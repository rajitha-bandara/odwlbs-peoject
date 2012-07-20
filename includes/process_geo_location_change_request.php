<?php 
if(isset($_POST['btnLoc']))
{
	$city = $_POST['txtCity'];
	$region = $_POST['txtState'];
	$country = $_POST['txtCountry'];
	$geoMsg = "";
	if(!empty($city) || !empty($state) || !empty($country))
	{
		setcookie('city',$city,time() + (86400 * 30)); // 86400 = 1 day
		setcookie('region',$region,time() + (86400 * 30));
		setcookie('country',$country,time() + (86400 * 30));
		
	}
	else
	{
		$geoMsg = "Enter your city, state or country";
	}
}
?>