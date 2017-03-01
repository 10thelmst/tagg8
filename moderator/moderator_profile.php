<?php
session_start();

require_once("dbcontroller.php");
$db_handle = new DBController();
include 'moderator_header.php';

if (isset($_GET['moderator_id']) && $_GET['moderator_id'] != "") {
		$moderator_id = $_GET['moderator_id'];
	} else {
		$moderator_id  = $_SESSION['moderator_id'];
	}
$query = mysql_query("SELECT * FROM moderator_user where moderator_id = $moderator_id")or die(mysql_error());
while($row = mysql_fetch_array( $query )) {
?>

<html>
<head>
<title> Moderator | Profile </title>
  <style type="text/css" medial="all">

body {
background-image:url('bg_gray.png');}

.proff {
	font-family: 'Alegreya SC', Georgia, serif;
	font-size: 20px;
	line-height: 20px;
	display: block;
	font-weight: 400;
	font-style: normal;
	color: #719dab;
	margin:10px;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.1);
}
.ADashboards {
margin: 30px auto;
width: 90%;
 border: 0px solid #333333;
 background-color: #eeeeee;
 padding-top:10px;
 border-radius: 20px 20px 20px 20px;
}

.color{
	color:#009999;
}


</style>
    
</head>

			
			<div class="ADashboards">			
			<a class="proff">
			<span style="color:#3399FF;">Profile information</span>
			<hr>
			
			Name: <span class="color"><?php echo $row['fname'];?> <?php echo $row['lname'];?></span>
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
			
				<a href="moderator_update.php?moderator_id=<?php echo $row['moderator_id']; ?>">
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
