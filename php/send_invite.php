<?php 
session_start();
$user_id = $_SESSION['id'];

include_once "connect.php";

if (isset($_GET['email'])){

    $team_id = $_GET['team_id'];
    $email = mysqli_real_escape_string($con, $_GET['email']);

    $team_details_fetch = mysqli_query($con, "SELECT * FROM teams WHERE team_id='{$team_id}'");
    $team_details = mysqli_fetch_assoc($team_details_fetch);

    $team_name = $team_details['team_name'];
    $team_id = $team_details['team_id'];
    
    
    $verify = mysqli_query($con, "SELECT * FROM users WHERE email='{$email}'");
    if (mysqli_num_rows($verify)>0){
        $data = mysqli_fetch_assoc($verify);
        $reciever_id = $data['user_id'];
    
        $send = mysqli_query($con, "INSERT INTO notif (user_id, content, category) VALUES ('{$reciever_id}', '{$team_name} Sent an invite to join their group<div>Invite code: <b>$team_id</b></div>', 'invite')");
        if ($send){
            echo "yes";
        }else{
            echo "err";
        }
    }else{
        echo "err";
    }
}else{
    echo "err";
}
// $send = mysqli_query($con, "INSERT INTO notif(user_id, content, category) VALUES('{$reciever_id}', '$team_name Sent an invite to join there group<button id='$team_id' onclick='joinTeam(this.id)'>Join</button>', 'invite')");

?>