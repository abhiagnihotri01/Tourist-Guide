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
		if(isset($_POST['city'])) {
			$tags_id_array = json_decode($_POST['tags'], true);
			// $tags_id_array = $user->getTagsId($tags);
		}
		else if(!isset($_POST['tags'])) {
			// $tags_id_array = json_decode($_POST['tags'], true);
			$category = $_POST['category'];
			$tags_id_array = $utility->convertCategoryNameToCategoryId($category);
		}
		if(empty($tags_id_array)) {
			if($_POST['city'] == "") {
				$venue_array = $utility->getVenuesListUsingLatLng($_POST['lat'], $_POST['lng'], $_POST['radius']);
			}
			else {
				$venue_array = $utility->getVenuesListUsingCityName($_POST['city'], $tags_id_array, $_POST['radius']);
			}
		}
		else {
			if($_POST['city'] == "") {
				$venue_array = $utility->getVenuesListUsingCategories($_POST['lat'], $_POST['lng'], $tags_id_array, $_POST['radius']);
			}
			else {
				$venue_array = $utility->getVenuesListUsingCityName($_POST['city'], $tags_id_array, $_POST['radius']);
			}
		}
		echo json_encode(array('status' => true, 'destination_details' => $venue_array));
	}