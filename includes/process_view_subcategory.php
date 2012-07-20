<?php
if(!(isset($_GET['mid']) && isset($_GET['sid'])))
{
	$redirect_to = 4;
	$page_topic = "Page Not Found";
	$page_body = "Sorry, the page you requested can not be found.";
	require_once('msg_to_user.php');
	exit();
}
else
{
	$mid = $_GET['mid'];
	$sid = $_GET['sid'];
}

$cid = mysql_real_escape_string($cid);
$cid = eregi_replace("`", "", $cid);
$sql = mysql_query("SELECT * FROM lbs_biz_sub_categories s,lbs_biz_main_categories m WHERE s.main_category_id= '$mid' AND  s.sub_category_id = '$sid' AND m.main_category_id= s.main_category_id");
// Make sure this category actually exists
$existCount = mysql_num_rows($sql);
if ($existCount < 1) 
{
	 $page_topic = "Unrecognized Listing Category!";
	 $msgToUser = "The listing category you are trying to access does not exist.";
	 require_once('msg_to_user.php');
     exit();
   
}
else
{
	 
	//$categoryName = $result;
}


?>