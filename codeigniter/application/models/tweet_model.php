<?php
class tweet_model extends CI_Model
{

	public function __construct()
    {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->library('session');//使ってないやつ書かない！！
	}

    public function get_tweet_id($user_id)
    {
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $this->db->limit(10);
        $min = $this->db->get('tweet');
        return $min->row();
    }

    public function more($user_id, $page)
    {
        $this->db->select('tweet, register_date');
        $this->db->where('user_id', $user_id);
        //$this->db->where('id <', $page);
        $this->db->order_by("id", "desc"); 
        $this->db->limit(10, $page);
        $more = $this->db->get('tweet');
        return $more->result_array();
    }

	public function news($user_id)
    {
    	$this->db->select('tweet, register_date');
        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "desc"); 
        $this->db->limit(10);
        $query = $this->db->get('tweet');
        return $query->result_array();
	}

	public function sounyu($tweet)
    {
		return $this->db->insert('tweet', $tweet);
	}
}