<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_USER','root');
define('DB_PASSWORD','');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());


function NewUser()
{	
	$email = $_POST['email'];
	$password =  $_POST['pass'];
	$epassword=md5($password);
	$query = "INSERT INTO admin (email,pass) VALUES ('$email','$epassword')";
	$data = mysql_query ($query)or die(mysql_error());
	if($data)
	{
	echo "YOUR REGISTRATION IS COMPLETED...";
	}
	session_start();
	$_SESSION["Email"] = $email;
	$_SESSION["login"] = 1;
	$query2 = mysql_query("SELECT *  FROM admin where email = '$_POST[email]' AND pass = '$epassword'") or die(mysql_error());
	$row = mysql_fetch_array($query2);
	$_SESSION["ID"]=$row['userID'];
	header("Location: https://localhost/adminpage.php");
}

function SignUp()
{
if(!empty($_POST['email']))
{
	$query = mysql_query("SELECT * FROM admin WHERE email = '$_POST[email]'") or die(mysql_error());

	if(!$row = mysql_fetch_array($query) or die(mysql_error()))
	{
		newuser();
	}
	else
	{
		echo "SORRY...YOU ARE ALREADY REGISTERED USER...";
	}
}
}
if(isset($_POST['submit']))
{
	SignUp();
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=  device-width, initial-scale=1">
	<title>Log-in/Sign-up</title>
	<link rel="stylesheet" type="text/css" href="./css/signup.css">
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/bootstrap-material-design.css">
  <link rel="stylesheet" type="text/css" href="./css/ripples.min.css">
	

  </head>
<body>
  
  <!-- NavBar -->
  <div class="navbar navbar-default navbar-fixed-top navtrans" style="background-color: grey;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://localhost/home.html">WD</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="https://localhost/home.html">Home&nbsp;&nbsp;</a></li>
            <li><a href="javascript:void(0)">Buy&nbsp;&nbsp;</a></li>
            <li><a href="https://localhost/register.php">Sell&nbsp;&nbsp;</a></li>
         </ul>
        </div>
      </div>
    </div>
    <!-- End NavBar -->

  <!-- container -->
  <div class="container">
    <div class="backbox">
      <div class="loginMsg">
        <div class="textcontent">
          <p class="title">Don't have an account?</p>
          <p>Sign up to sell your car.</p>
          <a id="switch1" class="btn btn-raised buttonn btn-success">Sign Up</a>
        </div>
      </div>
      <div class="signupMsg visibility">
        <div class="textcontent">
          <p class="title">Have an account?</p>
          <p>Log in to see all the information.</p>
          <a id="switch2" class="btn btn-raised buttonn btn-success">LOG IN</a>
        </div>
      </div>
    </div>
    <!-- backbox -->
    <!-- frontbox -->
    <form action="https://localhost/adminreg.php" method="post">
    <div class="frontbox">
      <div class="login">
        <h2>LOG IN</h2>
        <div class="inputbox">
          <input class="form-control" type="email" name="user" placeholder="  E-MAIL" id="login_email"> 
          <input class="form-control" type="password" name="pass" placeholder="  PASSWORD" id="login_password">
        </div>
        <p style="color: blue; font-size:15px;">FORGET PASSWORD?</p>
        <input type="submit" name="submit" id="login" class="btn btn-raised buttonn btn-primary" value="Login">
      </div>
    </form>
    <form action="http://localhost/adminreg.php" method="post">
      <div class="signup hide">
        <h2>SIGN UP</h2>
        <div class="inputbox">
          <input type="email" name="email" placeholder="  E-MAIL" class="form-control" id="signup_email">
          <input type="password" name="pass" placeholder="  PASSWORD" class="form-control" id="signup_password">
          <input type="password" name="cpass" placeholder="  CONFIRM PASSWORD" class="form-control" id="signup_confirm_password">
          <p id="validate-status"></p>
        </div>
        <input type="submit" name="submit" id="signup" class="btn btn-raised buttonn btn-primary" value="SignUp">
      </div>
    </form>
    </div>
    <!-- frontbox -->
  </div>
  <!-- container -->



  <!-- scripts -->
	<script src="./js/jquery.min.js"></script>
  <script src="./js/material.min.js"></script>
  <script src="./js/ripples.min.js"></script>
  <script src="./js/ripplesinit.js"></script>
  <SCRIPT src="./js//validatelog.js"></SCRIPT>
  <script src="./js/signup.js"></script>

</body>
</html>