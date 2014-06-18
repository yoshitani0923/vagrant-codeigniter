BEGIN {
    count_tweet = 0;
    }
$11 ~ /index.php\/tweet/ { ++count_tweet }
END {print "ツイートページアクセス数 ＝ "count_tweet;}
