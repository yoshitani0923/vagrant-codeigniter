#!/bin/sh

#送信先
address="yoshitani@realworld.jp"

#メール主題
#`date`は現在の日時を表示
subject="mail title here _`date`"

#メール送信
mail -s "$subject" $address << mailbody
PID:`ps auxw | httpd`
mailbody
#`ps auxw | httpd`コマンドの出力をメールの中身に追加

exit
