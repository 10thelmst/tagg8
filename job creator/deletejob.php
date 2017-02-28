<?php

//session_start();
//require_once("functions.php");
require_once("dbcontroller.php");
$db_handle = new DBController();


				
		
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
					
					function delQ($q_id){
					$query = @mysql_query("SELECT * FROM `question` WHERE Question_id = $q_id ")or die(mysql_error());
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