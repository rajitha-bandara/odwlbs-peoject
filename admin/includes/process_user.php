<?php
	require_once('../../includes/init.php');
	
	if(isset($_POST['btnAdd']))
	{
	  $uname = $_POST['uname'];
      $pw = $_POST['password'];
      $email = $_POST['email'];
	  
	  global $guserObj;
	  if($guserObj->isAlreadyTaken('username',$uname))
	  {
		  ?>
          <script type="text/javascript">
          alert('Username already exists');
		  window.location.href='../test.php';
          </script>
          <?php 
	  }
	  else if($guserObj->isAlreadyTaken('email',$email))
	  {
		  ?>
          <script type="text/javascript">
          alert('Email already exists');
		  window.location.href='../test.php';
          </script>
          <?php 
	  }
	  else
	  {
		$guserObj->set_basic_vars($uname,$pw,$email);
		$res = $guserObj->create();
		if($res)
		{
			$user_id = $guserObj->getUserId();
			//Create directory(folder) to hold each user's files(pics,videos,etc.)
			mkdir(SITE_ROOT."/members/$user_id", 0755);
			?>
			<script type="text/javascript">
			alert('Successfully added a new user');
			window.location.href='../test.php';
			</script>
			<?php 
		}
		else
		{
			?>
			<script type="text/javascript">
			alert('Unable to add this user');
			window.location.href='../test.php';
			</script>
			<?php
		}
	  }
	}
	
	else if(isset($_POST['btnEdit']))
	{
	  $uid = $_POST['uid'];
	  $uname = $_POST['uname'];
      $email = $_POST['email'];
      $fname = $_POST['fname'];
	  $lname = $_POST['lname'];
	  $gender = $_POST['gender'];
      $listcountry = $_POST['listcountry'];
      $city = $_POST['city'];
      $street = $_POST['street'];
	  $zip = $_POST['zip'];
	  $phone = $_POST['phone'];
	  $description = $_POST['hidden_desc'];
	  $email_act = $_POST['email_act'];
	  
	  
	  global $guserObj;
	 
		$guserObj->set_all_vars($uid,$uname,$first_name,$last_name,$country,$city,$street,$phone,$zip,$description);
		$res = $guserObj->update();
		if($res)
		{
			
			?>
			<script type="text/javascript">
			alert('<?php echo $uid." ".$uname. " " .$first_name. " ".$description  ;?>');
			alert('Successfully updated user data');
			window.location.href='../test.php';
			</script>
			<?php 
		}
		else
		{
			?>
			<script type="text/javascript">
			alert('Unable to update user data');
			window.location.href='../test.php';
			</script>
			<?php
		}
	  
	  
	
}
	
	
?>
