<?php

$id = $_GET['id'];
echo "

<div class='close'><i class='bi bi-x-lg' onclick='document.getElementById(`right-container`).style.display='none';'></i></div>
<div class='task'>
    <div class='check'></div>
    <div class='task-details'>Mellow task(id: $id)</div>
    <div class='fav'><i class='bi bi-star'></i></div>
</div>

<div class='more-task-details'>
    <div class='detail'>
        <div class='icon'><i class='bi bi-collection'></i></div>
        <div class='detail-name'>Category</div>
    </div>
    <hr>
    <div class='detail'>
        <div class='icon'><i class='bi bi-calendar-date'></i></div>
        <div class='detail-name'>Due Date</div>
    </div>
</div>

<div class='task-desc'>
    <p class='descriptio'>Mellow</p>
</div>
";

?>
