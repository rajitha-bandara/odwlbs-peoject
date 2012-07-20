<?php

$sql = mysql_query("SELECT * FROM lbs_newsletters WHERE received='0' LIMIT 20");
$numRows = mysql_num_rows($sql); 
if($numrows > 0)
{
$mail_body = '';
while($row = mysql_fetch_array($sql))
{
	$id = $row["id"];
	$email = $row["email"];
	$name = $row["name"];
	
	$mail_body = '<html>
<body style="background-color:#CCC; color:#000; font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
<h3><a href="http://www.developphp.com"><img src="http://www.yoursite.com/images/logo.png" alt="DevelopPHP" width="216" height="36" border="0"></a> Newsletter
</h3>
<p>Hello ' . $name . ',</p>
<p>You can make this out to be just like most any web page or design format you require using HTML and CSS.</p>
<p>~Adam @ DevelopPHP</p>
<hr>
<p>To opt out of receiving this newsletter,  <a href="optout.php?e=' . $email . '">click here</a> and we will remove you from the listing immediately.</p>
</body>
</html>';
    $subject = "Develop PHP Newsletter";
    $headers  = "From:newsletter@developphp.com\r\n";
    $headers .= "Content-type: text/html\r\n";
    $to = "$email";

    $mail_result = mail($to, $subject, $mail_body, $headers);
	
	if ($mail_result) {
		mysql_query("UPDATE lbs_newsletters SET received='1' WHERE email='$email' LIMIT 1");
	} else 
	{
	   // this else statement can be used to write into an error log if the mail function fails
	   // It can also be removed if you do not need error logging
	}
	
}//end of while loop
}
else
{
	 $subj = "Newsletter Campaign Has Ended";
	 $body = "The current newsletter campaign has ended. All have been sent the newsletter.";
     $hdr  = "From:newsletter@developphp.com\r\n";
     $hdr .= "Content-type: text/html\r\n";
     mail("yourEmailAddressHere", $subj, $body, $hdr);
}
?>
