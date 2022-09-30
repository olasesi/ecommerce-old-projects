<?php
require('../incs_genelect/gen_config.php');
include('../incs_genelect/header.php');
include('../incs_gene../lect/gen_cookie_for_most.php');

?>

<?php

if (!isset($_GET['product'])) {
	$_GET['product'] = '';
}

?>
<!-- /NAVIGATION -->

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<?php
				$select_details = mysqli_query($connect, "SELECT * FROM goods WHERE goods_id = '" . $_GET['product'] . "'") or die(db_conn_error);


				?>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo GEN_WEBSITE; ?>">Home</a></li>
					<li><a href="shop.php">Shop</a></li>
					<!--<li><a href="#">Accessories</a></li>
							<li><a href="#">Headphones</a></li>-->
					<li class="active">Product</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<?php
		if (mysqli_num_rows($select_details) == 1) {
			while ($product_result = mysqli_fetch_array($select_details)) {
				echo '<div class="row">
					
					<div class="col-md-6 ">
						<div id="product-main-img">
						
							
							<div class="product-preview">
								<img src="img/' . $product_result['file_name_goods'] . '" alt="' . $product_result['goods_name'] . '" title="' . $product_result['goods_name'] . '">
							</div>

							
						</div>
					</div>
					
					
					<div class="col-md-6">
						<div class="product-details">
							<h2 class="product-name">' . $product_result['goods_name'] . '</h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<span class="product-available">In Stock</span>
								
							</div>
							<div>
							
							</div>
							<p>' . $product_result['description'] . '</p>
							';



				if (isset($_SESSION['user_id'])) {

					echo '<ul class="product-btns">
								<li><a href="edit.php?product_id=' . $product_result['goods_id'] . '"><i class="fa fa-edit"></i> Edit</a></li>
								
							</ul>
							';
				}




				echo '</div>
					</div>
					
				</div>';
			}
		} else {

			echo '';
		}
		?>


		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->


<?php include('../incs_genelect/footer.php'); ?>