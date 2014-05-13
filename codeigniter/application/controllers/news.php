<?php
class News extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('news_model');
	}

	

    public function create(){
	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('username', '名前', 'required');
	    $this->form_validation->set_rules('email', 'メールアドレス', 'required');
	    $this->form_validation->set_rules('password', 'パスワード', 'required');
        //検証処理の実行
	    
	    if ($this->form_validation->run() === FALSE){
		    $this->load->view('news/create');
	    }
	    else{
		    $this->news_model->set_news();
		    $this->load->view('news/login');
	    }
    }

    public function aaaaa(){
	    $this->load->view('news/login');
    }

}


