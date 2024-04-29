<?php 
session_start();
$user_id = $_SESSION['id'];

include_once "connect.php";

$fetch = mysqli_query($con, "SELECT * FROM notif WHERE user_id='{$user_id}' ORDER BY notif_date DESC");

if (mysqli_num_rows($fetch)>0){
    while ($row = mysqli_fetch_assoc($fetch)){
        $notif_id = $row['id'];
        $category = $row['category'];
        $content = $row['content'];
        $date = $row['notif_date'];
        $opened = $row['opened'];

        if ($opened == '0') {
            $new="<div style='background: var(--team); color: var(--text);padding: 8px 20px; position: relative; left: -20px;border-radius: 30px '> new </div>";
        }else{
            $new="";
        }
        
        if ($category == "invite"){
            $icon = "envelope";
        }else if($category == "info"){
            $icon = "info-circle";
        }
        echo "
            <div class='single-notif'>
                <div class='notification'>
                    <div class='img'><i class='bi bi-$icon' class='$category'></i></div>
                        <div class='textBox'>
                            <div class='textContent'>
                                <p class='h1'>$category</p>
                                <span class='span'>$date</span>
                            </div>
                            <p class='p'>$content</p>
                        <div>
                    </div>
                </div>
                $new <br>
                <a href='php/delete_notification.php?id=$notif_id' class='bi bi-trash'></a>
            </div>        
        ";
    }
}else{
    echo "
        <div class='placeholder'>
            <img src='assets/img/notif.png' alt='Empty icon'>
            <div class='text'>
                <h3>Empty Notification tab</h3>
                <h6>Seems like there is no updates to right now</h6>
            </div>
        </div>    
    ";
}
?>

