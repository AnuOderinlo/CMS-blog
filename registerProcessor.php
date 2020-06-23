<?php 
  /*require_once 'include/session.php';*/
  require_once 'include/functions.php';
  require_once 'include/config.php';

  session_start();
  getSessionId();//regenerate another session ID

  if(isset($_SESSION['user_login'])) destroySession();

  if(empty($_SESSION['token']) && empty($_SESSION['token_time'])){
    $_SESSION['token'] = uniqid();
    $_SESSION['token_time'] = time() + 3600;
  }

  $token =  $_SESSION['token'];
  $token_time =  $_SESSION['token_time'];

  $error = NULL;

  if(isset($_POST['submit'])){
    $submit = sanitizeString($_POST['submit']);
    $username = sanitizeString($_POST['username']);
    $firstname = sanitizeString($_POST['firstname']);
    $lastname = sanitizeString($_POST['lastname']);
    $password = sanitizeString($_POST['password']);
    $tokenCRF =  sanitizeString($_POST['token']);
  

    if(!empty($tokenCRF) && time() < $token_time){
    if($tokenCRF=== $token){
    if(!empty($username)){
      $error="yeah";
    }
    else{
      $error = "Pleaser enter your email address";
    }
    }
    else{
      $error = "Please you need to refresh the page <a href=''>Refresh</a>";
    }
    }
    else{
       unset($_SESSION['token']);
       unset($_SESSION['token_time']);
      $error = "Please you need to refresh the page <a href=''>Refresh</a>";
    }

    echo $error;
  }




 ?>
