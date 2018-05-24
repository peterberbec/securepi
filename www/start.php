<?php
	exec("/usr/bin/sudo /usr/sbin/service openvpn@uploaded restart");
	header('Location: //secure.pi/done.html');
