<?php

session_start();
//require_once("functions.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';
include 'deletejob.php';


 $job_ID = $_SESSION['job_id'];

if(isset($_GET['Question_id']))
{
	$_SESSION['Question_id'] = $_GET['Question_id'];
}
$question_id = $_SESSION['Question_id'];
if(isset($_GET['Question_info'])){
	
$_SESSION['Question_info'] = urlencode($_GET['Question_info']);
//$question_info = $_GET['Question_info'];
}
$question_info = urldecode($_SESSION['Question_info']);
//echo $question_info;
if(isset($_GET['answer_id'])){
$answer_id =  $_GET['answer_id'];
deleteAns($answer_id);
 }

 if(isset($_POST['add'])){
//$Question_id =  $_GET['addAnswer'];
$Question_id = $_SESSION['Question_id'];
//echo $Question_id;

	$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '', '$Question_id')")or die(mysql_error());;
	
 }
  if(isset($_POST['SaveChanges'])){
echo $_POST['Question_info'];

foreach($_POST['answer'] as $value) {
					$answer[]=  $value;			
			
									}
			$ar_counter =  sizeof($answer);						
			foreach($_POST['answerID'] as $IDvalue) {
					$answerID[] =   $IDvalue;			
			
					
									}
									
										for ($x = 0; $x < $ar_counter; $x++) {
 
	
	$ans= $answer[$x];
	
	$ansID= $answerID[$x];	 
	//echo $ans;
	//echo $ansID;			
		$sql = mysql_query("UPDATE `answer` SET `answer_info` = '$ans' WHERE `answer`.`answer_id` = '$ansID'")or die(mysql_error());;
	header("Location: dashboard_create_job2.php?job_id=$job_ID");
						
										}
									
									
 }
 

?>


<!DOCTYPE html>
<html>
</body>
<head>

<style>
.edit{
	margin-left : 10px;
	margin-top : 10px;
	border : 1px solid #999999;
	
	
}

.but {
   
    height: 8px;
    background: #4E9CAF;
	padding : 10px;
    text-align: center;
    border-radius: 4px;
    border: 5px;
    color: white;
    font-weight: bold;
	margin : 2px;
	padding : 2px;
	
	
}
	.Ques {
	margin-top : 20px;
	margin-left :15px;
	margin-right : 15px;
	border : 4px solid #39C;
	width :1000px;
	border-radius : 8px;
	background-color : #ffffff;
	
	font-size : 20pt;
	height : 40px;
		}
		
#ans{
	margin-left :15px;
	margin-top : 5px;
    border: 5px solid #CCC;
	border : 1px solid #39C;
	
	border-radius : 5px;
	background-color : #ffffff;
	
	font-size : 15pt;
	height : 25px;
	
	 }
	 #submit{
	 margin-left :15px;
	 
	 }
</style>
</head>


		<div class="container">
		
			

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
					<div class='edit'>
						<form method='POST' action=''>

						<?php

						//echo  $question_id;
						//echo  $question_info;
						echo "Question<br/>";
						echo "<input type=text required='' class='Ques' name='Question_info' value='".$question_info."'>
								";
								$h = 0;
									$query = mysql_query("SELECT * FROM `answer` WHERE Question_id = $question_id")or die(mysql_error());
								while($row = mysql_fetch_array( $query )){
									//echo $row['answer_id'];
									$h++;
								}
								$query = mysql_query("SELECT * FROM `answer` WHERE Question_id = $question_id")or die(mysql_error());
								while($row = mysql_fetch_array( $query )){
									//echo $row['answer_id'];
								
									$answer_info =  $row['answer_info'];
									$answerID =  $row['answer_id'];
									echo "<br>";
									echo "<input type='hidden'  name='answerID[]'  id='ans' value='".$answerID."'>";
									echo "<input type='text'  name='answer[]'  id='ans' value='".$answer_info."'>";
									if($h>2)	
									echo "<a href='editquestion.php?answer_id=".$row['answer_id']."'class='but'> remove </a>";
									//echo $row['answer_id'];
									
								}
								echo "<br><input type='submit' name='add' value='add'><br>";
								//echo "<br/><br/><a id='submit' href='editquestion.php?addAnswer=".$question_id."' class='but'> add </a><br/>";
						?>
						<br>
						<input type='submit' name='SaveChanges'value='Save All Changes'>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
<html>