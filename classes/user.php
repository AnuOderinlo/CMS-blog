<?php 


	// require 'db_object.php';


	class User extends Db_object{


		protected static $db_table = 'admins';
		protected static $db_table_fields = array('date', 'username', 'adminName', 'password', 'authority', 'superAdmin', 'headline', 'image', 'about');
		public $id;
		public $date;
		public $username;
		public $password;
		public $adminName;
		public $authority;
		public $image;
		public $headline;
		public $about;
		public $upload_dir = "images";
		// public $image_placeholder = "https://via.placeholder.com/80x80?text=image";

		// public function img_path_and_placeholder(){
		// 	return empty($this->user_image)? $this->image_placeholder : $this->upload_dir.DS.$this->user_image;
		// }

		
		function __construct(){
			# code...
		}

		public function picture_path(){
			return $this->upload_dir."/".$this->image;
		}


		public static function verify_user($username,$password){
			global $database;

			$sql= "SELECT * FROM ".self::$db_table ." WHERE (username='$username' OR email='$username') AND activation='active' LIMIT 1";
			$result_array = self::find_this_query($sql);
			foreach ($result_array as $row) {
				 $hassPassword = $row->password;
			}

			// if (password_verify($password, $hassPassword)) {
				return !empty($result_array) ? array_shift($result_array) :  false;
			// }

		}

		public static function verify_email($vkey){
			global $database;

			$sql= "SELECT * FROM ".self::$db_table ." WHERE activation= 'invalid' AND code='$vkey' LIMIT 1";
			$result_array = self::find_this_query($sql);

			return !empty($result_array) ? array_shift($result_array) :  false;
		}

		

		public function delete_user_dp(){
			if ($this->delete()) {
				$target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
				return unlink($target_path)?true:false;
			}else{
				return false;
			}
		}


		public function set_file($file){

			if (empty($file) || !$file || !is_array($file)) {
				$this->custom_errors[] = 'There was no file uploaded here';
				return false;
			}elseif($file['error'] != 0 ){

				$this->custom_errors[] = $this->upload_errors[$file['error']];
				return false;
			}else{

				$this->user_image = basename($file['name']);
				$this->tmp_path = $file['tmp_name'];
				$this->type = $file['type'];
				$this->size = $file['size'];
			}

		}


		public function upload_image(){
			
				if (!empty($this->custom_errors)) {
					return false;
				}
				if (empty($this->user_image) || empty($this->tmp_path)) {
					$this->custom_errors[] = 'The file is not available';
					return false;
				}

				$target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_dir.DS.$this->user_image;

				if (file_exists($target_path)) {
					$this->custom_errors[] = "The file {$file->user_image} already exists";
					return false;
				}
				if (move_uploaded_file($this->tmp_path, $target_path)) {
					unset($this->tmp_path);
					return true;
				}else{
					$this->custom_errors[] = "The file directory does not have permission";
					return false;
				}

				$this->create(); 

		}


		public function save_user_image($user_image, $user_id){
			global $database;

			$this->user_image= $database->escape_string($user_image);
			$this->id= $database->escape_string($user_id);

			$sql = "UPDATE ".self::$db_table." SET user_image = '{$this->user_image}' WHERE id = {$this->id}";

			$update_image = $database->query($sql);
			return $this->img_path_and_placeholder();
		
			
		}



		public function check_super_admin(){
			global $database;
			$sql = "SELECT * FROM ".self::$db_table;
			$connect = $database->query($sql);
			while ( $row = $connect->fetch_assoc()) {
				$admin_status = $row["authority"];
				if ($admin_status == "super_admin") {
					return $admin_status;
				}
			}
		}


		/*This functions checks the existence of a username*/
		public function check_username($username){
			global $database;
			$sql = "SELECT username FROM  ".self::$db_table." WHERE username='$username'";
			$connect = $database->query($sql);

			$totalRow = mysqli_num_rows($connect);
			if ($totalRow == 1) {
				// return true;
				echo "Username already exist";
			}else{
				return $username;
			}
		}


		/*This functions checks if an email exist*/
		public function check_email($email){
			global $database;
			$sql = "SELECT email FROM  ".self::$db_table." WHERE email='$email'";
			$connect = $database->query($sql);

			$totalRow = mysqli_num_rows($connect);
			if ($totalRow == 1) {
				echo "Email already exist";
			}else{
				return $email;
			}
		}
		
			/*This functions checks if an email exist*/
		public function if_email_exist($email){
			global $database;
			$sql = "SELECT email FROM  ".self::$db_table." WHERE email=?";
	    $stmt = $database->prepare($sql);
	    $stmt->bind_param("s", $email);
	    $stmt->execute();
	    $result = $stmt->get_result();

			$totalRow = $result->num_rows;
			if ($totalRow == 1) {
				return true;
			}else{
				return false;
			}
		}
			





		public function author($author){
			global $database;
			$sql = "SELECT * FROM  ".self::$db_table." WHERE adminName='$author'";
			$result = self::find_this_query($sql);
			// $result->execute();
			return !empty($result) ? $result :  false;
		 
		}


		public function update_profile_image($image, $admin_id){
			global $database;
			if ($image !== "myAvatar.png") {
			  unlink("images/".$image);
			}
			$sql = "UPDATE ".self::$db_table." SET adminName=?, headline=?, image=?, about=? WHERE id= ?";
			$connect = $database->prepare($sql);
			$connect->bind_param("ssssi", $this->adminName, $this->headline, $this->image, $this->about, $admin_id);
			if ($connect->execute()) {
				
				echo $this->image;
				# code...
			}
			// $connect->execute();
			
		}


		public function update_profile(){
			global $database;
			$sql = "UPDATE ".self::$db_table." SET adminName=?, headline=?, about=? WHERE id='$this->id'";
			$connect = $database->prepare($sql);
			$connect->bind_param("sss", $this->adminName, $this->headline, $this->about);
			// $connect->execute();
			$connect->execute();
			
		}


		public  function create_admin($data){
			global $database;

			$sql ="INSERT INTO ".static::$db_table." (date, username, adminName, email, password) VALUES (?,?,?,?,?)";
			$connect = $database->prepare($sql);
			$connect->bind_param("sssss", $data['date'], $data['username'], $data['name'], $data['email'], $data['password']);
			if ($connect->execute()) {
				return true;
			}
		}


		public  function register_user($data, $vkey){
			global $database;

			$sql ="INSERT INTO ".static::$db_table." (date, username, adminName, email, password, code) VALUES (?,?,?,?,?,?)";
			$connect = $database->prepare($sql);
			$connect->bind_param("ssssss", $data['date'], $data['username'], $data['fullname'], $data['email'], $data['password'], $vkey);
			if ($connect->execute()) {
				return true;
			}
		}
		


		public function search_admin($search_input){
			
			$sql = "SELECT * FROM ". self::$db_table."  WHERE date LIKE '$search_input' OR username LIKE '$search_input' OR adminName LIKE '$search_input' OR email LIKE '$search_input'";
			$result = self::find_this_query($sql);
			return !empty($result) ? $result :  false;
			
		}



		/*Update the password in Admin table for password reset*/
		public function update_password($password, $email){
			global $database;
			$sql = "UPDATE ". self::$db_table." SET password=? WHERE email=?";
			$stmt = $database->prepare($sql);
			$stmt->bind_param("ss", $password, $email);
			if ($stmt->execute()) {
				return true;
			}
		}

		

		



		

		



	}






$user = new User();


















 ?>