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


    public function more($user_id, $page)
    {
        $this->db->select('tweet, register_date');
        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "desc"); 
        $this->db->limit(10, $page);
        $more = $this->db->get('tweet');
        return $more->result_array();
    }


	public function save_new_tweet($tweet)
    {
		return $this->db->insert('tweet', $tweet);
	}
}