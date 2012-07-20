<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/960_24_col.css" rel="stylesheet">
    <link href="public/css/reset.css" rel="stylesheet">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php require_once('includes/geo_location_all.php');?>

<script type="text/javascript">



function loadMap()
{
	alert('<?php echo $latitude;?>');
	var latlng = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
	var opt =
	{
	  center:latlng,
	  zoom:10,
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	  disableAutoPan:false,
	  navigationControl:true,
	  navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL },
	  mapTypeControl:true,
	  mapTypeControlOptions: {style:google.maps.MapTypeControlStyle.DROPDOWN_MENU}
	};
	var map = new google.maps.Map(document.getElementById("map"),opt);
	var marker= new google.maps.Marker({
	position: new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>),
	title: "<?php echo $title;?>",
	clickable: true,
	map: map
	});
	
	var infowindow = new google.maps.InfoWindow(
	{
	content: "<?php echo $title;?>"
	
	});
	
	google.maps.event.addListener(marker,'click',function(){
	infowindow.open(map,marker);
	});
}
</script>

    
<style type="text/css">
/* <![CDATA[ */

	
  

	#listing_container {
	  
	  margin: auto;
		padding:0;
		display: table;
		border: 1px solid black;
		}

  #listing_row  {
    display: table-row;
	
    }

	#counter 
	{
		width:20px;
		padding-left:10px;
		border-left:1px solid #000;
		display: table-cell;
	}

	#title 
	{
		width:250px;
		padding-left:10px;
		border-left:1px solid #000;
    	display: table-cell;
	}

	#view 
	{
		width:20px;
		padding-left:10px;
		border-left:1px solid #000;
    	display: table-cell;
	}
	#edit 
	{
		width:20px;
		padding-left:10px;
		border-left:1px solid #000;
    	display: table-cell;
	}
	#delete 
	{
		width:20px;
		padding-left:10px;
		border-left:1px solid #000;
    	display: table-cell;
	}

/* ]]> */
</style>
</head>

<body onLoad="loadMap()">
<div id="map" style="width:500;height:400px;"></div>
<div id="listing_container">
      <div id="listing_row">

  	<div id="counter">
  		
  		<p>Lorem ipsum dolor sit amet, consectetuer </p>
  	</div>
  	<div id="title">
  		<h4>Middle Col</h4>
  		<p>Lorem ipsum dolor sit amet, consectetuer </p>
  	</div>

  	<div id="view">
    	
    	<p>tuer </p>
  	</div>
	<div id="edit">
    	
    	<p>tuer </p>
  	</div>
    <div id="delete">
    	
    	<p>tuer </p>
  	</div>
    </div>
    <div class="clear"></div>
    <div id="listing_row">

  	<div id="counter">
  		
  		<p>Lorem ipsum dolor sit amet, consectetuer </p>
  	</div>
  	<div id="title">
  		<h4>Middle Col</h4>
  		<p>Lorem ipsum dolor sit amet, consectetuer </p>
  	</div>

  	<div id="view">
    	
    	<p>tuer </p>
  	</div>
	<div id="edit">
    	
    	<p>tuer </p>
  	</div>
    <div id="delete">
    	
    	<p>tuer </p>
  	</div>
	
	</div>
</div>
</body>
</html>