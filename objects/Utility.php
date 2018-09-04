<?php
	// error_reporting(0);
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Admin.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Tsp.php');
	class Utility {
		// 1. Nice history to this place and the place amazes me and tickles my buds ever time. 
		// 2. Wouldn't really go out of my way to stop here. It does have some nice views but not much different than other areas.
		// 3. Really nice place to visit, everybody should visit once this place.
		// 4. A traveler can never get enough of a place and so is with me, if you want to go and explore with friends, just go there.
		// 5. This is the place with which you will never fed up.
		// 6. If you really love to travel then you must visit this place once.
		// 7. if you are planning a holiday, then you must include this place in your list.
		// 8. If you visit this place once, I am sure you will get fond of visiting this place.
		// 9. I have gone to many places, but this one is my favourite.
		// 10. Awesome place! really want to spend quality time then you must go there.

		public function hashPassword($pass) {
			$password_hash = password_hash($pass, PASSWORD_BCRYPT);
			// password_verify( $password_input_string, $hash ) <- use for verifying
			return $password_hash;
		}

   //      function callGetApi($url) {
			// $ch = curl_init();
			// curl_setopt($ch, CURLOPT_URL, $url);
			// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			// $output=curl_exec($ch);
			// curl_close($ch);
			// $output = json_decode($output, true);
			// // echo "dadada";
			// return $output;
	  //   }

		public function callGetApi($url) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_PROXY, '172.31.102.29');
			curl_setopt($ch, CURLOPT_PROXYPORT, '3128');
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'edcguest:edcguest');			
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$output = curl_exec($ch);
			curl_close($ch);
			$output = json_decode($output, true);
			return $output;
		}
		public function string_encrypt_decrypt($string, $action = true) {
			$secret_key = 'ec457d0a974c48d5685a7efa03d137dc8bbde7e3';
			$secret_iv = 'lfa7efa03dj457d0a974cdc8bbde7e48d56851373';
			$output = false;
			$encrypt_method = "AES-256-CBC";
			$key = hash('sha256', $secret_key);
			$iv = substr(hash('sha256', $secret_iv), 0, 16);
		 
			if($action)	// true => encrypt
				$output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
			else 	// false => decrypt
				$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
			return $output;
		}
		public function getAllFeedbacks($conn) {
			$query = "SELECT feedback.id, users.name, feedback_text, stars, users.image_name FROM users, feedback WHERE feedback.user_id = users.id AND users.is_deleted = 0 AND feedback.is_deleted = 0";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function getNDestinations($conn) {
			$query = "SELECT name, image_name FROM places WHERE is_deleted = 0";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function getAllPhobia($conn) {
			$query = "SELECT DISTINCT tags_phobia.id, tags.name as tag_name, tags_phobia.phobia as phobia_name FROM tags_phobia, tags WHERE tags_phobia.tag_id = tags.id AND tags.is_deleted = 0 AND tags_phobia.is_deleted = 0";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function getAllRestrictions($conn) {
			$query = "SELECT id, restriction_name FROM restrictions WHERE is_deleted = 0";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		public function getStarsFromRatings($rating) {
			return $rating;
		}
		public function getRestrictionNames() {
			$db = new DB();
			$conn = $db->getConnection();
			$user = new User($conn);
			$res_arr = $this->getAllRestrictions($conn);
			$restriction_name = array();
			while($row = $res_arr->fetch(PDO::FETCH_ASSOC)) {
				array_push($restriction_name, $row['restriction_name']);
			}
			return $restriction_name;
		}
		public function getAllCategories($categoryArray) {
			$utility = new Utility();
			$username = $utility->string_encrypt_decrypt($_SESSION['isLoggedIn']['username'], false);
			$query = "SELECT id FROM users WHERE username=:username AND is_deleted = 0";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$user_id = $row['id'];

		}
		public function getVenueInformationUsingId($venueId) {
	    	$url = "https://api.foursquare.com/v2/venues/".$venueId."?&client_id=VMWPXJZBAR1Z1JYFTRRR4WDENGDBS1WZXIVYSIDYGFQWJZOM&client_secret=GMAVY3PKK1Y303U52QASFHBOQAUFRQQ1215AWNG2FWTXVZPR&v=20180405";
	    	$output = $this->callGetApi($url);
	    	// print_r($output);
	    	$venue = array();
	    	if(isset($output['response']['venue']['id']))
	    	    $venue['id'] = $output['response']['venue']['id'];
	    	if(isset($output['response']['venue']['name']))
	    	    $venue['name'] = $output['response']['venue']['name'];
	    	if(isset($output['response']['venue']['location']['address']))
	    	    $venue['address'] = $output['response']['venue']['location']['address'];
	    	if(isset($output['response']['venue']['location']['city']))
	    	    $venue['city'] = $output['response']['venue']['location']['city'];
	    	if(isset($output['response']['venue']['location']['state']))
	    	    $venue['state'] = $output['response']['venue']['location']['state'];
	    	if(isset($output['response']['venue']['location']['country']))
	            $venue['country'] = $output['response']['venue']['location']['country'];
	        if(isset($output['response']['venue']['location']['lat']))
	    	    $venue['lat'] = $output['response']['venue']['location']['lat'];
	    	if(isset($output['response']['venue']['location']['lng']))
	    	    $venue['lng'] = $output['response']['venue']['location']['lng'];
	    	// ------------------------- description ------------------------
	    	if(isset($output['response']['venue']['description']))
	    		$venue['description'] = $output['response']['venue']['description'];                
	    	else {
	    		$description_array = $this->getDescriptionArray();
	    		$randomIndex = mt_rand(0, count($description_array)-1);
	    		$venue['description'] = $description_array[$randomIndex];
	    	}	    	
	    	if(isset($output['response']['venue']['rating']))
	    	    $venue['rating'] = $output['response']['venue']['rating'];
	    	if(isset($output['response']['venue']['hours']['status']))
	    	    $venue['status'] = $output['response']['venue']['hours']['status'];
	    	if(isset($output['response']['venue']['url']))
	    	    $venue['url'] = $output['response']['venue']['url'];
	    	if(isset($output['response']['venue']['contact']['phone']))
	    	    $venue['phone'] = $output['response']['venue']['contact']['phone'];
	    	if(isset($output['response']['venue']['likes']['count']))
	    	    $venue['likes'] = $output['response']['venue']['likes']['count'];
	    	else
	    		$venue['likes'] = mt_rand(10, 30);
	    	if(isset($output['response']['venue']['dislike']['count']))
	    	    $venue['dislikes'] = $output['response']['venue']['dislike']['count'];
	    	else {
	    		$venue['dislikes'] = max(round($venue['likes']*0.10), 0);
	    	}
	    	// ------------------------- PRICE -----------------------
	    	if(isset($output['response']['venue']['price']['tier'])) {
	    		$venue['price'] = "";
	    		for($i = 0; $i < $output['response']['venue']['price']['tier']; $i++) {
	    			$venue['price'] .= $output['response']['venue']['price']['currency'];
	    		}
	    		if($venue['price'] == "") {
	    			$venue['price'] = "";
	    			for($i = 0; $i < mt_rand(1, 3); $i++) {
	    				$venue['price'] .= "₹";
	    			}
	    		}
	    	}
	    	else {
	    		$venue['price'] = "";
	    		for($i = 0; $i < mt_rand(1, 3); $i++) {
	    			$venue['price'] .= "₹";
	    		}
	    	}
	    	for($i=0;;$i++){
	    	    if(isset($output['response']['venue']['categories'][$i]['name'])){
	    	    	if($i == 0)
	    	    		$venue['category'] = $output['response']['venue']['categories'][0]['name'];
	    	    	else
	    	            $venue['category'] = $venue['category'].", ".$output['response']['venue']['categories'][$i]['name'];
	    	    }
	    	    else
	    	    	break;
	        }
	        if(isset($venue['category']))
            	$venue['photo'] = $this->assignImageNameToCategory($venue['category']);
            else
            	$venue['photo'] = 'tag_image/no_image.jpeg';
            for($i=0;;$i++){
	    	    if(isset($output['response']['venue']['photos']['groups'][0]['items'][$i])){
	    	        $venue['photo'.$i] = $output['response']['venue']['photos']['groups'][0]['items'][$i]['prefix']."original".$output['response']['venue']['photos']['groups'][0]['items'][$i]['suffix'];
	    	    }
	    	    else {
	    	    	break;
	    	    }
	        }
            for($i=0;;$i++){
            	if(isset($output['response']['venue']['tips']['groups'][0]['items'][$i]['text'])) {
    	    		$venue['userReview'.$i] = $output['response']['venue']['tips']['groups'][0]['items'][$i]['text'];
    	    		if(isset($output['response']['venue']['tips']['groups'][0]['items'][$i]['user']['photo'])) {
    	    			$venue['userPhoto'.$i] = $output['response']['venue']['tips']['groups'][0]['items'][$i]['user']['photo']['prefix']."original".$output['response']['venue']['tips']['groups'][0]['items'][$i]['user']['photo']['suffix'];
    	    		}
	    	    }
	    	    else {
	    	    	break;
	    	    }
	        }

	    	return $venue;
		}
		public function reduceString($description, $len = 30){
			$newDescription="";
			$c=0;
			for($i = 0; $i < strlen($description); $i++){
				if($i < $len){
					$newDescription = $newDescription.$description[$i];
				}
				else{
					if($description[$i] == " "){
						$newDescription = $newDescription."...";
						break;
					}
					else
					    $newDescription = $newDescription.$description[$i];		
				}
			}
			//echo $newDescription;
			return $newDescription;
		}		
		public function getVenuesListUsingCategories($lat, $lng, $category, $radius=20000){
			$url = "https://api.foursquare.com/v2/venues/search?categoryId=".$category[0];
			for($i=0;$i<count($category);$i++) {
				$url = $url.",".$category[$i];
			}
			$url = $url."&ll=".$lat.",".$lng."&radius=".$radius."&limit=40&client_id=VMWPXJZBAR1Z1JYFTRRR4WDENGDBS1WZXIVYSIDYGFQWJZOM&client_secret=GMAVY3PKK1Y303U52QASFHBOQAUFRQQ1215AWNG2FWTXVZPR&v=20180317";
			$output = $this->callGetApi($url);
			$venueList = array();
			// print_r($output);
			$latLngArray = array();
			$restriction_name = $this->getRestrictionNames();
			foreach($output['response']['venues'] as $i){
				$venue = array();
				if(isset($i['id']))
					$venue['id'] = $i['id'];
				if(isset($i['name']))
					$venue['name'] = $i['name'];
				if(isset($i['location']['address']))
	    	        $venue['address'] = $i['location']['address'];
	    		if(isset($i['location']['city']))
	    	    	$venue['city'] = $i['location']['city'];
	    		if(isset($i['location']['state']))
	    	   		$venue['state'] = $i['location']['state'];
	    		if(isset($i['location']['country']))
	            	$venue['country'] = $i['location']['country'];
				if(isset($i['categories'][0]['name']))
					$venue['category'] = $i['categories'][0]['name'];
				// echo $i['venue']['location']['lat'];
				if(isset($i['location']['lat']))
					$venue['lat'] = $i['location']['lat'];
				if(isset($i['location']['lng']))
					$venue['lng'] = $i['location']['lng'];				
				array_push($latLngArray, array($venue['lat'], $venue['lng']));
				if(isset($venue['category']))
					$venue['photo'] = $this->assignImageNameToCategory($venue['category']);
				else
					$venue['photo'] = 'tag_image/no_image.jpeg';				
				$tempVar = true;
				for($k = 0; $k < count($restriction_name); $k++) {
					if(stristr($venue['name'], $restriction_name[$k])) {
						$tempVar = false;
						break;
					}
				}
				// ------------------------- PRICE -----------------------
				if(isset($i['venue']['price']['tier'])) {
					$venue['price'] = "";
					for($k = 0; $k < $i['venue']['price']['tier']; $k++) {
						$venue['price'] .= $i['venue']['price']['currency'];
					}
					if($venue['price'] == "") {
						$venue['price'] = "";
						for($k = 0; $k < mt_rand(1, 3); $k++) {
							$venue['price'] .= "₹";
						}
					}
				}
				else {
					$venue['price'] = "";
					for($k = 0; $k < mt_rand(1, 3); $k++) {
						$venue['price'] .= "₹";
					}
				}
				// ------------------------- description ------------------------
				if(isset($i['tips'][0]['text']))
					$venue['description'] = $i['tips'][0]['text'];                
				else {
					$description_array = $this->getDescriptionArray();
					$randomIndex = mt_rand(0, count($description_array)-1);
					$venue['description'] = $description_array[$randomIndex];
				}
				// -------------------------- likes -----------------------
				if(isset($i['tips'][0]['likes']))
					$venue['likes'] = $i['tips'][0]['likes']['count'];
				else
					$venue['likes'] = mt_rand(10, 30);
				if(isset($i['venue']['rating']))
					$venue['rating'] = $this->getStarsFromRatings($i['venue']['rating']);
				else
					$venue['rating'] = $this->getStarsFromRatings(mt_rand(6,9));
				$venue['description'] = $this->reduceString($venue['description']);
				if($tempVar)
					array_push($venueList, $venue);					
			}
			$finArr = array();
			$distanceTimeArray = $this->getDistanceAndTime(array($lat, $lng), $latLngArray, "driving");
			for($i = 0; $i < count($venueList); $i++) {
				$venueList[$i]['distance'] = $distanceTimeArray[$i]['distance'];
				$venueList[$i]['duration'] = $distanceTimeArray[$i]['duration'];
				$dis = explode(" ", $venueList[$i]['distance'])[0];
				if($dis <= $radius/1000) {
					array_push($finArr, $venueList[$i]);
				}
			}
			return $finArr;
		}
		public function getDescriptionArray() {
			$description_array = array();
			array_push($description_array, "Nice history to this place and the place amazes me and tickles my buds ever time.");
			array_push($description_array, "Wouldn't really go out of my way to stop here. It does have some nice views but not much different than other areas.");
			array_push($description_array, "Really nice place to visit, everybody should visit once this place.");
			array_push($description_array, "A nice place to hangout.");
			array_push($description_array, "A must visit to feel nice vibes");
			array_push($description_array, "A traveler can never get enough of a place and so is with me, if you want to go and explore with friends, just go there");
			array_push($description_array, "This is the place with which you will never fed up.");
			array_push($description_array, "If you really love to travel then you must visit this place once.");
			array_push($description_array, "if you are planning a holiday, then you must include this place in your list.");
			array_push($description_array, "If you visit this place once, you will get fond of visiting this place.");
			array_push($description_array, "People have gone to many places, but this one is their favourite.");
			array_push($description_array, "Awesome place! really want to spend quality time then you must go there.");
			return $description_array;
		}
		public function getPhotos($venueList){
			$i=-1;
			foreach($venueList as $venue){   		
				$url = "https://api.foursquare.com/v2/venues/".$venue['id']."/photos?&limit=1&client_id=VMWPXJZBAR1Z1JYFTRRR4WDENGDBS1WZXIVYSIDYGFQWJZOM&client_secret=GMAVY3PKK1Y303U52QASFHBOQAUFRQQ1215AWNG2FWTXVZPR&v=20180319";
				$output = $this->callGetApi($url);        	    
				if($output['response']['photos']['count'] >= 1){
					$venueList[++$i]['photo'] = $output['response']['photos']['items'][0]['prefix'].'original'.$output['response']['photos']['items'][0]['suffix'];
				}
				else{
					++$i;
				}
			}
			return $venueList;
		}
		public function getVenuesListUsingLatLng($lat, $lng, $radius = 20000){
			$url = "https://api.foursquare.com/v2/venues/explore?ll=".$lat.",".$lng."&radius=".$radius."&limit=40&client_id=VMWPXJZBAR1Z1JYFTRRR4WDENGDBS1WZXIVYSIDYGFQWJZOM&client_secret=GMAVY3PKK1Y303U52QASFHBOQAUFRQQ1215AWNG2FWTXVZPR&v=20180413";
			// echo $url;
			return $this->getVenuesListUsingCategories($lat, $lng, array(), $radius);
			$output = $this->callGetApi($url);
			print_r($output);
			$venueList = array();
			$latLngArray = array();
			$restriction_name = $this->getRestrictionNames();
			foreach($output['response']['groups'][0]['items'] as $i){
				$venue = array();
				if(isset($i['venue']['id']))
					$venue['id'] = $i['venue']['id'];
				if(isset($i['venue']['name']))
					$venue['name'] = $i['venue']['name'];
				if(isset($i['venue']['location']['address']))
					$venue['address'] = $i['venue']['location']['address'];
				if(isset($i['venue']['location']['city']))
					$venue['city'] = $i['venue']['location']['city'];
				if(isset($i['venue']['location']['state']))
					$venue['state'] = $i['venue']['location']['state'];
				if(isset($i['venue']['location']['country']))
					$venue['country'] = $i['venue']['location']['country'];
				if(isset($i['venue']['location']['lat']))
					$venue['lat'] = $i['venue']['location']['lat'];
				if(isset($i['venue']['location']['lng']))
					$venue['lng'] = $i['venue']['location']['lng'];
				array_push($latLngArray, array($venue['lat'], $venue['lng']));
				if(isset($i['venue']['hours']['status']))
					$venue['hours'] = $i['venue']['hours']['status'];
				if(isset($i['venue']['url']))
					$venue['url'] = $i['venue']['url'];
				if(isset($i['venue']['categories'][0]['name']))
					$venue['category'] = $i['venue']['categories'][0]['name'];
				if(isset($venue['category']))
					$venue['photo'] = $this->assignImageNameToCategory($venue['category']);
				else
					$venue['photo'] = 'tag_image/no_image.jpeg';
				// ------------------------- PRICE -----------------------
				if(isset($i['venue']['price']['tier'])) {
					$venue['price'] = "";
					for($k = 0; $k < $i['venue']['price']['tier']; $k++) {
						$venue['price'] .= $i['venue']['price']['currency'];
					}
					if($venue['price'] == "") {
						$venue['price'] = "";
						for($k = 0; $k < mt_rand(1, 3); $k++) {
							$venue['price'] .= "₹";
						}
					}
				}
				else {
					$venue['price'] = "";
					for($k = 0; $k < mt_rand(1, 3); $k++) {
						$venue['price'] .= "₹";
					}
				}
				// -------------------------- likes -----------------------
				if(isset($i['tips'][0]['likes'])) {
					$venue['likes'] = $i['tips'][0]['likes']['count'];
				}
				else {
					$venue['likes'] = mt_rand(10, 30);
				}
				if(isset($i['venue']['rating'])) {
					$venue['rating'] = $this->getStarsFromRatings($i['venue']['rating']);
				}
				else {
					$venue['rating'] = $this->getStarsFromRatings(mt_rand(6,9));    	    	
				}
				// ------------------------- description ------------------------
				if(isset($i['tips'][0]['text'])) {
					$venue['description'] = $i['tips'][0]['text'];                
				}
				else {
					// $description_array = $this->getDescriptionArray();
					// $randomIndex = mt_rand(0, count($description_array)-1);
					// $venue['description'] = $description_array[$randomIndex];
				}
				$tempVar = true;
				for($k = 0; $k < count($restriction_name); $k++) {
					if(stristr($venue['name'], $restriction_name[$k])) {
						$tempVar = false;
						break;
					}
				}
				$venue['description'] = $this->reduceString($venue['description']);
				if($tempVar)
					array_push($venueList, $venue);
			}
			// get distance for all
			$finArr = array();
			$distanceTimeArray = $this->getDistanceAndTime(array($lat, $lng), $latLngArray, "driving");
			for($i = 0; $i < count($venueList); $i++) {
				$venueList[$i]['distance'] = $distanceTimeArray[$i]['distance'];
				$venueList[$i]['duration'] = $distanceTimeArray[$i]['duration'];
				$dis = explode(" ", $venueList[$i]['distance'])[0];
				if($dis <= $radius/1000) {
					array_push($finArr, $venueList[$i]);
				}
			}
			return $finArr;
		}
		public function getVenuesListUsingCityName($city, $category, $radius = 20000){
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$city."&key=AIzaSyCSubKz2ZWNFdsWQXk8c5QBMCl4FeenxLQ";
			$apiArr = $this->callGetApi($url);
			$lat = $apiArr['results'][0]['geometry']['location']['lat'];
			$lng = $apiArr['results'][0]['geometry']['location']['lng'];
			return $this->getVenuesListUsingCategories($lat, $lng, $category, $radius);
			if(empty($category)) {
				$url = "https://api.foursquare.com/v2/venues/search?near=".$city."&radius=".$radius."&limit=40&client_id=VMWPXJZBAR1Z1JYFTRRR4WDENGDBS1WZXIVYSIDYGFQWJZOM&client_secret=GMAVY3PKK1Y303U52QASFHBOQAUFRQQ1215AWNG2FWTXVZPR&v=20180319";
			}
			else {
				$cat = $category[0];
				for($i=1;$i<count($category);$i++)
					$cat = $cat.",".$category[$i];        	
				$url = "https://api.foursquare.com/v2/venues/search?near=".$city."&categoryId=".$cat."&radius=".$radius."&limit=40&client_id=VMWPXJZBAR1Z1JYFTRRR4WDENGDBS1WZXIVYSIDYGFQWJZOM&client_secret=GMAVY3PKK1Y303U52QASFHBOQAUFRQQ1215AWNG2FWTXVZPR&v=20180319";
			}
			// echo $url;
			$output = $this->callGetApi($url);
			$venueList = array();
			$restriction_name = $this->getRestrictionNames();
			$latLngArray = array();
			foreach($output['response']['venues'] as $i){
				$venue = array();
				if(isset($i['id']))
					$venue['id'] = $i['id'];
				if(isset($i['name']))
					$venue['name'] = $i['name'];
				if(isset($i['location']['address']))
					$venue['address'] = $i['location']['address'];
				if(isset($i['location']['city']))
					$venue['city'] = $i['location']['city'];
				if(isset($i['location']['state']))
					$venue['state'] = $i['location']['state'];
				if(isset($i['location']['country']))
					$venue['country'] = $i['location']['country'];
				if(isset($i['location']['lat']))
					$venue['lat'] = $i['location']['lat'];
				if(isset($i['location']['lng']))
					$venue['lng'] = $i['location']['lng'];
				array_push($latLngArray, array($venue['lat'], $venue['lng']));
				if(isset($i['url']))
					$venue['url'] = $i['url'];
				if(isset($i['categories'][0]['name']))
					$venue['category'] = $i['categories'][0]['name'];
				if(isset($venue['category']))
					$venue['photo'] = $this->assignImageNameToCategory($venue['category']);
				else
					$venue['photo'] = 'tag_image/no_image.jpeg';				
				$tempVar = true;
				for($k = 0; $k < count($restriction_name); $k++) {
					if(stristr($venue['name'], $restriction_name[$k])) {
						$tempVar = false;
						break;
					}
				}
				// ------------------------- PRICE -----------------------
				if(isset($i['venue']['price']['tier'])) {
					$venue['price'] = "";
					for($k = 0; $k < $i['venue']['price']['tier']; $k++) {
						$venue['price'] .= $i['venue']['price']['currency'];
					}
					if($venue['price'] == "") {
						$venue['price'] = "";
						for($k = 0; $k < mt_rand(1, 3); $k++) {
							$venue['price'] .= "₹";
						}
					}
				}
				else {
					$venue['price'] = "";
					for($k = 0; $k < mt_rand(1, 3); $k++) {
						$venue['price'] .= "₹";
					}
				}
				// ------------------------- description ------------------------
				if(isset($i['tips'][0]['text'])) {
					$venue['description'] = $i['tips'][0]['text'];                
				}
				else {
					$description_array = $this->getDescriptionArray();
					$randomIndex = mt_rand(0, count($description_array)-1);
					$venue['description'] = $description_array[$randomIndex];
				}
				// -------------------------- likes -----------------------
				if(isset($i['tips'][0]['likes'])) {
					$venue['likes'] = $i['tips'][0]['likes']['count'];
				}
				else {
					$venue['likes'] = mt_rand(10, 30);
				}
				if(isset($i['venue']['rating'])) {
					$venue['rating'] = $this->getStarsFromRatings($i['venue']['rating']);
				}
				else {
					$venue['rating'] = $this->getStarsFromRatings(mt_rand(6,9));
				}
				$venue['description'] = $this->reduceString($venue['description']);
				if($tempVar)
					array_push($venueList, $venue);					
			}
			// get distance for all
			$finArr = array();
			$distanceTimeArray = $this->getDistanceAndTime(array($lat, $lng), $latLngArray, "driving");
			for($i = 0; $i < count($venueList); $i++) {
				$venueList[$i]['distance'] = $distanceTimeArray[$i]['distance'];
				$venueList[$i]['duration'] = $distanceTimeArray[$i]['duration'];
				$dis = explode(" ", $venueList[$i]['distance'])[0];
				if($dis <= $radius/1000) {
					array_push($finArr, $venueList[$i]);
				}
			}
			return $finArr;
		}
		public function assignImageNameToCategory($category){
	    	//$category = strtolower($category);
	    	//echo $category;
	    	$imageName = "";
	    	if(stristr($category, "restaurant") != false || stristr($category, "food") != false || stristr($category, "joint") != false)
		    	$imageName = "tag_image/restaurant.jpg"; 
		    else if(stristr($category, "burger") != false || stristr($category, "pizza") != false || stristr($category, "breakfast") != false || stristr($category, "snack") != false)
		    	$imageName = "tag_image/snack.jpg";
		    else if(stristr($category, "bakery") != false)
		    	$imageName = "tag_image/bakery.jpg";
		    else if(stristr($category, "bus") != false)
		    	$imageName = "tag_image/bus.png";
		    else if(stristr($category, "library") != false)
		    	$imageName = "tag_image/library.jpg";
		    else if(stristr($category, "college") != false || stristr($category, "university") != false)
		    	$imageName = "tag_image/college.jpg";
		    else if(stristr($category, "airport") != false)
		    	$imageName = "tag_image/airport.jpg";
		    else if(stristr($category, "stadium") != false)
		    	$imageName = "tag_image/ground.jpg";
		    else if(stristr($category, "metro") != false)
		    	$imageName = "tag_image/metro.jpg";
		    else if(stristr($category, "road") != false)
		    	$imageName = "tag_image/road.jpg";
		    else if(stristr($category, "petrol") != false || stristr($category, "gas") != false)
		    	$imageName = "tag_image/petrol.jpg";
		    else if(stristr($category, "medical") != false || stristr($category, "hospital") != false)
		    	$imageName = "tag_image/hospital.jpg";		    
		    else if(stristr($category, "multiplex") != false || stristr($category, "theater") != false || stristr($category, "movie") != false || stristr($category, "cinema") != false)
		    	$imageName = "tag_image/multiplex.jpg";
		    else if(stristr($category, "cloth") != false)  //clothing store
		    	$imageName = "tag_image/cloth.jpg";
		    else if(stristr($category, "market") != false || stristr($category, "plaza") != false || stristr($category, "store") != false)   //flea market
		    	$imageName = "tag_image/market.png";
		    else if(stristr($category, "river") != false || stristr($category, "lake") != false)
		    	$imageName = "tag_image/river.jpg";
		    else if(stristr($category, "ca") != false || stristr($category, "coff") != false || stristr($category, "tea") != false)
		    	$imageName = "tag_image/cafe.jpg";
		    else if(stristr($category, "hotel") != false || stristr($category, "lounge") != false)
		    	$imageName = "tag_image/hotel.jpg";
		    else if(stristr($category, "mall") != false || stristr($category, "shop") != false)   //shopping mall
		    	$imageName = "tag_image/mall.jpg";
		    else if(stristr($category, "train") != false)   //train station
		    	$imageName = "tag_image/train.jpg";
		    else if(stristr($category, "park") != false || stristr($category, "garden") != false)
		    	$imageName = "tag_image/park.jpg";
		    else if(stristr($category, "art gallery") != false)   
		    	$imageName = "tag_image/art_gallery.jpg";
		    else if(stristr($category, "resort") != false || stristr($category, "beach") != false)
		    	$imageName = "tag_image/beach.jpg";
		    else if(stristr($category, "outdoor") != false)
		    	$imageName = "tag_image/outdoor.jpg";
		    else if(stristr($category, "museum") != false)
		    	$imageName = "tag_image/museum.jpg";
		    else if((stristr($category, "pub") != false || stristr($category, "club") != false || stristr($category, "bar") != false) && stristr($category, "public") == false)
		    	$imageName = "tag_image/pub.jpg";
		    else if(stristr($category, "castle") != false)
		    	$imageName = "tag_image/castle.jpg";
		    else if(stristr($category, "hindu temple") != false)
		    	$imageName = "tag_image/hindu_temple.jpg";
		    else if(stristr($category, "mosque") != false)
		    	$imageName = "tag_image/mosque.jpg";
		    else if(stristr($category, "buddhist_temple") != false)
		    	$imageName = "tag_image/buddhist_temple.jpg";
		    else if(stristr($category, "church") != false)
		    	$imageName = "tag_image/church.jpg";
		    else if(stristr($category, "post office") != false || stristr($category, "government") != false)
		    	$imageName = "tag_image/government.jpg";		    
		    else if(stristr($category, "school") != false || stristr($category, "college") != false || stristr($category, "university") != false)
		    	$imageName = "tag_image/school.jpg";
		    // else if(stristr($category, "building") != false)
		    // 	$imageName = "building.jpeg";
		    else if(stristr($category, "bank") != false) {
		    	$imageName = "tag_image/bank.jpg";
		    }
		    else if(stristr($category, "office") != false || stristr($category, "coworking") != false || stristr($category, "professional") != false)
		    	$imageName = "tag_image/office.jpg";
		    else if(stristr($category, "gym") != false || stristr($category, "workout") != false)
		    	$imageName = "tag_image/gym.jpg";
		    else if(stristr($category, "tattoo") != false)
		    	$imageName = "tag_image/tattoo.jpg";
		    else if(stristr($category, "mountain") != false)
		    	$imageName = "tag_image/mountain.png";
		    else if(stristr($category, "historic") != false)
		    	$imageName = "tag_image/historic_site.jpg";
		    else if(stristr($category, "planetarium") != false)
		    	$imageName = "tag_image/planetarium.jpg";		    
		    else if(stristr($category, "music") != false)
		    	$imageName = "tag_image/music.jpg";
		    else if(stristr($category, "cricket") != false)
		    	$imageName = "tag_image/cricket_ground.jpg";		    
		    else if(stristr($category, "concert") != false || stristr($category, "hall") != false)
		    	$imageName = "tag_image/concert_hall.jpg";
		    else
		    	$imageName = "tag_image/no_image.jpeg";
	    	return $imageName;
	    }
	    //$destination is an array of lat and lng
	    //$mode=driving,walking,bicycling,train
	    public function getDistanceAndTime($source, $destinations, $mode = "dri"){
	        if($mode == "train"){
	            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&mode=transit&transit_mode=train&origins=".$source[0].",".$source[1]."&destinations=";            
	        }
	        else{
	        	$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&mode=".$mode."&origins=".$source[0].",".$source[1]."&destinations=";
	        }
	        $c=0;
	        $i = array();
	        foreach($destinations as $i){
	        	$c++;
	        	if($c == 1)
	        	    $url = $url.$i[0].",".$i[1];
	        	else
	        		$url = $url."|".$i[0].",".$i[1];
	        }	        
	        $url = $url."&key=AIzaSyDmL6_uyTmZ8pf0inhKnAPwgL0WAWI0TcY";
	        // echo $url;
	        $result = $this->callGetApi($url);
	        // print_r($result);
	        $distTime = array();
	        $i = array();
	        $a = array();
	        foreach($result['rows'][0]['elements'] as $i){
	        	if(isset($i['distance']['text']))
	                $a['distance'] = $i['distance']['text'];
	            if(isset($i['duration']['text']))
	                $a['duration'] = $i['duration']['text'];
	            array_push($distTime, $a);
	        }
	        return $distTime;
	    }
	    public function convertCategoryNameToCategoryId($categoryString){
        	$categoryName = array();
            $categoryId = array();
            $str1="";
            for($i=0;$i<strlen($categoryString);$i++){
            	if(strtolower($categoryString[$i]) >= 'a' && strtolower($categoryString[$i]) <= 'z')
                    $str1 = $str1."".$categoryString[$i];
            	else if($categoryString[$i] == ','){
            		array_push($categoryName, $str1);
            		$str1="";
            	}
            }
            array_push($categoryName, $str1);
            for($i=0;$i<count($categoryName);$i++){
    	        if(stristr($categoryName[$i], "restaurant") != false || stristr($categoryName[$i], "burger") != false || stristr($categoryName[$i], "breakfast") != false || stristr($categoryName[$i], "food") != false)	        	
    	        	array_push($categoryId, "4d4b7105d754a06374d81259");
    	        else if(stristr($categoryName[$i], "multiplex") != false || stristr($categoryName[$i], "movie theater") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d17f941735");
    		    else if(stristr($categoryName[$i], "cloth") != false)  //clothing store
    		    	array_push($categoryId, "4bf58dd8d48988d103951735");
    		    else if(stristr($categoryName[$i], "market") != false)   //flea market
    		    	array_push($categoryId, "50be8ee891d4fa8dcc7199a7");
    		    else if(stristr($categoryName[$i], "river") != false || stristr($categoryName[$i], "lake") != false)
    		    	array_push($categoryId, "4eb1d4dd4b900d56c88a45fd");
    		    else if(stristr($categoryName[$i], "pizza") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d1ca941735");
    		    else if(stristr($categoryName[$i], "ca") != false || stristr($categoryName[$i], "coff") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d16d941735");
    		    else if(stristr($categoryName[$i], "hotel") != false || stristr($categoryName[$i], "lounge") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d1fa931735");
    		    else if(stristr($categoryName[$i], "mall") != false || stristr($categoryName[$i], "shop") != false)   //shopping mall
    		    	array_push($categoryId, "4bf58dd8d48988d1fd941735");
    		    else if(stristr($categoryName[$i], "train") != false)   //train station
    		    	array_push($categoryId, "4bf58dd8d48988d129951735");
    		    else if(stristr($categoryName[$i], "park") != false)  
    		    	array_push($categoryId, "4bf58dd8d48988d163941735");
    		    else if(stristr($categoryName[$i], "art gallery") != false)   
    		    	array_push($categoryId, "4bf58dd8d48988d1e2931735");
    		    else if(stristr($categoryName[$i], "resort") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d12f951735");
    		    else if(stristr($categoryName[$i], "beach") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d1e2941735");
    		    else if(stristr($categoryName[$i], "outdoor") != false)
    		    	array_push($categoryId, "4d4b7105d754a06377d81259");
    		    else if(stristr($categoryName[$i], "museum") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d181941735");
    		    else if(stristr($categoryName[$i], "medical") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d104941735");
    		    else if(stristr($categoryName[$i], "pub") != false && stristr($categoryName[$i], "public") == false)
    		    	array_push($categoryId, "4bf58dd8d48988d11b941735");
    		    else if(stristr($categoryName[$i], "castle") != false)
    		    	array_push($categoryId, "50aaa49e4b90af0d42d5de11");
    		    else if(stristr($categoryName[$i], "hindu") != false)
    		    	array_push($categoryId, "52e81612bcbc57f1066b7a3f");
    		    else if(stristr($categoryName[$i], "mosque") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d138941735");
    		    else if(stristr($categoryName[$i], "buddhist") != false)
    		    	array_push($categoryId, "52e81612bcbc57f1066b7a3e");
    		    else if(stristr($categoryName[$i], "church") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d132941735");
    		    else if(stristr($categoryName[$i], "post office") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d172941735");
    		    else if(stristr($categoryName[$i], "government") != false)
    		        array_push($categoryId, "4bf58dd8d48988d126941735");
    		    else if(stristr($categoryName[$i], "school") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d13b941735");
    		    else if(stristr($categoryName[$i], "college") != false || stristr($categoryName[$i], "university") != false)
    		    	array_push($categoryId, "4d4b7105d754a06372d81259");
    		    else if(stristr($categoryName[$i], "historic site") != false)
    		    	array_push($categoryId, "4deefb944765f83613cdba6e");
    		    else if(stristr($categoryName[$i], "stadium") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d184941735");
    		    else if(stristr($categoryName[$i], "zoo") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d17b941735");
    		    else if(stristr($categoryName[$i], "event") != false)
    		    	array_push($categoryId, "4d4b7105d754a06373d81259");
    		    else if(stristr($categoryName[$i], "bar") != false)
    		    	array_push($categoryId, "4bf58dd8d48988d116941735");
    		}
            return $categoryId;
        }

        public function getSubtags($conn) {	// used in dashboard to get all subtags and display it
        	$subtag_arr = array();
        	for($i = 1; $i <= 8; $i++) {
        		$query = "SELECT tags.name, tags.hash FROM tags,tags_subtags WHERE tags_subtags.tag_id = :id AND tags_subtags.subtag_id = tags.id AND tags_subtags.is_deleted = 0 AND tags.is_deleted = 0";
        		$stmt = $conn->prepare($query);
        		$stmt->bindParam(":id", $i);
        		$stmt->execute();
        		$arr = array();
        		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        			array_push($arr, $row);
        		}
        		array_push($subtag_arr, $arr);
        	}
        	return $subtag_arr;
        }
		public function suggestCompletion($city, $string1){
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$city."&key=AIzaSyCSubKz2ZWNFdsWQXk8c5QBMCl4FeenxLQ";
			$apiArr = $this->callGetApi($url);
			$lat = $apiArr['results'][0]['geometry']['location']['lat'];
			$lng = $apiArr['results'][0]['geometry']['location']['lng'];
			$string2 = "";
			for($i=0;$i<strlen($string1);$i++){
				if($string1[$i] == " ")
					$string2 = $string2."+";
				else
					$string2 = $string2.$string1[$i];
			}
			$url = "https://api.foursquare.com/v2/venues/suggestcompletion?ll=".$lat.",".$lng."&query=".$string2."&limit=10&radius=30000&client_id=VMWPXJZBAR1Z1JYFTRRR4WDENGDBS1WZXIVYSIDYGFQWJZOM&client_secret=GMAVY3PKK1Y303U52QASFHBOQAUFRQQ1215AWNG2FWTXVZPR&v=20180319";
			$output = $this->callGetApi($url);
			$venueList = array();
			foreach($output['response']['minivenues'] as $i){	    	
				if(isset($i['name'])) {
				    array_push($venueList, explode(" | ", $i['name'])[0]);
				}
			}
			return $venueList;
		}
	    public function openSuggestCompletionPlace($city, $string1){
	    	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$city."&key=AIzaSyCSubKz2ZWNFdsWQXk8c5QBMCl4FeenxLQ";
	    	$apiArr = $this->callGetApi($url);
	    	$lat = $apiArr['results'][0]['geometry']['location']['lat'];
	    	$lng = $apiArr['results'][0]['geometry']['location']['lng'];
	    	$string2 = "";
	    	for($i=0;$i<strlen($string1);$i++){
	    		if($string1[$i] == " ")
	    			$string2 = $string2."+";
	    		else
	    			$string2 = $string2.$string1[$i];
	    	}
	    	$url = "https://api.foursquare.com/v2/venues/suggestcompletion?ll=".$lat.",".$lng."&query=".$string2."&limit=10&radius=30000&client_id=VMWPXJZBAR1Z1JYFTRRR4WDENGDBS1WZXIVYSIDYGFQWJZOM&client_secret=GMAVY3PKK1Y303U52QASFHBOQAUFRQQ1215AWNG2FWTXVZPR&v=20180319";	        
	    	$output = $this->callGetApi($url);
	        $venueList = array();
	        $latLngArray = array();
	        $description_array = $this->getDescriptionArray();
		    foreach($output['response']['minivenues'] as $i){
		    	$venue = array();
		    	if(isset($i['id']))
		    	    $venue['id'] = $i['id'];
		    	if(isset($i['name']))
		    	    $venue['name'] = $i['name'];
		    	if(isset($i['location']['address']))
		    	    $venue['address'] = $i['location']['address'];
		    	if(isset($i['location']['city']))
		    	    $venue['city'] = $i['location']['city'];
		    	if(isset($i['location']['state']))
		    	    $venue['state'] = $i['location']['state'];
		    	if(isset($i['location']['country']))
		            $venue['country'] = $i['location']['country'];
		        if(isset($i['location']['lat']))
		    	    $venue['lat'] = $i['location']['lat'];
		    	if(isset($i['location']['lng']))
		    	    $venue['lng'] = $i['location']['lng'];
		    	array_push($latLngArray, array($venue['lat'], $venue['lng']));
		    	$venue['category'] = "";
	            if(isset($i['categories'])){
	                // $c=0;	                
		    	    foreach($i['categories'] as $j){
		    	        if(isset($j['name'])){
		    	            $venue['category'] .= $j['name'].",";
		    	            // $c++;
		    	        }
		            }
		        }
		        $venue['photo'] = $this->assignImageNameToCategory($venue['category']);
		        // $randomIndex = mt_rand(0, count($description_array)-1);
		        // $venue['description'] = $description_array[$randomIndex];
		    	array_push($venueList, $venue);
		    }
		    $distanceTimeArray = $this->getDistanceAndTime(array($lat, $lng), $latLngArray, "driving");
		    for($i = 0; $i < count($venueList); $i++) {
		    	$venueList[$i]['distance'] = $distanceTimeArray[$i]['distance'];
		    	$venueList[$i]['duration'] = $distanceTimeArray[$i]['duration'];
		    }
		    return $venueList;
	    }
	    public function getFormattedTd($key, $value) {
	    	return "<tr><td><b>" . $key . "</b></td><td>" . $value . "</td></tr>";
	    }
	 //    public function makeTour($lat, $lng, $category, $days, $radius=30000){
		// 	$tsp = array();
		// 	$tsp[0] = new TSP;
		// 	$tsp[1] = new TSP;
		// 	$tsp[2] = new TSP;
		// 	$tsp[3] = new TSP;
		// 	$tourArray = array();
		// 	$venues = array();
		// 	$venuesList = $this->getVenuesListUsingCategories($lat, $lng, array("4d4b7104d754a06370d81259","4bf58dd8d48988d11f941735"), $radius);
		// 	$x=1;
		// 	$y=1;
		// 	foreach($venuesList as $i){
		//         $x++;
		// 		$latitude1 = (float)$i['lat'];
		// 		$longitude1 = (float)$i['lng'];
		// 		$tsp[$y-1]->add($i['name'].",".$i['lat'].",".$i['lng'], $longitude1, $latitude1);
		// 		if($x == 6){
		// 	    	$y++;
		// 		    $tsp[$y-2]->compute();
		//             $shortestRoute = $tsp[$y-2]->shortest_route();
		//             $route = array();
		//             for($j=0;$j<5;$j++){
		//             	$g=0;
		//                 $lat1="";
		//                 $lng1="";
		//                 $name1 = "";
		//             	for($k=0;$k<strlen($shortestRoute[$j]);$k++){
		//             		if($shortestRoute[$j][$k] == ','){
		//             			$g++;
		//             		}
		//             		else if($g == 1 && (is_numeric($shortestRoute[$j][$k]) || $shortestRoute[$j][$k] == '.')){
		//             			$lat1 = $lat1.$shortestRoute[$j][$k];
		//             		}
		//             		else if($g == 2 && (is_numeric($shortestRoute[$j][$k]) || $shortestRoute[$j][$k] == '.')){
		//             			$lng1 = $lng1.$shortestRoute[$j][$k];
		//             		}
		//             		else{
		//             			$name1=$name1.$shortestRoute[$j][$k];
		//             		}
		//             	}
		//             	$shortestRoute1 = array();
		//             	$shortestRoute1['name'] = $name1;
		//             	$shortestRoute1['lat'] = $lat1;
		//             	$shortestRoute1['lng'] = $lng1;
		//             	array_push($route, $shortestRoute1);
		//             }
		//             array_push($tourArray, $route);
		//             if($y > $days)
		//             	break;
		//             $x=1;
		// 	    }
		// 	}

            
		// 	// echo "<pre>";
		// 	// print_r($tourArray);
		// 	// echo "</pre>";
		// 	return $tourArray;
		// }
		public function makeTour($lat, $lng, $category, $days, $radius=30000){
			// $util = new Utility;
			$tsp = array();
			$tsp[0] = new TSP;
			$tsp[1] = new TSP;
			$tsp[2] = new TSP;
			$tsp[3] = new TSP;
			$tsp[4] = new TSP;
			$tsp[5] = new TSP;
			$tsp[6] = new TSP;
			$tsp[7] = new TSP;
			$tsp[8] = new TSP;
			$tsp[9] = new TSP;
			$tsp[10] = new TSP;
			//$shortestRoute = array();
			$tourArray = array();
			$venues = array();

			$venuesList = $this->getVenuesListUsingCategories($lat, $lng, $category, $radius);
			
			$x=1;
			$y=1;
			foreach($venuesList as $i){
		        $x++;
				$latitude1 = (float)$i['lat'];
				$longitude1 = (float)$i['lng'];

				$tsp[$y-1]->add($i['name']."@".$i['lat']."@".$i['lng']."@".$i['address']."@".$i['city']."@".$i['state']."@".$i['country'], $longitude1, $latitude1);
				
				if($x == 6){
					
			    	$y++;
				    $tsp[$y-2]->compute();
		            $shortestRoute = $tsp[$y-2]->shortest_route();
		            
		            $route = array();
		            for($j=0;$j<5;$j++){
		            	$g=0;
		            	$lat1="";
		                $lng1="";
		                $name1 = "";
		                $address1 = "";
		                $city1 = "";
		                $state1 = "";
		                $country1 = "";
		            	for($k=0;$k<strlen($shortestRoute[$j]);$k++){
		            		if($shortestRoute[$j][$k] == '@'){
		            			$g++;
		            		}
		            		// else if($g == 1 && (is_numeric($shortestRoute[$j][$k]) || $shortestRoute[$j][$k] == '.')){
		            		// 	$lat1 = $lat1.$shortestRoute[$j][$k];
		            		// }
		            		else if($g == 1){
		            			$lat1 = $lat1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 2){
		            			$lng1 = $lng1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 3){
		            			$address1 = $address1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 4){
		            			$city1 = $city1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 5){
		            			$state1 = $state1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 6){
		            			$country1 = $country1.$shortestRoute[$j][$k];
		            		}
		            		else{
		            			$name1=$name1.$shortestRoute[$j][$k];
		            		}
		            	}
		            	$shortestRoute1 = array();
		            	$shortestRoute1['name'] = $name1;
		            	$shortestRoute1['lat'] = $lat1;
		            	$shortestRoute1['lng'] = $lng1;
		            	$shortestRoute1['address'] = $address1;
		            	$shortestRoute1['city'] = $city1;
		            	$shortestRoute1['state'] = $state1;
		            	$shortestRoute1['country'] = $country1;
		            	array_push($route, $shortestRoute1);
		            }
		  
		            array_push($tourArray, $route);
		            $x=1;
		            if($y > $days)
		            	break;
		            
			    }
			}

			if($x > 1 && $x < 6){
				$y++;
				    $tsp[$y-2]->compute();
		            $shortestRoute = $tsp[$y-2]->shortest_route();
		            
		            $route = array();
		            for($j=0;$j<($x-1);$j++){
		            	$g=0;
		                $lat1="";
		                $lng1="";
		                $name1 = "";
		                $address1 = "";
		                $city1 = "";
		                $state1 = "";
		                $country1 = "";
		            	for($k=0;$k<strlen($shortestRoute[$j]);$k++){
		            		if($shortestRoute[$j][$k] == '@'){
		            			$g++;
		            		}
		            		// else if($g == 1 && (is_numeric($shortestRoute[$j][$k]) || $shortestRoute[$j][$k] == '.')){
		            		// 	$lat1 = $lat1.$shortestRoute[$j][$k];
		            		// }
		            		else if($g == 1){
		            			$lat1 = $lat1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 2){
		            			$lng1 = $lng1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 3){
		            			$address1 = $address1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 4){
		            			$city1 = $city1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 5){
		            			$state1 = $state1.$shortestRoute[$j][$k];
		            		}
		            		else if($g == 6){
		            			$country1 = $country1.$shortestRoute[$j][$k];
		            		}
		            		else{
		            			$name1=$name1.$shortestRoute[$j][$k];
		            		}
		            	}
		            	$shortestRoute1 = array();
		            	$shortestRoute1['name'] = $name1;
		            	$shortestRoute1['lat'] = $lat1;
		            	$shortestRoute1['lng'] = $lng1;
		            	$shortestRoute1['address'] = $address1;
		            	$shortestRoute1['city'] = $city1;
		            	$shortestRoute1['state'] = $state1;
		            	$shortestRoute1['country'] = $country1;
		            	array_push($route, $shortestRoute1);
		            }		  
		            array_push($tourArray, $route);
		            $x=1;
		            // if($y > $days)
		            // 	break;
			}
			// echo "<pre>";
			// print_r($tourArray);
			// echo "</pre>";
			return $tourArray;
		}		
	}