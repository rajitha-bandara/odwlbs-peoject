<?php @session_start();?>
<?php 
require_once('includes/init.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
    
	<link href="public/css/ad.css" rel="stylesheet">    
<title>Untitled Document</title>
<style type="text/css">

</style>
</head>

<body>

 <?php
$coords =  getNearLatLong(7.81,79.56,20);
if(count($coords) == 4)
{
	$minLat = $coords[0];
	$maxLat = $coords[1];
	$minLon = $coords[2];
	$maxLon = $coords[3];
}
	?>
    
</body>
</html>