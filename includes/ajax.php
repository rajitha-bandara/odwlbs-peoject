<?php
@session_start();
require_once 'init.php';
 require_once('geo_location_all.php');
/*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");*/
 
switch($_POST['action']) {
     case "geolocation" :
	 	  $_SESSION['lat'] = $_POST['lat'];
		  $_SESSION['long'] = $_POST['long'];
          $_SESSION['city'] = $_POST['city'];
     	  $_SESSION['region'] = $_POST['region'];
		  $_SESSION['country'] = $_POST['country'];
		  $_SESSION['address'] = $_POST['address'];
        break;
		
	case "updateUserAddress" :
		  $_SESSION['lat'] = $_POST['lat'];
		  $_SESSION['long'] = $_POST['long'];
	 	  $_SESSION['address'] = $_POST['address'];
		  break;
		  
    case "search" :
    	  require_once '../data/classes/search.php';
		  $what = $_POST['what'];
		  $where = $_POST['where'];
		  Search::track($what,$where,$user_lat,$user_long);
		  break;
 
}

?>