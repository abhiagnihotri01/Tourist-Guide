<?php
	error_reporting(0);
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
	class User {
		private $conn;
		private $table_name;

		// properties
		public $id;
		public $username;
		public $name;
		public $contact;
		public $email;
		public $password;

		public function __construct($db) {
			session_start();
			$this->conn = $db;
			$this->table_name = "users";
		}

		public function readAll() {
			$query = "SELECT users.id, users.name, users.username, users.email, users.contact, users.created_at, users.updated_at FROM users WHERE users.id NOT IN (SELECT users_admin.user_id FROM users_admin WHERE users_admin.is_deleted = 0) AND users.is_deleted = 0";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function create() {
			// sanitize
			$this->name=htmlspecialchars(strip_tags($this->name));
			$this->username=htmlspecialchars(strip_tags($this->username));
			$this->password=$this->password;
			$this->email=htmlspecialchars(strip_tags($this->email));
			$this->contact=htmlspecialchars(strip_tags($this->contact));
			if($this->readbyEmail($this->email)->rowCount() > 0) {
				// means some user exists with same email id
				return array('status' => false, 'message' => 'User exists with same email-id');
			}
			if($this->readByUsername($this->username)->rowCount() > 0) {
				return array('status' => false, 'message' => 'User exists with same username');				
			}
			if($this->readByContact($this->contact)->rowCount() > 0) {
				return array('status' => false, 'message' => 'User exists with same contact number');				
			}

			$query = "INSERT INTO " . $this->table_name . " SET name=:name, username=:username, email=:email, password=:password, contact=:contact";
			$stmt = $this->conn->prepare($query);
			
			// bind values
			$stmt->bindParam(":name", $this->name);
			$stmt->bindParam(":email", $this->email);
			$stmt->bindParam(":password", $this->password);
			$stmt->bindParam(":username", $this->username);
			$stmt->bindParam(":contact", $this->contact);

			if($stmt->execute()) {
				// $stmt->debugDumpParams();
				return array('status' => true);
			}
			// $stmt->debugDumpParams();
			return array('status' => false, 'message' => 'Sorry, some error occured');
		}

		public function update() {
			// sanitize			
			$this->id=htmlspecialchars(strip_tags($this->id));
			$this->name=htmlspecialchars(strip_tags($this->name));
			$this->username=htmlspecialchars(strip_tags($this->username));
			$this->email=$this->email;
			$this->contact=htmlspecialchars(strip_tags($this->contact));
			$rows = $this->readbyEmail($this->email);
			$usernameRows = $this->readByUsername($this->username);
			if($rows->rowCount() > 0) {
				// means some user exists with same email id
				$row = $rows->fetch(PDO::FETCH_ASSOC);
				if($this->id != $row['id'])	// check if user with same id does the change or not
					return array('status' => false, 'message' => 'User exists with same email-id');
			}
			if($usernameRows->rowCount() > 0) {
				$row1 = $usernameRows->fetch(PDO::FETCH_ASSOC);
				if($this->id != $row1['id'])	// check if user with same id does the change or not
					return array('status' => false, 'message' => 'User exists with same username');				
			}


			$query = "UPDATE " . $this->table_name . " SET name=:name, username=:username, email=:email, contact=:contact WHERE id=:id";
			$stmt = $this->conn->prepare($query);
			
			// bind values
			$stmt->bindParam(":name", $this->name);
			$stmt->bindParam(":email", $this->email);
			$stmt->bindParam(":username", $this->username);
			$stmt->bindParam(":contact", $this->contact);
			$stmt->bindParam(':id', $this->id);

			if($stmt->execute()) {
				return array('status' => true);
			}
			return array('status' => false, 'message' => 'User with matching details exists');
		}

		public function readbyId($id) {
			$query = "SELECT name, username, email, contact, image_name, created_at, updated_at FROM " . $this->table_name . " WHERE id=:id AND is_deleted = 0";
			$id = htmlspecialchars(strip_tags($id));
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			// $stmt->debugDumpParams();
			return $stmt;
		}

		public function readByEmail($email) {
			$query = "SELECT id, name, username, email, contact, created_at, updated_at FROM " . $this->table_name . " WHERE email=:email AND is_deleted = 0";
			$email = htmlspecialchars(strip_tags($email));
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":email", $email);
			$stmt->execute();
			return $stmt;
		}

		public function readByContact($contact) {
			$query = "SELECT id, name, username, email, contact, created_at, updated_at FROM " . $this->table_name . " WHERE contact=:contact AND is_deleted = 0";
			$contact = htmlspecialchars(strip_tags($contact));
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":contact", $contact);
			$stmt->execute();
			return $stmt;
		}

		public function readByUsername($username) {
			$query = "SELECT id, name, username, email, contact, created_at, updated_at FROM " . $this->table_name . " WHERE username=:username AND is_deleted = 0";
			$username = htmlspecialchars(strip_tags($username));
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			// $stmt->debugDumpParams();
			return $stmt;
		}		

		public function checkIfUserExists($username, $pass) {
			$query = "SELECT users.password, users.id, users_admin.is_admin, users.image_name FROM (SELECT id, password, image_name FROM users WHERE users.username=:username AND users.is_deleted = 0) as users LEFT JOIN users_admin ON users.id = users_admin.user_id AND users_admin.is_deleted = 0";
			$username = htmlspecialchars(strip_tags($username));
			$pass = htmlspecialchars(strip_tags($pass));
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			if($stmt->rowCount() > 0) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				if(password_verify($pass, $password)) {	// pass => passed string, password => hash stored in db
					if(is_null($is_admin))
						return array('status' => true, 'id' => $id, 'is_admin' => false, 'image_name' => $image_name);
					return array('status' => true, 'id' => $id, 'is_admin' => true, 'image_name' => $image_name);
				}
			}
			return array('status' => false);
		}

		public function login($username, $pass, $rememberMe) {
			$user_exists = $this->checkIfUserExists($username, $pass);
			if($user_exists['status']) {	// pass => passed string, password => hash stored in db
				$id = $user_exists['id'];
				$utility = new Utility();
				$_SESSION['isLoggedIn'] = array('status' => true, 'username' => $utility->string_encrypt_decrypt($username), 'is_admin' => $user_exists['is_admin']);
				$arr = array('username' => $utility->string_encrypt_decrypt($username), 'id' => $utility->string_encrypt_decrypt($id), 'password' => $utility->string_encrypt_decrypt($pass), 'is_admin' => $user_exists['is_admin'], 'image_name' => $user_exists['image_name']);
				if($rememberMe)
					setcookie('user_details', json_encode($arr), time() + 10*24*3600, '/');				
				else
					setcookie('user_details', json_encode($arr), 0, '/');
				return array('status' => true, 'message' => 'Login successfull');
			}
			return array('status' => false, 'message' => 'Invalid credentials');
		}

		public function logout($is_admin = false) {
			unset($_SESSION['isLoggedIn']);
			session_destroy();
			setcookie('user_details', null, time()-100, '/');
		}

		public function getLoggedInDetails() {
			if($this->authenticate()) {
				$user_array = json_decode($_COOKIE['user_details'], true);
				$utility = new Utility();
				$username = $utility->string_encrypt_decrypt($user_array['username'], false);
				$id = $utility->string_encrypt_decrypt($user_array['id'], false);
				return array('status' => true, 'username' => $username, 'id' => $id, 'is_admin' => $user_array['is_admin'], 'image_name' => $user_array['image_name']);
			}
			return array('status' => false, 'message' => 'No user logged in');
		}

		public function authenticate() {
			if(!isset($_SESSION['isLoggedIn'])) {
				if(isset($_COOKIE['user_details'])) {
					// extract username and passsword
					$user_array = json_decode($_COOKIE['user_details'], true);
					$utility = new Utility();
					$username = $utility->string_encrypt_decrypt($user_array['username'], false);
					$password = $utility->string_encrypt_decrypt($user_array['password'], false);
					$id = $utility->string_encrypt_decrypt($user_array['id']);
					$details = $this->checkIfUserExists($username, $password);
					if($details['status']) {
						$_SESSION['isLoggedIn'] = array('status' => true, 'username' => $utility->string_encrypt_decrypt($username), 'is_admin' => $details['is_admin']);
						return true;
					}
				}
			}
			else if(isset($_COOKIE['user_details'])) {
				return true;
			}
			return false;
		}

		public function getTagsId($tags_array) {
			$categoryId = array();
			$utility = new Utility();
			$username = $utility->string_encrypt_decrypt($_SESSION['isLoggedIn']['username'], false);
			$query = "SELECT id FROM users WHERE username=:username AND is_deleted = 0";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['id'];			
			foreach($tags_array as $tag) {
				$query = "SELECT DISTINCT tags.hash, tags.id FROM tags, tags_subtags WHERE tags_subtags.tag_id = :id AND tags.id NOT IN (SELECT tags_phobia.tag_id as subtag_id FROM tags_phobia, users_phobia WHERE users_phobia.user_id = :user_id AND users_phobia.phobia_id = tags_phobia.id) AND tags_subtags.subtag_id = tags.id AND tags_subtags.is_deleted = 0 AND tags.is_deleted = 0";
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(":id", $tag);
				$stmt->bindParam(":user_id", $user_id);
				$stmt->execute();
				// $stmt->debugDumpParams();
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					// print_r($row);
					array_push($categoryId, $row['hash']);
				}
			}
			$categoryId = array_unique($categoryId);
			return $categoryId;
		}

		public function saveFeedback($feedback_text) {
			$utility = new Utility();
			$username = $utility->string_encrypt_decrypt($_SESSION['isLoggedIn']['username'], false);
			$query = "SELECT id FROM users WHERE username=:username AND is_deleted = 0";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['id'];
			$query = "INSERT INTO feedback SET user_id=:user_id, feedback_text=:feedback_text";
			$stmt = $this->conn->prepare($query);			
			$stmt->bindParam(":user_id", $user_id);
			$stmt->bindParam(":feedback_text", $feedback_text);
			if($stmt->execute()) {
				return true;
			}
			return false;
		}

		public function getAllPhobia() {
			$query = "SELECT id, phobia FROM tags_phobia WHERE is_deleted = 0";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function getAllSelectedPhobia() {
			$utility = new Utility();
			$username = $utility->string_encrypt_decrypt($_SESSION['isLoggedIn']['username'], false);
			$query = "SELECT tags_phobia.phobia as phobia_name, users_phobia.id FROM tags_phobia, users_phobia, users WHERE users.username = :username AND users.id = users_phobia.user_id AND users_phobia.phobia_id = tags_phobia.id AND tags_phobia.is_deleted = 0 AND users_phobia.is_deleted = 0 AND users.is_deleted = 0";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			// $stmt->debugDumpParams();
			return $stmt;
		}

		public function addPhobia($phobia_id) {
			$utility = new Utility();
			$username = $utility->string_encrypt_decrypt($_SESSION['isLoggedIn']['username'], false);
			$query = "SELECT id FROM users WHERE username=:username AND is_deleted = 0";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['id'];
			$query1 = "INSERT INTO users_phobia SET user_id=:user_id, phobia_id=:phobia_id";
			$stmt = $this->conn->prepare($query1);
			$stmt->bindParam(":user_id", $user_id);
			$stmt->bindParam(":phobia_id", $phobia_id);

			if($stmt->execute()) {
				// $stmt->debugDumpParams();
				return true;
			}
			// $stmt->debugDumpParams();
			return false;
		}

		public function deleteUserPhobia($user_phobia_id) {
			$query = "UPDATE users_phobia SET is_deleted = 1 WHERE id = :id";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":id", $user_phobia_id);
			if($stmt->execute())
				return true;
			return false;
		}
	}
