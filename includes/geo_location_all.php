<?php @session_start();?>
<?php
if (isset($_SESSION["lat"]) && isset($_SESSION["long"]) && isset($_SESSION["city"]) && isset($_SESSION["region"]) && isset($_SESSION["country"]) && isset($_SESSION["address"]))
{
	$user_lat = $_SESSION['lat'];
	$user_long = $_SESSION['long'];
    $user_city = $_SESSION['city'];
	$user_region = $_SESSION['region'];
	$user_country = $_SESSION['country'];
	$user_address = $_SESSION['address'];
}
else if(isset($_COOKIE["lat"]) && isset($_COOKIE["long"]) && isset($_COOKIE["city"]) && isset($_COOKIE["region"]) && isset($_COOKIE["country"]) && isset($_COOKIE["address"]))
{
	$user_lat = $_COOKIE['lat'];
	$user_long = $_COOKIE['long'];
    $user_city = $_COOKIE['city'];
	$user_region = $_COOKIE['region'];
	$user_country = $_COOKIE['country'];
	$user_address = $_COOKIE['address'];
}
else
{
?>


<!--<script src="public/js/jquery-1.7.js"></script>-->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=<?php //echo GOOGLE_MAP_API_KEY;?>" type="text/javascript"></script>-->
	<script src="http://www.google.com/jsapi?key=<?php echo GOOGLE_MAP_API_KEY;?>" type="text/javascript"></script>
	<script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>
    
	
<?php require_once('get_geo_location.php');?>

<?php
}
?>

	
<?php
if($user_lat == '' && $user_long =='' && $user_city == '' && $user_region == '' && $user_country == '' && $user_address=='')
{
	$parsedJson = ipToAddress('203.153.223.84');
	$user_lat =  $parsedJson->latitude;
	$user_long =  $parsedJson->longitude;
	$user_city =  $parsedJson->city;
	$user_region = $parsedJson->region_name;
	$user_country =  $parsedJson->country_name;
	$user_address = $user_city. ', '.$user_region. ', '.$user_country;
}
function ipToAddress($ip)
{
	$pageContent = file_get_contents('http://freegeoip.net/json/'.$ip );
	return json_decode($pageContent);
	 
}
?> 
