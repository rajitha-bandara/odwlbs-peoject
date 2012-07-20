<?php
if(!isset($_GET['lid']))
{
	$redirect_to = 4;
	$page_topic = "Page Not Found";
	$page_body = "Sorry, the page you requested can not be found.";
	require_once('msg_to_user.php');
	exit();
}
else
{
	$lid = $_GET['lid'];
}

$lid = mysql_real_escape_string($lid);
$lid = eregi_replace("`", "", $lid);
$sql = mysql_query("SELECT * FROM lbs_biz WHERE biz_id= '$lid' ");
// Make sure this listing actually exists
$existCount = mysql_num_rows($sql);
if ($existCount < 1) 
{
	 $page_topic = "Unrecognized Listing!";
	 $msgToUser = "The listing you are trying to access does not exist.";
	 require_once('msg_to_user.php');
     exit();
   
}

$title = "";
$mainCategory = "";
$subCategory = "";
$phone = "";
$street = "";
$city = "";
$country = "";
$zipcode = "";
$package = "";


$sql = "SELECT b.title AS title, b.package AS pkg, m.name AS mainCat, s.name AS subCat, c.phone AS phone, l.street AS street, l.city AS city, l.country AS country, l.zip_code AS zip FROM lbs_biz b, lbs_biz_contacts c, lbs_biz_location l, lbs_biz_main_categories m, lbs_biz_sub_categories s WHERE b.biz_id = '$lid' AND b.biz_id = c.biz_id AND b.biz_id = l.biz_id  AND b.main_category = m.main_category_id AND b.sub_category = s.sub_category_id";
		
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$title = $row['title'];
	$safeTitle = 	makeURLSafe($title);
	$package = $row['pkg'];
	$mainCategory = $row['mainCat'];
	$subCategory = $row['subCat'];
	$phone = $row['phone'];
	$street = $row['street'];
	$city = $row['city'];
	$country = $row['country'];
	$zipcode = $row['zip'];
	
}

if($package == 'b')
{
	
	
	
}
else if($package == 's')
{
	
}
else if($package == 'g')
{
	
}
?>