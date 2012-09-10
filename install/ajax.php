<?php
switch($_POST['action']) {
     case "install" :
	 	  $host = $_POST['host'];
		  $dbuser = $_POST['user'];
		  $dbpass = $_POST['pass'];
		  $dbname = $_POST['db'];
		  $domain = $_POST['domain'];
		  $root = $_POST['root'];
		  $url = $_POST['url'];
		  $google = $_POST['google'];
		  $fb = $_POST['fb'];
		  $mailchimp = $_POST['mailchimp'];
		  $ga = $_POST['ga'];
		  $adminU = $_POST['adminU'];
		  $adminP = md5($_POST['adminP']);
		  $email = $_POST['email'];
		  
		  $text = '<?php'. "\n".
		     '/*This is an auto generated file'. "\n".
			   ' Do not modify this config file'. "\n" .
			  '*/'.  "\n".
            'defined("DB_SERVER") ? null : define("DB_SERVER", "'. $host. '");'. "\n".
			'defined("DB_USER") ? null : define("DB_USER", "'. $dbuser. '");'. "\n".
			'defined("DB_PASS") ? null : define("DB_PASS", "'. $dbpass. '");'. "\n".
			'defined("DB_NAME") ? null : define("DB_NAME", "'. $dbname. '");'. "\n\n".
			
			'defined("DOMAIN_NAME") ? null : define("DOMAIN_NAME", "'. $domain. '");'. "\n".
			'defined("SITE_URL") ? null : define("SITE_URL", "'. $url. '");'. "\n".
			
			'defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);'. "\n".
			'defined("SITE_ROOT") ? null : define("SITE_ROOT", "'. $root. '");'. "\n".
			'defined("LIB_PATH") ? null : define("LIB_PATH", SITE_ROOT.DS."includes");'. "\n".
			'defined("CLASS_PATH") ? null : define("CLASS_PATH", SITE_ROOT.DS."data".DS."classes");'. "\n".	
			
			'defined("ADMIN_EMAIL") ? null : define("ADMIN_EMAIL", "'. $email. '");'. "\n".
			'defined("GOOGLE_MAP_API_KEY") ? null : define("GOOGLE_MAP_API_KEY", "'. $google. '");'. "\n".
			'defined("FACEBOOK_APP_ID") ? null : define("FACEBOOK_APP_ID", "'. $fb. '");'. "\n".
			'defined("MAILCHIMP_API_KEY") ? null : define("MAILCHIMP_API_KEY", "'. $mailchimp. '");'. "\n".
			'defined("GA_Property_ID") ? null : define("GA_Property_ID", "'. $ga. '");'. "\n".
			'?>';
			
			$filename = "../includes/config.php";
			$filehandle = fopen($filename, 'w') or exit("Unable to open file!");
			fwrite($filehandle, $text);
			fclose($filehandle);
			
			$message .= "Created config.php file."."<br>";
			$flag1 = 1;
			
			require_once('../includes/config.php');
			$conn = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die(mysql_error());
			mysql_select_db(DB_NAME,$conn) or die(mysql_error());
			
			require_once('sql.php');
			if($res1==1 && $res2 ==1 && $res3==1 && $res4 ==1 && $res5==1 && $res6 ==1 && $res7==1 && $res8 ==1 && $res9==1 && $res10 ==1 && $res11==1 && $res12 ==1 && $res13==1 && $res14 ==1 && $res15 ==1)
			{	
				$message .= "Created all necessary tables."."<br>";
				$flag2 = 1;
			}
			else
			{
				$message .= "Could not create some tables. Please try again or create them manually."."<br>";
			}
			
			$sql = "INSERT INTO `lbs_admin`(`username`, `password`, `email`, `date_joined`) VALUES
('$adminU', '$adminP', '$email',NOW());";
			$res = mysql_query($sql,$conn);
			
			if($res == 1)
			{	
				$message .= "Created admin successfully."."<br>";
				$flag3 = 1;
			}
			else
			{
				$message .= "Could not create admin. Please try again"."<br>";
			}
			//Everything is ok
			if($flag1 = $flag2 = $flag3 = 1)
			{
				$status = "ok";
			}
			
			$data = array(
			'message' => $message,
			'status' => $status
			
			);
	
			echo json_encode($data);
			exit;
			
        break;
}


?>