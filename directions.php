<?php @session_start();?>
<?php require_once('includes/init.php');?>
<?php require_once('includes/process_view_directions.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?php echo SITE_URL;?>/" />
<title><?php echo $title;?> : Maps & Directions - <?php echo DOMAIN_NAME;?></title>
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
    <link href="public/css/listing.css" rel="stylesheet">
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
 <script src="http://maps.google.com/?file=api&amp;v=2&amp;key=<?php echo GOOGLE_MAP_API_KEY;?>"></script>
 
<script type="text/javascript">
 
    var map;
    var gdir;
    var geocoder = null;
    var addressMarker;

    function initialize() {
      if (GBrowserIsCompatible()) {      
        map = new GMap2(document.getElementById("map_canvas"));
        gdir = new GDirections(map, document.getElementById("directions"));
        GEvent.addListener(gdir, "addoverlay", onGDirectionsLoad);
        GEvent.addListener(gdir, "error", handleErrors);
		var to = document.dirForm.txtTo.value;
        setDirections("<?php echo $user_address;?>", to, "en_US");
      }
    }
    
    function setDirections(fromAddress, toAddress, locale) {
      gdir.load("from: " + fromAddress + " to: " + toAddress,
                { "locale": locale });
    }

    function handleErrors(){
   if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
     alert("No corresponding geographic location could be found for one of the specified addresses. This may be due to the fact that the address is relatively new, or it may be incorrect.");
   else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
     alert("A geocoding or directions request could not be successfully processed.");
   else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
     alert("Input addresses may be missing");
   else if (gdir.getStatus().code == G_GEO_BAD_KEY)
     alert("The given key is either invalid.");
   else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
     alert("A directions request could not be successfully parsed.");
   else alert("An unknown error occurred. May be too long distance.");
    }

  function onGDirectionsLoad(){ 
   var poly = gdir.getPolyline();
   if (poly.getVertexCount() > 100) {
     //alert("This route has too many vertices");
     return;
   }
   var baseUrl = "http://maps.google.com/staticmap?";

   var params = [];
   var markersArray = [];
   markersArray.push(poly.getVertex(0).toUrlValue(5) + ",reda");
   markersArray.push(poly.getVertex(poly.getVertexCount()-1).toUrlValue(5) + ",redb");
   params.push("markers=" + markersArray.join("|"));

   var polyParams = "rgba:0x0000FF80,weight:3|";
   var polyLatLngs = [];
   for (var j = 0; j < poly.getVertexCount(); j++) {
     polyLatLngs.push(poly.getVertex(j).lat().toFixed(5) + "," + poly.getVertex(j).lng().toFixed(5));
   }
   params.push("path=" + polyParams + polyLatLngs.join("|"));
   params.push("size=300x300");
   params.push("key=<?php echo GOOGLE_MAP_API_KEY;?>");

   baseUrl += params.join("&");

  
}

    </script> 
</head>

<body onload="initialize()" onunload="GUnload()">

<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  
  <?php require_once('templates/header.php');?>
  
  <?php require_once('templates/linkbar.html');?>

   <div class="grid_17">
   <div class="grid_17" id="main_wrapper"><!--Begins main wrapper-->
  
  
  <div class="grid_17" id="page_content">
  	  <div id="dir_general">
      <ul>
      <li id="title"><h1><a href="<?php echo SITE_URL;?>/listing/<?php echo $safeTitle;?>-<?php echo $lid;?>.html"><?php echo $title;?></a></h1></li>
      <li><i><?php echo $mainCategory;?>, <?php echo $subCategory;?></i></li>
      <li><?php echo $phone;?></li>
      <li><b><?php echo $street;?>,  <?php echo $city;?>,  <?php echo $country;?></b></li>
      </ul>
      </div>
      
       <div  id="map_canvas" class="grid_16"></div>
  </div>
  
	
   </div>
   </div>
 
   <div class="grid_6" id="sec_col">
   <div class="grid_6">
   <form action="#" class="form-inline" name="dirForm" onsubmit="setDirections(this.txtFrom.value, this.txtTo.value); return false">
   <div class="control-group">
            <label class="control-label" for="input01">From(A)</label>
            <div class="controls">
              <input type="text" class="input-large" id="txtFrom" name="txtFrom" value="<?php echo $user_address;?>">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input02">To(B)</label>
            <div class="controls">
              <input type="text" class="input-large" id="txtTo" name="txtTo" value="<?php echo $street;?>,<?php echo $city;?>,<?php echo $country;?>">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input02"></label>
            <div class="controls">
              <button class="btn btn-primary" name="btnDir">Get Directions</button>
            </div>
          </div>
   </form>
   </div>
   
   <div id="directions" class="grid_6" style="overflow-y:auto;height:505px;"></div>
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
