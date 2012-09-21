<?php
@session_start();
if(isset($_POST['btn_bronze']))
{
	session_register('req_pkg');
	$_SESSION['req_pkg'] = "bronze";
	
}

header("location: ../add_listing.php");
exit();
?>