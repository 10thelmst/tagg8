<?php
 
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'moderator_header.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>

	Moderator | Post

</title>
<style type="text/css" media="all">
body {
background-image:url('bg_gray.png');}
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
.successmessage{
	
	position: relative; 
	font-family: 'Alegreya SC', Georgia, serif;
	font-size: 40px;
	margin: 30px auto;
	margin-left:500px;
	border-top:2px solid ;
	border-bottom:2px solid ;
	border-left:2px solid ;
	border-right:2px solid ;
	border-color:#43ABC9;
	padding-left:30px; 
	padding-top:20px;
	padding-right:20px; 
	padding-bottom:20px;
	width: 230px;
	background-color: #eeeeee;
	border-radius: 10px 10px 10px 10px;
	color:#1287A8;
}

.view a{color: blue;
	font-size: 16px;  
	font-family:Arial, Helvetica;}
.view a:hover{color: blue;text-decoration:underline;}
</style>
		

<?php
 

$tbl_name="fquestions"; // Table name
 

 
// get data that sent from form
$topic=$_POST['topic'];
$detail=$_POST['detail'];
$name=$_POST['name'];
$email=$_POST['email'];
 
$datetime=date("d/m/y h:i:s"); //create date time
 
$sql="INSERT INTO $tbl_name(topic, detail, name, email, datetime)VALUES('$topic', '$detail', '$name', '$email', '$datetime')";
$result=mysql_query($sql);
 
if($result){
	echo "<div class='successmessage'>";
	echo "Successful<BR>";
	echo "<p class='view'><a href=moderator_main_forum.php>View your topic</a></p>";
	echo  "</div>";
}
else {
echo "ERROR";
}
mysql_close();
?>

</div>

</body>
</html>