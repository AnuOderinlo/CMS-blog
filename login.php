<?php 
  // require_once 'include/session.php';
  // require_once 'include/functions.php';
  // require_once 'include/config.php';
  require_once 'classes/init.php';

  

  if (isset($_SESSION['adminId'])) {
    Redirect('dashboard.php');
  }

  if (isset($_POST['submit'])) {
    $username = $validator->sanitize_string($_POST['username']);
    $password = $validator->sanitize_string($_POST['password']);
   
    $accountValid = $user->verify_user($username, $password);
    if ($accountValid) {
      $_SESSION["adminName"] = $accountValid->adminName;
      $_SESSION["username"] = $accountValid->username;
      $_SESSION["adminId"] = $accountValid->id;
      $_SESSION["about"] = $accountValid->about;
      $_SESSION["headline"] = $accountValid->headline;
      $_SESSION["about"] = $accountValid->image;
      $_SESSION["authority"] = $accountValid->authority;
      $session->set_success_message("Welcome ".$_SESSION["adminName"]);
      
      if ($_SESSION['trackingUrl']) {
        Redirect($_SESSION['trackingUrl']);
      }else{
        Redirect('dashboard.php');
      }
    }else{
      $session->set_error_message("Username, Email or Password is not correct");
      Redirect('login.php');
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
      
      <div class="row justify-content-center viewport-height align-items-center ">
        <div class="form-container">
          <?php echo $session->success_message(); ?>
          <?php echo $session->error_message(); ?>
          <form class="" action="login.php" method="post">
            <div class=" mb-3">
              <div class="card-header bg-dark text-white">
                <h5 class="text-white">Good to see you again!</h5>
              </div>
              <div class="card-body text-white ">
                <div class="form-group">
                  <label>Username or Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" text-white input-group-text border-0 custom-bg"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="text" name="username"  value="">
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" text-white input-group-text border-0 custom-bg"><i class="fas fa-lock"></i></span>
                    </div>
                    <input class="form-control border-0 " id="password" type="password" name="password"  value="">
                    <div class="input-group-append">
                      <span class=" text-white input-group-text border-0 custom-bg" style="cursor: pointer;" id="lock" onclick="showPassword()"><i class="fas fa-eye"></i></span>
                    </div>
                  </div>
                </div>
                <div>
                  <button type="submit" class="btn btn-block text-white  custom-bg" name="submit">Sign in</button>
                </div>
                <div class="text-center">
                  <p><a  class="text-white" href="forget_password.php">Forgot your password?</a> </p>
                  <p>Don't have an account? <a class="text-white"  href="register.php">Sign Up</a> </p>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
            <p>CMS theme built by | Anuoluwapo Oderinlo | &copy;<?php echo date("Y"); ?> All rights reserved</p>
          </div>
        </div>
      </div>
    </footer> -->
    
    
    <script type="text/javascript">
      let lock = document.getElementById('lock');
      let password = document.getElementById('password');

      function showPassword() {
        // console.log(password.type)
        if (password.type == 'password') {
          password.type = "text";
        }else{
          password.type = "password";
        }
      }


      $(document).ready(function () {
        $(".close").click(function () {
          $("#error").hide();
        })
      })
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script> -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    

    
  </body>
</html>