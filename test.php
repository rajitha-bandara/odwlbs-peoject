<?php
@session_start();
require('includes/init.php');
require('includes/geo_location_all.php');	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="public/css/jquery.fancybox.css?v=2.1.0">
<script type="text/javascript" src="public/js/jquery.js"></script>
<script type="text/javascript" src="public/js/jquery.fancybox.js?v=2.1.0"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#link1").fancybox();
  $("#link2").fancybox();
  
  $("#btn").click(function(){
	
	
    $("#link1").trigger('click');
	
  });
});

</script>
</head>

<body>
<?php
global $gbizObj;
echo $gbizObj->fetchNearListings($user_lat,$user_long,$user_country,'top','inner',3);
?>
</body>
</html>