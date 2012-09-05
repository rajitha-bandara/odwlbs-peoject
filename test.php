<?php

	//$opt = $_POST['opt'];
	

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
<form method="post" action="">

<select name="opt">
<option value="0">0</option>
<option value="1">1</option>
</select>
<input type="button" id="btn" value="Button" name="btn" />
</form>
<div style="display:none;"> 
 <a href="#test1" id="link1">Click</a>
 <a href="#test2" id="link2">Click</a>
</div>

<div id="test1" style="display:none;">fancy box content
fancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box content
fancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box content
fancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box contentfancy box content
</div>

<div id="test2" style="display:none;">fancy box content
asassss
</div>

</body>
</html>