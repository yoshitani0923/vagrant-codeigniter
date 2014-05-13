<?php
class tweet_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
	}


	public function tweet($containt){
		$data = array('containt' => $containt, 'username' => 'aaa');
var_dump($data);
        $this->db->insert('TWEET', $data);

        $username = 'aaa';

        $this->db->select("containt, username");
        $this->db->where('containt', $containt);
        $this->db->where('username', $username);
        $query = $this->db->get('TWEET');
        return $query -> result_array();
var_dump($query->result_array());

    }

}