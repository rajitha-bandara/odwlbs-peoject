<?php @session_start();?>
<?php 
if ($_GET['lid']) {
	
     $lid = $_GET['lid'];

} 
else {
	
   	 $page_topic = "Page Not Found";
	 $msgToUser = "The requested page can not be found.";
	 echo "<h3>".$page_topic."</h3>";
	 echo "<h4>".$msgToUser."</h4>";
   	 exit();
}
?>
<?php
require_once('includes/init.php');
?>

<?php
$title = "";
$package = "";
$status = "";
$date_submitted = "";
$date_expire = "";
global $gbizObj;

$lid = mysql_real_escape_string($lid);
$lid = eregi_replace("`", "", $lid);
$sql = mysql_query("SELECT * FROM lbs_biz WHERE biz_id = '$lid' ");
// Make sure this listing actually exists
$existCount = mysql_num_rows($sql);
 if ($existCount < 1) 
{
	 $page_topic = "Unrecognized Listing!";
	 $msgToUser = "The listing you are trying to access does not exist.";
	 echo "<h3>".$page_topic."</h3>";
	 echo "<h4>".$msgToUser."</h4>";
	 exit();
}

$sql = "SELECT b.title, b.status, b.package, b.date_submit, b.date_expire FROM lbs_biz b WHERE b.biz_id = '$lid' ";
		
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$title = $row['title'];
	$status = $row['status'];
	$package = $row['package'];
	$date_submitted = $row['date_submit'];
	$date_expire = $row['date_expire'];
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/profile.css" rel="stylesheet">
</head>
<body>
<h2 id="profile_page_topic"><?php echo $title;?></h2>
<div class="grid_5">
<div class="grid_2">
<ul>
<li>Listing Plan</li>
<li>Status</li>
<li>Submitted Date</li>
<li>Expired Date</li>
</ul>
</div>
<div class="grid_3"  id="listing_overview">
<ul>
<li style="list-style-type:none"><?php echo $gbizObj->getPkg($package);?></li>
<li style="list-style-type:none"><?php echo $gbizObj->getStatus($status);?></li>
<li style="list-style-type:none"><?php echo $date_submitted;?></li>
<li style="list-style-type:none"><?php echo $date_expire;?></li>
</ul>
</div>
</div>
</body>
</html>