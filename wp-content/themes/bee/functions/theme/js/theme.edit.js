jQuery(document).ready(function() {
	
	jQuery('.inline-edit-save .save').click(function() {
		var edit_id = jQuery(this).parents('.inline-edit-row').attr('id'),
		    post_id = edit_id.replace('edit-','');
		
		
		//jQuery.post(ajaxurl, {
//			'action':'CustomThemeInlineEdit',
//			'data': {
//				'post_id' : post_id
//			}
//		}).done(function(content){
//			jQuery('#post-' + post_id).append('<td class="column_category column-column_category"><?php echo trim($output, $separator); ?></td>');
//		})
	});
});