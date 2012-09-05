<?php
@session_start();
require_once('../../includes/init.php');
 
switch($_POST['action']) {
     case "activateEmail":
	 	$uid = $_POST['uid'];
	    global $guserObj;
		$guserObj->activateEmail($uid);
        break;
		
	case "deactivateEmail" :
		$uid = $_POST['uid'];
	    global $guserObj;
		$guserObj->deactivateEmail($uid);
        break;
		
	case "approveContent" :
		$lid = $_POST['lid'];
	    global $gbizObj;
		$gbizObj->approveContent($lid);
        break;
		
	case "rejectContent" :
		$lid = $_POST['lid'];
	    global $gbizObj;
		$gbizObj->rejectContent($lid);
        break;		
	
	case "updateStatus" :
		$lid = $_POST['lid'];
		$status = $_POST['status'];
	    global $gbizObj;
		$gbizObj->updateStatus($lid,$status);
        break;
}

?>