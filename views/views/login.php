<html>
<head>
	<title>Login</title>
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
	<link href="bootstrap/css/bootstrap-modal.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />	
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="css/form-elements.css">
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/toaster.js"></script>

</head>
<body>
	<div class="loader"></div>
	<!-- INCLUDE HEADER -->
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		if($user->authenticate()) {
			// open modal, and give link to dashboard
			if($_SESSION['isLoggedIn']['is_admin'])
				header('location: admin_dashboard.php');			
			header('location: dashboard.php');
		}		
	?>
	<div class="row">
		&nbsp
	</div>
	<div class="row">
		&nbsp
	</div>
	<div class="row">
		&nbsp
	</div>
	<div class="row">
		&nbsp
	</div>
	<div class="top-content">
		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<h3>Login to your travel guide</h3>
								<p>Enter your username and password to log on:</p>
							</div>
							<div class="form-top-right">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<div class="form-bottom">
							<form role="form" onsubmit="return false;" method="post" class="login-form">
								<div class="form-group">
									<!-- <label class="sr-only" for="form-username">Username</label> -->
									<input type="text" name="form-username" placeholder="Username" class="form-username form-control" id="form-username">
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-password">Password</label>
									<input type="password" name="form-password" placeholder="Password" class="form-password form-control" id="form-password">
								</div>
								<div class="form-group">
									<input type="checkbox" class="form-check-input" name="form-rememberme" id="form-rememberme">
									<label class="form-check-label" for="form-rememberme">
										Remember me
									</label>
									<div hidden="true" class="row text-danger text-center" id="someError" style="font-size: 15px;">
									</div>									
								</div>
								<button type="submit" class="btn" id="loginButton">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="snackbar"></div>
		<div class="row">
			&nbsp
		</div>
		<div class="row">
			&nbsp
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
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog">
			<div class="modal-content" id="successContent">
				<div class="modal-header">
					Logged in
					<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
				</div>
				<div class="modal-body">
					<div style="font-size: 35px;">
						<big><i class="glyphicon glyphicon-ok"></i></big>
					</div>
					<div class="row">
						<br>
						<p style="color: black !important;">Login successful, you are automatically redirected to your dashboard within 3 seconds.</p>
					</div>
					<div class="row">
						<br>
						<a href="dashboard.php" class="btn btn-warning" role="button">Dashboard</a>
						<br><br>						
					</div>
				</div>
			</div>
			<div class="modal-content" id="failureContent">
				<div class="modal-header">
					Login Unsuccessful!
				</div>
				<div class="modal-body">
					<div style="font-size: 35px;">
						<big><i class="glyphicon glyphicon-remove"></i></big>
					</div>
					<div class="row center">
						<br>
						<div id="reasonOfFailure">Sorry, your login is not successful due to some error.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script defer src="bootstrap/js/bootstrap.min.js"></script>
	<script defer src="js/jquery.backstretch.min.js"></script>
	<script defer src="js/scripts.js"></script>
	<script defer src="js/SmoothScroll.min.js"></script>
	<script defer type="text/javascript" src="js/move-top.js"></script>
	<script defer type="text/javascript" src="js/easing.js"></script>
	<script defer src="js/jsFunctions/loginFormValidation.js"></script>
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
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script> 
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

</body>

</html>