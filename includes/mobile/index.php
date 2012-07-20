<?php 
require_once '../init.php';
?>
<?php 
/**
 * File to handle all API requests
 * Accepts GET and POST
 *
 * Each request will be identified by TAG
 * Response will be JSON data

 /**
 * check for POST request
 */

if (isset($_POST['tag']) && $_POST['tag'] != '')
{
	$tag = $_POST['tag'];
	$response = array("tag" => $tag, "success" => 0, "error" => 0);

	// check for tag type
	if ($tag == 'login')
	{
		$uname = $_POST['username'];
		$password = $_POST['password'];

		if ((!$uname) || (!$password))
		{

			$response["error"] = 1;
			$response["error_msg"] = "Please Fill In Both Fields";
			//echo json_encode($response);

		}
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

				$response["success"] = 1;
				//$response["uid"] = $guserObj->getUserId($id);
				$response["user"]["name"] = $uname;
				$response["user"]["password"] = $password;
				//echo json_encode($response);
			}
			else // invalid member
			{
				$response["error"] = 1;
				$response["error_msg"] = "Invalid username  or password";
				//echo json_encode($response);

			}
		}
	}
	else
	{
		echo "Invalid Request";
		$response["error"] = 1;
		$response["error_msg"] = "Invalid Request";

	}
	
}
else
{
	echo "Access Denied";
	$response["error"] = 1;
	$response["error_msg"] = "Access Denied";
}
echo json_encode($response);
?>