<?php  header('Content-type: text/html; charset=UTF-8'); 
ini_set('max_execution_time', 1200);

session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';

if (isset($_GET['jc_id']) && $_GET['jc_id'] != "") {
		$jc_id = $_GET['jc_id'];
	}
		$jc_id = $_SESSION['jc_id'];
	//echo $jc_id;
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
					<!-------------THIS FORM CAN BE PUT SOON IN POP UP--------------->
					<!----form method="post" action="" enctype="multipart/form-data"  >
							<br>
							<input type="file" name="file"/>
							<input type="submit" name="upload" value="upload tweets"><br>
							Note: Make sure that your file is in csv file type
					</form---->
					<br/>
					<br/>
					<br/>
			<form method="post" enctype="multipart/form-data" style='margin-left : 30px;'>
	<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
	<tr> 
<td width="246">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="userfile" type="file" id="userfile"> 
</td>
<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
</tr>
</table>
</form>
<?php


// THIS PART WOULD SAVE THE INFO OF THE FILE IN THE DATA BASE
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
$file 	  = $_FILES['userfile']['tmp_name'];
$pfile 	  = $_FILES['userfile']['tmp_name'];
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



function outputProgress($current, $total) {
    echo "
	<span  style='position: absolute ;z-index:$current; background-color: #fff; margin-left:30px; margin-top:-50px;'> 
	Upload Progress <meter value='".$current."' min='0' max='".$total."'>$current out of $total </meter>
	".
	round($current/$total*100, 2)
	."%
	</span>
	
	";
	
    myFlush();
    //sleep(1);
}

/**
 * Flush output buffer
 */
function myFlush() {
    echo(str_repeat(' ', 256));
    if (@ob_get_contents()) {
        @ob_end_flush();
    }
    flush();
}

/******************************************************************
This part will save the file in the tweets table from the CSV file
*******************************************************************/
$firsthandler = fopen($pfile,"r");
$max=0;
while(($fileopen = fgetcsv($firsthandler,8000, ",")) !==false)
	{
		if($fileopen[0]!=NULL){
	$max++;
		}
		
	}

	
	
$handle = fopen($file,"r");
$current = 0;
while(($fileop = fgetcsv($handle,8000, ",")) !==false)
	{
		$tweet_todb = mysql_real_escape_string($fileop[0]) ;
		//echo $tweet_todb;
			$result[] = $tweet_todb;
			
			if($tweet_todb!=NULL){
		$query = "INSERT INTO `tweets` ( `tweet_info`, `up_id`) ".
			"VALUES ('$tweet_todb', '$uploaded_id')";
			mysql_query($query);// or die('Error, query failed'); 
			
			$current++;
		
			outputProgress($current,$max);
			
			
			}
			
		
	}
	
	fclose($handle);
	


	

		if(!empty($result)){
					$message = "You have uploaded successfully!";	
					unset($_POST);
							} 
						else {
							$message = "problem uploading";	
							}

} 

?>


					<span><?php if(isset($message)){ echo $message; 
					
							echo "<br>";
							echo "<br>";
							echo "Create a Job for this upload?<div class ='here'><a href='Jc_dashboard_uploaded.php'>Click here</a></div>";
					
					}





					?></span>
					<br/>
					<?php
					$showinter =0;
					$ongoing =0;
					$finish =0;
					$query = mysql_query("SELECT * FROM job where jc_id = $jc_id ")or die(mysql_error());
					while($row = mysql_fetch_array( $query )) {
					if($row['status']==0){
					$showinter++;
					}elseif($row['status']==1){
					$ongoing ++;
					}elseif($row['status']==-1)
					$finish ++;
					}
					if($showinter>0){
						
					
						echo "<br><br>There are $showinter job";
						if ($showinter>1)
						echo "s";
						echo " that was not been posted <br/>
						<a href='dashboard_cancel.php'>Click here to check</a>
					";}
					
					if($ongoing>0){
						
						echo "<br><br>There are $ongoing job";
						if ($ongoing>1)
						echo "s";
						echo " that is on going<br/>
						<a href='jc_ongoing.php'>Click here to check</a>	
					";}
					
						if($finish>0){
						
						echo "<br><br>There are $finish job";
						if ($finish>1)
						echo "s";
						echo " that was finished<br/>
						<a href='finishjob.php'>Click here to check</a>	
					";}
					?>




<br>
<!---br>
Current Job Status
<meter value=".5"></meter--->
				</div>	
		
			</div>
		</div>

		
		
		
		
</body>
</html>
