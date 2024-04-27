<?php
session_start();
include "php/connect.php";

$_SESSION['id'] = 1234;
$_SESSION['name'] = "Ndizeye David";
$_SESSION['email'] = "davidndizeye101@gmail.com";
$_SESSION['profile'] = "dav.jpg";

header("location: index.php");