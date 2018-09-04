<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Admin.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');

	$db = new DB();
	$conn = $db->getConnection();
	$user = new User($conn);
	if(!isset($_POST['phobia_id'])) {
		echo json_encode(array('status' => false, 'message' => 'Invalid request'));
	}
	else {
		$status = $user->addPhobia($_POST['phobia_id']);
		if($status) {
			echo json_encode(array('status' => true));
		}
		else {
			echo json_encode(array('status' => false, 'message' => 'Unable to add phobia'));
		}		
	}