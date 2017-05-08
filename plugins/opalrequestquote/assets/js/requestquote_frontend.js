(function($) {
	"use strict";
	$(document).ready(function() {

	    var form = $(".requestquote_post_form");
	    
	    /**
	    * Validate Form in Page  
	    */
	    form.validate({
			errorPlacement: function errorPlacement(error, element) { element.before(error); },
			errorContainer: ".mesagetooltips",
			  errorLabelContainer: ".mesagetooltips",
			rules: {
				opal_requestquote_movingon: {
				  required: true,
				  date: true
				},
				opal_requestquote_email: {
				  required: true,
				  email: true,
				},
				opal_requestquote_phonenumber: {
				  required: true,
				  number: true
				},
				opal_requestquote_type: {
				  required: true,
				}
			}, // end Rule
			messages: {
			   opal_requestquote_firstname: "Please specify your name",
			   opal_requestquote_email: {
			      required: "We need your email address to contact you",
			      email: "Your email address must be in the format of name@domain.com"
			   },
			   opal_requestquote_phonenumber: {
			      required: "We need your phone number to contact you",
			      number: "Required is number"
			   },

			}
	       
	    });
	    /**
	    *	Start Step Form
	    */

	    form.children("div").steps({
	        headerTag: "h3",
	        bodyTag: "section",
	        titleTemplate: '<span class="number">#index#</span> <span class="title">#title# </span>',
	        transitionEffect: "slideLeft",
	        enableFinishButton: false,
	        onInit: function (event, currentIndex) {
	        	if(currentIndex == 0){
	        		$('.actions > ul > li:first').hide();
	        	}
	        },
	        onStepChanging: function (event, currentIndex, newIndex)
	        {	
	        	//console.log(event+currentIndex+newIndex);
	        	$('.actions > ul > li:first').show();
	        	if(newIndex == 2){
	        		$('.actions > ul > li:first').hide();
		        	$('.modal').addClass('loading');
				  	var data = $(form).serialize();
			        	$.ajax({
			            url: ajaxurl,
			            type:'POST',
			            dataType: 'json',
			            data:  'action=requestquote_post_form&' + data,
			            error: function(jqXHR, textStatus, errorThrown){   
			            	$('.modal').removeClass("loading");                                     
						      console.error("The following error occured: " + textStatus, errorThrown);                                                       
						    },
			        }).done(function(reponse) {
			        	$('.modal').removeClass("loading");
			        	if (reponse.status == "success") {
			        		$('.requestquote-icon-check').html( '<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>' );
			            	$('.requestquote-message').html( reponse.msg );
			            	$(".requestquote_post_form input").val("");
			            }else{
			            	$('.requestquote-icon-check').html( '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>' );
			            	$('.requestquote-message').html( reponse.msg );
			            	$(".requestquote_post_form input").val("");
			            }  
			        });
			    }
	            if(newIndex != 0){
	           	 	return form.valid();
	        	}
	        	return true;
	        },
	        onStepChanged: function (event, currentIndex, priorIndex) { 
	        	$(".steps.clearfix > ul > li").each(function(){
	    			var selectedStep = $(this).attr('aria-selected');
	    			if (selectedStep =='false' || currentIndex == 2) {
	    				$(this).find('.number').html('<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>');
	    			}

	    		});
	        	
	        },
	        onFinished: function (event, currentIndex) {

	        	$(".requestquote_post_form input").val("");
	        	return form.valid();
	        },
	        labels: opal_lables,

	    });

	    //---------------------------------
	    // load address filter by googlemap
	    $('#opal_requestquote_movingfrom').geocomplete().bind("geocode:result", function(event, result){
	        calculateRoute();
	    });

	    $('#opal_requestquote_movingto').geocomplete().bind("geocode:result", function(event, result){
	        calculateRoute();
	    });
		
		
		//---------------------------------
		//----- Calculator Direction ------
		window.onload =  function() {
            navigator.geolocation.getCurrentPosition(locSuccess, locError);
            calculateRoute();
            var selectedType = $('.opal_requestquote_type');
            if(selectedType.val() != null){
            	$.ajax({
	            url: ajaxurl,
	            type:'POST',
	            dataType: 'html',
	            data:  'action=bedroom_filter&id=' + selectedType.val(),
	            error: function(jqXHR, textStatus, errorThrown){                                       
				      console.error("The following error occured: " + textStatus, errorThrown);                                                       
				},
		        }).done(function(reponse) {
		            $('#bedroom-filter').html( reponse );
		        });
            }		
        };


        var directionsDisplay = new google.maps.DirectionsRenderer(),
        	currentPosition,
            directionsService = new google.maps.DirectionsService(),
            map;

        function initialize_place_map(lat,lon) 
        {
            directionsDisplay = new google.maps.DirectionsRenderer();
            currentPosition = new google.maps.LatLng(lat, lon);

            var myOptions = {
                zoom:5,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: currentPosition
            }

            map = new google.maps.Map(document.getElementById("directions_map"), myOptions);
            directionsDisplay.setMap(map);
            var currentPositionMarker = new google.maps.Marker({
                position: currentPosition,
                map: map,
                title: "Current position"
            });

            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(currentPositionMarker, 'click', function() {
                infowindow.setContent("Current position: latitude: " + lat +" longitude: " + lon);
                infowindow.open(map, currentPositionMarker);
            });
        }

        function locError(error) {
            // initialize map with a static predefined latitude, longitude
           initialize_place_map(59.3426606750, 18.0736160278);
        }

        function locSuccess(position) {
            initialize_place_map(position.coords.latitude, position.coords.longitude);
        }

        function calculateRoute() 
        {	
            var selectedMode = 'DRIVING',
                start = $("#opal_requestquote_movingfrom").val(),
                end = $("#opal_requestquote_movingto").val();

            if(start == '')
            {
             	$("#opal_requestquote_movingfrom").focus();  
                return;
            }else if(end == ''){
            	$("#opal_requestquote_movingto").focus();
            	return;
            }
            else
            {
                var request = {
                    origin:start, 
                    destination:end,
                    travelMode: google.maps.DirectionsTravelMode[selectedMode]
                };

                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                    	$('.directions-message').html('');
                        directionsDisplay.setDirections(response); 
                    }else{
                    	$('.directions-message').html('Sorry, we could not calculate directions from "'+response.request.origin+'" to "'+response.request.destination+'" ')
                    }
                });

            }
        }
	});
}(jQuery));