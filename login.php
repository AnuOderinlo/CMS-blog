<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';

  if (isset($_SESSION['adminId'])) {
    Redirect('dashboard.php');
  }

  if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (empty($username) || empty($password)) {
      $_SESSION["errorMessage"] = "Field(s) can't be empty";
      Redirect("login.php");
    }else{
      $accountValid = verifyLogin($username, $password);
      if ($accountValid) {
        $_SESSION["adminName"] = $accountValid['adminName'];
        $_SESSION["username"] = $accountValid['username'];
        $_SESSION["adminId"] = $accountValid['id'];
        $_SESSION["successMessage"] = "Welcome ".$_SESSION["adminName"];
        if ($_SESSION['trackingUrl']) {
          Redirect($_SESSION['trackingUrl']);
        }else{
          Redirect('dashboard.php');
        }
      }else{
        $_SESSION["errorMessage"] = "Username or password is not correct";
        Redirect('login.php');
      }

    }

  }


  
 ?>


<!doctype html>
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

    <title>Login</title>
  </head>
  <body>
    <header class="container-fluid bg-dark mb-3">
      <nav class="navbar navbar-dark navbar-expand-md container ">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Logo</a>
        
        <button class="navbar-toggler  navbar-light" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
   
       
      </nav>
      <div class="row bg-primary" style="height: 3.5px"></div>
    </header>

    <!-- Main Content -->
    <section class="container">
      
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <?php echo errorMessage(); 
                echo successMessage(); 
          ?>
          <form class="" action="login.php" method="post">
            <div class="card mb-3">
              <div class="card-header bg-secondary text-white">
                <h5 class="text-white">Good to see you again!</h5>
              </div>
              <div class="card-body text-white bg-dark">
                <div class="form-group">
                  <label>Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="text" name="username"  value="">
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input class="form-control" type="password" name="password"  value="">
                  </div>
                </div>
                <div>
                  <button type="submit" class="btn btn-info btn-block" name="submit">Sign in</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
            <p>CMS theme built by | Anuoluwapo Oderinlo | &copy;<?php echo date("Y"); ?> All rights reserved</p>
          </div>
        </div>
      </div>
    </footer>
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
  </body>
</html>