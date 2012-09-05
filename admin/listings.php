<?php
@session_start();
require_once('../includes/init.php');
require_once('includes/login_status.php');

?>
<?php
$lid = "";
if(isset($_POST['btnTrack']))
{
	global $gbizObj;
	$lid = $_POST['listingID'];
	if($gbizObj->fetchListingObj($lid) != false)
	{
		$bizObj = $gbizObj->fetchListingObj($lid);
	}
	else
	{
		echo'Data not found';
	}
	
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo DOMAIN_NAME;?>.:Manage Listings</title>
	
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
			url: 'includes/post_listing.php',
			dataType: 'json',
			colModel : [
				{display: 'Lsting ID', name : 'biz_id', process: getRowID, width : 40, sortable : true, align: 'right', hide: false},
				{display: 'Title', name : 'title', width : 120, sortable : true, align: 'left'},
				{display: 'User ID', name : 'user_id', width : 80, sortable : true, align: 'right'},
				{display: 'Main Category', name : 'main_category', width : 80, sortable : true, align: 'right'},
				{display: 'Sub Category', name : 'sub_category', width : 80, sortable : true, align: 'right'},
				{display: 'URL', name : 'url', width : 80, sortable : true, align: 'left'},
				{display: 'Status', name : 'status', width : 40, sortable : true, align: 'right'},
				{display: 'Content Approval', name : 'content_approved', width : 60, sortable : true, align: 'right'},
				{display: 'Package', name : 'package', width : 60, sortable : true, align: 'right'},
				{display: 'Submit Date', name : 'date_submit', width : 80, sortable : true, align: 'left'},
				{display: 'Expire Date', name : 'date_expire', width : 80, sortable : true, align: 'left'},
				],
			buttons : [
				{name: 'Edit', bclass: 'edit', onpress : test},	
				{name: 'Delete', bclass: 'delete', onpress : test},
				{separator: true}
				],
			searchitems : [
				{display: 'Lsting ID', name : 'biz_id'},
				{display: 'Title', name : 'title', isdefault: true}
				],
			sortname: "biz_id",
			sortorder: "asc",
			usepager: true,
			title: 'Manage Listings',
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
        document.getElementById('listingID').value = id;
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
		
		<h4 class="alert_info">Manage Listings</h4>
		
		<article class="module width_full">
			<header><h3></h3></header>
			<div class="module_content">
				
				<table id="flex1" style="display:none"></table>
	
           
				<div class="clear"></div>
			</div>
            
            <footer>
				<div style="padding-top:5px;padding-left:10px;">
			<form action="" method="post">
            <label>Listing ID</label>
            <input name="listingID" type="text" id="listingID" value="<?php echo $lid;?>" required = "required">
            <input type="submit" class="alt_btn" value="Track" name="btnTrack"/>
            </form>
				</div>
			</footer>
		</article><!-- end of manage listings grid article -->
	
    <article class="module width_3_quarter" <?php if($lid == ""){?> style="display:none" <?php }?>>
		<header><h3 class="tabs_involved">Listing Details - Listing ID : <?php echo $lid;?></h3></header>
        
        <header>
		<ul class="tabs">
   			<li><a href="#tab1">Overview</a></li>
    		<li><a href="#tab2">General Info</a></li>
            <li><a href="#tab3">Contacts</a></li>
            <li><a href="#tab2">Location</a></li>
            <li><a href="#tab3">Keywords</a></li>
		</ul>
        </header>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			
            <table width="500px" border="0" align="center" class="tablesorter">
            <tr>
              <td><h1 align="center"><?php echo $bizObj->title;?></h1></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Listing Plan</td>
              <td>
			  <?php 
              $pkg = $bizObj->package;
              echo ($pkg == 'g' ? 'Gold' : ($pkg == 's' ? 'Silver' : 'Bronze')) ;?>
              </td>
            </tr>
            <tr>
            <tr>
              <td>Content Approved</td>
              <td>
			  <?php 
              $app = $bizObj->content_approved;
              echo ($app == '1' ? "Yes <input type='button' value='Reject' onClick='handleContent($lid,$app)' class='alt_btn'>" : "No <input type='button' value='Approve' onClick='handleContent($lid,$app)' class='alt_btn'>");?>
              
              </td>
            </tr>
            <tr>
              <td>Listing Status</td>
              <td>
              <?php 
              $st = $bizObj->status;
              echo ($st == '0' ? "Pending <input type='button' value='Activate' onClick='updateStatus($lid,1)' class='alt_btn'> <input type='button' value='Deactivate' onClick='updateStatus($lid,2)' class='alt_btn'>" : ($st == '1' ? "Active <input type='button' value='Pending' onClick='updateStatus($lid,0)' class='alt_btn'> <input type='button' value='Deactivate' onClick='updateStatus($lid,2)' class='alt_btn'>" : "Deactive <input type='button' value='Pending' onClick='updateStatus($lid,0)' class='alt_btn'> <input type='button' value='Activate' onClick='updateStatus($lid,1)' class='alt_btn'> ")) ;?>
              </td>
            </tr>
            <tr>
              <td>Submitted Date</td>
              <td><?php echo $bizObj->date_submit;?></td>
            </tr>
            <tr>
              <td>Expired Date</td>
              <td><?php echo $bizObj->date_expire;?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
			</div><!-- end of #tab1 -->
			
			<div id="tab2" class="tab_content">
			
			


			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of listing content manager article -->
</section>

</body>

</html>