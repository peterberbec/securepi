#!/usr/bin/env bash  
# securepi  
# setup:  
if [ "$EUID" -ne 0 ]  
	then echo "Please run as root"  
	exit  
fi  
echo "enable I2C and SPI"  
read -n1 -r -p "Press any key to continue..." key  
raspi-config  
curl -sSL https://pisupp.ly/papiruscode | bash  
curl -sSL https://install.pi-hole.net | bash  
ln -fs /home/gamblodar/securepi/www /var/www/secure.pi  
ln -fs /home/gamblodar/securepi/papirus.service /lib/systemd/system/  
ln -fs /home/gamblodar/securepi/rc.local /etc/  
ln -fs /home/gamblodar/securepi/dhcpcd.conf /etc/  
ln -fs /home/gamblodar/securepi/dhcpd.conf /etc/dhcp/  
ln -fs /home/gamblodar/securepi/01-pihole.conf /etc/dnsmasq.d/  
ln -fs /home/gamblodar/securepi/10-ssl.conf /etc/lighttpd/conf-enabled/  
ln -fs /home/gamblodar/securepi/setupVars.conf /etc/pihole/  
ln -fs /home/gamblodar/securepi/lighttpd.conf /etc/lighttpd/  
ln -fs /home/gamblodar/securepi/ssh /home/gamblodar/.ssh  
ln -fs /etc/openvpn/client.log /home/gamblodar/securepi/www  
ln -s /etc/openvpn/client.log /var/log
ln -fs /home/gamblodar/sudoers /etc/  
ln -fs /var/www/html /home/gamblodar/securepi/www/pihole  
ln -fs /home/gamblodar/securepi/hosts /etc  
ln -fs /home/gamblodar/securepi/stubby.yml /etc/  
ln -fs /home/gamblodar/securepi/stubby.service /lib/systemd/system/  
ln -fs /home/gamblodar/securepi/02-stubby.conf /etc/dnsmasq.d/  
ln -fs /home/gamblodar/securepi/stubby.conf /usr/lib/tmpfiles.d/  
cp -f  /home/gamblodar/securepi/config.txt /boot/  
cp -f  /home/gamblodar/securepi/cmdline.txt /boot/  
cp -f  /home/gamblodar/securepi/pre-commit /home/gamblodar/securepi/.git/hooks/  
cp -f  /home/gamblodar/securepi/post-checkout /home/gamblodar/securepi/.git/hooks/  
/home/gamblodar/securepi/generate_ssl_cert.sh  
cd /home/gamblodar/securepi/getdns/build  
echo 'https://www.reddit.com/r/pihole/comments/7oyh9m/guide_how_to_use_pihole_with_stubby/'  
make install  
chown gamblodar -R /home/gamblodar/.ssh  
chown www-data:www-data -R /var/www
chmod 600 -R /home/gamblodar/.ssh  
chmod 664 /etc/openvpn/client.log  
systemctl enable papirus.service  
systemctl daemon-reload  
service papirus start  
service dhcpd restart  
service dhcpcd restart  
service lighttpd restart  
service dnsmasq restart  
service pihole-FTL restart  
bash /etc/rc.local  
