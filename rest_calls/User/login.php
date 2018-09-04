<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	// include database and object files
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');

	if(isset($_POST['username']) && isset($_POST['password'])) {
		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		extract($_POST);
		if(isset($_POST['remember_me']))
			$arr = $user->login($username, $password, true);
		else
			$arr = $user->login($username, $password, false);
		echo json_encode($arr);
	}
	else {
		echo json_encode(array("status" => false, "message" => "Insufficient parameters"));
	}
