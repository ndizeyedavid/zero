<?php 

session_start();
$user_id = $_SESSION['id'];
include_once "connect.php";

if (isset($_POST['submit'])){
    $invite = mysqli_real_escape_string($con, $_POST['invite_code']);

    $verify = mysqli_query($con, "SELECT * FROM teams WHERE team_id='{$invite}'");
    if (mysqli_num_rows($verify)>0){
        $team_details = mysqli_fetch_assoc($verify);
        
        $team_name = $team_details['team_name'];

        $verify2 = mysqli_query($con, "SELECT * FROM team_members WHERE team_id='{$invite}' AND member_id='{$user_id}'");
        
        if (mysqli_num_rows($verify2)==0){
            $add = mysqli_query($con, "INSERT INTO team_members(team_id, member_id, role) VALUES('{$invite}', '{$user_id}', 'member')");

            if ($add){
                $notif = mysqli_query($con, "INSERT INTO notif(user_id, content, category) VALUES('{$user_id}', 'You joined team: <b>$team_name</b>', 'info')");
                echo "
                <script>
                    alert('Joined $team_name');
                    window.location.assign('../#team');
                </script>
                ";
            }
        }else{
            echo "
            <script>
                alert('Already a member in $team_name');
                window.location.assign('../#team');
            </script>
            ";
                
        }
        
    }else{
        echo "
        <script>
            alert('invalid invite code');
            window.location.assign('../#team');
        </script>
        ";
    }
}

?>