<?php
    $t_d = date("d");
    $t_m = date("m");
    session_start();
    $user_id = $_SESSION['id'];

    include "connect.php";
    if (isset($_GET['tab'])){
        $task_id = uniqid();
        $task = mysqli_real_escape_string($con, $_GET['task']);
        $category = mysqli_real_escape_string($con, $_GET['category']);
        $due = mysqli_real_escape_string($con, $_GET['due']);
        $descr = mysqli_real_escape_string($con, $_GET['desc']);
        $tab = mysqli_real_escape_string($con, $_GET['tab']);

        if (empty($due) && $tab == "main"){
            $due = date("m/d/Y");
        }

        $spl_d = explode("/", $due);
        $d_m = $spl_d[0];
        $d_d = $spl_d[1];
        
        if ($d_d<$t_d && $d_m<=$t_m){
            $due = date("m/d/Y");
        }
        
        if (empty($task)){
            echo "Empty task";
            return false;
        }
        
        $insert = mysqli_query($con, "INSERT INTO tasks(task_id, user_id, task, category, due, descr) values('{$task_id}', '{$user_id}', '{$task}', '{$category}', '{$due}', '{$descr}')");
        if ($insert){
            echo "Task inserted successfully";
        }else{
            echo "An error occured. Please try again";
        }
    }else{
        echo "Undefined task";
    }

?>