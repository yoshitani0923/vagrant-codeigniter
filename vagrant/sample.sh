sudo cat /var/log/httpd/vagrant-codeigniter-access_log > sample.txt
awk -f login.awk sample.txt > login.txt
awk -f news.awk sample.txt > news.txt
awk -f tweet.awk sample.txt > tweet.txt
cat login.txt
cat news.txt
cat tweet.txt
