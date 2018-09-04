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
</head>
<body ng-app="getAllUserPhobiaApp" ng-controller="getAllUserPhobiaCtrl">
	<div class="loader"></div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/DB.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/User.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Admin.php');
		$db = new DB();
		$utility = new Utility();
		$conn = $db->getConnection();
		$user = new User($conn);
		if(!$user->authenticate()) {
			header('location: login.php');
		}
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/header_login.php');		
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/Constants.php');
		$image_base_url = HTTP.HOST.'/Project/rest_calls/Public/getImage.php';
	?>
	<div class="content container form-group">
		<h2 style="color:black;"><b>Add Phobia</b></h2>
		<br>
		<div class="row">
			<div class="col-xs-10">
				<select class="form-control input-lg" ng-model="selectPhobia">
					<option ng-disabled="true">------- SELECT PHOBIA -------</option>
					<option ng-repeat="phobia in phobia_details" value="{{phobia.id}}">{{phobia.phobia}}</option>
				</select>
			</div>
			<div class="col-xs-2">
				<button type="button" class="btn btn-primary input-lg" style="font-size: 20px;" ng-click="addPhobia();">Add phobia</button>				
			</div>
		</div>
		<br><br>
		<hr size="5">
		<hr size="5">
		<h2 style="color:black;"><b>View/Delete Phobia</b></h2>
		<table class="table table-bordered table-striped">
		  <thead style="background-color: black; color: black !important;">
		    <tr>
		      <th class="col-md-2"><h3>S.No.</h3></th>
		      <th class="col-md-8"><h3>Phobia</h3></th>
		      <th class="col-md-2"><h3>Delete</h3></th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr ng-repeat="p in phobia_selected_details">
		      <td>{{$index+1}}</td>
		      <td>{{p.phobia_name}}</td>
		      <td><button class="closebtn btn btn-info btn-primary" style="width:65px;" ng-click="deletePhobia(p.id);">&times;</button></td>
		    </tr>
		  </tbody>
		</table>
		<br><br><br>
	</div>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/Project/views/footer.php');
	?>
	<script src="js/jsFunctions/getAllUserPhobiaFunctions.js"></script>
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
