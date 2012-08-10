 <?php
require_once('geo_location_all.php'); 
 
 
 $results = "";
 $flag = "";
 if(isset($_GET['p']) && $_GET['p'] == 'new')
 {
 	$results = "";
 	$flag = "new_search";
 }
 else if(!isset($_GET['q']) || $_GET['q'] == null)
 {
 	$results = "<div class='alert alert-error'>Enter a business name or category</div>";
 	$flag = "incomplete_search";
 
 }
 else if(!isset($_GET['city']) || $_GET['city'] == null)
 {
 	$results = "<div class='alert alert-error'>Select a location to search</div>";
 	$flag = "incomplete_search";
 }
 

 
 
 

//start
 else if(!isset($_GET['btnSearch']) || $_GET['btnSearch'] == advancedSearch)
 {
 

	if(!isset($_GET['listCategory']) || $_GET['listCategory'] == null)
	{
		$results = "<div class='alert alert-error'>Select a category to search</div>";
		$flag = "incomplete_search";
	}



	else 
	{
		$what = $_GET['q'] ;
		$what = trim($what);
		$where=$_GET['city'] ;
		$where = trim($where);
		
		$category=$_GET['listCategory'];
		$subCategory=$_GET['listSubCategory']==null?-1:$_GET['listSubCategory'];
		
		$sql = "SELECT b.biz_id AS id,b.title AS title, b.url AS url, c.phone AS phone, l.street AS street, l.city AS city 
				FROM lbs_biz b 
				LEFT JOIN lbs_biz_contacts c on  b.biz_id = c.biz_id
				LEFT JOIN lbs_biz_location l on b.biz_id = l.biz_id
				LEFT JOIN lbs_biz_main_categories m on b.main_category = m.main_category_id
				LEFT JOIN lbs_biz_sub_categories s on  b.sub_category = s.sub_category_id
				WHERE  b.main_category='$category' AND (b.sub_category='$subCategory' or ".$subCategory.'=-1)';
		
		
		switch ($_GET['listSearchCriteria']) 
		{
			case 'ALL':
				$sql=$sql." AND (b.title LIKE '%$what%' || b.tagline LIKE '%$what%' || m.name LIKE '%$what%' || s.name LIKE '%$what%') ";
			break;
			
			case 'tagline':
				$sql=$sql." AND ( b.tagline LIKE '%$what%' ) ";
				break;
				
			case 'name':
				$sql=$sql." AND (b.title LIKE '%$what%') ";
				break;									
			default:
				$sql=$sql." AND (b.title LIKE '%$what%' || b.tagline LIKE '%$what%' || m.name LIKE '%$what%' || s.name LIKE '%$what%') ";
			break;
		}
		
		switch ($_GET['listLocationCriteria'])
		{
			case 'ALL':
				$sql=$sql." AND ((l.city LIKE '%$where%') || (l.street LIKE '%$where%')) ";
				break;
					
			case 'city':
				$sql=$sql." AND ( l.city LIKE '%$where%') ";
				break;
		
			case 'country':
				$sql=$sql." AND (l.country LIKE '%$where%') ";
				break;
			default:
				$sql=$sql." AND ((l.city LIKE '%$where%') || (l.street LIKE '%$where%')) ";
				break;
		}
		
		/*
		 * Create a PS_Pagination object
		*
		* $conn = MySQL connection object
		* $sql = SQl Query to paginate
		* 10 = Number of rows per page
		* 5 = Number of links
		* "param1=valu1&param2=value2" = You can append your own parameters to paginations links
		*/
		$pager = new PS_Pagination($sql, 2, 5, "param1=valu1&param2=value2");
		
		/*
		 * Enable debugging if you want o view query errors
		*/
		$pager->setDebug(false);
		
		/*
		 * The paginate() function returns a mysql result set
		* or false if no rows are returned by the query
		*/
		$rs = $pager->paginate();
		if(!$rs)
		{
			$topic = "Found 0 results on <u>".$what."</u> in <u>".$where."</u>";
		
		}
		else
		{
			$counter = 1;
			$results="";
			while($row = mysql_fetch_assoc($rs)) {
				$results.= getResultHTML($where,$counter,$row['id'],$row['title'], $row['url'],$row['phone'],$row['street'],$row['city']);
				$counter++;
			}
		
			//Display the full navigation in one go
			$pagination =  $pager->renderFullNav();
			$total_no_of_results = 0;
			$total_no_of_results = $pager->getResultsCount();
			$topic = "Found ". $total_no_of_results." results on <u>".$what."</u> in <u>".$where."</u>";
			
		}
		
		//$topic=$topic.$sql;
		
	}
 }
//end

 
else
{

	$what = $_GET['q'] ;
	$what = trim($what);
	$where=$_GET['city'] ;
	$where = trim($where);
	
	$sql = "SELECT b.biz_id AS id,b.title AS title, b.url AS url, c.phone AS phone, l.street AS street, l.city AS city FROM lbs_biz b, lbs_biz_contacts c, lbs_biz_location l, lbs_biz_main_categories m, lbs_biz_sub_categories s
	WHERE (b.title LIKE '%$what%' || m.name LIKE '%$what%' || s.name LIKE '%$what%') AND ((l.city LIKE '%$where%') || (l.street LIKE '%$where%')) AND  b.biz_id = c.biz_id AND b.biz_id = l.biz_id AND b.main_category = m.main_category_id AND b.sub_category = s.sub_category_id";
	
	Search::track($what,$where,$user_lat,$user_long);
	
	/*
	 * Create a PS_Pagination object
	*
	* $conn = MySQL connection object
	* $sql = SQl Query to paginate
	* 10 = Number of rows per page
	* 5 = Number of links
	* "param1=valu1&param2=value2" = You can append your own parameters to paginations links
	*/
	$pager = new PS_Pagination($sql, 2, 5, "param1=valu1&param2=value2");

	/*
	 * Enable debugging if you want o view query errors
	*/
	$pager->setDebug(false);

	/*
	 * The paginate() function returns a mysql result set
	* or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs)
	{
		$topic = "Found 0 results on <u>".$what."</u> in <u>".$where."</u>";

	}
	else
	{
		$counter = 1;
		$results="";
		while($row = mysql_fetch_assoc($rs)) {
			$results.= getResultHTML($where,$counter,$row['id'],$row['title'], $row['url'],$row['phone'],$row['street'],$row['city']);
			$counter++;
		}

		//Display the full navigation in one go
		$pagination =  $pager->renderFullNav();
		$total_no_of_results = 0;
		$total_no_of_results = $pager->getResultsCount();
		$topic = "Found ". $total_no_of_results." results on <u>".$what."</u> in <u>".$where."</u>";
	}
}


?>

