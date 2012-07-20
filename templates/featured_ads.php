<div id="category_wrapper" class="grid_17">
  <div id="home_page_content_topic">Featured Classifieds</div>
  
    <?php
	$count = 0;
	$i = 0;
	echo "<div class='grid_5' style='margin:0px;'>";
	while($count<=5)
	{
		
		if($i >=2 )
		{
			$i = 0;
			echo "</div>";
			echo "<div class='grid_5' style='margin:0px;'>";
			
		}
		echo "<div style='width:190px;height:200px;margin-left:10px;margin-right:10px;'>
		<img src='ads/150_150/$count.gif'>
		
		</div>";
		$count++;
		$i++;
	}
	echo "</div>";
	?>
     <div class="clear"></div>
   <div class="grid_17" id="view_all" style="padding-left:500px;">View All</div> 
  </div>