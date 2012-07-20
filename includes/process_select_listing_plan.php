<?php
@session_start();
if(isset($_POST['btn_bronze']))
{
	session_register('req_pkg');
	$_SESSION['req_pkg'] = "bronze";
	
}
else if(isset($_POST['btn_silver']))
{
	session_register('req_pkg');
	$_SESSION['req_pkg'] = "silver";
	
}
else if(isset($_POST['btn_gold']))
{
	session_register('req_pkg');
	$_SESSION['req_pkg'] = "gold";
	
}
header("location: ../add_listing.php");
exit();
?>