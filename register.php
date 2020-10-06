<?php 
  // require_once ("register_processing.php"); 
  
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
  <body class="login-body">
    <header class="container-fluid bg-dark mb-3">
      <nav class="navbar navbar-dark navbar-expand-md container ">
        <!-- Brand -->
        <a class="navbar-brand" href="blog.php">i<i class="font-weight-bold" style="color: red">Blog.com</i></a>
        
        <button class="navbar-toggler  navbar-light" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
   
       
      </nav>
      <div class="row bg-light" style="height: 3.5px"></div>
    </header>

    <!-- Main Content -->
    <section class="container">

      
      <div class="row  justify-content-center viewport-height align-items-center ">
        <div class="form-container">
          <form class="registerationForm" action="register_processing.php" method="post">

            <input type="hidden" value="<?php echo $token; ?>" name="token">
            <div class=" mb-3">
              <div class="card-header bg-secondary text-white ">
                <h5 class="text-white errorMsg" id="err">Just a step to become a blogger</h5>
              </div>
              <div class="card-body text-white">
                <div class="form-group">
                  <label>Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" custom-bg  border-0  text-white input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="text" name="username" placeholder="JohnD" value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Full name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" custom-bg  border-0  text-white input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" type="text" name="fullname" placeholder="Firstname Lastname"  value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" custom-bg  border-0  text-white input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input class="form-control" type="email" name="email" placeholder="youremail@xxxx.com"  value="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" custom-bg  border-0  text-white input-group-text"><i class="fas fa-lock" style="cursor: pointer;" onclick="showPassword()"></i></span>
                    </div>
                    <input class="form-control border-0 " type="password" name="password" id="password"  value="">
                    <div class="input-group-append">
                      <span class=" custom-bg  border-0  text-white input-group-text" style="cursor: pointer;" id="lock" onclick="showPassword()"><i class="fas fa-eye"></i></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Confirm Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class=" custom-bg  border-0  text-white input-group-text"><i class="fas fa-lock" style="cursor: pointer;" onclick="showPassword()"></i></span>
                    </div>
                    <input class="form-control border-0 " type="password" name="confirm_password" id="cPassword" placeholder="Retype password"  value="">
                    <div class="input-group-append">
                      <span class=" custom-bg  border-0  text-white input-group-text" style="cursor: pointer;" id="lock" onclick="showPassword()"><i class="fas fa-eye"></i></span>
                    </div>
                  </div>
                </div>
                
                <div>
                  <input type="hidden" name="submit">
                  <button type="submit" class="btn text-white btn-block custom-bg" name="submit">Register</button>
                </div>
                <div class="text-center">
                  <!-- <p><a  class="text-white" href="forget_password.php">Forgot your password?</a> </p> -->
                  <p>Do you have an account? <a class="text-white"  href="login.php">Login</a> </p>
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
    // let btn = document.getElementById("btn");

    // btn.addEventListener("click", function (e) {
    //   e.preventDefault();
    //   if (password_value.value !== confirm_password_value.value ) {
    //     err.innerHTML = '<span style="color:red">Password don\'t match</span>'
    //   }
    // } ,false)


    $(document).ready(function(){
      // $("#password").keydown(function(event) {
      //     if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
      //         alert('thou. shalt. not. PASTE!');
      //         event.preventDefault();
      //      }
      // });


      $(".registerationForm").on("submit", (function(event){
        event.preventDefault();

        $.ajax({
          url:"register_processing.php",
          method:"POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          success:function(data){
            // console.log("data");
            if(data == "Field(s) can't be empty" || data == "Password  characters can not be less than 4" || data == "Passwords doesn't match" || data == "Username already exist, use another one"|| data == "Something went wrong"){
              $(".registerationForm")[0].reset();
              $(".errorMsg").html(`<div  id="error" class=" text-white bg-danger p-2 ">${data}</div>`);
            }
            else{
              $(".errorMsg").html(`<div  id="error" class=" text-white bg-success p-2 ">${data}</div>`);
            }
            
          }
        })


      }))

    })
  </script>

  

    <!-- <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script> -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
  </body>
</html>