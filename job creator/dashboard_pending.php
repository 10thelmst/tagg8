


<?php
//filename :dashboard_pending.php


session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'jc_header.php';
$jc_id = $_SESSION['jc_id'];

function showorg($ID){
	
	$query = mysql_query("SELECT * FROM `jc_user` where jc_id = $ID")or die(mysql_error());
while($row = mysql_fetch_array( $query )){
	
	
	echo $row['organization'];
}
}



?>

<html>
<head>
	<title>

		Jobcreator | Dashboard <?php echo "$jc_id";?>

	</title>

</head>
<style type="text/css">

.inside{
	border:4px;
	border-color: #ffffff;
	background-color: #C69;
}


    
</style>
<body>


<div class='inside'>
<?php

	echo "<table style='width:80%' align='center'>
  <tr align='left'>
    <th>Job ID</th>
    <th>Title</th> 
    <th>Organization</th>
    <th>Date Uploaded</th>
   
  </tr>";
$query = mysql_query("SELECT * FROM `job` where status = 0 && jc_id = $jc_id ")or die(mysql_error());

  
  while($row = mysql_fetch_array( $query )){
	  
	  $jc_id =  $row['jc_id'];
echo "<tr>";
echo "<td> Job ". $row['job_id']. "</td> ";
echo "<td>  ". $row['job_name']. "</td> ";
echo "<td>";
showorg($jc_id);
echo "</td> ";
echo "<td> upload ID ". $row['up_id']. "</td> ";
  }
?>

</div>
<body>
<html>
