#!/bin/bash
echo "$(date +"%a %b %d %H:%M:%S %Y") setting up ip masquerading"
route del -net default gw 192.168.7.1 netmask 0.0.0.0 dev usb0 > /dev/null 2> /dev/null
iptables -F
iptables -X
iptables -t nat -F
iptables -t nat -X
iptables -t mangle -F
iptables -t mangle -X
iptables -P INPUT ACCEPT
iptables -P FORWARD ACCEPT
iptables -P OUTPUT ACCEPT
iptables -t nat -A POSTROUTING -o tun0 -j MASQUERADE
iptables -A FORWARD -i tun0 -o usb0 -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A FORWARD -i usb0 -o tun0 -j ACCEPT
#echo "$(date +"%a %b %d %H:%M:%S %Y") restarting dnsmasq"
#service dnsmasq restart
#sleep 2
#echo "$(date +"%a %b %d %H:%M:%S %Y") restarting pihole-FTL"
#service pihole-FTL restart
#sleep 2 
echo "$(date +"%a %b %d %H:%M:%S %Y") startup script done"
