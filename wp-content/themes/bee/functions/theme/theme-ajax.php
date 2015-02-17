<?php

function CustomThemeInlineEdit(){
	$data = $_POST['data'];
	
	if(isset($data['post_id'])){
		$post_id = $data['post_id'];
		$post_type = get_post_type($post_id);
		$categories = get_the_terms($post_id, $post_type);
		$separator = ', ';
		$output = '';
		if($categories){
			foreach($categories as $category) {
				$output .= '<a href="?post_type='.$post_type.'&'.$post_type.'='.$category->slug.'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'ux'), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
			}
		}
		?>
        <td class="column_category column-column_category"><?php echo trim($output, $separator); ?></td>
        <?php
	}
	die();

}
add_action('wp_ajax_CustomThemeInlineEdit', 'CustomThemeInlineEdit' );
/*
============================================================================
	*
	* Theme Option Ajax
	*
============================================================================	
*/
function CustomThemeOptionAjax(){
	$data = $_POST['data'];
	$mode = $data['mode'];
	
	switch($mode){
		case 'save':
		
			$theme_option_meta = $data['theme_option_meta'];
			
			foreach ($theme_option_meta as $name => $field) {  
				$old = get_option($name);  
				$new = $field;  
			
				if ($new && $new != $old) {  
					update_option($name, $new); 
				} elseif ('' == $new && $old) {  
					delete_option($name, $old);  
				}
				
				if(!$new){
					delete_option($name, $old); 
				}
				
				if($name == 'theme_option_select_front_page'){
					if($new == '-1'){
						$show_on = 'posts';
						$page_on = '0';
					}else{
						$show_on = 'page';
						$page_on = $new;
					}
					
					update_option('show_on_front', $show_on); 
					update_option('page_on_front', $page_on); 
				}
			}
		
		break;
		
		case 'restore':
			global $wpdb;
			$get_results = $wpdb->get_results("
				SELECT `option_id`, `option_name`
				FROM $wpdb->options 
				WHERE `option_name` LIKE '%theme_option_%'
				"
			);
			
			foreach($get_results as $result){
				delete_option($result->option_name);
			}
		break;
		
	}
	
	
	
	die('');
	
}
add_action('wp_ajax_CustomThemeOptionAjax', 'CustomThemeOptionAjax' );

/*
============================================================================
	*
	* Load Post Gallery
	*
============================================================================	
*/
function CustomPostOptionAjaxGallery(){
	$paged = (isset($_POST['data']))? $_POST['data'] : 1; 
	if($paged == ''){ $paged = 1; }
	
	$gallery_count = wp_count_posts('attachment')->inherit;
	
	$statement = array(
		'post_type' => 'attachment',
		'post_mime_type' =>'image',
		'post_status' => 'inherit',
		'posts_per_page' => '16',
		'paged' => $paged
	);
	
	$media_query = new WP_Query($statement); ?>
	<?php if($gallery_count != '0'): ?>
        <ul>
        <?php
		foreach($media_query->posts as $image){
			$thumb_src = wp_get_attachment_image_src( $image->ID, 'thumbnail');
			$thumb_src_preview = wp_get_attachment_image_src( $image->ID, 'gallery-selected-thumb');
			echo '<li><img src="' . $thumb_src[0] .'" title="' . $image->post_title . '" attid="' . $image->ID . '" rel="' . $thumb_src_preview[0] . '" class="post_gallery_selected post_click"/></li>'; 
		
		}
		?>
        </ul>
	<?php endif; ?>
	<?php
	
	die("");
  
}

add_action('wp_ajax_CustomPostOptionAjaxGallery', 'CustomPostOptionAjaxGallery' );

/*
============================================================================
	*
	* Ajax Theme Option
	*
============================================================================	
*/
$post_option_type_fields = array(
	array(
		'id' => 'background_color'
	),
	
	array(
		'id' => 'image_select',
		'item' => array(
			'post_option_select_sidebar' => array(
				array('title' => __('Sidebar Right','ux'), 'value' => 'post_sidebar_right'),
				array('title' => __('Sidebar Left','ux'), 'value' => 'post_sidebar_left'),
				array('title' => __('Sidebar No','ux'), 'value' => 'post_sidebar_no')
			),
			
			'post_option_select_audio_layout' => array(
				array('title' => __('Self Hosted Audio','ux'), 'value' => 'post_self_hosted_audio'),
				array('title' => __('Soundcloud','ux'), 'value' => 'post_soundcloud')
			),
			
			
		)
	
	),
	
	array(
		'id' => 'select',
		'item' => array(
			'post_option_select_list_style' => array(
				array('title' => __('Vertical List','ux'), 'value' => 'verticle'),
				array('title' => __('Slider','ux'), 'value' => 'slider'),
				array('title' => __('Masonry','ux'), 'value' => 'masonry')
			),
			'post_option_select_title_bar' => array(
				array('title' => __('Yes','ux'), 'value' => 'yes'),
				array('title' => __('No','ux'), 'value' => 'no')
			),
			'post_option_select_specing' => array(
				array('title' => __('Yes','ux'), 'value' => 'yes'),
				array('title' => __('No','ux'), 'value' => 'no')
			),
			'post_option_select_bottom_specing' => array(
				array('title' => __('Yes','ux'), 'value' => 'yes'),
				array('title' => __('No','ux'), 'value' => 'no')
			)
					
		)
	),
	
	array(
		'id' => 'cheak',
		'item' => array(
			'post_option_cheak_show' => array(
				array('title' => __('Meta','ux'), 'value' => 'meta'),
				//array('title' => __('Comments','ux'), 'value' => 'comments'),
			),
		)
	),
	
	array('id' => 'input_text'),
	array('id' => 'textarea'),
	array('id' => 'link_item'),
	array('id' => 'line')
);

$post_option_fields = array(
	array(
		'id' => 'page',
		'item_display' => 'none',
		'item' => array(
			
			
		
		),
		'option' => array(
			
			array('title' => __('Sidebar','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_sidebar'),
				  
			array('title' => __('Show Title Bar','ux'),
				  'type' => 'select',
				  'name' => 'post_option_select_title_bar'),
				  
			array('title' => __('Top Specing','ux'),
				  'type' => 'select',
				  'name' => 'post_option_select_specing'),
			
			array('title' => __('Bottom Specing','ux'),
				  'type' => 'select',
				  'name' => 'post_option_select_bottom_specing')	  
		
		)
	),
	
	array(
		'id' => '0',
		'item_display' => 'none',
		'item' => array(),
		'option' => array(
			
			array('title' => __('Color','ux'),
				  'type' => 'background_color',
				  'name' => 'post_background_color'),
				  
			array('title' => __('Sidebar','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_sidebar'),
				  
			array('title' => __('Show','ux'),
				  'type' => 'cheak',
				  'name' => 'post_option_cheak_show')
		
		)
	),
	
	array(
		'id' => 'gallery',
		'item_display' => __('Select Images','ux'),
		'item' => array(
			
			array('type' => 'gallery')
		
		),
		'option' => array(
			
			array('title' => __('Color','ux'),
				  'type' => 'background_color',
				  'name' => 'post_background_color'),
				  
			array('title' => __('Sidebar','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_sidebar'),
				  
			array('title' => __('Image List Style','ux'),
				  'type' => 'select',
				  'name' => 'post_option_select_list_style'),
				  
			array('title' => __('Show','ux'),
				  'type' => 'cheak',
				  'name' => 'post_option_cheak_show')
		
		)
	),
	
	array(
		'id' => 'image',
		'item_display' => __('Image Settings','ux'),
		'item' => array(
		
			array('title' => __('Link','ux'),
				  'type' => 'input_text',
				  'name' => 'post_option_input_link'),
			
		
		),
		'option' => array(
			
			array('title' => __('Color','ux'),
				  'type' => 'background_color',
				  'name' => 'post_background_color'),
				  
			array('title' => __('Sidebar','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_sidebar'),
				  
			array('title' => __('Show','ux'),
				  'type' => 'cheak',
				  'name' => 'post_option_cheak_show')
		
		)
	),
	
	array(
		'id' => 'audio',
		'item_display' => __('Audio Settings','ux'),
		'item' => array(
			
			array('title' => __('Audio Type','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_audio_layout'),
			
			array('type' => 'line'),
			
			array('title' => __('Artist','ux'),
				  'type' => 'input_text',
				  'name' => 'post_option_input_artist'),
				  
			array('title' => __('MP3','ux'),
				  'type' => 'link_item',
				  'name' => 'post_option_mp3'),
				  
			array('title' => __('Code for WP','ux'),
				  'type' => 'textarea',
				  'name' => 'post_option_textarea_soundcloud',
				  'unit' => __('*Format: https://soundcloud.com/imam-lepast-konyol/maher-zain-always-be-there-1','ux'))
		
		),
		'option' => array(
			
			array('title' => __('Color','ux'),
				  'type' => 'background_color',
				  'name' => 'post_background_color'),
				  
			array('title' => __('Sidebar','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_sidebar'),
				  
			array('title' => __('Show','ux'),
				  'type' => 'cheak',
				  'name' => 'post_option_cheak_show')
		
		)
	),
	
	array(
		'id' => 'video',
		
		'item_display' =>  __('Video Settings','ux'),
		'item' => array(
		
			array('type' => 'text',
				  'content' => __('You could find the enbed code on the source video page. For Youtube and Vimoe, you can enter the url only.','ux')),
				  
			array('title' => __('Embeded Code','ux'),
				  'type' => 'textarea',
				  'name' => 'post_option_textarea_embeded')
			
			/*array('title' => __('M4V File URL','ux'),
				  'type' => 'input_text',
				  'name' => 'post_option_input_m4v'),
			
			array('title' => __('OGV File URL','ux'),
				  'type' => 'input_text',
				  'name' => 'post_option_input_ogv')*/
			
		
		),
		'option' => array(
			
			array('title' => __('Color','ux'),
				  'type' => 'background_color',
				  'name' => 'post_background_color'),
				  
			array('title' => __('Sidebar','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_sidebar'),
				  
			array('title' => __('Show','ux'),
				  'type' => 'cheak',
				  'name' => 'post_option_cheak_show')
		
		)
	),
	
	array(
		'id' => 'quote',
		'item_display' => __('Quote Settings','ux'),
		'item' => array(
			
			array('title' => __('The Quote','ux'),
				  'type' => 'textarea',
				  'name' => 'post_option_textarea_quote',
				  'unit' => __('Write your quote in this field.','ux')),
		
		),
		'option' => array(
			
			array('title' => __('Color','ux'),
				  'type' => 'background_color',
				  'name' => 'post_background_color'),
				  
			array('title' => __('Sidebar','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_sidebar'),
				  
			array('title' => __('Show','ux'),
				  'type' => 'cheak',
				  'name' => 'post_option_cheak_show')
		
		)
	),
	
	array(
		'id' => 'link',
		'item_display' => __('Link Settings','ux'),
		'item' => array(
			
			array('title' => __('Link Item','ux'),
				  'type' => 'link_item',
				  'name' => 'post_option_link_item'),
		
		),
		'option' => array(
			
			array('title' => __('Color','ux'),
				  'type' => 'background_color',
				  'name' => 'post_background_color'),
				  
			array('title' => __('Sidebar','ux'),
				  'type' => 'image_select',
				  'name' => 'post_option_select_sidebar'),
				  
			array('title' => __('Show','ux'),
				  'type' => 'cheak',
				  'name' => 'post_option_cheak_show')
		
		)
	)
	
	
);

function CustomPostOptionAjax(){
	global $post_option_fields, $post_option_type_fields;
	$data = $_POST['data'];
	$option = $data['option'];
	$post_id = $data['post_id'];
	
	foreach($post_option_fields as $field){
		if($field['id'] == $option){
			if($field['item_display'] != 'none'): ?>
				<div id="post-format-option-box" class="postbox" style="display:none;">
                    <div title="<?php _e('Click to toggle','ux'); ?>" class="handlediv"><br></div>
                    <h3 class="hndle"><span><?php echo $field['item_display']; ?></span></h3>
                    <div class="inside">
                        <div class="post_option_content">
							<?php foreach($field['item'] as $item): ?>
								<?php if($item['type'] == 'text'): ?>
                                
                                    <div class="row-fluid">
                                        <div class="span12 muted"><?php echo $item['content']; ?></div>
                                    </div>
								
								<?php elseif($item['type'] == 'gallery'): ?>
								
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="post_option_gallery">
                                            <div class="post_option_gallery_images">
                                                <?php
                                                $post_option_gallery_selected = get_post_meta($post_id, 'post_option_gallery_selected', true);
                                                if($post_option_gallery_selected){
                                                    $below_show = ' style="display:none;"';
                                                    $selected_show = '';
                                                }else{
                                                    $below_show = '';
                                                    $selected_show = ' style="display:none;"';
                                                }
                                                ?>
                                                <div class="post_option_gallery_below" <?php echo $below_show; ?>></div>
                                                <ul class="post_option_gallery_selected" <?php echo $selected_show; ?>>
                                                    <?php if($post_option_gallery_selected){
                                                    $i=0;
                                                    for ($i=0; $i<count($post_option_gallery_selected); $i++){
                                                        $thumb_src_preview = wp_get_attachment_image_src( $post_option_gallery_selected[$i], 'gallery-selected-thumb'); ?>
                                                    <li><span class="remove_item_image post_click"></span><img src="<?php echo $thumb_src_preview[0]; ?>" /><input type="hidden" name="post_option_gallery_selected[]" value="<?php echo $post_option_gallery_selected[$i]; ?>" /></li>
                                                    
                                                    <?php }
													}?>
                                                </ul>
                                                <script type="text/javascript">
												jQuery(document).ready(function() {
													jQuery('.post_option_gallery_selected').sortable();
												});
												</script>
                                                
                                            
                                            </div>
                                            
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="post_option_show_line"></div>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="post_option_gallery_image_list">
                                            <div class="post_option_gallery_image_list_loading"></div>
                                            <div class="post_option_gallery_image_list_content"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="pagination pagination-centered post_option_gallery_pagination">
                                            <?php
                                            $gallery_count = wp_count_posts('attachment')->inherit;
                                            $gallery_paged = ceil($gallery_count/16);
                                            if($gallery_count != 0):
                                            ?>
                                            <ul>
                                                <?php 
                                                for($i=1; $i<=$gallery_paged; $i++){
                                                    if($i == 1){
                                                        $active = 'active';
                                                    }else{
                                                        $active = '';
                                                    }
                                                    
                                                    ?>
                                                    <li class="<?php echo $active; ?>"><a href="#" class="post_gallery_pages post_click"><?php echo $i; ?></a></li>
                                                
                                                <?php }; ?>
                                            </ul>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                
								<?php elseif($item['type'] == 'line'): ?>
                                    
                                    <div class="post_option_show_line"></div>
                                    
                                <?php else: ?>
                                
                                    <div class="row-fluid">
                                        <div class="span2">
                                            <div class="post_descriptive_title">
                                                <strong class="lead"><?php echo $item['title']; ?></strong>
                                            </div>
                                        </div>
                                        <div class="span10">
                                            <div class="<?php echo $item['name']; ?>">
                                            <?php
                                            foreach($post_option_type_fields as $type){
                                                if($type['id'] == $item['type']){
                                                    switch($item['type']){
                                                        case 'input_text':
                                                          $post_meta = get_post_meta($post_id, $item['name'], true);
                                                          echo '<input name="'.$item['name'].'" class="post_option_text_input span10" type="text" value="'. $post_meta.'" />';
                                                        break;
                                                  
                                                        case 'textarea':
                                                            $post_meta = get_post_meta($post_id, $item['name'], true);
                                                            if(isset($item['unit'])){
                                                                $post_unit = $item['unit'];
																$span = 'span12';
                                                            }else{
                                                                $post_unit = '';
																$span = 'span10';
                                                            }
                                                            echo '<textarea name="'.$item['name'].'" class="'.$span.'" rows="6">'.$post_meta.'</textarea>';
                                                            echo '<span class="post_option_unit_descriptions">'.$post_unit.'</span>';
                                                        break;
                                                        
                                                        case 'link_item':
                                                            $post_meta = get_post_meta($post_id, $item['name'], true);
                                                            $post_meta_title = get_post_meta($post_id, $item['name'].'_title', true);
                                                            $post_meta_url = get_post_meta($post_id, $item['name'].'_url', true);
                                                            if($post_meta_title){
                                                                $i = 0;
                                                                for ($i=0; $i<count($post_meta_title); $i++){
                                                                    if($i == 0){
                                                                        $btn = 'post_option_add_btn';
                                                                    }else{
                                                                        $btn = 'post_option_remove_btn';
                                                                    }?>
                                                                    <div class="row-fluid">
                                                                        <input name="<?php echo $item['name']; ?>_title[]" class="post_option_text_input span3" type="text" value="<?php echo $post_meta_title[$i]; ?>" placeholder="<?php _e('Title','ux'); ?>" />
                                                                        <input name="<?php echo $item['name']; ?>_url[]" class="post_option_text_input span6" type="text" value="<?php echo $post_meta_url[$i]; ?>" placeholder="<?php _e('URL','ux'); ?>" />
                                                                        <div class="span2"><div class="<?php echo $btn; ?> post_click"></div></div>
                                                                        
                                                                    </div>
                                                                <?php	
                                                                }
                                                            }else{
                                                                $i = 0;
                                                                for ($i=0; $i<2; $i++){
                                                                    if($i == 0){
                                                                        $btn = 'post_option_add_btn';
                                                                    }else{
                                                                        $btn = 'post_option_remove_btn';
                                                                    }?>
                                                                    <div class="row-fluid">
                                                                        <input name="<?php echo $item['name']; ?>_title[]" class="post_option_text_input span3" type="text" value="" placeholder="<?php _e('Title','ux'); ?>" />
                                                                        <input name="<?php echo $item['name']; ?>_url[]" class="post_option_text_input span6" type="text" value="" placeholder="<?php _e('URL','ux'); ?>" />
                                                                        <div class="span2"><div class="<?php echo $btn; ?> post_click"></div></div>
                                                                        
                                                                    </div>
                                                                <?php	
                                                                }
                                                            }
                                                        
                                                        break;
														
														case 'image_select':
															$post_meta = get_post_meta($post_id, $item['name'], true);
															foreach($type['item'][$item['name']] as $num => $type_item):
																	if($post_meta){
																		if($post_meta == $type_item['value']){
																			$checked = 'checked';
																		}else{
																			$checked = '';
																		}
																		$value = $post_meta;
																	}else{
																		if($num == 0){
																			$checked = 'checked';
																		}else{
																			$checked = '';
																		}
																		$value = 'post_self_hosted_audio';
																	}
															  
																?>
																	<div class="<?php echo $type_item['value']; ?> select_layout post_click <?php echo $checked; ?>" data-layout="<?php echo $type_item['value']; ?>">
																		<div class="checked_btn"></div>
																	</div>
																	
																  
																<?php endforeach; ?>
																<input type="hidden" name="<?php echo $item['name']; ?>" value="<?php echo $value; ?>" />
															
														<?php
                                                        break;
                                                         
                                                    }
                                                }
                                                
                                            }?>
                                            </div>
                                        </div>
                                    </div>
                                    
								<?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
				
				
			<?php endif; ?>
            
			<div id="post-option-box" class="postbox" style="display:none;">
                <div title="<?php _e('Click to toggle','ux'); ?>" class="handlediv"><br></div>
                <h3 class="hndle">
                    <span>
                    <?php if($field['id'] == 'page'){
						echo __('Page Option','ux');
					}else{
						echo __('Post Option','ux');
					} ?>
                    </span>
                </h3>
                <div class="inside">
					<div class="post_option_content">
						<?php foreach($field['option'] as $option): ?>
                        <div class="row-fluid">
                            <div class="span2">
                                <div class="post_descriptive_title">
                                    <strong class="lead"><?php echo $option['title']; ?></strong>
                                </div>
                            </div>
                            <div class="span10">
                                <div class="<?php echo $option['name']; ?>">
                                <?php
								foreach($post_option_type_fields as $type){
									if($type['id'] == $option['type']){
										switch($option['type']){
											case 'background_color':
												global $theme_color;
												$post_background_color = get_post_meta($post_id, 'post_background_color', true);
												foreach($theme_color as $i => $color) : 
													$icon = '';
													if($post_background_color){
														if($post_background_color == $i){
															$icon = '<i class="icon-ok"></i>';
														}
													}?>
													<a href="#post_color<?php echo $color['value']; ?>" class="post_click bg-<?php echo $color['value']; ?>" data-postcolor="<?php echo $i; ?>"><?php echo $icon; ?></a>
												
												<?php 
												endforeach;
												echo '<input type="hidden" name="'. $option['name'] .'" value="'. $post_background_color .'" />';
												echo '<div class="clearfix"></div>';
											break;
											
											case 'image_select':
												$post_meta = get_post_meta($post_id, $option['name'], true);
												if($option['name'] == 'post_option_select_sidebar'){
													foreach($type['item'][$option['name']] as $num => $type_item):
														if($post_meta){
															if($post_meta == $type_item['value']){
																$checked = 'checked';
															}else{
																$checked = '';
															}
															$value = $post_meta;
														}else{
															if(get_post_type($post_id) == 'page'){
																if($type_item['value'] == 'post_sidebar_no'){
																	$checked = 'checked';
																}else{
																	$checked = '';
																}
																$value = 'post_sidebar_no';
															}else{
																if($num == 0){
																	$checked = 'checked';
																}else{
																	$checked = '';
																}
																$value = 'post_sidebar_right';
															}
														}
                                                  
													?>
                                                        <div class="<?php echo $type_item['value']; ?> select_sidebar post_click <?php echo $checked; ?>" data-sidebar="<?php echo $type_item['value']; ?>">
                                                            <div class="checked_btn"></div>
                                                        </div>
                                                        
                                                      
													<?php endforeach; ?>
                                                    <input type="hidden" name="<?php echo $option['name']; ?>" value="<?php echo $value; ?>" />
                                                    <div class="clearfix"></div>
                                                    <?php $post_option_select_sidebars = get_post_meta($post_id, 'post_option_select_sidebars', true); ?>
                                                    <div class="row-fluid">
                                                        <select name="post_option_select_sidebars">
                                                            <option value="none"><?php _e('Please select', 'ux'); ?></option>
                                                            <?php
                                                            global $sidebar_array;
                                                            foreach($sidebar_array as $num => $sidebar):
                                                                if($post_option_select_sidebars){
                                                                    if($post_option_select_sidebars == $sidebar['id']){
                                                                        $selected = ' selected="selected"';
                                                                    }else{
                                                                        $selected = '';
                                                                    }
                                                                }else{
                                                                    $selected = '';
                                                                }
                                                                ?>
                                                                <option value="<?php echo $sidebar['id']; ?>" <?php echo $selected; ?>><?php echo $sidebar['name']; ?></option>
                                                            
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                
                                                <?php }
												
											break;
											
											case 'cheak':
                                              $post_meta = get_post_meta($post_id, $option['name'], true);
                                              echo '<ul class="post_option_cheak_list">';
                                              foreach($type['item'][$option['name']] as $num => $type_item):
                                                  if($post_meta){
													  if(in_array($type_item['value'],$post_meta)){
														  $checked = ' checked="checked"';
													  }else{
														  $checked = '';
													  }
												  }else{
													  $checked = '';
												  }
                                              
                                              ?>
                                                  <li>
                                                  <input type="checkbox" class="post_option_checkbox" name="<?php echo $option['name']; ?>[]" id="post_option_cheak_<?php echo $type_item['value']; ?>" value="<?php echo $type_item['value']; ?>" <?php echo $checked; ?>>
                                                  <label for="post_option_cheak_<?php echo $type_item['value']; ?>"><?php echo $type_item['title']; ?></label>
                                                  </li>
                                              <?php 
                                              endforeach;
                                              echo '</ul>';
                                          break;
										  
										  case 'select':
                                              $post_meta = get_post_meta($post_id, $option['name'], true);
                                              echo '<select name="'.$option['name'].'">';
                                              foreach($type['item'][$option['name']] as $num => $type_item):
												  if($post_meta){
													  if($post_meta == $type_item['value']){
														  $selected = ' selected="selected"';
													  }else{
														  $selected = '';
													  }
												  }else{
													  $selected = '';
												  }
											  
											  ?>
												  <option value="<?php echo $type_item['value']; ?>"<?php echo $selected; ?>><?php echo $type_item['title']; ?></option>
											  <?php 
											  endforeach;
                                              echo '</select>';
                                          
                                          break;
											 
										}
									}
									
								}?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
		<?php	
		}
		
	}
	
	die("");
  
}

add_action('wp_ajax_CustomPostOptionAjax', 'CustomPostOptionAjax' );


?>