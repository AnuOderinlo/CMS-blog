<?php 
  // require_once 'include/session.php';
  // require_once 'include/functions.php';
  // require_once 'include/config.php';
  require_once 'classes/init.php';

  

  if (isset($_SESSION['adminId'])) {
    Redirect('dashboard.php');
  }

  if (isset($_POST['submit'])) {
    $email =trim($_POST['email']);
    $sql = "SELECT * from login WHERE email='$email'";
    $connect = $db->query($sql);
    if ($connect) {
      $totalRow = mysqli_num_rows($connect);
      if ($totalRow == 1) {
        $newPassword = substr(md5(uniqid()),0,5);
        $sql = "UPDATE login SET password='$newPassword', time='time()' WHERE email='$email'";
        $connect = $db->query($sql);
        if ($connect == false) {
          echo "Didnt connect";
        }

        $receiver = $email;
        $subject = "Reset Password";
        $message =  <<<email
                  Dear user,
                  Click on the following link to reset your password:
                  http://localhost/cms-blog/restorePassword.php
                  New Password: {$newPassword}

                  email;
        $sender = "From: oderinloanuoluwapo@gmail.com";
        mail($receiver, $subject, $message);


        $_SESSION["successMessage"] = "Please check your Email for new password";
        Redirect('forgetPassword.php');
      }else{
        $_SESSION["errorMessage"] = "Email not found";
        Redirect('forgetPassword.php');
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
      
      <div class="row justify-content-center viewport-height align-items-center ">
        <div class="form-container">
          <?php echo $session->error_message(); ?>
          <form class="" action="" method="post">
            <div class=" mb-3">
              <div class="card-header bg-dark text-white">
                <h5 class="text-white">Create a new password</h5>
              </div>
              <div class="card-body text-white ">
                <div class="form-group">
                  <label>Token</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" text-white input-group-text border-0 custom-bg"><i class="fas fa-key"></i></span>
                    </div>
                    <input class="form-control" type="text" name="token"  value="">
                  </div>
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" text-white input-group-text border-0 custom-bg"><i class="fas fa-lock"></i></span>
                    </div>
                    <input class="form-control" type="text" name="new_password"  value="">
                  </div>
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" text-white input-group-text border-0 custom-bg"><i class="fas fa-lock"></i></span>
                    </div>
                    <input class="form-control" type="text" name="confirm_password"  value="">
                  </div>
                </div>
                
                <div>
                  <button type="submit" class="btn btn-block text-white  custom-bg" name="submit">Create</button>
                </div>
                <div class="text-center">
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