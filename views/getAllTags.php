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
</head>
<body>
	<div class="loader"></div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Admin.php');
		$db = new DB();
		$conn = $db->getConnection();
		$user = new User($conn);
		if(!$user->authenticate()) {
			// open modal, and ask to go to login
			header('location: login.php');
		}
		if(!$_SESSION['isLoggedIn']['is_admin'])
			header('location: dashboard.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header_admin.php');		
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/Constants.php');
		$image_base_url = HTTP.HOST.'/Project/rest_calls/Public/getImage.php';
		$admin = new Admin();
		// $adminDetails = $admin->getAdminDetails($user);
	?>

	<div class="content container">
		<br>
		<div class="panel panel-primary">
			<div class="panel-heading"><b>Add/Delete Tags</b></div>
			<div class="panel-body panelDiv">
				<div class="d-inline">
					<label for="tags">Add tags:</label>
					<input type="text" class="form-control" id="tags">					
				</div>
				<div class="form-group d-inline pull-right">
					<button class="btn btn-primary" id="addTags">Add</button>
				</div>
				<br><br>
				<div class="chip">
				  	<!-- <img src="img_avatar.jpg" alt="Person" width="96" height="96"> -->
					Adventure
				  	<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
				</div>
				<div class="chip">
					Leisure
				  	<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
				</div>
				<div class="chip">
					Beaches
				  	<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
				</div>
				<div class="chip">
					Pilgrimage
				  	<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
				</div>
				<div class="chip">
					Family
				  	<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
				</div>
				<div class="chip">
					Wildlife
				  	<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
				</div>
				<div class="chip">
					Hills
				  	<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
				</div>
			</div>		
		</div>
		<br>
		<div style="color: black !important;">
			<b>Note: </b> Data on this page is related to crucial functioning of website. Do not alter this until and unless you have proper understanding of working.
		</div>
		<br><br>
	</div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		$("#addTags").click(function() {
			var tag = $("#tags").val();
			if(tag != '')
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
