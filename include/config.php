<?php 
	define('MYSQL_HOST', 'localhost');
	define('MYSQL_USER', 'root');
	define('MYSQL_PASSWORD', '');
	define('MYSQL_DB', 'cms');

	$db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
	// if (isset($_SESSION["adminId"])) {
		// $admin_id= $_SESSION["adminId"];
		// $admin_status = $_SESSION["authority"];
	// }
	// confirmLogin(); 
	

?>