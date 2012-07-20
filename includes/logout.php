<?php 
@session_start();
 $salt = "34asdf34";
 $domain = "places.com";
 
$_SESSION = array();
session_destroy();
		
setcookie("auth_id", "", time() - 3600,"/business_directory");
setcookie("auth_username", "", time() - 3600,"/business_directory");
setcookie("auth_password", "", time() - 3600,"/business_directory");

header('Location: ../index.php');

?>