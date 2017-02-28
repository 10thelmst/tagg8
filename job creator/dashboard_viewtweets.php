

<?php
//file name : dashboard_viewtweets.php
?>
<style type="text/css" media="all">



th {
  background-color: #0066CC;
  color: #FFFFFF;
}

tr:nth-child(even) {
  background-color: white; 
}


tr:nth-child(odd) {
  background-color:  #99CCFF;
}
</style>
<?php



session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';


$_SESSION["uploadedtweetID"] = $_GET["JCULID"];
$uploaded_ID = $_SESSION["uploadedtweetID"];

echo $uploaded_ID;

if (isset($_GET['jc_id']) && $_GET['jc_id'] != "") {
		$jc_id = $_GET['jc_id'];
	} else {
		$jc_id = $_SESSION['jc_id'];
	}
	
$t=1;

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
				<a href= "#" class="color red button" disabled><img src="images/jcongoing.gif" alt="jc dashboard" ></a> | 
				<a href= "#" class="color red button" disabled><img src="images/jcfin.gif" alt="jc dashboard" ></a> | 
				<a href= "dashboard_cancel.php" class="color red button" disabled><img src="images/jccancel.gif" alt="jc dashboard" ></a>
	</div>
			<!------------->
				<div class="MainWrapper">
				
				<br>

<?php




echo "<table style='width:80%' align='center' border='0px'>
						  <tr align='left'>
							<th>tweet number</th>
							<th>Tweet information</th> 
						  </tr>";
$query = mysql_query("SELECT * FROM tweets where up_id = $uploaded_ID")or die(mysql_error());
while($row = mysql_fetch_array( $query )) {
	echo "<tr>";;
	
	echo "<td>".$t."</td>";
	//echo $row['tweet_id']."  ";
	echo "<td>".$row['tweet_info']."</td>";

	$t=$t+1;
}



?>

			</div>
		</div>

</body>
</html>
