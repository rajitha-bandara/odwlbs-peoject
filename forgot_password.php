<?php 
@session_start();
require_once('includes/init.php');
require_once('includes/process_forgot_password.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Places.com :: Reset Password</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
     <!-- Le styles -->
    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/960_24_col.css" rel="stylesheet">
    <link href="public/css/reset.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
	<link href="public/css/slide_show.css" rel="stylesheet">
    <link href="public/css/validator.css" rel="stylesheet">
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="public/icons/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
    <link rel="apple-touch-icon-precomposed" href="">
    
    <script src="public/js/livevalidation.js"></script>
    <script src="public/js/jquery.js"></script>
    <script src="public/js/bpopup-0.6.0.min.js"></script>
 	
    <script src="public/js/functions.js"></script>
   
<style type="text/css">
.response-waiting {
background:url(public/img/loading_small.gif) no-repeat;
}

.response-success {
background:url(public/img/tick.png) no-repeat;
}

.response-error {
background:url(public/img/cross.png) no-repeat;
}
</style>

</head>

<body>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  
  <?php require_once('templates/header.php');?>
  
  <?php require_once('templates/linkbar.html');?>
  
  
  
  <div id="page_content" class="grid_24">
  <div id="page_topic"><h1>Reset Your Password</h1></div>

    <div  id="response">
  <?php echo $outputForUser;?>
  </div>
     
     <div id="forgot_password_model" align="center">
      <p>No problem! Give us the email address you registered with and we'll send you instructions on how to reset your password. </p><br><br><br>
      <form method="post" action="" class="form-horizontal">
      Email <input type="text" name="txtforgotpass" class="input-large">
      <button name="btnReset" class="btn btn-primary" type="submit">Reset</button>
      </form>
     </div>
  
     </div>
  
  <div class="clear"></div>
 
  <?php require_once('templates/footer.php');?>

</div>
<?php require_once('templates/popup_login.php');?>

<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
    
    
    <script src="public/js/bootstrap/bootstrap-button.js"></script>
    
</body>
</html>
