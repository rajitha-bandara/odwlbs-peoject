<?php @session_start();?>
<?php 
if ($_GET['lid']) {
	
     $lid = $_GET['lid'];

} 
else {
	
   	 $page_topic = "Page Not Found";
	 $msgToUser = "The requested page can not be found.";
	 echo "<h3>".$page_topic."</h3>";
	 echo "<h4>".$msgToUser."</h4>";
   	 exit();
}
?>
<?php
require_once('includes/init.php');
require_once('includes/process_edit_listings.php');
?>

<?php

$email = "";
$phone = "";
$fax = "";
$mobile = "";
$contactPerson = "";

$lid = mysql_real_escape_string($lid);
$lid = eregi_replace("`", "", $lid);
$sql = mysql_query("SELECT * FROM lbs_biz WHERE biz_id = '$lid' ");
// Make sure this listing actually exists
$existCount = mysql_num_rows($sql);
 if ($existCount < 1) 
{
	 $page_topic = "Unrecognized Listing!";
	 $msgToUser = "The listing you are trying to access does not exist.";
	 echo "<h3>".$page_topic."</h3>";
	 echo "<h4>".$msgToUser."</h4>";
	 exit();
}

$sql = "SELECT b.title AS title,c.email AS email, c.phone AS phone, c.fax AS fax, c.mobile AS mobile, c.contact_person AS contactP FROM lbs_biz b, lbs_biz_contacts c WHERE b.biz_id = '$lid' AND b.biz_id = c.biz_id";
		
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$title = $row['title'];
	$email = $row['email'];
	$phone = $row['phone'];
	$fax = $row['fax'];
	$mobile = $row['mobile'];
	$contactPerson = $row['contactP'];
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="public/css/bootstrap.css" rel="stylesheet">
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/profile.css" rel="stylesheet">

<script src="public/js/jquery.js"></script>
<script src="public/js/functions.js"></script>

<style type="text/css">

</style>

<script type="text/javascript">

</script>
</head>

<body>

<div id="edit_profile_container">
<h3 id="profile_page_topic"><?php echo $title;?></h3>
<h4 id="edit_profile_item"> - Contact Info</h4>
<div  id="response">
  <?php echo $msg;?>
  
  </div>
  
<form action="" method="post"  name="listing-form" class="form-inline">
			<div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">*</span>Email</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtEmail" name="txtEmail" value="<?php echo $email;?>">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">*</span>Phone Number</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtPhone" name="txtPhone" value="<?php echo $phone;?>" >
              </div>
            </div>
            
             <div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Fax Number</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtFax" name="txtFax" value="<?php echo $fax;?>">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Mobile</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtMobile" name="txtMobile" value="<?php echo $mobile;?>">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">*</span>Contact Person</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtContactP" name="txtContactP" value="<?php echo $contactPerson;?>">
              </div>
            </div>	
            <br><br>
            <div class="control-group">
            <div class="controls">
            <div id="submit">
            
            <button class="btn btn-primary" name="btnEditContacts">Update</button>
                      
            <button class="btn btn-primary" onClick="ClearListing(1)">Cancel</button>
            
            </div>
            
            </div>
          </div>
            
</form>
</div>

<script src="public/js/bootstrap/bootstrap-button.js"></script>
<script src="public/js/bootstrap/bootstrap-alert.js"></script>
</body>
</html>