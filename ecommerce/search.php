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
						<h3 class="breadcrumb-header">Search</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">Search</li>
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

<?php include ('../incs_genelect/gen_paginate.php');?>					
				<?php 
				 if(!isset($_GET['search_input'])){
					$_GET['search_input']=""; 
				 }
				 $statement = "goods WHERE goods_name LIKE '%".mysqli_real_escape_string ($connect,$_GET['search_input'])."%' ORDER BY goods_timestamp DESC"; 
				 
				 ?>					
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Search Result</h3>
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
 <?php echo pagination($statement,$per_page,$page,$url=GEN_WEBSITE.'/search.php?search_input='.$_GET['search_input'].'&'); ?>
</div>



<?php include('../incs_genelect/footer.php'); ?>