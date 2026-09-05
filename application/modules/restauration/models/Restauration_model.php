<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Restauration_model
 *
 * Outil de "restauration de personnage" pour les joueurs revenant sur
 * Azeroth Universe apres le passage a une base de personnages (auc_chars)
 * propre. Le joueur prouve qu'un ancien personnage lui appartient en se
 * reconnectant avec son ANCIEN compte (l'ancienne auc_auth, restauree a
 * cote sous le nom configure dans le groupe de connexion 'auth_old'), puis
 * choisit lequel de ses anciens personnages copier vers son compte ACTUEL
 * sur la base de personnages live (groupe de connexion 'characters').
 *
 * Principe general :
 *  - Les bases 'chars_old' et 'auth_old' ne sont JAMAIS ecrites, uniquement
 *    lues. Ce sont des sauvegardes figees.
 *  - Toute l'ecriture se fait dans une seule transaction sur le groupe
 *    'characters' (la base live), pour ne jamais laisser un personnage a
 *    moitie copie si quelque chose echoue en cours de route.
 *  - Le `guid` du personnage change forcement (l'ancien guid peut deja
 *    exister sur la base live), donc TOUT ce qui reference ce guid doit
 *    etre reecrit avec le nouveau. Meme chose pour les objets (item_instance
 *    a son propre `guid` global, independant de celui du personnage) et les
 *    familiers (character_pet.id).
 *
 * Ce qui est copie :
 *  - La fiche personnage (characters), reassignee au compte ACTUEL du
 *    joueur (celui avec lequel il est connecte sur le site).
 *  - Tous les objets (sacs, banque, equipement) via item_instance +
 *    character_inventory, avec un nouveau guid d'objet pour chacun.
 *  - Les sets d'equipement, les cadeaux (item emballe), le stockage du
 *    Neant - ce sont les 3 seules autres tables qui referencent aussi un
 *    guid d'objet, donc elles utilisent la meme correspondance ancien
 *    guid -> nouveau guid que les objets ci-dessus.
 *  - Familiers (character_pet + leurs sorts/auras/cooldowns), avec un
 *    nouvel id de familier.
 *  - Tout le reste de la progression du personnage : sorts, competences,
 *    talents, hauts faits, reputation, quetes, glyphes, macros de raccourcis,
 *    lien du foyer, statistiques, nom decline, donnees de compte-personnage,
 *    etapes de peche, apparences de transmog "simples" (celles qui ne
 *    stockent qu'un ID d'objet generique, pas un guid d'objet precis).
 *
 * Ce qui n'est PAS copie (deliberement, pour rester simple et sur) :
 *  - Guilde, equipe d'arene, groupe (les ID de guilde/groupe/equipe de
 *    l'ancienne base ne veulent plus rien dire sur la nouvelle).
 *  - Liste d'amis/ignores (character_social) : ces guids-la pointent vers
 *    d'AUTRES personnages qui n'existent pas forcement sur la base live.
 *  - Courrier, hotel des ventes, petitions, sauvegardes d'instance/raid,
 *    cadavre en attente, file LFG, mode de guerre : etat transitoire, pas
 *    une "possession" du joueur.
 *  - Sanctions (character_banned) : une sanction ne doit jamais etre
 *    recopiee automatiquement, c'est une decision humaine.
 *  - Mods perso lies a un guid d'objet precis (transmogrification en dur,
 *    reforge, stats solocraft) : trop specifique/risque pour une v1, peut
 *    etre ajoute plus tard si besoin.
 *  - Raccourcis d'objets sur les barres d'action (character_action est
 *    copiee, mais si un bouton pointait vers un objet precis, ce guid
 *    d'objet n'est PAS reecrit - au pire le bouton s'affiche vide et le
 *    joueur le re-glisse depuis son sac, rien de casse).
 *
 * Un personnage ne peut etre restaure qu'UNE SEULE FOIS, ce qui est garanti
 * par la table `character_restore_log` (creee par
 * sql/character_restore_log.sql, a executer sur auc_chars) : c'est la meme
 * transaction que la copie elle-meme, donc soit tout est ecrit, soit rien.
 */
class Restauration_model extends CI_Model {

    /**
     * Tables qui ne referencent QUE le guid du personnage (aucun guid
     * d'objet ni de familier a l'interieur) : une simple copie des lignes
     * avec `guid` remplace par le nouveau suffit.
     */
    const SIMPLE_TABLES = array(
        'character_action',
        'character_aura',
        'character_declinedname',
        'character_glyphs',
        'character_homebind',
        'character_queststatus',
        'character_queststatus_daily',
        'character_queststatus_monthly',
        'character_queststatus_rewarded',
        'character_queststatus_seasonal',
        'character_queststatus_weekly',
        'character_reputation',
        'character_skills',
        'character_spell',
        'character_spell_cooldown',
        'character_talent',
        'character_talentspell',
        'character_achievement',
        'character_achievement_progress',
        'character_stats',
        'character_account_data',
        'character_fishingsteps',
        'character_transmog',
        'transmog_char',
        'character_arena_stats',
        'character_dracthyr_display',
    );

    /**
     * Verifie un identifiant/mot de passe par rapport a l'ANCIENNE base de
     * comptes (groupe de connexion 'auth_old'). Reprend exactement le meme
     * calcul SRP6 que Auth_model::game_hash('srp6', ...), puisque c'est
     * l'emulateur configure ($config['emulator']) pour ce serveur.
     *
     * @return int|false L'id du compte sur l'ANCIENNE base si le mot de
     *                    passe est correct, false sinon (compte inconnu,
     *                    mauvais mot de passe, ou emulateur non-srp6).
     */
    public function verifyOldAccount($username, $password)
    {
        $username = strtoupper(trim($username));
        if ($username === '' || $password === '')
        {
            return false;
        }

        $emulator = config_item('emulator');
        if ($emulator !== 'srp6')
        {
            // Ecrit pour le mode 'srp6' (celui utilise par ce site, voir
            // application/config/blizzcms.php). Si $config['emulator']
            // change un jour, il faut ajouter ici l'equivalent des deux
            // autres branches de Auth_model::game_hash() ('hex', 'old-trinity').
            log_message('error', 'Restauration_model::verifyOldAccount: emulateur "'.$emulator.'" non gere par l\'outil de restauration.');
            return false;
        }

        $oldAuth = $this->load->database('auth_old', TRUE);
        $account = $oldAuth->where('username', $username)->get('account')->row();

        if (!$account)
        {
            return false;
        }

        $computed = $this->srp6Verifier($account->username, $password, $account->salt);

        if (!hash_equals($account->verifier, $computed))
        {
            return false;
        }

        return (int) $account->id;
    }

    /**
     * Meme formule que Auth_model::game_hash($username, $password, 'srp6', $salt).
     * Dupliquee ici (plutot que reutilisee via wowauth) pour que cet outil
     * reste autonome et ne depende jamais de la config d'authentification
     * "courante" du site pour verifier un mot de passe de l'ANCIENNE base.
     */
    private function srp6Verifier($username, $password, $salt)
    {
        $g = gmp_init(7);
        $N = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);

        $h1 = sha1(strtoupper($username . ':' . $password), TRUE);
        $h2 = sha1($salt . $h1, TRUE);
        $h2 = gmp_import($h2, 1, GMP_LSW_FIRST);

        $verifier = gmp_powm($g, $h2, $N);
        $verifier = gmp_export($verifier, 1, GMP_LSW_FIRST);

        return str_pad($verifier, 32, chr(0), STR_PAD_RIGHT);
    }

    /**
     * Liste les personnages restaurables d'un ancien compte (non supprimes),
     * avec un indicateur already_restored pour ceux deja recuperes.
     */
    public function getRestorableCharacters($oldAccountId)
    {
        $oldDb = $this->load->database('chars_old', TRUE);
        $chars = $oldDb->where('account', $oldAccountId)
                       ->where('deleteDate', NULL)
                       ->order_by('level', 'DESC')
                       ->get('characters')
                       ->result_array();

        if (empty($chars))
        {
            return array();
        }

        $newDb = $this->load->database('characters', TRUE);
        $guids = array_map(function ($c) { return (int) $c['guid']; }, $chars);

        $restored = array();
        $logRows = $newDb->select('old_character_guid')
                          ->where_in('old_character_guid', $guids)
                          ->get('character_restore_log')
                          ->result_array();
        foreach ($logRows as $row)
        {
            $restored[(int) $row['old_character_guid']] = true;
        }

        foreach ($chars as &$c)
        {
            $c['already_restored'] = isset($restored[(int) $c['guid']]);
        }

        return $chars;
    }

    /**
     * @return bool True si ce guid (sur l'ancienne base) a deja ete restaure.
     */
    public function isAlreadyRestored($oldGuid)
    {
        $newDb = $this->load->database('characters', TRUE);
        return $newDb->where('old_character_guid', $oldGuid)
                      ->get('character_restore_log')
                      ->num_rows() > 0;
    }

    /**
     * Copie un ancien personnage vers le compte ACTUEL du joueur sur la
     * base live. Toute la logique est dans une seule transaction sur le
     * groupe 'characters' : soit tout est ecrit, soit rien ne l'est.
     *
     * @return array ['success' => bool, 'message' => string, 'name' => ?string, 'guid' => ?int]
     */
    public function restoreCharacter($oldGuid, $oldAccountId, $newAccountId)
    {
        $oldDb = $this->load->database('chars_old', TRUE);
        $newDb = $this->load->database('characters', TRUE);

        // Revalidation "en dur" cote modele (le controleur a deja verifie
        // ces points avant d'appeler restoreCharacter, mais on ne fait
        // jamais confiance qu'a une seule couche pour une action qui ecrit
        // en base de facon quasi irreversible).
        $oldChar = $oldDb->where('guid', $oldGuid)
                         ->where('account', $oldAccountId)
                         ->where('deleteDate', NULL)
                         ->get('characters')
                         ->row_array();

        if (!$oldChar)
        {
            return array('success' => false, 'message' => "Ce personnage n'existe pas, n'appartient pas a ce compte, ou a ete supprime.");
        }

        if ($this->isAlreadyRestored($oldGuid))
        {
            return array('success' => false, 'message' => "Ce personnage a deja ete restaure precedemment.");
        }

        if ($newDb->where('name', $oldChar['name'])->get('characters')->num_rows() > 0)
        {
            return array('success' => false, 'message' => "Un personnage nomme \"" . $oldChar['name'] . "\" existe deja sur le serveur actuel. Contacte le staff pour regler ce conflit de nom avant de pouvoir restaurer ce personnage.");
        }

        $newDb->trans_begin();

        try
        {
            // FOR UPDATE reduit (sans l'annuler completement) le risque de
            // collision si deux restaurations partaient exactement en meme
            // temps - largement suffisant pour un outil en libre-service a
            // faible volume comme celui-ci.
            $newGuid      = (int) $newDb->query('SELECT MAX(guid) AS m FROM characters FOR UPDATE')->row()->m + 1;
            $nextItemGuid = (int) $newDb->query('SELECT MAX(guid) AS m FROM item_instance FOR UPDATE')->row()->m + 1;
            $nextPetId    = (int) $newDb->query('SELECT IFNULL(MAX(id), 0) AS m FROM character_pet FOR UPDATE')->row()->m + 1;

            // 1) La fiche personnage elle-meme.
            $charRow = $oldChar;
            $charRow['guid']               = $newGuid;
            $charRow['account']            = $newAccountId;
            $charRow['online']             = 0;
            $charRow['deleteInfos_Account'] = NULL;
            $charRow['deleteInfos_Name']    = NULL;
            $charRow['deleteDate']          = NULL;
            $newDb->insert('characters', $charRow);

            // 2) Les objets d'abord : tout le reste qui reference un guid
            //    d'objet se sert de la correspondance construite ici.
            $itemGuidMap = array();
            $this->copyItemsAndBuildMap($oldDb, $newDb, $oldGuid, $newGuid, $itemGuidMap, $nextItemGuid);
            $this->copyInventory($oldDb, $newDb, $oldGuid, $newGuid, $itemGuidMap);
            $this->copyEquipmentSets($oldDb, $newDb, $oldGuid, $newGuid, $itemGuidMap);
            $this->copyGifts($oldDb, $newDb, $oldGuid, $newGuid, $itemGuidMap);
            $this->copyVoidStorage($oldDb, $newDb, $oldGuid, $newGuid, $itemGuidMap, $nextItemGuid);

            // 3) Familiers.
            $this->copyPets($oldDb, $newDb, $oldGuid, $newGuid, $nextPetId);

            // 4) Tout le reste (sorts, talents, quetes, reputation, hauts
            //    faits, glyphes, foyer, stats, nom decline, etc.)
            foreach (self::SIMPLE_TABLES as $table)
            {
                $this->copySimpleTable($oldDb, $newDb, $table, $oldGuid, $newGuid);
            }

            // 5) On journalise AVANT le commit, dans la meme transaction :
            //    si cette ligne ne peut pas s'ecrire, tout le reste doit
            //    etre annule pour eviter qu'un personnage soit restaurable
            //    une deuxieme fois.
            $newDb->insert('character_restore_log', array(
                'old_account_id'     => $oldAccountId,
                'old_character_guid' => $oldGuid,
                'old_character_name' => $oldChar['name'],
                'new_account_id'     => $newAccountId,
                'new_character_guid' => $newGuid,
                'restored_at'        => date('Y-m-d H:i:s'),
                'restored_ip'        => $this->input->ip_address(),
            ));

            if ($newDb->trans_status() === FALSE)
            {
                throw new Exception('trans_status() a signale un echec.');
            }

            $newDb->trans_commit();

            return array('success' => true, 'message' => 'ok', 'name' => $oldChar['name'], 'guid' => $newGuid);
        }
        catch (Exception $e)
        {
            $newDb->trans_rollback();
            log_message('error', 'Restauration_model::restoreCharacter: echec pour old guid ' . $oldGuid . ' - ' . $e->getMessage());
            return array('success' => false, 'message' => "Une erreur est survenue pendant la restauration, rien n'a ete modifie. Le staff a ete notifie via les logs.");
        }
    }

    /**
     * Copie item_instance pour ce personnage, alloue un nouveau guid pour
     * chaque objet et remplit $itemGuidMap[ancienGuid] = nouveauGuid.
     *
     * creatorGuid / giftCreatorGuid ne sont PAS reecrits : ce sont des
     * informations purement cosmetiques (l'infobulle "Cree par..."), qui
     * peuvent continuer a pointer vers un guid de l'ancienne base sans
     * casser quoi que ce soit - au pire, le jeu ne retrouve pas ce
     * personnage-la et n'affiche simplement pas cette ligne d'infobulle.
     */
    private function copyItemsAndBuildMap($oldDb, $newDb, $oldGuid, $newGuid, array &$itemGuidMap, &$nextItemGuid)
    {
        $items = $oldDb->where('owner_guid', $oldGuid)->get('item_instance')->result_array();

        foreach ($items as $item)
        {
            $oldItemGuid = (int) $item['guid'];
            $newItemGuid = $nextItemGuid++;
            $itemGuidMap[$oldItemGuid] = $newItemGuid;

            $item['guid']       = $newItemGuid;
            $item['owner_guid'] = $newGuid;

            $newDb->insert('item_instance', $item);
        }

        return count($items);
    }

    /**
     * character_inventory.item est un guid d'objet, et character_inventory.bag
     * l'est aussi quand l'objet est range DANS un sac (0 = pas dans un sac,
     * cette valeur ne peut jamais entrer en collision avec un vrai guid).
     */
    private function copyInventory($oldDb, $newDb, $oldGuid, $newGuid, array $itemGuidMap)
    {
        $rows = $oldDb->where('guid', $oldGuid)->get('character_inventory')->result_array();

        foreach ($rows as $row)
        {
            $oldItem = (int) $row['item'];
            if (!isset($itemGuidMap[$oldItem]))
            {
                // Ne devrait normalement jamais arriver (chaque ligne
                // d'inventaire doit correspondre a un objet qu'on vient de
                // copier), mais on saute la ligne plutot que d'ecrire un
                // guid d'objet qui n'existe pas.
                continue;
            }

            $row['guid'] = $newGuid;
            $row['item'] = $itemGuidMap[$oldItem];

            $oldBag = (int) $row['bag'];
            if ($oldBag !== 0 && isset($itemGuidMap[$oldBag]))
            {
                $row['bag'] = $itemGuidMap[$oldBag];
            }

            $newDb->insert('character_inventory', $row);
        }

        return count($rows);
    }

    /**
     * character_equipmentsets.item0..item18 sont des guids d'objet.
     * setguid est un identifiant global auto-increment (partage par TOUS
     * les personnages de la base), donc on le laisse volontairement de
     * cote pour que la base live en attribue un nouveau.
     */
    private function copyEquipmentSets($oldDb, $newDb, $oldGuid, $newGuid, array $itemGuidMap)
    {
        $rows = $oldDb->where('guid', $oldGuid)->get('character_equipmentsets')->result_array();

        foreach ($rows as $row)
        {
            $row['guid'] = $newGuid;
            unset($row['setguid']);

            for ($i = 0; $i <= 18; $i++)
            {
                $col = 'item' . $i;
                $old = (int) $row[$col];
                $row[$col] = ($old !== 0 && isset($itemGuidMap[$old])) ? $itemGuidMap[$old] : 0;
            }

            $newDb->insert('character_equipmentsets', $row);
        }

        return count($rows);
    }

    /**
     * character_gifts.item_guid reference un objet emballe deja copie
     * ci-dessus. Si pour une raison quelconque cet objet n'a pas ete
     * copie, on saute la ligne plutot que d'ecrire un guid orphelin.
     */
    private function copyGifts($oldDb, $newDb, $oldGuid, $newGuid, array $itemGuidMap)
    {
        $rows = $oldDb->where('guid', $oldGuid)->get('character_gifts')->result_array();
        $copied = 0;

        foreach ($rows as $row)
        {
            $oldItemGuid = (int) $row['item_guid'];
            if (!isset($itemGuidMap[$oldItemGuid]))
            {
                continue;
            }

            $row['guid']      = $newGuid;
            $row['item_guid'] = $itemGuidMap[$oldItemGuid];
            $newDb->insert('character_gifts', $row);
            $copied++;
        }

        return $copied;
    }

    /**
     * Le stockage du Neant n'a pas de ligne item_instance correspondante
     * dans ce schema (c'est un stockage a part) : on alloue donc un
     * nouveau guid depuis le MEME compteur que les objets normaux, pour
     * garantir qu'il ne rentre jamais en collision avec un vrai guid
     * d'objet de la base live.
     */
    private function copyVoidStorage($oldDb, $newDb, $oldGuid, $newGuid, array &$itemGuidMap, &$nextItemGuid)
    {
        $rows = $oldDb->where('guid', $oldGuid)->get('character_void_storage')->result_array();

        foreach ($rows as $row)
        {
            $oldItemGuid = (int) $row['item_guid'];
            if (!isset($itemGuidMap[$oldItemGuid]))
            {
                $itemGuidMap[$oldItemGuid] = $nextItemGuid++;
            }

            $row['guid']      = $newGuid;
            $row['item_guid'] = $itemGuidMap[$oldItemGuid];
            $newDb->insert('character_void_storage', $row);
        }

        return count($rows);
    }

    /**
     * character_pet.id est lui aussi un identifiant global auto-increment
     * (partage par tous les familiers de la base), donc chaque familier
     * recoit un nouvel id, propage ensuite a ses sorts/auras/cooldowns.
     */
    private function copyPets($oldDb, $newDb, $oldGuid, $newGuid, &$nextPetId)
    {
        $pets = $oldDb->where('owner', $oldGuid)->get('character_pet')->result_array();
        $petIdMap = array();

        foreach ($pets as $pet)
        {
            $oldPetId = (int) $pet['id'];
            $newPetId = $nextPetId++;
            $petIdMap[$oldPetId] = $newPetId;

            $pet['id']    = $newPetId;
            $pet['owner'] = $newGuid;
            $newDb->insert('character_pet', $pet);
        }

        foreach ($petIdMap as $oldPetId => $newPetId)
        {
            foreach (array('pet_aura', 'pet_spell', 'pet_spell_cooldown') as $table)
            {
                $rows = $oldDb->where('guid', $oldPetId)->get($table)->result_array();
                foreach ($rows as $row)
                {
                    $row['guid'] = $newPetId;
                    $newDb->insert($table, $row);
                }
            }
        }

        return count($pets);
    }

    /**
     * Copie generique pour une table qui ne reference QUE le guid du
     * personnage (voir self::SIMPLE_TABLES).
     */
    private function copySimpleTable($oldDb, $newDb, $table, $oldGuid, $newGuid)
    {
        $rows = $oldDb->where('guid', $oldGuid)->get($table)->result_array();

        foreach ($rows as $row)
        {
            $row['guid'] = $newGuid;
            $newDb->insert($table, $row);
        }

        return count($rows);
    }
}
