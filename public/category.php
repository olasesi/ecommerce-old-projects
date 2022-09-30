<?php
require('../incs_genelect/gen_config.php');
include('../incs_genelect/gen_cookie_for_most.php');

if (!isset($_GET['cat']) or empty($_GET['cat'])) {
	header("Location:" . GEN_WEBSITE);
	exit();
}


include('../incs_genelect/header.php');
?>



<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Category</h3>
				<ul class="breadcrumb-tree">
					<li><a href="index.php">Home</a></li>
					<li class="active"><?php echo $_GET['cat'] . ' Shop'; ?></li>
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

			$statement = "goods WHERE categories = '" . mysqli_real_escape_string($connect, $_GET['cat']) . "' ORDER BY goods_timestamp DESC";

			?>
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title"><?php echo $_GET['cat'] . ' Shop'; ?></h3>
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
	<?php echo pagination($statement, $per_page, $page, $url = GEN_WEBSITE . '/category.php?cat=' . $_GET['cat'] . '&'); ?>
</div>



<?php include('../incs_genelect/footer.php'); ?>