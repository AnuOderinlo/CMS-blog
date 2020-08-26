<?php 
  require_once 'include/session1.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  // $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  // confirmLogin();
  // echo $_POST["username"];
  if (isset($_POST["submit"])) {
    date_default_timezone_set("Africa/Lagos");
    $date = date("d/M/Y h:ia", time());
    $username = sanitizeString($_POST["username"]);
    $fullname = sanitizeString($_POST["fullname"]);
    $password = sanitizeString($_POST["password"]);
    $confirmPassword = sanitizeString($_POST["confirm_password"]);

    if (empty($username)||empty($password)||empty($fullname)) {
      $_SESSION["errorMessage"] = "Field(s) can't be empty";
      echo errorMessage();
    }elseif (strlen($password)< 4) {
      $_SESSION["errorMessage"] = "Password  characters can not be less than 4";
      echo errorMessage();
    }elseif ($password !== $confirmPassword) {
      $_SESSION["errorMessage"] = "Passwords doesn't match";
      echo errorMessage();
    }elseif (checkUsername($username)) {
      $_SESSION["errorMessage"] = "Username already exist, use another one";
      echo errorMessage();
    }else{
      $sql = "INSERT INTO admins (date, username, adminName, password) VALUES (?,?,?,?)";
      $connect = $db->prepare($sql);
      $connect->bind_param("ssss", $date, $username, $fullname, $password);
      $connect = $connect->execute();

      if ($connect) {
        $_SESSION["successMessage"] = "Please check your email";
        echo successMessage();
      }else{
        $_SESSION["errorMessage"] = "Something went wrong";
        echo errorMessage();
      }
    }
  }



 ?>
