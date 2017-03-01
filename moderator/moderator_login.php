<?php

session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

$errormsg="";

if (isset($_POST['login'])) {
	
	$email=$_POST['email'];
    $password=($_POST['password']);
	
	
	$query = mysql_query("SELECT * FROM moderator_user where 
	email = '$email' AND 
	password ='$password'");

	
	$row = mysql_fetch_array($query);
	$count = mysql_num_rows($query);	

	if( $count == 1 && $row['password']==$password ){
		$_SESSION['moderator_id'] = $row['moderator_id'];
		$_SESSION['usr_name'] = $row['fname'];
		header("Location: moderator_dashboard.php");
	}
	if($row) {
			$_SESSION["tagger_id"] = $row["tagger_id"];
			
			if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}
	}
	else {
		$errormsg = "Incorrect Email or Password!!!";
	}
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Moderator | Login </title>
		  <style type="text/css" media="all">
body {
 background:url('bg_gray.png');
}
.form{border-radius: 10px 10px 10px 10px;}
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
				
                <span class="right"><a href="moderator_login.php"><strong>Login</strong></a></span>
                
				<div class="clr"></div>
				
				</div>
			
			

					<header>
					<h1><span>Moderator</span>Login</h1> 
					</header>    

								
						<div  class="form">
							<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform"> 
								<div class="loginmessage"><?php if(isset($errormsg)) echo $errormsg; ?></div>
								
								<p class="contact"><label for="email">Email</label></p>
								<input type="text" name="email" placeholder="example@domain.com" required="" tabindex="1" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
			
								<p class="contact"><label for="password">Password</label></p>
								<input type="password" name="password" placeholder="password" required="" tabindex="1" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>">								
								
								<p class="contact">Remember me:
								<input type="checkbox" checked="checked" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> /></p>
									
								<p class="row" ><input class="buttom" name="login" id="" value="Login" type="submit" tabindex="5">
																
							   <a href="forgot.php">Forgot Password?</a></p>
									
							</form> 
								
						</div>  
				    
			</div>
	</div>
		</body>
</html>
