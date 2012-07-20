<?php
global $gvalObj ;
global $gdbObj;
if($_GET['action'] == 'signup_for_newsletter')
{
	$signup_email        = $_POST['txtSignupEmail'];
	$signup_email        = $gdbObj->escape_value($signup_email);
		
	if(empty($signup_email))
	{
		$status = "error";
		$message = "Enter your email address!";
	}
	
	else if(!$gvalObj ->isEmail($signup_email))
	{
		$status = "error";
		$message = "Invalid email address!";
	} 
	
	else 
	{
		$existingSignup = mysql_query("SELECT * FROM lbs_newsletters WHERE email='$signup_email'");   
		if(mysql_num_rows($existingSignup) < 1)
		{
			$date = date('Y-m-d');
			$time = date('H:i:s');
			
			$insertSignup = mysql_query("INSERT INTO lbs_newsletters (email) VALUES ('$signup_email')");
			if($insertSignup)
			{ 
				$status = "success";
				$message = "Thank you for signed up!";	
			}
			else 
			{
				$status = "error";
				$message = "Ooops, There has been some error!";	
			}
		}
		else 
		{ 
			$status = "error";
			$message = "This email address already exists!";
		}
	}
	
	//return json response
	$data = array(
		'status' => $status,
		'message' => $message
	);
	
	echo json_encode($data);
	exit;
}

?>