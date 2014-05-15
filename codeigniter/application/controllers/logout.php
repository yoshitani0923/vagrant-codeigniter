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
        //セッション削除
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('user_id');
//$username = $this->session->userdata('username');
//$user_id = $this->session->userdata('user_id');
//var_dump($username);
//var_dump($user_id);exit;
        //ログイン画面に戻る
        redirect('login/login');
    }
}