<?php
class Tweet extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('tweet_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('array');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('cookie');
    }

    public function index()
    {
        $this->form_validation->set_rules('tweet', 'ツイート内容', 'required|max_length[140]');
        
        $user_id = $this->session->userdata('user_id');

        if($user_id === FALSE) {
            return redirect('login/login', 'refresh');
        }
        
        $username = $this->session->userdata('username');
        $unix_time = array();
        $result = $this->tweet_model->news($user_id);
        
        for ($i = 0 ; $i < count($result) ; $i++) {
            $tweet_time = strtotime($result[$i]['register_date']);
            $now_time = strtotime(date("Y-m-d H:i:s"));
            $relative_time = $now_time - $tweet_time;
            
            if ($relative_time < 60) {
                $before = $relative_time.'秒前';
            } elseif ($relative_time < (60*60)) {
                $before = round($relative_time/60).'分前';
            } elseif ($relative_time < 60*60*24) {
                $before = round($relative_time/(60*60)).'時間前';
            } else {
                $before = round($relative_time/(60*60*24)).'日前';
            }
            $unix_time[] = $before;
        }

        $data = array(
            "news" => $result,
            "username" => $username,
            "now_register_date" => date("Y-m-d H:i:s"),
            "unix_time" => $unix_time
            );
        
        $this->load->view('tweet', $data);
    }


    public function new_tweet()
    {
        $this->form_validation->set_rules('tweet_area', 'ツイート内容', 'required|max_length[139]');
        
        if ($this->form_validation->run() === FALSE) {
            redirect('http://vagrant-codeigniter.local/index.php/tweet', 'refresh');
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

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                "tweet" => $tweet['tweet'],
                "username" => $this->session->userdata('username'),
                "new_tweet_time" => $new_tweet_time
                )
            )
        );

    }

    public function more_tweet()
    {
        $page = $this->input->get('page');
        $user_id = $this->session->userdata('user_id');
        $result = $this->tweet_model->more($user_id, $page);

        for ($i = 0 ; $i < count($result) ; $i++) {
            $tweet_time = strtotime($result[$i]['register_date']);
            $now_time = strtotime(date("Y-m-d H:i:s"));
            $relative_time = $now_time - $tweet_time;

            if ($relative_time < 60) {
                $before = round($relative_time).'秒前';
            } elseif ($relative_time < (60*60)) {
                $before = round($relative_time/60).'分前';
            } elseif ($relative_time < (60*60*24)) {
                $before = round($relative_time/(60*60)).'時間前';
            } else {
                $before = round($relative_time/(60*60*24)).'日前';
            }
            $unix_time[] = $before;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                "news" => $result,
                "username" => $this->session->userdata('username'),
                "unix_time" => $unix_time
                )
            )
        );
    }
}