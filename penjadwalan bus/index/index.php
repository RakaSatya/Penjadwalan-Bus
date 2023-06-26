<?php include('../php/server.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <!--- === STYLES === -->
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="index.css">
    <!--- === ICON === -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body class="index">
    <div class="nav">
        <div class="logo-img">
            <img src="../images/logo.png">
        </div>
        <ul class="menu-link">
            <li class="left"><a href="#" class="nav-item gradient-text" >Home</a></li>
            <li class="left"><a href="#" class="nav-item gradient-text" >About Us</a></li>
            <li class="left"><a href="#" class="nav-item gradient-text" >Order Ticket</a></li>
            <li class="left"><a href="#" class="nav-item gradient-text" >Contact</a></li>
            <li class="right login-link"><a href="
                <?php 
                if(isset($_SESSION['loginStatus'])) echo "../users/profile.php";
                else echo "#";
                ?>" class="nav-item gradient-text">
                <?Php 
                if(isset($_SESSION['loginStatus'])) echo $_SESSION['username'];
                else echo "Log In";
                ?>
            </a></li>
            <li class="right"><a href="../admin-site/admin-site.php" class="nav-item gradient-text">
                <?php if(isset($_SESSION['admin'])) echo "Admin-Site";
                ?>
            </a></li>
        </ul>
    </div>
    <div class="overlay">
        <div class="form-wrap">
            <div class="close-btn">
                <i class="uil uil-times-circle"></i>
            </div>
            <div class="login">
                <h2 class="form-title">Log In</h2>
                <form action = "index.php" method = "POST">
                    <input type="text" name = "username" placeholder="Username/Email" required>
                    <input type="password" name = "password" placeholder="Password" required>
                    <input type="submit" name = "loginbtn" value="Log In">
                </form>
                <div class="pass-reg-link">
                    <div class="forgot-pass">
                        <a href="#">Forgot Pass?</a>
                    </div>
                    <div class="register-link" id="registerBtn">
                        <a href="#">Register Now</a>
                    </div>
                </div>
            </div>
            <div class="register inactive">
                <h2 class="form-title">Registration</h2>
                <div class="errorMsg">
                    <?php
                    if(isset($_SESSION['errormsg'])){
                        echo $_SESSION['errormsg'];
                    }
                    ?>
                </div>
                <form action="index.php" method = "POST" >
                    <input type="text" name = "email"placeholder="Email">
                    <input type="text" name = "username" placeholder="Username">
                    <input type="password" name = "password_1" placeholder="Password">
                    <input type="password" name = "password_2" placeholder="Confirm Password">
                    <input type="submit" name = "regBtn" value="Register">
                </form>
                <div class="alr-have-acc">
                    <p>Already have an account?</p>
                    <a href="#" id="loginBtn">Log In</a>
                </div>
            </div>
        </div>
    </div>
    <script src="index.js"></script>
    
    <?php // If there's an error
    if (isset($_SESSION['error'])) { ?>
        <script>
            alert("<?php echo $_SESSION['error']; ?>");
            <?php unset($_SESSION['error']); ?>
        </script>
    <?php } ?>
</body>
</html>