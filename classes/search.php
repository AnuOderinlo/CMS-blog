<?php 


	
	class Search extends db_object{
		
		public function serach_input($input){
			$searchInput = "%".$_GET['search']."%";
			$sql = "SELECT * FROM posts WHERE date LIKE '$searchInput' OR author LIKE '$searchInput' OR category LIKE '$searchInput' OR title LIKE '$searchInput' OR post LIKE '$searchInput'";
			$connect = $db->query($sql);
		}


	}




















 ?>