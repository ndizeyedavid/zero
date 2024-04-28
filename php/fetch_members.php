<?php
session_start();
$user_id = $_SESSION['id'];

include_once "connect.php";

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $fetch = mysqli_query($con, "SELECT * FROM team_members WHERE team_id='{$id}'");
    if (mysqli_num_rows($fetch)>0) {
        $i=0;
        while ($row = mysqli_fetch_assoc($fetch)){
            ++$i;
            $member_id = $row['member_id'];
            $fetch_data = mysqli_query($con, "SELECT * FROM users WHERE user_id='{$member_id}'");
            $data = mysqli_fetch_assoc($fetch_data);

            $name = $data['user_name'];
            $profile = $data['profile'];
            echo "
                <tr>
                    <td style='text-align: center;'>$i</td>
                    <td style='text-align: center;'><img src='assets/img/profile/$profile' alt='Profile-image'></td>
                    <td style='text-align: center;font-size: 30px;'>$name</td>
                </tr>            
            ";
        }
    }else{
        echo "
            <tr>
                <td colspan='4' align='center'>No members in this group</td>
            </tr>        
        ";        
    }
}
?>