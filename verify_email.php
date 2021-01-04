<?php 
  // require_once 'include/session.php';
  // require_once 'include/functions.php';
  // require_once 'include/config.php';
  require_once 'classes/init.php';

  if (isset($_GET["vkey"]) && !empty($_GET["vkey"])){
    $vkey = $_GET['vkey'];
    $sql= "SELECT activation, code FROM admins WHERE activation= 'inactive' AND code='$vkey' LIMIT 1";
    $select = $database->query($sql);

    if ($select) {
      $sql = "UPDATE admins SET activation = 'active' WHERE code = '$vkey' LIMIT 1";
      $update = $database->prepare($sql);
      if ( $update->execute()) {
        $session->set_success_message("Account Verified, you can login");
        Redirect("login.php");
      }else{
        echo "Something is wrong";
        Redirect("register.php");
      }

    }else{
      // echo "This account is invalid or already verified";
      $session->set_error_message("This account is invalid or already verified");
      Redirect("register.php");
    }
  }else{
    $session->set_error_message("This acccount is invalid");
    Redirect("register.php");
  }


  
 ?>


