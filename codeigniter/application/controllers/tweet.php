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
        $now_time = strtotime(date("Y-m-d H:i:s"));
        $result = $this->tweet_model->news($user_id);
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
            redirect('http://vagrant-codeigniter.local/index.php/tweet', 'refresh');
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
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        $get = $this->tweet_model->more($user_id, $page);
        $result = $get->result_array();

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
                "username" => $this->session->userdata('username'),
                "num" => $get->num_rows(),
                "all_num" => $all_num
            )));
    }
}