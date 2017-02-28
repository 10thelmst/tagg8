<?php
$job_name = $_GET['job_name'];
$filename = $job_name;

//output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
//header('Content-Disposition: attachment; filename=data.csv');
 // header('Content-Type: application/csv');
 header('Content-Disposition: attachment; filename="'.$filename.'.csv";');
// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

$job_id = $_GET['job_id'];

session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();




/////////////////////////////////////////////////////////////////////////
function showtweet($twet)
	{
				
			$query = mysql_query("SELECT * FROM `tweets` WHERE tweet_id ='$twet'")or die(mysql_error());
				
				while($row = mysql_fetch_array( $query ))
				{
					
					
					$tweet_info = str_replace(',',';',$row['tweet_info']);
					echo $tweet_info ;
				}
	}
///////////////////////////////////////////////////////////////////////////
function showanswer($q,$counter)
	{
			
			
			$query = mysql_query("SELECT * FROM `answer` WHERE Question_id ='$q'")or die(mysql_error());
				
				while($row = mysql_fetch_array( $query ))
				{
					 
					echo "[Q" .$counter. "]". $row['answer_info'];
					echo ",";
				}
				
	}
	
	function showanswerID($q,$tweet)
	{
				
			$query = mysql_query("SELECT * FROM `answer` WHERE Question_id ='$q'")or die(mysql_error());
				
				while($row = mysql_fetch_array( $query ))
				{	
					$ansID = $row['answer_id'];
					//echo "answer ID is : ".$row['answer_id'];
					//echo "<br>";
				responsecounter($tweet,$ansID);
				}
				//echo $tweet;
				
				//echo "<br/>";
	}
	
function responsecounter($tweetID,$ansID){
	
	$Rcounter =0;
	$query = mysql_query("SELECT response_id FROM `response` WHERE tweet_id ='$tweetID' and answer_id=$ansID")or die(mysql_error());
				//$row = mysql_fetch_array( $query );
			while($row = mysql_fetch_array( $query ))
				{
					$Rcounter ++;
					//echo "response ID is :".$row['response_id'];
				//	echo "<br>";
				}
				echo  $Rcounter;
				echo ",";
				
}





	
	
	$rows = mysql_query("SELECT * FROM question where job_id='$job_id'");
$qcounter=1;
while ($row = mysql_fetch_array($rows)){
	echo "[Q$qcounter]". $row['Question_info'];
	echo "\n";
	$qcounter++;
	//$quest =  $row['tweet_id'];
	

} 
	echo "Tweets";
	echo ",";
	$rows = mysql_query("SELECT * FROM question where job_id=$job_id");
$counter=1;
while ($row = mysql_fetch_assoc($rows)){
	//echo "[Q$counter]". $row['Question_info'];
	$q_id =  $row['Question_id'];
	//echo "$q_id<br/>";

	showanswer($q_id,$counter);
	$counter++;
	
	//$quest =  $row['tweet_id'];
	

}
echo "\n"; 



$rows = mysql_query("SELECT * FROM generator where job_id=$job_id");

while ($row = mysql_fetch_assoc($rows)){

	$tweet =  $row['tweet_id'];
	echo '"';
	showtweet($tweet);
	echo '"';
	echo ",";
	counttweetperanswer($tweet,$job_id);
	echo "\n";
	//echo "<br>";
	//fputcsv($output, $row);
	//fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));

	
} 



function counttweetperanswer($tweetid,$jobid){
		$rows = mysql_query("SELECT * FROM question where job_id='$jobid'");
	while ($row = mysql_fetch_array($rows)){
	
	$q_id =  $row['Question_id'];
	//$qcounter++;
	showanswerID($q_id,$tweetid);
	//$quest =  $row['tweet_id'];
	
	//print_r($test);
}
} 



?>