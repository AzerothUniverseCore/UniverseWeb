<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cron
 *
 * Taches planifiees du site, executees periodiquement en dehors de toute
 * requete joueur. Pour l'instant : verification des votes RPG Paradize en
 * attente d'une confirmation OTP (voir application/libraries/Rpgparadize_api.php
 * et application/modules/vote/models/Vote_model.php).
 *
 * Deux facons de la declencher :
 *
 * 1. Ligne de commande (recommande, pas d'exposition HTTP) :
 *      php index.php cron checkRpgParadizeVotes
 *    A planifier avec le Planificateur de taches Windows (Task Scheduler),
 *    toutes les 1 a 2 minutes, action "Demarrer un programme" :
 *      Programme  : C:\chemin\vers\php.exe
 *      Arguments  : index.php cron checkRpgParadizeVotes
 *      Dossier de demarrage : C:\Servers\Sources\UniverseWeb
 *
 * 2. Appel HTTP protege par un secret (si le CLI n'est pas pratique a
 *    planifier sur votre config) :
 *      https://votre-site/cron/checkRpgParadizeVotes?secret=VOTRE_CRON_SECRET
 *    Le secret vient de $config['cron_secret'] (application/config/blizzcms.php).
 *    Changez-le avant la mise en prod -- n'importe qui connaissant l'URL +
 *    le secret peut declencher la verification (sans consequence grave en
 *    soi, mais autant la garder privee).
 *
 * @author  iThorgrim / adapte pour Azeroth Universe
 */
class Cron extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Verifie tous les tokens OTP RPG Paradize encore en attente : credite
     * les votes confirmes, expire ceux dont le delai de 10 minutes est
     * depasse sans confirmation. Voir Vote_model::checkPendingRpgParadizeOtp().
     */
    public function checkRpgParadizeVotes()
    {
        if (!$this->isAllowed()) {
            show_404();
            return;
        }

        $this->load->model('vote/vote_model');

        $result = $this->vote_model->checkPendingRpgParadizeOtp();

        $line = sprintf(
            '[Cron] RPG Paradize OTP check : %d verifie(s), %d expire(s), %d a reessayer.',
            $result['verified'],
            $result['expired'],
            $result['retried']
        );
        log_message('info', $line);

        // CLI : simple sortie texte. HTTP : reponse JSON minimale, pratique
        // pour verifier manuellement que le cron tourne bien.
        if (is_cli()) {
            echo $line . PHP_EOL;
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => true) + $result));
    }

    /**
     * Autorise l'appel s'il vient de la ligne de commande (planificateur de
     * taches local), ou si le parametre ?secret= correspond a
     * $config['cron_secret']. Refuse tout le reste (renvoie un simple 404 --
     * pas d'indice pour un visiteur qui tomberait dessus par hasard).
     */
    private function isAllowed()
    {
        if (is_cli()) {
            return true;
        }

        $expected = trim((string) $this->config->item('cron_secret'));
        $given = trim((string) $this->input->get('secret'));

        return $expected !== '' && hash_equals($expected, $given);
    }
}
