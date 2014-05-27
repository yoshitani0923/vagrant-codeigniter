<?php
class login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }

    public function index()
    {   
        /*$username = $this->session->userdata('username');
        $user_id = $this->session->userdata('user_id');
        var_dump($username);
        var_dump($user_id);*/

        //入力必須
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            return $this->load->view('news/login');
        }
        
        $pass = $this->input->post('password');
        $ok = $this->user_model->login(
            $this->input->post('email')
            );
        $password = $this->encrypt->decode($ok->password);
        //var_dump($pass);
        //var_dump($password);
        if($pass === $password) {
            //フォームからのデータ受け取り
            $email = $this->input->post('email');
            $cookie = $this->user_model->get_cookie($email);
            $this->session->set_userdata($cookie);
            
            //リダイレクトでツイート画面へ遷移
            redirect('http://vagrant-codeigniter.local/index.php/tweet', 'refresh');
        }

        $this->load->view('news/login');
    }
}