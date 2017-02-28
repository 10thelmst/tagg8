<?php

	session_start();
	if (!isset($_SESSION['tagger_id']) || (!isset($_SESSION['jc_id']))) {
    echo 'the session is either empty or doesn\'t exist';
		sleep(2);
		header("Location: ../index.php");

	}


	?>