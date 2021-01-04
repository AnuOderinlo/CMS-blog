<?php 



class Session{
	private $signed_in = false;
	public $admin_id; 
	public $message;
	public $count;

	function __construct(){
		session_start();
		$this->check_login(); 
		$this->check_success_message() ;
		$this->check_error_message();
		// $this->check_message();  
		  
	}

	private function check_login(){ 
		if (isset($_SESSION["adminId"])) {
			$this->admin_id = $_SESSION["adminId"];
			$this->signed_in = true;
		}else{
			unset($this->admin_id);
			$this->signed_in = false;
		}
	}

	public function is_signed_in(){
		return $this->signed_in;
	}

	public function login($user){
		if ($user) {
			$this->admin_id = $_SESSION["adminId"] = $user->id;
			$this->signed_in = true;
		}
	}

	public function logout(){
		unset($_SESSION["adminId"]);
		unset($this->admin_id);
		$this->signed_in = false;
		session_destroy();
	}




	public function set_error_message($msg){
		if (!empty($msg)) {
			$_SESSION['error_message'] =  htmlentities($msg);
	    // $this->message = $_SESSION['error_message'];
		}else{
			return $this->message;
		}
	}

	public function set_success_message($msg){
		if (!empty($msg)) {
			$_SESSION['success_message'] =  htmlentities($msg);
	   	// $this->message = $_SESSION['success_message'];
		}else{
			return $this->message;
		}
	}


	public function check_error_message(){
		if (isset($_SESSION['error_message'])) {
			$this->message = $_SESSION['error_message'];
			// unset($_SESSION['error_message']);
		}else{
			 // $this->message = "";
		}
	}

	public function check_success_message(){
		if (isset($_SESSION['success_message'])) {
			$this->message = $_SESSION['success_message'];
			// unset($_SESSION['success_message']);
		}
		else{
			 // $this->message = "";
		}
	}




	public	function error_message(){
		if (isset($_SESSION["error_message"])) {
			$output ='<div  id="error" class="alert alert-danger">'.$this->message.'<button type="button" class="close" data-dismiss="modal">&times;</button></div>';
			unset($_SESSION['error_message']);
			return $output;
		}
		// if ($this->message === "") {
		// 	$output = "";
		// }
	}


	public	function success_message(){
		if (isset($_SESSION["success_message"])) {
			$output ='<div id="error" class="alert alert-success">'.$this->message.'<button type="button" class="close" data-dismiss="modal">&times;</button></div>';
			unset($_SESSION['success_message']);
			return $output;
		}
		// if ($this->message === "") {
		// 	$output = "";
		// }
	}


}



$session = new Session();
$message = $session->message;


















 ?>