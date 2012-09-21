<?php @session_start();?>
<?php require_once('includes/init.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Advanced Search -<?php echo DOMAIN_NAME;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Advanced Search in <?php echo DOMAIN_NAME;?> online directory." />
<meta name="keywords" content="listing search, advanced listing search">
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
<!-- Start -->
<link rel="stylesheet" href="public/css/jquery-ui.css" type="text/css" media="all" />
<style type="text/css">
.ui-autocomplete-loading {
	background: url(public/img/loading_small.gif)no-repeat scroll right center white;
}
.ui-autocomplete-category {
	border-bottom: 1px dotted #555555;
	color: #555555;
}
</style>
<script src="public/js/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		var selectedItem;
		function log( message ) {
			
		}

		$( "#where" ).autocomplete({
			source: function( request, response ) {

				if($('#q').val().length>0)
				{
					$.ajax({
						url: "includes/process_suggestions.php",
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
				
				$( '.ui-autocomplete,.ui-menu' ).css('font-size','12px').css('width',$(this).outerWidth());
				if($('#q').val().length>0)
				{
					$( '.ui-autocomplete,.ui-menu' ).prepend('<li class="ui-autocomplete-category"><div style="font-size:10px;text-align:right">Suggesions</div><strong>Locations for: </strong>'+$('#q').val()+'</li>');
							}
				else
					$( '.ui-autocomplete,.ui-menu' ).prepend('<li class="ui-autocomplete-category" ><div style="font-size:10px;text-align:right">Suggesions</div></li>');
		
			},
			close: function() {
				//$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});


		$( "#what" ).autocomplete({
			appendTo:"#suggestions_what",
			source: function( request, response ) {
				$.ajax({
					url: "includes/process_suggestions.php",
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
				
				$( '.ui-autocomplete,.ui-menu' ).css('font-size','12px').css('width',$(this).outerWidth());
				$( '.ui-autocomplete,.ui-menu' ).prepend('<li class="ui-autocomplete-category" style="font-size:10px;text-align:right">Suggesions<br></li>')
			},
			close: function() {
				//$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	});
	
	
	</script>
<!-- end -->
</head>
<body>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <div class="grid_17">
    <div class="grid_17" id="main_wrapper">
      <!--Begins main wrapper-->
      <div id="page_topic"> Advanced Search </div>
      <div class="grid_17" style="padding:10px;padding-right:10px;min-height:500px;">
        <form action="search.php" method="get" enctype="multipart/form-data" name="listing-form" class="form-horizontal" onSubmit="map_geocode( this.address.value ); return false;" style="margin-top:30px;">
          <div class="control-group">
            <label class="control-label" for="input01">Keywords</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="what" name="q">
              <select name="listSearchCriteria" style="width:80px;">
                <option value="all">All</option>
                <option value="name">Name</option>
                <option value="tagline">Tagline</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input03">Where</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="where" name="city">
              <select name="listLocationCriteria" style="width:80px;">
                <option value="all">All</option>
                <option value="street">Street</option>
                <option value="city">City</option>
                <option value="country">Country</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input04">Main Category</label>
            <div class="controls">
              <select name="listCategory"  id="search_category_id" class="input-xlarge">
                <option value="" selected="selected"></option>
                <?php
		$query = "select * from lbs_biz_main_categories ";
		$results = mysql_query($query);
		
		while ($rows = mysql_fetch_assoc(@$results))
		{?>
                <option value="<?php echo $rows['main_category_id'];?>"><?php echo $rows['name'];?></option>
                <?php
		}?>
              </select>
            </div>
            <!--End of Main category control-->
          </div>
          <div class="control-group">
            <label class="control-label" for="input03" id="show_heading">Sub Category</label>
            <div class="controls" >
              <div id="show_sub_categories"> <img src="public/img/loader.gif" style="margin-top:8px; float:left" id="loader" alt="" /> </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input03" id="show_heading"></label>
            <div class="controls" >
              <div id="show_submit">
                <button type="submit" class="btn btn-primary" value="advancedSearch" name="btnSearch" id="btnSearch">Search</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="grid_6">
    <?php require_once('templates/right_column.php');?>
  </div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>
