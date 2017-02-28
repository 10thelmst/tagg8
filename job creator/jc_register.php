<?php

require_once("dbcontroller.php");
$db_handle = new DBController();

$error = false;
if(count($_POST)>0) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) 
	
	if (!preg_match("/^[a-zA-Z ]+$/",$_POST['fname'])) {
		$error = true;
		$message = "Name must contain only alphabets and space";
	}
	
	if (!preg_match("/^[a-zA-Z ]+$/",$_POST['lname'])) {
		$error = true;
		$message = "Name must contain only alphabets and space";
	}
	
	if(!isset($message)) {
		if(isset($_POST['jc_nickname'])){
			$jc_nickname=$_POST['jc_nickname'];
			$result= mysql_query("SELECT jc_nickname FROM jc_user WHERE jc_nickname= '$jc_nickname'");
			$row = mysql_fetch_assoc($result);
			if(strtolower($jc_nickname)==strtolower($row['jc_nickname'])){
			$error = true;
			$message = "Nickname Already Exist";
			}
		}
	}
	
	/* Password Matching Validation */
	if($_POST['password'] != $_POST['confirm_password']){ 
		$error = true;
		$message = 'Passwords should be same<br>'; 
	}
	
	if(strlen($_POST['password'])< 6){
		$error = true;
		$message = 'Password must contain at least 6 characters<br>'; 	
	}

	/* Email Validation */
	if(!isset($message)) {
		if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$message = "Invalid UserEmail";
		}
	}
		
		if(!isset($message)) {
		if(isset($_POST['userEmail'])){
			$email=$_POST['userEmail'];
			$result= mysql_query("SELECT email FROM jc_user WHERE email= '$email'");
			$row = mysql_fetch_assoc($result);
			if(strtolower($email)==strtolower($row['email'])){
			$error = true;
			$message = "Email Already Exist";
			}
		}
	}
	

	/* Validation to check if gender is selected */
	if(!isset($message)) {
		if(!isset($_POST["gender"])) {
			$error = true;
			$message = " Gender field is required";
		}
	}


	if(!isset($message)) {
		

		$DOB = $_POST['BirthYear'] . '-' . $_POST['BirthMonth'] . '-' . $_POST['BirthDay'];
		function GetAge($DOB) { 
			$DOB=explode("-",$DOB); 
			$curMonth = date("m");
			$curDay = date("j");
			$curYear = date("Y");
			$age = $curYear - $DOB[0]; 
			if($curMonth<$DOB[1] || ($curMonth==$DOB[1] && $curDay<$DOB[2])) 
            $age--; 
			return $age; 
			}
			$age = GetAge($DOB);

		$query = "INSERT INTO jc_user (jc_nickname,fname, lname, email, password, DOB, organization, gender, age) VALUES
		('" . $_POST["jc_nickname"] . "', '" . $_POST["fname"] . "', '" . $_POST["lname"] . "', '" . $_POST["userEmail"] . "', '" .($_POST["password"]) . "', '" . $DOB . "', '" . $_POST["userOrganization"] . "', '" . $_POST["gender"] . "', '" . $age . "')";
		
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$message = "You have registered successfully!";	
			unset($_POST);
		} else {
			$message = "Problem in registration. Try Again!";	
		}
	}
}

?>

<html>
<head>

<title>Job Creator | Signup</title>
<style type="text/css" media="all">
body {
background-image:url('bg_gray.png');}
.form{border-radius: 10px 10px 10px 10px;}
</style>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
	
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link href="css/demo.css" type="text/css" rel="stylesheet" />

</head>

<body>
<div class="container">

            <div class="freshdesignweb-top">
                <a href="../index.php" style="margin-left:15px;">Home</a>
                <span class="right"></span>
                <div class="clr"></div>
            </div>
			<header>
			<h1>
			<span>Job Creator</span>
			Registration Form
			</h1>
			</header>
			
			<form  id="contactform" name="frmRegistration" method="post" action="" class="form">
			<div class="registermessage"><?php if(isset($message)) echo $message; ?></div>
			
		
			<p class="contact"><label for="name">Name</label></p>	
			<input type="" class="fullname" name="fname" placeholder="First Name" required="" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
			<input type="" class="fullname" name="lname" placeholder="Last Name" required="" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>">
			<input type="" class="" name="jc_nickname" placeholder="Nickname" required="" value="<?php if(isset($_POST['jc_nickname'])) echo $_POST['jc_nickname']; ?>">
			
			
		
			<p class="contact"><label for="email">Email</label></p>
			<input type="text" name="userEmail" placeholder="example@domain.com" required="" tabindex="1" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>">
			
			<p class="contact"><label for="password">Password</label></p>
			<input type="password" name="password" placeholder="Password" required="" tabindex="1" value="">
			
			<p class="contact"><label for="confirmpassword">Confirm Password</label></p>
			<input type="password"  name="confirm_password" placeholder="********" required="" tabindex="1" value="">
			
			<fieldset>
			<label>Birthday</label>
			<label class="month" required="">
			<select class="select-style" name="BirthMonth" >
			<option value="">Month</option>
			<option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
			</label>
			</select>
			
			<label class="day" required=""> 
            <select class="select-style" name="BirthDay" >
            <option value="">Day</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31" >31</option>
			</label>
            </select>
			
			<label><input class="year" maxlength="4" name="BirthYear" placeholder="0000" required=""></label>
			</fieldset>
			
			<p class="contact"><label for="occupation">Organization</label></p>
			<input type="text" name="userOrganization" required="" tabindex="1" value="<?php if(isset($_POST['userOrganization'])) echo $_POST['userOrganization']; ?>">
			
			<p class="contact"><label for="gender">Gender</label></p>
			<input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?>> Male
			<input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?>> Female
			
			<br><br>
			
			<input class="buttom" name="signup" id="submit" tabindex="5" value="Sign me up!" type="submit" >
			
			</form>
			
		</div>
		
	</body>
	
</html>