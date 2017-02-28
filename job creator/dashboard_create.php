
<?php
//session_start();
//filename:dashboard_create.php


session_start();

require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';
$Valmin = 20;
if (isset($_GET['jc_id']) && $_GET['jc_id'] != "") {
		$jc_id = $_GET['jc_id'];
	} else {
		$jc_id = $_SESSION['jc_id'];
	}
$query = mysql_query("SELECT * FROM jc_user where jc_id = $jc_id")or die(mysql_error());
while($row = mysql_fetch_array( $query )) {
	
}


?>

<!DOCTYPE html>
<html>
<head>
<title>

	Jobcreator | Dashboard <?php echo "$jc_id";?>

</title>

<style type='text/css'>

#title {
	margin-top : 20px;
	margin-left : 60px;
	border : 4px solid #39C;
	width :1000px;
	border-radius : 8px;
	background-color : #ffffff;
	
	font-size : 20pt;
	height : 40px;
		}

#min {
	margin-top : 20px;
	margin-left : 60px;
	border : 4px solid #39C;
	width :250px;
	border-radius : 8px;
	background-color : #ffffff;
	
	font-size : 15pt;
	height : 40px;
		}


#Submit{
	
	width : 150px ;
	color : #ffffff;
	background-color : #33CCCC;
	margin-top : 10px;	
	margin-left : 70px;
	font-size : 20pt;
	border : 4px solid #33CCCC; 
	border-radius : 15px;
	padding-button : 10px;
}
#mini {
	margin-left : 30px;
	border : 4px solid #33CCCC; 
}
</style>


</head>
			
		<div class="ADashboard">	
			
		<div class='dashmenu'>
				<a href= "Jc_dashboard.php" class="color red button" disabled><img src="images/jcdash.gif" alt="jc dashboard" ></a> | 
				<a href= "jc_dashboard_tweetlist.php" class="color red button" disabled><img src="images/jcup.gif" alt="jc upload" ></a> | 
				<a href= "Jc_dashboard_uploaded.php" class="color red button" disabled><img src="images/jccreate.gif" alt="jc dashboard" ></a> | 
				<a href= "jc_ongoing.php" class="color red button" disabled><img src="images/jcongoing.gif" alt="jc dashboard" ></a> | 
				<a href= "finishjob.php" class="color red button" disabled><img src="images/jcfin.gif" alt="jc dashboard" ></a> | 
				<a href= "dashboard_cancel.php" class="color red button" disabled><img src="images/jccancel.gif" alt="jc dashboard" ></a>
				</div>
			<!------------->
				<div class="MainWrapper">
						<br>
						

<?php

$_SESSION["uploadedtweetID"] = $_GET["JCULID"];
$uploaded_ID = $_SESSION["uploadedtweetID"];

//echo "your uploaded ID is  $uploaded_ID"; //this will test session if went thru
?>
<form method='post' action='dashboard_create_job2.php'>
<div>
<input type='text' id='title' required='' name='jobtitle' placeholder='Your Job Title'></input><br/>
<div class="mini">

<select name='minimum' required="" id="min">
<option  value=''># of respondents</option>
<?php
for($Val=1;$Val<=$Valmin;$Val++){
echo "<option value='$Val'>$Val</option>";
}
?>
</div>




</select>


<br>
<input type='Submit' id = 'Submit' name = 'Create_Job' value='Create'>
</div>
</form>


				</div>	
		
			</div>
		</div>

</body>
</html>

