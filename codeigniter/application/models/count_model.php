<?php
class count_model extends CI_Model
{

	public function __construct()
    {
		parent::__construct();
		$this->load->database();
		
	}


    public function count($url, $page_colum)
    {
        $pattern = "<a href=\"http:\/\/u-note.me\/note\/(.*)\">(.*)<\/a>";

        for ($i = 1; $i <= $page_colum; $i++) {
            $html = file($url."?page=".$i);
            $str = implode("", $html);

            $result = array();
            $offset = 0;
            while (preg_match("/".$pattern."/i", $str, $match, PREG_OFFSET_CAPTURE, $offset)) {
                $match_solo = $match[0];
                $result[] = $match_solo[0];
                $offset = $match_solo[1] + strlen($match_solo[0]);
            }

            foreach ($result as $title) {
                echo $title."<br />";
            }
        }
    }
}