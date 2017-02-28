

<?php

session_start();
//require_once("functions.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';
include 'deletejob.php';

//$_SESSION['jc_id'];

$jc_id = $_SESSION['jc_id'];
$_SESSION['QuestionCounter']= 0;
$job_ID = '';

if(isset($_GET['job_id'])){
$job_ID = $_GET['job_id'];
echo $job_ID ;
 $_SESSION['job_id'] = $job_ID ;
 }
//$qcounter = 0;
if(isset($_GET['Question_id'])){
$q_id = $_GET['Question_id'];	
		delQ($q_id);
		}
?>

<!DOCTYPE html>
<html>
<head>
<title>

	Jobcreator | Dashboard <?php echo "$jc_id";?>

</title>

<script type="text/javascript">

</script>


	<style type='text/css'>
	
.but {
   
    
    height: 8px;
    background: #4E9CAF;
	padding : 0px;
    text-align: center;
    border-radius: 4px;
    border: 2px;
    color: white;
    font-weight: bold;
	margin : 2px;
	padding : 2px;
}

.showme{ 
display: none;
position:relative;
    float:right;
}
.party:hover .showme{
display : inline;
}
.party{ 
width : 1000px;
}



	#question {
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
		select {
  font-size: 20px;
  
}
input[type="text"]{
	margin-left :15px;
	margin-top : 5px;
    border: 5px solid #CCC;
	border : 1px solid #39C;
	
	border-radius : 5px;
	background-color : #ffffff;
	
	font-size : 15pt;
	height : 25px;
	
	 }

	
	</style>

    <style>
.inv {
    display: none;
}
.error {color: #FF0000;}
    </style>
 
<style type="text/css" media="all">

.option {
	margin-left:10px;
	width: 100%;
	background: ;
	color:teal;
}
.tweet{
	margin-left:0px;
	width: 100%;
	background: ;
	color:blue;
}
.colorquestion
{
	margin-left:0px;
	width: 100%;
	background: ;
	color:teal;
}

 -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 0 0 5px 5px;
  border: 1px solid green;

 background-color: #eeeeee;
}


.btnfinish:hover	{ background-color: #2a78f6; }

.btnfinish{ 
float:right;
margin-right:20%;
background: #4b8df9; 
display: inline-block; 
padding: 5px 10px 6px; 
color: #fbf7f7; 
text-decoration: none; 
font-weight: bold; 
line-height: 1; 
-moz-border-radius: 5px; 
-webkit-border-radius: 5px; 
border-radius: 5px; 
-moz-box-shadow: 0 1px 3px #999; 
-webkit-box-shadow: 0 1px 3px #999; 
box-shadow: 0 1px 3px #999; 
text-shadow: 0 -1px 1px #222; 
border: none; 
position: relative; 
cursor: pointer; 
font-size: 14px; 
font-family:Verdana, Geneva, sans-serif;
}
#donate {
    margin:4px;
    float:left;
	
}
.cv{
	width:100%;
	align:center;
}
#donate label {
    float:left;
    width:100px;
    margin:4px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
       
}

#donate label span {
    text-align:center;
    font-size: 12px;
    padding:13px 0px;
    display:block;
}

#donate label input {
    position:absolute;
    left:-100px;
}

#donate input:checked + span {
    background-color:#404040;
    color:#F7F7F7;

}

#donate .yellow {
    background-color:#FFCC00;
    color:#333;
}

#donate .blue {
    background-color:#00BFFF;
    color:#333;
}

#donate .pink {
    background-color:#FF99FF;
    color:#333;
}

#donate .green {
    background-color:#A3D900;
    color:#333;
}
#donate .purple {
    background-color:#B399FF;
    color:#333;
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
						<br>
				


<?php
function creategenerator($twitid,$jcid){
	$query = "INSERT INTO `generator` (`tweet_id`, `Job_id`, `rescounter`) VALUES ( '$twitid', '$jcid', '0')" ;
		mysql_query($query) or die('Error, query failed');
}


if (isset($_POST['jobtitle'])){
	
$uploaded_ID = $_SESSION["uploadedtweetID"];

$jobinfo = $_POST["jobtitle"];
$jobmin = $_POST["minimum"];
$query = "INSERT INTO `job` (`job_name`, `up_id`, `jc_id` , `minimum`) VALUES ( '$jobinfo', '$uploaded_ID', '$jc_id','$jobmin')" ;


//echo "its now inserted";
mysql_query($query) or die('Error, query failed');
$_SESSION['job_id']= mysql_insert_id();


$job_ID = $_SESSION['job_id'];
//this part will provide the job ID
//echo "Job ID was $job_ID";

$query = mysql_query("SELECT * FROM `tweets` WHERE up_id = $uploaded_ID")or die(mysql_error());
		while($row = mysql_fetch_array( $query )){
		$tweetid= $row['tweet_id'];
		
		creategenerator($tweetid,$job_ID);
		}
		
	

}

	
 

if (isset($_POST['AddQuestion'])){
//////////////////////////////////////////
//echo "Submitted<br>";
//echo $_POST["question"]. "<br/>";
$question=$_POST["question"];

//echo $_POST["ansopt"];
 $job_ID = $_SESSION['job_id'];
// echo  $job_ID;
 
 ////////////////////////////////////////
$sql = mysql_query("INSERT INTO question (Question_info, job_id ,Qtype) VALUES ('$question' , '$job_ID' ,'1' )")or die(mysql_error());

	
$lastQID=mysql_insert_id();

if(($_POST['ansopt'])=="content_1"){
							foreach($_POST['option'] as $value) {
								
				$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$value', '$lastQID')")or die(mysql_error());;
	
					
									}
									
									
	}
	elseif(($_POST['ansopt'])=="content_2"){
								foreach($_POST['opt'] as $value) {
										
										$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$value', '$lastQID')")or die(mysql_error());;
	
									}
									
									
	}
	elseif(($_POST['ansopt'])=="content_3"){
								foreach($_POST['rating'] as $value) {
										$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$value', '$lastQID')")or die(mysql_error());;
									}
									
									
	}
	
		elseif(($_POST['ansopt'])=="content_4"){
								
								foreach($_POST['custom'] as $value) {
									
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
									$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$childlist', '$lastQID')")or die(mysql_error());;
	
								} else {
								$more = FALSE;
										}
														$i++;
											}
									
									
	}
	

}

/*This part will whow the question*/

$job_ID = $_SESSION['job_id'];
//echo "Job ID is : $job_ID yeah"; 
//echo $jobinfo;
//$j_id = $job_ID;
	$qcounter=0;


	
	
$query = mysql_query("SELECT * FROM `question` WHERE job_id = $job_ID")or die(mysql_error());
		while($row = mysql_fetch_array( $query )){
			$qcounter++;
			$_SESSION['QuestionCounter'] = $qcounter;
			
			

			echo "<div class ='party' id='donate'>
			
			
			
			
			";
			
			echo "<strong>".$row['Question_info']." </strong> 	
			<div class='showme' align ='left'>
			<a href='editquestion.php?Question_id=".$row['Question_id']."&Question_info=".$row['Question_info']."' class ='but'>
			Edit
			</a>
			<a href='dashboard_create_job2.php?Question_id=".$row['Question_id']."' class ='but'>
			Delete
			</a>
			
			</div>
			
			
			
			<br/>";
			
			$qId=$row['Question_id'];
			//echo $qId;
			showanswer($qId);
			echo "</div>
				
		
			";
			echo "<br/>";
			echo "<br/>";
			echo "<br/>";
			echo "<br/>";
			echo "<br/>";
		
		}
		
		
	function showanswer($qid){
	$query = mysql_query("SELECT * FROM `answer` WHERE Question_id = $qid ")or die(mysql_error());
	while($row = mysql_fetch_array( $query )){
	echo " <label class='blue'>
				
				<input type='radio' name='answer[]' required value='".$row['answer_id']."'>
				
			<span>"
				.$row['answer_info'].
			   "</span>
			  </label>";
	
	
		}

	}		
		
		
			if($_SESSION['QuestionCounter']==0){
				echo "Create your Question/s and Answers";
			}
		

?>


		<form action='#_SELF' method='POST'>
				
	    <select name ='ansopt' required='' id="target">
		
            <option value="">Type of Question</option>
            <option  value="content_1">Yes or No</option>
            <option  value="content_2">Agreement</option>
            <option  value="content_3">Emotion</option>
            <option  value="content_4">Customize</option>
        <select>
		<br>
		 <input type='text' required='' id='question' placeholder='Add your Question here'name='question'></input>
		 
		 <br/><br/>
	
	
		
    
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
		<input type='Submit' id ='Submit'name='AddQuestion' Value='Save'>
		<br><br>
		
		</form>
		
		<?php 
		$mcounter = $_SESSION['QuestionCounter'];
		if($mcounter!=0){
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
		//div.style.margin-top = "5px";
		div.setAttribute('class', 'myclass');
    	div.innerHTML = ' <input type="text"  name="child_'+i+'"  required="" placeholder="add text here"> <input type="button" id="add_kid()" onClick="addKid()" value=" + " /><input type="button" value=" - " onclick="removeKid(this)">';
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
