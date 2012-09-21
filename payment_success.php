<?php @session_start();?>
<?php require_once('includes/init.php'); ?>
<?php
if(isset($_POST['txn_id']))
{
	
	$item=$_POST['item_name'];
	if($item == 'Gold Package')
	{
		session_register('req_pkg');
		$_SESSION['req_pkg'] = "gold";
		
	}
	else if($item == 'Silver Package')
	{
		session_register('req_pkg');
		$_SESSION['req_pkg'] = "silver";
		
	}
}
else
{
	header('Location: '.SITE_URL.'/listing_plans.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo DOMAIN_NAME;?>Payments</title>
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
<body>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <div class="grid_17">
    <div class="grid_17" id="main_wrapper">
      <!--Begins main wrapper-->
      <div id="page_topic">
        <h1>Payment Success!</h1>
      </div>
      <div class="grid_17" id="page_content">
        <h1>Thank you for purchasing our
          <?php $item;?>
        </h1>
        <p>Click <a href="add_listing.php">here</a> to proceed with your listing/p>
      </div>
    </div>
  </div>
  <div class="grid_6"></div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
