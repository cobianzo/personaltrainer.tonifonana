        <!--Page-->
		<div id="main">
			<div id="main_title_wrap" data-module="true">
                <div class="container main_title_wrap_inn">
                    <div id="main_title">
                        <h1 class="main_title">
                        <?php 
                        if( is_category()) { 
                            
                            _e('Category: ','ux'); echo single_cat_title(); } 
                        
                        elseif(is_archive()){
                            
                            if(is_day()){
                                printf( __( 'Archives: %s', 'ux' ), get_the_date());
                            
                            }elseif(is_month()){
                                printf( __( 'Archives: %s', 'ux' ), get_the_date(_x( 'F Y', 'monthly archives date format', 'ux' )));
                            
                            }elseif(is_year()){
                                printf( __( 'Archives: %s', 'ux' ), get_the_date(_x( 'Y', 'yearly archives date format', 'ux' )));
                            
                            }else{
                                _e( 'Archives', 'ux' );
                            
                            };
                        } else {
						
								_e( 'Archives', 'ux' );
						}
                        ?>
                        </h1>
                    </div>
                </div>
            
            </div><!--End #main_title_wrap-->
			<div class="title_wrap_line"></div><!--End .title_wrap_line-->
			
			<div id="content" class="container">
			
				<div class="row">
					
					<!--
					Main conent
					-->
					<div id="content_wrap" class="span8">
						
						<!-- 
						Archive wrap 
						-->
						 	<div class="archive-wrap">
								<ul>
									<?php
									if(have_posts()) {
										while ( have_posts() ) : the_post(); ?>
                                        <li class="archive-wrap-item"><h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3><p class="archive_date"><?php echo get_the_time('F j, Y'); ?></p></li>
                                        
                                        <?php 
										endwhile;
									} ?>
								</ul>
                                <?php ux_themepagination(); ?>
								
							</div><!--end .archive-wrap-->
					
						
						
					</div><!--End content_wrap-->
					
					<!--
					Sidaber
					-->
					<aside id="sidebar" class="span4" data-module="true">
					
						<ul class="sidebar_widget">
							<?php dynamic_sidebar('sidebar_default'); ?>	
                        </ul>
						
					</aside><!--End sidebar-->
	 
				</div><!--End row-->
			
			</div><!--End #content-->
		</div><!--End #main-->