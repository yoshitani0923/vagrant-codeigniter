<?php
class user_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    //データベースに書き込み
	public function set_news($data)
	{
		$this->db->set('username', $data['username']);
		$this->db->set('email', $data['email']);
		$this->db->set('password', $data['password']);
		$this->db->set('register_date', $data['register_date']);
	    $this->db->insert('user');
	    return;
	}

    //ログイン機能
    public function login($email)
    {
	   // return $query->row_array();
        $this->db->select("username, password, user_id");
        $this->db->where('email', $email);
        //$this->db->where('password', $password);
        $query = $this->db->get('user');
        return $query->row();
        //var_dump($query->num_rows(), $query->result_array());exit;
    }

    public function num_row($email)
    {
        //$this->db->select("email");
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        return $query->num_rows();
        //var_dump($query);
    }

    public function get_cookie($email)
    {
        $this->db->select("username, user_id");
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        return $query->row();
    }
}

