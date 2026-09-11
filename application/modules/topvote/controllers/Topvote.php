<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topvote extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('topvote_model');

        if (!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if (!$this->wowgeneral->getMaintenance())
            redirect(site_url($this->lang->lang().'/maintenance'),'refresh');

        if (!$this->wowmodule->getVoteStatus())
            redirect(site_url($this->lang->lang()),'refresh');
    }

    public function index()
    {
        $data = array(
            'pagetitle'    => $this->lang->line('tab_topvote'),
            'topVoters'    => $this->topvote_model->getTopVoters(),
            'globalVotes'  => $this->topvote_model->getGlobalVoteCount(),
            'globalPoints' => $this->topvote_model->getGlobalPointsSum(),
        );

        $this->template->build('index', $data);
    }
}
