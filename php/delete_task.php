<?php
session_start();
$user_id = $_SESSION['id'];

include_once "connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = mysqli_query($con, "DELETE FROM tasks WHERE task_id='{$id}' AND user_id='{$user_id}'");
    if ($delete) {
        echo "yes";
    }else{
        echo "err";
    }
}else{
    echo "err";
}

?>