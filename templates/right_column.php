<div id="new_biz">
  
  <div style="margin-left:40px;margin-top:10px;margin-bottom:20px;">
    <?php
	global $gbizObj;
	echo $gbizObj->fetchNearListings($user_lat,$user_long,$user_country,'vertical','inner',1);
	?>
  </div> 
  
  <div style="margin-left:40px;margin-top:10px;margin-bottom:10px;">
    <div style="margin-bottom:15px;">
    <?php
	global $gbizObj;
	echo $gbizObj->fetchNearListings($user_lat,$user_long,$user_country,'bottom','inner',1);
	?>
    </div>
   
    <div style="margin-bottom:15px;">
    <?php
	global $gbizObj;
	echo $gbizObj->fetchNearListings($user_lat,$user_long,$user_country,'bottom','inner',1);
	?>
    </div>
  </div> 
         
</div>