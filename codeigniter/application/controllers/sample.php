<?php
class Home extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index()
    {
        $data['sample'] = "yoshitani";
        $this->load->view("sample/sample1", $data);
    }
}