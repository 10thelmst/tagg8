<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';

if (isset($_GET['jc_id']) && $_GET['jc_id'] != "") {
		$jc_id = $_GET['jc_id'];
	} else {
		$jc_id = $_SESSION['jc_id'];
	}
$query = mysql_query("SELECT * FROM jc_user where jc_id = $jc_id")or die(mysql_error());
while($row = mysql_fetch_array( $query )) {
?>

<html>
<head>
<title>Job Creator | Profile</title>
<style type="text/css" media="all">
body {
background-image:url('bg_gray.png');}
.color{
	color:#009999;
}
.ADashboard{
margin: 30px auto;
width: 90%;
 border: 0px solid #333333;
 background-color: #eeeeee;
  padding-top:10px;
 border-radius: 20px 20px 20px 20px;
}
.freshdesignweb-top{
	line-height: 30px;
	font-size: 11px;
	text-transform: uppercase;
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
	list-style: none;
	padding: 0;
	margin: 0;
	background: rgba(0, 0, 0, 0.10);
	border-top: solid 2px #fff;
	border-bottom: solid 2px #fff;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
 
}
</style>


</head>
<body>
			
			<div class="ADashboard">			
			<a class="prof">
			<span style="color:#3399FF;">Profile information</span>
			<hr>
			
			Nickname: <span class="color"><?php echo $row['jc_nickname'];?> </span>
			<br>
			<br>
			Fullname: <span class="color"><?php echo $row['fname'];?> <?php echo $row['lname'];?></span>
			<br>
			<br>
			Organizatin: <span class="color"><?php echo $row['organization'];?></span>  
			<br>
			<br>
			Email: <span class="color"><?php echo $row['email'];?></span>
			<br>
			<br>
			Date of Birth: <span class="color"><?php echo $row['DOB'];?></span>
			<br>
			<br>
			Age: <span class="color"><?php echo $row['age'];?></span>
			<br>
			<br>
			Gender: <span class="color"><?php echo $row['gender'];?></span>
			<br>  
			<br>  
			<br>  
			 
			<a/>
			
				<a href="jc_update.php?jc_id=<?php echo $row['jc_id']; ?>">
				<div class="form">
				<input class="buttom" name="edit" id="submit" tabindex="5" value="Edit Profile Information" type="submit"> 
				<a/>
			
				</div>

			</div>    
</div>
<?php //  close  while  loop 
} 
?>

</body>
</html>
