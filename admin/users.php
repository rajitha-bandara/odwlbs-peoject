<?php
@session_start();
require_once('../includes/init.php');
require_once('includes/login_status.php');
require_once('../includes/phpmailer/phpmailer.inc.php');
?>
<?php
if(isset($_POST['btnTrack']))
{
	$uid = $_POST['userID'];
	$opt = $_POST['options'];
}
if(isset($_POST['btnSend']))
{
	global $guserObj;
	$from = ADMIN_EMAIL;
	$to = $guserObj->getUserEmail($uid);
	$subject = $_POST['txtTitle'];
	$message = $_POST['txtBody'];
	
	$mail = new phpmailer();
	$mail->From = $from;
	$mail->AddAddress($to);
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->Send();
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo DOMAIN_NAME;?>.:Manage Users</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/flexigrid.css" />
    <link type="text/css" href="css/base/ui.all.css" rel="stylesheet" /> 
    <link type="text/css" href="css/zebra_msgbox/zebra_dialog.css" rel="stylesheet" /> 
    <link type="text/css" href="css/zebra_msgbox/zebra_dialog.css" rel="stylesheet" />  
    <link type="text/css" href="css/styles.css" rel="stylesheet" />    
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script> 
    <script class="jsbin" src="js/jquery-ui.min.js"></script>    
<script type="text/javascript">
	var $nf = jQuery.noConflict();
</script>

<script type="text/javascript" src="js/jquery-1.2.3.pack.js"></script> 
<script type="text/javascript" src="js/ui/ui.datepicker.js"></script>   
<script type="text/javascript" src="js/ui/i18n/ui.datepicker-id.js"></script>
<script type="text/javascript" src="js/flexigrid.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/zebra_dialog.js"></script>
<script type="text/javascript" src="js/functions.js"></script>

	<script type="text/javascript">
	
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    

<script type="text/javascript">
$(document).ready(function(){
	
	$("#flex1").flexigrid
			(
			{
			url: 'includes/post_user.php',
			dataType: 'json',
			colModel : [
				{display: 'User ID', name : 'user_id', process: getRowID, width : 40, sortable : true, align: 'right', hide: false},
				{display: 'Username', name : 'username', width : 60, sortable : true, align: 'left'},
				{display: 'Password', name : 'password', width : 180, sortable : true, align: 'left'},
				{display: 'Email', name : 'email', width : 120, sortable : true, align: 'left'},
				{display: 'First Name', name : 'first_name', width : 80, sortable : true, align: 'left'},
				{display: 'Last Name', name : 'last_name', width : 80, sortable : true, align: 'left'},
				{display: 'Gender', name : 'gender', width : 40, sortable : true, align: 'left'},
				{display: 'Street', name : 'street', width : 60, sortable : true, align: 'left'},
				{display: 'City', name : 'city', width : 60, sortable : true, align: 'left'},
				{display: 'Country', name : 'country', width : 60, sortable : true, align: 'left'},
				{display: 'Zip Code', name : 'zip_code', width : 40, sortable : true, align: 'left'},
				{display: 'Phone', name : 'phone', width : 40, sortable : true, align: 'left'},
				{display: 'Email Activated', name : 'email_activated', width : 70, sortable : true, align: 'right'},
				],
			buttons : [
				{name: 'Add', bclass: 'add', onpress : test},
				{name: 'Edit', bclass: 'edit', onpress : test},	
				{name: 'Delete', bclass: 'delete', onpress : test},
				{separator: true}
				],
			searchitems : [
				{display: 'Username', name : 'username'},
				{display: 'Email', name : 'email', isdefault: true}
				],
			sortname: "user_id",
			sortorder: "asc",
			usepager: true,
			title: 'Manage users',
			useRp: true,
			rp: 10,
			showTableToggleBtn: true,
			width: 950,
			height: 255
			}
			);   
	
});
function getRowID( celDiv, id ) {
    $( celDiv ).click( function() {
								//alert(id);
        document.getElementById('userID').value = id;
    });
}

function sortAlpha(com)
{ 
	jQuery('#flex1').flexOptions({newp:1, params:[{name:'letter_pressed', value: com},{name:'qtype',value:$('select[name=qtype]').val()}]});
	jQuery("#flex1").flexReload(); 
}
function getid(com,grid){		
	var id='';	
	$('.trSelected', grid).each(function() {
		id = $(this).attr('id');
		id = id.substring(id.lastIndexOf('row')+3);		
	});
	return id;		
}
$nf(document).ready(function(){
	//define config object
   var dialogAdd = {
        modal: true,
        bgiframe: true,
        autoOpen: false,
        height: 270,
        width: 640,
        draggable: true,
        resizeable: true,
        open: function(com,grid) {		    
            //display correct dialog content
            $("#formadd").load("includes/manager_user.php");
        }
   };
   $nf("#formadd").dialog(dialogAdd);  //end dialog
   var dialogEdit = {
        modal: false,
        bgiframe: true,
        autoOpen: false,
        height: 470,
        width: 640,
        draggable: true,
        resizeable: true,
        open: function(com,grid) {		    
            //display correct dialog content
            $("#formedit").load("includes/manager_user.php?id="+getid()+"");
        }
   };
   $nf("#formedit").dialog(dialogEdit);  //end dialog
});

function test(com,grid)
{
	if (com=='Delete')
	{
	   if($('.trSelected',grid).length>0){
	   if(confirm('Delete ' + $('.trSelected',grid).length + ' items?')){
		var items = $('.trSelected',grid);
		var itemlist ='';
		for(i=0;i<items.length;i++){
			itemlist+= items[i].id.substr(3)+",";
		}
		$.ajax({
		   type: "POST",
		   dataType: "json",
		   url: "delete.php",
		   data: "items="+itemlist,
		   success: function(data){
			alert("Query: "+data.query+" - Total affected rows: "+data.total);
		   $("#flex1").flexReload();
		   }
		 });
		}
		} else {
			return false;
		} 
	}
	else if (com=='Add')
	{		       
		$nf("#formadd").dialog('open');		
	} 
	else if (com=='Edit')
	{
		if($('.trSelected',grid).length>0){
			$nf("#formedit").dialog('open');
		}else{
			return false;
		}
	}          
}

</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.php"><?php echo DOMAIN_NAME;?> Admin</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="<?php echo SITE_URL;?>">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $admin_username;?> (Admin)</p>
			 <a class="logout_user" href="includes/logout.php" title="Logout">Logout</a> 
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.php"><?php echo DOMAIN_NAME;?> Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
       <h3>Users</h3>
		<ul class="toggle">
			<li class="icn_add_user"><a href="users.php">Manage</a></li>
			<li class="icn_folder"><a href="user_reports.php">Reports</a></li>
		</ul>
		<h3>Listings</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="listings.php">Manage</a></li>
			
		</ul>
		
		<h3>Reports</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="https://www.google.com/analytics/web/?pli=1#dashboard/default/a33771504w61124560p62578444/" target="_blank">Analytics</a></li>
			
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Options</a></li>
			<li class="icn_jump_back"><a href="includes/logout.php">Logout</a></li>
		</ul>
		
		<footer>
			<hr />
			<p></p>
			<p></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Manage Users</h4>
		
		<article class="module width_full">
			<header><h3></h3></header>
			<div class="module_content">
				
				<table id="flex1" style="display:none"></table>
<br /><br />
<div id="formadd" style="display:none" title=""></div>
<div id="formedit" style="display:none" title=""></div>
<br /><br />
			
           
				<div class="clear"></div>
			</div>
            
            <footer>
				<div style="padding-top:5px;padding-left:10px;">
			 <form action="" method="post">
            <label>User ID </label>
            <input name="userID" type="text" id="userID" required="required" value="<?php echo $uid;?>" >
            <select name="options">
            <option value="profile">Profile Details</option>
            <option value="login">Login Details</option>
            <option value="listings">Listings</option>
            <option value="notifications">Notifications</option>
            </select>
            <input type="submit" class="alt_btn" value="Track" name="btnTrack"/>
            </form>
				</div>
			</footer>
		</article><!-- end of manage users grid article -->
		
        <article class="module width_full" <?php if($opt != 'profile'){?> style="display:none" <?php }?>>
			<header><h3>Profile Details - User ID : <?php echo $uid;?></h3></header>
			<div class="module_content">
            <?php
			global $guserObj;
			$profile_img = get_profile_image($uid);
			$obj = $guserObj->fetchUserObj($uid);
			?>
			<table width="500px" border="0" id="profile_data">
  <tr>
  <td><?php echo $profile_img;?></td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Username</td>
    <td><?php echo $obj->username;?></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><?php echo $obj->password;?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $obj->email;?></td>
  </tr>
  <tr>
    <td>First Name</td>
    <td><?php echo $obj->first_name;?></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><?php echo $obj->last_name;?></td>
  </tr>
  <tr>
    <td>Gender</td>
    <td><?php echo $obj->gender;?></td>
  </tr>
  <tr>
    <td>Street</td>
    <td><?php echo $obj->street;?></td>
  </tr>
  <tr>
    <td>City</td>
    <td><?php echo $obj->city;?></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><?php echo $obj->country;?></td>
  </tr>
  <tr>
    <td>Zip Code</td>
    <td><?php echo $obj->zip_code;?></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><?php echo $obj->phone;?></td>
  </tr>
  <tr>
    <td>Email Activated</td>
    <td><?php 
	if($obj->email_activated == 1)
	{
		echo "Yes <input type='button' value='Deactivate' onClick='handleEmailAct($uid,$obj->email_activated)' class='alt_btn'> ";
	}
	else
	{
		echo "No <input type='button' value='Activate' onClick='handleEmailAct($uid,$obj->email_activated)' class='alt_btn'>";
	}
	?></td>
  </tr>
  
</table>      
			<div class="clear"></div>
			</div>
            
            <footer>
				
			</footer>
            </article>
   
<article class="module width_full" <?php if($opt != 'login'){?> style="display:none" <?php }?>>
			<header><h3>Login Details - User ID : <?php echo $uid;?></h3></header>
			<div class="module_content">
            
            <table width="500px" border="0" style="overflow:auto">
            <tr ><td width="200px"><b>Login Date</b></td><td width="150px" ><b>IP Address</b></td><td width="150px"><b>Platform</b></td><td width="150px"><b>Browser</b></td></tr>
            <?php
			global $guserObj;
			echo $guserObj->fetchUserLoginData($uid);
			?>
            </table>
       
				<div class="clear"></div>
			</div>
            
            <footer>
				
			</footer>
            </article>   
            
        
        
        <article class="module width_full" <?php if($opt != 'listings'){?> style="display:none" <?php }?>>
			<header><h3>Listing Details - User ID : <?php echo $uid;?></h3></header>
			<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
                	<th></th>
   					<th>Listing Title</th> 
    				 
				</tr> 
			</thead> 
			<tbody> 
				<?php
				global $gbizObj;
				echo $gbizObj->fetchListingTitle($uid);
					
			?>	
			</tbody> 
			</table>
			</div>
            </div>
            <footer>
				
			</footer>
            </article>
            
       
		<!-- end of content manager article -->
		
		
		<article class="module width_3_quarter" <?php if($opt != 'notifications'){?> style="display:none" <?php }?>>
			<header><h3>Notifications - User ID : <?php echo $uid;?></h3></header>
                     
				<div class="module_content">
                <form method="post" id="message_form">
						<fieldset>
							<label>Subject</label>
							<input type="text" name="txtTitle">
						</fieldset>
						<fieldset>
							<label>Message Body</label>
							<textarea rows="12" name="txtBody"></textarea>
						</fieldset>
						
						
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Send" class="alt_btn" name="btnSend">
					<input type="reset" value="Reset">
				</div>
			</footer>
            </form>
		</article><!-- end of messages article -->
		
		
		
		
		
</section>

<script type="text/javascript">



</script>
</body>

</html>