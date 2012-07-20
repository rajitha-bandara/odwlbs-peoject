<?php 
require_once('init.php');
require_once('phpmailer/phpmailer.inc.php');
?>
<?php
$outputForUser = "";
if ($_POST['txtforgotpass'] != "") {

       $email = $_POST['txtforgotpass'];
       $email   = strip_tags($email);
	   $email= eregi_replace("`", "", $email);
	   $email = mysql_real_escape_string($email);
       $sql = mysql_query("SELECT * FROM lbs_user WHERE email='$email' AND email_activated='1'"); 
       $emailcheck = mysql_num_rows($sql);
       if ($emailcheck == 0){
       
              $outputForUser = 'The email address you provided can not be verified, please try again.';
			  $status = "NOTOK";
                                                                                     

       } else {
				 
				$emailcut = substr($email, 0, 4); // Takes first four characters from the user email address
				$randNum = rand(); 
                $tempPass = "$emailcut$randNum"; 
				$hashTempPass = md5($tempPass);

                @mysql_query("UPDATE lbs_user SET password='$hashTempPass' where email='$email'") or die("cannot set your new password");

                $from = "admin@rajitha.freeiz.com";
				$to = "$email";
                $subject ="Login Password Generated";
				
                $body="<div align=center><br>----------------------------- New Login Password --------------------------------<br><br><br>
                Your New Password for our site is: <font color=\"#006600\"><u>$tempPass</u></font><br><br />
				</div>";

				$mail = new phpmailer();
				$mail->From = $from;
				$mail->AddAddress($to);
				$mail->Subject = $subject;
				$mail->Body = $message;
				$result = $mail->Send();
				
				$outputForUser = "An email sent to your account with the information to reset your password";
				$status = "OK";
				
				
				
     }

} else {
 
   $outputForUser = 'Please enter your email address.';
   $status = "NOTOK";

}

if($status == "OK")
{
	$outputForUser = "<div class='alert alert-info' id='error_box'>".$outputForUser."</div>";
}
else
{
	$outputForUser = "<div class='alert alert-error' id='error_box'>".$outputForUser."</div>";
}
?>