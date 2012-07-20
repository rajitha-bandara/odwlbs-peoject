<?php
class User 
{
	private $user_id;
	private $username;
	private $password;
	private $email;
	private $first_name;
	private $last_name;
	private $country;
	private $city;
	private $street;
	private $phone;
	private $zip;
	private $description;
	protected static $usersTable ="lbs_user";
	protected static $userloginDataTable = "lbs_user_login_data"; 
	
	public function __construct()
	{
				
	}
	
	public function set_basic_vars($username="",$password="",$email="")
	{
		$this->username = $username;
		$this->password = $password;
		$this->email    = $email;
	}
	public function set_all_vars($user_id="",$username="",$first_name="",$last_name="",$country="",$city="",$street="",$phone="",$zip="",$description="")
	{
		$this->user_id = $user_id;
		$this->username = $username;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->country = $country;
		$this->city = $city;
		$this->street = $street;
		$this->phone = $phone;
		$this->zip = $zip;
		$description = $description;
	}
	 	
	public function setUserId($id="")
	{
		$this->user_id = $id;
	}
	
	public function getUserId()
	{
		return  $this->user_id;
	}
	public function getUserEmail($userID="")
	{
		global $gdbObj;
		$result = $gdbObj->query("SELECT email FROM ".self::$usersTable." WHERE user_id= '$userID' ");
		$count = $gdbObj->num_rows($result);
		if ($count == 1) 
		{
			return mysql_result($result, 0, 0);
		}
		
		
	}
	/* Add a new user.
	 * Returns true on success, false on error */
	public function create()
	{
		global $gdbObj;
		$username = $gdbObj->escape_value($this->username);
		$password = $gdbObj->escape_value($this->password);
		$email    = $gdbObj->escape_value($this->email);
				 
		$sql = "INSERT INTO ".self::$usersTable." (username,password,email) values('$username','$password','$email')";
		if($gdbObj->query($sql))
		{
			$this->user_id = $gdbObj->insert_id();
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	/* Update user profile.
	 * Returns true on success, false on error */
	public  function update()
	{
		global $gdbObj;
		$user_id  = $this->user_id;
		$username = $gdbObj->escape_value($this->username);
		$first_name = $gdbObj->escape_value($this->first_name);
		$last_name = $gdbObj->escape_value($this->last_name);
		$country = $gdbObj->escape_value($this->country);
		$city = $gdbObj->escape_value($this->city);
		$street = $gdbObj->escape_value($this->street);
		$phone = $gdbObj->escape_value($this->phone);
		$zip = $gdbObj->escape_value($this->zip);
		$description = $gdbObj->escape_value($this->description);
		
		$sql = "UPDATE  ".self::$usersTable." SET username = '$username',first_name = '$first_name', last_name =  '$last_name', street = '$street', city = '$city', country = '$country', zip_code = '$zip' , phone = '$phone', description = '$description' where user_id = '$user_id'";
		if($gdbObj->query($sql))
		{
			$this->user_id = $gdbObj->insert_id();
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/* Remove an user.
	 * Returns true on success, false on error */
	public function delete()
	{
		global $gdbObj;
		$user_id  = $this->user_id;
		$sql = "DELETE FROM lbs_user WHERE user_id='$user_id'";
		if($gdbObj->query($sql))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function addUserGeoData()
	{
		global $gdbObj;
		$last_login = time();
		$sql = "INSERT INTO ".self::$userloginDataTable." (user_id,last_logged_in_time,ip,country,city) VALUES ($this->user_id,$last_login,'','','')";
	    if($gdbObj->query($sql))
		{
			
		}
	}
	
		
	public function updateUserGeoData()
	{
	
	}
	
	public function deleteUserGeoData()
	{
	
	}
	
	/* Returns account type forthe given user id
	Returns 0 for free users
	Reurns 1 or 2 for premium users */
	public function getUserAccountType($userID="")
	{
		global $gdbObj;
		$result = $gdbObj->query("SELECT account_type FROM ".self::$usersTable." WHERE user_id = '$userID'");
		if($gdbObj->num_rows($result) == 1)
		{
			$accountType = mysql_result($result, 0, 0);
			switch($accountType)
			{
				case 0:
					return 0;
					break;
				case 1:
					return 1;
					break;
				case 2:
					return 2;
					break;
				default:
					return 0;
			}
		}
		return 0;
	}
	
	public function isUserExists($userID="")
	{
		global $gdbObj;
		$userID = mysql_real_escape_string($userID);
		$userID = eregi_replace("`", "", $userID);
		$result = $gdbObj->query("SELECT * FROM ".self::$usersTable." WHERE user_id= '$userID' ");
		$count = $gdbObj->num_rows($result);
		if ($count < 1) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function getAccountType($accountType)
	{
		
		if($accountType == 1)
		{
			return 'Silver';
		}
		else if($accountType == 2)
		{
			return 'Gold';
		}
		else
		{
			return 'Bronze';
		}
		
	}
	
	
}
$guserObj = new User();
?>
