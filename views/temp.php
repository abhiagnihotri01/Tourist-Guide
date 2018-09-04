<pre>
<?php

	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
	// $db = new DB();
	// $conn = $db->getConnection();
	// $user = new User($conn);
	$utility = new Utility();
	print_r($utility->makeTour("28.7041", "77.1025", array("4d4b7104d754a06370d81259","4bf58dd8d48988d11f941735"), 3, 30000));
?>
</pre>