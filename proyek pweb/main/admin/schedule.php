<?php include('../server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/schedule.css">
    <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" 
    />
    <style>
        .SPxY{
            width: 100%;
            height: 100%;
            cursor: pointer;
            background-color: #fff;
            border: none;
        }
        .SPxY:hover{
            background-color: aqua;
        }
    </style>
    <title>Calendar</title>
</head>
<body>
    <div class="formcontainer">
        <a href="admin.php">test</a>
        <div class="text">ADD SCHEDULE</div>
        <form action ="schedule.php" method = "POST" class="inputlist">
            <?php include('../errors.php'); ?>
            <div class="inputchange">
                <label>Bus ID</label>
                <input type="text" name="bus_id">
            </div>
            <div class="inputchange">
                <label>Bus Company Name</label>
                <input type="text" name="bus_company">
            </div>
            <div class="inputchange">
                <label>From</label>
                <input type="text" name="from_city">
            </div>
            <div class="inputchange">
                <label>To</label>
                <input type="text" name="to_city">
            </div>
            <div class="inputchange">
                <label>Departure Date and Time</label>
                <input type="datetime-local" name="d_time">
            </div>
            <div class="inputchange">
                <label>Estimated Time Arrived</label>
                <input type="datetime-local" name="a_time">
            </div>
            <div class="inputchange">
                <label>Available Seat</label>
                <input type="number" name="total_seat">
            </div>
            <div class="btn">
                <button type="submit" name ="add_schedule">ADD SCHEDULE</button>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="left">
            <div class="calendar">
                <form action="schedule.php" method="POST" class = "month">
                    <button type = "submit" name = "left" class="hide"><i class = "fa fa-angle-left prev"></i></button>
                    <div class="date"><?php echo date("F Y", strtotime($_SESSION['current_date']))?></div>
                    <button type = "submit" name = "right" class="hide"><i class = "fa fa-angle-right prev"></i></button>
                </form> 
                <div class="weekdays">
                    <div>sun</div>
                    <div>mon</div>
                    <div>tue</div>
                    <div>wed</div>
                    <div>thu</div>
                    <div>fri</div>
                    <div>sat</div>
                </div>
                <form action="schedule.php" method = "POST" class="days">
                   <!-- ADD DAYS WITH PHP -->
                   <!-- BEFORE ACTIVE MONTH DAYS -->
                   <?php
                    for($day = 31-$tdbm+1; $day <= 31; $day++){
                        ?>
                        <div class="day prev-date"><?php echo $day?></div>
                        <?php
                    }
                    ?>
                   <!-- ACTIVE MONTH DAYS -->
                   <?php
                    for($day = 1; $day <= $tdcm; $day++){
                        ?>
                        <div class="day">
                            <button type="submit" name = "selected" value ="<?php echo "$day"?>" class ="SPxY"><?php echo $day?></button>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- AFTER ACTIVE MONTH DAYS -->
                    <?php
                    for($day = 1; $day <= $tdam; $day++){
                        ?>
                        <div class="day next-date"><?php echo $day?></div>
                        <?php
                    }
                    ?>
                </form>
                <div class="goto-today">
                    <div class="goto">
                        <form action="schedule.php" method ="POST">
                            <input type="date" name="search_date" placeholder="mm/yyyy" class="date-input">
                            <button type = "submit" name = "search" class="goto-btn">go</button>
                        </form>
                    </div>
                    <button class="today-btn">today</button>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="today-date">
                <div class="event-day">
                    <?php echo date("D", strtotime($_SESSION['current_date']))?>
                </div>
                <div class="event-date">
                    <?php echo date("d F Y", strtotime($_SESSION['current_date']))?>
                </div>
            </div>
            <div class="events">
                <?php   while($tarray = mysqli_fetch_array($tquery)){
                    $bus_id = $tarray['bus_id'];
                    $sd_time = $tarray['d_time'];
                    $sa_time = $tarray['a_time'];
                    ?>
                <div class="event">
                    <div class="title">
                        <i class="fas fa-circle"></i>
                        <h3 class="event-title"><?php echo $bus_id?></h3>
                    </div>
                    <div class="event-time">
                        <?php echo $sd_time, " - ", $sa_time?>
                    </div>
                </div>      
                <?php
                }?>
            </div>
        </div>
    </div>
</body>
</html>