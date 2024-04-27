<?php 
session_start();
$user_id = $_SESSION['id'];

include_once "connect.php";

if (isset($_GET['id'])) {
    $task_id = mysqli_real_escape_string($con, $_GET['id']);
    $task = mysqli_real_escape_string($con, $_GET['task']);
    $category = mysqli_real_escape_string($con, $_GET['category']);
    $due = mysqli_real_escape_string($con, $_GET['due']);
    $descr = mysqli_real_escape_string($con, $_GET['desc']);

    $update = mysqli_query($con, "UPDATE tasks SET task='{$task}', category='{$category}', due='{$due}', descr='{$descr}' WHERE task_id='{$task_id}' AND user_id='{$user_id}'");
    if ($update){
        echo "yes";
    }else{
        echo "err";
    }
}else{
    echo "err";
}
?>