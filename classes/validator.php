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




 	
 }

 $validator = new Validator();









































 ?>