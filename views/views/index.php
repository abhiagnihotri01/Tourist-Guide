<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Your Guide</title>
	<!-- custom-theme -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Travel Agency Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
</head>
<body ng-app="indexApp" ng-controller="indexCtrl">
	<!-- <div class="loader"> -->
	<!-- </div>	 -->
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		if($user->authenticate()) {
			if(!$_SESSION['isLoggedIn']['is_admin'])
				include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header_login.php');
			else
				include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header_admin.php');
		}
		else
			include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/Constants.php');
		$image_base_url = HTTP.HOST.'/Project/rest_calls/Public/getImage.php';
	?>
	<div class="banner-silder">
		<div id="JiSlider" class="jislider">
			<ul>
				<li>
					<div class="w3layouts-banner-top">

							<div class="container">
								<div class="agileits-banner-info">								
									<h3> HILLS </h3>
									<p>
										<p style="background-color: rgba(0, 0, 0, 0.4);">The fresh air whistles a tune, the mountains echo gentle music and the trees resonate a soft susurrus... Yes, the hills are calling! How about a few days away from the chaos of modern life and into the very lap of nature? Trek out to the most beautiful hilly destinations in India!</p>
									</p>
								</div>	
							</div>
						</div>
				</li>
				<li>
						<div class="w3layouts-banner-top w3layouts-banner-top1">
						<div class="container" >
								<div class="agileits-banner-info">								
									<h3>WILDLIFE</h3>
									<p style="background-color: rgba(0, 0, 0, 0.3);">
										What's better than getting a glimpse of the majestic tiger roaring or the gentle elephants trumpeting? Ride through dense Indian jungles in sporty Jeeps that will take your adrenaline a notch north! Make your adventurous holiday a little comfortable at one of the cosy hotels in India.
									</p>
								</div>	
							</div>
						</div>
				</li>
				<li>
						<div class="w3layouts-banner-top w3layouts-banner-top2">
							<div class="container">
								<div class="agileits-banner-info">
								    
									<h3>BEACHES</h3>
									 <p style="background-color: rgba(0, 0, 0, 0.3);">There is no place in the world that gives you the kind of peace and tranquil along with such stunning views that a beach does - white sand stretched out for miles, while your freshly formed footprints are washed up by the gentle waves of the sea. </p>
									
								</div>
								
							</div>
						</div>
					</li>
					<li>
						<div class="w3layouts-banner-top w3layouts-banner-top3">
							<div class="container">
								<div class="agileits-banner-info">
								 
									<h3>HERITAGE</h3>
									 <p style="background-color: rgba(0, 0, 0, 0.3);">Break the monotony and indulge in some erstwhile glory of Indian royalty with some of the most glorious heritage properties the country has to offer. Service with a personal touch, and hospitality that comes straight from the heart, these Indian heritage hotels will make you feel right at home. </p>
									
								</div>
								
							</div>
						</div>
					</li>
			</ul>
		</div>
      </div>
</div>
	<div class="two-grids">
		<div class="container">
			<div class="wthree_head_section">
				<h3 class="w3l_header">Welcome to <span>Your Guide</span></h3>
				<p>your guide is a private retailer or public service that provides travel and tourism related services to the public on behalf of suppliers such as activities</p>
			</div>
			<div class="col-md-6 w3_two_grid_right">
				<div class="w3_two_grid_right1">
					<div class="col-xs-3 w3_two_grid_right_grid">
						<div class="w3_two_grid_right_grid1">
							<i class="fa fa-users" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-xs-9 w3_two_grid_right_gridr">
						<h4>Family</h4>
						<p>Everyone loves a family vacation! Go zipping through good times with your family in a myriad lovely destinations in India.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="w3_two_grid_right1">
					<div class="col-xs-3 w3_two_grid_right_grid">
						<div class="w3_two_grid_right_grid1">
							<i class="fa fa-tree" aria-hidden="true"></i>

						</div>
					</div>
					<div class="col-xs-9 w3_two_grid_right_gridr">
						<h4>Wildlife</h4>
						<p>What's better than getting a glimpse of the majestic tiger roaring or the gentle elephants trumpeting.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="w3_two_grid_right1">
					<div class="col-xs-3 w3_two_grid_right_grid">
						<div class="w3_two_grid_right_grid1">
							<i class="fa fa-heart" aria-hidden="true"></i>

						</div>
					</div>
					<div class="col-xs-9 w3_two_grid_right_gridr">
						<h4>Romantic</h4>
						<p>Romance comes with the territory if you plan a trip with your partner to one of the top romantic destinations in India.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="w3_two_grid_right1" style="padding: 2em 0em 2em !important;">
					<div class="col-xs-3 w3_two_grid_right_grid">
						<div class="w3_two_grid_right_grid1">
							<i class="fa fa-area-chart" aria-hidden="true"></i>

						</div>
					</div>
					<div class="col-xs-9 w3_two_grid_right_gridr">
						<h4>Hills</h4>
						<p>The fresh air whistles a tune, the mountains echo gentle music and the trees resonate a soft susurrus... Yes, the hills are calling.</p>
					</div>
					<div class="clearfix"> </div>
				</div>				
			</div>
			<div class="col-md-6 w3_two_grid_right">
				<div class="w3_two_grid_right1">
					<div class="col-xs-3 w3_two_grid_right_grid">
						<div class="w3_two_grid_right_grid1">
							<i class="fa fa-pagelines" aria-hidden="true"></i>


						</div>
					</div>
					<div class="col-xs-9 w3_two_grid_right_gridr">
						<h4>Leisure</h4>
						<p>Leisure holidays are incomplete without the occasional luxurious stay, grand feast and shopping spree.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="w3_two_grid_right1">
					<div class="col-xs-3 w3_two_grid_right_grid">
						<div class="w3_two_grid_right_grid1">
							<i class="fa fa-university" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-xs-9 w3_two_grid_right_gridr">
						<h4>Heritage</h4>
						<p>Break the monotony and indulge in some erstwhile glory of Indian royalty with some of the most glorious heritage properties the country has to offer..</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="w3_two_grid_right1">
					<div class="col-xs-3 w3_two_grid_right_grid">
						<div class="w3_two_grid_right_grid1">
							<i class="fa fa-bed" aria-hidden="true"></i>


						</div>
					</div>
					<div class="col-xs-9 w3_two_grid_right_gridr">
						<h4>Beaches</h4>
						<p>There is no place in the world that gives you the kind of peace and tranquil along with such stunning views that a beach does.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="w3_two_grid_right1" style="padding: 2em 0em 2em !important;">
					<div class="col-xs-3 w3_two_grid_right_grid">
						<div class="w3_two_grid_right_grid1">
							<i class="fa fa-university" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-xs-9 w3_two_grid_right_gridr">
						<h4>Pilgrimage</h4>
						<p>Soak up some spiritual vibes in some of the most religious destinations in India.</p>
					</div>
					<div class="clearfix"> </div>
				</div>				
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //advantages -->

	<!-- banner-bottom -->
	<div class="banner-bottom mid-section-agileits">
		<div class="col-md-7 bannerbottomleft">
			
		</div>
		<div class="col-md-5 bannerbottomright">
			<h3>What's our vision </h3>
			<p>People are the fundamental core of our activity.We are here to provide best guidance to a tourist visiting India</p>
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- //banner-bottom -->
	<div class="w3ls-section wthree-pricing" id="pricing">	
		<div class="container">
			<div class="wthree_head_section">
				<h3 class="w3l_header">Destinations <span>to visit</span></h3>
				<p>India has a lot of beautiful destinations to attract tourists</p>
			</div>
			<div>
				<div ng-repeat="place in places">
					<div class="pricing-grid grid-{{place.gridNumber}}">
						<div class="w3ls-top">
							<img src='<?=$image_base_url."?name={{place.image_name}}&width=300&height=200"?>' class="img-responsive">
						</div>
						<div class="w3ls-bottom">
							<ul class="count">
								<h3>{{place.name}}</h3>
							</ul>
						</div>
					</div>
				</div>
 				<div class="clearfix"></div> 
			</div>
		</div>	
	</div>	
	<div class="services-bottom stats services" >
		<div class="banner-dott1">
			<div class="container">
				<div class="wthree-agile-counter">
					<div class="col-md-6 w3_agile_stats_grid-top">
						<div class="w3_agile_stats_grid">
							<div class="agile_count_grid_left">
								<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
							</div>
							<div class="agile_count_grid_right">
								<p class="counter">{{numFeedbacks}}</p> 
							</div>
							<div class="clearfix"> </div>
							<h4>Feedbacks</h4>
						</div>
					</div>
					<div class="col-md-6 w3_agile_stats_grid-top">
						<div class="w3_agile_stats_grid">
							<div class="agile_count_grid_left">
								<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
							</div>
							<div class="agile_count_grid_right">
								<p class="counter">{{numUsers}}</p> 
							</div>
							<div class="clearfix"> </div>
							<h4>Members</h4>
						</div>
					</div>
<!-- 					<div class="col-md-3 w3_agile_stats_grid-top">
						<div class="w3_agile_stats_grid">
							<div class="agile_count_grid_left">
								<span class="fa fa-trophy" aria-hidden="true"></span>
							</div>
							<div class="agile_count_grid_right">
								<p class="counter">234</p> 
							</div>
						</div>
					</div> -->
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
	<!-- //counter -->


	<!-- Clients -->
	<div class="clients" id="clientsDiv">
		<div class="container">
			<div class="wthree_head_section">
				<h3 class="w3l_header">What People  <span>Say</span></h3>
				<p>Your guide is an organization that helps people organize their tours or trips efficiently and suggest them some awesome places to visit.</p>
			</div>
			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src='{{feedback1.image_name}}' />
							<p>{{feedback1.feedback_text}}</p>
							<div class="client">
								<h5>{{feedback1.name}}</h5>
							</div>
						</li>
						<li>
							<img src="{{feedback2.image_name}}" />
							<p>{{feedback2.feedback_text}}</p>
							<div class="client">
								<h5>{{feedback2.name}}</h5>
							</div>
						</li>
						<li>
							<img src="{{feedback3.image_name}}" />
							<p>{{feedback3.feedback_text}}</p>
							<div class="client">
								<h5>{{feedback3.name}}</h5>
							</div>
						</li>
						<li>
							<img src="{{feedback4.image_name}}" />
							<p>{{feedback4.feedback_text}}</p>
							<div class="client">
								<h5>{{feedback4.name}}</h5>
							</div>
						</li>						
					</ul>
				</div>
			</section>
		</div>
	</div>
	<!-- INCLUDE FOOTER -->
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script src="js/JiSlider.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/jsFunctions/indexFunctions.js"></script>
	<!-- here stars scrolling script -->
	<script type="text/javascript">
		$(window).load(function () {
			$(".loader").fadeOut();
			// getAllFeedbacks();
			$('#JiSlider').JiSlider({color: '#fff', start: 3, reverse: true}).addClass('ff')
		});
		$(document).ready(function() {
			$().UItoTop({ easingType: 'easeOutQuart' });
			$(window).on("scroll", function() {
			    if($(window).scrollTop() > 50) {
			        $(".top-bar").addClass("active");
			    } else {
			        //remove the background property so it comes transparent again (defined in your css)
			       $(".top-bar").removeClass("active");
			    }
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
		<!-- //scrolling script -->
		<!-- responsiveslides -->
		<script src="js/responsiveslides.min.js"></script>
		<script>
			// You can also use "$(window).load(function() {"
			$(function () {
			 // Slideshow 4
			 $("#slider3").responsiveSlides({
			 	auto: true,
			 	pager: false,
			 	nav: true,
			 	speed: 500,
			 	namespace: "callbacks",
			 	before: function () {
			 		$('.events').append("<li>before event fired.</li>");
			 	},
			 	after: function () {
			 		$('.events').append("<li>after event fired.</li>");
			 	}
			 });
			});
		</script>
		<!-- //responsiveslides -->
		<!-- stats -->
		<script src="js/jquery.waypoints.min.js"></script>
		<script src="js/jquery.countup.js"></script>
		<script>
			$('.counter').countUp();
		</script>
		<!-- //stats -->
		<!-- FlexSlider-JavaScript -->
		<script defer src="js/jquery.flexslider.js"></script>
		<script type="text/javascript">		
			$(window).load(function(){
				$('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
						$('body').removeClass('loading');
					}
				});
			});
		</script>
<!-- //FlexSlider-JavaScript -->
</body>
</html>