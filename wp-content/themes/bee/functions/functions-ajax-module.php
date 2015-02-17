<?php
header("charset: UTF-8");
require_once('../../../../wp-load.php');
$data = $_POST['data'];
$mode = $_POST['mode'];

switch($mode){
	case 'module':
	
	$module_id = $data["module_id"];
	$paged = $data["paged"];
	$post_id = $data["post_id"];
	$module_post = $data["module_post"];
	
	ux_view_module_load($module_id, $post_id, $paged, $module_post);
	
	break;
	
	case 'liquid':
	$post_id = $data["post_id"];
	$block_words = $data["block_words"];
	$show_social = $data["show_social"];
	$image_ratio = $data["image_ratio"];
	
	ux_view_liquid_load($post_id, $block_words, $show_social, $image_ratio);
	break;
	
}




?>