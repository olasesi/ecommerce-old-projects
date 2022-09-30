<?php
require('../incs_genelect/gen_config.php');
//include('../incs_genelect/gen_cookie_for_most.php'); 
if (isset($_SESSION['user_id'])) {
	header("Location:" . GEN_WEBSITE);
	exit();
}
?>
<?php
//username == email address
$login_errorsl = array();
if (isset($_POST['login']) and $_SERVER['REQUEST_METHOD'] == 'POST') {

	if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
		$el = mysqli_real_escape_string($connect, trim($_POST['email']));
	} else {
		$login_errorsl['email'] = 'Email is not correctly spelt.';
	}
	if (!empty($_POST['pass'])) {
		$pl = mysqli_real_escape_string($connect, $_POST['pass']);
	} else {
		$login_errorsl['pass'] = 'Please enter your password';
	}


	if (empty($login_errorsl)) {

		$rl = mysqli_query($connect, "SELECT * FROM users WHERE (email='" . $el . "' AND password='" . $pl . "' AND active='1')") or die(db_conn_error);

		if (mysqli_num_rows($rl) == 1) {

			$row = mysqli_fetch_array($rl, MYSQLI_NUM);


			$value = md5(uniqid(rand(), true));
			$query_confirm_sessions = mysqli_query($connect, "SELECT cookie_sessions FROM users WHERE email='" . $el . "' AND active = '1'") or die(db_conn_error);
			$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);

			if (empty($cookie_value_if_empty[0])) {
				mysqli_query($connect, "UPDATE users SET cookie_sessions = '" . $value . "' WHERE email='" . $el . "' AND active = '1'") or die(db_conn_error);
				setcookie("remember_me", $value, time() + 360);	//session time out is 5 min

			} else if (!empty($cookie_value_if_empty[0])) {

				setcookie("remember_me", $cookie_value_if_empty[0], time() + 360);
			}


			$_SESSION['user_id'] = $row[0];
			$_SESSION['firstname'] = $row[2];
			$_SESSION['lastname'] = $row[3];
			$_SESSION['email'] = $row[4];


			if ($row[1] == 'admin') $_SESSION['user_admin'] = true;


			header("Location:" . GEN_WEBSITE);
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
							echo '<p class="message" style="color:red;">' . $login_errorsl['email'] . '</p>';
						}
						?>
						<?php
						if (array_key_exists('pass', $login_errorsl)) {
							echo '<p class="message" style="color:red;">' . $login_errorsl['pass'] . '</p>';
						}
						?>
						<div class="form-group">
							<input class="input" type="text" name="email" required="required" placeholder="Email" value="<?php if (isset($_POST['email'])) {
																																echo $_POST['email'];
																															} ?>">
						</div>

						<div class="form-group">
							<input class="input" type="password" name="pass" placeholder="Password" required="required" value="<?php if (isset($_POST['password'])) {
																																	echo '';
																																} ?>">
						</div>
						<div class="form-group">
							<button name="login" type="submit" class="primary-btn order-submit">Login</button>
						</div>


					</form>

				</div>

			</div>


		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<?php include('../incs_genelect/footer.php'); ?>