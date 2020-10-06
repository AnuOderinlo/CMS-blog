<?php 

	function classAutoLoader($class) {
		$class = strtolower($class);
		$path = "includes/".$class.".php";

		if (is_file($path) && !class_exists($class)) {
			include($path);
		}
	}
	

	spl_autoload_register('classAutoLoader');


		// require_once 'config.php';
		function Redirect($location)
		{
			header("Location:".$location);
			exit;
		}

	

		// This fucntions returns total number of rows in a table
		function totalRow($table)
		{
			global $database;
			$sql = "SELECT * FROM $table";
			$connect = $database->query($sql);

			$totalRow = mysqli_num_rows($connect);
			return $totalRow;
		}

		function totalRowPost($table)
		{
			global $database;
			$sql = "SELECT * FROM $table WHERE admin_id=$admin_id";
			$connect = $database->query($sql);

			$totalRow = mysqli_num_rows($connect);
			return $totalRow;
		}


		function getSessionId(){
			session_id();
			session_regenerate_id();
		}

		





	


 ?>