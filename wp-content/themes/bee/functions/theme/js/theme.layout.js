jQuery(document).ready(function() {
	
	var post_pagebuilder_box    = jQuery('#post-pagebuilder-box'),
		normal_sortables        = jQuery('#normal-sortables'),
		formatdiv               = jQuery('#formatdiv'),
		post_ID                 = jQuery('#post_ID'),
		postexcerpt             = jQuery('#postexcerpt'),
		commentstatusdiv        = jQuery('#commentstatusdiv'),
		post_type               = jQuery('#post_type'),
		screen_options_wrap     = jQuery('#screen-options-wrap');
	
	jQuery('[for=post-format-gallery]').text('Portfolio');
	
	function post_option_ajax(_this_cheack){
		formatdiv.find('.hndle span').append('<span class="spinner" style="display:block;"></span>');
		jQuery.post(ajaxurl, {
			'action':'CustomPostOptionAjax',
			'data': {
				'option'  : _this_cheack,
				'post_id' : post_ID.val()
			}
		}).done(function(content){
			if(post_pagebuilder_box.length != 0){
				post_pagebuilder_box.after(content);
				post_option_gallery(1);
			}else{
				normal_sortables.prepend(content);
			}
			
			var post_format_option_box = jQuery('#post-format-option-box'),
				post_option_box = jQuery('#post-option-box'),
				post_option_select_audio_layout = jQuery('[name=post_option_select_audio_layout]'),
				option_textarea_soundcloud_parent = jQuery('.post_option_textarea_soundcloud').parent().parent(),
				option_mp3_parent = jQuery('.post_option_mp3').parent().parent(),
				option_input_artist_parent = jQuery('.post_option_input_artist').parent().parent();
				
			post_format_option_box.slideDown();
			post_option_box.slideDown();
			formatdiv.find('.spinner').remove();
			
			if(post_option_select_audio_layout.val() == 'post_soundcloud'){
				option_mp3_parent.hide();
				option_input_artist_parent.hide();
				
				option_textarea_soundcloud_parent.fadeIn();
			}else{
				option_textarea_soundcloud_parent.hide();
				
				option_mp3_parent.fadeIn();
				option_input_artist_parent.fadeIn();	
			}
			
			jQuery('.post_option_checkbox').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
			post_theme_events();
		});
		
	}
	
	function post_option_gallery(data){
		var post_option_gallery_image_list = jQuery('.post_option_gallery_image_list'),
			post_option_gallery_image_list_content = post_option_gallery_image_list.find('.post_option_gallery_image_list_content'),
			post_option_gallery_image_list_loading = post_option_gallery_image_list.find('.post_option_gallery_image_list_loading');
		
		post_option_gallery_image_list_loading.show();
		
		jQuery.post(ajaxurl, {
			'action':'CustomPostOptionAjaxGallery',
			'data': data
		}).done(function(content){
			post_option_gallery_image_list_content.html(content);
			post_option_gallery_image_list_loading.hide();
			
			post_gallery_selected();
			jQuery('.post_gallery_selected').each(function(index, element) {
				jQuery(this).click(function(){
					var _this = jQuery(this),
						gallery_img = _this.attr('rel'),
						gallery_img_id = _this.attr('attid'),
						post_option_gallery_selected = jQuery('.post_option_gallery_selected'),
						post_option_gallery_below = jQuery('.post_option_gallery_below'),
						post_option_gallery_selected = jQuery('.post_option_gallery_selected');
					
					post_option_gallery_below.hide();
					post_option_gallery_selected.fadeIn();
					post_option_gallery_selected.append('<li><span class="remove_item_image post_click"></span><img src="'+gallery_img+'" /><input type="hidden" name="post_option_gallery_selected[]" value="'+gallery_img_id+'" /></li>');
					
					post_theme_events();
					post_option_gallery_selected.sortable();
					post_gallery_selected();
					
					return false;
				})
            });
			
		});
		
	}
	
	if(post_type.val() == 'post'){
		commentstatusdiv.show();
		
		if(jQuery('[name=post_format]:checked')){
			var _this_cheack = jQuery('[name=post_format]:checked').val();
			
			if(_this_cheack == 'gallery'){
				post_option_gallery(1);
			}
			if(_this_cheack == 'gallery' || _this_cheack == '0' || _this_cheack == 'image'){
				postexcerpt.fadeIn();
			}
			post_option_ajax(_this_cheack);
		}
		
		jQuery('[name=post_format]').click(function(){
			var _this_cheack            = jQuery(this).val(),
				post_format_option_box  = jQuery('#post-format-option-box'),
				post_option_box         = jQuery('#post-option-box');
				
			post_format_option_box.slideUp(function(){
				jQuery(this).remove();
			});
			
			post_option_box.slideUp(function(){
				jQuery(this).remove();
			});
			
			if(_this_cheack == 'gallery'){
				post_option_gallery(1);
			}
			
			if(_this_cheack == 'gallery' || _this_cheack == '0' || _this_cheack == 'image'){
				postexcerpt.fadeIn();
			}else{
				postexcerpt.hide();
			}
			
			post_option_ajax(_this_cheack);
			
		});
	}else if(post_type.val() == 'page'){
		commentstatusdiv.hide();
		post_option_ajax('page');
	}
	
	function post_theme_events(){
		jQuery('.post_option_add_btn').unbind('click');
		jQuery('.post_click').bind('click',function(){
			var _this                      = jQuery(this),
				post_background_color      = jQuery('[name=post_background_color]'),
				post_option_select_sidebar = jQuery('[name=post_option_select_sidebar]'),
				post_option_select_audio_layout = jQuery('[name=post_option_select_audio_layout]'),
				option_textarea_soundcloud_parent = jQuery('.post_option_textarea_soundcloud').parent().parent(),
				option_mp3_parent = jQuery('.post_option_mp3').parent().parent(),
				option_input_artist_parent = jQuery('.post_option_input_artist').parent().parent();
			
			if(_this.is('[href*=#post_color]')){
				var data_postcolor = _this.data('postcolor');
				
				jQuery('[href*=#post_color]').find('i').remove();
				_this.html('<i class="icon-ok"></i>');
				post_background_color.val(data_postcolor);
			}
			
			else if(_this.is('.select_sidebar')){
				var data_sidebar = _this.data('sidebar');
				
				jQuery('.select_sidebar').removeClass('checked');
				_this.addClass('checked');
				
				post_option_select_sidebar.val(data_sidebar);
				
			}
			
			else if(_this.is('.select_layout')){
				var data_layout = _this.data('layout');
				
				jQuery('.select_layout').removeClass('checked');
				_this.addClass('checked');
				
				post_option_select_audio_layout.val(data_layout);
				
				if(data_layout == 'post_soundcloud'){
					option_mp3_parent.hide();
					option_input_artist_parent.hide();
					
					option_textarea_soundcloud_parent.fadeIn();
				}else{
					option_textarea_soundcloud_parent.hide();
					
					option_mp3_parent.fadeIn();
					option_input_artist_parent.fadeIn();	
				}
				
			}
			
			else if(_this.is('.post_option_add_btn')){
				var _parent = _this.parent().parent().parent();
					_name = _parent.attr('class'),
				    text_title = _this.parent().parent().find('[name*='+_name+'_title]').attr('placeholder'),
					text_url = _this.parent().parent().find('[name*='+_name+'_url]').attr('placeholder');
				
				_parent.append('<div class="row-fluid"><input name="'+_name+'_title[]" class="post_option_text_input span3" type="text" value="" placeholder="'+text_title+'" /><input name="'+_name+'_url[]" class="post_option_text_input span6" type="text" value="" placeholder="'+text_url+'" /><div class="span2"><div class="post_option_remove_btn post_click"></div></div></div>');
				
				post_theme_events();
				
			}
			
			else if(_this.is('.post_option_remove_btn')){
				_this.parent().parent().remove();
				
			}
			
			else if(_this.is('.remove_item_image')){
				_this.parent().remove();
				
				if(jQuery('.remove_item_image.post_click').length == 0){
					jQuery('.post_option_gallery_below').show();
					jQuery('.post_option_gallery_selected').hide();
				}
				
			}
			
			else if(_this.is('.post_gallery_pages')){
				var paged = _this.text(),
					gallery_pagination = jQuery('.post_option_gallery_pagination'),
					gallery_pages = jQuery('.post_gallery_pages',gallery_pagination);
					module_show_gallery_image_list_loading = jQuery('.post_option_gallery_image_list_loading'),
					module_show_gallery_image_list_content = jQuery('.post_option_gallery_image_list_content'),
					option_textarea_soundcloud_parent = jQuery('.post_option_textarea_soundcloud').parent().parent(),
					option_mp3_parent = jQuery('.post_option_mp3').parent().parent(),
					option_input_artist_parent = jQuery('.post_option_input_artist').parent().parent();
					
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
				post_option_gallery(paged);
			}
			
			return false;
			
		});
		
	}
	
	function post_gallery_selected(){
		jQuery('.post_gallery_selected').each(function(index, element) {
			var _this_height = jQuery(this).height();
			var _this_width = jQuery(this).width();
			var _this_padding = _this_width * .05;
			var _this_parent_height = jQuery(this).parent().height();
			
			jQuery(this).parent().height(jQuery(this).parent().width());
			jQuery(this).height(_this_width);
			
		});
		
		jQuery('.post_option_gallery_selected li').each(function(index, element) {
			var _this_width = jQuery(this).width();
			var _this_height = jQuery(this).height();
			var _this_img_height = jQuery(this).find('img').height();
			var _this_img_width = jQuery(this).find('img').width();
			jQuery(this).height(Number(_this_width) * 0.7);
		});
		
	}
	
	jQuery(window).resize(function(){
		post_gallery_selected();
		
	});
});