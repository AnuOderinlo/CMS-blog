<?php 
// include 'config.php';

class Database{

	public $db;

	function __construct(){
		$this->open_db();
	}

	/*This method opens the database connection*/
	public function open_db(){
		$this->db= new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
		// $db = $this->db;
		if ($this->db->connect_errno) {
			die("Database connection failed".$this->db->connect_error);
		}
	}

	/*This method returns the result of a query*/
	public function query($sql){
		$result = $this->db->query($sql);
		
		return $result;
	}

	/*This method returns the result of a prepared statement*/
	public function prepare($sql){
		$result = $this->db->prepare($sql);
		
		return $result;
	}
	
	/*This method confirms if query result is not true */
	private function confirm_query($result){
		if (!$result) {
			die("Query failed".$this->db->connect_error);
		}
	}

	/*This method remove unwanted strings from input data */
	public function escape_string($string){
		$escape_string = $this->db->real_escape_string($string);
		return $escape_string;
	}

	/*This method returns a particular id created after INSERT or  UPDATE*/
	public function insert_id(){
		return $this->db->insert_id;
	}

}



$database = new Database();
// $database->open_db();




 ?>