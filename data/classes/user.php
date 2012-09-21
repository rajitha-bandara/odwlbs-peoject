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
		$this->description = $description;
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
				 
		$sql = "INSERT INTO ".self::$usersTable." (username,password,email,joined_date) values('$username','$password','$email',CURDATE())";
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

	/* Fetch all users in table.
	 * Returns MYSQL result set */
	public function fetchAllUsers($where,$sort,$limit)
	{
		global $gdbObj;
		$sql = "SELECT u.user_id,u.username,u.password,u.email,u.first_name,u.last_name,u.gender,u.email_activated FROM ".self::$usersTable ." u  $where $sort $limit";
		return $gdbObj->query($sql);
	}
	
	/* Fetch user object.*/
	 
	public function fetchUserObj($id)
	{
		global $gdbObj;
		$sql = "SELECT * FROM ".self::$usersTable ." u  where u.user_id = ".$id;
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
	
		
	/* Counts no of user records
	 * returns the count */
	public function countUsers($where)
	{
		global $gdbObj;
		$sql = "SELECT COUNT(user_id) FROM ".self::$usersTable. " $where";
		$result =  $gdbObj->query($sql);
		while ($row = mysql_fetch_array($result)) 
		{
			return $row[0];
		}
	}
	
	/* Counts users by month
	 * returns the count */
	public function countUsersByMonth($month="")
	{
		global $gdbObj;
		$result = $gdbObj->query("SELECT count(*) FROM ".self::$usersTable." WHERE MONTH(joined_date) = '$month' ");
		return mysql_result($result, 0, 0);

	}
	
	/* Activate user email address*/
	public function activateEmail($uid)
	{
		global $gdbObj;
		$sql = "UPDATE  ".self::$usersTable." SET email_activated = '1' where user_id = '$uid'";
		$gdbObj->query($sql);
	}
	
	/* Deactivate user email address*/
	public function deactivateEmail($uid)
	{
		global $gdbObj;
		$sql = "UPDATE  ".self::$usersTable." SET email_activated = '0' where user_id = '$uid'";
		$gdbObj->query($sql);
	}
	
	
	/* Fetch user login details*/
	public function fetchUserLoginData($uid)
	{
		global $gdbObj;
		$sql = "SELECT * FROM ".self::$userloginDataTable." WHERE user_id = '$uid'";
		$result =  $gdbObj->query($sql);
		
		while($row = mysql_fetch_array($result))
		{
			$login_time = $row[1];
			$ip = $row[2];
			$platform = $row[3];
			$browser = $row[4];
			$results.= formatLoginItem($login_time,$ip,$platform,$browser);
		
		}
		return $results;
	}
	
	/* Insert login details for each user*/
	public function addUserLoginData($uid,$ip,$platform,$browser)
	{
		global $gdbObj;
		$sql = "INSERT INTO ".self::$userloginDataTable." (user_id,last_logged_in_time,ip,platform,browser) VALUES ('$uid',NOW(),'$ip','$platform','$browser')";
	    $gdbObj->query($sql);
	}
	
		
	/* public function updateUserLoginData($uid)
	{
		if($this->isUserExists($uid))
		{
			global $gdbObj;
			$last_login = time();
			$ip = $_SERVER['REMOTE_ADDR'];
			$sql = "UPDATE  ".self::$userloginDataTable." SET email_activated = '0' where user_id = '$uid'";
			$gdbObj->query($sql);
		}
		else
		{
			$this->addUserLoginData();
		}
	} */
	
	public function deleteUserLoginData()
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
	
	public function isAlreadyTaken($field,$value)
	{
		global $gdbObj;
		$field = mysql_real_escape_string($field);
		$value = mysql_real_escape_string($value);
		$field = eregi_replace("`", "", $field);
		$value = eregi_replace("`", "", $value);
		$result = $gdbObj->query("SELECT * FROM ".self::$usersTable." WHERE ".$field." = '$value' ");
		$count = $gdbObj->num_rows($result);
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function countBrowserUsage($browser="")
	{
		global $gdbObj;
		$result = $gdbObj->query("SELECT * FROM ".self::$userloginDataTable." WHERE browser = '$browser' ");
		$count = $gdbObj->num_rows($result);
		return $count;
		
	}
	
	/* public function getAccountType($accountType)
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
		
	} */
	
	
}
$guserObj = new User();
?>
