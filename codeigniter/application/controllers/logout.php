<?php
class logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('user_id');
        redirect('login/login');
    }
}