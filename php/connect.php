<?php  

$hostname = "localhost";
$username = "root";
$password = "";
$db = "zero";

$con = mysqli_connect($hostname, $username, $password, $db);

if (!$con) {
	die("connection failed");
	header("location: errors/?i=501");
}

?>