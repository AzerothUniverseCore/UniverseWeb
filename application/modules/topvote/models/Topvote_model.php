<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topvote_model extends CI_Model {

    /**
     * Topvote_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getTopVoters()
    {
        $this->db->select('users.id, users.username,
                            COUNT(votes_logs.id) AS total_votes,
                            SUM(votes_logs.points) AS total_points,
                            MAX(votes_logs.lasttime) AS last_vote');
        $this->db->from('votes_logs');
        $this->db->join('users', 'users.id = votes_logs.idaccount');
        $this->db->group_by('votes_logs.idaccount');
        $this->db->order_by('total_points', 'DESC');
        $this->db->order_by('total_votes', 'DESC');

        return $this->db->get()->result();
    }

    public function getGlobalVoteCount()
    {
        return (int) $this->db->count_all('votes_logs');
    }

    public function getGlobalPointsSum()
    {
        $row = $this->db->select_sum('points')->get('votes_logs')->row();
        return $row && $row->points !== null ? (int) $row->points : 0;
    }
}
