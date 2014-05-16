<?php
class News extends CI_Controller
{

	public function __construct()
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
    	//検証処理の実行
        $this->form_validation->set_rules('username', '名前', 'required');
	    $this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email|callback_email_check');
	    $this->form_validation->set_rules('password', 'パスワード', 'required|alpha_dash');

	    //ダメならもう一度 news/create 表示
	    if ($this->form_validation->run() === false) {
		    return $this->load->view('news/create');
	    } 
	    	//フォームからのデータ受け取り
            $email = $this->input->post('email');
            $cookie = $this->user_model->get_cookie(
            	$this->input->post('email')
            	);
            
            $this->session->set_userdata($cookie);
            
            $pass = $this->input->post('password');
            //
	    	$data = array(
		        'username' => $this->input->post('username'),
		        'email' => $this->input->post('email'),
		        'password' => $this->encrypt->encode($pass),
		        'register_date' => date("Y-m-d H:i:s")
	            );

            $result = $this->user_model->num_rows(
            	$this->input->post('email')
            	);

            if($result != 0) {//!--データベースから取得したデータが空ならnull返ってくる--!//
                return $this->load->view("news/create");
            }
	        //データベースへの書き込みメソッドuser_newsへ$dataを送る
		    $this->user_model->set_news($data);

		    $cookie = $this->user_model->get_cookie($email);

            $this->session->set_userdata($cookie);

		    //リダイレクトでツイート画面へ遷移
		    redirect('http://vagrant-codeigniter.local/index.php/tweet', 'refresh');
		    //$this->load->view('news/login');//リダイレクト使って書きましょう！！！！
    }

    function email_check($str)
	{
		$email = $this->input->post('email');
		$email_check = $this->user_model->mail_check($email);

		if ($email_check->email == $str) {
			$this->form_validation->set_message('email_check', '入力されたメールアドレスは既に使われております。');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}


