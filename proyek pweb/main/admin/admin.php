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
                    <a href="admin.php">
                        <?php echo $_SESSION['username'];?>
                    </a>
                </div>
                <div class = "admin-sidebar">
                    <ul class = "admin-menulist">
                        <li class="admin-menuitem"><a href="../home.php">Home Page</a></li>
                        <li class="admin-menuitem"><a href="schedule.php">Schedule</a></li>
                        <li class="admin-menuitem"><a href="../home.php?logout='1'">Log Out</a></li>
                    </ul>
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
                        <li class="menu-item menu-selected"><a href="admin.php">Profile Information</a></li>
                    </ul>
                </div>
                <div class="wrap">
                    <form>
                        <div class="inputChanges">
                            <label>Status : Admin</label>
                        </div>
                        <div class="inputChanges">
                            <label>Name</label>
                            <input type="text" 
                            placeholder="<?php echo $_SESSION['username'];?>"
                            >
                        </div>
                        <div class="inputChanges">
                            <label>Phone</label>
                            <input type="number" placeholder="<?php echo $_SESSION['phone'];?>">
                        </div>
                        <div class="inputChanges">
                            <label>Email</label>
                            <input type="email" placeholder="<?php echo $_SESSION['email'];?>">
                        </div>
                        <input type="submit" value="Save Changes">
                    </form>
                </div>
            </div>
            <hr class="horizontalLine">
        </body>
        </html>
    <?php
}
else{
    header("Location: index.php");
    exit();
}
?>
