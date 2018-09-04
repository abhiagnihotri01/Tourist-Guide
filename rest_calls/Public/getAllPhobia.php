<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');

	$db = new DB();
	$conn = $db->getConnection();
	$utility = new Utility();
	$rows = $utility->getAllPhobia($conn);
	$numRows = $rows->rowCount();
	if($numRows > 0) {
		$arr["status"] = true;
		$arr["count"] = $numRows;
		$arr["phobia_details"] = array();
		while($row = $rows->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$phobiaDetails = array(
				"id" => $id,
				"tag_name" => ucwords($tag_name),
				"phobia_name" => $phobia_name,
			);
			array_push($arr["phobia_details"], $phobiaDetails);
		}
		echo json_encode($arr);
	}
	else {
		echo json_encode(array('status' => false, 'message' => 'No phobias + tags found'));
	}
