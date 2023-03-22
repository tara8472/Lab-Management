<?php
	//Destroy the session so that no one can login using the previous session
	session_start();
	session_unset();
	session_destroy();
	header("location:login.php");
?>
