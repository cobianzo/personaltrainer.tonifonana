<?php if(get_post_type() == 'post' || get_post_type() == 'page'): ?>
<div id="pagebuilder_switch">
    <input type="button" class="btn btn-info switch_pagebuilder item_click" value="<?php _e('Switch to Page Builder','ux');?>" />
    <input type="button" class="btn switch_classic item_click" value="<?php _e('Classic Editor','ux');?>" />
    <input type="hidden" class="switch_value" value="<?php echo ux_custom_meta('pagebuilder_switch'); ?>" name="pagebuilder_switch" />
</div>
<?php endif; ?> 