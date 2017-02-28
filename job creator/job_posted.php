<?php
//file name: job_posted.php

session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';



/**this will check if there is a session created for user*****/
$url = "/taggsv2/index.php";
if(!isset($_SESSION['jc_id'])) {
	header("Location:$url");
}
/*************************************************************/


//$uploaded_ID = $_SESSION["uploadedtweetID"];
$jc_id = $_SESSION['jc_id'];

if (isset($_POST['postjob'])){
	$changer =   $_POST['posted'];
	$jb_id = $_POST['jbid'];
	$sql = mysql_query("UPDATE `job` SET `status` = '1' WHERE `job`.`job_id` = $jb_id")or die(mysql_error());;

	//UPDATE `job` SET `status` = '1' WHERE `job`.`job_id` = $jb_id

}
?>


<!DOCTYPE html>
<html>
<head>
<title>

	Jobcreator | Dashboard <?php echo "$jc_id";?>

</title>


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

echo "Your job has been posted";
echo "<br/>Redirecting to the  status page";
sleep(5);
header("Location:jc_ongoing.php");

?>

				</div>	
		
			</div>
		</div>

</body>
</html>


