<?php
@session_start();
require('includes/init.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="public/css/jquery.fancybox.css?v=2.1.0">
<script type="text/javascript" src="public/js/jquery.js"></script>
<script type="text/javascript" src="public/js/jquery.fancybox.js?v=2.1.0"></script>


</head>

<body>
<?php
$browser = get_browser(null, true);
print_r($browser);
echo $browser->platform;
?>
</body>
</html>