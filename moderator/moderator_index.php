<?php

	session_start();
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	
	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['moderator_id'])!="" ) {
		header("Location: moderator_dashboard.php");
		exit;
	}
	
	?>

<!DOCTYPE html>
<html>
	<head>
		<title>Moderator | Index </title>
		  <style type="text/css" media="all">
body {
 background:url('bg_gray.png');

}
</style>

		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
		<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" media="all" />
	

	</head>

		<body>
			<div class="container">
			
				<div class="freshdesignweb-top">
					
				<a href="moderator_index.php" style="margin-left:15px;"><strong>Home</strong></a>
				
					<span class="right">
					<a href="moderator_login.php"><strong>Login</strong>
					</a>
					</span>
					
					
					<div class="clr"></div>
					
				</div>	
			</div> 
			
		</body>
</html>
