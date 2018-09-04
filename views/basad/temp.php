<body>
	<pre>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');

		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		$utility = new Utility();
		$str = "Lal Qila";
		// $utility->getVenueInformationUsingId("4b42e3c7f964a520b5da25e3");
		// $utility->getVenuesListUsingLatLng("25.491283", "81.87005909999999", 20000);
		print_r($utility->getDistanceAndTime(array("25.5", "81.8"), array(array("25.450548410118", "81.836421704724"), array("25.454642155036", "81.834768713343"), array("25.392185910843", "25.392185910843"), array("25.430014780206", "81.879821551313")), "driving"));
		// print_r($utility->getVenuesListUsingCityName("delhi", [], 20000));
		// print_r($utility->getVenuesListUsingCategories("25.5", "81.8", array("52e81612bcbc57f1066b7a3e", "4bf58dd8d48988d132941735", "52e81612bcbc57f1066b7a3f", "4bf58dd8d48988d138941735"), 20000));
		// print_r($utility->openSuggestCompletionPlace("Delhi", $str));
		// $url = "https://api.foursquare.com/v2/venues/explore?ll=25.4983146,81.8698831&radius=100000&limit=10&client_id=I4CNW2P23UGF3TIIXVWAPGYC0HF5KI0UJ5XJFDJFV5LLFUAV&client_secret=E14EDSPKZOFJDL4TQF2IB2ON4ZXTJUOSRABHEIWJ1VG32CWY&v=20180317";
		// print_r($utility->callGetApi($url));
	?>
	</pre>
</body>