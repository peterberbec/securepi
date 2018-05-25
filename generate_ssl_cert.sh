cd /etc/lighttpd/
sudo mkdir certificates; cd certificates
sudo openssl req -new -x509 -keyout domainname.pem -out domainname.pem -days 365 -nodes \
	-subj "/C=US/ST=New York/L=New York/O=SecurePi/OU=Org/CN=secure.pi"
sudo chown www-data:www-data domainname.pem
sudo chmod 0600 domainname.pem
