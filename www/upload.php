<?php
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
$config_file = "/etc/openvpn/uploaded.conf";
$keywords = array(	"udp"		=> "proto udp",
			"tcp"		=> "proto tcp",
			"remote"	=> "remote ",
			"start_ca"	=> "<ca>",
			"end_ca"	=> "</ca>");
$keywords_skip = array( 1 => "client",
		 	2 => "dev",
		 	3 => "verb",
		 	4 => "nobind",
		 	5 => "persist-key",
		 	6 => "persist-tun",
		 	7 => "resolv-retry",
		 	8 => "mute-replay-warnings",
		 	9 => "daemon",
		 	10 => "script-security",
		 	11 => "auth-user-pass",
		 	12 => "auth-nocache",
		 	13 => "log",
		 	14 => "up",
		 	15 => "down");
$temp_file = tempnam("", "");

if (!empty($_FILES["myFile"]))
{
	$myFile = $_FILES["myFile"];

	if ($myFile["error"] !== UPLOAD_ERR_OK)
	{
		print "An error occurred uploading the file.";
		print "<a href=//secure.pi/upload.html>Back</a>";
		exit;
	}
	$tmp = $_FILES["myFile"][tmp_name];
	$temp_uploaded_file = tempnam("", "");

	if(move_uploaded_file($tmp, $temp_uploaded_file) === false)
	{
		print "An error occurred moving the uploaded file.";
		print "<a href=//secure.pi/upload.html>Back</a>";
		exit;
	}	

	$input_file = fopen($temp_uploaded_file, "r");
	if($input_file === false)
	{
		print "Error opening input file\n";
		print "<a href=//secure.pi/upload.html>Back</a>";
		exit;
	}
	$output_file = fopen($temp_file, "w");
	if($output_file === false)
	{
		print "Error opening ouptu file\n";
		print "<a href=//secure.pi/upload.html>Back</a>";
		exit;
	}
	$proto_test = false;
	$remote_test = false;
	$ca_test = false;
	if($input_file)
	{
		while(($line = fgets($input_file)) !== false)
		{
			$skip = false;
			for($i = 1; $i <= 15; $i++)
			{
				if(startsWith($line, $keywords_skip[$i]))
				{
					$skip = true;
				}
			}
			if($skip === true)
			{
				continue;
			}
			if(startsWith($line, $keywords["udp"]) or startsWith($line, $keywords["tcp"]))
			{
				fwrite($output_file, $line);
				$proto_test = true;
			}
			elseif(startsWith($line, $keywords["remote"]))
			{
				fwrite($output_file, $line);
				$remote_test = true;
			}
			elseif(startsWith($line, $keywords["start_ca"]))
			{
				$ca = $line;
				do
				{
					$line = fgets($input_file);
					if($line === false)
					{
						print "File read error during ca cert.\n";
						print "<a href=//secure.pi/upload.html>Back</a>";
						exit;
					}
					$ca .= $line;
				} while(startsWith($line, $keywords["end_ca"]) === false);
				fwrite($output_file, $ca);
				$ca_test = true;
			}
			else
			{
				fwrite($output_file, $line);
			}
		}
	}
	fclose($input_file);
	fwrite($output_file, "client\n");
 	fwrite($output_file, "dev tun0\n");
 	fwrite($output_file, "verb 3\n");
 	fwrite($output_file, "nobind\n");
 	fwrite($output_file, "persist-key\n");
 	fwrite($output_file, "persist-tun\n");
 	fwrite($output_file, "resolv-retry infinite\n");
 	fwrite($output_file, "mute-replay-warnings\n");
 	fwrite($output_file, "daemon\n");
 	fwrite($output_file, "script-security 2\n");
 	fwrite($output_file, "auth-user-pass \"/etc/openvpn/login.conf\"\n");
 	fwrite($output_file, "auth-nocache\n");
 	fwrite($output_file, "log-append \"/etc/openvpn/client.log\"\n");
 	fwrite($output_file, "up \"/home/gamblodar/securepi/vpn_masquerade.sh\"\n");
 	fwrite($output_file, "down \"/home/gamblodar/securepi/non_vpn_masquerade.sh\"\n");
	fclose($output_file);
	if($ca_test === true And $remote_test === true And $proto_test === true)
	{
		$output_file = fopen($config_file, "w");
		$input_file = fopen($temp_file, "r");
		if($input_file === false Or $output_file === false)
		{
			print "Error opening files\n";
			print "<a href=//secure.pi/upload.html>Back</a>";
			exit;
		}
		while(($line = fgets($input_file)) !== false)
		{
			fwrite($output_file, $line);
		}
		fclose($output_file);
		unlink($temp_file);
		fclose($input_file);		
	}
	else
	{
		if($ca_test === false)		print "Didn't find a <ca> block\n";
		if($remote_test === false)	print "Didn't find a remote server line\n";
		if($proto_test === false)	print "Didn't find a protocol line\n";
		exit;
	}
	// set proper permissions on the new file
	chmod($config_file, 0664);
	header('Location: //secure.pi/login.html');
}
