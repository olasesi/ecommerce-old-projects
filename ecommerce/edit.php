<?php 
require('../incs_genelect/gen_config.php'); 
include('../incs_genelect/gen_cookie_for_most.php'); 

if(!isset($_GET['product_id'])){
	$_GET['product_id']=""; 
}

$select_edit = mysqli_query($connect, "SELECT * FROM goods WHERE goods_id = '".mysqli_real_escape_string ($connect, $_GET['product_id'])."'") or die(db_conn_error);

if(!$_SESSION['user_id'] OR mysqli_num_rows($select_edit) == 0){
header("Location:".GEN_WEBSITE);
exit();
}

?>


<?php 
 include('../incs_genelect/header.php');
?>

<?php							
//if the number of slides is now 16 and you wish to add to it, it can be added but the list slide will be put into product category						
 if (!isset($reg_errors_slider)) {$reg_errors_slider = array();}
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadslide'])){
	 
	if (preg_match ('/^.{3,20}$/i', trim($_POST['slide_goods_name']))) {		//only 20 characters are allowed to be inputted
		$slidegoodname = mysqli_real_escape_string ($connect, trim($_POST['slide_goods_name']));
	
	} else {
		$reg_errors_slider['slide_name'] = 'Maximum characters, 20';
	} 
	 
 //only numbers are allowed here. no decimals or commas
 if (preg_match ('/^[0-9]{1,10}$/', trim($_POST['slide_price'])) OR empty($_POST['slide_price']))  {	// OR empty(trim($_POST['slide_price']))
		$slideprice = mysqli_real_escape_string ($connect,trim($_POST['slide_price']));
		} else {
		$reg_errors_slider['slide_price'] = 'Please enter valid characters e.g 13000';
		}
		
		
	if ($_POST['slide_categories'] == "Choose category") {
		$reg_errors_slider['slide_categories'] = 'Please choose from the category';			//same reason as above
		}else{
		$slidecategories = $_POST['slide_categories'];
		}
		
	if ($_POST['section'] == "Choose section") {
		$reg_errors_slider['section_error_key'] = 'Please choose section to upload to';			//same reason as above
		}else{
		$section = $_POST['section'];
		}


	if (preg_match ('/^.{0,5000}+$/i', trim($_POST['description']))) {			//exclamation mark(!) added to it. To be added to others	
		$description_g = mysqli_real_escape_string ($connect, trim($_POST['description']));
		} else {
		$reg_errors_slider['description'] = 'Maximum characters: 5000';
		}
		
	 
if(empty($reg_errors_slider)){
	
$q = mysqli_query($connect,"UPDATE goods SET goods_name = '".$slidegoodname."', goods_price = '".$slideprice."', description = '".$description_g."', categories = '".$slidecategories."', section = '".$section."' WHERE goods_id = '".$_GET['product_id']."'") or die(db_conn_error);
 
 if (mysqli_affected_rows($connect) == 1){
			
echo '<br><br><h2 class="text-success text-center">Product info was successfully edited</h2>';
			$_POST = array();
			}
 
}
 
}
 
 
 //end of slide upload
 ?>
 
 
 

	<?php							
//if the number of slides is now 16 and you wish to add to it, it can be added but the list slide will be put into product category						
 if (!isset($reg_errors_slider1)) {$reg_errors_slider1 = array();}
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadslide1'])){
	
		
	if (is_uploaded_file($_FILES['slideimage1']['tmp_name']) AND $_FILES['slideimage1']['error'] == UPLOAD_ERR_OK){ 
		
			if($_FILES['slideimage1']['size'] > 1048576){ 		//conditions for the file size 1MB
				$reg_errors_slider1['file_size1']="File size is too big. Max file size 1MB";
			}
		
			$allowed_extensions1 = array('jpeg', '.png', '.jpg', '.JPG', 'JPEG', '.PNG');		
			$allowed_mime1 = array('image/jpeg', 'image/png', 'image/pjpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/x-png');
			$image_info1 = getimagesize($_FILES['slideimage1']['tmp_name']);
			$ext1 = substr($_FILES['slideimage1']['name'], -4);
			
			
			
			
			if (!in_array($_FILES['slideimage1']['type'], $allowed_mime1) || !in_array($image_info1['mime'], $allowed_mime1) || !in_array($ext1, $allowed_extensions1)){
				$reg_errors_slider1['wrong_upload1'] = "Please choose jpg or png file type. GIF images are not allowed.";
				
			}
			
		}
 		
	
	
	
	if(empty($reg_errors_slider1)){
	if($_FILES['slideimage1']['error'] == UPLOAD_ERR_OK){
			$new_name1= (string) sha1($_FILES['slideimage1']['name'] . uniqid('',true));
			$new_name1 .= ((substr($ext1, 0, 1) != '.') ? ".{$ext1}" : $ext1);
			$dest = "img/".$new_name1;
			
			if (move_uploaded_file($_FILES['slideimage1']['tmp_name'], $dest)){
			
			$_SESSION['images1']['new_name'] = $new_name1;
			$_SESSION['images1']['file_name'] = $_FILES['slideimage1']['name'];
			
			
			} else {
			trigger_error('The file could not be moved.');
			$reg_errors_slider1['not_moved1'] = "The file could not be moved.";
			unlink ($_FILES['slideimage1']['tmp_name']);
			}
			}
 
if(empty($reg_errors_slider1)){

	
$new_name1 = ((isset($_SESSION['images1']['new_name']))? $_SESSION['images1']['new_name']:"goods_serv_pix.jpg");
$q1 = mysqli_query($connect,"UPDATE goods SET file_name_goods = '".$new_name1."' WHERE goods_id = '".$_GET['product_id']."'") or die(db_conn_error);
 
 if (mysqli_affected_rows($connect) == 1) {
			
			$_POST = array();
			$_FILES = array();
			unset($_FILES['slideimage1'], $_SESSION['images1']);
					
		echo '<br><br><h2 class="text-success text-center">Image change was successful!!!</h2>';
			}
 

 
 
 }
 
 
 }
 
 
 }
 
 ?>
 
 
 <?php
 $edit_array = mysqli_fetch_array($select_edit);
	$value_goodsname = $edit_array['goods_name'];
	$value_goods_price = $edit_array['goods_price'];
	$value_file_name_goods = $edit_array['file_name_goods'];
	$value_description = $edit_array['description'];
	$value_categories = $edit_array['categories'];
	$value_section = $edit_array['section'];
	
?>
 
 
 
 
 
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Product Edit</h3>
						<ul class="breadcrumb-tree">
							<li><a href="<?php echo GEN_WEBSITE; ?>">Home</a></li>
							<li class="active">Product Edit</li>
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
							<form method="POST" action="">
							
							<div class="section-title">
								<h3 class="title">Edit Product Info</h3>
							</div>
							  <?php
								if (array_key_exists('slide_name', $reg_errors_slider)) {
								echo '<p class="message" style="color:red;">'.$reg_errors_slider['slide_name'].'</p>';
								}
								?>
							<div class="form-group">
								<input class="input" type="text" name="slide_goods_name" required="required" placeholder="Product name" value="<?php if(!isset($_POST['slide_goods_name'])){ echo $value_goodsname;}else{ echo $_POST['slide_goods_name'];} ?>">
							</div>
							
							 <?php
								if (array_key_exists('slide_price', $reg_errors_slider)) {
								echo '<p class="message" style="color:red;">'.$reg_errors_slider['slide_price'].'</p>';
								}
								?>
							<div class=""><small><em>(Optional)</em></small></div>
							<div class="form-group">
								<input class="input" type="text" name="slide_price"  placeholder="Product price" value="<?php if(!isset($_POST['slide_price'])){  echo $value_goods_price;}else{ echo $_POST['slide_price'];} ?>">
							</div>
							
							
							 
							<?php if (array_key_exists('slide_categories', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['slide_categories'].'</p>';}?>
								
							 <div class="form-group">
				             
								
								<select class="form-control input-sm" name="slide_categories" id="categories">
								<option>Choose category</option>
								
								<?php
								
								$productscategories_array= array('Apple','Samsung', 'Huawei', 'HTC', 'Blackberry', 'Motorola', 'Nokia', 'Xiaomi', 'Laptops', 'Games');
								
								
									foreach ($productscategories_array as $productsoption){
										if(!isset($_POST['slide_categories'])){
											
										$productssel = ($productsoption==$value_categories)?"Selected='selected'":"";
										}else{
										$productssel = ($productsoption==$_POST['slide_categories'])?"Selected='selected'":"";
										}
									echo '<option '.$productssel.'>'.$productsoption.'</option>';
									}
								
								?>
								</select>
								
							</div>
							
							<?php if (array_key_exists('section_error_key', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['section_error_key'].'</p>';}?>
								
							 <div class="form-group">
				             <select class="form-control input-sm" name="section" id="section">
								<option>Choose section</option>
								
								<?php
								
								$productscategories_array1= array('New Products','Top Selling');
								
								
									foreach ($productscategories_array1 as $productsoption1){
									if(!isset($_POST['section'])){
										$productssel1 = ($productsoption1==$value_section)?"Selected='selected'":"";
									}else{
										$productssel1 = ($productsoption1==$_POST['section'])?"Selected='selected'":"";
									}
									
									echo '<option '.$productssel1.'>'.$productsoption1.'</option>';}
								
								?>
								</select>
								
							</div>
							
							
							
							 <?php
								if (array_key_exists('description', $reg_errors_slider)) {
								echo '<p class="message" style="color:red;">'.$reg_errors_slider['description'].'</p>';
								}
								?>
							<div class="form-group"> 
							<label for="description">Product description<small><em>(Optional)</em></small></label> 
							<textarea class="form-control" name="description" id="description" placeholder="Enter description here"><?php if(!isset($_POST['description'])){echo $value_description;}else{ echo $_POST['description'];} ?></textarea> 
							</div>
												
							<div class="form-group">
							<button name="uploadslide" type="submit" class="primary-btn order-submit">Edit Info</button>
							<div class="form-group">
							
							
							</form>
						
						</div>
						
					</div>

					
				</div>
				<!-- /row -->
				<br><br><br>
			</div>
			
			
			
			
			
			
			
			
			
			<div class="col-md-5">
						<!-- Billing Details -->
						<div class="billing-details">
							<form method="POST" action="" enctype="multipart/form-data">
							
							<div class="section-title">
								<h3 class="title">Change Product Image</h3>
							</div>
							
							
							
							<?php 
							if (array_key_exists('file_size1', $reg_errors_slider1)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider1['file_size1'].'</p>';}
							if (array_key_exists('wrong_upload1', $reg_errors_slider1)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider1['wrong_upload1'].'</p>';}
							//if (array_key_exists('upload_slide_image', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['upload_slide_image'].'</p>';}
							if (array_key_exists('not_moved1', $reg_errors_slider1)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider1['not_moved1'].'</p>';}
							?>
							
							<div class="form-group">
							<div class=""><small>Upload only square-size images</small><small><em>(Optional)</em></small></div>
							<input type="file" id="slide_1_image_1" name="slideimage1" class="form-control"/>
							
							</div>
							
							<div class="form-group">
							<button name="uploadslide1" type="submit" class="primary-btn order-submit">Change Image</button>
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
 