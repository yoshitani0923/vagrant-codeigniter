<?php
class user_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function make_new_account($data)
	{
		$this->db->set('username', $data['username']);
		$this->db->set('email', $data['email']);
		$this->db->set('password', $data['password']);
		$this->db->set('register_date', $data['register_date']);
	    $this->db->insert('user');
	    return;
	}


    public function login($email, $password)
    {
        $this->db->select("username, password");
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }


    public function mail_check($email)
    {
        //$this->db->select("email");
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function get_cookie($email)
    {
        $this->db->select("username, user_id");
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        return $query->row();
    }
}

