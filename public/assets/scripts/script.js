$(document).ready(function() {

	$('a').smoothScroll({ speed: 500 });
	//$(".navigation-container").headroom();
	if( !isMobile() ) {
		//window.scrollReveal = new scrollReveal();
	}


	$('.confirm').click(function ( e ) {

		e.preventDefault();
		var $card = $(e.target).parents('.invitation-card');
		var invite_id = $card.data('invitation-id');

		$.post('/invitacion/' + invite_id + '/confirmar', null, function( response ) {
			$card.find('.status').addClass('replied').find('.status-msg').text('Asistirá');
		});

	});

	$('.decline').click(function ( e ) {

		e.preventDefault();
		var $card = $(e.target).parents('.invitation-card');
		var invite_id = $card.data('invitation-id');

		$.post('/invitacion/' + invite_id + '/declinar', null, function( response ) {
			$card.find('.status').addClass('replied').find('.status-msg').text('No Asistirá');
		});

	});

	$('.change-rsvp').click( function ( e ) {
		e.preventDefault();

		var $card = $(e.target).parents('.invitation-card');
		$card.find('.status').removeClass('replied');

	});

});
	 google.maps.event.addDomListener(window, 'load', init);
	var map;
	function init() {
		var mapOptions = {
			center: new google.maps.LatLng(-34.834941,-58.47642),
			zoom: 13,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.DEFAULT,
			},
			disableDoubleClickZoom: true,
			mapTypeControl: false,
			scaleControl: true,
			scrollwheel: true,
			panControl: true,
			streetViewControl: false,
			draggable : true,
			overviewMapControl: false,
			overviewMapControlOptions: {
				opened: false,
			},
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: [
	{
		featureType: 'water',
		stylers: [{color:'#46bcec'},{visibility:'on'}]
	},{
		featureType: 'landscape',
		stylers: [{color:'#f2f2f2'}]
	},{
		featureType: 'road',
		stylers: [{saturation: -100},{lightness: 45}]
	},{
		featureType: 'road.highway',
		stylers: [{visibility: 'simplified'}]
	},{
		featureType: 'road.arterial',
		elementType: 'labels.icon',
		stylers: [{visibility: 'off'}]
	},{
		featureType: 'administrative',
		elementType: 'labels.text.fill',
		stylers: [{color: '#444444'}]
	},{
		featureType: 'transit',
		stylers: [{visibility: 'off'}]
	},{
		featureType: 'poi',
		stylers: [{visibility: 'off'}]
	}
],
		}
		var mapElement = document.getElementById('place-map');
		var map = new google.maps.Map(mapElement, mapOptions);
		var locations = [
['Los Laureles', 'Manuel Julian Medel 1386 <br> Monte Grande <br> Buenos Aires', 'undefined', 'undefined', 'undefined', -34.8377349, -58.47819419999999]
		];
		for (i = 0; i < locations.length; i++) {
			if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
			if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
			if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
			if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
			marker = new google.maps.Marker({
				icon: 'https://mapbuildr.com/assets/img/markers/solid-pin-red.png',
				position: new google.maps.LatLng(locations[i][5], locations[i][6]),
				map: map,
				title: locations[i][0],
				desc: description,
				tel: telephone,
				email: email,
				web: web
			});
			var html= "<div style='color:#000;background-color:#fff;padding:5px;width:150px;'><h4>"+locations[i][0]+"</h4><p>"+description+"<p></div>";
			iw = new google.maps.InfoWindow({content:html});
			iw.open(map,marker);

			//bindInfoWindow(marker, map, locations[i][0], description, telephone, email, web);
		}
 function bindInfoWindow(marker, map, title, desc, telephone, email, web) {
	  google.maps.event.addListener(marker, 'click', function() {
			var html= "<div style='color:#000;background-color:#fff;padding:5px;width:150px;'><h4>"+title+"</h4><p>"+desc+"<p></div>";
			iw = new google.maps.InfoWindow({content:html});
			iw.open(map,marker);
		});
	}
}

function isMobile() {
 if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
    return true;
  }
 else {
    return false;
  }
}
