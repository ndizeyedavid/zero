<?php

include "connect.php";

if (isset($_POST['email'])){
    $out = "";
    $id = rand();
    $name = mysqli_real_escape_string($con, $_POST['user']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pswd = mysqli_real_escape_string($con, $_POST['pswd']);

    $enc = md5($pswd);
    
    $verify = mysqli_query($con, "SELECT * FROM users WHERE email='{$email}'");

    if (mysqli_num_rows($verify)==0){
        $create = mysqli_query($con, "INSERT INTO users(user_id, user_name, email, pswd, profile) VALUES('{$id}', '{$name}', '{$email}', '{$enc}', 'default.png')");

        if ($create){
            header("location: session.php?id=$id");
        }else{
            $out = "
            <script>
                alert('An error Occured');
                window.location.assign('../login.html');
            </script>
        ";
        }
    }else{
        $out = "
            <script>
                alert('E-mail already exists');
                window.location.assign('../login.html');
            </script>
        ";
    }

    echo $out;
}