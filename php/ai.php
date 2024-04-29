<?php 
session_start();
$user_id = $_SESSION['id'];
include_once "connect.php";

if (isset($_GET['prompt'])){
    $task_id = uniqid();
    $msg = mysqli_real_escape_string($con, $_GET['q']);
    $prompt = mysqli_real_escape_string($con, $_GET['prompt']);
    $due = date("m/d/Y");

    if ($prompt == "add"){
        $sql = "INSERT INTO tasks(task_id, user_id, task, due) VALUES('{$task_id}', '{$user_id}', '{$msg}', '{$due}')";
        $done = "add";
    }

    $act = mysqli_query($con, $sql);

    if ($act){
        echo "Task $done"."ed";
    }else{
        echo "err";
    }
}