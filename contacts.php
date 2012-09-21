<?php @session_start();?>
<?php 
require_once('includes/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo DOMAIN_NAME;?> Contacts</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Contacts <?php echo DOMAIN_NAME;?>" />
<meta name="keywords" content="<?php echo DOMAIN_NAME;?> contacts">
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
        <h1>Contact us</h1>
      </div>
      <div class="grid_17" style="padding:10px;padding-right:10px;min-height:500px;">
        <h2>Customer Service :</h2>
        <i>Office Hours are Monday to Friday from 9.00am to 5.00pm</i><br>
        <p>Office : (094) 946-8139</p>
        <p>Email : <?php echo ADMIN_EMAIL;?></p>
        <h2>Sales and Advertising :</h2>
        <i>Banner and Bullet Advertising, Membership Upgrades, etc.</i><br>
        <p>Email : <?php echo ADMIN_EMAIL;?></p>
        <h2>Technical Support :</h2>
        <i>Having problems with using our site?</i><br>
        <p>Email : <?php echo ADMIN_EMAIL;?></p>
        <br>
        <br>
        <h3>You can chat with our agents live</h3>
        <h5>Use the chat widget at the bottom of this page</h5>
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
<!-- ClickDesk - <a href='http://www.clickdesk.com'> Live Chat Service </a> for websites -->
<script type='text/javascript'>
	var _glc =_glc || []; _glc.push('ag9jb250YWN0dXN3aWRnZXRyEAsSB3dpZGdldHMY0IWqBAw');
	var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/livily/browser/' : 
	'http://gae.clickdesk.com/livily/browser/');
	var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
	var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
	glcspt.async = true; glcspt.src = glcpath + 'livechat.js';
	var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
</script>
<noscript>
<p><a href='http://gae.clickdesk.com/clickdeskchat.jsp?widget_id=ag9jb250YWN0dXN3aWRnZXRyEAsSB3dpZGdldHMY0IWqBAw'>HelpDesk Software</a></p>
</noscript>
<!-- End of ClickDesk -->
</body>
</html>
