<div id="category_wrapper" class="grid_17">
  <div id="home_page_content_topic">Popular Listings</div>
  
	<div id="popular_listings">
    <?php 
	global $gbizObj;
	echo $gbizObj->fetchPopularListings();
	?>
    </div>
    <div class="clear"></div>
    
  </div>