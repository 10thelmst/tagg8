<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';


?>

<!DOCTYPE html>
<html>
<head>
  <title>Job Creator| Guidelines</title>


<style type="text/css" media="all">
body {
background-image:url('images/bg_gray.png');}

.jcdashboard {
    width:60%;
	font-family:Verdana, Geneva, sans-serif;
	background-color: #eeeeee;
	border-radius: 10px 10px 10px 10px;
	padding-top:10px;
	padding-bottom:10px;
	padding-left:10px;
	padding-right:10px;
	border-top:2px solid ;
	border-bottom:2px solid ;
	border-left:2px solid ;
	border-right:2px solid ;
	border-color:violet;
	margin:auto;
	align:center;

}
</style>
</head>
<body>


</head>


<br><br>
<div class="jcdashboard">
	 
 	 <strong>Guidelines for Job Creator:<br></strong> 
	  
	<strong><br>NOTE:</strong>
	
      <p><br>File should only be .csv (Excel file) format.</p>
      <p>- A CSV is a comma separated values file which allows data to be saved in a table structured format. CSVs look like a garden-variety spreadsheet but with a .csv extension (Traditionally they take the form of a text file containing information separated by commas, hence the name).</p>

      <br><p>You can cancel the job anytime.</p>
      <p>- Make sure to check it first before you decide to cancel the job.</p>
   
      <br><p>You can download a data anytime.</p>
      <p>- It allows you to download and upload the file at any time.</p>

      <br><p>Once job has been cancelled, all form will be deleted.</p>
      <p>- If you delete or cancel the job, you will not be able to get it back and will be automatically become a value of zero. </p>
 
	
</div> 

</body>
</html>


