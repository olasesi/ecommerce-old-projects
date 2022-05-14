<?php 
require('../incs_genelect/gen_config.php'); 

if(!$_SESSION['user_id']){
header("Location:".GEN_WEBSITE);
exit();
}


include('../incs_genelect/gen_cookie_for_most.php'); 


mysqli_query($connect,"UPDATE users SET cookie_sessions = '' WHERE user_id = '".$_SESSION['user_id']."' AND active = '1'") or die(db_conn_error);	
session_destroy();
setcookie("remember_me", "", time() - 31104000);		//I think i made the cookie session time to be a month
	
header("Location:".GEN_WEBSITE);
exit();

?>
