<?php
class tweet extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('tweet_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }



    public function index(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $somthing = $this->tweet_model->tweet(
            $this->input->post('tweet')
            );
        $this->load->view('news/login', $something);
    }

}