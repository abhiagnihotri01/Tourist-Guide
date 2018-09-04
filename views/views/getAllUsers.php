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
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/toaster.js"></script>

	<!-- <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> -->
</head>
<body ng-app="getAllUsersApp" ng-controller="getAllUsersCtrl">
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
	?>

	<div class="content container">
		<h2><b>View/Delete Users</b></h2>
		<br>
		<div id="errorDiv"></div>
		<div id="tableDiv">
			<table class="table table-bordered table-striped" style="color: white;">
			  <thead>
			    <tr>
			      <th><h3>Id</h3></th>
			      <th><h3>Name</h3></th>
			      <th><h3>Email</h3></th>
			      <th><h3>Username</h3></th>
			      <th><h3>Contact</h3></th>
			      <th><h3>Created at</h3></th>
			      <th><h3>Updated at</h3></th>
			      <th><h3>Delete</h3></th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr ng-repeat="user in users">
			      <td>{{$index+1}}</td>
			      <td>{{user.name}}</td>
			      <td>{{user.email}}</td>
			      <td>{{user.username}}</td>
			      <td>{{user.contact}}</td>
			      <td>{{user.created_at}}</td>
			      <td>{{user.updated_at}}</td>
			      <td><button class="closebtn btn btn-info" ng-click="deleteUser(user.id)">&times;</button></td>
			    </tr>
	<!-- 		    <tr>
			    	<td>2</td>
			    	<td>Sachin</td>
			    	<td>sachin.mishra@gmail.com</td>
			    	<td>sachinmishra</td>
			    	<td>9856321485</td>
			    	<td><span class="closebtn">&times;</span></td>
			    </tr>
			    <tr>
			    	<td>3</td>
			    	<td>John</td>
			    	<td>cena.john@gmail.com</td>
			    	<td>john.cena</td>
			    	<td>8965412357</td>
			    	<td><span class="closebtn">&times;</span></td>
			    </tr>
			    <tr>
			    	<td>4</td>
			    	<td>Katy perry</td>
			    	<td>iamkperry@gmail.com</td>
			    	<td>katy.perry</td>
			    	<td>8878945632</td>
			    	<td><span class="closebtn">&times;</span></td>
			    </tr>		    
	 -->		 
				</tbody>
			</table>
		</div>
		<br><br><br>
	</div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>
	<script src="js/jsFunctions/getAllUsersFunctions.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/SmoothScroll.min.js"></script>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
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
