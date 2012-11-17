  <div id="user_geo_wrapper" class="grid_24">
  
  <div id="user_geo" class="grid_24" >
  <?php 
   	  echo "<ul id='user_location_list'>";
	  echo "<li>You are in </li>&nbsp;";
	  if($user_city != "" && $user_region != "" && $user_country != "")
	  {
		   echo "<li>".$user_address."</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
	  }
	  else if($user_city == "" && $user_region == "" && $user_country != "")
	  {
		  echo "<li>".$user_country."</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	  }
	  else
	  {
	  		echo "<li>Unknown</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
	  }
	  echo "<li id='displayText'><a href='imap.php'  class='fancybox fancybox.iframe'>Change Location</a></li>";
	  echo "</ul>";
  ?>
 	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
			
		});	
								   
		</script>
   </div>
    
   </div>