<?php @session_start();?>
<?php 
require_once('includes/init.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Places.com Business Directory</title>
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

<body>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  
  <?php require_once('templates/header.php');?>
  
  <?php require_once('templates/linkbar.html');?>
  
 <div class="grid_17">
   <div id="main_wrapper" class="grid_17"><!--Begins main wrapper-->
   
  
  <div id="page_topic"><h1>Listing Categories</h1></div>
  		
   <!--begins directory-->     
   
      
    <div class="grid_17">
  <div id="home_page_content_topic"></div>
  <?php
    $sql = "SELECT * FROM lbs_biz_main_categories";
	$result  = mysql_query($sql);
	$count = 0;///Track total number of images
	$i = 0;//Track number of images for a column
	echo "<div class='grid_5' id='category'>";
	while($row=mysql_fetch_array($result))
	{
		//Retrive sub categories of the main category 
		$subcat = "";
		$sql2 = "SELECT * FROM lbs_biz_sub_categories WHERE main_category_id = ".$row["main_category_id"]." ";
		$result2  = mysql_query($sql2);
		while($row2=mysql_fetch_array($result2))
		{
			$subcat.= $row2["name"]. ", ";
		}
		//Control the number of categories for a column
		if($i >=4 )
		{
			$i = 0;
			echo "</div>";
			echo "<div class='grid_5' id='category'>";
			
		}
		//Display main category image,name and its sub categories
		echo "<div class='category' >
		<div class='category_image'><img src='public/img/categories/".$row["main_category_id"].".png' width='48' height='48' alt='".$row["name"]."'></div>

<div id='category_description'>
<h3>".$row["name"]."</h3>
<p>".$subcat."</p>
</div>
</div>";

		$count++;
		$i++;
	}
	echo "</div>";
	?>
    
    </div>
   
    <div class="clear"></div>
   
  </div>
  
   </div>
  
<!--End of directory-->
  
  <div class="grid_6" id="sec_col">
    <?php require_once('templates/right_column.php');?>
   </div>
  
  <?php require_once('templates/footer.php');?>
   
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     

</body>
</html>
