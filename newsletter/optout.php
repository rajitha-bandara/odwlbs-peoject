<?php 
require_once('../includes/init.php');
?>
<?php
global $gdbObj;
$msg = "";

if (isset($_GET['e'])) 
{
	$email = $_GET['e'];
	$email = $gdbObj->escape_value($email);
	
}
else
{
	//$page_topic = "Bad Request";
	//$page_body = "You are not allowed to view this page";
	//require_once('../msg_to_user.php');
	exit();
}
?>

<?php
if (isset($_POST['btnUnsub']))
{
$result = mysql_query("SELECT * FROM lbs_newsletters WHERE email='$email' LIMIT 1");
$row_count = mysql_num_rows($result);
if ($row_count==1) 
{
		$delete_result = mysql_query("DELETE  FROM lbs_newsletters WHERE email='$email' LIMIT 1");
		if($delete_result)
		{
			$message = "You have been successfully removed from this subscriber list. You will no longer hear from us..";
		}
		else
		{
			$message =  "Sorry there seems to be trouble removing your listing. Please email Admin directly using this email address put an email address here";
		}
		
} 
else 
{
	$message = "Invalid Email";	
		
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Unsubscribe</title>
<link href="../public/css/newsletter.css" rel="stylesheet">
<link href="../public/css/bootstrap.min.css" rel="stylesheet">
<link href="../public/css/bootstrap.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
    <![endif]-->
    
    <link rel="shortcut icon" href="../public/icons/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
    <link rel="apple-touch-icon-precomposed" href="">
</head>

<body id="optout_bg">

<div id="container">
<div id="header">
<img src="../public/img/logo.png" alt="Places.com">
</div>
<div id="content">
<h2>Unsubscribe</h2>
<p>We will be sorry to see you go, but it’s your subscription to manage as you see fit.</p>
<form action=""  method="post" id="unsub_form">
<button name="btnUnsub" id="btnUnsub" class="btn btn-primary">Unsubscribe</button>
</form>

<div id="unsub-response">
<?php echo $message; ?>
</div>
</div>

</div>

<script src="../public/js/bootstrap/bootstrap-button.js"></script>
</body>
</html>