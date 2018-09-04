<html>
<head>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<style type="text/css">
		div {
		    opacity: 1;
		}
		div.ng-enter {
		    -webkit-transition: 1s;
		    transition: 1s;
		    opacity: 0;
		}
		div.ng-enter-active {
		    opacity: 1;
		}
	</style>
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
	<link href="css/style_sidebar.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,550,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,800,500i,550,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<script src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/toaster.js"></script>
</head>
<body ng-app="dashboardApp" ng-controller="dashboardCtrl">
	<div class="loader"></div>
	<?php

		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/utility.php');
		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		if(!$user->authenticate()) {
			header('location: login.php');
		}
		if($_SESSION['isLoggedIn']['is_admin']) {				
			header('location: admin_dashboard.php');
		}		
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header_login.php');		
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/Constants.php');
		$image_base_url = HTTP.HOST.'/Project/rest_calls/Public/getImage.php';
		$utility = new Utility();
		$subtag_arr = $utility->getSubtags($conn);
	?>
	<div class="wrapper">
		<nav id="sidebar" style="color: black;background-color: white;">
			<div class="sidebar-header">
				<h3 style="color: white !important;font-size: 25px;"><u>Filters</u></h3>
			</div>
			<ul class="list-unstyled components" id="tagsDiv" style="margin-left: 10px;">
				<dt style="font-size: 20px;cursor: pointer;"  data-toggle="collapse" data-target="#family">
					<i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp&nbspFamily
				</dt>
				<div style="margin-left: -20px;font-size: 15px;" id="family" class="collapse">
					<?php
						for($i = 0; $i < count($subtag_arr[0]); $i++) {
							echo '<dd>';
							echo '<input type="checkbox" class="checkboxInputs" value="'.$subtag_arr[0][$i]['hash'].'">&nbsp'.$subtag_arr[0][$i]['name'].'<br>';
							echo '</dd>';
						}
					?>
				</div>
				<dt style="font-size: 20px;cursor: pointer;"  data-toggle="collapse" data-target="#hills">
					<i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp&nbspHills
				</dt>
				<div style="margin-left: -20px;font-size: 15px;" id="hills" class="collapse">
					<?php
						for($i = 0; $i < count($subtag_arr[1]); $i++) {
							echo '<dd>';
							echo '<input type="checkbox" class="checkboxInputs" value="'.$subtag_arr[1][$i]['hash'].'">&nbsp'.$subtag_arr[1][$i]['name'].'<br>';
							echo '</dd>';
						}
					?>
				</div>
				<dt style="font-size: 20px;cursor: pointer;"  data-toggle="collapse" data-target="#wildlife">
					<i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp&nbspWildlife
				</dt>
				<div style="margin-left: -20px;font-size: 15px;" id="wildlife" class="collapse">
					<?php
						for($i = 0; $i < count($subtag_arr[2]); $i++) {
							echo '<dd>';
							echo '<input type="checkbox" class="checkboxInputs" value="'.$subtag_arr[2][$i]['hash'].'">&nbsp'.$subtag_arr[2][$i]['name'].'<br>';
							echo '</dd>';
						}
					?>
				</div>
				<dt style="font-size: 20px;cursor: pointer;"  data-toggle="collapse" data-target="#beaches">
					<i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp&nbspBeaches
				</dt>
				<div style="margin-left: -20px;font-size: 15px;" id="beaches" class="collapse">
					<?php
						for($i = 0; $i < count($subtag_arr[3]); $i++) {
							echo '<dd>';
							echo '<input type="checkbox" class="checkboxInputs" value="'.$subtag_arr[3][$i]['hash'].'">&nbsp'.$subtag_arr[3][$i]['name'].'<br>';
							echo '</dd>';
						}
					?>
				</div>
				<dt style="font-size: 20px;cursor: pointer;"  data-toggle="collapse" data-target="#romantic">
					<i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp&nbspRomantic
				</dt>
				<div style="margin-left: -20px;font-size: 15px;" id="romantic" class="collapse">
					<?php
						for($i = 0; $i < count($subtag_arr[4]); $i++) {
							echo '<dd>';
							echo '<input type="checkbox" class="checkboxInputs" value="'.$subtag_arr[4][$i]['hash'].'">&nbsp'.$subtag_arr[4][$i]['name'].'<br>';
							echo '</dd>';
						}
					?>
				</div>
				<dt style="font-size: 20px;cursor: pointer;"  data-toggle="collapse" data-target="#adventure">
					<i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp&nbspAdventure
				</dt>
				<div style="margin-left: -20px;font-size: 15px;" id="adventure" class="collapse">
					<?php
						for($i = 0; $i < count($subtag_arr[5]); $i++) {
							echo '<dd>';
							echo '<input type="checkbox" class="checkboxInputs" value="'.$subtag_arr[5][$i]['hash'].'">&nbsp'.$subtag_arr[5][$i]['name'].'<br>';
							echo '</dd>';
						}
					?>
				</div>
				<dt style="font-size: 20px;cursor: pointer;"  data-toggle="collapse" data-target="#leisure">
					<i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp&nbspLeisure
				</dt>
				<div style="margin-left: -20px;font-size: 15px;" id="leisure" class="collapse">
					<?php
						for($i = 0; $i < count($subtag_arr[6]); $i++) {
							echo '<dd>';
							echo '<input type="checkbox" class="checkboxInputs" value="'.$subtag_arr[6][$i]['hash'].'">&nbsp'.$subtag_arr[6][$i]['name'].'<br>';
							echo '</dd>';
						}
					?>
				</div>
				<dt style="font-size: 20px;cursor: pointer;"  data-toggle="collapse" data-target="#pilgrimage">
					<i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp&nbspPilgrimage
				</dt>
				<div style="margin-left: -20px;font-size: 15px;" id="pilgrimage" class="collapse">
					<?php
						for($i = 0; $i < count($subtag_arr[7]); $i++) {
							echo '<dd>';
							echo '<input type="checkbox" class="checkboxInputs" value="'.$subtag_arr[7][$i]['hash'].'">&nbsp'.$subtag_arr[7][$i]['name'].'<br>';
							echo '</dd>';
						}
					?>
				</div>
				<br>
				<div class="text-center">
					<label>
						Radius (<label id="radiusLabel"></label>)
						<input type="range" min="1" max="100" value="20" ng-model="radius" class="slider" id="radius">
					</label>
					<br>
					<br>
					<label class="text-center">
						<button type="button" class="btn btn-primary" style="font-size: 15px;" ng-click="applyFilters();">Apply filters</button>
					</label> 					
				</div>
				
			</ul>
		</nav>
		<!-- Page Content Holder -->
		<div id="content">
			<div class="container-fluid navbar-header">
				<button type="button" id="sidebarCollapse" class="btn toggle_filterbar navbar-btn ">
					<i class="glyphicon glyphicon-align-left"></i>
					<span>Toggle Filters</span>
				</button>
			</div>
			<br><br>
			<div class="container-fluid">
				<div class="col-md-4" ng-repeat="dest in destination_details" id="destId">
				  <div class="card">
				    <img class="card-img-top" src='<?=$image_base_url."?name={{dest.photo}}&width=800&height=550"?>' alt="Card image cap">
				    <div class="card-block cardDiv">
				      <h4 class="card-title title"><u>{{dest.name}}</u></h4>
				      <p class="card-text">
				      	<p >
				      		"<i>{{dest.description}}</i>"
				      	</p>
				      	<p >
				      		{{dest.address}}<br>
				      	</p>
				      	<p >
  					      	{{dest.distance}}( {{dest.duration}} )
					    </p>				      	
				      </p>
<!-- 				      <p ng-bind-html="dest.rating | to_trusted"></p>
				      <p>
				      	{{dest.price}}
				      </p>
 -->				  
<!-- 				      <p>
				      	<i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;font-size:28px;"></i>: {{dest.likes}}
				      </p>				      -->
				      <hr>
 				      <a href="getVenueDetails.php?venue_id={{dest.id}}&lat={{lat}}&lng={{lng}}&city={{cityName}}" target="_blank" class="btn btn-primary">Explore Venue</a>
				    </div>
				  </div>
				  <br ng-if="($index+1)%3==0"><br ng-if="($index+1)%3==0">
				</div>
			</div>
		</div>
		<div id="loaderHolder" style="margin-top: 300px;margin-left: 500px;">
			<img src="images/loading.gif">
		</div>
	</div>
	<script src="js/bootstrap.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script src="js/JiSlider.js"></script>
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/jsFunctions/dashboardFunctions.js"></script>
	<script type="text/javascript">
		$("#radiusLabel").html($("#radius").val() + " km");
		$("#radius").change(function() {
			$("#radiusLabel").html($("#radius").val() + " km");
		});
		$(window).load(function () {
			$("#searchDivCanHide").show();
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
	<!-- for scroll button to top -->
	<script type="text/javascript">	
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script> 
	<script src="js/responsiveslides.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>
	<script src="js/jquery.flexslider.js"></script>
<!-- 	<script type="text/javascript">		
		$(window).load(function(){
			$('.flexslider').flexslider({
				animation: "slide",
				start: function(slider){
					$('body').removeClass('loading');
				}
			});
		});
	</script>
 -->
</body>
</html>
