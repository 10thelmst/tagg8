<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'moderator_header.php';

?>
	
<!DOCTYPE html>
<html>
<head>
<title>

	Moderator | Forum

</title>
<style type="text/css" media="all">
body {
background-image:url('bg_gray.png');}
.freshdesignweb-top{
	line-height: 30px;
	font-size: 11px;
	text-transform: uppercase;
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
	list-style: none;
  padding: 0;
  margin: 0;
  background: rgba(0, 0, 0, 0.10);
  border-top: solid 2px #fff;
  border-bottom: solid 2px #fff;
  box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
 
}

.divide{
	margin-left:260px;
	width:60%;
	position:fixed;
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
}


.mainforum{
	position:relative;
	background-color: ;
	width:100%;
	align:center;
	cellpadding:3px;
	cellspacing:1px;
	font-family:Verdana, Geneva, sans-serif;
	
}


.view a{color:#000099;
	font-size: 16px;  
	font-family:Arial, Helvetica;
	float:right;}
.view a:hover{color:blue;
	text-decoration:underline;
	text-shadow: 0px 1px 1px #fff;
	}
	
	table {
    border-collapse: separate;
    border-spacing: 0;
    min-width: 350px;
}


table {
    border-collapse: ;
    border-spacing: 0;
    
}
table tr th,
table tr td {
    border-right: ;
    border-bottom: ;
    padding: 5px;
}
/* left border */
table tr th:first-child,
table tr td:first-child {
    border-left: ;
}

/* left border */
table tr th:first-child,
table tr td:first-child {
    border-left:;
}
table tr th {
    background: #eee;
    text-align: left;
}

table.Info tr th,
table.Info tr:first-child td
{
    border-top: ;
}

/* top-left border-radius */
table tr:first-child th:first-child,
table.Info tr:first-child td:first-child {
    border-top-left-radius: 20px;
}

/* top-right border-radius */
table tr:first-child th:last-child,
table.Info tr:first-child td:last-child {
    border-top-right-radius: 20px;
}

/* bottom-left border-radius */
table tr:first-child th:first-child,
 {
    border-bottom-left-radius: 50px;
}

/* bottom-right border-radius */
table tr:first-child th:last-child,
table.Info tr:first-child td:last-child {
    border-bottom-right-radius: 20px;
}
	
</style>

   

</head>


	
<?php
$tbl_name="fquestions"; // Table name

$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
// OREDER BY id DESC is order result by descending
 
$result=mysql_query($sql);

?>
  <div class="divide" align="center" >
  
<p class="view" bgcolor="#E6E6E6"><a href="moderator_new_topic.php"><strong>Create Topic</strong> </a></p>
  
<table class="mainforum" align="center" >
<tr>
<th width="50%" align="center" bgcolor=""><strong>Topic</strong></th>
<th width="10%" align="center" bgcolor=""><strong>Views</strong></th>
<th width="10%" align="center" bgcolor=""><strong>Replies</strong></th>
<th width="15%" align="center" bgcolor=""><strong>Date/Time</strong></th>
</tr>
 
<?php
 
// Start looping table row
while($rows = mysql_fetch_array($result)){
?>
<tr>

<td bgcolor=""><a href="moderator_view_topic.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['topic']; ?></a><BR></td>
<td align="center" bgcolor=""><?php echo $rows['view']; ?></td>
<td align="center" bgcolor=""><?php echo $rows['reply']; ?></td>
<td align="center" bgcolor=""><?php echo $rows['datetime']; ?></td>
</tr>
 
<?php
// Exit looping and close connection
}
mysql_close();
?>
 


</table>
</div>
</div>
</body>
</html>