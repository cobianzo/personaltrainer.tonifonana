<?php
/*
============================================================================
	*
	* Admin css and scripts 
	*
============================================================================	
*/
function CustomAdminThemeEnqueueScripts(){
	//wp_register_style('custom_wp_colorpicker', get_template_directory_uri(). '/functions/theme/css/colorpicker.css', false);
	//wp_enqueue_style('custom_wp_colorpicker');
	
	wp_register_style('custom_wp_spectrum', get_template_directory_uri(). '/functions/theme/css/spectrum.css', false);
	wp_enqueue_style('custom_wp_spectrum');
	
	wp_register_style('custom_wp_theme_css', get_template_directory_uri(). '/functions/theme/css/style.css', false);
	wp_enqueue_style('custom_wp_theme_css');
	
	
	//wp_enqueue_script('bootstrap-colorpicker',get_template_directory_uri(). '/functions/theme/js/bootstrap-colorpicker.js',array( 'jquery' ),'2.0.0',true);
	
	wp_enqueue_script('spectrum',get_template_directory_uri(). '/functions/theme/js/spectrum.js',array( 'jquery' ),'2.0.0',true);
	
	if(get_post_type() == 'post' || get_post_type() == 'page'){
		wp_enqueue_script('theme-layout',get_template_directory_uri(). '/functions/theme/js/theme.layout.js',array( 'jquery' ),'1.0.0',true);
	}
	
//	global $theme_google_fonts;
//	foreach($theme_google_fonts as $i => $font){
//		if($font['import'] != ''){
//			wp_register_style( 'theme-google-font-'.$i, $font['url'], array(), '1' ); 
//			wp_enqueue_style( 'theme-google-font-'.$i );
//		}
//		
//	}

	if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
}
add_action('admin_enqueue_scripts','CustomAdminThemeEnqueueScripts');

/*
============================================================================
	*
	* Theme Language Flags
	*
============================================================================	
*/
function language_flags($mod=''){
	if (function_exists('icl_get_languages')) {
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		if(!empty($languages)){
			if($mod == 'mobile'){
				echo '<h3 class="mobile-header-tit">'.__('Select Language','ux').'</h3>';
				echo '<ul>';
				foreach($languages as $l){
					echo '<li>';
					if($l['country_flag_url']){
						if(!$l['active']) {
							echo '<a href="'.$l['url'].'">'.$l['translated_name'].'</a>';
						} else {
							echo '<div class="current-language"><a href="'.$l['url'].'">'.$l['translated_name'].'</a></div>';
						}
					}
					echo '</li>';
				}
				echo '</ul>';
				?>
                
                
                <?php
			}else{
				echo '<div id="header-translation">';
				echo '<ul id="header-language-flags" class="clearfix">';
				foreach($languages as $l){
					echo '<li>';
					if($l['country_flag_url']){
						if(!$l['active']) {
							echo '<a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></a>';
						} else {
							echo '<div class="current-language"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></div>';
						}
					}
					echo '</li>';
				}
				echo '</ul>';
				echo '</div><!--End header-translation-->';
			}
		}
	} else {
		echo "<p class='wpml-tip'>". __('WPML not installed and activated.','ux') ."</p>";
	}
}

            

/*
============================================================================
	*
	* Theme Ajax
	*
============================================================================	
*/
require_once locate_template('/functions/theme/theme-ajax.php');

/*
============================================================================
	*
	* Theme Option
	*
============================================================================	
*/
require_once locate_template('/functions/theme/theme-option.php');

/*
============================================================================
	*
	* Theme import
	*
============================================================================	
*/
require_once locate_template('/functions/theme/theme-import.php');

/*
============================================================================
	*
	* Theme export
	*
============================================================================	
*/
require_once locate_template('/functions/theme/theme-export.php');
?>