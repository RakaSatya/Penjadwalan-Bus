<?php include('../server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="../home.php">homepage</a>
    <?php 
      if(count($errors) == 0){
        $sQuery = mysqli_query($db, "SELECT * FROM bus_schedule WHERE from_city = '$sFrom_city' AND to_city = '$sTo_city' AND date(d_time) = '$search_date'");
        while($row = mysqli_fetch_array($sQuery)){
          $d_time = strtotime($row['d_time']);
          $a_time = strtotime($row['a_time']);
          $d_s = $a_time - $d_time;
          $d_h = $d_s % 3600;
          $d_m = $d_h;
          $d_h = $d_s - $d_h;
          $d_h = $d_h / 3600;
          $d_m = $d_m / 60;
          echo $row['bus_id'];
          echo "<br>";
          echo $row['bus_company'];
          echo "<br>";
          echo $row['from_city'];
          echo "<br>";
          echo $row['to_city'];
          echo "<br>";
          echo date("h:i a m/d/Y l", $d_time);
          echo "<br>";
          echo date("h:i a m/d/Y l", $a_time);
          echo "<br>";
          echo "Duration = $d_h Hour $d_m Minutes";
          echo "<br>";
          echo $row['seat'];
          echo "<br>";
        }
      }
    ?>
</body>
</html>