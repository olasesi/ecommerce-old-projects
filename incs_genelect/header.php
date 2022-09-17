<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<meta name="description" content="Electronics Mobile Master USA has the largest collections of Electronics such as phones, laptops, digital cameras, video games, etc.">


	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Electronics Mobile Master USA</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="../assets/css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../assets/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="../assets/css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../assets/css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../assets/css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="tel:+18322940953"><i class="fa fa-phone"></i> +1 (832) 294-0953</a></li>
					<li><a href="mailto:denispama1980@gmail.com"><i class="fa fa-envelope"></i> denispama1980@gmail.com</a></li>
					<!--<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>-->
				</ul>
				<ul class="header-links pull-right">
					<?php
					if (isset($_SESSION['user_id'])) {
						echo '<li><a href="upload.php"><i class="fa fa-upload"></i> Upload</a></li>';
					}
					?>

					<?php
					if (isset($_SESSION['user_id'])) {
						echo '<li><a href="logout.php"><i class="fa fa-user"></i> Logout</a></li>';
					} else {
						echo '<li><a href="login.php"><i class="fa fa-user"></i> Admin Login</a></li>';
					}




					?>


				</ul>
			</div>
		</div>
		<!-- /TOP HEADER -->

		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="/" class="logo">
								<h3 style="color:white;">Electronics Mobile Master USA</h3>
								<!--<img src="./img/logo.png" alt="">-->
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form method="GET" action="search.php">
								<!--<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>-->
								<input name="search_input" class="input" placeholder="Search products">
								<button class="search-btn">Search</button>
							</form>
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">


							<!-- Menu Toogle -->
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
							<!-- /Menu Toogle -->
						</div>
					</div>
					<!-- /ACCOUNT -->
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<nav id="navigation">
		<!-- container -->
		<div class="container">
			<!-- responsive-nav -->
			<div id="responsive-nav">
				<!-- NAV -->
				<ul class="main-nav nav navbar-nav">
					<li class=""><a href="/">Home</a></li>
					<li><a href="category.php?cat=Apple">Apple</a></li>
					<li><a href="category.php?cat=Samsung">Samsung</a></li>
					<li><a href="category.php?cat=Huawei">Huawei</a></li>
					<li><a href="category.php?cat=Xiaomi">Xiaomi</a></li>
					<li><a href="category.php?cat=TV Fire Stick">TV Fire Stick</a></li>
					<li><a href="category.php?cat=Iwatch">Iwatch</a></li>
					<li><a href="category.php?cat=Airpod">Airpod</a></li>
					<li><a href="category.php?cat=Drones">Drones</a></li>

					<li><a href="category.php?cat=Laptops">Laptops</a></li>
					<li><a href="category.php?cat=Games">Games</a></li>

				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>