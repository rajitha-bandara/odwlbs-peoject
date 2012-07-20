
<?php
require_once('init.php');
?>

<?php

$service;//type of the service request ex search,login
$format='json';//response format

//parameters for search
$query;
$longitude;
$latitude;


//validate service parameter of the request
if(isset($_GET['service']))
{
	$service=$_GET['service'];
	
}
else
	exit(404);


switch ($service) {
	case "search":
		
		if(isset($_GET['query']))
		{
			$query=$_GET['query'];
			
			
			if(isset($_GET['lat']) && isset($_GET['long']))	
			{
				$result = mysql_query('SELECT b.biz_id,b.title,b.description 
									   FROM lbs_biz b 
									   LEFT JOIN lbs_biz_location l on b.biz_id=l.biz_id 
									   WHERE b.title LIKE \'%'.$query.'%\'') ;
			}
			else 
			{
				$result = mysql_query('SELECT b.biz_id,b.title,b.description,b.tagline,mc.name mainCategory,sc.name subCategory 
									   FROM lbs_biz b
									   LEFT JOIN lbs_biz_main_categories mc on b.main_category=mc.main_category_id
									   LEFT JOIN lbs_biz_sub_categories sc on b.sub_category=sc.sub_category_id
									   WHERE
									   b.title LIKE \'%'.$query.'%\' or
									   mc.name LIKE \'%'.$query.'%\' or
									   sc.name LIKE \'%'.$query.'%\' ') ;
				
			}	
			$response = array();
			if(mysql_num_rows($result)) 
			{
				while($item = mysql_fetch_assoc($result)) 
				{
					array_push($response,$item);
				}
			}
			if($format == 'json') 
			{
					
				echo json_encode(array('response'=>$response));
			}			
				
		}
		else
			exit(404);
		
	
	break;
	
	case "location":
	{
		if(isset($_GET['query']))
		{
			$query=$_GET['query'];
			$business=$_GET['business'];
				
					$result = mysql_query('SELECT l.city,l.street,l.country,b.biz_id
											FROM lbs_biz b
											LEFT JOIN lbs_biz_location l on b.biz_id=l.biz_id
											WHERE
											(l.city LIKE \'%'.$query.'%\' or l.street LIKE \'%'.$query.'%\' or l.country LIKE \'%'.$query.'%\') and b.title LIKE \'%'.$business.'%\' ') ;
		
			
			$response = array();
			if(mysql_num_rows($result))
			{
				while($item = mysql_fetch_assoc($result))
				{
					array_push($response,$item);
				}
			}
			if($format == 'json')
			{
					
				echo json_encode(array('response'=>$response));
			}
		
		}
		else
			exit(404);
	}
	break;
	default:
		exit(404)
		;
	break;
}



?>
