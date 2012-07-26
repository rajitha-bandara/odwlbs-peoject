<?php @session_start();?>
<?php require_once('includes/init.php');?>
<?php require_once('includes/process_view_listing.php');?>

<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/LocalBusiness">
<head>
<base href="http://localhost/business_directory/" />
<title><?php echo $title ." - ". DOMAIN_NAME;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta itemprop="name" content="<?php echo $title ." - ". DOMAIN_NAME;?>">
<meta itemprop="description" content="">
<!-- Le styles -->
<link href="public/css/bootstrap.css" rel="stylesheet">
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/reset.css" rel="stylesheet">
<link href="public/css/style.css" rel="stylesheet">
<link href="public/css/listing.css" rel="stylesheet">
<link href="public/css/ad.css" rel="stylesheet">
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
<script src="ratingfiles/ratings.js"></script>
 <script type="text/javascript">
	$(document).ready(function(){
 	 setTimeout("getRtgsElm()", 88);  
	});
	</script>
<script src="public/js/functions.js"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


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
	var map = new google.maps.Map(document.getElementById("map"),opt);
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

</head>
<body onLoad="loadMap()">
<!--Load Facebook JS SDK. Keep the code immediately under <BODY>-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo FACEBOOK_APP_ID;?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <div class="grid_17">
    <div id="listing_wrapper" class="grid_17">
      <!--Begins listing wrapper-->
      <div class="grid_17" id="listing_share_bar">
        <div id="share_out" class="grid_13"> <a class='email_popup' href='#' > <img src='public/img/social/email_small.png' title='Email this information' /></a> <a onClick=\"window.open('http://www.facebook.com/sharer.php?s=100&p[title]=$title on $domain_name &p[summary]=$summary&p[url]=$listing_url&&p[images][0]=$image','sharer','toolbar=0,status=0,width=548,height=325');\" href='javascript: void(0)'><img src='public/img/social/facebook_share_small.png' title='Share on Facebook' /></a> <a href='http://twitter.com/share?text=$summary&url=$listing_url' target='_blank'> <img src='public/img/social/twitter_share_small.png' title='Share on Twitter' /></a>  </div>
        
        <div id="share_in" class="grid_3"> 
        <a href="javascript:bookmark('window.location.href','<?php echo $title;?>, - <?php echo DOMAIN_NAME;?>');"><img src="public/img/social/bookmark.png" width="16" height="16" alt="Add to Bookmarks" title="Bookmark"></a>
        <script src="http://cdn.printfriendly.com/printfriendly.js" type="text/javascript"></script><a href="http://www.printfriendly.com"  class="printfriendly" onclick="window.print(); return false;" title="Print"><img src="http://cdn.printfriendly.com/pf-print-icon.gif" alt="Print"/></a>
        <a href="http://www.printfriendly.com" class="printfriendly" onclick="window.print(); return false;" title="PDF">
        <img  src="http://cdn.printfriendly.com/pf-pdf-icon.gif" alt="PDF"/></a>
        </div>
      </div> <!--Ends listing_share_bar-->
      
      <div class="grid_17" id="listing_general">
      <div class="grid_10">
      <div id="title"><h1><?php echo $title;?></h1></div>
      <div id="category">
      <ul>
      <li><?php echo $mainCategory;?></li>
      <li><?php echo $subCategory;?></li>
      </ul>
      </div>
      <div id="rating" >
      <div class="srtgs" id="rt_listing_<?php echo $lid;?>" <?php if($package == 'b' || $package == 's'){?> style="display:none" <?php }?>></div>
      </div>
      <div id="likeBox">
      <div class="fb-like" data-href="<?php echo currentPageURL();?>" data-send="true" data-layout="button_count" data-width="400" data-show-faces="false"></div>
      </div>
      <div id="google_plus">
       <!-- Place this tag where you want the +1 button to render -->
<g:plusone   href="<?php echo currentPageURL();?>"></g:plusone>

<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script> 
      </div>
       <div id="web" <?php if($package == 'b'){?> style="display:none" <?php }?>>
       <a href="<?php echo $web;?>" target="_blank">Visit Web Site</a>
       </div>
      </div>
      <div class="grid_7" id="logo">
        <?php echo $logo;?>
        </div>
      </div>
      
      <hr class="grid_17">
      <div id="contacts" class="grid_17">
      <div id="subheading">Contact information</div>
      <ul>
      <li class="grid_17">Email : <?php echo $email;?></li>
      <li class="grid_4">Phone : <?php echo $phone;?></li>
      <li class="grid_4">Fax : <?php echo $fax;?></li>
      <li class="grid_4">Mobile : <?php echo $mobile;?></li>
      <li class="grid_17">Contact Person : <?php echo $contactP;?></li>
      <li class="grid_3"><div id="follow" <?php if($package == 'b'){?> style="display:none" <?php }?>><a href=""><img src="public/img/social/facebook.png" width="32" height="32" alt="Find us on Facebook"></a></div></li>
      <li class="grid_3"><div id="follow" <?php if($package == 'b'){?> style="display:none" <?php }?>><a href=""><img src="public/img/social/twitter.png" width="32" height="32" alt="Find us on Facebook"></a></div> </li>
      </ul>
      </div>
      
      <hr class="grid_17">
      <div id="description" class="grid_17">
      <div id="subheading">Business Details</div>
      <?php echo $description;?>
      </div>
      
       <hr class="grid_17">
      <div id="media" class="grid_17">
      <div id="subheading" <?php if($package == 'b'){?> style="display:none" <?php }?>>Videos & Photos</div>
      <div class="grid_4"><img src="public/img/450845415_1328492_70x70.jpg" width="70" height="70"></div>
      <div class="grid_4"><img src="public/img/450845415_1328492_70x70.jpg" width="70" height="70"></div>
      <div class="grid_17">See more >></div>
      </div>
      
       <hr class="grid_17">
      <div id="location" class="grid_17">
      <div id="subheading">Location</div>
      
      <div class="grid_17"> <?php echo $street;?>,  <?php echo $city;?>,  <?php echo $country;?></div>
      <div class="grid_17">
      <a  
onclick="javascript:window.open('http://zms.zhiing.com/webclient/zhiingchat/zmschat2.aspx?addrTxt=<?php echo $street.", ".$city. ", ".$country; ?>&txtFrom=<?php echo DOMAIN_NAME;?>&txtSubject=<?php echo $title;?>&txtMessage=<?php echo "Received location details for ".$title;?>','zhiing','resizable=no,scrollbars=no,height=436,width=568,status=yes');">
 <img src='http://images.zoscomm.com/buttonv2.png' alt='Send to Phone' style='cursor: pointer' /> </a> 
      </div>
      </div>
      
       <hr class="grid_17">
      <div id="reviews" class="grid_17" <?php if($package == 'b' || $package == 's'){?> style="display:none" <?php }?>>
      <div id="subheading">Write a Review for <?php echo $title;?> </div>
      <div class="fb-comments" data-href="http://example.com" data-num-posts="5" data-width="600"></div>
      </div>
      
    </div>
  </div>
  
  <div class="grid_6" id="listing_sec_col">
  
  <div id="get_dir" <?php if($package == 'b'){?> style="display:none" <?php }?>><a href="http://localhost/business_directory/listing/directions/<?php echo $safeTitle;?>-<?php echo $lid;?>.html">Maps & Directions >></a></div>
  
  <div id="large_map_link" <?php if($package == 'b'){?> style="display:none" <?php }?>><a href="map_large.php?lat=<?php echo $latitude;?>&lon=<?php echo $longitude;?>"title=<?php echo $title;?>>View Large Map</a></div>
  <div id="map" <?php if($package == 'b'){?> style="display:none" <?php }?>></div>
  
  
      
  <div id="tweets" <?php if($package == 'b'){?> style="display:none" <?php }?>>
  <script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 4,
  interval: 30000,
  width: 230,
  height: 240,
  theme: {
    shell: {
      background: '#333333',
      color: '#140814'
    },
    tweets: {
      background: '#76c6e3',
      color: '#120612',
      links: '#f8faf7'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: false,
    behavior: 'default'
  }
}).render().setUser('twitter').start();
</script>
  </div>
  
  
  
  </div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
