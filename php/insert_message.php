<?php
session_start();
$user_id = $_SESSION['id'];

include_once "connect.php";

if (isset($_GET['team'])){
    $msg_id = rand();
    $msg = mysqli_real_escape_string($con, $_GET['msg']);
    $team_id = mysqli_real_escape_string($con, $_GET['team']);

    $insert = mysqli_query($con, "INSERT INTO group_messaging(msg_id, sender_id, team_id, msg) VALUE('{$msg_id}', '{$user_id}', '{$team_id}', '{$msg}')");
    if ($insert){
        echo "yeah";
    }else{
        echo "err";
    }
}