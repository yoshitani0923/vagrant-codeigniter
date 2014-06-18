BEGIN { 
    count_login = 0;
    } 
$11 ~ /login\/login/ {print ++count_login " " $11}
END {print "ログインページアクセス数 ＝ "count_login}
