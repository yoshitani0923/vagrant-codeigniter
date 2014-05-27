<?php
class Login extends CI_Controller
{
    function __construct()
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
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email');

        if ($this->session->userdata('username') !== FALSE) {
            redirect('http://vagrant-codeigniter.local/index.php/tweet', 'refresh');
        }

        if ($this->form_validation->run() === FALSE) {
            return $this->load->view('news/login');
        }

        $typed_password = $this->input->post('password');
        $email = $this->input->post('email');
        $encode_password = $this->encrypt->encode($typed_password);
        $check = $this->user_model->login($email, $encode_password);
        $cookie = $this->user_model->get_cookie($email);

        if($check === true) {
            $this->session->set_userdata($cookie);
            redirect('http://vagrant-codeigniter.local/index.php/tweet', 'refresh');
        }

        $this->load->view('news/login');
    }
}