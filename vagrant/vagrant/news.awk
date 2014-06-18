BEGIN {
    count_news = 0;
    }
$11 ~ /news/ {print ++count_news " " $11}
END {print "新規登録ページアクセス数 ＝ "count_news}
