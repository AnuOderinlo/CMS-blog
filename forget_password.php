<?php 
  require_once 'classes/init.php';

  if (isset($_SESSION['adminId'])) {
    Redirect('dashboard.php');
  }


  if (isset($_POST['submit'])) {
    $token = bin2hex(random_bytes(32));
    $email = $validator->sanitize_string($_POST['email']);
    $expire_time = date("U") + 3600;
    $url = "http://localhost/cms-blog/restore_password.php?token=".$token;
    

    if ($validator->email_validator($email)) {
   
      if ($user->if_email_exist($email)) {
        /*
          Send email
        */
          $sql = "INSERT INTO password_recovery (email, activation_code, verification_time) VALUES (?, ?, ?)";
          $stmt = $database->prepare($sql);
          $stmt->bind_param("sss", $email,$token,$expire_time);
          if ($stmt->execute()) {

            /*SEND EMAIL*/
            

            
            $session->set_success_message("Please check your email");
            Redirect('forget_password.php');
          }else{
            $session->set_error_message("Something went wrong");
            Redirect('forget_password.php');
          }

      }else{
        $session->set_error_message("Email doesn't exist");
        Redirect('forget_password.php');
      }
      
    }else{
      // print_r($data);
      $session->set_error_message("Invalid Email or field is empty");
      Redirect('forget_password.php');
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

    <title>Forget password</title>
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
          <?php echo $session->success_message(); ?>
          <form class="" action="" method="post">
            <div class=" mb-3">
              <div class="card-header bg-dark text-white">
                <h5 class="text-white">Please enter your Email</h5>
              </div>
              <div class="card-body text-white ">
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" text-white input-group-text border-0 custom-bg"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input class="form-control" type="text" name="email"  value="">
                  </div>
                </div>
                <div>
                  <button type="submit" class="btn btn-block text-white  custom-bg" name="submit">Submit</button>
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