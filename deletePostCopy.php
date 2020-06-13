<?php 
  require_once 'include/config.php';
  require_once 'include/session.php';
  require_once 'include/functions.php';
  /*$sql = "SELECT * FROM posts WHERE id='$id'";
  $connect = $db->query($sql);
  foreach ($connect as $row) {
    var_dump($row);
  }*/
  if (isset($_POST["submit"])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM posts WHERE id='$id'";
    $connect = $db->query($sql);
  
    if ($connect) {
      $_SESSION["successMessage"] = "Successfully Deleted a post";
      Redirect("post.php");
    }else{
      $_SESSION["errorMessage"] = "Couldn't Delete the post, something went wrong!";
      Redirect("post.php");[]
    }
   }
 ?>

