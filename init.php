<?php
session_start();
include "php/connect.php";

$_SESSION['id'] = "0909";
$_SESSION['name'] = "Tom cruise";
$_SESSION['email'] = "tom@gmail.com";
$_SESSION['profile'] = "tom.png";

header("location: index.php");