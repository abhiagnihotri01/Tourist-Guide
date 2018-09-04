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
		if(!isset($_POST['id'])) {
			echo json_encode(array('status' => false, 'message' => 'Invalid request'));
		}
		else {
			$status = $admin->deletePhobia($_POST['id'], $conn);
			if($status) {
				echo json_encode(array('status' => true, 'message' => 'Phobia deleted'));
			}
			else {
				echo json_encode(array('status' => false, 'message' => 'Unable to delete phobia'));
			}
		}
	}