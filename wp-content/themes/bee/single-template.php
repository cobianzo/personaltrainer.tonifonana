<?php 
$get_post_type = get_post_type();
if($get_post_type == 'post'): ?>
	<?php if(has_post_format('video')): ?>
        <?php 
        $post_option_link_item_title = get_post_meta(get_the_ID(), "post_option_link_item_title", true);
        $post_option_link_item_url = get_post_meta(get_the_ID(), "post_option_link_item_url", true);
        $post_option_textarea_embeded = get_post_meta(get_the_ID(), 'post_option_textarea_embeded', true);
        $post_option_input_m4v = get_post_meta(get_the_ID(), 'post_option_input_m4v', true);
        $post_option_input_ogv = get_post_meta(get_the_ID(), 'post_option_input_ogv', true);
        if($post_option_input_m4v != ''){
            $video_file = $post_option_input_m4v;
        }else{
            $video_file = $post_option_input_ogv;
        }
        
        ?>
        <div class="video-wrap video-post-wrap">
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
        </div>
        
    <?php elseif(has_post_format('quote')): ?>
        <?php $post_option_textarea_quote = get_post_meta(get_the_ID(), "post_option_textarea_quote", true); ?>
        <div class="quote-wrap">
            <i class="m-quote-left"></i><?php echo $post_option_textarea_quote; ?>
        </div>
    
    <?php elseif(has_post_format('link')): ?>
        <?php 
        $post_option_link_item_title = get_post_meta(get_the_ID(), "post_option_link_item_title", true);
        $post_option_link_item_url = get_post_meta(get_the_ID(), "post_option_link_item_url", true); ?>
        <ul class="link-wrap">
            <?php for($i=0; $i<count($post_option_link_item_title); $i++){ ?>
            <li><a title="<?php echo $post_option_link_item_title[$i]; ?>" href="<?php echo $post_option_link_item_url[$i]; ?>"><i class="m-link"></i><?php echo $post_option_link_item_title[$i]; ?></a></li>
            <?php } ?>
        </ul>
    
    <?php elseif(has_post_format('audio')): ?>
        <?php $post_option_select_audio_layout = get_post_meta(get_the_ID(), "post_option_select_audio_layout", true); ?>
        <?php if($post_option_select_audio_layout == 'post_soundcloud'):?>
        <div class="audiopost-soundcloud-wrap">
            <?php $post_option_textarea_soundcloud = get_post_meta(get_the_ID(), 'post_option_textarea_soundcloud', true); ?>
            <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $post_option_textarea_soundcloud;?>&amp;color=ff3900&amp;auto_play=false&amp;show_artwork=true"></iframe>
        </div>            
        <?php else: ?>
            <?php 
            $post_option_mp3_title = get_post_meta(get_the_ID(), "post_option_mp3_title", true);
            $post_option_mp3_url = get_post_meta(get_the_ID(), "post_option_mp3_url", true); ?>
        
            <ul class="audio_player_list audio_content">
            <?php foreach($post_option_mp3_title as $num => $t): ?>
            <li class="audio-unit"><span id="audio<?php echo get_the_ID(). $num; ?>" class="audiobutton pause" rel="<?php echo $post_option_mp3_url[$num]; ?>"></span><span class="songtitle" title="<?php echo $post_option_mp3_title[$num];?>"><?php echo $post_option_mp3_title[$num];?></span>
            </li>
            
            <?php endforeach; ?>
            </ul>
        
        <?php endif; ?> 
     
    <?php elseif(has_post_format('gallery')): ?>
        <?php 
        $post_option_select_list_style = get_post_meta(get_the_ID(), "post_option_select_list_style", true); 
        $post_option_gallery_selected = get_post_meta(get_the_ID(), "post_option_gallery_selected", true);
        ?>
        <?php if($post_option_select_list_style == 'slider'):?>
            <!-- 
            Portfolio Slider 
            -->
            <div id="gallerypost<?php echo get_the_ID(); ?>" class="gallery-image carousel slide">
                <div class="carousel-inner">
                    <?php 
                    foreach($post_option_gallery_selected as $num => $image): 
                        if($num == 0){
                            $active = 'active';
                        }else{
                            $active = '';
                        }
                        $thumb_src = wp_get_attachment_image_src( $image, 'full');
                        ?>
                        <div class="<?php echo $active; ?> item"><a href="<?php echo $thumb_src[0]; ?>" class="lightbox" ><img src="<?php echo $thumb_src[0]; ?>" alt=""></a></div>
                    <?php endforeach; ?>
                </div><!--End .carousel-inner-->
                <a class="carousel-control left" href="#gallerypost<?php echo get_the_ID(); ?>" data-slide="prev"><i class="m-angle-left"></i></a>
                <a class="carousel-control right" href="#gallerypost<?php echo get_the_ID(); ?>" data-slide="next"><i class="m-angle-right"></i></a>
            </div><!--End .gallery-image-->
            
        <?php elseif($post_option_select_list_style == 'masonry'):?>
        
            <!-- 
            Portfolio isotope Grid
            -->
            <div class="row-fluid">
    
                <div class="container-isotope clear gallery-post-wrap">
                <div id="isotope-load" class="isotope-load"></div>
                    <div class="isotope masonry" data-size="medium" style="margin:-20px 0 0 -20px;">
                    
                        <?php 
                        foreach($post_option_gallery_selected as $num => $image): 
                            if($num == 0){
                                $width_item = 'width4';
                            }else{
                                $width_item = 'width2';
                            }
                            $thumb_full_src = wp_get_attachment_image_src( $image, 'full');
                            $thumb_src = wp_get_attachment_image_src( $image, 'standard-thumb');
                            ?>
                            <div class="<?php echo $width_item; ?> isotope-item">
                                <div class="inside" style="margin:20px 0 0 20px;">
                                    <div class="entry-thumb">
                                        <div class="single-image mouse-over">
                                            <a href="<?php echo $thumb_full_src[0]; ?>" class="lightbox">
                                                <div class="single-image-mask"><i class="m-eye"></i></div>
                                                <img src="<?php echo $thumb_src[0]; ?>" />
                                                </a>
                                        </div><!--End single-image mouse-over-->
                                    </div><!--End entry-thumb-->
                                </div><!--End inside-->
                            </div><!--End isotope-item-->
                            
                        <?php endforeach; ?>
                    
                    </div><!--End isotope-->
    
                </div> <!--End container-isotope-->
    
            </div><!--End row-fluid-->
        
        <?php else: ?>
        
            <!-- 
            Portfolio vercical list 
            -->
            <div class="portfolio_wtap">
            
                <ul class="portfolio_vertical_list">
                
                    <?php 
                    if($post_option_gallery_selected):
						foreach($post_option_gallery_selected as $num => $image):
							$thumb_src = wp_get_attachment_image_src( $image, 'full'); ?>
							<li><a href="<?php echo $thumb_src[0]; ?>" class="lightbox"><img src="<?php echo $thumb_src[0]; ?>" title="" /></a></li>
						<?php endforeach;
					endif; ?>
                    
                </ul><!--End portfolio_vertical_list-->
                
            </div><!--End portfolio_wtap-->
            
        <?php endif; ?> 
    
    
    <?php elseif(has_post_format('image')): ?>
    
        <?php if(has_post_thumbnail()): ?>
        <div class="image-post-wrap">
            <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
        </div>
        <?php endif; ?>
    
    <?php endif; ?>
    
    <?php if(!has_post_format('quote')): ?>
        <div class="entry"><?php the_content(); wp_link_pages(); ?></div>
    <?php endif; ?>
	<?php
    $post_option_cheak_show = get_post_meta(get_the_ID(), "post_option_cheak_show", true);
    if($post_option_cheak_show){
        foreach($post_option_cheak_show as $meta){
            if($meta == 'meta'){
                get_template_part('template/post', 'meta');
            }
        }
    }
     ?>
    <?php 
    $theme_option_switch_show_social_share = get_option('theme_option_switch_show_social_share');
    if($theme_option_switch_show_social_share == 'true'):
    get_template_part('template/post', 'social'); 
    endif;?>
<?php else: ?>
    <div class="entry">
        <?php if($get_post_type == 'team'):
			$post_type_team_position = get_post_meta(get_the_ID(), 'post_type_team_position', true);
			$post_type_team_email = get_post_meta(get_the_ID(), 'post_type_team_email', true);
			$post_type_team_phone_number = get_post_meta(get_the_ID(), 'post_type_team_phone_number', true);
			$post_type_team_social_networks = get_post_meta(get_the_ID(), 'post_type_team_social_networks', true); ?>
            <div class="team">
                <?php if(has_post_thumbnail()){ 
					echo get_the_post_thumbnail(get_the_ID(), array(360,9999), array('class'=>'team-photo'));
				} ?> 
                <div class="team-info">
                    <?php 
					if($post_type_team_position){
						?><p class="team-position"><?php echo __('POSITION:', 'ux'). ' ' .$post_type_team_position; ?></p><?php
					}
					if($post_type_team_email){
						?><p class="team-email"><?php echo __('EMAIL:', 'ux'). ' ' .$post_type_team_email; ?></p><?php
					}
					if($post_type_team_phone_number){
						?><p class="team-phone"><?php echo __('PHONE NUMBER:', 'ux'). ' ' .$post_type_team_phone_number; ?></p><?php
                    } ?>
                    <p class="team-content"><?php the_content(); ?></p>
                </div><!--end .team-info-->
            </div>
		<?php elseif($get_post_type == 'testimonials'):
			$post_type_testimonial_cite = get_post_meta(get_the_ID(), 'post_type_testimonial_cite', true); ?>
            <div class="testimenials">
                <i class="m-quote-left"></i>
                <?php the_content(); ?>
				<?php 
                if($post_type_testimonial_cite){
					?><div class="cite"><?php echo $post_type_testimonial_cite; ?></div><?php
                } ?>
                <div class="arrow-bg"><p class="arrow-wrap"><span class="arrow"></span></p></div>
            </div>
		<?php elseif($get_post_type == 'clients'):
			$post_type_client_link = get_post_meta(get_the_ID(), 'post_type_client_link', true); ?>
            <div class="client">
                <a title="<?php echo get_the_title(); ?>" href="<?php echo $post_type_client_link;?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'full');?></a>
                 <?php echo get_the_title(); ?>
            </div>
		<?php else: ?>
			<?php the_content(); ?>
        <?php endif; ?>
    </div>
    <?php if($get_post_type == 'jobs'):
		$post_type_job_location = get_post_meta(get_the_ID(), 'post_type_job_location', true);
		$post_type_job_number = get_post_meta(get_the_ID(), 'post_type_job_number', true); ?>
        <div class="job-info">
            <?php 
			if($post_type_job_location){
				?><span class="job-location"><?php echo __('Location:', 'ux'). ' ' .$post_type_job_location; ?></span><?php
			}
			if($post_type_job_number){
				?><span class="job-number"><?php echo __('Number:', 'ux'). ' ' .$post_type_job_number; ?></span><?php
			} ?>
        </div>
    <?php endif; ?>
<?php endif; ?>