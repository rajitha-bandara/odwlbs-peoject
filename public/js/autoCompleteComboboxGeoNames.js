/*
 

var latitude;
var longitude;
var method;//GeoLocation=geo and MaxMind=max
var location;//This will hold the JSON data response from google


//check weather the browser supports w3c geo location service
if (navigator && navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(function (position)
			{
					set_Latitude_Longitude(position.coords.latitude,position.coords.longitude,"geo");
			}, geo_error);
	
 
	}
else 
	{
    
		set_Latitude_Longitude(geoip_latitude(),geoip_longitude(),"max");
		
	}




//this function will be executed if the browser successfully identifies geo location 
function set_Latitude_Longitude(lat,long,method)
{
	this.latitude=lat;
	this.longitude=long;
	this.method=method;
	
	
	if(method=='max')
		{
			//This requires for maxmind free service
    		$('body').append('<p><a href="http://www.maxmind.com" target="_blank">IP to Location Service Provided by MaxMind</a></p>');

		}
	
	set_location(latitude,longitude);
}


//this function will be executed if the browser supports and identifies geo location 
function geo_error(err)
	{
    if (err.code == 1) 
    {
       // alert('The user denied the request for location information.');
    	 alert('Please enable share location to provide you more accurate results');
        set_Latitude_Longitude(geoip_latitude(),geoip_longitude(),"max");
    } 
    else if (err.code == 2) 
    {
    	alert('Your location information is unavailable.');
    	set_Latitude_Longitude(geoip_latitude(),geoip_longitude(),"max");
    } 
    else if (err.code == 3) 
    {
    	alert('The request to get your location timed out.');
    	set_Latitude_Longitude(geoip_latitude(),geoip_longitude(),"max");
    } 
    else if(err==4)
    {
    	alert("Reverse Geocoding failed ");
   	}
    else
    {
    	alert('An unknown error occurred while requesting your location.');
    }
}


//This will convert the lat and long values to corressponding adress
function set_location(lat,long)
{
	var geoCoderObj=new google.maps.Geocoder();
	var locationObj=new  google.maps.LatLng(lat, long);
	
	geoCoderObj.geocode({ 'latLng': locationObj }, function (results, status) 
			{
				if (status == google.maps.GeocoderStatus.OK)
				{
					
					this.Location=results;
					if (results[0])
					{
						document.getElementById('addressDiv').innerHTML= '<p>Your Address: ' +results[0].formatted_address + '</p>' ;
						document.getElementById('cityDiv').innerHTML= '<p>Your Nearest City: ' + results[0].address_components[2].long_name + '</p><p> Method :'+this.method +'   Longitude/Latitude :'+ this.longitude+'/'+this.latitude ;
						
						set_location_textbox_text(results[0].address_components[2].long_name);
						
						
					} 
					else 
					{
						geo_error(4);
					}
				} 
				else 
				{
					geo_error(4);
				}
			});

}

function set_location_textbox_text(text)
{
    var textBox = document.getElementById("cbCity");
    textBox.value = null;
    textBox.value = textBox.value + text;
}

* 
 */

//Following Code handles the autocomplete of city textbox

var lastResponse;
var selectedLat;
var selectedLong;
function setLastResponse(data)
{
	lastResponse=data;
}

function setLatLong(lat,long)
{
	this.selectedLat=lat;
	this.selectedLong=long;
	
	alert(this.selectedLat+""+this.selectedLong);

}

$(function(){
// filter
$.widget("ui.combobox", {
    _create: function() {
        var self = this,
            select = this.element.hide(),
            selected = select.children(":selected"),
            value = selected.val() ? selected.text() : "";
        var input = this.input = $("<input>").insertAfter(select).val(value).autocomplete({
            delay: 0,
            minLength: 0,
            source: function(request, response) {
                $.ajax({
                    url: "http://ws.geonames.org/searchJSON",
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term
                    },
                    success: function(data) {
                    	setLastResponse(data);
                        response($.map(data.geonames, function(item) {
                        	
                            return {
                                label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                                value: item.name
                            }
                        }));
                    }
                })
            },
            select: function(event, ui) {
            	
            	
            	 for (var i = 0, len = lastResponse.geonames.length; i < len; ++i) {
            		
            	     var city = lastResponse.geonames[i];
            	     if(city.name==ui.item.value)
            	    	 {
            	    	 	setLatLong(city.lat,city.lng);
            	    	 }
              	 }

            },

        }).addClass("input-xlarge");

        input.data("autocomplete")._renderItem = function(ul, item) {
            return $("<li></li>").data("item.autocomplete", item).append("<a>" + item.label + "</a>").appendTo(ul);
        };

        this.button = null;
    },

    destroy: function() {
        this.input.remove();
        this.button.remove();
        this.element.show();
        $.Widget.prototype.destroy.call(this);
    }
});

$("#cbCity").combobox({
    source: "http://ws.geonames.org/searchJSON",
    dataType: "jsonp",
    minLength: 2,
    select: function(event, ui) {
        log(ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value);
    }

});
});