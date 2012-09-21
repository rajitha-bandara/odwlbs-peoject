<?php @session_start();?>
<?php 
require_once('includes/init.php');

?>
<?php
$status = "unknown";
$place_type = "";
if(isset($_POST['btnPlaces']))
{
	$status = "known";
	$place_type = $_POST["list_places_types"];
	$radius = $_POST["list_raius"];
	$radius = convertMilesToMeters($radius);
}	

if(isset($_POST['btnPlacesMore']))
{
	$status = "known";
	$radius = $_POST["list_raius"];
	$radius = convertMilesToMeters($radius);
	
	if(isset($_POST["txtPlaceType"]) && $_POST["txtPlaceType"] != null)
	{
		$place_type = $_POST["txtPlaceType"];
		$place_type = resolvePlaceType($place_type);
		
	}
	else
	{
		$place_type = $_POST["rbPlaceType"];
	}
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Find<?php echo $place_type;?>near you-<?php echo DOMAIN_NAME;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Find Near places. What is near by " />
<meta name="keywords" content="what is near me, near places, near supermarkets, near shops, near gas stations,  near hospitals, near night clubs">
<!-- Le styles -->
<link href="public/css/bootstrap.css" rel="stylesheet">
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/reset.css" rel="stylesheet">
<link href="public/css/style.css" rel="stylesheet">
<link href="public/css/ad.css" rel="stylesheet">
<link href="public/css/jquery.autocomplete.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="public/icons/favicon.ico">
<?php require_once('includes/geo_location_all.php');?>
<script src="public/js/jquery.js"></script>
<script src="public/js/bpopup-0.6.0.min.js"></script>
<script src="public/js/functions.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script src="public/js/jquery.autocomplete.js"></script>
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
#map {
	height: 400px;
	width: 600px;
	border: 1px solid #333;
	margin-top: 20px;
	margin-bottom:50px;
	margin-left:10px;
}
</style>
<script type="text/javascript">
      var map;
      var infowindow;

      function initialize() {
        var pyrmont = new google.maps.LatLng(<?php echo $user_lat;?>,<?php echo $user_long;?>);

        map = new google.maps.Map(document.getElementById('map'), {
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: pyrmont,
          zoom: 15
        });

        var request = {
          location: pyrmont,
          radius: <?php echo $radius;?>,
          types: ['<?php echo $place_type;?>']
        };
        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.search(request, callback);
      }

      function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }

      google.maps.event.addDomListener(window, 'load', initialize);
	  	  
    </script>
<script>
  $(document).ready(function(){
    var data = "Accounting/Airport/Amusement Park/Aquarium/Art Gallery/Atm/Bakery/Bank/Bar/Beauty Salon/Bicycle Store/Book Store/Bowling Alley/Bus Station/Café/Campground/Car Dealer/Car Rental Car Repair/Car Wash/Casino/Cemetery/Church/City Hall/Clothing Store/Convenience Store/Courthouse/Dentist/Department Store/Doctor/Electrician/Electronics Store/Embassy/Establishment/Finance/Fire Station/Florist/Food/Funeral Home/Furniture Store/Gas Station/General Contractor/Grocery/Gym/Hair Care/Hardware Store/Health/Hindu Temple/Home Goods Store/Hospital/Insurance Agency/Jewelry Store/Laundry/Lawyer/Library/Liquor Store/Local Government Office/Locksmith/Lodging/Meal Delivery/Meal Takeaway/Mosque/Movie Rental/Movie Theater Moving Company/Museum/Night Club/Painter/Park/Parking/Pet Store/Pharmacy/Physiotherapist/Place Of Worship/Plumber/Police/Post Office/Real Estate Agency/Restaurant/Roofing Contractor/Rv Park/School/Shoe Store/Shopping Mall/Spa/Stadium/Storage/Store/Subway Station/Supermarket/Synagogue/Taxi Stand/Train Station/Travel Agency/University/Veterinary/Care Zoo".split("/");
$("#txtPlaceType").autocomplete(data);
  });
  </script>
<?php require_once('includes/ga_property_id.php');?>
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
        <?php 
  if($status == "known")
  {
     echo "<h1>Find ". $place_type ." near you</h1>";
  }
  else
  {
	  echo "<h1>Find places near you</h1>";
  }
  ?>
      </div>
      <div id="map" class="grid_16"></div>
    </div>
  </div>
  <div class="grid_6" id="sec_col" style="background-color:#000;color:#FFF;">
    <div id="find_near">Find near by</div>
    <form action="" method="post">
      <ul class="">
        <li>
          <input name="rbPlaceType" type="radio" value="airport" />
          Airport </li>
        <li>
          <input name="rbPlaceType" type="radio" value="bank" />
          Bank </li>
        <li>
          <input name="rbPlaceType" type="radio" value="casino" />
          Casino </li>
        <li>
          <input name="rbPlaceType" type="radio" value="food" />
          Food </li>
        <li>
          <input name="rbPlaceType" type="radio" value="hospital" />
          Hospital </li>
        <li>
          <input name="rbPlaceType" type="radio" value="pharmacy" />
          Pharmacy </li>
        <li>
          <input name="rbPlaceType" type="radio" value="university" />
          University </li>
        <li>
          <input name="txtPlaceType" type="text" class="input-medium" style="margin-bottom:10px;margin-top:10px;" id="txtPlaceType" />
        </li>
      </ul>
      Distance(in miles)
      <select name="list_raius" class="input-medium">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">25</option>
        <option value="25">25</option>
        <option value="30">30</option>
      </select>
      <br>
      <button type="submit" class="btn btn-primary" name="btnPlacesMore" style="margin-bottom:23px;" onClick="track_find_near_places_more()">Map It</button>
    </form>
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
