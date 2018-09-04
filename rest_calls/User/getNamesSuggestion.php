<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	// include database and object files
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');

	$db = new DB();
	$conn = $db->getConnection();
	$user = new User($conn);
	$utility = new Utility();
	if(!isset($_POST['city']) || !isset($_POST['place'])) {
		echo json_encode(array('status' => false, 'message' => 'Invalid request'));
	}
	else {
		$venue_array = $utility->suggestCompletion($_POST['city'], $_POST['place']);
		echo json_encode(array('status' => true, 'names_details' => $venue_array));
	}