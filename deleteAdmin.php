<?php 
	require_once 'classes/init.php';
		
		if (empty($_GET['id'])) {
			redirect('addAdmin.php');
		}

		if (isset($_GET['id'])) {
			$id=$_GET['id'];
		}
		$user = User::find_by_id($_GET['id']);

		if ($user) {
			$user->delete();
			redirect('addAdmin.php');
		}else{
			redirect('addAdmin.php');
		}

 ?>