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
	if(!isset($_POST['feedback_text'])) {
		echo json_encode(array('status' => false, 'message' => 'Invalid request, feedback text not received, please refresh'));
	}
	else {
		$ans = $user->saveFeedback($_POST['feedback_text']);
		if($ans)
			echo json_encode(array('status' => true));
		else
			echo json_encode(array('status' => false, 'message' => 'Error in saving feedback'));
	}