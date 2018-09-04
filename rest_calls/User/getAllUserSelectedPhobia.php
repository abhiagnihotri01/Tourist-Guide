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
	$rows = $user->getAllSelectedPhobia();
	$phobia_selected_details = array();
	while($row = $rows->fetch(PDO::FETCH_ASSOC)) {
		array_push($phobia_selected_details, $row);
	}
	// print_r($phobia_selected_details);
	if($rows->rowCount() > 0) {
		echo json_encode(array('status' => true, 'phobia_selected_details' => $phobia_selected_details));
	}
	else {
		echo json_encode(array('status' => false, 'message' => 'Unable to get subtags, please refresh'));
	}