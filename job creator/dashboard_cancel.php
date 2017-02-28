
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
$jc_id = $_SESSION['jc_id'];

function showorg($ID){
	
	$query = mysql_query("SELECT * FROM `jc_user` where jc_id = $ID")or die(mysql_error());
while($row = mysql_fetch_array( $query )){
	
	
	echo $row['organization'];
}
}

if(isset($_GET['stopjob_id'])){
	
	$jb_id = $_GET['stopjob_id'];
	$sql = mysql_query("UPDATE `job` SET `status` = '0' WHERE `job`.`job_id` = $jb_id")or die(mysql_error());;

	
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
    return confirm('Are you sure you want to delete this Job?\n You cannot revert this after deleting');
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
.notification{
	border: 2px;
	width : 1000px;
	height : 20px;
	margin-left : 20px;
}
.but {
   
    
    height: 8px;
    background: #4E9CAF;
	padding : 0px;
    text-align: center;
    border-radius: 4px;
    border: 4px;
    color: white;
    font-weight: bold;
	margin : 3px;
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
				<div class='notification'>
					<?php
					
					
						function deletejob($jobID){
	
						$query = mysql_query("DELETE FROM `job` WHERE `job`.`job_id` = $jobID ")or die(mysql_error());
						$query = mysql_query("DELETE FROM `generator` WHERE `generator`.`Job_id` = $jobID ")or die(mysql_error());
					} 
					
					function deleteQue($delQueID){
	
						$query = mysql_query("DELETE FROM `question` WHERE `question`.`Question_id` = $delQueID ")or die(mysql_error());
					} 
					function deleteAns($delAnsID){
						
						$query = mysql_query("DELETE FROM `answer` WHERE `answer`.`answer_id` = $delAnsID ")or die(mysql_error());
						$query = mysql_query("DELETE FROM `response` WHERE `response`.`answer_id` = $delAnsID ")or die(mysql_error());
						
					} 
					
					
					function delAnswer($qid){
						
	$query = mysql_query("SELECT * FROM `answer` WHERE Question_id = $qid ")or die(mysql_error());
	while($row = mysql_fetch_array( $query )){
		$delAnsID =  $row['answer_id'];
		//echo $row['answer_id'];
		
		//echo "</br> ";
		//echo $row['answer_info'];
		deleteAns($delAnsID);
		//DELETE FROM `answer` WHERE `answer`.`answer_id` = $delAnsID
	}	
						
					}
					
					function delQ($job_id){
						$query = mysql_query("SELECT * FROM `question` WHERE job_id = $job_id ")or die(mysql_error());
	while($row = mysql_fetch_array( $query )){
		$queID = $row['Question_id'];
		//echo $row['Question_info'];
		//echo $row['Question_id'];
		//echo "Job :$job_id ";
		delAnswer($queID);
		
		deleteQue($queID);
	}
			}		
					
					if (isset($_POST['up_id'])){
	
foreach($_POST['up_id'] as $field_name => $field_value) {
    $job_id = $field_value;
	delQ($job_id);
	
	
	deletejob($job_id);
	}
	
}
		
		?>
			</div>
				<br/>
						<form method='POST' action='#'>
						<?php
					echo "<table style='width:80%' align='center'>
				  <tr align='left'>
					
					<th> </th> 
					<th>Title</th> 
				
					<th><input type='submit' id='del' onclick='return checkDelete()' value='delete'></th>
				   
				  </tr>";
				$query = mysql_query("SELECT * FROM `job` where status = 0 && jc_id = $jc_id ")or die(mysql_error());
				  while($row = mysql_fetch_array( $query )){
					  
					 // $jc_id =  $row['jc_id'];
					echo "<tr>";
				echo "		<td>
							<a href='resumejob2.php?job_id=".$row['job_id']."'>  <span class='but'> Edit/Post</span> </a>
						</td> ";		
						echo "		<td>
							<a href='dashboard_create_job2.php?job_id=".$row['job_id']."'> "
								. $row['job_name']. 
							"</a>
						</td> ";
				echo "<td>";
			 echo "   <input type='checkbox' name='up_id[]' value=". $row['job_id'] . ">";
				 echo  "</td> ";
				  }
				?>
			</form>
				</div><!-----"inside div" closing tag---------->
			</div><!-----main wrapper closing tag---------->
</div>
<body>
<html>
