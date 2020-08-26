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
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

    <title>Register</title>
  </head>
  <body>
    <header class="container-fluid bg-dark mb-3">
      <nav class="navbar navbar-dark navbar-expand-md container ">
        <!-- Brand -->
        <a class="navbar-brand" href="blog.php">i<i class="font-weight-bold" style="color: red">Blog.com</i></a>
        
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
                <h5 class="text-white errorMsg" id="err">Just a step to become a blogger</h5>
              </div>
              <div class="card-body text-white bg-dark">
                <div class="form-group">
                  <label>Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="text" name="username" placeholder="JohnD" value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Full name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="text" name="fullname" placeholder="Firstname Lastname"  value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input class="form-control" type="email" name="email" placeholder="johndoe@gmail.com"  value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-lock" style="cursor: pointer;" onclick="showPassword()"></i></span>
                    </div>
                    <input class="form-control" type="password" name="password" id="password"  value="">
                    <div class="input-group-append">
                      <span class="bg-info text-white input-group-text" style="cursor: pointer;" id="lock" onclick="showPassword()"><i class="fas fa-eye"></i></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Confirm Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="bg-info text-white input-group-text"><i class="fas fa-lock" style="cursor: pointer;" onclick="showPassword()"></i></span>
                    </div>
                    <input class="form-control" type="password" name="confirm_password" id="cPassword" placeholder="Retype password"  value="">
                    <div class="input-group-append">
                      <span class="bg-info text-white input-group-text" style="cursor: pointer;" id="lock" onclick="showPassword()"><i class="fas fa-eye"></i></span>
                    </div>
                  </div>
                </div>
                
                <div>
                  <input type="hidden" name="submit">
                  <button type="submit" id="btn" class="btn btn-info btn-block" name="submit">Register</button>
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

  // $(document).ready(function(){
  //   $('#password #cPassword').bind("copy cut paste",function(e) {
  //      console.log("You can't copy the password, just retype it");
  //      e.preventDefault();
  //   });
  // });

  let password_value = document.getElementById("password"); 
  let confirm_password_value = document.getElementById("cPassword"); 
  let err = document.getElementById("err"); 
  // Password validation
  let btn = document.getElementById("btn");

  btn.addEventListener("click", function (e) {
    e.preventDefault();
    if (password_value.value !== confirm_password_value.value ) {
      err.innerHTML = '<span style="color:red">Password don\'t match</span>'
    }
  } ,false)


  



  // $(document).ready(function(){
  //   $("#password").keydown(function(event) {
  //       if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
  //           alert('thou. shalt. not. PASTE!');
  //           event.preventDefault();
  //        }
  //   });


  //   $(".registerationForm").on("submit", (function(event){
  //     event.preventDefault();

  //     $.ajax({
  //       url:"registerProcessor.php",
  //       method:"POST",
  //       data: new FormData(this),
  //       contentType: false,
  //       processData: false,
  //       success:function(data){
  //         if(data == "yeah"){
  //           $(".registerationForm")[0].reset();
  //           $(".errorMsg").html("Good to see you again!");
  //         }
  //         else{
  //           $(".errorMsg").html(data);
  //         }
          
  //       }
  //     })
  //   }))
  // })
</script>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>