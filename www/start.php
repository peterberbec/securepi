<?php
	exec("/usr/bin/sudo /usr/sbin/service openvpn@uploaded restart");
	exec("/usr/bin/sudo /bin/systemctl openvpn@uploaded enable");
	header('Location: //secure.pi/done.html');
