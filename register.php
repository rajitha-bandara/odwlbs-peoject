<?php @session_start();?>
<?php 
require_once('includes/init.php');
require_once('includes/process_register.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Places.com :: New Member</title>
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
	<link href="public/css/validator.css" rel="stylesheet">
    <link href="public/css/ad.css" rel="stylesheet">
    
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

<body onLoad="checkTerms()">
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  
  <?php require_once('templates/header.php');?>
  
  <?php require_once('templates/linkbar.html');?>
  
 
  
  <div class="grid_17">
  
  		
        <div id="main_wrapper" class="grid_17"><!--Begins main wrapper-->
        <div id="page_topic"><h1>Register New User</h1></div>
      
    
   <div id="register_response">
     <?php 
	 
	 echo "<span style='color:red;font-weight:bold' id='error_msg'>$msg</span><br><br>";
	 echo "<span style='color:blue;font-weight:bold'>$success_msg</span><br><br>";
	 ?>
     </div>
     
    <div id="reg-form">
    <form action="" method="post" class="form-horizontal" id="reg_form" name="reg_form">
        <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
              <input type="text" class="input-large" name="txtUname" id="txtUname" value="<?php print "$username";?>">
          </div>
              <div class="output">
        			<script type="text/javascript">
	 				var txtUname = new LiveValidation('txtUname');
	 				txtUname.add( Validate.Presence );
					</script>
   		  </div>
        </div>
          
           <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
              <input type="password" class="input-large" name="txtPass" id="txtPass" value="<?php print "$password";?>">
             </div>
              <div class="output">
        			<script type="text/javascript">
	 				 var txtPass = new LiveValidation('txtPass');
					 txtPass.add( Validate.Length, { minimum: 4 } );
					 var txtPass = new LiveValidation('txtPass');
					 txtPass.add( Validate.Presence );
					</script>
       		 </div>
          </div>
       
       		<div class="control-group">
            <label class="control-label">Confirm Password</label>
            <div class="controls">
              <input type="password" class="input-large" name="txtConfPass" id="txtConfPass" value="<?php print "$confirm_password";?>">
              </div>
              <div class="output">
        			<script type="text/javascript">
	 				 var txtConfPass = new LiveValidation('txtConfPass');
					 txtConfPass.add(Validate.Confirmation, { match: 'txtPass'} );
					 var txtConfPass = new LiveValidation('txtConfPass');
					 txtConfPass.add( Validate.Presence );
					</script>
       		  </div>
          </div>
          
          <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
             <input type="text" class="input-large" name="txtEmail" id="txtEmail" value="<?php print "$email";?>">
            </div>
              <div class="output">
        			<script type="text/javascript">
	 				  var txtEmail = new LiveValidation('txtEmail');
					   txtEmail.add(Validate.Email );
					   var txtEmail = new LiveValidation('txtEmail');
					   txtEmail.add( Validate.Presence );
					</script>
       		</div>
          </div>
          
          <div class="control-group">
            <div class="controls">
             <?php require_once('includes/captcha/display_captcha.php'); ?>
            </div>
          
          </div>
          
          <div class="control-group">
            <div class="controls">
           
            </div>
            <div class="controls">
            <input type="checkbox" name="cbAccept" id="cbAccept" onChange="checkTerms()" value="I have read and accept Places.com Conditions of use."> I have read and accept Places.com <a href="terms.php" target="_blank">Terms of use</a>.
            <br>
             <input type="checkbox" name="cbUpdates" id="cbUpdates"  value="Receive updates and notifications via Email."> Receive updates and notifications via Email.
            </div>
              
          </div>
          
          <div class="control-group">
            <div class="controls">
              <button type="submit" name="btnReg" class="btn btn-primary">Register</button>
            </div>
        </div>
         
      </form>
    </div> <!--End of  reg-form-->
   
    </div><!--End of main wrapper-->
  </div>
  
  <div class="grid_6" id="sec_col">
  <?php require_once('templates/right_column.php');?>
    
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
