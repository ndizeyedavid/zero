<?php
session_start();
include "connect.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $fetch_data = mysqli_query($con, "SELECT * FROM users WHERE user_id='{$id}'");
    $data = mysqli_fetch_assoc($fetch_data);

    $_SESSION['id'] = $data['user_id'];
    $_SESSION['name'] = $data['user_name'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['profile'] = $data['profile'];

    if ($_SESSION['id']){
        header("location: init.php");
    }
    
}