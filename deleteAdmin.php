<?php 
	require_once 'include/session.php';
	require_once 'include/functions.php';
	require_once 'include/config.php';

	if (isset($_GET['id'])) {
		$id=$_GET['id'];
	}
	$admin = $_SESSION["adminName"];
	$sql = "DELETE FROM admins WHERE id='$id'";
	$connect = $db->query($sql);

	if ($connect) {
		$_SESSION["successMessage"] = "Successfully deleted an Admiin";
		Redirect('addAdmin.php');
	}else{
		$_SESSION["errorMessage"] = "Something went wrong! unabale to delete";
		Redirect('addAdmin.php');
	}

 ?>