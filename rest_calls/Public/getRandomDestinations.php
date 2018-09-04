<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');

	$db = new DB();
	$conn = $db->getConnection();
	$utility = new Utility();
	$numOfDestinations = 4;
	if(isset($_GET['n'])) {
		$numOfDestinations = $_GET['n'];
	}
	$rows = $utility->getNDestinations($conn, $numOfDestinations);
	$numRows = $rows->rowCount();
	if($numRows > 0) {
		$arr["status"] = true;
		$arr["count"] = $numRows;
		$randomArray = array();
		$randomNumber;
		for ($i=0; $i < $numOfDestinations; $i++) { 
			$randomNumber = rand(1, $numRows);
			while(in_array($randomNumber, $randomArray)) {
				$randomNumber = rand(1, $numRows);
			}
			array_push($randomArray, $randomNumber);
		}
		$arr["places_details"] = array();
		$cnt = 1;
		while($row = $rows->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$feedbackDetails = array(
				"name" => ucwords($name),
				"image_name" => $image_name
			);
			if(in_array($cnt, $randomArray))
				array_push($arr["places_details"], $feedbackDetails);
			$cnt++;
		}
		echo json_encode($arr);
	}
	else {
		echo json_encode(array('status' => false, 'message' => 'No place found'));
	}
