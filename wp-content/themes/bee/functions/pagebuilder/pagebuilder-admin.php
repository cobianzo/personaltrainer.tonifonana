<?php
/*
============================================================================
	*
	* Custom Module Meta
	*
============================================================================	
*/
function ux_get_module_meta($module_post, $module_name, $post_id = ''){
	$pagebuilder_module_value = get_post_meta($post_id, 'pagebuilder_module_value_'.$module_post, true);
	
	if($pagebuilder_module_value){
		if(isset($pagebuilder_module_value[$module_name])){
			return $pagebuilder_module_value[$module_name];
		}else{
			return false;
		}
	}else{
		return false;
	}
}

/*
============================================================================
	*
	* Admin css and scripts 
	*
============================================================================	
*/
function ux_admin_enqueue_scripts(){
	wp_register_style('bootstrap-style', get_template_directory_uri(). '/functions/pagebuilder/css/bootstrap.min.css', false);
	wp_register_style('bootstrap-switch', get_template_directory_uri(). '/functions/pagebuilder/css/bootstrapSwitch.css', false);
	wp_register_style('icheak_skins', get_template_directory_uri(). '/functions/pagebuilder/css/icheak/skins/all.css', false);
	wp_register_style('custom_wp_admin_css', get_template_directory_uri(). '/functions/pagebuilder/css/style.css', false);
	
    wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('bootstrap-style');
	wp_enqueue_style('bootstrap-switch');
	wp_enqueue_style('icheak_skins');
    wp_enqueue_style('custom_wp_admin_css');
	
	wp_enqueue_script('bootstrap-js',get_template_directory_uri(). '/functions/pagebuilder/js/bootstrap.min.js',array( 'jquery' ),'1.0.0',true);
	wp_enqueue_script('bootstrap-switch',get_template_directory_uri(). '/functions/pagebuilder/js/bootstrapSwitch.js',array( 'jquery' ),'1.0.0',true); 
	wp_enqueue_script('icheak',get_template_directory_uri(). '/functions/pagebuilder/js/jquery.icheck.min.js',array( 'jquery' ),'1.0.0',true); 
	wp_enqueue_script('jquery-nicescroll',get_template_directory_uri(). '/functions/pagebuilder/js/jquery.nicescroll.min.js',array( 'jquery' ),'1.0.0',true); 
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-timepicker',get_template_directory_uri(). '/functions/pagebuilder/js/jquery-ui-timepicker-addon.js',array( 'jquery' ),'1.0.0',true);
	wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
		
	wp_enqueue_script('media-upload');
	wp_enqueue_script('my-upload');
	
	wp_enqueue_script('pagebuilder-layout',get_template_directory_uri(). '/functions/pagebuilder/js/pagebuilder.layout.js',array( 'jquery' ),'1.0.0',true); 
}
add_action('admin_enqueue_scripts','ux_admin_enqueue_scripts');


/*
============================================================================
	*
	* Custom Module
	*
============================================================================	
*/
require_once locate_template('/functions/pagebuilder/pagebuilder-modules.php');

/*
============================================================================
	*
	* Custom Module fields
	*
============================================================================	
*/
require_once locate_template('/functions/pagebuilder/pagebuilder-modules-fields.php');

/*
============================================================================
	*
	* Custom meta box
	*
============================================================================	
*/
require_once locate_template('/functions/pagebuilder/pagebuilder-metabox.php');

/*
============================================================================
	*
	* Custom ajax
	*
============================================================================	
*/
require_once locate_template('/functions/pagebuilder/pagebuilder-ajax.php');

/*
============================================================================
	*
	* Get Custom meta
	*
============================================================================	
*/
function ux_custom_meta($id){
	global $post;
	$meta = get_post_meta($post->ID, $id, true);
	return $meta;
}

?>