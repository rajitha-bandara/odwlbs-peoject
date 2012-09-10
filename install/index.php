<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>123biz Directory Installation Wizard</title>

<link type="text/css" rel="stylesheet" href="../public/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="../public/css/jWizard.base.css" />

</head>

<body>

<div style="width:600px;margin-left:300px;margin-top:50px;">
<form id="jWizard" action="a.php" method="post">
	<div title="Introduction">
		<h4>Welcome to 123biz Directory Installation!</h4>
		<p>123biz Directory is an online business directory web application which allows users to add listings and search local businesses.</p>
		<p>You are about to install 123biz Directory v.1.0</p>
        <p>Click Next to proceed.</p>
	</div>
	<div title="Requirements">
		<h3>Requirements</h3>
		<input  type="button" onclick="window.open('probe.php','view');" value="Run Environment Test" />
        <iframe name="view" src="" width="350px" height="150px" style="margin-top:10px;border:0px;" scrolling="auto"></iframe>
        
	</div>
	<div title="Database Settings">
		<h3>Database Settings</h3>
		<table width="350px" border="0">
  <tr>
    <td>Database Server Host Name</td>
    <td><input type="text" name="txtHost" id="txtHost"  size="25px"  /></td>
  </tr>
  <tr>
    <td>Database Username</td>
    <td><input type="text" name="txtDbuser" id="txtDbuser" size="25px" /></td>
  </tr>
  <tr>
    <td>Database Password</td>
    <td><input type="password" name="txtDbPass" id="txtDbPass" value="" size="25px"  /></td>
  </tr>
  <tr>
    <td>Database Name</td>
    <td><input type="text" name="txtDbName" id="txtDbName" value="" size="25px" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

        
	</div>
	
    <div title="Server URL Settings">
		<h3>Server URL Settings</h3>
		<table width="350px" border="0">
  <tr>
    <td>Domain Name</td>
    <td><input type="text" name="txtDomain" id="txtDomain" size="25px" value="<?php echo $_SERVER['HTTP_HOST']; ?>" required=required /></td>
  </tr>
  <tr>
    <td>Root Directory</td>
    <td><input type="text" name="txtRoot" id="txtRoot" size="25px"  value="<?php echo dirname(dirname(__FILE__)); ?>" placeholder="eg. home/public_html " />
    
    </td>
  </tr>
  
  <tr>
    <td>Site URL</td>
    <td><input type="text" name="txtURL" id="txtURL" size="25px"  value="" placeholder="eg. http://wwww.example.com" /></td>
  </tr>
</table>
	</div>
    <div title="Application Settings">
		<h3>Application Settings</h3>
		<table width="350px" border="0">
  <tr>
    <td>Google Map API Key</td>
    <td><input type="text" name="txtGoogle" id="txtGoogle" size="25px"  /></td>
  </tr>
  <tr>
    <td>Facebook APP ID</td>
    <td><input type="text" name="txtFb" id="txtFb" size="25px" /></td>
  </tr>
  <tr>
    <td>Mailchimp API Key</td>
    <td><input type="text" name="txtMailchimp" id="txtMailchimp" size="25px"  /></td>
  </tr>
  <tr>
    <td>Google Analytics Property ID</td>
    <td><input type="text" name="txtGA" id="txtGA"  size="25px" /></td>
  </tr>
 
</table>
	</div>
    <div title="Administrator Details">
		<h3>Administrator Details</h3>
		<table width="350px" border="0">
  <tr>
    <td>Administrator Username</td>
    <td><input type="text" name="txtAdminU" id="txtAdminU" size="25px"  /></td>
  </tr>
  <tr>
    <td>Administrator Password</td>
    <td><input type="password" name="txtAdminP" id="txtAdminP" size="25px" /></td>
  </tr>
 
  <tr>
    <td>Contact Email</td>
    <td><input type="text" name="txtEmail" id="txtEmail"  size="25px" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
	</div>
    <div title="Install">
		<h3>Install</h3>
		<p>You have completed all the steps of the wizard!</p>
        <p>Now you are ready to install 123biz Directory</p>
        <p>Please delete install directory after installation</p>
		<p>Click Finish below to Proceed</p>
      <div id="response" style="font-weight:bold;color:#069;"></div>
    </div>
</form>
</div>
<script type="text/javascript" src="../public/js/jquery-1.7.js"></script>
<script type="text/javascript" src="../public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.jWizard.js"></script>
<script type="text/javascript" src="../public/js/jquery.validate.js"></script>

<script type="text/javascript">
$(document).ready(function($) {
	

	$("#jWizard").jWizard({
		menuEnable: true,
		counter: { enable: true },
		effects: { enable: true }
	});
	});

$(document).ready(function() {
	
	$w = $("#jWizard");

	$w.validate({ errorClass: "ui-state-error-text" });

	$w
		.jWizard({
			buttons: {
				cancelType: "reset",	// Resets the form when the Cancel Button is clicked (use in conjunction with onCancel to jump to the first step)
				finishType: "click"	// Will POST the form when the Finish Button is clicked
			},

			// The 4 functions below are callbacks... they are the last function to be executed before deciding whether or not to proceed
			cancel: function(event, ui) {
				$w.jWizard("firstStep");
			},
			previous: function(event, ui) {
				// some code
			},
			next: function(event, ui) {
				// some code
			},
			finish: function(event, ui) {
							
				host = document.getElementById('txtHost').value;
				user = document.getElementById('txtDbuser').value;
				pass = document.getElementById('txtDbPass').value;
				db = document.getElementById('txtDbName').value;
				domain = document.getElementById('txtDomain').value;
				root = document.getElementById('txtRoot').value;
				url = document.getElementById('txtURL').value;
				google = document.getElementById('txtGoogle').value;
				fb = document.getElementById('txtFb').value;
				mailchimp = document.getElementById('txtMailchimp').value;
				ga = document.getElementById('txtGA').value;
				adminU = document.getElementById('txtAdminU').value;
				adminP = document.getElementById('txtAdminP').value;
				email = document.getElementById('txtEmail').value;
				
				
				$.ajax({
            url: 'ajax.php',
            type: 'POST',
            data: 'action=install&host='+ host + '&user='+ user +'&pass=' + pass + '&db='+ db  + '&domain='+ domain  +'&root=' + root +'&url=' + url + '&google='+ google + '&fb=' + fb + '&mailchimp=' + mailchimp + '&ga='+ ga + '&adminU=' + adminU + '&adminP=' + adminP + '&email=' + email,
            success: function(data) {
               var response = jQuery.parseJSON(data);
			   if(response.status = 'ok')
			   {
				   msg = "Congratulations! You have succesfully installed 123biz Directory.<br> You may now login as admin<br>                     <a href='" + url + "/admin'>Login</a>" ;
			   }
			   else
			   {
				   msg = "Installation is not successful. Please reinstall the system.";
			   }
               document.getElementById('response').innerHTML = response.message + "<br>" + msg;  
            }
        });
				





			}
		})
		
		
	
});
</script>
<script type="text/javascript">

</script>

</body>

</html>