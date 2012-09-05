<?php 
require('../../includes/init.php');

$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = 'biz_id';
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

global $gbizObj;
$result = $gbizObj->fetchAllListings($where,$sort,$limit);
$total = $gbizObj->countListings($where);

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
$json .= "id:'".$row['biz_id']."',";
$json .= "cell:['".$row['biz_id']."','".$row['title']."'";
$json .= ",'".addslashes($row['user_id'])."'";
$json .= ",'".addslashes($row['main_category'])."'";
$json .= ",'".addslashes($row['sub_category'])."'";
$json .= ",'".addslashes($row['url'])."'";
$json .= ",'".addslashes($row['status'])."'";
$json .= ",'".addslashes($row['content_approved'])."'";
$json .= ",'".addslashes($row['package'])."'";
$json .= ",'".addslashes($row['date_submit'])."'";
$json .= ",'".addslashes($row['date_expire'])."']";
$json .= "}";
$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>