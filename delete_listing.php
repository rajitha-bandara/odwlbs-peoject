<?php @session_start();?>
<?php 
if (isset($_GET['id']) && isset($_GET['lid'])) {
	
     $id = $_GET['id'];
	 $lid = $_GET['lid'];

} else if (isset($_SESSION['auth_id']) && isset($_GET['lid'])) {
	
	 $id = $_SESSION['auth_id'];
	 $lid = $_GET['lid'];
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

global $gbizObj;
?>
<?php
if(isset($_POST['btnDel']))
{
	$msg = "";
	global $gbizObj;
	$gbizObj->setListingId($lid);
	for($i=1;$i<=8;$i++)
	{
		$gbizObj->delete($i);
	}
	//delete listing directory and  all its contents
	$dirPath = "biz/$lid";
	recursiveRemoveDirectory($dirPath);
	header("Location: view_listings.php?id=$id");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php print DOMAIN_NAME. " :: "."$logOptions_username"?>'s listings</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<script src="public/js/jquery.js"></script>
<script src="public/js/bpopup-0.6.0.min.js"></script>
<script src="public/js/functions.js"></script>
<script type="text/javascript">
    function showLizDel()
	{
		//status = document.getElementById('lizDel').style.visibility;
		
		$(document).ready(function()
		{  
		   var isHidden;
		   if ($('#lizDel').css('visibility') == 'hidden')
		   {
			   
			  $('#lizDel').css('visibility', 'visible');
			  $('#del_listing').css('visibility', 'hidden');
		   }
		  
			
		});
	}
	
	
    </script>
<?php require_once('includes/ga_property_id.php');?>
</head>
<body>
<?php require_once('includes/geo_location_all.php');?>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <?php require('templates/profile_left_column.php');?>
  <div id="profile_body" class="grid_12">
    <h1 id="profile_page_topic">Delete Listing - <?php echo $gbizObj->getTitle($lid);?> </h1>
    <div id="del_listing" class="grid_12"> You are going to delete this listing. Please consider that this can not be undone. Once you delete a listing, it can not be recovered. The search engines will  not track this listing.<br>
      <br>
      Click Back button to cancel listing deletion and go to previous page. <br>
      Click Proceed button to go ahead with listing deletion.
      <div id="controls">
        <input name="" type="button" class="btn-primary" value="Go Back" style="margin-right:100px;" onClick="history.go(-1)">
        <input name="" type="button" class="btn-danger" value="Proceed" onClick="showLizDel()">
      </div>
      <div id="lizDel" align="center"> Click Delete button to remove <?php echo "<b>".$gbizObj->getTitle($lid)."</b>";?> with all its information. <br>
        <br>
        <form method="post" action="">
          <input  type="submit" class="btn-danger" value="Delete" name="btnDel" onClick="hidelizDel()">
        </form>
      </div>
      <div id="response"><?php echo $msg;?></div>
    </div>
  </div>
  <div class="grid_6">
    <?php require_once('templates/right_column.php');?>
  </div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>