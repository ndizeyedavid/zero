<?php
    if (isset($_GET['task'])) {
        $task = $_GET['task'];
        $category = $_GET['category'];
        $due = $_GET['due'];
        $desc = $_GET['desc'];

        echo "Task: $task";
        echo "Category: $category";
        echo "Due: $due";
        echo "Desc: $desc";
    }