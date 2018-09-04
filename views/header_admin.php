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
					if($user_details['is_admin'])
						$username .= '(<u>Admin</u>)';
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
								if (strpos($arr[count($arr)-1], 'feedback') !== false)
									echo '<li class="active dropdown"><a href="#" class="dropdown-toggle" data-hover="Feedbacks" data-toggle="dropdown" role="button" aria-haspopup="true">Feedbacks<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="getAllFeedbacks.php">View/Delete Feedbacks</a></li></ul></li>';
								else
								?>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">Permissions<span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li>
												<a href="getAllFeedbacks.php">View/Delete feedbacks</a>
											</li>
											<li>
												<a href="getAllPhobia.php">Add/Delete phobia</a>
											</li>
											<li>
												<a href="getAllRestrictions.php">Add/Delete restrictions</a>
											</li>
											<li>
												<a href="getAllUsers.php">View/Delete Users</a>
											</li>
										</ul>
									</li>			
								<?php
								//------------------------------------------------------------------------
								if (strpos($arr[count($arr)-1], 'dashboard') !== false)
									echo '<li class="active"><a href="dashboard.php">Dashboard</a></li>';
								else
									echo '<li><a href="dashboard.php">Dashboard</a></li>';
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
		</div>
	</div>
</div>
