<?php 



 /**
  * 
  */
  class Validator extends Db_object{



		// serialize input
  	public function sanitize_string($var){
			global $database;
			$var = strip_tags($var);
			$var = htmlentities($var);
			$var = stripslashes($var);
			$var = filter_var($var, FILTER_SANITIZE_STRING);
			return $database->escape_string(trim($var));
		}

		public function form_validator($data){
			// validate EMAIL
			if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
				if (preg_match("/[a-zA-Z0-9_.]{3,}@[a-zA-Z]{4,}[.]{1}[a-zA-Z0-9.]{2,}/", $data)) {
					return true;
				}
			}
			// validate PHONE NUMBER
			if (filter_var($data, FILTER_SANITIZE_NUMBER_INT)) {
				return true;
			}
			// validate URL
			if (filter_var($data, FILTER_VALIDATE_URL)) {
				if (preg_match("/(https:|ftp:)\/\/+[a-zA-Z.0-9\?&\%\$\-\#]+\.[a-zA-Z.0-9\?&\%\$\-\#\/\_]*/", $data)) {
					return true;
				}
			}
		}

		public static function crfToken(){
			if(empty($_SESSION['crf_token'])){
				$_SESSION['crf_token'] = bin2hex(random_bytes(32));
				htmlentities($_SESSION['crf_token'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); 
			}else{
				// unset($_SESSION['crf_token']);

			}

			return $_SESSION['crf_token'];
		}


		/*This method create the token time that will expire*/
		public static function tokenTime(){
			if(empty($_SESSION['token_time'])){
				$_SESSION['token_time'] = time() + 3600;
			}else{
				// unset($_SESSION['token_time']);
			}
			return $_SESSION['token_time'];
		}


		public static function checkToken($var){
			if(!empty($var)){
				if(hash_equals($var, Validator::crfToken())){
					// return Validator::crfToken();
					// return Sanitizer::tokenTime();
					return true;
				}
				else{
					return false;
					// return "You need to refresh this page <a href=''>Click here</a>";
				}
			}
			else{
				unset($_SESSION['token_time']);
				unset($_SESSION['crf_token']);
				return false;
				// return "Page expired, click here to <a href=''>Refresh</a>";
			}
		}


		public function password_validator($password){
			
		}




 	
 }

 $validator = new Validator();









































 ?>