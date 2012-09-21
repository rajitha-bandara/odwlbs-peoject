<?php @session_start();?>
<?php 
require_once('includes/init.php');
?>
<?php
$latitude = $_GET['lat'];
$longitude = $_GET['lon'];
$lid =  $_GET['lid'];
$title = $_GET['title'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Maps -<?php echo DOMAIN_NAME;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="public/css/bootstrap.css" rel="stylesheet">
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/reset.css" rel="stylesheet">
<link href="public/css/style.css" rel="stylesheet">
<link href="public/css/ad.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="public/icons/favicon.ico">
<script src="public/js/jquery.js"></script>
<script src="public/js/bpopup-0.6.0.min.js"></script>
<script src="public/js/functions.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">



function loadMap()
{
	var latlng = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
	var opt =
	{
	  center:latlng,
	  zoom:10,
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	  disableAutoPan:false,
	  navigationControl:true,
	  navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL },
	  mapTypeControl:true,
	  mapTypeControlOptions: {style:google.maps.MapTypeControlStyle.DROPDOWN_MENU}
	};
	var map = new google.maps.Map(document.getElementById("large_map"),opt);
	var marker= new google.maps.Marker({
	position: new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>),
	title: "<?php echo $title;?>",
	clickable: true,
	map: map
	});
	
	var infowindow = new google.maps.InfoWindow(
	{
	content: "<?php echo $title;?>"
	
	});
	
	google.maps.event.addListener(marker,'click',function(){
	infowindow.open(map,marker);
	});
}
</script>
<style type="text/css">
.response-waiting {
	background:url(public/img/loading_small.gif) no-repeat;
}
.response-success {
	background:url(public/img/tick.png) no-repeat;
}
.response-error {
	background:url(public/img/cross.png) no-repeat;
}
</style>
</head>
<body onLoad="loadMap()">
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <div id="page_body">
    <!--Begins main wrapper-->
    <div id="page_topic">
      <h1><a href="<?php echo SITE_URL;?>/listing/<?php echo $title;?>-<?php echo $lid;?>.html">Maps of <?php echo $title;?> on <?php echo DOMAIN_NAME;?></a></h1>
      </div>
    <div id="large_map" align="center"></div>
  </div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/uservoice_feedback.js"></script>
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>
