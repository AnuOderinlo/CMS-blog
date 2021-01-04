<?php


	class Password extends Db_object{
		protected static $db_table = 'admins';
		public function __construct(){
			
		}

		public function change_password($email){
			global $database;
			$sql = "SELECT email FROM  ".self::$db_table." WHERE email='$email'";
			$result = self::find_this_query($sql);
			if ($result) {


				/*$token_code = substr(md5(uniqid()),0,5);
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
				mail($receiver, $subject, $message);*/

				return true;
				
			}else{
				return false;
				// $session->set_error_message("Email doesn't exist");
				// return "Email doesn't exist";
			}

		}


		/*Delete the record where activation_ code is active from password_recovery table*/
		public function delete_password_token($token){
			global $database;
			$sql = "DELETE FROM password_recovery WHERE activation_code=?";
			$stmt = $database->prepare($sql);
			$stmt->bind_param("s", $token);
			if ($stmt->execute()) {
				return true;
			}
		}

		public function password_hashing($password){
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);
			return $passwordHash;
		}


	}



	$password = new Password();








?>