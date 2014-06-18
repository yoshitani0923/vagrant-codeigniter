awk -f access.awk /var/log/httpd/vagrant-codeigniter-access_log > access_count.txt
cat access_count.txt
