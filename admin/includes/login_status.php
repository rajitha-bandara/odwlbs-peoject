<?php

global $gadminObj;
$isSetSession = false;
$isSetCookie  = false;

$isSetSession = $gadminObj->check_session();
$isSetCookie = $gadminObj->check_cookie(); 

if($isSetSession)

{
	$admin_id = $_SESSION['admin_sess_id'];
	$admin_username = $_SESSION['admin_username'];
	$admin_password = $_SESSION['admin_password'];
	
	
}
else if($isSetCookie)
{
	$admin_id = $_COOKIE['admin_sess_id'];
	$admin_username = $_COOKIE['admin_username'];
	$admin_password = $_COOKIE['admin_password'];
	
	
}
else 
{
	require_once('login.php');
	exit();
}
?>