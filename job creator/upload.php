<?php
 header('Content-type: text/html; charset=UTF-8'); 
ini_set('max_execution_time', 1200);

  
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
//include 'tagger_header.php';


$jc_id = $_SESSION['jc_id'];


$query = mysql_query("SELECT * FROM jc_user where jc_id = $jc_id")or die(mysql_error());
while($row = mysql_fetch_array( $query )) {
	
}


// THIS PART WOULD SAVE THE INFO OF THE FILE IN THE DATA BASE
if(isset($_POST['upload']) && $_FILES['file']['size'] > 0)
{
$fileName = $_FILES['file']['name'];
$tmpName  = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];
$file 	  = $_FILES['file']['tmp_name'];
/* opening of files and its contents*/
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);

	fclose($fp);
if(!get_magic_quotes_gpc())
{
  $fileName = addslashes($fileName);
}
//include 'library/config.php';
//include 'library/opendb.php';
//echo "file name is $fileName<br/>";
//echo "file size is $fileSize<br/>";
//echo "owner is 	$jc_id";

$query = "INSERT INTO `upload_tweet` (`up_title`, `up_size`, `up_date`, `jc_id`) ".
 "VALUES ('$fileName', '$fileSize', NOW(), '$jc_id')";

 
 /******************************************************************
This part will save the file in the tweets table from the CSV file
*******************************************************************/
mysql_query($query) or die('Error, query failed'); 
//printf("Last inserted record has id %d\n", mysql_insert_id()); // will show the last inserted ID boomm panes

$uploaded_id = mysql_insert_id();// this will provide the most current ID of uploaded tweet
//echo "<br/>uploaded id is $uploaded_id ";

//echo "$fp<br/>";


/******************************************************************
This part will save the file in the tweets table from the CSV file
*******************************************************************/
$handle = fopen($file,"r");

//while(($fileop = fgetcsv($handle,8000, ",")) !==false)
		
	  while (!feof($handle) ) {
		$fileop = fgetcsv($handle,8000, ",");
		
		$tweet_todb = mysql_real_escape_string($fileop[0]) ;
		if($tweet_todb!=NULL){
			$query = "INSERT INTO `tweets` ( `tweet_info`, `up_id`) ".
			"VALUES ('$tweet_todb', '$uploaded_id')";
			mysql_query($query);
		}
		//echo $tweet_todb;
		// or die('Error, query failed'); 
	}
	
	fclose($handle);
	

	/*
$result = $db_handle->insertQuery($query);
//echo "result : $result";
if(!empty($result)){
			$message = "You have uploaded successfully!";	
			unset($_POST);
		} else {
			$message = "problem uploading";	
		}
		
	*/	

} 

move_uploaded_file($_FILES['file']['tmp_name'],$_FILES['file']['name']);
echo 'Uploaded...!'; 	
?>

	<span><?php if(isset($message)){ echo $message; 
					
							echo "<br>";
							echo "<br>";
							echo "Create a Job for this upload?<div class ='here'><a href='Jc_dashboard_uploaded.php'>Click here</a></div>";
					
					} ?></span>