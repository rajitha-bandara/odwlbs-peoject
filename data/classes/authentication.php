<?php
class Auth
{
	
	var $user_id;
	var $username;
	var $password;
    var $salt = "34asdf34";
	var $domain = DOMAIN_NAME;
		
	//Function to check the session
	public function check_session()
	{
		if(isset($_SESSION['auth_username']) && isset($_SESSION['auth_password']))
		{
			return $this->check($_SESSION['auth_username'], $_SESSION['auth_password']);
		}
		return  false;
	}
 
	//Function to check the cookie
	public function check_cookie()
	{
		if(isset($_COOKIE['auth_username']) && isset($_COOKIE['auth_password']))
		{
			return $this->check($_COOKIE['auth_username'], $_COOKIE['auth_password']);
		}
		return  false;
	}
 
	//Function for the login
	public function login($username, $password)
	{
		
		global $gdbObj;
		$username = $gdbObj->escape_value($username);
		$password = $gdbObj->escape_value($password);
		$result = $gdbObj->query("SELECT * FROM lbs_user WHERE username = '$username' AND password = '$password' AND email_activated = '1'");
		if($gdbObj->num_rows($result) == 1)
		{
			$this->user_id = mysql_result($result, 0, 0);
			$this->username = $username;
			$this->password = $password;
			$this->ok = true;
 
			session_register('auth_id');
			$_SESSION['auth_id'] = $this->user_id;
			
			session_register('auth_username');
			$_SESSION['auth_username'] = $this->username;
			
			session_register('auth_password');
			$_SESSION['auth_password'] = md5($this->password . $this->salt);
			
			/* setcookie("auth_id", $this->user_id, time()+60*60*24*30,"/business_directory");
			setcookie("auth_username", $this->username, time()+60*60*24*30,"/business_directory");
			setcookie("auth_password", md5($this->password . $this->salt), time()+60*60*24*30,"/business_directory"); */
 			return true;
		}
		return false;
	}		
 
	//Function on check
	public function check($username, $password)
	{
		global $gdbObj;
		$result = $gdbObj->query("SELECT user_id, password FROM lbs_user WHERE username = '$username'");
		if($gdbObj->num_rows($result) == 1)
		{
			$db_password = mysql_result($result, 0, 1);
			if(md5($db_password . $this->salt) == $password)
			{
				$this->user_id = mysql_result($result, 0, 0);
				$this->username = $username;
				return true;
			}
		}			
		return false;
	}
 
 	//Function to logout
	public function logout()
	{
		$this->user_id = 0;
		$this->username = "Guest";
		$this->ok = false;
 
		$_SESSION['auth_id'] = "";
		$_SESSION['auth_username'] = "";
		$_SESSION['auth_password'] = "";
 
		setcookie("auth_username", "", time() - 3600, $this->domain);
		setcookie("auth_password", "", time() - 3600, $this->domain);
	}
	
	//Remember me function
	public function rememberMe()
	{
		setcookie("auth_id", $this->user_id, time()+60*60*24*30,"/business_directory");
		setcookie("auth_username", $this->username, time()+60*60*24*30,"/business_directory");
		setcookie("auth_password", md5($this->password . $this->salt), time()+60*60*24*30,"/business_directory");
	}
 
}
$gauthObj = new Auth();
?>