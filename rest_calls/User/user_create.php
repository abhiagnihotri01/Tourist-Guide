<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// include database and object files	
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');

	// $url = parse_url($_SERVER['REQUEST_URI']);
	// print_r($url);
	// print_r($_SERVER);
	// if(strpos($url['path'], "/rest_calls/User/user_create.php") !== false) {

	// TODO
	// 1. CHECK FOR THE REQUESTING URL. THIS PAGE MUST BE CALLED FROM "register.php" ONLY
	
	$db = new DB();
	$conn = $db->getConnection();
	$user = new User($conn);
	$utility = new Utility();
	extract($_POST);
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contact']) && isset($_POST['password']) && isset($_POST['username'])) {
		$user->name = $name;
		$user->email = $email;
		$user->contact = $contact;
		$user->password = $utility->hashPassword(htmlspecialchars(strip_tags($password)));
		$user->username = $username;

		$retArr = $user->create();
		if($retArr['status']) {
			echo json_encode(array("status" => true, "message" => "User created successfully"));
		}
		else {
			echo json_encode($retArr);
		}
	}
	else {
		echo json_encode(array("status" => false, "message" => "Invalid request"));
	}
