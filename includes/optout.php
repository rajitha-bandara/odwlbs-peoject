<?php
global $gdbObj;
if (isset($_GET['e'])) 
{
	$email = $_GET['e'];
	$email = $gdbObj->escape_value($email);
	$sql_delete = mysql_query("DELETE FROM lbs_newsletters WHERE email='$email' LIMIT 1");
	if (!$sql_delete) 
	{
		echo "Sorry there seems to be trouble removing your listing. Please email Admin directly using this email address: put an email address here";
	} else 
	{
		echo "It is done. You will not receive our newsletter ever again unless you relist.";
	}
}
?>