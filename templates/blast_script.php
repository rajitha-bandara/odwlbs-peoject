<?php
require_once('../includes/init.php');
?>
<?php
require_once('../includes/phpmailer/phpmailer.inc.php');
?>
<?php
//prepare newsletter to be sent


$sql = mysql_query("SELECT * FROM lbs_newsletters WHERE received='0' LIMIT 20");
$numRows = mysql_num_rows($sql); 
$mail_body = '';
while($row = mysql_fetch_array($sql)){
	$id = $row["id"];
	$email = $row["email"];
	$name = $row["name"];
	
	ob_start();
	include("newsletter.php");
	$var = ob_get_clean();
		
	$message = $var;
    $from = ADMIN_EMAIL;
	$subject = "Email blast at places.com";
	$to = "$email";

    $mail = new phpmailer();
		$mail->From = $from;
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->Send();
	
	
		mysql_query("UPDATE lbs_newsletters SET received='1' WHERE email='$email' LIMIT 1");
	
	
}
?>
<?php
// This section is for sending the site owner a message informing them that
// all people in the database have been sent the newsletter for the current campaign
if ($numRows == 0) 
{
	 
	 $subject =  "Newsletter Campaign Has Ended";
	 $message = "The current newsletter campaign has ended. All have been sent the newsletter.";
     $from = ADMIN_EMAIL;
	 $to = "rcb44u@gmail.com";
	 
     $mail = new phpmailer();
		$mail->From = $from;
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->Send();
	
}

?>