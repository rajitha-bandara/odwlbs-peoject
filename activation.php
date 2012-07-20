<?php
require_once('includes/init.php');
?>
<?php
global $gdbObj;
// If the GET variable id is not empty, run this script, if variable is empty, give message at bottom
if ($_GET['id'] != "") 
{  
    $id = $_GET['id']; 
    $hashpass = $_GET['sequence']; 

    $id  = $gdbObj->escape_value($id );
    $id = eregi_replace("`", "", $id);

    $hashpass = $gdbObj->escape_value($hashpass);
    $hashpass = eregi_replace("`", "", $hashpass);

    $sql = mysql_query("UPDATE lbs_user SET email_activated='1' WHERE user_id='$id' AND password='$hashpass'"); 

    $sql_doublecheck = mysql_query("SELECT * FROM lbs_user WHERE user_id ='$id' AND password='$hashpass' AND email_activated='1'"); 
    $doublecheck = mysql_num_rows($sql_doublecheck); 

    if($doublecheck == 0)
	{ 
		$page_topic = "Activation Error";
        $msgToUser = "<h3><strong><font color=red>Your account could not be activated!</font></strong><h3><br />
        <br />
        Please email site administrator and request manual activation."; 
    	require_once('msg_to_user.php'); 
		exit();
    } 
	elseif($doublecheck > 0) 
	{ 
		//Add user login data record to lbs_user_login_data as default
		global $guserObj;
		$guserObj->setUserId($id);
		$guserObj->addUserGeoData();
		
		$page_topic = "Activation Complete!";
        $msgToUser = "
		<h2>Activation Complete!</h2><br /><br /><h3><font color=\"#0066CC\"><strong>Your account has been successfully activated. You can now login using the username and password you chose during the registration. 
        </strong></font></h3>";
	
	$redirect_to = 2;
    require_once('msg_to_user.php');
	//header('Location: listing_plans.php');
	exit();
	}
 } 

$page_topic = "Activation Error";
$msgToUser ="Essential data from the activation URL is missing! Close your browser, go back to your email inbox, and please use the full URL supplied in the activation link we sent you.<br />
<br />
".ADMIN_EMAIL;
require_once('msg_to_user.php');
exit();
?>