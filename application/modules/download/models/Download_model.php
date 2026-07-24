<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_model extends CI_Model {

    /**
     * Download_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Table de contenu selon la langue active : 'download' (EN) par
     * defaut, 'downloadfr' pour le francais.
     */
    private function downloadTable()
    {
        return ($this->lang->lang() == 'fr') ? 'downloadfr' : 'download';
    }

	public function getGame()
    {
        return $this->db->select('*')->where('category', '1')->order_by('id', 'ASC')->get($this->downloadTable());
    }
	
	public function getAddons()
    {
        return $this->db->select('*')->where('category', '2')->order_by('id', 'ASC')->get($this->downloadTable());
    }
	
}