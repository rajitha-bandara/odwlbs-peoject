<?php @session_start();?>
<?php
global $gdbObj;
if($_GET['action'] == 'sign_in')
{
	$uname    = '';
	$password = '';
	$isValid  = false;
	
	if (isset($_POST['txtUname']) && isset($_POST['txtPass'])) 
	{

	$uname     = $_POST['txtUname'];
	$password  = $_POST['txtPass'];
	$remember  = $_POST['remember'];
	$uname     = stripslashes($uname);
	$password  = stripslashes($password);
	$uname     = strip_tags($uname);
	$password  = strip_tags($password);
		
	if ((!$uname) || (!$password))
	 { 
		$status = "error";
		$message = "Please Fill In Both Fields";	

	 } 
	
	else 
	{
		$uname    = $gdbObj->escape_value($uname); 
	    $password = $gdbObj->escape_value($password); 
		//$password = md5($password); // Add MD5 Hash to the password variable
		
       global $gauthObj;
		$isValid =  $gauthObj->login($uname, $password);
		
		if($isValid)// Valid member
		{
			//add user login details
			$uid = $_SESSION['auth_id'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$ua = getBrowser();
			$browserName =  $ua['name'];
			$platform = $ua['platform'];
			global $guserObj;
			$guserObj->addUserLoginData($uid,$ip,$browserName,$platform);
			
			
			//handle user remember be option
			if($remember == "yes")
			{
				$gauthObj-> rememberMe();
			}
			 
			if(isset($_SESSION['req_pkg']) && ($_SESSION['req_pkg']=="bronze" || $_SESSION['req_pkg']=="silver" || $_SESSION['req_pkg']=="gold"))
			{
				//send to add listing page as they may have made a requet for new listing
				$status = "successaddlisting";
				$message = "Redirecting...";
			}
			else
			{
			//Send them to homepage then exit script
			$status = "success";
			$message = "Redirecting...";
			}
			
		}
		else // invalid member
		{
			$status = "error";
			$message = "Invalid username or password";
				
		}
	}
}
else 
{ 
	$status = "error";
	$message = "Incorrect Login Data <br> Please Try Again";
    
}
	
	//return json response
	$data = array(
		'status' => $status,
		'message' => $message,
		
	);
	
	echo json_encode($data);
	exit;
}
?>