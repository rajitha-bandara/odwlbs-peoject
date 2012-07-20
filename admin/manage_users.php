<?php
@session_start();
require_once('../includes/init.php');
require_once('includes/login_status.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN PANEL</title>
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

<?php 
include("includes/header.php");
?>
<div class="center_content">  
<div class="left_content">
 
<?php 
include("includes/left_content.php");
?>    </div>
              
        
    <div class="right_content">            
    
    <h2> Users </h2>
    
    <div class="sidebar_search">
            <form>
            <input type="text" name="" class="search_input" value="Search Name" onclick="this.value=''" />
            <input type="image" class="search_submit" src="images/search.png" />
            </form>            
            </div>
    
    <table id="rounded-corner" summary="Users">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"></th>
            <th scope="col" class="rounded">User ID</th>
            <th scope="col" class="rounded">Username</th>
            <th scope="col" class="rounded">First Name</th>
            <th scope="col" class="rounded">Last Name</th>
            <th scope="col" class="rounded">Email</th>
            <th scope="col" class="rounded">Edit</th>
            <th scope="col" class="rounded-q4">Delete</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="7" class="rounded-foot-left"></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
    	<tr>
        	<td><input type="checkbox" name="" /></td>
            <td>User ID</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
			<td>Email</td>
            <td><a href="#"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>
        
    	<tr>
        	<td><input type="checkbox" name="" /></td>
            <td>User ID</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
			<td>Email</td>
            <td><a href="#"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr> 
        
    	<tr>
        	<td><input type="checkbox" name="" /></td>
            <td>User ID</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
			<td>Email</td>
            <td><a href="#"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>
        
    	<tr>
        	<td><input type="checkbox" name="" /></td>
            <td>User ID</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
			<td>Email</td>
            <td><a href="#"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>  
    	<tr>
        	<td><input type="checkbox" name="" /></td>
            <td>User ID</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
			<td>Email</td>
            <td><a href="#"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>
        
    	<tr>
        	<td><input type="checkbox" name="" /></td>
            <td>User ID</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
			<td>Email</td>
            <td><a href="#"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>    
        
    </tbody>
</table> 

      <div class="pagination">
        <span class="disabled"><< prev</span><span class="current">1</span><a href="">2</a><a href="">3</a><a href="">4</a><a href="">5</a>…<a href="">10</a><a href="">11</a><a href="">12</a>...<a href="">100</a><a href="">101</a><a href="">next >></a>
        </div> 
   
      
     
    </div><!-- end of right content-->
            
                    
 </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
<?php
include("includes/footer.php");
?>

</div>		
</body>
</html>