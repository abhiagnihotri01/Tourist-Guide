<html>
<head>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Travel Agency Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	<script type="application/x-javascript"> 
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);
		function hideURLbar(){
			window.scrollTo(0,1);
		}
	</script>
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/JiSlider.css" rel="stylesheet"> 
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,550,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,800,500i,550,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>	
	<script src="js/angular.min.js"></script>
	<script src="js/toaster.js"></script>
</head>
<body ng-app="venueApp" ng-controller="venueCtrl">
	<!-- <div class="loader"></div> -->
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Admin.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		$utility = new Utility();
		if(!$user->authenticate()) {
			// open modal, and ask to go to login
			header('location: login.php');
		}
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header_login.php');		
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/Constants.php');
		$image_base_url = HTTP.HOST.'/Project/rest_calls/Public/getImage.php';
		// 4b53fce2f964a52014b027e3
		if(!isset($_GET['venue_id']) || !isset($_GET['lat']) || !isset($_GET['lng'])) {
			echo '<script>window.alert("Invalid request, pass a venue id")</script>';
			exit();
		}
		error_reporting(0);
		$arr = $utility->getVenueInformationUsingId($_GET['venue_id']);
		
	?>
	
	<div class="content" style="margin-top: 120px; padding: 50px;">
		<h1 style="color: black; font-size: 50px;"><b><u><?=$arr['name']?></u></b></h1>
		<br>
		<br>
		<span hidden="true" id="latDiv"><?=$arr['lat']?></span>
		<span hidden="true" id="lngDiv"><?=$arr['lng']?></span>
		<span id="categoryDiv"><?=$arr['category']?></span>
		<div class="row">
			<div class="col-md-4">
 				<div id="myCarousel" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				  	<?php
				  		$i = 0;
				  		while(isset($arr['photo'.$i])) {
				  			echo '<li data-target="#myCarousel" data-slide-to="' . $i . '"></li>';
				  			$i++;
				  		}
				  		if($i == 0) {
				  			echo '<li data-target="#myCarousel" data-slide-to="0"></li>';
				  		}
				  	?>
				  </ol>

				  <div class="carousel-inner">
				  	<?php
					  	$i = 0;
					  	while(isset($arr['photo'.$i])) {
					  		if($i == 0)
						  		echo '<div class="item active"><img src="'.$arr['photo'.$i].'"></div>';
						  	else 
						  		echo '<div class="item"><img src="'.$arr['photo'.$i].'"></div>';
					  		$i++;
					  	}
					  	if($i == 0) {
					  		echo '<div class="item active"><img src="images/tag_image/no_image.jpeg"></div>';
					  	}
				  	?>
				  </div>

				  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
			<div class="col-md-1">
				
			</div>
			<div class="col-md-7" class="text-left" style="margin-left: 0px;">
				<div style="font-size: 20px;">
					<table style="color:black;" class="table table-sm">
						<tbody>
				<?php
					if(isset($arr['description'])) {
						echo $utility->getFormattedTd("Description", "\"<i>".$arr['description']."</i>\"");
					}
					// ---------- address ---------------
					if(isset($arr['address'])) {
						echo $utility->getFormattedTd("Address", $arr['address']);
					}
					if(isset($arr['city'])) {
						echo $utility->getFormattedTd("City", $arr['city']);
					}
					if(isset($arr['state'])) {
						echo $utility->getFormattedTd("State", $arr['state']);
					}
					if(isset($arr['country'])) {
						echo $utility->getFormattedTd("Country", $arr['country']);
					}
					if($_GET['city'] != "") {
						$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$_GET['city']."&key=AIzaSyCSubKz2ZWNFdsWQXk8c5QBMCl4FeenxLQ";
						$output = $utility->callGetApi($url);
						$nLat = $output['results'][0]['geometry']['location']['lat'];
						$nLng = $output['results'][0]['geometry']['location']['lng'];
					}
					else {
						$nLat = $_GET['lat'];
						$nLng = $_GET['lng'];
					}
					$dis_arr = $utility->getDistanceAndTime(array($nLat, $nLng), array(array($arr['lat'], $arr['lng'])), "driving");
					$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$nLat.",".$nLng."&sensor=true&key=AIzaSyCSubKz2ZWNFdsWQXk8c5QBMCl4FeenxLQ";
					$output = $utility->callGetApi($url);
					$distName = $output['results'][0]['formatted_address'];
					echo $utility->getFormattedTd("Distance", $dis_arr[0]['distance']);
					echo $utility->getFormattedTd("Duration", $dis_arr[0]['duration']);
					echo $utility->getFormattedTd("", "from: <u>".$distName."</u>");
					// // ---------- rating ---------------
					$rating = $arr['rating']/2;
					if($rating == 0)
						$rating = 1.5;
					$str = "";
					while($rating > 0) {
						if($rating >= 1) {
							$str .= '<i class="fa fa-star" aria-hidden="true" style="color: gold;font-size:25px;"></i>&nbsp';
							$rating -= 1;
						}
						else {
							$str .= '<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;font-size:25px;"></i>&nbsp';
							$rating = 0;
						}
					}
					echo $utility->getFormattedTd("Ratings", $str);
					// echo 'Price: '.$arr['price'].'<br><br>';
					echo $utility->getFormattedTd("Price slab", $arr['price']);
					echo $utility->getFormattedTd("Likes", '<i class="fa fa-thumbs-up" aria-hidden="true" style="color: green;font-size:28px;"></i>&nbsp'.$arr['likes']);
					echo $utility->getFormattedTd("Dislikes", '<i class="fa fa-thumbs-down" aria-hidden="true" style="color: red;font-size:28px;"></i>&nbsp'.$arr['dislikes']);
					if(isset($arr['status'])) {
						echo $utility->getFormattedTd("Opening status", $arr['status']);
					}
					if(isset($arr['url'])) {
						echo $utility->getFormattedTd("Website", $arr['url']);
					}
					?>
					<tr>
						<td>
							<b>User Reviews</b>
						</td>
						<td>							
							<?php
								if(isset($arr['userReview4']))
									echo '<div style="overflow: scroll; height: 800px;">';
								else if(isset($arr['userReview3']))
									echo '<div style="overflow: scroll; height: 600px;">';
								else if(isset($arr['userReview2']))
									echo '<div style="overflow: scroll; height: 400px;">';
								else if(isset($arr['userReview1']))
									echo '<div style="overflow: scroll; height: 200px;">';
								else
									echo '<div>';
							$i = 0;
							while(isset($arr['userReview'.$i])) {
								// echo '<div>';
								echo '<div class="col-md-1">';
								if(isset($arr['userPhoto'.$i]))
									echo '<img src="'.$arr['userPhoto'.$i].'" class="img-circle">';
								else
									echo '<img src="images/tag_image/no_image.jpeg" class="img-circle">';
								echo '</div>';
								echo '<div class="col-md-11 text-left">';
								echo '<i>"'.$arr['userReview'.$i].'"</i>';
								echo '</div>';
								// echo '</div>';
								echo '<br><br><br>';
								echo '<hr>';
								$i++;
							}
							if($i == 0) {	// means no user reviews found
								echo '<div class="col-md-12">';
								echo 'No reviews for this place';
								echo '</div>';
								echo '<br><br><br>';
								echo '<hr>';
							}
							?>
						</td>
					</tr>
						</tbody>
					</table>
					</div>		
				</div>
			</div>
		</div>
		<br><br>
		<div class="row" style="color: black;">
		  <h1 style="color: black;"><b><u>Nearby related places</u></b></h1>(Below distances are from <b><u><?=$arr['name']?></u></b>)
		  <br><br>
		  <div class="col-md-12" style="overflow: scroll; height: 500px;border-style: solid;background-color: ">
		  	<div id="hideWhenLoad" hidden="true" style="">
		  		<img src="images/loading.gif" style="width: 700px;height: 400px;">
		  	</div>
	        <div ng-repeat="dest in destination_details">
	        	<div class="col-xs-3">
	        	  <div class="card">
	        	    <img class="card-img-top" src='<?=$image_base_url."?name={{dest.photo}}&width=800&height=550"?>' alt="Card image cap">
	        	    <div class="card-block cardDiv">
	        	      <h4 class="card-title title"><u>{{dest.name}}</u></h4>
	        	      <p class="card-text">{{dest.description}}</p>
	        	      <!-- <br><p ng-bind-html="dest.rating | to_trusted"></p> -->
	        	      <!-- <p>{{dest.price}}</p> -->
	        	      <p ng-if="dest.distance != undefined">
	        	      	{{dest.distance}}( {{dest.duration}} )
	        	      </p>
	        	      <!-- <p><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;font-size:28px;"></i>: {{dest.likes}}</p>				       -->
	        	      <a href="getVenueDetails.php?venue_id={{dest.id}}&lat={{lat}}&lng={{lng}}" target="_blank" class="btn btn-primary">Explore Venue</a>
	        	    </div>
	        	  </div>
	     	   	  <br ng-if="($index+1)%4==0"><br ng-if="($index+1)%4==0">
	     	   	  <br ng-if="($index+1)%4==0">
	    	    </div>
		    </div>
		  </div>
		</div>
	</div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>
	<script src="js/jsFunctions/getVenueDetailsFunctions.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		// Instantiate the Bootstrap carousel
		$('.multi-item-carousel').carousel({
		  interval: false
		});

		// for every slide in carousel, copy the next slide's item in the slide.
		// Do the same for the next, next item.
		$('.multi-item-carousel .item').each(function(){
		  var next = $(this).next();
		  if (!next.length) {
		    next = $(this).siblings(':first');
		  }
		  next.children(':first-child').clone().appendTo($(this));
		  
		  if (next.next().length>0) {
		    next.next().children(':first-child').clone().appendTo($(this));
		  } else {
		  	$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
		  }
		});		
		$("#addTags").click(function() {
			var tag = $("#tags").val();
			$(".panelDiv").append(
				'<div class="chip">' + tag + '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span></div>'
			);
			$("#tags").val("");
		});
		$(window).load(function () {
			$(".loader").fadeOut();
			$("#wrapper").toggleClass("toggled");
			// $('#JiSlider').JiSlider({color: '#fff', start: 3, reverse: true}).addClass('ff')
		});		
		$(document).ready(function() {
			$().UItoTop({ easingType: 'easeOutQuart' });
			$('#sidebarCollapse').on('click', function () {
				$('#sidebar').toggleClass('active');
			});
		});
	</script>
	<script type="text/javascript">	
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script> 
</body>
</html>
