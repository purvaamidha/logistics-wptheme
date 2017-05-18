(function($) {
	"use strict";
	$(document).ready(function() {
		//=====================================================================
		// -- All Selector Process 
		//=====================================================================
		$('#opal_requestquote_type').on('change', function (e) {
		    var optionSelected = $("option:selected", this);
		    var valueSelected = this.value;
		    var loading = '<div class="bedroom-loading"><img src="'+pluginurl+'assets/img/bx_loader.gif"  border=0><br>Data is loading...</div>';
	    	$('#bedroom-filter').html(loading);
		    $.ajax({
	            url: ajaxurl,
	            type:'POST',
	            dataType: 'html',
	            data:  'action=bedroom_filter&id=' + valueSelected + '&admin=1',
	            error: function(jqXHR, textStatus, errorThrown){                                       
				      console.error("The following error occured: " + textStatus, errorThrown);                                                       
				},
	        }).done(function(reponse) {
	            $('#bedroom-filter').html( reponse );
	        });
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
            var selectedType = $('#opal_requestquote_type');
            //console.log(selectedType.val());
            if(selectedType.val() != null){
            	$.ajax({
	            url: ajaxurl,
	            type:'POST',
	            dataType: 'html',
	            data:  'action=bedroom_filter&id=' + selectedType.val() + '&admin=1',
	            error: function(jqXHR, textStatus, errorThrown){                                       
				      console.error("The following error occured: " + textStatus, errorThrown);                                                       
				},
	        }).done(function(reponse) {
	            $('#bedroom-filter').html( reponse );
	        });
            }
            
        };


        var directionsDisplay,
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
        }// end Fnc calculateRoute
	});
}(jQuery));