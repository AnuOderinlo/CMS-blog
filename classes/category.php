<?php 

	
	class Category extends Db_object{
		protected static $db_table = 'category';
		protected static $db_table_fields = array('title', 'author', 'date');
		public $id;
		public $title;
		public $author;
		public $date;


		public  function create_category($data){
			global $database;

			$sql ="INSERT INTO ".static::$db_table." (title, author, date) VALUES (?,?,?)";
			$connect = $database->prepare($sql);
			// $connect->bind_param("".implode("", $value2)."", implode(",", array_values($properties)));
			$connect->bind_param("sss", $data["title"],$data["author"],$data["date"]);
			if ($connect->execute()) {
				return true;
			}
		
		}

	}










	$category = new Category();















































 ?>