<div class="top-bar navbar-fixed-top">
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
								//------------------------------------------------------------------------
								if (strpos($arr[count($arr)-1], 'login') !== false)
									echo '<li class="active"><a href="login.php">Login</a></li>';
								else
									echo '<li><a href="login.php">Login</a></li>';
								//------------------------------------------------------------------------
								if (strpos($arr[count($arr)-1], 'register') !== false)
									echo '<li class="active"><a href="register.php">Register</a></li>';
								else
									echo '<li><a href="register.php">Register</a></li>';
							?>
						</ul>									
					</nav>
				</div>
			</nav>
		</div>
	</div>
</div>