<?php 

	require 'classes/init.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\OAuth;
	use PHPMailer\PHPMailer\SMTP;

  if (isset($_POST["submit"])) {
    // echo "is it working";
     $data  = array();
     date_default_timezone_set("Africa/Lagos");
     $data["date"] = date("d/M/Y h:ia", time());
     $data["username"] = $_POST["username"];
     $data["fullname"] = $_POST["fullname"];
     $data["email"] = $_POST["email"];
     $data["tokenCrf"] = $_POST["token"];

     



     // echo $data["tokenCrf"];


     
     if ($validator->checkToken($data["tokenCrf"])) {

        if ($data["username"] = $validator->isEmpty($_POST["username"], "Username")) {
          if ($data["fullname"] = $validator->isEmpty($_POST["fullname"], "Fullname")) {
            if ($data["email"] = $validator->isEmpty($_POST["email"], "Email")) {
              if ($data["password"] = $validator->isEmpty($_POST["password"], "Password")) {
          			if ($user->check_email($data["email"])) {
          				if ($user->check_username($data["username"])) {
          					if ($validator->email_validator($data["email"])) {
          						// echo "Successfully";
                      $data["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

          						$vkey = md5(time().$data["username"]);

          						if ($user->register_user($data, $vkey)) {

                        echo "Registered !!!";
          						}else{
          						  
          						  echo "something went wrong";  
          						  // Redirect("addAdmin.php");
          						}

            				}
          				}
          			}
              }
            }
          }
        }

     }else{
       unset($_SESSION['token_time']);
       unset($_SESSION['crf_token']);
       echo "You need to refresh this page <a href=''>Click here</a> <br>";
       echo $data["tokenCrf"];
     }

  }





 ?>