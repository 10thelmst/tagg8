<style type="text/css">

</style>

<?php



session_start();

require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';



/**this will check if there is a session created for user*****/
$url = "/taggsv2/index.php";
if(!isset($_SESSION['jc_id'])) {
	header("Location:$url");
}
/*************************************************************/


$uploaded_ID = $_SESSION["uploadedtweetID"];
$jc_id = $_SESSION['jc_id'];

$qcounter = 0;
?>






<!DOCTYPE html>
<html>
<head>
<title>

	Jobcreator | Dashboard <?php echo "$jc_id";?>

</title>

<script type="text/javascript">

</script>


</head>
			
		<div class="ADashboard">	
			
			<div class='dashmenu'>
					<a href= "Jc_dashboard.php" class="color red button" disabled><img src="images/jcdash.gif" alt="jc dashboard" ></a> | 
				<a href= "Jc_dashboard_uploaded.php" class="color red button" disabled><img src="images/jcup.gif" alt="jc upload" ></a> | 
				<a href= "#" class="color red button" disabled><img src="images/jccreate.gif" alt="jc dashboard" ></a> | 
				<a href= "#" class="color red button" disabled><img src="images/jcongoing.gif" alt="jc dashboard" ></a> | 
				<a href= "#" class="color red button" disabled><img src="images/jcfin.gif" alt="jc dashboard" ></a> | 
				<a href= "dashboard_cancel.php" class="color red button" disabled><img src="images/jccancel.gif" alt="jc dashboard" ></a>
	</div>
			<!------------->
				<div class="MainWrapper">
						<br>
						









<?php

function creategenerator($twitid,$jcid){
	$query = "INSERT INTO `generator` (`tweet_id`, `Job_id`, `rescounter`) VALUES ( '$twitid', '$jcid', '0')" ;
		mysql_query($query) or die('Error, query failed');
}
//$job_ID = $_SESSION['job_id'];

if (isset($_POST['jobtitle'])){
//filename:dashboard_create.php

$jobinfo = $_POST["jobtitle"];
$query = "INSERT INTO `job` (`job_name`, `up_id`, `jc_id`) VALUES ( '$jobinfo', '$uploaded_ID', '$jc_id')" ;


//echo "its now inserted";
mysql_query($query) or die('Error, query failed');
$_SESSION['job_id']= mysql_insert_id();

$job_ID = $_SESSION['job_id'];
//this part will provide the job ID
//echo "Job ID was $job_ID";

$query = mysql_query("SELECT * FROM `tweets` WHERE up_id = $uploaded_ID")or die(mysql_error());
		while($row = mysql_fetch_array( $query )){
		$tweetid= $row['tweet_id'];
		//echo "$tweetid ";
		creategenerator($tweetid,$job_ID);
		}
		
	

 /***************************************************************************
This part will save the job to the data base ; it will be on a pop up soon
*****************************************************************************/

}

$query = mysql_query("SELECT * FROM `question` WHERE job_id = $job_ID")or die(mysql_error());
		while($row = mysql_fetch_array( $query )){
			$qcounter = $qcounter+1;
		if($qcounter>0){
			echo $row['Question_info']."<br/>";
			}else{
				echo "Create your Question/s and Answers";
			}
			
		}


// define variables and set to empty values
$QuestionErr = $AnswerErr = $genderErr = $websiteErr = "";
$Question = $Answer = $gender = $comment = $website = "";


///bug catcher

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["question"])) {
    $QuestionErr = "Question is required";
  }
  
    if (empty($_POST["ansopt"])) {
    $AnswerErr = "Please create your options";
  }else
  
 
 

if (isset($_POST['AddQuestion'])){

//echo "Submitted<br>";
echo $_POST["question"]. "<br/>";
$question=$_POST["question"];

//echo $_POST["ansopt"];

$sql = mysql_query("INSERT INTO question (Question_info, job_id) VALUES ('$question' , '$job_ID' )")or die(mysql_error());;

	
$lastQID=mysql_insert_id();

//echo " last inserted ID was : $lastQID";
//INSERT INTO `question` (`Question_info`, `job_id`, `tweet_id`) VALUES ( $_POST['question'], $uploaded_ID, $_POST['tweet]');
if(($_POST['ansopt'])=="content_1"){
							foreach($_POST['option'] as $value) {
										echo "$value<br/>";
										
	
				$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$value', '$lastQID')")or die(mysql_error());;
	
										//INSERT INTO `answer` ( `answer_info`, `Question_id`) VALUES ( '$value', '$lastQID')
									}
									
									
	}
	elseif(($_POST['ansopt'])=="content_2"){
								foreach($_POST['opt'] as $value) {
										echo "$value<br/>";
										$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$value', '$lastQID')")or die(mysql_error());;
	
									}
									
									
	}
	elseif(($_POST['ansopt'])=="content_3"){
								foreach($_POST['rating'] as $value) {
										echo "$value<br/>";
										$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$value', '$lastQID')")or die(mysql_error());;
	
									}
									
									
	}
	
		elseif(($_POST['ansopt'])=="content_4"){
								
								foreach($_POST['custom'] as $value) {
										//echo "$value<br/>";
										if (empty($_POST["custom"])){
											$errmsg="Please add an option value";
										}else
										{
										$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$value', '$lastQID')")or die(mysql_error());;
										}
									}
									
									$childlist = "";	
								$more = TRUE;
								$i = 1;
								while ($more){
									if ((isset($_POST['child_'.$i])) && ($_POST['child_'.$i] != "")){
								$childlist = $_POST['child_'.$i];
								//$childlist .= "<br />";
									$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$childlist', '$lastQID')")or die(mysql_error());;
	
								} else {
								$more = FALSE;
										}
														$i++;
											}
									
									
	}
	

}

 }

$_POST = array();

?>


<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <style>
.inv {
    display: none;
}
.error {color: #FF0000;}
    </style>
    <body>
	
		<form action='#_SELF' method='POST'>
				
	
		Question : <input type='text' required='1' placeholder='Add your Question here'name='question'></input>
		 <span class="error">* <?php echo $QuestionErr;?></span>
		 <br/><br/>
	
	
		Type :
        <select name ='ansopt' id="target">
		
            <option value="">Select...</option>
            <option  value="content_1">Yes or No</option>
            <option  value="content_2">Agreement</option>
            <option  value="content_3">Emotion</option>
            <option  value="content_4">Customize</option>
        <select>
		<br/>
		<br/>
        <div id="content_1" class="inv">
		<!-------------- Content 1 ------------>
		
		
		  <input type="text" name="option[]" value="Yes"> <br>
		  <input type="text" name="option[]" value="No"> <br>
		
		 
		
		
		</div>
        <div id="content_2" class="inv">
		<!-------------- Content 2 ------------>	
		
		
		  <input type="text" name="opt[]" value="agree">  <br>
		  <input type="text" name="opt[]" value="disagree">  <br>
		
		
		
		
		</div>
        <div id="content_3" class="inv">
		<!-------------- Content 3 ------------>
		
			
		  <input type="text" name="rating[]" value="Happy"> <br>
		  <input type="text" name="rating[]" value="Sad">  <br>
		  
		</div>
		
		   <div id="content_4" class="inv">
		<!-------------- Content 4 ------------>
		
			
		  <input type="text" required='' placeholder="add text here" value="Add text here" name="custom[]" placeholder="add text here" value=''> <br>

    <div id="kids">
       <input type="text" required='' placeholder="add text here" name="child_1" value="Add text here"> 
    </div>
	<input type="button" id="add_kid()" onClick="addKid()" value="+" />(limit 10)
		</div>
		<br>
		<input type='Submit' id ='Submit'name='AddQuestion' Value='Submit'>
		<br><br>
		
		</form>
		
		<?php
		echo $qcounter;
		if($qcounter!=0){
		echo "<form method=POST action='job_posted.php'> 
		<input type='hidden' name='posted' value='1'>
		<input type='hidden' name='jbid' value='$job_ID'>
		<input type='Submit' id ='POST'name='postjob' Value='POST JOB'>
		</form>";
		}
		?>
		
		
		
		
        <script>
            document
                .getElementById('target')
                .addEventListener('change', function () {
                    'use strict';
                    var vis = document.querySelector('.vis'),   
                        target = document.getElementById(this.value);
                    if (vis !== null) {
                        vis.className = 'inv';
                    }
                    if (target !== null ) {
                        target.className = 'vis';
                    }
            });
			
			
			var i = 1;
function addKid(){
	if (i <= 9){
		i++;	
    	var div = document.createElement('div');
		div.style.width = "300px";
		div.style.height = "25px";
		div.style.color = "black";
		div.setAttribute('class', 'myclass');
    	div.innerHTML = ' <input type="text"  name="child_'+i+'"  required="" placeholder="add text here"> <input type="button" id="add_kid()" onClick="addKid()" value="+" /><input type="button" value="-" onclick="removeKid(this)">';
    	document.getElementById('kids').appendChild(div);
	}
}

function removeKid(div) {	
    document.getElementById('kids').removeChild( div.parentNode );
	i--;
};;
			
        </script>






				</div>	
		
			</div>
		</div>

</body>
</html>
