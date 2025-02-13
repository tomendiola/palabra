<?php
$ip = file_get_contents("https://api64.ipify.org");
echo "Tu dirección IP pública es: " . $ip;

$mac = shell_exec("getmac"); // Para Windows
echo "Tu dirección MAC es: " . trim($mac);
echo " " ;


$mac = shell_exec("getmac"); // Para Windows
echo "Tu dirección MAC es: " . $mac;
?>
