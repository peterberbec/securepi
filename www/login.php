<?php
if(isset($_POST['username']) && isset($_POST['password']))
{
	$data =	$_POST['username'] . "\n" . $_POST['password'] . "\n";
	$ret = file_put_contents('/etc/openvpn/login.conf', $data, LOCK_EX);
	header('Location: //secure.pi/start.html');
}
