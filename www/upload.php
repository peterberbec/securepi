<?php
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
function ca_error()
{
	print "<h3><b>Didn't find a \"&lt;ca&gt;\" block</b></h3>";
	print "<p>Some downloaded OpenVPN configurations contain a seperate file ";
	print "that contains the Root CA certificate. This needs to be included ";
	print "in the file uploaded. ";
	print "To fix this error, please open the OpenVPN configuration file in the ";
	print "editor of your choice. Also open the CA root certificate you downloaded ";
	print "from your VPN provider. Add the following line to your OpenVPN config: ";
	print "<pre>&lt;ca&gt;</pre>";
	print "Then copy the CA root certificate from the";
	print "<pre>-----BEGIN</pre>all the way to the";
	print "<pre>-----END</pre>";
	print "and copy that into the configuration file. After that, add the following line:";
	print "<pre>&lt;/ca&gt;</pre>";
	print "You should be able to upload the configuration successfully after that.</p>";
}
function proto_error()
{
	print "<b><h3>Didn't find a \"proto\" line.</h3></b>";
	print "<p>The \"proto\" line tell OpenVPN if it uses UDP or TCP, the two possible ";
	print "was of communicating with the VPN server. Most configurations use UDP, but ";
	print "we cannot assume that is the case. The connetion will fail with the wrong ";
	print "setting. Please contact your VPN provider and determine if the use UDP or ";
	print "TCP. Once you are aware of the correct style of connection, add a single line ";
	print "in your OpenVPN configuration file.<br><br>";
	print "Either add:";
	print "<pre>proto udp</pre>";
	print "or";
	print "<pre>proto tcp</pre>";
	print "and reupload the file.</p>";
}
function remote_error()
{
	print "<h3><b>Didn't find a \"remote\" server line.</b></h3>";
	print "<p>The \"remote\" line tells OpenVPN where to connect. ";
	print "It is very unlikely a configuration file lacks this line. ";
	print "Ensure you are uploading the correct file. Some VPN providers ";
	print "distribute their configurations compressed. If the file shows as ";
	print "\"Zip file\" or \"Archive\" or something similar, please uncompress ";
	print "and upload the correct file.</p>";
}
function print_html_begin()
{
	print "<html><body>";
}
function print_html_end()
{
	print "</html></body>";
}
function print_back()
{
	print "<a href=//secure.pi/upload.html>Back</a>";
}
$config_file = "/etc/openvpn/uploaded.conf";
$keywords = array(	"udp"		=> "proto udp",
			"tcp"		=> "proto tcp",
			"remote"	=> "remote ",
			"start_ca"	=> "<ca>",
			"begin_ca"	=> "-----BEGIN",
			"end_ca"	=> "-----END",
			"stop_ca"	=> "</ca>");
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
		print_html_begin();
		print "An error occurred uploading the file.";
		print_back();
		print_html_end();
		exit;
	}
	$tmp = $_FILES["myFile"][tmp_name];
	$temp_uploaded_file = tempnam("", "");

	if(move_uploaded_file($tmp, $temp_uploaded_file) === false)
	{
		print_html_begin();
		print "An error occurred moving the uploaded file.";
		print_back();
		print_html_end();
		exit;
	}	

	$input_file = fopen($temp_uploaded_file, "r");
	if($input_file === false)
	{
		print_html_begin();
		print "Error opening input file\n";
		print_back();
		print_html_end();
		exit;
	}
	$output_file = fopen($temp_file, "w");
	if($output_file === false)
	{
		print_html_begin();
		print "Error opening output file\n";
		print_back();
		print_html_end();
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
# "start_ca" => "<ca>",	"begin_ca" => "-----BEGIN", "end_ca" => "-----END", "stop_ca" => "</ca>"
				$ca = $line;
				$line = fgets($input_file);
				if(startsWith($line, $keywords["begin_ca"]))
				{
					$ca .= $line;
				}
				else
				{
					print_html_begin();
					ca_error();
					print_back();
					print_html_end();
					exit;
				}
				do
				{
					$line = fgets($input_file);
					if($line === false)
					{
						print_html_begin();
						ca_error();
						print_back();
						print_html_begin();
						exit;
					}
					$ca .= $line;
				} while(startsWith($line, $keywords["end_ca"]) === false);
				$line = fgets($input_file);
				if(startsWith($line, $keywords["stop_ca"]))
				{
					$ca .= $line;
				}
				else
				{
					print_html_begin();
					ca_error();
					print_back();
					print_html_end();
					exit;
				}
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
			print_html_begin();
			print "Error opening files\n";
			print_back();
			print_html_end();
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
		print_html_begin();
		print "<p><h1>Error in uploaded OpenVPN configuration</h1></p>\n";
		if($ca_test === false)
		{
			ca_error();
		}
		if($remote_test === false)
		{
			remote_error();
		}
		if($proto_test === false)
		{
			proto_error();
		}
		print "<p><h2>Please fix these issues and reupload your configuration file.</h2><p>";
		print_back();
		print_html_end();
		exit;
	}
	// set proper permissions on the new file
	chmod($config_file, 0664);
	header('Location: //secure.pi/login.html');
}
