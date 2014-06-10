<?php
class Tweet extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('tweet_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('mymemcached'); 
        $this->load->helper('array');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('cookie');
        $this->load->driver('cache', array('adapter' => 'memcached'));
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        $key = $this->cache->memcached->get($user_id);
        if ($key === false) {
            $key = 0;
        }
        $this->cache->save($user_id, $key);
        //memcachedにデータがあれば / なければ
        if($this->mymemcached->loadCache($user_id, $key) !== FALSE) {
            $result = $this->mymemcached->loadCache($user_id, $key);
        } else {
            $result = $this->tweet_model->news($user_id);
            $keyName = $this->mymemcached->creatCacheKey($user_id, $key);
            $this->cache->save($keyName, $result);
        }

        $this->form_validation->set_rules('tweet', 'ツイート内容', 'required|max_length[140]');
        
        if($user_id === FALSE) {
            return redirect('login/login', 'refresh');
        }
        
        $username = $this->session->userdata('username');
        $now_time = strtotime(date("Y-m-d H:i:s"));
        $tweet = $this->tweet_model->time_calc($result, $now_time);

        if($this->tweet_model->count_all_num($user_id) === count($result)) {
            $button = 0;
        } else {
            $button = 1;
        }

        $data = array(
            "button" => $button,
            "news" => $tweet,
            "username" => $username,
            "now_register_date" => date("Y-m-d H:i:s")
            );

        $this->load->view('tweet', $data);
    }


    public function new_tweet()
    {
        $this->form_validation->set_rules('form_tweet_area', 'ツイート内容', 'required|max_length[139]');
        
        if ($this->input->post('tweet_area') === '') {
            redirect('tweet', 'refresh');
            //$this->load->view('tweet');
        }

        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        $new_tweet_time = 'たったいま';
        $tweet = array(
            "user_id" => $user_id,
            "tweet" => $this->input->post("tweet_area"),
            "register_date" => date("Y-m-d H:i:s")
            );

        $this->tweet_model->save_new_tweet($tweet);

        $this->mymemcached->deleteCache($user_id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                "tweet" => $tweet['tweet'],
                "username" => $username,
                "new_tweet_time" => $new_tweet_time
                )
            )
        );

    }

    public function more_tweet()
    {
        $page = $this->input->get('page');
        if ($page === false) {
            $page = 0;
        }
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');

        //キャッシュから取得してくる
        $result = $this->mymemcached->loadCache($user_id, $page);
        //もしデータがなければ…
        if ($result === FALSE) {
            //DBからツイート情報取得
            $get = $this->tweet_model->more($user_id, $page);
            $result = $get->result_array();
            //キャッシュ保存
            $this->mymemcached->saveCache($user_id, $page, $result);
        };
        $data = $this->tweet_model->more($user_id, $page);
        $num = $data->num_rows();

        if($this->tweet_model->count_all_num($user_id) == 0){
            exit;
        }

        $now_time = strtotime(date("Y-m-d H:i:s"));
        $tweet = $this->tweet_model->time_calc($result, $now_time);

        $all_num = $this->tweet_model->count_all_num($user_id);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                "news" => $tweet,
                "username" => $username,
                "num" => $num,
                "all_num" => $all_num
            )));
    }
}