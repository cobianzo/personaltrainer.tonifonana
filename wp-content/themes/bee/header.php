<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<?php ux_theme_option_show('favicon'); ?>
    <?php ux_theme_option_show('favicon_mobile'); ?>
	
	<noscript>
		<style>
            #socialicons>a span { top: 0px;left: -100%; -webkit-transition: all 0.3s ease; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; -ms-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; }
            #socialicons>ahover div{ left: 0px; }
        </style>
    </noscript>
	
    <?php wp_head(); ?>
	
	
  </head>
  <body <?php body_class(); ?>>
  	<div id="jquery_jplayer" class="jp-jplayer"></div>
    <div id="wrap" <?php ux_theme_option_show('website_layout'); ?>>	
	<!-- Header -->
		<?php 
		$theme_option_select_header_layout = get_option('theme_option_select_header_layout'); 
		?>
        <?php if($theme_option_select_header_layout == 'fullwidth'){
			$header_layout = 'header-layout-b';
		}else{
			$header_layout = 'header-layout-a';
		}?>
		
        <div id="mobile-header-meta" style="">
		<?php $theme_option_switch_show_search = get_option('theme_option_switch_show_search'); 
		if($theme_option_switch_show_search!= 'false'):
		?>
            <div id="search_mobile">
                <form name="" method="get" action="<?php echo home_url();?>" class="search_top_form">
                    <input type="search" onBlur="if (this.value == '') {this.value = '<?php _e('search','ux'); ?>';}" onFocus="if (this.value == '<?php _e('search','ux'); ?>') {this.value = '';}" name="s" value="<?php _e('search','ux'); ?>" class="search_top_form_text">
                    <input type="submit" value="" name="submitsearch" style="display:none" class="search_top_form_button">
                </form>
            </div><!--End #search_top-mobile-->
        <?php endif; ?>
            <?php ux_theme_option_show('header_socialicons','mobile'); ?>
        
            <?php ux_theme_option_show('header_wpml','mobile'); ?>
            
            <?php ux_theme_option_show('header_info','mobile'); ?>
			
		</div>
        
        <header id="header_wrap" class="<?php echo $header_layout; ?> clearfix" data-module="true">	
			
            
            <?php if($theme_option_select_header_layout == 'fullwidth'): ?>
                <div class="header_line"></div><!--End header_line-->
            <?php endif; ?>
            
            <?php if($theme_option_select_header_layout != 'fullwidth'): ?>
                <div id="top_bar">
			
                    <div class="top_bar_inn container">
					
					
					
						<?php //ALV: añadido por mi
						if (is_user_logged_in()) {
							global $current_user;
							echo "<font>".__('loggeado como')." ".$current_user->display_name."</font> 
							<a href='".admin_url( 'user-edit.php?user_id=' . $current_user->ID, 'http' )."' rel='noindex nofolloe'>".__('edita perfil')."</a>";
							echo "| <font><a href='".wp_logout_url(get_permalink())."' rel='noindex nofolloe'>".__('logout')."</a> </font>";
						}else {		
							echo "<font><a href='".wp_login_url(get_permalink())."' rel='noindex nofollow'>".__('accede')."</a> | <a href='".wp_registration_url()."' rel='noindex nofollow'>".__('registrate')."</a>&nbsp;&nbsp;&nbsp;</font>";
						?>
                        <?php ux_theme_option_show('header_info'); ?>
                        <?php ux_theme_option_show('header_wpml'); ?>
                        <?php } ?>
                    </div>
                </div><!--End .top_bar-->	
            <?php endif; ?>
            
			<div id="header_inn" class="container">	
				
				<div id="headerinn_main" class="pull-right">
				
                    <?php if($theme_option_select_header_layout == 'fullwidth'): ?>
                    
                    <div class="top_bar_inn">
				
						<?php ux_theme_option_show('header_wpml'); ?>
                        <?php ux_theme_option_show('header_info'); ?>
                        
                    </div>
                    
                    <?php else: ?>
                    
                    <?php ux_theme_option_show('header_navi'); ?>
					
					<div id="headerinn_s">
					<?php if($theme_option_switch_show_search!= 'false'): ?>
						<div id="search_top">
						<form class="search_top_form" action="<?php echo home_url();?>" method="get" name="">
							<input id="s" class="search_top_form_text" type="search" value="<?php _e('SEARCH','ux'); ?>" name="s" onFocus="if (this.value == '<?php _e('SEARCH','ux'); ?>') {this.value = '';}" onBlur="if (this.value == '') {this.value = '<?php _e('SEARCH','ux'); ?>';}">
							<input class="search_top_form_button" style="display:none" type="submit" name="submitsearch" value="">
						</form>
						</div><!--End #search_top-->
					<?php endif; ?>	
						<?php ux_theme_option_show('header_socialicons'); ?>
                        
						
						
					</div><!--End #headerinn_s-->
                    
                    <?php endif; ?>
					
					
				</div><!--End #headerinn_main-->
	
				<div class='hidefaraway'>
				<?php 
				if (is_single() && has_post_thumbnail()) {
					the_post_thumbnail();
				}
				?></div>
				<div id="logo"><?php ux_theme_option_show('logo'); ?></div>
			</div><!--End #header_inn-->
            
            <?php if($theme_option_select_header_layout != 'fullwidth'): ?>
                <div class="header_line"></div><!--End header_line-->
            <?php else: ?>
                <div id="header-meun-bar">
            
                    <div class="container" id="header-meun-bar-inn">	
                    
                        <?php ux_theme_option_show('header_navi'); ?>
                        
                        <div id="headerinn_s">
                        
                            <?php ux_theme_option_show('header_socialicons'); ?>
                            <?php if($theme_option_switch_show_search!= 'false'): ?>
                            <div id="search_top">
                            <form name="" method="get" action="<?php echo home_url();?>" class="search_top_form">
                                <input type="search" onBlur="if (this.value == '') {this.value = '<?php _e('SEARCH','ux'); ?>';}" onFocus="if (this.value == '<?php _e('SEARCH','ux'); ?>') {this.value = '';}" name="s" value="<?php _e('SEARCH','ux'); ?>" class="search_top_form_text" id="s">
                                <input type="submit" value="" name="submitsearch" style="display:none" class="search_top_form_button">
                            </form>
                            </div><!--End #search_top-->
                            <?php endif; ?>
                        </div><!--End #headerinn_s-->
                    
                    </div><!--End header-meun-bar-inn-->
                    
                </div>
			<?php endif; ?>
		</header>
		<!--End Header-->
        
        <?php $theme_option_topbar_fixed = get_option('theme_option_topbar_fixed'); ?>
        <div id="topbarfixed" <?php if($theme_option_topbar_fixed  == 'true'):?>class="topbarfixed-yes"<?php endif; ?>></div>