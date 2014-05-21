<?php
class News_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
	}

    //データベースからデータゲット
	public function get_news($a = FALSE){
	    if ($a === FALSE){	
	        $query = $this->db->get('USER');
	        return $query->result_array();
	    }
	    $query = $this->db->get_where('USER'/*, array('slug' => $slug)*/);
	    return $query->row_array();
	}

    //データベースに書き込み
	public function set_news(){
	    
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
	    $data = array(
		    'username' => $this->input->post('username'),
		    'email' => $this->input->post('email'),
		    'password' => $this->input->post('password')
	    );
	    return $this->db->insert('USER', $data);
	}

    //ログイン機能
    public function login($email, $password){
	   // return $query->row_array();
        $this->db->select("email, password");
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('USER');
        
        //var_dump($query->num_rows(), $query->result_array());exit;

        if($query->num_rows() > 0){
        	return true;
        } else {
        	return false;
        }
    }
}