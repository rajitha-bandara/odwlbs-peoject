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
$keywords= "";

$lid = mysql_real_escape_string($lid);
$lid = eregi_replace("`", "", $lid);
$sql = mysql_query("SELECT * FROM lbs_biz_keywords WHERE biz_id = '$lid' ");
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

$sql = "SELECT b.title AS title, k.keyword AS keywords FROM lbs_biz b, lbs_biz_keywords k WHERE b.biz_id = '$lid' AND b.biz_id = k.biz_id";
		
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$title  = $row['title'];
	$keywords= $row['keywords'];
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
<h4 id="edit_profile_item"> - Manage Keywords</h4>

<div  class="alert alert-success" id="keyword_info">
   <h3>Why should I choose keywords carefully?</h3>
	<ul>
    <li id="biz_info_list_item">Selecting better keywords help increase traffic to your site</li>
    <li id="biz_info_list_item">We advice you to select most appropriate keywords </li>
     
    </ul>
  </div>
  
<div  id="response">
  <?php echo $msg;?>
  
  </div>

<div id="list_keywords">
<?php
if($keywords == "")
{
	echo "You have not set any keyword for this listing";
}
else
{
	echo "Keywords you have chosen";
}
?>
<ul>  
<?php   
$arr = explode(',',$keywords);
foreach ($arr as $word) {
    echo "<li>". $word . "</li>";
}
?>
</ul>  
</div>


<h4>Update your keywords below</h4>
<form action="" method="post"  name="keyword-form" class="form-inline" id="keyword-form">
			<div class="control-group">
              <label class="control-label" for="input05">Enter each keyword separated by comma</label>
              <div class="controls">
                <textarea name="txtKeywords" rows="5" class="input-xlarge" id="txtKeywords"><?php echo $keywords;?></textarea>
                 
              </div>
            </div>
        
            <br>
            <div class="control-group">
           
            <div class="controls">
            <div id="submit">
            
            <button class="btn btn-primary" name="btnEditKeywords">Update</button>
                      
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