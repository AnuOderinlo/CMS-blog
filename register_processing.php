<?php 
 require 'classes/init.php';

 if (isset($_POST["submit"])) {
   // echo "is it working";
    $data  = array();
    date_default_timezone_set("Africa/Lagos");
    $data["date"] = date("d/M/Y h:ia", time());
    $data["username"] = $validator->sanitize_string($_POST["username"]);
    $data["fullname"] = $validator->sanitize_string ($_POST["fullname"]);
    $data["email"] = $validator->sanitize_string ($_POST["email"]);
    $data["password"] = $validator->sanitize_string($_POST["password"]);
    $data["confirm_password"] = $validator->sanitize_string($_POST["confirm_password"]);
    $data["tokenCrf"] = $validator->sanitize_string($_POST["token"]);


    // echo $data["tokenCrf"];



    if ($validator->checkToken($data["tokenCrf"])) {
      if (empty($data["username"])||empty($data["password"])||empty($data["confirm_password"])||empty($data["name"])) {
        // $_SESSION["errorMessage"] = "Field(s) can't be empty";
        echo "Field(s) can't be empty";
        // Redirect("addAdmin.php");
      }elseif (strlen($data["password"])< 4) {
        // $_SESSION["errorMessage"] = "Password  characters can not be less than 4";
        echo "Password  characters can not be less than 4";
        // Redirect("addAdmin.php");
      }elseif ($data["password"] !== $data["confirm_password"]) {
        // $_SESSION["errorMessage"] = "Passwords doesn't match";
        echo "Passwords doesn't match";
        // Redirect("addAdmin.php");
      }elseif ($user->check_email($data["email"])) {
        // $_SESSION["errorMessage"] = "Passwords doesn't match";
        echo "Email already exist, use another one";
        // Redirect("addAdmin.php");
      }elseif ($user->checkUsername($data["username"])) {
        // $_SESSION["errorMessage"] = "Username already exist, use another one";
        echo "Username already exist, use another one";
        // Redirect("addAdmin.php");
      }elseif (!$validator->form_validator($data["email"])) {
        // $_SESSION["errorMessage"] = "Username already exist, use another one";
        echo "Incorrect email address";
        // Redirect("addAdmin.php");
      }else{
        // $user->create_admin($data);

        if ($user->register_user($data)) {
          // $_SESSION["successMessage"] = "Successfully created an admin";
          echo "An email has been seen to you to verify";  

          /*
            Send Email
          */




          // Redirect("addAdmin.php");
        }else{
          // $_SESSION["errorMessage"] = "Couldn't create an admin, something went wrong";
          echo "something went wrong";  
          // Redirect("addAdmin.php");
        }
      }
    }else{
      unset($_SESSION['token_time']);
      unset($_SESSION['crf_token']);
      echo "You need to refresh this page <a href=''>Click here</a> <br>";
      echo $data["tokenCrf"];
    }

    
 }






































 ?>