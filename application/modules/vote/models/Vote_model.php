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
        $mytime = $this->wowgeneral->getTimestamp();
        $ppoints = $this->getVotePoints($id);
        $votetime = $this->getVoteTime($id);

        $qqcheck = $this->getVoteLog($id, $userid);

        $url = $this->getVoteUrl($id);

        $fecha = new DateTime();
        $expired = $fecha->add(new DateInterval('PT'.$votetime.'H'));

        $expired_at = $expired->getTimestamp();

        if(!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        $comprobetime = $qqcheck->row('expired_at');

        if($this->wowgeneral->getTimestamp() >= $comprobetime)
        {
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
            // ou le vote est reellement accepte (cooldown expire) - jamais
            // dans la branche "deja vote" plus bas, qui ne represente pas
            // un vote reel. Best-effort : si Discord est injoignable ou mal
            // configure, on log l'erreur mais on ne bloque JAMAIS le
            // joueur, qui doit dans tous les cas etre redirige vers le site
            // de vote externe juste apres (voir sendDiscordVoteAlert()).
            $this->sendDiscordVoteAlert($id, $ppoints);

            echo '<script type="text/javascript">
                    window.open( "'.$url.'","_self")
                </script>';

            redirect(site_url($this->lang->lang().'/vote'),'refresh');
        } else {
            echo '<script type="text/javascript">alert("According to our records you have already voted in this top. Contact with Support Ingame for Resolving this problem")</script>';
            redirect(site_url($this->lang->lang().'/vote'),'refresh');
        }
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
    private function sendDiscordVoteAlert($id, $points)
    {
        $webhookUrl = $this->config->item('discord_vote_webhook_url');
        if (empty($webhookUrl)) {
            return;
        }

        // Pseudo du compte de jeu, deja present en session depuis la
        // connexion (voir Auth_model::arraySession()) : pas besoin d'une
        // nouvelle requete SQL ici.
        $username = $this->session->userdata('wow_sess_username');
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
