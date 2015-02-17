<?php
function ux_bbpress_enabled(){
	if (class_exists( 'bbPress' )) { return true; }
	return false;
}

//check if the plugin is enabled, otherwise stop the script
if(!ux_bbpress_enabled()) { return false; }

//register my own styles
if(!is_admin()){ add_action('bbp_enqueue_scripts', 'ux_bbpress_register_assets',15); }

function ux_bbpress_register_assets(){
	global $bbp;

	wp_dequeue_style( 'bbp-default-bbpress' );
	wp_enqueue_style( 'ux-bbpress', UX_LOCAL_URL.'/styles/bbpress-mod.css');
	
}

//remove forum and single topic summaries at the top of the page
add_filter('bbp_get_single_forum_description', 'ux_bbpress_filter_form_message',10,2 );
add_filter('bbp_get_single_topic_description', 'ux_bbpress_filter_form_message',10,2 );

function ux_bbpress_filter_form_message( $retstr, $args ){
	//removes forum summary, voices count etc
	return false;
}

register_sidebar(array(
	'name' => 'Forum',
	'id' => 'forum',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s">', 
	'after_widget' => '</li>', 
	'before_title' => '<h3 class="widget-title">', 
	'after_title' => '</h3>', 
));