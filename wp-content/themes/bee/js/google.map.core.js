jQuery(document).ready(function() {
	
	if(jQuery('.module-map-canvas').length > 0){
		jQuery('.module-map-canvas').each(function(index, element) {
            var _this = jQuery(this);
			
			var l = Number(_this.data('l'));
			var r = Number(_this.data('r'));
			var zoom = Number(_this.data('zoom'));
			var pin = _this.data('pin');
			var view = _this.data('view');
			
			map_initialize(element, l, r, zoom, pin, view);
        });
	}
	
	function map_initialize(element, l, r, zoom, pin, view) {
		var geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(l, r);
		var markers = [];
		var map_type;
		switch(view){
			case 'map': map_type = google.maps.MapTypeId.ROADMAP; break;
			case 'satellite': map_type = google.maps.MapTypeId.SATELLITE; break;
			case 'map_terrain': map_type = google.maps.MapTypeId.TERRAIN; break;
		}
		
		var mapOptions = {
			zoom: zoom,
			center: latlng,
			mapTypeId: map_type
		}
		var google_map = new google.maps.Map(element, mapOptions);
		
		if(pin == 't'){
			var marker = new google.maps.Marker({
				position: latlng,
				map: google_map
			});
			marker.setAnimation(google.maps.Animation.BOUNCE);
		}
		
	}
	
	
});