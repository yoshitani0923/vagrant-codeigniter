<?php
class News extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
	}

    public function create()
    {
        $this->form_validation->set_rules('username', '名前', 'required');
	    $this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email|callback_email_check');
	    $this->form_validation->set_rules('password', 'パスワード', 'required|alpha_dash');        

        if ($this->session->userdata('username') !== FALSE) {
            redirect('http://vagrant-codeigniter.local/index.php/tweet', 'refresh');
        }

	    if ($this->form_validation->run() === FALSE) {
		    return $this->load->view('news/create');
	    }

        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $result = $this->user_model->mail_check($email);

        if($result !== 0) {
            return $this->load->view("news/create");
        }
        
        $typed_password = $this->input->post('password');
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $this->encrypt->encode($typed_password),
            'register_date' => date("Y-m-d H:i:s")
        );
	    $cookie = $this->user_model->get_cookie($email);

	    $this->user_model->make_new_account($data);
        $this->session->set_userdata($cookie);
	    redirect('http://vagrant-codeigniter.local/index.php/tweet', 'refresh');
    }

    /*新規登録時に入力したemailの重複チェックのメソッド*/
    public function email_check($email)
	{
		$exists = $this->user_model->mail_check($email);
		if ($exists) {
			$this->form_validation->set_message('email_check', '入力されたメールアドレスは既に使われております。');
			return FALSE;
		} else {
			return TRUE;
		}	
	}
}


