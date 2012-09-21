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
<meta name="description" content="Listing Plans" />
<meta name="keywords" content="affordable listing plans, free listing services">
<!-- Le styles -->
<link href="public/css/bootstrap.css" rel="stylesheet">
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/reset.css" rel="stylesheet">
<link href="public/css/style.css" rel="stylesheet">
<link href="public/css/ad.css" rel="stylesheet">
<link href="public/css/listing_plans.css" rel="stylesheet">

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
          <div id="pkg">
          <form id="order_form" method="post" action="includes/process_select_listing_plan.php">
            <Button name="btn_bronze" class="btn btn-primary">Verify</Button>
            </form>
          </div>
          <div id="pkg">
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="notify_url" value="http://places.webuda.com/includes/payment.php">
              <input type="hidden" name="return" value="http://places.webuda.com/payment_success.php">
              <input type="hidden" name="cancel_return" value="http://places.webuda.com/payment_cancelled.php">
              <input type="hidden" name="cmd" value="_xclick">
              <input type="hidden" name="business" value="odwlbs_1347087733_biz@gmail.com">
              <input type="hidden" name="lc" value="US">
              <input type="hidden" name="item_name" value="Silver Package">
              <input type="hidden" name="item_number" value="1">
              <input type="hidden" name="amount" value="200.00">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="UseSandbox" value="true">
              <input type="hidden" name="button_subtype" value="services">
              <input type="hidden" name="no_note" value="0">
              <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
              <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"/>
            </form>
          </div>
          <div id="pkg">
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="notify_url" value="http://places.webuda.com/includes/payment.php">
              <input type="hidden" name="return" value="http://places.webuda.com/payment_success.php">
              <input type="hidden" name="cancel_return" value="http://places.webuda.com/payment_cancelled.php">
              <input type="hidden" name="cmd" value="_xclick">
              <input type="hidden" name="business" value="odwlbs_1347087733_biz@gmail.com">
              <input type="hidden" name="lc" value="US">
              <input type="hidden" name="item_name" value="Gold Package">
              <input type="hidden" name="item_number" value="1">
              <input type="hidden" name="amount" value="400.00">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="UseSandbox" value="true">
              <input type="hidden" name="button_subtype" value="services">
              <input type="hidden" name="no_note" value="0">
              <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
              <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"/>
            </form>
          </div>
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
<script src="public/js/bootstrap/bootstrap-button.js"></script>
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>
