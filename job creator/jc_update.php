<?php
session_start(); 

$error = false;
if(count($_POST)>0) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) 
	
	if (!preg_match("/^[a-zA-Z ]+$/",$_POST['jc_fname'])) {
		$error = true;
		$message = "Name must contain only alphabets and space";
	}
	
	if (!preg_match("/^[a-zA-Z ]+$/",$_POST['jc_lname'])) {
		$error = true;
		$message = "Name must contain only alphabets and space";
	}
	
	/* Password Matching Validation */
	if($_POST['jc_password'] != $_POST['jc_confirm_password']){ 
		$error = true;
		$message = 'Passwords should be same<br>'; 
	}
	
	if(strlen($_POST['jc_password'])< 6){
		$error = true;
		$message = 'Password must contain at least 6 characters<br>'; 	
	}

	/* Email Validation */
	if(!isset($message)) {
		if (!filter_var($_POST["jc_email"], FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$message = "Invalid UserEmail";
		}
	}

	if(!isset($message)) {
		if(!isset($_POST["jc_gender"])) {
			$error = true;
			$message = " Gender field is required";
		}
	}
	
	if(!isset($message)) {
		if (!isset($_POST['update'])) {
			$error = true;	
			$message = "Profile updated successfully";	
		
		} 
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Job Creator | Update Profile</title>
<style type="text/css" media="all">
body {
background-image:url('bg_gray.png');}
.form{border-radius: 10px 10px 10px 10px;}
</style>

</head>
<?php

require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';

if (isset($_POST['update'])) {
$id = $_POST['tid'];
$fname = $_POST['jc_fname'];
$lname = $_POST['jc_lname'];
$jc_nickname = $_POST['jc_nickname'];
$email = $_POST['jc_email'];
$password = $_POST['jc_password'];
$organization = $_POST['jc_organization'];
$gender = $_POST['jc_gender'];
$DOB = $_POST['dateofbirth'];


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

		
$query = mysql_query("update jc_user set
fname='$fname', lname='$lname', jc_nickname='$jc_nickname', email='$email', password='$password',
organization='$organization', DOB='$DOB', gender='$gender', age= '$age' where jc_id='$id'");


}


if (isset($_POST['jc_id']) && $_POST['jc_id'] != "") {
		$jc_id = $POST['jc_id'];
	} else {
		$jc_id = $_SESSION['jc_id'];
	}

$query = mysql_query("SELECT * FROM jc_user where jc_id = $jc_id");
while($row = mysql_fetch_array( $query )) {



?>	
	
<br>
			
			
			<form  id="contactform" name="frmRegistration" method="POST" action="" class="form">
			<div class="registermessage"><?php if(isset($message)) echo $message; ?></div>
			
			<input type="hidden" name="tid" value="<?php echo $row['jc_id']; ?>"/>
			
			<p class="contact"><label for="name">Name</label></p>	
			<input type="" class="fullname" name="jc_fname" placeholder="" required="" value="<?php echo  $row['fname']?>">
			<input type="" class="fullname" name="jc_lname" placeholder="" required="" value="<?php echo  $row['lname']?>">
			<input type="" class="fullname" name="jc_nickname" placeholder="" required="" value="<?php echo  $row['jc_nickname']?>">
		
			<p class="contact"><label for="email">Email</label></p>
			<input type="text" name="jc_email" placeholder="" required="" tabindex="1" value="<?php echo  $row['email']?>">
			
			<p class="contact"><label for="password">Password</label></p>
			<input type="password" name="jc_password" placeholder="" required="" tabindex="1" value="<?php echo  $row['password']?>">
			
			<p class="contact"><label for="confirmpassword">Confirm Password</label></p>
			<input type="password"  name="jc_confirm_password" placeholder="" required="" tabindex="1" value="<?php echo  $row['password']?>">
			
			
			<p class="contact"><label>Birthday</label></p>
			<input class="year" name="dateofbirth" placeholder="yyyy-mm-dd" required="" value="<?php echo $row['DOB']; ?>">
			
			
			<p class="contact"><label for="organization">Occupation</label></p>
			<input type="text" name="jc_organization" required="" tabindex="1" value="<?php echo  $row['organization']?>">
			
			<p class="contact"><label for="gender">Gender</label></p>
			<input type="radio" name="jc_gender" value="Male" <?php if($row['gender'] && $row['gender']=="Male") { ?>checked<?php } ?>> Male
			<input type="radio" name="jc_gender" value="Female" <?php if($row['gender'] && $row['gender']=="Female") { ?>checked<?php } ?>> Female
			
			
			<br><br>
			
			<input class="buttom" name="update" id="update" tabindex="5" value="Save" type="submit" >
			
			</form>
		</div>
		
<?php		

}


mysql_close();
?>
</body>
</html>