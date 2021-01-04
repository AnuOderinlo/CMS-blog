<?php 
  
  require_once 'classes/init.php';

  if (isset($_SESSION['adminId'])) {
    Redirect('dashboard.php');
  }

  if (isset($_GET["token"]) && !empty($_GET["token"])) {
    $token = $_GET["token"];
  }else{
    Redirect("register.php");
  }

  $sql = "SELECT email, activation_code, verification_time FROM password_recovery WHERE activation_code=?";
  $stmt = $database->prepare($sql);
  $stmt->bind_param("s", $token);
  $stmt->execute();
  $result = $stmt->get_result();

  foreach ($result as $row) {
    $expiryTime = $row['verification_time'];
    $tokenDB = $row['activation_code'];
    $email = $row['email'];
  }

 
  if (isset($_POST['submit'])) {
    $new_password = $validator->sanitize_string($_POST['new_password']);
    $confirm_password = $validator->sanitize_string($_POST['confirm_password']);

    if (time() < $expiryTime && $token === $tokenDB) {

      if ($new_password === $confirm_password) {

        $password = $password->password_hashing($new_password);

        /*Update the password in Admin table*/
        $user->update_password($password, $email);

        /*Delete the record where activation_ code is active from password_recovery table*/
        $password->delete_password_token($token);


        $session->set_success_message("Password successfully changed");
        Redirect('login.php');
      }else{
        $session->set_error_message("Password(s) doesn't match");
        Redirect('restore_password.php?token='.$token);
      }

    }else{
     /*Delete the record where activation_ code is active from password_recovery table*/
      $password->delete_password_token($token);
      
      $session->set_error_message("Time Expired!!!");
      Redirect("forget_password.php");
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

    <title>Change password</title>
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
                  <label>New Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" text-white input-group-text border-0 custom-bg"><i class="fas fa-lock"></i></span>
                    </div>
                    <input class="form-control" type="password" name="new_password"  value="">
                  </div>
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" text-white input-group-text border-0 custom-bg"><i class="fas fa-lock"></i></span>
                    </div>
                    <input class="form-control" type="password" name="confirm_password"  value="">
                  </div>
                </div>
                
                <div>
                  <button type="submit" class="btn btn-block text-white  custom-bg" name="submit">Reset password</button>
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