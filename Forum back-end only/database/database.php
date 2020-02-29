<?php // връзка с базата от данни

$servername = "localhost"; 
$dBUsername = "root";
$dBPassword = "";
$dBName = "userinfo";

$connect = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$connect){
	die("Connection failed: ".mysqli_connect_error());
}

?>