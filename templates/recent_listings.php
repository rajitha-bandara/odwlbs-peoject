<?php
global $gbizObj;
$result = $gbizObj->fetchRecentListings();
if(result != false)
{
	echo "<ul>";
	echo $result;
	echo "</ul>";
}
?>