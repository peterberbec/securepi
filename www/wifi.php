<?php
if(isset($_POST['ssid']) && isset($_POST['password']))
{
	$data = "ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev\n" .
		"update_config=1\n" . 
		"country=US\n" .
		"\nnetwork={\n" .
		"	ssid=\"" . $_POST['ssid'] . "\"\n" .
		"	psk=\"" . $_POST['password'] . "\"\n" .
		"}\n";

	$filename = "/etc/wpa_supplicant/wpa_supplicant.conf";
	$ret = file_put_contents($filename, $data, LOCK_EX);
	exec("/usr/bin/sudo /sbin/dhclient -r wlan0");
	exec("/usr/bin/sudo /sbin/ifconfig wlan0 down");
	exec("/usr/bin/sudo /bin/systemctl daemon-reload");
	exec("/usr/bin/sudo /sbin/ifconfig wlan0 up");
	exec("/usr/bin/sudo /bin/systemctl restart dhcpcd");
	exec("/usr/bin/sudo /sbin/dhclient -v wlan0");
	header('Location: //secure.pi/upload.html');
}
