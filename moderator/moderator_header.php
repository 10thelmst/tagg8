<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/forum.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" media="all" />
	
</head>

<body>
		<div class="container">
			<div class="freshdesignweb-top">
				<a href="moderator_dashboard.php" style="margin-left:15px;">Home</a>
		        <a href="moderator_profile.php">Profile</a>
				<a href="moderator_pending_request.php">Pending Request</a>
				<a href="moderator_job_creator_list.php">Job Creator List</a>
				<a href="moderator_main_forum.php">Forum</a>

                <span class="right">
                    <a href="moderator_logout.php">
						<strong>Logout</strong>
                    </a>	
               	</span>
				
				    <span class="loginas">
					Signin as <strong><?php echo $_SESSION['usr_name']; ?></strong>
				 	</span>
					
                <div class="clr"></div>
				
			</div>
			<br>