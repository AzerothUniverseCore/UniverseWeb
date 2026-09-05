<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rpgparadize_api
 *
 * Client minimal pour l'API REST de RPG Paradize (verification de vote par
 * token OTP -- "Vérification par OTP (token unique)" dans le panel serveur).
 * Aucune dependance a curl : file_get_contents + stream_context_create,
 * exactement comme Vote_model::postDiscordWebhook(), pour rester compatible
 * avec les hebergements mutualises qui n'ont pas l'extension curl active.
 *
 * Toutes les methodes publiques retournent NULL en cas d'echec reseau/API
 * (token manquant, hote injoignable, timeout, JSON invalide) -- jamais
 * d'exception. L'appelant doit toujours pouvoir retomber sur un
 * comportement de secours (voir Vote_model::voteNow) plutot que de planter
 * la page si RPG Paradize est indisponible.
 *
 * Documentation : panel serveur RPG Paradize > Token API.
 *
 * @author  iThorgrim / adapte pour Azeroth Universe
 */
class Rpgparadize_api {

    /** @var CI_Controller */
    private $CI;

    /** @var string */
    private $baseUrl = 'https://rpg-paradize.com';

    public function __construct()
    {
        // blizzcms.php est deja autoloade (voir application/config/autoload.php),
        // pas besoin de le recharger ici.
        $this->CI =& get_instance();
    }

    private function getToken()
    {
        return trim((string) $this->CI->config->item('rpgparadize_api_token'));
    }

    private function getSiteId()
    {
        return trim((string) $this->CI->config->item('rpgparadize_site_id'));
    }

    /**
     * TRUE si un token ET un site id sont configures. A verifier avant
     * d'engager le flux OTP -- si FALSE, l'appelant doit retomber sur le
     * comportement de secours (lien de vote statique, credit immediat).
     */
    public function isConfigured()
    {
        return $this->getToken() !== '' && $this->getSiteId() !== '';
    }

    /**
     * Requete GET authentifiee (Bearer) vers l'API RPG Paradize.
     * @return array|null Le corps JSON decode (tableau associatif), ou NULL
     *                     en cas d'echec (deja journalise via log_message).
     */
    private function request($path)
    {
        $token = $this->getToken();
        if ($token === '') {
            log_message('error', 'RPG Paradize API : token non configure (rpgparadize_api_token).');
            return null;
        }

        $url = $this->baseUrl . $path;

        $context = stream_context_create(array(
            'http' => array(
                'method'        => 'GET',
                'header'        => "Authorization: Bearer {$token}\r\n" .
                                   "Accept: application/json\r\n",
                'timeout'       => 8,
                'ignore_errors' => true,
            ),
        ));

        $response = @file_get_contents($url, false, $context);

        if ($response === false) {
            log_message('error', 'RPG Paradize API : requete echouee (hote injoignable ou timeout) - ' . $path);
            return null;
        }

        $data = json_decode($response, true);

        if (!is_array($data)) {
            log_message('error', 'RPG Paradize API : reponse JSON invalide - ' . $path . ' - ' . substr($response, 0, 200));
            return null;
        }

        return $data;
    }

    /**
     * Genere un token OTP (valide 10 minutes cote RPG Paradize).
     *
     * @return array|null { token, expires_in, vote_url, message } en cas de
     *                     succes, NULL sinon (API indisponible, token/site
     *                     id manquant, ou reponse "success": false).
     */
    public function generateOtp()
    {
        $siteId = $this->getSiteId();
        if ($siteId === '') {
            log_message('error', 'RPG Paradize API : site id non configure (rpgparadize_site_id).');
            return null;
        }

        $data = $this->request('/api/v1/servers/' . rawurlencode($siteId) . '/otp');

        if (!$data || empty($data['success']) || empty($data['data']['token'])) {
            log_message('error', 'RPG Paradize API : generation OTP echouee - ' . json_encode($data));
            return null;
        }

        return $data['data'];
    }

    /**
     * Verifie si un token OTP a ete consomme par un vote reel.
     *
     * @param string $token Le token OTP renvoye par generateOtp().
     * @return bool|null TRUE  = vote confirme (a crediter, une seule fois).
     *                    FALSE = pas encore vote (ou token deja
     *                            verifie/expire cote RPG Paradize) -- pas
     *                            une erreur, juste "pas encore".
     *                    NULL  = l'API n'a pas pu etre jointe : a traiter
     *                            comme "reessayer au prochain passage du
     *                            cron", JAMAIS comme un vote invalide.
     */
    public function verifyOtp($token)
    {
        $siteId = $this->getSiteId();
        $token = trim((string) $token);
        if ($siteId === '' || $token === '') {
            return null;
        }

        $data = $this->request('/api/v1/servers/' . rawurlencode($siteId) . '/votes/otp/' . rawurlencode($token));

        if ($data === null) {
            return null;
        }

        return !empty($data['success']);
    }
}
