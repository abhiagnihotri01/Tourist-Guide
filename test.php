<?php	

	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
	// $utility = new Utility();
	// $encrypted = $utility->string_encrypt_decrypt("himanshu", true);
	// echo $encrypted . "<br>";
	// echo $utility->string_encrypt_decrypt($encrypted, false);
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	$db = new DB();
	$conn = $db->getConnection();
	$user = new User($conn);
	if($user->authenticate())
		echo "Logged in";
	else
		echo "NOT Logged in";