<?php
function ux_get_field_option($type, $name, $post_id, $module_post){
	$module_meta = ux_get_module_meta($module_post, $name, $post_id);
	switch($type){
		case 'color': ?>
            <div class="row-fluid">
                <div class="module_item_remove_color module_item_remove_btn pull-left"></div>
                <input type="text" class="span2 module_item_color_switch" name="<?php echo $name; ?>" value="<?php echo $module_meta; ?>" />
            </div>
            <script type="text/javascript">
				jQuery(document).ready(function() {
					if(jQuery('.module_item_color_switch').length > 0){
						jQuery('.module_item_color_switch').each(function(index, element) {
							var _this = jQuery(this),
								_this_parents = _this.parents('.module_background_color');
								_color = _this.val();
							
							if(_color == ''){
								_color = '#ffffff';
							}else{
								_this.parents('.module_background_color').find('.icon-ok').remove();
							}
							
							jQuery(this).spectrum({
								showInitial: true,
								preferredFormat: "hex",
								color: _color,
								change: function(color) {
									if(_this.val() != ''){
										_this.parents('.module_background_color').find('.icon-ok').remove();
									}
								}
							});
							jQuery(this).show();
			
						});
						
						if(jQuery('.module_item_remove_color').length > 0){
							jQuery('.module_item_remove_color').each(function(index, element) {
								var _this = jQuery(this),
									_this_parents = _this.parents('.module_background_color');
									
								_this.click(function(){
									_this_parents.find('.module_item_color_switch').val('');
									_this_parents.find('.sp-replacer .sp-preview-inner').css({'background-color':'#ffffff'});
								});
							});
						}
					}
				});
			</script>
        <?php
		break;
		
		case 'tabs':
			$tabs_name = ux_get_module_meta($module_post, $name.'_name', $post_id);
			$tabs_title = ux_get_module_meta($module_post, $name.'_title', $post_id);
			
			if($tabs_name){
				foreach($tabs_name as $i => $t_name){
					$t_title = $tabs_title[$i];
					if($i == 0){
						$item_style = 'module_item_add_btn module_item_add';
					}else{
						$item_style = 'module_item_remove_btn module_item_remove';
					} ?>
					<div class="row-fluid module-social-item module-tabs-item" data-sort="<?php echo $i + 1; ?>">
                        <input class="span2" name="<?php echo $name.'_name'; ?>" type="text" value="<?php echo $t_name['value']; ?>" readonly />
                        <input class="module_text_input span6" name="<?php echo $name.'_title'; ?>" type="text" value="<?php echo $t_title['value']; ?>" />
                        <div class="span2"><div class="<?php echo $item_style; ?> item_click"></div></div>
                    </div>
				 
				
				<?php
				}
			}else{ ?>
                <div class="row-fluid module-social-item" data-sort="1">
					<input class="span2" name="<?php echo $name.'_name'; ?>" type="text" value="<?php _e('Tabs 1', 'ux'); ?>" readonly />
					<input class="module_text_input span6" name="<?php echo $name.'_title'; ?>" type="text" value="" />
					<div class="span2"><div class="module_item_add_btn module_item_add item_click"></div></div>
				</div>
            <?php
			}
		break;
		
		case 'google_map':
			$module_map_location_l = -33.8674869;
			$module_map_location_r = 151.20699020000006;
			if($module_meta){
				if($module_meta != ''){
					$module_map_location = str_replace('(', '', $module_meta);
					$module_map_location = str_replace(')', '', $module_map_location);
					$module_map_location = explode(', ', $module_map_location);
					
					$module_map_location_l = (isset($module_map_location[0])) ? $module_map_location[0] : -33.8674869;
					$module_map_location_r = (isset($module_map_location[1])) ? $module_map_location[1] : 151.20699020000006;
				}
			} ?>
            <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $module_meta; ?>" />
            <div id="module-map-canvas"></div>
            <script type="text/javascript">
				jQuery(document).ready(function() {
					var geocoder;
					var google_map;
					var markers = [];
					var module_map_location_l = Number(<?php echo $module_map_location_l; ?>);
					var module_map_location_r = Number(<?php echo $module_map_location_r; ?>);
					function map_initialize() {
						geocoder = new google.maps.Geocoder();
						var latlng = new google.maps.LatLng(module_map_location_l, module_map_location_r);
						var mapOptions = {
							zoom: 7,
							center: latlng,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						}
						google_map = new google.maps.Map(document.getElementById('module-map-canvas'), mapOptions);
						var marker = new google.maps.Marker({
							position: latlng,
							map: google_map
						});
						marker.setAnimation(google.maps.Animation.BOUNCE);
						markers.push(marker);
						google.maps.event.addListener(google_map, 'click', function(event) {
							map_addMarker(event.latLng);
						});
						
					}
					
					function map_addMarker(location) {
						map_deleteMarkers();
						var marker = new google.maps.Marker({
							position: location,
							map: google_map
						});
						marker.setAnimation(google.maps.Animation.BOUNCE);
						markers.push(marker);
						jQuery('[name=module_input_google_map_canvas]').val(location);
					}
					
					function map_clearMarkers() {
						map_setAllMap(null);
					}
					
					function map_showMarkers() {
						map_setAllMap(google_map);
					}
					
					function map_deleteMarkers() {
						map_clearMarkers();
						markers = [];
					}
					
					function map_setAllMap(map) {
						for (var i = 0; i < markers.length; i++) {
							markers[i].setMap(map);
						}
					}
				
					function map_codeAddress(address){
						geocoder.geocode( { 'address': address}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								google_map.setCenter(results[0].geometry.location);
								map_deleteMarkers();
								var marker = new google.maps.Marker({
									map: google_map,
									position: results[0].geometry.location
								});
								marker.setAnimation(google.maps.Animation.BOUNCE);
								markers.push(marker);
								jQuery('[name=module_input_google_map_canvas]').val(results[0].geometry.location);
							} else {
								alert('Geocode was not successful for the following reason: ' + status);
							}
						});
					}
					map_initialize();
					
					jQuery('[name=module_input_map_address2]').change(function(){
						map_codeAddress(jQuery(this).val());
					});
				});
			
            </script>
		<?php
		break;
	}
}


?>