<link rel="stylesheet" href="public/css/jquery-ui.css" type="text/css" media="all" />
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
            
<script src="public/js/jquery-ui.min.js" type="text/javascript"></script>
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


		$( "#q" ).autocomplete({
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
<!-- Start Suggetion div -->
  
  <div id="suggestions_what" style="font-size:10px;font-weight:bold;"></div>
  <div id="suggestions_where" style="font-size:10px;font-weight:bold;"></div>
  <!-- End -->

<header>
<div id="header">
  <div id="intro" class="grid_7"> <a href="index.php"><img src="public/img/logo.png" alt="Logo"/></a> </div>
  <div class="grid_17">
    <div style="background-color:#0C0;width:468px;height:60px;margin-left:90px;margin-top:10px;margin-bottom:10px;">
      <?php require_once('templates/top_ad.php');?>
    </div>
    <form class="horizontal" action="search.php" method="get" id="search_form">
      What
      <input type="text" class="input-large search-query" placeholder="Business Name or Category" name="q" id="q" value="<?php echo $what;?>">
      Where
      <input type="text" class="input-large search-query" placeholder="Location" name="city" id="city" value="<?php echo $where;?>">
      <button type="submit" class="btn btn-primary" name="btnSearch" id="btnSearch">Search</button>
    </form>
    <div id="advanced_search" class="grid_6"> <a href="advanced_search.php">Advanced Search</a> </div>
  </div>
</div>
<div style="clear:both"></div>
</header>