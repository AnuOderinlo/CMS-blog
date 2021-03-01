<?php


	class Password extends Db_object{
		protected static $db_table = 'admins';
		public function __construct(){
			
		}

		public function change_password($email){

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