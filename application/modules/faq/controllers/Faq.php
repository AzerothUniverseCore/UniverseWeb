<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('faq_model');
		
        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->wowgeneral->getMaintenance())
            redirect(site_url($this->lang->lang().'/maintenance'),'refresh');



    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('nav_faq'),
			);

			$this->template->build('index', $data);
    }
}