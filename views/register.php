<html>
<head>
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Your Guide"/>
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);
		function hideURLbar(){
			window.scrollTo(0,1);
		}
	</script>
	<style type="text/css">
		
	</style>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<link rel="stylesheet" href="css/form-elements.css">
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/toaster.js"></script>
</head>
<body>
	<div class="loader"></div>
	<!-- INCLUDE HEADER -->
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header.php');
	?>

	<div class="row">
		&nbsp
	</div>
	<div class="row">
		&nbsp
	</div>
	<div class="top-content" id="form-div">
		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<h3>Register with us</h3>
							</div>
							<div class="form-top-right">
								<small><i class="glyphicon glyphicon-option-horizontal"></i></small>
							</div>
						</div>
						<div class="form-bottom">
							<form role="form" onsubmit="return false;" method="post" class="login-form">
								<div class="form-group">
									<label class="sr-only" for="form-name">Name</label>
									<input type="text" name="form-name" placeholder="Name" class="form-name form-control" id="form-name" maxlength="100">
									<span hidden="true" class="text-danger" id="form-name-invalid">&nbsp&nbsp*Name cannot be empty</span>									
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-email">Email</label>
									<input type="text" name="form-email" placeholder="Email" class="form-email form-control" id="form-email" maxlength="50">
									<span hidden="true" class="text-danger" id="form-email-invalid">&nbsp&nbsp*Email is not valid</span>
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-contact">Contact</label>
									<input type="text" name="form-contact" placeholder="Contact (10 digit number)" class="form-contact form-control" id="form-contact" maxlength="10">
									<span hidden="true" class="text-danger" id="form-contact-invalid">&nbsp&nbsp*Contact is not valid</span>
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-username">Username</label>
									<input type="text" name="form-username" placeholder="Username (only alphabets and numbers)" class="form-username form-control" id="form-username" maxlength="50">
									<span hidden="true" class="text-danger" id="form-username-invalid">&nbsp&nbsp*Only alphabets and numbers are allowed</span>
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-password">Password</label>
									<input type="password" name="form-password" placeholder="Password (min 8 characters)" class="form-password form-control" id="form-password" maxlength="100">
									<span hidden="true" class="text-danger" id="form-password-invalid">&nbsp&nbsp*Minimum 8 characters needed</span>
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-cnfpassword">Confirm Password</label>
									<input type="password" name="form-cnfpassword" placeholder="Confirm Password" class="form-cnfpassword form-control" id="form-cnfpassword" maxlength="100">
									<span hidden="true" class="text-danger" id="form-cnfpassword-invalid">&nbsp&nbsp*Must be same as password</span>
								</div>
								<div hidden="true" class="text-danger text-center" id="someError">
									
								</div>
								<button type="submit" id="form-submit" class="btn">Register</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		&nbsp
	</div>
	<div class="row">
		&nbsp
	</div>
	<!-- INCLUDE FOOTER -->
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>
<!-- 	<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content" id="successContent">
				<div class="modal-header">
					Registraion successful
				</div>
				<div class="modal-body">
					<div style="font-size: 35px;">
						<big><i class="glyphicon glyphicon-ok"></i></big>
					</div>
					<div class="row">
						<br>
						<p style="color: black !important;">Your registration is successful, you are automatically redirected to login page within 3 seconds.</p>
					</div>
					<div class="row">
						<br>
						<a href="login.php" class="btn btn-warning" role="button">Login</a>
						<br><br>
					</div>
				</div>
			</div>
			<div class="modal-content" id="failureContent">
				<div class="modal-header">
					Registraion unsuccessful!
				</div>
				<div class="modal-body">
					<div style="font-size: 35px;">
						<big><i class="glyphicon glyphicon-remove"></i></big>
					</div>
					<div class="row center">
						<br>
						<div id="reasonOfFailure">Sorry, your registration is not successful due to some error.</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
 -->	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/jquery.backstretch.min.js"></script>
	<script src="js/scripts.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script src="js/responsiveslides.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>	
	<script src="js/jquery.flexslider.js"></script>	
	<!-- CHECKING FOR FORM -->
	<script src="js/jsFunctions/registerFormValidation.js"></script>
	<script type="text/javascript">
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
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script> 
	<script>
		// You can also use "$(window).load(function() {"
		// $(function () {
		//  // Slideshow 4
		//  $("#slider3").responsiveSlides({
		//  	auto: true,
		//  	pager: false,
		//  	nav: true,
		//  	speed: 500,
		//  	namespace: "callbacks",
		//  	before: function () {
		//  		$('.events').append("<li>before event fired.</li>");
		//  	},
		//  	after: function () {
		//  		$('.events').append("<li>after event fired.</li>");
		//  	}
		//  });
		// });
		// $('.counter').countUp();
		$(window).load(function(){
			$(".loader").fadeOut();
			// $('.flexslider').flexslider({
			// 	animation: "slide",
			// 	start: function(slider){
			// 		$('body').removeClass('loading');
			// 	}
			// });
		});

	</script>
</body>
</html>