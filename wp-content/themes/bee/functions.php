<?php
/*
============================================================================
	*
	* Functions 
	*
============================================================================	
*/
require_once locate_template('/functions/functions.php');










// ALV: mis funciones


//Page Slug Body Class
add_filter( 'body_class', 'add_slug_body_class' );
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}



/*  BACKEND */



if (is_admin()) :
// el metabox de yoast molesta bastante. Lo quito. Como está basado en una clase, no he conseguido eliminarlo
	if ( ! class_exists( 'WPSEO_Metabox' ) ) {
		$instance = new WPSEO_Metabox();
		//$instance = Thanks_For_Reading_Plugin::this();
		remove_action( 'add_meta_boxes', array( $instance, 'add_meta_box' ) );
	}
endif;




add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue($hook) {
	if (( 'profile.php' != $hook ) && ( 'user-edit.php' != $hook )) {
        return;
    }
	if (!current_user_can( 'subscriber' )) return;
    wp_enqueue_script( 'alv', get_stylesheet_directory_uri() . '/alv-backend.js' );
}







/* solo para subscriptor */

if (current_user_can("subscriber")) {
	add_filter('admin_head','remove_admin_bar_style_backend'); // Original version
	add_action("init",'disableAdminBar'); // New version
	
	// eliminar mensajes de avisos de updat wp y plugins
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
	remove_action( 'load-update-core.php', 'wp_update_plugins' );
	add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
	add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

}



if (!function_exists('disableAdminBar')) {
 
    function disableAdminBar(){
   
    remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 ); // for the admin page
    remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); // for the front end
   
    function remove_admin_bar_style_backend() {  // css override for the admin page
		if (current_user_can( 'subscriber' ))
			echo '<style> body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }
			#wpadminbar { display:none;}   </style>';
    }
           
    add_filter('admin_head','remove_admin_bar_style_backend');
     
    function remove_admin_bar_style_frontend() { // css override for the frontend
      echo '<style type="text/css" media="screen">
      html { margin-top: 0px !important; }
      * html body { margin-top: 0px !important; }
      </style>';
    }
     
    add_filter('wp_head','remove_admin_bar_style_frontend', 99);
   
  }
 
}


if (1)
{
	add_filter( 'wpseo_use_page_analysis', '__return_false' );
}
else{

}