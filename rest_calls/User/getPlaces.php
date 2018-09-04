<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	// include database and object files
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');

	$db = new DB();
	$conn = $db->getConnection();
	$user = new User($conn);
	$numRows = 0;
	if(isset($_GET['id'])) {	// call
		$rows = $user->readById($_GET['id']);
		$numRows = $rows->rowCount();
	}
	else if(isset($_GET['email'])) {
		$rows = $user->readByEmail($_GET['email']);
		$numRows = $rows->rowCount();
	}	
	if($numRows > 0) {
		$user_arr["status"] = true;
		$row = $rows->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$userDetails = array(
			"name" => $name,
			"username" => $username,
			"contact" => $contact,
			"email" => $email,
			"created_at" => $created_at,
			"updated_at" => $updated_at
		);
		$user_arr["user_details"] = $userDetails;
		echo json_encode($user_arr);
	}
	else {
		echo json_encode(array("status" => false, "message" => "No user found"));
	}