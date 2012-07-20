<?php @session_start();?>
<?php 
require_once('includes/init.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo DOMAIN_NAME;?> Privacy Policy</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
     <!-- Le styles -->
    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/960_24_col.css" rel="stylesheet">
    <link href="public/css/reset.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
	<link href="public/css/ad.css" rel="stylesheet">  
	    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="public/icons/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
    <link rel="apple-touch-icon-precomposed" href="">
    
    
 	<script src="public/js/jquery.js"></script>
    <script src="public/js/bpopup-0.6.0.min.js"></script>
    
    <script src="public/js/functions.js"></script>
  
 
  
  
  <!-- Start -->
  
  <!-- CSS -->
			<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.21/themes/base/jquery-ui.css" type="text/css" media="all" />
			<!--<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />-->
			
			 <style type="text/css">
			.ui-autocomplete-loading {
  			  background: url(public/img/loading_small.gif)no-repeat scroll right center white;
			}
			
			.ui-autocomplete-category
			{
				border-bottom: 1px dotted #555555;
   				 color: #555555;
				
			}
			</style>
			
<!-- JS -->
			<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>-->
			<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js" type="text/javascript"></script>
			<!--<script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>-->
			<!--<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/minified/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>-->
			
   <script type="text/javascript">
	$(function() {
		var selectedItem;
		function log( message ) {
			
		}

		$( "#city" ).autocomplete({
			source: function( request, response ) {

				if($('#q').val().length>0)
				{
					$.ajax({
						url: "service.php",
						dataType: "json",
						data: {
							service: "location",
							maxRows: 12,
							query: request.term,
							business:$('#q').val()
						},
						success: function( data ) {
							response( $.map( data.response, function( item ) {
								return {
									label: item.city + ","+ item.country,
									value: item.city
								}
							}));
						}
					});
				}
				else
				{
				$.ajax({
					appendTo:"suggestions_where",
					url: "http://ws.geonames.org/searchJSON",
					dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term
					},
					success: function( data ) {
						
						response( $.map( data.geonames, function( item ) {
							
							return {
								label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								value: item.name
							}
						}));
						
					}
				});
				}
			},
			minLength: 2,
			select: function( event, ui ) {
				log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
				
			},
			open: function() {
				
				
				if($('#q').val().length>0)
				{
				}
				else
					$( '.ui-autocomplete,.ui-menu' ).prepend('<li class="ui-autocomplete-category"  style="font-size:10px;text-align:right">Suggesions</li>');
		
			},
			close: function() {
				//$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});


		$( "#q" ).autocomplete({
			appendTo:"#suggestions_what",
			source: function( request, response ) {
				$.ajax({
					url: "service.php",
					dataType: "json",
					data: {
						service: "search",
						maxRows: 12,
						query: request.term
					},
					success: function( data ) {
						response( $.map( data.response, function( item ) {
							return {
								label: item.title,
								value: item.title
							}
						}));
					}
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
				selectedItem=ui.item ?
							 ui.item.label :
							null;
			
			},
			open: function() {
				
				
				$( '.ui-autocomplete,.ui-menu' ).prepend('<li class="ui-autocomplete-category" style="font-size:10px;text-align:right">Suggesions<br></li>')
			},
			close: function() {
				//$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	});
	
	
	</script>
   
     
     <!-- End-->
     
     
     
     
     
       
<style type="text/css">
.response-waiting {
background:url(public/img/loading_small.gif) no-repeat;
}

.response-success {
background:url(public/img/tick.png) no-repeat;
}

.response-error {
background:url(public/img/cross.png) no-repeat;
}
</style>

</head>

<body>

<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  
  <?php require_once('templates/header.php');?>
  
  <?php require_once('templates/linkbar.html');?>

   <div class="grid_17">
   <div class="grid_17" id="main_wrapper"><!--Begins main wrapper-->
  <div id="page_topic"><h1>Privacy Policy</h1></div>
  
  <div class="grid_17" id="page_content">
  
  <!-- Start Suggetion div -->
  
  <div id="suggestions_what" style="font-size:10px;font-weight:bold;"></div>
  <div id="suggestions_where" style="font-size:10px;font-weight:bold;"></div>
  <!-- End -->
  
  </div>
  
	
   </div>
   </div>
 
   <div class="grid_6" id="sec_col"></div>
   
   
   
  <div class="clear"></div>
  
  <?php require_once('templates/footer.php');?>
   
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
