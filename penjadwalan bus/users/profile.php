<?php include('../php/server.php');

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("Location: ../index/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--- === CSS === -->
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../admin-site/admin-site.css">
    <link rel="stylesheet" href="profile.css">
    <!--- === ICON === -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <title>Admin Site</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <div class="logo-image">
                <img src="../images/logo.png" alt="">
            </div>
            <div class="logo-name">Espishu</div>
            <div class="close-btn">
                <i class="uil uil-angle-left"></i>
            </div>
        </div>
        <div class="menu">
            <ul class="menu-1">
                <li class="menu-items selected">
                    <a href="#">
                        <i class="uil uil-home"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="menu-items">
                    <a href="#">
                        <i class="uil uil-credit-card"></i>
                        <p>Add Saldo</p>
                    </a>
                </li>
                <li class="menu-items">
                    <a href="#">
                        <i class="uil uil-bus"></i>
                        <p>Order Ticket</p>
                    </a>
                </li>
            </ul>
            <ul class="menu-2">
                <li class="menu-items">
                    <a href="profile.php?logout='1'">
                        <i class="uil uil-signout"></i>
                        <p>Log Out</p>
                    </a>
                </li>
                <li class="menu-items mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <p>Dark Mode</p>
                    </a>
                    <div class="mode-toggle">
                        <div class="switch"></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="side-bar">
            <ul class="profile-menu">
                <li class ="profile-menu-list open-profile selected">Profile Information</li>
                <li class ="profile-menu-list open-security">User Security Settings</li>
            </ul>
        </div>
        <div class="profile-info">
            <form action = "profile.php" method = "POST" class="change-profile">     
                <div class="inputChanges">
                    <label>Name</label>
                    <input type="text" name = "newName" placeholder="<?php echo $_SESSION['username'];?>" required>
                </div>
                <div class="inputChanges">
                    <label>Email</label>
                    <input type="email"  placeholder="<?php echo $_SESSION['email'];?>" required>
                </div>
            </form>
            <form actin = "profile.php" method = "POST" class="change-security inactive">     
                <div class="inputChanges">
                    <label>Current Password</label>
                    <input type="text" placeholder="current password" name ="oldPass" required>
                </div>
                <div class="inputChanges">
                    <label>New Password</label>
                    <input type="password" placeholder="new password" name ="newPass_1" required>
                </div>
                <div class="inputChanges">
                    <label>Confirm New Password</label>
                    <input type="password" placeholder="confirm new password" name ="newPass_2" required>
                </div>
                <input type="submit" value="Save Changes" name = "change_pass">
            </form>
        </div>
    </div>
    
    <script src="../admin-site/admin-site.js"></script>
    <script src="profile.js"></script>
    <?php // If there's an error
    if (isset($_SESSION['error'])) { ?>
        <script>
            alert("<?php echo $_SESSION['error']; ?>");
            <?php unset($_SESSION['error']); ?>
        </script>
    <?php } ?>
</body>
</html>