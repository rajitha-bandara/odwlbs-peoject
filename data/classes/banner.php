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
}

$gbannerObj = new Banner();
?>