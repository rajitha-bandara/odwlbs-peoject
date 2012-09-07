<?php
class Business
{
	private $listingID;
	private $userID;
	private $title;
	private $tagline;
	private $category;
	private $subCategory;
	private $description;
	private $web;
	private $fb;
	private $twitter;
	private $linkedIn;
	private $video;
	private $email;
	private $phone;
	private $fax;
	private $mobile;
	private $contactP;
	private $street;
	private $city;
	private $country;
	private $zip;
	private $latitude;
	private $longitude;
	private $keywords;
	private $content_approved	 = 0;
	private $status;
	private $package	 = '';
	protected static $table_biz="lbs_biz";
	protected static $table_contacts="lbs_biz_contacts";
	protected static $table_location="lbs_biz_location";
	protected static $table_social ="lbs_biz_social_links";
	protected static $table_keywords="lbs_biz_keywords";
	protected static $table_banners="lbs_biz_banners";
	protected static $table_mainCategories="lbs_biz_main_categories";
	protected static $table_subCategories="lbs_biz_sub_categories";
	protected static $table_ratings="lbs_rtgitems";
	protected static $table_rated_users="lbs_rtgusers";

	public function __construct()
	{

	}

	public function setBizInfo($userID="",$title="",$tagline="",$category="",$subcategory="",$description="",$web="")
	{
		$this->userID = $userID;
		$this->title = $title;
		$this->tagline = $tagline;
		$this->category = $category;
		$this->subCategory = $subcategory;
		$this->description = $description;
		$this->web = $web;

	}

	public function setContactInfo($email="",$phone="",$fax="",$mobile="",$contactP="")
	{
		$this->email = $email;
		$this->phone = $phone;
		$this->fax = $fax;
		$this->mobile = $mobile;
		$this->contactP = $contactP;
	}

	public function setLocationInfo($street="",$city="",$country="",$zip="",$latitude="",$longitude="")
	{
		$this->street = $street;
		$this->city = $city;
		$this->country = $country;
		$this->zip = $zip;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
	}

	public function setKeywordInfo($keywords ="")
	{
		$this->keywords = $keywords;
	}

	public function setSocialLinks($fb="",$twitter="",$linkedIn="",$videoChannel="")
	{
		$this->fb = $fb;
		$this->twitter = $twitter;
		$this->linkedIn = $linkedIn;
		$this->video = $videoChannel;
	}

	public function add()
	{
		global $gdbObj;

		$title       = $gdbObj-> escape_value($this->title);
		$tagline     = $gdbObj-> escape_value($this->tagline);
		$category    = $gdbObj-> escape_value($this->category);
		$subCategory = $gdbObj-> escape_value($this->subCategory);
		$description = $gdbObj-> escape_value($this->description);
		$web         = $gdbObj-> escape_value($this->web);
		$email		 = $gdbObj-> escape_value($this->email);
		$phone 		 = $gdbObj-> escape_value($this->phone);
		$fax		 = $gdbObj-> escape_value($this->fax);
		$mobile 	 = $gdbObj-> escape_value($this->mobile);
		$contactP 	 = $gdbObj-> escape_value($this->contactP);
		$street 	 = $gdbObj-> escape_value($this->street);
		$city 		 = $gdbObj-> escape_value($this->city);
		$country 	 = $gdbObj-> escape_value($this->country);
		$zip 		 = $gdbObj-> escape_value($this->zip);
		$latitude 	 = $gdbObj-> escape_value($this->latitude);
		$longitude 	 = $gdbObj-> escape_value($this->longitude);
		$keywords 	 = $gdbObj-> escape_value($this->keywords);
		$package	 = $gdbObj-> escape_value($this->package);


		$sql_biz = "INSERT INTO ".self::$table_biz." (title,tagline,main_category,sub_category,description,url,status,content_approved,package,date_submit,date_expire,user_id) VALUES('$title','$tagline','$category','$subCategory','$description','$web',0,0,'$package',NOW(),null,$this->userID)";

		if($gdbObj->query($sql_biz))
		{
			global $gbannerObj;

			$this->business_id = $gdbObj->insert_id();
			$biz_id = $this->business_id;

			$sql_contacts = "INSERT INTO ".self::$table_contacts." (email,phone,fax,mobile,contact_person,biz_id) VALUES('$email','$phone','$fax','$mobile','$contactP','$biz_id')";
			$gdbObj->query($sql_contacts);

			$sql_location = "INSERT INTO ".self::$table_location." (street,city,country,zip_code,latitude,longitude,biz_id) VALUES('$street','$city','$country','$zip','$latitude','$longitude','$biz_id')";
			$gdbObj->query($sql_location);

			$sql_keywords = "INSERT INTO ".self::$table_keywords." (keyword,biz_id) VALUES('$keywords','$biz_id')";
			$gdbObj->query($sql_keywords);

			return true;
		}
		else
		{
			return false;
		}

	}

	public function update($option="")
	{
		global $gdbObj;
		$listingID   = $gdbObj-> escape_value($this->listingID);

			

		$keywords 	 = $gdbObj-> escape_value($this->keywords);
		$package	 = $gdbObj-> escape_value($this->package);

		if($option == 1)
		{
			$title       = $gdbObj-> escape_value($this->title);
			$tagline     = $gdbObj-> escape_value($this->tagline);
			$category    = $gdbObj-> escape_value($this->category);
			$subCategory = $gdbObj-> escape_value($this->subCategory);
			$description = $gdbObj-> escape_value($this->description);
			$web         = $gdbObj-> escape_value($this->web);

			$sql_biz = "UPDATE ".self::$table_biz." SET  title = '$title', tagline = '$tagline', main_category = '$category', sub_category = '$subCategory', description = '$description', url = '$web' WHERE biz_id = '$listingID'";
			$gdbObj->query($sql_biz);
			return true;
		}

		else if($option == 2)
		{
			$email       = $gdbObj-> escape_value($this->email);
			$phone       = $gdbObj-> escape_value($this->phone);
			$fax    	 = $gdbObj-> escape_value($this->fax);
			$mobile      = $gdbObj-> escape_value($this->mobile);
			$contactP    = $gdbObj-> escape_value($this->contactP);

			$sql_biz = "UPDATE ".self::$table_contacts." SET  email = '$email', phone = '$phone', fax = '$fax', mobile = '$mobile', contact_person = '$contactP' WHERE biz_id = '$listingID'";
			$gdbObj->query($sql_biz);
			return true;
		}
		else if($option == 3)
		{
			$street 	 = $gdbObj-> escape_value($this->street);
			$city 		 = $gdbObj-> escape_value($this->city);
			$country 	 = $gdbObj-> escape_value($this->country);
			$zip 		 = $gdbObj-> escape_value($this->zip);
			$latitude 	 = $gdbObj-> escape_value($this->latitude);
			$longitude 	 = $gdbObj-> escape_value($this->longitude);

			$sql_biz = "UPDATE ".self::$table_location." SET  street = '$street', city = '$city', country = '$country', zip_code = '$zip', latitude = '$latitude', longitude = '$longitude' WHERE biz_id = '$listingID'";
			$gdbObj->query($sql_biz);
			return true;
		}
		else if($option == 4)
		{
			$fb			 = $gdbObj-> escape_value($this->fb);
			$twitter 	 = $gdbObj-> escape_value($this->twitter);
			$linkedIn 	 = $gdbObj-> escape_value($this->linkedIn);
			$video		 = $gdbObj-> escape_value($this->video);

			$sql_biz = "UPDATE ".self::$table_social." SET  facebook = '$fb', twitter = '$twitter', linkedin = '$linkedIn', video_channel = '$video' WHERE biz_id = '$listingID'";
			$gdbObj->query($sql_biz);
			return true;
		}
		else if($option == 5)
		{
			$keywords			 = $gdbObj-> escape_value($this->keywords);


			$sql_biz = "UPDATE ".self::$table_keywords." SET  keyword = '$keywords' WHERE biz_id = '$listingID'";
			$gdbObj->query($sql_biz);
			return true;
		}
	}

	public function delete($option="")
	{
		global $gdbObj;
		global $gbannerObj;
		$listingID   = $gdbObj-> escape_value($this->listingID);
		switch($option)
		{
			case 1:
				$table = self::$table_biz;
				break;
			case 2:
				$table = self::$table_contacts;
				break;
			case 3:
				$table = self::$table_location;
				break;
			case 4:
				$table = self::$table_keywords;
				break;
			case 5:
				$table = self::$table_social;
				break;
			case 6:
				$table = self::$table_banners;
				$gbannerObj->deleteBanner($listingID);
				break;
			case 7:
				$table = self::$table_ratings;
				break;
			case 8:
				$table = self::$table_rated_users;
				$itemId = "rt_listing_".$listingID;
				$sql_biz = "DELETE FROM ".$table."  WHERE item = '$itemId'";
				$gdbObj->query($sql_biz);
				break;

		}

		$sql_biz = "DELETE FROM ".$table."  WHERE biz_id = '$listingID'";
		return $gdbObj->query($sql_biz);
			


	}



	public function countListings($where)
	{
		global $gdbObj;
		$sql = "SELECT COUNT(biz_id) FROM ".self::$table_biz. " $where";
		$result =  $gdbObj->query($sql);
		while ($row = mysql_fetch_array($result))
		{
			return $row[0];
		}
	}

	public function fetchListingObj($id)
	{
		global $gdbObj;
		$sql = "SELECT * FROM ".self::$table_biz ." b  where b.biz_id = ".$id;
		$result = $gdbObj->query($sql);
		if($gdbObj->num_rows($result) ==1)
		{
			return mysql_fetch_object($result);
		}
		else
		{
			return false;
		}
			
	}

	public function fetchAllListings($where,$sort,$limit)
	{
		global $gdbObj;
		$sql = "SELECT * FROM ".self::$table_biz."$where $sort $limit";
		return $gdbObj->query($sql);
	}

	public function setListingId($lid="")
	{
		$this->listingID = $lid;
	}

	public function fetchPopularListings()
	{
		global $gdbObj;
		$sql = "SELECT b.biz_id,b.title FROM ".self::$table_biz." b, ".self::$table_ratings ." r WHERE b.biz_id= r.biz_id ORDER BY r.totalrate DESC LIMIT 6";
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{
			$counter = 1;
			while($row = mysql_fetch_array($resut))
			{
				$bizId = $row[0];
				$title = $row[1];
				$results.= formatPopularListing($bizId,$title);
				$counter++;
			}
			return $results;
		}
	}

	public function fetchListingsByUser($userId)
	{
		global $gdbObj;
		$sql = "SELECT biz_id,title FROM ".self::$table_biz." WHERE user_id= '$userId' ";
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{
			$counter = 1;
			while($row = mysql_fetch_array($resut))
			{
				$bizId = $row[0];
				$title = $row[1];
				$results.= formatListing($counter,$bizId,$title,$userId);
				$counter++;
			}
			return $results;
		}
	}

	public function fetchListingTitle($userId)
	{
		global $gdbObj;
		$sql = "SELECT biz_id,title FROM ".self::$table_biz." WHERE user_id= '$userId' ";
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{
			$counter = 1;
			while($row = mysql_fetch_array($resut))
			{
				$bizId = $row[0];
				$title = $row[1];
				$results.= formatListingTitle($counter,$bizId,$title,$userId);
				$counter++;
			}
			return $results;
		}
	}

	public function fetchListingsByLocation($lat,$lon,$radius)
	{
		$coords =  getNearLatLong($lat,$lon,$radius);

		$minLat = $coords[0];
		$maxLat = $coords[1];
		$minLon = $coords[2];
		$maxLon = $coords[3];

		global $gdbObj;
		$sql = "SELECT b.biz_id,b.title FROM ".self::$table_biz." b, ".self::$table_location." l WHERE l.latitude >= ".$minLat ." AND l.latitude <= ".$maxLat ." AND l.longitude >= ".$minLon ." AND l.longitude <= ".$maxLon ." AND b.biz_id = l.biz_id limit 5";
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{
			$counter = 1;
			while($row = mysql_fetch_array($resut))
			{
				$bizId = $row[0];
				$title = $row[1];
				$results.= formatRelatedSearch($counter,$bizId,$title);
				$counter++;
			}
			return $results;
		}
	}
	
	/* Find nearby listings for displaying banners */
	public function fetchNearListings($ulat,$ulon,$cnt,$bType,$level,$limit)
	{
		global $gbannerObj;
		$found = false;
		$hasLst = "";
		
		//Check listings based on user lat long
		for($i = 20;$i<=180;$i+=40)
		{
			$logic = "latlon";
			$coords =  getNearLatLong($ulat,$ulon,$i);
			$hasLst = $gbannerObj->getAdsByDist($logic,$coords,$bType,$level,$limit);
			if($hasLst !== false)
			{
				$found = true;
				break;
			}
			
		}

		if($found)
		{
			return $gbannerObj->displayBanners($hasLst,$bType);
			return;
				
		}
		if(!$found)
		{
			//Check listings based on user country - fallback 1
			$logic = "cnt";
			$hasLst = $gbannerObj->getAdsByDist($logic,$cnt, $bType, $level, $limit);
			if($hasLst !== false)
			{
				$found = true;
				
			}
		}
		if($found)
		{
			return $gbannerObj->displayBanners($hasLst,$bType);
			return;
		
		}
		if(!$found)
		{
			//Get random listings  - fallback 2
			$logic = "";
			$hasLst = $gbannerObj->getAdsByDist($logic,"",$bType, $level, $limit);
			if($hasLst !== false)
			{
				$found = true;
				
			}
		}
		if($found)
		{
			return $gbannerObj->displayBanners($hasLst,$bType);
			return;
		
		}


	}

	public function fetchRecentListings()
	{
		global $gdbObj;
		$sql = "SELECT b.biz_id,b.title,b.main_category,b.sub_category,m.name,s.name FROM ".self::$table_biz." b,".self::$table_mainCategories. " m,".self::$table_subCategories. " s
		WHERE b.main_category = m.main_category_id AND b.sub_category = s.sub_category_id ORDER BY date_submit DESC LIMIT 10";
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{

			while($row = mysql_fetch_array($resut))
			{
				$bizId = $row[0];
				$title = $row[1];
				$mainCatId = $row[2];
				$subCatId = $row[3];
				$mainCat = $row[4];
				$subCat = $row[5];
				$results.= formatRecentListing($bizId,$title,$mainCatId,$subCatId,$mainCat,$subCat);

			}
			return $results;
		}
	}

	/* Approve Content*/
	public function approveContent($lid)
	{
		global $gdbObj;
		$sql = "UPDATE  ".self::$table_biz." SET content_approved = '1' where biz_id = '$lid'";
		$gdbObj->query($sql);
	}

	/* Reject Content*/
	public function rejectContent($lid)
	{
		global $gdbObj;
		$sql = "UPDATE  ".self::$table_biz." SET content_approved = '0' where biz_id = '$lid'";
		$gdbObj->query($sql);
	}

	/* Update listing status*/
	public function updateStatus($lid,$status)
	{
		global $gdbObj;
		$sql = "UPDATE  ".self::$table_biz." SET status  = '$status' where biz_id = '$lid'";
		$gdbObj->query($sql);
	}

	public function getTitle($lid="")
	{
		global $gdbObj;
		$result = $gdbObj->query("SELECT title FROM ".self::$table_biz." WHERE biz_id = '$lid' ");
		$count = $gdbObj->num_rows($result);
		if ($count == 1)
		{
			return mysql_result($result, 0, 0);
		}
	}
	public function getPkg($pkg="")
	{
		$outPkg = "";
		switch($pkg)
		{
			case "bronze":
				$outPkg = "b";
				break;

			case "silver":
				$outPkg = "s";
				break;

			case "gold":
				$outPkg = "g";
				break;

			case "b":
				$outPkg = "bronze";
				break;

			case "s":
				$outPkg = "silver";
				break;

			case "g":
				$outPkg = "gold";
				break;

		}
		return $outPkg;
	}

	public function setPkg($pkg="")
	{
		$this->package = $pkg;
	}
	public function getStatus($st="")
	{
		$status="";
		switch($st)
		{
			case 0:
		  $status = "pending";
		  break;

			case 1:
		  $status = "active";
		  break;

			case 2:
		  $status = "deactive";
		  break;
		}
		return $status;
	}
}
$gbizObj = new Business();
?>