<?php
function ux_p4_module_fields($module_fields){
	$liquid_list = array(
		'id' => 'liquid_list',
		'name' => __('Liquid list','ux'),
		'icon' => 'liquidlist_icon',
		'display' => 'block',
		'item' => array(
			
			array('title' => __('Style by Default','ux'),
				  'description' => __('Choose a style for the Liquid List','ux'),
				  'type' => 'select',
				  'name' => 'module_select_style_default'),
				  
			array('title' => __('Enable Mouseover Effect','ux'),
				  'description' => __('Turn on it to enable mouseover effect','ux'),
				  'type' => 'switch',
				  'name' => 'module_select_mouseover_effect'),
				  
			array('title' => __('Image Size','ux'),
				  'description' => __('Choose a size for the images under image style','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_size'),
				  
			array('title' => __('Block Ratio','ux'),
				  'description' => __('The images come from featured image, a image larger than 600*600px would be recommended','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_ratio'),
				  
			array('title' => __('Spacing Between Blocks','ux'),
				  'description' => __('The size of gaps between post blocks','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_spacing_blocks',
				  'default' => '20px'),
				  
			array('title' => __('Category','ux'),
				  'description' => __('The posts under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category'),
				  
			array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby'),
				  
			array('title' => __('Pagination','ux'),
				  'description' => __('The "Twitter" option is to show a "Load More" button on the bottom of the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_pagination'),
				  
			array('title' => __('Number per Page','ux'),
				  'description' => __('How many items should be displayed per page, leave it empty to show all items in one page','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_per_page'),
				  
			array('title' => __('Loading Block Color','ux'),
				  'description' => __('The panel color for the loading status after you click on it','ux'),
				  'type' => 'select',
				  'name' => 'module_select_loading_block_color'),
				  
			array('title' => __('Expanded Block Width','ux'),
				  'description' => __('The width after a block is expanded','ux'),
				  'type' => 'select',
				  'name' => 'module_select_expanded_block_width'),
				  
			array('title' => __('Expanded Block Words Numbers','ux'),
				  'description' => __('How many descrptions should be showed for a expanded block','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_expanded_block_words'),
				  
			array('title' => __('Show Social Medias on Expanded Block','ux'),
				  'description' => __('Enable it to show Social Medias links on expanded block','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_social_network',
				  'default' => 'false')
		
		)
	);
	array_push($module_fields, $liquid_list);
	
	$latest_post = array(
		'id' => 'latest_post',
		'name' => __('Latest/Related Post','ux'),
		'icon' => 'latestpost_icon',
		'display' => 'block',
		'item' => array(
			
			array('title' => __('Layout','ux'),
				  'description' => __('Choose a layout','ux'),
				  'type' => 'select',
				  'name' => 'module_select_latest_post_layout'),
				  
			array('title' => __('Post Type','ux'),
				  'description' => __('Check on the post types you want to show on this module','ux'),
				  'type' => 'cheak',
				  'name' => 'module_cheak_post_type'),
				  
			array('title' => __('Category','ux'),
				  'description' => __('The posts under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category'),
				  
			array('title' => __('Number of Items','ux'),
				  'description' => __('How many items should be displayed in this module, leave it empty to show all items','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_number_of_items'),
				  
			array('title' => __('Ratio of Thumb','ux'),
				  'description' => __('The images come from featured image, choose a ratio to show in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_ratio'),
				  
			array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby'),
				  
			array('title' => __('Image Size','ux'),
				  'description' => __('Choose a size for the images','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_size'),
				  
			array('title' => __('Show','ux'),
				  'description' => __('Check on the elements you want to show','ux'),
				  'type' => 'cheak',
				  'name' => 'module_cheak_show_function',
				  'option_in' => array('title', 'read_more_button')),
				  
			  array('title' => __('Text Align','ux'),
				  'description' => __('Select alignment for the text','ux'),
				  'type' => 'select',
				  'name' => 'module_select_text_align')
		
		)
	);
	array_push($module_fields, $latest_post);
	
	return $module_fields;
	
}
add_filter('pagebuilder_module_fields','ux_p4_module_fields');

function ux_p4_module_type_fields($module_type_fields){
	$select_key = false;
	$cheak_key = false;

	foreach($module_type_fields as $i => $type_field){
		switch($type_field['id']){
			case 'select': $select_key = $i; break;
			case 'cheak': $cheak_key = $i; break;
		}
	};
	
	if($cheak_key){
		$module_type_fields[$cheak_key]['item']['module_cheak_post_type'] = array(
			array('title' => __('Standard','ux'), 'value' => 'standard'),
			array('title' => __('Image','ux'), 'value' => 'image'),
			array('title' => __('Portfolio','ux'), 'value' => 'portfolio'),
			array('title' => __('Video','ux'), 'value' => 'video'),
			array('title' => __('Audio','ux'), 'value' => 'audio')
		);
		$module_type_fields[$cheak_key]['item']['module_cheak_show_function'] = array(
			array('title' => __('Title','ux'), 'value' => 'title'),
			array('title' => __('Excerpt','ux'), 'value' => 'excerpt'),
			array('title' => __('Read More Button','ux'), 'value' => 'read_more_button'),
		);
	}
	
	if($select_key){
		$module_type_fields[$select_key]['item']['module_select_style_default'] = array(
			array('title' => __('Image','ux'), 'value' => 'image'),
			array('title' => __('Magazine','ux'), 'value' => 'magazine')
		); 
		$module_type_fields[$select_key]['item']['module_select_image_spacing_blocks'] = array(
			array('title' => __('0px','ux'), 'value' => '0px'),
			array('title' => __('10px','ux'), 'value' => '10px'),
			array('title' => __('20px','ux'), 'value' => '20px'),
			array('title' => __('30px','ux'), 'value' => '30px'),
			array('title' => __('40px','ux'), 'value' => '40px')
		);
		$module_type_fields[$select_key]['item']['module_select_loading_block_color'] = array(
			array('title' => __('Post Featured Color','ux'), 'value' => 'featured_color'),
			array('title' => __('Grey','ux'), 'value' => 'grey'),
			array('title' => __('White','ux'), 'value' => 'white')
		);
		$module_type_fields[$select_key]['item']['module_select_expanded_block_width'] = array(
			array('title' => __('2 Columns','ux'), 'value' => '2'),
			array('title' => __('3 Columns','ux'), 'value' => '3'),
			array('title' => __('4 Columns','ux'), 'value' => '4')
		);
		$module_type_fields[$select_key]['item']['module_select_latest_post_layout'] = array(
			array('title' => __('Grid','ux'), 'value' => 'grid'),
			array('title' => __('Vertical List','ux'), 'value' => 'vertical_list'),
		);
		
	}
	
	return $module_type_fields;
	
}
add_filter('pagebuilder_module_type_fields','ux_p4_module_type_fields');


function ux_p4_view_module_switch($modules){
	global $post;
	$module_id = $modules['module_id'];
	$module_post = $modules['module_post'];
	
	switch($module_id){
		case 'latest_post':
			$select_latest_post_layout = ux_get_module_meta($module_post, 'module_select_latest_post_layout', get_the_ID());
			$select_post_type = ux_get_module_meta($module_post, 'module_cheak_post_type', get_the_ID());
			$select_image_size = ux_get_module_meta($module_post, 'module_select_image_size', get_the_ID());
			$select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
			$select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', get_the_ID());
			$select_order = ux_get_module_meta($module_post, 'module_select_order', get_the_ID());
			$select_image_ratio = ux_get_module_meta($module_post, 'module_select_image_ratio', get_the_ID());
			$select_number_of_items = ux_get_module_meta($module_post, 'module_input_number_of_items', get_the_ID());
			$select_show_function = ux_get_module_meta($module_post, 'module_cheak_show_function', get_the_ID());
			$select_text_align = ux_get_module_meta($module_post, 'module_select_text_align', get_the_ID());
			
			$idObj = get_category_by_slug($select_category);
			$select_category = ($idObj) ? $idObj->term_id : '0';
			$select_orderby = ($select_orderby != '-1') ? $select_orderby : 'none';
			$select_order = ($select_order == 'descending') ? 'DESC' : 'ASC';
			$select_image_ratio = ($select_image_ratio) ? $select_image_ratio : 'image-thumb';
			$select_image_size = ($select_image_size) ? $select_image_size : 'medium';
			$select_number_of_items = ($select_number_of_items) ? $select_number_of_items : -1;
			
			$select_show_function = ($select_show_function) ? explode("'%_%'",$select_show_function) : false;
			$select_post_type = ($select_post_type) ? explode("'%_%'",$select_post_type) : false;
			$select_post_format = false;
			$select_post_operator = false;
			$select_thumbnail_compare = false;
			if($select_post_type){
				$select_post_format = array();
				$post_format = array(
					'post-format-aside',
					'post-format-chat',
					'post-format-gallery',
					'post-format-link',
					'post-format-image',
					'post-format-quote',
					'post-format-status',
					'post-format-video',
					'post-format-audio'
				);
				foreach($select_post_type as $post_type){
					switch($post_type){
						case 'image': array_push($select_post_format, 'post-format-image'); break;
						case 'portfolio': array_push($select_post_format, 'post-format-gallery'); break;
						case 'audio': array_push($select_post_format, 'post-format-audio'); break;
						case 'video': array_push($select_post_format, 'post-format-video'); break;
					}
				}
				if(in_array("standard", $select_post_type)){
					$select_post_operator = 'NOT IN';
					foreach($select_post_format as $delete_format){
						foreach($post_format as $key => $format_string){
							if($delete_format == $format_string) unset($post_format[$key]);
						}
					}
					$select_post_format = $post_format;
				}else{
					$select_post_operator = 'IN';
				}
			}
			
			$image_ratio = 'image-thumb';
			if($select_image_ratio){
				switch($select_image_ratio){
					case 'landscape': $image_ratio = 'image-thumb'; break;
					case 'square': $image_ratio = 'image-thumb-1'; break;
					case 'auto': $image_ratio = 'standard-thumb'; break;
				}
			}
			
			$text_align = 'text-left';
			if($select_text_align){
				switch($select_text_align){
					case 'center': $text_align = 'text-center'; break;
				}
			}
			
			switch($select_latest_post_layout){
				case 'grid':
					$select_thumbnail_compare = array(
						'relation' => 'AND',
						array(
							'key' => '_thumbnail_id',
							'compare' => 'EXISTS'
						)
					);
				break;
				
			}
			
			$get_posts = get_posts(array(
				'posts_per_page' => $select_number_of_items,
				'category' => $select_category,
				'orderby' => $select_orderby,
				'order' => $select_order,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => $select_post_format,
						'operator' => $select_post_operator
					)
				),
				'meta_query' => $select_thumbnail_compare
			));
			
			switch($select_latest_post_layout){
				case 'grid': ?>
                    <div class="container-isotope clear" data-post="<?php echo $module_post; ?>">
                        <div class="isotope masonry" data-space="20px" style="margin: -20px 0px 0px -20px;" data-size="<?php echo $select_image_size; ?>">
							<?php foreach($get_posts as $post){ setup_postdata( $post );
								$post_background_color = get_post_meta(get_the_ID(), 'post_background_color', true);
								$thumb_src_full = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        
								global $theme_color;
								$post_background_color = ($post_background_color) ? 'bg-'.$theme_color[$post_background_color]['value'] : 'post-bgcolor-default'; ?>
                                <div class="width2 isotope-item container3d">
                                    <div class="inside" style="padding:20px 0 0 20px">
                                        <div class="fade_wrap">
                                            <a class="lightbox" data-rel="post<?php the_ID(); ?>" href="<?php echo $thumb_src_full[0]; ?>">
                                                <div class="fade_wrap_back">
                                                    <div class="fade_wrap_back_bg">
                                                        <i class="m-eye"></i>
                                                    </div>
                                                </div>
                                                <?php echo get_the_post_thumbnail(get_the_ID(), $image_ratio, array('title' => get_the_title(get_post_thumbnail_id()))); ?>
                                            </a>
                                        </div>
                                        
                                        <?php if($select_show_function){
											if(in_array('title', $select_show_function)){ ?>
												<div class="latest-posts-tit-wrap <?php echo $post_background_color; ?>">
													<h2 class="latest-posts-tit <?php echo $text_align; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
												</div>
                                        <?php }
										} ?>
                                    </div>
                                </div>
                            <?php }
							wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php
				break;
				
				case 'vertical_list': ?>
                    <div class="latest-posts-verticallist">
						<?php foreach($get_posts as $post){ setup_postdata( $post );
							$thumb_src_full = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                            <section class="posts-verticallist-item clearfix">
                                <?php if(has_post_thumbnail()){ ?>
                                    <div class="posts-verticallist-img">
                                        <a class="lightbox" href="<?php echo $thumb_src_full[0]; ?>"><?php echo get_the_post_thumbnail(get_the_ID(), $image_ratio, array('title' => get_the_title(get_post_thumbnail_id()))); ?></a>
                                    </div><!--End posts-verticallist-img-->
                                <?php } ?>
                                <div class="posts-verticallist-main">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <p class="posts-verticallist-meta"><i class="m-history"></i><?php the_time('F j, Y'); ?></p>
                                </div><!--End posts-verticallist-main-->
                            </section>
                        <?php }
						wp_reset_postdata(); ?>
                    </div>
                <?php
				break;
				
			}
		break;
		
		case 'liquid_list':
			$select_style_default = ux_get_module_meta($module_post, 'module_select_style_default', get_the_ID());
			$select_image_spacing_blocks = ux_get_module_meta($module_post, 'module_select_image_spacing_blocks', get_the_ID());
			$select_image_size = ux_get_module_meta($module_post, 'module_select_image_size', get_the_ID());
			$select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
			$select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', get_the_ID());
			$select_order = ux_get_module_meta($module_post, 'module_select_order', get_the_ID());
			$select_image_ratio = ux_get_module_meta($module_post, 'module_select_image_ratio', get_the_ID());
			$select_expanded_block_width = ux_get_module_meta($module_post, 'module_select_expanded_block_width', get_the_ID());
			$select_expanded_block_words = ux_get_module_meta($module_post, 'module_input_expanded_block_words', get_the_ID());
			$module_switch_social_network = ux_get_module_meta($module_post, 'module_switch_social_network', get_the_ID());
			
			$select_image_spacing_blocks = ($select_image_spacing_blocks) ? $select_image_spacing_blocks : '20px';
			$isotope_style = 'margin:-'.$select_image_spacing_blocks.' 0 0 -'.$select_image_spacing_blocks.';';
			
			$idObj = get_category_by_slug($select_category);
			$select_category = ($idObj) ? $idObj->term_id : '0';
			$select_orderby = ($select_orderby != '-1') ? $select_orderby : 'none';
			$select_order = ($select_order == 'descending') ? 'DESC' : 'ASC';
			$select_image_ratio = ($select_image_ratio) ? $select_image_ratio : 'image-thumb';
			$select_image_size = ($select_image_size) ? $select_image_size : 'medium';
			$select_image_size = ($select_style_default == 'magazine') ? 'large': $select_image_size;
			
			$image_ratio = 'image-thumb';
			if($select_image_ratio){
				switch($select_image_ratio){
					case 'landscape': $image_ratio = 'image-thumb'; break;
					case 'square': $image_ratio = 'image-thumb-1'; break;
					case 'auto': $image_ratio = 'standard-thumb'; break;
				}
			}
			
			$block_width = 'width4';
			if($select_expanded_block_width){
				switch($select_expanded_block_width){
					case '3': $block_width = 'width6'; break;
					case '4': $block_width = 'width8'; break;
				}
			}
			
			$block_words = ($select_expanded_block_words) ? $select_expanded_block_words : false;
			$show_social = ($module_switch_social_network) ? $module_switch_social_network : 'false';
			
			$select_per_page = ux_get_module_meta($module_post, 'module_input_per_page', get_the_ID());
			$per_page = ($select_per_page) ? $select_per_page : -1;
			
			$get_posts = get_posts(array(
				'posts_per_page' => -1,
				'category' => $select_category,
				'orderby' => $select_orderby,
				'order' => $select_order,
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => '_thumbnail_id',
						'compare' => 'EXISTS'
					)
				)
			));
			if($select_style_default == 'magazine'){
				$get_posts = get_posts(array(
					'posts_per_page' => -1,
					'category' => $select_category,
					'orderby' => $select_orderby,
					'order' => $select_order
				));
			} ?>
            <div class="container-isotope clear" data-post="<?php echo $module_post; ?>">
                <div id="isotope-load" class="isotope-load"></div>
                <div class="isotope masonry isotope-liquid-list" data-space="<?php echo $select_image_spacing_blocks; ?>" style=" <?php echo $isotope_style; ?>" data-size="<?php echo $select_image_size; ?>"  data-width="<?php echo $block_width; ?>" data-words="<?php echo $block_words; ?>" data-social="<?php echo $show_social; ?>" data-ratio="<?php echo $image_ratio; ?>">
                    <?php ux_view_module_load($module_id, get_the_ID(), 1, $module_post); ?>
                </div>
            </div>
            <?php ux_view_module_pagenums(get_the_ID(),$per_page,count($get_posts),$module_id,$module_post); ?>
		<?php
        break;
	}
}
add_action('ux_view_module_switch', 'ux_p4_view_module_switch');

function ux_p4_view_module_load($modules){
	global $post;
	$module_id = $modules['module_id'];
	$module_post = $modules['module_post'];
	$post_id = $modules['post_id'];
	$paged = $modules['paged'];
	
	switch($module_id){
		case 'liquid_list':
			$select_category = ux_get_module_meta($module_post, 'module_select_category', $post_id);
			$select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', $post_id);
			$select_order = ux_get_module_meta($module_post, 'module_select_order', $post_id);
			
			$idObj = get_category_by_slug($select_category);
			$select_category = ($idObj) ? $idObj->term_id : '0';
			$select_orderby = ($select_orderby != '-1') ? $select_orderby : 'none';
			$select_order = ($select_order == 'descending') ? 'DESC' : 'ASC';
			
			$select_block_color = ux_get_module_meta($module_post, 'module_select_loading_block_color', $post_id);
			$block_color = false;
			if($select_block_color){
				switch($select_block_color){
					case 'featured_color': $block_color = 'featured_color'; break;
					case 'grey': $block_color = 'bg-theme-color-10'; break;
				}
			}
			
			$select_style_default = ux_get_module_meta($module_post, 'module_select_style_default', $post_id);
			$select_spacing_blocks = ux_get_module_meta($module_post, 'module_select_image_spacing_blocks', $post_id);
			$inside_style = 'padding:'.$select_spacing_blocks.' 0 0 '.$select_spacing_blocks.';';
			if($select_style_default == 'magazine'){
				$inside_style = 'margin:'.$select_spacing_blocks.' 0 0 '.$select_spacing_blocks;
			}
			
			$select_mouseover_effect = ux_get_module_meta($module_post, 'module_select_mouseover_effect', $post_id);
			$container3d = 'container3d';
			if($select_mouseover_effect){
				if($select_mouseover_effect == 'false'){
					$container3d = false;
				}
			}
			
			$select_image_ratio = ux_get_module_meta($module_post, 'module_select_image_ratio', $post_id);
			$select_image_ratio = ($select_image_ratio) ? $select_image_ratio : 'image-thumb';
			$image_ratio = 'image-thumb';
			if($select_image_ratio){
				switch($select_image_ratio){
					case 'landscape': $image_ratio = 'image-thumb'; break;
					case 'square': $image_ratio = 'image-thumb-1'; break;
					case 'auto': $image_ratio = 'standard-thumb'; break;
				}
			}
			
			$back_con_style = 'padding-left: '.$select_spacing_blocks.';';
			$back_tit_style = 'margin-top: -'.$select_spacing_blocks.';';
			$back_bg_style = 'left: '.$select_spacing_blocks.'; top: -'.$select_spacing_blocks.';';
			
			$select_per_page = ux_get_module_meta($module_post, 'module_input_per_page', $post_id);
			$per_page = ($select_per_page) ? $select_per_page : -1;
			
			$get_posts = get_posts(array(
				'posts_per_page' => $per_page,
				'paged' => $paged,
				'category' => $select_category,
				'orderby' => $select_orderby,
				'order' => $select_order,
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => '_thumbnail_id',
						'compare' => 'EXISTS'
					)
				)
			));
			if($select_style_default == 'magazine'){
				$get_posts = get_posts(array(
					'posts_per_page' => $per_page,
					'paged' => $paged,
					'category' => $select_category,
					'orderby' => $select_orderby,
					'order' => $select_order
				));
			} ?>
		
			<?php foreach($get_posts as $num => $post){ setup_postdata($post);
                $post_background_color = get_post_meta(get_the_ID(), 'post_background_color', true);
    
                global $theme_color;
                $post_background_color = ($post_background_color) ? 'bg-'.$theme_color[$post_background_color]['value'] : 'post-bgcolor-default';
                $background_color = ($block_color == 'featured_color') ? $post_background_color : $block_color;
                
                switch($select_style_default){
                    case 'image': ?>
                        <div class="width2 isotope-item <?php echo $container3d; ?>">
                            <div class="inside card liquid_inside" style=" <?php echo $inside_style; ?>">
                                <div class="flip_wrap_back back face liquid_list_image">
                                    <div class="flip_wrap_back_con" style=" <?php echo $back_con_style; ?>">
                                        <h2 style=" <?php echo $back_tit_style; ?>"><a href="<?php the_permalink(); ?>" class="liquid_list_image" data-postid="<?php the_ID(); ?>" data-color="<?php echo $background_color; ?>" data-type="<?php echo $select_style_default; ?>"><?php the_title(); ?></a></h2>
                                    </div>
                                    <div class="flip_wrap_back_bg <?php echo $background_color; ?>" style=" <?php echo $back_bg_style; ?>"></div>
                                </div>
                                <?php 
                                $get_the_thumbnail = get_the_post_thumbnail(get_the_ID(), $image_ratio, array('class'=>'front face'));
                                if($select_mouseover_effect){
                                    if($select_mouseover_effect == 'false'){
                                        $get_the_thumbnail = '<a href="'.get_permalink().'" class="liquid_list_image" data-postid="'.get_the_ID().'" data-color="'.$background_color.'" data-type="'.$select_style_default.'">'.$get_the_thumbnail.'</a>';
                                    }
                                    
                                }
                                
                                echo $get_the_thumbnail; ?>
                            
                            </div><!--End inside-->
                            <div style="display:none; <?php echo 'margin:'.$select_spacing_blocks.' 0 0 '.$select_spacing_blocks.';'; ?>" class="inside liquid-loading-wrap <?php echo $background_color; ?>">
                                <div class="liquid-loading"></div>
                                <?php echo get_the_post_thumbnail(get_the_ID(), $image_ratio, array('class'=>'liquid-hide')); ?>
                            </div>
                        </div>
					<?php
                    break;
                    
                    case 'magazine':
                        $get_post_format = (get_post_format() == '') ? 'standard' : get_post_format(); ?>
                        <div class="width2 isotope-item <?php echo $get_post_format; ?>">
                            <div class="inside liquid_inside" style=" <?php echo $inside_style; ?>">
                                <div class="liquid-item">
                                    <div class="item_topbar <?php echo $background_color; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="item_link liquid_list_image" data-postid="<?php the_ID(); ?>" data-color="<?php echo $background_color; ?>" data-type="<?php echo $select_style_default; ?>"></a></div>
                                    
                                    <?php if(has_post_format('quote')){
                                        $textarea_quote = get_post_meta(get_the_ID(), "post_option_textarea_quote", true); ?>
                                        <div class="item_des"><i class="m-quote-left"></i>
                                            <p><?php echo $textarea_quote; ?></p>
                                            <div class="like clear"></div><!--End like-->
                                        </div>
                                    <?php }elseif(has_post_format('link')){
                                        $link_item_title = get_post_meta(get_the_ID(), "post_option_link_item_title", true);
                                        $link_item_url = get_post_meta(get_the_ID(), "post_option_link_item_url", true); ?>
                                        <div class="item_des">
                                            <?php for($i=0; $i<count($link_item_title); $i++){ ?>
                                                <p><a title="<?php echo $link_item_title[$i]; ?>" href="<?php echo $link_item_url[$i]; ?>"><?php echo $link_item_title[$i]; ?></a></p>
                                            <?php } ?>
                                            <div class="like clear"></div><!--End like-->
                                        </div>
                                    <?php }elseif(has_post_format('audio')){
                                        $select_audio_layout = get_post_meta(get_the_ID(), "post_option_select_audio_layout", true);
                                        if($select_audio_layout == 'post_soundcloud'){
                                            $textarea_soundcloud = get_post_meta(get_the_ID(), 'post_option_textarea_soundcloud', true); ?>
                                            <div class="item_des">
                                                <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="liquid_list_image" data-postid="<?php the_ID(); ?>" data-color="<?php echo $background_color; ?>" data-type="<?php echo $select_style_default; ?>"><?php the_title(); ?></a></h2>
                                                <div class="soundcloudWrapper">
                                                    <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $textarea_soundcloud;?>&amp;color=ff3900&amp;auto_play=false&amp;show_artwork=false"></iframe>
                                                </div>
                                                <div class="like clear"></div><!--End like-->
                                            </div>
                                        <?php }else{
                                            $mp3_title = get_post_meta(get_the_ID(), "post_option_mp3_title", true);
                                            $mp3_url = get_post_meta(get_the_ID(), "post_option_mp3_url", true); ?>
                                            <div class="item_des">
                                                <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="liquid_list_image" data-postid="<?php the_ID(); ?>" data-color="<?php echo $background_color; ?>" data-type="<?php echo $select_style_default; ?>"><?php the_title(); ?></a></h2>
                                            </div>
                                            <ul class="audio_player_list">
                                                <?php foreach($mp3_title as $num => $t){ ?>
                                                    <li class="audio-unit"><span id="audio<?php echo get_the_ID(). $num; ?>" class="audiobutton pause" rel="<?php echo $mp3_url[$num]; ?>"></span><span class="songtitle" title="<?php echo $mp3_title[$num];?>"><?php echo $mp3_title[$num];?></span>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php
                                        }
                                    }elseif(has_post_format('video')){
                                        $textarea_embeded = get_post_meta(get_the_ID(), 'post_option_textarea_embeded', true);
                                        $input_m4v = get_post_meta(get_the_ID(), 'post_option_input_m4v', true);
                                        $input_ogv = get_post_meta(get_the_ID(), 'post_option_input_ogv', true);
                                        if($input_m4v != ''){
                                            $video_file = $input_m4v;
                                        }else{
                                            $video_file = $input_ogv;
                                        } ?>
                                        <div class="videoWrapper">
                                            <?php if($textarea_embeded){
                                                if($textarea_embeded != ''){
                                                    if ( ereg ("youtube", $textarea_embeded) && !(ereg("iframe", $textarea_embeded))){ ?>
                                                        <iframe src="http://www.youtube.com/embed/<?php echo get_you_tube_id($textarea_embeded);?>?rel=0&controls=1&showinfo=0&theme=light&autoplay=0&wmode=transparent"></iframe>
                                                    <?php }elseif( ereg ("vimeo", $textarea_embeded) && !(ereg("iframe", $textarea_embeded))){ ?>
                                                        <iframe src="http://player.vimeo.com/video/<?php echo get_vimeo_id($textarea_embeded); ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" height="auto" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                                    <?php }else{
                                                        echo $textarea_embeded;
                                                    }
                                                } else { ?>
                                                    <iframe width="100%" height="auto" frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="<?php echo $video_file; ?>"></iframe>
                                                <?php }
                                            } ?>
                                        </div>
                                        <div class="item_des">
                                            <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="liquid_list_image" data-postid="<?php the_ID(); ?>" data-color="<?php echo $background_color; ?>" data-type="<?php echo $select_style_default; ?>"><?php the_title(); ?></a></h2>
                                            <div class="like clear"></div><!--End like-->
                                        </div>
                                    <?php
                                    }elseif(has_post_format('gallery')){
                                        $gallery_selected = get_post_meta(get_the_ID(), "post_option_gallery_selected", true); ?>
                                        <div class="item_des">
                                            <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="liquid_list_image" data-postid="<?php the_ID(); ?>" data-color="<?php echo $background_color; ?>" data-type="<?php echo $select_style_default; ?>"><?php the_title(); ?></a></h2>
                                            <?php if(get_the_excerpt()){ ?><div class="item-des-p"><?php the_excerpt(); ?></div><?php } ?>
                                            <?php if($gallery_selected){ ?>
                                                <ul class="item_gallery">
                                                    <?php foreach($gallery_selected as $num => $image){
                                                        $thumb_src_full = wp_get_attachment_image_src( $image, 'full');
                                                        $thumb_src = wp_get_attachment_image_src( $image, 'blog-thumb'); ?>
                                                        <?php if($num < 3){ ?>
                                                            <li><a href="<?php echo $thumb_src_full[0]; ?>" class="lightbox" rel="post<?php the_ID(); ?>" title="<?php echo get_the_title($image); ?>"><img src="<?php echo $thumb_src[0]; ?>" alt="" /></a></li>
                                                        <?php }
                                                    } ?>
                                                </ul>
                                            <?php } ?>
                                            <div class="like clear"></div><!--End like-->
                                        </div><!--End item_des-->
                                    <?php }else{
                                        if(has_post_thumbnail()){
                                            $thumb_src_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                            $thumb_src_360 = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'standard-thumb'); ?>
                                            <a href="<?php echo $thumb_src_full[0]; ?>" class="lightbox" rel="post<?php the_ID(); ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo $thumb_src_360[0]; ?>" ></a>
                                        <?php } ?>
                                        <div class="item_des">
                                            <h2 class="item_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="liquid_list_image" data-postid="<?php the_ID(); ?>" data-color="<?php echo $background_color; ?>" data-type="<?php echo $select_style_default; ?>"><?php the_title(); ?></a></h2>
                                            <?php if(get_the_excerpt()){ ?><div class="item-des-p"><?php the_excerpt(); ?></div><?php } ?>
                                            <div class="like clear"></div><!--End like-->
                                        </div>
                                    <?php } ?>
                                </div>
                            </div><!--End inside-->
                            <div style="display:none; <?php echo 'margin:'.$select_spacing_blocks.' 0 0 '.$select_spacing_blocks.';'; ?>" class="inside liquid-loading-wrap <?php echo $background_color; ?>">
                                <div class="liquid-loading"></div>
                                <div class="liquid-hide"></div>
                            </div>
                        </div><!--End isotope-item-->
                    <?php
                    break;
                }
            }
            wp_reset_postdata(); ?>
            
		<?php
		break;
		
	}
	
}
add_action('ux_view_module_load', 'ux_p4_view_module_load');

function ux_view_liquid_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}

function ux_view_liquid_load($post_id, $block_words, $show_social, $image_ratio){
	global $theme_color, $post;
	
	$post = get_post($post_id);
	setup_postdata($post); 
	
	$post_background_color = get_post_meta($post_id, 'post_background_color', true);
	$background_color = 'post-bgcolor-default';
	if($post_background_color){
		$background_color = 'bg-'.$theme_color[$post_background_color]['value'];
	}
    
	$show_social = ($show_social == 'true') ? true : false; ?>
	<section class="liquid-expand-wrap" style="display:none;">
        <h1 class="liquid-title <?php echo $background_color; ?>">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            <i class="m-close"></i>
        </h1>
        <div class="liquid-body">
			<?php if(get_the_excerpt()){ ?>
                <div class="liquid-body-des">
                    <?php if($block_words){
                        ux_view_liquid_charlength($block_words);
                    }else{
                        the_excerpt();
                    } ?>
                </div><!--End liquid-body-des-->
            <?php } ?>
            <?php if(has_post_format('gallery')){
				$gallery_selected = get_post_meta(get_the_ID(), "post_option_gallery_selected", true);
				if($gallery_selected){ ?>
                    <ul class="liquid-body-thumbs clearfix">
                        <?php foreach($gallery_selected as $num => $image){
                            $thumb_src_full = wp_get_attachment_image_src($image, 'full');
                            $thumb_src = wp_get_attachment_image_src($image, 'imagebox-thumb'); ?>
                            <li><a href="<?php echo $thumb_src_full[0]; ?>" title="<?php echo get_the_title($image); ?>" class="imgwrap lightbox" data-rel="post<?php the_ID(); ?>"><img width="100" height="100" src="<?php echo $thumb_src[0]; ?>" /></a></li>
                        
                        <?php } ?>
                    </ul>
                <?php 
				}
            }elseif(has_post_format('audio')){
				$select_audio_layout = get_post_meta(get_the_ID(), "post_option_select_audio_layout", true); ?>
                <div class="liquid-body-audio">
					<?php if($select_audio_layout == 'post_soundcloud'){
                        $textarea_soundcloud = get_post_meta(get_the_ID(), 'post_option_textarea_soundcloud', true); ?>
                            <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $textarea_soundcloud;?>&amp;color=ff3900&amp;auto_play=false&amp;show_artwork=true"></iframe>
						<?php
					}else{
						$mp3_title = get_post_meta(get_the_ID(), "post_option_mp3_title", true);
						$mp3_url = get_post_meta(get_the_ID(), "post_option_mp3_url", true);
						
						if($mp3_title){ ?>
							<ul class="audio_player_list">
								<?php foreach($mp3_title as $num => $t){ ?>
                                    <li class="audio-unit"><span id="audio<?php echo get_the_ID(). $num; ?>" class="audiobutton pause" rel="<?php echo $mp3_url[$num]; ?>"></span><span class="songtitle" title="<?php echo $mp3_title[$num];?>"><?php echo $mp3_title[$num];?></span></li>
                                <?php } ?>
                            </ul>
						<?php
						}
					} ?>
				</div>
			<?php 
            }elseif(has_post_format('quote')){
				$textarea_quote = get_post_meta(get_the_ID(), "post_option_textarea_quote", true); ?>
				<div class="liquid-body-quote">
                    <div class="quote-wrap"><i class="m-quote-left"></i><?php echo $textarea_quote; ?></div><!--End quote-wrap-->
                </div><!--End liquid-body-quote-->
			<?php
			}elseif(has_post_format('video')){
				$textarea_embeded = get_post_meta(get_the_ID(), 'post_option_textarea_embeded', true);
				$input_m4v = get_post_meta(get_the_ID(), 'post_option_input_m4v', true);
				$input_ogv = get_post_meta(get_the_ID(), 'post_option_input_ogv', true);
				
				$video_file = ($input_m4v != '') ? $input_m4v : $input_ogv;
				
				if($textarea_embeded){ ?>
                    <div class="liquid-body-video video-wrap video-16-9">
                         <?php if($textarea_embeded != ''){
                             if(ereg("youtube", $textarea_embeded) && !(ereg("iframe", $textarea_embeded))){ ?>
                                 <iframe src="http://www.youtube.com/embed/<?php echo get_you_tube_id($textarea_embeded);?>?rel=0&controls=1&showinfo=0&theme=light&autoplay=0&wmode=transparent"></iframe>
                             <?php
                             }elseif(ereg("vimeo", $textarea_embeded) && !(ereg("iframe", $textarea_embeded))){ ?>
                                 <iframe src="http://player.vimeo.com/video/<?php echo get_vimeo_id($textarea_embeded); ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" height="auto" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                             <?php
                             }else{
                                 echo $textarea_embeded;
                             }
                         }else{ ?>
                             <iframe width="100%" height="auto" frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="<?php echo $video_file; ?>"></iframe>
                         <?php } ?>
                    </div>
				<?php
				}
			}elseif(has_post_format('link')){
				$link_item_title = get_post_meta(get_the_ID(), "post_option_link_item_title", true);
				$link_item_url = get_post_meta(get_the_ID(), "post_option_link_item_url", true);
				if(count($link_item_title) > 0){ ?>
                    <div class="liquid-body-link">
                        <ul class="link-wrap">
							<?php for($i=0; $i<count($link_item_title); $i++){ ?>
                                <li><a href="<?php echo $link_item_title[$i]; ?>" title="<?php echo $link_item_title[$i]; ?>"><i class="m-link"></i><?php echo $link_item_title[$i]; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!--End liquid-body-link-->
				<?php
				}
			}else{
				if(has_post_thumbnail()){ ?>
                    <div class="liquid-body-img">
						<?php echo get_the_post_thumbnail(get_the_ID(), $image_ratio); ?>
                    </div>
				<?php 
				}
			} ?>
        </div><!--End liquid-body-->
        <div class="liquid-more">
            <a href="<?php the_permalink(); ?>" class="liquid-more-icon" title="<?php the_title(); ?>"><i class="m-right-arrow-curved"></i><?php if(!$show_social){ _e('Read more...', 'ux'); } ?></a>
            <?php if($show_social){
                get_template_part('template/post', 'social'); 
            } ?>
        </div><!--End liquid-more-->
    
    
    </section>
    
	<?php
    wp_reset_postdata();
}
?>