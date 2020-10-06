<?php 
	require_once 'classes/init.php';

	if (empty($_GET['id'])) {
		redirect('categories.php');
	}

	if (isset($_GET['id'])) {
		$id=$_GET['id'];
	}
	$category = Comment::find_by_id($_GET['id']);

	if ($category) {
		$category->delete();
		redirect('categories.php');
	}else{
		redirect('categories.php');
	}
 ?>