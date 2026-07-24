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

    /**
     * Tables de contenu selon la langue active : 'news'/'news_comments'
     * (EN) par defaut, 'newsfr'/'news_commentsfr' pour le francais.
     */
    private function newsTable()
    {
        return ($this->lang->lang() == 'fr') ? 'newsfr' : 'news';
    }

    private function newsCommentsTable()
    {
        return ($this->lang->lang() == 'fr') ? 'news_commentsfr' : 'news_comments';
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

        $this->db->insert($this->newsCommentsTable(), $data);
        return true;
    }

    public function removeComment($id)
    {
        $this->db->where('id', $id)->delete($this->newsCommentsTable());
        return true;
    }

    public function getComments($idlink)
    {
        return $this->db->select('*')->where('id_new', $idlink)->get($this->newsCommentsTable());
    }

    public function getNewTitle($id)
    {
        return $this->db->select('title')->where('id', $id)->get($this->newsTable())->row('title');
    }

    public function getNewImage($id)
    {
        return $this->db->select('image')->where('id', $id)->get($this->newsTable())->row('image');
    }

    public function getNewDescription($id)
    {
        return $this->db->select('description')->where('id', $id)->get($this->newsTable())->row('description');
    }

    public function getNewlogDate($id)
    {
        return $this->db->select('date')->where('id', $id)->get($this->newsTable())->row('date');
    }

    public function getCommentCount($id)
    {
        return $this->db->select('id')->where('id_new', $id)->get($this->newsCommentsTable())->num_rows();
    }

    public function getNewSpecifyID($id)
    {
        return $this->db->select('*')->where('id', $id)->get($this->newsTable());
    }

    public function getNewsList()
    {
        return $this->db->select('*')->order_by('id', 'DESC')->limit('4')->get($this->newsTable());
    }

    public function getExtendedNewsList()
    {
        return $this->db->select('*')->order_by('id', 'DESC')->limit('8')->get($this->newsTable());
    }
}
