<?php
/*
 *  Redirects the user to the specified URL  
 */

function redirect_to( $location = NULL ) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

/*
 *  Redirects the user to the specified URL  
 */

function redirect_to_on_error( $location = NULL ) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

/*
 *  Returns the string if not empty
*/
function output_message($message="") {
	if (!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	} else {
	return "";
	}
}

/*
 *  includes the specified template within the current page
*/
function include_layout_template($template="") {
	include(SITE_ROOT.DS.'templates'.DS.$template);
}

/*
 *  check File exists
*/
function isFileExists($path)
{
	if (file_exists($path))
		return true;
	else
		return false;
}

/*
 *  get image(s) with a given name
*/
function get_image($match,$dir)
{
  $files = opendir($dir);
  $i = 0;
  $images = array();
  $images = null;
  while($file = readdir($files)) 
  {
	  
	if(preg_match('/'.$match.'[(.png)|(.gif)|(.jpg)|(.jpeg)]/i',$file))
	{
		$images[$i] = $file;
		$i++;
	}
  }
  return $images;
}

/*
 *  get all image(s) from a given directory
*/
function get_any_image($dir)
{
  $files = opendir($dir);
  $i = 0;
  $images = array();
  $images = null;
  while($file = readdir($files)) 
  {
	  
	if(preg_match('/^([a-zA-Z0-9])+[(.png)|(.gif)|(.jpg)|(.jpeg)]/i',$file))
	{
		$images[$i] = $file;
		$i++;
	}
  }
  return $images;
}


/*
 *  Make URL safe by replacing special characters 
*/
function makeURLSafe($word)
{
	$word = trim($word);
	$word = strtolower($word);
	$word = stripslashes($word);
	$word = str_replace(" ","-",$word);
	$word = str_replace("/","-",$word);	
	$word = str_replace("+","-",$word);
	$word = str_replace(",","-",$word);
	$word = str_replace("'","-",$word);
	$word = str_replace(".","-",$word);
	$word = str_replace("@","-",$word);
	$word = str_replace("&","-",$word);
	$word = str_replace("---","-",$word);
	return $word;
}

/*
 *  Build a  result element and returns as a string
*/

function getResultHTML($where,$counter,$id,$title,$url,$phone,$street,$city)
{
$safeTitle = 	makeURLSafe($title);
$domain_name = DOMAIN_NAME;
//$listing_url = SITE_URL."/listing.php?lid=$id";
//$listing_url = SITE_URL."/listing/$safeTitle-$id.html";
$listing_url = "http://localhost/business_directory/listing/$safeTitle-$id.html";

$summary 	 = "I just checked out ".$title." on ".DOMAIN_NAME." and thought you would like it too. Read reviews, post your own, get coupons, maps and more. Have a look!";

$images = array();
$image = "";
$images = get_image("sample","biz/$id");
if($images != null)
{
	$photo = "<div id='photo' class='grid_2'><img src=biz/$id/".$images[0]." id='image'></div><div class='clear'></div>";
	$image = "<img src=biz/$id/".$images[0].">";
}

 return "<div id='listing' class='grid_17'>
  <div id='result_id' class='grid_1'>
  <div id='result_counter'>".$counter."</div>
  </div>
  <div id='result_info' class='grid_11'>
  <div id='title' class='grid_9'><a href='$listing_url'>".$title."</a></div><div class='clear'></div>
  ".$photo."
  <div id='location' class='grid_9'>".$street.", ".$city." >> Map</div>
   <div id='contacts' class='grid_9'>$phone</div>
    <div id='web' class='grid_12'><a href='http://$url' target='_blank'>$url</a>
</div>
  </div>
  <div id='rating_info' class='grid_4'>
  <div id='rating_bar'><div class='srtgs' id='rt_listing_$id'></div></div>
  </div>
  <div id='social_info' class='grid_17'>
  <div id='tags'>
  
  <a class='email_popup' href='#' >
<img src='public/img/social/email_small.png' title='Email this information' /></a>

  <a onClick=\"window.open('http://www.facebook.com/sharer.php?s=100&p[title]=$title on $domain_name &p[summary]=$summary&p[url]=$listing_url&&p[images][0]=$image','sharer','toolbar=0,status=0,width=548,height=325');\" href='javascript: void(0)'><img src='public/img/social/facebook_share_small.png' title='Share on Facebook' /></a>

<a href='http://twitter.com/share?text=$summary&url=$listing_url' target='_blank'>
<img src='public/img/social/twitter_share_small.png' title='Share on Twitter' /></a>


  </div>
  </div>
  </div>";		
	
		
	/*if(strlen($description)<100)
		echo '<p class="posted">'.$description.'</p>';
	else
		echo '<p class="posted">'.substr($description,0,100).'...</p>';*/
	
}

/*
 *  Format listing in HTML
 *  
*/
function formatListing($counter,$bizId,$title,$userId)
{
	$safeTitle = makeURLSafe($title);
	return 	"
      <div id='listing_row'>
  		<div id='counter' class='grid_1'>".$counter."</div>
  		<div id='title' class='grid_6'>".$title."</div>
  		<div id='view' class='grid_2'><a href='listing/$safeTitle-$bizId.html' target='_blank'><img src='public/img/lview.png'></a></div>
    	<div id='edit' class='grid_2'><a href='edit_listing.php?id=$userId&lid=$bizId' target='_blank'><img src='public/img/ledit.png'></a></div>
    	<div id='delete' class='grid_2'><a href='delete_listing.php?lid=$bizId' target='_blank'><img src='public/img/ldelete.png'></a></div>
  	  </div>
	<hr style='margin-top:10px;margin-bottom:10px;'>
	<div class='clear'></div>";  	
}

/*
 *  Format related search in HTML
 *  
*/
function formatRelatedSearch($counter,$bizId,$title)
{
	$safeTitle = makeURLSafe($title);
	$listing_url = "http://localhost/business_directory/listing/$safeTitle-$bizId.html";
	//$listing_url = SITE_URL."/listing/$safeTitle-$bizId.html";
	return 	"
	<li><a href='$listing_url'>".$title."</a></li>";
	
}

/*
 *  Format category in HTML
*
*/
function formatCategory($catId,$name)
{
	$safeCat = makeURLSafe($name);
	$category_url = "http://localhost/business_directory/$safeCat-$catId/";
	//$category_url = SITE_URL."/$safeCat-$catId/";
	return 	"
	<li><a href='$category_url'>".$name."</a></li>";

}

/*
 *  Format sub category in HTML
*
*/
function formatSubCategory($catId,$mainCat,$subCatId,$subCatName)
{
	$safeCat = makeURLSafe($mainCat);
	$safeSubCat = makeURLSafe($subCatName);
	$category_url = "http://localhost/business_directory/$safeCat-$catId/$safeSubCat-$subCatId";
	//$category_url = SITE_URL."/$safeCat-$catId/$safeSubCat-$subCatId";
	return 	"
	<li><a href='$category_url'>".$subCatName."</a></li>";

}

/*
 *  Format recent listing in HTML
*
*/
function formatRecentListing($bizId,$title,$mainCatId,$subCatId,$mainCat,$subCat)
{
	$safeTitle = makeURLSafe($title);
	$safeCat = makeURLSafe($mainCat);
	$safeSubCat = makeURLSafe($subCat);
	
	 $listing_url = "http://localhost/business_directory/listing/$safeTitle-$bizId.html";
     $mainCategory_url = "http://localhost/business_directory/$safeCat-$mainCatId/";
	 $subCategory_url = "http://localhost/business_directory/$safeCat-$mainCatId/$safeSubCat-$subCatId";
	
	//$listing_url = SITE_URL."/listing/$safeTitle-$bizId.html";
	//	$mainCategory_url = SITE_URL."/$safeCat-$mainCatId/";
	//	$subCategory_url = SITE_URL."/$safeCat-$mainCatId/$safeSubCat-$subCatId";

	return 	"
	<li style='border_bottom:1px sold #000'><div><div class='grid_6' id='title'><a href='$listing_url'>".$title."</a></div><div class='grid_6' id='info'><a href='$mainCategory_url'>".$mainCat."</a> ,<a href='$subCategory_url'>".$subCat."</a></div></div></li>";

}

/*
 *  Check the given string is longer than the given length
 *  If longer Split the string using that length 
*/

function getStringChunk($length,$str)
{
	if(strlen($str)<$length)
		return $str;
	else
		return substr($str,0,$length);
}


/*
 *  Iterate through the variables in the object
 *  Call escape_value() in each iteration
*/
/* function escape_all() {
	foreach($this as $var => $value) {
		echo "$var is $value\n";
	}
	} */


/*
 *  Returns current page URL
 *   
*/

function currentPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function convertMilesToMeters($dist)
{
	$ratio = 1.609344;
	$meters = $dist * $ratio * 1000;
	return $meters;

}

/*
 *  Calculate Latitude, Longitude range based on the given radius using Haversine formula
 *   
*/
function getNearLatLong($lat,$lon,$radius)
{
	$latitude = (float) $lat;
	$longitude = (float) $lon;
	$radius = $radius; // in miles
	
	$lat_min = $latitude - ($radius / 69);
	$lat_max = $latitude + ($radius / 69);
	$lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
	$lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
	
	$coords = array($lat_min,$lat_max,$lng_min,$lng_max);
	return $coords;
}
function resolvePlaceType($place_type)
{
	
	
	$resolved = "";
	switch($place_type)
	{
		
		case "Accounting":
		$resolved = "accounting";
		break;
		
		case "Airport":
		$resolved = "airport";
		break;
		
		case "Amusement Park":
		$resolved = "amusement_park";
		break;
		
		case "Aquarium":
		$resolved = "aquarium";
		break;
		
		case "Art Gallery":
		$resolved = "art_gallery";
		break;
		
		case "Atm":
		$resolved = "atm";
		break;
		
		case "Bakery":
		$resolved = "bakery";
		break;
		
		case "Bank":
		$resolved = "bank";
		break;
		
		case "Bar":
		$resolved = "bar";
		break;
		
		case "Beauty Salon":
		$resolved = "beauty_salon";
		break;
		
		case "Bicycle Store":
		$resolved = "bicycle_store";
		break;
		
		case "Book Store":
		$resolved = "book_store";
		break;
		
		case "Bowling Alley":
		$resolved = "bowling_alley";
		break;
		
		case "Bus Station":
		$resolved = "bus_station";
		break;
		
		case "Café":
		$resolved = "café";
		break;
		
		case "Campground":
		$resolved = "campground";
		break;
		
		case "Car Dealer":
		$resolved = "car_dealer";
		break;
		
		case "Car Rental":
		$resolved = "car_rental";
		break;
		
		case "Car Repair":
		$resolved = "car_repair";
		break;
		
		case "Car Wash":
		$resolved = "car_wash";
		break;
		
		case "Casino":
		$resolved = "casino";
		break;
		
		case "Cemetery":
		$resolved = "cemetery";
		break;
		
		case "Church":
		$resolved = "church";
		break;
		
		case "City Hall":
		$resolved = "city_hall";
		break;
		
		case "Clothing Store":
		$resolved = "clothing_store";
		break;
		
		case "Convenience Store":
		$resolved = "convenience_store";
		break;
		
		case "Courthouse":
		$resolved = "courthouse";
		break;
		
		case "Dentist":
		$resolved = "dentist";
		break;
		
		case "Department Store":
		$resolved = "department_store";
		break;
		
		case "Doctor":
		$resolved = "doctor";
		break;
		
		case "Electrician":
		$resolved = "electrician";
		break;
		
		case "Electronics Store":
		$resolved = "electronics_store";
		break;
		
		case "Embassy":
		$resolved = "embassy";
		break;
		
		case "Establishment":
		$resolved = "establishment";
		break;
		
		case "Finance":
		$resolved = "finance";
		break;
		
		case "Fire Station":
		$resolved = "fire_station";
		break;
		
		case "Florist":
		$resolved = "florist";
		break;
		
		case "Food":
		$resolved = "food";
		break;
		
		case "Funeral Home":
		$resolved = "funeral_home";
		break;
		
		case "Furniture Store":
		$resolved = "furniture_store";
		break;
		
		case "Gas Station":
		$resolved = "gas_station";
		break;
		
		case "General Contractor":
		$resolved = "general_contractor";
		break;
		
		case "Grocery Or Supermarket":
		$resolved = "grocery_or_supermarket";
		break;
		
		case "Gym":
		$resolved = "gym";
		break;
		
		case "Hair Care":
		$resolved = "hair_care";
		break;
		
		case "Hardware Store":
		$resolved = "hardware_store";
		break;
		
		case "Health":
		$resolved = "health";
		break;
		
		case "Hindu Temple":
		$resolved = "hindu_temple";
		break;
		
		case "Home Goods Store":
		$resolved = "home_goods_store";
		break;
		break;
		
		case "Hospital":
		$resolved = "hospital";
		break;
		
		case "Insurance Agency":
		$resolved = "insurance_agency";
		break;
		
		case "Jewelry Store":
		$resolved = "jewelry_store";
		break;
		
		case "Laundry":
		$resolved = "laundry";
		break;
		
		case "Lawyer":
		$resolved = "lawyer";
		break;
		
		case "Library":
		$resolved = "library";
		break;
		
		case "Liquor Store":
		$resolved = "liquor_store";
		break;
		
		case "Local Government Office":
		$resolved = "local_government_office";
		break;
		
		case "Locksmith":
		$resolved = "locksmith";
		break;
		
		case "Lodging":
		$resolved = "lodging";
		break;
		
		case "Meal Delivery":
		$resolved = "meal_delivery";
		break;
		
		case "Meal Takeaway":
		$resolved = "meal_takeaway";
		break;
		
		case "Mosque":
		$resolved = "mosque";
		break;
		
		case "Movie Rental":
		$resolved = "movie_rental";
		break;
		
		case "Movie Theater":
		$resolved = "movie_theater";
		break;
		
		case "Moving Company":
		$resolved = "moving_company";
		break;
		
		case "Museum":
		$resolved = "museum";
		break;
		
		case "Night Club":
		$resolved = "night_club";
		break;
		
		case "Painter":
		$resolved = "painter";
		break;
		
		case "Park":
		$resolved = "park";
		break;
		
		case "Parking":
		$resolved = "parking";
		break;
		
		case "Pet Store":
		$resolved = "pet_store";
		break;
		
		case "Pharmacy":
		$resolved = "pharmacy";
		break;
		
		case "Physiotherapist":
		$resolved = "physiotherapist";
		break;
		
		case "Place Of Worship":
		$resolved = "place_of_worship";
		break;
		
		case "Plumber":
		$resolved = "plumber";
		break;
		
		case "Police":
		$resolved = "police";
		break;
		
		case "Post Office":
		$resolved = "post_office";
		break;
		
		case "Real Estate Agency":
		$resolved = "real_estate_agency";
		break;
		
		case "Restaurant":
		$resolved = "restaurant";
		break;
		
		case "Roofing Contractor":
		$resolved = "roofing_contractor";
		break;
		
		case "Rv Park":
		$resolved = "rv_park";
		break;
		
		case "School":
		$resolved = "school";
		break;
		
		case "Shoe Store":
		$resolved = "shoe_store";
		break;
		
		case "Shopping Mall":
		$resolved = "shopping_mall";
		break;
		
		case "Spa":
		$resolved = "spa";
		break;
		
		case "Stadium":
		$resolved = "stadium";
		break;
		
		case "Storage":
		$resolved = "storage";
		break;
		
		case "Store":
		$resolved = "store";
		break;
		
		case "Subway Station":
		$resolved = "subway_station";
		break;
		
		case "Synagogue":
		$resolved = "synagogue";
		break;
		
		case "Taxi Stand":
		$resolved = "taxi_stand";
		break;
		
		case "Train Station":
		$resolved = "train_station";
		break;
		
		case "Travel Agency":
		$resolved = "travel_agency";
		break;
		
		case "University":
		$resolved = "university";
		break;
		
		case "Veterinary Care":
		$resolved = "veterinary_care";
		break;
		
		case "Zoo":
		$resolved = "zoo";
		break;
		
		default:
		$resolved = $place_type;
	}
	
	return $resolved;
}
?>