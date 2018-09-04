<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');

	$db = new DB();
	$conn = $db->getConnection();
	$utility = new Utility();
	$rows = $utility->getAllRestrictions($conn);
	$numRows = $rows->rowCount();
	if($numRows > 0) {
		$arr["status"] = true;
		$arr["count"] = $numRows;
		$arr["restriction_details"] = array();
		while($row = $rows->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$restrictionDetails = array(
				"id" => $id,
				"restriction_name" => $restriction_name,
			);
			array_push($arr["restriction_details"], $restrictionDetails);
		}
		echo json_encode($arr);
	}
	else {
		echo json_encode(array('status' => false, 'message' => 'No restrictions found'));
	}
