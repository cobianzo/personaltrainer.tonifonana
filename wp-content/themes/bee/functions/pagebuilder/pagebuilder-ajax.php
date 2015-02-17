<?php
/*
============================================================================
	*
	* Template Ajax action
	*
============================================================================	
*/
function CustomPagebuilderTemplateAjax(){
	$modal_data = $_POST['data'];
	$mode = $modal_data["mode"];
	$module_fields = ux_module_fields();
		
	switch($mode){
		case 'save':
		
			$title = $modal_data["title"];
			$this_post_id = $modal_data["post_id"];
			$module_post_meta = $modal_data["module_post_meta"];
			
			$post = array(
				'post_title'  => $title,
				'post_status' => 'publish',
				'post_type'   => 'custom_template');
			
			$post_id = wp_insert_post($post,true);
			
			foreach ($module_post_meta as $name => $field) {  
				$old = get_post_meta($post_id, $name, true);  
				$new = $field;  
			
				if ($new && $new != $old) {  
					update_post_meta($post_id, $name, $new);  
				} elseif ('' == $new && $old) {  
					delete_post_meta($post_id, $name, $old);  
				}
				
				$pagebuilder_module_post = false;
				if($name == 'pagebuilder_item_module_post'){
					$pagebuilder_module_post = get_post_meta($post_id, 'pagebuilder_item_module_post', true);
				}elseif($name == 'pagebuilder_module_post'){
					$pagebuilder_module_post = get_post_meta($post_id, 'pagebuilder_module_post', true);
				}
				
				if($pagebuilder_module_post){
					$module_post = explode("'%_%'", $pagebuilder_module_post);
					foreach($module_post as $post_name){
						if($post_name != ''){
							$meta_value = get_post_meta($this_post_id, 'pagebuilder_module_value_'.$post_name, true);  
							add_post_meta($post_id, 'pagebuilder_module_value_'.$post_name, $meta_value);
						}
					}
				}
			}
		
		break;
		
		case 'load':
		
			$post_id = $modal_data["post_id"];
			$pagebuilder_item_width = get_post_meta($post_id, 'pagebuilder_item_width', true);
			$pagebuilder_item_module_post = get_post_meta($post_id, 'pagebuilder_item_module_post', true);
			$pagebuilder_module_post = get_post_meta($post_id, 'pagebuilder_module_post', true);
			
			$module_post = array(
				$pagebuilder_item_module_post,
				$pagebuilder_module_post
			);
			
			$item_width = explode("'%_%'", $pagebuilder_item_width);
			
			if(isset($modal_data['this_post_id'])){
				$this_post_id = $modal_data['this_post_id'];
				foreach($module_post as $post_field){
					$module_post = explode("'%_%'", $post_field);
					foreach($module_post as $post_name){
						$old = get_post_meta($this_post_id, 'pagebuilder_module_value_'.$post_name, true);  
						$new = get_post_meta($post_id, 'pagebuilder_module_value_'.$post_name, true);;  
					
						if ($new && $new != $old) {  
							update_post_meta($this_post_id, 'pagebuilder_module_value_'.$post_name, $new);  
						} elseif ('' == $new && $old) {  
							delete_post_meta($this_post_id, 'pagebuilder_module_value_'.$post_name, $old);  
						}
					}
				}
				
			}
			
			if($pagebuilder_item_width){  
				$i = 0;
				for($i=0; $i < count($item_width) -1; $i++){
					CustomWrapItemContainer($i, $item_width[$i], $post_id, $module_fields);
				}
			}
		
		break;
		
		case 'remove':
			
			global $wpdb;
			$post_id = $modal_data["post_id"];
			wp_delete_post($post_id);
			$wpdb->delete($wpdb->postmeta, array( 'post_id' => $post_id ) );
			
		break;
		
		case 'select':
			$template_post = get_posts(array(
				'posts_per_page' => -1,
				'post_type'      => 'custom_template'
			));
			
			foreach($template_post as $t_p){ ?>
				<option value="<?php echo $t_p->ID; ?>"><?php echo get_the_title($t_p->ID); ?></option>
			<?php }
		break;
		
	}
	
	die("");
	
}
add_action('wp_ajax_CustomPagebuilderTemplateAjax', 'CustomPagebuilderTemplateAjax' );

/*
============================================================================
	*
	* Ajax action
	*
============================================================================	
*/
function CustomPagebuilderAjaxAction(){
	$modal_data = $_POST['data'];
	$module_id = $modal_data["module_id"];
	$module_post_meta = $_POST['data']['module_post_meta'];
	$module_post_id = $modal_data["module_post_id"];
	$module_post = $modal_data["module_post"];
	$module_post_title = $modal_data["module_post_title"];
	$post_id = $modal_data["post_id"];
	
	if(isset($modal_data["module_content"])){
		$module_content = $modal_data["module_content"];
	}else{
		$module_content = '';
	}
	
	if($module_post_id != ''){
		$post = array(
			'ID' => $module_post_id,
			'post_title' => $module_post_title,
			'post_content' => $module_content);
			
		//wp_update_post($post);
		//$post_id = $module_post_id;
	}else{
		$post = array(
			'post_title' => $module_post_title,
			'post_content' => $module_content,
			'post_status' => 'publish',
			'post_type' => 'custom_modules' );
		
		//$post_id = wp_insert_post($post,true);
	}
	
	$old = get_post_meta($post_id, 'pagebuilder_module_value_'.$module_post, true);  
	$new = $module_post_meta;  

	if ($new && $new != $old) {  
		update_post_meta($post_id, 'pagebuilder_module_value_'.$module_post, $new);  
	} elseif ('' == $new && $old) {  
		delete_post_meta($post_id, 'pagebuilder_module_value_'.$module_post, $old);  
	}
	
	die("");
  
}

add_action('wp_ajax_CustomPagebuilderAjax', 'CustomPagebuilderAjaxAction' );


/*
============================================================================
	*
	* Load Gallery
	*
============================================================================	
*/
function CustomPagebuilderAjaxGallery(){
	$paged = (isset($_POST['data']))? $_POST['data'] : 1; 
	if($paged == ''){ $paged = 1; }
	
	$gallery_count = wp_count_posts('attachment')->inherit;
	
	$statement = array(
		'post_type' => 'attachment',
		'post_mime_type' =>'image',
		'post_status' => 'inherit',
		'posts_per_page' => '9',
		'paged' => $paged
	);
	
	$media_query = new WP_Query($statement); ?>
	<?php if($gallery_count != '0'): ?>
        <ul>
        <?php
		foreach($media_query->posts as $image){
			$thumb_src = wp_get_attachment_image_src( $image->ID, 'gallery-list-thumb');
			$thumb_src_preview = wp_get_attachment_image_src( $image->ID, 'gallery-selected-thumb');
			echo '<li><img src="' . $thumb_src[0] .'" title="' . $image->post_title . '" attid="' . $image->ID . '" rel="' . $thumb_src_preview[0] . '" class="gallery_selected item_click"/></li>'; 
		
		}
		?>
        </ul>
	<?php endif; ?>
	<?php
	
	die("");
  
}

add_action('wp_ajax_CustomPagebuilderAjaxGallery', 'CustomPagebuilderAjaxGallery' );


/*
============================================================================
	*
	* Ajax other
	*
============================================================================	
*/
function CustomPagebuilderAjaxOther(){
  $modal_data = $_POST['data'];
  $mode = $modal_data["mode"];
  
  switch($mode){
	  case 'add_item':
	  $i = $modal_data["item_id"];
	  $module_id = $modal_data["module_id"];
	  ?>
          <div class="lists_item" rel="<?php echo $i; ?>">
              <a href="#"><i></i> <?php echo __('Item','ux'). ' '.$i; ?></a>
              <span class="lists_item_edit item_click" module_id="<?php echo $module_id; ?>"></span>
              <span class="lists_item_close item_click" module_id="<?php echo $module_id; ?>"></span>
              <?php if($module_id == 'accordion_toggle' || $module_id == 'tabs'): ?>
              <input name="module_lists_layout_title[]" type="hidden" value="<?php echo __('Item','ux'). ' '.$i; ?>" />
              <textarea name="module_lists_layout_content[]" style="display:none;"></textarea>
              <?php elseif($module_id == 'price'): ?>
              <input name="module_lists_layout_color[]" type="hidden"  value="" />
              <input name="module_lists_layout_title[]" type="hidden" value="<?php echo __('Item','ux'). ' '.$i; ?>" />
              <input name="module_lists_layout_price[]" type="hidden" value="" />
              <input name="module_lists_layout_button[]" type="hidden" value="" />
              <input name="module_lists_layout_to_link[]" type="hidden" value="" />
              <input name="module_lists_layout_details[]" type="hidden" value="" />
              <?php elseif($module_id == 'progress_bar'): ?>
              <input name="module_lists_layout_color[]" type="hidden"  value="" />
              <input name="module_lists_layout_title[]" type="hidden" value="<?php echo __('Item','ux'). ' '.$i; ?>" />
              <input name="module_lists_layout_subtitle[]" type="hidden" value="" />
              <input name="module_lists_layout_progress[]" type="hidden" value="" />
              <?php else: ?>
              <input name="module_lists_layout_bullet[]" type="hidden" />
              <input name="module_lists_layout_content[]" type="hidden" value="<?php echo __('Item','ux'). ' '.$i; ?>" />
              <?php endif; ?>
          </div>
	  <?php
      break;
	  
	  case 'add_detail':
	  $i = $modal_data["item_id"];
	  $module_id = $modal_data["module_id"];
	  ?>
          <div class="details_item row-fluid" rel="<?php echo $i; ?>">
			  <?php global $module_details_item_icon; ?>
              <select class="span3" name="module_details_item_details_icon[]">
                  <?php foreach($module_details_item_icon as $icon): ?>
                  <option value="<?php echo $icon['value']; ?>"><?php echo $icon['title']; ?></option>
                  <?php endforeach; ?>
              </select>
              <input type="text" class="span5" name="module_details_item_details_text[]" value="">
              <span class="details_item_close item_click span4"></span>
          </div>
      <?php
	  break;
	  
	  case 'load_detail':
	  $item = $modal_data["item"];
	  $details = $modal_data["details"];
	  
	  if($details != ''){
		  $item_details = explode("O_O", $details);
		  $item_details_icon = explode("\'@_@\'", $item_details[0]);
		  $item_details_text = explode("\'@_@\'", $item_details[1]);
		  $i=0;
		  for ($i=0; $i<count($item_details_icon) - 1; $i++){ ?>
			  <div class="details_item row-fluid" rel="<?php echo $i; ?>">
				  <?php global $module_details_item_icon; ?>
				  <select class="span3" name="module_details_item_details_icon[]">
					  <?php foreach($module_details_item_icon as $icon): ?>
					  <?php 
					  if(isset($item_details_icon[$i])){
						  if($item_details_icon[$i] == $icon['value']){
							  $selected = ' selected="selected"';
						  }else{
							  $selected = '';
						  }
					  }else{
						  $selected = '';
					  } ?>
					  <option value="<?php echo $icon['value']; ?>" <?php echo $selected; ?>><?php echo $icon['title']; ?></option>
					  <?php endforeach; ?>
				  </select>
				  <input type="text" class="span5" name="module_details_item_details_text[]" value="<?php echo $item_details_text[$i];?>">
				  <span class="details_item_close item_click span4"></span>
			  </div>
			  
		  <?php 
          }
	  }else{ ?>
		  <div class="details_item row-fluid" rel="0">
			  <?php global $module_details_item_icon; ?>
			  <select class="span3" name="module_details_item_details_icon[]">
				  <?php foreach($module_details_item_icon as $icon): ?>
				  <option value="<?php echo $icon['value']; ?>"><?php echo $icon['title']; ?></option>
				  <?php endforeach; ?>
			  </select>
			  <input type="text" class="span5" name="module_details_item_details_text[]">
			  <span class="details_item_close item_click span4"></span>
		  </div>
		  
	  <?php
      }
	  
	  break;
	  
  }
  die("");
  
}

add_action('wp_ajax_CustomPagebuilderAjaxOther', 'CustomPagebuilderAjaxOther' );

/*
============================================================================
	*
	* Ajax Pagebuilder Create
	*
============================================================================	
*/
function CustomPagebuilderAjaxCreate(){
  $ajax_data       = $_POST['data'];
  
  $mode            =  $ajax_data['mode'];
  $parent_id       =  $ajax_data['parent_id'];
  $parent_title    =  $ajax_data['parent_title'];
  $parent_width    =  $ajax_data['parent_width'];
  $module_id       =  $ajax_data['module_id'];
  $module_post     =  $ajax_data['module_post'];
  $module_name     =  $ajax_data['module_name'];
  $module_post_id  =  $ajax_data['module_post_id'];
  
  if(isset($ajax_data['this_post'])){
	  $this_post = $ajax_data['this_post'];
	  if(isset($ajax_data['this_post_id'])){
		  $this_post_id = $ajax_data['this_post_id'];
		  $old = get_post_meta($this_post_id, 'pagebuilder_module_value_'.$module_post, true);  
		  $new = get_post_meta($this_post_id, 'pagebuilder_module_value_'.$this_post, true);;  
	  
		  if ($new && $new != $old) {  
			  update_post_meta($this_post_id, 'pagebuilder_module_value_'.$module_post, $new);  
		  } elseif ('' == $new && $old) {  
			  delete_post_meta($this_post_id, 'pagebuilder_module_value_'.$module_post, $old);  
		  }
	  }
  }
  
  if($parent_title == 'Fullwidth Wrap'){
	  $parent_title = '1/1';
  }
  
  switch($mode){
	  case 'general_wrap': ?>
	  <div class="pagebuilder_wrap_item warp_item <?php echo $parent_width; ?>" data-width="<?php echo $parent_width; ?>">
          <input type="hidden" class="item_sort" name="pagebuilder_item_sort[]" value="<?php echo $parent_id; ?>" />
          <input type="hidden" class="item_width" name="pagebuilder_item_width[]" value="<?php echo $parent_width; ?>" />
          <input type="hidden" class="item_module_id" name="pagebuilder_item_module_id[]" value="<?php echo $module_id; ?>" />
          <input type="hidden" class="item_module_post set_module_post" name="pagebuilder_item_module_post[]" value="<?php echo $module_post; ?>" />
          <input type="hidden" class="item_module_post_id set_post_id" name="pagebuilder_item_module_post_id[]" value="<?php echo $module_post_id; ?>" />
          <div class="pagebuilder_wrap_item_title sort_over_title">
              <a class="item_increase item_click" href="#"></a>
              <a class="item_reduce item_click" href="#"></a>
              <a class="item_module item_click" href="#"><?php _e('+ Module','ux');?></a>
              <a class="item_delete item_click" href="#"></a>
              <span class="item_subtitle"><?php echo $parent_title; ?></span>
              <div class="clear"></div>
          </div>
          <div class="pagebuilder_wrap_item_content module_connect"></div>
      </div>
	  
      <?php 
	  break;
	  
	  case 'fullwidth_wrap': ?>
	  <div class="pagebuilder_wrap_item warp_item <?php echo $parent_width; ?>" data-width="<?php echo $parent_width; ?>">
          <input type="hidden" class="item_sort" name="pagebuilder_item_sort[]" value="<?php echo $parent_id; ?>" />
          <input type="hidden" class="item_width" name="pagebuilder_item_width[]" value="<?php echo $parent_width; ?>" />
          <input type="hidden" class="item_module_id" name="pagebuilder_item_module_id[]" value="<?php echo $module_id; ?>" />
          <input type="hidden" class="item_module_post set_module_post" name="pagebuilder_item_module_post[]" value="<?php echo $module_post; ?>" />
          <input type="hidden" class="item_module_post_id set_post_id" name="pagebuilder_item_module_post_id[]" value="<?php echo $module_post_id; ?>" />
          <div class="pagebuilder_wrap_item_title sort_over_title">
              <div class="fullwidth_setting">
                  <a class="item_module item_click" href="#"><?php _e('+ Module','ux');?></a>
                  <a class="item_setting module_edit item_module_click item_click" href="#"><?php _e('Setting','ux');?></a>
              </div>
              <a class="item_delete item_click" href="#"></a>
              <span class="item_subtitle"><?php _e('Fullwidth Wrap','ux');?></span>
              <div class="clear"></div>
          </div>
          <div class="pagebuilder_wrap_item_content module_connect"></div>
      </div>
	  
      <?php 
	  break;
	  
	  case 'choose_module':
	  if($module_post_id != ''){
		  global $wpdb;
		  $get_results = $wpdb->get_results("
			  SELECT *
			  FROM $wpdb->postmeta 
			  WHERE `post_id` = $module_post_id
			  "
		  );
		  
		  $get_post = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = $module_post_id");
		  
		  $post = array(
			  'post_title' => $get_post->post_title,
			  'post_content' => $get_post->post_content,
			  'post_status' => 'publish',
			  'post_type' => 'custom_modules' );
		
		  $module_post_id = wp_insert_post($post,true);
		  foreach($get_results as $result){
			  add_post_meta($module_post_id, $result->meta_key, $result->meta_value);
		  }
	  }
	  
	  ?>
	  <div class="pagebuilder_wrap_item module_item <?php echo $parent_width; ?>" data-width="<?php echo $parent_width; ?>">
          <input type="hidden" class="item_sort" name="pagebuilder_item_sort[]" value="<?php echo $parent_id; ?>" />
          <input type="hidden" class="item_width" name="pagebuilder_item_width[]" value="<?php echo $parent_width; ?>" />
          <input type="hidden" class="item_module_id" name="pagebuilder_item_module_id[]" value="<?php echo $module_id; ?>" />
          <input type="hidden" class="item_module_post set_module_post" name="pagebuilder_item_module_post[]" value="<?php echo $module_post; ?>" />
          <input type="hidden" class="item_module_post_id set_post_id" name="pagebuilder_item_module_post_id[]" value="<?php echo $module_post_id; ?>" />
          <div class="pagebuilder_wrap_item_module">
              <div class="pagebuilder_wrap_item_module_title">
                  <a class="item_increase item_module_click item_click" href="#"></a>
                  <a class="item_reduce item_module_click item_click" href="#"></a>
              </div>
              <div class="pagebuilder_wrap_item_module_name sort_over_title">
                  <span class="item_title"><?php echo $module_name; ?></span>
                  <span class="item_subtitle"><?php echo $parent_title; ?></span>
              </div>
              <div class="pagebuilder_wrap_item_module_ctrl">
                  <a class="module_copy item_module_click item_click" href="#"></a>
                  <a class="module_remove item_click" href="#"></a>
                  <a class="module_edit item_module_click item_click" href="#"><?php _e('Edit','ux');?></a>
              </div>
              <div class="clear"></div>
          </div>
      </div>
	  <?php
	  break;
	  
	  case 'add_module':
	  if($module_post_id != ''){
		  global $wpdb;
		  $get_results = $wpdb->get_results("
			  SELECT *
			  FROM $wpdb->postmeta 
			  WHERE `post_id` = $module_post_id
			  "
		  );
		  
		  $get_post = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = $module_post_id");
		  
		  $post = array(
			  'post_title' => $get_post->post_title,
			  'post_content' => $get_post->post_content,
			  'post_status' => 'publish',
			  'post_type' => 'custom_modules' );
		
		  $module_post_id = wp_insert_post($post,true);
		  foreach($get_results as $result){
			  add_post_meta($module_post_id, $result->meta_key, $result->meta_value);
		  }
	  }
	  ?>
	  <div class="pagebuilder_wrap_item module_item <?php echo $parent_width[0]; ?>" data-width="<?php echo $parent_width[0]; ?>">
          <input type="hidden" class="module_id" name="pagebuilder_module_id[]" value="<?php echo $module_id; ?>" />
          <input type="hidden" class="module_width" name="pagebuilder_module_width[]" value="<?php echo $parent_width[0]; ?>" />
          <input type="hidden" class="module_parent" name="pagebuilder_module_parent[]" value="<?php echo $parent_id; ?>" />
          <input type="hidden" class="module_post set_module_post" name="pagebuilder_module_post[]" value="<?php echo $module_post; ?>" />
          <input type="hidden" class="module_post_id set_post_id" name="pagebuilder_module_post_id[]" value="<?php echo $module_post_id; ?>" />
          <div class="pagebuilder_wrap_item_module">
              <div class="pagebuilder_wrap_item_module_title">
                  <a class="item_increase module_click item_click" href="#"></a>
                  <a class="item_reduce module_click item_click" href="#"></a>
              </div>
              <div class="pagebuilder_wrap_item_module_name sort_over_title">
                  <span class="item_title"><?php echo $module_name; ?></span>
                  <span class="item_subtitle"><?php echo $parent_title; ?></span>
              </div>
              <div class="pagebuilder_wrap_item_module_ctrl">
                  <a class="module_copy module_click item_click" href="#"></a>
                  <a class="module_remove item_click" href="#"></a>
                  <a class="module_edit module_click item_click" href="#"><?php _e('Edit','ux');?></a>
              </div>
              <div class="clear"></div>
          </div>
      </div>
	  <?php 
	  break;
  }
  die('');
  
}
add_action('wp_ajax_CustomPagebuilderAjaxCreate', 'CustomPagebuilderAjaxCreate' );

/*
============================================================================
	*
	* Ajax Pagebuilder Create
	*
============================================================================	
*/
function CustomPagebuilderAjaxModule(){
	$module_fields = ux_module_fields();
	$module_type_fields = ux_module_type_fields();
	
	$ajax_data       =  $_POST['data'];
	$module_id       =  $ajax_data['module_id'];
	$module_post     =  $ajax_data['module_post'];
	$module_post_id  =  $ajax_data['module_post_id'];
	$post_id         =  $ajax_data['post_id'];
	
	if($module_post_id != ''){
		$post_content = get_post($module_post_id)->post_content;
		$post_title = get_post($module_post_id)->post_title;
	}else{
		$post_content = '';
		$post_title = '';
	}
	?>
    
    <input type="hidden" id="modal_module_id" name="modal_module_id" value="<?php echo $module_id; ?>">
    <input type="hidden" id="modal_module_post" name="modal_module_post" value="<?php echo $module_post; ?>">
    <input type="hidden" id="modal_module_post_id" name="modal_module_post_id" value="<?php echo $module_post_id; ?>">
	<?php
    foreach($module_fields as $field){
        if($field['id'] == $module_id){
            foreach($field['item'] as $item): ?>
                <?php if($item['type'] == 'line'): ?>
                
                    <div class="module_show_line"></div>
                
                <?php elseif($item['type'] == 'gallery'): ?>
					<div class="row-fluid">
                        <div class="span12">
                            <div class="module_show_gallery">
                                <div class="module_descriptive_title" data-module="">
                                    <strong class="lead"><?php echo $item['title']; ?></strong>
                                </div>
                                <div class="module_show_gallery_images">
                                    <?php
									$module_select_gallery_selected = ux_get_module_meta($module_post, 'module_select_gallery_selected', $post_id);
									$split_gallery = explode("'%_%'",$module_select_gallery_selected);
									if($module_select_gallery_selected){
										$below_show = ' style="display:none;"';
										$selected_show = '';
									}else{
										$below_show = '';
										$selected_show = ' style="display:none;"';
									}
									?>
                                    <div class="module_show_gallery_below" <?php echo $below_show; ?>></div>
                                    <ul class="module_show_gallery_selected" <?php echo $selected_show; ?>>
                                        <?php 
										$i=0;
										for ($i=0; $i<count($split_gallery) - 1; $i++){
											$thumb_src_preview = wp_get_attachment_image_src( $split_gallery[$i], 'gallery-selected-thumb'); ?>
                                        <li><span class="remove_item_image item_click"></span><img src="<?php echo $thumb_src_preview[0]; ?>" /><input type="hidden" name="module_select_gallery_selected[]" value="<?php echo $split_gallery[$i]; ?>" /></li>
                                        
                                        <?php } ?>
                                    </ul>
                                    
                                
                                </div>
                                
                            
                            </div>
                        </div>
                    </div>
                    <div class="module_show_line"></div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="module_show_gallery_image_list">
                                <div class="module_show_gallery_image_list_loading"></div>
                                <div class="module_show_gallery_image_list_content"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pagination pagination-centered gallery_pagination">
                                <?php
                                $gallery_count = wp_count_posts('attachment')->inherit;
								$gallery_paged = ceil($gallery_count/9);
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
                                        <li class="<?php echo $active; ?>"><a href="#" class="gallery_pages item_click"><?php echo $i; ?></a></li>
                                    
                                    <?php }; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                <?php else: ?>
                
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="module_descriptive_title" data-module="">
								<?php 
                                if(is_array($item['title'])){
                                    foreach($item['title'] as $i => $item_title){ ?>
                                        <strong class="lead" data-id="<?php echo $i; ?>"><?php echo $item_title; ?></strong>
                                    <?php
                                    }
                                }else{ ?>
                                    <strong class="lead"><?php echo $item['title']; ?></strong>
                                <?php } ?><br />
                                <span class="muted"><?php echo $item['description']; ?></span>
                            </div>
                        </div>
                        <div class="span8">
                              <div class="<?php echo $item['name']; ?>">
                              <?php
                              foreach($module_type_fields as $type){
                                  if($type['id'] == $item['type']){
                                      switch($item['type']){
                                          case 'background_color':
                                              global $theme_color;
											  $module_background_color = ux_get_module_meta($module_post, 'module_background_color', $post_id);
											  foreach($theme_color as $i => $color) :
												  $icon = '';
												  if($module_background_color){
													  if($module_background_color == $i){
														  $icon = '<i class="icon-ok"></i>';
													  }
												  }?>
												  <a href="#post_color<?php echo $color['value']; ?>" class="item_click bg-<?php echo $color['value']; ?>" data-postcolor="<?php echo $i; ?>"><?php echo $icon; ?></a>
											  
											  <?php endforeach; ?>
                                              <a href="#post_color_clear" class="item_click bg-cancelcolor" data-postcolor="clear"></a>
                                              <input type="hidden" name="<?php echo $item['name']; ?>" value="<?php echo $module_background_color; ?>" />
                                              <div class="clearfix"></div>
                                              <br />
                                              <?php if(isset($item['bind_type'])){
												  ux_get_field_option($item['bind_type'], $item['bind_name'], $post_id, $module_post);
											  } ?>
                                          <?php
                                          break;
										  
										  case 'tabs':
											  ux_get_field_option($item['type'], $item['name'], $post_id, $module_post);
										  break;
										  
										  case 'google_map':
											  ux_get_field_option($item['type'], $item['name'], $post_id, $module_post);
										  break;
										  
										  
                                          
                                          case 'icon':
                                              $module_select_icon = ux_get_module_meta($module_post, 'module_select_icon', $post_id);
                                              foreach($type['item'] as $num => $type_item): 
                                                  $current = '';
                                                  if($module_select_icon){
                                                      if($module_select_icon == $type_item){
                                                          $current = ' current';
                                                      }
                                                  }
                                              ?>
                                                  <a href="#" class="module_icons item_click<?php echo $current; ?>"><i class="<?php echo $type_item; ?>"></i></a>
                                              <?php 
                                              endforeach;
                                              echo '<input type="hidden" name="'. $item['name'] .'" value="'.$module_select_icon.'" />';
                                              echo '<div class="clearfix"></div>';
                                          break;
                                          
                                          case 'title':
                                              $module_post_title = ux_get_module_meta($module_post, 'module_post_title', $post_id);
											  echo '<input name="module_post_title" class="module_text_input" type="text" value="'. $module_post_title.'" />';
                                          break;
                                          
                                          case 'input_text':
                                              $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
                                              if(isset($item['unit'])){
                                                  $module_unit = $item['unit'];
                                              }else{
                                                  $module_unit = '';
                                              }
											  if(isset($item['placeholder'])){
												  $module_placeholder = $item['placeholder'];
											  }else{
												  $module_placeholder = '';
											  }
											  
											  if($item['name'] == 'module_select_price_currency'){
												  echo '<input name="'.$item['name'].'" class="module_text_input span6" type="text" value="'. $module_meta.'" placeholder="'.$module_unit.'" />';
											  }elseif($item['name'] == 'module_input_price_runtime'){
												  $module_input_price_runtime_hide = ux_get_module_meta($module_post, 'module_input_price_runtime_hide', $post_id);
												  if($module_input_price_runtime_hide){
                                                      $checked = ' checked="checked"';
													  $value = 'true';
                                                  }else{
                                                      $checked = '';
													  $value = 'false';
                                                  }
												  
												  echo '<input name="'.$item['name'].'" class="module_text_input span6" type="text" value="'. $module_meta.'" />';
												  echo '<div class="span4">';
												  echo '<input type="checkbox" class="module_checkbox pull-left" name="module_input_price_runtime_hide[]" value="'.$value.'" '.$checked.'>';
                                                  echo '<label for="module_cheak_hide_runtime" class="pull-left">'.__('Hide Runtime','ux').'</label>';
												  echo '</div>';
											  }elseif($item['name'] == 'module_input_map_address'){
												  echo '<div><input name="'.$item['name'].'" class="module_text_input span6" type="text" value="'. $module_meta.'" /> <span class="module_s_descriptions">'.$module_unit.'</span></div>';
												  echo '<div class="clear"><a href="http://map.google.com/" class="btn btn-small" target="_blank">'.__('Google Map','ux').'</a></div>';
												  
											  }else{
												  echo '<input name="'.$item['name'].'" class="module_text_input span6" type="text" value="'. $module_meta.'" placeholder="'.$module_placeholder.'" /> <span class="module_s_descriptions">'.$module_unit.'</span>';
											  }
                                          break;
                                          
                                          case 'html_content':
                                              $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
                                              echo '<textarea name="'.$item['name'].'" class="span12" rows="6">'.$module_meta.'</textarea>';
                                          break;
										  
										  case 'details_item':
										      echo '<a href="#" class="btn details_layout item_click" module_id="'. $module_id .'">'. __('Add','ux') .'</a>';
											  ?>
											  <div class="details_row"></div>
											  
										  <?php
										  break;
                                          
                                          case 'list_item':
                                              $module_lists_layout_bullet = ux_get_module_meta($module_post, 'module_lists_layout_bullet', $post_id);
                                              $module_lists_layout_title = ux_get_module_meta($module_post, 'module_lists_layout_title', $post_id);
											  $module_lists_layout_subtitle = ux_get_module_meta($module_post, 'module_lists_layout_subtitle', $post_id);
                                              $module_lists_layout_content = ux_get_module_meta($module_post, 'module_lists_layout_content', $post_id);
											  $module_lists_layout_color = ux_get_module_meta($module_post, 'module_lists_layout_color', $post_id);
											  $module_lists_layout_price = ux_get_module_meta($module_post, 'module_lists_layout_price', $post_id);
											  $module_lists_layout_button = ux_get_module_meta($module_post, 'module_lists_layout_button', $post_id);
											  $module_lists_layout_to_link = ux_get_module_meta($module_post, 'module_lists_layout_to_link', $post_id);
											  $module_lists_layout_details = ux_get_module_meta($module_post, 'module_lists_layout_details', $post_id);
											  $module_lists_layout_progress = ux_get_module_meta($module_post, 'module_lists_layout_progress', $post_id);
                                              echo '<a href="#" class="btn lists_layout item_click" module_id="'. $module_id .'">'. __('Add','ux') .'</a>';
                                              echo '<div class="lists_rows">';
                                              
                                              if($module_id == 'price' || $module_id == 'progress_bar'){
												  $module_array = $module_lists_layout_title;
											  }else{
												  $module_array = $module_lists_layout_content;
											  }
											  
											  if($module_array){
                                                  $split_bullet      = explode("'%_%'", $module_lists_layout_bullet);
                                                  $split_title       = explode("'%_%'", $module_lists_layout_title);
                                                  $split_subtitle    = explode("'%_%'", $module_lists_layout_subtitle);
                                                  $split_content     = explode("'%_%'", $module_lists_layout_content);
												  $split_color       = explode("'%_%'", $module_lists_layout_color);
												  $split_price       = explode("'%_%'", $module_lists_layout_price);
												  $split_button      = explode("'%_%'", $module_lists_layout_button);
												  $split_button_link = explode("'%_%'", $module_lists_layout_to_link);
												  $split_details     = explode("'%_%'", $module_lists_layout_details);
												  $split_progress    = explode("'%_%'", $module_lists_layout_progress);
												  if($module_id == 'price' || $module_id == 'progress_bar'){
													  $split_array = $split_title;
												  }else{
													  $split_array = $split_content;
												  }
												  
                                                  $i=0;
                                                  for ($i=0; $i<count($split_array) - 1; $i++){
                                                      
                                                      if($module_id == 'accordion_toggle' || $module_id == 'tabs' || $module_id == 'price' || $module_id == 'progress_bar'){
                                                          $lists_item_title = $split_title[$i];
                                                          $lists_item_bullet = '';
														  
                                                      }else{
                                                          $lists_item_title = $split_content[$i];
                                                          $lists_item_bullet = $split_bullet[$i];
                                                          
                                                      }
                                                      ?>
                                                      <div class="lists_item" rel="<?php echo $i; ?>">
                                                          <a href="#"><i class="<?php echo $lists_item_bullet; ?>"></i> <?php echo $lists_item_title; ?></a>
                                                          <span class="lists_item_edit item_click" module_id="<?php echo $module_id; ?>"></span>
                                                          <span class="lists_item_close item_click" module_id="<?php echo $module_id; ?>"></span>
                                                          
                                                          <?php if($module_id == 'accordion_toggle' || $module_id == 'tabs'): ?>
                                                          <input name="module_lists_layout_title[]" type="hidden"  value="<?php echo $split_title[$i]; ?>" />
                                                          <textarea name="module_lists_layout_content[]" style="display:none;"><?php echo $split_content[$i]; ?></textarea>
                                                          <?php elseif($module_id == 'price'): ?>
                                                          <input name="module_lists_layout_color[]" type="hidden"  value="<?php echo $split_color[$i]; ?>" />
                                                          <input name="module_lists_layout_title[]" type="hidden" value="<?php echo $split_title[$i]; ?>" />
                                                          <input name="module_lists_layout_price[]" type="hidden" value="<?php echo $split_price[$i]; ?>" />
                                                          <input name="module_lists_layout_button[]" type="hidden" value="<?php echo $split_button[$i]; ?>" />
                                                          <input name="module_lists_layout_to_link[]" type="hidden" value="<?php echo $split_button_link[$i]; ?>" />
                                                          
                                                          <input name="module_lists_layout_details[]" type="hidden" value="<?php echo $split_details[$i]; ?>" />
                                                          <?php elseif($module_id == 'progress_bar'): ?>
                                                          <input name="module_lists_layout_color[]" type="hidden"  value="<?php echo $split_color[$i]; ?>" />
                                                          <input name="module_lists_layout_title[]" type="hidden" value="<?php echo $split_title[$i]; ?>" />
                                                          <input name="module_lists_layout_subtitle[]" type="hidden" value="<?php echo $split_subtitle[$i]; ?>" />
                                                          <input name="module_lists_layout_progress[]" type="hidden" value="<?php echo $split_progress[$i]; ?>" />
                                                          <?php else: ?>
                                                          <input name="module_lists_layout_bullet[]" type="hidden"  value="<?php echo $split_bullet[$i]; ?>" />
                                                          <input name="module_lists_layout_content[]" type="hidden" value="<?php echo $split_content[$i]; ?>" />
                                                          <?php endif; ?>
                                                      </div>
                                                  
                                                  
                                                  <?php }
                                              }else{
                                                  $i=0;
                                                  for ($i=0; $i<4; $i++){ ?>
                                                      <div class="lists_item" rel="<?php echo $i; ?>">
                                                          <a href="#"><i></i> <?php echo __('Item','ux'). ' '.$i; ?></a>
                                                          <span class="lists_item_edit item_click" module_id="<?php echo $module_id; ?>"></span>
                                                          <span class="lists_item_close item_click" module_id="<?php echo $module_id; ?>"></span>
                                                          <?php if($module_id == 'accordion_toggle' || $module_id == 'tabs'): ?>
                                                          <input name="module_lists_layout_title[]" type="hidden" value="<?php echo __('Item','ux'). ' '.$i; ?>" />
                                                          <textarea name="module_lists_layout_content[]" style="display:none;"></textarea>
                                                          <?php elseif($module_id == 'price'): ?>
                                                          <input name="module_lists_layout_color[]" type="hidden"  value="" />
                                                          <input name="module_lists_layout_title[]" type="hidden" value="<?php echo __('Item','ux'). ' '.$i; ?>" />
                                                          <input name="module_lists_layout_price[]" type="hidden" value="" />
                                                          <input name="module_lists_layout_button[]" type="hidden" value="" />
                                                          <input name="module_lists_layout_to_link[]" type="hidden" value="" />
                                                          <input name="module_lists_layout_details[]" type="hidden" value="" />
                                                          <?php elseif($module_id == 'progress_bar'): ?>
                                                          <input name="module_lists_layout_color[]" type="hidden"  value="" />
                                                          <input name="module_lists_layout_title[]" type="hidden" value="<?php echo __('Item','ux'). ' '.$i; ?>" />
                                                          <input name="module_lists_layout_subtitle[]" type="hidden" value="" />
                                                          <input name="module_lists_layout_progress[]" type="hidden" value="" />
                                                          <?php else: ?>
                                                          <input name="module_lists_layout_bullet[]" type="hidden" />
                                                          <input name="module_lists_layout_content[]" type="hidden" value="<?php echo __('Item','ux'). ' '.$i; ?>" />
                                                          <?php endif; ?>
                                                          
                                                      </div>
                                                  <?php }
                                              }
                                              echo '</div>';
                                          break;
                                          
                                          case 'switch':
                                              $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
											  $checked = ' checked="checked"';
                                              if($module_meta){
                                                  if($module_meta == 'false'){
                                                      $checked = '';
                                                  }
                                              }else{
												  if(isset($item['default'])){
													  $checked = '';
													  $module_meta = $item['default'];
												  }else{
													  $module_meta = 'true';
												  }
											  }
                                              ?>
                                              <div class="module_switch <?php echo $item['name'];?>" data-on="info" data-off="danger">
                                                  <input type="checkbox"<?php echo $checked; ?> />
                                              </div>
                                              <input type="hidden" name="<?php echo $item['name']; ?>" value="<?php echo $module_meta; ?>" />
                                          <?php
                                          break;
										  
										  case 'date':
											  $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id); ?>
                                              <input class="post_option_text_input span6 module_date_click item_click" name="<?php echo $item['name']; ?>" type="text" value="<?php echo $module_meta; ?>" />
										  <?php
										  break;
										  
										  case 'social':
											  global $option_social_networks;
											  $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
											  $module_meta_url = ux_get_module_meta($module_post, $item['name'].'_url', $post_id); ?>
                                              <?php if($module_meta){
                                                  foreach($module_meta as $i => $media){
                                                      $media_url = $module_meta_url[$i];
													  if($i == 0){
														  $social_style = 'module_item_add_btn module_item_add';
													  }else{
														  $social_style = 'module_item_remove_btn module_item_remove';
													  } ?>
                                                      <div class="row-fluid module-social-item">
                                                          <select class="span3" name="<?php echo $item['name']; ?>">
                                                              <?php foreach($option_social_networks as $social){
                                                                  $selected = false;
                                                                  if($media['value'] == $social['icon2']){
                                                                      $selected = ' selected="selected"';
                                                                  } ?>
                                                                  <option value="<?php echo $social['icon2']; ?>" <?php echo $selected; ?>><?php echo $social['name']; ?></option>
                                                              <?php }?>
                                                          </select>
                                                          <input class="post_option_text_input span6" name="<?php echo $item['name'].'_url'; ?>" type="text" value="<?php echo $media_url['value']; ?>" />
                                                          <div class="span2"><div class="<?php echo $social_style; ?> item_click"></div></div>
                                                      </div>
                                                  <?php
                                                  }
                                              }else{ ?>
                                                  <div class="row-fluid module-social-item">
                                                      <select class="span3" name="<?php echo $item['name']; ?>">
                                                          <?php foreach($option_social_networks as $social){ ?>
                                                              <option value="<?php echo $social['icon2']; ?>"><?php echo $social['name']; ?></option>
                                                          <?php }?>
                                                      </select>
                                                      <input class="post_option_text_input span6" name="<?php echo $item['name'].'_url'; ?>" type="text" value="" />
                                                      <div class="span2"><div class="module_item_add_btn module_item_add item_click"></div></div>
                                                  </div>
                                              <?php } ?>
										  <?php
										  break;
										  
										  case 'media':
											  $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
											  echo '<p><a href="#" class="btn image_media_add item_click" module_id="'. $module_id .'">'. __('Add Image','ux') .'</a></p>';
                                              echo '<input type="hidden" name="'.$item['name'].'" value="'.$module_meta.'" />';
                                              echo '<img src="'.$module_meta.'" style="max-width:55%" />';
										  break;
                                          
                                          case 'image':
                                              $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
											  
											  $meta_url = explode('__',$module_meta);
											  
											  $meta_array = array();
											  if(isset($meta_url[0])){
												  $meta_array = explode('-',$meta_url[0]);
											  }
											  
											  $img_src = '';
											  if(isset($meta_url[1])){
												 $img_src = $meta_url[1];
											  }
                                              echo '<p><a href="#" class="btn image_single_add item_click" module_id="'. $module_id .'">'. __('Add Image','ux') .'</a></p>';
                                              echo '<input type="hidden" name="'.$item['name'].'" value="'.$module_meta.'" />';
                                              echo '<img src="'.$img_src.'" style="max-width:95%" />';
                                          break;
                                          
                                          case 'cheak':
                                              $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
                                              $split_meta = explode("'%_%'",$module_meta);
											  $cheak_array = $type['item'][$item['name']];
											  if(isset($item['option_in'])){
												  $cheak_array = array();
												  foreach($item['option_in'] as $option_in){
													  foreach($type['item'][$item['name']] as $type_item){
														  if($type_item['value'] == $option_in){
															  array_push($cheak_array, $type_item);
														  }
													  }
												  }
											  }
											  
                                              echo '<ul class="module_cheak_list">';
                                              foreach($cheak_array as $num => $type_item):
                                                  if(in_array($type_item['value'], $split_meta)){
                                                      $checked = ' checked="checked"';
                                                  }else{
                                                      $checked = '';
                                                  }
                                              
                                              ?>
                                                  <li>
                                                  <input type="checkbox" class="module_checkbox" name="<?php echo $item['name']; ?>[]" id="module_cheak_<?php echo $type_item['value']; ?>" value="<?php echo $type_item['value']; ?>" <?php echo $checked; ?>>
                                                  <label for="module_cheak_<?php echo $type_item['value']; ?>"><?php echo $type_item['title']; ?></label>
                                                  </li>
                                              <?php 
                                              endforeach;
                                              echo '</ul>';
                                          break;	
										  
										  case 'image_select':
											  $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
											  if(isset($type['item'][$item['name']])): ?>
                                                  <ul class="nav nav-pills select_icon_mask">
													  <?php foreach($type['item'][$item['name']] as $num => $type_item):
                                                          $mask_style = false;
														  $mask_current = false;
														  switch($type_item['value']){
															  case 'circle': $mask_style = 'mask_circle'; break;
															  case 'triangle': $mask_style = 'mask_triangle'; break;
															  case 'rounded_square': $mask_style = 'mask_rounded_square'; break;
															  case 'diamond': $mask_style = 'mask_diamond'; break;
															  case 'star': $mask_style = 'mask_star'; break;
														  }
														  if($module_meta){
                                                              if($module_meta == $type_item['value']){
                                                                  $mask_current = 'current';
                                                              }
                                                          } ?>
                                                          <li><a href="#" class="mask_icon module_mask item_click <?php echo $mask_style; ?> <?php echo $mask_current; ?>" data-mask="<?php echo $type_item['value']; ?>"><span class="choosed"></span></a></li>
													  <?php endforeach; ?>
                                                  </ul>
                                                  <input type="hidden" name="<?php echo $item['name']; ?>" value="<?php echo $module_meta; ?>" />
											  <?php 
											  endif;
										  break;
                                                                          
                                          case 'select':
										      $module_meta = ux_get_module_meta($module_post, $item['name'], $post_id);
											  echo '<select name="'.$item['name'].'" class="item_change">';
                                              if($item['name'] == 'module_select_category'){
												  echo '<option value="0-1">'. __('Select a category', 'ux') .'</option>';
                                                  if(isset($item['post_type'])){
													  $categories = get_categories('type='.$item['post_type'].'&taxonomy='.$item['post_type_cat']);
													  foreach($categories as $cate):
														  if($module_meta){
															  if($module_meta == $cate->slug){
																  $selected = ' selected="selected"';
															  }else{
																  $selected = '';
															  }
														  }else{
															  $selected = '';
														  }
													  
													  ?>
														  <option value="<?php echo $cate->slug; ?>"<?php echo $selected; ?>><?php echo $cate->name; ?></option>
													  <?php 
													  endforeach;
													  
												  }else{
													  $categories = get_categories();
													  foreach($categories as $cate):
														  if($module_meta){
															  if($module_meta == $cate->slug){
																  $selected = ' selected="selected"';
															  }else{
																  $selected = '';
															  }
														  }else{
															  $selected = '';
														  }
													  
													  ?>
														  <option value="<?php echo $cate->slug; ?>"<?php echo $selected; ?>><?php echo $cate->name; ?></option>
													  <?php 
													  endforeach;
												  }
                                              }elseif($item['name'] == 'module_select_button_style' || $item['name'] == 'module_select_color'){
												  global $theme_color;
												  foreach($theme_color as $i => $color):
													  if($module_meta){
                                                          if($module_meta == $i){
                                                              $selected = ' selected="selected"';
                                                          }else{
                                                              $selected = '';
                                                          }
                                                      }else{
                                                          $selected = '';
                                                      }
													  if($color['title'] != ''){
														  $color_title = $color['title'];
													  }else{
														  $color_title = $color['value'];
													  }
													  ?>
													  <option value="<?php echo $i; ?>"<?php echo $selected; ?>><?php echo $color_title; ?></option>
												
												  <?php 
												  endforeach;
											  }elseif($item['name'] == 'module_select_revolution_slider'){
												  global $wpdb;
												  $table_revslider = $wpdb->prefix . "revslider_sliders";
												  
												  $wpdb->hide_errors();
												  $sliders = $wpdb->get_results( "SELECT * FROM $table_revslider ORDER BY id ASC" );
												  if(count($sliders)){
													  foreach($sliders as $num => $slider):
														  if($module_meta){
															  if($module_meta == $slider->alias){
																  $selected = ' selected="selected"';
															  }else{
																  $selected = '';
															  }
														  }else{
															  $selected = '';
														  }
													  
													  ?>
														  <option value="<?php echo $slider->alias; ?>"<?php echo $selected; ?>><?php echo $slider->title; ?></option>
													  <?php 
													  endforeach;
												  }
											  
											  }elseif($item['name'] == 'module_select_layer_slider'){
												  global $wpdb;
												  $table_layerslider = $wpdb->prefix . "layerslider";
												  
												  $sliders = $wpdb->get_results( "SELECT * FROM $table_layerslider
																	WHERE flag_hidden = '0' AND flag_deleted = '0'
																	ORDER BY id ASC" );
																	
												  foreach($sliders as $num => $slider):
                                                      $name = empty($slider->name) ? 'Unnamed' : $slider->name;
													  if($module_meta){
                                                          if($module_meta == $slider->id){
                                                              $selected = ' selected="selected"';
                                                          }else{
                                                              $selected = '';
                                                          }
                                                      }else{
                                                          $selected = '';
                                                      }
                                                  
                                                  ?>
                                                      <option value="<?php echo $slider->id; ?>"<?php echo $selected; ?>><?php echo $name; ?></option>
                                                  <?php 
                                                  endforeach;
												  
											  }elseif($item['name'] == 'module_select_contact_form_7_alias'){
												  $get_cf7 = get_posts(array(
													  'posts_per_page' => -1,
													  'post_type' => 'wpcf7_contact_form'
												  ));
												  if($get_cf7){
													  foreach($get_cf7 as $cf7){
														  $selected = false;
														  if($module_meta){
															  if($module_meta == $cf7->ID){
																  $selected = ' selected="selected"';
															  }
														  }?>
														  <option value="<?php echo $cf7->ID; ?>"<?php echo $selected; ?>><?php echo get_the_title($cf7->ID); ?></option>
													  <?php
                                                      }
												  }
												  
											  }else{
												  if(isset($type['item'][$item['name']])){
													  $select_array = $type['item'][$item['name']];
												  }elseif($item['name'] == 'module_select_count_to'){
													  $select_array = $type['item']['module_select_count_start'];
												  }
												  
												  foreach($select_array as $num => $type_item):
                                                      $selected = false;
													  if($module_meta){
                                                          if($module_meta == $type_item['value']){
                                                              $selected = ' selected="selected"';
                                                          }
                                                      }else{
														  if(isset($item['default'])){
															  if($item['default'] == $type_item['value']){
																  $selected = ' selected="selected"';
															  }
														  }
                                                      }
													  
													  $option = true;
													  if($type_item['value'] == 'contact_form_7'){
														  if(!class_exists('WPCF7_ContactForm')){
															  $option = false;
														  }
													  }elseif($type_item['value'] == 'layerslider'){
														  if(!is_plugin_active('LayerSlider/layerslider.php')){
															  $option = false;
														  }
													  }elseif($type_item['value'] == 'revolutionslider'){
														  if(!is_plugin_active('revslider/revslider.php')){
															  $option = false;
														  }
													  }
													  if($option){ ?>
                                                          <option value="<?php echo $type_item['value']; ?>"<?php echo $selected; ?>><?php echo $type_item['title']; ?></option>
													  <?php }
                                                  endforeach;
                                              }
                                              echo '</select>';
                                              
                                              if($item['name'] == 'module_select_orderby'){
                                                  echo '<select name="module_select_order" class="item_change">';
                                                  foreach($type['item']['module_select_order'] as $type_item):
                                                      $module_meta = ux_get_module_meta($module_post, 'module_select_order', $post_id);
                                                      if($module_meta){
                                                          if($module_meta == $type_item['value']){
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
                                                  
                                              }elseif($item['name'] == 'module_select_video_ratio'){
												  $module_select_video_ratio_custom = ux_get_module_meta($module_post, 'module_select_video_ratio_custom', $post_id);
												  $split_ratio_custom = explode("'%_%'",$module_select_video_ratio_custom);
												  
												  if(isset($split_ratio_custom[0])){
													  $key_1 = $split_ratio_custom[0];
												  }else{
													  $key_1 = '';
												  }
												  
												  if(isset($split_ratio_custom[1])){
													  $key_2 = $split_ratio_custom[1];
												  }else{
													  $key_2 = '';
												  }
												  ?>
												  <div class="row-fluid module_select_video_ratio_custom">
                                                      <input name="module_select_video_ratio_custom[]" class="module_text_input span2" type="text" value="<?php echo $key_1; ?>" />
                                                      <div class="ratio_custom">:</div>
                                                      <input name="module_select_video_ratio_custom[]" class="module_text_input span2" type="text" value="<?php echo $key_2; ?>" />
                                                  
                                                  </div>
												
											  <?php  
											  }
                                          
                                          break;
                                          
                                      }
                                      
                                  }
                                  
                              }
                              
                              ?>
                              </div>
                        </div>
                    </div>
                    
                <?php endif; ?>
           <?php endforeach;
        }
    }
    
	if($module_id == 'text_block' || $module_id == 'icon_box' || $module_id == 'accordion_toggle' || $module_id == 'tabs'): ?>
		<div class="ajax_module_post_content">
			<?php $module_content = ux_get_module_meta($module_post, 'module_content', $post_id); ?>
			<?php echo $module_content; ?>
        </div>
		
	<?php
	endif;
	
	die("");
	
	
}
add_action('wp_ajax_CustomPagebuilderAjaxModule', 'CustomPagebuilderAjaxModule');
?>