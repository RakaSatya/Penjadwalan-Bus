<?php
session_start();
// connecting to database
$db = mysqli_connect('localhost', 'root', '', 'reglog');

$username = "";
$email = "";

// register form
if(isset($_POST['regBtn'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

     // Check if username or email already exist
    $user_check_query = "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email' LIMIT 1";
    $user_check_result = mysqli_query($db, $user_check_query);
    $users = mysqli_fetch_assoc($user_check_result);
    if($users){
        if($users['username'] === $username){
            $_SESSION['error'] = "Username already exist";
        }
        if($users['email'] === $email){
            $_SESSION['error'] = "Email already exist";
        }
    }
    if(!isset($_SESSION['error'])){
        if($password_1 == $password_2){
            // Encrypt password before saving it to database
            $hashPass = md5($password_1);
            $query = "INSERT INTO tb_user(username, password, email, status) VALUES ('$username', '$hashPass', '$email', 'member')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['loginStatus'] = true;
            header('location: index.php');
        }
    }   
}

// log in form
if(isset($_POST['loginbtn'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);
    $query = "SELECT * FROM tb_user WHERE
    username = '$username' AND
    password = '$password'";

    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) == 1){
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $password;
        $_SESSION['loginStatus'] = true;
        if($row['status'] == "admin"){
            $_SESSION['admin'] = true;
        }
        header('location: index.php');
    }else{
        $_SESSION['error'] = "Incorrect Username/Password";
    }
}

// change pass form
if(isset($_POST['change_pass'])){
    $oldPass = md5($_POST['oldPass']);
    $newPass_1 = md5($_POST['newPass_1']);
    $newPass_2 = md5($_POST['newPass_2']);
    $oldPassDB = $_SESSION['password'];
    $username = $_SESSION['username'];
    if($newPass_1 != $newPass_2){
        $_SESSION['error'] = "The two password do not match";
    }
    if($oldPass != $oldPassDB){
        $_SESSION['error'] = "Old password is incorrect";
    }

    if(!isset($_SESSSION['error'])){
        $changePassQuery = "UPDATE `tb_user` SET `password` = '$newPass_1' WHERE `username` = '$username'";
        mysqli_query($db, $changePassQuery);
    }
}

// submit bus company form


?>
