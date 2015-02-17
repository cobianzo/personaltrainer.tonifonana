<?php
	$post_option_select_bottom_specing = get_post_meta(get_the_ID(), 'post_option_select_bottom_specing', true);
	$specing_css = "";
	if($post_option_select_bottom_specing){
		if($post_option_select_bottom_specing != 'no'){
			$specing_css = "";
		}else{
			$specing_css = "class='foot-no-margintop'";
		}
		
	}
	
?>
<!--Footer-->
		<footer id="footer_wrap" <?php echo $specing_css; ?> data-module="true">
        
            <ul style="" class="container" id="foot_widget">
                <?php dynamic_sidebar( 'footer-widget' ); ?>
			</ul>
            <div id="footer-bar"><?php ux_theme_option_show('copyright'); ?></div>
		</footer>
		<!--End Footer-->
	</div>
  	<!--End #wrap-->	
	
	<!--Back Top button-->
   	<?php $theme_option_switch_show_back_top = get_option('theme_option_switch_show_back_top'); ?>
	
	<?php if($theme_option_switch_show_back_top  == 'true'):?>
	 
	<div id="backtop"><i class="m-angle-up"></i></div>
	
	<?php endif; ?>
   
    <!--print Track code-->
	<?php ux_theme_option_show('track_code'); ?>
	
	<?php wp_footer(); ?>
  </body>
</html>