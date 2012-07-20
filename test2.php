<?php @session_start();?>
<?php 
require_once('includes/init.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/960_24_col.css" rel="stylesheet">
    <link href="public/css/reset.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
	<link href="public/css/ad.css" rel="stylesheet">    
<title>Untitled Document</title>
<style type="text/css">

</style>
</head>

<body>

 <?php
    $sql = "SELECT * FROM lbs_biz_main_categories";
	$result  = mysql_query($sql);
	$count = 0;///Track total number of images
	$i = 0;//Track number of images for a column
	echo "<div  id=''>";
	while($row=mysql_fetch_array($result))
	{
		//Retrive sub categories of the main category 
		$subcat = "";
		$sql2 = "SELECT * FROM lbs_biz_sub_categories WHERE main_category_id = ".$row["main_category_id"]." ";
		$result2  = mysql_query($sql2);
		while($row2=mysql_fetch_array($result2))
		{
			$subcat.= "<li>".$row2["name"]. "</li>";
		}
		//Control the number of categories for a column
		
		//Display main category image,name and its sub categories
		echo "<div class='' > <h3>".$row["name"]."</h3></div>
		
<div id=''>

<p><ul>".$subcat."</ul></p>

</div>
</div>";

		
	}
	
	?>
    
</body>
</html>