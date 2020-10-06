<?php 




	class Comment extends Db_object{


		protected static $db_table = 'comments';
		protected static $db_table_fields = array('id', 'post_id', 'date', 'name', 'email', 'comment');
		public $id;
		public $post_id;
		public $date;
		public $name;
		public $comment;


		public function create_comment($post_id, $date, $name, $email, $comment){
			global $database;
				$sql = "INSERT INTO ".self::$db_table." (post_id, date, name, email, comment) VALUES (?,?,?,?,?)";
				$connect = $database->prepare($sql);
				$connect->bind_param("issss", $post_id, $date, $name, $email, $comment);
				$connect = $connect->execute();

				return $connect;
		}



		public static function find_comments(){
			global $database;
			$sql = "SELECT * FROM " . self::$db_table." ORDER BY id desc";
			return self::find_this_query($sql);
		}


		// This fucntions returns total number of rows 
	  public	function comment_by_post($id){	
			global $database;
			$sql = "SELECT * FROM ". self::$db_table." WHERE  post_id='$id' ";
			$connect = $database->query($sql);
			$totalRow = mysqli_num_rows($connect);
			return $totalRow;
		}

		



	}


	$comment = new Comment();

























 ?>