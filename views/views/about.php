
<!DOCTYPE html>
<html lang="en">
<head>
	<title>About</title>
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
		function ifLogin() {
			var retVal = confirm("Only member can submit a feedback, please login to continue");
			return true;
		}
	</script>	
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
</head>
<body>
	<div class="loader"></div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		if(!$user->authenticate()) {
			include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header.php');
		}
		else if($_SESSION['isLoggedIn']['is_admin']) {				
			include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header_admin.php');
		}	
		else {
			include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header_login.php');
		}	
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/Constants.php');
		$image_base_url = HTTP.HOST.'/Project/rest_calls/Public/getImage.php';
	?>
	<!-- INCLUDE HEADER -->
	<div class="banner-1">
	</div>
	<!-- //banner -->
	<!-- about -->
	<!-- main-textgrids -->
	<div class="main-textgrids">
		<div class="container">
			<div class="wthree_head_section">
				<h3 class="w3l_header">About <span>Us</span></h3>
				<p> We all love going out on outings and trips, the irksome part is the planning process.<br>
 					Here, we have created a step-by-step guide for you to plan your trip that will make the process easier and less overwhelming.</p>
			</div>
			<div class="ab-agile">
				<div class="col-md-5 ab-pic">
					<img src="images/g1.jpg" alt=" " />
				</div>
				<div class="col-md-7 ab-text">
					<p>We are an online travel guide in India providing a 'best in class' customer experience with the goal to be 'India's best Travel Planner'.Through our website leisure and business travelers can explore, research and plan in a better way their trip.A strong and "trusted" travel guide of India, our strengths include a large and loyal customer base. In order to suggest the better trip plan ,we always care about the customer interest and their preferences. Day by day we are improving ourselves with the help of customer's feedback.</p>
				</div>
			</div>
		</div>
		<br><br>
	<!-- //main-textgrids -->
	<!-- different -->
	<div class="different">
		<div class="container" p style="background-color: rgba(0, 0, 0, 0.8);">
			<div class="wthree_head_section">

				<h3 class="w3l_header hrm">Why We are <span class="hrm">Different</span></h3>
				<p class="hrm">A travel agency is a private retailer or public service that provides travel and tourism related services to the public on behalf of suppliers such as activities.</p>
			</div>
			<div class="w3agile-different-info">
				<p>As we are working as a not-for-profit organization, so we are not biased to any particular thing. We always tries to provide a better travel plan to ou customer on the basis of their interests, phobia etc. We do not charge our customers for providing them services. Customers can give feedback which help us to improve our services. </p>
			</div>
		</div>
	</div>
	<!-- //different -->
	<!-- team -->
	<div class="team">
		<div class="container">
			<div class="wthree_head_section">
				<h2 class="w3l_header">The <span>Team</span></h2>
				<p>A travel agency is a private retailer or public service that provides travel and tourism related services to the public on behalf of suppliers such as activities.</p>
			</div>
			<div class="agileinfo-team-grids">
				<div class="col-md-4 wthree-team-grid">
					<img src="images/user_profile_images/sachin_mishra.jpg" style="height: 350px;" alt="">
					<div class="wthree-team-grid-info">
						<h4>Sachin Mishra</h4>
						<p>Allahabad</p>
						<div class="team-social-grids">
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 wthree-team-grid">
					<img src="images/user_profile_images/himanshu.jpg" alt="">
					<div class="wthree-team-grid-info">
						<h4>Himanshu Rohilla</h4>
						<p>Allahabad</p>
						<div class="team-social-grids">
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4 wthree-team-grid">
					<img src="images/user_profile_images/abhinav.jpg" alt="">
					<div class="wthree-team-grid-info">
						<h4>Abhinav Agnihotri</h4>
						<p>Allahabad</p>
						<div class="team-social-grids">
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
<!-- 				<div class="col-md-3 wthree-team-grid">
					<img src="images/default_user.png" alt="">
					<div class="wthree-team-grid-info">
						<h4>Keshav Gupta</h4>
						<p>Allahabad</p>
						<div class="team-social-grids">
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
					</div>
				</div> -->
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //team -->
	<!-- //about -->
	<!-- INCLUDE FOOTER -->
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
	<!-- //js -->
	<!-- //here starts scrolling icon -->
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling script -->
	<script type="text/javascript">
		$(window).load(function () {
			$(".loader").fadeOut();
		})		
		$(document).ready(function() {
			$(window).on("scroll", function() {
			    if($(window).scrollTop() > 50) {
			        $(".top-bar").addClass("active");
			    } else {
			        //remove the background property so it comes transparent again (defined in your css)
			       $(".top-bar").removeClass("active");
			    }
			});	
			$().UItoTop({ easingType: 'easeOutQuart' });				
		});
	</script>
	<!-- //here ends scrolling script -->
	<!-- //here ends scrolling icon -->

	<!-- scrolling script -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script> 
	<!-- //scrolling script -->
</body>
</html>