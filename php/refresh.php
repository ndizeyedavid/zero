<?php 
session_start();
$user_id = $_SESSION['id'];

include_once "connect.php";

$update = mysqli_query($con, "UPDATE notif SET opened='1' WHERE user_id='{$user_id}'");
header("location: ../#notification");
?>