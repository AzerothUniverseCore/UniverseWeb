<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Restauration
 *
 * Page "restauration de personnage" : un joueur deja connecte sur le site
 * (avec son compte ACTUEL) peut recuperer un ancien personnage en prouvant
 * qu'il possede l'ANCIEN compte sur lequel ce personnage etait joue (voir
 * Restauration_model pour le detail de ce qui est copie / pas copie et
 * pourquoi).
 *
 * Duree de validite de la verification : 15 minutes (RESTORE_SESSION_TTL),
 * pour laisser le temps de restaurer plusieurs anciens personnages dans la
 * meme visite sans avoir a retaper son ancien mot de passe a chaque fois,
 * sans pour autant laisser une verification trainer indefiniment en session.
 */
class Restauration extends MX_Controller {

    const RESTORE_SESSION_TTL = 900; // 15 minutes
    const MAX_LOGIN_ATTEMPTS = 5;
    const LOGIN_ATTEMPTS_WINDOW = 600; // 10 minutes

    public function __construct()
    {
        parent::__construct();
        $this->load->model('restauration_model');

        if (!ini_get('date.timezone'))
            date_default_timezone_set($this->config->item('timezone'));

        if (!$this->wowgeneral->getMaintenance())
            redirect(site_url($this->lang->lang() . '/maintenance'), 'refresh');

        if (!$this->wowauth->isLogged())
            redirect(site_url($this->lang->lang() . '/login'), 'refresh');
    }

    /**
     * Formulaire "ancien compte" (etape 1). Si une verification recente est
     * deja en session, on passe directement a la liste des personnages.
     */
    public function index()
    {
        if ($this->hasValidRestoreSession())
        {
            redirect(site_url($this->lang->lang() . '/restauration/personnages'), 'refresh');
        }

        $error = NULL;

        if ($this->input->method() === 'post')
        {
            $error = $this->handleLoginAttempt();

            if ($error === NULL)
            {
                redirect(site_url($this->lang->lang() . '/restauration/personnages'), 'refresh');
            }
        }

        $data = array(
            'pagetitle' => 'Restauration de personnage',
            'error'     => $error,
        );

        $this->template->build('restauration/index', $data);
    }

    /**
     * Liste des anciens personnages du compte verifie (etape 2).
     */
    public function personnages()
    {
        if (!$this->hasValidRestoreSession())
        {
            redirect(site_url($this->lang->lang() . '/restauration'), 'refresh');
        }

        $oldAccountId = (int) $this->session->userdata('restore_old_account_id');

        $data = array(
            'pagetitle'  => 'Restauration de personnage',
            'characters' => $this->restauration_model->getRestorableCharacters($oldAccountId),
        );

        $this->template->build('restauration/personnages', $data);
    }

    /**
     * Lance la restauration d'UN personnage (etape 3, appele en POST
     * uniquement depuis le bouton de la vue personnages).
     */
    public function restaurer($oldGuid = NULL)
    {
        if (!$this->hasValidRestoreSession() || $this->input->method() !== 'post')
        {
            redirect(site_url($this->lang->lang() . '/restauration'), 'refresh');
        }

        $oldGuid = (int) $oldGuid;
        $oldAccountId = (int) $this->session->userdata('restore_old_account_id');
        $newAccountId = (int) $this->session->userdata('wow_sess_id');

        $result = $this->restauration_model->restoreCharacter($oldGuid, $oldAccountId, $newAccountId);

        $data = array(
            'pagetitle' => 'Restauration de personnage',
            'result'    => $result,
        );

        $this->template->build('restauration/resultat', $data);
    }

    /**
     * Traite la soumission du formulaire "ancien compte". Retourne un
     * message d'erreur (string) a afficher, ou NULL si la verification a
     * reussi (et la session a ete marquee comme verifiee).
     */
    private function handleLoginAttempt()
    {
        $attempts  = (int) ($this->session->userdata('restore_login_attempts') ?: 0);
        $attemptAt = (int) ($this->session->userdata('restore_login_attempts_at') ?: 0);

        if ($attempts >= self::MAX_LOGIN_ATTEMPTS && (time() - $attemptAt) < self::LOGIN_ATTEMPTS_WINDOW)
        {
            $wait = ceil((self::LOGIN_ATTEMPTS_WINDOW - (time() - $attemptAt)) / 60);
            return "Trop de tentatives. Reessaie dans environ " . $wait . " minute(s).";
        }

        $username = trim((string) $this->input->post('old_username', TRUE));
        $password = (string) $this->input->post('old_password', TRUE);

        if ($username === '' || $password === '')
        {
            return "Merci de remplir l'identifiant et le mot de passe de ton ANCIEN compte.";
        }

        $oldAccountId = $this->restauration_model->verifyOldAccount($username, $password);

        if ($oldAccountId === false)
        {
            $this->session->set_userdata('restore_login_attempts', $attempts + 1);
            $this->session->set_userdata('restore_login_attempts_at', time());
            return "Identifiant ou mot de passe incorrect pour l'ancien compte.";
        }

        // Reset du compteur de tentatives, et ouverture de la fenetre de
        // 15 minutes pendant laquelle les personnages de ce compte peuvent
        // etre restaures sans re-verifier le mot de passe.
        $this->session->unset_userdata('restore_login_attempts');
        $this->session->unset_userdata('restore_login_attempts_at');
        $this->session->set_userdata('restore_old_account_id', $oldAccountId);
        $this->session->set_userdata('restore_verified_at', time());

        return NULL;
    }

    private function hasValidRestoreSession()
    {
        $verifiedAt = $this->session->userdata('restore_verified_at');

        if (!$verifiedAt)
        {
            return false;
        }

        if ((time() - (int) $verifiedAt) > self::RESTORE_SESSION_TTL)
        {
            $this->session->unset_userdata('restore_old_account_id');
            $this->session->unset_userdata('restore_verified_at');
            return false;
        }

        return true;
    }
}
