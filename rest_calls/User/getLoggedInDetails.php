<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Admin.php');
	$db = new DB();
	$conn = $db->getConnection();
	$user = new User($conn);
	$admin = new Admin();
	$adminDetails = $admin->getAdminDetails($user, $conn);
	if(!$adminDetails['status'])
		header('location: logout.php');	
	echo json_encode(array('status' => true, 'user_details' => $adminDetails));