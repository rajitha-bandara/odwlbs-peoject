<?php
if(!isset($_GET['cid']))
{
	$redirect_to = 4;
	$page_topic = "Page Not Found";
	$page_body = "Sorry, the page you requested can not be found.";
	require_once('msg_to_user.php');
	exit();
}
else
{
	$cid = $_GET['cid'];
}

global $gcatObj;
$result = $gcatObj->verifyCategory($cid);
if(!$result)
{
	$page_topic = "Unrecognized Listing Category!";
	 $msgToUser = "The listing category you are trying to access does not exist.";
	 require_once('msg_to_user.php');
     exit();
}
else
{
	 
	$categoryName = $result;
}

/*$cid = mysql_real_escape_string($cid);
$cid = eregi_replace("`", "", $cid);
$sql = mysql_query("SELECT * FROM lbs_biz_main_categories WHERE main_category_id= '$cid' ");
// Make sure this category actually exists
$existCount = mysql_num_rows($sql);
if ($existCount < 1) 
{
	 $page_topic = "Unrecognized Listing Category!";
	 $msgToUser = "The listing category you are trying to access does not exist.";
	 require_once('msg_to_user.php');
     exit();
   
}*/
?>