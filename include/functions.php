<?php 
	// require_once 'config.php';
	

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

	

	function totalRowPost($table)
	{
		global $db;
		$sql = "SELECT * FROM $table WHERE admin_id=$admin_id";
		$connect = $db->query($sql);

		$totalRow = mysqli_num_rows($connect);
		return $totalRow;
	}



	// This fucntions returns total number of rows depending on the status
	function comment($id)
	{	
		global $db;
		$sql2 = "SELECT * FROM comments WHERE  post_id='$id' ";
		$connect2 = $db->query($sql2);
		$totalRow = mysqli_num_rows($connect2);
		return $totalRow;
	}


function getSessionId(){
session_id();
	session_regenerate_id();
}

// serialize input
function sanitizeString($var){
	global $db;
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripslashes($var);
	$var = filter_var($var, FILTER_SANITIZE_STRING);
	return $db->real_escape_string(trim($var));
}

// Validate user input
function validator($data)
{
	// validate EMAIL
	if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
		if (preg_match("/[a-zA-Z0-9_.]{3,}@[a-zA-Z]{4,}[.]{1}[a-zA-Z0-9.]{2,}/", $data)) {
			return $data;
		}
	}
	// validate PHONE NUMBER
	if (filter_var($data, FILTER_SANITIZE_NUMBER_INT)) {
		return $data;
	}
	// validate URL
	if (filter_var($data, FILTER_VALIDATE_URL)) {
		if (preg_match("/(https:|ftp:)\/\/+[a-zA-Z.0-9\?&\%\$\-\#]+\.[a-zA-Z.0-9\?&\%\$\-\#\/\_]*/", $data)) {
			return $data;
		}
	}
}



function check_super_admin(){
	global $db;
	$sql = "SELECT * FROM admins";
	$connect = $db->query($sql);
	while ( $row = $connect->fetch_assoc()) {
		$admin_status = $row["authority"];
		if ($admin_status == "super_admin") {
			return $admin_status;
		}
	}
	

}

// check_admin()









?>