<?php @session_start();?>
<?php require_once('phpmailer/phpmailer.inc.php');?>

<?php
/* Check whether the user has selected a package
 * Accept the user only if session for a requested package is set
 * and it is one of valid packages 
 * Otherwise redirect the user to listing plans page */
if(isset($_SESSION['req_pkg']))
{
	$requested_pkg = $_SESSION['req_pkg'];
	if($requested_pkg != "bronze" && $requested_pkg != "silver" && $requested_pkg != "gold")
	{
		$redirect_to = 3;
		$page_topic = "Invalid Listing Plan";
		$page_body = "Found some problem with your listing plan. You will be redirected to our listing plans page shortly.";
		require_once('msg_to_user.php');
		exit();
	}
	
}
else
{
	$redirect_to = 3;
	$page_topic = "Invalid Listing Plan";
	$page_body = "Found some problem with your listing plan. You will be redirected to our listing plans page shortly.";
	require_once('msg_to_user.php');
	exit();
}

/*  Check whether the user has logged in
 * Accept the user as a logged in user if necessary url parameters are set
 * or a session is set
 * Otherwise redirect the user to Register page */
if ($_GET['id']) 
{
  	$id = $_GET['id'];
} 
else if (isset($_SESSION['auth_id'])) 
{
	$id = $_SESSION['auth_id'];
} 
else 
{
	$redirect_to = 1;
	$page_topic = "Only site members can add listings";
	$page_body = "You need to register in the site in order to add listing. If you have already registered, you can login now.";
	require_once('msg_to_user.php');
	exit();
}
?>
<?php 
require_once('init.php');
?>
<?php
$title    	 = "";
$logo        = "";
$tagline     = "";
$category 	 = "";
$subCategory = "";
$description = "";
$web		 = "";

$email	  	 = "";
$phone	  	 = "";
$fax	  	 = "";
$mobile	  	 = "";
$contactP	 = "";
$street	  	 = "";
$city	  	 = "";
$country	 = "";
$zip	  	 = "";
$latitude	 = "";
$longitude	 = "";
$keywords	 = "";
$banerType   = "";
$caption     = "";
$destination = "";

$isAccepted  = "";
$msg		 = "";
$package	 = '';

$upload_errors = array(
UPLOAD_ERR_OK 				=> "No errors.",
UPLOAD_ERR_INI_SIZE  		=> "Larger than upload_max_filesize.",
UPLOAD_ERR_FORM_SIZE 		=> "Larger than form MAX_FILE_SIZE.",
UPLOAD_ERR_PARTIAL 			=> "Partial upload.",
UPLOAD_ERR_NO_FILE 			=> "No file.",
UPLOAD_ERR_NO_TMP_DIR 		=> "No temporary directory.",
UPLOAD_ERR_CANT_WRITE 		=> "Can't write to disk.",
UPLOAD_ERR_EXTENSION 		=> "File upload stopped by extension."
);


global  $gvalObj;//Add a reference to Validate class

if(isset($_POST['btnSave']))
{
	$title          = $_POST[txtTitle];
	$tagline 		= $_POST[txtTagline];
	$category       = $_POST[listCategory];
	$subCategory 	= $_POST[listSubcategory];
	$description	= $_POST[txtDes];
	$urlProtocol    = $_POST[listUrlProtocol];
	$web			= $_POST[txtWeb];
	
	$email			= $_POST[txtEmail];
	$phone			= $_POST[txtPhone];
	$fax			= $_POST[txtFax];
	$mobile			= $_POST[txtMobile];
	$contactP		= $_POST[txtContactP];
	$street			= $_POST[txtStreet];
	$city			= $_POST[txtCity];
	$country		= $_POST[listCountry];
	$zip			= $_POST[txtZip];
	$latitude		= $_POST[txtLat];
	$longitude		= $_POST[txtLong];
	$keywords		= $_POST[txtKeywords];
	$banerType      = $_POST[listType];
	$caption        = $_POST[txtCaption];
	$adUrlProtocol  = $_POST[listAdUrlProtocol];
	$destination    = $_POST[txtDestination];
	$isAccepted		= $_POST[cbAccept];
	
	$listingUrl     = $urlProtocol.$web;
	$adUrl			= $adUrlProtocol.$destination;

	if(empty($title)|| empty($tagline)|| empty($category)|| empty($subCategory)|| 
	empty($email)|| empty($phone) || empty($contactP) || empty($street) ||
	empty($city) ||empty($country))
	{
		$msg=$msg."Required fields can not be left blank<br>";
		$status = "NOTOK";
	}	
	else
	{
		if(!isset($_POST['cbAccept']))
		{
			$msg=$msg."You must read and accept ".DOMAIN_NAME." Terms and Conditions  to add a listing<br>";
			$status ="NOTOK";
		}
		
		if($web == NULL)
		{
			$listingUrl="";
		}
		else if($web!=NULL && !$gvalObj ->isURL($listingUrl))
		{
			$msg=$msg."Invalid business URL<br>";
			$status ="NOTOK";
		}
		
		if($destination == NULL)
		{
			$adUrl="";
		}
		else if($destination!=NULL && !$gvalObj ->isURL($adUrl))
		{
			$msg=$msg."Invalid banner URL<br>";
			$status ="NOTOK";
		}

		if(!$gvalObj ->isEmail($email))
		{
			$msg=$msg."Invalid Email address<br>";
			$status ="NOTOK";
		}

		if(!$gvalObj ->isPhone($phone))
		{
			$msg=$msg."Invalid phone number<br>";
			$status ="NOTOK";
		}
		
		if(!empty($zip) && !$gvalObj ->isZipCode($zip))
		{
			$msg=$msg."Invalid zip code<br>";
			$status ="NOTOK";
		}
		
	
	}
										  
	if($status=="NOTOK")
	{
		$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
		
		
	}
	else
	{
		$package = getPkg($requested_pkg);
				
		$gbizObj = new Business();
		$gbizObj->setBizInfo($id,$title,$tagline,$category,$subCategory,$description,$listingUrl,$package);
		$gbizObj->setContactInfo($email,$phone,$fax,$mobile,$contactP);
		$gbizObj->setLocationInfo($street,$city,$country,$zip,$latitude,$longitude);
		$gbizObj->setKeywordInfo($keywords);
		
		$result = $gbizObj->add();// Cause insert a new business record in to the database
		if($result)
		{
			
			$bizId = $gbizObj->business_id;
			$gbannerObj = new Banner();
			$gbannerObj->setBannerInfo($banerType,$caption,$adUrl,$bizId,$id);
			$gbannerObj->add();
			$bannerId = $gdbObj->insert_id();
			$msg .= "<b>You have successfully added a new business with the Id of ".$bizId."</b>";
			$msg = "<div class='alert alert-info' id='error_box'>".$msg."</div>";
			
			//upload the logo file 
			mkdir(SITE_ROOT."/biz/$bizId", 0755);
			$tmp_file = $_FILES['file_upload']['tmp_name'];
			$originalFile = basename($_FILES['file_upload']['name']);
			$extension = substr($originalFile, strripos($originalFile, '.'),strlen($originalFile));
			$renamedFile = "logo".$extension;
			$upload_dir = "biz/$bizId";
			move_uploaded_file($tmp_file, $upload_dir."/".$renamedFile);
			
			//upload banner image file
			$tmp_file = $_FILES['banner_upload']['tmp_name'];
			$originalFile = basename($_FILES['banner_upload']['name']);
			$extension = substr($originalFile, strripos($originalFile, '.'),strlen($originalFile));
			$renamedFile = "ad_".$bannerId."".$extension;
			$upload_dir = "biz/$bizId";
			move_uploaded_file($tmp_file, $upload_dir."/".$renamedFile);
			
			/*//upload product sample 
			$tmp_file = $_FILES['sample_upload']['tmp_name'];
			$originalFile = basename($_FILES['sample_upload']['name']);
			$extension = substr($originalFile, strripos($originalFile, '.'),strlen($originalFile));
			$renamedFile = "sample".$extension;
			$upload_dir = "biz/$bizId";
			move_uploaded_file($tmp_file, $upload_dir."/".$renamedFile);*/
			
			//Send email to user about his new listing under moderation
			global $guserObj;
			
			$to = $guserObj->getUserEmail($logOptions_id);
			$from = ADMIN_EMAIL;
			
			$subject = DOMAIN_NAME ." Listing Notification";
			$message = "Dear, $logOptions_username,
		
			You have just added one listing in our directory with the title of $title. You will be notified again once the 	moderation process is completed. Stay tuned!
			Regards,
			".DOMAIN_NAME." team
			";
		
			$mail = new phpmailer();
			$mail->From = $from;
			$mail->AddAddress($to);
			$mail->Subject = $subject;
			$mail->Body = $message;
			$result = $mail->Send();
			
			//Send email to moderator about  new listing to be moderated
			$to = ADMIN_EMAIL;
			$subject = "New Listing for moderation";
			$message = "$logOptions_username has submitted a new listing. Visit this link to approve it";
			
			$mail = new phpmailer();
			//$mail->From = $from;
			$mail->AddAddress($to);
			$mail->Subject = $subject;
			$mail->Body = $message;
			$result = $mail->Send();
		}
		else
		{
			$msg .= "An error occurred while inserting data. Please try again.";
			$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
		}
		
		
	}
	
	
}

function clearAll()
{
	$title    	 = "";
	$logo        = "";
	$tagline     = "";
	$category 	 = "";
	$subCategory = "";
	$description = "";
	$web		 = "";
	$email	  	 = "";
	$phone	  	 = "";
	$fax	  	 = "";
	$mobile	  	 = "";
	$contactP	 = "";
	$street	  	 = "";
	$city	  	 = "";
	$country	 = "";
	$zip	  	 = "";
	$latitude	 = "";
	$longitude	 = "";
	$keywords	 = "";
}
	
?>
