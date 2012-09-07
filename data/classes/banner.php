<?php 
class Banner
{
	private $bannerID;
	private $userID;
	private $listingID;
	private $bannerType;
	private $caption;
	private $destination;
	protected static $banner_table="lbs_biz_banners";
	protected static $table_biz="lbs_biz";
	protected static $table_location="lbs_biz_location";
	
	public function __construct()
	{

	}

	public function setListingId($lid="")
	{
		$this->listingID = $lid;
	}
	public function getBannerId()
	{
		return $this->bannerID;
	}
	public function setBannerInfo($bannerType="",$caption="",$destination="")
	{
		$this->bannerType = $bannerType;
		$this->caption = $caption;
		$this->destination = $destination;

	}

	public function add()
	{
		global $gdbObj;

		$bannerType   = $gdbObj-> escape_value($this->bannerType);
		$caption     = $gdbObj-> escape_value($this->caption);
		$destination = $gdbObj-> escape_value($this->destination);
		$listingID  = $gdbObj-> escape_value($this->listingID);

		$sql = "INSERT INTO ".self::$banner_table." (type,caption,url,biz_id) values('$bannerType','$caption','$destination','$listingID')";
		if($gdbObj->query($sql))
		{
			$this->bannerID = $gdbObj->insert_id();
			return true;
		}
		else
		{
			return false;
		}

	}

	public function deleteBanner($lid)
	{
		global $gdbObj;
		$result = $gdbObj->query("SELECT banner_id,type FROM ".self::$banner_table." WHERE biz_id= '$lid' ");
		$count = $gdbObj->num_rows($result);
		if ($count > 0)
		{
			while($row = $gdbObj->fetch_array($result))
			{
				$id = $row['banner_id'];
				$type = $row['type'];
				$exts = array('bmp','png','jpg','gif','jpeg');
				foreach($exts as $ext) {
					if(file_exists("ads/" . $type . "/". $id .".". $ext)){
						unlink("ads/" . $type . "/". $id .".". $ext);
					}
				}


			}
		}

	}
	
	/* Query banner information based on lat long distance from the user */
	/* public function getAdsByDist($coords,$bType,$level,$limit)
	{
		if($level == 'home')
			$pkg = "b.package = 'g'";
		else
			$pkg = "(b.package = 'g' OR b.package = 's')";
		global $gdbObj;
		
		$sql = "SELECT a.banner_id	FROM ".self::$table_biz . " b, ".self::$table_location. " l, ".self::$banner_table. " a
		        where a.type = '$bType' AND $pkg AND b.biz_id = a.biz_id AND b.biz_id = l.biz_id AND l.latitude >= $coords[0] AND
				 l.latitude <= $coords[1] AND l.longitude >= $coords[2] AND l.longitude <= $coords[3] ORDER BY RAND() LIMIT $limit";
		
		
		
		$result =  $gdbObj->query($sql);
		if($gdbObj->num_rows($result) > 0)
			return $result;
		else
			return false;
	} */
	
	public function getAdsByDist($logic,$loc,$bType,$level,$limit)
	{
		$locationStr = "";
		$pkgStr = "";
		//Solve location condition
		if($logic == "latlon")
		{
			$locationStr = "l.latitude >= $loc[0] AND l.latitude <= $loc[1] AND l.longitude >= $loc[2] AND l.longitude <= $loc[3]";
		}
		else if($logic == "cnt")
		{
			$locationStr = "l.country LIKE '$loc'";
		}
		else 
		{
			$locationStr = 1;
		}

		/* Solve listing package with banner display location in page
		home page or inside pages */
		if($level == 'home')
			$pkgStr = "b.package = 'g'";
		else
			$pkgStr = "(b.package = 'g' OR b.package = 's')";
		global $gdbObj;
	
		$sql = "SELECT b.biz_id, b.title, a.banner_id	FROM ".self::$table_biz . " b, ".self::$table_location. " l, ".self::$banner_table. " a
		where a.type = '$bType' AND $pkgStr AND b.biz_id = a.biz_id AND b.biz_id = l.biz_id AND $locationStr ORDER BY RAND() LIMIT $limit";
	
		$result =  $gdbObj->query($sql);
		if($gdbObj->num_rows($result) > 0)
			return $result;
		else
			return false;
	}
	
	/*  Query banner information based on user country
	public function getAdsByCnt($cnt,$bType,$level,$limit)
	{
		if($level == 'home')
			$pkg = "b.package = 'g'";
		else
			$pkg = "(b.package = 'g' OR b.package = 's')";
		global $gdbObj;
	
		$sql = "SELECT a.banner_id	FROM ".self::$table_biz . " b, ".self::$table_location. " l, ".self::$banner_table. " a
		where a.type = '$bType' AND $pkg AND b.biz_id = a.biz_id AND b.biz_id = l.biz_id AND l.country LIKE '' ORDER BY RAND() LIMIT $limit";
	
	
	
		$result =  $gdbObj->query($sql);
		if($gdbObj->num_rows($result) > 0)
			return $result;
		else
			return false;
	} */
	
	public function displayBanners($result,$bType)
	{
		$imgArr = array();
		if($bType == 'featured')
		{
			
			$counter = 0;
			while($row = mysql_fetch_array($result))
			{
				$lstId = $row[0];
				$lstTitle = $row[1];
				$exts = array('bmp','png','jpg','gif','jpeg');
				foreach($exts as $ext) {
					$bPath = "ads/" . $bType . "/". $row[2] .".". $ext;
					if(file_exists($bPath)){
						
						$imgArr[$counter][0] = $lstId;
						$imgArr[$counter][1] = makeURLSafe($lstTitle);
						$imgArr[$counter][2] = $bPath;
						$counter++;
					}
				}
			}
			return $imgArr;
		}
		
		while($row = mysql_fetch_array($result))
		{
			$exts = array('bmp','png','jpg','gif','jpeg');
			foreach($exts as $ext) {
				$bPath = "ads/" . $bType . "/". $row[2] .".". $ext;
				$lstId = $row[0];
				$lstTitle = $row[1];
				if(file_exists($bPath)){
					if($bType == 'top')
						return formatTopBanner($bPath,$lstId,$lstTitle);
					else if($bType == 'vertical')
						return formatVerticalBanner($bPath,$lstId,$lstTitle);
					else if($bType == 'bottom')
						return formatBottomBanner($bPath,$lstId,$lstTitle);
				}
			}
			
		}
	}
	
}

$gbannerObj = new Banner();
?>