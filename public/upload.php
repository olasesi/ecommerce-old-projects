<?php
require('../incs_genelect/gen_config.php');
include('../incs_genelect/gen_cookie_for_most.php');

if (!$_SESSION['user_id']) {
	header("Location:" . GEN_WEBSITE);
	exit();
}

?>
<?php
include('../incs_genelect/header.php');
?>



<?php
//if the number of slides is now 16 and you wish to add to it, it can be added but the list slide will be put into product category						
if (!isset($reg_errors_slider)) {
	$reg_errors_slider = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['uploadslide'])) {

	if (preg_match('/^.{3,20}$/i', trim($_POST['slide_goods_name']))) {		//only 20 characters are allowed to be inputted
		$slidegoodname = mysqli_real_escape_string($connect, trim($_POST['slide_goods_name']));
	} else {
		$reg_errors_slider['slide_name'] = 'Maximum characters, 20';
	}

	//only numbers are allowed here. no decimals or commas
	if (preg_match('/^[0-9]{1,10}$/', trim($_POST['slide_price'])) or empty($_POST['slide_price'])) {	// OR empty(trim($_POST['slide_price']))
		$slideprice = mysqli_real_escape_string($connect, trim($_POST['slide_price']));
	} else {
		$reg_errors_slider['slide_price'] = 'Please enter valid characters e.g 13000';
	}


	if ($_POST['slide_categories'] == "Choose category") {
		$reg_errors_slider['slide_categories'] = 'Please choose from the category';			//same reason as above
	} else {
		$slidecategories = $_POST['slide_categories'];
	}

	if ($_POST['section'] == "Choose section") {
		$reg_errors_slider['section_error_key'] = 'Please choose section to upload to';			//same reason as above
	} else {
		$section = $_POST['section'];
	}


	if (preg_match('/^.{0,5000}+$/i', trim($_POST['description']))) {			//exclamation mark(!) added to it. To be added to others	
		$description_g = mysqli_real_escape_string($connect, trim($_POST['description']));
	} else {
		$reg_errors_slider['description'] = 'Maximum characters: 5000';
	}

	if (is_uploaded_file($_FILES['slideimage']['tmp_name']) and $_FILES['slideimage']['error'] == UPLOAD_ERR_OK) {

		if ($_FILES['slideimage']['size'] > 1048576) { 		//conditions for the file size 1MB
			$reg_errors_slider['file_size'] = "File size is too big. Max file size 1MB";
		}

		$allowed_extensions = array('jpeg', '.png', '.jpg', '.JPG', 'JPEG', '.PNG');
		$allowed_mime = array('image/jpeg', 'image/png', 'image/pjpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/x-png');
		$image_info = getimagesize($_FILES['slideimage']['tmp_name']);
		$ext = substr($_FILES['slideimage']['name'], -4);




		if (!in_array($_FILES['slideimage']['type'], $allowed_mime) || !in_array($image_info['mime'], $allowed_mime) || !in_array($ext, $allowed_extensions)) {
			$reg_errors_slider['wrong_upload'] = "Please choose jpg or png file type. GIF images are not allowed.";
		}
	}




	if (empty($reg_errors_slider)) {
		if ($_FILES['slideimage']['error'] == UPLOAD_ERR_OK) {
			$new_name = (string) sha1($_FILES['slideimage']['name'] . uniqid('', true));
			$new_name .= ((substr($ext, 0, 1) != '.') ? ".{$ext}" : $ext);
			$dest = "img/" . $new_name;

			if (move_uploaded_file($_FILES['slideimage']['tmp_name'], $dest)) {

				$_SESSION['images']['new_name'] = $new_name;
				$_SESSION['images']['file_name'] = $_FILES['slideimage']['name'];
			} else {
				trigger_error('The file could not be moved.');
				$reg_errors_slider['not_moved'] = "The file could not be moved.";
				unlink($_FILES['slideimage']['tmp_name']);
			}
		}

		if (empty($reg_errors_slider)) {


			$new_name = ((isset($_SESSION['images']['new_name'])) ? $_SESSION['images']['new_name'] : "goods_serv_pix.jpg");
			$q = mysqli_query($connect, "INSERT INTO goods(goods_id, UID, goods_name, goods_price, file_name_goods, description, categories, section, goods_timestamp) 
						VALUES ('','" . $_SESSION['user_id'] . "','" . $slidegoodname . "','" . $slideprice . "','" . $new_name . "','" . $description_g . "','" . $slidecategories . "','" . $section . "', '" . strtotime('now') . "')") or die(db_conn_error);

			if (mysqli_affected_rows($connect) == 1) {

				$_POST = array();
				$_FILES = array();
				unset($_FILES['slideimage'], $_SESSION['images']);

				echo '<br><br><h2 class="text-success text-center">Upload was successful!!!</h2>';
			}
		}
	}
}


//end of slide upload
?>





<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Product Upload</h3>
				<ul class="breadcrumb-tree">
					<li><a href="<?php echo GEN_WEBSITE; ?>">Home</a></li>
					<li class="active">Product Upload</li>
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
		<div class="row">

			<div class="col-md-7">
				<!-- Billing Details -->
				<div class="billing-details">
					<form method="POST" action="" enctype="multipart/form-data">

						<div class="section-title">
							<h3 class="title">Upload Product</h3>
						</div>
						<?php
						if (array_key_exists('slide_name', $reg_errors_slider)) {
							echo '<p class="message" style="color:red;">' . $reg_errors_slider['slide_name'] . '</p>';
						}
						?>
						<div class="form-group">
							<input class="input" type="text" name="slide_goods_name" required="required" placeholder="Product name" value="<?php if (isset($_POST['slide_goods_name'])) {
																																				echo $_POST['slide_goods_name'];
																																			} ?>">
						</div>

						<?php
						if (array_key_exists('slide_price', $reg_errors_slider)) {
							echo '<p class="message" style="color:red;">' . $reg_errors_slider['slide_price'] . '</p>';
						}
						?>
						<div class=""><small><em>(Optional)</em></small></div>
						<div class="form-group">
							<input class="input" type="text" name="slide_price" placeholder="Product price" value="<?php if (isset($_POST['slide_price'])) {
																														echo $_POST['slide_price'];
																													} ?>">
						</div>



						<?php if (array_key_exists('slide_categories', $reg_errors_slider)) {
							echo '<p class="message" style="color:red;">' . $reg_errors_slider['slide_categories'] . '</p>';
						} ?>

						<div class="form-group">


							<select class="form-control input-sm" name="slide_categories" id="categories">
								<option>Choose category</option>

								<?php

								$productscategories_array = array('Apple', 'Samsung', 'Huawei', 'Xiaomi', 'TV Fire Stick', 'Iwatch', 'Airpod', 'Drones', 'Laptops', 'Games');

								if (isset($_POST['slide_categories'])) {
									foreach ($productscategories_array as $productsoption) {
										$productssel = ($productsoption == $_POST['slide_categories']) ? "Selected='selected'" : "";
										echo '<option ' . $productssel . '>' . $productsoption . '</option>';
									}
								} else {
									foreach ($productscategories_array as $productsoption) {
										echo '<option>' . $productsoption . '</option>';
									}
								}
								?>
							</select>

						</div>



						<?php if (array_key_exists('section_error_key', $reg_errors_slider)) {
							echo '<p class="message" style="color:red;">' . $reg_errors_slider['section_error_key'] . '</p>';
						} ?>

						<div class="form-group">


							<select class="form-control input-sm" name="section" id="section">
								<option>Choose section</option>

								<?php

								$productscategories_array1 = array('New Products', 'Top Selling');

								if (isset($_POST['section'])) {
									foreach ($productscategories_array1 as $productsoption1) {
										$productssel1 = ($productsoption1 == $_POST['section']) ? "Selected='selected'" : "";
										echo '<option ' . $productssel1 . '>' . $productsoption1 . '</option>';
									}
								} else {
									foreach ($productscategories_array1 as $productsoption1) {
										echo '<option>' . $productsoption1 . '</option>';
									}
								}
								?>
							</select>

						</div>



						<?php
						if (array_key_exists('description', $reg_errors_slider)) {
							echo '<p class="message" style="color:red;">' . $reg_errors_slider['description'] . '</p>';
						}
						?>
						<div class="form-group">
							<label for="description">Product description<small><em>(Optional)</em></small></label>
							<textarea class="form-control" name="description" id="description" placeholder="Enter description here"><?php if (isset($_POST['description'])) {
																																		echo trim($_POST['description']);
																																	} ?></textarea>
						</div>




						<?php
						if (array_key_exists('file_size', $reg_errors_slider)) {
							echo '<p class="message" style="color:red;">' . $reg_errors_slider['file_size'] . '</p>';
						}
						if (array_key_exists('wrong_upload', $reg_errors_slider)) {
							echo '<p class="message" style="color:red;">' . $reg_errors_slider['wrong_upload'] . '</p>';
						}
						//if (array_key_exists('upload_slide_image', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['upload_slide_image'].'</p>';}
						if (array_key_exists('not_moved', $reg_errors_slider)) {
							echo '<p class="message" style="color:red;">' . $reg_errors_slider['not_moved'] . '</p>';
						}
						?>

						<div class="form-group">
							<div class=""><small>Upload only square-size images</small><small><em>(Optional)</em></small></div>
							<input type="file" id="slide_1_image_1" name="slideimage" class="form-control" />

						</div>





						<div class="form-group">
							<button name="uploadslide" type="submit" class="primary-btn order-submit">Upload</button>
							<div class="form-group">


					</form>

				</div>

			</div>


		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
</div>
</div>



<?php include('../incs_genelect/footer.php'); ?>