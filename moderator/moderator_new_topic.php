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

?>


<!DOCTYPE html>
<html>
<head>
<title>

	Tagger | Post

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
</style>

</head>

			<br>
			<br>
			

<form class="form" id="form1" name="form1" method="post" action="moderator_add_new_topic.php">
<p class="contact"><strong>Post New Topic</strong> </p>

<p style="color:#0066CC"  class="contact"><strong>Topic</strong></p>
<input name="topic" type="text" id="topic" size="50" required=""/>

<p  style="color:#0066CC" class="contact"><strong>Detail</strong></p>
<textarea name="detail" cols="50" rows="10" id="detail" required=""></textarea>


<p style="color:#0066CC"  class="contact"><strong>Name</strong></p>
<input name="name" type="text" id="name" size="50" value="<?php echo $row['fname'];?>"/>

<p style="color:#0066CC"  class="contact"><strong>Email</strong></p>
<input name="email" type="text" id="email" size="50" value="<?php echo $row['email'];?>"/>

<input class="buttom" type="submit" name="Submit" value="Submit" />
<input class="buttom" type="reset" name="Submit2" value="Reset" />

</form>

<?php //  close  while  loop 
} 
?>
</div>
</body>
</html>