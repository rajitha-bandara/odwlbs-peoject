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
$tagline = "";
$mainCatId = "";
$subCatId = "";
$mainCategory = "";
$subCategory = "";
$description= "";
$web = "";
$logo = "";

$email = "";
$phone = "";
$fax = "";
$mobile = "";
$contactPerson = "";
$fbURL = "";
$twitterURL = "";

$street = "";
$city = "";
$country = "";
$zipcode = "";
$latitude = "";
$longitude = "";

$keywords= "";
$package = "";
global $gbizObj;

$sql = "SELECT b.title AS title, b.description AS des, b.url AS url, b.package AS pkg,b.main_category AS mainCatId, b.sub_category AS subCatId, m.name AS mainCat, s.name AS subCat, c.email AS email, c.phone AS phone, c.fax AS fax, c.mobile AS mobile, c.contact_person AS contactP, l.street AS street, l.city AS city, l.country AS country, l.zip_code AS zip,l.latitude AS lat,l.longitude AS lon,k.keyword AS keywords FROM lbs_biz b, lbs_biz_contacts c, lbs_biz_location l, lbs_biz_main_categories m, lbs_biz_sub_categories s, lbs_biz_keywords k WHERE b.biz_id = '$lid' AND b.biz_id = c.biz_id AND b.biz_id = l.biz_id AND b.biz_id = k.biz_id AND b.main_category = m.main_category_id AND b.sub_category = s.sub_category_id";
		
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$title = $row['title'];
	$safeTitle = makeURLSafe($title);
	//$tagline = $row['title'];
	$description= $row['des'];
	$web = $row['url'];
	$package = $row['pkg'];
	$mainCatId = $row['mainCatId'];
	$subCatId = $row['subCatId'];
	$mainCategory = $row['mainCat'];
	$subCategory = $row['subCat'];
		
	$email = $row['email'];
	$phone = $row['phone'];
	$fax = $row['fax'];
	$mobile = $row['mobile'];
	$contactPerson = $row['contactP'];
	
	$street = $row['street'];
	$city = $row['city'];
	$country = $row['country'];
	$zipcode = $row['zip'];
	$latitude = $row['lat'];
	$longitude = $row['lon'];
	
	$keywords= $row['keywords'];
	
}

$images = array();
$images = get_image("logo","biz/$lid");
if($images != null)
{
	$logo = "<img src=biz/$lid/".$images[0]." width='125' height='125'>";
}

$sampleImages = array();
$images = get_any_image("biz/$lid/photo");
if($images != null)
{
	$loopImg = "";
	$thumb = "";
	$i = 0;
	foreach($images as $img)
	{
		$loopImg .= "{
						href : 'biz/$lid/photo/$img',
						title : 'My title'
					 },";
		
	}
	
	foreach($images as $img)
	{
		if($i==4)
		break;
		$thumb .= "<div class='grid_4'><img src='biz/$lid/photo/$img' width='100' height='100'></div>";
		$i++;
	}
	
}


if($package == 'b')
{
	$description = getStringChunk(100,$description);
	
	
}
else if($package == 's')
{
	$description = getStringChunk(500,$description);
	
}
else if($package == 'g')
{
	$description = getStringChunk(1000,$description);
	
}
?>