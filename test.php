<?php 
  session_start();

    // public static function crfToken(){
    //   if(empty($_SESSION['crf_token'])){
    //     $_SESSION['crf_token'] = bin2hex(random_bytes(32));
    //     htmlentities($_SESSION['crf_token'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); 
    //   }

    //   return $_SESSION['crf_token'];
    // }

    $_SESSION['crf_token'] = bin2hex(random_bytes(32));


    if (!empty($_SESSION['crf_token'])) {
      $token = $_SESSION['crf_token'];
    }
 /* $data = "EseOkwi";
  $encode = base64_encode($data);
  $decode = base64_decode($encode);
  $fullName = explode(" ", $data);
  $value = [];
  $value2 = [];

  for ($i=0; $i < 5 ; $i++) { 
    $value[$i] = "?";
    $value2[$i] = "s";
  }
  // print_r($value);

  echo "<pre>";
    echo implode(",", $value)."<br>";
    echo implode("", $value2);
  echo "</pre>";*/

  $newPassword = substr(md5(uniqid()),0,7);
  $string = "password";
  $time = time() + 3600;
  // echo $newPassword;
  // echo bin2hex(random_bytes(32));
  echo  $token


 ?>