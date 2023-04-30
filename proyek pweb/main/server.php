<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$phone    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $users = mysqli_fetch_assoc($result);
  
  if ($users) { // if user exists
    if ($users['username'] === $username) {
      array_push($errors, "Username already exists");
    }
    if ($users['email'] === $email) {
      array_push($errors, "Email already exists");
    }
    if ($users['phone'] === $phone) {
      array_push($errors, "Phone Number already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password, phone) 
  			  VALUES('$username', '$email', '$password', '$phone')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
if(isset($_POST['change_pass'])){
  // receive all input value from change-pass form
  $oldPass = md5($_POST['oldPass']);
  $newPass_1 = md5($_POST['newPass_1']);
  $newPass_2 = md5($_POST['newPass_2']);
  $oldPassDB = $_SESSION['password'];
  $username = $_SESSION['username'];
  // validate that the input are corrects
  if (empty($oldPass)) { array_push($errors, "Old Pass is required"); }
  if (empty($newPass_1)) { array_push($errors, "New Pass is required"); }
  if ($newPass_1 != $newPass_2) {
  array_push($errors, "The two passwords do not match");
  }
  if($oldPass != $oldPassDB){
    array_push($errors, "Old password is incorrect");
  }
  
  if (count($errors) == 0) {
    $querychange = "UPDATE `users` SET `password` = '$newPass_1' WHERE `username` = '$username'";
    header('location: ../index.php');
    $resultupdate = mysqli_query($db, $querychange);
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  // Initialize variable for schedule.php
  $today = date("Y-m-d");
  $_SESSION['current_date'] = $today;
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
    $rs = mysqli_fetch_array($results);
  	if (mysqli_num_rows($results) == 1) {
      $phone = $rs['phone'];
      $email = $rs['email'];
  	  $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      $_SESSION['phone'] = $phone;
      $_SESSION['password'] = $password;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: home.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

// SCHEDULE
$filename = basename($_SERVER['PHP_SELF']);
if($filename == "schedule.php"){
  
  //initialize variable
  $bus_id = "";
  $sd_time ="";
  $sa_time ="";

  if($_SESSION['current_date'] == 0){
      $_SESSION['current_date'] = $today;
  }
 // IF ADD BUS SCHEDULE
  if(isset($_POST['add_schedule'])){
    $bus_id = $_POST['bus_id'];
    $bus_company = $_POST['bus_company'];
    $from_city = $_POST['from_city'];
    $to_city = $_POST['to_city'];
    $d_time = $_POST['d_time'];
    $a_time = $_POST['a_time'];
    $total_seat = $_POST['total_seat'];
    $selected_date = $d_time;
    // INITIALIZE VARIABLE TO CHECK IF THE BUS IS CURRENTLY AVAILABLE
    $check_date = date($d_time);

    // CHECK IF THE FORM IS FILLED CORRECTLY
    if (empty($bus_id || $bus_company || $from_city || $to_city || $d_time || $a_time || $total_seat)) {
      array_push($errors, "Form is not Filled Correctly");
    }
    // IF THE FORM IS FILLED CORRECTLY ->
    else{
      // CHECK DATABASE TO MAKE SURE
      // THE BUS IS AVAILABLE
      $bus_check_query = mysqli_query($db, "SELECT * FROM bus_schedule WHERE bus_id = '$bus_id' AND date(d_time) = '$check_date'");
      while($bus_check_array = mysqli_fetch_array($bus_check_query)){
        //CONVERT DATE AND TIME TO SECONDS USING STRTOTIME
        //IF THE WANTED TO ADD BUS SCHEDULE DEPARTURE TIME IS IN BETWEEN EXISTED BUS SCHEDULE DEPARTURE TIME AND ARRIVED TIME -> BUS IS NOT AVAILABLE
        //IF (CHECK_TIME >= DEPARTURE_TIME AND CHECK_TIME <= ARRIVE_TIME){ BUS IS NOT AVAILABLE;}
        $check_d_time = strtotime($bus_check_array['d_time']);
        $check_a_time = strtotime($bus_check_array['a_time']);
        $d_time = strtotime($d_time);
        if($d_time >= $check_d_time && $d_time <= $check_a_time){
          array_push($errors, "BUS CURRENCTLY UNAVAILABLE");
          break;
        }
      }

      // $sQuery = mysqli_query($db, "SELECT * FROM bus_schedule WHERE ")
      // FINALLY ADD THE BUS SCHEDULE TO DATABASE
      if(count($errors) == 0){
        $addbus = "INSERT INTO bus_schedule (bus_id, bus_company, from_city, 
                to_city, d_time, a_time, seat) 
                VALUES ('$bus_id', '$bus_company', '$from_city', 
                '$to_city', '$d_time', '$a_time', '$total_seat')";
        mysqli_query($db, $addbus);
      }
    }
  }
  if(isset($_POST['search'])){
      $_SESSION['current_date'] = $_POST['search_date'];
  }
  if(isset($_POST['left'])){
      $_SESSION['current_date'] = date("Y-m-d", strtotime("-1 month", strtotime($_SESSION['current_date'])));
  }
  if(isset($_POST['right'])){
      $_SESSION['current_date'] = date("Y-m-d", strtotime("+1 month", strtotime($_SESSION['current_date'])));
  }
  if(isset($_POST['selected'])){
      // Convert current date from Y-m-d to Y-m
      $_SESSION['current_date'] = date("Y-m", strtotime($_SESSION['current_date']));

      // Get the value of selected button
      $selected = $_POST['selected'];

      // Convert format second to day
      $selected = $selected * 86400; //1 day = 86400seconds
      //1ST DAY = 0, 2ND DAY = 86400, 3RD DAY = 172800 -> THEREFORE SUBSTRACT SELECTED BY 86400
      $selected = $selected - 86400;

      //Add value of selected to session_current_date
      $_SESSION['current_date'] = strtotime($_SESSION['current_date']);
      $_SESSION['current_date'] = $_SESSION['current_date'] + $selected;

      //convert it to Y-m-d value
      $_SESSION['current_date'] = date("Y-m-d", $_SESSION['current_date']);
  }
  $tdbm = strtotime($_SESSION['current_date']);
  $tdbm = date("Y-m", $tdbm);
  $tdcm = date("t", strtotime($tdbm));
  $tdbm = date("N", strtotime($tdbm));
  $tdam = 42 - $tdbm - $tdcm;
  $contain = $_SESSION['current_date'];
  $tquery = mysqli_query($db, "SELECT * FROM bus_schedule WHERE date(d_time) ='$contain'");
}


// SEARCH BUS
if(isset($_POST['search_bus'])){
  $sFrom_city = $_POST['sFrom_city'];
  $sTo_city = $_POST['sTo_city'];
  $search_date = $_POST['search_date'];
  if (empty($sFrom_city || $sTo_city || $search_date)) {
  	array_push($errors, "Form is not filled correctly");
  }
}
?>