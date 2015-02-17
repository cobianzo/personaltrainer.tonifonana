<?php
define( 'UX_LOCAL_URL', get_template_directory_uri() );
add_theme_support('post-thumbnails'); 
add_theme_support('post-formats', array('gallery','image','audio','video','quote','link'));
add_theme_support('automatic-feed-links');
add_theme_support('custom-header');
add_theme_support('custom-background');
add_image_size('blog-thumb', 100, 100, true);
add_image_size('imagebox-thumb', 200, 200, true);
add_image_size('standard-blog-thumb', 300, 260, true);
add_image_size('standard-thumb', 600, 9999);
add_image_size('image-thumb', 600, 400, true);
add_image_size('image-thumb-1', 600, 600, true);
add_image_size('image-thumb-2', 400, 600, true);
add_image_size('image2-thumb', 800, 480, true); //Not work
add_image_size('image3-thumb', 800, 9999); //Not work
post_type_supports( 'post', 'comments' );
if ( ! isset( $content_width ) ) $content_width = 1220;

function ux_cheakother(){
	add_editor_style();
	echo posts_nav_link();
}

/*
============================================================================
	*
	* Register theme text domain
	*
============================================================================	
*/  
if(!function_exists('ux_lang_setup')){

	add_action('after_setup_theme', 'ux_lang_setup');
	function ux_lang_setup(){
		$lang = get_template_directory()  . '/languages';
		load_theme_textdomain('ux', $lang);
	}
}
/*
============================================================================
	*
	* Theme Title
	*
============================================================================	
*/  

function ux_custom_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ux' ), max( $paged, $page ) );

	return $title;
}
add_filter('wp_title','ux_custom_title',10, 2 );

/*
============================================================================
	*
	* Get youtube/vimeo ID
	*
============================================================================	
*/ 

function get_you_tube_id($url)
{
	preg_match('#http://w?w?w?.?youtube.com/watch\?v=([A-Za-z0-9\-_]+)#s', $url, $matches);
	return $matches[1];
}
function get_vimeo_id($url)
{
	$matches = parse_url($url);
	$matches = str_replace("/","",$matches['path']);
	return $matches;

}

/*
============================================================================
	*
	* Cutom menu
	*
============================================================================	
*/ 
register_nav_menu( 'primary', 'Primary Menu' );

/*
============================================================================
	*
	* Custom js css
	*
============================================================================	
*/  
function ux_front_scripts(){
	global $wp_styles, $wp_scripts;
	$child_theme_url = get_stylesheet_directory_uri();
	//register js
	wp_register_script( 'bootstrap', UX_LOCAL_URL. '/js/bootstrap.js', array('jquery'), "2.3.1", true );
	wp_register_script( 'jquery-lightbox', UX_LOCAL_URL. '/js/lightbox/jquery.lightbox.min.js', array('jquery'), "1.7.1", true );
	wp_register_script( 'jquery-jplayer', UX_LOCAL_URL. '/js/jquery.jplayer.min.js',array('jquery'),'2.2',true);
	wp_register_script( 'waypoints', UX_LOCAL_URL. '/js/waypoints.min.js', array('jquery'), '1.1.7', true );
	wp_register_script( 'infographic', UX_LOCAL_URL. '/js/infographic.js', array('jquery'), '1.2.0', true );
	wp_register_script( 'pjax', UX_LOCAL_URL. '/js/jquery.pjax.js', array('jquery'), '1.2.0', true );
	wp_register_script( 'jquery-flexslider', UX_LOCAL_URL. '/js/jquery.flexslider-min.js', array('jquery'), '2.2.0', true );
	wp_register_script( 'jquery-main', UX_LOCAL_URL. '/js/main.js', array('jquery'), 1, true );
	wp_register_script( 'jquery-custom-theme', UX_LOCAL_URL. '/js/custom.theme.js', array('jquery'), 1, true );
	wp_register_script( 'jquery-custom-pagebuild', UX_LOCAL_URL. '/js/custom.pagebuild.js', array('jquery'), 1, true );
	wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
	wp_register_script( 'google-map-custom', UX_LOCAL_URL. '/js/google.map.core.js', array('google-map'), 1, true );
	
	if(is_single()){
		wp_register_script( 'jquery-comments-ajax', UX_LOCAL_URL.'/js/comments-ajax.js', 'jquery', "1.3", true);	
		wp_enqueue_script('jquery-comments-ajax');
	}
	
	wp_enqueue_script( 'bootstrap' );
	wp_enqueue_script( 'jquery-lightbox' );
	wp_enqueue_script( 'jquery-jplayer' );
	wp_enqueue_script( 'infographic' );
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_script( 'pjax' );
	wp_enqueue_script( 'jquery-flexslider' );
	wp_enqueue_script( 'jquery-main' );
	wp_enqueue_script( 'jquery-custom-theme' );
	wp_enqueue_script( 'jquery-custom-pagebuild' );
	
	//register styles
	wp_register_style( 'bootstrap', UX_LOCAL_URL. "/styles/bootstrap.css", array(), '1', 'screen' ); 
	wp_register_style( 'jquery-lightbox', UX_LOCAL_URL. "/js/lightbox/themes/default/jquery.lightbox.css", array(), '1', 'screen' ); 
	wp_register_style( 'pagebuild', UX_LOCAL_URL. "/styles/pagebuild.css", array(), '1', 'screen' );  
	wp_register_style( 'custom-style', UX_LOCAL_URL. "/style.css", array(), '1', 'screen' );
	wp_register_style( 'custom-child-style', $child_theme_url. "/style.css", array('custom-style'), '1', 'screen' );
	wp_register_style( 'theme-custom-style', UX_LOCAL_URL. '/functions/theme/theme-style.php', array('custom-style'),'1', 'screen');
	wp_register_style( 'google-fonts-opensans', "http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic", array(), '1', 'screen' ); 
	wp_register_style( 'google-fonts-aladin', "http://fonts.googleapis.com/css?family=Aladin", array(), '1', 'screen' ); 
	wp_register_style( 'google-fonts-roboto', "http://fonts.googleapis.com/css?family=Roboto:400,300,100", array(), '1', 'screen' ); 
	
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'jquery-lightbox' );
	wp_enqueue_style( 'pagebuild' );
	wp_enqueue_style( 'custom-style' );
	if($child_theme_url !=  UX_LOCAL_URL){
		wp_enqueue_style( 'custom-child-style');
	}
	wp_enqueue_style( 'theme-custom-style');
	wp_enqueue_style( 'google-fonts-opensans' );
	wp_enqueue_style( 'google-fonts-aladin' );
	wp_enqueue_style( 'google-fonts-roboto' );
	/*wp_enqueue_style( 'style-ie', get_template_directory_uri() . '/styles/ie.css', array( 'custom-style' ), '20130909' );
	$wp_styles->add_data( 'style-ie', 'conditional', 'lte IE 9' );
	wp_enqueue_style( 'style-ie8', get_template_directory_uri() . '/styles/ie8.css', array( 'custom-style' ), '20130925' );
	$wp_styles->add_data( 'style-ie8', 'conditional', 'lte IE 8' );*/
	global $wpdb, $theme_google_fonts;
	$option_fonts = $wpdb->get_results("
		SELECT DISTINCT `option_value`
		FROM $wpdb->options
		WHERE option_name LIKE '%_family%'" );
	
	if(count($option_fonts) > 0){
		foreach($option_fonts as $font){
			$font_id = $font->option_value;
			$font_url = $theme_google_fonts[$font_id]['url'];
			if(isset($font_url)){
				wp_register_style( 'theme-google-font-'.$font_id, $font_url, array(), '1' ); 
				wp_enqueue_style( 'theme-google-font-'.$font_id );
			}
		}
	}
	
	if(ux_has_module('google_map')){
		wp_enqueue_script('google-map');
		wp_enqueue_script('google-map-custom');
	}

	?>
    <script type="text/javascript">
	var JS_PATH = "<?php echo UX_LOCAL_URL.'/js';?>";
	var AJAX_M = "<?php echo UX_LOCAL_URL.'/functions/functions-ajax-module.php'; ?>";
    </script>
    
<?php   
}
add_action( 'wp_enqueue_scripts', 'ux_front_scripts' );

function ux_front_scripts_ie(){ ?>
	<!-- IE hack
	================================================== -->
	<!--[if lte IE 9]>
	<link rel='stylesheet' id='cssie'  href='<?php echo UX_LOCAL_URL; ?>/styles/ie.css' type='text/css' media='screen' />
	<![endif]-->
	
	<!--[if lt IE 9]>
	<script type="text/javascript" src="<?php echo UX_LOCAL_URL; ?>/js/ie.js"></script>
	<link rel='stylesheet' id='cssie8'  href='<?php echo UX_LOCAL_URL; ?>/styles/ie8.css' type='text/css' media='screen' />
	<![endif]-->
	
	<!--[if lte IE 7]>
	<div style="width: 100%;" class="messagebox_orange">Your browser is obsolete and does not support this webpage. Please use newer version of your browser or visit <a href="http://www.ie6countdown.com/" target="_new">Internet Explorer 6 countdown page</a>  for more information. </div>
	<![endif]-->
<?php	
}
add_action( 'wp_head', 'ux_front_scripts_ie' );
   
/*
============================================================================
	*
	* Bootstrap width
	*
============================================================================	
*/
$bootstrap_width = array(
	'pb_1_1' => 'span12',
	'pb_3_4' => 'span9',
	'pb_2_3' => 'span8',
	'pb_1_2' => 'span6',
	'pb_1_3' => 'span4',
	'pb_1_4' => 'span3'
	

);
/*
============================================================================
	*
	* Define COMMENT
	*
============================================================================	
*/
function idi_cust_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
  	<li class="commlist-unit">
		<div class="avatar"></div><!--END avatar--> 
		<div class="comm-u-wrap">
			<div class="comment-meta">
				<span class="comment-author"><a href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></span>
				<span class="date"><?php echo human_time_diff(get_comment_time('U'), current_time('timestamp'));  _e(" ago","ux"); ?></span>
			</div><!--END comment-mate--> 
			<div class="comment">
				<?php comment_text() ?>
			</div><!--END comment-->
			<span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text'=>__('Reply','ux'),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>		
		</div><!--END comm-u-wrap-->
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation','ux'); ?>.</em></p>
<?php endif; ?>				
<?php 
}
/*
============================================================================
	*
	* Social Networks
	*
============================================================================	
*/
$social_networks = array(
	array(
		'name' => __('Twitter','ux'),
		'icon' => 'm-social-twitter',
		'slug' => 'twitter'
	),
	array(
		'name' => __('Facebook','ux'),
		'icon' => 'm-social-facebook',
		'slug' => 'facebook'
	),
	array(
		'name' => __('LinkedIn','ux'),
		'icon' => 'm-social-linkedin',
		'slug' => 'linkedin'
	),
	array(
		'name' => __('Tumblr','ux'),
		'icon' => 'm-social-tumblr',
		'slug' => 'tumblr'
	),
	array(
		'name' => __('Pinterest','ux'),
		'icon' => 'm-social-pinterest',
		'slug' => 'pinterest'
	),
	array(
		'name' => __('Googleplus','ux'),
		'icon' => 'm-social-googleplus',
		'slug' => 'googleplus'
	),
	array(
		'name' => __('Flickr','ux'),
		'icon' => 'm-social-flickr',
		'slug' => 'flickr'
	),
	array(
		'name' => __('Youtube','ux'),
		'icon' => 'm-social-youtube',
		'slug' => 'youtube'
	),
	array(
		'name' => __('Vimeo','ux'),
		'icon' => 'm-social-vimeo',
		'slug' => 'vimeo'
	),
	array(
		'name' => __('Stumbleupon','ux'),
		'icon' => 'm-social-stumbleupon',
		'slug' => 'stumbleupon'
	),
	array(
		'name' => __('Lastfm','ux'),
		'icon' => 'm-social-lastfm',
		'slug' => 'lastfm'
	),
	array(
		'name' => __('Deviantart','ux'),
		'icon' => 'm-social-deviantart',
		'slug' => 'deviantart'
	),
	array(
		'name' => __('Blogger','ux'),
		'icon' => 'm-social-blogger',
		'slug' => 'blogger'
	),
	array(
		'name' => __('Instagram','ux'),
		'icon' => 'm-social-instagram',
		'slug' => 'instagram'
	),
	array(
		'name' => __('Forrst','ux'),
		'icon' => 'm-social-forrst',
		'slug' => 'forrst'
	),
	array(
		'name' => __('Github','ux'),
		'icon' => 'm-social-git',
		'slug' => 'git'
	),
	array(
		'name' => __('VK','ux'),
		'icon' => 'icon-m-social-vk',
		'slug' => 'vk'
	),
	array(
		'name' => __('Weibo','ux'),
		'icon' => 'icon-m-social-weibo',
		'slug' => 'weibo'
	),
	array(
		'name' => __('Wechat','ux'),
		'icon' => 'icon-m-social-wechat',
		'slug' => 'wechat'
	),
	array(
		'name' => __('Douban','ux'),
		'icon' => 'icon-m-social-douban',
		'slug' => 'douban'
	),
	array(
		'name' => __('Renren','ux'),
		'icon' => 'icon-m-social-renren',
		'slug' => 'renren'
	),
	array(
		'name' => __('Xing','ux'),
		'icon' => 'icon-m-social-xing',
		'slug' => 'xing'
	),
	array(
		'name' => __('Reddit','ux'),
		'icon' => 'icon-m-social-reddit',
		'slug' => 'Reddit'
	),
	array(
		'name' => __('Livejournal','ux'),
		'icon' => 'icon-m-social-livejournal',
		'slug' => 'livejournal'
	),
	array(
		'name' => __('Path','ux'),
		'icon' => 'icon-m-social-path',
		'slug' => 'path'
	),
	array(
		'name' => __('Bebo','ux'),
		'icon' => 'icon-m-social-bebo',
		'slug' => 'bebo'
	),
	array(
		'name' => __('Odnoklassniki','ux'),
		'icon' => 'icon-m-social-odnoklassniki',
		'slug' => 'odnoklassniki'
	),
	array(
		'name' => __('Myspace','ux'),
		'icon' => 'icon-m-social-myspace',
		'slug' => 'myspace'
	),
	array(
		'name' => __('Livejournal','ux'),
		'icon' => 'icon-m-social-livejournal',
		'slug' => 'livejournal'
	),
	array(
		'name' => __('Dribbble','ux'),
		'icon' => 'm-social-dribbble',
		'slug' => 'dribbble'
	
	)
	
);

$option_social_networks = array(
	array(
		'name' => __('Facebook','ux'),
		'icon' => 's-facebook',
		'icon2' => 'm-social-facebook',
		'slug' => 'facebook',
		'dec'  => __('Visit Facebook page','ux')
	),
	array(
		'name' => __('Twitter','ux'),
		'icon' => 's-twitter',
		'icon2' => 'm-social-twitter',
		'slug' => 'twitter',
		'dec'  => __('Visit Twitter page','ux')
	),
	array(
		'name' => __('Google+','ux'),
		'icon' => 's-googleplus',
		'icon2' => 'm-social-googleplus',
		'slug' => 'googleplus',
		'dec'  => __('Visit Google Plus page','ux')
	),
	array(
		'name' => __('Youtube','ux'),
		'icon' => 's-youtube',
		'icon2' => 'm-social-youtube',
		'slug' => 'youtube',
		'dec'  => __('Visit Youtube page','ux')
	),
	array(
		'name' => __('Vimeo','ux'),
		'icon' => 's-vimeo',
		'icon2' => 'm-social-vimeo',
		'slug' => 'vimeo',
		'dec'  => __('Visit Vimeo page','ux')
	),
	array(
		'name' => __('Tumblr','ux'),
		'icon' => 's-tumblr',
		'icon2' => 'm-social-tumblr',
		'slug' => 'tumblr',
		'dec'  => __('Visit Tumblr page','ux')
	),
	array(
		'name' => __('RSS','ux'),
		'icon' => 's-rss',
		'icon2' => 'm-social-rss',
		'slug' => 'rss',
		'dec'  => __('Visit Rss','ux')
	),
	array(
		'name' => __('Pinterest','ux'),
		'icon' => 's-pinterest',
		'icon2' => 'm-social-pinterest',
		'slug' => 'pinterest',
		'dec'  => __('Visit Pinterest page','ux')
	),
	array(
		'name' => __('Linkedin','ux'),
		'icon' => 's-linkedin',
		'icon2' => 'm-social-linkedin',
		'slug' => 'linkedin',
		'dec'  => __('Visit Linkedin page','ux')
	),
	array(
		'name' => __('Instagram','ux'),
		'icon' => 's-instagram',
		'icon2' => 'm-social-instagram',
		'slug' => 'instagram',
		'dec'  => __('Visit Instagram page','ux')
	),
	array(
		'name' => __('Github','ux'),
		'icon' => 's-git',
		'icon2' => 'm-social-git',
		'slug' => 'github',
		'dec'  => __('Visit Github page','ux')
	),
	array(
		'name' => __('Forrst','ux'),
		'icon' => 's-forrst',
		'icon2' => 'm-social-forrst',
		'slug' => 'forrst',
		'dec'  => __('Visit Forrst page','ux')
	),
	array(
		'name' => __('Flickr','ux'),
		'icon' => 's-flickr',
		'icon2' => 'm-social-flickr',
		'slug' => 'flickr',
		'dec'  => __('Visit Flickr page','ux')
	),
	array(
		'name' => __('Livejournal','ux'),
		'icon' => 'icon-s-livejournal',
		'icon2' => 'icon-m-social-livejournal',
		'slug' => 'livejournal',
		'dec'  => __('Visit Livejournal page','ux')
	),
	array(
		'name' => __('VK','ux'),
		'icon' => 'icon-s-vk',
		'icon2' => 'icon-m-social-vk',
		'slug' => 'vk',
		'dec'  => __('Visit VK page','ux')
	),
	array(
		'name' => __('Weibo','ux'),
		'icon' => 'icon-s-weibo',
		'icon2' => 'icon-m-social-weibo',
		'slug' => 'weibo',
		'dec'  => __('Visit Weibo page','ux')
	),
	array(
		'name' => __('Wechat','ux'),
		'icon' => 'icon-s-wechat',
		'icon2' => 'icon-m-social-wechat',
		'slug' => 'wechat',
		'dec'  => __('Find me at Wechat','ux')
	),
	array(
		'name' => __('Renren','ux'),
		'icon' => 'icon-s-renren',
		'icon2' => 'icon-m-social-renren',
		'slug' => 'renren',
		'dec'  => __('Visit Renren page','ux')
	),
	array(
		'name' => __('Douban','ux'),
		'icon' => 'icon-s-douban',
		'icon2' => 'icon-m-social-douban',
		'slug' => 'douban',
		'dec'  => __('Visit Douban page','ux')
	),
	array(
		'name' => __('Xing','ux'),
		'icon' => 'icon-s-xing',
		'icon2' => 'icon-m-social-xing',
		'slug' => 'xing',
		'dec'  => __('Visit Xing page','ux')
	),
	array(
		'name' => __('Reddit','ux'),
		'icon' => 'icon-s-reddit',
		'icon2' => 'icon-m-social-reddit',
		'slug' => 'reddit',
		'dec'  => __('Visit Reddit page','ux')
	),
	array(
		'name' => __('Path','ux'),
		'icon' => 'icon-s-path',
		'icon2' => 'icon-m-social-path',
		'slug' => 'path',
		'dec'  => __('Find me at Path','ux')
	),
	array(
		'name' => __('Bebo','ux'),
		'icon' => 'icon-s-bebo',
		'icon2' => 'icon-m-social-bebo',
		'slug' => 'bebo',
		'dec'  => __('Visit Bebo page','ux')
	),
	array(
		'name' => __('Odnoklassniki','ux'),
		'icon' => 'icon-s-odnoklassniki',
		'icon2' => 'icon-m-social-odnoklassniki',
		'slug' => 'odnoklassniki',
		'dec'  => __('Visit Odnoklassniki page','ux')
	),
	array(
		'name' => __('Email','ux'),
		'icon' => 'icon-s-email',
		'icon2' => 'm-social-email',
		'slug' => 'email',
		'dec'  => __('Mail','ux')
	),
	array(
		'name' => __('Blogger','ux'),
		'icon' => 'icon-s-blogger',
		'icon2' => 'm-social-blogger',
		'slug' => 'blogger',
		'dec'  => __('Visit Blogger page','ux')
	),
	array(
		'name' => __('Deviantart','ux'),
		'icon' => 'icon-s-deviantart',
		'icon2' => 'm-social-deviantart',
		'slug' => 'deviantart',
		'dec'  => __('Visit Deviantart page','ux')
	),
	array(
		'name' => __('Lastfm','ux'),
		'icon' => 'icon-s-lastfm',
		'icon2' => 'm-social-lastfm',
		'slug' => 'lastfm',
		'dec'  => __('Visit lLastfm page','ux')
	),
	array(
		'name' => __('Stumbleupon','ux'),
		'icon' => 'icon-s-stumbleupon',
		'icon2' => 'm-social-stumbleupon',
		'slug' => 'stumbleupon',
		'dec'  => __('Visit Stumbleupon page','ux')
	),
	array(
		'name' => __('Myspace','ux'),
		'icon' => 'icon-s-myspace',
		'icon2' => 'icon-m-social-myspace',
		'slug' => 'myspace',
		'dec'  => __('Visit Myspace page','ux')
	),
	array(
		'name' => __('Dribbble','ux'),
		'icon' => 's-dribbble',
		'icon2' => 'm-social-dribbble',
		'slug' => 'dribbble',
		'dec'  => __('Visit Dribbble page','ux')
	)
);

/*
============================================================================
	*
	* Custom Show Moudle
	*
============================================================================	
*/
function ux_show_module(){
	global $bootstrap_width; 
	
	$item_width = ux_custom_meta( 'pagebuilder_item_width' );
	$item_module_id = ux_custom_meta( 'pagebuilder_item_module_id' );
	$item_module_post_id = ux_custom_meta( 'pagebuilder_item_module_post_id' );
	$item_module_post = ux_custom_meta( 'pagebuilder_item_module_post' );
	
	$module_width = ux_custom_meta( 'pagebuilder_module_width' );
	$module_parent = ux_custom_meta( 'pagebuilder_module_parent' );
	$module_id = ux_custom_meta( 'pagebuilder_module_id' );
	
	
	$module = array();
	
	if($item_width){
		foreach($item_width as $id => $width){
			$module[$id] = array();
		
		}
	}
	
	if($module_parent){
		foreach($module_parent as $parent_id => $parent){
			$module[$parent][$parent_id] = array();
		
		}
	}
	$row_class = "row";
	$post_option_select_sidebar  = get_post_meta(get_the_ID(), "post_option_select_sidebar", true);
	if($post_option_select_sidebar != 'post_sidebar_no'){
		$row_class = "row-fluid";
	}
	
	if($module): ?>
        <div class="row-fluid">
        <?php foreach($item_width as $id => $width):
			
			
			$m_width = explode( " ", $width );
			$span_width = $bootstrap_width[ $m_width[0] ];
			
			$span_style = '';
			if($bootstrap_width[$m_width[0]] == 'span12'){
				$span_style = 'margin-left:0px;';
			}
			
			$width_col = str_replace($m_width[0], $span_width, $width);
			
			if($item_module_id[$id] != '-1'):
				ux_view_module_switch($item_module_id[$id], $id, 'item_module', $width_col.' moudle');
			
			?>
            
            <?php else: ?>    
            
                <?php
				$module_background_color = ux_get_module_meta($item_module_post[$id], 'module_background_color', get_the_ID());
				$module_background_color_rgb = ux_get_module_meta($item_module_post[$id], 'module_background_color_rgb', get_the_ID());
				$module_image_single = ux_get_module_meta($item_module_post[$id], 'module_image_single', get_the_ID());
				$module_switch_via_tab = ux_get_module_meta($item_module_post[$id], 'module_switch_via_tab', get_the_ID());
				$module_switch_dark_background = ux_get_module_meta($item_module_post[$id], 'module_switch_dark_background', get_the_ID());
				$module_cheak_dark_background = ux_get_module_meta($item_module_post[$id], 'module_cheak_dark_background', get_the_ID());
				$module_switch_shadow = ux_get_module_meta($item_module_post[$id], 'module_switch_shadow', get_the_ID());
				$tabs_name = ux_get_module_meta($item_module_post[$id], 'module_tabs_fullwidth_name', get_the_ID());
				$tabs_title = ux_get_module_meta($item_module_post[$id], 'module_tabs_fullwidth_title', get_the_ID());
				$module_switch_fullwidth_fit = ux_get_module_meta($item_module_post[$id], 'module_switch_fullwidth_fit', get_the_ID());
				$module_switch_spacer_top = ux_get_module_meta($item_module_post[$id], 'module_switch_spacer_top', get_the_ID());
				$module_switch_spacer_bottom = ux_get_module_meta($item_module_post[$id], 'module_switch_spacer_bottom', get_the_ID());
				
				$module_select_background = ux_get_module_meta($item_module_post[$id], 'module_select_background', get_the_ID());
				$module_select_background_repeat = ux_get_module_meta($item_module_post[$id], 'module_select_background_repeat', get_the_ID());
				$module_select_background_attachment = ux_get_module_meta($item_module_post[$id], 'module_select_background_attachment', get_the_ID());
				$module_input_fullwidth_height = ux_get_module_meta($item_module_post[$id], 'module_input_fullwidth_height', get_the_ID());
				$fullwidth_height = '';
				if($module_input_fullwidth_height){
					$fullwidth_height = 'height: '.$module_input_fullwidth_height.'px;';
				}
				
				$module_cheak_dark_background = ($module_cheak_dark_background) ? explode("'%_%'",$module_cheak_dark_background) : false;
				
				$wrap_style_color = false;
				$wrap_style_img = false;
				
				if($item_module_post_id[$id] != '-1'){
					if($module_select_background == 'image'){
						$image_single_url = explode('__',$module_image_single);
						$img_ur_src = '';
						if(isset($image_single_url[1])){
							$img_ur_src = $image_single_url[1];
						}
						$wrap_style_img = 'background-repeat: '.$module_select_background_repeat.'; background-image: url('.$img_ur_src.'); background-attachment: '.$module_select_background_attachment.'; background-position: top left;background-size:cover;';
					}elseif($module_select_background == 'color'){
						if($module_background_color){
							global $theme_color;
							$wrap_style_color = 'bg-'.$theme_color[$module_background_color]['value'];
						}else{
							$wrap_style_color = '';
						}
					}
				}else{
					$wrap_style = '';
				}
				
				$fullwrap_type = 'general_moudle';
				$fullwrap_moudle = false;
				if($item_module_post_id[$id] != '-1'){
					$fullwrap_type = 'fullwrap_moudle';
					$fullwrap_moudle = 'data-module="true"';
				}
				
				$dark_background = false;
				if($module_switch_dark_background){
					if($module_switch_dark_background != 'false'){
						$dark_background = 'fullwidth-text-white';
					}
				}
				
				$dark_background_shadow = false;
				if($module_cheak_dark_background){
					if(in_array("text_shadow", $module_cheak_dark_background)){
						$dark_background_shadow = 'fullwidth-text-shadow';
					}
				}
				
				if($dark_background){
					$dark_background_shadow = $dark_background_shadow;
				}else{
					$dark_background_shadow = false;
				}
							
				$fullwrap_spacer_top = false;
				if($module_switch_spacer_top){
					if($module_switch_spacer_top != 'false'){
						$fullwrap_spacer_top = 'margin-top: 40px;';
					}else{
						$fullwrap_spacer_top = 'margin-top: 0;';
					}
				}
				
				$fullwrap_spacer_bottom = false;
				if($module_switch_spacer_bottom){
					if($module_switch_spacer_bottom != 'false'){
						$fullwrap_spacer_bottom = 'margin-bottom: 40px;';
					}else{
						$fullwrap_spacer_bottom = 'margin-bottom: 0;';
					}
				}
				
				$fullwrap_border = false;
				
				if($module_switch_shadow){
					if($module_switch_shadow != 'false'){
						$fullwrap_border = 'fullwrap-border';
					}
				}				
				?>
                
                <div class="<?php echo $width_col; ?> moudle <?php echo $fullwrap_type; ?>" style=" <?php echo $span_style; ?> <?php echo $fullwrap_spacer_top; ?> <?php echo $fullwrap_spacer_bottom; ?>" <?php echo $fullwrap_moudle; ?>>
                    <?php if($item_module_post_id[$id] != '-1'):
						$wrap_style_color = ($module_background_color_rgb) ? false : $wrap_style_color;
						$wrap_style_color_rgb = ($module_background_color_rgb) ? 'background-color: '.$module_background_color_rgb.';' : false; ?>
						<div class="row-fluid fullwidth-wrap custom_fullwidth_wrap container <?php echo $wrap_style_color; ?> <?php echo $dark_background_shadow; ?> <?php echo $dark_background; ?> <?php echo $fullwrap_border; ?>" style=" <?php echo $wrap_style_img; ?> <?php echo $fullwidth_height; ?> <?php echo $wrap_style_color_rgb; ?>">
                            <?php if($module_switch_shadow){
								if($module_switch_shadow != 'false'){ ?>
                                    <div class="fullwrap-shadow"></div>
                                <?php 
								}
							} ?>
                            <?php 
							$fullwrap_container = 'container';
							if($module_switch_fullwidth_fit){
								if($module_switch_fullwidth_fit != 'false'){
									$fullwrap_container = 'row-fluid';
								}
							} ?>
							<div class="<?php echo $fullwrap_container; ?>">
                                <?php 
								if($module_switch_via_tab){
									if($module_switch_via_tab != 'false'){
										if($tabs_name){
											$module_tabs = array();
											foreach($module[$id] as $m_id => $val){
												$m_width = explode( " ", $module_width[$m_id] );
												$span_width = $bootstrap_width[ $m_width[0] ];
												$width_col = str_replace($m_width[0], $span_width, $module_width[$m_id]);
												if(strstr($width_col, 'f_col')){
													array_push($module_tabs, $m_id);
												}
											} ?>
											<nav class="fullwrap-with-tab-nav">
												<?php foreach($tabs_name as $tab_i => $tab_name){
													$tab_title = $tabs_title[$tab_i];
													$tab_row = '-no-row';
													if(isset($module_tabs[$tab_i])){
														$tab_row = '-'.$item_module_post[$id].'-'.$module_tabs[$tab_i];
													} ?>
													<a data-target="fullwidth-row<?php echo $tab_row; ?>" href="javascript:;"><?php echo $tab_title['value']; ?></a>
												<?php } ?>
											</nav>
										<?php 
										}
									}
								}
								
								if($module_parent){
									$module_f = array();
									foreach($module_parent as $parent_id => $parent){
										if($parent == $id){
											array_push($module_f, $parent_id);
										}
									}
								}
								
								foreach($module_f as $iii => $m_id){
                                    $m_width = explode( " ", $module_width[$m_id] );
                                    $span_width = $bootstrap_width[ $m_width[0] ];
                                    $width_col = str_replace($m_width[0], $span_width, $module_width[$m_id]);
                                    
                                    $fullwrap_enble = 'disble';
                                    if($iii == 0){
                                        $fullwrap_enble = 'enble';
                                    }
                                    
									if($module_switch_via_tab){
										if($module_switch_via_tab != 'false'){
											if(strstr($width_col, 'f_col')){
												if($iii != 0){
													echo '</div>';
													
												}
												echo '<div id="fullwidth-row-'.$item_module_post[$id].'-'.$m_id.'" class="fullwrap-with-tab-inn row-fluid '.$fullwrap_enble.'">';
												
											}
										}
									}
                                    
                                    ux_view_module_switch($module_id[$m_id], $m_id, 'module', $width_col.' moudle');
                                    
                                    if($module_switch_via_tab){
										if($module_switch_via_tab != 'false'){
											if($iii == count($module_f) - 1){
												echo '</div>';
											}
										}
									}
                                } ?>
							</div>
						</div>
					<?php else: ?>
                    <div class="row-fluid">
					<?php 
                    foreach($module[$id] as $m_id => $val){
                        $m_width = explode( " ", $module_width[$m_id] );
						$span_width = $bootstrap_width[ $m_width[0] ];
						$width_col = str_replace($m_width[0], $span_width, $module_width[$m_id]);
						ux_view_module_switch($module_id[$m_id], $m_id, 'module', $width_col.' moudle');
                    } ?>
                    </div>
                    <?php endif; ?>
                </div>
                
			<?php endif; ?>
		
		<?php endforeach; ?>
        </div><!--End row-->
	<?php endif; ?>
<?php	
}



/*
============================================================================
	*
	* Post, Page Submit Box 
	*
============================================================================	
*/

function ux_submit_box(){
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(ABSPATH).'" /> ';
	require_once locate_template('/functions/pagebuilder/pagebuilder-submitbox.php');
}
add_action('submitpost_box', 'ux_submit_box');
add_action('submitpage_box', 'ux_submit_box');

/*
============================================================================
	*
	* font size and style
	*
============================================================================	
*/
$theme_font_size = array('10px', '11px', '12px', '13px', '14px', '15px', '16px', '17px', '18px', '19px', '20px', '22px', '24px', '26px', '28px', '30px', '32px', '36px', '38px', '40px', '46px', '50px', '56px', '60px', '66px');

$theme_font_style = array(
	array('title' => 'Light', 'value' => 'light'),
	array('title' => 'Normal', 'value' => 'normal'),
	array('title' => 'Bold', 'value' => 'bold'),
	array('title' => 'Italic', 'value' => 'italic')
);

/*
============================================================================
	*
	* google fonts
	*
============================================================================	
*/
$theme_google_fonts = array(
	array(
		'name' => __('-- Select Font --','ux'),
		'import' => false,
		'url' => false,
		'css' => false
	),
	array(
		'name' => 'Open Sans',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Open+Sans);',
		'url' => 'http://fonts.googleapis.com/css?family=Open+Sans',
		'css' => "font-family: 'Open Sans', sans-serif;"
	),
	array(
		'name' => 'Lato',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Lato);',
		'url' => 'http://fonts.googleapis.com/css?family=Lato',
		'css' => "font-family: 'Lato', sans-serif;"
	),
	array(
		'name' => 'Arial',
		'import' => '',
		'url' => '',
		'css' => "font-family: Arial, sans-serif;"
	),
	array(
		'name' => 'Allan',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Allan:700);',
		'url' => 'http://fonts.googleapis.com/css?family=Allan:700',
		'css' => "font-family: 'Allan', cursive;"
	),
	array(
		'name' => 'Allerta',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Allerta);',
		'url' => 'http://fonts.googleapis.com/css?family=Allerta',
		'css' => "font-family: 'Allerta', sans-serif;"
	),
	array(
		'name' => 'Armata',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Armata);',
		'url' => 'http://fonts.googleapis.com/css?family=Armata',
		'css' => "font-family:'Armata', sans-serif;"
	),
	array(
		'name' => 'Arimo',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Arimo);',
		'url' => 'http://fonts.googleapis.com/css?family=Arimo',
		'css' => "font-family: 'Arimo', sans-serif;"
	),
	array(
		'name' => 'Bitter',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Bitter);',
		'url' => 'http://fonts.googleapis.com/css?family=Bitter',
		'css' => "font-family: 'Bitter', sans-serif;"
	),
	array(
		'name' => 'Balthazar',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Balthazar);',
		'url' => 'http://fonts.googleapis.com/css?family=Balthazar',
		'css' => "font-family: 'Balthazar', sans-serif;"
	),
	array(
		'name' => 'Bonbon',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Bonbon);',
		'url' => 'http://fonts.googleapis.com/css?family=Bonbon',
		'css' => "font-family: 'Bonbon', sans-serif;"
	),
	array(
		'name' => 'Butcherman',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Butcherman);',
		'url' => 'http://fonts.googleapis.com/css?family=Butcherman',
		'css' => "font-family: 'Butcherman', sans-serif;"
	),
	array(
		'name' => 'Coda',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Coda);',
		'url' => 'http://fonts.googleapis.com/css?family=Coda',
		'css' => "font-family: 'Coda', sans-serif;"
	),
	array(
		'name' => 'Changa One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Changa+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Changa+One',
		'css' => "font-family: 'Changa One', sans-serif;"
	),
	array(
		'name' => 'Codystar',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Codystar);',
		'url' => 'http://fonts.googleapis.com/css?family=Codystar',
		'css' => "font-family: 'Codystar', sans-serif;"
	),
	array(
		'name' => 'Capriola',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Capriola);',
		'url' => 'http://fonts.googleapis.com/css?family=Capriola',
		'css' => "font-family: 'Capriola', sans-serif;"
	),
	array(
		'name' => 'Courgette',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Courgette);',
		'url' => 'http://fonts.googleapis.com/css?family=Courgette',
		'css' => "font-family: 'Courgette', sans-serif;"
	),
	array(
		'name' => 'Cagliostro',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Cagliostro);',
		'url' => 'http://fonts.googleapis.com/css?family=Cagliostro',
		'css' => "font-family: 'Cagliostro', sans-serif;"
	),
	array(
		'name' => 'Creepster',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Creepster);',
		'url' => 'http://fonts.googleapis.com/css?family=Creepster',
		'css' => "font-family: 'Creepster', sans-serif;"
	),
	array(
		'name' => 'Contrail One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Contrail+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Contrail+One',
		'css' => "font-family: 'Contrail One', sans-serif;"
	),
	array(
		'name' => 'Ceviche One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Ceviche+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Ceviche+One',
		'css' => "font-family: 'Ceviche One', sans-serif;"
	),
	array(
		'name' => 'Cedarville Cursive',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Cedarville+Cursive);',
		'url' => 'http://fonts.googleapis.com/css?family=Cedarville+Cursive',
		'css' => "font-family: 'Cedarville Cursive', sans-serif;"
	),
	array(
		'name' => 'Dosis',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Dosis);',
		'url' => 'http://fonts.googleapis.com/css?family=Dosis',
		'css' => "font-family: 'Dosis', sans-serif;"
	),
	array(
		'name' => 'Duru Sans',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Duru+Sans);',
		'url' => 'http://fonts.googleapis.com/css?family=Duru+Sans',
		'css' => "font-family: 'Duru Sans', sans-serif;"
	),
	array(
		'name' => 'Diplomata SC',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Diplomata+SC);',
		'url' => 'http://fonts.googleapis.com/css?family=Diplomata+SC',
		'css' => "font-family: 'Diplomata SC', sans-serif;"
	),
	array(
		'name' => 'Eater',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Eater);',
		'url' => 'http://fonts.googleapis.com/css?family=Eater',
		'css' => "font-family: 'Eater', sans-serif;"
	),
	array(
		'name' => 'Esteban',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Esteban);',
		'url' => 'http://fonts.googleapis.com/css?family=Esteban',
		'css' => "font-family: 'Esteban', sans-serif;"
	),
	array(
		'name' => 'Eagle Lake',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Eagle+Lake);',
		'url' => 'http://fonts.googleapis.com/css?family=Eagle+Lake',
		'css' => "font-family: 'Eagle Lake', sans-serif;"
	),
	array(
		'name' => 'Electrolize',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Electrolize);',
		'url' => 'http://fonts.googleapis.com/css?family=Electrolize',
		'css' => "font-family: 'Electrolize', sans-serif;"
	),
	array(
		'name' => 'Emblema One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Emblema+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Emblema+One',
		'css' => "font-family: 'Emblema One', sans-serif;"
	),
	array(
		'name' => 'Engagement',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Engagement);',
		'url' => 'http://fonts.googleapis.com/css?family=Engagement',
		'css' => "font-family: 'Engagement', sans-serif;"
	),
	array(
		'name' => 'Felipa',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Felipa);',
		'url' => 'http://fonts.googleapis.com/css?family=Felipa',
		'css' => "font-family: 'Felipa', sans-serif;"
	),
	array(
		'name' => 'Federant',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Federant);',
		'url' => 'http://fonts.googleapis.com/css?family=Federant',
		'css' => "font-family: 'Federant', sans-serif;"
	),
	array(
		'name' => 'Fascinate Inline',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Fascinate+Inline);',
		'url' => 'http://fonts.googleapis.com/css?family=Fascinate+Inline',
		'css' => "font-family: 'Fascinate+Inline', sans-serif;"
	),
	array(
		'name' => 'Georgia',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Georgia);',
		'url' => 'http://fonts.googleapis.com/css?family=Georgia',
		'css' => "font-family: 'Georgia', sans-serif;"
	),
	array(
		'name' => 'Galindo',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Galindo);',
		'url' => 'http://fonts.googleapis.com/css?family=Galindo',
		'css' => "font-family: 'Galindo', sans-serif;"
	),
	array(
		'name' => 'Gudea',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Gudea);',
		'url' => 'http://fonts.googleapis.com/css?family=Gudea',
		'css' => "font-family: 'Gudea', sans-serif;"
	),
	array(
		'name' => 'Give You Glory',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Give+You+Glory);',
		'url' => 'http://fonts.googleapis.com/css?family=Give+You+Glory',
		'css' => "font-family: 'Give You Glory', sans-serif;"
	),
	array(
		'name' => 'Gochi Hand',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Gochi Hand);',
		'url' => 'http://fonts.googleapis.com/css?family=Gudea',
		'css' => "font-family: 'Gudea', sans-serif;"
	),
	array(
		'name' => 'Glegoo',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Glegoo);',
		'url' => 'http://fonts.googleapis.com/css?family=Glegoo',
		'css' => "font-family: 'Glegoo', sans-serif;"
	),
	array(
		'name' => 'Happy Monkey',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Happy+Monkey);',
		'url' => 'http://fonts.googleapis.com/css?family=Happy+Monkey',
		'css' => "font-family: 'Happy Monkey', sans-serif;"
	),
	array(
		'name' => 'Headland One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Headland+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Headland+One',
		'css' => "font-family: 'Headland One', sans-serif;"
	),
	array(
		'name' => 'Inder',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Inder);',
		'url' => 'http://fonts.googleapis.com/css?family=Inder',
		'css' => "font-family: 'Inder', sans-serif;"
	),
	array(
		'name' => 'IM Fell DW Pica',
		'import' => '@import url(http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica);',
		'url' => 'http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica',
		'css' => "font-family: 'IM Fell DW Pica', sans-serif;"
	),
	array(
		'name' => 'IM Fell French Canon SC',
		'import' => '@import url(http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC);',
		'url' => 'http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC',
		'css' => "font-family: 'IM Fell French Canon SC', sans-serif;"
	),
	array(
		'name' => 'Jolly Lodger',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Jolly+Lodger);',
		'url' => 'http://fonts.googleapis.com/css?family=Jolly+Lodger',
		'css' => "font-family: 'Jolly Lodger', sans-serif;"
	),
	array(
		'name' => 'Jockey One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Jockey+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Jockey+One',
		'css' => "font-family: 'Jockey One', sans-serif;"
	),
	array(
		'name' => 'Jim Nightshade',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Jim+Nightshade);',
		'url' => 'http://fonts.googleapis.com/css?family=Jim+Nightshade',
		'css' => "font-family: 'Jim Nightshade', sans-serif;"
	),
	array(
		'name' => 'Just Me Again Down Here',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Just+Me+Again+Down+Here);',
		'url' => 'http://fonts.googleapis.com/css?family=Just+Me+Again+Down+Here',
		'css' => "font-family: 'Just Me Again Down Here', sans-serif;"
	),
	array(
		'name' => 'Josefin Sans',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Josefin+Sans);',
		'url' => 'http://fonts.googleapis.com/css?family=Josefin+Sans',
		'css' => "font-family: 'Josefin Sans', sans-serif;"
	),
	array(
		'name' => 'Karla',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Karla);',
		'url' => 'http://fonts.googleapis.com/css?family=Karla',
		'css' => "font-family: 'Karla', sans-serif;"
	),
	array(
		'name' => 'Kristi',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Kristi);',
		'url' => 'http://fonts.googleapis.com/css?family=Kristi',
		'css' => "font-family: 'Kristi', sans-serif;"
	),
	array(
		'name' => 'Knewave',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Knewave);',
		'url' => 'http://fonts.googleapis.com/css?family=Knewave',
		'css' => "font-family: 'Knewave', sans-serif;"
	),
	array(
		'name' => 'Lobster',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Lobster);',
		'url' => 'http://fonts.googleapis.com/css?family=Lobster',
		'css' => "font-family: 'Lobster', cursive;"
	),
		array(
		'name' => 'Lemon',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Lemon);',
		'url' => 'http://fonts.googleapis.com/css?family=Lemon',
		'css' => "font-family: 'Lemon', sans-serif;"
	),
	array(
		'name' => 'Lustria',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Lustria);',
		'url' => 'http://fonts.googleapis.com/css?family=Lustria',
		'css' => "font-family: 'Lustria', sans-serif;"
	),
		array(
		'name' => 'Life Savers',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Life+Savers);',
		'url' => 'http://fonts.googleapis.com/css?family=Life+Savers',
		'css' => "font-family: 'Life Savers', sans-serif;"
	),
	array(
		'name' => 'Londrina Outline',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Londrina+Outline);',
		'url' => 'http://fonts.googleapis.com/css?family=Londrina+Outline',
		'css' => "font-family: 'Londrina Outline', sans-serif;"
	),
		array(
		'name' => 'Marck Script',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Marck+Script);',
		'url' => 'http://fonts.googleapis.com/css?family=Marck+Script',
		'css' => "font-family: 'Marck Script', sans-serif;"
	),
	array(
		'name' => 'Metal Mania',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Metal+Mania);',
		'url' => 'http://fonts.googleapis.com/css?family=Metal+Mania',
		'css' => "font-family: 'Metal Mania', sans-serif;"
	),
	array(
		'name' => 'Maiden Orange',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Maiden+Orange);',
		'url' => 'http://fonts.googleapis.com/css?family=Maiden+Orange',
		'css' => "font-family: 'Maiden Orange', serif;"
	),
	array(
		'name' => 'Molengo',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Molengo);',
		'url' => 'http://fonts.googleapis.com/css?family=Molengo',
		'css' => "font-family: 'Molengo', sans-serif;"
	),
	array(
		'name' => 'Metamorphous',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Metamorphous);',
		'url' => 'http://fonts.googleapis.com/css?family=Metamorphous',
		'css' => "font-family: 'Metamorphous', sans-serif;"
	),
	array(
		'name' => 'Mr Dafoe',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Mr+Dafoe);',
		'url' => 'http://fonts.googleapis.com/css?family=Mr+Dafoe',
		'css' => "font-family: 'Mr Dafoe', sans-serif;"
	),
	array(
		'name' => 'McLaren',
		'import' => '@import url(http://fonts.googleapis.com/css?family=McLaren);',
		'url' => 'http://fonts.googleapis.com/css?family=McLaren',
		'css' => "font-family: 'McLaren', sans-serif;"
	),
	array(
		'name' => 'Meie Script',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Meie+Script);',
		'url' => 'http://fonts.googleapis.com/css?family=Meie+Script',
		'css' => "font-family: 'Meie Script', sans-serif;"
	),
	array(
		'name' => 'Metrophobic',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Metrophobic);',
		'url' => 'http://fonts.googleapis.com/css?family=Metrophobic',
		'css' => "font-family: 'Metrophobic', sans-serif;"
	),
	array(
		'name' => 'Niconne',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Niconne);',
		'url' => 'http://fonts.googleapis.com/css?family=Niconne',
		'css' => "font-family: 'Niconne', sans-serif;"
	),
	array(
		'name' => 'Noticia Text',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Noticia+Text);',
		'url' => 'http://fonts.googleapis.com/css?family=Noticia+Text',
		'css' => "font-family: 'Noticia Text', sans-serif;"
	),
	array(
		'name' => 'Numans',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Numans);',
		'url' => 'http://fonts.googleapis.com/css?family=Numans',
		'css' => "font-family: 'Numans', sans-serif;"
	),
	array(
		'name' => 'Original Surfer',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Original+Surfer);',
		'url' => 'http://fonts.googleapis.com/css?family=Original+Surfer',
		'css' => "font-family: 'Original Surfer', sans-serif;"
	),
	array(
		'name' => 'Oregano',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Oregano);',
		'url' => 'http://fonts.googleapis.com/css?family=Oregano',
		'css' => "font-family: 'Oregano', sans-serif;"
	),
	array(
		'name' => 'Oranienbaum',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Oranienbaum);',
		'url' => 'http://fonts.googleapis.com/css?family=Oranienbaum',
		'css' => "font-family: 'Oranienbaum', sans-serif;"
	),
	array(
		'name' => 'Playfair Display',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Playfair+Display);',
		'url' => 'http://fonts.googleapis.com/css?family=Playfair+Display',
		'css' => "font-family: 'Playfair Display', sans-serif;"
	),
	array(
		'name' => 'Playball',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Playball);',
		'url' => 'http://fonts.googleapis.com/css?family=Playball',
		'css' => "font-family: 'Playball', sans-serif;"
	),
	array(
		'name' => 'Passion One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Passion+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Passion+One',
		'css' => "font-family: 'Passion One', sans-serif;"
	),
	array(
		'name' => 'Palatino',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Palatino);',
		'url' => 'http://fonts.googleapis.com/css?family=Palatino',
		'css' => "font-family: 'Palatino', sans-serif;"
	),
	array(
		'name' => 'Port Lligat Slab',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Port+Lligat+Slab);',
		'url' => 'http://fonts.googleapis.com/css?family=Port+Lligat+Slab',
		'css' => "font-family: 'Port Lligat Slab', sans-serif;"
	),
	array(
		'name' => 'PT Sans Narrow',
		'import' => '@import url(http://fonts.googleapis.com/css?family=PT+Sans+Narrow);',
		'url' => 'http://fonts.googleapis.com/css?family=PT+Sans+Narrow',
		'css' => "font-family: 'PT Sans Narrow', sans-serif;"
	),
	array(
		'name' => 'Quando',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Quando);',
		'url' => 'http://fonts.googleapis.com/css?family=Quando',
		'css' => "font-family: 'Quando', sans-serif;"
	),
	array(
		'name' => 'Qwigley',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Qwigley);',
		'url' => 'http://fonts.googleapis.com/css?family=Qwigley',
		'css' => "font-family: 'Qwigley', sans-serif;"
	),
	array(
		'name' => 'Questrial',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Questrial);',
		'url' => 'http://fonts.googleapis.com/css?family=Questrial',
		'css' => "font-family: 'Questrial', sans-serif;"
	),
	array(
		'name' => 'Quicksand',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Raleway:100);',
		'url' => 'http://fonts.googleapis.com/css?family=Raleway:100',
		'css' => "font-family: 'Raleway', sans-serif;"
	),
	array(
		'name' => 'Quattrocento',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Quattrocento);',
		'url' => 'http://fonts.googleapis.com/css?family=Quattrocento',
		'css' => "font-family: 'Quattrocento', sans-serif;"
	),
	array(
		'name' => 'Russo One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Russo+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Russo+One',
		'css' => "font-family: 'Russo One', sans-serif;"
	),
	array(
		'name' => 'Ruthie',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Ruthie);',
		'url' => 'http://fonts.googleapis.com/css?family=Ruthie',
		'css' => "font-family: 'Ruthie', sans-serif;"
	),
	array(
		'name' => 'Rye',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Rye);',
		'url' => 'http://fonts.googleapis.com/css?family=Rye',
		'css' => "font-family: 'Rye', sans-serif;"
	),
	array(
		'name' => 'Raleway',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Raleway:100);',
		'url' => 'http://fonts.googleapis.com/css?family=Raleway:100',
		'css' => "font-family: 'Raleway', sans-serif;"
	),
	array(
		'name' => 'Racing Sans One',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Racing+Sans+One);',
		'url' => 'http://fonts.googleapis.com/css?family=Racing+Sans+One',
		'css' => "font-family: 'Racing Sans One', cursive;"
	),
	array(
		'name' => 'Romanesco',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Romanesco);',
		'url' => 'http://fonts.googleapis.com/css?family=Romanesco',
		'css' => "font-family: 'Romanesco', cursive;"
	),
	array(
		'name' => 'Stoke',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Stoke);',
		'url' => 'http://fonts.googleapis.com/css?family=Stoke',
		'css' => "font-family: 'Stoke', cursive;"
	),
	array(
		'name' => 'Skranji',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Skranji);',
		'url' => 'http://fonts.googleapis.com/css?family=Skranji',
		'css' => "font-family: 'Skranji', cursive;"
	),
	array(
		'name' => 'Signika Negative',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Signika+Negative);',
		'url' => 'http://fonts.googleapis.com/css?family=Signika+Negative',
		'css' => "font-family: 'Signika Negative', cursive;"
	),
	array(
		'name' => 'Smythe',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Smythe);',
		'url' => 'http://fonts.googleapis.com/css?family=Smythe',
		'css' => "font-family: 'Smythe', cursive;"
	),
	array(
		'name' => 'Stint Ultra Expanded',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Stint+Ultra+Expanded);',
		'url' => 'http://fonts.googleapis.com/css?family=Stint+Ultra+Expanded',
		'css' => "font-family: 'Stint Ultra Expanded', cursive;"
	),
	array(
		'name' => 'Stint Ultra Condensed',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Stint+Ultra+Condensed);',
		'url' => 'http://fonts.googleapis.com/css?family=Stint+Ultra+Condensed',
		'css' => "font-family: 'Stint Ultra Condensed', cursive;"
	),
	array(
		'name' => 'Smythe',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Smythe);',
		'url' => 'http://fonts.googleapis.com/css?family=Smythe',
		'css' => "font-family: 'Smythe', cursive;"
	),
	array(
		'name' => 'Spirax',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Spirax);',
		'url' => 'http://fonts.googleapis.com/css?family=Spirax',
		'css' => "font-family: 'Spirax', cursive;"
	),
	array(
		'name' => 'Source Sans Pro',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro);',
		'url' => 'http://fonts.googleapis.com/css?family=Source+Sans+Pro',
		'css' => "font-family: 'Source Sans Pro', cursive;"
	),
	array(
		'name' => 'Trebuchet',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Trebuchet);',
		'url' => 'http://fonts.googleapis.com/css?family=Trebuchet',
		'css' => "font-family: 'Trebuchet', cursive;"
	),
	array(
		'name' => 'Times New Roman',
		'import' => '',
		'url' => '',
		'css' => "font-family: Times New Roman;"
	),
	array(
		'name' => 'Tahoma',
		'import' => '',
		'url' => '',
		'css' => "font-family: Tahoma;"
	),
	array(
		'name' => 'Verdana',
		'import' => '',
		'url' => '',
		'css' => "font-family: Verdana;"
	),
	array(
		'name' => 'VT323',
		'import' => '@import url(http://fonts.googleapis.com/css?family=VT323);',
		'url' => 'http://fonts.googleapis.com/css?family=VT323',
		'css' => "font-family: 'VT323', sans-serif;"
	),
	array(
		'name' => 'Varela Round',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Varela+Round);',
		'url' => 'http://fonts.googleapis.com/css?family=Varela+Round',
		'css' => "font-family: 'Varela Round', sans-serif;"
	),
	array(
		'name' => 'Vollkorn',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Vollkorn);',
		'url' => 'http://fonts.googleapis.com/css?family=Vollkorn',
		'css' => "font-family: 'Vollkorn', sans-serif;"
	),
	array(
		'name' => 'Walter Turncoat',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Walter+Turncoat);',
		'url' => 'http://fonts.googleapis.com/css?family=Walter+Turncoat',
		'css' => "font-family: 'Walter Turncoat', cursive;"
	),
	array(
		'name' => 'Waiting for the Sunrise',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Waiting+for+the+Sunrise);',
		'url' => 'http://fonts.googleapis.com/css?family=Waiting+for+the+Sunrise',
		'css' => "font-family: 'Waiting for the Sunrise', cursive;"
	),
	array(
		'name' => 'Yanone Kaffeesatz',
		'import' => '@import url(http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz);',
		'url' => 'http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz',
		'css' => "font-family:'Yanone Kaffeesatz', sans-serif;"
	),
	
);

/*
============================================================================
	*
	* set color
	*
============================================================================	
*/
$theme_color = array(
	'1' => array(
		'title' => 'color1',
		'value' => 'theme-color-1',
		'rgb' => '#ee7164'
	),
	'2' => array(
		'title' => 'color2',
		'value' => 'theme-color-2',
		'rgb' => '#be9ecd'
	),
	'3' => array(
		'title' => 'color3',
		'value' => 'theme-color-3',
		'rgb' => '#f67bb5'
	),
	'4' => array(
		'title' => 'color4',
		'value' => 'theme-color-4',
		'rgb' => '#77c9e1'
	),
	'5' => array(
		'title' => 'color5',
		'value' => 'theme-color-5',
		'rgb' => '#5a6b7f'
	),
	'6' => array(
		'title' => 'color6',
		'value' => 'theme-color-6',
		'rgb' => '#b8b69d'
	),
	'7' => array(
		'title' => 'color7',
		'value' => 'theme-color-7',
		'rgb' => '#34bc99'
	),
	'8' => array(
		'title' => 'color8',
		'value' => 'theme-color-8',
		'rgb' => '#e8b900'
	),
	'9' => array(
		'title' => 'color9',
		'value' => 'theme-color-9',
		'rgb' => '#ce671e'
	),
	'10' => array(
		'title' => 'color10',
		'value' => 'theme-color-10',
		'rgb' => '#454545'
	),

);

/*
============================================================================
	*
	* Functions Admin
	*
============================================================================	
*/
require_once locate_template('/functions/pagebuilder/pagebuilder-admin.php');

/*
============================================================================
	*
	* Theme Admin
	*
============================================================================	
*/
require_once locate_template('/functions/theme/theme-admin.php');

/*
============================================================================
	*
	* Load view module
	*
============================================================================	
*/
require_once locate_template('/functions/functions-view-module.php');

/*
============================================================================
	*
	* Load post type
	*
============================================================================	
*/
require_once locate_template('/functions/functions-post-type.php');

/*
============================================================================
	*
	* Load layerslider
	*
============================================================================	
*/
//require_once locate_template('/functions/layerslider/layerslider.php');

/*
============================================================================
	*
	* Load wordpress importer
	*
============================================================================	
*/
if(!function_exists('wordpress_importer_init')){
	require_once locate_template('/functions/wordpress-importer/wordpress-importer.php');
}

/*
============================================================================
	*
	* Load TGM plugin
	*
============================================================================	
*/
require_once locate_template('/functions/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'ux_theme_tgmpa_register' );

function ux_theme_tgmpa_register(){
	$plugins = array(

		array(
			'name' 		=> 'LayerSlider WP',
			'slug' 		=> 'LayerSlider',
			'source'    => get_stylesheet_directory() . '/functions/plugins/layerslider.zip', 
			'required' 	=> false,
		),
		array(
			'name' 		=> 'BM MEGA MENU for Bee wp theme',
			'slug' 		=> 'bm-mega-menu-bee',
			'source'    => get_stylesheet_directory() . '/functions/plugins/bm-mega-menu-bee.zip', 
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),
		array(
			'name' => 'BB Press Forum Software',
			'slug' => 'bbpress',
			'required' => false
		)

	);

	$theme_text_domain = 'ux';

	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
	
}

/*
============================================================================
	*
	* Load breadcrumbs
	*
============================================================================	
*/
require_once locate_template('/functions/breadcrumb/full-breadcrumb.php');

/*
============================================================================
	*
	* Custom siderbar
	*
============================================================================	
*/ 
$sidebar_array = array(
	array('id' => 'sidebar_default', 'name' => __('default','ux')),
	array('id' => 'sidebar_1', 'name' => __('sidebar_1','ux')),
	array('id' => 'sidebar_2', 'name' => __('sidebar_2','ux')),
	array('id' => 'sidebar_3', 'name' => __('sidebar_3','ux')),
	array('id' => 'sidebar_4', 'name' => __('sidebar_4','ux')),
	array('id' => 'sidebar_5', 'name' => __('sidebar_5','ux')),
	array('id' => 'sidebar_6', 'name' => __('sidebar_6','ux')),
	array('id' => 'sidebar_7', 'name' => __('sidebar_7','ux')),
	array('id' => 'sidebar_8', 'name' => __('sidebar_8','ux')),
	array('id' => 'sidebar_9', 'name' => __('sidebar_9','ux')),
	array('id' => 'sidebar_10', 'name' => __('sidebar_10','ux')),

);

foreach($sidebar_array as $num => $sidebar){
	register_sidebar(array(
		'name' => $sidebar['name'],
		'id' => $sidebar['id'],
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'class' => ''
	));
	
}

register_sidebar(array(
	'name' => __('Footer Widget','ux'),
	'id' => 'footer-widget',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s span3">',
	'after_widget' => '</li>',
	'class' => ''
));

/*
============================================================================
	*
	* Register image size
	*
============================================================================	
*/
add_image_size('gallery-selected-thumb', 160, 110, true); 
add_image_size('gallery-list-thumb', 70, 70, true); 


/*
============================================================================
	*
	* pagenation
	*
============================================================================	
*/ 
function ux_themepagination($pages = '', $range = 3)
{  
     $showitems = ($range * 2)+1;  

     //global $paged;
     //if(empty($paged)) $paged = 1;
	 
	 if (is_front_page()) {
		 if(get_post_type()){
			 global $paged;
			 if(empty($paged)) $paged = 1;
		 }else{
			 $paged = (get_query_var('page')) ? get_query_var('page') : 1;
		 }
	 }else{
		 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	 }

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagenums pull-left'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."' class='first' pajx-click='true'>&laquo;</a>";
        
		 if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='pre'  pajx-click='true'>".__('PREVIOUS','ux')."</a>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' pajx-click='true'>".$i."</a>";
             }
         }

         if ( $paged < $pages && $showitems < $pages ) echo "<a href='".get_pagenum_link($paged + 1)."' class='next' pajx-click='true'>".__('NEXT','ux')."</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."' class='last' pajx-click='true'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*
============================================================================
	*
	* Save Post
	*
============================================================================	
*/
$ux_metafields = array(
	array('id' => 'pagebuilder_switch'),
	array('id' => 'pagebuilder_item_sort'),
	array('id' => 'pagebuilder_item_width'),
	array('id' => 'pagebuilder_item_module_id'),
	array('id' => 'pagebuilder_item_module_post'),
	array('id' => 'pagebuilder_item_module_post_id'),
	
	array('id' => 'pagebuilder_module_parent'),
	array('id' => 'pagebuilder_module_width'),
	array('id' => 'pagebuilder_module_id'),
	array('id' => 'pagebuilder_module_post'),
	array('id' => 'pagebuilder_module_post_id'),
	
	array('id' => 'post_background_color'),
	array('id' => 'post_option_select_sidebar'),
	array('id' => 'post_option_select_sidebars'),
	array('id' => 'post_option_cheak_show'),
	array('id' => 'post_option_select_list_style'),
	array('id' => 'post_option_input_link'),
	array('id' => 'post_option_textarea_quote'),
	array('id' => 'post_option_link_item_title'),
	array('id' => 'post_option_link_item_url'),
	array('id' => 'post_option_mp3_title'),
	array('id' => 'post_option_mp3_url'),
	array('id' => 'post_option_input_artist'),
	array('id' => 'post_option_select_audio_layout'),
	array('id' => 'post_option_textarea_embeded'),
	array('id' => 'post_option_input_m4v'),
	array('id' => 'post_option_input_ogv'),
	array('id' => 'post_option_textarea_soundcloud'),
	array('id' => 'post_option_gallery_selected'),
	array('id' => 'post_option_select_title_bar'),
	array('id' => 'post_option_select_specing'),
	array('id' => 'post_option_select_bottom_specing'),
	
	array('id' => 'post_type_job_location'),
	array('id' => 'post_type_job_number'),
	array('id' => 'post_type_client_link'),
	array('id' => 'post_type_testimonial_cite'),
	array('id' => 'post_type_testimonial_position'),
	array('id' => 'post_type_testimonial_link'),
	array('id' => 'post_type_team_position'),
	array('id' => 'post_type_team_email'),
	array('id' => 'post_type_team_phone_number'),
	array('id' => 'post_type_team_social_networks'),
	array('id' => 'post_type_team_social_networks_url'),
	
	
);

function ux_custom_mete_saved($post_id){
	$pagebuilder_item_module_post = get_post_meta($post_id, 'pagebuilder_item_module_post', true);
	$pagebuilder_module_post = get_post_meta($post_id, 'pagebuilder_module_post', true);
	$pagebuilder_module_post_array = array();
	
	if($pagebuilder_item_module_post){
		foreach($pagebuilder_item_module_post as $item_module_post){
			if($item_module_post != -1){
				$meta_value = get_post_meta($post_id, 'pagebuilder_module_value_'.$item_module_post, true);
				$pagebuilder_module_post_array[$item_module_post] =  $meta_value;
			}
		}
	}
	
	if($pagebuilder_module_post){
		foreach($pagebuilder_module_post as $module_post){
			if($item_module_post != -1){
				$meta_value = get_post_meta($post_id, 'pagebuilder_module_value_'.$module_post, true);
				$pagebuilder_module_post_array[$module_post] =  $meta_value;
			}
		}
	}
	
	global $wpdb;
	$get_module_value = $wpdb->get_results("
		SELECT `meta_id`
		FROM $wpdb->postmeta 
		WHERE `post_id` = '$post_id'
		AND `meta_key` LIKE '%pagebuilder_module_value_%'
		"
	);
	foreach($get_module_value as $module_value){
		$wpdb->delete($wpdb->postmeta, array('meta_id' => $module_value->meta_id));
	}
	
	if(count($pagebuilder_module_post_array) > 0){
		foreach($pagebuilder_module_post_array as $post => $value){
			add_post_meta($post_id, 'pagebuilder_module_value_'.$post, $value);
		}
	}
	
}

function ux_custom_meta_save($post_id) {  
    global $ux_metafields, $post;
	
	if(!isset($_POST['custom_meta_box_nonce'])){
		$post_nonce = '';
	}else{
		$post_nonce = $_POST['custom_meta_box_nonce'];
	}
	
	if (!wp_verify_nonce($post_nonce, ABSPATH))  
		return $post_id; 
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    
    if('page' == $_POST['post_type']){  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }
	
	foreach ($ux_metafields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = @$_POST[$field['id']];  
    
	    if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }
    }
	
	//ux_custom_mete_saved($post_id);
	return $post_id;
}  
add_action('save_post', 'ux_custom_meta_save'); 
/*
============================================================================
	*
	* Tag widget filter
	*
============================================================================	
*/
function ux_cloud_filter($args = array()) {
   $args['smallest'] = 11;
   $args['largest'] = 11;
   $args['unit'] = 'px';
   return $args;
}
add_filter('widget_tag_cloud_args', 'ux_cloud_filter', 90);


/*
============================================================================
	*
	* has module
	*
============================================================================	
*/
function ux_has_module($module){
   $return = false;
   
   
   if(is_singular()){
	   $pagebuilder_item_module_id = get_post_meta(get_the_ID(), 'pagebuilder_item_module_id', true);
	   $pagebuilder_module_id = get_post_meta(get_the_ID(), 'pagebuilder_module_id', true);
	   
	   if($pagebuilder_item_module_id){
		   if(in_array($module, $pagebuilder_item_module_id)){
			   $return = true;
		   }
	   }
	   
	   if($pagebuilder_module_id){
		   if(in_array($module, $pagebuilder_module_id)){
			   $return = true;
		   }
	   }
   }
   
   return $return;
}

/*
============================================================================
	*
	* Hook widget / Shortcode
	*
============================================================================	
*/

require_once locate_template('/functions/widget-recent-comments.php');
require_once locate_template('/functions/widget-contact-form.php');
require_once locate_template('/functions/widget-social-icons.php');
require_once locate_template('/functions/shortcodes.php');
require_once locate_template('/functions/shortcode/ux-core.php');
require_once locate_template('/functions/mod-bbpress.php');

require_once locate_template('/functions/functions-part4.php');
require_once locate_template('/functions/functions-part5.php');
?>