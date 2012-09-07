<?php
global $gbizObj;
echo $gbizObj->fetchNearListings($user_lat,$user_long,$user_country,'top','inner',1);
?>