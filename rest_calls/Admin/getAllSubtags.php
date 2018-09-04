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
	$admin = new Admin();
	$adminDetails = $admin->getAdminDetails($user, $conn);
	if(!$adminDetails['status']) {
		echo json_encode(array('status' => false, 'message' => 'You dont have permission to access this page'));
	}
	else {
		$rows = $admin->getAllSubtags($conn);
		$subtags_details = array();
		while($row = $rows->fetch(PDO::FETCH_ASSOC)) {
			array_push($subtags_details, $row);
		}
		if($rows->rowCount() > 0) {
			echo json_encode(array('status' => true, 'subtags_details' => $subtags_details));
		}
		else {
			echo json_encode(array('status' => false, 'message' => 'Unable to get subtags, please refresh'));
		}
	}