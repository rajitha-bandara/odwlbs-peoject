//read cookie
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

//add_listing.php ddisplay categories and subcategories
$(document).ready(function() {

	$('#loader').hide();
	$('#show_heading').hide();
	
	$('#search_category_id').change(function(){
		$('#show_sub_categories').fadeOut();
		$('#loader').show();
		$.post("includes/get_chid_categories.php", {
			parent_id: $('#search_category_id').val(),
		}, function(response){
			
			setTimeout("finishAjax('show_sub_categories', '"+escape(response)+"')", 400);
		});
		return false;
	});
});

function finishAjax(id, response){
  $('#loader').hide();
  $('#show_heading').show();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} 

function alert_id()
{
	if($('#sub_category_id').val() == '')
	alert('Please select a sub category.');
	else
	alert($('#sub_category_id').val());
	return false;
}

//add_listing.php - display Google Map
function openMap()
{
	var left = (screen.width/2)-(900/2);
	var top = (screen.height/2)-(500/2);
	window.open("map.html","", "menubar=no,width=900,height=500,toolbar=no,location=no,resizable=no,status=yes,top='+top+', left='+left+'");
}


// Newsletter signup form 

/*$(document).ready(function(){
	$('#newsletter-signup').submit(function(){
		
		//check the form is not currently submitting
		if($(this).data('formstatus') !== 'submitting'){
		
			//setup variables
			var form = $(this),
				formData = form.serialize(),
				formUrl = form.attr('action'),
				formMethod = form.attr('method'), 
				responseMsg = $('#signup-response');
			
			//add status data to form
			form.data('formstatus','submitting');
			
			//show response message - waiting
			responseMsg.hide()
					   .addClass('response-waiting')
					   .text('Please Wait...')
					   .fadeIn(200);
			
			//send data to server for validation
			$.ajax({
				url: formUrl,
				type: formMethod,
				data: formData,
				success:function(data){
					
					//setup variables
					var responseData = jQuery.parseJSON(data), 
						klass = '';
					
					//response conditional
					switch(responseData.status){
						case 'error':
							klass = 'response-error';
						break;
						case 'success':
							klass = 'response-success';
						break;	
					}
					
					//show reponse message
					responseMsg.fadeOut(200,function(){
						$(this).removeClass('response-waiting')
							   .addClass(klass)
							   .text(responseData.message)
							   .fadeIn(200,function(){
								   //set timeout to hide response message
								   setTimeout(function(){
									   responseMsg.fadeOut(200,function(){
									       $(this).removeClass(klass);
										   form.data('formstatus','idle');
									   });
								   },3000)
								});
					});
				}
			});
		}
		
		//prevent form from submitting
		return false;
	});
});
*/

//Newsletter unsubscribe
$(document).ready(function(){
	$('#unsub_form').submit(function(){
		
		//check the form is not currently submitting
		if($(this).data('formstatus') !== 'submitting'){
		
			//setup variables
			var form = $(this),
				formData = form.serialize(),
				formUrl = form.attr('action'),
				formMethod = form.attr('method'), 
				responseMsg = $('#unsub-response');
			
			//add status data to form
			form.data('formstatus','submitting');
			
			//show response message - waiting
			responseMsg.hide()
					   .addClass('response-waiting')
					   .text('Please Wait...')
					   .fadeIn(200);
			
			//send data to server for validation
			$.ajax({
				url: formUrl,
				type: formMethod,
				data: formData,
				success:function(data){
					
					//setup variables
					var responseData = jQuery.parseJSON(data), 
						klass = '';
					
					//response conditional
					switch(responseData.status){
						case 'error':
							klass = 'response-error';
						break;
						case 'success':
							klass = 'response-success';
						break;	
					}
					
					//show reponse message
					responseMsg.fadeOut(200,function(){
						$(this).removeClass('response-waiting')
							   .addClass(klass)
							   .text(responseData.message)
							   .fadeIn(200,function(){
								   //set timeout to hide response message
								   setTimeout(function(){
									   responseMsg.fadeOut(200,function(){
									       $(this).removeClass(klass);
										   form.data('formstatus','idle');
									   });
								   },3000)
								});
					});
				}
			});
		}
		
		//prevent form from submitting
		return false;
	});
});


//show and hide location details div
function showLocForm() {
	var ele = document.getElementById("location_form");
	//var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		//text.innerHTML = "show";
  	}
	else {
		ele.style.display = "block";
		//text.innerHTML = "hide";
	}
} 

//////////////////popup login/////////////////////////////////
// Semicolon (;) to ensure closing of earlier scripting
    // Encapsulation
    // $ is assigned to jQuery
    ;(function($) {

         // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('#login_popup').bind('click', function(e) {

                // Prevents the default action to be triggered. 
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#login_popup_content').bPopup();

            });

        });

    })(jQuery);
	
	
///////////////////////////////// Pop up sign in form ///////////////////////////////

$(document).ready(function(){
	$('#sign_in').submit(function(){
		
		//check the form is not currently submitting
		if($(this).data('formstatus') !== 'submitting'){
		
			//setup variables
			var form = $(this),
				formData = form.serialize(),
				formUrl = form.attr('action'),
				formMethod = form.attr('method'), 
				responseMsg = $('#sign_in_response');
			
			//add status data to form
			form.data('formstatus','submitting');
			
			//show response message - waiting
			responseMsg.hide()
					   .addClass('response-waiting')
					   .text('Please Wait...')
					   .fadeIn(200);
			
			//send data to server for validation
			$.ajax({
				url: formUrl,
				type: formMethod,
				data: formData,
				success:function(data){
					
					//setup variables
					var responseData = jQuery.parseJSON(data), 
						klass = '';
					
					//response conditional
					switch(responseData.status){
						case 'error':
							klass = 'response-error';
						break;
						case 'success':
							klass = 'response-success';
							window.location.href = 'index.php';
						
						break;
						case 'successaddlisting':
							klass = 'response-success';
							window.location.href = 'add_listing.php';
						
						break;
					}
					
					//show reponse message
					responseMsg.fadeOut(200,function(){
						$(this).removeClass('response-waiting')
							   .addClass(klass)
							   .text(responseData.message)
							   .fadeIn(200,function(){
								   //set timeout to hide response message
								   setTimeout(function(){
									   responseMsg.fadeOut(200,function(){
									       $(this).removeClass(klass);
										   form.data('formstatus','idle');
									   });
								   },3000)
								});
					});
				}
			});
		}
		
		//prevent form from submitting
		return false;
	});
});


//////////////////popup email/////////////////////////////////


   



///////////////////////////////////Feedback tab//////////////////////////////////

   /* $(function(){
        $('.slide-out-div').tabSlideOut({
            tabHandle: '.handle',                     //class of the element that will become your tab
            pathToTabImage: 'public/img/contact_tab.gif', //path to the image for the tab //Optionally can be set using css
            imageHeight: '122px',                     //height of tab image           //Optionally can be set using css
            imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
            tabLocation: 'right',                      //side of screen where tab lives, top, right, bottom, or left
            speed: 300,                               //speed of animation
            action: 'click',                          //options: 'click' or 'hover', action to trigger animation
            topPos: '200px',                          //position from the top/ use if tabLocation is left or right
            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
            fixedPosition: true                      //options: true makes it stick(fixed position) on scroll
        });

    });*/

//////////////////////Check checkbox checked///////////////////////

	function checkTerms() 
	{
     if(document.reg_form.cbAccept.checked)
     {
         document.reg_form.btnReg.disabled=false;
     }
     else
     {
         document.reg_form.btnReg.disabled=true;
     }
 }

//////////////////////Bookmark Page///////////////////////
function bookmark(url, sitename)
{
  ns="Netscape and FireFox users, use CTRL+D to bookmark this site."
  if ((navigator.appName=='Microsoft Internet Explorer') &&
    (parseInt(navigator.appVersion)>=4))
  {
    window.external.AddFavorite(window.location.href, sitename);
  }
  else if (navigator.appName=='Netscape')
  {
    alert(ns);
  }
}

///////////////////Track Search Near Places////////////////
function track_find_near_places()
{
	
	var place = document.getElementById('list_places_types').value;
	var dist  = document.getElementById('list_raius').value;
	var place_dist = place +'_'+ dist;
	_gaq.push(['_trackEvent', 'near_place', 'select', place_dist]);
	
}


///////////////////Track Search Near Places More////////////////
function track_find_near_places_more()
{
	var place = document.getElementById('rbPlaceType').value;
	var dist  = document.getElementById('list_raius').value;
	var place_dist = place +'_'+ dist;
	_gaq.push(['_trackEvent', 'near_place', 'select', place_dist]);
	
}

///////////////////Track Search Terms////////////////
function track_search()
{
	var what = document.getElementById('q').value;
	var where  = document.getElementById('city').value;
	var what_where = what +'_'+ where;
	
	///_gaq.push(['_trackEvent', 'search_terms', 'search', what_where]);
	
	 $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=search&what='+ what +'&where='+ where,
            success: function(ret) {
              
            }
        });
	
}

//////////////////////////////////////////////////////
