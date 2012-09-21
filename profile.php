<?php
@session_start();
require_once('includes/init.php');
?>
<?php 
if ($_GET['id']) {
	
     $id = $_GET['id'];

} else if (isset($_SESSION['auth_id'])) {
	
	 $id = $_SESSION['auth_id'];

} else {
	
   include_once "deny_access.php";
   exit();
}


$username = "";
$email = "";
$fname = "";
$lname = "";
$gender = "";
$street = "";
$city = "";
$country = "";
$zipcode = "";
$phone = "";
$description = "";
global $guserObj;

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
	
	$username = $row["username"];
	$email = $row["email"];
	$fname = $row["first_name"];
	$lname = $row["last_name"];
	$gender = $row["gender"];
	$street = $row["street"];
	$city = $row["city"];
	$country = $row["country"];
	$zipcode = $row["zip_code"];
	$phone = $row["phone"];
	$description = $row["description"];
	
	$profile_img = get_profile_image($id);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo DOMAIN_NAME;?> Profile - <?php print "$logOptions_username"?></title>
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
</head>
<body>
<?php require_once('includes/geo_location_all.php');?>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <?php require('templates/profile_left_column.php');?>
  <div class="grid_12" id="profile_body">
    <h1 id="profile_page_topic">View Account Info</h1>
    <table id="profile_details_table" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td width="124" height="37"> Username</td>
        <td width="24"></td>
        <td width="244"><?php print $username; ?></td>
      </tr>
      <tr>
        <td height="49">Email</td>
        <td width="24"></td>
        <td><?php print $email; ?></td>
      </tr>
      <tr>
        <td height="49">First Name</td>
        <td width="24"></td>
        <td><?php print $fname; ?></td>
      </tr>
      <tr>
        <td height="49">Last Name</td>
        <td width="24"></td>
        <td><?php print $lname; ?></td>
      </tr>
      <tr>
        <td height="49">Gender</td>
        <td width="24"></td>
        <td><?php print $gender; ?></td>
      </tr>
      <tr>
        <td height="49">Country</td>
        <td width="24"></td>
        <td><?php print $country; ?></td>
      </tr>
      <tr>
        <td height="49">City</td>
        <td width="24"></td>
        <td><?php print $city; ?></td>
      </tr>
      <tr>
        <td height="49">Street</td>
        <td width="24"></td>
        <td><?php print $street; ?></td>
      </tr>
      <tr>
        <td height="49">Phone</td>
        <td width="24"></td>
        <td><?php print $phone; ?></td>
      </tr>
      <tr>
        <td height="49">Zip Code</td>
        <td width="24"></td>
        <td><?php print $zipcode; ?></td>
      </tr>
      <tr>
        <td height="49">Description</td>
        <td width="24"></td>
        <td><?php print $description; ?></td>
      </tr>
    </table>
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