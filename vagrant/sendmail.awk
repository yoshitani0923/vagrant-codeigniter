BEGIN {
    count_login = 0;
    count_create = 0;
    count_tweet = 0;
    }
$11 ~ /login\/login/ {++count_login}
$11 ~ /news\/create/ {++count_create}
$11 ~ /index.php\/tweet/ {++count_tweet}
END {print "ログインページアクセス数 ＝ " count_login "\n""新規登録ページアクセス数 ＝ " count_create "\n""ツイートページアクセス数 ＝ " count_tweet}
