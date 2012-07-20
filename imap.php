<?php @session_start();?>
<?php require_once('includes/geo_location_all.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="public/css/bootstrap.css" rel="stylesheet">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/reset.css" rel="stylesheet">

<script src="https://maps.google.com/maps?file=api&sensor=false" type="text/javascript"></script>

<script src="public/js/jquery.js"></script>


<script type="text/javascript">
		var map = null;
		var geocoder = null; 
		var submissionType = '';
		var ajaxFunction = ''; 
		
        
   		function initialize()
		{
			if (GBrowserIsCompatible())
			{
				
				map = new GMap2(document.getElementById("map_canvas"));
                map.setCenter(new GLatLng(<?php echo $user_lat;?>, <?php echo $user_long;?>), 13);
				map.addControl(new GSmallMapControl());
				geocoder = new GClientGeocoder();
				showAddress('<?php echo $user_address;?>');
			}
		}
		function getAddress(overlay, latlng) 
		{
  			if (latlng != null)
  			{
    			address = latlng;
    			geocoder.getLocations(latlng, showNewAddress);
  			}
		}
		
		
		//Getting the Latitude/Longitude values and Location Map   
		function showAddress(address)
		{
            
			if (geocoder)
			{
				geocoder.getLatLng(
          		address,
          		function(point)
          		{
            		if (!point)
            		{
              			document.getElementById("msg").innerHTML = "Unable to find Latitude/Longitude values for your location: " + address + "." + "Please manually enter them below.";
              			document.latLonPicker.latitude.value = "0.0000";
              			document.latLonPicker.longitude.value = "0.0000";
              			document.getElementById('address').innerHTML = address;
            		} 
            		else
            		{
              			map.setCenter(point, 13);
              			var marker = new GMarker(point, {draggable: true});
              			map.addOverlay(marker);
              			marker.openInfoWindowHtml(address);
              			GEvent.addListener(marker, "dragstart", function() 
              			{
            				map.closeInfoWindow();
            			});
            			GEvent.addListener(marker, "dragend", function() 
            			{     					
      						getAddress(null , marker.getLatLng());
    						});
              			var str = point.toString();
              			var str2 = str.substring(1, str.length-1);
              			geocode = str2.split(", ");
              			document.getElementById("msg").innerHTML = "Please drag and drop the position marker to the correct position or manually edit GPS details below if there is any difference.";
              			
              			document.latLonPicker.latitude.value = geocode[0];
              			document.latLonPicker.longitude.value = geocode[1];
						document.getElementById('address').innerHTML = address;
              			//document.search.confirmedLatitude.value = document.search.latitude.value;
						//document.search.confirmedLongitude.value = document.search.longitude.value;
						
            		}
          		}
        		);
      	}
		
		showMap();
    	}
    
    	function showNewAddress(response) 
    	{
  			map.clearOverlays();
  			if (!response || response.Status.code != 200)
  			{
    			alert("Status Code:" + response.Status.code);
  			} 
  			else 
  			{
    		place = response.Placemark[0];
    		point = new GLatLng(place.Point.coordinates[1],
                        place.Point.coordinates[0]);
    		marker = new GMarker(point, {draggable: true});
    		map.addOverlay(marker);
    		marker.openInfoWindowHtml(place.address);
    		document.getElementById("msg").innerHTML = "Please drag and drop the position marker to the correct position or manually edit GPS details below if there is any difference.";
         document.latLonPicker.latitude.value = place.Point.coordinates[1];
         document.latLonPicker.longitude.value = place.Point.coordinates[0];
		 document.getElementById('address').innerHTML = (place.address).toString();
		 
         //document.search.confirmedLatitude.value = document.search.latitude.value;
			//document.search.confirmedLongitude.value = document.search.longitude.value;
         GEvent.addListener(marker, "dragstart", function() 
         { 
         	map.closeInfoWindow();
        	});
         GEvent.addListener(marker, "dragend", function() 
         {
      		getAddress(null , marker.getLatLng());
    		});
  			}
		}
    
    		
		//Pop-Up the Location Map with Geocodes 
		function showMap()
		{
			var geoMap = document.getElementById("geoMap");	
			geoMap.style.display = 'block';
			geoMap.style.position = 'absolute'; 			
			geoMap.style.fontFamily = 'Arial';
			geoMap.style.fontSize = '11px'; 
			geoMap.style.zIndex = '100';
			geoMap.style.backgroundColor = "#FFFFFF";
			geoMap.style.border = 'thick solid #808080';
			map.checkResize();
  			
		}
		
		//When clicked on the Relocate button 
		function doRelocate()
		{
			document.latLonPicker.confirmedLatitude.value = document.latLonPicker.latitude.value;
			document.latLonPicker.confirmedLongitude.value = document.latLonPicker.longitude.value;
			map.setCenter(new GLatLng(document.latLonPicker.confirmedLatitude.value, document.latLonPicker.confirmedLongitude.value),  13);
         map.clearOverlays();
         var marker = new GMarker(new GLatLng(document.latLonPicker.confirmedLatitude.value, document.latLonPicker.confirmedLongitude.value), {draggable: true});
			map.addOverlay(marker);
    		GEvent.addListener(marker, "dragstart", function() 
    		{
         	map.closeInfoWindow();
         });
         GEvent.addListener(marker, "dragend", function() 
         {     					
      		getAddress(null , marker.getLatLng());
    		});
		}
	
		function doSubmit()
		{
				
			newLatitude = document.latLonPicker.latitude.value;
			newLongitude = document.latLonPicker.longitude.value;
			newAddress = document.getElementById('address').innerHTML;
			
			//write new location details to cookie
			document.cookie = 'lat' + "=" + newLatitude;
			document.cookie = 'long' + "=" + newLongitude;
			document.cookie = 'address' + "=" + newAddress;
			document.getElementById('msg').innerHTML = "<font color='red'>Please refresh the page to reflect your changes </font>";
			$.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=updateUserAddress&lat='+newLatitude+'&long='+newLongitude+'&address='+ newAddress,
            success: function(ret) {
             alert('Please refresh the page to reflect your changes');
                 
            }
        });
			
			javascript:parent.jQuery.fancybox.close();
			
		}
		 
   </script>
		
<style type="text/css">
body{
	height:480px;
	margin:0px;
	padding:0px;
}
#latLonPicker{
	margin:10px;
}
#map #geoMap{
	width: 500px;
}
#map #geoMap #map_canvas{
	width: 500px;
	height: 300px;
}
#map #geoMap #msg{
	margin-left:10px;
}
#map #geoMap #manual{
	font-size:12px;
	margin-left:10px;
	
}
#map #geoMap #manual #latitude,#map #geoMap #manual #longitude{
	margin-right:20px;
	
}
#map #geoMap #manual #address{
	margin-left:10px
	
}
#map #geoMap #manual #btn_panel{
	margin-bottom:10px;
	
}
</style>	

</head>

<body onLoad="initialize();">

 
                                                                                
<form name="latLonPicker" id="latLonPicker">
<input type="hidden" name="confirmedLatitude">
<input type="hidden" name="confirmedLongitude">
<div id="map">
 
 <div id="geoMap"><div id="map_canvas"></div><br>
 <div id="msg"></div>
 <br>
 <div id="manual">
Latitude <input id="latitude" name="latitude" type="text" class="input-medium">
Longitude<input id="longitude" name="longitude" type="text" class="input-medium">
<br> 
Location <div id="address"></div>
<br>
<div id="btn_panel">
<button name="confirm" id="confirm" onclick="doSubmit();" class="btn btn-primary" style="margin-left:10px;">Confirm</button>

<button name="relocate" onclick="doRelocate();" class="btn btn-primary" style="margin-left:10px;">Relocate</button>
</div>
</div>
</div>
 </div>
</form>
 
<script src="public/js/bootstrap/bootstrap-button.js"></script>                     
</body>
</html>
