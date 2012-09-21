<?php @session_start();?>
<?php require_once('includes/init.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>About<?php echo DOMAIN_NAME;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="About <?php echo DOMAIN_NAME;?> online directory." />
<meta name="keywords" content="business directory, local, search, business listings, maps, driving directions, location based search, lbs, user reviews, ratings">
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
        <h1>About us</h1>
      </div>
      <div class="grid_17"> 
      <div style="padding:10px;padding-right:10px;text-align:justify;min-height:500px;">
     <?php echo DOMAIN_NAME;?> business Directory is a global online business directory listing and Internet resource.  Our business listing database is organized into a proprietary structure that yields search results in a manner particularly useful for search engines.  Our business directory is unique with location based advertising features. It's quick and easy for you to find local businesses, service providers, retailers and organizations.  Each one is listed with full contact details, Google maps, directions, an online business community and reviews and ratings delivered for your convenience.<br><br>
  
All submitted sites are reviewed before approval.  We do not use volunteer editors so your site will be indexed by our editorial team.  Our editorial team makes great effort to evaluate the existence and accuracy of each company web site.  Please read the house rules and optimization tips to ensure your business listing is approved.  
<br><br>
Although you can use this local business directory to locate your businesses and services, you will also be able to find them on all the major search engines making it simple and easy to locate quickly and also increasing your internet traffic to your website.
<br><br>
If you want to promote your business and services then feel free to add your details to <?php echo DOMAIN_NAME;?> business Directory.
If you have a suggestion on how we can improve this site then we would like to hear from you too.
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
