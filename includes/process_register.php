<?php 
require_once('init.php');
require_once('phpmailer/phpmailer.inc.php');
?>
<?php
$username   = "";
$password   = "";
$email      = "";
$msg 	    = "";
$success_msg= "";

if(isset($_POST['btnReg']))
{
	$username         = $_POST[txtUname];
	$password         = $_POST[txtPass];
	$confirm_password = $_POST[txtConfPass];
	$email            =  $_POST[txtEmail];

	if(empty($_POST[txtUname])|| empty($_POST[txtPass])|| empty($_POST[txtConfPass])|| 
	empty($_POST[txtEmail]))
	{
		$msg=$msg."Required fields can not be left blank<br>";
		$status ="NOTOK";
	}	
	else
	{
		

		if(preg_match("/[^A-Za-z]/",$_POST[txtUname]))
		{
			$msg=$msg."Invalid username<br>";
			$status ="NOTOK";
		}

		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})",$_POST[txtEmail] ))
		{
			$msg=$msg."Invalid email<br>";
			$status ="NOTOK";
		}

		if($_POST[txtPass] && $_POST[txtConfPass])
		{  
			if($_POST[txtPass] != $_POST[txtConfPass])
			{ 
				$msg =$msg. "Passwords do not match!<br>";
				$status ="NOTOK";
		 	}
 		}
 		
		 if($_POST[txtUname])
		 { 
		  	$sql = "SELECT * FROM lbs_user WHERE username = '$_POST[txtUname]'"; 
		  	$res = mysql_query($sql) or die(mysql_error());
    		if(mysql_num_rows($res) > 0)
    		{  
    			$msg =$msg. "The username you supplied is already in use!<br>";
    			$status ="NOTOK";
    		}
    	 }
									  
			if($_POST[txtEmail])
			{ 
			 	$sql2 = "SELECT * FROM lbs_user WHERE email = '$_POST[txtEmail]'";   
			 	$res2 = mysql_query($sql2) or die(mysql_error());   
				if(mysql_num_rows($res2) > 0)
				{ 
					$msg =$msg. "The e-mail address you supplied is already in use of another user!<br>";
					$status ="NOTOK";
				}
			}
			               
			  require_once('captcha/recaptchalib.php');
			  $privatekey = "6LdEAs8SAAAAAHAD64p62xlzOL1aG-1y8BpqhsH4";
			  $resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
			  
			  if (!$resp->is_valid) 
			  {
			    $msg =$msg. "The verification code is incorrect!<br>"; 
			    $status ="NOTOK";
			  }
	}
 										  
	if($status=="NOTOK")
	{
		$msg = $msg;
		
	}
	else
	{
		$md5_passowrd = md5($_POST[txtPass]);
		$user = new User();
		$user->set_basic_vars($_POST[txtUname],$md5_passowrd,$_POST[txtEmail]);
		$user->create();
		$user_id = $user->getUserId();
		//Create directory(folder) to hold each user's files(pics,videos,etc.)
		mkdir(SITE_ROOT."/members/$user_id", 0755);
		
		$success_msg =$success_msg. "You have successfully registered with Places.com!<br>";
		
		//Send Email to actvate the account
		$to = "$email";
			
		$from = ADMIN_EMAIL;
		$subject = "Complete your registration at directory.com";
		//Begin HTML Email Message
				
		$message = "Hi $username,
		
		Thank you for registering at Directory.ac. To verify your Email, you will 
		need to click on this link or copy and paste it in your browser:
		
		http://www.places.webuda.com/activation.php?id=$user_id&sequence=$md5_passowrd
		
		This will verify your account and log you into the site. In the future you 
		will be able to log in to http://***/user using the username and 
		password that you created during registration.
		
		Meanwhile we suggest you to read how to really build links for your business 
		and get your sites in top Google search results: 
		http://***
		
		You may now log in to http://***/user using the following username 
		and password:
		
		username: $username
		password: $password
		
		If you have any further questions, please don't hesitate to ask, simply reply 
		to this E-mail with your request.
		
		Sincerely,
		--  *** team
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

		$page_topic = "Complete your registration at Places.com";
		$msgToUser = "<h2>One Last Step - Activate through Email</h2><h4>OK $username, one last step to verify your email identity:</h4><br />
		In a moment you will be sent an Activation link to your email address. You must activate the account by clicking on the activation link before you can login.<br /><br />
		
		";
		
		require_once('msg_to_user.php');
		
		exit();
		
	}
	
	mysql_close();
	}
?>

