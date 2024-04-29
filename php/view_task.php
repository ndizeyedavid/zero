<?php
    session_start();
    $user_id = $_SESSION['id'];

    include "connect.php";
    
    if (isset($_GET['type'])) {
        $type = mysqli_real_escape_string($con, $_GET['type']);
        $sql = '';
        $due = date("m/d/Y");
        if ($type == "main"){
            $sql = "SELECT * FROM tasks WHERE user_id='{$user_id}' AND due='{$due}' ORDER BY important DESC";
        }else if($type == "planned"){
            $sql = "SELECT * FROM tasks WHERE user_id='{$user_id}' AND due!='{$due}' AND completed='0' ORDER BY due ASC";
        }else if($type == "important"){
            $sql = "SELECT * FROM tasks WHERE user_id='{$user_id}' AND important='1' ORDER BY due ASC";
        }else if($type == "completed"){
            $sql = "SELECT * FROM tasks WHERE user_id='{$user_id}' AND completed='1' ORDER BY due ASC";
        }

        $fetch = mysqli_query($con, $sql);
        if (mysqli_num_rows($fetch)>0){
            while ($row = mysqli_fetch_assoc($fetch)){
                $id = $row['task_id'];
                $task = $row['task'];
                $category = $row['category'];
                $due = $row['due'];
                $completed = $row['completed'];
                $important = $row['important'];
                $created_date = $row['created_date'];
                if ($important == 1 && $completed == 0){
                    echo "
                        <div class='task' id='task_$id' title='Created on: $created_date'>
                            <div class='check' id='$id' onclick='taskComplete(this.id)'></div>
                            <div class='task-details' id='$id' onclick='displayDetails(this.id)'>
                                <h3 class='task-name'>$task</h3>
                                <h5 class='category'>$category</h5>
                            </div>
                            <div class='fav' id='$id' onclick='modeChange(this.id)'>
                                <i class='bi bi-star-fill'></i>
                            </div>
                        </div>                    
                    ";                    
                }else if ($completed == 1 && $important == 0){
                    echo "
                        <div class='task' id='task_$id' title='Created on: $created_date'>
                            <div class='check active' id='$id' onclick='taskComplete(this.id)'><i class='bi bi-check'></i></div>
                            <div class='task-details' id='$id' onclick='displayDetails(this.id)'>
                                <h3 class='task-name active'>$task</h3>
                                <h5 class='category'>$category</h5>
                            </div>
                            <div class='fav' id='$id' onclick='modeChange(this.id)'>
                                <i class='bi bi-star'></i>
                            </div>
                        </div>                    
                    ";
                }else if($important == 1 && $completed == 1){
                    echo "
                        <div class='task' id='task_$id' title='Created on: $created_date'>
                            <div class='check active' id='$id' onclick='taskComplete(this.id)'><i class='bi bi-check'></i></div>
                            <div class='task-details' id='$id' onclick='displayDetails(this.id)'>
                                <h3 class='task-name active'>$task</h3>
                                <h5 class='category'>$category</h5>
                            </div>
                            <div class='fav' id='$id' onclick='modeChange(this.id)'>
                                <i class='bi bi-star-fill'></i>
                            </div>
                        </div>               
                    ";
                }else{
                    echo "
                        <div class='task' id='task_$id' title='Created on: $created_date'>
                            <div class='check' id='$id' onclick='taskComplete(this.id)'></div>
                            <div class='task-details' id='$id' onclick='displayDetails(this.id)'>
                                <h3 class='task-name'>$task</h3>
                                <h5 class='category'>$category</h5>
                            </div>
                            <div class='fav' id='$id' onclick='modeChange(this.id)'>
                                <i class='bi bi-star'></i>
                            </div>
                        </div>                    
                    ";
                }
            }
        }else{
            echo "
                <div class='placeholder'>
                    <img src='assets/img/empty.png' alt='Empty icon'>
                    <div class='text'>
                        <h3>Empty plan board</h3>
                        <h6>Seems like nothing is planned here yet.</h6>
                    </div>
                </div>            
            ";
        }
    }
?>

     