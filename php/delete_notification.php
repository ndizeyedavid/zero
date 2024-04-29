<?php
session_start();
$user_id = $_SESSION['id'];
include_once "connect.php";

if (isset($_GET['id'])){
    $notif_id = $_GET['id'];

    $delete = mysqli_query($con, "DELETE FROM notif WHERE id='{$notif_id}' AND user_id='{$user_id}'");
    if ($delete){
        header("location: ../#notification");
    }else{
        echo "Error";
    }
}
?>