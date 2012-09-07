<?php
@session_start();
require_once('../includes/init.php');
require_once('includes/login_status.php');
?>


<?php
global $guserObj;
global $gbizObj;

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo DOMAIN_NAME;?>.:Admin Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript" src="js/jquery.gvChart-1.1.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
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
    $(function(){
        $('.column').equalHeight();
    });
</script>


		<script type="text/javascript">
		gvChartInit();
		jQuery(document).ready(function(){
			jQuery('#userStats').gvChart({
				chartType: 'AreaChart',
				gvSettings: {
					vAxis: {title: 'No of users'},
					hAxis: {title: 'Month'},
					width: 720,
					height: 300
					}
			});
			});
			</script>
</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html">Website Admin</a></h1>
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
			
			
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Welcome to <?php echo DOMAIN_NAME;?> admin panel</h4>
		
		<article class="module width_full">
			<header><h3>Stats</h3></header>
			<div class="module_content">
				<article class="stats_graph">
					<table id='userStats'>
					<caption>Registered Users</caption>
					<thead>
						<tr>
							<th></th>
							<th>Jan</th>
							<th>Feb</th>
							<th>Mar</th>
							<th>Apr</th>
							<th>May</th>
							<th>Jun</th>
							<th>Jul</th>
							<th>Aug</th>
							<th>Sep</th>
							<th>Oct</th>
							<th>Nov</th>
							<th>Dec</th>
						</tr>
					</thead>
						<tbody>
						<tr>
							<th><?php echo date('Y');?></th>
							<td><?php echo $guserObj->countUsersByMonth(1);?></td>
							<td><?php echo $guserObj->countUsersByMonth(2);?></td>
							<td><?php echo $guserObj->countUsersByMonth(3);?></td>
							<td><?php echo $guserObj->countUsersByMonth(4);?></td>
							<td><?php echo $guserObj->countUsersByMonth(5);?></td>
							<td><?php echo $guserObj->countUsersByMonth(6);?></td>
							<td><?php echo $guserObj->countUsersByMonth(7);?></td>
							<td><?php echo $guserObj->countUsersByMonth(8);?></td>
							<td><?php echo $guserObj->countUsersByMonth(9);?></td>
							<td><?php echo $guserObj->countUsersByMonth(10);?></td>
							<td><?php echo $guserObj->countUsersByMonth(11);?></td>
							<td><?php echo $guserObj->countUsersByMonth(12);?></td>
						</tr>
						
					</tbody>
				</table>
				</article>
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Users</p>
						<p class="overview_count"><?php echo $guserObj->countUsers('');?></p>
						
					</div>
					<div class="overview_previous">
						<p class="overview_day">Listings</p>
						<p class="overview_count"><?php echo $gbizObj->countListings('');?></p>
                        <p class="overview_type">All</p>
                        <p class="overview_count"><?php echo $gbizObj->countListings(" where status = 0");?></p>
						<p class="overview_type">Pending</p>
						<p class="overview_count"><?php echo $gbizObj->countListings(" where status = 1");?></p>
						<p class="overview_type">Active</p>
                        <p class="overview_count"><?php echo $gbizObj->countListings(" where status = 2");?></p>
						<p class="overview_type">Dective</p>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
		
		
		
		
		<div class="spacer"></div>
	</section>


</body>

</html>