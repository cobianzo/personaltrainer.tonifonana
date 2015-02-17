<?php get_header(); ?>

      <!--Page--->
		<div id="main">
			<?php while ( have_posts() ) : the_post();?>
            <div id="main_title_wrap" data-module="true">
                <div class="container main_title_wrap_inn">
                    <p class="breadcrumbs pull-right visible-desktop">
						<?php if (function_exists('show_full_breadcrumb')) show_full_breadcrumb(); ?>
                    </p>
                
                    <div id="main_title">
                        <h1 class="main_title"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div><!--End #main_title_wrap-->
			<div class="title_wrap_line"></div><!--End .title_wrap_line-->
			
            <div id="content" class="container">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php 
                $get_post_type = get_post_type();
				$post_option_select_sidebar  = get_post_meta(get_the_ID(), "post_option_select_sidebar", true);
				
				if($post_option_select_sidebar){
					if($post_option_select_sidebar == 'post_sidebar_left'){
						$sidebar_class = 'span8 pull-right';
					}elseif($post_option_select_sidebar == 'post_sidebar_no'){
						$sidebar_class = 'span12';
					}else{
						$sidebar_class = 'span8';
					}
				}else{
					$sidebar_class = 'span8';
				} ?>
                
                    <div class="row">
                        <div id="content_wrap" class="<?php echo $sidebar_class; ?>">
                    
                            <?php if( ux_custom_meta( 'pagebuilder_switch' ) == 'switch_pagebuilder' ) {
                                
                                ux_show_module();
                                
                            } else {
                                
                                get_template_part('single','template');
                                
                            }?>
                            
                            <?php if(comments_open(get_the_ID())){
                                comments_template();
                            }?>
                        
                        </div>
                        
                        <?php if($post_option_select_sidebar != 'post_sidebar_no' || !$post_option_select_sidebar): ?>
                        <aside id="sidebar" class="span4" data-module="true">
                            <ul class="sidebar_widget">
                                <?php $post_option_select_sidebars = get_post_meta(get_the_ID(), "post_option_select_sidebars", true); 
                                if($post_option_select_sidebars){
									if($post_option_select_sidebars != 'none'){
										if( !function_exists('dynamic_sidebar') || !dynamic_sidebar($post_option_select_sidebars) ) : endif;
									}else{
										dynamic_sidebar('sidebar_default');
									}
								}else{
									dynamic_sidebar('sidebar_default');
								}?>	
                            </ul>
                        </aside>
                        <?php endif; ?>
                    
                    </div>
                </div>
			</div><!--End #content-->
            <?php endwhile; ?>
		</div><!--End #main-->
        
        
<?php get_footer(); ?>