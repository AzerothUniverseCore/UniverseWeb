<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model {

    /**
     * Vote_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getVotes()
    {
        return $this->db->get('votes')->result();
    }

    public function getVotePoints($id)
    {
        return $this->db->where('id', $id)->get('votes')->row('points');
    }

    public function getVoteTime($id)
    {
        return $this->db->where('id', $id)->get('votes')->row('time');
    }

    public function getVoteName($id)
    {
        return $this->db->where('id', $id)->get('votes')->row('name');
    }

    public function getVoteLog($id, $userid)
    {
        return $this->db->where('idaccount', $userid)->where('idvote', $id)->limit('1')->order_by('id', 'DESC')->get('votes_logs');
    }

    public function getTimeLogExpired($id, $userid)
    {
        return $this->db->where('idaccount', $userid)->where('idvote', $id)->limit('1')->order_by('id', 'DESC')->get('votes_logs')->row('expired_at');
    }

    public function getCredits($userid)
    {
        return $this->db->where('id', $userid)->limit('1')->get('users')->row('vp');
    }

    public function getVoteUrl($id)
    {
        return $this->db->where('id', $id)->get('votes')->row('url');
    }

    public function voteNow($id)
    {
        $userid = $this->session->userdata('wow_sess_id');
        $votetime = $this->getVoteTime($id);

        $qqcheck = $this->getVoteLog($id, $userid);
        $comprobetime = $qqcheck->row('expired_at');

        // Cooldown pas encore ecoule : comportement inchange, quel que soit
        // le topsite (RPG Paradize inclus -- pas la peine d'aller generer un
        // OTP si le joueur ne peut de toute facon pas encore revoter).
        if ($this->wowgeneral->getTimestamp() < $comprobetime) {
            echo '<script type="text/javascript">alert("According to our records you have already voted in this top. Contact with Support Ingame for Resolving this problem")</script>';
            redirect(site_url($this->lang->lang().'/vote'),'refresh');
            return;
        }

        // RPG Paradize (et uniquement ce topsite, identifie par son domaine
        // dans la colonne `url`) beneficie d'une vraie verification API
        // avant de crediter -- voir voteNowRpgParadize(). Tous les autres
        // topsites gardent l'ancien comportement (credit immediat au clic),
        // faute d'API de verification equivalente.
        $this->load->library('rpgparadize_api');
        if ($this->isRpgParadizeVote($id) && $this->rpgparadize_api->isConfigured()) {
            $handled = $this->voteNowRpgParadize($id, $userid, $votetime);
            if ($handled) {
                return;
            }
            // $handled === false : API injoignable/mal configuree au moment
            // de generer l'OTP -- on retombe sciemment sur l'ancien
            // comportement juste en dessous plutot que de bloquer le vote.
        }

        $ppoints = $this->getVotePoints($id);
        $url = $this->getVoteUrl($id);

        if(!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        $this->creditVote($id, $userid, $ppoints, $votetime);

        echo '<script type="text/javascript">
                window.open( "'.$url.'","_self")
            </script>';

        redirect(site_url($this->lang->lang().'/vote'),'refresh');
    }

    /**
     * TRUE si la ligne `votes` #$id pointe vers RPG Paradize (identifie par
     * son domaine plutot que par un id fixe, au cas ou l'ordre des topsites
     * changerait dans la table).
     */
    private function isRpgParadizeVote($id)
    {
        $url = $this->getVoteUrl($id);
        return $url && stripos($url, 'rpg-paradize.com') !== false;
    }

    /**
     * Flux OTP RPG Paradize : genere un token via l'API, l'enregistre comme
     * "pending" dans votes_rpgparadize_otp, puis redirige le joueur vers le
     * vote_url renvoye par l'API (qui embarque ce token) au lieu du lien
     * statique de la table `votes`. Les points ne sont PAS credites ici --
     * Cron::checkRpgParadizeVotes() les creditera une fois le vote
     * reellement confirme par RPG Paradize (voir creditVote()).
     *
     * @return bool TRUE si le flux OTP a pris le relais (la reponse HTTP est
     *              deja envoyee, l'appelant ne doit rien faire de plus),
     *              FALSE si l'API n'a pas repondu correctement -- l'appelant
     *              doit alors retomber sur l'ancien comportement.
     */
    private function voteNowRpgParadize($id, $userid, $votetime)
    {
        $otp = $this->rpgparadize_api->generateOtp();

        if (!$otp || empty($otp['token']) || empty($otp['vote_url'])) {
            log_message('error', 'RPG Paradize : echec generation OTP pour le compte ' . $userid . ', fallback sur le lien statique.');
            return false;
        }

        $now = $this->wowgeneral->getTimestamp();
        $expiresIn = isset($otp['expires_in']) ? (int) $otp['expires_in'] : 600;

        // Un seul OTP "vivant" a la fois par compte+topsite : les anciens
        // pending non consommes sont marques expired pour ne jamais pouvoir
        // etre confondus avec celui-ci (creditVote() ne s'execute qu'une
        // seule fois par ligne verified de toute facon, mais autant garder
        // la table propre).
        $this->db->where('idaccount', $userid)
            ->where('idvote', $id)
            ->where('status', 'pending')
            ->update('votes_rpgparadize_otp', array('status' => 'expired'));

        $this->db->insert('votes_rpgparadize_otp', array(
            'idaccount'    => $userid,
            'idvote'       => $id,
            'otp_token'    => $otp['token'],
            'requested_at' => $now,
            'expires_at'   => $now + $expiresIn,
            'status'       => 'pending',
        ));

        // On ne credite rien et on n'ecrit pas dans votes_logs tout de
        // suite -- ca, c'est le role de creditVote(), appele par le cron
        // uniquement quand RPG Paradize confirme le vote. Idem pour
        // l'alerte Discord : elle ne doit partir que sur un vote reellement
        // confirme (voir Cron::checkRpgParadizeVotes()).
        echo '<script type="text/javascript">
                window.open( "'.$otp['vote_url'].'","_self")
            </script>';

        redirect(site_url($this->lang->lang().'/vote'),'refresh');

        return true;
    }

    /**
     * Credite les points de vote et enregistre le log -- factorise pour
     * etre appele soit immediatement (voteNow(), tous les topsites sauf RPG
     * Paradize), soit differe (Cron::checkRpgParadizeVotes(), une fois le
     * vote RPG Paradize confirme par l'API).
     */
    public function creditVote($id, $userid, $ppoints, $votetime)
    {
        $mytime = $this->wowgeneral->getTimestamp();

        $fecha = new DateTime();
        $expired = $fecha->add(new DateInterval('PT'.$votetime.'H'));
        $expired_at = $expired->getTimestamp();

        $vp2 = $this->db->where('id', $userid)->get('users')->row('vp');
        $vp = ($vp2+$ppoints);

        $data = array('vp' => $vp);

        $logs = array(
            'idaccount' => $userid,
            'idvote' => $id,
            'lasttime' => $mytime,
            'expired_at' => $expired_at,
            'points' => $ppoints
        );

        $this->db->where('id', $userid)->update('users', $data);
        $this->db->insert('votes_logs', $logs);

        // Alerte Discord (#vote-alert) : UNIQUEMENT ici, dans la branche
        // ou le vote est reellement accepte (cooldown expire, et pour RPG
        // Paradize : vote confirme par l'API) - jamais dans la branche
        // "deja vote", qui ne represente pas un vote reel. Best-effort : si
        // Discord est injoignable ou mal configure, on log l'erreur mais on
        // ne bloque JAMAIS le credit des points (voir sendDiscordVoteAlert()).
        $this->sendDiscordVoteAlert($id, $ppoints, $userid);
    }

    /**
     * Verifie tous les OTP RPG Paradize encore "pending" : credite les
     * votes confirmes, marque comme "expired" ceux dont le delai de 10
     * minutes est depasse sans confirmation. Appelee periodiquement par
     * Cron::checkRpgParadizeVotes() (voir application/controllers/Cron.php).
     *
     * @return array{verified: int, expired: int, retried: int} Petit
     *         resume pour le log/la reponse du controleur.
     */
    public function checkPendingRpgParadizeOtp()
    {
        $this->load->library('rpgparadize_api');

        $result = array('verified' => 0, 'expired' => 0, 'retried' => 0);
        $now = $this->wowgeneral->getTimestamp();

        $pending = $this->db->where('status', 'pending')->get('votes_rpgparadize_otp')->result();

        foreach ($pending as $row) {
            $verified = $this->rpgparadize_api->verifyOtp($row->otp_token);

            if ($verified === null) {
                // API injoignable : on reessaiera au prochain passage du
                // cron, SAUF si le token est de toute facon deja expire
                // cote RPG Paradize (10 min) -- dans ce cas, inutile
                // d'insister indefiniment.
                $result['retried']++;
                if ($now >= $row->expires_at) {
                    $this->db->where('id', $row->id)->update('votes_rpgparadize_otp', array('status' => 'expired'));
                    $result['expired']++;
                    $result['retried']--;
                }
                continue;
            }

            if ($verified === true) {
                // Garde anti double-credit : on ne credite QUE si c'est bien
                // CETTE execution qui a fait passer la ligne de "pending" a
                // "verified" (WHERE status='pending' + affected_rows). Si
                // deux passages du cron se chevauchaient jamais, le second
                // trouverait 0 ligne affectee et ne crediterait rien deux fois.
                $this->db->where('id', $row->id)->where('status', 'pending')
                    ->update('votes_rpgparadize_otp', array('status' => 'verified'));

                if ($this->db->affected_rows() > 0) {
                    $ppoints = $this->getVotePoints($row->idvote);
                    $votetime = $this->getVoteTime($row->idvote);
                    $this->creditVote($row->idvote, $row->idaccount, $ppoints, $votetime);

                    $result['verified']++;
                }
                continue;
            }

            // $verified === false : pas encore vote. On abandonne seulement
            // une fois le delai de 10 minutes de l'OTP depasse.
            if ($now >= $row->expires_at) {
                $this->db->where('id', $row->id)->update('votes_rpgparadize_otp', array('status' => 'expired'));
                $result['expired']++;
            }
        }

        return $result;
    }

    /**
     * Poste un message dans le salon Discord #vote-alert quand un vote
     * vient d'etre valide. URL de webhook lue depuis la config
     * (discord_vote_webhook_url, voir application/config/blizzcms.php) :
     * vide/absente => on ne fait rien (pas d'erreur, le vote continue de
     * fonctionner normalement).
     *
     * Volontairement tout en PHP cote serveur (jamais expose au
     * navigateur) : l'URL d'un webhook Discord permet de poster des
     * messages en votre nom a quiconque la possede, elle ne doit donc
     * JAMAIS transiter par du JavaScript cote client ni par une reponse
     * HTTP lisible par le joueur.
     */
    private function sendDiscordVoteAlert($id, $points, $userid)
    {
        $webhookUrl = $this->config->item('discord_vote_webhook_url');
        if (empty($webhookUrl)) {
            return;
        }

        // FIX : le pseudo NE PEUT PAS venir de la session ($this->session->
        // userdata('wow_sess_username')) -- ca fonctionnait pour les
        // topsites a credit immediat (executes pendant la requete du joueur,
        // donc sa session existe), mais creditVote() est aussi appelee
        // depuis Cron::checkRpgParadizeVotes(), qui tourne dans une requete
        // totalement separee (curl/CLI, sans session joueur) -- d'ou le
        // "Un joueur" generique observe sur les votes RPG Paradize. On va
        // toujours chercher le pseudo en base via le compte ($userid),
        // exactement comme le fait Auth_model::getUsernameID() -- $this->
        // wowauth est l'alias autoload de Auth_model (voir application/
        // config/autoload.php), deja connecte a la base auc_auth.
        $username = $this->wowauth->getUsernameID($userid);
        if (empty($username)) {
            $username = 'Un joueur';
        }
        // Echappement defensif : un pseudo contenant "@" ne doit jamais
        // pouvoir declencher un ping @everyone/@here dans le salon Discord
        // (peu probable vu les regles d'inscription du compte de jeu, mais
        // ce message est construit a partir d'une donnee fournie par le
        // joueur, donc autant rester prudent).
        $username = str_replace('@', "@\xE2\x80\x8B", $username);

        $topsiteName = $this->getVoteName($id);
        if (empty($topsiteName)) {
            $topsiteName = 'un topsite';
        }

        $payload = array(
            'embeds' => array(array(
                'title' => '🗳️ Nouveau vote !',
                'description' => "**{$username}** vient de voter sur **{$topsiteName}**.",
                'color' => hexdec('F5A623'),
                'fields' => array(array(
                    'name' => 'Points gagnés',
                    'value' => '+' . $points . ' VP',
                    'inline' => true,
                )),
                'footer' => array('text' => $this->config->item('website_name')),
                'timestamp' => gmdate('c'),
            )),
        );

        $this->postDiscordWebhook($webhookUrl, $payload);
    }

    /**
     * POST JSON minimal via file_get_contents/stream_context_create : pas
     * de dependance a l'extension curl (pas garantie activee chez tous les
     * hebergeurs mutualises PHP). Timeout court (4s) et erreurs
     * uniquement journalisees (log_message, voir application/logs/) -
     * cette fonction ne doit JAMAIS lever d'exception ni afficher de
     * warning au joueur : un Discord indisponible ne doit pas empecher un
     * vote de fonctionner.
     */
    private function postDiscordWebhook($webhookUrl, array $payload)
    {
        $body = json_encode($payload);
        if ($body === false) {
            log_message('error', 'Discord vote webhook: echec json_encode du payload.');
            return;
        }

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => $body,
                'timeout' => 4,
                'ignore_errors' => true,
            ),
        ));

        $response = @file_get_contents($webhookUrl, false, $context);

        if ($response === false) {
            log_message('error', 'Discord vote webhook: envoi echoue (hote injoignable ou timeout).');
            return;
        }

        // Discord repond 204 No Content en cas de succes ; tout le reste
        // (400/401/404 - webhook invalide/supprime, 429 - rate limit...)
        // n'est qu'une trace de debogage, jamais une erreur bloquante pour
        // le joueur.
        if (isset($http_response_header[0]) && strpos($http_response_header[0], '204') === false) {
            log_message('error', 'Discord vote webhook: reponse inattendue - ' . $http_response_header[0]);
        }
    }
}
