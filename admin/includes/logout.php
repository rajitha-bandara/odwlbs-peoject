<?php 
@session_start();
 $salt = "34asdf34";
 $domain = DOMAIN_NAME;
 
$_SESSION = array();
session_destroy();
		
setcookie("admin_sess_id", "", time() - 3600,"/business_directory");
setcookie("admin_username", "", time() - 3600,"/business_directory");
setcookie("admin_password", "", time() - 3600,"/business_directory");

header('Location: ../login.php');

?>