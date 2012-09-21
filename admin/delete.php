<?php 
require_once('../../includes/init.php');

$items = rtrim($_POST['items'],",");
$sql = "DELETE FROM `lbs_user` WHERE `user_id` IN ($items)";

$total = count(explode(",",$items)); 
$result = mysql_query($sql);
$total = mysql_affected_rows(); 

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-type: text/x-json");
$json = "";
$json .= "{\n";
$json .= "query: '".$sql."',\n";
$json .= "total: $total,\n";
$json .= "}\n";
echo $json;
 ?>