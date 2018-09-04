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

	// $key = $value = NULL;
	// foreach (_POST as $key => $value) {
	//     break;
	// }
	// $_POST = json_decode($key, true);
	if(!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['contact']) || !isset($_POST['username'])) {
		echo json_encode(array('status' => false, 'message' => 'Invalid Request'));
	}
	else {
		if(strlen($_POST['contact']) != 10) {
			echo json_encode(array('status' => false, 'message' => 'Contact must be of 10 digits'));
		}
		else {
			$db = new DB();
			$conn = $db->getConnection();
			$user = new User($conn);
			$utility = new Utility();
			$user->id = $_POST['id'];
			$user->name = $_POST['name'];
			$user->email = $_POST['email'];
			$user->contact = $_POST['contact'];
			$user->username = $_POST['username'];
			$retArr = $user->update();
			if($retArr['status']) {
				echo json_encode(array("status" => true, "message" => "User updated successfully"));
			}
			else {
				echo json_encode($retArr);
			}			
		}
	}