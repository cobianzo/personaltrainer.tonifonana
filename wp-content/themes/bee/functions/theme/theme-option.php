<?php
$theme_option_fields = array(
	array(
		'id' => 'select',
		'item' => array(
			'theme_option_select_header_layout' => array(
				array('title' => __('Right Menu Bar','ux'), 'value' => 'dark'),
				array('title' => __('Fullwidth Menu Bar','ux'), 'value' => 'fullwidth')
			),
			'theme_option_upload_boxed_layout_bg_repeat' => array(
				array('title' => __('Tile','ux'), 'value' => 'repeat'),
				array('title' => __('Fill','ux'), 'value' => 'no-repeat'),
			),
			'theme_option_upload_boxed_layout_bg_attachment' => array(
				array('title' => __('Fixed','ux'), 'value' => 'fixed'),
				array('title' => __('Scroll','ux'), 'value' => 'scroll')
			)
		)
	),
	array(
		'id' => 'image_select',
		'item' => array(
			'theme_option_select_website_layout' => array(
				array('title' => __('Fullwidth','ux'), 'value' => 'website_layout_fullwidth'),
				array('title' => __('Boxed','ux'), 'value' => 'website_layout_boxed')
			),
			'theme_option_select_color_scheme' => $theme_color
		)
	), 
);

$theme_option_setting = array(
	array(
		'id' => 'theme_options',
		'name' => __('Theme Options','ux'),
		'item' => array(
			
			array(
				'id' => 'default',
				'name' => __('Import Demo Data','ux'),
				'item' =>  array(
					
					array('title' => __('Import Demo Data','ux'),
						  'description' => __('If you are new to WordPress or have problems creating posts or pages that look like the theme preview you can import dummy posts and pages here that will definitely help to understand how those tasks are done.','ux'),
						  'type' => 'button',
						  'name' => 'theme_option_button_import_demo_data',
						  'url' => admin_url('admin.php?import=wordpress&step=2', 'http'),
						  'default' => ''),
					
					array('title' => __('Export Current Data','ux'),
						  'description' => __('Export your current data to a file and save it on your computer','ux'),
						  'type' => 'button',
						  'name' => 'theme_option_button_export_current_data',
						  'url' => 'export.php?download=true',
						  'default' => ''),
					
					array('title' => __('Import My Saved Data','ux'),
						  'description' => __('Import a data file you have saved.','ux'),
						  'type' => 'button',
						  'name' => 'theme_option_button_import_my_saved',
						  'url' => 'admin.php?import=wordpress',
						  'default' => ''),
					
					array('title' => __('Front Page','ux'),
						  'description' => __('Select which page to display on your FrontPage. If left blank the Blog will be displayed','ux'),
						  'type' => 'select_front',
						  'name' => 'theme_option_select_front_page',
						  'default' => 1820)
				)  
			)
		),
	),
	array(
		'id' => 'general_settings',
		'name' => __('General Settings','ux'),
		'item' => array(
			array(
				'id' => 'logo',
				'name' => __('Logo','ux'),
				'item' =>  array(
					
					array('title' => __('Enable Plain Text Logo','ux'),
						  'description' => __('Use the plain text logo, you need to check it on to enable it.','ux'),
						  'type' => 'cheak',
						  'name' => 'theme_option_cheak_text_logo',
						  'placeholder' => __('Input Text Here','ux'),
						  'default' => true, 
						  'default_text' => __('Bee','ux')),
						  
					array('title' => __('Custom Logo','ux'),
						  'description' => __('Use a custom image as logo','ux'),
						  'type' => 'upload',
						  'name' => 'theme_option_upload_custom_logo',
						  'default' => ''),
						  
					array('title' => __('Custom Retina Logo','ux'),
						  'description' => __('Use a particular image for retina solutions, a double sized Custom Logo is recommend','ux'),
						  'type' => 'upload',
						  'name' => 'theme_option_upload_custom_retina_logo',
						  'default' => ''),
					
					array('title' => __('Logo Width','ux'),
						  'description' => __('Set the custom logo image(not the retina logo image) width','ux'),
						  'type' => 'input',
						  'name' => 'theme_option_logo_width',
						  'default' => __('214','ux'))	  
						  
				)
			),
			array(
				'id' => 'copyright',
				'name' => __('Copyright','ux'),
				'item' =>  array(
					
					array('title' => __('Copyright Information','ux'),
						  'description' => __('Enter the copyright information, it would be place on the bottom of the pages.','ux'),
						  'type' => 'input',
						  'name' => 'theme_option_input_copyright',
						  'placeholder' => __('Copyright @ xxxxxx','ux'),
						  'default' => '')
				)
			),
			array(
				'id' => 'track_code',
				'name' => __('Track Code','ux'),
				'item' =>  array(
					
					array('title' => __('Track Code','ux'),
						  'description' =>'',
						  'type' => 'textarea',
						  'name' => 'theme_option_textarea_track_code',
						  'placeholder' => '',
						  'default' => '')
				)
			),
			array(
				'id' => 'custom_css',
				'name' => __('Custom CSS','ux'),
				'item' =>  array(
					
					array('title' => __('Custom CSS','ux'),
						  'description' =>'',
						  'type' => 'textarea',
						  'name' => 'theme_option_textarea_custom_css',
						  'placeholder' => '',
						  'default' => '')
				)
			),
			array(
				'id' => 'icon',
				'name' => __('Icon','ux'),
				'item' =>  array(
					
					array('title' => __('Custom Favicon','ux'),
						  'description' => __('Upload the favicon for your website, it would be shown on the tab of the browser','ux'),
						  'type' => 'upload',
						  'name' => 'theme_option_upload_custom_favicon',
						  'default' => ''),
						  
					array('title' => __('Custom Mobile Icon','ux'),
						  'description' => __('Upload the icon for the shortcuts on mobile devices','ux'),
						  'type' => 'upload',
						  'name' => 'theme_option_upload_mobile_icon',
						  'default' => '')
				)
			)
		)
	),
	array(
		'id' => 'layout_settings',
		'name' => __('Layout Settings','ux'),
		'item' => array(
			array(
				'id' => 'website_layout',
				'name' => __('Website Layout','ux'),
				'item' =>  array(
					
					array('title' => '',
						  'description' => __('Descriptions','ux'),
						  'type' => 'image_select',
						  'name' => 'theme_option_select_website_layout',
						  'default' => 'website_layout_boxed')
				)
			),
			array(
				'id' => 'header_layout',
				'name' => __('Header Layout','ux'),
				'item' =>  array(
					
					array('title' => '',
						  'description' => __('Select a header layout','ux'),
						  'type' => 'select',
						  'name' => 'theme_option_select_header_layout',
						  'default' => 'fullwidth'),
						  
					array('title' => __('WPML Switcher Enable','ux'),
						  'description' => __('If it is activated, the WPML switcher(flags) would be shown.','ux'),
						  'type' => 'switch',
						  'name' => 'theme_option_switch_wpml',
						  'default' => 'false'),
					
					array('title' => __('Main Menu Bar Fixed Enable','ux'),
						  'description' => __('If it is activated, the main menu would be fixed on top. It is not supported in touch device.','ux'),
						  'type' => 'switch',
						  'name' => 'theme_option_topbar_fixed',
						  'default' => 'true'),	 
					
					array('title' => __('Show Search bar on head','ux'),
						  'description' => '',
						  'type' => 'switch',
						  'name' => 'theme_option_switch_show_search',
						  'default' => 'true'),	 	  
						  
					array('title' => __('Information','ux'),
						  'description' => __('Phone number, email... shown in header','ux'),
						  'type' => 'textarea',
						  'name' => 'theme_option_textarea_header_info',
						  'placeholder' => '',
						  'default' => __('Email: uiueux@gmail.com Phone: +00 21 387','ux')),
						  
					array('title' => __('Show Social Icons on head','ux'),
						  'description' => __('The social media icons would be shown on header','ux'),
						  'type' => 'switch',
						  'name' => 'theme_option_switch_show_social',
						  'default' => 'false'), 
						  
					array('title' => __('Social Medias','ux'),
						  'description' => '',
						  'type' => 'social',
						  'name' => 'theme_option_social_medias',
						  'default' => ''),
						  
					array('title' => __('Show Social Share Button in Post Content Page','ux'),
						  'description' => __('Enable it to show share buttons (Facebook, Twitter, Pinterest.) on every post content page.','ux'),
						  'type' => 'switch',
						  'name' => 'theme_option_switch_show_social_share',
						  'default' => 'false'),
						  
					array('title' => __('Show Back Top Button','ux'),
						  'description' => '',
						  'type' => 'switch',
						  'name' => 'theme_option_switch_show_back_top',
						  'default' => 'false')	  	  
				)
			),
		)
	),
	array(
		'id' => 'styling',
		'name' => __('Styling','ux'),
		'item' => array(
			array(
				'id' => 'color_scheme',
				'name' => '',
				'item' =>  array(
					
					array('title' => __('Select a predefined color scheme','ux'),
						  'description' => '',
						  'type' => 'image_select',
						  'name' => 'theme_option_select_color_scheme',
						  'default' => ''),
						  
					array('title' => __('Theme Main Color','ux'),
						  'description' => __('The color would affect most mouseover effect and linked text colors... <a href="http://www.uiueux.com/a/bee/documentation/themeoption-color.html" target="_blank" class="themeoption-help-a" title="Sample"><span class="themeoption-help">?</span></a>','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_theme_main',
						  'default' => ''),
						  
					array('title' => __('First Auxiliary Color','ux'),
						  'description' => __('The color for top bar(on header layout "Right Menu Bar" ), some module default color block.<a href="http://www.uiueux.com/a/bee/documentation/themeoption-color.html" target="_blank" class="themeoption-help-a" title="Sample"><span class="themeoption-help">?</span></a>','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_auxiliary_first_color',
						  'default' => ''),	 
						  
					array('title' => __('Second Auxiliary Color','ux'),
						  'description' => __('The color for Title Bar, Sidebar, Filters, etc.<a href="http://www.uiueux.com/a/bee/documentation/assets/themeoption-color.html" target="_blank" class="themeoption-help-a" title="Sample"><span class="themeoption-help">?</span></a>','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_auxiliary_second_color',
						  'default' => '')	  
				)
			),
			array(
				'id' => 'general',
				'name' => __('General','ux'),
				'item' =>  array(
					
					array('title' => __('Title Color','ux'),
						  'description' => __('The color for title text','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_title',
						  'default' => ''),
						  
					array('title' => __('Content Text Color','ux'),
						  'description' => __('The color for content text','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_content_text',
						  'default' => ''),
						  
					array('title' => __('Auxiliary Content Color','ux'),
						  'description' => __('The color for auxiliary content text, such as meta of a post','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_auxiliary_content',
						  'default' => ''),
						  
					array('title' => __('Selected Text Bg Color','ux'),
						  'description' => __('The color for selected text background Boxed Layout','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_selected_text_bg',
						  'default' => '')
				)
			),
			array(
				'id' => 'background',
				'name' => __('Background (Bg)','ux'),
				'item' =>  array(
					
					array('title' => __('Page Bg Color','ux'),
						  'description' => __('Background color for the page area','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_page_bg',
						  'default' => ''),
						  
					array('title' => __('Boxed Layout Bg Color','ux'),
						  'description' => __('Background color for boxed layout','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_boxed_layout_bg',
						  'default' => ''),
						  
					array('title' => __('Boxed Layout Bg Image','ux'),
						  'description' => __('Background image for boxed layout','ux'),
						  'type' => 'upload',
						  'name' => 'theme_option_upload_boxed_layout_bg',
						  'default' => ''),
						  
					array('title' => __('Boxed Layout Bg Image Arrangement','ux'),
						  'description' => __('Tile means the image would be tiled to fulfill background area, fill means the image would be resized for the background area. Recommended image size is 1500x1500px for fill option','ux'),
						  'type' => 'select',
						  'name' => 'theme_option_upload_boxed_layout_bg_repeat',
						  'default' => ''),
						  
					array('title' => __('Boxed Layout Bg Image Attachment','ux'),
						  'description' => __('On fixed option, when you scroll the page, background image would not be moved. Fixed is not supported on touch device ','ux'),
						  'type' => 'select',
						  'name' => 'theme_option_upload_boxed_layout_bg_attachment',
						  'default' => '')
						  
				)
			),
			array(
				'id' => 'logo_text',
				'name' => __('Logo','ux'),
				'item' =>  array(
					
					array('title' => __('Logo Text Color','ux'),
						  'description' => __('Color for plain text logo','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_logo_text',
						  'default' => '')
				)
			),
			array(
				'id' => 'menu',
				'name' => __('Menu','ux'),
				'item' =>  array(
			
						  
					array('title' => __('Menu Item Text Color','ux'),
						  'description' => __('Color for menu item text','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_menu_item_text',
						  'default' => ''),
						  
					array('title' => __('Activated Item Text Color','ux'),
						  'description' => __('Color for text of menu item linked the current page','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_activated_item_text',
						  'default' => ''),
						  
					array('title' => __('Submenu Bg Color','ux'),
						  'description' => __('Color for submenu item background','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_submenu_bg',
						  'default' => ''),
						  
					array('title' => __('Submenu Text Color','ux'),
						  'description' => __('Color for submenu item text','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_submenu_text',
						  'default' => '')
				)
			),
			array(
				'id' => 'sidebar',
				'name' => __('Sidebar','ux'),
				'item' =>  array(
						  
					array('title' => __('Sidebar Widget Title Color','ux'),
						  'description' => __('Color for sidebar widget title text','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_sidebar_widget_title',
						  'default' => ''),
						  
					array('title' => __('Sidebar Widget Content Color','ux'),
						  'description' => __('Color for sidebar widget content text','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_sidebar_widge_content',
						  'default' => '')
				)
			),
			array(
				'id' => 'footer',
				'name' => __('Footer','ux'),
				'item' =>  array(

					
					array('title' => __('Copyright Text Color','ux'),
						  'description' => __('Color for copyright information','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_copyright_text',
						  'default' => ''),
						  
					array('title' => __('Widget Title Color','ux'),
						  'description' => __('Color for footer widget title text','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_widget_title',
						  'default' => ''),
						  
					array('title' => __('Widget Content Color','ux'),
						  'description' => __('Color for footer widget content text','ux'),
						  'type' => 'color',
						  'name' => 'theme_option_color_widget_content',
						  'default' => '')
				)
				
				
				
				
				
			)
		)
	),
	array(
		'id' => 'font_settings',
		'name' => __('Font Settings','ux'),
		'item' => array(
			array(
				'id' => '',
				'name' => '',
				'item' =>  array(
					
					array('title' => __('Main Font','ux'),
						  'description' => __('Font for all text besides titles','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_main',
						  'style' => false,
						  'font' => true,
						  'default' => array(
							  'family' => 0,
							  'size' => '12px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Heading Font','ux'),
						  'description' => __('Font for titles','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_heading',
						  'style' => false,
						  'font' => true,
						  'default' => array(
							  'family' => 0,
							  'size' => '22px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Logo Font','ux'),
						  'description' => __('Font for plaint text logo','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_logo',
						  'style' => true,
						  'font' => true,
						  'default' => array(
							  'family' => 0,
							  'size' => '40px',
							  'style' => 'normal'
						  )),
						  
					array('title' => __('Menu Font','ux'),
						  'description' => __('Font for text on menu','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_menu',
						  'style' => true,
						  'font' => true,
						  'default' => array(
							  'family' => 0,
							  'size' => '12px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Post/Page Title Font','ux'),
						  'description' => __('Font for post/page title text','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_post_page_title',
						  'style' => true,
						  'font' => false,
						  'default' => array(
							  'family' => 0,
							  'size' => '22px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Post/Page Content Font','ux'),
						  'description' => __('Font for post/page content text','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_post_page_content',
						  'style' => true,
						  'font' => false,
						  'default' => array(
							  'family' => 0,
							  'size' => '12px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Sidebar Widget Title Font','ux'),
						  'description' => __('Font for sidebar widget title text','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_sidebar_title',
						  'style' => true,
						  'font' => false,
						  'default' => array(
							  'family' => 0,
							  'size' => '16px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Sidebar Widget Content Font','ux'),
						  'description' => __('Font for sidebar widget content text','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_sidebar_content',
						  'style' => true,
						  'font' => false,
						  'default' => array(
							  'family' => 0,
							  'size' => '12px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Footer Copyright Text','ux'),
						  'description' => __('Font for copyright text on footer','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_footer_copyright_text',
						  'style' => true,
						  'font' => false,
						  'default' => array(
							  'family' => 0,
							  'size' => '12px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Footer Widget Title','ux'),
						  'description' => __('Font for widget title text on footer','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_footer_widget_title',
						  'style' => true,
						  'font' => false,
						  'default' => array(
							  'family' => 0,
							  'size' => '16px',
							  'style' => 'light'
						  )),
						  
					array('title' => __('Footer Widget Content','ux'),
						  'description' => __('Font for widget content text on footer','ux'),
						  'type' => 'fonts',
						  'name' => 'theme_option_fonts_footer_widget_content',
						  'style' => true,
						  'font' => false,
						  'default' => array(
							  'family' => 0,
							  'size' => '12px',
							  'style' => 'light'
						  ))
						  
				)
			)
		)
	)

);

/*
============================================================================
	*
	* Theme Option Menu
	*
============================================================================	
*/

function CustomThemeOptionMenu(){
	add_menu_page(__('Bee','ux'), __('Bee','ux'), 'administrator', 'themeoption', 'CustomThemeOptionPage');
	
}

add_action('admin_menu', 'CustomThemeOptionMenu');

function CustomThemeOptionPage(){
	require_once locate_template('/functions/theme/theme-option-view.php');
}

/*
============================================================================
	*
	* Theme Option Show
	*
============================================================================	
*/
function ux_theme_option_show($key,$mod=''){
	
	switch($key){
		case 'logo':
		$theme_option_cheak_text_logo = get_option('theme_option_cheak_text_logo');
		$theme_option_cheak_text_logo_content = get_option('theme_option_cheak_text_logo_content');
		$theme_option_upload_custom_logo = get_option('theme_option_upload_custom_logo');
		$theme_option_upload_custom_retina_logo = get_option('theme_option_upload_custom_retina_logo');
		$theme_option_logo_width = get_option('theme_option_logo_width');
		if(!$theme_option_upload_custom_retina_logo){ $theme_option_upload_custom_retina_logo = get_option('theme_option_upload_custom_logo'); }
		?>
            <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                <?php if($theme_option_cheak_text_logo){
                    if($theme_option_cheak_text_logo == 'true'){
                        echo '<h1>'.$theme_option_cheak_text_logo_content.'</h1>';
                    }else{
                        ?><img class="logo-image" src="<?php echo $theme_option_upload_custom_logo; ?>" alt="<?php echo get_bloginfo('name'); ?>" >
						<img class="logo-image-retina" width="<?php if($theme_option_logo_width) {echo $theme_option_logo_width;}else{ echo '214'; } ?>" src="<?php echo $theme_option_upload_custom_retina_logo; ?>" alt="<?php echo get_bloginfo('name'); ?>" ><?php
                    }
                }else{
                    ?><img class="logo-image" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo get_bloginfo('name'); ?>" >
					<img class="logo-image-retina" width="214" src="<?php echo get_template_directory_uri(); ?>/img/logo-retina.png" alt="<?php echo get_bloginfo('name'); ?>" ><?php
                } ?>
                
            </a>
		<?php
		break;
		
		case 'track_code':
		$theme_option_textarea_track_code = get_option('theme_option_textarea_track_code');
		?>
			<?php if($theme_option_textarea_track_code){
				echo str_replace('\"','"',str_replace("\'","'",$theme_option_textarea_track_code));
			} ?>
		
        <?php
		
		case 'custom_css':
		$theme_option_textarea_custom_css = get_option('theme_option_textarea_custom_css');
		?>
			<?php if($theme_option_textarea_custom_css){
				echo $theme_option_textarea_custom_css;
			} ?>
		
        <?php
		
		break;
		
		case 'favicon':
		$theme_option_upload_custom_favicon = get_option('theme_option_upload_custom_favicon');
		?>
			<?php if($theme_option_upload_custom_favicon){
				?><link rel="shortcut icon" href="<?php echo $theme_option_upload_custom_favicon; ?>"><?php
            }else{
				?><link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico"><?php
            } ?>
            
        <?php
		break;
		
		case 'favicon_mobile':
		$theme_option_upload_mobile_icon = get_option('theme_option_upload_mobile_icon');
		?>
			<?php if($theme_option_upload_mobile_icon){
				?><link rel="apple-touch-icon-precomposed" href="<?php echo $theme_option_upload_mobile_icon; ?>"><?php
            }else{
				?><link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-114x114.png"><?php
            } ?>
            
        <?php
		break;
		
		case 'website_layout':
		$theme_option_select_website_layout = get_option('theme_option_select_website_layout');
		?>
			<?php if($theme_option_select_website_layout){
				if($theme_option_select_website_layout == 'website_layout_fullwidth'){
					echo 'class="fullwidth_ux"';
				}
            }?>
        <?php
		break;
		
		case 'header_info':
		$theme_option_select_header_layout = get_option('theme_option_select_header_layout');
		?>
			<?php if($mod == 'mobile'): ?>
            
                <div class="header-info-mobile">
                    <span><?php echo get_option('theme_option_textarea_header_info'); ?></span>
                </div><!--End header-info-mobile-->
            
            <?php else: ?>
			
				<?php if($theme_option_select_header_layout != 'fullwidth'){
                    ?><div class="header_info"><?php echo get_option('theme_option_textarea_header_info'); ?></div><!--End top_bar_info--><?php
                }else{
                    ?><div class="header_info"><?php echo get_option('theme_option_textarea_header_info'); ?></div><!--End top_bar_info--><?php
                }?>
            
            <?php endif; ?>
        <?php
		break;
		
		case 'header_wpml':
		$theme_option_switch_wpml = get_option('theme_option_switch_wpml'); 
		?>
			<?php if($theme_option_switch_wpml == 'true'): ?>
            
				<?php
                if (function_exists('language_flags')) {
                    language_flags($mod);
                }
                ?>
            
            <?php endif; ?>
        <?php
		break;
		
		case 'header_navi':
		?>
            <nav id="navi">
                <?php
                wp_nav_menu(array( 
                    'theme_location' => 'primary', 
                    'container_id' => 'navi_wrap',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                    ) 
                );
                
                ?>
                <!--End #navi_wrap-->
            </nav>
        <?php
		break;
		
		case 'copyright':
		$theme_option_input_copyright = get_option('theme_option_input_copyright'); 
		?>
            <?php if($theme_option_input_copyright){
				echo $theme_option_input_copyright;
			}?>
        <?php
		break;
		
		case 'header_socialicons':
		$theme_option_switch_show_social = get_option('theme_option_switch_show_social'); 
		$theme_option_social_medias = get_option('theme_option_social_medias'); 
		$theme_option_social_tomedias_url = get_option('theme_option_social_tomedias_url'); 
		$split_medias = explode("\'%_%\'",$theme_option_social_medias);
		$split_medias_url = explode("\'%_%\'",$theme_option_social_tomedias_url);
		
		global $option_social_networks;
		?>
            <?php if($theme_option_switch_show_social == 'true'): ?>
            
				<?php if($mod == 'mobile'): ?>
                
                <h3 class="mobile-header-tit"><?php _e('Social Network','ux'); ?></h3>
                <ul>
                    <?php 
                    for($i=0; $i<count($split_medias) - 1; $i++){ 
                        $medias_url = $split_medias_url[$i];
						foreach($option_social_networks as $social){
							if($social['icon'] == $split_medias[$i]){
                                ?><li><a title="<?php echo $social['dec']; ?>" href="<?php echo $medias_url; ?>" class="social_active"><?php echo $social['name']; ?></a></li><?php
                            }
                    
                        }
                        ?>
                    <?php } ?>
                </ul>
                
                <?php else: ?>
                
                <div id="socialicons">
                    <?php 
                    for($i=0; $i<count($split_medias) - 1; $i++){ 
                        $medias_url = $split_medias_url[$i];
						foreach($option_social_networks as $social){
							if($social['icon'] == $split_medias[$i]){
                                ?><a title="<?php echo $social['dec']; ?>" href="<?php echo $medias_url; ?>" class="social_active"><i class="<?php echo $social['icon']; ?>"></i><span><i class="<?php echo $social['icon']; ?>"></i></span></a><?php
                            }
                    
                        }
                        ?>
                    <?php } ?>
                </div><!--End #socialicons-->
                
                <?php endif; ?>

                
            <?php endif; ?>
            
        <?php
		break;
		
    }  
}


?>