<?php
@session_start();
require_once('../includes/init.php');
require_once('includes/login_status.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="clockp.js"></script>
<script type="text/javascript" src="clockh.js"></script> 
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>

<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />

</head>
<body>
<div id="main_container">

	<div class="header">
    <div class="logo"><a href="#"><img src="" alt="" title="" border="0" /></a></div>
    
    <div class="right_header">Welcome <?php echo $admin_username;?> (Admin), <a href="<?php echo SITE_URL;?>">Visit site</a> | <a href="#" class="messages">Messages</a> | <a href="includes/logout.php" class="logout">Logout</a></div>
    <div id="clock_a"></div>
    </div>
    
    <div class="main_content">
    
                    <div class="menu">
                    <ul>
                    <li><a class="current" href="index.php">Admin Home</a></li>
                    <li><a href="">Manage Users<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                        <li><a href="" title="">Users</a></li>
                        <li><a href="add_user.php" title="">Add User</a></li>
                        <li><a href="" title="">User Groups</a></li>
                        <li><a href="" title="">Add User Group</a></li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <li><a href="">Listings<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                        <li><a href="" title="">Add Listings</a></li>
                        <li><a href="" title="">Search Listings</a></li>
                        <li><a href="" title="">All Listings</a></li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <li><a href="">Tools<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                        <li><a href="" title="">Pages Manager</a></li>
                        <li><a href="" title="">Menu Links Manager</a></li>
                        <li><a href="" title="">Banner Manager</a></li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <li><a href="">Setup<!--[if IE 7]><!--></a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                        <li><a href="" title="">Settings</a></li>
                        <li><a href="" title="">Language</a></li>
                        <li><a href="" title="">Maintenance</a></li>
                        </ul>
                        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                 
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                  
                    </ul>
                    </div> 
                    
                    
                    
                    
    <div class="center_content">  

    <div class="left_content">

            <div class="sidebarmenu">
            
                <a class="menuitem submenuheader" href="manage_users.php">Manage Users</a>
                <div class="submenu">
                    <ul>
                    <li><a href="">Users</a></li>
                    <li><a href="add_user.php">Add User</a></li>
                    <li><a href="">User Groups</a></li>
                    <li><a href="">Add User Group</a></li>
                    </ul>
                </div>
                <a class="menuitem submenuheader" href="" >Listings</a>
                <div class="submenu">
                    <ul>
                    <li><a href="">Add Listings</a></li>
                    <li><a href="">Search Listings</a></li>
                    <li><a href="">All Listings</a></li>
                    </ul>
                </div>
                <a class="menuitem submenuheader" href="">Tools</a>
                <div class="submenu">
                    <ul>
                    <li><a href="">Pages Manager</a></li>
                    <li><a href="">Menu Links Manager</a></li>
                    <li><a href="">Banner Manager</a></li>
                    </ul>
                </div>
                <a class="menuitem submenuheader" href="">Setup</a>
                <div class="submenu">
                    <ul>
                    <li><a href="">Settings</a></li>
                    <li><a href="">Language</a></li>
                    <li><a href="">Maintenance</a></li>
                    </ul>
                </div>
                
                    
            </div>

            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                <h4>Important Notice</h4>
                <img src="images/notice.png" alt="" title="" class="sidebar_icon_right" />
                <p>
				There are some new listings to be confirmed
                </p>                
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
            
           
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                <h3>To do List</h3>
                <img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
                <ul>
                <li></li>
                 <li><strong> Confirm New Listings </strong></li>
                  <li>Confirm New User Accouts</li>
                   <li> Reply To Messeges</li>
                    <li></li>
                     <li></li>
                </ul>                
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
              
    
    </div>  
    
    <div class="right_content">            
        
    <h2>Summary</h2> 
    
    <h3>Users</h3>
    
 <table id="rounded-corner" summary="users" width="100%">
 
 <tbody>
    	<tr>
            <td>Users</td>
            <td>12</td>
        </tr>
        
    	<tr>
            <td>Email Unconfirmed</td>
            <td>00</td>
        </tr> 
        <tr>
            <td>Registered This Week</td>
            <td>00</td>
        </tr> 
  
    </tbody>
</table> 

    <h3>Listings</h3>
    
 <table id="rounded-corner" summary="listings" width="100%">
 
 <tbody>
    	<tr>
            <td>Listings   </td>
            <td>16</td>
        </tr>
        
    	<tr>
            <td>Listing Suggestions   </td>
            <td>00</td>
        </tr> 
        <tr>
            <td>Lsting Claims  </td>
            <td>00</td>
        </tr> 
        
        	<tr>
            <td>Pending Updates</td>
            <td>00</td>
        </tr>
        
    </tbody>
</table>   

    <h3>Other</h3>
    
 <table id="rounded-corner" summary="listings" width="100%">
 
 <tbody>
    	<tr>
            <td>Categories</td>
            <td>30</td>
        </tr>
        
    	<tr>
            <td>Emails in Queue</td>
            <td>00</td>
        </tr> 
        <tr>
            <td>Canceling Requests</td>
            <td>00</td>
        </tr> 
    </tbody>
</table>      
 
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
    <div class="footer">

    
    </div>

</div>		
</body>
</html>