<?php
class Admin
{
	private $admin_id;
	private $username;
	private $password;
	private $email;
	private $date_joined;
	var $salt = "34asdf34";
	var $domain = DOMAIN_NAME;
	protected static $adminTable ="lbs_admin";

	function __construct()
	{

	}

	public function setAdminId($id="")
	{
		$this->admin_id = $id;
	}

	public function getAdminId()
	{
		return  $this->admin_id;
	}

	public function setVars($username="",$password="",$email="")
	{
		$this->username = $username;
		$this->password = $password;
		$this->email    = $email;
	}

	// Create a new administrator
	public function create($username="",$password="",$email="")
	{
		global $gdbObj;
		$this->username  = $username = $gdbObj->escape_value($username);
		$this->password  = $password = $gdbObj->escape_value($password);
		$this->email     = $email    = $gdbObj->escape_value($email);

		$date = date('Y-m-d H:i:s');
		$sql = "INSERT INTO ".self::$adminTable." (username,password,email,date_joined) values('$username','$password','$email','$date')";
		if($gdbObj->query($sql))
		{
			$this->admin_id = $gdbObj->insert_id();
			return true;
		}
		else
		{
			return false;
		}

	}


	// Handle admin login
	public function login($username, $password)
	{

		global $gdbObj;
		$username = $gdbObj->escape_value($username);
		$password = $gdbObj->escape_value($password);
		$result = $gdbObj->query("SELECT * FROM ".self::$adminTable  ." WHERE username = '$username' AND password = '$password'");
		if($gdbObj->num_rows($result) == 1)
		{
			$this->admin_id = mysql_result($result, 0, 0);
			$this->username = $username;
			$this->password = $password;
			$this->ok = true;

			session_register('admin_sess_id');
			$_SESSION['admin_sess_id'] = $this->admin_id;
				
			session_register('admin_username');
			$_SESSION['admin_username'] = $this->username;
				
			session_register('admin_password');
			$_SESSION['admin_password'] = md5($this->password . $this->salt);
				
			return true;
		}
		return false;
	}

	//Check  session
	public function check_session()
	{
		if(isset($_SESSION['admin_username']) && isset($_SESSION['admin_password']))
		{
			return $this->check($_SESSION['admin_username'], $_SESSION['admin_password']);
		}
		return  false;
	}

	//Check  cookie
	public function check_cookie()
	{
		if(isset($_COOKIE['admin_username']) && isset($_COOKIE['admin_password']))
		{
			return $this->check($_COOKIE['admin_username'], $_COOKIE['admin_password']);
		}
		return  false;
	}

	/*
	 * Find whether an admin really exists
	* with the given username and password
	*/
	public function check($username, $password)
	{
		global $gdbObj;
		$result = $gdbObj->query("SELECT admin_id, password FROM ".self::$adminTable ." WHERE username = '$username'");
		if($gdbObj->num_rows($result) == 1)
		{
			$db_password = mysql_result($result, 0, 1);
			if(md5($db_password . $this->salt) == $password)
			{
				$this->admin_id = mysql_result($result, 0, 0);
				$this->username = $username;
				return true;
			}
		}
		return false;
	}

	//Handle admin logout
	public function logout()
	{
		$this->admin_id = 0;
		$this->username = "Guest";
		$this->ok = false;

		$_SESSION['admin_sess_id'] = "";
		$_SESSION['admin_username'] = "";
		$_SESSION['admin_password'] = "";

		setcookie("admin_username", "", time() - 3600, $this->domain);
		setcookie("admin_password", "", time() - 3600, $this->domain);
	}

	//Remember me function
	public function rememberMe()
	{
		setcookie("admin_sess_id", $this->admin_id, time()+60*60*24*30,"/business_directory");
		setcookie("admin_username", $this->username, time()+60*60*24*30,"/business_directory");
		setcookie("admin_password", md5($this->password . $this->salt), time()+60*60*24*30,"/business_directory");
	}
}

$gadminObj = new Admin();
?>