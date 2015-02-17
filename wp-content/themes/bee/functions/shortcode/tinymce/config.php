<?php
/*-----------------------------------------------------------------------------------*/
/*	Default Options
/*-----------------------------------------------------------------------------------*/

// Number of posts array
function ux_shortcodes_range ( $range, $all = true, $default = false, $range_start = 1 ) {
	if($all) {
		$number_of_posts['-1'] = 'All';
	}

	if($default) {
		$number_of_posts[''] = 'Default';
	}

	foreach(range($range_start, $range) as $number) {
		$number_of_posts[$number] = $number;
	}

	return $number_of_posts;
}

// Taxonomies
function ux_shortcodes_categories ( $taxonomy, $empty_choice = false ) {
	if($empty_choice == true) {
		$post_categories[''] = 'Default';
	}

	$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);

	if( ! array_key_exists('errors', $get_categories) ) {
		if( $get_categories && is_array($get_categories) ) {
			foreach ( $get_categories as $cat ) {
				$post_categories[$cat->slug] = $cat->name;
			}
		}

		if(isset($post_categories)) {
			return $post_categories;
		}
	}
}

$choices = array('yes' => 'Yes', 'no' => 'No');
$reverse_choices = array('no' => 'No', 'yes' => 'Yes');
$dec_numbers = array('0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' );

// Fontawesome icons list
//$pattern = '/\.(icon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
//$fontawesome_path = UX_TINYMCE_DIR . '/css/font-awesome.css';
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path =  get_template_directory().'/functions/theme/css/font-awesome.min.css';
if( file_exists( $fontawesome_path ) ) {
	@$subject = file_get_contents($fontawesome_path);
}

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
	$icons[$match[1]] = $match[2];
}

$checklist_icons = array ( 'icon-check' => '\f00c', 'icon-star' => '\f006', 'icon-angle-right' => '\f105', 'icon-asterisk' => '\f069', 'icon-remove' => '\f00d', 'icon-plus' => '\f067' );

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Selection Config
/*-----------------------------------------------------------------------------------*/

$ux_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '',
	'popup_title' => ''
);


// Buttons shortcode config
$ux_shortcodes['button'] = array(
	'params' => array(
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Text', 'ux'),
			'desc' => __('Add the button\'s text', 'ux'),
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Link', 'ux'),
			'desc' => __('Add the button\'s url eg http://example.com', 'ux')
		),
		'color' => array(
			'type' => 'select',
			'label' => __('Color', 'ux'),
			'desc' => __('Select the button\'s colour', 'ux'),
			'options' => array(
				'bg-theme-color-1' => 'LightCoral',
				'bg-theme-color-2' => 'MediumPurple ',
				'bg-theme-color-3' =>'Pink',
				'bg-theme-color-4' => 'LightSkyBlue ',
				'bg-theme-color-5' => 'Darkblue',
				'bg-theme-color-6' => 'Grey',
				'bg-theme-color-7' => 'Green',
				'bg-theme-color-8' => 'Gold',
				'bg-theme-color-9' => 'LightSienna ',
				'bg-theme-color-10' =>'DarkGrey'
			)
		)
	),
	'shortcode' => '[button link="{{link}}" color="{{color}}"] {{content}} [/button]',
	'popup_title' => __('Insert Button Shortcode', 'ux')
);
// Maps shortcode config
$ux_shortcodes['map'] = array(
	'params' => array(
		'location' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Location<br>(Lat/Lng)', 'ux'),
			'desc' => __('Link to your map. Visit <a href="http://maps.google.com/" target="_blank">Google maps</a> find your address and then click "Link" button to obtain your map link.<br>You need to get your location Lat/Lng in this page', 'ux')
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width', 'ux'),
			'desc' => __('Add the Maps\'s width eg 90%', 'ux')
		),
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Height', 'ux'),
			'desc' => __('Add the Maps\'s height eg 300px', 'ux')
		)
		
	),
	'no_preview' => true,
	'shortcode' => '[map width="{{width}}" height="{{height}}" location="{{location}}"][/map]',
	'popup_title' => __('Insert Google Maps Shortcode', 'ux')
);

// Dropcap
$ux_shortcodes['dropcap'] = array(
	'params' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Letter', 'ux'),
			'desc' => '',
			)
	),
	'shortcode' => '[dropcap]{{content}}[/dropcap]',
	'popup_title' => __('Insert First Letter Shortcode', 'ux')
);

// Icon
$ux_shortcodes['icon'] = array(
	'params' => array(
		'content' => array(
			'std' => 'check',
			'type' => 'select',
			'options' => array(
				'check' => 'check',
				'close' => 'close',
				'play1' => 'play',
				'dot' => 'dot',
				'dot-large' => 'dot-large',
				'ring' => 'ring',
				'star-full' => 'star-full',
				'star-stroke' => 'star-stroke',
				'point-left' => 'point-left',
				'point-right' => 'point-right',
				'point-up' => 'point-up',
				'point-down' => 'point-down',
				'pt-video' => 'video-post',
				'pt-standard' => 'standard-post',
				'pt-quote' => 'quote-post',
				'pt-portfolio' => 'portfolio-post',
				'pt-link' => 'link-post',
				'pt-image' => 'image-post',
				'pt-audio' => 'audio-post',
				'more' => 'more',
				'left-dir' => 'left-dir',
				'right-dir' => 'right-dir',
				'up-dir' => 'up-dir',
				'down-dir' => 'down-dir',
				'angle-left' => 'angle-left',
				'angle-right' => 'angle-right',
				'angle-up' => 'angle-up',
				'angle-down' => 'angle-down',
				'up-arrow' => 'up-arrow',
				'down-arrow' => 'down-arrow',
				'left-arrow' => 'left-arrow',
				'right-arrow' => 'right-arrow',
				'left-arrow-curved' => 'left-arrow-curved',
				'right-arrow-curved' => 'right-arrow-curved',
				'downleft-arrow-curved' => 'downleft-arrow-curved',
				'downright-arrow-curved' => 'downright-arrow-curved',
				'close-thin' => 'close-thin',
				'people-female' => 'people-female',
				'people-male' => 'people-male',
				'coffee1' => 'coffee1',
				'heart' => 'heart',
				'spade' => 'spade',
				'club' => 'club',
				'diamond' => 'diamond',
				'water' => 'water',
				'lab' => 'lab',
				'grid' => 'grid',
				'history' => 'history',
				'check-circle' => 'check-circle',
				'heart-circle' => 'heart-circle',
				'left-circle' => 'left-circle',
				'right-circle' => 'right-circle',
				'close-circle' => 'close-circle',
				'alert-circle' => 'alert-circle',
				'plus-circle' => 'plus-circle',
				'minus-circle' => 'minus-circle',
				'help-circle' => 'help-circle',
				'info-circle' => 'info-circle',
				'alert' => 'alert',
				'coffee' => 'coffee',
				'html5-fill' => 'html5-fill',
				'css3-fill' => 'css3-fill',
				'chrome' => 'chrome',
				'setting' => 'setting',
				'cloud-down' => 'cloud-down',
				'cloud-up' => 'cloud-up',
				'settings' => 'settings',
				'help' => 'help',
				'pc' => 'pc',
				'ipod' => 'ipod',
				'book' => 'book',
				'user' => 'user',
				'users' => 'users',
				'shopping-cart' => 'shopping-cart',
				'resize-small' => 'resize-small',
				'resize-full' => 'resize-full',
				'umbrella' => 'umbrella',
				'menu' => 'menu',
				'comment' => 'comment',
				'chat' => 'chat',
				'calendar' => 'calendar',
				'tel' => 'tel',
				'location' => 'location',
				'at' => 'at',
				'camera' => 'camera',
				'eye' => 'eye',
				'email' => 'email',
				'airplane' => 'airplane',
				'link' => 'link',
				'tag' => 'tag',
				'scissors' => 'scissors',
				'wifi' => 'wifi',
				'music' => 'music',
				'food' => 'food',
				'image' => 'image',
				'trash' => 'trash',
				'volume' => 'volume',
				'volume-off' => 'volume-off',
				'quote-right' => 'quote-right',
				'quote-left' => 'quote-left',
				'social-youtube' => 'social-youtube',
				'social-wp' => 'social-wordpress',
				'social-vimeo' => 'social-vimeo',
				'social-twitter' => 'social-twitter',
				'social-tumblr' => 'social-tumblr',
				'social-stumbleupon' => 'social-stumbleupon',
				'social-rss' => 'social-rss',
				'social-pinterest' => 'social-pinterest',
				'social-linkedin' => 'social-linkedin',
				'social-lastfm' => 'social-lastfm',
				'social-instagram' => 'social-instagram',
				'social-googleplus' => 'social-googleplus',
				'social-git' => 'social-github',
				'social-forrst' => 'social-forrst',
				'social-flickr' => 'social-flickr',
				'social-facebook' => 'social-facebook',
				'social-email' => 'social-email',
				'social-dribbble' => 'social-dribbble',
				'social-deviantart' => 'social-deviantart',
				'social-blogger' => 'social-blogger',
				'image-view' => 'image-view',
				'image-readmore' => 'image-readmore',
				'goback1' => 'goback1',
				'goback2' => 'goback2',
				'edit' => 'edit',
				'data' => 'data',
				'sun-fill' => 'sun-fill',
				'sun-stroke' => 'sun-stroke',
				'weather-rain' => 'weather-rain',
				'weather-cloud' => 'weather-cloud',
				'forum-question' => 'question',
				'forum-repairing' => 'repairing',
				'forum-done' => 'done',
				'forum-locked' => 'locked',
				'forum-top' => 'top'
				
			),
			'label' => __('Select icon', 'ux'),
			'desc' => __('Add the icon', 'ux'),
		),
			'size' => array(
				'std' => 'medium',
				'type' => 'select',
				'label' => __('Size', 'ux'),
				'options' => array(
					'small' => 'small',
					'medium' => 'medium',
					'big' => 'big'
					)
			)
		
	),
	'shortcode' => '[icon size="{{size}}"]{{content}}[/icon]',
	'popup_title' => __('Insert Face Shortcode', 'ux')
);

// Social shortcode config
$ux_shortcodes['social'] = array(
	'params' => array(
		'social_type' => array(
			'std' => 'crying',
			'type' => 'select',
			'options' => array(
				'facebook' => 'Facebook',
				'twitter' => 'Twitter',
				'google_plus' => 'Google Plus',
				'youtube' => 'Youtube',
				'flickr' => 'Flickr',
				'vimeo' => 'Vimeo',
				'linkedin' => 'LinkedIn',
				'trumblr' => 'Trumblr',
				'forst' => 'Forst',
				'dribbble' => 'Dribbble',
				'pinterest' =>'Pinterest',
				'instagram' =>'Instagram',
				'skype' =>'Skype',
				'tumblr' => 'Tumblr',
				'github' =>'Github',
				'rss' => 'RSS'
			),
			'label' => __('Please select the type', 'ux'),
			'desc' => '',
		),
		 'social_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Link', 'ux'),
			'desc' => __('Please enter the url, e.g. http://www.facebook.com/your-facebook-name', 'ux')
			)
		
	),
	'shortcode' => '[social social_type="{{social_type}}" social_link="{{social_link}}"][/social]',
	'popup_title' => __('Insert Face Shortcode', 'ux')
);

// Message box shortcode config
$ux_shortcodes['mbox'] = array(
	'params' => array(
		'color' => array(
			'type' => 'select',
			'label' => __('Color', 'ux'),
			'desc' => __('Select the Message box\'s colour', 'ux'),
			'options' => array(
				'blue' => 'Blue',
				'red' => 'Red',
				'orange' => 'Orange',
				'green' => 'Green'
			)
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width', 'ux'),
			'desc' => __('Add the Message box\'s width eg 95%', 'ux')
		),
		'content' => array(
			'std' => 'Message box text',
			'type' => 'textarea',
			'label' => __('Message box\'s Text', 'ux'),
			'desc' => __('Add the Message box\'s text', 'ux'),
		)
		
	),
	'shortcode' => '[mbox width="{{width}}" color="{{color}}"] {{content}} [/mbox]',
	'popup_title' => __('Insert Message box Shortcode', 'ux')
);

// Contact Form shortcode config
$ux_shortcodes['contactform'] = array(
	'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Title', 'ux'),
			'desc' =>__('The shortcode only works in page', 'ux')
		),	
		'name' => array(
			'std' => 'Name',
			'type' => 'text',
			'label' => __('Name Box', 'ux'),
			'desc' =>''
		),
		'email' => array(
			'std' => 'Email',
			'type' => 'text',
			'label' => __('Email Box', 'ux'),
			'desc' => ''
		),
		'button' => array(
			'std' => 'Send',
			'type' => 'text',
			'label' => __('Button', 'ux'),
			'desc' => ''
		)
		
	),
	'no_preview' => true,
	'shortcode' => '[form title="{{title}}" name="{{name}}" email="{{email}}" button="{{button}}"][/form]',
	'popup_title' => __('Insert Contact Form Shortcode (The shortcode only works in page)', 'ux')
);
// Image border shortcode config
$ux_shortcodes['imageborder'] = array(
	'params' => array(
		'img' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image URL', 'ux'),
			'desc' => __('Add the image\'s url', 'ux'),
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width', 'ux'),
			'desc' => __('Add the image\'s width eg 95%', 'ux')
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Border Style', 'ux'),
			'desc' => __('Select the border\'s style', 'ux'),
			'options' => array(
				'style1' => 'Style 1',
				'style2' => 'Style 2',
				'style3' => 'Style 3'
			)
		),
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image Name', 'ux'),
			'desc' => __('Add the image\'s name', 'ux'),
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image Link URL', 'ux'),
			'desc' => __('Add the image\'s link url, It\'s optional.', 'ux'),
		)
		
	),
	'shortcode' => '[imageborder  img="{{img}}" style="{{style}}" width="{{width}}"]',
	'popup_title' => __('Insert Image Border Shortcode', 'ux')
);
// Image round
$ux_shortcodes['round'] = array(
	'params' => array(
		'img' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image URL', 'ux'),
			'desc' => __('Add the image\'s url', 'ux'),
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Link', 'ux'),
			'desc' => '',
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width', 'ux'),
			'desc' => __('Add the image\'s width eg 140', 'ux')
		),
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Height', 'ux'),
			'desc' => __('Add the image\'s height eg 140', 'ux')
		),
		'align' => array(
			'type' => 'select',
			'label' => __('Align', 'ux'),
			'desc' => '',
			'options' => array(
				'center' => 'Center',
				'left' => 'Left'
			)
		),
		'radius' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Radius', 'ux'),
			'desc' => __('Add the image\'s radius eg 70', 'ux')
		)
		
	),
	'shortcode' => '[round  img="{{img}}" link="{{link}}" radius="{{radius}}" width="{{width}}" height="{{height}}" align="{{align}}"]',
	'popup_title' => __('Insert Image Round shortcode', 'ux')
);
// Lines shortcode config
$ux_shortcodes['line'] = array(
	'params' => array(
		'color' => array(
			'type' => 'select',
			'label' => __('Color', 'ux'),
			'desc' => __('Select the Line\'s colour', 'ux'),
			'options' => array(
				'blue' => 'Blue',
				'red' => 'Red',
				'pink' => 'Pink',
				'green' => 'Green',
				'brown' => 'Brown',
				'grey' => 'Grey',
				'dark' => 'Dark',
				'black' => 'Black'
			)
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Style', 'ux'),
			'desc' => __('Select the Line\'s type', 'ux'),
			'options' => array(
				'solid' => 'Solid',
				'dot' => 'Dot',
				'dashed' => 'Dashed'
			)
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width', 'ux'),
			'desc' => __('Add the Line\'s width eg 95%', 'ux')
		)
	),
	'shortcode' => '[line width="{{width}}" color="{{color}}" style="{{style}}"] ',
	'popup_title' => __('Insert Line Shortcode', 'ux')
);


// Toggle content shortcode config
$ux_shortcodes['toggle'] = array(
'params' => array(),
	'shortcode' => ' {{child_shortcode}} ',
	'no_preview' => true,
	'popup_title' => __('Insert Toggle Content Shortcode', 'ux'),
	'child_shortcode' => array(
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => __('Toggle Content Title', 'ux'),
			'desc' => __('Add the title that will go above the toggle content', 'ux'),
			'std' => 'Title'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => __('Toggle Content', 'ux'),
			'desc' => __('Add the toggle content.', 'ux'),
		)
		
	),
	'shortcode' => '[toggle title="{{title}}"] {{content}} [/toggle]',
	'clone_button' => __('Add New', 'eandc')
	)
);

// Columns
$ux_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Columns Shortcode', 'ux'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'ux'),
				'desc' => __('Select the type, ie width of the column.', 'ux'),
				'options' => array(
					'one_third' => 'One Third',
					'one_third_last' => 'One Third Last',
					'two_third' => 'Two Thirds',
					'two_third_last' => 'Two Thirds Last',
					'one_half' => 'One Half',
					'one_half_last' => 'One Half Last',
					'one_fourth' => 'One Fourth',
					'one_fourth_last' => 'One Fourth Last',
					'three_fourth' => 'Three Fourth',
					'three_fourth_last' => 'Three Fourth Last',
					'one_fifth' => 'One Fifth',
					'one_fifth_last' => 'One Fifth Last',
					'two_fifth' => 'Two Fifth',
					'two_fifth_last' => 'Two Fifth Last',
					'three_fifth' => 'Three Fifth',
					'three_fifth_last' => 'Three Fifth Last',
					'four_fifth' => 'Four Fifth',
					'four_fifth_last' => 'Four Fifth Last',
					'one_sixth' => 'One Sixth',
					'one_sixth_last' => 'One Sixth Last',
					'five_sixth' => 'Five Sixth',
					'five_sixth_last' => 'Five Sixth Last'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'ux'),
				'desc' => __('Add the column content.', 'ux'),
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => __('Add a new Column', 'ux')
	)
);
// Lists


$ux_shortcodes['lists'] = array(
	'params' => array(
		'style' => array(
			'std' => 'check',
			'label' => __('List Icon', 'ux'),
			'type' => 'select',
			'options' => array(
				'check' => 'check',
				'close' => 'close',
				'play1' => 'play',
				'dot' => 'dot',
				'dot-large' => 'dot-large',
				'ring' => 'ring',
				'star-full' => 'star-full',
				'star-stroke' => 'star-stroke',
				'point-left' => 'point-left',
				'point-right' => 'point-right',
				'point-up' => 'point-up',
				'point-down' => 'point-down',
				'pt-video' => 'video-post',
				'pt-standard' => 'standard-post',
				'pt-quote' => 'quote-post',
				'pt-portfolio' => 'portfolio-post',
				'pt-link' => 'link-post',
				'pt-image' => 'image-post',
				'pt-audio' => 'audio-post',
				'more' => 'more',
				'left-dir' => 'left-dir',
				'right-dir' => 'right-dir',
				'up-dir' => 'up-dir',
				'down-dir' => 'down-dir',
				'angle-left' => 'angle-left',
				'angle-right' => 'angle-right',
				'angle-up' => 'angle-up',
				'angle-down' => 'angle-down',
				'up-arrow' => 'up-arrow',
				'down-arrow' => 'down-arrow',
				'left-arrow' => 'left-arrow',
				'right-arrow' => 'right-arrow',
				'left-arrow-curved' => 'left-arrow-curved',
				'right-arrow-curved' => 'right-arrow-curved',
				'downleft-arrow-curved' => 'downleft-arrow-curved',
				'downright-arrow-curved' => 'downright-arrow-curved',
				'close-thin' => 'close-thin',
				'people-female' => 'people-female',
				'people-male' => 'people-male',
				'coffee1' => 'coffee1',
				'heart' => 'heart',
				'spade' => 'spade',
				'club' => 'club',
				'diamond' => 'diamond',
				'water' => 'water',
				'lab' => 'lab',
				'grid' => 'grid',
				'history' => 'history',
				'check-circle' => 'check-circle',
				'heart-circle' => 'heart-circle',
				'left-circle' => 'left-circle',
				'right-circle' => 'right-circle',
				'close-circle' => 'close-circle',
				'alert-circle' => 'alert-circle',
				'plus-circle' => 'plus-circle',
				'minus-circle' => 'minus-circle',
				'help-circle' => 'help-circle',
				'info-circle' => 'info-circle',
				'alert' => 'alert',
				'coffee' => 'coffee',
				'html5-fill' => 'html5-fill',
				'css3-fill' => 'css3-fill',
				'chrome' => 'chrome',
				'setting' => 'setting',
				'cloud-down' => 'cloud-down',
				'cloud-up' => 'cloud-up',
				'settings' => 'settings',
				'help' => 'help',
				'pc' => 'pc',
				'ipod' => 'ipod',
				'book' => 'book',
				'user' => 'user',
				'users' => 'users',
				'shopping-cart' => 'shopping-cart',
				'resize-small' => 'resize-small',
				'resize-full' => 'resize-full',
				'umbrella' => 'umbrella',
				'menu' => 'menu',
				'comment' => 'comment',
				'chat' => 'chat',
				'calendar' => 'calendar',
				'tel' => 'tel',
				'location' => 'location',
				'at' => 'at',
				'camera' => 'camera',
				'eye' => 'eye',
				'email' => 'email',
				'airplane' => 'airplane',
				'link' => 'link',
				'tag' => 'tag',
				'scissors' => 'scissors',
				'wifi' => 'wifi',
				'music' => 'music',
				'food' => 'food',
				'image' => 'image',
				'trash' => 'trash',
				'volume' => 'volume',
				'volume-off' => 'volume-off',
				'quote-right' => 'quote-right',
				'quote-left' => 'quote-left',
				'social-youtube' => 'social-youtube',
				'social-wp' => 'social-wordpress',
				'social-vimeo' => 'social-vimeo',
				'social-twitter' => 'social-twitter',
				'social-tumblr' => 'social-tumblr',
				'social-stumbleupon' => 'social-stumbleupon',
				'social-rss' => 'social-rss',
				'social-pinterest' => 'social-pinterest',
				'social-linkedin' => 'social-linkedin',
				'social-lastfm' => 'social-lastfm',
				'social-instagram' => 'social-instagram',
				'social-googleplus' => 'social-googleplus',
				'social-git' => 'social-github',
				'social-forrst' => 'social-forrst',
				'social-flickr' => 'social-flickr',
				'social-facebook' => 'social-facebook',
				'social-email' => 'social-email',
				'social-dribbble' => 'social-dribbble',
				'social-deviantart' => 'social-deviantart',

				'social-blogger' => 'social-blogger',
				'image-view' => 'image-view',
				'image-readmore' => 'image-readmore',
				'goback1' => 'goback1',
				'goback2' => 'goback2',
				'edit' => 'edit',
				'data' => 'data',
				'sun-fill' => 'sun-fill',
				'sun-stroke' => 'sun-stroke',
				'weather-rain' => 'weather-rain',
				'weather-cloud' => 'weather-cloud',
				'forum-question' => 'question',
				'forum-repairing' => 'repairing',
				'forum-done' => 'done',
				'forum-locked' => 'locked',
				'forum-top' => 'top'
				
			),
			'desc' => __('Add the icon', 'ux')
		),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('List Content', 'ux'),
				'desc' => ''
			)
		
	),
	'shortcode' => '[list style="{{style}}"] {{content}} [/list]',
	'popup_title' => __('Insert Text List Shortcode', 'ux')
);


// Fixed Column
$ux_shortcodes['fixedcolumns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Fixed Columns Shortcode', 'ux'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'width' => array(
				'std' => '300px',
				'type' => 'text',
				'label' => __('Width', 'ux'),
				'desc' => __('e.g. 300px', 'ux')
			),
			'margin_top' => array(
				'std' => '20px',
				'type' => 'text',
				'label' => __('Margin Top', 'ux'),
				'desc' => __('Column spacing on the top, e.g. 20px', 'ux')
			),
			'margin_left' => array(
				'std' => '20px',
				'type' => 'text',
				'label' => __('Margin Left', 'ux'),
				'desc' => __('Column spacing on the left, e.g. 20px', 'ux')
			),
			'margin_bottom' => array(
				'std' => '20px',
				'type' => 'text',
				'label' => __('Margin Bottom', 'ux'),
				'desc' => __('Column spacing on the bottom, e.g. 20px', 'ux')
			),
			'margin_right' => array(
				'std' => '20px',
				'type' => 'text',
				'label' => __('Margin Right', 'ux'),
				'desc' => __('Column spacing on the right, e.g. 20px', 'ux')
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Content', 'ux'),
				'desc' => ''
			)
		),
		'shortcode' => '[fixed_column margin_top="{{margin_top}}"  margin_right="{{margin_right}}" margin_bottom="{{margin_bottom}}" margin_left="{{margin_left}}" width="{{width}}"] {{content}} [/fixed_column] ',
		'clone_button' => __('Add Fixed Columns', 'ux')
	)
);
?>