<?php 
 require 'classes/init.php';

 if (isset($_POST["submit"])) {
   // echo "is it working";
    $data  = array();
    date_default_timezone_set("Africa/Lagos");
    $data["date"] = date("d/M/Y h:ia", time());
    $data["username"] = $validator->sanitize_string($_POST["username"]);
    $data["name"] = $validator->sanitize_string ($_POST["name"]);
    $data["email"] = $validator->sanitize_string ($_POST["email"]);
    $data["password"] = $validator->sanitize_string($_POST["password"]);
    $data["confirmPassword"] = $validator->sanitize_string($_POST["confirmPassword"]);

    if (empty($data["username"])||empty($data["password"])||empty($data["confirmPassword"])||empty($data["name"])) {
      // $_SESSION["errorMessage"] = "Field(s) can't be empty";
      echo "Field(s) can't be empty";
      // Redirect("addAdmin.php");
    }elseif (strlen($data["password"])< 4) {
      // $_SESSION["errorMessage"] = "Password  characters can not be less than 4";
      echo "Password  characters can not be less than 4";
      // Redirect("addAdmin.php");
    }elseif ($data["password"] !== $data["confirmPassword"]) {
      // $_SESSION["errorMessage"] = "Passwords doesn't match";
      echo "Passwords doesn't match";
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

      if ($user->create_admin($data)) {
        // $_SESSION["successMessage"] = "Successfully created an admin";
        echo "Successfully created an admin";  
        // Redirect("addAdmin.php");
      }else{
        // $_SESSION["errorMessage"] = "Couldn't create an admin, something went wrong";
        echo "Couldn't create an admin, something went wrong";  
        // Redirect("addAdmin.php");
      }
    }
 }






































 ?>