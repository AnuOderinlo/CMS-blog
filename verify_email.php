<?php 
  // require_once 'include/session.php';
  // require_once 'include/functions.php';
  // require_once 'include/config.php';
  require_once 'classes/init.php';

  

  if (isset($_SESSION['adminId'])) {
    Redirect('dashboard.php');
  }

  if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (empty($username) || empty($password)) {
      // $_SESSION["errorMessage"] = "Field(s) can't be empty";
      $session->set_error_message("Field can't be empty");
      Redirect("login.php");
    }else{
      $accountValid = $user->verify_user($username, $password);
      if ($accountValid) {
        $_SESSION["adminName"] = $accountValid->adminName;
        $_SESSION["username"] = $accountValid->username;
        $_SESSION["adminId"] = $accountValid->id;
        $_SESSION["about"] = $accountValid->about;
        $_SESSION["headline"] = $accountValid->headline;
        $_SESSION["about"] = $accountValid->image;
        $_SESSION["authority"] = $accountValid->authority;
        // $_SESSION["successMessage"] = "Welcome ".$_SESSION["adminName"];
        $session->set_success_message("Welcome ".$_SESSION["adminName"]);
        
        if ($_SESSION['trackingUrl']) {
          Redirect($_SESSION['trackingUrl']);
        }else{
          Redirect('dashboard.php');
        }
      }else{
        $session->set_error_message("Username or password is not correct");
        Redirect('login.php');
      }

    }

  }


  
 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="css/css/all.css">
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

    <title>Login</title>
  </head>
  <body class="login-body">
    <header class="container-fluid bg-dark mb-3">
      <nav class="navbar navbar-dark navbar-expand-md container ">
        <!-- Brand -->
        <a class="navbar-brand" href="blog.php">i<i class="font-weight-bold" style="color: red">Blog.com</i></a>
        
      </nav>
      <div class="row bg-light" style="height: 3.5px"></div>
    </header>

    <!-- Main Content -->
    <section class="container ">
      
      <div class="row justify-content-center ">
        <div class="custom-container bg-white p-5 text-center">
          <h1 class="text-success">Awesome! Please check your email or spam to verify your account</h1>
        </div>
      </div>
    </section>

   
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script> -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
  </body>
</html>