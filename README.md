#!/usr/bin/env bash
# securepi 
# setup:  
if [ "$EUID" -ne 0 ]
	then echo "Please run as root"
	exit
fi
echo "enable I2C and SPI"
raspi-config
curl -sSL https://pisupp.ly/papiruscode | bash
curl -sSL https://install.pi-hole.net | bash
ln -s /home/gamblodar/securepi/www /var/www/secure.pi  
ln -s /home/gamblodar/securepi/papirus.service /lib/systemd/system/  
ln -s /home/gamblodar/securepi/rc.local /etc/  
ln -s /home/gamblodar/securepi/dhcpcd.conf /etc/  
ln -s /home/gamblodar/securepi/dhcpd.conf /etc/dhcp/  
ln -s /home/gamblodar/securepi/01-pihole.conf /etc/dnsmasq.d/  
ln -s /home/gamblodar/securepi/setupVars.conf /etc/pihole/  
ln -s /home/gamblodar/securepi/lighttpd.conf /etc/lighttpd/  
ln -s /home/gamblodar/securepi/ssh /home/gamblodar/.ssh  
cp    /home/gamblodar/securepi/config.txt /boot/
cp    /home/gamblodar/securepi/cmdline.txt /boot/
