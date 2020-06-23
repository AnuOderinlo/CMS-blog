<?php 
  /*require_once 'include/session.php';*/
  require_once 'include/functions.php';
  require_once 'include/config.php';

  session_start();
  getSessionId();

  if(isset($_SESSION['user_login'])) destroySession();

  if(empty($_SESSION['token']) && empty($_SESSION['token_time'])){
    $_SESSION['token'] = uniqid();
    $_SESSION['token_time'] = time() + 3600;
  }

  $token =  $_SESSION['token'];
  
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
   <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>

    <title>Login</title>
  </head>
  <body>
    <header class="container-fluid bg-dark mb-3">
      <nav class="navbar navbar-dark navbar-expand-md container ">
        <!-- Brand -->
        <a class="navbar-brand" href="blog.php">Logo</a>
        
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
          <form class="registerationForm" action="" method="post">

             <input type="hidden" value="<?php echo $token; ?>" name="token">
            <div class="card mb-3">
              <div class="card-header bg-secondary text-white">
                <h5 class="text-white errorMsg">Good to see you again!</h5>
              </div>
              <div class="card-body text-white bg-dark">
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="email" name="username"  value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Firstname</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="text" name="firstname"  value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>lastname</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="text" name="lastname"  value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-eye" style="cursor: pointer;" onclick="showPassword()"></i></span>
                    </div>
                    <input class="form-control" type="password" name="password" id="password"  value="">
                  </div>
                </div>
                <div>
                   <input type="hidden" name="submit">
                  <button type="submit" class="btn btn-info btn-block" name="submit">Register</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

<script type="text/javascript">
  function showPassword(){
    var hide = document.getElementById("password");
    if(hide.type === "password"){
        hide.type = "text";
    }
    else{
      hide.type = "password";
    }
  }



$(document).ready(function(event){
  $(".registerationForm").on("submit", (function(event){
    event.preventDefault();

    $.ajax({
      url:"registerProcessor.php",
      method:"POST",
      data: new FormData(this),
      contentType: false,
      processData: false,
      success:function(data){
        if(data == "yeah"){
          $(".registerationForm")[0].reset();
          $(".errorMsg").html("Good to see you again!");
        }
        else{
          $(".errorMsg").html(data);
        }
        
      }
    })
  }))
})
</script>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>