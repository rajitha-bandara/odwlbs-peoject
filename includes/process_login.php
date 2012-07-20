<?php @session_start();?>
<?php
//Initialize Variables
$msg 	  = '';
$uname    = '';
$password = '';
$isValid  = false;
$remember = 'no';
if (isset($_POST['btnSignIn'])) 
{
	
if (isset($_POST['txtUname']) && isset($_POST['txtPass'])) 
{
	
	$uname     = $_POST['txtUname'];
	$password  = $_POST['txtPass'];
	$remember  = $_POST['remember'];
	$uname     = stripslashes($uname);
	$password  = stripslashes($password);
	$uname     = strip_tags($uname);
	$password  = strip_tags($password);

	//Error handling condition
	if ((!$uname) || (!$password))
	 { 

		$msg = $msg.'Please Fill In Both Fields';

	 } 
	//Process The Info If No Errors
	else 
	{ 
		
		$uname    = mysql_real_escape_string($uname); //Secure the string before adding to database
	    $password = mysql_real_escape_string($password); //Secure the string before adding to database
		//$password = md5($password); // Add MD5 Hash to the password variable
		
        
		global $gauthObj;
		$isValid =  $gauthObj->login($uname, $password);
		if($isValid)// Valid member
		{
			//update user login data
			global $guserObj;
			$guserObj->setUserId($id);
			$guserObj->updateUserGeoData();
        	
			//handle user remember be option
			if($remember == "yes")
			{
				$gauthObj-> rememberMe();
			}
			
			//Send them to homepage then exit script
			header("location: index.php");
			exit();
		}
		else // invalid member
		{
			$msg = $msg.'Invalid username  or password ';
				
		}
	}
}
	
else 
{ 
    $msg = $msg. "Incorrect Login Data <br> Please Try Again";
}
     
}

?>
