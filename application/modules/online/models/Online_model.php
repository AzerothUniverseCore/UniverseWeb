<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->dbm_chars = $this->load->database('characters', true);
    }

    public function getOnlinePlayers()
	{
    $this->dbm_auth = $this->load->database('auth', true);

    $this->dbm_chars->select('c.name, c.race, c.class, c.level, c.zone, IFNULL(aa.SecurityLevel, 0) AS rank')
        ->from('characters c')
        ->join('auc_auth.account_access aa', 'c.account = aa.AccountID', 'left')
        ->where('c.online', '1')
        ->order_by('c.name', 'DESC');

    return $this->dbm_chars->get()->result();
	}
}
