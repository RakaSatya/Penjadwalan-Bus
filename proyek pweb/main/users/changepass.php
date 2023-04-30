<?php
session_start();
if(
    //isset($_SESSION['id']) && 
    isset($_SESSION['username'])){
        ?>
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/tailwind.css">
            <link rel="stylesheet" href="../css/admin.css"> 
            <title>Profile</title>
        </head>
        <body>
            <div class="fixed">
                <div class="header"><a href="#">Logo</a></div>
                <div class="admin">
                    <a href="latihanprofile.php">
                        <?php echo $_SESSION['username'];?>
                    </a>
                </div>
                <div class = "admin-sidebar">
                    <ul class = "admin-menulist">
                        <li class="admin-menuitem"><a href="home.php">Home Page</a></li>
                        <li class="admin-menuitem"><a href="searchbus.php">Order Ticket</a></li>
                        <li class="admin-menuitem"><a href="../home.php?logout='1'">Log Out</a></li>
                </div>
            </div>
            </div>
            <div class="header-top"> 
                <div class="profile">
                    <?php echo $_SESSION['username'];?>
                </div> 
            </div>
            <div class="adminContent">
                <div class="sideBar">
                    <ul class="menu-list">
                        <li class="menu-item"><a href="profile.php">Profile Information</a></li>
                        <li class="menu-item menu-selected"><a href="changepass.php">Account Security Settings</a></li>
                    </ul>
                </div>
                <div class="wrap">
                    <form action="latihanprofile.php" method="POST">     
                        <div class="inputChanges">
                            <label>Current Password</label>
                            <input type = "text" name="oldPass">
                        </div>
                        <div class="inputChanges">
                            <label>New Password</label>
                            <input type = "password" name="newPass_1">
                        </div>
                        <div class="inputChanges">
                            <label>Confirm Password</label>
                            <input type = "password" name="newPass_2">
                        </div>
                        <input type="submit" name = "change_pass" value="Change Password">
                    </form>
                </div>
            </div>
        </body>
        </html>
    <?php
}
else{
    header("Location: index.php");
    exit();
}
?>
