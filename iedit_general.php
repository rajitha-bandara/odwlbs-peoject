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
$title = "";
$tagline = "";
$mainCatId = "";
$mainCategory = "";
$subCategory = "";
$description= "";
$web = "";
$logo = "";


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

$sql = "SELECT b.title AS title,b.tagline AS tagline,b.main_category AS mainCatId, b.description AS des, b.url AS url, m.name AS mainCat, s.name AS subCat FROM lbs_biz b, lbs_biz_main_categories m, lbs_biz_sub_categories s WHERE b.biz_id = '$lid' AND b.main_category = m.main_category_id AND b.sub_category = s.sub_category_id";
		
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$title = $row['title'];
	$tagline = $row['tagline'];
	$description= $row['des'];
	$web = $row['url'];
	$web = removeProtocol($web);
	$mainCatId = $row['mainCatId'];
	$mainCategory = $row['mainCat'];
	$subCategory = $row['subCat'];
		
	
	
}
$images = array();
$images = get_image("logo","biz/$lid");
if($images != null)
{
	$logo = "<img src=biz/$lid/".$images[0]." width='125' height='125'>";
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
#hover_image {
	position:absolute;
	visibility:hidden;
	border:solid 3px #000;
	padding:7px;
	background-color:#000;
}
</style>
<script type="text/javascript">
function ShowPicture(id,Source) {
if (Source=="1"){
if (document.layers) document.layers[''+id+''].visibility = "show"
else if (document.all) document.all[''+id+''].style.visibility = "visible"
else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "visible"
}
else
if (Source=="0"){
if (document.layers) document.layers[''+id+''].visibility = "hide"
else if (document.all) document.all[''+id+''].style.visibility = "hidden"
else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "hidden"
}
}
</script>
</head>
<body>
<div id="edit_profile_container">
  <h3 id="profile_page_topic"><?php echo $title;?></h3>
  <h4 id="edit_profile_item"> - Genral Info</h4>
  <div  id="response"> <?php echo $msg;?> </div>
  <form action="" method="post" enctype="multipart/form-data" name="listing-form" class="form-inline">
    <div class="control-group">
      <label class="control-label" for="input01"><span class="red_star">*</span>Business Title</label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="input01" name="txtTitle" value="<?php echo $title;?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input02"><span class="red_star">&nbsp;</span>Logo</label>
      <a href="#" onMouseOver="ShowPicture('hover_image',1)" onMouseOut="ShowPicture('hover_image',0)">View Logo</a>
      <div id="hover_image"><?php echo $logo;?></div>
      <div class="controls">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type="file" name="file_upload" id="fileLogo" class="input-xlarge" />
        <p class="help-block">Maximum file size: 500 KB. Allowed extensions: png gif jpg jpeg</p>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input03"><span class="red_star">*</span>Tagline</label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="input03" name="txtTagline" value="<?php echo $tagline;?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input04"><span class="red_star">*</span>Business Category</label>
      <div class="controls">
        <select name="listCategory"  id="search_category_id" class="input-xlarge">
          <option value="<?php echo $mainCatId;?>" selected="selected"><?php echo $mainCategory;?></option>
          <?php
		$query = "select * from lbs_biz_main_categories ";
		$results = mysql_query($query);
		
		while ($rows = mysql_fetch_assoc(@$results))
		{?>
          <option value="<?php echo $mainCatId;?>"><?php echo $rows['name'];?></option>
          <?php
		}?>
        </select>
      </div>
      <!--End of Main category control-->
    </div>
    <div class="control-group">
      <label class="control-label" for="input03" id="show_heading"><span class="red_star">*</span>Sub Category</label>
      <div class="controls" >
        <div id="show_sub_categories"> <img src="public/img/loader.gif" style="margin-top:8px; float:left" id="loader" alt="" /> </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Business Description</label>
      <div class="controls">
        <textarea name="txtDes" id="textarea" cols="45" rows="4" class="input-xlarge"><?php echo $description;?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Web Site</label>
      <div class="controls">
        <select name="listUrlProtocol" style="width:80px;">
          <option value="http://">http://</option>
          <option value="https://">https://</option>
        </select>
        <input type="text" class="input-large" id="input06" name="txtWeb" value="<?php echo $web;?>">
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <div id="submit">
          <button class="btn btn-primary" name="btnEditGeneral">Update</button>
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