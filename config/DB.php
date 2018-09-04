<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/Constants.php');
	class DB{
		// specify your own database credentials
		private $host = DB_HOST;
		private $db_name = DB_NAME;
		private $username = DB_USERNAME;
		private $password = DB_PASSWORD;
		public $conn = null;
		// get the database connection
		public function getConnection(){
			if($this->conn == null) {
				try{
					$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
					// $this->conn->exec("set names utf8");
				} catch(PDOException $exception){
					echo "Connection error: " . $exception->getMessage();
				}
			}
			return $this->conn;
		}
	}