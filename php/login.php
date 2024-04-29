<?php 
include "connect.php";

if (isset($_POST['email'])){
    $out = '';
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pswd = mysqli_real_escape_string($con, $_POST['pswd']);

    $verify_email = mysqli_query($con,"SELECT * FROM users WHERE email='{$email}'");
    if (mysqli_num_rows($verify_email)>0){
        $fetch = mysqli_fetch_assoc($verify_email);
        $verify_pswd = $fetch['pswd'];
        $id =$fetch['user_id'];

        if (md5($pswd) == $verify_pswd){
            header("location: session.php?id=$id");
        }else{
            $out = "
                <script>
                    alert('Access Denied. Wrong password!');
                    window.location.assign('../login.html');
                </script>
            ";        
        }
    }else{
        $out = "
            <script>
                alert('E-mail not found');
                window.location.assign('../login.html');
            </script>
        ";
    }

    echo $out;
}