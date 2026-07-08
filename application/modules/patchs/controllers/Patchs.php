<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Module Patchs — Azeroth Universe
 *
 * Page de téléchargement manuel des patchs client (fichiers MPQ),
 * construite sur le même modèle que le module Download natif de BlizzCMS.
 */

class Patchs extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        // Coupe la page si le site est en maintenance, comme les autres modules
        if(!$this->wowgeneral->getMaintenance())
            redirect(base_url('maintenance'),'refresh');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => 'Téléchargement des patchs',
        );

        $this->template->build('index', $data);
    }
}
