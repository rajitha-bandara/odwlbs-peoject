<?php @session_start();?>
<?php 
require_once('includes/init.php');
require_once('includes/process_search.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
<?php 
if($flag == "new_search" || $flag = "incomplete_search")
{
	echo DOMAIN_NAME. " Search Engine";
}
else
{
	echo $_GET['city']. " ". $_GET['q']. " | ". $_GET['q']." in ". $_GET['city']. " - " .DOMAIN_NAME;
}
?>
</title>
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
<link href="public/css/search.css" rel="stylesheet">
<link href="ratingfiles/ratings.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="public/icons/favicon.ico">
<script src="public/js/jquery.js"></script>
<script src="public/js/bpopup-0.6.0.min.js"></script>
<script src="ratingfiles/ratings.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
 	 setTimeout("getRtgsElm()", 88);  
	});
	</script>
<script src="public/js/functions.js"></script>
<?php require_once('includes/geo_location_all.php');?>
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
<?php require_once('includes/ga_property_id.php');?>
</head>
<body>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <div class="grid_17">
    <div id="main_wrapper" class="grid_17">
      <!--Begins main wrapper-->
      <div id="page_topic">
        <h1><?php echo $topic; ?></h1>
      </div>
      <div class="grid_17" style="min-height:500px;">
        <?php 
	
    //begins display search results
	echo $results;
	?>
        <div id="pagination">
          <?php  echo $pagination; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="grid_6" id="sec_col">
    <div id="related_searches">
      <div id="heading">Found near <?php echo $user_address;?></div>
      <div id="content">
        <ul>
          <?php
   echo $gbizObj->fetchListingsByLocation($user_lat,$user_long,20);
   ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<?php require_once('templates/popup_email.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>
