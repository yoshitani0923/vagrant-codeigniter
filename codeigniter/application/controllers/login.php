<?php
class login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('news_model');
    }



    public function index(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        /*$data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
        );*/
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');

        //if (!$this->input->post()){
        if ($this->form_validation->run() === FALSE){
            $this->load->view('news/login');
        } else {
            $ok = $this->news_model->login(
                $this->input->post('email'),
                $this->input->post('password')
                );
            if ($ok == true) {
                $this->load->view('tweet');
            } else {
                $this->load->view('news/login');
            }
        }
        //var_dump($data);

        //$this->news_model->hikaku($data);


        //$this->load->view('tweet', $data);
/*
        $this->news_model->login($data);

        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        //検証処理の実行
        if ($this->form_validation->run() === FALSE){
            $this->load->view('news/login');
        }
        else{
            $this->news_model->set_news();
            $this->load->view('tweet');
        }

        $this->post->login();
    */}
}