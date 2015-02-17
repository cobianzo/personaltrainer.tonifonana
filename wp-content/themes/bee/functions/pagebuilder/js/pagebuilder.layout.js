jQuery(document).ready(function() {
	
	var post_body_content              = jQuery('#post-body-content'),
		post_pagebuilder_box           = jQuery('#post-pagebuilder-box'),
		postdivrich                    = jQuery('#postdivrich'),
		commentstatusdiv               = jQuery('#commentstatusdiv'),
		post_type                      = jQuery('#post_type'),
		
		pagebuilder_switch             = jQuery('#pagebuilder_switch'),
		pagebuilder_wrap_menu          = jQuery('#pagebuilder_wrap_menu'),
		pagebuilder_wrap_container     = jQuery('#pagebuilder_wrap_container'),
		pagebuilder_module_pop         = jQuery('#pagebuilder_module_pop'),
		pagebuilder_module_menu        = jQuery('.pagebuilder_module_menu'),
		
		switch_pagebuilder             = jQuery('.switch_pagebuilder'),
		switch_classic                 = jQuery('.switch_classic'),
		switch_value                   = jQuery('.switch_value'),
		
		modal_window                   = jQuery('#showModalWindow'),
		modal_window_title             = jQuery('#showModalTitle'),
		modal_window_editor            = jQuery('#showModalEditor'),
		modal_module_id                = jQuery('#modal_module_id'),
		modal_module_post              = jQuery('#modal_module_post'),
		modal_module_post_id           = jQuery('#modal_module_post_id'),
		modal_save_loading             = jQuery('.modal_save_loading'),
		modal_iframe                   = jQuery('.modal_iframe'),
		modal_list_window              = jQuery('#showModalListWindow'),
		
		modal_template_title           = jQuery('[name=modal_template_title]'),
		modal_template_post_select     = jQuery('[name=modal_template_post_select]'),
		
		module_pop_content_prepend     = jQuery('#module_pop_content_prepend'),
		module_pop_content_append      = jQuery('#module_pop_content_append');
	
	pagebuilder_switch.insertAfter('#titlediv');
	
	if(post_type.val() == 'page'){
		commentstatusdiv.hide();
	}
	
	// judgement --------------------------------------------------------------------------------------------
	if(switch_value.val() != ''){
		pagebuilder_switch_control(switch_value.val());
	}else{
		pagebuilder_switch_control('switch_classic');
	}
	
	
	// function ----------------------------------------------------------------------------------
	function pagebuilder_switch_control(_this){
		if(_this == 'switch_pagebuilder'){
			post_body_content.addClass('custom_post_body_content');
			post_pagebuilder_box.fadeIn();
			postdivrich.slideUp();
			switch_pagebuilder.hide();
			switch_classic.fadeIn();
			switch_value.val('switch_pagebuilder');
		}
		else if(_this == 'switch_classic'){
			post_body_content.removeClass('custom_post_body_content');
			post_pagebuilder_box.hide();
			postdivrich.slideDown();
			switch_classic.hide();
			switch_pagebuilder.fadeIn();
			switch_value.val('switch_classic');
		}
	}
	
	function pagebuilder_create(data,container,mode){
		
		jQuery.post(ajaxurl, {
			'action':'CustomPagebuilderAjaxCreate',
			'data': data
		}).done(function(content){
			switch(mode){
				case 'append': container.append(content); break;
				case 'after': 
					var _this_item = jQuery(content);
					container.after(_this_item);
					_this_item.hide();
					_this_item.slideDown();
				break;
			}
			
			pagebuilder_resets();
			pagebuilder_events();
			
			pagebuilder_sortable();
		});
	}
	
	function pagebuilder_module_ajax(data,container){
		jQuery.post(ajaxurl, {
			'action':'CustomPagebuilderAjaxOther',
			'data': data
		}).done(function(content){
			container.append(content);
			pagebuilder_events();
			pagebuilder_module_events();
			pagebuilder_module_save();
			pagebuilder_sortable();
		});
		
	}
	
	function pagebuilder_template_ajax(data){
		jQuery.post(ajaxurl, {
			'action':'CustomPagebuilderTemplateAjax',
			'data': data
		}).done(function(content){
			jQuery('.modal_template_loading').hide();
			modal_template_title.val('');
			modal_list_window.modal('hide');
			
			if(data['mode'] == 'select'){
				modal_template_post_select.html(content);
				
			}else if(data['mode'] == 'save'){
				var ajax_data = {
					'mode' : 'select'
				}
				pagebuilder_template_ajax(ajax_data);
			}else if(data['mode'] == 'load'){
				pagebuilder_wrap_container.html(content);
				pagebuilder_resets();
				pagebuilder_events();
				
				pagebuilder_sortable();
			}
			
		});
	}
	
	function pagebuilder_load_gallery(data){
		jQuery.post(ajaxurl, {
			'action':'CustomPagebuilderAjaxGallery',
			'data': data
		}).done(function(content){
			var module_show_gallery_image_list = jQuery('.module_show_gallery_image_list'),
				module_show_gallery_image_list_content = jQuery('.module_show_gallery_image_list_content'),
				module_show_gallery_image_list_loading = jQuery('.module_show_gallery_image_list_loading');
			
			module_show_gallery_image_list_content.html(content);
			module_show_gallery_image_list_loading.hide();
			
			jQuery('.gallery_selected').click(function(){
				var _this = jQuery(this),
					gallery_img = _this.attr('rel'),
					gallery_img_id = _this.attr('attid'),
					module_show_gallery_selected = jQuery('.module_show_gallery_selected'),
					module_show_gallery_below = jQuery('.module_show_gallery_below'),
					module_show_gallery_selected = jQuery('.module_show_gallery_selected');
				
				module_show_gallery_below.hide();
				module_show_gallery_selected.fadeIn();
				module_show_gallery_selected.append('<li><span class="remove_item_image item_click"></span><img src="'+gallery_img+'" /><input type="hidden" name="module_select_gallery_selected[]" value="'+gallery_img_id+'" /></li>');
				
				pagebuilder_module_events();
				
			})
			
		});
		
	}
	
	function pagebuilder_module_edit(data){
		var data_module =  jQuery('[data-module*='+data['module_id']+']');
		
		jQuery('.modal_loading').fadeOut();
		modal_iframe.hide();
		data_module.show();	
		
		jQuery.post(ajaxurl, {
			'action':'CustomPagebuilderAjaxModule',
			'data': data
		}).done(function(content){
			var module_content_ifr   =  jQuery('#module_content_ifr'),
				module_content_wrap  =  jQuery('#wp-module_content-wrap');
				module_content       =  jQuery('#module_content');
				
			module_content_ifr.height(200);
			
			if(data['module_id'] == 'text_block'){
				module_pop_content_append.html(content);
			}else{
				module_pop_content_prepend.html(content);
			}
			
			if(data['module_id'] == 'text_block' || data['module_id'] == 'icon_box' || data['module_id'] == 'accordion_toggle' || data['module_id'] == 'tabs'){
				var ajax_module_post_content = jQuery('.ajax_module_post_content');
				if(module_content_wrap.is('.tmce-active')){
					module_content_ifr.contents().find('body').html(ajax_module_post_content.html());
				}else{(module_content_wrap.is('.html-active'))
					module_content.val(ajax_module_post_content.html());
				}
				ajax_module_post_content.remove();
			}
			
			if(data['module_id'] == 'accordion_toggle' || data['module_id'] == 'tabs'){
				var post_title_parent = jQuery('.module_post_title').parent().parent(),
					post_content_parent = jQuery('.module_post_content').parent().parent();
					
					post_title_parent.hide(); post_content_parent.hide();
			}else if(data['module_id'] == 'text_list'){
				var select_icon_parent = jQuery('.module_select_icon').parent().parent(),
					html_content_parent = jQuery('.module_post_html_content').parent().parent();
				
				select_icon_parent.hide(); html_content_parent.hide();
			}else if(data['module_id'] == 'divider'){
				var divider_type              = jQuery('[name=module_select_divider_type]').val(),
					select_text_align_parent  = jQuery('.module_select_text_align').parent().parent(),
					select_height_parent      = jQuery('.module_select_height').parent().parent(),
					background_color_parent   = jQuery('.module_background_color').parent().parent(),
					post_title_parent         = jQuery('.module_post_title').parent().parent();
					
						
				if(divider_type == 'single_line'){
					select_text_align_parent.hide(); 
					select_height_parent.hide();
					post_title_parent.hide();
					
					background_color_parent.fadeIn(); 
				}else if(divider_type == 'text_and_line'){
					select_height_parent.hide();
					
					select_text_align_parent.fadeIn(); 
					background_color_parent.fadeIn(); 
					post_title_parent.fadeIn();
				}else if(divider_type == 'blank_divider'){
					background_color_parent.hide();
					select_text_align_parent.hide(); 
					post_title_parent.hide();
					
					select_height_parent.fadeIn(); 
				}
			}else if(data['module_id'] == 'promote'){
				var module_switch_show_button   = jQuery('[name=module_switch_show_button]'),
					module_select_text_align    = jQuery('[name=module_select_text_align]'),
					background_color_parent     = jQuery('.module_background_color').parent().parent(),
					input_button_text_parent    = jQuery('.module_input_button_text').parent().parent(),
					input_button_link_parent    = jQuery('.module_input_button_link').parent().parent();
					
				if(module_switch_show_button.val() == 'false'){
					background_color_parent.hide();
					input_button_text_parent.hide();
					input_button_link_parent.hide();
				}
				
				module_select_text_align.find('option[value=right]').remove();
			}else if(data['module_id'] == 'blog'){
				var module_select_pagination  = jQuery('[name=module_select_pagination]');
				
				//module_select_pagination.find('option[value=infiniti_scroll]').remove();
			}else if(data['module_id'] == 'portfolio'){
				var module_select_image_list_type  = jQuery('[name=module_select_image_list_type]'),
					module_select_pagination       = jQuery('[name=module_select_pagination]'),
					select_image_ratio_parent      = jQuery('.module_select_image_ratio').parent().parent(),
					select_first_item_parent       = jQuery('.module_select_first_item').parent().parent();
					
				/*if(module_select_image_list_type.val() == 'masonry'){
					select_image_ratio_parent.hide();
					select_first_item_parent.fadeIn();
				}else{
					select_image_ratio_parent.show();
					select_first_item_parent.hide();
				}*/
				
				//module_select_pagination.find('option[value=twitter]').remove();
			}else if(data['module_id'] == 'gallery'){
				var module_select_image_list_type  = jQuery('[name=module_select_image_list_type]'),
					module_select_image_source     = jQuery('[name=module_select_image_source]'),
					module_select_pagination       = jQuery('[name=module_select_pagination]'),
					
					select_image_ratio_parent      = jQuery('.module_select_image_ratio').parent().parent(),
					select_category_parent         = jQuery('.module_select_category').parent().parent(),
					select_orderby_parent          = jQuery('.module_select_orderby').parent().parent(),
					select_sortable_parent         = jQuery('.module_select_sortable').parent().parent(),
					select_first_item_parent       = jQuery('.module_select_first_item').parent().parent(),
					show_gallery_parent            = jQuery('.module_show_gallery').parent().parent(),
					show_gallery_image_list_parent = jQuery('.module_show_gallery_image_list').parent().parent();
					
					
				/*if(module_select_image_list_type.val() == 'masonry'){
					select_image_ratio_parent.hide();
					select_first_item_parent.fadeIn();
				}else{
					select_image_ratio_parent.show();
					select_first_item_parent.hide();
				}*/
				
				if(module_select_image_source.val() == 'image_post'){
					select_category_parent.fadeIn();
					select_orderby_parent.fadeIn();
					select_sortable_parent.fadeIn();
					show_gallery_parent.hide();
					show_gallery_parent.prev('.module_show_line').hide();
					show_gallery_image_list_parent.hide();
					show_gallery_image_list_parent.prev('.module_show_line').hide();
					
				}else{
					select_category_parent.hide();
					select_orderby_parent.hide();
					select_sortable_parent.hide();
					show_gallery_parent.fadeIn();
					show_gallery_parent.prev('.module_show_line').fadeIn();
					show_gallery_image_list_parent.fadeIn();
					show_gallery_image_list_parent.prev('.module_show_line').fadeIn();
				}
				
				//module_select_pagination.find('option[value=twitter]').remove();
				pagebuilder_load_gallery(1);
				
			}else if(data['module_id'] == 'video'){
				var module_select_video_ratio        = jQuery('[name=module_select_video_ratio]'),
					select_video_ratio_custom_parent = jQuery('.module_select_video_ratio_custom');
					
				if(module_select_video_ratio.val() == 'custom'){
					select_video_ratio_custom_parent.show();
				}else{
					select_video_ratio_custom_parent.hide();
				}
			}else if(data['module_id'] == 'slider'){
				var module_select_slider_image = jQuery('[name=module_select_slider_image]'),
					
					input_slider_alias_parent = jQuery('.module_select_layer_slider').parent().parent(),
					input_per_page_parent = jQuery('.module_input_per_page').parent().parent(),
					select_category_parent = jQuery('.module_select_category').parent().parent(),
					select_orderby_parent = jQuery('.module_select_orderby').parent().parent(),
					flexslider_animation_parent = jQuery('.module_select_flexslider_animation').parent().parent(),
					navigation_hint_parent = jQuery('.module_switch_navigation_hint').parent().parent(),
					previous_next_parent = jQuery('.module_switch_previous_next').parent().parent(),
					speed_second_parent = jQuery('.module_input_speed_second').parent().parent(),
					revolution_slider_parent = jQuery('.module_select_revolution_slider').parent().parent();
					
				if(module_select_slider_image.val() == 'novo'){
					input_slider_alias_parent.hide();
					flexslider_animation_parent.hide();
					navigation_hint_parent.hide();
					previous_next_parent.hide();
					speed_second_parent.hide();
					revolution_slider_parent.hide();
				}else if(module_select_slider_image.val() == 'flexslider'){
					input_slider_alias_parent.hide();
					revolution_slider_parent.hide();
				}else if(module_select_slider_image.val() == 'layerslider'){
					input_per_page_parent.hide();
					select_category_parent.hide();
					select_orderby_parent.hide();
					flexslider_animation_parent.hide();
					navigation_hint_parent.hide();
					previous_next_parent.hide();
					speed_second_parent.hide();
					revolution_slider_parent.hide();
				}else if(module_select_slider_image.val() == 'revolutionslider'){
					input_per_page_parent.hide();
					select_category_parent.hide();
					select_orderby_parent.hide();
					flexslider_animation_parent.hide();
					navigation_hint_parent.hide();
					previous_next_parent.hide();
					speed_second_parent.hide();
					input_slider_alias_parent.hide();
				}
			}else if(data['module_id'] == 'price'){
				var background_color_parent  = jQuery('.module_background_color').parent().parent(),
					input_title_parent       = jQuery('.module_input_title').parent().parent(),
					input_price_parent       = jQuery('.module_input_price').parent().parent(),
					details_item_parent      = jQuery('.module_details_item').parent().parent(),
					input_button_text_parent = jQuery('.module_input_button_text').parent().parent(),
					input_button_link_parent = jQuery('.module_input_button_link').parent().parent();
					
					background_color_parent.hide();
					input_title_parent.hide();
					input_price_parent.hide();
					details_item_parent.hide();
					input_button_text_parent.hide();
					input_button_link_parent.hide();
					
					if(jQuery('.lists_item').length >= 4){
						jQuery('.lists_layout').hide();
					}else{
						jQuery('.lists_layout').fadeIn();
					}
				
			}else if(data['module_id'] == 'icon_box'){
				var module_select_icon_location = jQuery('[name=module_select_icon_location]'),
					module_switch_hyperlink = jQuery('[name=module_switch_hyperlink]'),
					select_icon_mask_parent = jQuery('.module_select_icon_mask').parent().parent(),
					background_color_parent = jQuery('.module_background_color').parent().parent(),
					select_hover_animation_parent = jQuery('.module_select_hover_animation').parent().parent(),
					
					hyperlink_parent = jQuery('.module_input_hyperlink').parent().parent();
				
				if(module_select_icon_location.val() == 'icon_top'){
					select_icon_mask_parent.show();
					background_color_parent.show();
					select_hover_animation_parent.show();
				}else{
					select_icon_mask_parent.hide();
					background_color_parent.hide();
					select_hover_animation_parent.hide();
					
				}
				
				if(module_switch_hyperlink.val() == 'false'){
					hyperlink_parent.hide();
				}
				
			}else if(data['module_id'] == 'contact_form'){
				var module_select_contact_form_type = jQuery('[name=module_select_contact_form_type]'),
					input_recipient_email_parent = jQuery('.module_input_recipient_email').parent().parent(),
					input_field_text_parent = jQuery('.module_input_field_text').parent().parent(),
					input_button_text_parent = jQuery('.module_input_button_text').parent().parent(),
					textarea_sent_message_parent = jQuery('.module_textarea_sent_message').parent().parent(),
					swich_show_verify_parent = jQuery('.module_switch_show_verifynumber').parent().parent(),
					select_contact_form_7_alias_parent = jQuery('.module_select_contact_form_7_alias').parent().parent();
				
				if(module_select_contact_form_type.val() == 'single_field'){
					select_contact_form_7_alias_parent.hide();
				}else if(module_select_contact_form_type.val() == 'contact_form_7'){
					input_recipient_email_parent.hide();
					input_field_text_parent.hide();
					input_button_text_parent.hide();
					textarea_sent_message_parent.hide();
					swich_show_verify_parent.hide();
				}else{
					select_contact_form_7_alias_parent.hide();
					input_field_text_parent.hide();
				}
			}else if(data['module_id'] == 'progress_bar'){
				var module_select_infographic_type = jQuery('[name=module_select_infographic_type]'),
					
					select_infographic_style_parent = jQuery('.module_select_infographic_style').parent().parent(),
					select_icon_parent = jQuery('.module_select_icon').parent().parent(),
					
					lists_layout_parent = jQuery('.module_lists_layout').parent().parent(),
					background_color_parent = jQuery('.module_background_color').parent().parent(),
					switch_show_background_color_parent = jQuery('.module_switch_show_background_color').parent().parent(),
					
					input_title_parent = jQuery('.module_input_title').parent().parent(),
					input_subtitle_parent = jQuery('.module_input_subtitle').parent().parent(),
					input_number_icons_parent = jQuery('.module_input_number_icons').parent().parent(),
					input_number_active_icons_parent = jQuery('.module_input_number_active_icons').parent().parent(),
					input_infographic_digit_parent = jQuery('.module_input_infographic_digit').parent().parent(),
					input_progress_parent = jQuery('.module_input_progress').parent().parent();
					
				background_color_parent.find('.module_descriptive_title .lead').hide();
				
				if(module_select_infographic_type.val() == 'bar'){
					select_infographic_style_parent.hide();
					select_icon_parent.hide();
					lists_layout_parent.hide();
					input_subtitle_parent.hide();
					input_number_icons_parent.hide();
					input_number_active_icons_parent.hide();
					input_infographic_digit_parent.hide();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=0]').show();
					
				}else if(module_select_infographic_type.val() == 'column'){
					select_infographic_style_parent.hide();
					select_icon_parent.hide();
					input_title_parent.hide();
					input_subtitle_parent.hide();
					input_number_icons_parent.hide();
					input_number_active_icons_parent.hide();
					input_infographic_digit_parent.hide();
					input_progress_parent.hide();
					background_color_parent.hide();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=0]').show();
					
				}else if(module_select_infographic_type.val() == 'pie'){
					select_icon_parent.hide();
					input_number_icons_parent.hide();
					input_number_active_icons_parent.hide();
					input_infographic_digit_parent.hide();
					lists_layout_parent.hide();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=0]').show();
					
				}else if(module_select_infographic_type.val() == 'pictorial'){
					select_infographic_style_parent.hide();
					lists_layout_parent.hide();
					switch_show_background_color_parent.hide();
					input_subtitle_parent.hide();
					input_infographic_digit_parent.hide();
					input_progress_parent.hide();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=1]').show();
					
				}else if(module_select_infographic_type.val() == 'big_number'){
					select_infographic_style_parent.hide();
					select_icon_parent.hide();
					lists_layout_parent.hide();
					switch_show_background_color_parent.hide();
					input_number_icons_parent.hide();
					input_number_active_icons_parent.hide();
					input_progress_parent.hide();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=2]').show();
					
				}
			}else if(data['module_id'] == 'image_box'){
				var module_switch_social_network = jQuery('[name=module_switch_social_network]'),
					module_switch_hyperlink = jQuery('[name=module_switch_hyperlink]'),
					
					hyperlink_parent = jQuery('.module_input_hyperlink').parent().parent(),
					social_medias_parent = jQuery('.module_social_medias').parent().parent();
				
				if(module_switch_social_network.val() == 'false'){
					social_medias_parent.hide();
				}
				
				if(module_switch_hyperlink.val() == 'false'){
					hyperlink_parent.hide();
				}
				
			}else if(data['module_id'] == 'fullwidth'){
				var module_select_background = jQuery('[name=module_select_background]'),
					module_select_background_attachment = jQuery('[name=module_select_background_attachment]'),
					module_switch_via_tab = jQuery('[name=module_switch_via_tab]'),
					module_switch_dark_background = jQuery('[name=module_switch_dark_background]'),
					
					background_color_parent = jQuery('.module_background_color').parent().parent(),
					image_single_parent = jQuery('.module_image_single').parent().parent(),
					select_background_attachment_parent = jQuery('.module_select_background_attachment').parent().parent(),
					select_parallax_ratio_parent = jQuery('.module_select_parallax_ratio').parent().parent(),
					tabs_fullwidth_parent = jQuery('.module_tabs_fullwidth').parent().parent(),
					
					dark_background_parent = jQuery('.module_cheak_dark_background').parent().parent();
				
				if(module_select_background.val() == 'color'){
					image_single_parent.hide();
					select_background_attachment_parent.hide();
					select_parallax_ratio_parent.hide();
				}else{
					background_color_parent.hide();
					if(module_select_background_attachment.val() != 'parallax'){
						select_parallax_ratio_parent.hide();
					}
				}
				
				if(module_switch_via_tab.val() == 'false'){
					tabs_fullwidth_parent.hide();
				}
				
				if(module_switch_dark_background.val() == 'false'){
					dark_background_parent.hide();
				}
				
			}else if(data['module_id'] == 'liquid_list'){
				var module_select_style_default = jQuery('[name=module_select_style_default]'),
					module_switch_social_network = jQuery('[name=module_switch_social_network]'),
					module_select_image_size = jQuery('[name=module_select_image_size]'),
					module_select_expanded_block_width = jQuery('[name=module_select_expanded_block_width]'),
					select_mouseover_effect_parent = jQuery('.module_select_mouseover_effect').parent().parent(),
					select_image_siz_parente = jQuery('.module_select_image_size').parent().parent(),
					select_image_ratio_parent = jQuery('.module_select_image_ratio').parent().parent(),
					select_loading_block_color_parent = jQuery('.module_select_loading_block_color').parent().parent();
				
				if(module_select_style_default.val() == 'magazine'){
					select_mouseover_effect_parent.hide();
					select_image_siz_parente.hide();
					select_image_ratio_parent.hide();
					select_loading_block_color_parent.hide();
					
					module_select_expanded_block_width.find('option[value=4]').hide();
				}
				
				if(module_select_image_size.val() == 'large'){
					module_select_expanded_block_width.find('option[value=4]').hide();
				}
				
			}else if(data['module_id'] == 'latest_post'){
				var module_select_latest_post_layout = jQuery('[name=module_select_latest_post_layout]'),
					module_select_text_align = jQuery('[name=module_select_text_align]'),
					
					image_ratio_parent = jQuery('.module_select_image_ratio').parent().parent(),
					image_size_parente = jQuery('.module_select_image_size').parent().parent(),
					show_function_parent = jQuery('.module_cheak_show_function').parent().parent();
					text_align_parent = jQuery('.module_select_text_align').parent().parent();
				
				
				module_select_text_align.find('option[value=right]').remove();
				
				if(module_select_latest_post_layout.val() == 'vertical_list'){
					image_ratio_parent.hide();
					image_size_parente.hide();
					show_function_parent.hide();
					text_align_parent.hide();
				}
			}
			
			jQuery('.module_switch')['bootstrapSwitch']();
			jQuery('.module_checkbox').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
			
			pagebuilder_events();
			pagebuilder_module_events();
			pagebuilder_module_save();
			pagebuilder_sortable();
			jQuery('.modal-body').scrollTop(0);
			
			if(jQuery('.themeoption-help-wrap').length > 0){
				jQuery('.themeoption-help-wrap').each(function(index, element) {
					var _this = jQuery(this);
					
					_this.find('.themeoption-help').hover(function(){
						_this.find('.themeoption-help-hide').css({'opacity': 1});
					},function(){
						_this.find('.themeoption-help-hide').css({'opacity': 0});
					});
				});
			}
		});
		
	}
	
	function pagebuilder_sortable(){
		var pagebuilder_wrap_item_content  =  jQuery('.pagebuilder_wrap_item_content'),
			pagebuilder_wrap_item          =  jQuery('.pagebuilder_wrap_item'),
			module_lists_layout            =  jQuery('.module_lists_layout'),
			module_details_item            =  jQuery('.module_details_item');
		
		pagebuilder_wrap_container.sortable({
			placeholder: "pagebuilder_wrap_highlight",
			forcePlaceholderSize: true,
			tolerance: 'pointer',
			items: "> .pagebuilder_wrap_item",
			handle: '.sort_over_title',
			appendTo: 'body',
			distance: 40,
			helper: function(event,ui){
				pagebuilder_wrap_item_content.each(function(index, element) {
                    jQuery(this).sortable().sortable('disable');
                });
				pagebuilder_wrap_container.sortable().sortable('refresh');
				pagebuilder_wrap_item_content.sortable().sortable('refresh');
				
				return ui;
			},
			beforeStop: function(event,ui){
				pagebuilder_wrap_item_content.each(function(index, element) {
                    jQuery(this).sortable().sortable('enable');
					jQuery(this).sortable().sortable('refresh');
                });
			},
			over: function(event,ui){
				pagebuilder_wrap_container.sortable().sortable('refresh');
				pagebuilder_wrap_item_content.sortable().sortable('refresh');
			},
			update: function(event,ui){
				pagebuilder_resets();
			},
			receive: function(event, ui){
				ui.item.find('input.module_id').attr('name','pagebuilder_item_module_id[]').removeClass('module_id').addClass('item_module_id');
				ui.item.find('input.module_width').attr('name','pagebuilder_item_width[]').removeClass('module_width').addClass('item_width');
				ui.item.find('input.module_parent').attr('name','pagebuilder_item_sort[]').removeClass('module_parent').addClass('item_sort');
				ui.item.find('input.module_post').attr('name','pagebuilder_item_module_post[]').removeClass('module_post').addClass('item_module_post');
				ui.item.find('input.module_post_id').attr('name','pagebuilder_item_module_post_id[]').removeClass('module_post_id').addClass('item_module_post_id');
				ui.item.find('.module_click').removeClass('module_click').addClass('item_module_click');
			}
		})
		
		pagebuilder_wrap_item_content.sortable({
			placeholder: "pagebuilder_wrap_highlight",
			forcePlaceholderSize: true,
			items: "> .module_item",
			tolerance: "pointer",
			handle: '.sort_over_title',
			appendTo: 'body',
			distance: 40,
			connectWith: ".module_connect, #pagebuilder_wrap_container",
			update: function(event,ui){
				pagebuilder_resets();
			},
			helper: function(event,ui){
				pagebuilder_wrap_container.sortable().sortable('refresh');
				pagebuilder_wrap_item_content.sortable().sortable('refresh');
				return ui;
			},
			over: function(event,ui){
				pagebuilder_wrap_container.sortable().sortable('refresh');
				pagebuilder_wrap_item_content.sortable().sortable('refresh');
			}
		})
		
		pagebuilder_wrap_item_content.droppable({
			accept: '#pagebuilder_wrap_container > .module_item',
			hoverClass: 'pagebuilder_wrap_droppable_hover',
			over: function(event,ui){
				var _this = jQuery(this);
				jQuery('.pagebuilder_wrap_highlight').hide();
			},
			out: function(event,ui){
				jQuery('.pagebuilder_wrap_highlight').show();
			},
			drop: function(event,ui){
				var _this       =  jQuery(this),
				module_id       =  ui.draggable.find('> .item_module_id').val(),
				module_width    =  ui.draggable.find('> .item_width').val(),
				module_parent   =  ui.draggable.find('> .item_sort').val(),
				module_post     =  ui.draggable.find('> .item_module_post').val(),
				module_post_id  =  ui.draggable.find('> .item_module_post_id').val(),
				module_name     =  ui.draggable.find('> .pagebuilder_wrap_item_module > .pagebuilder_wrap_item_module_name > .item_title').text(),
				container       =  _this.parent('.pagebuilder_wrap_item'),
				parent_title    =  container.find('> .pagebuilder_wrap_item_title > .item_subtitle').text(),
				parent_width    =  container.find('> .item_width').val().split(" ",1);
				
				
				var ajax_data = {
					'mode'            :  'add_module',
					'parent_id'       :  module_parent,
					'parent_title'    :  parent_title,
					'parent_width'    :  parent_width,
					'module_id'       :  module_id,
					'module_post'     :  module_post,
					'module_name'     :  module_name,
					'module_post_id'  :  module_post_id
					
				}
				pagebuilder_create(ajax_data,_this,'append');
				
				ui.draggable.remove();
				pagebuilder_resets();
			}
		});
		
		module_lists_layout.find('.lists_rows').sortable({
			update: function(){
				module_lists_layout.find('.lists_rows').find('.lists_item').each(function(i){
					jQuery(this).attr('rel',i);
				});
			}
			
		});
		
		module_details_item.find('.details_row').sortable({
			update: function(){
				module_details_item.find('.details_row').find('.details_item').each(function(i){
					jQuery(this).attr('rel',i);
				});
			}
			
		});
		
	}
	
	function pagebuilder_change_size(clicked,container,mode){
		var container_parent = container.parent().parent();
		var container_parent_width = container_parent.data('width');
		
		var item		= jQuery(clicked),
			currentSize	= container.data('width'),
			nextSize	= [],
			direction	= item.is('.item_increase') ? 1 : -1,
			sizes		= [ 
							['pb_1_1', '1/1'], 
							['pb_3_4', '3/4'],
							['pb_2_3', '2/3'], 
							['pb_1_2', '1/2'], 
							['pb_1_3', '1/3'], 
							['pb_1_4', '1/4']
						],
			sizes_i     = {
							'pb_1_1': 0.99, 
							'pb_3_4': 0.74, 
							'pb_2_3': 0.656666666666666666666666666666666666666666, 
							'pb_1_2': 0.49, 
							'pb_1_3': 0.323333333333333333333333333333333333333333, 
							'pb_1_4': 0.24
			};
			
		if(sizes_i[currentSize] > sizes_i[container_parent_width]){
			currentSize = container_parent_width;
		}
		
		if(mode == 'module'){
			var sizeString   =  container.find('> .pagebuilder_wrap_item_module > .pagebuilder_wrap_item_module_name > .item_subtitle');
			var dataStorage  =  container.find('> .module_width'),
				dataString	 =  dataStorage.val();
		}else if(mode == 'item_module'){
			var sizeString   =  container.find('> .pagebuilder_wrap_item_module > .pagebuilder_wrap_item_module_name > .item_subtitle');
			var dataStorage  =  container.find('> .item_width'),
				dataString	 =  dataStorage.val();
		}else{
			var sizeString   =  container.find('> .pagebuilder_wrap_item_title > .item_subtitle');
			var dataStorage  =  container.find('> .item_width'),
				dataString	 =  dataStorage.val();
		}
		
		for (var i = 0; i < sizes.length; i++){
		    if(sizes[i][0] == currentSize){
		    	nextSize = sizes[i - direction];
		    }
		}
		
		if(typeof nextSize != 'undefined')
		{
			dataString = dataString.replace(currentSize, nextSize[0]);
			
			dataStorage.val(dataString);
			container.removeClass(currentSize).addClass(nextSize[0]);
			container.attr('data-width',nextSize[0]).data('width',nextSize[0]); 
			sizeString.text(nextSize[1]);
			
		}
		if(mode == 'item'){
			if(direction == -1){
				container.find('.pagebuilder_wrap_item[data-width='+currentSize+']').find('.module_width').val(nextSize[0]);
				container.find('.pagebuilder_wrap_item[data-width='+currentSize+']').find('.item_subtitle').text(nextSize[1]);
				container.find('.pagebuilder_wrap_item[data-width='+currentSize+']').attr('data-width',nextSize[0]).data('width',nextSize[0]).removeClass(currentSize).addClass(nextSize[0]);
				
			}
		}
		pagebuilder_resets();
	}
	
	function pagebuilder_resets(){
		var pagebuilder_wrap_item_content = jQuery('.pagebuilder_wrap_item_content'),
			pagebuilder_wrap_item = jQuery('.pagebuilder_wrap_item');
		
		pagebuilder_item_reset(pagebuilder_wrap_container,'item');
		
		if(pagebuilder_wrap_item_content.length > 0){
			pagebuilder_wrap_item_content.each(function(index, element) {
                pagebuilder_module_reset(jQuery(this),'module');
            });
		}
		
	}
	
	function pagebuilder_item_reset(container,mode){
		var container     =  container,
			item_fields   =  container.find('> .pagebuilder_wrap_item'),
			content_sort  =  container.find('> .pagebuilder_wrap_item > .item_sort'),
			content       =  "",
			sizeCount     =  0,
			currentField, currentContent, currentParent, currentSize;
			
			
		if(mode != 'module'){
			var content_width           =  container.find('> .pagebuilder_wrap_item > .item_width'),
				module_post             =  '',
				container_parent        =  '',
				container_parent_width  =  '',
				sizes         = {
									'pb_1_1': 0.99, 
									'pb_3_4': 0.74, 
									'pb_2_3': 0.656666666666666666666666666666666666666666, 
									'pb_1_2': 0.49, 
									'pb_1_3': 0.323333333333333333333333333333333333333333, 
									'pb_1_4': 0.24
				};
		}else{
			var content_width           =  container.find('> .pagebuilder_wrap_item > .module_width'),
				module_post             =  container.find('> .pagebuilder_wrap_item > .module_post'),
				container_parent        =  container.parent(),
				container_parent_width  =  container_parent.data('width'),
				item_subtitle           =  container_parent.find('> .pagebuilder_wrap_item_title > .item_subtitle');
				
			if(container_parent_width == 'pb_3_4'){
				var sizes = {
					  'pb_3_4': 0.99, 
					  'pb_2_3': 0.888888888888888888888888888888888888888888, 
					  'pb_1_2': 0.656666666666666666666666666666666666666666, 
					  'pb_1_3': 0.434444444444444444444444444444444444444444, 
					  'pb_1_4': 0.323333333333333333333333333333333333333333
				};
			}else if(container_parent_width == 'pb_2_3'){
				var sizes = {
					  'pb_2_3': 0.99, 
					  'pb_1_2': 0.74, 
					  'pb_1_3': 0.49, 
					  'pb_1_4': 0.365
				};
			}else if(container_parent_width == 'pb_1_2'){
				var sizes = {
					  'pb_1_2': 0.99, 
					  'pb_1_3': 0.656666666666666666666666666666666666666666, 
					  'pb_1_4': 0.49
				};
			}else if(container_parent_width == 'pb_1_3'){
				var sizes = {
					  'pb_1_3': 0.99, 
					  'pb_1_4': 0.74
				};
			}else{
				var sizes = {
					  'pb_1_1': 0.99, 
					  'pb_3_4': 0.74, 
					  'pb_2_3': 0.656666666666666666666666666666666666666666, 
					  'pb_1_2': 0.49, 
					  'pb_1_3': 0.323333333333333333333333333333333333333333, 
					  'pb_1_4': 0.24
				};
			}
		}
		for (var i = 0; i < content_width.length; i++){
			currentSort	      =  jQuery(content_sort[i]);
			currentWidth	  =  jQuery(content_width[i]);
			currentParent     =  currentWidth.parent();
			currentContent    =  currentWidth.val();
			var itemParent    =  currentParent.find('> .pagebuilder_wrap_item_content > .pagebuilder_wrap_item > .module_parent');
			
			if(currentParent.length){
				if(sizes[currentParent.data('width')] > sizes[container_parent_width]){
					currentSize = container_parent_width;
					currentParent.removeClass('pb_1_1');
					currentParent.removeClass('pb_3_4');
					currentParent.removeClass('pb_2_3');
					currentParent.removeClass('pb_1_2');
					currentParent.removeClass('pb_1_3');
					currentParent.removeClass('pb_1_4');
					currentParent.removeClass(currentParent.data('width'));
					currentParent.addClass(container_parent_width);
					currentWidth.val(currentSize);
					currentParent.attr('data-width',container_parent_width);
					currentParent.find('> .pagebuilder_wrap_item_module > .pagebuilder_wrap_item_module_name > .item_subtitle').text(item_subtitle.text());
				}else{
					currentSize = currentParent.data('width');
				}
				sizeCount += sizes[currentSize];
				
				if(sizeCount > 1 || i == 0){
					if(!currentParent.is('.f_col')){
						currentParent.addClass('f_col');
						currentWidth.val(currentSize+' f_col');
					}
					sizeCount = sizes[currentSize];
				}
				else if(currentParent.is('.f_col')){
					currentParent.removeClass('f_col');
					currentWidth.val(currentSize);
				}
			}
			else
			{
				sizeCount = 1;
			}
			
			if(mode != 'module'){
				currentSort.val(i);
				currentParent.attr('rel',i);
				itemParent.val(i);
			}
		}
		
		container.find('> .clear').remove();
		container.append('<div class="clear"></div>');
		
		var module_container = item_fields.find('> .pagebuilder_wrap_item_content');
		module_container.find('> .clear').remove();
		module_container.append('<div class="clear"></div>');
	};
	
	function pagebuilder_module_reset(container,mode){
		for (var i = 0; i < container.length; i++){
			var pb_container = jQuery(container[i]);
			var pb_item = pb_container.find('> .pagebuilder_wrap_item');
			if(pb_item.length){
				pagebuilder_item_reset(pb_container,mode);
			}
		}
	}
	
	function pagebuilder_random_post(){
		var rnd = Math.floor(Math.random()*10);
		var d = new Date();
		return rnd + d * 10;
	}
	
	function pagebuilder_form_array(key){
		var arr = '';
		var fields = jQuery('[name*='+key+']').serializeArray();
		jQuery.each(fields, function(i, field){
			arr += field.value + "'%_%'";
		});
		return arr;
		
	}
	
	function pagebuilder_form_array_post(key){
		var arr = '';
		var fields = jQuery('.set_module_post[name*='+key+']').serializeArray();
		jQuery.each(fields, function(i, field){
			arr += field.value + "'%_%'";
		});
		return arr;
		
	}
	
	function pagebuilder_form_detail(key){
		var arr = '';
		var fields = jQuery('[name*='+key+']').serializeArray();
		jQuery.each(fields, function(i, field){
			arr += field.value + "'@_@'";
		});
		return arr;
		
	}
	
	function pagebuilder_module_item_remove(){
		jQuery('.item_click').click(function(){
			if(jQuery(this).is('.module_item_remove')){
				jQuery(this).parents('.module-social-item').remove();
				pagebuilder_module_tabs_sort();
			}
		});
	}
	
	function pagebuilder_module_tabs_sort(){
		if(jQuery('.module-tabs-item').length > 0){
			jQuery('.module-tabs-item').each(function(index, element) {
                var _this = jQuery(this);
				var _this_sort = index + 1;
				var _this_tabs_name = _this.find('[name=module_tabs_fullwidth_name]');
				
				_this.attr('data-sort', _this_sort);
				_this_tabs_name.val('Tabs '+ _this_sort);
				
            });
		}
	}
	
	function pb_m_val(name){
		var val = jQuery('[name='+name+']').val();
		return val;
	}
	
	function pb_m_array(name){
		var array = jQuery('[name='+name+']').serializeArray();
		return array;
	}
	
	function pagebuilder_module_save(){
		jQuery('.item_click').click(function(){
			var _this = jQuery(this);
			if(_this.is('.modal_save')){
				var save_data, content,
					post_id                            = jQuery('#post_ID'),
					module_content                     = jQuery('#module_content'),
					module_content_wrap                = jQuery('#wp-module_content-wrap'),
					module_content_ifr                 = jQuery('#module_content_ifr'),
					
					modal_module_id                    = jQuery('#modal_module_id'),
					modal_module_post                  = jQuery('#modal_module_post'),
					modal_module_post_id               = jQuery('#modal_module_post_id'),
					
					module_background_color            = jQuery('[name=module_background_color]'),
					module_post_title                  = jQuery('[name=module_post_title]'),
					module_select_icon                 = jQuery('[name=module_select_icon]'),
					module_select_icon_location        = jQuery('[name=module_select_icon_location]'),
					module_select_icon_mask            = jQuery('[name=module_select_icon_mask]'), 
					module_select_message_type         = jQuery('[name=module_select_message_type]'),
					module_post_html_content           = jQuery('[name=module_post_html_content]'),
					
					module_select_accordion_type       = jQuery('[name=module_select_accordion_type]'),
					module_select_accordion_style      = jQuery('[name=module_select_accordion_style]'),
					module_select_first_item           = jQuery('[name=module_select_first_item]'),
					
					module_select_tabs_type            = jQuery('[name=module_select_tabs_type]'),
					
					module_select_divider_type         = jQuery('[name=module_select_divider_type]'),
					module_select_text_align           = jQuery('[name=module_select_text_align]'),
					module_select_color                = jQuery('[name=module_select_color]'),
					module_select_height               = jQuery('[name=module_select_height]'),
					
					module_select_category             = jQuery('[name=module_select_category]'),
					module_select_orderby              = jQuery('[name=module_select_orderby]'),
					module_select_order                = jQuery('[name=module_select_order]'),
					module_select_columns              = jQuery('[name=module_select_columns]'),
					module_select_rows                 = jQuery('[name=module_select_rows]'),
					
					module_select_list_type            = jQuery('[name=module_select_list_type]'),
					module_select_pagination           = jQuery('[name=module_select_pagination]'),
					module_input_per_page              = jQuery('[name=module_input_per_page]'),
					
					module_input_columns               = jQuery('[name=module_input_columns]'),
					module_switch_carousel             = jQuery('[name=module_switch_carousel]'),
					
					module_image_single                = jQuery('[name=module_image_single]'),
					module_image_media                 = jQuery('[name=module_image_media]'),
					module_select_image_style          = jQuery('[name=module_select_image_style]'),
					module_select_mouseover_effect     = jQuery('[name=module_select_mouseover_effect]'),
					module_select_lightbox             = jQuery('[name=module_select_lightbox]'),
					
					module_switch_position             = jQuery('[name=module_switch_position]'),
					module_switch_social_network       = jQuery('[name=module_switch_social_network]'),
					module_switch_email                = jQuery('[name=module_switch_email]'),
					module_switch_phone_number         = jQuery('[name=module_switch_phone_number]'),
					
					module_select_contact_form_type    = jQuery('[name=module_select_contact_form_type]'),
					module_input_recipient_email       = jQuery('[name=module_input_recipient_email]'),
					module_input_field_text            = jQuery('[name=module_input_field_text]'),
					module_input_button_text           = jQuery('[name=module_input_button_text]'),
					module_textarea_sent_message       = jQuery('[name=module_textarea_sent_message]'),
					module_select_contact_form_7_alias = jQuery('[name=module_select_contact_form_7_alias]'),
					
					module_textarea_embed_code         = jQuery('[name=module_textarea_embed_code]'),
					module_input_m4v                   = jQuery('[name=module_input_m4v]'),
					module_input_ogv                   = jQuery('[name=module_input_ogv]'),
					
					module_textarea_big_text           = jQuery('[name=module_textarea_big_text]'),
					module_textarea_medium_text        = jQuery('[name=module_textarea_medium_text]'),
					module_switch_show_button          = jQuery('[name=module_switch_show_button]'),
					module_select_button_style         = jQuery('[name=module_select_button_style]'),
					module_input_button_link           = jQuery('[name=module_input_button_link]'),
					
					module_input_map_address           = jQuery('[name=module_input_map_address]'),
					module_select_map_zoom             = jQuery('[name=module_select_map_zoom]'),
					module_input_map_height            = jQuery('[name=module_input_map_height]'),
					module_select_map_view             = jQuery('[name=module_select_map_view]'),
					module_switch_map_show_bubble      = jQuery('[name=module_switch_map_show_bubble]'),
					module_switch_map_scroll_mouse     = jQuery('[name=module_switch_map_scroll_mouse]')
					
					module_input_title                 = jQuery('[name=module_input_title]'),
					module_input_content               = jQuery('[name=module_input_content]'),
					module_input_progress              = jQuery('[name=module_input_progress]'),
					
					module_select_slider_image         = jQuery('[name=module_select_slider_image]'),
					module_select_layer_slider         = jQuery('[name=module_select_layer_slider]'),
					
					module_select_image_source         = jQuery('[name=module_select_image_source]'),
					module_select_image_list_type      = jQuery('[name=module_select_image_list_type]'),
					module_select_image_spacing        = jQuery('[name=module_select_image_spacing]'),
					module_select_image_size           = jQuery('[name=module_select_image_size]'),
					module_select_image_ratio          = jQuery('[name=module_select_image_ratio]'),
					
					module_select_portfolio_list_type  = jQuery('[name=module_select_portfolio_list_type]')
					module_select_sortable             = jQuery('[name=module_select_sortable]')
					module_select_hover_effect         = jQuery('[name=module_select_hover_effect]'),
					
					module_select_video_ratio          = jQuery('[name=module_select_video_ratio]'),
					module_select_layer_slider         = jQuery('[name=module_select_layer_slider]'),
					
					module_input_fullwidth_height      = jQuery('[name=module_input_fullwidth_height]'),
					module_select_background           = jQuery('[name=module_select_background]'),
					module_select_background_repeat    = jQuery('[name=module_select_background_repeat]'),
					module_select_background_attachment= jQuery('[name=module_select_background_attachment]'),
					module_select_parallax_ratio       = jQuery('[name=module_select_parallax_ratio]'),
					
					module_select_price_currency       = jQuery('[name=module_select_price_currency]'),
					module_input_price_runtime         = jQuery('[name=module_input_price_runtime]'),
					
					module_select_hover_animation      = jQuery('[name=module_select_hover_animation]'),
				
					module_select_infographic_type     = jQuery('[name=module_select_infographic_type]'),
					module_select_infographic_style    = jQuery('[name=module_select_infographic_style]'),
					module_input_infographic_digit     = jQuery('[name=module_input_infographic_digit]'),
					module_switch_show_background_color= jQuery('[name=module_switch_show_background_color]'),
					module_input_subtitle              = jQuery('[name=module_input_subtitle]'),
					module_input_number_icons          = jQuery('[name=module_input_number_icons]'),
					module_input_number_active_icons   = jQuery('[name=module_input_number_active_icons]'),
					module_switch_social_show          = jQuery('[name=module_switch_social_show]'),
					module_social_medias               = jQuery('[name=module_social_medias]'),
					module_social_medias_url           = jQuery('[name=module_social_medias_url]'),
					module_date_time                   = jQuery('[name=module_date_time]'),
					module_select_count_start          = jQuery('[name=module_select_count_start]'),
					module_select_count_to             = jQuery('[name=module_select_count_to]');        
				
				if(module_content_wrap.is('.tmce-active')){
					content = module_content_ifr.contents().find('#tinymce').html();
				}else{(module_content_wrap.is('.html-active'))
					content = module_content.val();
				}
				
				modal_save_loading.fadeIn();
				
				if(module_post_title.val()){
					var module_post_title_val = module_post_title.val();
				}else{
					var module_post_title_val = '';
				}
				
				jQuery.post(ajaxurl, {
					'action':'CustomPagebuilderAjax',
					'data': {
						'post_id'           : post_id.val(),
						'module_id'         : modal_module_id.val(),
						'module_post_id'    : modal_module_post_id.val(),
						'module_post_title' : module_post_title_val,
						'module_content'    : content,
						'module_post'       : modal_module_post.val(),
						'module_post_meta'  : {
							  'module_id'                           : modal_module_id.val(),
							  'module_content'                      : content,
							  'module_post_title'                   : module_post_title_val,
							  'module_select_icon'                  : module_select_icon.val(),
							  'module_select_icon_location'         : module_select_icon_location.val(),
							  'module_select_icon_mask'             : module_select_icon_mask.val(),
							  'module_background_color'             : module_background_color.val(),
							  'module_lists_layout_bullet'          : pagebuilder_form_array('module_lists_layout_bullet'),
							  'module_lists_layout_title'           : pagebuilder_form_array('module_lists_layout_title'),
							  'module_lists_layout_content'         : pagebuilder_form_array('module_lists_layout_content'),
							  'module_post_html_content'            : module_post_html_content.val(),
							  'module_select_message_type'          : module_select_message_type.val(),
							  'module_select_accordion_type'        : module_select_accordion_type.val(),
							  'module_select_accordion_style'       : module_select_accordion_style.val(),
							  'module_select_first_item'            : module_select_first_item.val(),
							  'module_select_tabs_type'             : module_select_tabs_type.val(),
							  'module_select_divider_type'          : module_select_divider_type.val(),
							  'module_select_text_align'            : module_select_text_align.val(),
							  'module_select_color'                 : module_select_color.val(),
							  'module_select_height'                : module_select_height.val(),
							  'module_select_category'              : module_select_category.val(),
							  'module_select_orderby'               : module_select_orderby.val(),
							  'module_select_order'                 : module_select_order.val(),
							  'module_select_columns'               : module_select_columns.val(),
							  'module_select_rows'                  : module_select_rows.val(),
							  'module_select_list_type'             : module_select_list_type.val(),
							  'module_select_pagination'            : module_select_pagination.val(),
							  'module_input_per_page'               : module_input_per_page.val(),
							  'module_input_columns'                : module_input_columns.val(),
							  'module_switch_carousel'              : module_switch_carousel.val(),
							  'module_image_single'                 : module_image_single.val(),
							  'module_image_media'                  : module_image_media.val(),
							  'module_select_image_style'           : module_select_image_style.val(),
							  'module_select_mouseover_effect'      : module_select_mouseover_effect.val(),
							  'module_select_lightbox'              : module_select_lightbox.val(),
							  'module_switch_position'              : module_switch_position.val(),
							  'module_switch_social_network'        : module_switch_social_network.val(),
							  'module_switch_email'                 : module_switch_email.val(),
							  'module_switch_phone_number'          : module_switch_phone_number.val(),
							  'module_select_contact_form_type'     : module_select_contact_form_type.val(),
							  'module_input_recipient_email'        : module_input_recipient_email.val(),
							  'module_input_field_text'             : module_input_field_text.val(),
							  'module_input_button_text'            : module_input_button_text.val(),
							  'module_textarea_sent_message'        : module_textarea_sent_message.val(),
							  'module_select_contact_form_7_alias'  : module_select_contact_form_7_alias.val(),
							  'module_textarea_embed_code'          : module_textarea_embed_code.val(),
							  'module_input_m4v'                    : module_input_m4v.val(),
							  'module_input_ogv'                    : module_input_ogv.val(),
							  'module_textarea_big_text'            : module_textarea_big_text.val(),
							  'module_textarea_medium_text'         : module_textarea_medium_text.val(),
							  'module_switch_show_button'           : module_switch_show_button.val(),
							  'module_select_button_style'          : module_select_button_style.val(),
							  'module_input_button_link'            : module_input_button_link.val(),
							  'module_cheak_share'                  : pagebuilder_form_array('module_cheak_share'),
							  'module_input_map_address'            : module_input_map_address.val(),
							  'module_select_map_zoom'              : module_select_map_zoom.val(),
							  'module_input_map_height'             : module_input_map_height.val(),
							  'module_select_map_view'              : module_select_map_view.val(),
							  'module_switch_map_show_bubble'       : module_switch_map_show_bubble.val(),
							  'module_switch_map_scroll_mouse'      : module_switch_map_scroll_mouse.val(),
							  'module_input_title'                  : module_input_title.val(),
							  'module_input_progress'               : module_input_progress.val(),
							  'module_select_slider_image'          : module_select_slider_image.val(),
							  'module_select_layer_slider'          : module_select_layer_slider.val(),
							  'module_select_image_source'          : module_select_image_source.val(),
							  'module_select_image_list_type'       : module_select_image_list_type.val(),
							  'module_select_image_spacing'         : module_select_image_spacing.val(),
							  'module_select_image_size'            : module_select_image_size.val(),
							  'module_select_image_ratio'           : module_select_image_ratio.val(),
							  'module_select_gallery_selected'      : pagebuilder_form_array('module_select_gallery_selected'),
							  'module_select_portfolio_list_type'   : module_select_portfolio_list_type.val(),
							  'module_select_sortable'              : module_select_sortable.val(),
							  'module_select_hover_effect'          : module_select_hover_effect.val(),
							  'module_select_video_ratio'           : module_select_video_ratio.val(),
							  'module_select_video_ratio_custom'    : pagebuilder_form_array('module_select_video_ratio_custom'),
							  'module_select_layer_slider'          : module_select_layer_slider.val(),
							  'module_input_fullwidth_height'       : module_input_fullwidth_height.val(),
							  'module_select_background'            : module_select_background.val(),
							  'module_select_background_repeat'     : module_select_background_repeat.val(),
							  'module_select_background_attachment' : module_select_background_attachment.val(),
							  'module_select_parallax_ratio'        : module_select_parallax_ratio.val(),
							  
							  'module_select_price_currency'        : module_select_price_currency.val(),
							  'module_input_price_runtime'          : module_input_price_runtime.val(),
							  'module_input_price_runtime_hide'     : pagebuilder_form_array('module_input_price_runtime_hide'),
							  'module_lists_layout_color'           : pagebuilder_form_array('module_lists_layout_color'),
							  'module_lists_layout_price'           : pagebuilder_form_array('module_lists_layout_price'),
							  'module_lists_layout_button'          : pagebuilder_form_array('module_lists_layout_button'),
							  'module_lists_layout_to_link'         : pagebuilder_form_array('module_lists_layout_to_link'),
							  'module_lists_layout_details'         : pagebuilder_form_array('module_lists_layout_details'),
							  'module_lists_layout_subtitle'        : pagebuilder_form_array('module_lists_layout_subtitle'),
							  'module_lists_layout_progress'        : pagebuilder_form_array('module_lists_layout_progress'),
							  'module_select_hover_animation'       : module_select_hover_animation.val(),
							  'module_switch_show_background_color' : module_switch_show_background_color.val(),
							  'module_input_subtitle'               : module_input_subtitle.val(),
							  'module_select_infographic_type'      : module_select_infographic_type.val(),
							  'module_select_infographic_style'     : module_select_infographic_style.val(),
							  'module_input_infographic_digit'      : module_input_infographic_digit.val(),
							  'module_input_number_icons'           : module_input_number_icons.val(),
							  'module_input_number_active_icons'    : module_input_number_active_icons.val(),
							  'module_input_content'                : module_input_content.val(),
							  'module_switch_social_show'           : module_switch_social_show.val(),
							  'module_social_medias'                : module_social_medias.serializeArray(),
							  'module_social_medias_url'            : module_social_medias_url.serializeArray(),
							  'module_date_time'                    : module_date_time.val(),
							  'module_select_count_start'           : module_select_count_start.val(),
							  'module_select_count_to'              : module_select_count_to.val(),
							  
							  //p4
							  'module_select_style_default'         : pb_m_val('module_select_style_default'),
							  'module_select_image_spacing_blocks'  : pb_m_val('module_select_image_spacing_blocks'),
							  'module_select_loading_block_color'   : pb_m_val('module_select_loading_block_color'),
							  'module_select_expanded_block_width'  : pb_m_val('module_select_expanded_block_width'),
							  'module_input_expanded_block_words'   : pb_m_val('module_input_expanded_block_words'),
							  
							  'module_select_latest_post_layout'    : pb_m_val('module_select_latest_post_layout'),
							  'module_cheak_post_type'              : pagebuilder_form_array('module_cheak_post_type'),
							  'module_input_number_of_items'        : pb_m_val('module_input_number_of_items'),
							  'module_cheak_show_function'          : pagebuilder_form_array('module_cheak_show_function'),
							  'module_cheak_dark_background'        : pagebuilder_form_array('module_cheak_dark_background'),
							  
							  'module_input_hyperlink'              : pb_m_val('module_input_hyperlink'),
							  'module_input_map_address2'           : pb_m_val('module_input_map_address2'),
							  'module_input_google_map_canvas'      : pb_m_val('module_input_google_map_canvas'),
							  'module_input_speed_second'           : pb_m_val('module_input_speed_second'),
							  
							  'module_select_button_size'           : pb_m_val('module_select_button_size'),
							  'module_select_flexslider_animation'  : pb_m_val('module_select_flexslider_animation'),
							  'module_select_revolution_slider'     : pb_m_val('module_select_revolution_slider'),
							  
							  'module_switch_hyperlink'             : pb_m_val('module_switch_hyperlink'),
							  'module_switch_navigation_hint'       : pb_m_val('module_switch_navigation_hint'),
							  'module_switch_testimonials_link'     : pb_m_val('module_switch_testimonials_link'),
							  'module_switch_testimonials_position' : pb_m_val('module_switch_testimonials_position'),
							  'module_switch_via_tab'               : pb_m_val('module_switch_via_tab'),
							  'module_switch_shadow'                : pb_m_val('module_switch_shadow'),
							  'module_switch_spacer_bottom'         : pb_m_val('module_switch_spacer_bottom'),
							  'module_switch_spacer_top'            : pb_m_val('module_switch_spacer_top'),
							  'module_switch_fullwidth_fit'         : pb_m_val('module_switch_fullwidth_fit'),
							  'module_switch_dark_background'       : pb_m_val('module_switch_dark_background'),
							  'module_switch_map_pin'               : pb_m_val('module_switch_map_pin'),
							  'module_switch_previous_next'         : pb_m_val('module_switch_previous_next'),
							  'module_switch_show_verifynumber'     : pb_m_val('module_switch_show_verifynumber'),
							  
							  'module_background_color_rgb'         : pb_m_val('module_background_color_rgb'),
							  
							  'module_tabs_fullwidth_name'          : pb_m_array('module_tabs_fullwidth_name'),
							  'module_tabs_fullwidth_title'         : pb_m_array('module_tabs_fullwidth_title')
							  
						}
					}
				}).done(function(post_id){
					modal_save_loading.hide();
					jQuery('.set_module_post[value='+modal_module_post.val()+']').next('.set_post_id').val(post_id);
					modal_window.modal('hide');
				});
			}
		})

	}
	
	function pagebuilder_module_events(){
		pagebuilder_module_item_remove();
		
		jQuery('.module_date_click').click(function(){
			jQuery(this).datetimepicker({
				timeFormat: 'HH:mm:ss'
			});
		});
		
		jQuery('.item_click').bind('click',function(){
			var _this                     =  jQuery(this),
			
				module_background_color   =  jQuery('[name=module_background_color]'),
				module_select_icon        =  jQuery('[name=module_select_icon]'),
				module_lists_layout       =  jQuery('.module_lists_layout'),
				module_details_item       =  jQuery('.module_details_item');
				
			if(_this.is('[href*=#post_color]')){
				var data_postcolor = _this.data('postcolor'),
				    _this_parents = _this.parents('.module_background_color');
				
				jQuery('[href*=#post_color]').find('i').remove();
				if(_this.is('.bg-cancelcolor')){
					module_background_color.val('');
				}else{
					_this.html('<i class="icon-ok"></i>');
					module_background_color.val(data_postcolor);
				}
				
				_this_parents.find('.module_item_color_switch').val('');
				_this_parents.find('.sp-replacer .sp-preview-inner').css({'background-color':'#ffffff'});
			}
			
			else if(_this.is('.module_icons')){
				var data_moduleicon = _this.find('i').attr('class');
				
				jQuery('.module_icons').removeClass('current');
				_this.addClass('current');
				module_select_icon.val(data_moduleicon);
			}
			
			else if(_this.is('.module_mask')){
				var module_select_icon_mask = jQuery('[name=module_select_icon_mask]');
				
				if(_this.is('.current')){
					var data_mask = '';
					_this.removeClass('current');
				}else{
					var data_mask = _this.data('mask');
					_this.parent().parent().find('.module_mask').removeClass('current');
					_this.addClass('current');
				}
				
				module_select_icon_mask.val(data_mask);
			}
			
			else if(_this.is('.module_item_add')){
				var last_item = _this.parent().parent().parent().find('.module-social-item:last'),
					item_sort = last_item.data('sort'),
					last_sort = item_sort + 1;
					
				last_item.after(last_item.clone());
				
				var last_item = _this.parent().parent().parent().find('.module-social-item:last'),
					tabs_name = last_item.find('[name=module_tabs_fullwidth_name]');
					
				tabs_name.val('Tabs '+ last_sort);
				last_item.attr('data-sort', last_sort);
				last_item.find('.module_text_input').val('');
				last_item.find('.item_click').removeClass('module_item_add_btn module_item_add').addClass('module_item_remove_btn module_item_remove');
				
				pagebuilder_module_item_remove();
			}
			
			else if(_this.is('.image_media_add')){
				var frame = wp.media({
					title : 'Insert Media',
					multiple : false,
					library : { type : 'image'},
					button : { text : 'Insert' }
				});
				
				frame.on('select',function() {
					
					first = frame.state().get('selection').first().toJSON();
					attachments = frame.state().get('selection').toJSON();
	
					_this.parent().next().val(first['url']);
					_this.parent().next().next().attr('src', first['url']);
				});
					
				frame.open();
			}
			
			else if(_this.is('.image_single_add')){
				var fileInput = _this.parent().next('input');
				var fileImg = fileInput.next('img');
				
				modal_iframe.fadeIn().html('<iframe width="100%" height="100%" frameborder="0" src="media-upload.php?type=image"></iframe>');
				pagebuilder_module_pop.slideUp();
				
				window.original_send_to_editor = window.send_to_editor;
				window.send_to_editor = function(html){
			
					if (fileInput) {
						
						fileurl = jQuery('img',html).attr('src');
						fileclass = jQuery('img',html).attr('class').split(" ");
						
						fileInput.val(fileclass[2]+'__'+fileurl);
						fileImg.fadeIn();
						fileImg.attr('src',fileurl);
						
						tb_remove();
			
					} else {
						window.original_send_to_editor(html);
					}
					
					pagebuilder_module_pop.slideDown();
					modal_iframe.fadeOut().html('');
				}
			}
			
			else if(_this.is('.lists_layout')){
				var item_last = jQuery('.lists_item').last().attr('rel');
				var module_id = _this.attr('module_id');
				var item_id = Number(item_last) + 1;
				
				var ajax_data = {
					'mode'       :  'add_item',
					'item_id'    :  item_id,
					'module_id'  :  module_id
				}
				pagebuilder_module_ajax(ajax_data,module_lists_layout.find('.lists_rows'));
				
				if(module_id == 'price'){
					if(jQuery('.lists_item').length >= 3){
						jQuery(this).hide();
					}else{
						jQuery(this).fadeIn();
					}
				}
			}
			
			else if(_this.is('.details_layout')){
				var item_last = jQuery('.details_item').last().attr('rel');
				var module_id = _this.attr('module_id');
				var item_id = Number(item_last) + 1;
				
				var ajax_data = {
					'mode'       :  'add_detail',
					'item_id'    :  item_id,
					'module_id'  :  module_id
				}
				pagebuilder_module_ajax(ajax_data,module_details_item.find('.details_row'));
				
			}
			
			else if(_this.is('.lists_item_close')){
				_this.parent().remove();
				
				if(module_id == 'price'){
					if(jQuery('.lists_item').length > 3){
						jQuery('.lists_layout').hide();
					}else{
						jQuery('.lists_layout').fadeIn();
					}
				}
			}
			
			else if(_this.is('.details_item_close')){
				if(jQuery('.details_item').length > 1){
					_this.parent().remove();
				}
			}
			
			else if(_this.is('.gallery_pages')){
				var paged = _this.text(),
					gallery_pagination = jQuery('.gallery_pagination'),
					gallery_pages = jQuery('.gallery_pages',gallery_pagination);
					module_show_gallery_image_list_loading = jQuery('.module_show_gallery_image_list_loading'),
					module_show_gallery_image_list_content = jQuery('.module_show_gallery_image_list_content');
					
				jQuery('li',gallery_pagination).removeClass('active');
				jQuery('li',gallery_pagination).removeClass('disabled');
				_this.parent().addClass('active');
				
				if(paged == 1){
					jQuery('li:first',gallery_pagination).addClass('disabled');
				}else if(paged == gallery_pages.length){
					jQuery('li:last',gallery_pagination).addClass('disabled');
				}
				
				module_show_gallery_image_list_content.html('');
				module_show_gallery_image_list_loading.fadeIn();
				pagebuilder_load_gallery(paged);
			}
			
			else if(_this.is('.remove_item_image')){
				_this.parent().remove();
				
				if(jQuery('.remove_item_image.item_click').length == 0){
					jQuery('.module_show_gallery_below').show();
					jQuery('.module_show_gallery_selected').hide();
				}
				
			}
			
			else if(_this.is('.lists_item_edit')){
				var _this_rel                      = _this.parent().attr('rel'),
					_this_parent                   = jQuery('.module_lists_layout').parent().parent(),
					
					layout_bullet                  = _this.parent().find('[name*=module_lists_layout_bullet]'),
					layout_title                   = _this.parent().find('[name*=module_lists_layout_title]'),
					layout_content                 = _this.parent().find('[name*=module_lists_layout_content]'),
					
					layout_color                   = _this.parent().find('[name*=module_lists_layout_color]'),
					layout_price                   = _this.parent().find('[name*=module_lists_layout_price]'),
					layout_button                  = _this.parent().find('[name*=module_lists_layout_button]'),
					layout_button_link             = _this.parent().find('[name*=module_lists_layout_to_link]'),
					layout_details                 = _this.parent().find('[name*=module_lists_layout_details]'),
					layout_subtitle                = _this.parent().find('[name*=module_lists_layout_subtitle]'),
					layout_progress                = _this.parent().find('[name*=module_lists_layout_progress]'),
					
					module_select_icon             = jQuery('[name=module_select_icon]'),
					module_post_html_content       = jQuery('[name=module_post_html_content]'),
					module_post_title              = jQuery('[name=module_post_title]'),
					
					module_background_color        = jQuery('[name=module_background_color]'),
					module_input_title             = jQuery('[name=module_input_title]'),
					module_input_subtitle          = jQuery('[name=module_input_subtitle]'),
					module_input_price             = jQuery('[name=module_input_price]'),
					module_input_button_text       = jQuery('[name=module_input_button_text]'),
					module_input_button_link       = jQuery('[name=module_input_button_link]'),
					module_input_progress          = jQuery('[name=module_input_progress]'),
					
					select_icon_parent             = jQuery('.module_select_icon').parent().parent(),
					html_content_parent            = jQuery('.module_post_html_content').parent().parent(),
					
					post_title_parent              = jQuery('.module_post_title').parent().parent(),
					post_content_parent            = jQuery('.module_post_content').parent().parent(),
					select_first_item_parent       = jQuery('.module_select_first_item').parent().parent(),
					select_accordion_style_parent  = jQuery('.module_select_accordion_style').parent().parent(),
					select_accordion_type_parent   = jQuery('.module_select_accordion_type').parent().parent(),
					
					background_color_parent        = jQuery('.module_background_color').parent().parent(),
					input_title_parent             = jQuery('.module_input_title').parent().parent(),
					input_subtitle_parent          = jQuery('.module_input_subtitle').parent().parent(),
					input_price_parent             = jQuery('.module_input_price').parent().parent(),
					details_item_parent            = jQuery('.module_details_item').parent().parent(),
					input_button_text_parent       = jQuery('.module_input_button_text').parent().parent(),
					input_button_link_parent       = jQuery('.module_input_button_link').parent().parent(),
					select_price_currency_parent   = jQuery('.module_select_price_currency').parent().parent(),
					input_price_runtime_parent     = jQuery('.module_input_price_runtime').parent().parent(),
					
					select_tabs_type_parent        = jQuery('.module_select_tabs_type').parent().parent(),
					select_infographic_type_parent = jQuery('.module_select_infographic_type').parent().parent(),
					
					switch_show_background_color_parent = jQuery('.module_switch_show_background_color').parent().parent(),
					input_progress_parent               = jQuery('.module_input_progress').parent().parent(),
					
					module_id                      = _this.attr('module_id');
				
				
				if(module_id == 'accordion_toggle' || module_id == 'tabs'){
					var module_content_ifr         = jQuery('#module_content_ifr'),
						module_content_wrap        = jQuery('#wp-module_content-wrap'),
						module_content             = jQuery('#module_content');
					
					_this_parent.hide();
					select_first_item_parent.hide();
					select_accordion_style_parent.hide();
					select_accordion_type_parent.hide();
					select_tabs_type_parent.hide();
					
					post_title_parent.fadeIn();
					post_content_parent.fadeIn();
					
					module_post_title.val(layout_title.val());
					
					if(module_content_wrap.is('.tmce-active')){
						module_content_ifr.contents().find('body').html(layout_content.val());
					}else{(module_content_wrap.is('.html-active'))
						module_content.val(layout_content.val());
					}
					
				}else if(module_id == 'text_list'){
					
					_this_parent.hide();
					
					select_icon_parent.fadeIn();
					html_content_parent.fadeIn();
					
					jQuery('.module_icons').removeClass('current');
					if(layout_bullet.val()){
						jQuery('i[class='+layout_bullet.val()+']').parent('.module_icons').addClass('current');
					}
					
					module_post_html_content.val(layout_content.val());
					module_select_icon.val(layout_bullet.val());
					
				}else if(module_id == 'price'){
					
					_this_parent.hide();
					select_price_currency_parent.hide();
					input_price_runtime_parent.hide();
					
					background_color_parent.fadeIn();
					input_title_parent.fadeIn();
					input_price_parent.fadeIn();
					details_item_parent.fadeIn();
					input_button_text_parent.fadeIn();
					input_button_link_parent.fadeIn();
					
					module_background_color.val(layout_color.val());
					module_input_title.val(layout_title.val());
					module_input_price.val(layout_price.val());
					module_input_button_text.val(layout_button.val());
					module_input_button_link.val(layout_button_link.val());
					
					jQuery('[href*=#post_color]').find('i').remove();
					if(layout_color.val()){
						jQuery('[href*=#post_color][data-postcolor='+layout_color.val()+']').html('<i class="icon-ok"></i>');
					}
					
					module_details_item.find('.details_row').html('');
					
					var ajax_data = {
						'mode'       :  'load_detail',
						'details'    :  layout_details.val(),
						'item'       :  _this_rel
					}
					pagebuilder_module_ajax(ajax_data,module_details_item.find('.details_row'));
					
				}else if(module_id == 'progress_bar'){
					
					_this_parent.hide();
					select_infographic_type_parent.hide();
					switch_show_background_color_parent.hide();
					
					input_progress_parent.fadeIn();
					input_title_parent.fadeIn();
					background_color_parent.fadeIn();
					
					module_background_color.val(layout_color.val());
					module_input_title.val(layout_title.val());
					module_input_subtitle.val(layout_subtitle.val());
					module_input_progress.val(layout_progress.val());
					
					jQuery('[href*=#post_color]').find('i').remove();
					jQuery('[href*=#post_color][data-postcolor='+layout_color.val()+']').html('<i class="icon-ok"></i>');
					
				}
				
				jQuery('.back_lists').attr('module_id',module_id);
				jQuery('.modal_item_save').attr('module_id',module_id);
				
				jQuery('.modal_save').hide();
				jQuery('.window_close').hide();
				
				jQuery('.modal_item_save').fadeIn();
				jQuery('.back_lists').fadeIn();
				
				jQuery('.modal_item_save').attr('rel',_this_rel);
				
				jQuery('.modal-body').scrollTop(0);
				
			}
			
			else if(_this.is('.back_lists')){
				var _this_rel                      = _this.parent().attr('rel'),
					_this_parent                   = jQuery('.module_lists_layout').parent().parent(),
					
					layout_bullet                  = _this.parent().find('[name*=module_lists_layout_bullet]'),
					layout_title                   = _this.parent().find('[name*=module_lists_layout_title]'),
					layout_subtitle                = _this.parent().find('[name*=module_lists_layout_subtitle]'),
					layout_content                 = _this.parent().find('[name*=module_lists_layout_content]'),
					layout_progress                = _this.parent().find('[name*=module_lists_layout_progress]'),
					layout_color                   = _this.parent().find('[name*=module_lists_layout_color]'),
					
					module_select_icon             = jQuery('[name=module_select_icon]'),
					module_post_html_content       = jQuery('[name=module_post_html_content]'),
					module_post_title              = jQuery('[name=module_post_title]'),
					
					select_icon_parent             = jQuery('.module_select_icon').parent().parent(),
					html_content_parent            = jQuery('.module_post_html_content').parent().parent();
					
					post_title_parent              = jQuery('.module_post_title').parent().parent(),
					post_content_parent            = jQuery('.module_post_content').parent().parent(),
					select_first_item_parent       = jQuery('.module_select_first_item').parent().parent(),
					select_accordion_style_parent  = jQuery('.module_select_accordion_style').parent().parent(),
					select_accordion_type_parent   = jQuery('.module_select_accordion_type').parent().parent(),
					
					background_color_parent        = jQuery('.module_background_color').parent().parent(),
					input_title_parent             = jQuery('.module_input_title').parent().parent(),
					input_subtitle_parent          = jQuery('.module_input_subtitle').parent().parent(),
					input_price_parent             = jQuery('.module_input_price').parent().parent(),
					details_item_parent            = jQuery('.module_details_item').parent().parent(),
					input_button_text_parent       = jQuery('.module_input_button_text').parent().parent(),
					input_button_link_parent       = jQuery('.module_input_button_link').parent().parent(),
					select_price_currency_parent   = jQuery('.module_select_price_currency').parent().parent(),
					input_price_runtime_parent     = jQuery('.module_input_price_runtime').parent().parent(),
					
					select_tabs_type_parent        = jQuery('.module_select_tabs_type').parent().parent(),     
					select_infographic_type_parent = jQuery('.module_select_infographic_type').parent().parent(),
					
					switch_show_background_color_parent = jQuery('.module_switch_show_background_color').parent().parent(),
					input_progress_parent               = jQuery('.module_input_progress').parent().parent(),  
					
					module_id                      = _this.attr('module_id');
					
				
				if(module_id == 'accordion_toggle' || module_id == 'tabs'){
					
					post_title_parent.hide();
					post_content_parent.hide();
					
					_this_parent.fadeIn();
					select_first_item_parent.fadeIn();
					select_accordion_style_parent.fadeIn();
					select_accordion_type_parent.fadeIn();
					select_tabs_type_parent.fadeIn();
					
				}else if(module_id == 'text_list'){
					
					select_icon_parent.hide();
					html_content_parent.hide();
					
					_this_parent.fadeIn();
				}else if(module_id == 'price'){
					
					background_color_parent.hide();
					input_title_parent.hide();
					input_price_parent.hide();
					details_item_parent.hide();
					input_button_text_parent.hide();
					input_button_link_parent.hide();
					
					_this_parent.fadeIn();
					select_price_currency_parent.fadeIn();
					input_price_runtime_parent.fadeIn();
					
				}else if(module_id == 'progress_bar'){
					
					_this_parent.fadeIn();
					select_infographic_type_parent.fadeIn();
					switch_show_background_color_parent.fadeIn();
					
					input_progress_parent.hide();
					input_title_parent.hide();
					background_color_parent.hide();
				
				}
				
				jQuery('.modal_item_save').hide();
				jQuery('.back_lists').hide();
				
				
				jQuery('.window_close').fadeIn();
				jQuery('.modal_save').fadeIn();
				
			}
			
			else  if(_this.is('.modal_item_save')){
				var _this_rel                      = _this.attr('rel'),
					_this_parent                   = jQuery('.module_lists_layout').parent().parent(),
					
					_to_item                       = jQuery('.lists_item[rel='+_this_rel+']'),
					_to_item_title                 = _to_item.find('a'),
					_to_bullet                     = _to_item.find('[name*=module_lists_layout_bullet]'),
					_to_title                      = _to_item.find('[name*=module_lists_layout_title]'),
					_to_subtitle                   = _to_item.find('[name*=module_lists_layout_subtitle]'),
					_to_content                    = _to_item.find('[name*=module_lists_layout_content]'),
					_to_progress                   = _to_item.find('[name*=module_lists_layout_progress]'),
					
					_to_color                      = _to_item.find('[name*=module_lists_layout_color]'),
					_to_price                      = _to_item.find('[name*=module_lists_layout_price]'),
					_to_button                     = _to_item.find('[name*=module_lists_layout_button]'),
					_to_button_link                = _to_item.find('[name*=module_lists_layout_to_link]'),
					_to_details                    = _to_item.find('[name*=module_lists_layout_details]')
					
					module_select_icon             = jQuery('[name=module_select_icon]'),
					module_post_html_content       = jQuery('[name=module_post_html_content]'),
					module_post_title              = jQuery('[name=module_post_title]'),
					
					module_background_color        = jQuery('[name=module_background_color]'),
					module_input_title             = jQuery('[name=module_input_title]'),
					module_input_subtitle          = jQuery('[name=module_input_subtitle]'),
					module_input_progress          = jQuery('[name=module_input_progress]'),
					module_input_price             = jQuery('[name=module_input_price]'),
					module_input_button_text       = jQuery('[name=module_input_button_text]'),
					module_input_button_link       = jQuery('[name=module_input_button_link]'),
					
					select_icon_parent             = jQuery('.module_select_icon').parent().parent(),
					html_content_parent            = jQuery('.module_post_html_content').parent().parent(),
					
					post_title_parent              = jQuery('.module_post_title').parent().parent(),
					post_content_parent            = jQuery('.module_post_content').parent().parent(),
					select_first_item_parent       = jQuery('.module_select_first_item').parent().parent(),
					select_accordion_style_parent  = jQuery('.module_select_accordion_style').parent().parent(),
					select_accordion_type_parent   = jQuery('.module_select_accordion_type').parent().parent(),
					
					background_color_parent        = jQuery('.module_background_color').parent().parent(),
					input_title_parent             = jQuery('.module_input_title').parent().parent(),
					input_subtitle_parent          = jQuery('.module_input_subtitle').parent().parent(),
					input_price_parent             = jQuery('.module_input_price').parent().parent(),
					details_item_parent            = jQuery('.module_details_item').parent().parent(),
					input_button_text_parent       = jQuery('.module_input_button_text').parent().parent(),
					input_button_link_parent       = jQuery('.module_input_button_link').parent().parent(),
					select_price_currency_parent   = jQuery('.module_select_price_currency').parent().parent(),
					input_price_runtime_parent     = jQuery('.module_input_price_runtime').parent().parent(),
					
					select_tabs_type_parent        = jQuery('.module_select_tabs_type').parent().parent(),     
					select_infographic_type_parent = jQuery('.module_select_infographic_type').parent().parent(),
					
					switch_show_background_color_parent = jQuery('.module_switch_show_background_color').parent().parent(),
					input_progress_parent               = jQuery('.module_input_progress').parent().parent(),      
					
					module_id                      = _this.attr('module_id');
				
				if(module_id == 'accordion_toggle' || module_id == 'tabs'){
					var module_content_ifr   = jQuery('#module_content_ifr'),
						module_content_wrap  = jQuery('#wp-module_content-wrap');
						module_content       = jQuery('#module_content');
					
					if(module_content_wrap.is('.tmce-active')){
						content = module_content_ifr.contents().find('#tinymce').html();
					}else{(module_content_wrap.is('.html-active'))
						content = module_content.val();
					}
					
					post_title_parent.hide();
					post_content_parent.hide();
					
					_this_parent.fadeIn();
					select_first_item_parent.fadeIn();
					select_accordion_style_parent.fadeIn();
					select_accordion_type_parent.fadeIn();
					select_tabs_type_parent.fadeIn();
					
					_to_title.val(module_post_title.val());
					_to_content.html(content);
					
					if(module_post_title.val() != ''){
						_to_item_title.html('<i></i> ' + module_post_title.val());
					}
					
					
				}else if(module_id == 'text_list'){
					_to_bullet.val(module_select_icon.val());
					_to_content.val(module_post_html_content.val());
					
					if(module_post_html_content.val() != ''){
						if(module_select_icon.val() != ''){
							_to_item_title.html('<i class="'+module_select_icon.val()+'"></i> ' + module_post_html_content.val());
						}else{
							_to_item_title.html('<i></i> ' + module_post_html_content.val());
						}
					}
					
					select_icon_parent.hide();
					html_content_parent.hide();
					_this_parent.fadeIn();
				
				}else if(module_id == 'price'){
					_to_color.val(module_background_color.val());
					_to_title.val(module_input_title.val());
					_to_price.val(module_input_price.val());
					_to_button.val(module_input_button_text.val());
					_to_button_link.val(module_input_button_link.val());
					_to_details.val(pagebuilder_form_detail('module_details_item_details_icon')+'O_O'+pagebuilder_form_detail('module_details_item_details_text'))
					
					background_color_parent.hide();
					input_title_parent.hide();
					input_price_parent.hide();
					details_item_parent.hide();
					input_button_text_parent.hide();
					input_button_link_parent.hide();
					
					_this_parent.fadeIn();
					select_price_currency_parent.fadeIn();
					input_price_runtime_parent.fadeIn();
					
				}else if(module_id == 'progress_bar'){
					_to_color.val(module_background_color.val());
					_to_title.val(module_input_title.val());
					_to_subtitle.val(module_input_subtitle.val());
					_to_progress.val(module_input_progress.val());
					
					_this_parent.fadeIn();
					select_infographic_type_parent.fadeIn();
					switch_show_background_color_parent.fadeIn();
					
					input_progress_parent.hide();
					input_title_parent.hide();
					background_color_parent.hide();
					
					if(module_input_title.val() != ''){
						_to_item_title.html('<i></i> ' + module_input_title.val());
					}
						
				}
				
				jQuery('.modal_item_save').hide();
				jQuery('.back_lists').hide();
				
				jQuery('.window_close').fadeIn();
				jQuery('.modal_save').fadeIn();
				
				
			}
			return false;
		})
		
		jQuery('.item_change').change(function(){
			var select_name   = jQuery(this).attr('name'),
				select_value  = jQuery(this).val(),
				module_id = jQuery(this).parents('#module_pop_content_prepend').find('#modal_module_id').val();
				
			if(select_name == 'module_select_divider_type'){
				var select_text_align_parent  = jQuery('.module_select_text_align').parent().parent(),
					select_height_parent      = jQuery('.module_select_height').parent().parent(),
					background_color_parent   = jQuery('.module_background_color').parent().parent(),
					post_title_parent         = jQuery('.module_post_title').parent().parent();
					
						
				if(select_value == 'single_line'){
					select_text_align_parent.hide(); 
					select_height_parent.hide();
					post_title_parent.hide();
					
					background_color_parent.fadeIn(); 
				}else if(select_value == 'text_and_line'){
					select_height_parent.hide();
					
					select_text_align_parent.fadeIn(); 
					background_color_parent.fadeIn(); 
					post_title_parent.fadeIn();
				}else if(select_value == 'blank_divider'){
					background_color_parent.hide();
					select_text_align_parent.hide(); 
					post_title_parent.hide();
					
					select_height_parent.fadeIn(); 
				}
			}
			
			else if(select_name == 'module_select_image_list_type'){
				var select_image_ratio_parent = jQuery('.module_select_image_ratio').parent().parent(),
				    select_first_item_parent  = jQuery('.module_select_first_item').parent().parent();
					
				/*if(select_value == 'masonry'){
					select_image_ratio_parent.slideUp();
					select_first_item_parent.slideDown();
				}else{
					select_image_ratio_parent.slideDown();
					select_first_item_parent.slideUp();
				}*/
			}
			
			else if(select_name == 'module_select_image_source'){
				var select_image_ratio_parent      = jQuery('.module_select_image_ratio').parent().parent(),
					select_category_parent         = jQuery('.module_select_category').parent().parent(),
					select_orderby_parent          = jQuery('.module_select_orderby').parent().parent(),
					select_sortable_parent         = jQuery('.module_select_sortable').parent().parent(),
					show_gallery_parent            = jQuery('.module_show_gallery').parent().parent(),
					show_gallery_image_list_parent = jQuery('.module_show_gallery_image_list').parent().parent();
				
				if(select_value == 'image_post'){
					select_category_parent.fadeIn();
					select_orderby_parent.fadeIn();
					select_sortable_parent.fadeIn();
					show_gallery_parent.hide();
					show_gallery_parent.prev('.module_show_line').hide();
					show_gallery_image_list_parent.hide();
					show_gallery_image_list_parent.prev('.module_show_line').hide();
					
				}else{
					select_category_parent.hide();
					select_orderby_parent.hide();
					select_sortable_parent.hide();
					show_gallery_parent.fadeIn();
					show_gallery_parent.prev('.module_show_line').fadeIn();
					show_gallery_image_list_parent.fadeIn();
					show_gallery_image_list_parent.prev('.module_show_line').fadeIn();
				}
				
			}
			
			else if(select_name == 'module_select_video_ratio'){
				var select_video_ratio_custom_parent = jQuery('.module_select_video_ratio_custom');
					
				if(select_value == 'custom'){
					select_video_ratio_custom_parent.fadeIn();
				}else{
					select_video_ratio_custom_parent.fadeOut();
					select_video_ratio_custom_parent.find('.module_text_input').val('');
				}
				
			}
			
			else if(select_name == 'module_select_slider_image'){
				var input_slider_alias_parent = jQuery('.module_select_layer_slider').parent().parent(),
					input_per_page_parent = jQuery('.module_input_per_page').parent().parent(),
					select_category_parent = jQuery('.module_select_category').parent().parent(),
					select_orderby_parent = jQuery('.module_select_orderby').parent().parent(),
					
					flexslider_animation_parent = jQuery('.module_select_flexslider_animation').parent().parent(),
					navigation_hint_parent = jQuery('.module_switch_navigation_hint').parent().parent(),
					previous_next_parent = jQuery('.module_switch_previous_next').parent().parent(),
					speed_second_parent = jQuery('.module_input_speed_second').parent().parent(),
					revolution_slider_parent = jQuery('.module_select_revolution_slider').parent().parent();
					
				if(select_value == 'novo'){
					input_per_page_parent.fadeIn();
					select_category_parent.fadeIn();
					select_orderby_parent.fadeIn();
					
					input_slider_alias_parent.hide();
					flexslider_animation_parent.hide();
					navigation_hint_parent.hide();
					previous_next_parent.hide();
					speed_second_parent.hide();
					revolution_slider_parent.hide();
				}else if(select_value == 'flexslider'){
					input_per_page_parent.fadeIn();
					select_category_parent.fadeIn();
					select_orderby_parent.fadeIn();
					flexslider_animation_parent.fadeIn();
					navigation_hint_parent.fadeIn();
					previous_next_parent.fadeIn();
					speed_second_parent.fadeIn();
					
					input_slider_alias_parent.hide();
					revolution_slider_parent.hide();
				}else if(select_value == 'layerslider'){
					input_slider_alias_parent.fadeIn();
					
					input_per_page_parent.hide();
					select_category_parent.hide();
					select_orderby_parent.hide();
					flexslider_animation_parent.hide();
					navigation_hint_parent.hide();
					previous_next_parent.hide();
					speed_second_parent.hide();
					revolution_slider_parent.hide();
				}else if(select_value == 'revolutionslider'){
					revolution_slider_parent.fadeIn();
					
					input_per_page_parent.hide();
					select_category_parent.hide();
					select_orderby_parent.hide();
					flexslider_animation_parent.hide();
					navigation_hint_parent.hide();
					previous_next_parent.hide();
					speed_second_parent.hide();
					input_slider_alias_parent.hide();
				}
				
			
			}
			
			else if(select_name == 'module_select_icon_location'){
				var select_icon_mask_parent = jQuery('.module_select_icon_mask').parent().parent(),
					background_color_parent = jQuery('.module_background_color').parent().parent(),
					select_hover_animation_parent = jQuery('.module_select_hover_animation').parent().parent();
					
				if(select_value == 'icon_top'){
					select_icon_mask_parent.fadeIn();
					background_color_parent.fadeIn();
					select_hover_animation_parent.fadeIn();
				}else{
					select_icon_mask_parent.hide();
					background_color_parent.hide();
					select_hover_animation_parent.hide();
				}
			}
			
			else if(select_name == 'module_select_contact_form_type'){
				var input_recipient_email_parent = jQuery('.module_input_recipient_email').parent().parent(),
					input_field_text_parent = jQuery('.module_input_field_text').parent().parent(),
					input_button_text_parent = jQuery('.module_input_button_text').parent().parent(),
					textarea_sent_message_parent = jQuery('.module_textarea_sent_message').parent().parent(),
					swich_show_verify_parent = jQuery('.module_switch_show_verifynumber').parent().parent(),
					select_contact_form_7_alias_parent = jQuery('.module_select_contact_form_7_alias').parent().parent();
				
				if(select_value == 'single_field'){
					input_recipient_email_parent.fadeIn();
					input_button_text_parent.fadeIn();
					textarea_sent_message_parent.fadeIn();
					input_field_text_parent.fadeIn();
					swich_show_verify_parent.fadeIn();
					select_contact_form_7_alias_parent.hide();
				}else if(select_value == 'contact_form_7'){
					select_contact_form_7_alias_parent.fadeIn();
					swich_show_verify_parent.hide();
					input_recipient_email_parent.hide();
					input_field_text_parent.hide();
					input_button_text_parent.hide();
					textarea_sent_message_parent.hide();
				}else{
					
					input_recipient_email_parent.fadeIn();
					input_button_text_parent.fadeIn();
					textarea_sent_message_parent.fadeIn();
					swich_show_verify_parent.fadeIn();
					select_contact_form_7_alias_parent.hide();
					input_field_text_parent.hide();
				}
			}
			
			else if(select_name == 'module_select_infographic_type'){
				var select_infographic_style_parent = jQuery('.module_select_infographic_style').parent().parent(),
					select_icon_parent = jQuery('.module_select_icon').parent().parent(),
					
					lists_layout_parent = jQuery('.module_lists_layout').parent().parent(),
					background_color_parent = jQuery('.module_background_color').parent().parent(),
					switch_show_background_color_parent = jQuery('.module_switch_show_background_color').parent().parent(),
					
					input_title_parent = jQuery('.module_input_title').parent().parent(),
					input_subtitle_parent = jQuery('.module_input_subtitle').parent().parent(),
					input_number_icons_parent = jQuery('.module_input_number_icons').parent().parent(),
					input_number_active_icons_parent = jQuery('.module_input_number_active_icons').parent().parent(),
					input_infographic_digit_parent = jQuery('.module_input_infographic_digit').parent().parent(),
					input_progress_parent = jQuery('.module_input_progress').parent().parent();
					
				background_color_parent.find('.module_descriptive_title .lead').hide();
				
				if(select_value == 'bar'){
					select_infographic_style_parent.hide();
					select_icon_parent.hide();
					
					lists_layout_parent.hide();
					background_color_parent.fadeIn();
					switch_show_background_color_parent.fadeIn();
					
					input_title_parent.fadeIn();
					input_subtitle_parent.hide();
					input_number_icons_parent.hide();
					input_number_active_icons_parent.hide();
					input_infographic_digit_parent.hide();
					input_progress_parent.fadeIn();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=0]').show();
					
				}else if(select_value == 'column'){
					select_infographic_style_parent.hide();
					select_icon_parent.hide();
					
					lists_layout_parent.fadeIn();
					background_color_parent.hide();
					switch_show_background_color_parent.fadeIn();
					
					input_title_parent.hide();
					input_subtitle_parent.hide();
					input_number_icons_parent.hide();
					input_number_active_icons_parent.hide();
					input_infographic_digit_parent.hide();
					input_progress_parent.hide();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=0]').show();
					
				}else if(select_value == 'pie'){
					select_infographic_style_parent.fadeIn();
					select_icon_parent.hide();
					
					lists_layout_parent.hide();
					background_color_parent.fadeIn();
					switch_show_background_color_parent.fadeIn();
					
					input_title_parent.fadeIn();
					input_subtitle_parent.fadeIn();
					input_number_icons_parent.hide();
					input_number_active_icons_parent.hide();
					input_infographic_digit_parent.hide();
					input_progress_parent.fadeIn();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=0]').show();
					
				}else if(select_value == 'pictorial'){
					select_infographic_style_parent.hide();
					select_icon_parent.fadeIn();
					
					lists_layout_parent.hide();
					background_color_parent.fadeIn();
					switch_show_background_color_parent.hide();
					
					input_title_parent.fadeIn();
					input_subtitle_parent.hide();
					input_number_icons_parent.fadeIn();
					input_number_active_icons_parent.fadeIn();
					input_infographic_digit_parent.hide();
					input_progress_parent.hide();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=1]').show();
					
				}else if(select_value == 'big_number'){
					select_infographic_style_parent.hide();
					select_icon_parent.hide();
					
					lists_layout_parent.hide();
					background_color_parent.fadeIn();
					switch_show_background_color_parent.hide();
					
					input_title_parent.fadeIn();
					input_subtitle_parent.fadeIn();
					input_number_icons_parent.hide();
					input_number_active_icons_parent.hide();
					input_infographic_digit_parent.fadeIn();
					input_progress_parent.hide();
					
					background_color_parent.find('.module_descriptive_title .lead[data-id=2]').show();
					
				}
					
			}
			
			else if(select_name == 'module_select_count_start'){
				var module_select_count_to = jQuery('[name=module_select_count_to]');
				
				var this_option = jQuery(this).find('option');
				var select_count = jQuery.makeArray(this_option);
				
				var to_option = module_select_count_to.find('option');
				var select_to_count = jQuery.makeArray(to_option);
				
				jQuery.each(select_count,function(i){
					var value = jQuery(this).attr('value');
					if(value == select_value){
						module_select_count_to.find('option').show();
						jQuery.each(select_to_count,function(ii){
							if(ii <= i){
								jQuery(this).hide();
							}
						});
						if(i < select_count.length - 1){
							var next_value = jQuery(this).next().attr('value');
							module_select_count_to.val(next_value);
						}
					}
					
				});
				
			}
			
			else if(select_name == 'module_select_background'){
				var module_select_background_attachment = jQuery('[name=module_select_background_attachment]'),
				
					background_color_parent = jQuery('.module_background_color').parent().parent(),
					image_single_parent = jQuery('.module_image_single').parent().parent(),
					select_background_attachment_parent = jQuery('.module_select_background_attachment').parent().parent(),
					select_parallax_ratio_parent = jQuery('.module_select_parallax_ratio').parent().parent();
					
				if(select_value == 'color'){
					background_color_parent.fadeIn();
					
					image_single_parent.hide();
					select_background_attachment_parent.hide();
					select_parallax_ratio_parent.hide();
				}else{
					background_color_parent.hide();
					
					image_single_parent.fadeIn();
					select_background_attachment_parent.fadeIn();
					
					if(module_select_background_attachment.val() != 'parallax'){
						select_parallax_ratio_parent.hide();
					}else{
						select_parallax_ratio_parent.fadeIn();
					}
				}
				
			}
			
			else if(select_name == 'module_select_background_attachment'){
				var select_parallax_ratio_parent = jQuery('.module_select_parallax_ratio').parent().parent();
				
				if(select_value == 'parallax'){
					select_parallax_ratio_parent.fadeIn();
				}else{
					select_parallax_ratio_parent.hide();
				}
			}
			
			else if(select_name == 'module_select_style_default'){
				var module_select_expanded_block_width = jQuery('[name=module_select_expanded_block_width]'),
					select_mouseover_effect_parent = jQuery('.module_select_mouseover_effect').parent().parent(),
					select_image_siz_parente = jQuery('.module_select_image_size').parent().parent(),
					select_image_ratio_parent = jQuery('.module_select_image_ratio').parent().parent(),
					select_loading_block_color_parent = jQuery('.module_select_loading_block_color').parent().parent();
				
				if(select_value == 'magazine'){
					select_mouseover_effect_parent.hide();
					select_image_siz_parente.hide();
					select_image_ratio_parent.hide();
					select_loading_block_color_parent.hide();
					
					if(module_select_expanded_block_width.val(4)){
						module_select_expanded_block_width.val(2)
						module_select_expanded_block_width.find('option[value=4]').hide();
					}
				}else{
					select_mouseover_effect_parent.fadeIn();
					select_image_siz_parente.fadeIn();
					select_image_ratio_parent.fadeIn();
					select_loading_block_color_parent.fadeIn();
					module_select_expanded_block_width.find('option[value=4]').fadeIn();
				}
			}
			
			else if(select_name == 'module_select_image_size'){
				if(module_id == 'liquid_list'){
					var module_select_expanded_block_width = jQuery('[name=module_select_expanded_block_width]');
					
					if(select_value == 'large'){
						module_select_expanded_block_width.find('option[value=4]').hide();
					}else{
						module_select_expanded_block_width.find('option[value=4]').fadeIn();
					}
				}
			}
			
			else if(select_name == 'module_select_latest_post_layout'){
				var image_ratio_parent = jQuery('.module_select_image_ratio').parent().parent(),
					image_size_parente = jQuery('.module_select_image_size').parent().parent(),
					show_function_parent = jQuery('.module_cheak_show_function').parent().parent();
					text_align_parent = jQuery('.module_select_text_align').parent().parent();
				
				if(select_value == 'vertical_list'){
					image_ratio_parent.hide();
					image_size_parente.hide();
					show_function_parent.hide();
					text_align_parent.hide();
				}else{
					image_ratio_parent.fadeIn();
					image_size_parente.fadeIn();
					show_function_parent.fadeIn();
					text_align_parent.fadeIn();
				}
			}
			
		})
		
		jQuery('.module_switch').off('switch-change');
		jQuery('.module_switch').on('switch-change',function (e, data){
			var value = data.value,
				switch_value = jQuery(this).next('input:hidden');
				
			switch_value.val(value);
			
			if(jQuery(this).is('.module_switch_show_button')){
				
				var background_color_parent = jQuery('.module_background_color').parent().parent(),
					input_button_text_parent = jQuery('.module_input_button_text').parent().parent(),
					input_button_link_parent = jQuery('.module_input_button_link').parent().parent();
				
				if(value == false){
					background_color_parent.slideUp();
					input_button_text_parent.slideUp();
					input_button_link_parent.slideUp();
				}else{
					background_color_parent.slideDown();
					input_button_text_parent.slideDown();
					input_button_link_parent.slideDown();
				}
				
			}
			
			else if(jQuery(this).is('.module_switch_social_show')){
				var social_medias_parent = jQuery('.module_social_medias').parent().parent();
				
				if(value == false){
					social_medias_parent.slideUp();
				}else{
					social_medias_parent.slideDown();
				}
			}
			
			else if(jQuery(this).is('.module_switch_social_network')){
				var social_medias_parent = jQuery('.module_social_medias').parent().parent();
				
				if(value == false){
					social_medias_parent.slideUp();
				}else{
					social_medias_parent.slideDown();
				}
			}
			
			else if(jQuery(this).is('.module_switch_hyperlink')){
				var hyperlink_parent = jQuery('.module_input_hyperlink').parent().parent();
				
				if(value == false){
					hyperlink_parent.slideUp();
				}else{
					hyperlink_parent.slideDown();
				}
			}
			
			else if(jQuery(this).is('.module_switch_via_tab')){
				var tabs_fullwidth_parent = jQuery('.module_tabs_fullwidth').parent().parent();
				
				if(value == false){
					tabs_fullwidth_parent.slideUp();
				}else{
					tabs_fullwidth_parent.slideDown();
				}
			}
			
			else if(jQuery(this).is('.module_switch_dark_background')){
				var dark_background_parent = jQuery('.module_cheak_dark_background').parent().parent();
				
				if(value == false){
					dark_background_parent.slideUp();
				}else{
					dark_background_parent.slideDown();
				}
			}
			
		});
		
	}
	
	function pagebuilder_events(){
		jQuery('.item_click').unbind('click');
		jQuery('.item_click').bind('click',function(){
			var _this = jQuery(this),
				container = _this.parent().parent('.pagebuilder_wrap_item');
				module_container = _this.parent().parent().parent('.pagebuilder_wrap_item');
			
			if(_this.is('.switch_pagebuilder')){
				pagebuilder_switch_control('switch_pagebuilder');
			}
			
			else if(_this.is('.switch_classic')){
				pagebuilder_switch_control('switch_classic');
			}
			
			else if(_this.is('.general_wrap')){
				_this.parents('.btn-group').removeClass('open');
				var ajax_data = {
					'mode'            :  'general_wrap',
					'parent_id'       :  '',
					'parent_title'    :  '1/1',
					'parent_width'    :  'pb_1_1',
					'module_id'       :  '-1',
					'module_post'     :  '-1',
					'module_name'     :  '',
					'module_post_id'  :  '-1'
					
				}
				pagebuilder_create(ajax_data,pagebuilder_wrap_container,'append');
								
			}
			
			else if(_this.is('.fullwidth_wrap')){
				
				_this.parents('.btn-group').removeClass('open');
				var module_post  =  pagebuilder_random_post();
				
				var ajax_data = {
					'mode'            :  'fullwidth_wrap',
					'parent_id'       :  '',
					'parent_title'    :  '1/1',
					'parent_width'    :  'pb_1_1',
					'module_id'       :  '-1',
					'module_post'     :  module_post,
					'module_name'     :  '',
					'module_post_id'  :  ''
					
				}
				pagebuilder_create(ajax_data,pagebuilder_wrap_container,'append');
				
			}
			
			else if(_this.is('.item_increase')){
				if(_this.is('.module_click')){
					var parent_width  =  module_container.parent().parent().data('width'),
						module_width  =  module_container.data('width');
					
					if(parent_width == module_width){
					}else{pagebuilder_change_size('.item_increase',module_container,'module');}
					
				}else if(_this.is('.item_module_click')){pagebuilder_change_size('.item_increase',module_container,'item_module');
				}else{ pagebuilder_change_size('.item_increase',container,'item'); }
			}
			
			else if(_this.is('.item_reduce')){
				if(_this.is('.module_click')){
					var parent_width  =  module_container.parent().parent().data('width'),
						module_width  =  module_container.data('width');
						
					if(module_width == 'pb_1_4'){
					}else{pagebuilder_change_size('.item_reduce',module_container,'module');}
					
				}else if(_this.is('.item_module_click')){pagebuilder_change_size('.item_reduce',module_container,'item_module');
				}else{pagebuilder_change_size('.item_reduce',container,'item');}
			}
			
			else if(_this.is('.item_delete')){
				container.remove();
				pagebuilder_resets();
			}
			
			else if(_this.is('.item_module')){
				var container_rel =  _this.parents('.pagebuilder_wrap_item').attr('rel');
				modal_list_window.modal('show');
				jQuery('.modal_list_window a').removeClass('choose_module');
				jQuery('.modal_list_window a').attr('rel',container_rel);
				
				modal_list_window.modal('show');
				modal_list_window.find('h3').html(jQuery('.pagebuilder_tool_choose .dropdown-toggle').html());
				modal_list_window.find('h3').find('span').remove();
				
				jQuery('.modal_template_window').hide();
				jQuery('.modal_list_window').fadeIn();
			}
			
			else if(_this.is('.module_copy')){
				if(_this.is('.item_module_click')){
					var module_id         = _this.parent().parent().parent().find('.item_module_id').val(),
						module_name       = _this.parent().parent().find('.item_title').text(),
						module_post       = pagebuilder_random_post(),
						module_post_id    = _this.parent().parent().parent().find('.item_module_post_id').val(),
						parent_title      = _this.parent().parent().find('.item_subtitle').text(),
						parent_width      = _this.parent().parent().parent().data('width'),
						this_post         = _this.parent().parent().parent().find('.set_module_post').val(),
						post_id           = jQuery('#post_ID').val();
					
					var ajax_data = {
						'mode'            : 'choose_module',
						'parent_id'       : '',
						'parent_title'    : parent_title,
						'parent_width'    : parent_width,
						'module_id'       : module_id,
						'module_post'     : module_post,
						'module_name'     : module_name,
						'module_post_id'  : module_post_id,
						'this_post'       : this_post,
						'this_post_id'    : post_id
						
					}
					pagebuilder_create(ajax_data,_this.parent().parent().parent(),'after');
					
				}else if(_this.is('.module_click')){
					var module_id         = _this.parent().parent().parent().find('.module_id').val(),
						module_name       = _this.parent().parent().find('.item_title').text(),
						module_post       = pagebuilder_random_post()
						module_post_id    = _this.parent().parent().parent().find('.module_post_id').val(),
						parent_title      = _this.parent().parent().find('.item_subtitle').text(),
						parent_width      = _this.parent().parent().parent().find('.module_width').val().split(" ",1),
						this_post         = _this.parent().parent().parent().find('.set_module_post').val(),
						post_id           = jQuery('#post_ID').val();
						
						container_rel     = _this.parent().parent().parent().parent().parent().attr('rel'),
						container         = jQuery('.pagebuilder_wrap_item.warp_item[rel='+container_rel+']'),
						container_id      = container.attr('rel'),
						container_content = container.find('> .pagebuilder_wrap_item_content');
					
					var ajax_data = {
						'mode'           : 'add_module',
						'parent_id'      : container_id,
						'parent_title'   : parent_title,
						'parent_width'   : parent_width,
						'module_id'      : module_id,
						'module_post'    : module_post,
						'module_name'    : module_name,
						'module_post_id' : module_post_id,
						'this_post'      : this_post,
						'this_post_id'   : post_id
						
					}
					pagebuilder_create(ajax_data,_this.parent().parent().parent(),'after');
					
				}
				
			}
			
			else if(_this.is('.add_module')){
				var module_id    =  _this.attr('module-id'),
					module_name  =  _this.text(),
					module_post  =  pagebuilder_random_post();
				
				modal_list_window.modal('hide');
				
				if(_this.is('.choose_module')){
					_this.parents('.btn-group').removeClass('open');
					var ajax_data = {
						'mode'            :  'choose_module',
						'parent_id'       :  '',
						'parent_title'    :  '1/1',
						'parent_width'    :  'pb_1_1',
						'module_id'       :  module_id,
						'module_post'     :  module_post,
						'module_name'     :  module_name,
						'module_post_id'  :  ''
						
					}
					pagebuilder_create(ajax_data,pagebuilder_wrap_container,'append');
				}else{
					var container_rel      =  _this.attr('rel'),
						container          =  jQuery('.pagebuilder_wrap_item.warp_item[rel='+container_rel+']'),
						container_id       =  container.attr('rel'),
						container_content  =  container.find('> .pagebuilder_wrap_item_content'),
						parent_width       =  container.find('> .item_width').val().split(" ",1),
						parent_title       =  container.find('> .pagebuilder_wrap_item_title > .item_subtitle').text();
					
					pagebuilder_module_menu.slideUp();
					
					var ajax_data = {
						'mode'            :  'add_module',
						'parent_id'       :  container_id,
						'parent_title'    :  parent_title,
						'parent_width'    :  parent_width,
						'module_id'       :  module_id,
						'module_post'     :  module_post,
						'module_name'     :  module_name,
						'module_post_id'  :  ''
						
					}
					pagebuilder_create(ajax_data,container_content,'append');
				}
				
			}
			
			else if(_this.is('.module_remove')){
				module_container.remove();
				pagebuilder_resets();
			}
			
			else if(_this.is('.module_edit')){
				var modal_loading =  jQuery('.modal_loading');
				
				if(_this.is('.item_setting')){
					var module_title = module_container.find('> .pagebuilder_wrap_item_title > .item_subtitle').html();
				}else{
					var module_title = module_container.find('> .pagebuilder_wrap_item_module > .pagebuilder_wrap_item_module_name > .item_title').html();
				}
				
				jQuery('[data-module]').hide();
				jQuery('.modal_save').fadeIn();
				jQuery('.modal_item_save').hide();
				jQuery('.window_close').fadeIn();
				jQuery('.back_lists').hide();
				module_pop_content_prepend.html('');
				module_pop_content_append.html('');
				pagebuilder_module_pop.show();
				modal_iframe.hide().html('');
				
				modal_loading.show();
				modal_window_title.html(module_title);
				modal_window.modal('show');
				
				if(_this.is('.item_module_click')){
					var module_id,
						module_post     =  module_container.find('> .item_module_post').val(),
						module_post_id  =  module_container.find('> .item_module_post_id').val();
							
					if(_this.is('.item_setting')){
						module_id = 'fullwidth';
					}else{
						module_id = module_container.find('> .item_module_id').val();
					}
				}else{
					var module_id       =  module_container.find('> .module_id').val(),
						module_post     =  module_container.find('> .module_post').val(),
						module_post_id  =  module_container.find('> .module_post_id').val();
				}
				
				var ajax_data = {
					'module_id'       : module_id,
					'module_post'     : module_post,
					'module_post_id'  : module_post_id,
					'post_id'         : jQuery('#post_ID').val()
					
				}
				pagebuilder_module_edit(ajax_data);
			}
			return false;
		});
	}
	
	modal_window.on('hidden', function () {
		var module_content_ifr   =  jQuery('#module_content_ifr'),
			module_content_wrap  =  jQuery('#wp-module_content-wrap');
			module_content       =  jQuery('#module_content');

		if(module_content_wrap.is('.tmce-active')){
			module_content_ifr.contents().find('body').html('');
		}else{(module_content_wrap.is('.html-active'))
			module_content.val('');
		}
		
		module_pop_content_prepend.html('');
		module_pop_content_append.html('');
		pagebuilder_module_pop.show();
		modal_iframe.hide().html('');
    })
	
	jQuery('.custom-window-toggle .dropdown-toggle').click(function(e){
        modal_list_window.modal('show');
		modal_list_window.find('h3').html(jQuery(this).html());
		modal_list_window.find('h3').find('span').remove();
		jQuery('.modal_template_window').hide();
		jQuery('.modal_list_window').fadeIn();
		if(jQuery('.modal_list_window a').not('.choose_module')){
			jQuery('.modal_list_window a').addClass('choose_module')
		}
		return false;
    }); 
	
	jQuery('.save_current_template').click(function(){
		modal_list_window.modal('show');
		modal_list_window.find('.modal-header').hide();
		jQuery('.modal_list_window').hide();
		jQuery('.modal_template_window').fadeIn();
		jQuery('.modal_template_window #load_a_template').hide();
		jQuery('.modal_template_window #save_current_template').fadeIn();
	});
	
	jQuery('.load_a_template').click(function(){
		modal_list_window.modal('show');
		modal_list_window.find('.modal-header').hide();
		jQuery('.modal_list_window').hide();
		jQuery('.modal_template_window').fadeIn();
		jQuery('.modal_template_window #save_current_template').hide();
		jQuery('.modal_template_window #load_a_template').fadeIn();
	});
	
	jQuery('.modal_template_save').click(function(){
		jQuery(this).parent().find('.modal_template_loading').show();
		var ajax_data = {
			'mode'              : 'save',
			'title'             : modal_template_title.val(),
			'post_id'           : jQuery('#post_ID').val(),
			'module_post_meta'  : {
				'pagebuilder_item_width'          : pagebuilder_form_array('pagebuilder_item_width'),
				'pagebuilder_item_module_id'      : pagebuilder_form_array('pagebuilder_item_module_id'),
				'pagebuilder_item_module_post'    : pagebuilder_form_array_post('pagebuilder_item_module_post'),
				'pagebuilder_item_module_post_id' : pagebuilder_form_array('pagebuilder_item_module_post_id'),
				
				'pagebuilder_module_parent'       : pagebuilder_form_array('pagebuilder_module_parent'),
				'pagebuilder_module_width'        : pagebuilder_form_array('pagebuilder_module_width'),
				'pagebuilder_module_id'           : pagebuilder_form_array('pagebuilder_module_id'),
				'pagebuilder_module_post'         : pagebuilder_form_array_post('pagebuilder_module_post'),
				'pagebuilder_module_post_id'      : pagebuilder_form_array('pagebuilder_module_post_id')
			}
			
		}
		pagebuilder_template_ajax(ajax_data);
	});
	
	jQuery('.modal_template_remove').click(function(){
		jQuery(this).parent().parent().find('.modal_template_loading').show();
		var modal_template_post_select = jQuery('[name=modal_template_post_select]');
		var ajax_data = {
			'mode'    : 'remove',
			'post_id' : modal_template_post_select.val()
		}
		pagebuilder_template_ajax(ajax_data);
	});
	
	jQuery('.modal_template_load').click(function(){
		jQuery(this).parent().parent().find('.modal_template_loading').show();
		var modal_template_post_select = jQuery('[name=modal_template_post_select]');
		var ajax_data = {
			'mode'         : 'load',
			'this_post_id' : jQuery('#post_ID').val(),
			'post_id'      : modal_template_post_select.val()
		}
		pagebuilder_template_ajax(ajax_data);
	});
	
	function modal_template_item(){
		jQuery('.modal_template_item').unbind('click');
		jQuery('.modal_template_item').bind('click',function(){
			jQuery(this).stop().animate({'padding-top':'5%','padding-bottom':'5%'});
			return false;
		})
	}
	
	modal_template_item();
	pagebuilder_resets();
	pagebuilder_sortable();
	pagebuilder_events();
});