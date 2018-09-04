<div class="top-bar active navbar-fixed-top">
	<div class="container">
		<div class="header">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<!-- <h1><a>YOUR GUIDE</a></h1> -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand"><img src="images/logo-2.png" height="50"></a>
				</div>
				<?php
					$url = $_SERVER['REQUEST_URI'];
					$arr = explode("/", $url);
					$user_details = $user->getLoggedInDetails();
					if(!$user_details['status'])
						header('location: login.php');
					$username = $user_details['username'];
				?>
				<!-- Collect the nav links, forms, and other content for toggling -->

				
 				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="cl-effect-15" id="cl-effect-15">
						<ul class="nav navbar-nav">
							<?php
								if (strpos($arr[count($arr)-1], 'index') !== false)
									echo '<li class="active"><a href="index.php">Home</a></li>';
								else
									echo '<li><a href="index.php">Home</a></li>';
								//------------------------------------------------------------------------
								if (strpos($arr[count($arr)-1], 'about') !== false)
									echo '<li class="active"><a href="about.php">About</a></li>';
								else
									echo '<li><a href="about.php">About</a></li>';
								//------------------------------------------------------------------------
								if (strpos($arr[count($arr)-1], 'feedback') !== false)
									echo '<li class="active"><a href="feedback.php">Feedback</a></li>';
								else
									echo '<li><a href="feedback.php">Feedback</a></li>';
								//------------------------------------------------------------------------
								if (strpos($arr[count($arr)-1], 'gallery') !== false)
									echo '<li class="active"><a href="gallery.php">Gallery</a></li>';
								else
									echo '<li><a href="gallery.php">Gallery</a></li>';
								?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">Permissions<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li>
											<a href="getUserDetails.php">Edit Details</a>
										</li>
										<li>
											<a href="addUserPhobia.php">Add Phobia</a>
										</li>
										<li>
											<a href="suggestTour.php">Get Planned Tour</a>
										</li>										
									</ul>
								</li>								
								<?php
								//------------------------------------------------------------------------
								if (strpos($arr[count($arr)-1], 'dashboard') !== false)
									echo '<li class="active"><a href="dashboard.php">Dashboard</a></li>';
								else
									echo '<li><a href="dashboard.php">Dashboard</a></li>';
								// //------------------------------------------------------------------------
								// if (strpos($arr[count($arr)-1], 'UserDetails') !== false)
								// 	echo '<li class="active"><a href="getUserDetails.php">Edit Details</a></li>';
								// else
								// 	echo '<li><a href="getUserDetails.php">Edit Details</a></li>';								
								// //------------------------------------------------------------------------
								// if (strpos($arr[count($arr)-1], 'addUserPhobia') !== false)
								// 	echo '<li class="active"><a href="addUserPhobia.php">Add Phobia</a></li>';
								// else
								// 	echo '<li><a href="addUserPhobia.php">Add Phobia</a></li>';
								//------------------------------------------------------------------------
								if (strpos($arr[count($arr)-1], 'logout.php') !== false)
									echo '<li class="active"><a href="logout.php">Logout( ' . ucwords($username) . ' )</a></li>';
								else
									echo '<li><a href="logout.php">Logout( ' . ucwords($username) . ' )</a></li>';
							?>
						</ul>									
					</nav>
				</div>
			</nav>
				<div class="row" id="searchDivCanHide" hidden="true">
					<br>
					<div class="col-md-8">
						<input type="text" id="searchBar" ng-model="cityName" name="search" placeholder="City (eg. delhi)">
						<input type="text" id="searchBar" ng-model="placeName" list="places" ng-change="getNames()" name="search" placeholder="Place (eg. qutab minar)">
							<datalist id="places">
								<option ng-repeat="name in names_details" value="{{name}}"></option>
							</datalist>
						<button id="searchVenueButton" class="btn btn-default" type="submit" ng-click="applyCity();">
					        <i class="glyphicon glyphicon-search"></i>
				        </button>
			        </div>
			        <div class="col-md-4" style="color: white;" ng-model="visitSummary" id="visitSummaryId">
			        </div>
				</div>
		</div>
	</div>
</div>