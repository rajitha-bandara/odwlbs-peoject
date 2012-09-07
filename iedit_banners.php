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
<h4 id="edit_profile_item"> - Manage Banners</h4>
  
<div  id="response">
  <?php echo $msg;?>
  </div>


<form action="" method="post"  name="banner-form" class="form-inline" id="banner-form" enctype="multipart/form-data">
			 <div class="control-group">
              <label class="control-label" for="input05">Display Location</label>
              <div class="controls">
                 <select name="listType" class="input-xlarge">
                 <option value="">-- Select a Type --</option>
					<option value="top" selected="selected">Top (468px x 60px)</option>
					<option value="bottom" >Bottom (234px x 60px)</option>
					<option value="featured" >Featured (180px x 150px)</option>
					<option value="vertical" >Vertical (240px x 400px)</option>
                 </select>
              </div>
            </div>
            
                  <div class="control-group">
              <label class="control-label" for="input05">Caption</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtCaption" name="txtCaption" value="<?php echo $caption;?>">
              </div>
            </div>
            
            <div class="control-group">
            <label class="control-label" for="input02">Image</label>
            <div class="controls">
              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
              <input type="file" name="banner_upload" id="banner_upload" class="input-xlarge" />
               <p class="help-block">Maximum file size: 500 KB. Allowed extensions: png gif jpg jpeg</p>
            </div>
            </div>
                       
             <div class="control-group">
              <label class="control-label" for="input05">Destination URL</label>
              <div class="controls">
             
              <select name="listAdUrlProtocol" style="width:80px;">
              <option value="http://">http://</option>
              <option value="https://">https://</option>
              </select>
              <input type="text" class="input-large" id="input06" name="txtDestination" value="<?php echo $destination;?>">
              </div>
            </div>
        
            <br>
            <div class="control-group">
           
            <div class="controls">
            <div id="submit">
            
            <button class="btn btn-primary" name="btnEditBanners">Update</button>
                      
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