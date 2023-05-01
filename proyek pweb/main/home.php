<?php
session_start();

    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "You must log in first";
        header('location: index.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/popup2.css">
    <style>
        li:nth-child(5){
            margin-left: 50vh;
        }
    </style>
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <img src ="css/images/logo3.png">
            </div>
            <ul>
                <li><a href = "#" class="gradient">Home</a></li>
                <li><a href = "#" class="gradient">About Us</a></li>
                <li><a href = "users/searchbus.php" class="gradient">Order Ticket</a></li>
                <li><a href = "#" class="gradient">Contact</a></li>
                <li><a href = "admin/admin.php" class="adminSite">Admin-Site</a></li>
                <li>
                    <a href="users/profile.php" class="button">
                        <?php echo $_SESSION['username'];?>
                    </a>
                    <!-- <label for="show" class="popup">Log In</label> -->
                </li>
                <li><a href = "home.php?logout='1'">Log Out</a></li>
            </ul>
        </div>
        </div>
        <div class="welcome-text" id="login">
            <h1>Home Page Web Travel Services</h1>
            <a href="#">Contact Us</a>
        </div>
    </header>
</body>
</html>
