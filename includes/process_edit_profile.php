<?php 
if(isset($_POST['btnupdate']))
{
	$username = $_POST['txtuname'];
	$first_name = $_POST['txtfname'];
	$last_name = $_POST['txtlname'];
	$country = $_POST['listcountry'];
	$city = $_POST['txtcity'];
	$street = $_POST['txtstreet'];
	$phone = $_POST['txtphone'];
	$zip_code = $_POST['txtzip'];
	$description = $_POST['txtdescription'];
	$msg = "";
	$user = new User();
	$user->set_all_vars($id,$username,$first_name,$last_name,$country,$city,$street,$phone,$zip_code,$description);
	$result = $user->update();
	if($result)
	{
		$msg = "<span style='color:#00F;font-weight:bold'>Your profile has been updated successfully.</span>";
	}
	else
	{
		$msg = "<span style='color:#F00;font-weight:bold'>Unable to update your profile. Please try again.</span>";
	}
}
?>