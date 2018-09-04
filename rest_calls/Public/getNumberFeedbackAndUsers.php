<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');

	$db = new DB();
	$conn = $db->getConnection();
	$utility = new Utility();
	$user = new User($conn);
	$arr["status"] = true;
	$arr["feedback_count"] = $utility->getAllFeedbacks($conn)->rowCount();
	$arr["user_count"] = $user->readAll()->rowCount();
	echo json_encode($arr);
