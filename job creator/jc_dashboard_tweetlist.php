
<?php

//file name : jc_dashboard_tweetlist.php
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
	
}

?>


<!DOCTYPE html>
<html>
<head>
<title>

	Jobcreator | Dashboard <?php echo "$jc_id";?>

</title>

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
</head>

		<div class="ADashboard">	
			
			<div class='dashmenu'>
						<a href= "Jc_dashboard.php" class="color red button" disabled><img src="images/jcdash.gif" alt="jc dashboard" ></a> | 
				<a href= "jc_dashboard_tweetlist.php" class="color red button" disabled><img src="images/jcup.gif" alt="jc upload" ></a> | 
				<a href= "Jc_dashboard_uploaded.php" class="color red button" disabled><img src="images/jccreate.gif" alt="jc dashboard" ></a> | 
				<a href= "jc_ongoing.php" class="color red button" disabled><img src="images/jcongoing.gif" alt="jc dashboard" ></a> | 
				<a href= "#" class="color red button" disabled><img src="images/jcfin.gif" alt="jc dashboard" ></a> | 
				<a href= "dashboard_cancel.php" class="color red button" disabled><img src="images/jccancel.gif" alt="jc dashboard" ></a>
	</div>
			<!------------->
				<div class="MainWrapper">
						<br>

		
						
						<?php
						function is_up($jcref_id){
							echo "<table style='width:80%' align='center' border='1px'>
						  <tr align='left'>
							
							<th>Title</th> 
							<th>Size</th>
							<th>Date Uploaded</th>
							
						  </tr>";
						$query = mysql_query("SELECT * FROM `upload_tweet` WHERE jc_id = '$jcref_id;'")or die(mysql_error());
						while($row = mysql_fetch_array( $query )){
						echo "<tr>";;
						//echo "<td> Create". $row['up_id']. "</td> "; // can be remove already, reference from check box
						echo "<td><a href ='dashboard_viewtweets.php?JCULID=".$row['up_id']."'> ".$row['up_title']. " </a></td> "; //put a link in here
						echo "<td>".$row['up_size'] . " </td> ";
						echo "<td>".$row['up_date'] . "</td> ";
						//echo "<td> No </td>"; 
						//echo " <td><label><input type='checkbox' value=" .$row['up_id'].">Option 1</label></td>";
						echo "</tr>";
						}

						echo "</table>";	
						}

						is_up($jc_id);

						?>

				</div>	

			</div>
		</div>

</body>
</html>

