<?php
/*
============================================================================
	*
	* Post Type Columns
	*
============================================================================	
*/
function CustomPostTypeColumns($columns) {
	global $post_type_fields;
	
	if(isset($_GET['post_type'])){
		$post_type = $_GET['post_type'];
		foreach($post_type_fields as $field){
			if($post_type == $field['slug']){
				if(isset($field['columns'])){
					$columns = array_merge( $columns, $field['columns'] );
				}
			}
		}
	}
	
	unset($columns['date']);
	return $columns;
	
}

function CustomPostTypeColumn($column,$post_id){
	global $post_type_fields;
	
	if(isset($_GET['post_type'])){
		$post_type = $_GET['post_type'];
		foreach($post_type_fields as $field){
			if($post_type == $field['slug']){
				switch($column){
					case 'column_category':
						$categories = get_the_terms($post_id, $field['cat_slug']);
						$separator = ', ';
						$output = '';
						if($categories){
							foreach($categories as $category) {
								$output .= '<a href="?post_type='.$post_type.'&'.$field['cat_slug'].'='.$category->slug.'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'ux' ), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
							}
						}
						echo trim($output, $separator);
					break;
				}
			}
		}
	}
}

add_action('admin_footer-edit.php', 'CustomPostTypeColumnEdit', 11);
function CustomPostTypeColumnEdit(){
	if(get_post_type() == 'post'){}elseif(get_post_type() == 'page'){}else{
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/functions/theme/js/theme.edit.js"></script>';
	}
}


/*
============================================================================
	*
	* Post Type Meta
	*
============================================================================	
*/

function CustomPostTypeMetaBox(){
	global $post_type_fields;
	
	foreach($post_type_fields as $field){
		if($field['meta']){
			add_meta_box(  
				'post-type-'.$field['slug'].'-box', 
				$field['name'] .' '.__('Meta', 'ux'), 
				'CustomShowPostTypeMetaBox',
				$field['slug'], 
				'normal', 
				'high'
			);
		}
	}
}

function CustomShowPostTypeMetaBox(){
	require_once locate_template('/functions/functions-post-type-meta.php');
}

add_action('add_meta_boxes', 'CustomPostTypeMetaBox');

/*
============================================================================
	*
	* Post Type
	*
============================================================================	
*/
$post_type_fields = array(
	'team' => array(
		'name' => __('Team','ux'),
		'slug' => 'team',
		'meta' => true,
		'add_new' => __('Add New','ux'),
		'add_new_item' => __('Add New Team Member','ux'),
		'edit_item' => __('Edit Team Member','ux'),
		'new_item' => __('New Team Member','ux'),
		'view_item' => __('View Team Member','ux'),
		'not_found' => __('No Team Member found.','ux'),
		'not_found_in_trash' => __('No Team Member found in Trash.','ux'),
		'search_items' => __('Search Team Member','ux'),
		'cat_slug' => __('team_cat','ux'),
		'cat_menu_name' => __('Team Categories','ux'),
		'columns' => array(
			'column_category' => __('Categories','ux')
		),
		'menu_icon' => UX_LOCAL_URL.'/functions/theme/images/icons/team.png'
	
	),
	'Clients' => array(
		'name' => __('Clients','ux'),
		'slug' => 'clients',
		'meta' => true,
		'add_new' => __('Add New','ux'),
		'add_new_item' => __('Add New Client','ux'),
		'edit_item' => __('Edit Client','ux'),
		'new_item' => __('New Client','ux'),
		'view_item' => __('View Client','ux'),
		'not_found' => __('No Client found.','ux'),
		'not_found_in_trash' => __('No Client found in Trash.','ux'),
		'search_items' => __('Search Client','ux'),
		'cat_slug' => __('client_cat','ux'),
		'cat_menu_name' => __('Client Categories','ux'),
		'columns' => array(
			'column_category' => __('Categories','ux')
		),
		'menu_icon' => UX_LOCAL_URL.'/functions/theme/images/icons/client.png'
	
	),
	'Testimonials' => array(
		'name' => __('Testimonials','ux'),
		'slug' => 'testimonials',
		'meta' => true,
		'add_new' => __('Add New','ux'),
		'add_new_item' => __('Add New Testimonial','ux'),
		'edit_item' => __('Edit Testimonial','ux'),
		'new_item' => __('New Testimonial','ux'),
		'view_item' => __('View Testimonial','ux'),
		'not_found' => __('No Testimonial found.','ux'),
		'not_found_in_trash' => __('No Testimonial found in Trash.','ux'),
		'search_items' => __('Search Testimonial','ux'),
		'cat_slug' => __('testimonial_cat','ux'),
		'cat_menu_name' => __('Categories','ux'),
		'columns' => array(
			'column_category' => __('Categories','ux')
		),
		'menu_icon' => UX_LOCAL_URL.'/functions/theme/images/icons/testimonial.png'
	
	),
	'Jobs' => array(
		'name' => __('Jobs','ux'),
		'slug' => 'jobs',
		'meta' => true,
		'add_new' => __('Add New','ux'),
		'add_new_item' => __('Add New Job','ux'),
		'edit_item' => __('Edit Job','ux'),
		'new_item' => __('New Job','ux'),
		'view_item' => __('View Job','ux'),
		'not_found' => __('No Job found.','ux'),
		'not_found_in_trash' => __('No Job found in Trash.','ux'),
		'search_items' => __('Search Job','ux'),
		'cat_slug' => __('job_cat','ux'),
		'cat_menu_name' => __('Job Categories','ux'),
		'columns' => array(
			'column_category' => __('Categories','ux')
		),
		'menu_icon' => UX_LOCAL_URL.'/functions/theme/images/icons/jobs.png'
	
	),
	'FAQs' => array(
		'name' => __('FAQs','ux'),
		'slug' => 'faqs',
		'meta' => false,
		'add_new' => __('Add New','ux'),
		'add_new_item' => __('Add New Question','ux'),
		'edit_item' => __('Edit Question','ux'),
		'new_item' => __('New Question','ux'),
		'view_item' => __('View Question','ux'),
		'not_found' => __('No Question found.','ux'),
		'not_found_in_trash' => __('No Question found in Trash.','ux'),
		'search_items' => __('Search Question','ux'),
		'cat_slug' => __('question_cat','ux'),
		'cat_menu_name' => __('Topics','ux'),
		'columns' => array(
			'column_category' => __('Categories','ux')
		),
		'menu_icon' => UX_LOCAL_URL.'/functions/theme/images/icons/faqs.png'
	
	)
	
);

function CustomPostType(){
	global $post_type_fields;
	
	foreach($post_type_fields as $field){
		$labels = array(
			'name'               => $field['name'],
			'singular_name'      => $field['name'],
			'add_new'            => $field['add_new'],
			'add_new_item'       => $field['add_new_item'],
			'edit_item'          => $field['edit_item'],
			'new_item'           => $field['new_item'],
			'all_items'          => $field['name'],
			'view_item'          => $field['view_item'],
			'search_items'       => $field['search_items'],
			'not_found'          => $field['not_found'],
			'not_found_in_trash' => $field['not_found_in_trash'], 
			'parent_item_colon'  => '',
			'menu_name'          => $field['name']
		);
		
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true, 
			'show_in_menu'       => true, 
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $field['slug'] ),
			'capability_type'    => 'post',
			'has_archive'        => true, 
			'hierarchical'       => true,
			'menu_icon'          => $field['menu_icon'],
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		); 
		
		register_post_type($field['slug'],$args);
		
		if($field['slug'] == 'clients'){
			remove_post_type_support( 'clients', 'editor' );
			
		}
		
		$labels = array(   
			'name' => $field['cat_menu_name'], 
			'singular_name' => $field['cat_slug'], 
			'menu_name' => $field['cat_menu_name'],   
		);  
		
		register_taxonomy(   
			$field['cat_slug'],   
			array($field['slug']),   
			array(   
				'hierarchical' => true,   
				'labels' => $labels,   
				'show_ui' => true,   
				'query_var' => true,   
				'rewrite' => array( 'slug' => $field['cat_slug'] ),   
			)   
		); 
		
		add_filter('manage_'.$field['slug'].'_posts_columns', 'CustomPostTypeColumns');
		add_action('manage_'.$field['slug'].'_posts_custom_column', 'CustomPostTypeColumn', 10, 2 );
	}
	register_post_type('custom_template',array('label'=>__('Module Template','ux'),'show_ui'=>false));
}
add_action('init','CustomPostType');


?>