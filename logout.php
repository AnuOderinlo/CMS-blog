<?php 
	require_once 'include/session.php';
	require_once 'include/functions.php';
	require_once 'include/config.php';

	$_SESSION["adminName"] = null;
	$_SESSION["username"] = null;
	$_SESSION["adminId"] = null;
	session_destroy();
	
	Redirect('login.php');

 ?>