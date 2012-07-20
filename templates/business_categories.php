<div id="category_wrapper" class="grid_17">
  <div id="home_page_content_topic">Business Categories</div>
  <?php
    $sql = "SELECT * FROM lbs_biz_main_categories ORDER BY RAND() LIMIT 0,9";
	$result  = mysql_query($sql);
	$count = 0;///Track total number of images
	$i = 0;//Track number of images for a column
	echo "<div class='grid_5' id='category'>";
	while($row=mysql_fetch_array($result))
	{
		//Retrive sub categories of the main category 
		$subcat = "";
		$sql2 = "SELECT * FROM lbs_biz_sub_categories WHERE main_category_id = ".$row["main_category_id"]." LIMIT 0,2";
		$result2  = mysql_query($sql2);
		while($row2=mysql_fetch_array($result2))
		{
			$subcat.= $row2["name"]. ", ";
		}
		//Control the number of categories for a column
		if($i >=3 )
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
    <div class="clear"></div>
   <div class="grid_17" id="view_all" style="padding-left:500px;"><a href="directory.php">View All</a></div> 
  </div>