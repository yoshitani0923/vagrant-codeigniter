<?php
class New_id extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
    {
	$data['news'] = $this->user_model->get_news();
	$data['title'] = 'News archive';

	$this->load->view('templates/header', $data);
	$this->load->view('login/index', $data);
	$this->load->view('templates/footer');
    }


    public function create()
    {
	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $data['title'] = 'Create a news item';

	    $this->form_validation->set_rules('title', 'Title', 'required');
	    $this->form_validation->set_rules('text', 'text', 'required');

	    if ($this->form_validation->run() === FALSE)
	    {
		    $this->load->view('templates/header', $data);
		    $this->load->view('login/create_user');
		    $this->load->view('templates/footer');
	    } else {
		    $this->user_model->set_news();
		    $this->load->view('login/success');
	    }
    }

}

