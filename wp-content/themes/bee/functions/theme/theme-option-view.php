<div class="wrap">
	<div class="icon32" id="icon-themes"><br></div>
	<h2>
		<?php _e('Theme Option', 'ux') ?>
	</h2>
    
    <?php if(isset($_GET['message'])): ?>
		<?php if($_GET['message'] == 'restore'): ?>
        <div id="restore-defaults-msg">
            <div class="updated below-h2"><p><?php _e('Restore Defaults', 'ux') ?></p></div>
        </div>
        <?php endif; ?>
    <?php endif; ?>

	<div class="row-fluid theme-option-wrap">
        <?php global $theme_option_setting, $theme_option_fields, $theme_google_fonts, $theme_font_size, $theme_font_style; ?>
        <?php if(count($theme_option_setting) != 0): ?>
        <ul class="nav nav-tabs">
            <?php foreach($theme_option_setting as $num => $setting): ?>
			<?php if($num == 0): $active = 'active'; else: $active = ''; endif; ?>
            <li class="<?php echo $active; ?>"><a href="#setting_<?php echo $setting['id']; ?>" data-toggle="tab"><?php echo $setting['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
 
        <div class="tab-content">
            <?php foreach($theme_option_setting as $num => $setting): ?>
            <?php if($num == 0): $active = 'active'; else: $active = ''; endif; ?>
            <div class="tab-pane <?php echo $active; ?>" id="setting_<?php echo $setting['id']; ?>">
				 <?php foreach($setting['item'] as $i => $items): ?>
                 <?php if($i != 0): $border = 'border-top:1px dotted #ccc;'; else: $border = ''; endif; ?>
                 <div class="theme-option-item" style=" <?php echo $border; ?>">
                     <h1><?php echo $items['name']; ?></h1>
                     <div class="clearfix"></div>
                     
                     <?php foreach($items['item'] as $item): ?>
						 <?php 
						 $option = get_option($item['name']);
						 if($option == false){
							 $option = $item['default'];
						 }
						 
						 ?>
						 <?php
						 if($item['name'] == 'theme_option_social_medias'){
							 $theme_option_switch_show_social = get_option('theme_option_switch_show_social');
							 if($theme_option_switch_show_social == 'false'){
								 $display_option = 'display:none;';
							 }else{
								 $display_option = '';
							 }
						 }else{
							 $display_option = '';
						 }?>
						 
						 <?php if($item['title'] != ''): ?>
                         
							 <?php if($item['name'] == 'theme_option_cheak_text_logo'): ?>
                             <?php elseif($item['name'] == 'theme_option_button_import_demo_data'): ?>
                             <?php elseif($item['name'] == 'theme_option_button_export_current_data'): ?>
                             <?php elseif($item['name'] == 'theme_option_button_import_my_saved'): ?>
                             <?php elseif($item['type'] != 'color'): ?>
                             
                             <h3 data-name="<?php echo $item['name']; ?>" style=" <?php echo $display_option; ?>"><?php echo $item['title']; ?></h3>
                             <?php endif; ?>
                         
                         <?php endif; ?>
                         
                         <div class="row-fluid" data-name="<?php echo $item['name']; ?>" style=" <?php echo $display_option; ?>">
                             <?php if($item['type'] == 'image_select'): ?>
                             <div class="span12">
								 <?php foreach($theme_option_fields as $field):
									 if($field['id'] == $item['type']):
										 if(count($field['item'][$item['name']]) != 0):?>
											 <?php foreach($field['item'][$item['name']] as $type_item): 
												 if($option){
													 if($option == $type_item['value']){
														 $image_select_style = 'display:block;';
													 }else{
														 $image_select_style = 'display:none;';
													 } 
												 }else{
													 $image_select_style = 'display:none;';
												 }
												 if($item['name'] == 'theme_option_select_color_scheme'):?>
                                             
                                                 <div class="option_image_select color_scheme bg-<?php echo $type_item['value']; ?>" data-option="<?php echo $item['name']; ?>"  data-value="<?php echo $type_item['value']; ?>">
                                                     <div class="checked_btn" style=" <?php echo $image_select_style; ?>"></div>
                                                 </div>
                                                 
                                                 <?php else: ?>
                                                 
                                                 <div id="<?php echo $type_item['value']; ?>" data-option="<?php echo $item['name']; ?>" class="option_image_select" data-value="<?php echo $type_item['value']; ?>">
                                                     <div class="checked_btn" style=" <?php echo $image_select_style; ?>"></div>
                                                 </div>
                                                 
                                                 <?php endif; ?>
                                             
                                             <?php endforeach; ?>
										 <?php
										 endif;
                                     endif;
                                 endforeach; ?>
                                 <input type="hidden" name="<?php echo $item['name']; ?>" value="<?php echo $option; ?>" />
                             </div>
                             <?php if($item['name'] == 'theme_option_select_color_scheme'):?>
								 <?php _e('or configure your custom color','ux'); ?>
							 <?php endif; ?>
                             <?php else: ?>
                             
                             <div class="span6">
								 <?php switch($item['type']){
                                     case 'select_front':
										 $get_pages = get_pages();
										 $show_on_front = get_option('show_on_front');
										 $page_on_front = get_option('page_on_front');
										 if($show_on_front == 'page'){
											 $option = $page_on_front;
										 }
										 ?>
                                         <select name="<?php echo $item['name']; ?>" class="span10">
                                             <option value="-1"><?php _e('Homepage','ux') ?></option>
                                             
                                             <?php foreach($get_pages as $page): ?>
                                             <?php
                                             if($option == $page->ID){
												 $selected = ' selected="selected"';
											 }else{
												 $selected = '';
											 }?>
                                             
                                             <option value="<?php echo $page->ID; ?>" <?php echo $selected; ?>><?php echo $page->post_title; ?></option>
                                             
                                             <?php endforeach; ?>
                                         </select>
                                     <?php
									 break;
									 
									 case 'upload':
										 ?>
                                         <input type="text" class="post_option_text_input span10" name="<?php echo $item['name']; ?>" value="<?php echo $option; ?>" />
                                         <div class="clearfix"></div>
                                         <p class="controls">
                                             <input type="button" class="btn option_upload_image" value="<?php _e('Upload Image','ux') ?>" />
                                             <input type="button" class="btn btn-danger option_remove_image" value="<?php _e('Remove','ux') ?>" />
                                         </p>
                                     <?php
									 break;
									 
									 case 'cheak': 
										 $theme_option_cheak_text_logo_content = get_option('theme_option_cheak_text_logo_content');
										 
										 if($theme_option_cheak_text_logo_content){
											 $text_logo = $theme_option_cheak_text_logo_content;
										 }else{
											 $text_logo = $item['default_text'];
										 }
										 
										 if($option == 'true'){
											 $checked = ' checked="checked"';
										 }else{
											 $checked = '';
										 }
										 ?>
                                         <?php if($item['name'] == 'theme_option_cheak_text_logo'): ?>
                                         <label class="checkbox">
                                             <h3><input type="checkbox" class="option_cheakbox" name="<?php echo $item['name']; ?>" <?php echo $checked; ?>> <?php echo $item['title']; ?></h3>
                                         </label>
                                         <input type="text" name="theme_option_cheak_text_logo_content" placeholder="<?php echo $item['placeholder']; ?>" class="post_option_text_input cheak_text_logo span10" value="<?php echo $text_logo; ?>" />
                                         
                                         <?php endif; ?>
									 <?php
									 break;
									 
									 case 'input':
										 ?>
                                         <input type="text" name="<?php echo $item['name']; ?>" placeholder="<?php echo $item['placeholder']; ?>" class="post_option_text_input cheak_text_logo span10" value="<?php echo $option; ?>" />
									 <?php
									 break;
									 
									 case 'textarea':
										 if($item['name'] == 'theme_option_textarea_track_code'){
											 $option = str_replace('\"','"',str_replace("\'","'",$option));
										 }
										 ?>
                                         <textarea rows="4" class="span10" name="<?php echo $item['name']; ?>"><?php echo $option; ?></textarea>
                                     <?php
									 break;
									 
									 case 'button':
										 $button_style = false;
										 $demo_data = false;
										 if($item['name'] == 'theme_option_button_import_demo_data'){
											 $file = '../wp-content/themes/'.get_stylesheet().'/functions/theme/demo-data.xml';
											 $button_style = 'btn-info';
											 $demo_data = 'data-xml="'.$file.'" data-attachments="1"';
											 wp_nonce_field( 'import-wordpress' );
										 } ?>
										 <p><a href="<?php echo $item['url']; ?>" class="option_button btn <?php echo $button_style; ?> <?php echo $item['name']; ?>" <?php echo $demo_data; ?>><?php echo $item['title']; ?></a></p>
                                         <?php
									 break;
									 
									 case 'select':
										 foreach($theme_option_fields as $field):
											 if($field['id'] == $item['type']):  ?>
                                                 <select name="<?php echo $item['name']; ?>" class="span10">
													 <?php foreach($field['item'][$item['name']] as $num => $type_item): ?>
                                                     <?php
													 if($option == $type_item['value']){
														 $selected = ' selected="selected"';
													 }else{
														 $selected = '';
													 }?>
                                                     <option value="<?php echo $type_item['value']; ?>" <?php echo $selected; ?>><?php echo $type_item['title']; ?></option>
                                                     <?php endforeach; ?>
                                                 </select>
											 <?php
                                             endif;
										 endforeach;
									 break;
									 
									 case 'switch':
										 if($option == 'true'){
											 $checked = ' checked="checked"';
										 }else{
											 $checked = '';
										 }
										 ?>
                                         <div class="option_switch <?php echo $item['name'];?>" data-on="info" data-off="danger">
                                             <input type="checkbox" <?php echo $checked; ?> />
                                         </div>
                                         <input type="hidden" name="<?php echo $item['name']; ?>" value="<?php echo $option; ?>" />
									 <?php
                                     break;
									 
									 case 'color':
										 ?>
									     <h3 class="span7 color_title_h3"><?php echo $item['title']; ?></h3>
                                         <div class="span1"><div class="option_remove_color post_option_remove_btn"></div></div>
                                         <label class="span4">
                                             <input type="text" class="span5 option_color_switch" name="<?php echo $item['name']; ?>" value="<?php echo $option; ?>" />
											 <?php /*?><input type="text" class="span9 option_color_switch" value="<?php echo $option; ?>" name="<?php echo $item['name']; ?>">
                                             <div class="option_color_bg" style="background-color: <?php echo $option; ?>"></div><?php */?>
                                         </label>
                                     <?php
									 break;
									 
									 case 'social':
										 global $option_social_networks;
										 $theme_option_social_medias = get_option('theme_option_social_medias'); 
										 $theme_option_social_tomedias_url = get_option('theme_option_social_tomedias_url'); 
										 $split_medias = explode("\'%_%\'",$theme_option_social_medias);
										 $split_medias_url = explode("\'%_%\'",$theme_option_social_tomedias_url);
										 if($theme_option_social_medias){
											 for($i=0; $i<count($split_medias) - 1; $i++){
												 if($i == 0){
													 $option_social_button = 'post_option_add_btn option_social_add';
												 }else{
													 $option_social_button = 'post_option_remove_btn option_social_remove';
												 }
												 
												 ?>
												 <div class="row-fluid">
													 <select class="span3" name="<?php echo $item['name']; ?>[]">
														 <?php foreach($option_social_networks as $social){
															 if($theme_option_social_medias){
																 if($split_medias[$i] == $social['icon']){
																	 $selected = ' selected="selected"';
																 }else{
																	 $selected = '';
																 }
															 }else{
																 $selected = '';
															 }
															
															 echo '<option value="'.$social['icon'].'" '.$selected.'>'.$social['name'].'</option>';
														
														 }?>
													 </select>
													 <input class="post_option_text_input span6" name="theme_option_social_tomedias_url[]" type="text" value="<?php echo $split_medias_url[$i]; ?>" />
													 <div class="span2"><div class="<?php echo $option_social_button; ?>"></div></div>
												
												 </div>
											 <?php
											 }
										 }else{ ?>
											<div class="row-fluid">
                                               <select class="span3" name="<?php echo $item['name']; ?>[]">
                                                   <?php foreach($option_social_networks as $social){
                                                       echo '<option value="'.$social['icon'].'">'.$social['name'].'</option>';
												   }?>
                                               </select>
                                               <input class="post_option_text_input span6" name="theme_option_social_tomedias_url[]" type="text" value="" />
                                               <div class="span2"><div class="post_option_add_btn option_social_add"></div></div>
                                          
                                           </div>
										 <?php
										 }
									 break;
									 
									 case 'fonts':
										 $font_family = get_option($item['name'].'-family');
										 $font_size = get_option($item['name'].'-size');
										 $font_style = get_option($item['name'].'-style');
										 
										 if($font_family == false){
											 $font_family = $item['default']['family'];
										 }
										 if($font_size == false){
											 $font_size = $item['default']['size'];
										 }
										 if($font_style == false){
											 $font_style = $item['default']['style'];
										 }
										 ?>
                                         <?php if($item['font']): ?>
                                         <select name="<?php echo $item['name']; ?>-family" class="span5 font-select">
											 <?php foreach($theme_google_fonts as $id => $font): ?>
                                             <?php
											 if($font_family == $id){
												 $selected = ' selected="selected"';
											 }else{
												 $selected = '';
											 }?>
                                             <option data-fonturl="<?php echo $font['url']; ?>" value="<?php echo $id; ?>" <?php echo $selected; ?>><?php echo $font['name']; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                         <?php endif; ?>
                                         
                                         <?php if($item['style']): ?>
                                         <select name="<?php echo $item['name']; ?>-size" class="span2">
											 <?php foreach($theme_font_size as $id => $size): ?>
                                             <?php
											 if($font_size == $size){
												 $selected = ' selected="selected"';
											 }else{
												 $selected = '';
											 }?>
                                             <option value="<?php echo $size; ?>" <?php echo $selected; ?>><?php echo $size; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                         
                                         <select name="<?php echo $item['name']; ?>-style" class="span3">
											 <?php foreach($theme_font_style as $id => $style): ?>
                                             <?php
											 if($font_style == $style['value']){
												 $selected = ' selected="selected"';
											 }else{
												 $selected = '';
											 }?>
                                             <option value="<?php echo $style['value']; ?>" <?php echo $selected; ?>><?php echo $style['title']; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                         <?php endif; ?>
									 <?php
                                     break;
                                 }?>
                             
                             </div>
                             <div class="span6">
                                 <div class="theme-option-description"><?php echo $item['description']; ?></div>
                             </div>
                                 
                             <?php endif; ?>
                         </div>
                         
                     <?php endforeach; ?>
                 </div>
                 <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
            <div class="theme-option-save">
                <button class="btn pull-left theme-option-restore-btn" type="button"><?php _e('Restore Defaults', 'ux') ?></button>
                <button class="btn pull-right btn-primary theme-option-save-btn" type="button"><?php _e('Save Options', 'ux') ?></button>
                <div class="loading"></div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <script type="text/javascript">
	jQuery(document).ready(function() {
		
		//Google font preview
		jQuery('.font-select').each(function(){
		
			var 
			current_font_url = jQuery(this).find('option:selected').data('fonturl'),
			current_font     = jQuery(this).find('option:selected').text();
			jQuery('head').append('<link href="'+current_font_url+'" rel="stylesheet" type="text/css">');
			jQuery(this).parent('.span6').siblings('.span6').find('.theme-option-description').css("font-family",current_font);
		
			jQuery(this).live('change', function(){
				
				var 
				current_font_url_change = jQuery(this).find('option:selected').data('fonturl'),
				current_font_change     = jQuery(this).find('option:selected').text();
				jQuery('head').append('<link href="'+current_font_url_change+'" rel="stylesheet" type="text/css">');
				jQuery(this).parent('.span6').siblings('.span6').find('.theme-option-description').css("font-family",current_font_change);
			
			});
		
		});//End font each
	
		jQuery('.option_switch')['bootstrapSwitch']();
		jQuery('.option_upload_image').click(function(){
			var this_parent = jQuery(this).parent().parent(),
				fileInput = this_parent.find('.post_option_text_input'),
				option_win = jQuery('#showOptionUploadWindow'),
				winoption_save = jQuery('.winoption_save');
				winoption_iframe = jQuery('.winoption_iframe');
				
			option_win.modal('show');
			winoption_iframe.html('<iframe width="100%" height="100%" frameborder="0" src="media-upload.php?type=image"></iframe>');
			winoption_save.attr('data-name',fileInput.attr('name'));
			
			window.original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html){
		
				if (fileInput) {
					
					fileurl = jQuery('img',html).attr('src');
					
					fileInput.val(fileurl);
					
					tb_remove();
		
				} else {
					window.original_send_to_editor(html);
				}
				
				option_win.modal('hide');
				winoption_iframe.html('');
				winoption_save.attr('data-name','');
			}
			
			return false;
		});
		
		jQuery('.option_remove_image').click(function(){
			var this_parent = jQuery(this).parent().parent(),
				fileInput = this_parent.find('.post_option_text_input');
				
				fileInput.val('');
			
		});
		
		jQuery('.option_image_select').click(function(){
			var option = jQuery(this).data('option'),
				value = jQuery(this).data('value'),
				_this = jQuery('.option_image_select[data-option='+option+']');
				
			_this.find('.checked_btn').hide();
			jQuery(this).find('.checked_btn').fadeIn();
			jQuery('[name='+option+']').val(value);
			
			//if(jQuery(this).is('.color_scheme')){
//				jQuery('[name=theme_option_color_theme_main]').val('');
//				jQuery('[name=theme_option_color_theme_main]').next().css({'background-color':''});
//			}
		});
		
		if(jQuery('.option_color_switch').length > 0){
			jQuery('.option_color_switch').each(function(index, element) {
                //jQuery(this).colorpicker().on('changeColor', function(ev){
//					jQuery(this).next('.option_color_bg').css({'background-color':ev.color.toHex()});
//				});
				var color = jQuery(this).val();
				
				if(color == ''){
					color = '#ffffff';
				}
				
				jQuery(this).spectrum({
					showInitial: true,
					preferredFormat: "hex",
					color: color
				});
				jQuery(this).show();

            });
			
			if(jQuery('.option_remove_color').length > 0){
				jQuery('.option_remove_color').each(function(index, element) {
                    jQuery(this).click(function(){
						jQuery(this).parent().next().find('.option_color_switch').val('');
						jQuery(this).parent().next().find('.sp-replacer .sp-preview-inner').css({'background-color':'#ffffff'});
						
					});
                });
			}
		}
		
		function theme_option_form_array(key){
			var arr = '';
			var fields = jQuery('[name*='+key+']').serializeArray();
			jQuery.each(fields, function(i, field){
				arr += field.value + "'%_%'";
			});
			return arr;
			
		}
		
		function option_social_remove(){
			jQuery('.option_social_remove').click(function(){
				jQuery(this).parent().parent().remove();
				
			});
		}
		option_social_remove();
		
		jQuery('.option_social_add').click(function(){
			var parent = jQuery(this).parent().parent().parent();
				
			parent.append('<div class="row-fluid"><select class="span3" name="theme_option_social_medias[]"><?php foreach($option_social_networks as $social):?><option value="<?php echo $social["icon"]; ?>"><?php echo $social["name"]; ?></option><?php endforeach; ?></select><input class="post_option_text_input span6" name="theme_option_social_tomedias_url[]" type="text" value="" /><div class="span2"><div class="post_option_remove_btn option_social_remove"></div></div></div>');
			option_social_remove();
			
		});
		
		
		function theme_set_value(name){
			var item_name = jQuery('.theme-option-item [name='+name+']');
			
			if(item_name.is('[type=checkbox]')){
				if(item_name.is(':checked')){
					value = true;
				}else{
					value = false;
				}
			}else{
				value = item_name.val();
			}
			
			return value;
		}
		
		jQuery('.theme-option-restore-btn').click(function(){
			jQuery.post(ajaxurl, {
				'action':'CustomThemeOptionAjax',
				'data': {
					  'mode': 'restore'
				}
			}).done(function(content){
				window.location.href="admin.php?page=themeoption&message=restore"
			});
			
		});
		
		function theme_import_demo_data(el){
			el.live('click',function(){
				var _this = jQuery(this);
				var _this_xml = _this.data('xml');
				var _this_attachments = _this.data('attachments');
				var _wpnonce = _this.parent().parent().find('[name=_wpnonce]').val();
				var _wp_http_referer = _this.parent().parent().find('[name=_wp_http_referer]').val();
				
				if(!_this.hasClass('processing')){
					_this.addClass('processing');
					_this.addClass('disabled');
					_this.html("<?php _e("Loading data, don't close the page pls", 'ux'); ?>");

					jQuery.post('<?php echo admin_url('admin.php?import=wordpress&step=2', 'http'); ?>',{
						'xml'               : _this_xml,
						'fetch_attachments' : _this_attachments,
						'_wpnonce'          : _wpnonce,
						'_wp_http_referer'  : _wp_http_referer
					}).done(function(content){
						var wpbody_content = jQuery('#wpbody-content .wrap',content);
						var ux_import_content = jQuery('#ux_import_content',content);
						
						if(wpbody_content.find('a[href="<?php echo admin_url(); ?>"]').length > 0){
							_this.removeClass('disabled');
							_this.removeClass('btn-info');
							_this.addClass('btn-success');
							_this.html("<?php _e("Successfully imported!", 'ux'); ?>");
						}else{
							_this.removeClass('disabled');
							_this.removeClass('btn-info');
							_this.addClass('btn-danger');
							_this.html("<?php _e("Not successfully!", 'ux'); ?>");
							setTimeout(function(){
								_this.removeClass('processing');
								_this.removeClass('btn-danger');
								_this.addClass('btn-info');
								_this.html("<?php _e("Import Demo Data", 'ux'); ?>");
							},2000)
						}
						
					});
				}
				el.die('click');
				theme_import_demo_data(jQuery('.theme_option_button_import_demo_data'));
				return false;
			});
		}
		theme_import_demo_data(jQuery('.theme_option_button_import_demo_data'));
		
		
		function theme_option_save(){
			
			jQuery('.theme-option-save-btn').click(function(){
				
				jQuery('.theme-option-save .loading').fadeIn(300);
				
				jQuery.post(ajaxurl, {
					'action':'CustomThemeOptionAjax',
					'data': {
						  'mode': 'save',
						  'theme_option_meta': {
							  'theme_option_select_front_page' : theme_set_value('theme_option_select_front_page'),
							  'theme_option_cheak_text_logo' : theme_set_value('theme_option_cheak_text_logo'),
							  'theme_option_cheak_text_logo_content' : theme_set_value('theme_option_cheak_text_logo_content'),
							  'theme_option_upload_custom_logo' : theme_set_value('theme_option_upload_custom_logo'),
							  'theme_option_upload_custom_retina_logo' : theme_set_value('theme_option_upload_custom_retina_logo'),
							  'theme_option_logo_width' : theme_set_value('theme_option_logo_width'),
							  'theme_option_input_copyright' : theme_set_value('theme_option_input_copyright'),
							  'theme_option_textarea_track_code' : theme_set_value('theme_option_textarea_track_code'),
							  'theme_option_textarea_custom_css' : theme_set_value('theme_option_textarea_custom_css'),
							  'theme_option_upload_custom_favicon' : theme_set_value('theme_option_upload_custom_favicon'),
							  'theme_option_upload_mobile_icon' : theme_set_value('theme_option_upload_mobile_icon'),
							  'theme_option_select_website_layout' : theme_set_value('theme_option_select_website_layout'),
							  'theme_option_select_header_layout' : theme_set_value('theme_option_select_header_layout'),
							  'theme_option_switch_wpml' : theme_set_value('theme_option_switch_wpml'),
							  'theme_option_topbar_fixed' : theme_set_value('theme_option_topbar_fixed'),
							  'theme_option_switch_show_back_top' : theme_set_value('theme_option_switch_show_back_top'),
							  'theme_option_switch_show_search' : theme_set_value('theme_option_switch_show_search'),
							  'theme_option_textarea_header_info' : theme_set_value('theme_option_textarea_header_info'),
							  'theme_option_switch_show_social' : theme_set_value('theme_option_switch_show_social'),
							  'theme_option_switch_show_social_share' : theme_set_value('theme_option_switch_show_social_share'),
							  'theme_option_social_medias' : theme_option_form_array('theme_option_social_medias'),
							  'theme_option_social_tomedias_url' : theme_option_form_array('theme_option_social_tomedias_url'),
							  'theme_option_color_theme_main' : theme_set_value('theme_option_color_theme_main'),
							  'theme_option_select_color_scheme' : theme_set_value('theme_option_select_color_scheme'),
							  'theme_option_auxiliary_first_color' : theme_set_value('theme_option_auxiliary_first_color'),
							  'theme_option_auxiliary_second_color' : theme_set_value('theme_option_auxiliary_second_color'),
							  'theme_option_color_title' : theme_set_value('theme_option_color_title'),
							  'theme_option_color_content_text' : theme_set_value('theme_option_color_content_text'),
							  'theme_option_color_auxiliary_content' : theme_set_value('theme_option_color_auxiliary_content'),
							  'theme_option_color_selected_text_bg' : theme_set_value('theme_option_color_selected_text_bg'),
							  'theme_option_color_hyperlinks' : theme_set_value('theme_option_color_hyperlinks'),
							  
							  'theme_option_color_page_bg' : theme_set_value('theme_option_color_page_bg'),
							  'theme_option_color_boxed_layout_bg' : theme_set_value('theme_option_color_boxed_layout_bg'),
							  'theme_option_upload_boxed_layout_bg' : theme_set_value('theme_option_upload_boxed_layout_bg'),
							  'theme_option_upload_boxed_layout_bg_repeat' : theme_set_value('theme_option_upload_boxed_layout_bg_repeat'),
							  'theme_option_upload_boxed_layout_bg_attachment' : theme_set_value('theme_option_upload_boxed_layout_bg_attachment'),
							  
							  'theme_option_color_logo_text' : theme_set_value('theme_option_color_logo_text'),
							  
							  'theme_option_color_menu_item_text' : theme_set_value('theme_option_color_menu_item_text'),
							  'theme_option_color_activated_item_text' : theme_set_value('theme_option_color_activated_item_text'),
							  'theme_option_color_submenu_bg' : theme_set_value('theme_option_color_submenu_bg'),
							  'theme_option_color_submenu_text' : theme_set_value('theme_option_color_submenu_text'),
							  'theme_option_color_sidebar_bg' : theme_set_value('theme_option_color_sidebar_bg'),
							  'theme_option_color_sidebar_widget_title' : theme_set_value('theme_option_color_sidebar_widget_title'),
							  'theme_option_color_sidebar_widge_content' : theme_set_value('theme_option_color_sidebar_widge_content'),
							  'theme_option_color_copyright_text' : theme_set_value('theme_option_color_copyright_text'),
							  'theme_option_color_widget_title' : theme_set_value('theme_option_color_widget_title'),
							  'theme_option_color_widget_content' : theme_set_value('theme_option_color_widget_content'),
							  
							  'theme_option_fonts_main-family' : theme_set_value('theme_option_fonts_main-family'),
							  
							  'theme_option_fonts_heading-family' : theme_set_value('theme_option_fonts_heading-family'),
							  
							  'theme_option_fonts_logo-family' : theme_set_value('theme_option_fonts_logo-family'),
							  'theme_option_fonts_logo-size' : theme_set_value('theme_option_fonts_logo-size'),
							  'theme_option_fonts_logo-style' : theme_set_value('theme_option_fonts_logo-style'),
							  
							  'theme_option_fonts_menu-family' : theme_set_value('theme_option_fonts_menu-family'),
							  'theme_option_fonts_menu-size' : theme_set_value('theme_option_fonts_menu-size'),
							  'theme_option_fonts_menu-style' : theme_set_value('theme_option_fonts_menu-style'),
							  
							  'theme_option_fonts_post_page_title-size' : theme_set_value('theme_option_fonts_post_page_title-size'),
							  'theme_option_fonts_post_page_title-style' : theme_set_value('theme_option_fonts_post_page_title-style'),
							  
							  'theme_option_fonts_post_page_content-size' : theme_set_value('theme_option_fonts_post_page_content-size'),
							  'theme_option_fonts_post_page_content-style' : theme_set_value('theme_option_fonts_post_page_content-style'),
							  
							  'theme_option_fonts_sidebar_title-size' : theme_set_value('theme_option_fonts_sidebar_title-size'),
							  'theme_option_fonts_sidebar_title-style' : theme_set_value('theme_option_fonts_sidebar_title-style'),
							  
							  'theme_option_fonts_sidebar_content-size' : theme_set_value('theme_option_fonts_sidebar_content-size'),
							  'theme_option_fonts_sidebar_content-style' : theme_set_value('theme_option_fonts_sidebar_content-style'),
							  'theme_option_fonts_footer_copyright_text-size' : theme_set_value('theme_option_fonts_footer_copyright_text-size'),
							  'theme_option_fonts_footer_copyright_text-style' : theme_set_value('theme_option_fonts_footer_copyright_text-style'),
							  'theme_option_fonts_footer_widget_title-size' : theme_set_value('theme_option_fonts_footer_widget_title-size'),
							  'theme_option_fonts_footer_widget_title-style' : theme_set_value('theme_option_fonts_footer_widget_title-style'),
							  'theme_option_fonts_footer_widget_content-size' : theme_set_value('theme_option_fonts_footer_widget_content-size'),
							  'theme_option_fonts_footer_widget_content-style' : theme_set_value('theme_option_fonts_footer_widget_content-style'),
						  }
						  
					}
				}).done(function(content){
					jQuery('.theme-option-save .loading').fadeOut(400);
					theme_option_save();
				});
			});
		}
		
		theme_option_save();
		
		var socialtitle = jQuery('.theme-option-item h3[data-name=theme_option_social_medias]'),
			socialcontent = jQuery('.theme-option-item .row-fluid[data-name=theme_option_social_medias]');
		
		if(jQuery('[name=theme_option_switch_show_social]').val() != 'true'){
			socialtitle.slideUp();
			socialcontent.slideUp();
		}else{
			socialtitle.slideDown();
			socialcontent.slideDown();
		}
		
		jQuery('.option_switch').on('switch-change',function (e, data){
			var value = data.value,
				switch_value = jQuery(this).next('input:hidden');
				
			switch_value.val(value);
			
			if(jQuery(this).is('.theme_option_switch_show_social')){
				
				var title = jQuery('.theme-option-item h3[data-name=theme_option_social_medias]'),
					content = jQuery('.theme-option-item .row-fluid[data-name=theme_option_social_medias]');
				
				if(value == false){
					title.slideUp();
					content.slideUp();
				}else{
					title.slideDown();
					content.slideDown();
				}
				
			}
		});
		
		
		
	});
	
	</script>
</div>

<div id="showOptionUploadWindow" class="modal hide fade">
    <div class="winoption-header">
        <button type="button" class="close window_close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 id="showOptionUploadTitle"><?php _e('Insert Media','ux');?></h3>
    </div>
    <div class="winoption-body">
        <div class="winoption_iframe"></div>
    </div>
    <div class="winoption-footer"></div>
</div>