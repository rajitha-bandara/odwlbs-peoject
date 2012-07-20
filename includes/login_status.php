<?php

 global $gauthObj;
$isSetSession = false;
$isSetCookie  = false;

$isSetSession = $gauthObj->check_session();
$isSetCookie = $gauthObj->check_cookie(); 

if($isSetSession)

{
	$logOptions_id = $_SESSION['auth_id'];
	$logOptions_username = $_SESSION['auth_username'];
	$logOptions_password = $_SESSION['auth_password'];
	
	$log_msg =  "Hi, ".$logOptions_username." ! 
	<a href ='profile.php?pid=".$logOptions_id."'>My Profile</a>
	<a href ='includes/logout.php'>Log out</a> ";
}
else if($isSetCookie)
{
	$logOptions_id = $_COOKIE['auth_id'];
	$logOptions_username = $_COOKIE['auth_username'];
	$logOptions_password = $_COOKIE['auth_password'];
	
	$log_msg =  "Hi, ".$logOptions_username." ! 
	<a href ='profile.php?pid=".$logOptions_id."'>My Profile</a>
	<a href ='includes/logout.php'>Log out</a> ";
}
else 
{
	$log_msg =  "Welcome Guest! 
	<a id='login_popup' href='#'>Sign in </a> | 
	<a href ='register.php' >Register </a>";
}
?>