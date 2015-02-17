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
                                the_title();
                            
                            };
                        } else {
						
								the_title();
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
										while ( have_posts() ) : the_post(); 
										
										the_content();
										
										?>
                                         
                                        
                                        <?php 
										endwhile;
									} ?>
								</ul>
																
							</div><!--end .archive-wrap-->
					
						
						
					</div><!--End content_wrap-->
					
					<!--
					Sidaber
					-->
					<aside id="sidebar" class="span4" data-module="true">
					
						<ul class="sidebar_widget">
							<?php dynamic_sidebar('forum'); ?>	
                        </ul>
						
					</aside><!--End sidebar-->
	 
				</div><!--End row-->
			
			</div><!--End #content-->
		</div><!--End #main-->