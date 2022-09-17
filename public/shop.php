<?php
require('../incs_genelect/gen_config.php');
include('../incs_genelect/gen_cookie_for_most.php');
include('../incs_genelect/header.php');
?>



<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Shop</h3>
				<ul class="breadcrumb-tree">
					<li><a href="index.php">Home</a></li>
					<li class="active">Shop</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>

<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<?php include('../incs_genelect/gen_paginate.php'); ?>
			<?php

			$statement = "goods ORDER BY goods_timestamp DESC";

			?>
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Shop Products</h3>
					<div class="section-nav">

					</div>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->

			<!-- product -->

			<?php
			include('../incs_genelect/gen_products.php');
			?>




			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>


<div class="row text-center">
	<?php echo pagination($statement, $per_page, $page, $url = GEN_WEBSITE . '/shop.php?'); ?>
</div>



<?php include('../incs_genelect/footer.php'); ?>