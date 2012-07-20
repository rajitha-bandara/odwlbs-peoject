<?php
require_once('../includes/phpmailer/phpmailer.inc.php');
$username   = "";
$password   = "";
$email      = "";
$role		= "";
$msg 	    = "";
global  $gvalObj;
global $gadminObj;
global $guserObj;
if(isset($_POST['btnAddUser']))
{
	$username         = $_POST[txtUname];
	$password         = $_POST[txtPass];
	$email            =  $_POST[txtEmail];
	$role			  = $_POST[role];
	
	if(empty($_POST[txtUname])|| empty($_POST[txtPass])|| empty($_POST[txtEmail]) || empty($_POST[role]))
	{
		$msg=$msg."Required fields can not be left blank<br>";
		$status ="NOTOK";
	}	
	else
	{
		if(!$gvalObj ->isEmail($email))
		{
			$msg=$msg."Invalid Email address<br>";
			$status ="NOTOK";
		}
		if(strlen($password)<4)
		{
			$msg=$msg."Password should have 4 or more characters <br>";
			$status ="NOTOK";
		}
		
	}
	
	if($status=="NOTOK")
	{
		$msg = "<span id='error_box'>".$msg."</span>";
		
	}
	else
	{
		$password = $md5_passowrd = md5($password);
		if($role == "uadmin")
		{
			
			$result = $gadminObj->create($username,$password,$email);
			if($result)
			{
				$msg = "<span id='success_box'>Created new admin successfully.</span>";
			}
		}
		else if($role == "unormal")
		{
			$guserObj->set_basic_vars($username,$password,$email);
			$guserObj->create();
			$user_id = $guserObj->getUserId();
			//Create directory(folder) to hold each user's files(pics,videos,etc.)
			mkdir(SITE_ROOT."/members/$user_id", 0755);
			$msg = "<span id='success_box'>Created new user successfully.</span>";
			
			//Send Email to actvate the account
			$to = "$email";
				
			$from = ADMIN_EMAIL;
			$subject = "Complete your registration at ".DOMAIN_NAME;
			//Begin HTML Email Message
					
			$message = "Hi $username,
			
			We have created a ". DOMAIN_NAME ." for you and a verification email has been sent 
			to your account. To verify your Email, you will 
			need to click on this link or copy and paste it in your browser:
			
			http://www.places.webuda.com/activation.php?id=$user_id&sequence=$password
			
			This will verify your account and log you into the site. In the future you 
			will be able to log in to this site using the username and 
			password created for you.
			
			Meanwhile we suggest you to read how to really build links for your business 
			and get your sites in top Google search results: 
			
			
			username: $username
			password: $password
			
			If you have any further questions, please don't hesitate to ask, simply reply 
			to this E-mail with your request.
			
			Sincerely,
			--  Admin
			".DOMAIN_NAME."
			";
			//end of message
			$headers  = "From: $from\r\n";
			$headers .= "Content-type: text\r\n";
			
			//mail($to, $subject, $message, $headers);
			
			$mail = new phpmailer();
			$mail->From = $from;
			$mail->AddAddress($to);
			$mail->Subject = $subject;
			$mail->Body = $message;
			//$result = $mail->Send();
		}
	}
}
?>