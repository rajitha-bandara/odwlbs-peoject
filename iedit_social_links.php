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
$fb	  	  = "";
$twitter  = "";
$linkedin = "";
$video_chanel	  = "";


$lid = mysql_real_escape_string($lid);
$lid = eregi_replace("`", "", $lid);
$sql = mysql_query("SELECT * FROM lbs_biz_social_links WHERE biz_id = '$lid' ");
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

$sql = "SELECT b.title AS title,s.facebook AS facebook, s.twitter AS twitter, s.linkedin AS linkedin, s.video_channel AS video_chanel FROM lbs_biz b, lbs_biz_social_links s WHERE b.biz_id = '$lid' AND b.biz_id = s.biz_id";
		
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$title  = $row['title'];
	$fb = $row['facebook'];
	$twitter = $row['twitter'];
	$linkedin = $row['linkedin'];
	$video_chanel = $row['video_chanel'];
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
<h4 id="edit_profile_item"> - Social Links</h4>
<div  id="response">
  <?php echo $msg;?>
  
  </div>
  
<form action="" method="post"  name="social-form" class="form-inline" id="social-form">
			<div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Facebook URL</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtFb" name="txtFb" value="<?php echo $fb;?>">
                 <p id="social_ex">Please insert your business Facebook fan page link.</p>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Twitter URL</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtTwitter" name="txtTwitter" value="<?php echo $twitter;?>">
                 <p id="social_ex">eg: https://twitter.com/Places6</p>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Linkedin URL</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="txtLinkedIn" name="txtLinkedIn" value="<?php echo $linkedin;?>">
                <p id="social_ex"></p>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Video Channel</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtVideo" name="txtVideo" value="<?php echo $video_chanel;?>">
                 <p id="social_ex">Please enter your business video channel URL. e.g. Youtube, Vimeo,..</p>
              </div>
            </div>
            <div class="controls">
           	</div>
           
            <br>
            <div class="control-group">
           
            <div class="controls">
            <div id="submit">
            
            <button class="btn btn-primary" name="btnEditSocial">Update</button>
                      
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