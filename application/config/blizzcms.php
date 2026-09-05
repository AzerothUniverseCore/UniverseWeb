<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Website Name
 *
 * Write the name of your website this will appear by default.
 *
*/
$config['website_name'] = 'Azeroth Universe';

/**
 *
 * Timezone
 *
 * http://php.net/manual/en/timezones.php
 *
*/
$config['timezone'] = 'GMT';

/**
 *
 * Maintenance Mode
 *
 * 1 = Enable | 0 = Disable
 *
*/
$config['maintenance_mode'] = '0';

/**
 *
 * Invitation Discord
 *
 * Write the invitation of your discord channel.
 *
*/
$config['discord_invitation'] = 'yDVSxdWFYx';

/**
 *
 * Discord Vote Webhook
 *
 * URL du webhook Discord du salon #vote-alert : quand un joueur clique sur
 * "VOTE" (module vote, voir application/modules/vote/models/Vote_model.php)
 * ET que ce vote est reellement accepte (cooldown expire, pas juste un
 * re-clic pendant le cooldown), un message est poste dans ce salon avec le
 * pseudo du joueur et le nom du topsite.
 *
 * SECURITE - lisez avant de committer ce fichier dans un depot Git :
 * n'importe qui possedant cette URL peut poster des messages dans votre
 * salon Discord en votre nom (elle contient a la fois l'ID du webhook ET
 * son token secret). getenv() permet de la definir hors de ce fichier (ex:
 * SetEnv dans un vhost Apache/.htaccess prive, ou variable d'environnement
 * cote hebergeur) plutot que de la coder en dur ci-dessous - mais la valeur
 * codee en dur ci-dessous fonctionne aussi telle quelle si vous ne
 * publiez jamais ce fichier avec un vrai token dedans sur un depot public.
 *
 * Laissez une chaine vide ('') pour desactiver completement l'envoi
 * (aucune erreur, le vote continue de fonctionner normalement, juste sans
 * notification Discord).
 *
*/
$config['discord_vote_webhook_url'] = getenv('AU_DISCORD_VOTE_WEBHOOK_URL') ?: 'https://discord.com/api/webhooks/1247691761372102697/pSdmHHVpTrocQUz_hbMcZZ3p6miSj2cuRy-pZPgh3un1wd_76iEqOHipiEZiWoxW9w6Y';

/**
 *
 * RPG Paradize - API de vote (verification OTP)
 *
 * Permet de VERIFIER qu'un vote sur RPG Paradize a reellement eu lieu avant
 * de crediter les points, au lieu de faire confiance au simple clic sur
 * "Voter" (voir application/modules/vote/models/Vote_model.php et
 * application/libraries/Rpgparadize_api.php).
 *
 * rpgparadize_api_token : genere depuis le panel serveur RPG Paradize
 * ("Token API" > Generer un token). Donne acces en lecture/ecriture a
 * l'API REST de VOTRE serveur uniquement.
 *
 * rpgparadize_site_id : l'identifiant numerique de votre serveur sur
 * RPG Paradize (le "{siteId}" des routes /api/v1/servers/{siteId}/...).
 * Recupere ici depuis l'URL de vote deja configuree dans la table `votes`
 * (https://rpg-paradize.com/vote/112289 -> siteId = 112289).
 *
 * SECURITE - lisez avant de committer ce fichier dans un depot Git : ce
 * token permet d'agir sur votre compte serveur RPG Paradize (generer des
 * OTP en votre nom). Meme recommandation que pour le webhook Discord
 * ci-dessus : preferez getenv() (variable d'environnement / SetEnv Apache)
 * plutot que la valeur codee en dur, SURTOUT si ce depot est ou pourrait
 * devenir public un jour.
 *
 * Laissez le token vide ('') pour desactiver la verification : le vote
 * RPG Paradize retombe alors automatiquement sur l'ancien comportement
 * (credit immediat au clic, lien de vote statique), sans erreur.
 *
*/
$config['rpgparadize_api_token'] = getenv('AU_RPGPARADIZE_API_TOKEN') ?: 'asE5OoYhhxJFberq76n2q499sk3SzkkDlX1oGPTq209c4f62';
$config['rpgparadize_site_id'] = getenv('AU_RPGPARADIZE_SITE_ID') ?: '112289';

/**
 *
 * Cron - Cle secrete
 *
 * Protege application/controllers/Cron.php (verification periodique des
 * votes RPG Paradize en attente) contre un appel HTTP par n'importe qui.
 * Ignoree si le controleur est lance en ligne de commande (CLI, via le
 * planificateur de taches Windows) plutot que par une URL.
 *
 * Changez cette valeur avant la mise en prod.
 *
*/
$config['cron_secret'] = getenv('AU_CRON_SECRET') ?: '51d9a81f6f82774fa0358d37cf09d8a69d6c20c109e9b5f7';

/**
 *
 * Realmlist
 *
 * Write the realmlist used on your server to publish it on the website.
 *
*/
$config['realmlist'] = 'realm.azerothuniverse.org';

/**
 *  Bnet enabled?
 *
 *
 */

$config['bnet_enabled'] = false; // Default: True for Emulators BattleNet and false for not bnetserver

 /**
 *  Emulator
 *
 *
 *  srp6 = For Emulators (SRP6 Compatibility)
 *  old-trinity =  Trinity Core not SRP6  (Sha_pass_hash Compatibility)
 *  hex = For emulators Mangos  (HEX6 Compatibility)
 *
 */

$config['emulator'] = 'srp6';

/**
 *
 * Expansion Supported
 *
 * Select the expansion that your website will use among these options:
 *
 * 1 = Vanilla
 * 2 = The Burning Crusade
 * 3 = Wrath of the Lich King
 * 4 = Cataclysm
 * 5 = Mist of Pandaria
 * 6 = Warlords of Draenor
 * 7 = Legion
 * 8 = Battle for Azeroth
 * 9 = Shadowlands
 *
*/
$config['expansion'] = '3';

/**
 *
 * Theme Name
 *
 * Write the name of your theme
 * The name is the same as the main folder
 * The css must also have the same name
 * Default: default
 *
*/
$config['theme_name'] = 'default';

/**
 *
 * Social Links
 *
 * Write the links for redirect to your social networks.
 *
*/
$config['social_facebook'] = '';
$config['social_twitter'] = '';
$config['social_youtube'] = 'https://www.youtube.com/@AzerothUniverseTV';

/**
 *
 * Recaptcha (V2)
 *
 * Write the necessary keys to enable recaptcha in the register
 * Use the following page to create the necessary keys.
 * https://www.google.com/recaptcha/admin#list
 *
*/
$config['recaptcha_sitekey'] = '';

/**
 *
 * SMTP
 *
 * Write the necessary information for use SMTP to use in recovery password
 * and account activation.
 *
*/
$config['smtp_host'] = '';
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
$config['smtp_port'] = '465';
$config['smtp_crypto'] = 'ssl';

/**
 *
 * Email Settings
 *
 * Write the necessary information to use in sending emails.
 *
*/
$config['email_settings_sender'] = '';
$config['email_settings_sender_name'] = '';

/**
 *
 * Account Activation
 *
 * Enable or Disable the option to activate accounts by email.
 *
 * TRUE  = Enable
 * FALSE = Disable
 *
*/
$config['account_activation_required'] = FALSE;

/**
 *
 * Administrator Access Level
 *
 * Minimum gmlevel to access to admin sections.
 *
*/
$config['admin_access_level'] = '4';

/**
 *
 * Moderator Access Level
 *
 * Minimum gmlevel to access to mod sections.
 *
*/
$config['mod_access_level'] = '3';

/**
 *
 * Migrate Status
 *
 * Warning: Don't change this configuration.
 *
*/
$config['migrate_status'] = '0';
