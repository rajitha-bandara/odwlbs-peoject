<?php
@session_start();
require_once('../includes/init.php');
require_once('includes/login_status.php');
?>

<?php 
require_once('includes/process_add_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo DOMAIN_NAME . " Admin Panel ";?></title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="public/css/new_styles.css" />
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
?>    
</div>
              
        
    <div class="right_content">            
    
   	<h2>Add User</h2>
    
    <div class="form">
    
         <form action="" method="post" class="niceform">
         
                <fieldset>
                    <dl>
                        <dt><label for="email">Username:</label></dt>
                        <dd><input type="text" name="txtUname" id="txtUname" size="54" /></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd><input type="password" name="txtPass" id="txtPass" size="54" /></dd>
                    </dl>
                        <dl>
                        <dt><label for="password">Email:</label></dt>
                        <dd><input type="text" name="txtEmail" id="txtEmail" size="54" /></dd>
                    </dl>
                    
                    
                    
                    <dl>
                        <dt><label for="interests">User Groups:</label></dt>
                            <div>
                        	
                            <input type="radio" name="role" id="" value="uadmin" /><label class="check_label">Administrator</label>
                            
                            <input type="radio" name="role" id="" value="unormal" /><label class="check_label">Normal User</label>
                            
                                                   
                            <input type="radio" name="role" id="" value="uguest" /><label class="check_label">Guest</label>
                            
                            </div>    
                    </dl>
                    
                    <dl class="submit">
                    <input type="submit" name="btnAddUser" id="btnAddUser" value="Submit" />
                    </dl>
      
                </fieldset>
                 <div id="response">
    				<?php echo $msg;?>
    			</div>
         </form>
         
        
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