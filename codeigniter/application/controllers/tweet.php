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

    public function new_tweet()
    {
        //ルール決め
        $this->form_validation->set_rules('tweet', 'ツイート内容', 'required|max_length[140]');
        //ユーザID、ユーザネームの取得
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        //新規ツイート情報
        $tweet = array(
            "user_id" => $user_id,//ユーザネーム
            "tweet" => $this->input->post("tweet"),//内容
            "register_date" => date("Y-m-d H:i:s")//今の時間
            );
        //もしルール守っているなら新規ツイート情報をデータベースに登録
        if ($this->form_validation->run() != FALSE) {
            //新規ツイート情報の登録実行
            $this->tweet_model->sounyu($tweet);
        }
        //JSONをjsで受けるため
        print json_encode(array(
            "news" => $tweet,
            "username" => $this->session->userdata('username')
            )
        );
    }


    public function more_tweet()
    {
        $page = $_GET['page'];
        //var_dump($page);
        $user_id = $this->session->userdata('user_id');
        $result = $this->tweet_model->more($user_id, $page);
        //var_dump($json);exit;
        print json_encode(array(
            "news" => $result,
            "username" => $this->session->userdata('username')));
        
    }


    public function index()
    {
        //ユーザID、ユーザネーム取得
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        //フォームのルール設定
        $this->form_validation->set_rules('tweet', 'ツイート内容', 'required|max_length[140]');
        
        //ログインしていないならログイン画面へ
        if($user_id === false) {
            return redirect('login/login', 'refresh');
        }
        
        //最新10件のツイート取得
        $result = $this->tweet_model->news($user_id);//'tweet, register_date'の取得
        
        $data = array(
            "news" => $result,//10件のツイート
            "username" => $username,//ユーザネーム
            "now_tweet" => $this->input->post('tweet'),//書き込んだツイート内容
            "now_user_id" => $user_id,//ユーザID
            "now_register_date" => date("Y-m-d H:i:s"),//今の時間
            'maxlength' => '100'//100文字まで
            );

        //ツイート画面に表示
        $this->load->view('tweet', $data);
        
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