<?php include('server.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/popup2.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        li:nth-child(5){
            margin-left: 60vh;
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
                <li><a href = "order.html" class="gradient">Order Ticket</a></li>
                <li><a href = "#" class="gradient">Contact</a></li>
                <li>
                    <a href="#login" class="button">Log In</a>
                    <!-- <label for="show" class="popup">Log In</label> -->
                </li>
            </ul>
        </div>
        <div class="overlay" id="login">
            <div class="wrapper">
                <h2>Log In</h2>
                <a href="#" class="close">&times;</a>
                <div class="content">
                    <div class="container">
                        <form action="index.php" method="POST">
                            <?php include('errors.php'); ?>
                            <label>Username</label>
                            <input type="text" name="username" id="">
                            <label>Password</label>
                            <input type="password" name="password" id="">
                            <input type="submit" value="LOGIN" name="login_user">
                            <p>
                                Not yet a member? <a href="register.php"> Sign up </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome-text" id="login">
            <h1>Home Page Web Travel Services</h1>
            <a href="#">Contact Us</a>
        </div>
    </header>
</body>
</html>