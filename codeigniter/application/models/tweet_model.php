<?php
class tweet_model extends CI_Model
{

	public function __construct()
    {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('array');
	}


    public function news($user_id)
    {
        $this->db->select('tweet, register_date');
        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "desc"); 
        $this->db->limit(10);
        $query = $this->db->get('tweet');
        return $query->result_array();
    }

    public function time_calc($tweets, $now_time)
    {
        foreach($tweets as &$unix_tweet) {
            $unix_time = strtotime($unix_tweet['register_date']);
            $gap = $now_time - $unix_time;

            if ($gap < 60) {
                $before = round($gap).'秒前';
            } elseif ($gap < (60*60)) {
                $before = round($gap/60).'分前';
            } elseif ($gap < (60*60*24)) {
                $before = round($gap/(60*60)).'時間前';
            } else {
                $before = round($gap/(60*60*24)).'日前';
            }
            
            $unix_tweet["unix_time"] = $before;
        }

        return $tweets;
    }


    public function more($user_id, $page)
    {
        $this->db->select('tweet, register_date');
        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "desc"); 
        $this->db->limit(10, $page);
        return $this->db->get('tweet');
    }


	public function save_new_tweet($tweet)
    {
		return $this->db->insert('tweet', $tweet);
	}

    public function count_all_num($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->from('tweet');
        $num = $this->db->count_all_results();
        return $num;
    }
}