<?php
function ux_import_modules(){
	global $wpdb;
	if(!empty( $_POST['xml'] )){
		$file = $_POST['xml'];
	}else{
		$this_id = (int) $_POST['import_id'];
		$file = get_attached_file( $this_id );
	}
	
	$data_xml = simplexml_load_file($file);
	
	$get_cache = $wpdb->get_results("
		SELECT `option_id`, `option_name`
		FROM $wpdb->options 
		WHERE `option_name` LIKE '%import_cache_attachment%'
		"
	);
	
	foreach($get_cache as $cache){
		delete_option($cache->option_name);
	}
	
	$item = $data_xml->channel->item;
	foreach($item as $post){
		$post_id = $post->children('wp',true)->post_id;
		$post_type = $post->children('wp',true)->post_type;
		if($post_type == 'attachment'){
			$post_title = $post->title;
			$post_date = $post->children('wp',true)->post_date;
			$attachment_url = $post->children('wp',true)->attachment_url;
			
			update_option(
				'import_cache_attachment_'.$post_id,
				array(
					'post_title' => (string) $post_title,
					'post_date' => (string) $post_date,
					'attachment_url' => (string) $attachment_url
				)
			);
		}
	}
	
	
}
add_action( 'import_start' , 'ux_import_modules' );

function ux_import_front_cache(){
	global $wpdb;
	if(!empty( $_POST['xml'] )){
		$file = $_POST['xml'];
	}else{
		$this_id = (int) $_POST['import_id'];
		$file = get_attached_file( $this_id );
	}
	
	$data_xml = simplexml_load_file($file);
	
	$get_cache = $wpdb->get_results("
		SELECT `option_id`, `option_name`
		FROM $wpdb->options 
		WHERE `option_name` LIKE '%import_cache_front%'
		"
	);
	
	foreach($get_cache as $cache){
		delete_option($cache->option_name);
	}
	
	$post_title = false;
	$post_date = false;
	$item = $data_xml->channel->item;
	$show_on_front = $data_xml->channel->theme_front_page->show_on_front;
	$page_on_front = $data_xml->channel->theme_front_page->page_on_front;
	foreach($item as $post){
		$post_id = $post->children('wp',true)->post_id;
		if((int) $post_id == (int) $page_on_front){
			$post_title = $post->title;
			$post_date = $post->children('wp',true)->post_date;
		}
	}
	
	$wpdb->insert( 
		$wpdb->options, 
		array( 
			'option_name'  => 'import_cache_front_post_title', 
			'option_value' => $post_title
		)
	);
	$wpdb->insert( 
		$wpdb->options, 
		array( 
			'option_name'  => 'import_cache_front_post_date', 
			'option_value' => $post_date
		)
	);
	$wpdb->insert( 
		$wpdb->options, 
		array( 
			'option_name'  => 'import_cache_front_show_on', 
			'option_value' => $show_on_front
		)
	);
	
	
}
add_action( 'import_start' , 'ux_import_front_cache' );

function ux_import_layerslider(){
	if(!empty( $_POST['xml'] )){
		$file = $_POST['xml'];
	}else{
		$this_id = (int) $_POST['import_id'];
		$file = get_attached_file( $this_id );
	}
	
	$data_xml = simplexml_load_file($file);
	global $wpdb;
	
	$get_cache = $wpdb->get_results("
		SELECT `option_id`, `option_name`
		FROM $wpdb->options 
		WHERE `option_name` LIKE '%import_cache_layerslider%'
		"
	);
	
	foreach($get_cache as $cache){
		delete_option($cache->option_name);
	}
	
	$table_layerslider = $wpdb->prefix . "layerslider";
	$sql = "CREATE TABLE $table_layerslider (
			  id int(10) NOT NULL AUTO_INCREMENT,
			  name varchar(100) NOT NULL,
			  data mediumtext NOT NULL,
			  date_c int(10) NOT NULL,
			  date_m int(11) NOT NULL,
			  flag_hidden tinyint(1) NOT NULL DEFAULT 0,
			  flag_deleted tinyint(1) NOT NULL DEFAULT 0,
			  PRIMARY KEY  (id)
			);";
			
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	
	$layerslider = $data_xml->channel->layerslider;
	foreach($layerslider as $slider){
		$id           = $slider->id;
		$name         = $slider->name;
		$data         = $slider->data;
		$date_c       = $slider->date_c;
		$date_m       = $slider->date_m;
		$flag_hidden  = $slider->flag_hidden;
		$flag_deleted = $slider->flag_deleted;
		
		$slider_row = $wpdb->get_row("
			SELECT * FROM $table_layerslider 
			WHERE date_c = '$date_c' 
			AND name = '$name'
			"
		);
		
		if(!$slider_row){
			$wpdb->insert( 
				$table_layerslider, 
				array( 
					'name'         => $name, 
					'data'         => $data, 
					'date_c'       => $date_c,
					'date_m'       => $date_m, 
					'flag_hidden'  => $flag_hidden, 
					'flag_deleted' => $flag_deleted 
				)
			);
			
			$new_id = $wpdb->insert_id;
		}else{
			$new_id = $slider_row->id;
		}
		
		$wpdb->insert( 
			$wpdb->options, 
			array( 
				'option_name'  => 'import_cache_layerslider_'.$id, 
				'option_value' => $new_id
			)
		);
	}
}
add_action( 'import_start' , 'ux_import_layerslider' );

function ux_import_theme_option(){
	global $wpdb;
	
	if(!empty( $_POST['xml'] )){
		$file = $_POST['xml'];
	}else{
		$this_id = (int) $_POST['import_id'];
		$file = get_attached_file( $this_id );
	}
	
	$data_xml = simplexml_load_file($file);
	
	$get_results = $wpdb->get_results("
		SELECT `option_id`, `option_name`
		FROM $wpdb->options 
		WHERE `option_name` LIKE '%theme_option_%'
		"
	);
	
	foreach($get_results as $result){
		delete_option($result->option_name);
	}
	
	$theme_option = $data_xml->channel->theme_option;
	foreach($theme_option as $option){
		$option_name  = $option->option_name;
		$option_value = $option->option_value;
		
		$wpdb->insert( 
			$wpdb->options, 
			array( 
				'option_name'  => $option_name, 
				'option_value' => $option_value
			)
		);
	}
}
add_action( 'import_start' , 'ux_import_theme_option' );

function ux_import_theme_menu(){
	global $wpdb;
	
	if(!empty( $_POST['xml'] )){
		$file = $_POST['xml'];
	}else{
		$this_id = (int) $_POST['import_id'];
		$file = get_attached_file( $this_id );
	}
	
	$data_xml = simplexml_load_file($file);
	
	$get_cache = $wpdb->get_results("
		SELECT `option_id`, `option_name`
		FROM $wpdb->options 
		WHERE `option_name` LIKE '%import_cache_nav_menu_locations%'
		"
	);
	
	foreach($get_cache as $cache){
		delete_option($cache->option_name);
	}
	
	$nav_menu = $data_xml->channel->nav_menu_locations;
	foreach($nav_menu as $menu){
		$menu_name = $menu->menu_name;
		$menu_slug = $menu->menu_slug;
		
		$wpdb->insert( 
			$wpdb->options, 
			array( 
				'option_name'  => 'import_cache_nav_menu_locations_'.$menu_name, 
				'option_value' => $menu_slug
			)
		);
	}
	
}
add_action( 'import_start' , 'ux_import_theme_menu' );

function ux_import_theme_widgets(){
	global $wpdb;
	
	if(!empty( $_POST['xml'] )){
		$file = $_POST['xml'];
	}else{
		$this_id = (int) $_POST['import_id'];
		$file = get_attached_file( $this_id );
	}
	
	$data_xml = simplexml_load_file($file);
	
	$widgets = array(
		'sidebars_widgets'       => $data_xml->channel->sidebars_widgets,
		'widget_categories'      => $data_xml->channel->theme_widgets->widget_categories,
		'widget_text'            => $data_xml->channel->theme_widgets->widget_text,
		'widget_rss'             => $data_xml->channel->theme_widgets->widget_rss,
		'widget_search'          => $data_xml->channel->theme_widgets->widget_search,
		'widget_recent-posts'    => $data_xml->channel->theme_widgets->widget_recent_posts,
		'widget_recent-comments' => $data_xml->channel->theme_widgets->widget_recent_comments,
		'widget_archives'        => $data_xml->channel->theme_widgets->widget_archives,
		'widget_meta'            => $data_xml->channel->theme_widgets->widget_meta,
		'widget_calendar'        => $data_xml->channel->theme_widgets->widget_calendar,
		'widget_uxconatactform'  => $data_xml->channel->theme_widgets->widget_uxconatactform,
		'widget_nav_menu'        => $data_xml->channel->theme_widgets->widget_nav_menu,
		'widget_pages'           => $data_xml->channel->theme_widgets->widget_pages,
		'widget_uxsocialinons'   => $data_xml->channel->theme_widgets->widget_uxsocialinons,
		'widget_tag_cloud'       => $data_xml->channel->theme_widgets->widget_tag_cloud
	);
	
	
	foreach($widgets as $name => $value){
		delete_option($name);
		if($value != ''){
			$wpdb->insert( 
				$wpdb->options, 
				array( 
					'option_name'  => $name, 
					'option_value' => $value
				)
			);
		}
	}
	
}
add_action( 'import_start' , 'ux_import_theme_widgets' );

function ux_import_post_layerslider(){
	global $wpdb;
	$get_module_layerslider = $wpdb->get_results("
		SELECT `post_id`, `meta_key`
		FROM $wpdb->postmeta 
		WHERE `meta_value` LIKE '%module_select_layer_slider%'
		"
	);
	foreach($get_module_layerslider as $module_layerslider){
		$get_post_meta = get_post_meta($module_layerslider->post_id, $module_layerslider->meta_key, true);
		foreach($get_post_meta as $name => $value){
			if($name == 'module_select_layer_slider'){
				$new_id = get_option('import_cache_layerslider_' . $value);
				$get_post_meta['module_select_layer_slider'] = $new_id;
			}
		}
		update_post_meta($module_layerslider->post_id, $module_layerslider->meta_key, $get_post_meta);
	}
}
add_action( 'import_end' , 'ux_import_post_layerslider' );

function ux_import_theme_menu_locations(){
	global $wpdb;
	$get_cache = $wpdb->get_results("
		SELECT `option_id`, `option_name`, `option_value`
		FROM $wpdb->options 
		WHERE `option_name` LIKE '%import_cache_nav_menu_locations%'
		"
	);
	$nav_menu_locations = get_theme_mod('nav_menu_locations');
	foreach($get_cache as $nav_menu){
		$get_option = get_option($nav_menu->option_name);
		
		$get_term_by = get_term_by('slug', $get_option, 'nav_menu');
		
		$menu_name = str_replace('import_cache_nav_menu_locations_', '', $nav_menu->option_name);
		$menu_id = $get_term_by->term_id;
		
		$nav_menu_locations[$menu_name] = $menu_id;
	}
	set_theme_mod('nav_menu_locations', $nav_menu_locations);
	//update_option('theme_mods_'.get_stylesheet(), $theme_mods_pagebuilder);
}
add_action( 'import_end' , 'ux_import_theme_menu_locations' );

function ux_import_set_front_cache(){
	$get_posts = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'any'
	));
	
	$cache_post_title = get_option('import_cache_front_post_title');
	$cache_post_date = get_option('import_cache_front_post_date');
	$cache_show_on = get_option('import_cache_front_show_on');
	
	if($cache_show_on == ''){
		update_option('show_on_front', 'page'); 
	}else{
		update_option('show_on_front', $cache_show_on); 
	}
	if($cache_post_date != ''){
		foreach($get_posts as $post){
			if($post->post_date == $cache_post_date && $post->post_title == $cache_post_title){
				update_option('page_on_front', $post->ID); 
			}
		}
	}else{
		update_option('page_on_front', 0); 
	}
}
add_action( 'import_end' , 'ux_import_set_front_cache' );

function ux_import_set_modules(){
	global $wpdb;
	$get_posts = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'attachment'
	));
	
	//module single image
	$get_single_image = $wpdb->get_results("
		SELECT `post_id`, `meta_key`
		FROM $wpdb->postmeta 
		WHERE `meta_value` LIKE '%module_image_single%'
		"
	);
	foreach($get_single_image as $single_image){
		$module_image_single = get_post_meta($single_image->post_id, $single_image->meta_key, true);
		foreach($module_image_single as $name => $value){
			if($name == 'module_image_single'){
				if($value){
					$meta_url = explode('__', $value);
					$attachment_url = '';
					if(isset($meta_url[1])){
						$attachment_url = $meta_url[1];
					}
					$get_attachment = $wpdb->get_row("
						SELECT `option_name` FROM $wpdb->options 
						WHERE `option_value` LIKE '%$attachment_url%'
					");
					if($get_attachment){
						$import_cache_attachment = get_option($get_attachment->option_name);
						$import_post_title = $import_cache_attachment['post_title'];
						$import_post_date = $import_cache_attachment['post_date'];
						foreach($get_posts as $post){
							if($post->post_date == $import_post_date && $post->post_title == $import_post_title){
								$attachment_image_src = wp_get_attachment_image_src($post->ID , 'full');
								$module_image_single['module_image_single'] = 'wp-image-'.$post->ID.'__'.$attachment_image_src[0];
							}
						}
					}
					
				}
			}
		}
		update_post_meta($single_image->post_id, $single_image->meta_key, $module_image_single);
		
	}
	
	//module image box
	$get_image_media = $wpdb->get_results("
		SELECT `post_id`, `meta_key`
		FROM $wpdb->postmeta 
		WHERE `meta_value` LIKE '%module_image_media%'
		"
	);
	
	foreach($get_image_media as $image_media){
		$module_image_media = get_post_meta($image_media->post_id, $image_media->meta_key, true);
		foreach($module_image_media as $name => $value){
			if($value){
				if($name == 'module_image_media'){
					$attachment_url = $value;
					$get_attachment = $wpdb->get_row("
						SELECT `option_name` FROM $wpdb->options 
						WHERE `option_value` LIKE '%$attachment_url%'
					");
					if($get_attachment){
						$import_cache_attachment = get_option($get_attachment->option_name);
						$import_post_title = $import_cache_attachment['post_title'];
						$import_post_date = $import_cache_attachment['post_date'];
						foreach($get_posts as $post){
							if($post->post_date == $import_post_date && $post->post_title == $import_post_title){
								$attachment_image_src = wp_get_attachment_image_src($post->ID , 'full');
								$module_image_media['module_image_media'] = $attachment_image_src[0];
							}
						}
					}
				}
			}
		}
		update_post_meta($image_media->post_id, $image_media->meta_key, $module_image_media);
		
	}
	
	//post format gallery
	$get_gallery_selected = $wpdb->get_results("
		SELECT `post_id`, `meta_key`
		FROM $wpdb->postmeta 
		WHERE `meta_key` LIKE 'post_option_gallery_selected'
		"
	);
	
	foreach($get_gallery_selected as $gallery_selected){
		$post_option_gallery_selected = get_post_meta($gallery_selected->post_id, $gallery_selected->meta_key, true);
		foreach($post_option_gallery_selected as $name => $value){
			$import_cache_attachment = get_option('import_cache_attachment_'.$value);
			$import_post_title = $import_cache_attachment['post_title'];
			$import_post_date = $import_cache_attachment['post_date'];
			foreach($get_posts as $post){
				if($post->post_date == $import_post_date && $post->post_title == $import_post_title){
					$attachment_image_src = wp_get_attachment_image_src($post->ID, 'full');
					$post_option_gallery_selected[$name] = $post->ID;
				}
			}
		}
		update_post_meta($gallery_selected->post_id, $gallery_selected->meta_key, $post_option_gallery_selected);
		
	}
	
	//module gallery
	$get_module_gallery_selected = $wpdb->get_results("
		SELECT `post_id`, `meta_key`
		FROM $wpdb->postmeta 
		WHERE `meta_value` LIKE '%module_select_gallery_selected%'
		"
	);

	foreach($get_module_gallery_selected as $module_gallery_selected){
		$module_select_gallery_selected = get_post_meta($module_gallery_selected->post_id, $module_gallery_selected->meta_key, true);
		foreach($module_select_gallery_selected as $name => $value){
			if($value){
				if($name == 'module_select_gallery_selected'){
					$value = explode("'%_%'", $value);
					$module_select_gallery_selected['module_select_gallery_selected'] = '';
					foreach($value as $val){
						if($val){
							$import_cache_attachment = get_option('import_cache_attachment_'.$val);
							$import_post_title = $import_cache_attachment['post_title'];
							$import_post_date = $import_cache_attachment['post_date'];
							foreach($get_posts as $post){
								if($post->post_date == $import_post_date && $post->post_title == $import_post_title){
									$attachment_image_src = wp_get_attachment_image_src($post->ID, 'full');
									$module_select_gallery_selected['module_select_gallery_selected'] .= $post->ID."'%_%'";
								}
							}
						}
					}
				}
			}
			
		}
		update_post_meta($module_gallery_selected->post_id, $module_gallery_selected->meta_key, $module_select_gallery_selected);
	}
	
}
add_action( 'import_end' , 'ux_import_set_modules' );

function ux_import_set_post_meta(){
	global $wpdb;
	$get_posts = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'any',
		'post_status' => 'any'
	));
	
	foreach($get_posts as $post){
		$get_custom_meta = $wpdb->get_results("
			SELECT `meta_id`, `meta_key`, `meta_value`
			FROM $wpdb->postmeta 
			WHERE `post_id` = '$post->ID'
			"
		);
		
		foreach($get_custom_meta as $meta){
			$meta_value = get_post_meta($post->ID, $meta->meta_key, false);
			
			if(count($meta_value) > 1){
				$this_meta_value = get_post_meta($post->ID, $meta->meta_key, true);
				delete_post_meta($post->ID, $meta->meta_key, $this_meta_value);
				add_post_meta($post->ID, $meta->meta_key, $this_meta_value);
			}
		}
		
	}
}
add_action( 'import_end' , 'ux_import_set_post_meta' );

function ux_import_delete_repeat_nav(){
	
}
add_action( 'import_end' , 'ux_import_delete_repeat_nav' );
?>