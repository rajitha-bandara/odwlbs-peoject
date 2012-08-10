<?php @session_start();?>
<?php require_once('includes/init.php');?>
<?php require_once('includes/process_geo_location_change_request.php');?>
<?php //require_once('includes/process_newsletter_sign_up.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo DOMAIN_NAME;?> :: Home Page</title>
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
    <link href="public/css/presentationCycle.css" rel="stylesheet">
    <link href="public/css/ad.css" rel="stylesheet">
   	<link href="public/css/jquery.fancybox.css?v=2.0.6" rel="stylesheet">
    <link href="ratingfiles/ratings.css" rel="stylesheet">
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
    
    <script src="public/js/jquery.tabSlideOut.v1.3.js"></script>      
    <script src="public/js/jquery.cycle.all.min.js"></script>
	<script src="public/js/presentationCycle.js"></script>  
	<script src="ratingfiles/ratings.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){
 	 setTimeout("getRtgsElm()", 88);  
	});
	</script>
	<script src="public/js/functions.js"></script>
	
     
     <script type="text/javascript">
        var emailEntered;

        $(document).ready(function() {
            $("#btnSignupEmail").click(function() {
                    $(".error").hide();
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    var emailaddressVal = $("#txtSignupEmail").val();

                    if(emailaddressVal == '') {
                        $("#signup-response").html('<span class="error">Enter your email address!</span>');
                        return false; 
                    }
                    else if(!emailReg.test(emailaddressVal)) {
                        $("#signup-response").html("<span class='error'>Invalid email address!</span>");
                        return false; 
                    } 
                    else {
                        emailEntered = escape($('#txtSignupEmail').val());
                    }

                    

            });
            $('#signup').submit(function() {
                $("#signup-response").html("<span class='status'>Adding your email address...</span>");
                $.ajax({
                    url: 'includes/mailchimp/inc/store-address.php', // proper url to your "store-address.php" file
                    data: 'ajax=true&email=' + emailEntered,
                    success: function(msg) {
                        $('#signup-response').html("<span class='status'>" + msg + "</span>");
                    }
                });
                return false;
            });
        });
    </script>
    
    
	<style type="text/css">
	#signup-response {
	display:inline;
	margin-left:4px;
	padding-left:0px;
	font-size:12px;
	}
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
  <?php require_once('templates/user_geo_data.php');?>
  
  <div class="grid_17">
  <div id="category_wrapper" class="grid_17" style="background-color:#000;">
  <?php require_once('templates/slide_show.html');?>
 
  </div>
  </div>
  
  <div class="grid_6" id="right-col" style="background-color:#000;color:#FFF">
  <div id="find_near">Find near by</div>
  <form action="maps.php" method="post" target="_blank">
  <select name="list_places_types" class="input-medium" id="list_places_types">
  <option value="airport">Airport</option>
  <option value="bank">Bank</option>
  <option value="casino">Casino</option>
  <option value="food">Food</option>
  <option value="hospital">Hospital</option>
  <option value="pharmacy">Pharmacy</option>
  <option value="travel_agency">Travel Agency</option>

  </select>
  <br>
  Distance(in miles)
  <select name="list_raius" class="input-medium" id="list_raius">
  <option value="5">5</option>
  <option value="10">10</option>
  <option value="15">15</option>
  <option value="20">25</option>
  <option value="25">25</option>
  <option value="30">30</option>
  </select>
  <br><br>
  <button type="submit" class="btn btn-primary" name="btnPlaces" style="margin-bottom:35px;" onClick="track_find_near_places();">Map It</button>
  </form>
  <a id="map_places_more" href="maps.php" target="_blank">View more Places</a>
  </div>
  
  <div class="clear"></div>
 
  <div class="grid_17">
  <?php require_once('templates/featured_ads.php');?>
  <div class="clear"></div>
  <?php require_once('templates/popular_biz.php');?>
  </div>
  
  <div class="grid_6" id="right-col">
  
    <div id="new_biz">
    <div id="right_column_topic">Recent Listings</div>
    
   <?php require_once('templates/recent_listings.php');?>
        <div class="clear"></div>  
    </div>
    
    
    <div id="newsletter">
    <div id="right_column_topic">Subscribe to newsletter</div>
    <!--<form method="post" action="?action=signup_for_newsletter" id="newsletter-signup">
    <div id="email_signup_des">
    Sign up for free business newsletters to stay updated about latest information from businesses and companies world wide: 
    </div>
          <div class="control-group">
            <input type="text" class="input-large" id="txtSignupEmail" name="txtSignupEmail" value="" placeholder="Email Address">
            <div class="controls">
              
               <button class="btn btn-primary" name="btnSignupEmail" id="btnSignupEmail">Sign Up</button>
            </div>
          </div>
          
          <div id="signup-response"></div>
        </form>-->
        
        <!--mailchimp-->
        <form method="get" action="index.php" id="signup">
    <div id="email_signup_des">
    Sign up for free business newsletters to stay updated about latest information from businesses and companies world wide: 
    </div>
          <div class="control-group">
            <input type="text" class="input-large" id="txtSignupEmail" name="txtSignupEmail" value="" placeholder="Email Address">
            <div class="controls">
              
               <button class="btn btn-primary" name="btnSignupEmail" id="btnSignupEmail">Sign Up</button>
            </div>
          </div>
          
          <div id="signup-response"></div>
        </form>
        <!--mailchimp-->
           <?php require_once('templates/share_this.html'); ?>
    </div> <!--End of newsletter-->
    
    <!--<div class="advertisement"><img src="public/img/2.jpg"></div>
    <div class="advertisement"><img src="public/img/1.jpg"></div>-->
    
  </div>
 
  
  
 <div class="clear"></div>
  <?php require_once('templates/footer.php');?>

</div>

 <?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
   <script src="public/js/bootstrap/bootstrap-button.js"></script>
    <script type="text/javascript" src="public/js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="public/js/jquery.fancybox.js?v=2.0.6"></script>
<script type="text/javascript">
  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/GFHX9zugpCB23PSqLy8Q.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();
</script>       
</body>
</html>
