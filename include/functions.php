<?php 
	require_once 'config.php';
	function Redirect($location)
	{
		header("Location:".$location);
		exit;
	}

/*This functions checks the existence of a username*/
	function checkUsername($username)
	{
		global $db;
		$sql = "SELECT username FROM admins WHERE username='$username'";
		$connect = $db->query($sql);

		$totalRow = mysqli_num_rows($connect);
		if ($totalRow == 1) {
			return true;
		}else{
			return false;
		}
	}

// This  functions verify Login details
	function verifyLogin($username, $password)
	{
		global $db;
		$sql= sprintf("SELECT * FROM admins WHERE username='%s' AND password='%s' LIMIT 1",
		        $db->real_escape_string($username),
		        $db->real_escape_string($password)
		  );
		$connect = $db->query($sql);
		$totalRow = mysqli_num_rows($connect);
		if ($totalRow == 1) {
		  return  $connect->fetch_assoc();
		}else{
		  return null;
		}
	}

	// This confirms if user has login
	function confirmLogin()
	{
		if ($_SESSION['adminId']) {
			return true;
		}else{
			$_SESSION["errorMessage"] = "Login required please!";
			Redirect('login.php');
		}
	}

	// This fucntions returns total number of rows in a table
	function totalRow($table)
	{
		global $db;
		$sql = "SELECT * FROM $table";
		$connect = $db->query($sql);

		$totalRow = mysqli_num_rows($connect);
		return $totalRow;
	}

	// This fucntions returns total number of rows depending on the status
	function comment($status, $id)
	{	
		global $db;
		$sql2 = "SELECT * FROM comments WHERE status= '$status' AND post_id='$id' ";
		$connect2 = $db->query($sql2);
		$totalRow = mysqli_num_rows($connect2);
		return $totalRow;
	}














?>