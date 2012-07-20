<?php
if (isset($_POST["btnDelAcc"])) 
{
	$del_acct_pass = $_POST['del_acct_pass'];
	$sql = mysql_query("SELECT * FROM lbs_user WHERE user_id='$id' AND password='$del_acct_pass'");
    $pass_check_num = mysql_num_rows($sql);
	if ($pass_check_num > 0)
	{
		 $msgToUser = '
		  Are you sure you want to delete your account?<br />
		  <br />
		  <a href="account_settings.php?choice=no">NO</a> 		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <a href="account_settings.php?choice=yes">YES</a>';
          

	} 
	else 
	{
		$msgToUser = '<br /><br />This password  is invalid.';
   	 
	}	
	
}

?>

<?php 
if ($_GET['choice'] == "yes") 
{
	global $guserObj;
    $pic1 = ("members/$id/image01.jpg");
	if (file_exists($pic1)) 
	{
		 unlink($pic1);
    }
    $dir = "members/$id";
    rmdir($dir);
	    
    $guserObj->setUserId($id);
	$guserObj->delete();
	// Unset all of the session variables
	$_SESSION = array();
	
	// Destroy the session variables
	session_destroy();
    echo "<script type='text/javascript'>window.location.href='index.php';</script>";

    exit(); 
	
} else if ($_GET['choice'] == "no") 
{
	include_once 'profile.php'; 
    exit(); 
}

?>