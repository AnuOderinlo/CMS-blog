<?php 




class Post extends Db_object{
	
	protected static $db_table = 'posts';
	protected static $db_table_fields = array('id','admin_id', 'date', 'author', 'title', 'category', 'image', 'post');
	public $id;
	public $admin_id;
	public $date;
	public $author;
	public $title;
	public $category;
	public $image;
	public $post;
	public $upload_dir = "upload";


	public function alt_picture_path($data){
		$this->image = $data["image"];
		return $this->upload_dir.DS.$this->image;
	}

	public function picture_path(){
		// $this->image = $data["image"];
		return $this->upload_dir.DS.$this->image;
	}
	

	public function post_by_category($category){
		$sql = "SELECT * FROM ". self::$db_table." WHERE category='$category' ORDER BY id desc ";
		$result = self::find_this_query($sql);
		return !empty($result) ? $result:  false;
	}

	/* the param $search_input will a value from $_GET[]*/
	public function post_by_search($search_input){
		
		$sql = "SELECT * FROM ". self::$db_table."  WHERE date LIKE '$search_input' OR author LIKE '$search_input' OR category LIKE '$search_input' OR title LIKE '$search_input' OR post LIKE '$search_input'";
		$result = self::find_this_query($sql);
		return !empty($result) ? $result :  false;
	}


	public function post_by_default(){
	  $sql = "SELECT * FROM ". self::$db_table." ORDER BY id desc";
		$result = self::find_this_query($sql);
		return !empty($result) ? $result :  false;
	}

	public function recent_post(){
	  $sql = "SELECT * FROM ". self::$db_table." ORDER BY id desc LIMIT 0,5";
		$result = self::find_this_query($sql);
		return !empty($result) ? $result :  false;
	}
	
	public function post_by_admin($admin_id){
		$sql = "SELECT * FROM ". self::$db_table." WHERE admin_id=$admin_id";
		$result = self::find_this_query($sql);
		return !empty($result) ? $result :  false;

	}

	public function post_by_admin_order($admin_id){
		$sql = "SELECT * FROM ". self::$db_table." WHERE admin_id=$admin_id  ORDER BY id desc LIMIT 0,5";
		$result = self::find_this_query($sql);
		return !empty($result) ? $result :  false;

	}

	public function totalRowPost($admin_id){
		global $database;
		$sql = "SELECT * FROM  ". self::$db_table."  WHERE admin_id=$admin_id";
		$result = $database->query($sql);

		$totalRow = mysqli_num_rows($result);
		return $totalRow;
	}

	public function update_author($author, $admin_id){
		global $database;
		$sql = "UPDATE ". self::$db_table." SET author=? WHERE admin_id=?";
		$connect = $database->prepare($sql);
		$connect->bind_param("si", $author, $admin_id);  
		$connect->execute();
		
	}


	public  function create_post($data){
		global $database;

		$sql ="INSERT INTO ".static::$db_table." (admin_id, date, author, title, category, image, post) VALUES (?,?,?,?,?,?,?)";
		$connect = $database->prepare($sql);
		// $connect->bind_param("".implode("", $value2)."", implode(",", array_values($properties)));
		$connect->bind_param("issssss", $data["admin_id"],$data["date"],$data["author"],$data["title"],$data["category"],$data["image"],$data["post"]);
		$connect->execute();
		if ($connect->execute()) {
			return true;
		}
	
	}


	public  function update_post_with_image($data){
		global $database;

		$sql = "UPDATE ".static::$db_table." SET title = ?, category=?, post=?, image= ? WHERE id= ?";
		$connect = $database->prepare($sql);
		// $connect->bind_param("".implode("", $value2)."", implode(",", array_values($properties)));
		$connect->bind_param("ssssi",$data["title"],$data["category"],$data["post"],$data["image"], $data["post_id"]);
		$connect->execute();
		if ($connect->execute()) {
			return true;
		}
	
	}

	public  function update_post($data){
		global $database;

		$sql = "UPDATE ".static::$db_table." SET title = ?, category=?, post=? WHERE id= ?";
		$connect = $database->prepare($sql);
		// $connect->bind_param("".implode("", $value2)."", implode(",", array_values($properties)));
		$connect->bind_param("sssi",$data["title"],$data["category"],$data["post"], $data["post_id"]);
		$connect->execute();
		if ($connect->execute()) {
			return true;
		}
	
	}
	



}


$post = new Post();


























 ?>