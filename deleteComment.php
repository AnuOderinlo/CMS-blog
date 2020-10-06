<?php 
	require_once 'classes/init.php';
	
	if (empty($_GET['id'])) {
		redirect('comment.php');
	}

	if (isset($_GET['id'])) {
		$id=$_GET['id'];
	}
	$comment = Comment::find_by_id($_GET['id']);

	if ($comment) {
		$comment->delete();
		redirect('comment.php');
	}else{
		redirect('comment.php');
	}

 ?>