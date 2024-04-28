<?php
session_start();
$user_id = $_SESSION['id'];

include_once "connect.php";

if (isset($_POST['submit'])){
    $team_id = rand();

    $name = mysqli_real_escape_string($con, $_POST['team_name']);
    $img = $_FILES['team_profile']['name'];
    
    if (empty($img)) {
        $img = "placeholder.png";
    }else{        
        $ext = explode(".", $img);
        $ext = end($ext);

        $img = $team_id.".".$ext;
        $upload = move_uploaded_file($_FILES['team_profile']['tmp_name'], "../assets/img/teams/$img");
    }
    if ($upload) {
        $create = mysqli_query($con, "INSERT INTO teams(team_id, creator_id, team_name, team_profile) VALUES('{$team_id}', '{$user_id}', '{$name}', '$img')");
        if ($create){
            $validate = mysqli_query($con, "INSERT INTO team_members(team_id, member_id, role) VALUES('{$team_id}', '{$user_id}', 'admin')");
            if ($validate){
                $notif = mysqli_query($con, "INSERT INTO notif(user_id, content, category) VALUES('{$user_id}', 'A new group was created successfully( $name )', 'info')");
                echo "
                <script>
                    alert('Team created successfully');
                    window.location.assign('../#team');
                </script>
                ";

                // header("location: ../#team?succ=$name");
            }else{
                $delete = mysqli_query($con, "DELETE FROM teams WHERE team_id='{$team_id}'");
                echo "operation failed";
            }
        }else{
            echo "error";
        }
    }else{
        echo "Error uploading!";
    }
}