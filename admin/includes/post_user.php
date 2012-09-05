<?php 
require('../../includes/init.php');

$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = 'user_id';
if (!$sortorder) $sortorder = 'asc';
		if($_POST['query']!=''){
			$where = "WHERE `".$_POST['qtype']."` LIKE '%".$_POST['query']."%' ";
		} else {
			$where ='';
		}
		if($_POST['letter_pressed']!=''){
			$where = "WHERE `".$_POST['qtype']."` LIKE '".$_POST['letter_pressed']."%' ";	
		}
		if($_POST['letter_pressed']=='#'){
			$where = "WHERE `".$_POST['qtype']."` REGEXP '[[:digit:]]' ";
		}
$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);

$limit = "LIMIT $start, $rp";

global $guserObj;
$result = $guserObj->fetchAllUsers($where,$sort,$limit);
$total = $guserObj->countUsers($where);

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-type: text/x-json");
$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";
$rc = false;
while ($row = mysql_fetch_array($result)) {
if ($rc) $json .= ",";
$json .= "\n{";
$json .= "id:'".$row['user_id']."',";
$json .= "cell:['".$row['user_id']."','".$row['username']."'";
$json .= ",'".addslashes($row['password'])."'";
$json .= ",'".addslashes($row['email'])."'";
$json .= ",'".addslashes($row['first_name'])."'";
$json .= ",'".addslashes($row['last_name'])."'";
$json .= ",'".addslashes($row['gender'])."'";
$json .= ",'".addslashes($row['street'])."'";
$json .= ",'".addslashes($row['city'])."'";
$json .= ",'".addslashes($row['country'])."'";
$json .= ",'".addslashes($row['zip_code'])."'";
$json .= ",'".addslashes($row['phone'])."'";
$json .= ",'".addslashes($row['email_activated'])."']";
$json .= "}";
$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>