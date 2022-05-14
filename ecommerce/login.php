<?php 
require('../incs_genelect/gen_config.php'); 
//include('../incs_genelect/gen_cookie_for_most.php'); 
if(isset($_SESSION['user_id'])){
header("Location:".GEN_WEBSITE);
exit();
}
?>
<?php
//username == email address
$login_errorsl = array();
if(isset($_POST['login']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){

if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
   $el = mysqli_real_escape_string ($connect,trim($_POST['email'] ));	
} else {
     $login_errorsl['email'] = 'Email is not correctly spelt.';
}
if (!empty($_POST['pass'])) {									
   $pl = mysqli_real_escape_string ($connect,$_POST['pass']);
}else{
   $login_errorsl['pass'] = 'Please enter your password';
}


if (empty($login_errorsl)) {
    
	$rl = mysqli_query ($connect, "SELECT * FROM users WHERE (email='".$el."' AND password='".$pl."' AND active='1')") or die(db_conn_error);
	
	if (mysqli_num_rows($rl) == 1) {
    
	$row = mysqli_fetch_array ($rl, MYSQLI_NUM);
    
	
	$value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT cookie_sessions FROM users WHERE email='".$el."' AND active = '1'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE users SET cookie_sessions = '".$value."' WHERE email='".$el."' AND active = '1'") or die(db_conn_error);		
	setcookie("remember_me", $value, time() + 360);	//session time out is 5 min
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("remember_me", $cookie_value_if_empty[0], time() + 360);	
	}
	
	
	$_SESSION['user_id'] = $row[0];
    $_SESSION['firstname'] = $row[2];
	$_SESSION['lastname'] = $row[3];
	$_SESSION['email'] = $row[4];
   
	 
	 if ($row[1] == 'admin') $_SESSION['user_admin'] = true;
    
	
	 header("Location:".GEN_WEBSITE);
	 exit();
	 
	} else {
      $login_errorsl['pass'] = 'The email and password did not match.';	
}
} // End of $login_errors IF.

}

?>

<?php
include('../incs_genelect/header.php'); 
?>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Admin Login</h3>
						<ul class="breadcrumb-tree">
							<li><a href="<?php echo GEN_WEBSITE; ?>">Home</a></li>
							<li class="active">Admin Login</li>
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
								<h3 class="title">Login</h3>
							</div>
							  <?php
								if (array_key_exists('email', $login_errorsl)) {
								echo '<p class="message" style="color:red;">'.$login_errorsl['email'].'</p>';
								}
								?>
								 <?php
								if (array_key_exists('pass', $login_errorsl)) {
								echo '<p class="message" style="color:red;">'.$login_errorsl['pass'].'</p>';
								}
								?>
							<div class="form-group">
								<input class="input" type="text" name="email" required="required" placeholder="Email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>">
							</div>
							
							<div class="form-group">
								<input class="input" type="password" name="pass" placeholder="Password" required="required" value="<?php if(isset($_POST['password'])){ echo '';} ?>">
							</div>
							<div class="form-group">
							<button name="login" type="submit" class="primary-btn order-submit">Login</button>
							</div>
							
							
							</form>
							<!--<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>-->
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<!--<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address">
								<label for="shiping-address">
									<span></span>
									Ship to a diffrent address?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="tel" placeholder="Telephone">
									</div>
								</div>
							</div>
						</div>-->
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<!--<div class="order-notes">
							<textarea class="input" placeholder="Order Notes"></textarea>
						</div>-->
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<!--<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								<div class="order-col">
									<div>1x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
								<div class="order-col">
									<div>2x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$2940.00</strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<a href="#" class="primary-btn order-submit">Place order</a>
					</div>-->
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

	<?php include('../incs_genelect/footer.php'); ?>