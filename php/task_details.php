<?php
session_start();
$user_id = $_SESSION['id'];
include_once "connect.php";
$id = $_GET['id'];
$fetch = mysqli_query($con, "SELECT * FROM tasks WHERE user_id='{$user_id}' AND task_id='{$id}'");

if(mysqli_num_rows($fetch)>0){
    $data = mysqli_fetch_assoc($fetch);

    $task = $data['task'];
    $category = $data['category'];
    $due = $data['due'];
    $desc = $data['descr'];
    $created_date = $data['created_date'];
    $important = $data['important'];

    if ($important == 0){
        echo "
            <div class='close'><i class='bi bi-x-lg' onclick='closePanel()'></i></div>
            <div class='task'>
                <div class='task-details'><input type='text' value='$task' id='inp-task'></div>
                <div class='fav'><i class='bi bi-star'></i></div>
            </div>

            <div class='more-task-details'>
                <div class='detail'>
                    <div class='icon'><i class='bi bi-collection'></i></div>
                    <div class='detail-name'>Category <input type='text' value='$category' id='inp-category'></div> 
                    
                </div>
                <hr>
                <div class='detail'>
                    <div class='icon'><i class='bi bi-calendar-date'></i></div>
                    <div class='detail-name'>Due Date <input type='text' value='$due' id='inp-due'></div>
                </div>
            </div>

            <div class='task-desc'>
                <textarea id='inp-desc'>$desc</textarea>
            </div>     
            <button class='update' id='$id' onclick='updateTask(this.id)'>Update Changes</button>
            <div class='bottom'>
                <hr>
                <div class='txt'>
                    <span>Added on: $created_date</span>
                    <button title='delete' id='$id' onclick='deleteTask(this.id)'>
                        <i class='bi bi-trash'></i>
                    </button>
                </div>
            </div>    
        ";
    }else{
       echo "
            <div class='close'><i class='bi bi-x-lg' onclick='closePanel()'></i></div>
            <div class='task'>
                <div class='task-details'><input type='text' value='$task' id='inp-task'></div>
                <div class='fav'><i class='bi bi-star-fill'></i></div>
            </div>

            <div class='more-task-details'>
                <div class='detail'>
                    <div class='icon'><i class='bi bi-collection'></i></div>
                    <div class='detail-name'>Category <input type='text' value='$category' id='inp-category'></div> 
                    
                </div>
                <hr>
                <div class='detail'>
                    <div class='icon'><i class='bi bi-calendar-date'></i></div>
                    <div class='detail-name'>Due Date <input type='text' value='$due' id='inp-due'></div>
                </div>
            </div>

            <div class='task-desc'>
                <textarea id='inp-desc'>$desc</textarea>
            </div>     
            <button class='update' id='$id' onclick='updateTask(this.id)'>Update Changes</button>
            <div class='bottom'>
                <hr>
                <div class='txt'>
                    <span>Added on: $created_date</span>
                    <button title='delete' id='$id' onclick='deleteTask(this.id)'>
                        <i class='bi bi-trash'></i>
                    </button>
                </div>
            </div>    
        "; 
    }
}else{
    echo "error fetching Task details. <h1>Please refresh the page</h1>";
}
?>
