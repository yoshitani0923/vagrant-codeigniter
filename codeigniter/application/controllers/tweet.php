<?php
class tweet extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('tweet_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('javascript');
        $this->load->helper('array');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('cookie');
    }



    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');

        $this->form_validation->set_rules('tweet', 'ツイート内容', 'required');
        
        //ログインしていないならログイン画面へ
        if($user_id === false) {
            return redirect('login/login', 'refresh');
        }
//var_dump($user_id);
//var_dump($username);
        
        //最新10件のツイート取得
        $result = $this->tweet_model->news($user_id);
//var_dump($result);
//var_dump(/*"<pre>",*/$result);

        $data = array(
            "news" => $result,
            "username" => $username,
            "now_tweet" => $this->input->post('tweet'),
            "now_user_id" => $user_id,
            "now_register_date" => date("Y-m-d H:i:s"),
            'maxlength'   => '100'
            );

        //ツイート画面に表示
        $this->load->view('tweet', $data);
//var_dump($data);exit;
        
        if ($this->form_validation->run() != FALSE) {

        $tweet = array(
            'tweet' => $this->input->post('tweet'),
            'user_id' => $user_id,
            'register_date' => date("Y-m-d H:i:s")
            );

        //ツイート内容保存
        $this->tweet_model->sounyu($tweet);
        }

    }
}