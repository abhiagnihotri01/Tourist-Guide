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
	if(!isset($_POST['lat']) || !isset($_POST['lng'])) {
		echo json_encode(array('status' => false, 'message' => 'Invalid request'));
	}
	else {
		$tags_id_array = json_decode($_POST['tags'], true);
		$arr = $utility->makeTour($_POST['lat'], $_POST['lng'], $tags_id_array, $_POST['days'], $_POST['radius']);
		echo json_encode(array('status' => true, 'tour_details' => $arr));
	}