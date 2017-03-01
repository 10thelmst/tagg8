<?php
session_start();
include 'moderator_header.php';

include_once("dbcontroller.php");
$db_handle = new DBController();

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

	Moderator | Dashboard

</title>
  <style type="text/css" media="all">
body {
 background:url('bg_gray.png');

}
</style>


</head>

	
		</div>
		<?php //  close  while  loop 
} 
?>
</body>
</html>
