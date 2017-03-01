<?php
session_start(); 
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'moderator_header.php';

$error = false;
if(count($_POST)>0) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) 
	
	if (!preg_match("/^[a-zA-Z ]+$/",$_POST['moderator_fname'])) {
		$error = true;
		$message = "Name must contain only alphabets and space";
	}
	
	if (!preg_match("/^[a-zA-Z ]+$/",$_POST['moderator_lname'])) {
		$error = true;
		$message = "Name must contain only alphabets and space";
	}
	
	/* Password Matching Validation */
	if($_POST['moderator_password'] != $_POST['moderator_confirm_password']){ 
		$error = true;
		$message = 'Passwords should be same<br>'; 
	}
	
	if(strlen($_POST['moderator_password'])< 6){
		$error = true;
		$message = 'Password must contain at least 6 characters<br>'; 	
	}

	/* Email Validation */
	if(!isset($message)) {
		if (!filter_var($_POST["moderator_email"], FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$message = "Invalid UserEmail";
		}
	}

	if(!isset($message)) {
		if(!isset($_POST["moderator_gender"])) {
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
<title>Moderator | Update Profile </title>
  <style type="text/css" medial="all">

body {
background-image:url('bg_gray.png');}
</style>

</head>
<?php



if (isset($_POST['update'])) {
$id = $_POST['mid'];
$fname = $_POST['moderator_fname'];
$lname = $_POST['moderator_lname'];
$email = $_POST['moderator_email'];
$password = $_POST['moderator_password'];
$gender = $_POST['moderator_gender'];
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

		
$query = mysql_query("update moderator_user set
fname='$fname', lname='$lname', email='$email', password='$password',DOB='$DOB', gender='$gender', age= '$age' where moderator_id='$id'");


}


if (isset($_POST['moderator_id']) && $_POST['moderator_id'] != "") {
		$moderator_id = $POST['moderator_id'];
	} else {
		$moderator_id = $_SESSION['moderator_id'];
	}

$query = mysql_query("SELECT * FROM moderator_user where moderator_id = $moderator_id");
while($row = mysql_fetch_array( $query )) {



?>	
	

			
			<form  id="contactform" name="frmRegistration" method="POST" action="" class="form">
			<div class="registermessage"><?php if(isset($message)) echo $message; ?></div>
			
			<input type="hidden" name="mid" value="<?php echo $row['moderator_id']; ?>"/>
			
			<p class="contact"><label for="name">Name</label></p>	
			<input type="" class="fullname" name="moderator_fname" placeholder="" required="" value="<?php echo  $row['fname']?>">
			<input type="" class="fullname" name="moderator_lname" placeholder="" required="" value="<?php echo  $row['lname']?>">
		
		
			<p class="contact"><label for="email">Email</label></p>
			<input type="text" name="moderator_email" placeholder="" required="" tabindex="1" value="<?php echo  $row['email']?>">
			
			<p class="contact"><label for="password">Password</label></p>
			<input type="password" name="moderator_password" placeholder="" required="" tabindex="1" value="<?php echo  $row['password']?>">
			
			<p class="contact"><label for="confirmpassword">Confirm Password</label></p>
			<input type="password"  name="moderator_confirm_password" placeholder="" required="" tabindex="1" value="<?php echo  $row['password']?>">
			
			
			<p class="contact"><label>Birthday</label></p>
			<input class="year" name="dateofbirth" placeholder="yyyy-mm-dd" required="" value="<?php echo $row['DOB']; ?>">
			
			<p class="contact"><label for="gender">Gender</label></p>
			<input type="radio" name="moderator_gender" value="Male" <?php if($row['gender'] && $row['gender']=="Male") { ?>checked<?php } ?>> Male
			<input type="radio" name="moderator_gender" value="Female" <?php if($row['gender'] && $row['gender']=="Female") { ?>checked<?php } ?>> Female
			
			
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