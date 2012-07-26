  <div id="user_geo_wrapper" class="grid_24">
  
  <div id="user_geo" class="grid_24" >
  <?php 
   	  echo "<ul id='user_location_list'>";
	  echo "<li>You are in </li>&nbsp;";
	  echo "<li>".$user_address."</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 	  
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