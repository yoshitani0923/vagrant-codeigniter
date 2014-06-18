BEGIN {
    count_tweet = 0;
    }
$11 ~ /index.php\/tweet/ {print ++count_tweet " " $11}
END {print "ツイートページアクセス数 ＝ "count_tweet;}
