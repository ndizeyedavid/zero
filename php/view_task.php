<?php
    $i=0;
    while ($i<=2){
        echo "
            <div class='task' onclick='displayDetails($i)' id='task_$i'>
                <div class='check' onclick='taskComplete($i)'></div>
                <div class='task-details'>
                    <h3 class='task-name'>Task Name</h3>
                    <h5 class='category'>category</h5>
                </div>
                <div class='fav' onclick='modeChange($i)'>
                    <i class='bi bi-star'></i>
                </div>
            </div>        
        ";
        $i++;
    }
//     echo "
//     <div class='placeholder'>
//     <img src='assets/img/empty.png' alt='Empty icon'>
//     <div class='text'>
//         <h3>Welcome to your day</h3>
//         <h6>We'll help you manage all tasks you have today</h6>
//     </div>
// </div>

//     ";
?>

