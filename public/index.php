<?php
require('../incs_genelect/gen_config.php');
include('../incs_genelect/gen_cookie_for_most.php');
include('../incs_genelect/header.php');


?>
<!-- /NAVIGATION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- shop -->
			<div class="col-md-6 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="../assets/img/Shop01.jpg" alt="">
					</div>
					<div class="shop-body">
						<h3>Electronics<br>Products</h3>
						<a href="shop.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="../assets/img/Shop02.jpg" alt="">
					</div>
					<div class="shop-body">
						<h3>Electronics<br>Products</h3>
						<a href="shop.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">New Products</h3>
					<div class="section-nav">
						<!--<ul class="section-tab-nav tab-nav">
									<li><a data-toggle="tab" >Smartphones</a></li>
									<li><a data-toggle="tab">Laptops</a></li>
									<li><a data-toggle="tab">Smartphones</a></li>
									<li><a data-toggle="tab">Cameras</a></li>
									<li><a data-toggle="tab">Games</a></li>
									<li><a data-toggle="tab">Accessories</a></li>
								</ul>-->
					</div>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab1" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-1">
								<!-- product -->

								<?php
								$select_products = mysqli_query($connect, "SELECT * FROM goods WHERE section='New Products' ORDER BY goods_timestamp ASC LIMIT 0,4") or die(db_conn_error);
								if (mysqli_num_rows($select_products) > 0) {

									while ($row_set = mysqli_fetch_array($select_products)) {

										echo '<div class="product">
											
											
											<div class="product-img">
												<img src="img/' . $row_set['file_name_goods'] . '" alt="' . $row_set['goods_name'] . '" title="' . $row_set['goods_name'] . '">
												<div class="product-label">
													<!--<span class="sale">-30%</span>-->
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<!--<p class="product-category">Category</p>-->
												<h3 class="product-name"><a href="details.php?product=' . $row_set['goods_id'] . '">' . $row_set['goods_name'] . '</a></h3>
												<!--<h4 class="product-price"><del class="product-old-price"></del></h4>-->
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													
													<!--<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>-->
													<button class="quick-view"><a href="details.php?product=' . $row_set['goods_id'] . '"><i class="fa fa-eye"></i><span class="tooltipp">Details</span></a></button>';

										if (isset($_SESSION['user_id'])) {

											echo '<button class="add-to-wishlist"><a href="edit.php?product_id=' . $row_set['goods_id'] . '"><i class="fa fa-edit"></i><span class="tooltipp">Edit</span></a></button>';
										}


										echo '	
												</div>
											</div>
											
										</div>';
									}
								} else {

									echo '<h3 class="text-center">No Latest Products</h3>';
								}

								?>







								<?php
								$select_products1 = mysqli_query($connect, "SELECT * FROM goods WHERE section='New Products' ORDER BY goods_timestamp ASC LIMIT 4,4") or die(db_conn_error);
								if (mysqli_num_rows($select_products1) > 0) {

									while ($row_set1 = mysqli_fetch_array($select_products1)) {

										echo '<div class="product">
											
											
											<div class="product-img">
												<img src="img/' . $row_set1['file_name_goods'] . '" alt="' . $row_set1['goods_name'] . '" title="' . $row_set1['goods_name'] . '">
												<div class="product-label">
													<!--<span class="sale">-30%</span>-->
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<!--<p class="product-category">Category</p>-->
												<h3 class="product-name"><a href="details.php?product=' . $row_set1['goods_id'] . '">' . $row_set1['goods_name'] . '</a></h3>
												<!--<h4 class="product-price"><del class="product-old-price"></del></h4>-->
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													
													<!--<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>-->
													<button class="quick-view"><a href="details.php?product=' . $row_set1['goods_id'] . '"><i class="fa fa-eye"></i><span class="tooltipp">Details</span></a></button>';

										if (isset($_SESSION['user_id'])) {

											echo '<button class="add-to-wishlist"><a href="edit.php?product_id=' . $row_set1['goods_id'] . '"><i class="fa fa-edit"></i><span class="tooltipp">Edit</span></a></button>';
										}


										echo '	
												</div>
											</div>
											
										</div>';
									}
								}

								?>

								<!-- /product -->
							</div>


							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="hot-deal">
					<!--<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>-->
					<h2 class="text-uppercase">hot deal this week</h2>
					<p>New Products Up to 20% OFF</p>
					<a class="primary-btn cta-btn" href="shop.php">Shop now</a>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Top selling</h3>
					<div class="section-nav">
						<!--<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
									<li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
									<li><a data-toggle="tab" href="#tab2">Cameras</a></li>
									<li><a data-toggle="tab" href="#tab2">Accessories</a></li>
								</ul>-->
					</div>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">


					<?php
					$select_products3 = mysqli_query($connect, "SELECT * FROM goods WHERE section='Top Selling' LIMIT 8") or die(db_conn_error);
					if (mysqli_num_rows($select_products3) > 0) {

						while ($row_set3 = mysqli_fetch_array($select_products3)) {

							echo '<div class="col-md-4 col-xs-6"><div class="product">
											
											
											<div class="product-img">
												<img src="img/' . $row_set3['file_name_goods'] . '" alt="' . $row_set3['goods_name'] . '" title="' . $row_set3['goods_name'] . '">
												<div class="product-label">
													<!--<span class="sale">-30%</span>-->
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<!--<p class="product-category">Category</p>-->
												<h3 class="product-name"><a href="details.php?product=' . $row_set3['goods_id'] . '">' . $row_set3['goods_name'] . '</a></h3>
												<!--<h4 class="product-price"><del class="product-old-price"></del></h4>-->
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													
													<!--<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>-->
													<button class="quick-view"><a href="details.php?product=' . $row_set3['goods_id'] . '"><i class="fa fa-eye"></i><span class="tooltipp">Details</span></a></button>';

							if (isset($_SESSION['user_id'])) {

								echo '<button class="add-to-wishlist"><a href="edit.php?product_id=' . $row_set3['goods_id'] . '"><i class="fa fa-edit"></i><span class="tooltipp">Edit</span></a></button>';
							}


							echo '	
												</div>
											</div>
											
										</div></div>';
						}
					} else {

						echo '<h3 class="text-center">No Top Selling Products</h3>';
					}

					?>


				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>


<?php include('../incs_genelect/footer.php'); ?>