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
            "user_id" => $user_id,//id
            "tweet" => $this->input->post("tweet"),//内容
            "register_date" => date("Y-m-d H:i:s")//今の時間
            );
        //もしルール守っているなら新規ツイート情報をデータベースに登録
        if ($this->form_validation->run() != FALSE) {
            //新規ツイート情報の登録実行
            $this->tweet_model->sounyu($tweet);
        }
$ima = 'たったいま';
        //JSONをjsで受けるため
        print json_encode(array(
            "tweet" => $tweet['tweet'],
            "username" => $this->session->userdata('username'),
            "word1" => $ima
            )
        );
    }


    public function more_tweet()
    {
        $page = $_GET['page'];
        //var_dump($page);
        $user_id = $this->session->userdata('user_id');
        $result = $this->tweet_model->more($user_id, $page);

        for ($i=0 ; $i<=9 ; $i++) {
        $date2 = $result[$i]['register_date'];
        $tweet_time = strtotime($date2);//Unixタイムスタンプ形式に変換
        $now_time = date("Y-m-d H:i:s");//現在の時刻をUnixタイムスタンプで取得
        $now_time = strtotime($now_time);
        $relative_time = $now_time - $tweet_time;//つぶやかれたのが何秒前か
        if ($relative_time < 60) {
            $before = round($relative_time).'秒前';
        } elseif ($relative_time < 3600) {
            $before = round($relative_time/60).'分前';
        } elseif ($relative_time < 86400) {
            $before = round($relative_time/(60*60)).'時間前';
        } else {
            $before = round($relative_time/(60*60*24)).'日前';
        }
        //var_dump($i, $time[$i]);
        $unix_time[] = $before;
        }
        //var_dump($json);exit;
        print json_encode(array(
            "news" => $result,
            "username" => $this->session->userdata('username'),
            "unix_time" => $unix_time
            )
        );
    }

    /*public function time()
    {
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');

        $time = $this->tweet_model->news('user_id');
        $date = $time[0]['register_date'];
        $tweet_time=strtotime($date);//Unixタイムスタンプ形式に変換
        $now_time=date("Y-m-d H:i:s");//現在の時刻をUnixタイムスタンプで取得
        $now_time = strtotime($now_time);
        $relative_time = $now_time - $tweet_time;//つぶやかれたのが何秒前か

        var_dump($relative_time / (60*60*24));
        $y = array("time" => $relative_time, "jikan" => $date);//var_dump(date('n月j日',$tweet_time));
        $this->load->view('news/success', $y);
    }*/


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
        //最新10件のツイート(tweet, register/date)取得
        $result = $this->tweet_model->news($user_id);//'tweet, register_date'の取得
        
        for ($i=0 ; $i<=9 ; $i++) {
        $date2 = $result[$i]['register_date'];
        $tweet_time = strtotime($date2);//Unixタイムスタンプ形式に変換
        $now_time = date("Y-m-d H:i:s");//現在の時刻をUnixタイムスタンプで取得
        $now_time = strtotime($now_time);
        $relative_time = $now_time - $tweet_time;//つぶやかれたのが何秒前か
        
        if ($relative_time < 60) {
            $before = $relative_time.'秒前';
        } elseif ($relative_time < 3600) {
            $before = round($relative_time/60).'分前';
        } elseif ($relative_time < 86400) {
            $before = round($relative_time/(60*60)).'時間前';
        } else {
            $before = round($relative_time/(60*60*24)).'日前';
        }
        //var_dump($i, $time[$i]);
        $unix_time[] = $before;
        }

        $data = array(
            "news" => $result,//10件のツイート
            "username" => $username,//ユーザネーム
            "now_register_date" => date("Y-m-d H:i:s"),//今の時間
            "unix_time" => $unix_time
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