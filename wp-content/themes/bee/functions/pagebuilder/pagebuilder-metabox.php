<?php
function ux_custom_meta_box(){
	add_meta_box(  
        'post-pagebuilder-box', 
        __('Page Builder', 'ux'), 
        'ux_show_page_builder_box',
        'post', 
        'normal', 
        'high'
	);
	add_meta_box(  
        'post-pagebuilder-box', 
        __('Page Builder', 'ux'), 
        'ux_show_page_builder_box',
        'page', 
        'normal', 
        'high'
	);
}

function ux_show_page_builder_box(){
	wp_enqueue_script('google-map');
	require_once locate_template('/functions/pagebuilder/view/box-pagebuilder.php');
}

add_action('add_meta_boxes', 'ux_custom_meta_box');

?>
