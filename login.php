<?php require_once ('../inc-ecommerce/config.php');
$title = 'Login page - Ecommerce Cloth World';
include('../inc-ecommerce/header.php');  





$login_errorsl = array();
if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['mysubmit'])){

if (preg_match ('/^[A-Z0-9_-]{3,30}$/i',$_POST['username'])) {
   $el = mysqli_real_escape_string ($connect,$_POST['username']);
} else {
     $login_errorsl['username'] = 'Wrong username. Please type your username exactly the way you registered it.';
}
if (preg_match ('/^.{6,255}$/i',$_POST['pass'])) {									
   $pl = mysqli_real_escape_string ($connect,$_POST['pass']);
}else{
   $login_errorsl['pass'] = 'Please enter your password';
}



if(empty($login_errorsl)){
    
	$rl = mysqli_query($connect, "SELECT user_id, member, firstname, surname, password, username, email WHERE username='".$el."' 
  AND password='".$pl."'") or die(db_conn_error);
	
	if (mysqli_num_rows($rl) == 1) {
    
	$row = mysqli_fetch_array ($rl, MYSQLI_NUM);
    
	
	$value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT cookie_sessions FROM users WHERE username='".$el."' AND active = '1' AND payment = '1'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE users SET cookie_sessions = '".$value."' WHERE username='".$el."' AND active = '1' AND payment = '1'") or die(db_conn_error);		
	setcookie("remember_me", $value, time() + 30*24*3600);	
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("remember_me", $cookie_value_if_empty[0], time() + 30*24*3600);	
	}
	
	
	$_SESSION['user_id'] = $row[0];
  $_SESSION['firstname'] = $row[2];
	$_SESSION['lastname'] = $row[3];
	$_SESSION['username'] = $row[4];
  $_SESSION['brand_username_name'] = $row[5];
	$_SESSION['r_email'] = $row[6];
	$_SESSION['local_area'] = $row[7];
	$_SESSION['state_local_area'] = $row[8];
	$_SESSION['address'] = $row[9];
	$_SESSION['phone1'] = $row[10];
	$_SESSION['phone2'] = $row[11];
	$_SESSION['bus_email'] = $row[12];
	$_SESSION['bus_description'] = $row[13];
	$_SESSION['headline'] = $row[14];
	$_SESSION['facebook_link'] = $row[15];
	$_SESSION['instagram_link'] = $row[16];
	$_SESSION['twitter_link'] = $row[17];
	 
	 if ($row[1] == 'admin') $_SESSION['user_admin'] = true;
    
	
	 header("Location:".MYSHOPTWO."/".$_SESSION['username'].".php");
	 exit;
	 
	} else {
      $login_errorsl['pass'] = 'The username and password did not match.';	
}
} // End of $login_errors IF.

}


?>





    <!-- ***** Contact Area Starts ***** -->
    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Log in Page!</h2>
                        <span>Details to details is what makes Hexashop different from the other themes.</span>
                    </div>
                    <form id="contact" action="" method="post">
                        <div class="row">
                          <div class="col-lg-6">
                            <fieldset>
                              <input name="username" type="text" id="name" placeholder="Your name" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-6">
                            <fieldset>
                              <input name="pass" type="password" id="password" placeholder="password" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-12">
                            <fieldset>
                              <button type="submit" name="mysubmit" id="form-submit" class="main-dark-button"><i class="fa fa-paper-plane"></i>Submit</button>
                            </fieldset> 
                          </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Contact Area Ends ***** -->
    <!-- Footer -->











<?php include('../inc-ecommerce/footer.php');  
?>



























