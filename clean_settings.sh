sudo rm -vf /etc/wpa_supplicant/wpa_supplicant.conf
sudo rm -vf /etc/openvpn/login.conf
sudo rm -vf /etc/openvpn/uploaded.conf
cat <<EOF | sudo tee /var/lib/dhcp/dhcpd.leases > /dev/null
# The format of this file is documented in the dhcpd.leases(5) manual page.
# This lease file was written by isc-dhcp-4.3.5

# authoring-byte-order entry is generated, DO NOT DELETE
authoring-byte-order little-endian;

server-duid "\000\001\000\001\"\230/\234\322\300\312\217\3766";
EOF
echo "removed '/var/lib/dhcp/dhcpd.leases'"
