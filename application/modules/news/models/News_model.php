<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

    /**
     * News_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function insertComment($reply, $newsid, $idsession)
    {
        $date = $this->wowgeneral->getTimestamp();

        $data = array(
            'id_new' => $newsid,
            'commentary' => $reply,
            'date' => $date,
            'author' => $idsession
        );

        $this->db->insert('news_commentsfr', $data);
        return true;
    }

    public function removeComment($id)
    {
        $this->db->where('id', $id)->delete('news_commentsfr');
        return true;
    }

    public function getComments($idlink)
    {
        return $this->db->select('*')->where('id_new', $idlink)->get('news_commentsfr');
    }

    public function getNewTitle($id)
    {
        return $this->db->select('title')->where('id', $id)->get('newsfr')->row('title');
    }

    public function getNewImage($id)
    {
        return $this->db->select('image')->where('id', $id)->get('newsfr')->row('image');
    }

    public function getNewDescription($id)
    {
        return $this->db->select('description')->where('id', $id)->get('newsfr')->row('description');
    }

    public function getNewlogDate($id)
    {
        return $this->db->select('date')->where('id', $id)->get('newsfr')->row('date');
    }

    public function getCommentCount($id)
    {
        return $this->db->select('id')->where('id_new', $id)->get('news_commentsfr')->num_rows();
    }

    public function getNewSpecifyID($id)
    {
        return $this->db->select('*')->where('id', $id)->get('newsfr');
    }

    public function getNewsList()
    {
        return $this->db->select('*')->order_by('id', 'DESC')->limit('4')->get('newsfr');
    }

    public function getExtendedNewsList()
    {
        return $this->db->select('*')->order_by('id', 'DESC')->limit('8')->get('newsfr');
    }
}
