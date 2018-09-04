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
	<script src="js/angular.min.js"></script>
	<!-- <link href="css/xeditable.css" rel="stylesheet"> -->
</head>
<body ng-app="adminDashboardApp" ng-controller="adminDashboardCtrl">
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
		$adminDetails = $admin->getAdminDetails($user, $conn);
		if(!$adminDetails['status'])
			header('location: logout.php');
	?>

	<div class="content container">
		<div>
			<img src="<?=$image_base_url.'?name={{user.image_name}}&width=300&height=200'?>" class="img-circle" id="admin_image">	
		</div>
		<br><br>
		<div class="panel panel-primary">
			<div class="panel-heading"><b>Personal Information</b></div>
			<div class="panel-body panelDiv" id="editdiv" ng-show="isEdit">
				<div>
					<h3><b>Name: </b><input type="text" ng-model="user.name" /></h3>
				</div>
				<div>
					<h3><b>Username: </b><input type="text" ng-model="user.username"></h3>
				</div>
				<div>
					<h3><b>Email: </b><input type="text" ng-model="user.email"></h3>
				</div>
				<div>
					<h3><b>Contact: </b><input type="text" ng-model="user.contact"></h3>
				</div>				
			</div>
			<div class="panel-body panelDiv" id="displayDiv" ng-hide="isEdit">
				<div>
					<h3><b>Name: </b><span ng-model="user.name">{{user.name}}</span></h3>
				</div>
				<div>
					<h3><b>Username: </b><span ng-model="user.username">{{user.username}}</span></h3>
				</div>
				<div>
					<h3><b>Email: </b><span ng-model="user.email">{{user.email}}</span></h3>
				</div>
				<div>
					<h3><b>Contact: </b><span ng-model="user.contact">{{user.contact}}</span></h3>
				</div>				
			</div>
			<div class="panel-footer clearfix" ng-hide="isEdit">
				<span id="errorSpan"></span>
				<span id="successSpan"></span>
			    <div class="pull-right">
			        <a href="#" class="btn btn-primary" id="editPersonalInformation" ng-click="editDetails()">Edit</a>
			    </div>
			</div>
			<div class="panel-footer clearfix" ng-show="isEdit">
			    <div class="pull-right">
			        <a href="#" class="btn btn-primary" id="saveDetails" ng-click="saveDetails()">Save</a>
			    </div>
			</div>			
		</div>
	</div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>	
	<!-- <script src="js/xeditable.js"></script> -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script src="js/JiSlider.js"></script>
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<script src="js/jsFunctions/adminDashboardFunctions.js"></script>
	<script type="text/javascript">
		$(window).load(function () {
			$(".loader").fadeOut();
			$("#wrapper").toggleClass("toggled");
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
</body>
</html>
