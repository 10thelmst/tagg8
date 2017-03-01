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

	Moderator | Reply

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

   

</head>


<?php
$tbl_name="fanswer"; // Table name

 
// Get value of id that sent from hidden field
$id=$_POST['id'];
 
// Find highest answer number.
$sql="SELECT MAX(a_id) AS Maxa_id FROM $tbl_name WHERE question_id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
 
// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1
if ($rows) {
$Max_id = $rows['Maxa_id']+1;
}
else {
$Max_id = 1;
}
 
// get values that sent from form
$a_name=$_POST['a_name'];
$a_email=$_POST['a_email'];
$a_answer=$_POST['a_answer'];
 
$datetime=date("d/m/y H:i:s"); // create date and time
 
// Insert answer
$sql2="INSERT INTO $tbl_name(question_id, a_id, a_name, a_email, a_answer, a_datetime)VALUES('$id', '$Max_id', '$a_name', '$a_email', '$a_answer', '$datetime')";
$result2=mysql_query($sql2);
 
if($result2){
echo "<div class='successmessage'>";
echo "Successful<BR>";
echo "<p class='view'><a href='moderator_view_topic.php?id=".$id."'>View your answer</a></p>";
echo  "</div>";
 
// If added new answer, add value +1 in reply column
$tbl_name2="fquestions";
$sql3="UPDATE $tbl_name2 SET reply='$Max_id' WHERE id='$id'";
$result3=mysql_query($sql3);
}
else {
echo "ERROR";
}
 
// Close connection
mysql_close();
?>
</div>

</body>
</html>