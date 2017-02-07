<?php

	session_start();
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	/*<?php include 'tagger_user/tagger_login.php'; ?>
	<?php include 'tagger_user/tagger_register.php'; ?>
	
	include '../jc_login.php';
	/include '../jc_register.php';
	*/
	
	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['tagger_id'])!="" ) {
		header("Location:tagger_user/tagger_job_list.php");
		exit;
	}
	if ( isset($_SESSION['jc_id'])!="" ) {
		header("Location: jc_user/jc_dashboard.php");
		exit;
	}
	
	?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>User Index</title>
  <style type="text/css" media="all">
body {
 background:url('bg_gray.png');

}
.navigation{
	font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
	font-weight: 400;
	font-size: 11px;
	line-height: 30px;
	color: #3a2127;
	letter-spacing: 1px;
	text-transform: uppercase;
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
	list-style: none;
	background: rgba(0, 0, 0, 0.10);
	border-top: solid 2px #fff;
	border-bottom: solid 2px #fff;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
 
}
.clear {
  clear: both;
}

.navigation li {
  float: left;
}

.navigation li:hover {
  background: #fff;
}

.navigation li:first-child {
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 0px 0px 0px 0px;
}

.navigation li a {
  display: block;
  padding: 0px 10px;
  text-decoration: none;
  line-height: 30px;
  color: #333;
  text-shadow: 0px 1px 1px #fff;
  text-transform: uppercase;
  font-size: 11px;
  z-index: 9999
  
}

.navigation ul {
  display: none;
  position: fixed;
  list-style: none;
  margin-left: 3px;
  padding: 0 ;
  overflow: hidden;
}

.navigation ul li {
  float: none;
}

.navigation li:hover > ul {
  display: block;
 background: rgba(0, 0, 0, 0.10);
  border: solid 2px #fff;
  border-top: 0;
  
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
  
  -webkit-box-shadow:  0px 3px 3px 0px rgba(0, 0, 0, 0.25);
  box-shadow:  0px 3px 3px 0px rgba(0, 0, 0, 0.25);
}

.navigation li:hover > ul li:hover {
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}

.navigation li li a:hover {
 background: #fff;
}

.navigation ul li:last-child a,
.navigation ul li:last-child a:hover {
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}

input.MyButton {
width: 400px;
padding: 20px;
cursor: pointer;
font-weight: bold;
font-size: 150%;
background: #9ACD32;
color: #fff;
border: 1px solid #3366cc;
border-radius: 2px;
-moz-box-shadow:: 6px 6px 5px #999;
-webkit-box-shadow:: 6px 6px 5px #999;
box-shadow:: 6px 6px 5px #999;
}
input.MyButton:hover {
color: #ffff00;
background: #000;
border: 1px solid #fff;
-moz-box-shadow:: 5px 5px 4px #adadad;
-webkit-box-shadow:: 5px 5px 4px #adadad;
box-shadow:: 5px 5px 4px #adadad;
}

input.MyButton2 {
width: 400px;
padding: 20px;
cursor: pointer;
font-weight: bold;
font-size: 145%;
background: #9ACD32;
color: #fff;
border: 1px solid #3366cc;
border-radius: 2px;
-moz-box-shadow:: 6px 6px 5px #999;
-webkit-box-shadow:: 6px 6px 5px #999;
box-shadow:: 6px 6px 5px #999;
}
input.MyButton2:hover {
color: #ffff00;
background: #000;
border: 1px solid #fff;
-moz-box-shadow:: 5px 5px 4px #adadad;
-webkit-box-shadow:: 5px 5px 4px #adadad;
box-shadow:: 5px 5px 4px #adadad;
}
  </style>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  
</head>

<body>
  <div class="">
  
  <div class="">
    
  </div>
  
  <ul class="navigation">
  <li><a href="index.php" title=""><strong>Home</strong></a></li>
    
    <li><span class="right"><a href="" title=""><strong>Login</strong></a></span>
      <ul>
        <li><a href="tagger_user/tagger_login.php" title=""><strong>as Tagger</strong></a></li>
        <li><a href="jc_user/jc_login.php" title=""><strong>as Job Creator</a></li>
   </ul>
    </li>
    <li><a href="" title=""><strong>Signup</strong></a>
	  <ul>
        <li><a href="tagger_user/tagger_register.php" title=""><strong>as Tagger</strong></a></li>
        <li><a href="jc_user/jc_register.php" title=""><strong>as Job Creator</a></li>
   </ul>
   </li>
    <div class="clear"></div>
  </ul>
  
</div>

	
	<font size="6" color="black"> 
	<p style="margin-left:210px; margin-top:5px;"><img src="images/title.png" alt="homepage" width="180" height="70" style="margin-left:0px;"> upload tweets, create tweet, tagging jobs, get answers</p>

<div align="center">

	
	<font size="2" color="black"> 
	<p style="font-family: Georgia, serif; font-size:15px;">
	<br>&nbsp;&nbsp;Web-Based Platform for Manual Tagging of Tweets for Supervised Machine Learning Applications </p>


	&nbsp;&nbsp;&nbsp; 

	<h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Upload tweet   &nbsp;&nbsp;&nbsp; Want more tweet tagger? &nbsp;&nbsp;&nbsp; Give your result </h1> 

	&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; 
	<img src="images/Picture1.png" alt="HTML5 Icon" width="100" height="100"> 

	&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
	<img src="images/Picture2.png" alt="HTML5 Icon" width="100" height="100"> 
	&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	<img src="images/Picture3.png" alt="HTML5 Icon" width="100" height="100">

	<br> 

	<form>
	<p align="center"> 
	<input class="MyButton" type="button" value="SIGN-UP now and get result!" onclick="window.location.href='jc_user/jc_register.php'" /></p>
	</form> 

	&nbsp;&nbsp;&nbsp; 

	<h1> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Earn points   
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Exchange badges 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Be a top tagger 
	</h1> 
	
	<form>
	<p align="center"> 
	<input class="MyButton2" type="button" value="SIGN-UP now and earn points!" onclick="window.location.href='tagger_user/tagger_register.php'" /></p>
	</form> 
  
 </div>
  
</body>
</html>
