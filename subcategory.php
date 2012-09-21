<?php @session_start();?>
<?php require_once('includes/init.php');?>
<?php require_once('includes/process_view_subcategory.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?php echo SITE_URL;?>/" />
<title><?php echo $categoryName ." - ".DOMAIN_NAME;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="<?php echo $categoryName;?>">
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
<?php require_once('includes/geo_location_all.php');?>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <div class="grid_17">
    <div id="main_wrapper" class="grid_17">
      <!--Begins main wrapper-->
      <div id="page_topic">
        <h1><?php echo $categoryName;?></h1>
      </div>
      <!--begins directory-->
      <div class="grid_17" id="categories">
        <div id="sub_cat"> </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <!--End of directory-->
  <div class="grid_6">
    <?php require_once('templates/right_column.php');?>
  </div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>
