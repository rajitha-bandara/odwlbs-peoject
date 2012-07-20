<?php 
class Banner
{
	private $banerID;
	private $userID;
	private $businessID;
	private $banerType;
	private $caption;
	private $destination;
	protected static $banner_table="lbs_biz_banners";
	
	public function __construct()
	{
		
	}
	
	public function setBannerInfo($banerType="",$caption="",$destination="",$businessID="",$userID="")
	{
		$this->banerType = $banerType;
		$this->caption = $caption;
		$this->destination = $destination;
		$this->businessID = $businessID;
		$this->userID = $userID;
	}
	
	public function add()
	{
		global $gdbObj;
		
		$banerType   = $gdbObj-> escape_value($this->banerType);
		$caption     = $gdbObj-> escape_value($this->caption);
		$destination = $gdbObj-> escape_value($this->destination);
		$businessID  = $gdbObj-> escape_value($this->businessID);
		$userID  = $gdbObj-> escape_value($this->userID);
		
		$sql = "INSERT INTO ".self::$banner_table." (type,caption,url,biz_id,user_id) values('$banerType','$caption','$destination','$businessID','$userID')";
		if($gdbObj->query($sql))
		{
			$this->banerID = $gdbObj->insert_id();
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