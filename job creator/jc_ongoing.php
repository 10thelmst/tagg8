


<?php
//filename :dashboard_pending.php


session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';

$jc_id = $_SESSION['jc_id'];

function showorg($ID){
	
	$query = mysql_query("SELECT * FROM `jc_user` where jc_id = $ID")or die(mysql_error());
while($row = mysql_fetch_array( $query )){
	
	
	echo $row['organization'];
}
}



?>


<!DOCTYPE html>
<html>
<head>
<title>

	Jobcreator | Dashboard <?php echo "$jc_id";?>

</title>
	<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure you want to cancel this Job?\n You cannot revert this after ');
}
</script>
	
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
				<a href= "finishjob.php" class="color red button" disabled><img src="images/jcfin.gif" alt="jc dashboard" ></a> | 
				<a href= "dashboard_cancel.php" class="color red button" disabled><img src="images/jccancel.gif" alt="jc dashboard" ></a>
				</div>
			<!------------->
				<div class="MainWrapper">
				<br/>
					
						<?php
					echo "<table style='width:80%' align='center'>
				  <tr align='left'>
					
					<th>Title</th> 
					<th>Progress</th>
					<th>Download</th>
					<th>Cancel</th>
				   
				  </tr>";
				  function gencheck($job,$jobmin){
					 // SELECT * FROM `generator` ORDER BY `Job_id` ASC
					  $current =0;
					  $query = mysql_query("SELECT * FROM `generator` where job_id = $job ")or die(mysql_error());
						while($row = mysql_fetch_array( $query )){
							$arr[] = $row['Job_id'];
							$rescntr = $row['rescounter'];
							//	echo $rescntr;
						if($jobmin<=$rescntr){
							$current= $current+ $jobmin;
						//	echo $rescntr;
						}else{
							
							$current= $current+ $rescntr;
							
						}
						
		
					
					
				  }
				  
						$gensize = sizeof($arr);
						$total = $jobmin*$gensize;
					
				  //echo "max is :". $max;
				 // echo "size is :". $current;
				  
				  	echo "<meter value='".$current."' min='0' max='".$total."'>$current out of $total </meter> ".round($current/$total*100, 2)."%";
					
				  }
				$query = mysql_query("SELECT * FROM `job` where status = 1 && jc_id = $jc_id ")or die(mysql_error());
				  while($row = mysql_fetch_array( $query )){
					  
					  $jc_id =  $row['jc_id'];
					  $job_id =  $row['job_id'];
					  $job_name =  $row['job_name'];
					  $job_minimum =  $row['minimum'];
				echo "<tr>";
				
				echo "<td> <a href='#'> ". $row['job_name']. "</a></td> ";				
					echo "<td>" ;
					gencheck($job_id,$job_minimum);
				//<meter value='.01'></meter>";
				//showorg($jc_id);
				echo "</td> ";
				echo "<td><a href='jobexport.php?job_id=".$job_id."&job_name=".$job_name."'><img height ='25' width ='25' src=images/download.png></img></a></td> ";
				echo "<td> <a  onclick='return checkDelete()' href='dashboard_cancel.php?stopjob_id=".$job_id."' >Stop job</a></td> ";
				  }
				?>

				</div><!-----"inside div" closing tag---------->
			</div><!-----main wrapper closing tag---------->
</div>
<body>
<html>
