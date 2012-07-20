
<script type="text/javascript">
function setGeoLocInDIvs(lat,lon,city,region,country)
{
	$("#user_lat").html(lat);
	$("#user_long").html(lon);
	$("#user_town").html(city);
	$("#user_county").html(region);
	$("#user_country").html(country);
}

function onSuccess(position)
{
	visitor_lat = position.coords.latitude;
	visitor_lon = position.coords.longitude;
	DoReverseGeo(visitor_lat,visitor_lon);
				
}
function onError(err)
{
	DoFallback();
}
function DoReverseGeo(visitor_lat,visitor_lon)
{
var lat = parseFloat(visitor_lat);
var lng = parseFloat(visitor_lon);
var latlng = new google.maps.LatLng(lat, lng);
geocoder = geocoder = new google.maps.Geocoder();
geocoder.geocode({'latLng': latlng}, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK) {
    if (results[1]) {
       if (results[1]) {
        var indice=0;
        for (var j=0; j<results.length; j++)
        {
            if (results[j].types[0]=='locality')
                {
                    indice=j;
                    break;
                }
        }
        
        console.log(results[j]);
        for (var i=0; i<results[j].address_components.length; i++)
            {
                if (results[j].address_components[i].types[0] == "locality") {
                        //this is the object you are looking for
                        visitor_city = results[j].address_components[i];
                    }
                if (results[j].address_components[i].types[0] == "administrative_area_level_1") {
                        //this is the object you are looking for
                        visitor_region = results[j].address_components[i];
                    }
                if (results[j].address_components[i].types[0] == "country") {
                        //this is the object you are looking for
                        visitor_country = results[j].address_components[i];
                    }
            }

            
        alert(visitor_city.long_name + " || " + visitor_region.long_name + " || " + visitor_country.long_name)
		var visitor_address = visitor_city.long_name + ", " + visitor_region.long_name + ", " + visitor_country.long_name;
		document.cookie = 'lat' + "=" + visitor_lat;
		document.cookie = 'long' + "=" + visitor_lon;
		document.cookie = 'city' + "=" + visitor_city.long_name;
		document.cookie = 'region' + "=" + visitor_region.long_name;
		document.cookie = 'country' + "=" + visitor_country.long_name;
		document.cookie = 'address' + "=" + visitor_address;
		$.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
             data: 'action=geolocation&lat='+ visitor_lat +'&long='+ visitor_lon +'&city='+ visitor_city +'&region='+ visitor_region +'&country='+ visitor_country +'&address='+ visitor_address,
            success: function(ret) {
                 
               alert("aaa");
			   
                 
            }
        });
		
        }    
    } 
  } 
});
}

function DoFallback()
{
	$(document).ready(function(){
		   if(google.loader.ClientLocation) {
			// Google has found you
			visitor_lat = google.loader.ClientLocation.latitude;
			visitor_lon = google.loader.ClientLocation.longitude;
			visitor_city = google.loader.ClientLocation.address.city;
			visitor_region = google.loader.ClientLocation.address.region;
			visitor_country = google.loader.ClientLocation.address.country;
			visitor_countrycode = google.loader.ClientLocation.address.country_code;
			
			var visitor_address = visitor_city + ", " + visitor_region + ", " + visitor_country;
			document.cookie = 'lat' + "=" + visitor_lat;
			document.cookie = 'long' + "=" + visitor_lon;
			document.cookie = 'city' + "=" + visitor_city;
			document.cookie = 'region' + "=" + visitor_region;
			document.cookie = 'country' + "=" + visitor_country;
			document.cookie = 'address' + "=" + visitor_address;
			
			$.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
             data: 'action=geolocation&lat='+ visitor_lat +'&long='+ visitor_lon +'&city='+ visitor_city +'&region='+ visitor_region +'&country='+ visitor_country +'&address='+ visitor_address,
            success: function(ret) {
                 
               alert("aaa");
			  
                 
            }
        });
			//setGeoLocInDIvs(visitor_lat,visitor_lon,visitor_city,visitor_region,visitor_country);
			
		}
		else {
			// Google couldnt find you, Maxmind could
			visitor_lat = geoip_latitude();
			visitor_lon = geoip_longitude();
			visitor_city = geoip_city();
			visitor_region_code = geoip_region();
			visitor_region = geoip_region_name();
			visitor_country = geoip_country_name();
			visitor_countrycode = geoip_country_code();
			visitor_postcode = geoip_postal_code();
			
			var visitor_address = visitor_city + ", " + visitor_region + ", " + visitor_country;
			document.cookie = 'lat' + "=" + visitor_lat;
			document.cookie = 'long' + "=" + visitor_lon;
			document.cookie = 'city' + "=" + visitor_city;
			document.cookie = 'region' + "=" + visitor_region;
			document.cookie = 'country' + "=" + visitor_country;
			document.cookie = 'address' + "=" + visitor_address;
			
			
	
	 $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=geolocation&lat='+ visitor_lat +'&long='+ visitor_lon +'&city='+ visitor_city +'&region='+ visitor_region +'&country='+ visitor_country +'&address='+ visitor_address,
            success: function(ret) {
                 
               alert("aaa");
			  
                 
            }
        });


			//setGeoLocInDIvs(visitor_lat,visitor_lon,visitor_city,visitor_region,visitor_country);
			
		}
		
		
	});
}



</script>
<?php
?>
<script type="text/javascript">
	
		if (navigator.geolocation) {
					
			navigator.geolocation.getCurrentPosition(
						onSuccess,
						onError, {
							enableHighAccuracy: true,
							timeout: 10000,
							maximumAge: 120000
						});
		}		
		
	</script>
<?php
?>