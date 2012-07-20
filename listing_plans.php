<?php @session_start();?>
<?php 
require_once('includes/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Selct Your Listing Plan at<?php echo DOMAIN_NAME;?></title>
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
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
<link rel="apple-touch-icon-precomposed" href="">
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
#wrapper_plans {
	padding:0;
	display: table;
	border: 1px solid black;
}
#wrapper_plans #row , #wrapper_plans_order #row {
	margin-bottom:5px;
	
	vertical-align:top;
	display: table-row;
	border:1px solid #000;
	height:32px;
}
#wrapper_plans_order {
	padding:0;
	display: table;
	padding-top:10px;
	padding-bottom:20px;
	margin-bottom:50px;
	border: 1px solid black;
}
#wrapper_plans #row_price {
	
	
	background-color:#FC0;
	vertical-align:middle;
	display: table-row;
	
}
#wrapper_plans #row_price #item {
	width:200px;
	display: table-cell;
	padding-left:20px;
}
#wrapper_plans #row_price #price {
	width:150px;
	display: table-cell;
	font-weight:bold;
}
#wrapper_plans #row_price #price button {
	width:80px;
	text-align:center;
	background-color:#000;
	font-weight:bold;
	color:#FFF;
}
#wrapper_plans #row_topic {
	margin-left:5px;
	margin-top:5px;
	margin-bottom:10px;
	font-weight:bold;
}
#wrapper_plans #row #item , #wrapper_plans_order #row #item {
	width:200px;
	display: table-cell;
	padding-left:20px;
}
#wrapper_plans #row #pkg , #wrapper_plans_order #row #pkg{
	width:150px;
	display: table-cell;
	font-weight:bold;
}

#wrapper_plans #row #order_form #pkg {
	width:150px;
	display: table-cell;
	font-weight:bold;
}
#wrapper_plans #row #pkg img {
	margin-right:5px;
}
#middle {
	padding: 1em;
	background:yellow;
	display: table-cell;
}
</style>
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
        <h1>Listing Plans</h1>
      </div>
      <div class="grid_17" style="padding:10px;padding-right:10px;"></div>
      <div id="wrapper_plans">
        <div id="row">
          <div id="item"></div>
          <div id="pkg"><img src="public/img/star-orange48.png" width="48" height="48" alt="Bronze">Bronze</div>
          <div id="pkg"><img src="public/img/star-white48.png" width="48" height="48" alt="Silver">Silver</div>
          <div id="pkg"><img src="public/img/star-gold48.png" width="48" height="48" alt="Gold">Gold</div>
        </div>
        <div id="row_topic">Default Options</div>
        <div id="row">
          <div id="item">Listing Title</div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        <div id="row">
          <div id="item">Address</div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        <div id="row">
          <div id="item">Contact Details</div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        <div id="row">
          <div id="item">Category Selection</div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        <div id="row">
          <div id="item">Social Sharing</div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        <div id="row_topic">Additional Options</div>
        <div id="row">
          <div id="item">Maps,Directions</div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Ratings,Reviews</div>
          <div id="pkg"></div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Product Samples</div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Web Site Address</div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Social Site Links</div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Listing Description(characters)</div>
          <div id="pkg">100</div>
          <div id="pkg">500</div>
          <div id="pkg">1000</div>
        </div>
        
        <div id="row">
          <div id="item">Articles</div>
          <div id="pkg"></div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Events</div>
          <div id="pkg"></div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Ad - Home Page</div>
          <div id="pkg"></div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Ad - Inside Pages</div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row">
          <div id="item">Ad - Search Pages</div>
          <div id="pkg"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
          <div id="pkg"><img src="public/img/tick32_32.png" width="24" height="24"></div>
        </div>
        
        <div id="row_price">
          <div id="item">Price</div>
          <div id="price">Free</div>
          <div id="price">$200/Yr</div>
          <div id="price">$400/Yr</div>
        </div>
       
      </div>
      


      <div id="wrapper_plans_order">
      <div id="row">
        <div id="item"></div>
        <form id="order_form" method="post" action="includes/process_select_listing_plan.php">
          <div id="pkg"><Button name="btn_bronze" class="btn btn-primary">Verify</Button></div>
          <div id="pkg"><Button name="btn_silver" class="btn btn-primary">Order</Button></div>
          <div id="pkg"><Button name="btn_gold" class="btn btn-primary">Order</Button></div>
          </form>
        </div>
        </div>
        
    </div>
  </div>
  <div class="grid_6" id="sec_col"></div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/bootstrap/bootstrap-button.js"></script>
</body>
</html>
