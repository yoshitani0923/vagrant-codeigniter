BEGIN { 
    count_login = 0;
    } 
$11 ~ /login\/login/ { ++count_login }
END {print "ログインページアクセス数 ＝ "count_login}
