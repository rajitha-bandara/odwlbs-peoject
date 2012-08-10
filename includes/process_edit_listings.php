<?php @session_start();?>
<?php require_once('phpmailer/phpmailer.inc.php');?>

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
$fb	  	  	 = "";
$twitter  	 = "";
$linkedin 	 = "";
$video_chanel = "";
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

if(isset($_POST['btnEditGeneral']))
{
	$title          = $_POST[txtTitle];
	$tagline 		= $_POST[txtTagline];
	$category       = $_POST[listCategory];
	$subCategory 	= $_POST[listSubcategory];
	$description	= $_POST[txtDes];
	$urlProtocol    = $_POST[listUrlProtocol];
	$web			= $_POST[txtWeb];
	
	$listingUrl     = $urlProtocol.$web;
	
	if(empty($title)|| empty($tagline)|| empty($category)|| empty($subCategory))
	{
		$msg=$msg."Required fields can not be left blank<br>";
		$status = "NOTOK";
	}	
	else
	{
		
		if($web == NULL)
		{
			$listingUrl="";
		}
		else if($web!=NULL && !$gvalObj ->isURL($listingUrl))
		{
			$msg=$msg."Invalid business URL<br>";
			$status ="NOTOK";
		}
		
	}
	
	if($status=="NOTOK")
	{
		$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
		
	}
	else
	{
		$gbizObj = new Business();
		$gbizObj->setListingId($lid);
		$gbizObj->setBizInfo(0,$title,$tagline,$category,$subCategory,$description,$listingUrl);
		$result = $gbizObj->update(1);
		
		if($result)
		{	
			
			$msg .= "<b>Listing updated successfully</b>";
			$msg = "<div class='alert alert-info'>".$msg."</div>";
			
			//upload the logo file
			
			if(!is_dir(SITE_ROOT."/biz/$lid"))
			{
				mkdir(SITE_ROOT."/biz/$lid", 0755);
			}
			if(!empty($_FILES['file_upload']['name']))
			{
				$tmp_file = $_FILES['file_upload']['tmp_name'];
				$originalFile = basename($_FILES['file_upload']['name']);
				$extension = substr($originalFile, strripos($originalFile, '.'),strlen($originalFile));
				$renamedFile = "logo".$extension;
				$upload_dir = "biz/$lid";
				move_uploaded_file($tmp_file, $upload_dir."/".$renamedFile);
			}
			
			//Send email to moderator about  new listing to be moderated
			$to = ADMIN_EMAIL;
			$subject = "Listing updated Notification";
			$message = "$logOptions_username has updated listing. Visit this link to approve it";
			
			$mail = new phpmailer();
			//$mail->From = $from;
			$mail->AddAddress($to);
			$mail->Subject = $subject;
			$mail->Body = $message;
			//$result = $mail->Send();
		}
		else
		{
			$msg .= "An error occurred while updating data. Please try again.";
			$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
		}
	}
	
	
}

else if(isset($_POST['btnEditContacts']))
{
	$email          = $_POST[txtEmail];
	$phone 			= $_POST[txtPhone];
	$fax       		= $_POST[txtFax];
	$mobile 		= $_POST[txtMobile];
	$contactP		= $_POST[txtContactP];
		
	if(empty($email)|| empty($phone) || empty($contactP))
	{
		$msg=$msg."Required fields can not be left blank<br>";
		$status = "NOTOK";
	}	
	else
	{
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
					
	}
	
	if($status=="NOTOK")
	{
		$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
		
	}
	else
	{
		$gbizObj = new Business();
		$gbizObj->setListingId($lid);
		$gbizObj->setContactInfo($email,$phone,$fax,$mobile,$contactP);
		$result = $gbizObj->update(2);
		
		if($result)
		{	
			
			$msg .= "<b>Listing updated successfully</b>";
			$msg = "<div class='alert alert-info'>".$msg."</div>";
			
		}
		else
		{
			$msg .= "An error occurred while updating data. Please try again.";
			$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
		}
	}
}

else if(isset($_POST['btnEditLocation']))
{
	$street          = $_POST['txtStreet'];
	$city 			= $_POST['txtCity'];
	$country       		= $_POST['listCountry'];
	$zip 		= $_POST['txtZip'];
	$latitude		= $_POST['txtLat'];
	$longitude	 = $_POST['txtLong'];
		
	if(empty($street)|| empty($city) || empty($country))
	{
		$msg=$msg."Required fields can not be left blank<br>";
		$status = "NOTOK";
	}	
	else
	{
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
		$gbizObj = new Business();
		$gbizObj->setListingId($lid);
		$gbizObj->setLocationInfo($street,$city,$country,$zip,$latitude,$longitude);
		$result = $gbizObj->update(3);
		
		if($result)
		{	
			
			$msg .= "<b>Listing updated successfully</b>";
			$msg = "<div class='alert alert-info'>".$msg."</div>";
			
		}
		else
		{
			$msg .= "An error occurred while updating data. Please try again.";
			$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
		}
	}
}

else if(isset($_POST['btnEditSocial']))
{
	$fb            = $_POST['txtFb'];
	$twitter 	   = $_POST['txtTwitter'];
	$linkedin      = $_POST['txtLinkedIn'];
	$video_chanel  = $_POST['txtVideo'];
			
	$gbizObj = new Business();
	$gbizObj->setListingId($lid);
	$gbizObj->setSocialLinks($fb,$twitter,$linkedin,$video_chanel);
	$result = $gbizObj->update(4);
	
	if($result)
	{	
		
		$msg .= "<b>Listing updated successfully</b>";
		$msg = "<div class='alert alert-info'>".$msg."</div>";
		
	}
	else
	{
		$msg .= "An error occurred while updating data. Please try again.";
		$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
	}
	
}

else if(isset($_POST['btnEditKeywords']))
{
	$keywords       = $_POST['txtKeywords'];
	
			
	$gbizObj = new Business();
	$gbizObj->setListingId($lid);
	$gbizObj->setKeywordInfo($keywords);
	$result = $gbizObj->update(5);
	
	if($result)
	{	
		
		$msg .= "<b>Listing updated successfully</b>";
		$msg = "<div class='alert alert-info'>".$msg."</div>";
		
	}
	else
	{
		$msg .= "An error occurred while updating data. Please try again.";
		$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
	}
	
}

else if(isset($_POST['btnEditBanners']))
{
	$banerType   = $_POST['listType'];
	$caption     = $_POST['txtCaption'];
	$urlProtocol = $_POST['listAdUrlProtocol'];
	$destination = $_POST['txtDestination'];
		
	$adUrl     = $urlProtocol.$destination;
	
	if($destination == NULL)
	{
		$adUrl="";
	}
	else if($destination!=NULL && !$gvalObj ->isURL($adUrl))
	{
		$msg=$msg."Invalid banner URL<br>";
		$status ="NOTOK";
	}
		
	
	
	if($status=="NOTOK")
	{
		$msg = "<div class='alert alert-error' id='error_box'>".$msg."</div>";
		
	}
	else
	{
	  $gbannerObj = new Banner();
	  $gbannerObj->setListingId($lid);
	  $gbannerObj->setBannerInfo($banerType,$caption,$adUrl);
	  $result = $gbannerObj->add();
	  $bannerID = $gbannerObj->getBannerId();
	  if($result)
	  {
		  
		  //upload banner image file
		  $tmp_file = $_FILES['banner_upload']['tmp_name'];
		  $originalFile = basename($_FILES['banner_upload']['name']);
		  $extension = substr($originalFile, strripos($originalFile, '.'),strlen($originalFile));
		  $renamedFile = $bannerID."".$extension;
		  $upload_dir = "ads/$banerType";
		  move_uploaded_file($tmp_file, $upload_dir."/".$renamedFile);
		  
		  $msg .= "<b>Listing updated successfully</b>";
		  $msg = "<div class='alert alert-info'>".$msg."</div>";
		  
	  }
	  else
	  {
		  $msg .= "An error occurred while updating data. Please try again.";
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
