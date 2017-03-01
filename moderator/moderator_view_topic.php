<?php
 
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
include 'moderator_header.php';

 if (isset($_GET['moderator_id']) && $_GET['moderator_id'] != "") {
		$moderator_id = $_GET['moderator_id'];
	} else {
		$moderator_id = $_SESSION['moderator_id'];
	}
$query = mysql_query("SELECT * FROM moderator_user where moderator_id = $moderator_id")or die(mysql_error());
while($row = mysql_fetch_array( $query )) {

$tbl_name="fquestions"; // Table name
 

// get value of id that sent from address bar
$id=$_GET['id'];
$sql="SELECT * FROM $tbl_name WHERE id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
?>
 <!DOCTYPE html>
<html>
<head>
<title>

	Moderator | View Topic

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
.ttopic{
 border-width:400px;
 border-top:20px solid;
 border-bottom:3px solid;
 border-left:3px solid;
 border-right:3px solid;
 border-color:;
 cellpadding-left:10px; 
 cellpadding-right:10px;
 cellpadding-top:10px;
 cellpadding-bottom:10px;
 border-radius: 20px 20px 20px 20px;
}

table {
    border-collapse: separate;
    border-spacing: 0;
    min-width: 350px;
}
table tr tr,
table tr td {
    border-right: 1px solid #bbb;
    border-bottom: 1px solid #bbb;
    padding: 5px;
}
table tr tr:first-child,
table tr td:first-child {
    border-left: 1px solid #bbb;
}
table tr tr:first-child,
table tr td:first-child {
    border-left: 1px solid #bbb;
}
table tr tr {
    background: #eee;
    text-align: left;
}

table.Info tr tr,
table.Info tr:first-child td
{
    border-top: 1px solid #bbb;
}

/* top-left border-radius */
table tr:first-child th:first-child,
table.Info tr:first-child td:first-child {
    border-top-left-radius: 6px;
}

/* top-right border-radius */
table tr:first-child th:last-child,
table.Info tr:first-child td:last-child {
    border-top-right-radius: 6px;
}

/* bottom-left border-radius */
table tr:last-child td:first-child {
    border-bottom-left-radius: 6px;
}

/* bottom-right border-radius */
table tr:last-child td:last-child {
    border-bottom-right-radius: 6px;
}

</style>

    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/forum.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" media="all" />

</head>

			<br>
			
<form style="background-color:#FFFFFF" class="form">

<p class="contact"><strong style="color:#0066CC" >Topic : </strong><?php echo $rows['topic']; ?></p>
<p class="contact"><strong style="color:#0066CC" >Details :</strong> <?php echo $rows['detail']; ?></p>
<p class="contact"><strong style="color:#0066CC">By :</strong> <?php echo $rows['name']; ?> </p>
<p class="contact"><strong style="color:#0066CC">Email : </strong><?php echo $rows['email'];?></p>
<p class="contact"><strong style="color:#0066CC">Date/time : </strong><?php echo $rows['datetime']; ?></p>
<BR>
</form>
<BR>
 
<?php
 
$tbl_name2="fanswer"; // Switch to table "forum_answer"
$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id'";
$result2=mysql_query($sql2);
while($rows=mysql_fetch_array($result2)){
?>
 <form class="form">
<p class="contact"><strong style="color:#0066CC">Name : </strong><?php echo $rows['a_name']; ?></p>

<p class="contact"><strong style="color:#0066CC">Email : </strong><?php echo $rows['a_email']; ?></p>

<p class="contact"><strong style="color:#0066CC">Answer</strong></p>
<p style="margin-right:10px" class="contact"><?php echo $rows['a_answer']; ?></p>

<p class="contact"><strong style="color:#0066CC">Date/Time : </strong><?php echo $rows['a_datetime']; ?></p>

<br>
</form>
<br>

<?php
}
 
$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
$result3=mysql_query($sql3);
$rows=mysql_fetch_array($result3);
$view=$rows['view'];
 
// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
$result4=mysql_query($sql4);
}
 
// count more value
$addview=$view+1;
$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
$result5=mysql_query($sql5);
mysql_close();
?>
<form class="form" name="form1" method="post" action="moderator_add_answer.php">

<p class="contact"><strong style="color:#0066CC">Name</strong></p>
<p class="contact"><input name="a_name" type="text" id="a_name" size="45" value="<?php echo $row['fname'];?>"></td>

<p class="contact"><strong style="color:#0066CC">Email</strong></p>
<input name="a_email" type="text" id="a_email" size="45" value="<?php echo $row['email'];?>">

<p class="contact"><strong style="color:#0066CC">Answer</strong></p>
<textarea name="a_answer" cols="50" rows="10" id="a_answer" required=""></textarea>
<br>
<br>
<input name="id" type="hidden" value="<?php echo $id; ?>">

<input class="buttom" type="submit" name="Submit" value="Submit"> 
<input class="buttom" type="reset" name="Submit2" value="Reset">

</form>

<br>

<?php //  close  while  loop 
} 
?>
</div>
<br>

</body>
</html>