
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style type="text/css">
<!--
.myclass{
	margin-bottom: 1px;
	background-color: #C69;
}
-->


    
.inv {
    display: none;
}
.error {color: #FF0000;}
    
</style>
<script type="text/javascript">
var i = 1;
function addKid(){
	//if (i <= 3){ //delimiter
		i++;	
    	var div = document.createElement('div');
		div.style.width = "300px";
		div.style.height = "25px";
		div.style.color = "black";
		div.setAttribute('class', 'myclass');
    	div.innerHTML = 'Option : <input type="text" name="child_'+i+'" ><input type="button" id="add_kid()" onClick="addKid()" value="+" /><input type="button" value="-" onclick="removeKid(this)">';
    	document.getElementById('kids').appendChild(div);
	//} / delimter terminator
}

function removeKid(div) {	
    document.getElementById('kids').removeChild( div.parentNode );
	i--;
}

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
       
        </script>


<?php
session_start();
require_once("functions.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

$uploaded_ID = $_SESSION["uploadedtweetID"];
$jc_id = $_SESSION['usr_id'];

function showchoices($uploaded){
$query = mysql_query("SELECT * FROM `tweets` where up_id = $uploaded")or die(mysql_error());

echo"<select>";
echo " <option> ";
while($row = mysql_fetch_array( $query )) {
	

	
	echo " <option value='".$row['tweet_id'] . "'> ";
	echo " ".$row['tweet_info']. "</option> ";
	//echo " ".$row['up_id']. "<br/>";
} //end of while loop
echo"</select>";
} // end of function show choices


if (isset($_POST['jobtitle'])){
//filename:dashboard_create.php
//echo $potet;
//echo 'Hello ' . htmlspecialchars($_POST['job_title']) . '!<br>';
echo $_POST["jobtitle"];
echo " This is the Job creator ID :$jc_id";
$jobinfo = $_POST["jobtitle"];
$query = "INSERT INTO `job` (`job_name`, `up_id`, `jc_id`) VALUES ( '$jobinfo', '$uploaded_ID', '$jc_id')" ;
echo "its now inserted";
mysql_query($query) or die('Error, query failed');
 /***************************************************************************
This part will save the job to the data base ; it will be on a pop up soon
*****************************************************************************/

echo"this will show uploaded ID :$uploaded_ID<br/>";
//$query = "SELECT * FROM `tweets` where up_id = $uploaded_ID";
//mysql_query($query) or die('Error, query failed'); 
//$tested = 0;


}
if (isset($_POST['addqanda'])){
	
	echo "torjacks Q and A";
}



// define variables and set to empty values
$QuestionErr = $AnswerErr = $genderErr = $websiteErr = "";
$Question = $Answer = $gender = $comment = $website = "";


///bug catcher

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["question"])) {
    $QuestionErr = "Question is required";
  }
  
    if (empty($_POST["tweet"])) {
    $AnswerErr = "Please select tweet";
  }else
  
 
  



if (isset($_POST['Submit'])){

echo "Submitted";
echo $_POST["question"]. "<br/>";
//echo $_POST["rate"];
echo $_POST["ansopt"];

if(($_POST['ansopt'])=="content_1"){
							foreach($_POST['option'] as $value) {
										echo "$value<br/>";
									}
									
									
	}
	elseif(($_POST['ansopt'])=="content_2"){
								foreach($_POST['opt'] as $value) {
										echo "$value<br/>";
									}
									
									
	}
	elseif(($_POST['ansopt'])=="content_3"){
								foreach($_POST['rating'] as $value) {
										echo "$value<br/>";
									}
									
									
	}
	

}

 }

$_POST = array();

?>


 
 
<form action="#" method="post" >
					 <?php
						 echo "Select Tweet";
						 showchoices($uploaded_ID);
						 echo "<br/>";
							//writeMsg();
					 ?>
	
		Question : <input type='text' name='question'></input>
		 <span class="error">* <?php echo $QuestionErr;?></span>
		 <br/><br/>
		Tweet : <input type='text'  name='tweet'></input>
		<span class="error">* <?php echo $AnswerErr;?></span>
		<br/><br/>
		Type :
        <select name ='ansopt' id="target">
		
            <option value="">Select...</option>
            <option  value="content_1">Yes or No</option>
            <option  value="content_2">Option 2</option>
            <option  value="content_3">Option 3</option>
        <select>
		<br/>
		<br/>
        <div id="content_1" class="inv">
		<!-------------- Content 1 ------------>
		
		
		  <input type="text" name="option[]" value="Yes"> Yes<br>
		  <input type="text" name="option[]" value="No"> No<br>
		
		 
		
		
		</div>
        <div id="content_2" class="inv">
		<!-------------- Content 2 ------------>	
		
		
		  <input type="text" name="opt[]" value="1"> 1 <br>
		  <input type="text" name="opt[]" value="2"> 2 <br>
		  <input type="text" name="opt[]" value="3"> 3 <br>
		  <input type="text" name="opt[]" value="4"> 4 <br>
		  <input type="text" name="opt[]" value="5"> 5 <br>
		
		
		
		</div>
        <div id="content_3" class="inv">
		<!-------------- Content 3 ------------>
		
			
		  <input type="text" name="rating[]" value="1"> Rate 1 <br>
		  <input type="text" name="rating[]" value="2"> Rate 2 <br>
		  <input type="text" name="rating[]" value="3"> Rate 3 <br>
		  <input type="text" name="rating[]" value="4"> Rate 4 <br>
		  <input type="text" name="rating[]" value="5"> Rate 5 <br>
		
		
		
		
		</div>
   
 	<input type="submit" name="addqanda" value="submit" />
</form>	