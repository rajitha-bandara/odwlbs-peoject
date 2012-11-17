 <style type="text/css">
 .qitem{width:150px;height:150px;border:2px solid #222;margin:15px 15px 15px 15px;background:url('bg.gif') no-repeat;overflow:hidden;position:relative;float:left;cursor:hand;cursor:pointer;}.qitem img{border:0;position:absolute;z-index:200;}.qitem .caption{position:absolute;z-index:0;color:#ccc;display:block;}.qitem .caption h4{font-size:12px;padding:10px 5px 0 8px;margin:0;color:#369ead;}.qitem .caption p{font-size:10px;padding:3px 5px 0 8px;margin:0;}.topLeft,.topRight,.bottomLeft,.bottomRight{position:absolute;background-repeat:no-repeat;float:left;}.topLeft{background-position:top left;}.topRight{background-position:top right;}.bottomLeft{background-position:bottom left;}.bottomRight{background-position:bottom right;}.clear{clear:both;}
 </style>
 <?php
	global $gbizObj;
	$arr = $gbizObj->fetchNearListings($user_lat,$user_long,$user_country,'featured','home',6);
	?>
  <div id="category_wrapper" class="grid_17">
  <div id="home_page_content_topic">Featured Classifieds</div>
  
  <div class='grid_5' style='margin:0px;'>
  <div  class="qitem"><a href="<?php echo SITE_URL;?>/listing/<?php echo $arr[0][1];?>-<?php echo $arr[0][0];?>.html" onclick="_gaq.push(['_trackEvent', 'Featured Ad', 'click', '<?php echo $arr[0][1];?>']);"><img src='<?php echo $arr[0][3];?>'></a>
  <span class="caption"><h4><?php echo $arr[0][1];?></h4><p><?php echo $arr[0][2];?></p></span>
  </div>
  
  <div class="qitem"><a href="<?php echo SITE_URL;?>/listing/<?php echo $arr[1][1];?>-<?php echo $arr[1][0];?>.html" onclick="_gaq.push(['_trackEvent', 'Featured Ad', 'click', '<?php echo $arr[1][1];?>']);"><img src='<?php echo $arr[1][3];?>'></a>
  <span class="caption"><h4><?php echo $arr[1][1];?></h4><p><?php echo $arr[1][2];?></p></span>
  </div>
  </div>
  
  
  <div class='grid_5' style='margin:0px;'>
   <div class="qitem"><a href="<?php echo SITE_URL;?>/listing/<?php echo $arr[2][1];?>-<?php echo $arr[2][0];?>.html"><img src='<?php echo $arr[2][3];?>' onclick="_gaq.push(['_trackEvent', 'Featured Ad', 'click', '<?php echo $arr[2][1];?>']);"></a>
  <span class="caption"><h4><?php echo $arr[2][1];?></h4><p><?php echo $arr[2][2];?></p></span>
  </div>
  
   <div class="qitem"><a href="<?php echo SITE_URL;?>/listing/<?php echo $arr[3][1];?>-<?php echo $arr[3][0];?>.html"><img src='<?php echo $arr[3][3];?>' onclick="_gaq.push(['_trackEvent', 'Featured Ad', 'click', '<?php echo $arr[3][1];?>']);"></a>
  <span class="caption"><h4><?php echo $arr[3][1];?></h4><p><?php echo $arr[3][2];?></p></span>
  </div>
  </div>
  
  <div class='grid_5' style='margin:0px;'>
   <div class="qitem"><a href="<?php echo SITE_URL;?>/listing/<?php echo $arr[4][1];?>-<?php echo $arr[4][0];?>.html"><img src='<?php echo $arr[4][3];?>' onclick="_gaq.push(['_trackEvent', 'Featured Ad', 'click', '<?php echo $arr[4][1];?>']);"></a>
  <span class="caption"><h4><?php echo $arr[4][1];?></h4><p><?php echo $arr[4][2];?></p></span>
  </div>
   <div class="qitem"><a href="<?php echo SITE_URL;?>/listing/<?php echo $arr[5][1];?>-<?php echo $arr[5][0];?>.html"><img src='<?php echo $arr[5][3];?>' onclick="_gaq.push(['_trackEvent', 'Featured Ad', 'click', '<?php echo $arr[5][1];?>']);"></a>
  <span class="caption"><h4><?php echo $arr[5][1];?></h4><p><?php echo $arr[5][2];?></p></span>
  </div>
  </div>
  
  <div class="clear"></div>
  <div class="grid_17" id="view_all" style="padding-left:500px;">View All</div> 
  </div>  
	
	
   <div class="clear"></div>
   
  