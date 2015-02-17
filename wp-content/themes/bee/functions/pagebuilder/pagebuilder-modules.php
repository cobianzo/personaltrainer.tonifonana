<?php
/*
============================================================================
	*
	* Module Fields
	*
============================================================================	
*/
$wrap_fields = array(
	'pb_1_1' => '1/1',
	'pb_3_4' => '3/4',
	'pb_2_3' => '2/3',
	'pb_1_2' => '1/2',
	'pb_1_3' => '1/3',
	'pb_1_4' => '1/4'
	

);
/*
============================================================================
	*
	* Module Fields
	*
============================================================================	
*/
$module_details_item_icon = array(
	  array('title' => __('Check','ux'), 'value' => 'm-check'),
	  array('title' => __('Arrow','ux'), 'value' => 'm-right-dir'),
	  array('title' => __("Don't Show Icon",'ux'), 'value' => 'noting')

);

$module_type_fields = array(
	array('id' => 'editor'),
	array('id' => 'background_color'),
	
	array(
		'id' => 'icon',
		'item' => array(
			'm-check',
			'm-close',
			'm-play1',
            'm-dot',
            'm-dot-large',
            'm-ring',
            'm-star-full',
            'm-star-stroke',
            'm-point-left',
            'm-point-right',
            'm-point-up',
            'm-point-down',
            'm-pt-video',
            'm-pt-standard',
            'm-pt-quote',
            'm-pt-portfolio',
            'm-pt-link',
            'm-pt-image',
            'm-pt-audio',
            'm-more',
			'm-left-dir',
            'm-right-dir',
            'm-down-dir',
            'm-up-dir',
            'm-angle-left',
            'm-angle-right',
            'm-angle-up',
            'm-angle-down',
            'm-up-arrow',
            'm-down-arrow',
            'm-left-arrow',
            'm-right-arrow',
            'm-left-arrow-curved',
            'm-right-arrow-curved',
            'm-downleft-arrow-curved',
            'm-downright-arrow-curved',
            'm-close-thin',
            'm-people-female',
            'm-people-male',
            'm-coffee1',
			'm-heart',
			'm-spade',
            'm-club',
            'm-diamond',
            'm-water',
            'm-lab',
            'm-grid',
            'm-history',
            'm-check-circle',
            'm-heart-circle',
            'm-left-circle',
            'm-right-circle',
            'm-close-circle',
            'm-alert-circle',
            'm-plus-circle',
            'm-minus-circle',
            'm-help-circle',
            'm-info-circle',
            'm-alert',
            'm-coffee',
			'm-html5-fill',
			'm-css3-fill',
            'm-chrome',
            'm-setting',
            'm-cloud-down',
            'm-cloud-up',
            'm-help',
            'm-settings',
            'm-pc',
            'm-ipod',
            'm-book',
            'm-user',
            'm-users',
            'm-shopping-cart',
            'm-resize-small',
            'm-resize-full',
            'm-umbrella',
            'm-menu',
            'm-comment',
            'm-chat',
			'm-calendar',
			'm-tel',
            'm-location',
            'm-at',
            'm-camera',
			'm-eye',
			'm-email',
			'm-airplane',
			'm-link',
			'm-tag',
			'm-scissors',
			'm-wifi',
			'm-music',
			'm-food',
			'm-image',
			'm-trash',
			'm-volume',
			'm-volume-off',
			'm-quote-right',
			'm-quote-left',
			'm-social-youtube',
			'm-social-wp',
			'm-social-vimeo',
			'm-social-twitter',
			'm-social-tumblr',
			'm-social-stumbleupon',
			'm-social-rss',
			'm-social-pinterest',
			'm-social-linkedin',
			'm-social-lastfm',
			'm-social-instagram',
			'm-social-googleplus',
			'm-social-git',
			'm-social-forrst',
			'm-social-flickr',
			'm-social-facebook',
			'm-social-email',
			'm-social-dribbble',
			'm-social-deviantart',
			'm-social-blogger',
			'icon-m-social-vk',
			'icon-m-social-livejournal',
			'icon-m-social-myspace',
			'icon-m-social-odnoklassniki',
			'icon-m-social-bebo',
			'icon-m-social-path',
			'icon-m-social-reddit',
			'icon-m-social-xing',
			'icon-m-social-douban',
			'icon-m-social-renren',
			'icon-m-social-wechat',
			'icon-m-social-weibo',
			'm-image-view',
			'm-image-readmore',
			'm-goback1',
			'm-goback2',
			'm-edit',
			'm-data',
			'm-sun-fill',
			'm-sun-stroke',
			'm-weather-rain',
			'm-weather-cloud',
			'm-forum-question',
			'm-forum-repairing',
			'm-forum-done',
			'm-forum-locked',
			'm-forum-top'
		)
	),
	
	array(
		'id' => 'select',
		'item' => array(
			'module_select_icon_location' => array(
				array('title' => __('Icon on Left','ux'), 'value' => 'icon_left'),
				array('title' => __('Icon on Top','ux'), 'value' => 'icon_top')
			),
			'module_select_message_type' => array(
				array('title' => __('Success','ux'), 'value' => 'success'),
				array('title' => __('Warning','ux'), 'value' => 'warning'),
				array('title' => __('Error','ux'), 'value' => 'error'),
				array('title' => __('Information','ux'), 'value' => 'information')
			),
			'module_select_accordion_style' => array(
				array('title' => __('Style A','ux'), 'value' => 'style_a'),
				array('title' => __('Style B','ux'), 'value' => 'style_b')
			),
			'module_select_accordion_type' => array(
				array('title' => __('Accordion','ux'), 'value' => 'accordion'),
				array('title' => __('Toggle','ux'), 'value' => 'toggle')
			),
			'module_select_tabs_type' => array(
				array('title' => __('Horizontal Tabs','ux'), 'value' => 'horizontal_tabs'),
				array('title' => __('Vertical Tabs','ux'), 'value' => 'vertical_tabs')
			),
			'module_select_divider_type' => array(
				array('title' => __('Single Line','ux'), 'value' => 'single_line'),
				array('title' => __('Text and Line','ux'), 'value' => 'text_and_line'),
				array('title' => __('Blank Divider','ux'), 'value' => 'blank_divider')
			),
			'module_select_text_align' => array(
				array('title' => __('Left','ux'), 'value' => 'left'),
				array('title' => __('Center','ux'), 'value' => 'center'),
				array('title' => __('Right','ux'), 'value' => 'right')
			),
			'module_select_color' => $theme_color,
			'module_select_height' => array(
				array('title' => __('20px','ux'), 'value' => '20px'),
				array('title' => __('40px','ux'), 'value' => '40px'),
				array('title' => __('60px','ux'), 'value' => '60px'),
				array('title' => __('80px','ux'), 'value' => '80px')
			),
			'module_select_orderby' => array(
				array('title' => __('Please Select','ux'), 'value' => '-1'),
				array('title' => __('Title','ux'), 'value' => 'title'),
                array('title' => __('Date','ux'), 'value' => 'date'),
                array('title' => __('ID','ux'), 'value' => 'id'),
                array('title' => __('Modified','ux'), 'value' => 'modified'),
                array('title' => __('Author','ux'), 'value' => 'author'),
                array('title' => __('Comment count','ux'), 'value' => 'comment_count'),
                array('title' => __('None','ux'), 'value' => 'none')
			),
			'module_select_order' => array(
				array('title' => __('Ascending','ux'), 'value' => 'ascending'),
				array('title' => __('Descending','ux'), 'value' => 'descending')
			),
			'module_select_columns' => array(
				array('title' => __('1','ux'), 'value' => '1'),
				array('title' => __('2','ux'), 'value' => '2'),
				array('title' => __('3','ux'), 'value' => '3')
			),
			'module_select_rows' => array(
				array('title' => __('1','ux'), 'value' => '1'),
				array('title' => __('2','ux'), 'value' => '2'),
				array('title' => __('3','ux'), 'value' => '3'),
				array('title' => __('4','ux'), 'value' => '4')
			),
			'module_select_list_type' => array(
				array('title' => __('Masonry List','ux'), 'value' => 'masonry_list'),
				array('title' => __('Standard List','ux'), 'value' => 'standard_list')
			),
			'module_select_pagination' => array(
				array('title' => __('No','ux'), 'value' => 'no'),
				array('title' => __('Page Number','ux'), 'value' => 'page_number'),
				array('title' => __('Twitter','ux'), 'value' => 'twitter'),
				//array('title' => __('Infiniti Scroll','ux'), 'value' => 'infiniti_scroll')
			),
			'module_select_image_style' => array(
				array('title' => __('Standard','ux'), 'value' => 'no'),
				array('title' => __('Shadow','ux'), 'value' => 'shadow')
			),
			'module_select_button_style' => $theme_color,
			'module_select_map_zoom' => array(
				array('title' => __('1','ux'), 'value' => '1'),
				array('title' => __('2','ux'), 'value' => '2'),
				array('title' => __('3','ux'), 'value' => '3'),
				array('title' => __('4','ux'), 'value' => '4'),
				array('title' => __('5','ux'), 'value' => '5'),
				array('title' => __('6','ux'), 'value' => '6'),
				array('title' => __('7','ux'), 'value' => '7'),
				array('title' => __('8','ux'), 'value' => '8'),
				array('title' => __('9','ux'), 'value' => '9'),
				array('title' => __('10','ux'), 'value' => '10'),
				array('title' => __('11','ux'), 'value' => '11'),
				array('title' => __('12','ux'), 'value' => '12'),
				array('title' => __('13','ux'), 'value' => '13'),
				array('title' => __('14','ux'), 'value' => '14'),
				array('title' => __('15','ux'), 'value' => '15'),
				array('title' => __('16','ux'), 'value' => '16'),
				array('title' => __('17','ux'), 'value' => '17'),
				array('title' => __('18','ux'), 'value' => '18'),
				array('title' => __('19','ux'), 'value' => '19'),
				array('title' => __('20','ux'), 'value' => '20')
			),
			'module_select_map_view' => array(
				array('title' => __('Map','ux'), 'value' => 'map'),
				array('title' => __('Satellite','ux'), 'value' => 'satellite'),
				array('title' => __('Map+Terrain','ux'), 'value' => 'map_terrain')
			),
			'module_select_slider_image' => array(
				array('title' => __('LayerSlider','ux'), 'value' => 'layerslider'),
				array('title' => __('Content Slider','ux'), 'value' => 'novo'),
				array('title' => __('Flex Slider','ux'), 'value' => 'flexslider'),
				array('title' => __('Revolution Slider','ux'), 'value' => 'revolutionslider')
			),
			'module_select_image_source' => array(
				array('title' => __('Library','ux'), 'value' => 'library'),
				array('title' => __('Image Post','ux'), 'value' => 'image_post')
			),
			'module_select_image_list_type' => array(
				array('title' => __('Grid list','ux'), 'value' => 'grid_list'),
				array('title' => __('Masonry','ux'), 'value' => 'masonry')
			),
			'module_select_image_spacing' => array(
				array('title' => __('0px','ux'), 'value' => '0px'),
				array('title' => __('1px','ux'), 'value' => '1px'),
				array('title' => __('2px','ux'), 'value' => '2px'),
				array('title' => __('5px','ux'), 'value' => '5px'),
				array('title' => __('10px','ux'), 'value' => '10px'),
				array('title' => __('20px','ux'), 'value' => '20px')
			),
			'module_select_image_size' => array(
				array('title' => __('Medium','ux'), 'value' => 'medium'),
				array('title' => __('Large','ux'), 'value' => 'large'),
				array('title' => __('Small','ux'), 'value' => 'small'),
			),
			'module_select_image_ratio' => array(
				array('title' => '3:2(Grid)', 'value' => 'landscape'),
				array('title' => '1:1(Grid)', 'value' => 'square'),
				array('title' => __('Auto Ratio(Masonry)','ux'), 'value' => 'auto')
			),
			'module_select_sortable' => array(
				array('title' => __('No','ux'), 'value' => 'no'),
				array('title' => __('Top','ux'), 'value' => 'top'),
				array('title' => __('Left','ux'), 'value' => 'left'),
				array('title' => __('Right','ux'), 'value' => 'right')
			),
			'module_select_hover_effect' => array(
				array('title' => __('Folding','ux'), 'value' => 'folding'),
				array('title' => __('Flip','ux'), 'value' => 'flip')
			),
			'module_select_video_ratio' => array(
				array('title' => __('4:3','ux'), 'value' => '4:3'),
				array('title' => __('16:9','ux'), 'value' => '16:9'),
				array('title' => __('Custom','ux'), 'value' => 'custom')
			),
			'module_select_background' => array(
				array('title' => __('Image','ux'), 'value' => 'image'),
				array('title' => __('Color','ux'), 'value' => 'color'),
			),
			'module_select_background_repeat' => array(
				array('title' => __('Repeat','ux'), 'value' => 'repeat'),
				array('title' => __('Fill','ux'), 'value' => 'no-repeat'),
			),
			'module_select_background_attachment' => array(
				//array('title' => __('Parallax','ux'), 'value' => 'parallax'),
				array('title' => __('Fixed','ux'), 'value' => 'fixed'),
				array('title' => __('Scroll','ux'), 'value' => 'scroll')
			),
			'module_select_parallax_ratio' => array(
				array('title' => __('0.1','ux'), 'value' => '0.1'),
				array('title' => __('0.2','ux'), 'value' => '0.2'),
				array('title' => __('0.3','ux'), 'value' => '0.3'),
				array('title' => __('0.4','ux'), 'value' => '0.4'),
				array('title' => __('0.5','ux'), 'value' => '0.5'),
				array('title' => __('0.6','ux'), 'value' => '0.6'),
				array('title' => __('0.7','ux'), 'value' => '0.7'),
				array('title' => __('0.8','ux'), 'value' => '0.8'),
				array('title' => __('0.9','ux'), 'value' => '0.9')
			),
			
			'module_select_hover_animation' => array(
				array('title' => __('Full Rotate','ux'), 'value' => 'full_rotate'),
				//array('title' => __('Half Rotate','ux'), 'value' => 'half_rotate'),
				//array('title' => __('Shake','ux'), 'value' => 'shake'),
				//array('title' => __('Halo','ux'), 'value' => 'halo'),
				array('title' => __('Flip','ux'), 'value' => 'flip'),
				array('title' => __('Scale','ux'), 'value' => 'scale')
			),
			'module_select_contact_form_type' => array(
				array('title' => __('Contact Form','ux'), 'value' => 'contact_form'),
				array('title' => __('Single Field','ux'), 'value' => 'single_field'),
				array('title' => __('Contact Form 7','ux'), 'value' => 'contact_form_7')
			),
			'module_select_infographic_type' => array(
				array('title' => __('Bar','ux'), 'value' => 'bar'),
				array('title' => __('Column','ux'), 'value' => 'column'),
				array('title' => __('Pie','ux'), 'value' => 'pie'),
				array('title' => __('Pictorial','ux'), 'value' => 'pictorial'),
				array('title' => __('Big Number','ux'), 'value' => 'big_number')
			),
			'module_select_infographic_style' => array(
				array('title' => __('Doughnut','ux'), 'value' => 'doughnut')
			),
			'module_select_count_start' => array(
				array('title' => __('Years','ux'), 'value' => 'years'),
				array('title' => __('Months','ux'), 'value' => 'months'),
				array('title' => __('Days','ux'), 'value' => 'days'),
				array('title' => __('Hours','ux'), 'value' => 'hours'),
				array('title' => __('Minutes','ux'), 'value' => 'minutes'),
				array('title' => __('Seconds','ux'), 'value' => 'seconds')
			)
			
		)
	),
	array(
		'id' => 'cheak',
		'item' => array(
			'module_cheak_share' => array(
				array('title' => __('Twitter','ux'), 'value' => 'twitter'),
				array('title' => __('Facebook','ux'), 'value' => 'facebook'),
				array('title' => __('Pinterest','ux'), 'value' => 'pinterest')
			),
			'module_cheak_dark_background' => array(
				array('title' => __('Text Shadow','ux'), 'value' => 'text_shadow')
			)
		)
	),
    
    array('id' => 'input_text'),
	array('id' => 'switch'),
	array('id' => 'title'),
	array('id' => 'image'),
	array('id' => 'media'),
	array('id' => 'tabs'),
	array('id' => 'google_map'),
	array('id' => 'social'),
	array('id' => 'html_content'),
	array('id' => 'list_item'),
	array('id' => 'details_item'),
	array('id' => 'date'),
	array(
		'id' => 'image_select',
		'item' => array(
			'module_select_icon_mask' => array(
				array('title' => __('Circle','ux'), 'value' => 'circle'),
				array('title' => __('Triangle','ux'), 'value' => 'triangle'),
				array('title' => __('Rounded Square','ux'), 'value' => 'rounded_square'),
				array('title' => __('Diamond','ux'), 'value' => 'diamond'),
				array('title' => __('Star','ux'), 'value' => 'star')
			)
		)
	)
);

function ux_module_type_fields(){
	global $module_type_fields;
	$module_type_fields = apply_filters('pagebuilder_module_type_fields', $module_type_fields);
	return $module_type_fields;
}

$module_fields = array(
	array(
		'id' => 'text_block',
		'name' => __('Text Block','ux'),
		'icon' => 'text_icon',
		'display' => 'block',
		'item' => array(
			
			array('title' => __('Background Color','ux'),
				  'description' => __('Select the Background Color for Text Block.','ux'),
				  'type' => 'background_color',
				  'name' => 'module_background_color')
		
		)
	),
	
	array(
		'id' => 'icon_box',
		'name' => __('Icon Box','ux'),
		'icon' => 'iconbox_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Select Icon','ux'),
				  'description' => __('Choose a icon for this Icon Box','ux'),
				  'type' => 'icon',
				  'name' => 'module_select_icon'),
			
			array('title' => __('Layout','ux'),
				  'description' => __('Place the Icon on left or top','ux'),
				  'type' => 'select',
				  'name' => 'module_select_icon_location'),
			
			array('title' => __('Icon Mask','ux'),
				  'description' => '',
				  'type' => 'image_select',
				  'name' => 'module_select_icon_mask'),
				  
			array('title' => __('Mask Color','ux'),
				  'description' => '',
				  'type' => 'background_color',
				  'name' => 'module_background_color'),
			
			array('title' => __('Hover Animation','ux'),
				  'description' => '',
				  'type' => 'select',
				  'name' => 'module_select_hover_animation'),
				  
			array('title' => __('Title','ux'),
				  'description' => __('Enter a title for this Icon Box','ux'),
				  'type' => 'title',
				  'name' => 'module_post_title'),
				  
			array('title' => __('Link','ux'),
				  'description' => '',
				  'type' => 'switch',
				  'name' => 'module_switch_hyperlink'),
				  
			array('title' => __('Url','ux'),
				  'description' => __('Paste a url for the icon','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_hyperlink',
				  'placeholder' => 'http://aol.com')
		
		)
	),
	
	array(
		'id' => 'text_list',
		'name' => __('Text List','ux'),
		'icon' => 'textlist_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Add Item','ux'),
				  'description' => __('Choose a icon for this Icon Box','ux'),
				  'type' => 'list_item',
				  'name' => 'module_lists_layout'),
				  
			array('title' => __('Bullet','ux'),
				  'description' => __('Place the Icon on left or top','ux'),
				  'type' => 'icon',
				  'name' => 'module_select_icon'),
				  
			array('title' => __('Content','ux'),
				  'description' => __('Enter content for this Text List','ux'),
				  'type' => 'html_content',
				  'name' => 'module_post_html_content')
			
		)
	),
	
	array(
		'id' => 'portfolio',
		'name' => __('Portfolio','ux'),
		'icon' => 'portfolio_icon',
		'display' => 'block',
		'item' =>  array(
			
			/*array('title' => __('List Type','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_list_type'),*/
				  
			array('title' => __('Spacing Between Images','ux'),
				  'description' => __('Choose the spacing between images','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_spacing'),
				  
			array('title' => __('Image Size','ux'),
				  'description' => __('Choose a size for the images','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_size'),
				  
			array('title' => __('Image Ratio','ux'),
				  'description' => __('From portfilio post featured image, recommended size: larger than 600px * 600px','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_ratio'),
				  
			array('title' => __('Sortable','ux'),
				  'description' => __('Choose whether you want the list to be sortable or not','ux'),
				  'type' => 'select',
				  'name' => 'module_select_sortable'),
				  
			array('title' => __('Pagination','ux'),
				  'description' => __('The "Twitter" option is to show a "Load More" button on the bottom of the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_pagination'),
				  
			array('title' => __('Hover Effect','ux'),
				  'description' => __('Choose a mouseover effect for the images','ux'),
				  'type' => 'select',
				  'name' => 'module_select_hover_effect'),
				  
			array('title' => __('Double Size First Item','ux'),
				  'description' => __('Enlarge the first image in the list','ux'),
				  'type' => 'switch',
				  'name' => 'module_select_first_item'),
				  
			array('title' => __('Post Number per Page','ux'),
				  'description' => __('How many items should be displayed per page, leave it empty to show all items in one page','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_per_page'),
				  
			array('title' => __('Category','ux'),
				  'description' => __('The featured images of the Portfolio posts under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category'),
				  
			array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby')
				  
			
		)
	),
	array(
		'id' => 'gallery',
		'name' => __('Gallery','ux'),
		'icon' => 'gallery_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Image Source','ux'),
				  'description' => __('Select where the images come from','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_source'),
				  
			array('title' => __('Category','ux'),
				  'description' => __('The featured images of the Image Posts under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category'),
				  
			/*array('title' => __('List Type','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_list_type'),*/
				  
			array('title' => __('Spacing Between Images','ux'),
				  'description' => __('Choose the spacing between images','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_spacing'),
				  
			array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby'),
				  
			array('title' => __('Image Size','ux'),
				  'description' => __('Choose a size for the images','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_size'),
				  
			array('title' => __('Image Ratio','ux'),
				  'description' => __('From portfilio post featured image, recommended size: larger than 600px * 600px','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_ratio'),
				  
			array('title' => __('Sortable','ux'),
				  'description' => __('Choose whether you want the list to be sortable or not','ux'),
				  'type' => 'select',
				  'name' => 'module_select_sortable'),
				  
			array('title' => __('Double Size First Item','ux'),
				  'description' => __('Enlarge the first image in the list','ux'),
				  'type' => 'switch',
				  'name' => 'module_select_first_item'),
				  
			array('title' => __('Hover Effect','ux'),
				  'description' => __('Enable the mouseover effect','ux'),
				  'type' => 'switch',
				  'name' => 'module_select_mouseover_effect'),
				  
			array('title' => __('Post Number per Page','ux'),
				  'description' => __('How many items should be displayed per page, leave it empty to show all items in one page','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_per_page'),
				  
			array('title' => __('Pagination','ux'),
				  'description' => __('The "Twitter" option is to show a "Load More" button on the bottom of the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_pagination'),
				  
			array('type' => 'line'),
			array('title' => __('Choose Image from Library','ux'),
				  'type' => 'gallery')
		)
	),
	array(
		'id' => 'single_image',
		'name' => __('Single Image','ux'),
		'icon' => 'singleimage_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Image','ux'),
				  'description' => __('Select image','ux'),
				  'type' => 'image',
				  'name' => 'module_image_single'),
				  
			array('title' => __('Style','ux'),
				  'description' => __('Select a style for the image','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_style'),
				  
			array('title' => __('Mouseover Effect','ux'),
				  'description' => __('Enable the mouseover effect','ux'),
				  'type' => 'switch',
				  'name' => 'module_select_mouseover_effect'),
				  
			array('title' => __('Lightbox','ux'),
				  'description' => __('Enable the Lightbox','ux'),
				  'type' => 'switch',
				  'name' => 'module_select_lightbox'),
				  
			array('title' => '',
				  'description' => '',
				  'type' => 'iframe',
				  'name' => 'module_iframe_single')
				  
				  
		)
	),
	array(
		'id' => 'image_box',
		'name' => __('Image Box','ux'),
		'icon' => 'imagebox_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Image','ux'),
				  'description' => __('Select image','ux'),
				  'type' => 'media',
				  'name' => 'module_image_media'),
				  
			array('title' => __('Image Mask','ux'),
				  'description' => '',
				  'type' => 'image_select',
				  'name' => 'module_select_icon_mask'),
				  
			array('title' => __('Title','ux'),
				  'description' => '',
				  'type' => 'input_text',
				  'name' => 'module_input_title'),
				  
			array('title' => __('Content','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_content'),
				  
			array('title' => __('Link','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_hyperlink'),
				  
			array('title' => __('Url','ux'),
				  'description' => __('Paste a url for the image','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_hyperlink',
				  'placeholder' => 'http://aol.com'),
				  
			array('title' => __('Show Social Icons','ux'),
				  'description' => '',
				  'type' => 'switch',
				  'name' => 'module_switch_social_network'),
			
			array('title' => __('Social Medias','ux'),
				  'description' => '',
				  'type' => 'social',
				  'name' => 'module_social_medias')
				  
		)
	),
	array(
		'id' => 'message_box',
		'name' => __('Message Box','ux'),
		'icon' => 'messagebox_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Type','ux'),
				  'description' => __('Select your message type','ux'),
				  'type' => 'select',
				  'name' => 'module_select_message_type'),
				  
			array('title' => __('Content','ux'),
				  'description' => __('Enter content for this Message Box','ux'),
				  'type' => 'html_content',
				  'name' => 'module_post_html_content')
			
		)
	),
	array(
		'id' => 'accordion_toggle',
		'name' => __('Accordion/Toggle','ux'),
		'icon' => 'accordion_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Type','ux'),
				  'description' => __('Select accordion or toggle','ux'),
				  'type' => 'select',
				  'name' => 'module_select_accordion_type'),
				  
			array('title' => __('Style','ux'),
				  'description' => __('Select a style for the module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_accordion_style'),
				  
			array('title' => __('Open First Item by Default','ux'),
				  'description' => __('Enable it the first item would be opened by default','ux'),
				  'type' => 'switch',
				  'name' => 'module_select_first_item'),
				  
			array('title' => __('Add Item','ux'),
				  'description' => __('Press the "Add" button to add an item','ux'),
				  'type' => 'list_item',
				  'name' => 'module_lists_layout'),
				  
			array('title' => __('Title','ux'),
				  'description' => __('Enter the title for this item','ux'),
				  'type' => 'title',
				  'name' => 'module_post_title')
			
		)
	),
	
	array(
		'id' => 'tabs',
		'name' => __('Tabs','ux'),
		'icon' => 'tab_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Type','ux'),
				  'description' => __('Select a layout for the Tabs module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_tabs_type'),
				  
			array('title' => __('Add Item','ux'),
				  'description' => __('Press the "Add" button to add an item','ux'),
				  'type' => 'list_item',
				  'name' => 'module_lists_layout'),
				  
			array('title' => __('Title','ux'),
				  'description' => __('Enter the title for this item','ux'),
				  'type' => 'title',
				  'name' => 'module_post_title')
			
		)
	),
	array(
		'id' => 'testimonials',
		'name' => __('Testimonials','ux'),
		'icon' => 'testimonial_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Testimonials Category','ux'),
				  'description' => __('The testimonials under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category',
				  'post_type' => 'testimonials',
				  'post_type_cat' => 'testimonial_cat'),
				  
			array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby'),
				  
			array('title' => __('Columns','ux'),
				  'description' => __('Setup the number of columns you want to show in front end','ux'),
				  'type' => 'select',
				  'name' => 'module_select_columns'),
				  
			array('title' => __('Rows','ux'),
				  'description' => __('Setup the number of rows you want to show in front end','ux'),
				  'type' => 'select',
				  'name' => 'module_select_rows'),
				  
			array('title' => __('Show Position','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_testimonials_position'),
				  
			array('title' => __('Show Link','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_testimonials_link')
				  
		)
				 
			
	),
	array(
		'id' => 'blog',
		'name' => __('Blog','ux'),
		'icon' => 'blog_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('List Type','ux'),
				  'description' => __('"Standard List" would showcase your Standard Post; "Masonry List" would showcase your posts in all types','ux'),
				  'type' => 'select',
				  'name' => 'module_select_list_type'),
                  
            array('title' => __('Category','ux'),
				  'description' => __('The Posts under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category'),
				  
			array('title' => __('Post Number per Page','ux'),
				  'description' => __('How many items should be displayed per page, leave it empty to show all items in one page','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_per_page'),
                  
            array('title' => __('Order by','ux'),
				  'description' => __('select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby'),
				  
			array('title' => __('Pagination','ux'),
				  'description' => __('The "Twitter" option is to show a "Load More" button on the bottom of the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_pagination')
				 
		)
	),
	array(
		'id' => 'client',
		'name' => __('Client','ux'),
		'icon' => 'client_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Client Category','ux'),
				  'description' => __('The clients under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category',
				  'post_type' => 'clients',
				  'post_type_cat' => 'client_cat'),
				  
			array('title' => __('Columns','ux'),
				  'description' => __('Setup the number of columns you want to show in front end','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_columns'),
				 
		)
	),
	array(
		'id' => 'divider',
		'name' => __('Divider','ux'),
		'icon' => 'divider_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Type','ux'),
				  'description' => __('select a type for the Divider module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_divider_type'),
				  
			array('title' => __('Divider Text','ux'),
				  'description' => __('Enter the text you want to show in the divider','ux'),
				  'type' => 'title',
				  'name' => 'module_post_title'),
			
			array('title' => __('Text Align','ux'),
				  'description' => __('Select alignment for the text','ux'),
				  'type' => 'select',
				  'name' => 'module_select_text_align'),
			
			array('title' => __('Height','ux'),
				  'description' => '',
				  'type' => 'select',
				  'name' => 'module_select_height'),
				  
			array('title' => __('Color','ux'),
				  'description' => __('Select a color for the divider','ux'),
				  'type' => 'background_color',
				  'name' => 'module_background_color')
				 
			
		)
	),
	array(
		'id' => 'team',
		'name' => __('Team','ux'),
		'icon' => 'team_icon',
		'display' => 'block',
		'item' =>  array(
			
			/*array('title' => __('List Type','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_list_type'),
				  
			array('title' => __('Spacing Between Images','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_spacing'),
				  
			array('title' => __('Image Size','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_size'),
				  
			array('title' => __('Ratio','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_ratio'),
				  
			array('title' => __('Sortable','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_sortable'),
				  
			array('title' => __('Pagination','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_pagination'),
				  
			array('title' => __('Hover Effect','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_hover_effect'),
				  
			array('title' => __('Double Size First Item','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'switch',
				  'name' => 'module_select_first_item'),*/
				  
			  array('title' => __('Show Position','ux'),
				  'description' => __('Show the team number\'s position in the module','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_position'),
				  
			array('title' => __('Show Email','ux'),
				  'description' => __('Show the team number\'s email in the module','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_email'),
				  
			array('title' => __('Show Phone Number','ux'),
				  'description' => __('Show the team number\'s phone number in the module','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_phone_number'),
				  
			array('title' => __('Show Social Network','ux'),
				  'description' => __('show the team number\'s social medias in the module','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_social_network'),
				  
			array('title' => __('Number','ux'),
				  'description' => __('How many items should be displayed in this module, leave it empty to show all items.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_per_page'),
				  
			array('title' => __('Team Category','ux'),
				  'description' => '',
				  'type' => 'select',
				  'name' => 'module_select_category',
				  'post_type' => 'team',
				  'post_type_cat' => 'team_cat'),
				  
			array('title' => __('Order by','ux'),
				  'description' => '',
				  'type' => 'select',
				  'name' => 'module_select_orderby')
			
		)
	),
	array(
		'id' => 'jobs',
		'name' => __('Jobs','ux'),
		'icon' => 'jobs_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Jobs Category','ux'),
				  'description' => __('The jobs under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category',
				  'post_type' => 'jobs',
				  'post_type_cat' => 'job_cat'),
                  
            array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby')
				 
			
		)
	),
	array(
		'id' => 'faq',
		'name' => __('FAQ','ux'),
		'icon' => 'faq_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('FAQ Category','ux'),
				  'description' => __('The questions under the category you selected would be shown in this module.','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category',
				  'post_type' => 'faqs',
				  'post_type_cat' => 'question_cat'),
                  
            array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby')
				 
			
		)
	),
	array(
		'id' => 'contact_form',
		'name' => __('Contact Form','ux'),
		'icon' => 'contact_icon',
		'display' => 'block',
		'item' =>  array(

			array('title' => __('Form Type','ux'),
				  'description' => '',
				  'type' => 'select',
				  'name' => 'module_select_contact_form_type'),
						
			array('title' => __('Recipient Email','ux'),
				  'description' => __('Enter the email to receive the messages.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_recipient_email'),
				  
			array('title' => __('Field Text','ux'),
				  'description' => '',
				  'type' => 'input_text',
				  'name' => 'module_input_field_text'),
				  
			array('title' => __('Button Text','ux'),
				  'description' => __('Enter the text you want to show on button.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_button_text'),
				  
			array('title' => __('Sent Message','ux'),
				  'description' => __('Enter the inform information you want to show after user send out the message.','ux'),
				  'type' => 'html_content',
				  'name' => 'module_textarea_sent_message'),
				  
			array('title' => __('Show Random Verify Number','ux'),
				  'description' => '',
				  'type' => 'switch',
				  'name' => 'module_switch_show_verifynumber'),	  
				  
			array('title' => __('Contact Form 7 Alias','ux'),
				  'description' => '',
				  'type' => 'select',
				  'name' => 'module_select_contact_form_7_alias'),
				  
			
		)
	),
	array(
		'id' => 'video',
		'name' => __('Video','ux'),
		'icon' => 'video_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Embed Code','ux'),
				  'description' => __('You could find the enbed code on the source video page. For Youtube and Vimoe, you can enter the url only.','ux'),
				  'type' => 'html_content',
				  'name' => 'module_textarea_embed_code'),
				  
			/*array('title' => __('M4V File URL','ux'),
				  'description' => __('You need to supply an M4V file to satisfy both HTML5 and Flash solutions.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_m4v'),
				  
			array('title' => __('OGV File URL','ux'),
				  'description' => __('The optional OGV format is used to increase x-browser support for HTML5 browsers such as Firefox and Opera.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_ogv'),*/
				  
			array('title' => __('Ratio','ux'),
				  'description' => __('Select the right ratio for your source video.','ux'),
				  'type' => 'select',
				  'name' => 'module_select_video_ratio')
				 
			
		)
	),
	array(
		'id' => 'promote',
		'name' => __('Promote','ux'),
		'icon' => 'promote_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Big Text','ux'),
				  'description' => __('Enter the text you want to show in a largger size.','ux'),
				  'type' => 'html_content',
				  'name' => 'module_textarea_big_text'),
				  
			array('title' => __('Medium Text','ux'),
				  'description' => __('Enter the text you want to show in normal size.','ux'),
				  'type' => 'html_content',
				  'name' => 'module_textarea_medium_text'),
				  
			array('title' => __('Text Align','ux'),
				  'description' => __('Select alignment for the text.','ux'),
				  'type' => 'select',
				  'name' => 'module_select_text_align'),
				  
			array('title' => __('Show Button','ux'),
				  'description' => __('Enable it to show the button.','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_show_button'),
				  
			array('title' => __('Button Style','ux'),
				  'description' => __('Select a color for the button','ux'),
				  'type' => 'background_color',
				  'name' => 'module_background_color'),
				  
			array('title' => __('Button Text','ux'),
				  'description' => __('Enter the text you want to show on button','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_button_text'),
				  
			array('title' => __('Button Link','ux'),
				  'description' => __('Paste the url to link the button to','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_button_link')
				 
		)
	),
	array(
		'id' => 'share',
		'name' => __('Share','ux'),
		'icon' => 'share_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Show','ux'),
				  'description' => __('Check on the social medias you want to show in the page. If the featured image is not set, the pin button would not be shown.','ux'),
				  'type' => 'cheak',
				  'name' => 'module_cheak_share')
				 
		)
	),
	array(
		'id' => 'google_map',
		'name' => __('Google Map','ux'),
		'icon' => 'googlemap_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Address','ux'),
				  'description' => __('Enter the address that you would like to show on the map here, i.e. "Sydney, NSW".','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_map_address2'),
				  
			array('title' => '',
				  'description' => '',
				  'type' => 'google_map',
				  'name' => 'module_input_google_map_canvas'),
				  
			array('title' => __('Height','ux'),
				  'description' => __('Enter the height for your map (e.g. 400)','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_map_height',
				  'unit' => __('px','ux')),
				  
			array('title' => __('View','ux'),
				  'description' => __('Select a map view','ux'),
				  'type' => 'select',
				  'name' => 'module_select_map_view'),
				  
			array('title' => __('Map Zoom','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_map_zoom',
				  'default' => '7'),
				  
			array('title' => __('Show Map Pin','ux'),
				  'description' => '',
				  'type' => 'switch',
				  'name' => 'module_switch_map_pin')
				  
		)
	),
	array(
		'id' => 'price',
		'name' => __('Price','ux'),
		'icon' => 'pricetable_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Currency','ux'),
				  'description' => __('Enter the Currency Symbol','ux'),
				  'type' => 'input_text',
				  'name' => 'module_select_price_currency',
				  'unit' => __('$','ux')),
				  
			array('title' => __('Runtime','ux'),
				  'description' => __('Enter the runtime, e.g. per month','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_price_runtime'),
				  
			array('type' => 'line'),
				  
			array('title' => __('Add Item','ux'),
				  'description' => __('Press the "Add" button to add a price card','ux'),
				  'type' => 'list_item',
				  'name' => 'module_lists_layout'),
				  
			array('title' => __('Color','ux'),
				  'description' => __('Select a color for the price card','ux'),
				  'type' => 'background_color',
				  'name' => 'module_background_color'),
				  
			array('title' => __('Title','ux'),
				  'description' => __('Enter the name of this product, it would be placed on the top of the card.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_title'),
				  
			array('title' => __('Price','ux'),
				  'description' => __('Enter the price of this product.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_price'),
				  
			array('title' => __('Details','ux'),
				  'description' => __('Press "Add" button to add detail items','ux'),
				  'type' => 'details_item',
				  'name' => 'module_details_item'),
				  
			array('title' => __('Button Text','ux'),
				  'description' => __('Enter the text you want to show on button, e.g. Buy Now!','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_button_text'),
				  
			array('title' => __('Button Link','ux'),
				  'description' => __('Enter the link for this button','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_button_link')
				  
		)
	),
	array(
		'id' => 'slider',
		'name' => __('Slider','ux'),
		'icon' => 'slider_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Slider Type','ux'),
				  'description' => __('Select the slider type','ux'),
				  'type' => 'select',
				  'name' => 'module_select_slider_image'),
				  
			array('title' => __('LayerSlider Alias','ux'),
				  'description' => __('The right hand dropdown menu would be enabled after you have create at least 1 slider by LayerSlider plugin.','ux'),
				  'type' => 'select',
				  'name' => 'module_select_layer_slider'),
				  
			array('title' => __('Revolution Slider Alias  ','ux'),
				  'description' => __('Descriptions','ux'),
				  'type' => 'select',
				  'name' => 'module_select_revolution_slider'),
				  
			array('title' => __('Category','ux'),
				  'description' => __('The post under the category you selected would be shown in this slider.','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category'),
				  
			array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules to show.','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby'),
				  
			array('title' => __('Number to Show','ux'),
				  'description' => __('How many posts(slides) you want to show in the slider.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_per_page'),
				  
			array('title' => __('Animation','ux'),
				  'description' => __('Choose an animation effect for the slider','ux'),
				  'type' => 'select',
				  'name' => 'module_select_flexslider_animation'),
				  
			array('title' => __('Show Navigation Hint(dot)','ux'),
				  'description' => __('Turn on if you want to show the Nav Hint','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_navigation_hint'),
				  
			array('title' => __('Show Previous/Next Button','ux'),
				  'description' => __('Turn on if you want to show the Nav Button','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_previous_next'),
				  
			array('title' => __('Speed (second)','ux'),
				  'description' => __('Enter a speed for the animation','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_speed_second')
				  
		)
	),
	array(
		'id' => 'progress_bar',
		'name' => __('Info-graphic','ux'),
		'icon' => 'progressbar_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Type','ux'),
				  'description' => __('Choose a info-graphic type','ux'),
				  'type' => 'select',
				  'name' => 'module_select_infographic_type'),
			
			array('title' => __('Style','ux'),
				  'description' => __('Choose a style for the pie','ux'),
				  'type' => 'select',
				  'name' => 'module_select_infographic_style'),
				  
			array('title' => __('Digit','ux'),
				  'description' => __('Enter the number','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_infographic_digit'),
			
			array('title' => __('Columns','ux'),
				  'description' => '',
				  'type' => 'list_item',
				  'name' => 'module_lists_layout'),
				  
			array('title' => __('Percent','ux'),
				  'description' => __('Enter the percentage data for this item.','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_progress',
				  'unit' => __('%','ux')),
			
			array('title' => __('Title','ux'),
				  'description' => __('Title for this item','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_title'),
				  
			array('title' => __('Subtitle','ux'),
				  'description' => __('Subtitle for this item','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_subtitle'),
				  
			array('title' => __('Icon','ux'),
				  'description' => '',
				  'type' => 'icon',
				  'name' => 'module_select_icon'),
				  
			array('title' => __('Number of Icons','ux'),
				  'description' => __('How many icons you want to show in this module','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_number_icons'),
				  
			array('title' => __('Number of Active Icons','ux'),
				  'description' => __('How many icons should be highlighted','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_number_active_icons'),
				  
			array('title' => array(
					  __('Percentage Color','ux'),
					  __('Active Icons Color','ux'),
					  __('Number Color','ux')),
				  'description' => __('Color for activated part','ux'),
				  'type' => 'background_color',
				  'name' => 'module_background_color'),
				  
			array('title' => __('Show Background Color','ux'),
				  'description' => __('Enable it to show background color','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_show_background_color')
				  
		)
	),
	array(
		'id' => 'fullwidth',
		'name' => __('Fullwidth Wrap','ux'),
		'icon' => '',
		'display' => 'none',
		'item' =>  array(
			
			array('title' => __('Height','ux'),
				  'description' => '',
				  'type' => 'input_text',
				  'name' => 'module_input_fullwidth_height',
				  'unit' => __('px','ux')),
				  
			array('title' => __('Background','ux'),
				  'description' => '',
				  'type' => 'select',
				  'name' => 'module_select_background'),
				  
			array('title' => __('Background Color','ux'),
				  'description' => '',
				  'type' => 'background_color',
				  'name' => 'module_background_color',
				  'bind_type' => 'color',
				  'bind_name' => 'module_background_color_rgb'),
				  
			array('title' => __('Background Image','ux'),
				  'description' => '',
				  'type' => 'image',
				  'name' => 'module_image_single'),
				  
			array('title' => __('Background Image Attachment','ux'),
				  'description' => __('The fixed is not supported touch device. If you use "Fixed" option, the backgorund image size is larger than 1500px * 1500px','ux'),
				  'type' => 'select',
				  'name' => 'module_select_background_attachment'),
				  
			array('title' => __('Parallax Ratio','ux'),
				  'description' => '',
				  'type' => 'select',
				  'name' => 'module_select_parallax_ratio'),
				  
			array('title' => __('Show Shadow','ux'),
				  'description' => '',
				  'type' => 'switch',
				  'name' => 'module_switch_shadow',
				  'default' => 'false'),
				  
			array('title' => __('Shift Text Color for Dark Background','ux'),
				  'description' => '',
				  'type' => 'switch',
				  'name' => 'module_switch_dark_background',
				  'default' => 'false'),
				  
			array('title' => '',
				  'description' => '',
				  'type' => 'cheak',
				  'name' => 'module_cheak_dark_background'),
				  
			array('title' => __('Fit Content to Fullwidth','ux'),
				  'description' => __('Content would fit to content container by default, turn on this option the content would fit to fullwidth of the page','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_fullwidth_fit',
				  'default' => 'false'),
				  
			array('title' => __('Show Top Spacer','ux'),
				  'description' => __('Show 40 pixel hight spacer on the top of wrap','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_spacer_top',
				  'default' => 'false'),
				  
			array('title' => __('Show Bottom Spacer','ux'),
				  'description' => __('Show 40 pixel hight spacer on the bottom of wrap','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_spacer_bottom',
				  'default' => 'false'),
				  
			array('title' => __('Show Module via Tab','ux'),
				  'description' => '',
				  'type' => 'switch',
				  'name' => 'module_switch_via_tab',
				  'default' => 'false'),
				  
			array('title' => '',
				  'description' => '',
				  'type' => 'tabs',
				  'name' => 'module_tabs_fullwidth')
				  
		)
	),
	array(
		'id' => 'count_down',
		'name' => __('Count Down','ux'),
		'icon' => 'countdown_icon',
		'display' => 'block',
		'item' =>  array(
			
			array('title' => __('Date','ux'),
				  'description' => __('Select a deadline for the counter','ux'),
				  'type' => 'date',
				  'name' => 'module_date_time'),
				  
			array('title' => __('Count Start','ux'),
				  'description' => __('Choose a start time unit','ux'),
				  'type' => 'select',
				  'name' => 'module_select_count_start'),
				  
			array('title' => __('Count To','ux'),
				  'description' => __('Choose a end time unit','ux'),
				  'type' => 'select',
				  'name' => 'module_select_count_to')
		
		)
	)
);

function ux_module_fields(){
	global $module_fields;
	$module_fields = apply_filters('pagebuilder_module_fields', $module_fields);
	return $module_fields;
}

/*
============================================================================
	*
	* Pagebuilder container print
	*
============================================================================	
*/
function CustomWrapItemContainer($num, $width, $key, $module_fields){
	global $wrap_fields;
	
	$item_value = explode(" ",$width);
	$item_title = $wrap_fields[$item_value[0]];
	
	if($key != 'n'){
		
		$pagebuilder_item_module_id = get_post_meta($key, 'pagebuilder_item_module_id', true);
		$pagebuilder_item_module_post = get_post_meta($key, 'pagebuilder_item_module_post', true);
		$pagebuilder_item_module_post_id = get_post_meta($key, 'pagebuilder_item_module_post_id', true);
		
		$item_module_id = explode("'%_%'", $pagebuilder_item_module_id);
		$item_module_post = explode("'%_%'", $pagebuilder_item_module_post);
		$item_module_post_id = explode("'%_%'", $pagebuilder_item_module_post_id);
		
	}else{
		
		$item_module_id = ux_custom_meta('pagebuilder_item_module_id');
		$item_module_post = ux_custom_meta('pagebuilder_item_module_post');
		$item_module_post_id = ux_custom_meta('pagebuilder_item_module_post_id');
		
	}
	
	if($item_module_id[$num] != '-1'):
	?>
    
    <div class="pagebuilder_wrap_item <?php echo $width; ?> module_item" data-width="<?php echo $item_value[0]; ?>">
        <input type="hidden" class="item_sort" name="pagebuilder_item_sort[]" value="<?php echo $num; ?>" />
        <input type="hidden" class="item_width" name="pagebuilder_item_width[]" value="<?php echo $width; ?>" />
        <input type="hidden" class="item_module_id" name="pagebuilder_item_module_id[]" value="<?php echo $item_module_id[$num]; ?>" />
        <input type="hidden" class="item_module_post set_module_post" name="pagebuilder_item_module_post[]" value="<?php echo $item_module_post[$num]; ?>" />
        <input type="hidden" class="item_module_post_id set_post_id" name="pagebuilder_item_module_post_id[]" value="<?php echo $item_module_post_id[$num]; ?>" />
        <div class="pagebuilder_wrap_item_module">
            <div class="pagebuilder_wrap_item_module_title">
                <a class="item_increase item_module_click item_click" href="#"></a>
                <a class="item_reduce item_module_click item_click" href="#"></a>
            </div>
            <div class="pagebuilder_wrap_item_module_name sort_over_title">
                <span class="item_title">
                <?php 
				foreach($module_fields as $field){
					if($field['id'] == $item_module_id[$num]){
						echo $field['name'];
					}
				}?>
                </span>
                <span class="item_subtitle"><?php echo $item_title; ?></span>
            </div>
            <div class="pagebuilder_wrap_item_module_ctrl">
                <a class="module_copy item_module_click item_click" href="#"></a>
                <a class="module_remove item_click" href="#"></a>
                <a class="module_edit item_module_click item_click" href="#"><?php _e('Edit','ux');?></a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <?php else: ?>
    
    <div class="pagebuilder_wrap_item warp_item <?php echo $width; ?>" data-width="<?php echo $item_value[0]; ?>">
        <input type="hidden" class="item_sort" name="pagebuilder_item_sort[]" value="<?php echo $num; ?>" />
        <input type="hidden" class="item_width" name="pagebuilder_item_width[]" value="<?php echo $width; ?>" />
        <input type="hidden" class="item_module_id" name="pagebuilder_item_module_id[]" value="<?php echo $item_module_id[$num]; ?>" />
        <input type="hidden" class="item_module_post set_module_post" name="pagebuilder_item_module_post[]" value="<?php echo $item_module_post[$num]; ?>" />
        <input type="hidden" class="item_module_post_id set_post_id" name="pagebuilder_item_module_post_id[]" value="<?php echo $item_module_post_id[$num]; ?>" />
        <div class="pagebuilder_wrap_item_title sort_over_title">
            <?php if($item_module_post_id[$num] == '-1'): ?>
            <a class="item_increase item_click" href="#"></a>
            <a class="item_reduce item_click" href="#"></a>
            <a class="item_module item_click" href="#"><?php _e('+ Module','ux');?></a>
            <a class="item_delete item_click" href="#"></a>
            <span class="item_subtitle"><?php echo $item_title; ?></span>
            <div class="clear"></div>
            
            <?php else: ?>
            <div class="fullwidth_setting">
                <a class="item_module item_click" href="#"><?php _e('+ Module','ux');?></a>
                <a class="item_setting module_edit item_module_click item_click" href="#"><?php _e('Setting','ux');?></a>
            </div>
            <a class="item_delete item_click" href="#"></a>
            <span class="item_subtitle"><?php _e('Fullwidth Wrap','ux');?></span>
            <?php endif; ?>
            
        </div>
        <div class="pagebuilder_wrap_item_content module_connect">
			<?php 
			if($key != 'n'){
				$pagebuilder_module_parent = get_post_meta($key, 'pagebuilder_module_parent', true);
				$module_parent = explode("'%_%'", $pagebuilder_module_parent);
			
				if($pagebuilder_module_parent){  
					$i = 0;
					for($i=0; $i < count($module_parent) - 1; $i++){
						if($num == $module_parent[$i]){
							CustomWrapModuleContainer($i, $module_parent[$i], $key, $module_fields);
						}
					}
				}
			}else{
				if(ux_custom_meta('pagebuilder_module_parent') != ''){  
					foreach(ux_custom_meta('pagebuilder_module_parent') as $a => $parent_id){
						if($num == $parent_id){
							CustomWrapModuleContainer($a, $parent_id, 'n', $module_fields); 
						}
					}
				}
			}
			?>
        </div>
    </div>
    
    <?php endif; ?>
<?php
}

/*
============================================================================
	*
	* Pagebuilder module container print
	*
============================================================================	
*/
function CustomWrapModuleContainer($a, $parent_id, $key, $module_fields){
	global $wrap_fields;
	
	if($key != 'n'){
		
		$pagebuilder_module_width = get_post_meta($key, 'pagebuilder_module_width', true);
		$pagebuilder_module_id = get_post_meta($key, 'pagebuilder_module_id', true);
		$pagebuilder_module_post = get_post_meta($key, 'pagebuilder_module_post', true);
		$pagebuilder_module_post_id = get_post_meta($key, 'pagebuilder_module_post_id', true);
		
		$module_widths = explode("'%_%'", $pagebuilder_module_width);
		$module_id = explode("'%_%'", $pagebuilder_module_id);
		$module_post = explode("'%_%'", $pagebuilder_module_post);
		$module_post_id = explode("'%_%'", $pagebuilder_module_post_id);
		
	}else{
		
		$module_widths = ux_custom_meta('pagebuilder_module_width');
		$module_id = ux_custom_meta('pagebuilder_module_id');
		$module_post = ux_custom_meta('pagebuilder_module_post');
		$module_post_id = ux_custom_meta('pagebuilder_module_post_id');
		
	}
	
	$module_width = explode(" ", $module_widths[$a]);
	$module_title = $wrap_fields[$module_width[0]];
	
	?>
    <div class="pagebuilder_wrap_item <?php echo $module_widths[$a]; ?> module_item" data-width="<?php echo $module_width[0]; ?>">
        <input type="hidden" class="module_id" name="pagebuilder_module_id[]" value="<?php echo $module_id[$a]; ?>" />
        <input type="hidden" class="module_width" name="pagebuilder_module_width[]" value="<?php echo $module_widths[$a]; ?>" />
        <input type="hidden" class="module_parent" name="pagebuilder_module_parent[]" value="<?php echo $parent_id; ?>" />
        <input type="hidden" class="module_post set_module_post" name="pagebuilder_module_post[]" value="<?php echo $module_post[$a]; ?>" />
        <input type="hidden" class="module_post_id set_post_id" name="pagebuilder_module_post_id[]" value="<?php echo $module_post_id[$a]; ?>" />
        <div class="pagebuilder_wrap_item_module">
            <div class="pagebuilder_wrap_item_module_title">
                <a class="item_increase module_click item_click" href="#"></a>
                <a class="item_reduce module_click item_click" href="#"></a>
            </div>
            <div class="pagebuilder_wrap_item_module_name sort_over_title">
                <span class="item_title">
                <?php 
				foreach($module_fields as $field){
					if($field['id'] == $module_id[$a]){
						echo $field['name'];
					}
				}?>
                </span>
                <span class="item_subtitle"><?php echo $module_title; ?></span>
            </div>
            <div class="pagebuilder_wrap_item_module_ctrl">
                <a class="module_copy module_click item_click" href="#"></a>
                <a class="module_remove item_click" href="#"></a>
                <a class="module_edit module_click item_click" href="#"><?php _e('Edit','ux');?></a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php
}
?>
