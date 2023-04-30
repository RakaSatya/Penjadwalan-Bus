<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <div class="center">
        <input type="checkbox" name="" id="show">
        <label for="show" class="show-btn">Show Form</label>
        <div class="container">
            <label for="show" class="close-btn fa fa-close"></label>
            <div class="text">Register</div>
            <form action="register.php" method="POST">
                <?php include('errors.php'); ?>
                <div class="data">
                    <label for="">Username</label>
                    <input type="text" name="username" id="">
                </div>
                <div class="data">
                    <label for="">Email</la bel>
                    <input type="email" name="email" id="">
                </div>
                <div class="data">
                    <label for="">Phone Number</label>
                    <input type="number" name="phone" id="">
                </div>
                <div class="data">
                    <label for="">Password</label>
                    <input type="password" name="password_1" id="">
                </div>
                <div class="data">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password_2" id="">
                </div>
                <div class="btn">
                    <div class="inner"></div>
                    <button type="submit" name="reg_user">REGISTER</button>
                </div>
                <div class="signup-link">
                    Already Have an Account?
                    <a href="index.php">
                        Log In Here
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>