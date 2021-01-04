<?php 
  require_once 'classes/init.php';

  if (empty($_GET['id'])) {
    redirect('post.php');
  }

  if (isset($_GET['id'])) {
    $id=$_GET['id'];
  }
  $post = Post::find_by_id($_GET['id']);

  if ($post) {
    $post->delete();
    redirect('post.php');
  }else{
    redirect('post.php');
  }
 ?>