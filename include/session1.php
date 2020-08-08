<?php 
	session_start();

	function errorMessage(){
		if (isset($_SESSION["errorMessage"])) {
			// $output ='<div  id="error" class="alert alert-danger d-block">'.htmlentities($_SESSION["errorMessage"]).'</div>';
			$output =htmlentities($_SESSION["errorMessage"]);
			// $_SESSION["errorMessage"] = null;
			return $output;
		}
	}
// 
	function successMessage(){
		if (isset($_SESSION["successMessage"])) {
			// $output ='<div id="error" class="alert alert-success">'.htmlentities($_SESSION["successMessage"]).'</div>';
			$output =htmlentities($_SESSION["successMessage"]);
			// $_SESSION["successMessage"] = null;
			return $output;
		}
	}

?>