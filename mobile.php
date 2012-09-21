<?php @session_start();?>
<?php require_once('includes/init.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo DOMAIN_NAME;?> on your mobile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Plmobile App from  <?php echo DOMAIN_NAME;?>. Plmobile is an Android App with  rich location based services" />
<meta name="keywords" content="Plmobile, <?php echo DOMAIN_NAME;?> mobile app, lbs apps, lbs android">
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
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
<?php require_once('includes/ga_property_id.php');?>
<body>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <div class="grid_17">
    <div id="main_wrapper" class="grid_17">
      <!--Begins main wrapper-->
      <div id="page_topic">
        <h1>Make it mobile. Find Local listings</h1>
         <h3>Dowaload our latest mobile app!</h3>
      </div>
      <div class="grid_17" style="padding:10px;padding-right:10px;min-height:500px;">
      <div class="grid_6"><img src="public/img/android-app.jpg"></div>
      <div class="grid_10" style="margin-left:20px;text-align:justify;">
      Plmobile® products turn your mobile device into a powerful local guide that brings you everyday saving. Search  businesses quickly by typing or browsing popular categories including gas prices, restaurants, bars, hotels, mechanics, dentists. <br><br>

Find businesses faster with predictive text, and quick links to top categories. The auto-complete feature remembers your favorite search terms making it easier to access past or favorite (pick one) on-the-go. Get the scoop from other locals, access comprehensive business listings including ratings, reviews, business details, open hours, or click to the website.
<br><br>

Store your favorite businesses, deals and event to "My Stuff" for easy access. Share business details and deals with friends via text, email, Facebook or Twitter.<br><br>
      </div>
  <div class="clear"></div>
 <div class="grid_6" style=""> 
 <img src="public/img/android_market_logo.png" width="200" height="70">
 </div>    
      
      </div>
    </div>
  </div>
  <div class="grid_6">
    <?php require_once('templates/right_column.php');?>
  </div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>
