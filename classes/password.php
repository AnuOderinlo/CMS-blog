<?php


	class Password extends Db_object{
		public $db_table = "admins";
		public function __construct(){
			
		}

		public function change_password($email){
			global $database;
			$sql = "SELECT * from ".$this->db_table ." WHERE email='$email'";
			$result = self::find_this_query($sql);
			if ($result) {
				$token_code = substr(md5(uniqid()),0,5);
				$receiver = $email;
				$subject = "Reset Password";
				$message =  <<<email
				          Dear user,
				          Please copy the token code below and click on the following link to reset your password:
				          http://localhost/cms-blog/restore_password.php
				          Token code: {$token_code}
				          If you did not request any password resets, then ignore this email.

				          NB: Please try and change it when you login back.

				          email;
				$sender = "From: oderinloanuoluwapo@gmail.com";
				mail($receiver, $subject, $message);


				$_SESSION["successMessage"] = "Please check your Email for new password";
				Redirect('forget_password.php');
			}else{

			}

		}

		public function update_password(){
			
		}

		public function password_hashing($password){
			
		}


	}








?>