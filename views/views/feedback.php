<!DOCTYPE html>
<html lang="en">
<head>
	<title>Feedback</title>
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
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<script src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/toaster.js"></script>

</head>
<body ng-app="feedbackApp" ng-controller="feedbackCtrl">
	<div class="loader"></div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		if(!$user->authenticate()) {
			header('location: login.php');
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

	<div class="banner-1">
	</div>
	<!-- //banner -->
	<!-- contact -->
	<section class="contact-w3ls">
		<div class="container">
			<div class="wthree_head_section">
				<h2 class="w3l_header">Feedback </h2>
				<p>Feedback helps us keep going and coming up with new features. Your feedback lets us know where improvements can be made to make a wonderful user excperience.</p>
			</div>
			<div class="con-top">
				<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile2" data-aos="flip-left">
					<div class="contact-agileits">
						<h4>Tell us, how do you feel</h4>
						<form action="#" method="post">
							<div class="control-group form-group">
								<div class="controls">
									<label class="contact-p1">Feedback Text:</label>
									<input type="text" ng-model="feedback_text" class="form-control" name="email" id="email" Placeholder=" " required="">
									<p class="help-block"></p>
								</div>
							</div>
							<div id="success"></div>
							<button type="button" class="btn btn-primary" ng-click="saveFeedback();">Send</button>	
						</form>            
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile1" data-aos="flip-right">
					<h4 class="w3l-contact">Connect With Us</h4>
					<p class="contact-agile1"><strong>Phone :</strong>+91 - 9582457810</p>
					<p class="contact-agile1"><strong>Email :</strong> <a href="#####@example.com">himanshu.mnnit04@gmail.com</a></p>
					<p class="contact-agile1"><strong>Address :</strong> Raman Hostel, MNNIT Allahabad.</p>											

					<ul class="agileits_social_list">
						<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</section>
	<!-- map -->
	<!-- <div class="w3l-map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d10446319.224363243!2d-101.53641366492933!3d40.52127641868563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1509778660321" style="border:0" allowfullscreen></iframe>
	</div> -->

	<!-- //contact -->
	<!-- INCLUDE FOOTER -->
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>
	<script src="js/bootstrap.js"></script>
	<script src="js/jsFunctions/feedbackFunctions.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling script -->
	<script type="text/javascript">
		$(window).load(function () {
			$(".loader").fadeOut();
		});		
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