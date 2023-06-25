<?php include('../php/server.php');

if(!isset($_SESSION['admin'])){
    $_SESSION['errorAuthority'] = "You do not have Authority to Acesss Admin-Site";
}
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("Location: ../index/index.php");
}
if (!isset($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify the form token
    if ($_POST['form_token'] === $_SESSION['form_token']) {
        if(isset($_POST['submitC'])){
            $bus_company = $_POST['bus_company'];
            $query = "SELECT * FROM bus_list WHERE bus_company = '$bus_company'";
            $result = mysqli_query($db, $query);
            $_SESSION['bus_company'] = $_POST['bus_company'];
        }
        
        // submit bus ID form
        if(isset($_POST['submitID'])){
            $_SESSION['bus_id'] = $_POST['bus_id'];
        }
        
        // submit final form of adding bus schedule
        if(isset($_POST['submitF'])){
            $_SESSION['arrival_time'] = $_POST['arrival_time'];
            $_SESSION['departure_time'] = $_POST['departure_time'];
            $_SESSION['arrival_location'] = $_POST['arrival_location'];
            $_SESSION['departure_location'] = $_POST['departure_location'];
            $_SESSION['seats'] = $_POST['seats'];
            $_SESSION['price'] = $_POST['price'];
            
            $_SESSION['formstatus'] = true;
        }
        
        if (isset($_POST['confirm'])) {
            $data1 = $_SESSION['bus_company'];
            $data2 = $_SESSION['bus_id'];
            $data3 = $_SESSION['departure_location'];
            $data4 = $_SESSION['arrival_location'];
            $data5 = $_SESSION['departure_time'];
            $data6 = $_SESSION['arrival_time'];
            $data7 = $_SESSION['seats'];
            $data8 = $_SESSION['price'];
        
            $check_date = date('Y-m-d', strtotime($data5));
        
            $bus_check_query = mysqli_query($db, "SELECT * FROM bus_schedule WHERE bus_id = '$data2' AND (departure_time BETWEEN '$data5' AND '$data6' OR arrival_time BETWEEN '$data5' AND '$data6')");
            
            while ($bus_check_array = mysqli_fetch_array($bus_check_query)) {
                $check_d_time = strtotime($bus_check_array['departure_time']);
                $check_a_time = strtotime($bus_check_array['arrival_time']);
                $data5 = strtotime($data5);
                $data6 = strtotime($data6);
                
                if (($data5 >= $check_d_time && $data5 <= $check_a_time) || ($data6 >= $check_d_time && $data6 <= $check_a_time)) {
                    $_SESSION['error'] = "BUS CURRENTLY UNAVAILABLE";
                    break;
                }
            }
            
            if (!isset($_SESSION['error'])) {
                $addbus = "INSERT INTO bus_schedule 
                (bus_company, bus_id, departure_location, arrival_location, departure_time,
                arrival_time, seats, price) VALUES
                ('$data1', '$data2', '$data3', '$data4', '$data5', '$data6', '$data7', '$data8')";
                mysqli_query($db, $addbus);
                $_SESSION['formDone'] = true;
            }
        }
    }
    // Regenerate the form token for the next request
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}



if(!isset($_SESSION['selected_date'])){
    $_SESSION['selected_date'] = date("Y-m-d");
    $selected_date = $_SESSION['selected_date'];
    $event_query = "SELECT * FROM bus_schedule WHERE DATE(departure_time) = '$selected_date'";
    $event_array = mysqli_query($db, $event_query);
}

if(isset($_POST['select_date'])){
    $_SESSION['selected_date'] = $_POST['select_date'];
    $selected_date = $_POST['select_date'];
    $event_query = "SELECT * FROM bus_schedule WHERE DATE(departure_time) = '$selected_date'";
    $event_array = mysqli_query($db, $event_query);
}

if (isset($_POST['reset']) || isset($_SESSION['formDone']) || isset($_SESSION['error'])) {
    unset($_SESSION['bus_company']);
    unset($_SESSION['bus_id']);
    unset($_SESSION['arrival_time']);
    unset($_SESSION['departure_time']);
    unset($_SESSION['arrival_location']);
    unset($_SESSION['departure_location']);
    unset($_SESSION['seats']);
    unset($_SESSION['price']);
    unset($_SESSION['formstatus']);
    unset($_SESSION['formDone']);
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
    <link rel="stylesheet" href="admin-site.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
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
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="menu-items">
                    <a href="#">
                        <i class="uil uil-user-square"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="menu-items">
                    <a href="#">
                        <i class="uil uil-calender"></i>
                        <p>Bus Schedule</p>
                    </a>
                </li>
            </ul>
            <ul class="menu-2">
                <li class="menu-items">
                    <a href="../index/index.php">
                        <i class="uil uil-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="menu-items">
                    <a href="admin-site.php?logout='1'">
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
        <div class="contain">
           <div class="left">
                <div class="schedule">
                    <div class="month-year">
                        <i class="uil uil-angle-left" id = "prev"></i>       
                        <div class="date"></div>
                        <i class="uil uil-angle-right" id = "next"></i>
                    </div>
                    <div class="calendar">
                        <ul class="weekdays">
                            <li>SU</li>
                            <li>MO</li>
                            <li>TU</li>
                            <li>WE</li>
                            <li>TH</li>
                            <li>FR</li>
                            <li>SA</li>
                        </ul>
                        <form action="admin-site.php" method = "POST">
                            <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">
                            <div class="days"></div>
                        </form>
                    </div>
                </div>
                <div class="form-contain">
                    <div class="form-header">
                        Add Bus Schedule
                    </div>

                    <form action="admin-site.php" method="POST" class = "schedule-form firstF">
                        <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">
                        <select name="bus_company">
                            <option value="Agra Mas">Agra Mas</option>
                            <option value="Putra Jaya">Putra Jaya</option>
                            <option value="PT Sinar Jaya">PT Sinar Jaya</option>
                        </select>
                        <button type="submit" name="submitC">Submit</button>
                        <button type="submit" name="reset">Reset</button>
                    </form>

                    <form action="admin-site.php" method="POST" class="schedule-form secondF <?php echo isset($_SESSION['bus_company']) ? '' : 'hidden'; ?>">
                        <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">
                        <select name="bus_id">
                            <?php
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value=\"" . $row['bus_id'] . "\">" . $row['bus_id'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" name="submitID">Submit</button>
                        <button type="submit" name="reset">Reset</button>
                    </form>

                    <form action="admin-site.php" method="POST" class="schedule-form thirdF <?php echo isset($_SESSION['bus_id']) ? '' : 'hidden'; ?>">
                        <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">
                        <select name="departure_location" id="">
                            <option value="Jakarta">Jakarta</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Bandung">Bandung</option>
                        </select>
                        <select name="arrival_location" id="">
                            <option value="Jakarta">Jakarta</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Bandung">Bandung</option>
                        </select>
                        <input type="datetime-local" name="departure_time" id="" required>
                        <input type="datetime-local" name="arrival_time" id="" required>
                        <input type="number" name="seats" id="" placeholder="seats" required>
                        <input type="number" name="price" id="" placeholder="price" required>
                        <button type="submit" name="submitF">Submit</button>
                        <button type="submit" name="reset">Reset</button>
                    </form>

                    <form action="admin-site.php" method="POST" class = "schedule-form fourthF <?php echo isset($_SESSION['formstatus']) ? '' : 'hidden'; ?>">
                        <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">
                        <?php 
                        if(isset($_SESSION['formstatus'])){
                            echo "<p>". $_SESSION['bus_company']. "</p>".
                            "<p>". $_SESSION['bus_id']. "</p>".
                            "<p>". $_SESSION['arrival_time']. "</p>".
                            "<p>". $_SESSION['departure_time']. "</p>".
                            "<p>". $_SESSION['arrival_location']. "</p>".
                            "<p>". $_SESSION['departure_location']. "</p>".
                            "<p>". $_SESSION['seats']. "</p>".
                            "<p>". $_SESSION['price']. "</p>";
                        }
                        ?>
                        <button type="submit" name = "confirm">Confirm</button>
                        <button type="submit" name="reset">Reset</button>
                    </form>
                </div>
            </div>
            <div class="right">
                <div class="event-header">
                    <?php
                        $currentDate = new dateTime($_SESSION['selected_date']);
                        $currentDate = $currentDate->format("Y F j");
                        echo $currentDate;
                    ?>
                </div>
                <div class="event-list">
                    <?php 
                    if(isset($event_array)){
                        while($event_row = $event_array->fetch_assoc()){
                            $dTime = new dateTime($event_row["departure_time"]);
                            $departTime = $dTime->format('H:i');
                            $aTime = new dateTime($event_row["arrival_time"]);
                            $arriveTime = $aTime->format('H:i');

                            $duration = $dTime->diff($aTime);
                            $days = $duration->d;
                            $hours = $duration->h + ($days * 24);
                            $minute = $duration->format('%iM');
                            echo'
                            <div class="event-item">
                                <div class="x">
                                    <div class="event-title">
                                    '.$event_row["bus_company"]. " ".$event_row["bus_id"].'
                                    </div>
            
                                    <div class="event-time">
                                        <div class="d-time">'.$departTime.'(Yogyakarta)</div>
                                        <div class="icon">➔</div>
                                        <div class="a-time">'.$arriveTime.'(Surabaya)</div>
                                        '.$hours.'J '.$minute.'
                                    </div>
                                </div>
                                <div class="price">Rp.'.$event_row['price'].'</div>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="admin-site.js"></script>
    <script>
        // Alert if error message exist
        // Hide or show the forms based on session values
        var busCompanyForm = document.querySelector('.schedule-form.firstF'),
            busIdForm = document.querySelector('.schedule-form.secondF'),
            tlForm = document.querySelector('.schedule-form.thirdF'),
            confirmForm = document.querySelector('.schedule-form fourthF');

        if ('<?php echo isset($_SESSION['bus_company']); ?>' === '1') {
            busCompanyForm.style.display = 'none';
            busIdForm.style.display = 'block';
        }

        if ('<?php echo isset($_SESSION['bus_id']); ?>' === '1') {
            busCompanyForm.style.display = 'none';
            busIdForm.style.display = 'none';
            tlForm.style.display = 'block';
        }
        if ('<?php echo isset($_SESSION['formstatus']); ?>' === '1') {
            busCompanyForm.style.display = 'none';
            busIdForm.style.display = 'none';
            tlForm.style.display = 'none';
            confirmForm.style.display = 'block';
        }

    </script>
    
    <?php // If there's an error
    if (isset($_SESSION['error'])) { ?>
        <script>
            alert("<?php echo $_SESSION['error']; ?>");
            <?php unset($_SESSION['error']); ?>
        </script>
    <?php } ?>

    <?php 
    if (isset($_SESSION['errorAuthority'])) { ?>
        <script>
            alert("<?php echo $_SESSION['errorAuthority']; ?>");
            window.location.href = "../index/index.php";
            <?php unset($_SESSION['errorAuthority']); ?>
        </script>
    <?php } ?>
</body>
</html>