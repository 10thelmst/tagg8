<?php
//filename :dashboard_pending.php


session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';


	if  (!isset($_SESSION['jc_id'])) {
    echo 'the session is either empty or doesn\'t exist';
		sleep(2);
		header("Location: ../index.php");

	}
$jc_id = $_GET['job_id'];




?>


<!DOCTYPE html>
<html>
<head>
<title>

	Jobcreator | Dashboard <?php echo "$jc_id";?>

</title>

<div class="ADashboard">	
	<div class='dashmenu'>
					<a href= "Jc_dashboard.php" class="color red button" disabled><img src="images/jcdash.gif" alt="jc dashboard" ></a> | 
				<a href= "Jc_dashboard_uploaded.php" class="color red button" disabled><img src="images/jcup.gif" alt="jc upload" ></a> | 
				<a href= "#" class="color red button" disabled><img src="images/jccreate.gif" alt="jc dashboard" ></a> | 
				<a href= "#" class="color red button" disabled><img src="images/jcongoing.gif" alt="jc dashboard" ></a> | 
				<a href= "#" class="color red button" disabled><img src="images/jcfin.gif" alt="jc dashboard" ></a> | 
				<a href= "dashboard_cancel.php" class="color red button" disabled><img src="images/jccancel.gif" alt="jc dashboard" ></a>
	</div>
			<!------------->
				<div class="MainWrapper">
				<?php
				
						echo $jc_id;
				?>
		
				
				</div>
				
				
				


		
				</div><!-----"inside div" closing tag---------->

<body>
<html>