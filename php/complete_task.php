<?php
session_start();

$user_id = $_SESSION['id'];
include_once "connect.php";

if (isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $fetch = mysqli_query($con, "SELECT completed FROM tasks WHERE task_id='{$id}' AND user_id='{$user_id}'");

    $verify = mysqli_fetch_assoc($fetch);
    $isComplete = $verify['completed'];
    
    if ($isComplete == "0"){
        $sql = "UPDATE tasks SET completed='1' WHERE task_id='{$id}' AND user_id='{$user_id}'";
    }else{
        $sql = "UPDATE tasks SET completed='0' WHERE task_id='{$id}' AND user_id='{$user_id}'";
    }

    $update = mysqli_query($con, $sql);

    if ($update) {
        echo "yes";
    }else{
        echo "no";
    }
}
?>