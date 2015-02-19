<?php
/*
============================================================================
	*
	* Module pagenums
	*
============================================================================	
*/
function ux_view_module_pagenums($post_id,$per_page,$count_post,$module_id,$module_post){
	$module_select_pagination = ux_get_module_meta($module_post, 'module_select_pagination', $post_id);
	
	if($per_page != '-1'){
		$page_paged = ceil($count_post/$per_page);
	}else{
		$page_paged = '1';
	}
	
	if($module_select_pagination): 
		if($module_select_pagination == 'page_number'):
		?>
		<?php if($page_paged > 1): ?>
        <div class="clearfix pagenums"> 
            <div class="pagination">
				<?php
                $i = 0;
                for($i=1; $i<=$page_paged; $i++){
                    if($i == 1){
                        $current = 'current';
                    }else{
                        $current = '';
                    }
					?><a class="<?php echo $current; ?> inactive select_pagination not_pagination" data-post="<?php echo $module_post; ?>" data-postid="<?php echo $post_id; ?>" data-paged="<?php echo $i; ?>" data-module=<?php echo $module_id; ?> href="#"><?php echo $i; ?></a><?php
                }?>
            </div>
        </div><!--End pagenums-->
        <?php endif; ?>
        
		<?php elseif($module_select_pagination == 'twitter'):?>
        
			<?php if($page_paged > 1):?>
            <div class="clearfix pagenums tw_style page_twitter">
                <a data-post="<?php echo $module_post; ?>" data-postid="<?php echo $post_id; ?>" data-paged="2" data-count="<?php echo $page_paged; ?>" data-module=<?php echo $module_id; ?> href="#" class="not_pagination"><?php _e('Load More','ux'); ?></a>
            </div>
            <?php endif; ?>
        
        <?php elseif($module_select_pagination == 'infiniti_scroll'): ?>
        
        <div class="clearfix pagenums tw_style infiniti_scroll">
            <a data-post="<?php echo $module_post; ?>" data-postid="<?php echo $post_id; ?>" data-paged="2" data-module=<?php echo $module_id; ?> href="#" class="not_pagination"><?php _e('Load More','ux'); ?></a>
        </div>
        
        <?php
		endif;
	endif; ?>
<?php	
}

/*
============================================================================
	*
	* Module Load
	*
============================================================================	
*/
function ux_view_module_load($module_id, $post_id, $paged, $module_post){
	
	switch($module_id){
		
		case 'blog':
		
			$module_select_list_type = ux_get_module_meta($module_post, 'module_select_list_type', $post_id);
			$module_select_category = ux_get_module_meta($module_post, 'module_select_category', $post_id);
			$module_select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', $post_id);
			$module_select_order = ux_get_module_meta($module_post, 'module_select_order', $post_id);
			$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', $post_id);
			
			if($module_input_per_page != ''){
				$per_page = $module_input_per_page;
			}else{
				$per_page = '-1';
			}
				
			if($module_select_orderby != '-1'){
				$orderby = $module_select_orderby;
			}else{
				$orderby = 'none';
			}
				
			if($module_select_order == 'descending'){
				$order = 'DESC';
			}else{
				$order = 'ASC';
			}
				
			$idObj = get_category_by_slug($module_select_category);
			if($idObj){
				$set_category = $idObj->term_id;
			}else{
				$set_category = '0';
			}
			
			if($module_select_list_type == 'masonry_list'){
				$blog_query = new WP_Query(array(
					'posts_per_page' => $per_page,
					'showposts' => $per_page,
					'paged' => $paged,
					'cat' => $set_category,
					'orderby' => $orderby,
					'order' => $order
				));
				
				?>
                
				<?php 
                if($blog_query->have_posts()){
                    while($blog_query->have_posts()){
                        $blog_query->the_post();
                        $thumb_src_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                        $thumb_src_360 = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'standard-thumb');
                        $blog_categories = get_the_category(get_the_ID());
                        $separator = ' ';
                        $output = '';
                        if($blog_categories){
                            foreach($blog_categories as $category){
                                $output .= 'filter_'.$category->slug.$separator;
                            }
                        }
                        
                        if(get_post_format(get_the_ID()) == ''){
                            $get_post_format = 'standard';
                        }else{
                            $get_post_format = get_post_format(get_the_ID());
                        }
                        
                        global $theme_color;
                        $post_background_color = get_post_meta(get_the_ID(), 'post_background_color', true);
                        if($post_background_color){
                            $item_topbar_color = 'bg-'.$theme_color[$post_background_color]['value'];
                        }else{
                            $item_topbar_color = 'post-bgcolor-default';
                        }
                        
                        ?>
                        <div class="<?php echo trim($output, $separator); ?> width2 isotope-item <?php echo $get_post_format; ?>">
                            <div class="inside" style="margin:40px 0 0 40px;">
                                <div>
                                    <div class="item_topbar <?php echo $item_topbar_color; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="item_link"></a></div>
                                    
                                    <?php if(has_post_format('quote')): ?>
                                        <?php $post_option_textarea_quote = get_post_meta(get_the_ID(), "post_option_textarea_quote", true); ?>
                                        <div class="item_des"><i class="m-quote-left"></i>
                                            <p><?php echo $post_option_textarea_quote; ?></p>
                                            <div class="like clear"></div><!--End like-->
                                        </div>
                                        
                                    <?php elseif(has_post_format('link')): ?>
                                        <?php 
                                        $post_option_link_item_title = get_post_meta(get_the_ID(), "post_option_link_item_title", true);
                                        $post_option_link_item_url = get_post_meta(get_the_ID(), "post_option_link_item_url", true); ?>
                                        
                                        <div class="item_des">
                                            <?php for($i=0; $i<count($post_option_link_item_title); $i++){ ?>
                                                <p><a title="<?php echo $post_option_link_item_title[$i]; ?>" href="<?php echo $post_option_link_item_url[$i]; ?>"><?php echo $post_option_link_item_title[$i]; ?></a></p>
                                            <?php } ?>
                                            <div class="like clear"></div><!--End like-->
                                        </div>
                                        
                                    <?php elseif(has_post_format('audio')): ?>
                                        <?php $post_option_select_audio_layout = get_post_meta(get_the_ID(), "post_option_select_audio_layout", true); ?>
                                        <?php if($post_option_select_audio_layout == 'post_soundcloud'):?>
                                            <div class="item_des">
                                                <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                                <div class="soundcloudWrapper">
                                                    <?php $post_option_textarea_soundcloud = get_post_meta(get_the_ID(), 'post_option_textarea_soundcloud', true); ?>
                                                    <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $post_option_textarea_soundcloud;?>&amp;color=ff3900&amp;auto_play=false&amp;show_artwork=false"></iframe>
                                                </div>
                                                <div class="like clear"></div><!--End like-->
                                            </div>
                                            
                                        <?php else: ?>
                                            <?php
                                            $post_option_mp3_title = get_post_meta(get_the_ID(), "post_option_mp3_title", true);
                                            $post_option_mp3_url = get_post_meta(get_the_ID(), "post_option_mp3_url", true); ?>
                                            <div class="item_des">
                                                <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                            </div>
                                            <ul class="audio_player_list">
                                                <?php foreach($post_option_mp3_title as $num => $t): ?>
                                                <li class="audio-unit"><span id="audio<?php echo get_the_ID(). $num; ?>" class="audiobutton pause" rel="<?php echo $post_option_mp3_url[$num]; ?>"></span><span class="songtitle" title="<?php echo $post_option_mp3_title[$num];?>"><?php echo $post_option_mp3_title[$num];?></span>
                                                </li>
                                                  
                                                <?php endforeach; ?>
                                            </ul>
                                            
                                        <?php endif; ?>
                                        
                                    <?php elseif(has_post_format('video')): ?>
                                        <?php
                                        $post_option_textarea_embeded = get_post_meta(get_the_ID(), 'post_option_textarea_embeded', true);
                                        $post_option_input_m4v = get_post_meta(get_the_ID(), 'post_option_input_m4v', true);
                                        $post_option_input_ogv = get_post_meta(get_the_ID(), 'post_option_input_ogv', true);
                                        if($post_option_input_m4v != ''){
                                            $video_file = $post_option_input_m4v;
                                        }else{
                                            $video_file = $post_option_input_ogv;
                                        }
                                        ?>
                                        <div class="videoWrapper">
                                            <?php if($post_option_textarea_embeded): ?>
                                                <?php if($post_option_textarea_embeded != ''): ?>
                                                    <?php if ( ereg ("youtube", $post_option_textarea_embeded) && !(ereg("iframe", $post_option_textarea_embeded))) : ?>
                                                    <iframe src="http://www.youtube.com/embed/<?php echo get_you_tube_id($post_option_textarea_embeded);?>?rel=0&controls=1&showinfo=0&theme=light&autoplay=0&wmode=transparent"></iframe>
                                                    <?php elseif ( ereg ("vimeo", $post_option_textarea_embeded) && !(ereg("iframe", $post_option_textarea_embeded))) : ?>
                                                    <iframe src="http://player.vimeo.com/video/<?php echo get_vimeo_id($post_option_textarea_embeded); ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" height="auto" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                                    <?php else :?>
                                                        <?php echo $post_option_textarea_embeded; ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <iframe width="100%" height="auto" frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="<?php echo $video_file; ?>"></iframe>
                                                <?php endif; ?>
                                            
                                            <?php endif; ?>
                                            
                                        </div>
                                        <div class="item_des">
                                            <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                            <div class="like clear"></div><!--End like-->
                                        </div>
                                          
                                        <?php elseif(has_post_format('gallery')): ?>
                                        
                                            <div class="item_des">
                                                <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                                <?php if(get_the_excerpt()){ ?><div class="item-des-p"><?php the_excerpt(); ?></div><?php } ?>
                                                <?php 
                                                $post_option_gallery_selected = get_post_meta(get_the_ID(), "post_option_gallery_selected", true);
                                                ?>
                                                <?php if($post_option_gallery_selected): ?>
                                                <ul class="item_gallery">
                                                    <?php foreach($post_option_gallery_selected as $num => $image):
                                                    $thumb_src_full = wp_get_attachment_image_src( $image, 'full');
													$thumb_src = wp_get_attachment_image_src( $image, 'blog-thumb'); ?>
                                                    <?php if($num < 3): ?>
                                                    <li><a href="<?php echo $thumb_src_full[0]; ?>" class="lightbox" rel="post<?php the_ID(); ?>" title="<?php echo get_the_title($image); ?>"><img src="<?php echo $thumb_src[0]; ?>" alt="" /></a></li>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <?php endif; ?>
                                                
                                                <div class="like clear"></div><!--End like-->
                                            </div><!--End item_des-->
                                        
                                        
                                        <?php else: ?>
                                        
                                            <?php if(has_post_thumbnail()): ?>
                                                <a href="<?php echo $thumb_src_full[0]; ?>" class="lightbox" rel="post<?php the_ID(); ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo $thumb_src_360[0]; ?>" ></a>
                                            <?php endif; ?>
                                            
                                            <div class="item_des">
                                                <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                              <?php if(get_the_excerpt()){ ?><div class="item-des-p"><?php the_excerpt(); ?></div><?php } ?>
                                                <div class="like clear"></div><!--End like-->
                                            </div>
                                        
                                        <?php endif; ?>
                                      
                                    </div>
                                </div><!--End inside-->
                        </div><!--End isotope-item-->
                        <?php
                        }
                        wp_reset_postdata();
                    }
                ?>
                
			<?php
            }elseif($module_select_list_type == 'standard_list'){
				$blog_query = new WP_Query(array(
					'posts_per_page' => $per_page,
					'showposts' => $per_page,
					'paged' => $paged,
					'cat' => $set_category,
					'orderby' => $orderby,
					'order' => $order,
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array(
								'post-format-gallery',
								'post-format-image',
								'post-format-quote',
								'post-format-link',
								'post-format-audio',
								'post-format-video'
							),
							'operator' => 'NOT IN'
						)
					)
				));
				if($blog_query->have_posts()){
					while($blog_query->have_posts()){
						$blog_query->the_post();
						$thumb_src_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
						
						
						global $theme_color;
						$post_background_color = get_post_meta(get_the_ID(), 'post_background_color', true);
						
						if($post_background_color){
							$item_topbar_color = 'bg-'.$theme_color[$post_background_color]['value'];
						}else{
							$item_topbar_color = 'post-bgcolor-default';
						}
						
						if($thumb_src_full != ''){
							$min_height = '';
						}else{
							$min_height = 'min-height:300px;';
						}
						$standard_blog_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id (get_the_ID()), 'standard-blog-thumb');
						?>
						<section class="blog-item">
						
							<div  class="date-block hidden-phone <?php echo $item_topbar_color; ?>">
								<p class="date-block-big"><?php echo get_the_time('d');?></p>
								<p class="date-block-m"><?php echo get_the_time('M');?></p>
								<p class="date-block-y"><?php echo get_the_time('Y');?></p>
								<p><a href="#"><?php echo get_avatar(get_the_author_meta('ID')); ?></a></p>
							</div><!--End .date-block-->
							
							<?php if(has_post_thumbnail()): ?>
							<div class="blog-item-img">
							<a class="lightbox" href="<?php echo $thumb_src_full[0]; ?>">
							<div class="blog-item-img-hover"><i class="m-eye"></i></div>
							<img alt="" src="<?php echo $standard_blog_thumb_src[0]; ?>" >
							</a>
							</div>
							<?php endif; ?>
							
							<div class="blog-item-main">
								<h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="blog-item-excerpt">
								<?php the_excerpt(); ?>
								</div><!--End blog-item-excerpt-->
								<ul class="blog_meta">
									<li class="blog_meta_date"><i class="m-calendar"></i><?php echo get_the_time('F j Y'); ?></li>
									<li class="blog_meta_cate"><i class="m-edit"></i><?php the_category(', '); ?></li>	
								</ul><!--End .blog_meta-->
							</div><!--End .blog-item-main-->
							
							
						</section>
					<?php
					}
					wp_reset_postdata();
				}
				?><div class="clearfix"></div><?php
			}
			?> 
        
        <?php
        break;
		
		case 'gallery':
			$module_select_image_source = ux_get_module_meta($module_post, 'module_select_image_source', $post_id);
			$module_select_image_spacing = ux_get_module_meta($module_post, 'module_select_image_spacing', $post_id);
			$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', $post_id);
			$module_select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', $post_id);
			$module_select_order = ux_get_module_meta($module_post, 'module_select_order', $post_id);
			$module_select_category = ux_get_module_meta($module_post, 'module_select_category', $post_id);
			$module_select_mouseover_effect = ux_get_module_meta($module_post, 'module_select_mouseover_effect', $post_id);
			$module_select_first_item = ux_get_module_meta($module_post, 'module_select_first_item', $post_id);
			//$module_select_image_list_type = ux_get_module_meta($module_post, 'module_select_image_list_type', $post_id);
			$module_select_image_ratio = ux_get_module_meta($module_post, 'module_select_image_ratio', $post_id);
			$module_select_gallery_selected = ux_get_module_meta($module_post, 'module_select_gallery_selected', $post_id);
			
			
			/*if($module_select_image_list_type=='masonry'){
				$module_select_image_ratio = 'auto';
			}else{	
				$module_select_image_ratio = ux_get_module_meta($module_post, 'module_select_image_ratio', $post_id);
				$module_select_first_item = 'false';
			}*/
			
			$split_gallery = explode("'%_%'",$module_select_gallery_selected);
				
			if($module_select_image_spacing){
				$isotope_style = 'margin:-'.$module_select_image_spacing.' 0 0 -'.$module_select_image_spacing;
				$inside_style = 'margin:'.$module_select_image_spacing.' 0 0 '.$module_select_image_spacing;
			}else{
				$isotope_style = 'margin:-40px 0 0 -40px';
				$inside_style = 'margin:40px 0 0 40px';
				
			}
			
			if($module_input_per_page != ''){
				$per_page = $module_input_per_page;
			}else{
				$per_page = '-1';
			}
			
			if($module_select_orderby != '-1'){
				$orderby = $module_select_orderby;
			}else{
				$orderby = 'none';
			}
			
			if($module_select_order == 'descending'){
				$order = 'DESC';
			}else{
				$order = 'ASC';
			}
			
			$idObj = get_category_by_slug($module_select_category);
			if($idObj){
				$set_category = $idObj->term_id;
			}else{
				$set_category = '0';
			}
			
			$get_categories = get_categories('parent='.$set_category);
			$gallery_query = get_posts(array(
				'posts_per_page' => $per_page,
				'numberposts' => $per_page,
				'paged' => $paged,
				'category' => $set_category,
				'orderby' => $orderby,
				'order' => $order,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array('post-format-image'),
						'operator' => 'IN'
					)
				)
			));
			
			if($module_select_image_source == 'image_post'){?>
            
				<?php foreach($gallery_query as $num => $gallery): ?>
                    <?php 
                    if($num == 0 && $paged == 1){
                        if($module_select_first_item == 'false'){
                            $width_item = 'width2';
                        }else{
                            $width_item = 'width4';
                        }
                    }else{
                        $width_item = 'width2';
                    }
                    
                    $gallery_categories = get_the_category($gallery->ID);
                    $separator = ' ';
                    $output = '';
                    if($gallery_categories){
                        foreach($gallery_categories as $category) {
                            $output .= 'filter_'.$category->slug.$separator;
                        }
                    }
                    
                    $post_option_input_link = get_post_meta($gallery->ID, 'post_option_input_link', true);
                    $thumb_src_full = wp_get_attachment_image_src(get_post_thumbnail_id($gallery->ID), 'full');
					$thumb_src_preview = wp_get_attachment_image_src(get_post_thumbnail_id($gallery->ID), 'standard-thumb');
					if($module_select_image_ratio == 'landscape'){
						$thumb_src_preview = wp_get_attachment_image_src(get_post_thumbnail_id($gallery->ID), 'image-thumb');
					}else if($module_select_image_ratio == 'square'){
						$thumb_src_preview = wp_get_attachment_image_src(get_post_thumbnail_id($gallery->ID), 'image-thumb-1');
					}
                    ?>
                            
                    <div class="<?php echo trim($output, $separator); ?> <?php echo $width_item; ?> isotope-item">
                        <div class="inside" style=" <?php echo $inside_style; ?>">
                            <div class="fade_wrap">
                                <a href="<?php echo $post_option_input_link; ?>">
								<?php if($module_select_mouseover_effect == 'true'):?>
									<div class="fade_wrap_back">
										<div class="fade_wrap_back_bg">
											<i class="m-link"></i>
										</div>
									</div>
								
                                <?php endif; ?>
                                <img src="<?php echo $thumb_src_preview[0]; ?>">
								</a>
                            </div><!--End fade_wrap-->
                        
                        </div><!--End inside-->
                    </div>
                    <!--End isotope-item-->
                <?php endforeach; ?>
                
				
			<?php 
            }else{
			?>	
				<?php 
                if($per_page != '-1'){
                    $count_gallery = count($split_gallery) - 1;
                    $page_paged = ceil($count_gallery/$per_page);
                    $count_pages = $per_page;
                }else{
                    $count_gallery = count($split_gallery) - 1;
                    $page_paged = '1';
                    $count_pages = count($split_gallery) - 1;
                }
                
                $i = (intval($paged) - 1) * $count_pages;
                for ($i; $i<intval($paged) * $count_pages; $i++){
                    
                    if(isset($split_gallery[$i])){
						$thumb_src_preview = wp_get_attachment_image_src( $split_gallery[$i],'standard-thumb');
						if($module_select_image_ratio == 'landscape'){
							$thumb_src_preview = wp_get_attachment_image_src( $split_gallery[$i], 'image-thumb');
						}else if($module_select_image_ratio == 'square'){
							$thumb_src_preview = wp_get_attachment_image_src( $split_gallery[$i], 'image-thumb-1');
						}
						$thumb_src_full = wp_get_attachment_image_src( $split_gallery[$i], 'full');
						
						if($i == (intval($paged) - 1) * $count_pages  && $paged == 1){
							if($module_select_first_item == 'false'){
								$width_item = 'width2';
							}else{
								$width_item = 'width4';
							}
						}else{
							$width_item = 'width2';
						} ?>
						
						<?php if($i < $count_gallery):?>
						<div class="<?php echo $width_item; ?> isotope-item">
							<div class="inside" style=" <?php echo $inside_style; ?>">
								<div class="fade_wrap">
									<?php 
									if($module_select_mouseover_effect == 'true'){
										$lightbox_class = 'lightbox';
										$lightbox_class2 = '';
										
										$lightbox_rel = 'post'.$module_post;
										$lightbox_rel2 = '';
									}else{
										$lightbox_class = '';
										$lightbox_class2 = 'lightbox';
										$lightbox_rel = '';
										$lightbox_rel2 = 'post'.$module_post;
									}?>
									
									<?php if($module_select_mouseover_effect == 'true'):?>
									<a href="<?php echo $thumb_src_full[0]; ?>" data-rel="<?php echo $lightbox_rel; ?>" class="<?php echo $lightbox_class; ?>">
										<div class="fade_wrap_back">
											<div class="fade_wrap_back_bg">
												<i class="m-eye"></i>
											</div>
										</div>
										<img src="<?php echo $thumb_src_preview[0]; ?>">
									</a>
									<?php else: ?>
									<a href="<?php echo $thumb_src_full[0]; ?>" class="<?php echo $lightbox_class2; ?>" data-rel="<?php echo $lightbox_rel2; ?>"><img src="<?php echo $thumb_src_preview[0]; ?>"></a>
									<?php endif; ?>
								</div><!--End fade_wrap-->
							   
							</div><!--End inside-->
						</div><!--End isotope-item-->
						<?php endif; 
					} ?>
                    
                    
                <?php } ?>
            
            <?php	
			}
		break;
		
		case 'portfolio':
			$module_select_category = ux_get_module_meta($module_post, 'module_select_category', $post_id);
			$module_select_image_spacing = ux_get_module_meta($module_post, 'module_select_image_spacing', $post_id);
			$module_select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', $post_id);
			$module_select_order = ux_get_module_meta($module_post, 'module_select_order', $post_id);
			$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', $post_id);
			$module_select_first_item = ux_get_module_meta($module_post, 'module_select_first_item', $post_id);
			$module_select_image_ratio = ux_get_module_meta($module_post, 'module_select_image_ratio', $post_id);
			$module_select_hover_effect = ux_get_module_meta($module_post, 'module_select_hover_effect', $post_id);
			
			
			if($module_input_per_page != ''){
				$per_page = $module_input_per_page;
			}else{
				$per_page = '-1';
			}
			
			if($module_select_orderby != '-1'){
				$orderby = $module_select_orderby;
			}else{
				$orderby = 'none';
			}
			
			if($module_select_order == 'descending'){
				$order = 'DESC';
			}else{
				$order = 'ASC';
			}
			
			$idObj = get_category_by_slug($module_select_category);
			if($idObj){
				$set_category = $idObj->term_id;
			}else{
				$set_category = '0';
			}
			
			$get_categories = get_categories('parent='.$set_category);
			$portfolio_query = get_posts(array(
				'posts_per_page' => $per_page,
				'numberposts' => $per_page,
				'paged' => $paged,
				'category' => $set_category,
				'orderby' => $orderby,
				'order' => $order,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array(
							'post-format-gallery'
						),
						'operator' => 'IN'
					)
				)
			));
			
			if($module_select_image_spacing){
				$isotope_style = 'margin:-'.$module_select_image_spacing.' 0 0 -'.$module_select_image_spacing;
				if($module_select_hover_effect == 'flip'){
					$inside_style = 'padding:'.$module_select_image_spacing.' 0 0 '.$module_select_image_spacing;
				}else{
					$inside_style = 'margin:'.$module_select_image_spacing.' 0 0 '.$module_select_image_spacing;
				}
				
			}else{
				$isotope_style = 'margin:-40px 0 0 -40px';
				if($module_select_hover_effect == 'flip'){
					$inside_style = 'padding:40px 0 0 40px';
				}else{
					$inside_style = 'margin:40px 0 0 40px';
				}
				
			}
			?>
					
			<?php foreach($portfolio_query as $num => $portfolio): ?>
            <?php 
			$post_background_color = get_post_meta($portfolio->ID, 'post_background_color', true);
			
			global $theme_color;
			if($post_background_color){
				$post_background_color = 'bg-'.$theme_color[$post_background_color]['value'];
			}else{
				$post_background_color = 'post-bgcolor-default';
			}
			
            if($num == 0 && $paged == 1){
                if($module_select_first_item == 'false'){
                    $width_item = 'width2';
                }else{
                    $width_item = 'width4';
                }
            }else{
                $width_item = 'width2';
            }
            
            $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio->ID), 'full');
			
			$thumb_src_preview = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio->ID),'standard-thumb');
			if($module_select_image_ratio == 'landscape'){
				$thumb_src_preview = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio->ID), 'image-thumb');
			}else if($module_select_image_ratio == 'square'){
				$thumb_src_preview = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio->ID), 'image-thumb-1');
			
			}
            
            $portfolio_categories = get_the_category($portfolio->ID);
            $separator = ' ';
            $output = '';
            if($portfolio_categories){
                foreach($portfolio_categories as $category) {
                    $output .= 'filter_'.$category->slug.$separator;
                }
            } ?>
            <?php if($module_select_hover_effect == 'flip'): ?>
            <?php
            if($module_select_image_spacing){
                $back_con_style = 'padding-left: '.$module_select_image_spacing.';' ;
                $back_bg_style = 'left: '.$module_select_image_spacing.'; top: -'.$module_select_image_spacing.';';
				$back_tit_style = 'margin-top: -'.$module_select_image_spacing.';' ;
            }else{
                $back_con_style = 'padding-left: 40px; ';
                $back_bg_style = 'left: 40px; top: -40px;';
				$back_tit_style = 'margin-top: -40px;';
            }?>
			
            <div class="<?php echo trim($output, $separator); ?> <?php echo $width_item; ?> isotope-item container3d">
			
                <div class="inside card" style=" <?php echo $inside_style; ?>">
                    <div class="flip_wrap_back back face">
                        <div class="flip_wrap_back_con" style=" <?php echo $back_con_style; ?>">
                            <h2 style=" <?php echo $back_tit_style; ?>"><a href="<?php echo get_permalink($portfolio->ID); ?>"><?php echo get_the_title($portfolio->ID); ?></a></h2>
                            
                            <ul class="hover_thumb_wrap">
                            
                                <?php 
								$post_option_gallery_selected = get_post_meta($portfolio->ID, "post_option_gallery_selected", true);
								
								if($post_option_gallery_selected){
									foreach($post_option_gallery_selected as $num => $image):
										$thumb_src = wp_get_attachment_image_src( $image, 'full');
										$small_thumb_src = wp_get_attachment_image_src( $image, 'blog-thumb');
										
										?>
										
										<li class="hover_thumb_unit"><a href="<?php echo $thumb_src[0]; ?>" title="<?php echo get_the_title($portfolio->ID); ?>" class="imgwrap lightbox" data-rel="post<?php echo $portfolio->ID; ?>"><img width="50" height="50" src="<?php echo $small_thumb_src[0]; ?>" alt="<?php echo get_the_title($portfolio->ID); ?>" /></a></li>
									
									<?php endforeach;
								}?>
                                
                             </ul>
                            
                        </div>
                        <div class="flip_wrap_back_bg <?php echo $post_background_color; ?>" style=" <?php echo $back_bg_style; ?>"></div>
                    </div>
                    <img src="<?php echo $thumb_src_preview[0]; ?>" class="front face" alt="<?php echo get_the_title($portfolio->ID); ?>" />
                
                </div><!--End inside-->
            </div>
            
            <?php else: ?>
            <div class="<?php echo trim($output, $separator); ?> <?php echo $width_item; ?> isotope-item captionhover">
                <div class="inside" style=" <?php echo $inside_style; ?>">
                    
                
                    <figure style=" <?php echo $post_background_color; ?>">
                        <div class="img_wrap"><img src="<?php echo $thumb_src_preview[0]; ?>"></div>
                            <figcaption class="<?php echo $post_background_color; ?>">
                                
                                <h2><a href="<?php echo get_permalink($portfolio->ID); ?>" title="<?php echo get_the_title($portfolio->ID); ?>"><?php echo get_the_title($portfolio->ID); ?></a></h2>
								<div class="btn_wrap"><a href="<?php echo $thumbnail_url[0]; ?>" class="lightbox"><i class="m-image-view"></i></a><a href="<?php echo get_permalink($portfolio->ID); ?>" class="more"><i class="m-image-readmore"></i></a></div>
								
                            </figcaption>
                    </figure>
                </div><!--End inside-->
            </div>
            
            <?php endif; ?>
            <!--End isotope-item-->
            <?php endforeach; ?>
		
		<?php
		break;
		
		case 'team':
			$module_select_category = ux_get_module_meta($module_post, 'module_select_category', $post_id);
			$module_select_image_spacing = '40px';
			$module_select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', $post_id);
			$module_select_order = ux_get_module_meta($module_post, 'module_select_order', $post_id);
			$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', $post_id);
			//$module_select_first_item = ux_get_module_meta($module_post, 'module_select_first_item', $post_id);
			$module_select_image_list_type =ux_get_module_meta($module_post, 'module_select_image_list_type', $post_id);
			$module_select_hover_effect = ux_get_module_meta($module_post, 'module_select_hover_effect', $post_id);
			$module_switch_position = ux_get_module_meta($module_post, 'module_switch_position', $post_id);
			$module_switch_email = ux_get_module_meta($module_post, 'module_switch_email', $post_id);
			$module_switch_phone_number = ux_get_module_meta($module_post, 'module_switch_phone_number', $post_id);
			$module_switch_social_network = ux_get_module_meta($module_post, 'module_switch_social_network', $post_id);
			
			/*if($module_select_image_list_type=='masonry'){
				$module_select_image_ratio = 'auto';
			}else{	
				$module_select_image_ratio = ux_get_module_meta($module_post, 'module_select_image_ratio', $post_id);
				$module_select_first_item = 'false';
			}*/
			
			if($module_input_per_page != ''){
				$per_page = $module_input_per_page;
			}else{
				$per_page = '-1';
			}
			
			if($module_select_orderby != '-1'){
				$orderby = $module_select_orderby;
			}else{
				$orderby = 'none';
			}
			
			if($module_select_order == 'descending'){
				$order = 'DESC';
			}else{
				$order = 'ASC';
			}
			
			$idObj = get_term_by('slug', $module_select_category, 'team_cat');
			if($idObj){
				$set_category = $idObj->term_id;
				$slug_category = $module_select_category;
			}else{
				$set_category = '0';
				$slug_category = '';
			}
			
			$get_categories = get_terms('team_cat');
			$team_query = get_posts(array(
				'posts_per_page' => $per_page,
				'numberposts' => $per_page,
				'paged' => $paged,
				'team_cat' => $slug_category,
				'orderby' => $orderby,
				'order' => $order,
				'post_type' => 'team'
			));
			/*
			if($module_select_image_spacing){
				$isotope_style = 'margin:-'.$module_select_image_spacing.' 0 0 -'.$module_select_image_spacing;
				if($module_select_hover_effect == 'flip'){
					$inside_style = 'padding:'.$module_select_image_spacing.' 0 0 '.$module_select_image_spacing;
				}else{
					$inside_style = 'margin:'.$module_select_image_spacing.' 0 0 '.$module_select_image_spacing;
				}
				
			}else{
				$isotope_style = 'margin:-40px 0 0 -40px';
				if($module_select_hover_effect == 'flip'){
					$inside_style = 'padding:40px 0 0 40px';
				}else{
					$inside_style = 'margin:40px 0 0 40px';
				}
				
			}*/
			?>
					
			<?php foreach($team_query as $num => $team): ?>
            <?php 
            $post_type_team_position = get_post_meta($team->ID, 'post_type_team_position', true);
			$post_type_team_email = get_post_meta($team->ID, 'post_type_team_email', true);
			$post_type_team_phone_number = get_post_meta($team->ID, 'post_type_team_phone_number', true);
			
			/*if($num == 0 && $paged == 1){
                if($module_select_first_item == 'false'){
                    $width_item = 'width2';
                }else{
                    $width_item = 'width4';
                }
            }else{
                $width_item = 'width2';
            }
            
           $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($team->ID), 'full');
			
			$thumb_src_preview = wp_get_attachment_image_src(get_post_thumbnail_id($team->ID),'image3-thumb');
			if($module_select_image_ratio == 'landscape'){
				$thumb_src_preview = wp_get_attachment_image_src(get_post_thumbnail_id($team->ID), 'image2-thumb');
			}*/
            
            $team_categories = get_the_terms($team->ID,'team_cat');
            $separator = ' ';
            $output = '';
            if($team_categories){
                foreach($team_categories as $category) {
                    $output .= 'filter_'.$category->slug.$separator;
                }
            } ?>
            <div class="<?php echo trim($output, $separator); ?> width2 isotope-item">
                <div class="inside card" style="padding:40px 0 0 40px">
                    <div class="team-item">
						<?php echo get_the_post_thumbnail($team->ID, array(520,520)); ?>
                        <div class="team-item-con">
                            <a class="team-item-title" title="<?php echo get_the_title($team->ID); ?>" href="<?php echo get_permalink($team->ID); ?>"><?php echo get_the_title($team->ID); ?></a>
                            
                            <?php
                            if($module_switch_social_network){
								if($module_switch_social_network != 'false'){
									$post_type_team_social_networks = get_post_meta($team->ID, 'post_type_team_social_networks', true);
									$post_type_team_social_networks_url = get_post_meta($team->ID, 'post_type_team_social_networks_url', true);
									?>
									<p class="team-icons">
										<?php 
										$i = 0;
										for($i=0; $i<count($post_type_team_social_networks); $i++){ ?>
										<a title="" href="<?php echo $post_type_team_social_networks_url[$i]; ?>"><i class="<?php echo $post_type_team_social_networks[$i]; ?> team-icons-item"></i></a>
										<?php } ?>
									</p><!--End team-icons-->
								<?php 
								}
							} ?>
                        </div><!--End team-item-con -->
                        <div class="team-item-con-back">
                            <a class="team-item-title" title="<?php echo get_the_title($team->ID); ?>" href="<?php echo get_permalink($team->ID); ?>"><?php echo get_the_title($team->ID); ?></a>
                            <div class="team-item-con-h">
                                <?php if($module_switch_position){
									if($module_switch_position != 'false'){ ?>
                                        <p class="team-position"><?php echo $post_type_team_position;?></p>
									<?php
									}
								} ?>
                                
                                <?php if($module_switch_email){
									if($module_switch_email != 'false'){ ?>
                                        <p class="team-mail"><a href="mailto:<?php echo $post_type_team_email;?>"><?php echo $post_type_team_email;?></a></p>
                                    <?php
									}
								} ?>
                                
                                <?php if($module_switch_phone_number){
									if($module_switch_phone_number != 'false'){ ?>
                                        <p class="team-phone"><?php echo $post_type_team_phone_number;?></p>
									<?php
									}
								} ?>
                            </div>
                            <?php
                            if($module_switch_social_network != 'false'):
                                $post_type_team_social_networks = get_post_meta($team->ID, 'post_type_team_social_networks', true);
                                $post_type_team_social_networks_url = get_post_meta($team->ID, 'post_type_team_social_networks_url', true);
                                ?>
                                <p class="team-icons">
                                    <?php 
                                    $i = 0;
                                    for($i=0; $i<count($post_type_team_social_networks); $i++){ ?>
                                    <a title="" href="<?php echo $post_type_team_social_networks_url[$i]; ?>"><i class="<?php echo $post_type_team_social_networks[$i]; ?> team-icons-item"></i></a>
                                    <?php } ?>
                                </p><!--End team-icons-->
                            <?php endif; ?>
                        </div><!--End team-item-con-back-->
                    </div>
                </div><!--End inside-->
            </div>
            <!--End isotope-item-->
            <?php endforeach; ?>
		
		<?php
		break;
		
	}
	
	do_action('ux_view_module_load', array(
		'module_id' => $module_id, 
		'module_post' => $module_post,
		'post_id' => $post_id,
		'paged' => $paged,
	));
	
	
}

/*
============================================================================
	*
	* Module switch
	*
============================================================================	
*/
function ux_view_module_switch($module_id, $id, $mode, $span_width){
	$item_module_post_id = ux_custom_meta( 'pagebuilder_item_module_post_id' );
	$module_post_id = ux_custom_meta( 'pagebuilder_module_post_id' );
	$pagebuilder_item_module_post = ux_custom_meta( 'pagebuilder_item_module_post' );
	$pagebuilder_module_post = ux_custom_meta( 'pagebuilder_module_post' );
	
	if($mode == 'module'){
		$post_id = $module_post_id[$id];
		$module_post = $pagebuilder_module_post[$id];
	}elseif($mode == 'item_module'){
		$post_id = $item_module_post_id[$id];
		$module_post = $pagebuilder_item_module_post[$id];
	}
	
	$module_style = '';
	$tab_type = '';
	$content_main = '';
	$slider_type = '';
	
	$custom_query = new WP_Query( 'posts_per_page=-1&post_type=custom_modules' );
	
	$module_select_tabs_type = ux_get_module_meta($module_post, 'module_select_tabs_type', get_the_ID());
	
	if($module_select_tabs_type == 'horizontal_tabs'){
		$tab_type = 'tabs-h';
	}elseif($module_select_tabs_type == 'vertical_tabs'){
		$tab_type = 'tabs-v';
	}
	
	if($module_id == 'blog'){
		$content_main = 'content-main';
	}
	
	$module_select_slider_image = get_post_meta($post_id, 'module_select_slider_image', true);
	if($module_select_slider_image){
		if($module_select_slider_image == 'layerslider'){
			$slider_type = 'fullwrap_moudle';
		}
	}
	
	$span_style = '';
	$width_value = explode(" ",$span_width);
	if($width_value[0] == "span12"){
		$span_style = 'margin-left:0px;';
	}
	
	?>
	<div class="<?php echo $span_width; ?> <?php echo $tab_type; ?> <?php echo $content_main; ?> <?php echo $slider_type; ?>" style=" <?php echo $span_style; ?>" data-module="true">
        
        
        <?php 
		switch($module_id){
			case 'text_block':
				global $theme_color;
				$module_background_color = ux_get_module_meta($module_post, 'module_background_color', get_the_ID());
				$module_content = ux_get_module_meta($module_post, 'module_content', get_the_ID());
				if($module_background_color){
					$module_color_style = $theme_color[$module_background_color]['value'];
				}else{
					$module_color_style = '';
				}
				if($module_background_color != 'false' and $module_background_color != ''){
					$module_style = 'text_block withbg';
				}else{
					$module_style = 'text_block ux-mod-nobg';
				} ?>
                <div class="<?php echo $module_style; ?> bg-<?php echo $module_color_style; ?>">
					<?php echo do_shortcode($module_content); ?>
                </div>
			
			<?php
			break;
			
			case 'icon_box':
				$module_select_icon_location =  ux_get_module_meta($module_post, 'module_select_icon_location', get_the_ID());
				$module_select_icon =  ux_get_module_meta($module_post, 'module_select_icon', get_the_ID());
				$module_post_title = ux_get_module_meta($module_post, 'module_post_title', get_the_ID());
				$module_content = ux_get_module_meta($module_post, 'module_content', get_the_ID());
				$module_select_icon_mask = ux_get_module_meta($module_post, 'module_select_icon_mask', get_the_ID());
				$module_select_hover_animation = ux_get_module_meta($module_post, 'module_select_hover_animation', get_the_ID());
				$module_background_color = ux_get_module_meta($module_post, 'module_background_color', get_the_ID());
				
				$module_switch_hyperlink = ux_get_module_meta($module_post, 'module_switch_hyperlink', get_the_ID());
				$module_input_hyperlink = ux_get_module_meta($module_post, 'module_input_hyperlink', get_the_ID());
				
				$hyperlink = ($module_input_hyperlink && $module_input_hyperlink != '') ? $module_input_hyperlink : '#';
				if($module_switch_hyperlink){
					$hyperlink_before = ($module_switch_hyperlink != 'false') ? '<a href="'.esc_url($hyperlink).'" target="_blank">' : false;
					$hyperlink_after = ($module_switch_hyperlink != 'false') ? '</a>' : false;
				}else{
					$hyperlink_before = false;
					$hyperlink_after = false;
				}
				
				if($module_select_icon_location != 'false' and $module_select_icon_location != ''){
					$module_style = 'iocnbox '. $module_select_icon_location;
				}
				
				$icon_mask_name = false;
				$icon_mask_style = false;
				$icon_mask_animation = false;
				$icon_mask_data_animation = false;
				$module_color_style = false;
				
				if($module_select_icon_mask){
					global $theme_color;
					switch($module_select_icon_mask){
						case 'circle': $icon_mask_name = 'iconbox-plus-circle'; break;
						case 'triangle': $icon_mask_name = 'iconbox-plus-triangle'; break;
						case 'rounded_square': $icon_mask_name = 'iconbox-plus-square'; break;
						case 'diamond': $icon_mask_name = 'iconbox-plus-hexagonal'; break;
						case 'star': $icon_mask_name = 'iconbox-plus-pentagon'; break;
					}
					if($module_select_hover_animation){
						switch($module_select_hover_animation){
							case 'full_rotate': $icon_mask_animation = 'rorate'; break;
							case 'flip': $icon_mask_animation = 'flip'; break;
							case 'scale': $icon_mask_animation = 'scale'; break;
							//case 'halo': $icon_mask_animation = 'halo'; break;
						}
						$icon_mask_data_animation = 'data-animation="'.$icon_mask_animation.'"';
					}
					if($module_background_color){
						$module_color_style = $theme_color[$module_background_color]['rgb'];
					}else{
						if(get_option('theme_option_color_theme_main')){
							$module_color_style = get_option('theme_option_color_theme_main');
						}else{
							if(get_option('theme_option_select_color_scheme')){
								foreach($theme_color as $color){
									if($color['value'] == get_option('theme_option_select_color_scheme')){
										$module_color_style = $color['rgb'];
									}
								}
								
							}
						}
					}
					$icon_mask_style = 'iconbox-plus '.$icon_mask_name.' hover-'.$icon_mask_animation.'';
				} ?>
                <div <?php echo $icon_mask_data_animation; ?> class="<?php echo $module_style; ?> <?php echo $icon_mask_style; ?> ux-mod-nobg">
                    <?php if($module_select_icon_mask): ?>
                        <div class="iconbox-plus-svg-wrap">
							<?php echo $hyperlink_before;
							switch($module_select_icon_mask){
								case 'circle': ?>
									<svg xml:space="preserve" enable-background="new 25.5 175.5 160 160" viewBox="25.5 175.5 160 160" height="160px" width="160px" y="0px" x="0px" id="<?php echo 'iconbox-plus' .$module_post; ?>" version="1.1"><circle r="65" cy="258.5" cx="105.5" fill="<?php echo $module_color_style; ?>" />
    </svg>
                                <?php
                                break;
								case 'triangle': ?>
									<svg xml:space="preserve" enable-background="new 25.5 175.5 160 160" viewBox="25.5 175.5 160 160" height="160px" width="160px" y="0px" x="0px" id="<?php echo 'iconbox-plus' .$module_post; ?>" version="1.1"><g><path d="M39.791,315.5c-6.487,0-9.148-4.574-5.915-10.162L99.62,191.691c3.234-5.588,8.527-5.588,11.757,0
            l65.747,113.646c3.232,5.588,0.572,10.162-5.917,10.162H39.791z" fill="<?php echo $module_color_style; ?>"/></g></svg>
                                <?php
                                break;
								case 'rounded_square': ?>
									<svg xml:space="preserve" enable-background="new 25.5 175.5 160 160" viewBox="25.5 175.5 160 160" height="160px" width="160px" y="0px" x="0px" id="<?php echo 'iconbox-plus' .$module_post; ?>" version="1.1"><path d="M175.5,308c0,9.659-7.841,17.5-17.5,17.5H53c-9.669,0-17.5-7.841-17.5-17.5V203
        c0-9.659,7.831-17.5,17.5-17.5h105c9.659,0,17.5,7.841,17.5,17.5V308z" fill="<?php echo $module_color_style; ?>"/></svg>
								<?php
                                break;
								case 'diamond': ?>
									<svg xml:space="preserve" enable-background="new 25.5 175.5 160 160" viewBox="25.5 175.5 160 160" height="160px" width="160px" y="0px" x="0px" id="<?php echo 'iconbox-plus' .$module_post; ?>" version="1.1"><g><path d="M74.297,324.5c-4.7,0-10.464-3.323-12.807-7.385l-31.235-54.231c-2.34-4.062-2.34-10.707,0-14.771
            l31.234-54.223c2.344-4.062,8.107-7.39,12.808-7.39h62.407c4.697,0,10.46,3.327,12.8,7.39l31.242,54.223
            c2.338,4.064,2.338,10.71,0,14.771l-31.242,54.231c-2.34,4.062-8.103,7.385-12.8,7.385H74.297z" fill="<?php echo $module_color_style; ?>"/></g></svg>
                                <?php
                                break;
								case 'star': ?>
									<svg xml:space="preserve" enable-background="new 25.5 175.5 160 160" viewBox="25.5 175.5 160 160" height="160px" width="160px" y="0px" x="0px" id="<?php echo 'iconbox-plus' .$module_post; ?>" version="1.1"><g><path d="M109.339,305.159c-2.113-1.104-5.562-1.106-7.675,0l-39.981,20.895c-2.11,1.102-3.506,0.09-3.103-2.248
            l7.636-44.251c0.405-2.34-0.664-5.604-2.37-7.262L31.5,240.937c-1.707-1.654-1.175-3.286,1.182-3.627l44.708-6.463
            c2.357-0.339,5.15-2.36,6.206-4.489l19.983-40.265c1.06-2.124,2.783-2.124,3.843,0l19.979,40.265
            c1.056,2.127,3.847,4.15,6.206,4.489l44.711,6.463c2.355,0.342,2.889,1.973,1.183,3.627l-32.348,31.355
            c-1.706,1.657-2.773,4.922-2.369,7.262l7.628,44.251c0.404,2.339-0.992,3.349-3.1,2.248L109.339,305.159z" fill="<?php echo $module_color_style; ?>"/></g></svg>
                                <?php
                                break;
							} ?>
                            <i class="<?php echo $module_select_icon; ?>"></i>
                            <?php echo $hyperlink_after; ?>
                        </div><!--End iconbox-plus-svg-wrap-->
                    <?php else: ?> 
                        <div class="icon_wrap"><?php echo $hyperlink_before; ?><i class="<?php echo $module_select_icon; ?>"></i><?php echo $hyperlink_after; ?></div>
					<?php endif; ?> 
                    
                    <div class="icon_text">
                        <?php if($module_post_title) { ?><h3><?php echo $module_post_title; ?></h3><?php } ?>
                        <p><?php echo do_shortcode($module_content); ?></p>
                    </div><!--End icon_text-->
                </div>
                
            <?php
			break;
			
			case 'text_list':
				$module_lists_layout_bullet = ux_get_module_meta($module_post, 'module_lists_layout_bullet', get_the_ID());
				$module_lists_layout_content = ux_get_module_meta($module_post, 'module_lists_layout_content', get_the_ID());
				
				$layout_bullet = explode("'%_%'",$module_lists_layout_bullet);
				$layout_content = explode("'%_%'",$module_lists_layout_content);
				foreach($layout_bullet as $i => $bullet){
					if($bullet != ''): ?>
					
					<div class="text-list ux-mod-nobg">
						<i class="<?php echo $bullet; ?>"></i>
						<p class="text-list-inn"><?php echo $layout_content[$i]; ?></p>
					
					</div>
				<?php 
					endif;
				}
			break;
			
			case 'message_box':
				$module_post_html_content = ux_get_module_meta($module_post, 'module_post_html_content', get_the_ID());
				$module_select_message_type = ux_get_module_meta($module_post, 'module_select_message_type', get_the_ID());
				switch($module_select_message_type){
					case 'error': $module_style = 'message-box box-bgcolor1 box-type1'; break;
					case 'warning': $module_style = 'message-box box-bgcolor2 box-type2'; break;
					case 'information': $module_style = 'message-box box-bgcolor3 box-type3'; break;
					case 'success': $module_style = 'message-box box-bgcolor4 box-type4'; break;
				} ?>
					<div class="<?php echo $module_style; ?>">
						<p class="box-close"><i class="m-close-circle"></i></p>
						<?php echo $module_post_html_content; ?>
					</div>
            <?php
			break;
			
			case 'accordion_toggle':
				$module_lists_layout_title = ux_get_module_meta($module_post, 'module_lists_layout_title', get_the_ID());
				$module_lists_layout_content = ux_get_module_meta($module_post, 'module_lists_layout_content', get_the_ID());
				$module_select_accordion_type = ux_get_module_meta($module_post, 'module_select_accordion_type', get_the_ID());
				$module_select_first_item = ux_get_module_meta($module_post, 'module_select_first_item', get_the_ID());
				$module_select_accordion_style = ux_get_module_meta($module_post, 'module_select_accordion_style', get_the_ID());
				$split_title = explode("'%_%'",$module_lists_layout_title);
				$split_content = explode("'%_%'",$module_lists_layout_content);
				if($module_select_accordion_type == 'toggle'){
					$type_class = 'accordion_toggle';
				}else{
					$type_class = 'accordion';
				}
				if($module_select_accordion_style == 'style_a'){
					$style_class = '';
				}else{
					$style_class = 'accordion-style-b';
				}
				?>
					<div id="accordion<?php echo $module_post; ?>" class="<?php echo $type_class; ?> <?php echo $style_class; ?> ux-mod-nobg">
						<?php 
						if($module_lists_layout_content){
							$i=0;
							for ($i=0; $i<count($split_content) - 1; $i++){
								if($i == 0){
									if($module_select_first_item == 'false'){
										$accordion_in = '';
										$active_class = '';
									}else{
										$accordion_in = 'in';
										$active_class = 'active';
									}
								}else{
									$accordion_in = '';
									$active_class = '';
								}
								?>
								
								<div class="accordion-group">
									<div class="accordion-heading">
										<a href="#collapse_<?php echo $module_post . $i; ?>" data-parent="#accordion<?php echo $module_post; ?>" data-toggle="collapse" class="accordion-toggle <?php echo $active_class; ?>"><?php echo $split_title[$i]; ?></a>
									</div><!--End accordion-heading-->
									
									<div class="accordion-body collapse <?php echo $accordion_in; ?>" id="collapse_<?php echo $module_post . $i; ?>">
										<div class="accordion-inner"><?php echo do_shortcode($split_content[$i]); ?></div><!--End accordion-inner-->
									</div><!--End accordion-body-->
								</div>
							
							<?php	
							}
						}
						?>
					</div>
            <?php
			break;
			
			case 'tabs':
				$module_lists_layout_title = ux_get_module_meta($module_post, 'module_lists_layout_title', get_the_ID());
				$module_lists_layout_content = ux_get_module_meta($module_post, 'module_lists_layout_content', get_the_ID());
				$split_title = explode("'%_%'",$module_lists_layout_title);
				$split_content = explode("'%_%'",$module_lists_layout_content);
				if($module_select_tabs_type == 'vertical_tabs'){
					$nav_tabs = 'nav-tabs-v';
					$nav_content = 'tab-content-v';
					$nav_clear = '<div class="clearfix"></div>';
				}else{
					$nav_tabs = '';
					$nav_content = '';
					$nav_clear = '';
				}
				?>
					<ul id="myTab<?php echo $post_id; ?>" class="nav nav-tabs <?php echo $nav_tabs; ?>">
						<?php
						$i=0;
						for ($i=0; $i<count($split_content) - 1; $i++){
							if($i == 0){
								$active = 'active';
							}else{
								$active = '';
							}
							?>
							
							<li class="<?php echo $active; ?>"><a href="#tabs_<?php echo $post_id . $i; ?>"><?php echo $split_title[$i]; ?></a></li>
						<?php } ?>
					</ul>
					<div class="tab-content <?php echo $nav_content; ?>">
						<?php
						$i=0;
						for ($i=0; $i<count($split_content) - 1; $i++){
							if($i == 0){
								$active = 'active';
							}else{
								$active = '';
							}
							?>
							<div id="tabs_<?php echo $post_id . $i; ?>" class="tab-pane <?php echo $active; ?>"><?php echo do_shortcode($split_content[$i]); ?></div>
						<?php } ?>
					</div>
					<?php echo $nav_clear; ?>
			<?php
			break;
			
			case 'divider':
				$module_select_divider_type = ux_get_module_meta($module_post, 'module_select_divider_type', get_the_ID());
				$module_select_text_align = ux_get_module_meta($module_post, 'module_select_text_align', get_the_ID());
				$module_select_color = ux_get_module_meta($module_post, 'module_select_color', get_the_ID());
				$module_background_color = ux_get_module_meta($module_post, 'module_background_color', get_the_ID());
				$module_select_height = ux_get_module_meta($module_post, 'module_select_height', get_the_ID());
				$module_post_title = ux_get_module_meta($module_post, 'module_post_title', get_the_ID());
				
				$divider_height = '';
				$divider_title = '';
				$divider_class = '';
				
				
				global $theme_color;
				if($module_background_color){
					$divider_color = $theme_color[$module_background_color]['value'];
					
				}else{
					$divider_color = $theme_color[1]['value'];
					
				}
				
				if($module_select_divider_type == 'single_line'){
					$divider_class = 'without-title';
				}elseif($module_select_divider_type == 'text_and_line'){
					$divider_title = '<h4 class="'.$divider_color.'" style=" background:none;">'.$module_post_title.'</h4>';
					if($module_select_text_align == 'center'){
						$divider_class = 'text-center';
						
					}elseif($module_select_text_align == 'right'){
						$divider_class = 'title_on_right';
						
					}elseif($module_select_text_align == 'left'){
						$divider_class = 'title_on_left';	
					}else{
						$divider_class = '';
					}
					
				}elseif($module_select_divider_type == 'blank_divider'){
					$divider_class = 'without-title blank-divider';
					$divider_height = 'height:'.$module_select_height.';';
					$divider_color ='';
				}


				?>
					<div class="separator <?php echo $divider_class; ?>" style=" <?php echo $divider_height; ?> ">
						<?php if($module_select_text_align == 'center'){ ?>
						<div class="separator_inn <?php if($module_select_divider_type != 'blank_divider'){ echo 'bg-'.$divider_color; } ?>" style=" <?php if(!$divider_title){ echo 'top:8px;'; } ?>"></div>
						<?php } ?>
						<?php echo $divider_title; ?>
						<div class="separator_inn <?php if($module_select_divider_type != 'blank_divider'){ echo 'bg-'.$divider_color; } ?>" style=" <?php if(!$divider_title){ echo 'top:8px;'; } ?>"></div>
                </div>
			<?php
			break;
			
			case 'count_down':
				$module_date_time = ux_get_module_meta($module_post, 'module_date_time', get_the_ID());
				$module_select_count_start = ux_get_module_meta($module_post, 'module_select_count_start', get_the_ID());
				$module_select_count_to = ux_get_module_meta($module_post, 'module_select_count_to', get_the_ID());
				
				$date_array = array(
					'years' => 0,
					'months' => 1,
					'days' => 2,
					'hours' => 3,
					'minutes' => 4,
					'seconds' => 5
				);
				$date_format = false;
				if($module_select_count_start){
					$date_start = $date_array[$module_select_count_start];
					$date_to = $date_array[$module_select_count_to];
					
					foreach($date_array as $date => $i){
						if($i >= $date_start && $i <= $date_to){
							switch($date){
								case 'years': $date_format .= 'y'; break;
								case 'months': $date_format .= 'o'; break;
								case 'days': $date_format .= 'd'; break;
								case 'hours': $date_format .= 'H'; break;
								case 'minutes': $date_format .= 'M'; break;
								case 'seconds': $date_format .= 'S'; break;
							}
						}
					}
				}
				$date = new DateTime($module_date_time);
				?>
                <div class="countdown" data-years="<?php echo $date->format('Y'); ?>" data-months="<?php echo $date->format('n'); ?>" data-days="<?php echo $date->format('d'); ?>" data-hours="<?php echo $date->format('H'); ?>" data-minutes="<?php echo $date->format('i'); ?>" data-seconds="<?php echo $date->format('s'); ?>" data-dateformat="<?php echo $date_format; ?>"></div>
            <?php
			break;
			
			case 'image_box':
				$module_image_media = ux_get_module_meta($module_post, 'module_image_media', get_the_ID());
				$module_select_icon_mask = ux_get_module_meta($module_post, 'module_select_icon_mask', get_the_ID());
				$module_input_title = ux_get_module_meta($module_post, 'module_input_title', get_the_ID());
				$module_input_content = ux_get_module_meta($module_post, 'module_input_content', get_the_ID());
				$module_switch_social_show = ux_get_module_meta($module_post, 'module_switch_social_show', get_the_ID());
				$module_switch_social_network = ux_get_module_meta($module_post, 'module_switch_social_network', get_the_ID());
				$module_switch_hyperlink = ux_get_module_meta($module_post, 'module_switch_hyperlink', get_the_ID());
				$module_input_hyperlink = ux_get_module_meta($module_post, 'module_input_hyperlink', get_the_ID());
				$module_social_medias = ux_get_module_meta($module_post, 'module_social_medias', get_the_ID());
				$module_social_medias_url = ux_get_module_meta($module_post, 'module_social_medias_url', get_the_ID());
				
				$hyperlink = ($module_input_hyperlink && $module_input_hyperlink != '') ? $module_input_hyperlink : '#';
				
				if($module_switch_hyperlink){
					$hyperlink_before = ($module_switch_hyperlink != 'false') ? '<a href="'.esc_url($hyperlink).'" target="_blank">' : false;
					$hyperlink_after = ($module_switch_hyperlink != 'false') ? '</a>' : false;
				}else{
					$hyperlink_before = false;
					$hyperlink_after = false;
				}
				
				$icon_mask_name = false;
				$icon_mask_style = false;
				
				if($module_select_icon_mask){
					switch($module_select_icon_mask){
						case 'circle': $icon_mask_name = 'image-box-circle'; break;
						case 'triangle': $icon_mask_name = 'image-box-triangle'; break;
						case 'rounded_square': $icon_mask_name = 'image-box-square'; break;
						case 'diamond': $icon_mask_name = 'image-box-hexagonal'; break;
						case 'star': $icon_mask_name = 'image-box-pentagon'; break;
					}
					$icon_mask_style = $icon_mask_name;
				}
				
				global $wpdb, $option_social_networks;
				$get_attachment = $wpdb->get_row("SELECT ID FROM $wpdb->posts WHERE `guid` LIKE '$module_image_media'");
				$img_src = false;
				$img_atta = false;
				if(count($get_attachment) > 0){
					$img_src = wp_get_attachment_image_src($get_attachment->ID, 'imagebox-thumb');
					$img_atta = wp_get_attachment_image($get_attachment->ID, 'imagebox-thumb', false, array('class' => 'image-box-img-iehack'));
				}
				?>
                <section class="image-box ux-mod-nobg <?php echo $icon_mask_style; ?>">
                    <?php if(count($get_attachment) > 0): ?>
						<?php if($module_select_icon_mask): ?>
                            <div class="image-box-svg-wrap">
                                <?php echo $hyperlink_before;
								switch($module_select_icon_mask){
									case 'circle': $clippath = '<circle r="80" cy="80" cx="80"/>'; break;
									case 'triangle': $clippath = '<path d="M7.738,145.805c-6.885,0-9.709-4.884-6.278-10.852L71.235,13.606c3.431-5.968,9.047-5.968,12.478,0
		l69.775,121.348c3.431,5.967,0.606,10.851-6.277,10.851H7.738z"/>'; break;
									case 'rounded_square': $clippath = '<path d="M150.5,132c0,9.659-7.841,17.5-17.5,17.5H28c-9.669,0-17.5-7.841-17.5-17.5V27c0-9.659,7.831-17.5,17.5-17.5
	h105c9.659,0,17.5,7.841,17.5,17.5V132z"/>'; break;
									case 'diamond': $clippath = '<path d="M48.797,149.5c-4.7,0-10.464-3.323-12.807-7.385L4.755,87.884c-2.34-4.062-2.34-10.707,0-14.771
		l31.234-54.223c2.344-4.062,8.107-7.391,12.808-7.391h62.407c4.696,0,10.46,3.327,12.8,7.391l31.242,54.223
		c2.338,4.063,2.338,10.71,0,14.771l-31.242,54.231c-2.34,4.062-8.104,7.385-12.8,7.385H48.797z"/>'; break;
									case 'star': $clippath = '<path d="M83.339,129.159c-2.112-1.104-5.562-1.106-7.675,0l-39.981,20.896c-2.11,1.102-3.506,0.09-3.103-2.248
		l7.636-44.252c0.405-2.34-0.664-5.604-2.37-7.262L5.5,64.938c-1.707-1.654-1.175-3.287,1.182-3.627l44.708-6.463
		c2.357-0.34,5.15-2.361,6.206-4.49l19.983-40.265c1.06-2.124,2.782-2.124,3.843,0L101.4,50.357c1.057,2.127,3.848,4.15,6.207,4.49
		l44.711,6.463c2.354,0.342,2.889,1.973,1.183,3.627l-32.349,31.354c-1.705,1.657-2.772,4.922-2.368,7.263l7.628,44.25
		c0.404,2.34-0.992,3.35-3.1,2.248L83.339,129.159z"/>'; break;
								} ?>
								<svg height="160" width="160">
                                    <defs>
                                        <clipPath id="<?php echo 'image-box' .$module_post; ?>">
                                            <?php echo $clippath; ?>
                                        </clipPath>
                                    </defs>
                                    <image style="clip-path: url(#<?php echo 'image-box' .$module_post; ?>); width:160px; height:160px; " height="160" width="160" xlink:href="<?php echo $img_src[0]; ?>"/>
                                </svg>
                                <?php echo $hyperlink_after; ?>		
                            </div>
                            
                        <?php else: ?>
							<img width="160" height="160" src="<?php echo $img_src[0]; ?>" class="image-box-img-iehack" style="display:block;" />
						<?php endif; ?>
                        <?php echo $img_atta; ?>
					<?php endif; ?>
                    <?php if($module_input_title) { ?><h1><?php echo $module_input_title; ?></h1><?php } ?>
                    <?php if($module_input_content) { ?><p class="image-box-des"><?php echo $module_input_content; ?></p><?php } ?>
					<?php if($module_switch_social_network != 'false'): ?>
                        <?php if(count($module_social_medias) > 0): ?>
                            <ul class="image-box-icons">
                                <?php foreach($module_social_medias as $i => $media): ?>
                                    <?php foreach($option_social_networks as $social): 
                                        $media_url = $module_social_medias_url[$i];
                                        if($social['icon2'] == $media['value']): ?>
                                            <li><a title="<?php echo 'visit ' .$social['name']; ?>" href="<?php echo $media_url['value']; ?>"><i class="<?php echo $media['value']; ?>"></i></a></li>
                                    <?php endif;
                                    endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </section>
			
			<?php
			break;
			
			case 'single_image':
				$module_image_single = ux_get_module_meta($module_post, 'module_image_single', get_the_ID());
				$module_select_image_style = ux_get_module_meta($module_post, 'module_select_image_style', get_the_ID());
				$module_select_mouseover_effect = ux_get_module_meta($module_post, 'module_select_mouseover_effect', get_the_ID());
				$module_select_lightbox = ux_get_module_meta($module_post, 'module_select_lightbox', get_the_ID());
				if($module_select_image_style == 'shadow'){
					$with_shadow = 'shadow';
				}else{
					$with_shadow = '';
				}
				$meta_url = explode('__',$module_image_single);
				
				$meta_array = array();
				if(isset($meta_url[0])){
					$meta_array = explode('-',$meta_url[0]);
				}
				
				$img_src = '';
				if(isset($meta_url[1])){
					$img_src = $meta_url[1];
				}
				
				$lightbox_img = '';
				if(isset($meta_array[2])){
					$lightbox_img = wp_get_attachment_image_src($meta_array[2],'full');
					$lightbox_img = $lightbox_img[0];
				}
				
				if($module_select_lightbox == 'false'){
					$with_lightbox = '';
					$a_img = '<img src="'.$img_src.'" />';
				}else{
					$with_lightbox = 'lightbox';
					$a_img = '<a class="lightbox" href="'.$lightbox_img.'"><img src="'.$img_src.'" /></a>';
				}
				
				if($module_select_mouseover_effect == 'false'): ?>
                
                    <div class="single-image <?php echo $with_shadow; ?>">
                        <?php echo $a_img; ?>
                    </div>
                    
                <?php else: ?>
                
                    <div class="single-image mouse-over <?php echo $with_shadow; ?>">
                        <a class="<?php echo $with_lightbox; ?>" href="<?php echo $lightbox_img; ?>">
                            <div class="single-image-mask"><i class="m-eye"></i></div>
                            <img src="<?php echo $img_src; ?>" />
                        </a>
                    </div>
                <?php endif; ?>
                
            <?php
			break;
			
			case 'promote':
				$module_select_text_align = ux_get_module_meta($module_post, 'module_select_text_align', get_the_ID());
				$module_textarea_big_text = ux_get_module_meta($module_post, 'module_textarea_big_text', get_the_ID());
				$module_textarea_medium_text = ux_get_module_meta($module_post, 'module_textarea_medium_text', get_the_ID());
				$module_switch_show_button = ux_get_module_meta($module_post, 'module_switch_show_button', get_the_ID());
				$module_background_color = ux_get_module_meta($module_post, 'module_background_color', get_the_ID());
				$module_input_button_text = ux_get_module_meta($module_post, 'module_input_button_text', get_the_ID());
				$module_input_button_link = ux_get_module_meta($module_post, 'module_input_button_link', get_the_ID());
				
				$button_align = '';
				if($module_select_text_align){
					if($module_select_text_align == 'center') { $text_align = 'text-center';}else{ $text_align = 'promote-wrap-2c';}
					if($module_select_text_align == 'left'){
						$button_align = '';
					}
				}else{
					$text_align = '';
				}
				global $theme_color;
				if($module_background_color){
					$button_color = $theme_color[$module_background_color]['value'];
				}else{
					$button_color = $theme_color[1]['value'];
				}
				
	
				?>
                <div class="promote-wrap <?php echo $text_align; ?>">
                    
                        <div class="promote-text">
							<h4 class="promote-big"><?php echo $module_textarea_big_text; ?></h4>
							<p class="promote-medium"><?php echo $module_textarea_medium_text; ?></p>
						</div>
                    
                    <?php if($module_switch_show_button):?>
						<?php if($module_switch_show_button != 'false'):?>
                            <div class="promote-button-wrap <?php echo $button_align; ?>">
                                <a class="promote-button bg-<?php echo $button_color; ?>" title="<?php echo $module_input_button_text; ?>" href="<?php echo $module_input_button_link; ?>"><?php echo $module_input_button_text; ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
			
			
			
			<?php
			break;
			
			case 'progress_bar':
				$module_select_infographic_type = ux_get_module_meta($module_post, 'module_select_infographic_type', get_the_ID());
				$module_background_color = ux_get_module_meta($module_post, 'module_background_color', get_the_ID());
				$module_input_infographic_digit = ux_get_module_meta($module_post, 'module_input_infographic_digit', get_the_ID());
				$module_select_icon = ux_get_module_meta($module_post, 'module_select_icon', get_the_ID());
				$module_input_title = ux_get_module_meta($module_post, 'module_input_title', get_the_ID());
				$module_input_subtitle = ux_get_module_meta($module_post, 'module_input_subtitle', get_the_ID());
				$module_input_number_icons = ux_get_module_meta($module_post, 'module_input_number_icons', get_the_ID());
				$module_input_number_active_icons = ux_get_module_meta($module_post, 'module_input_number_active_icons', get_the_ID());
				$module_input_progress = ux_get_module_meta($module_post, 'module_input_progress', get_the_ID());
				$module_switch_show_background_color = ux_get_module_meta($module_post, 'module_switch_show_background_color', get_the_ID());
				
				$module_lists_layout_title = ux_get_module_meta($module_post, 'module_lists_layout_title', get_the_ID());
				$module_lists_layout_subtitle = ux_get_module_meta($module_post, 'module_lists_layout_subtitle', get_the_ID());
				$module_lists_layout_color = ux_get_module_meta($module_post, 'module_lists_layout_color', get_the_ID());
				$module_lists_layout_progress = ux_get_module_meta($module_post, 'module_lists_layout_progress', get_the_ID());
				
				global $theme_color;
				if($module_background_color){
					$background_color = $theme_color[$module_background_color]['value'];
					$background_color_rgb = $theme_color[$module_background_color]['rgb'];
				}else{
					$background_color = $theme_color[1]['value'];
					$background_color_rgb = $theme_color[1]['rgb'];
				}
				
				$infographic_digit = ($module_input_infographic_digit) ? $module_input_infographic_digit : 0;
				$infographic_title = ($module_input_title) ? $module_input_title : false;
				$infographic_subtitle = ($module_input_subtitle) ? $module_input_subtitle : false;
				$infographic_number = ($module_input_number_icons) ? $module_input_number_icons : false;
				$infographic_number_active = ($module_input_number_active_icons) ? $module_input_number_active_icons : 0;
				$infographic_icon = ($module_select_icon) ? $module_select_icon : 'm-check';
				$infographic_progress = ($module_input_progress) ? $module_input_progress : 0;
				
				$split_title = ($module_lists_layout_title) ? explode("'%_%'", $module_lists_layout_title) : false;
				$split_subtitle = ($module_lists_layout_subtitle) ? explode("'%_%'", $module_lists_layout_subtitle) : false;
				$split_color = ($module_lists_layout_color) ? explode("'%_%'", $module_lists_layout_color) : false;
				$split_progress = ($module_lists_layout_progress) ? explode("'%_%'", $module_lists_layout_progress) : false;
				
				$second_color = get_option('theme_option_auxiliary_second_color');
				if(!$second_color){ $second_color = '#f7f7f7'; }
				
				$theme_set_color = false;
				if(get_option('theme_option_color_theme_main')){
					$theme_set_color = get_option('theme_option_color_theme_main');
				}else{
					if(get_option('theme_option_select_color_scheme')){
						foreach($theme_color as $color){
							if($color['value'] == get_option('theme_option_select_color_scheme')){
								$theme_set_color = $color['rgb'];
							}
						}
						
					}
				}
				
				if($module_select_infographic_type){
					switch($module_select_infographic_type){
						case 'bar':
							$background_color = ($module_switch_show_background_color != 'false') ? 'bg-'.$background_color : 'bg-theme-color-1';
							 ?>
                            <section class="infrographic bar ux-mod-nobg">
                                <?php if($infographic_title): ?><h1><?php echo $infographic_title; ?></h1><?php endif; ?><div class="bar-percent"><div class="bignumber-item " data-digit="<?php echo $infographic_progress; ?>">0</div>%</div>
                                <div class="progress-wrap progress <?php echo $background_color; ?>" data-progress-percent="<?php echo $infographic_progress; ?>">
                                	
                                    <div class="progress-bar progress" style="background-color: <?php echo $second_color; ?>; "></div>
                                </div>
                            </section>
                        <?php
						break;
						
						case 'column': ?>
                            <section class="infrographic columns ux-mod-nobg">

                                <?php if($split_title){
									for ($i=0; $i<count($split_title) - 1; $i++){
										$infographic_title = (isset($split_title[$i])) ? $split_title[$i] : false;
										$infographic_subtitle = (isset($split_subtitle[$i])) ? $split_subtitle[$i] : false;
										$infographic_progress = (isset($split_progress[$i])) ? $split_progress[$i] : false;
										$background_color = (isset($split_color[$i])) ? $theme_color[$split_color[$i]]['value'] : $theme_color[1]['value']; 
										$background_color = ($module_switch_show_background_color != 'false') ? 'bg-'.$background_color : 'bg-theme-color-1';
										$background_color_rgb = (isset($split_color[$i])) ? $theme_color[$split_color[$i]]['rgb'] : $theme_color[1]['rgb'];
										$background_color_rgb = ($module_switch_show_background_color != 'false') ? $background_color_rgb : '#ee7164'; ?>
										<div class="vbar-item"><div class="vbar" data-lbl="<?php echo $infographic_title; ?>" data-val="<?php echo $infographic_progress; ?>" data-clr="<?php echo $background_color_rgb; ?>" style="background-color:  <?php echo $second_color; ?>;"></div></div>
									<?php
                                    }
								} ?>
                            </section>
                        <?php
						break;
						
						case 'pie':
							$background_color_rgb = ($module_switch_show_background_color != 'false') ? $background_color_rgb : '#ee7164'; ?>
                            <section class="infrographic pie ux-mod-nobg">
                                <section class="pie-item">
                                    <input class="knob" data-width="120" data-height="120" data-thickness=.03 data-bgcolor="<?php echo $second_color; ?>" value="0" data-val="<?php echo $infographic_progress; ?>" data-readOnly=true data-fgColor="<?php echo $background_color_rgb; ?>">
                                    <?php if($infographic_title): ?><h1 class="infrographic-tit"><?php echo $infographic_title; ?></h1><?php endif; ?>
                                    <?php if($infographic_subtitle): ?><p class="infrographic-subtit"><?php echo $infographic_subtitle; ?></p><?php endif; ?>
                                </section>
                            </section>
                        <?php
						break;
						
						case 'pictorial': ?>
                            <section class="infrographic pictorial">
                                <div class="progress_bars_with_image_content clearfix" data-number="<?php echo $infographic_number_active; ?>">
                                    <?php if($infographic_number){
										for($i=0; $i < $infographic_number; $i++){ ?>
                                            <div class="bar">
                                                <i class="bar_noactive grey <?php echo $infographic_icon; ?>">&nbsp;</i>
                                                <i class="bar_active <?php echo $background_color; ?> <?php echo $infographic_icon; ?>">&nbsp;</i>
                                            </div>
										<?php
										}
									} ?>
                                    
                                </div>
                            </section>
						
                        <?php
                        break;
						
						case 'big_number': ?>
                            <section class="infrographic bignumber ux-mod-nobg">
                                <div class="bignumber-item <?php echo $background_color; ?>" data-digit="<?php echo $infographic_digit; ?>">0</div>
                                <?php if($infographic_title): ?><h1 class="infrographic-tit"><?php echo $infographic_title; ?></h1><?php endif; ?>
                                <?php if($infographic_subtitle): ?><p class="infrographic-subtit"><?php echo $infographic_subtitle; ?></p><?php endif; ?>
                            </section><!--End infrographic bignumber-->
						<?php
                        break;
					}
				} 
			break;
			
			case 'portfolio':
				$module_select_sortable = ux_get_module_meta($module_post, 'module_select_sortable', get_the_ID());
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', get_the_ID());
				//$module_select_image_list_type = ux_get_module_meta($module_post, 'module_select_image_list_type', get_the_ID());
				$module_select_image_spacing = ux_get_module_meta($module_post, 'module_select_image_spacing', get_the_ID());
				$module_select_image_size = ux_get_module_meta($module_post, 'module_select_image_size', get_the_ID());
				
				if($module_select_sortable == 'top'){
					$filter_class = '';
					$isotope_class = 'clear';
					$isotope_margin = '';
				}elseif($module_select_sortable == 'left'){
					$filter_class = 'span3 onside';
					$isotope_class = 'span9';
					$isotope_margin = '';
				}elseif($module_select_sortable == 'right'){
					$filter_class = 'span3 onside onright pull-right';
					$isotope_class = 'span9';
					$isotope_margin = 'margin-left:0;';
				}else{
					$filter_class = '';
					$isotope_class = 'clear';
					$isotope_margin = '';
				}
				
				if($module_input_per_page != ''){
					$per_page = $module_input_per_page;
				}else{
					$per_page = '-1';
				}
				
				$idObj = get_category_by_slug($module_select_category);
				if($idObj){
					$set_category = $idObj->term_id;
				}else{
					$set_category = '0';
				}
				
				$get_categories = get_categories('parent='.$set_category);
				$portfolio_query = get_posts(array(
					'posts_per_page' => -1,
					'numberposts' =>-1,
					'category' => $set_category
				));
				
				$portfolio_query = get_posts(array(
					'posts_per_page' => -1,
					'numberposts' => -1,
					'category' => $set_category,
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array('post-format-gallery'),
							'operator' => 'IN'
						)
					)
				));
				
				$portfolio_count = count($portfolio_query);
				
				if($module_select_image_spacing){
					$isotope_style = 'margin:-'.$module_select_image_spacing.' 0 0 -'.$module_select_image_spacing;
				}else{
					$isotope_style = 'margin:-40px 0 0 -40px';
				}
				?>
                <!--allery isotope-->
				<div class="row-fluid">
				
                    <?php if($module_select_sortable != 'no'): ?>
                    <!--Filter-->
                    <ul class="clearfix filters <?php echo $filter_class; ?>">
                        <li class="active"><a href="#" data-filter="*"><?php _e('All','ux'); ?></a></li>	
                        <?php foreach($get_categories as $cate): ?>		
                        <li><a data-filter=".filter_<?php echo $cate->slug; ?>" href="#"><?php echo $cate->name; ?></a></li>
                        <?php endforeach; ?> 
                    </ul><!--End filter-->
                    <?php endif; ?>

					<div class="container-isotope <?php echo $isotope_class; ?>" style=" <?php echo $isotope_margin; ?>" data-post="<?php echo $module_post; ?>">
                    <div id="isotope-load" class="isotope-load"></div>
                        <div class="isotope masonry<?php //echo $module_select_image_list_type; ?>" data-space="<?php echo $module_select_image_spacing; ?>" style=" <?php echo $isotope_style; ?>" data-size="<?php echo $module_select_image_size; ?>">
						
							<?php ux_view_module_load($module_id, get_the_ID(), 1, $module_post); ?>
                        </div>
	
					</div> <!--End container-isotope-->
                    
                    <?php ux_view_module_pagenums(get_the_ID(),$per_page,$portfolio_count,$module_id,$module_post); ?>

				</div><!--End row-fluid-->
            
			<?php
			break;
			
			case 'gallery':
				$module_select_image_source = ux_get_module_meta($module_post, 'module_select_image_source', get_the_ID());
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_select_sortable = ux_get_module_meta($module_post, 'module_select_sortable', get_the_ID());
				$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', get_the_ID());
				//$module_select_image_list_type = ux_get_module_meta($module_post, 'module_select_image_list_type', get_the_ID());
				$module_select_image_spacing = ux_get_module_meta($module_post, 'module_select_image_spacing', get_the_ID());
				$module_select_image_size = ux_get_module_meta($module_post, 'module_select_image_size', get_the_ID());
				
				if($module_select_image_spacing){
					$isotope_style = 'margin:-'.$module_select_image_spacing.' 0 0 -'.$module_select_image_spacing;
					$inside_style = 'margin:'.$module_select_image_spacing.' 0 0 '.$module_select_image_spacing;
				}else{
					$isotope_style = 'margin:-40px 0 0 -40px';
					$inside_style = 'margin:40px 0 0 40px';
				}
								
				if($module_select_sortable == 'top'){
					$filter_class = '';
					$isotope_class = 'clear';
					$isotope_margin = '';
				}elseif($module_select_sortable == 'left'){
					$filter_class = 'span3 onside';
					$isotope_class = 'span9';
					$isotope_margin = '';
				}elseif($module_select_sortable == 'right'){
					$filter_class = 'span3 onside onright pull-right';
					$isotope_class = 'span9';
					$isotope_margin = 'margin-left:0;';
				}else{
					$filter_class = '';
					$isotope_class = 'clear';
					$isotope_margin = '';
				}
				
				if($module_input_per_page != ''){
					$per_page = $module_input_per_page;
				}else{
					$per_page = '-1';
				}
				
				$idObj = get_category_by_slug($module_select_category);
				if($idObj){
					$set_category = $idObj->term_id;
				}else{
					$set_category = '0';
				}
				
				$get_categories = get_categories('parent='.$set_category);
				?>
                <!--gallery isotope-->
				<div class="row-fluid">

					<?php 
					if($module_select_image_source == 'image_post'):
					
						$gallery_querys = get_posts(array(
							'posts_per_page' => -1,
							'numberposts' => -1,
							'category' => $set_category,
							'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'post_format',
									'field' => 'slug',
									'terms' => array('post-format-image'),
									'operator' => 'IN'
								)
							)
						));
						
						$gallery_count = count($gallery_querys);
						?>
                    
						<?php if($module_select_sortable != 'no'): ?>
                        <!--Filter-->
                        <ul class="clearfix filters <?php echo $filter_class; ?>">
                            <li class="active"><a href="#" data-filter="*"><?php _e('All','ux'); ?></a></li>	
                            <?php foreach($get_categories as $cate): ?>		
                            <li><a data-filter=".filter_<?php echo $cate->slug; ?>" href="#"><?php echo $cate->name; ?></a></li>
                            <?php endforeach; ?> 
                        </ul><!--End filter-->
                        <?php endif; ?>
                        
                        <div class="container-isotope <?php echo $isotope_class; ?>" style=" <?php echo $isotope_margin; ?>" data-post="<?php echo $module_post; ?>">
                        <div id="isotope-load" class="isotope-load"></div>
						    <div class="isotope masonry<?php //echo $module_select_image_list_type; ?>" style=" <?php echo $isotope_style; ?>" data-size="<?php echo $module_select_image_size; ?>">
								<?php ux_view_module_load($module_id, get_the_ID(), 1, $module_post); ?>
                            </div>
                        </div>
                    
                    <?php else: ?>
                    
                        <?php
						$module_select_gallery_selected = ux_get_module_meta($module_post, 'module_select_gallery_selected', get_the_ID());
						$split_gallery = explode("'%_%'",$module_select_gallery_selected);
						$gallery_count = count($split_gallery) - 1;
						?>
                        
                        <div class="container-isotope" data-post="<?php echo $module_post; ?>">
                        <div id="isotope-load" class="isotope-load"></div>
                            <div class="isotope masonry<?php //echo $module_select_image_list_type; ?>" style=" <?php echo $isotope_style; ?>" data-size="<?php echo $module_select_image_size; ?>">
								<?php ux_view_module_load($module_id, get_the_ID(), 1, $module_post); ?>
                            </div>
        
                        </div> <!--End container-isotope-->
                    
                    <?php endif; ?>
                    
                    <?php ux_view_module_pagenums(get_the_ID(),$per_page,$gallery_count,$module_id, $module_post); ?>

				</div><!--End row-fluid-->
			<?php
			break;
			
			case 'team':
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', get_the_ID());

				
				if($module_input_per_page != ''){
					$per_page = $module_input_per_page;
				}else{
					$per_page = '-1';
				}
				
				$idObj = get_term_by('slug', $module_select_category, 'team_cat');
				if($idObj){
					$set_category = $idObj->term_id;
					$slug_category = $module_select_category;
				}else{
					$set_category = '0';
					$slug_category = '';
				}
				
				$get_categories = get_terms('team_cat');
				$team_query = get_posts(array(
					'posts_per_page' => -1,
					'team_cat' => $slug_category,
					'post_type' => 'team'
				));
				
				$team_count = count($team_query);

				?>
                <!--allery isotope-->
				<div class="row-fluid">

					<div class="container-isotope" style="" data-post="<?php echo $module_post; ?>">
                    
                        <div class="isotope grid_list" data-space="40px" style="  margin: -40px 0px 0px -40px;" data-size="medium">
							<?php ux_view_module_load($module_id, get_the_ID(), 1, $module_post); ?>
                        </div>
	
					</div> <!--End container-isotope-->
                    
                    <?php ux_view_module_pagenums(get_the_ID(),$per_page,$team_count,$module_id,$module_post); ?>

				</div><!--End row-fluid-->
				
			<?php
			break;
			
			case 'client':
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_input_columns = ux_get_module_meta($module_post, 'module_input_columns', get_the_ID());
				
				$idObj = get_term_by('slug', $module_select_category, 'client_cat');
				if($idObj){
					$set_category = $idObj->term_id;
					$slug_category = $module_select_category;
				}else{
					$set_category = '0';
					$slug_category = '';
				}
				
				$client_query = get_posts(array(
					'posts_per_page' => -1,
					'numberposts' => -1,
					'post_type' => 'clients',
					'client_cat' => $slug_category
				));
				
				if($module_input_columns){
					$span_class = 12 / intval($module_input_columns);
					$data_column = $module_input_columns;
				}else{
					$span_class = 12 / 1;
					$data_column = 1;
				}
				?>
                <div class="clients_wrap carousel-wrap" data-column="<?php echo $data_column; ?>">
					<?php if(count($client_query) > 0): ?>
                    <ul>
                        <?php foreach($client_query as $i => $client): ?>
                        <?php $post_type_client_link = get_post_meta($client->ID, 'post_type_client_link', true); ?>
                        <li><a title="<?php echo get_the_title($client->ID); ?>" href="<?php echo $post_type_client_link;?>"><?php echo get_the_post_thumbnail($client->ID, 'full');?></a></li>
                        
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <div class="carousel-btn">
                        <a href="#" class="prev"><i class="m-left-arrow"></i></a>
                        <a href="#" class="next"><i class="m-right-arrow"></i></a>
					</div>
                
                </div>
			<?php
			break;
			
			case 'jobs':
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', get_the_ID());
				$module_select_order = ux_get_module_meta($module_post, 'module_select_order', get_the_ID());
				
				if($module_select_orderby != '-1'){
					$orderby = $module_select_orderby;
				}else{
					$orderby = 'none';
				}
				
				if($module_select_order == 'descending'){
					$order = 'DESC';
				}else{
					$order = 'ASC';
				}
				
				$idObj = get_term_by('slug', $module_select_category, 'job_cat');
				if($idObj){
					$set_category = $idObj->term_id;
					$slug_category = $module_select_category;
				}else{
					$set_category = '0';
					$slug_category = '';
				}
				
				$jobs_query = new WP_Query(array(
					'posts_per_page' => -1,
					'numberposts' => -1,
					'orderby' => $orderby,
					'order' => $order,
					'post_type' => 'jobs',
					'job_cat' => $slug_category
				));
				?>
                <div id="accordion<?php echo $post_id; ?>" class="accordion_toggle accordion-style-b ux-mod-nobg job-mod">
                    <?php
					if ( $jobs_query->have_posts() ){
						while($jobs_query->have_posts()){
							$jobs_query->the_post();
							$location = get_post_meta(get_the_ID(), 'post_type_job_location', true);
							$number = get_post_meta(get_the_ID(), 'post_type_job_number', true);
							?>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#collapse_<?php the_ID(); ?>" data-parent="#accordion<?php the_ID(); ?>" data-toggle="collapse" class="accordion-toggle"><?php the_title(); ?></a>
								</div><!--End accordion-heading-->
								
								<div class="accordion-body collapse" id="collapse_<?php the_ID(); ?>">
									<div class="accordion-inner">
										<p class="job-meta"><span><?php echo __('Location:', 'ux'). ' '.$location; ?></span> <span><?php echo __('Number:', 'ux').' '.$number; ?></span></p>
										<?php the_content(); ?>
									</div><!--End accordion-inner-->
								</div><!--End accordion-body-->
							</div>
                        <?php
						}
						wp_reset_postdata();
					}?>
                </div>
                
			
			<?php
			break;
			
			case 'faq':
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', get_the_ID());
				$module_select_order = ux_get_module_meta($module_post, 'module_select_order', get_the_ID());
				
				if($module_select_orderby != '-1'){
					$orderby = $module_select_orderby;
				}else{
					$orderby = 'none';
				}
				
				if($module_select_order == 'descending'){
					$order = 'DESC';
				}else{
					$order = 'ASC';
				}
				
				$idObj = get_term_by('slug', $module_select_category, 'question_cat');
				if($idObj){
					$set_category = $idObj->term_id;
					$slug_category = $module_select_category;
				}else{
					$set_category = '0';
					$slug_category = '';
				}
				
				$faq_query = new WP_Query(array(
					'posts_per_page' => -1,
					'numberposts' => -1,
					'orderby' => $orderby,
					'order' => $order,
					'post_type' => 'faqs',
					'question_cat' => $slug_category
				));
				?>
                <div id="accordion<?php echo $post_id; ?>" class="accordion_toggle accordion-style-b ux-mod-nobg faq-mod">
                    <?php
					if ( $faq_query->have_posts() ){
						while($faq_query->have_posts()){
							$faq_query->the_post();
							?>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#collapse_<?php the_ID(); ?>" data-parent="#accordion<?php the_ID(); ?>" data-toggle="collapse" class="accordion-toggle"><?php the_title(); ?></a>
								</div><!--End accordion-heading-->
								
								<div class="accordion-body collapse" id="collapse_<?php the_ID(); ?>">
									<div class="accordion-inner">
										<?php the_content(); ?>
									</div><!--End accordion-inner-->
								</div><!--End accordion-body-->
							</div>
                        <?php
						}
						wp_reset_postdata();
					}?>
                </div>
                
			
			<?php
			break;
			
			case 'testimonials':
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', get_the_ID());
				$module_select_order = ux_get_module_meta($module_post, 'module_select_order', get_the_ID());
				$module_select_columns = ux_get_module_meta($module_post, 'module_select_columns', get_the_ID());
				$module_select_rows = ux_get_module_meta($module_post, 'module_select_rows', get_the_ID());
				
				$select_testimonials_position = ux_get_module_meta($module_post, 'module_switch_testimonials_position', get_the_ID());
				$select_testimonials_link = ux_get_module_meta($module_post, 'module_switch_testimonials_link', get_the_ID());
				
				$columns = 1;
				$rows = 1;
				if($module_select_columns){
					$columns = intval($module_select_columns);
				}
				
				if($module_select_rows){
					$rows = intval($module_select_rows);
				}
				
				
				if($columns){
					$span_class = 12 / $columns;
				}else{
					$span_class = 12;
				}
				
				
				if($module_select_orderby != '-1'){
					$orderby = $module_select_orderby;
				}else{
					$orderby = 'none';
				}
				
				if($module_select_order == 'descending'){
					$order = 'DESC';
				}else{
					$order = 'ASC';
				}
				
				$idObj = get_term_by('slug', $module_select_category, 'testimonial_cat');
				if($idObj){
					$set_category = $idObj->term_id;
					$slug_category = $module_select_category;
				}else{
					$set_category = '0';
					$slug_category = '';
				}
				
				$testimonials_query = get_posts(array(
					'posts_per_page' => -1,
					'numberposts' => -1,
					'orderby' => $orderby,
					'order' => $order,
					'post_type' => 'testimonials',
					'testimonial_cat' => $slug_category
				));
				if(count($testimonials_query) > $columns * $rows){
					$count_row = ceil(count($testimonials_query) / ($columns * $rows));
					?>
					<div class="carousel-wrap testimonials-wrap row-liquid">
						<ul>
						<?php
						for($row_r=0; $row_r<$count_row; $row_r++){
							?><li class="span12"><?php
							for($row=0; $row<$rows; $row++){
								?>
								<div class="row-fluid">
								<?php
								for($column=0; $column<$columns; $column++){
									$this_post = $column + ($columns * $row) + ($columns * $rows * $row_r);
									if($this_post < count($testimonials_query)){
										$testimonial = $testimonials_query[$this_post];
										$cite = get_post_meta($testimonial->ID, 'post_type_testimonial_cite', true);
										$position = get_post_meta($testimonial->ID, 'post_type_testimonial_position', true);
										$link = get_post_meta($testimonial->ID, 'post_type_testimonial_link', true);
										
										$testimonial_position = ($position) ? $position : false;
										$testimonial_title = ($link) ? $link['title'] : false;
										$testimonial_link = ($link) ? $link['link'] : false; ?>
									
										<div class="span<?php echo floor($span_class); ?>">
											<div class="testimenials"><i class="m-quote-left"></i>
												<?php echo $testimonial->post_content; ?>
												<div class="cite">
													<?php echo $cite; ?>
                                                    <?php if($select_testimonials_position != 'false'){
														if($position){ ?>
                                                            <span class="testimonial-position"><?php echo $testimonial_position; ?></span>
														<?php 
														}
													}
													if($select_testimonials_link != 'false'){
														if($link) { ?>
                                                            <span class="testimonial-company"><a class="testimonial-link" href="<?php echo esc_url($testimonial_link); ?>"><?php echo $testimonial_title; ?></a></span>
														<?php 
														} 
													} ?>
                                                </div>
												<div class="arrow-bg"><p class="arrow-wrap"><span class="arrow"></span></p></div>
											</div>
										</div>
								<?php }
								
								}?>
								</div>
								
							<?php
							}
							?></li><?php
						}
						?>
						</ul>
						<div class="carousel-btn">
							<a class="prev" href="#"><i class="m-left-arrow"></i></a>
							<a class="next" href="#"><i class="m-right-arrow"></i></a>
						</div>
					</div>
					<?php
				}else{
					for($row=0; $row<$rows; $row++){
						?>
						<div class="row-fluid">
						<?php
						for($column=0; $column<$columns; $column++){
							$this_post = $column + ($columns * $row);
							if($this_post < count($testimonials_query)){
								$testimonial = $testimonials_query[$this_post];
								$cite = get_post_meta($testimonial->ID, 'post_type_testimonial_cite', true); ?>
							
								<div class="span<?php echo floor($span_class); ?>">
									<div class="testimenials"><i class="m-quote-left"></i>
										<?php echo $testimonial->post_content; ?>
										 <div class="cite"><?php echo $cite; ?></div>
										<div class="arrow-bg"><p class="arrow-wrap"><span class="arrow"></span></p></div>
									</div>
								</div>
						<?php }
						
						}?>
						</div>
						
					<?php
					}
				}
				
				?>
                
			<?php
			break;
			
			case 'google_map':
				$select_map_address2 = ux_get_module_meta($module_post, 'module_input_map_address2', get_the_ID());
				$select_map_canvas = ux_get_module_meta($module_post, 'module_input_google_map_canvas', get_the_ID());
				$select_map_height = ux_get_module_meta($module_post, 'module_input_map_height', get_the_ID());
				$select_map_view = ux_get_module_meta($module_post, 'module_select_map_view', get_the_ID());
				$select_map_zoom = ux_get_module_meta($module_post, 'module_select_map_zoom', get_the_ID());
				$select_map_pin = ux_get_module_meta($module_post, 'module_switch_map_pin', get_the_ID());
				
				$map_height = 'height: 400px';
				if($select_map_height){
					$map_height = 'height: '.$select_map_height.'px';
				}
				
				$location_l = -33.8674869;
				$location_r = 151.20699020000006;
				if($select_map_canvas){
					if($select_map_canvas != ''){
						$map_location = str_replace('(', '', $select_map_canvas);
						$map_location = str_replace(')', '', $map_location);
						$map_location = explode(', ', $map_location);
						
						$location_l = (isset($map_location[0])) ? $map_location[0] : $location_l;
						$location_r = (isset($map_location[1])) ? $map_location[1] : $location_r;
					}
				}
				
				$map_zoom = ($select_map_zoom) ? $select_map_zoom : 7;
				$map_pin = 'f';
				if($select_map_pin){
					if($select_map_pin != 'false'){
						$map_pin = 't';
					}
				}
				
				$map_view = ($select_map_view) ? $select_map_view : 'map';
				?>
                <div class="module-map-canvas" style=" <?php echo $map_height; ?>" data-l="<?php echo $location_l; ?>" data-r="<?php echo $location_r; ?>" data-zoom="<?php echo $map_zoom; ?>" data-pin="<?php echo $map_pin; ?>" data-view="<?php echo $map_view; ?>"></div>
            <?php
			break;
			
			case 'video':
				$module_textarea_embed_code = ux_get_module_meta($module_post, 'module_textarea_embed_code', get_the_ID());
				$module_select_video_ratio = ux_get_module_meta($module_post, 'module_select_video_ratio', get_the_ID());
				$module_select_video_ratio_custom = ux_get_module_meta($module_post, 'module_select_video_ratio_custom', get_the_ID());
				$split_ratio_custom = explode("'%_%'",$module_select_video_ratio_custom);
				$module_input_ogv = ux_get_module_meta($module_post, 'module_input_ogv', get_the_ID());
				$module_input_m4v = ux_get_module_meta($module_post, 'module_input_m4v', get_the_ID());
				
				$video_custom = '';
				if($module_select_video_ratio == '16:9'){
					$video_size = 'video-16-9';
				}elseif($module_select_video_ratio == '4:3'){
					$video_size = 'video-4-3';
				}elseif($module_select_video_ratio == 'custom'){
					$key_1 = 4;
					$key_2 = 3;
					if(isset($split_ratio_custom[0])){
						if($split_ratio_custom[0] != ''){
							$key_1 = intval($split_ratio_custom[0]);
						}
					}
					
					if(isset($split_ratio_custom[1])){
						if($split_ratio_custom[1] != ''){
							$key_2 = intval($split_ratio_custom[1]);
						}
					}
					
					$video_size = '';
					$video_custom = 'padding-bottom:'.($key_2 / $key_1) * 100 .'%';
				}else{
					$video_size = '';
				}
				
				if($module_input_m4v != ''){
					$video_file = $module_input_m4v;
				}else{
					$video_file = $module_input_ogv;
				}
				
				
				?>
                <div class="video-wrap <?php echo $video_size; ?>" style=" <?php echo $video_custom; ?>">
				<?php if($module_textarea_embed_code): ?>
					<?php if ( ereg ("youtube", $module_textarea_embed_code) && !(ereg("iframe", $module_textarea_embed_code))) : ?>
                        <iframe src="http://www.youtube.com/embed/<?php echo get_you_tube_id($module_textarea_embed_code);?>?rel=0&controls=1&showinfo=0&theme=light&autoplay=0&wmode=transparent" width="1500" height="844" frameborder="0" allowfullscreen=""></iframe>
                    <?php elseif ( ereg ("vimeo", $module_textarea_embed_code) && !(ereg("iframe", $module_textarea_embed_code))) : ?>
                        <iframe src="http://player.vimeo.com/video/<?php echo get_vimeo_id($module_textarea_embed_code); ?>?title=0&amp;byline=0&amp;portrait=0" width="1500" height="844" frameborder="0" allowfullscreen=""></iframe>
						
                    <?php else :?>
                        <?php echo $module_textarea_embed_code; ?>
                    <?php endif; ?>
				<?php else: ?>
                    <iframe src="<?php echo $video_file; ?>" width="1500" height="844" frameborder="0" allowfullscreen=""></iframe>
				
				<?php endif; ?>
                </div>
			<?php
			break;
			
			case 'slider':
				$module_select_slider_image = ux_get_module_meta($module_post, 'module_select_slider_image', get_the_ID());
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', get_the_ID());
				$module_select_order = ux_get_module_meta($module_post, 'module_select_order', get_the_ID());
				$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', get_the_ID());
				$module_select_layer_slider = ux_get_module_meta($module_post, 'module_select_layer_slider', get_the_ID());
				$select_revolution_slider = ux_get_module_meta($module_post, 'module_select_revolution_slider', get_the_ID());
				$select_animation = ux_get_module_meta($module_post, 'module_select_flexslider_animation', get_the_ID());
				$select_speed_second = ux_get_module_meta($module_post, 'module_input_speed_second', get_the_ID());
				$select_navigation_hint = ux_get_module_meta($module_post, 'module_switch_navigation_hint', get_the_ID());
				$select_previous_next = ux_get_module_meta($module_post, 'module_switch_previous_next', get_the_ID());
				
				$direction = ($select_previous_next) ? $select_previous_next : 'true'; 
				$control = ($select_navigation_hint) ? $select_navigation_hint : 'true'; 
				$speed = ($select_speed_second) ? $select_speed_second : 7000; 
				$animation = ($select_animation) ? $select_animation : 'slide';
				
				if($module_input_per_page != ''){
					$per_page = $module_input_per_page;
				}else{
					$per_page = '3';
				}
				
				if($module_select_orderby != '-1'){
					$orderby = $module_select_orderby;
				}else{
					$orderby = 'none';
				}
				
				if($module_select_order == 'descending'){
					$order = 'DESC';
				}else{
					$order = 'ASC';
				}
				
				$idObj = get_category_by_slug($module_select_category);
				if($idObj){
					$set_category = $idObj->term_id;
				}else{
					$set_category = '0';
				}
				
				$slider_query = get_posts(array(
					'posts_per_page' => $per_page,
					'category' => $set_category,
					'orderby' => $orderby,
					'order' => $order,
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array(
								'post-format-quote',
								'post-format-link',
								'post-format-audio',
								'post-format-video'
							),
							'operator' => 'NOT IN'
						)
					),
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => '_thumbnail_id',
							'compare' => 'EXISTS'
						)
					)
				));

				global $post;
				?>
                <?php if($module_select_slider_image == 'novo'):?>
                <!--Content slider-->
				<div id="post<?php echo $module_post; ?>" class="listitem_slider carousel slide">
				
					<ol class="carousel-indicators">
						<?php foreach($slider_query as $num => $slider):
						if($num == 0){
							$active_class = 'active';
						}else{
							$active_class = '';
						}
						?>
                            <li class="<?php echo $active_class; ?>" data-slide-to="<?php echo $num; ?>" data-target="#post<?php echo $module_post; ?>"></li>
                        <?php endforeach; ?>
					</ol>
					
					<div class="carousel-img-wrap">
					
						<div class="carousel-inner">
							
							<?php foreach($slider_query as $num => $slider):
							$thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($slider->ID), 'image-thumb-1');
							if($num == 0){
								$active_class = 'active';
							}else{
								$active_class = '';
							}
							global $theme_color;
							$post_background_color = get_post_meta($slider->ID, 'post_background_color', true);
							if($post_background_color){
								$slider_post_color = 'background-color:'.$theme_color[$post_background_color]['value'];
							}else{
								$slider_post_color = '';
							}
							?>
							<div class="item <?php echo $active_class; ?>">
								<div class="slider_img">
									<a href="<?php echo $thumbnail_url[0]; ?>" class="lightbox" rel="prettyPhoto[post<?php echo $module_post; ?>]"><img src="<?php echo $thumbnail_url[0]; ?>"></a>
								</div><!--End slider_img-->
							</div><!--End item-->
							<?php endforeach; ?>
		
						</div><!--End .carousel-inner-->
						
						<a class="carousel-control left" href="#post<?php echo $module_post; ?>" data-slide="prev"><i class="m-angle-left"></i></a>
						<a class="carousel-control right" href="#post<?php echo $module_post; ?>" data-slide="next"><i class="m-angle-right"></i></a>
						
					</div><!--End .carousel-img-wrap-->
					
					<div class="slider-panel">
					
						
                        <?php foreach($slider_query as $num => $slider):
						if($num == 0){
							$active_class = 'active';
						}else{
							$active_class = '';
						}
						?>
						<div class="slider-panel-item <?php echo $active_class; ?>">
							<h2 class="slider-title"><a href="<?php echo get_permalink($slider->ID); ?>" title="<?php echo get_the_title($slider->ID); ?>"><?php echo get_the_title($slider->ID); ?></a></h2>
							<p class="slider-des"><?php echo $slider->post_excerpt; ?></p>
						</div><!--End .slider-panel-item-->
						<?php endforeach; ?>
						
					</div><!--End .slider-panel-->	
					
				</div><!--End .listitem_slider-->
                <?php elseif($module_select_slider_image == 'flexslider'): ?>
                    <div class="flex-slider-wrap" data-direction="<?php echo $direction; ?>" data-control="<?php echo $control; ?>" data-speed="<?php echo $speed; ?>" data-animation="<?php echo $animation; ?>">
                        <div class="flexslider">
                            <ul class="slides clearfix">
                                <?php foreach($slider_query as $num => $slider):
									$thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($slider->ID), 'image-thumb-1');  ?>
                                    <li><a href="<?php echo get_permalink($slider->ID); ?>" title="<?php echo get_the_title($slider->ID); ?>"><img src="<?php echo $thumbnail_url[0]; ?>" title="<?php echo get_the_title($slider->ID); ?>"></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div><!--End flexslider-->
                    </div>
                    <!--End flex-slider-wrap-->
                <?php elseif($module_select_slider_image == 'revolutionslider'): ?>
                <?php if($select_revolution_slider){
					echo do_shortcode('[rev_slider '.$select_revolution_slider.']');
				}
                ?>
				<?php else: ?>
                <?php if($module_select_layer_slider){
					echo do_shortcode('[layerslider id="'.$module_select_layer_slider.'"]');
				}
                ?>
                <?php endif; ?>
			<?php
			break;
			
			case 'share':
				$module_cheak_share = ux_get_module_meta($module_post, 'module_cheak_share', get_the_ID());
				$split_share = explode("'%_%'",$module_cheak_share);
				?>
                <div class="share-icon-wrap">
				<input value="<?php the_permalink(); ?>" name="url"  type="hidden"/>
				<input value="<?php the_title(); ?>" name="title"  type="hidden"/>
				<input value="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" name="media"  type="hidden"/>
					<ul class="post_social clearfix">
                        <?php for($i=0; $i<count($split_share); $i++){ ?>
						
							<?php if($split_share[$i] == 'twitter'): ?>
                            
                             <li>
								<a class="share postshareicon-twitter-wrap" href="javascript:;">
								<span class="icon postshareicon-twitter"><i class="m-social-twitter"></i></span>
								<span class="count">0</span>
								</a>
							</li>
                            
                            <?php elseif($split_share[$i] == 'facebook'): ?>
                            
                             <li>
								<a class="share postshareicon-facebook-wrap" href="javascript:;">
								<span class="icon postshareicon-facebook"><i class="m-social-facebook"></i></span>
								<span class="count">0</span>
								</a>
							</li>
                            
                            <?php elseif($split_share[$i] == 'pinterest'): ?>
                            
								<?php if(has_post_thumbnail()): ?>
                                
                                <li>
									<a class="share postshareicon-pinterest-wrap" href="javascript:;">
									<span class="icon postshareicon-pinterest"><i class="m-social-pinterest"></i></span>
									<span class="count">0</span>
									</a>
								</li>
                                
                                <?php endif; ?>

                            
                            <?php endif; ?>
                        <?php } ?>
						
					</ul><!--End .post_social-->
					
				</div>
            <?php
			break;
			
			case 'contact_form':
				$module_input_button_text = ux_get_module_meta($module_post, 'module_input_button_text', get_the_ID());
				$module_input_recipient_email = ux_get_module_meta($module_post, 'module_input_recipient_email', get_the_ID());
				if(!$module_input_recipient_email) { $module_input_recipient_email = get_bloginfo('admin_email'); }
				$module_textarea_sent_message = ux_get_module_meta($module_post, 'module_textarea_sent_message', get_the_ID());
				if(!$module_textarea_sent_message){ $module_textarea_sent_message = "Thanks, your email was successfully sent"; }
				$module_select_contact_form_type = ux_get_module_meta($module_post, 'module_select_contact_form_type', get_the_ID());
				$module_input_field_text =  ux_get_module_meta($module_post, 'module_input_field_text', get_the_ID());
				$show_verifynumber = ux_get_module_meta($module_post, 'module_switch_show_verifynumber', get_the_ID());
				
				if($module_select_contact_form_type){
					switch($module_select_contact_form_type){
						case 'contact_form': ?>
                            <div class="contactform">
                                <form action="<?php $_SERVER['REQUEST_URI']; ?>" id="contact-form" class="contact_form" method="POST">
                                    <p><input type="text" id="idi_name" name="idi_name" class="requiredField" value="<?php _e('Name*','ux'); ?>" onBlur="if (this.value =='' ) {this.value = '<?php _e('Name*','ux'); ?>';}" onFocus="if (this.value == '<?php _e('Name*','ux'); ?>' || this.value == '<?php _e('Required','ux'); ?>' ) { this.value = ''; }" /></p>
                                    <p><input type="text" id="idi_mail" name="idi_mail" class="requiredField email" value="<?php _e('Email*','ux'); ?>" onBlur="if (this.value =='' ) {this.value = '<?php _e('Email*','ux'); ?>';}" onFocus="if (this.value == '<?php _e('Email*','ux'); ?>' || this.value  == '<?php _e('Required','ux'); ?>' || this.value == '<?php _e('Invalid email','ux'); ?>' ) {this.value = '';}" /></p>
                                    <p><textarea rows="4" name="idi_text" id="idi_text" cols="4" class="requiredField inputError"  onfocus="if (this.value == '<?php _e('Required','ux'); ?>') {this.value = '';}"></textarea></p>
                                    <input type="hidden" value="send" class="info-tip" name="contact_form" onFocus="if (this.value  == '<?php _e('Required','ux'); ?>' ) {this.value = '';}" data-message="<?php echo $module_textarea_sent_message; ?>" data-sending="<?php _e('Sending...','ux')?>" data-error="<?php _e('Please Enter Correct Verification Number','ux')?>" />
									<div class="btnarea">
									<?php 
									if($show_verifynumber) { 
										
										if($show_verifynumber!='false'){
											
									?>
										<div class="verify-wrap">
											<input type="hidden" value="701469" id="verifyNumHidden" class="verifyNumHidden" name="verifyNumHidden" />
											<input type="text" id="enterVerify" name="enterVerify" class="requiredField Verify" onFocus="if (this.value  == '<?php _e('Required','ux'); ?>' ) {this.value = '';}" />
											<span class="verifyNum" id="verifyNum"></span>
										</div>
									<?php 
									
										}
									
									}?>	
										<input type="submit" id="idi_send" name="idi_send" value="<?php echo $module_input_button_text; ?>" />
									</div>
							
                                </form>
                            </div>
                            <?php 
							
						if( isset($_POST['contact_form']) && $_POST['contact_form'] == 'send')
						{
							$name = isset( $_POST['idi_name'] ) ? trim(htmlspecialchars($_POST['idi_name'], ENT_QUOTES)) : '';
							$email =  isset( $_POST['idi_mail'] ) ? trim(htmlspecialchars($_POST['idi_mail'], ENT_QUOTES)) : '';
							$content =  isset( $_POST['idi_text'] ) ? trim(htmlspecialchars($_POST['idi_text'], ENT_QUOTES)) : '';
							$sitename = get_bloginfo( 'name' );
							$siteurl = get_permalink();
							$post_content = "This mail was sent by  $name .  Content:  $content . Sent on: $sitename - $siteurl";
							$title =  'Mail from '.$email. ' sent on '.$sitename ;
							$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
							wp_mail($module_input_recipient_email,$title,$post_content,$headers);
						}
							
						break; 
						
						case 'single_field': ?>
                            <form action="#" id="contact-form" class="contact_form single-feild" method="POST">
                                <div class="single-feild-mail"><input type="text" id="idi_mail" name="idi_mail" class="requiredField email" value="<?php echo $module_input_field_text; ?>" onBlur="if (this.value =='' ) {this.value = '<?php echo $module_input_field_text; ?>';}" onFocus="if (this.value == '<?php echo $module_input_field_text; ?>' || this.value  == 'Required' || this.value == 'Invalid email' ) {this.value = '';}" /></div>
                                <input type="hidden" value="send" name="single_form" class="info-tip" data-message="<?php echo $module_textarea_sent_message; ?>" data-sending="<?php _e('Sending...','ux')?>" />
									<div class="verify-wrap">
									<?php 
									if($show_verifynumber) { 
										
										if($show_verifynumber!='false'){
											
									?>
										
											<input type="hidden" value="701469" id="verifyNumHidden" class="verifyNumHidden" name="verifyNumHidden" />
											<input type="text" id="enterVerify" name="enterVerify" class="requiredField Verify" onFocus="if (this.value  == '<?php _e('Required','ux'); ?>' ) {this.value = '';}" />
											<span class="verifyNum" id="verifyNum"></span>
										<?php 

										}
									
									}?>	
									</div>
									
								<div class="single-feild-submit"><input type="submit" id="idi_send" name="idi_send" class="idi_send" value="<?php echo $module_input_button_text; ?>" /></div>
                            </form>
						<?php
						
						if( isset($_POST['single_form']) && $_POST['single_form'] == 'send')
						{
							$email =  isset( $_POST['idi_mail'] ) ? trim(htmlspecialchars($_POST['idi_mail'], ENT_QUOTES)) : '';
							$sitename = get_bloginfo( 'name' );
							$siteurl = get_permalink();
							$post_content = "This subscription was sent by  $email .  Sent on: $sitename - $siteurl";
							$title = 'Subscription from '.$email. ' sent on '.$sitename ;
							$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
							wp_mail($module_input_recipient_email,$title,$post_content,$headers);
						}
							
						break;
						
						case 'contact_form_7':
							$module_select_contact_form_7_alias =  ux_get_module_meta($module_post, 'module_select_contact_form_7_alias', get_the_ID());
							
							if($module_select_contact_form_7_alias){
								$get_cf7 = $module_select_contact_form_7_alias;
								$shortcode = '[contact-form-7 id="'.$get_cf7.'" title="'.get_the_title($get_cf7).'"]';
								echo do_shortcode($shortcode);
							}
							?>
                        
                        
                        <?php
						break;
					}
				}
			break;
			
			case 'blog':
				$module_select_list_type = ux_get_module_meta($module_post, 'module_select_list_type', get_the_ID());
				$module_select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
				$module_input_per_page = ux_get_module_meta($module_post, 'module_input_per_page', get_the_ID());
				if($module_input_per_page != ''){
					$per_page = $module_input_per_page;
				}else{
					$per_page = '-1';
				}
				
				$idObj = get_category_by_slug($module_select_category);
				if($idObj){
					$set_category = $idObj->term_id;
				}else{
					$set_category = '0';
				}
				
				
				$get_categories = get_categories('parent='.$set_category);
				?>
                <?php if($module_select_list_type == 'masonry_list'): ?>
                
                <div class="row-fluid">
				
                    <!--Filter-->
                    <ul class="filters clearfix">
                        <li class="active"><a href="#" data-filter="*"><?php _e('All','ux'); ?></a></li>	
                        <?php foreach($get_categories as $cate): ?>		
                        <li><a data-filter=".filter_<?php echo $cate->slug; ?>" href="#"><?php echo $cate->name; ?></a></li>
                        <?php endforeach; ?> 
                    </ul><!--End filter-->
                    
					<div class="container-isotope clear" data-post="<?php echo $module_post; ?>">
                        <div id="isotope-load" class="isotope-load"></div>
						<div class="isotope masonry" style="margin:-40px 0 0 -40px;" data-size="large">
                        <?php 
						$blog_querys = new WP_Query(array(
							'posts_per_page' => -1,
							'showposts' => -1,
							'cat' => $set_category
						));
						
						ux_view_module_load($module_id, get_the_ID(), 1, $module_post);
						
						?>
                        </div>
	
					</div> <!--End container-isotope-->

				</div>
                <?php ux_view_module_pagenums(get_the_ID(),$per_page,count($blog_querys->posts),$module_id,$module_post); ?>
                <?php elseif($module_select_list_type == 'standard_list'): ?>
                
                <div class="blog-wrap" data-post="<?php echo $module_post; ?>">
					<?php 
                    $blog_querys = new WP_Query(array(
						'posts_per_page' => -1,
						'showposts' => -1,
						'cat' => $set_category,
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array(
									'post-format-gallery',
									'post-format-image',
									'post-format-quote',
									'post-format-link',
									'post-format-audio',
									'post-format-video'
								),
								'operator' => 'NOT IN'
							)
						)
					));
					
					ux_view_module_load($module_id, get_the_ID(), 1, $module_post);
                    
                    ?>
                    <div class="clearfix"></div>
                </div>
                <?php ux_view_module_pagenums(get_the_ID(),$per_page,count($blog_querys->posts),$module_id,$module_post); ?>
                <?php endif; ?>
			
			<?php
			break;
			
			case 'price':
				$module_lists_layout_title = ux_get_module_meta($module_post, 'module_lists_layout_title', get_the_ID());
				$module_lists_layout_color = ux_get_module_meta($module_post, 'module_lists_layout_color', get_the_ID());
				$module_lists_layout_price = ux_get_module_meta($module_post, 'module_lists_layout_price', get_the_ID());
				$module_lists_layout_button = ux_get_module_meta($module_post, 'module_lists_layout_button', get_the_ID());
				$module_lists_layout_to_link = ux_get_module_meta($module_post, 'module_lists_layout_to_link', get_the_ID());
				$module_lists_layout_details = ux_get_module_meta($module_post, 'module_lists_layout_details', get_the_ID());
				$module_select_price_currency = ux_get_module_meta($module_post, 'module_select_price_currency', get_the_ID());
				$module_input_price_runtime = ux_get_module_meta($module_post, 'module_input_price_runtime', get_the_ID());
				$module_input_price_runtime_hide = ux_get_module_meta($module_post, 'module_input_price_runtime_hide', get_the_ID());
													  
				$split_title = explode("'%_%'", $module_lists_layout_title);
				$split_color = explode("'%_%'", $module_lists_layout_color);
				$split_price = explode("'%_%'", $module_lists_layout_price);
				$split_button = explode("'%_%'", $module_lists_layout_button);
				$split_button_link = explode("'%_%'", $module_lists_layout_to_link);
				$split_details = explode("'%_%'", $module_lists_layout_details);
				
				if($module_select_price_currency){
					$price_currency = $module_select_price_currency;
				}else{
					$price_currency = __('$','ux');
				}
				
				if($module_lists_layout_title): ?>
					<div class="price-wrap">
							
						<?php
						$i=0;
						for ($i=0; $i<count($split_title) - 1; $i++){
							global $theme_color;
							if($split_color[$i]){
								$item_color = $theme_color[$split_color[$i]]['value'];
							}else{
								$item_color = $theme_color[1]['value'];
							}
							if($split_button[$i]){
								$item_button = $split_button[$i];
							}else{
								$item_button = __('Buy Now','ux');
							}
							?>
						
							<section class="pirce-item bg-<?php echo $item_color; ?>">
								<h2 class="pirce-title"><?php echo $split_title[$i]; ?></h2>
								<div class="price-number">
								<div class="price-mask"></div>
									<p class="price-number-b"><?php echo $split_price[$i]; ?></p>
									<p class="price-currency"><?php echo $price_currency; ?></p>
									<?php 
									$runtime_hide = '';
									if($module_input_price_runtime_hide){
										if($module_input_price_runtime_hide != "false'%_%'"){
											$runtime_hide = true;
										}
									}else{
										$runtime_hide = true;
									}
									?>
									<?php if($runtime_hide): ?>
										<p class="price-runtime"><?php echo $module_input_price_runtime; ?></p>
									<?php endif; ?>
								</div>
								<ul class="price-list">
									<?php 
									if($split_details[$i]):
										$item_details = explode("O_O", $split_details[$i]);
										$item_details_icon = explode("'@_@'", $item_details[0]);
										$item_details_text = explode("'@_@'", $item_details[1]);
										$ii=0;
										for ($ii=0; $ii<count($item_details_icon) - 1; $ii++){
											
											if($item_details_icon[$ii]){
												$icon_class = '<i class="'.$item_details_icon[$ii].'"></i>';
											}else{
												$icon_class = '';
											}
											?>
											<li class="price-list-item"><?php echo $icon_class; ?><p class="price-list-item-text<?php if($item_details_icon[$ii] == 'noting'){ echo ' price-list-item-no-icon'; } ?>"><?php echo $item_details_text[$ii]; ?></p></li>
										<?php } ?>
									
									<?php endif; ?>
								</ul>
								<a href="<?php echo $split_button_link[$i]; ?>" class="price-button"><?php echo $item_button; ?></a>
							</section><!--End price-item-->
						
						<?php } ?>
					</div>
				<?php
				endif;
			break;
			
			
		}
		
		do_action('ux_view_module_switch', array(
			'module_id' => $module_id, 
			'module_post' => $module_post,
		));
		
		?>
	</div>
    
<?php
}
