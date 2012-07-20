<?php @session_start();?>

<?php 
if ($_GET['id']) {
	
     $id = $_GET['id'];

} else if (isset($_SESSION['auth_id'])) {
	
	 $id = $_SESSION['auth_id'];

} else {
	
   include_once "deny_access.php";
   exit();
}
?>
<?php
require_once('includes/init.php');
?>

<?php
$email = "";
$fname = "";


$id = mysql_real_escape_string($id);
$id = eregi_replace("`", "", $id);
$sql = mysql_query("SELECT * FROM lbs_user WHERE user_id= '$id' ");
// Make sure this person a visitor is trying to view actually exists
$existCount = mysql_num_rows($sql);
 if ($existCount < 1) 
{
	 $page_topic = "Unrecognized User!";
	 $msgToUser = "The user you are trying to access does not exist.";
	 require_once('msg_to_user.php');
     exit();
}


while($row = mysql_fetch_array($sql)){ 
	
	$email = $row["email"];
	$fname = $row["first_name"];
	
	
	$check_pic = "members/$logOptions_id/image01.jpg";
	$default_pic = "members/default.png";
	if (file_exists($check_pic))
	{
    	$profile_img = "<img src='$check_pic' width='100px' height= '100px' />"; 
	} else 
	{
		$profile_img = "<img src='$default_pic' width='100px' height= '100px' />";
	}

} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php print DOMAIN_NAME. " :: "."$logOptions_username"?> 's listings</title>
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
    <link href="public/css/profile.css" rel="stylesheet" type="text/css">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="public/icons/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
    <link rel="apple-touch-icon-precomposed" href="">
    
    <script src="public/js/jquery.js"></script>
    <script src="public/js/bpopup-0.6.0.min.js"></script>
    <script src="public/js/functions.js"></script>
	
</head>

<body>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  
  <?php require_once('templates/header.php');?>
  
  <?php require_once('templates/linkbar.html');?>
  
  <?php require('templates/profile_left_column.php');?>
   
   <div id="profile_body" class="grid_12">
                      
           <h1 id="profile_page_topic">My Listings</h1>
           <div id="user_listings" class="grid_12">
           <?php
			global $gbizObj;
			$result =  $gbizObj->fetchListingsByUser($id);
			
			if(!$result)
			{
				echo "0 listings";
			}
			else
			{
				echo "<div id='listing_container'>";
				echo $result;
				echo "</div>";
				
			}
?>
     </div>     
   </div>
    
    <div class="grid_6" id="profile_right_col">
    <?php require_once('templates/right_column.php');?>
   </div> 
   
   <div class="clear"></div>
 
  <?php require_once('templates/footer.php');?>
</div>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  
</body>
</html>