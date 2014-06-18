#!/bin/sh

#送信先
address="yoshitani@realworld.jp"

#メール主題
#`date`は現在の日時を表示
subject="`date`"

#アクセスログから上位３件取得
sudo cat /var/log/httpd/vagrant-codeigniter-access_log | awk -F ' ' '{print $7}' | sort | uniq -c > /vagrant/vagrant/count.txt
message=$(sudo cat /vagrant/vagrant/count.txt | awk -F ' ' '{ print $0 }' | sort -k 1 -n -r | head -n 3)

#メール送信
mail -s "$subject" $address << mailbody
$message
mailbody
#`ps auxw | httpd`コマンドの出力をメールの中身に追加

exit