<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	// include database and object files
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');

	$db = new DB();
	$conn = $db->getConnection();
	$user = new User($conn);
	$rows = $user->readAll();
	$numRows = $rows->rowCount();
	if($numRows > 0) {
		$user_arr["status"] = true;
		$user_arr["count"] = $numRows;
		$user_arr["users_details"] = array();
		$cnt = 1;
		while($row = $rows->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$cnt++;
			$userDetails = array(
				"id" => $id,
				"name" => $name,
				"username" => $username,
				"contact" => $contact,
				"email" => $email,
				"created_at" => $created_at,
				"updated_at" => $updated_at
			);
			array_push($user_arr["users_details"], $userDetails);
		}
		echo json_encode($user_arr);
	}
	else {
		echo json_encode(array("status" => false, "message" => "No user found"));
	}