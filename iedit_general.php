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
?>

<?php
$title = "";
$tagline = "";
$mainCategory = "";
$subCategory = "";
$description= "";
$web = "";
$logo = "";

$email = "";
$phone = "";
$fax = "";
$mobile = "";
$contactPerson = "";


$street = "";
$city = "";
$country = "";
$zipcode = "";
$latitude = "";
$longitude = "";

$keywords= "";

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

$sql = "SELECT b.title AS title,b.tagline AS tagline, b.description AS des, b.url AS url, m.name AS mainCat, s.name AS subCat, c.email AS email, c.phone AS phone, c.fax AS fax, c.mobile AS mobile, c.contact_person AS contactP, l.street AS street, l.city AS city, l.country AS country, l.zip_code AS zip,l.latitude AS lat,l.longitude AS lon,k.keyword AS keywords FROM lbs_biz b, lbs_biz_contacts c, lbs_biz_location l, lbs_biz_main_categories m, lbs_biz_sub_categories s, lbs_biz_keywords k WHERE b.biz_id = '$lid' AND b.biz_id = c.biz_id AND b.biz_id = l.biz_id AND b.biz_id = k.biz_id AND b.main_category = m.main_category_id AND b.sub_category = s.sub_category_id";
		
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	$title = $row['title'];
	$tagline = $row['tagline'];
	$description= $row['des'];
	$web = $row['url'];
	$mainCategory = $row['mainCat'];
	$subCategory = $row['subCat'];
		
	$email = $row['email'];
	$phone = $row['phone'];
	$fax = $row['fax'];
	$mobile = $row['mobile'];
	$contactPerson = $row['contactP'];
	
	$street = $row['street'];
	$city = $row['city'];
	$country = $row['country'];
	$zipcode = $row['zip'];
	$latitude = $row['lat'];
	$longitude = $row['lon'];
	
	$keywords= $row['keywords'];
	
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

<style type="text/css">
body{
	background-color:#FFF;
}
</style>
</head>

<body>

<div>
<form action="" method="post" enctype="multipart/form-data" name="listing-form" class="form-horizontal" onSubmit="map_geocode( this.address.value ); return false;">
<div class="control-group">
            <label class="control-label" for="input01"><span class="red_star">*</span>Business Title</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="input01" name="txtTitle" value="<?php echo $title;?>">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="input02"><span class="red_star">&nbsp;</span>Logo</label>
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
		<option value="" selected="selected"></option>
		<?php
		$query = "select * from lbs_biz_main_categories ";
		$results = mysql_query($query);
		
		while ($rows = mysql_fetch_assoc(@$results))
		{?>
			<option value="<?php echo $rows['main_category_id'];?>"><?php echo $rows['name'];?></option>
		<?php
		}?>
		</select>
      </div><!--End of Main category control-->
       </div>
       
         <div class="control-group">
         <label class="control-label" for="input03" id="show_heading"><span class="red_star">*</span>Sub Category</label>
         <div class="controls" >
         	<div id="show_sub_categories">
			<img src="public/img/loader.gif" style="margin-top:8px; float:left" id="loader" alt="" />
            
		</div>
         </div>
         </div>
        
           <div class="control-group">
            <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Business Description</label>
            <div class="controls">
              <textarea name="txtDes" id="textarea" cols="45" rows="5" class="input-xlarge"></textarea>
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
            
</form>
</div>
</body>
</html>