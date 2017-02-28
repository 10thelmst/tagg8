
<?php

//file name : Jc_dashboard_uploaded.php
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



// THIS PART WOULD SAVE THE INFO OF THE FILE IN THE DATA BASE
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
$file 	  = $_FILES['userfile']['tmp_name'];
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
while(($fileop = fgetcsv($handle,8000, ",")) !==false)
	{
	
		$tweet_todb = mysql_real_escape_string($fileop[0]) ;
		//echo $tweet_todb;
		$query = "INSERT INTO `tweets` ( `tweet_info`, `up_id`) ".
			"VALUES ('$tweet_todb', '$uploaded_id')";
			mysql_query($query);// or die('Error, query failed'); 
	}
	
	fclose($handle);
	

	
$result = $db_handle->insertQuery($query);
//echo "result : $result";
if(!empty($result)){
			$message = "You have uploaded successfully!";	
			unset($_POST);
		} else {
			$message = "problem uploading";	
		}

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
				<a href= "finishjob.php" class="color red button" disabled><img src="images/jcfin.gif" alt="jc dashboard" ></a> | 
				<a href= "dashboard_cancel.php" class="color red button" disabled><img src="images/jccancel.gif" alt="jc dashboard" ></a>
				</div>
			<!------------->
				<div class="MainWrapper">
				
					<br/>
					<span><?php if(isset($message)){ echo $message; 
					
							//echo "<br>";
							//echo "<br>";
							//echo "Create a Job for this upload?<div class ='here'><a href='Jc_dashboard_uploaded.php'>Click here</a></div>";
					
					} ?></span>
					<br/>
						<br>
<form method="post" enctype="multipart/form-data">
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

<br/>
		
						
						<?php
						function yesorno($upID){
							$yescounter =0;
							$query = mysql_query("SELECT * FROM `job` WHERE up_id = '$upID' && status = '1'")or die(mysql_error());
							while($row = mysql_fetch_array( $query )){
							$yescounter++;
							}
							//echo "Yes";
							if($yescounter>0){
								echo "Yes";
							}else{
								echo "
								No";
								
							}
							
						}
						
						
						function is_up($jcref_id){
							
						$query = mysql_query("SELECT * FROM `upload_tweet` WHERE jc_id = '$jcref_id;'")or die(mysql_error());
						while($row = mysql_fetch_array( $query )){
							$upID = $row['up_id'];
						echo "<tr>";;
						//echo "<td> Create <a href ='dashboard_create.php?JCULID=". $row['up_id'].">Cre</a></td> "; // can be remove already, reference from check box
						echo "<td><a href ='dashboard_create.php?JCULID=".$row['up_id']."'> Create </a></td> "; //put a link in here
						echo "<td><a href ='dashboard_create.php?JCULID=".$row['up_id']."'> ".$row['up_title']. " </a></td> "; //put a link in here
						//echo "<td>".$row['up_size'] . " </td> ";
						echo "<td>".$row['up_date'] . "</td> ";
						echo "<td> ";
						yesorno($upID);
						echo "</td>"; 
						//echo " <td><label><input type='checkbox' value=" .$row['up_id'].">Option 1</label></td>";
						echo "</tr>";
						}

						echo "</table>";	
						}
						
						$dbchecker=0;
						$query = mysql_query("SELECT * FROM `upload_tweet` WHERE jc_id = '$jc_id;'")or die(mysql_error());
						while($row = mysql_fetch_array( $query )){
							$dbchecker=$dbchecker+1;

						}
						if($dbchecker>0){
							echo "<table style='width:80%' align='center' border='1px'>
						  <tr align='left'>
							<th>Create Job</th>
							<th>Title</th> 
							<!--th>Size</th--->
							<th>Date Uploaded</th>
							<th>Survey Created</th>
							<!----th>Del</th------>
						  </tr>";
							
						}
						
						
						is_up($jc_id);
						?>

				</div>	

			</div>
		</div>

</body>
</html>
s
