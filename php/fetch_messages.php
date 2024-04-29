
<?php
session_start();
$user_id = $_SESSION['id'];
include_once "connect.php";
if (isset($_GET['id'])) {
    $team_id = mysqli_real_escape_string($con, $_GET['id']);

    $sql = "SELECT * FROM group_messaging RIGHT JOIN users ON users.user_id = group_messaging.sender_id
            WHERE team_id = {$team_id} ORDER BY sent_date ASC";

    // $sql = "SELECT * FROM group_messaging LEFT JOIN users on users.user_id = group_messagin.sender_id WHERE"
    
    $fetch_msg = mysqli_query($con, $sql);

    $out = "";
    
    if (mysqli_num_rows($fetch_msg)>0){
        while ($row = mysqli_fetch_assoc($fetch_msg)){
            $message = $row['msg'];
            $profile = $row['profile'];
            $name = $row['user_name'];
            $date = $row['sent_date'];
            $time = explode(" ", $date);
            $time = end($time);

            if ($row['sender_id'] === $user_id){
                // echo "sender ";
                $out .= "
                    <div class='sender-msg-box' title='on: $date'>
                        <div class='msg'>
                            <span>$message</span>
                            <div class='msg-details'>$time</div>
                        </div>
                    </div>                             
                ";
            }else{
                // echo "reciever ";
                $out .= "
                    <div class='reciever-msg-box' title='on: $date'>
                        <div class='reciever-profile'><img src='assets/img/profile/$profile' alt='profile-img' title='$name'></div>
                        <div class='msg'>
                            <span>$message</span>
                            <div class='msg-details'>$time</div>
                        </div>
                    </div>
                ";
            }
            
        }
    }else{
        $out .= "<p style='text-align: center;position: relative; top: 100px;'>Empty messge box</p>";
    }
    
    echo $out;
}

?>
 