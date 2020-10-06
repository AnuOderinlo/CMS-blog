<?php 
	require_once 'classes/init.php';

	$session->logout();
	
	Redirect('login.php');

 ?>