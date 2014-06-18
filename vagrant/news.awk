BEGIN {
    count_news = 0;
    }
$11 ~ /news/ { ++count_news }
END {print "新規登録ページアクセス数 ＝ "count_news}
