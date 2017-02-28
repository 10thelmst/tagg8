<?php
session_start();
unset($_SESSION["jc_id"]);
unset($_SESSION["usr_name"]);
session_unset();
session_destroy();
header("Location: ../index.php");
		exit;
?>