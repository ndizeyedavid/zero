<?php

$id = $_GET['id'];
echo "

<div class='close'><i class='bi bi-x-lg' onclick='closePanel()'></i></div>
<div class='task'>
    <div class='check'></div>
    <div class='task-details'>Prepare students for school</div>
    <div class='fav'><i class='bi bi-star'></i></div>
</div>

<div class='more-task-details'>
    <div class='detail'>
        <div class='icon'><i class='bi bi-collection'></i></div>
        <div class='detail-name'>Category( Education )</div> 
    </div>
    <hr>
    <div class='detail'>
        <div class='icon'><i class='bi bi-calendar-date'></i></div>
        <div class='detail-name'>Due Date (29/2/2026) </div>
    </div>
</div>

<div class='task-desc'>
    <p class='descriptio'>I have to takk all of my kids to school before time so that i can be free for a while and go shopping</p>
</div>
";

?>
