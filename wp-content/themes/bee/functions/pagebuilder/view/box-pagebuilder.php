<?php $module_fields = ux_module_fields(); ?>

<div id="pagebuilder_tools">
    <div class="btn-group pagebuilder_tool_wrap">
        <button class="button button-large dropdown-toggle" data-toggle="dropdown"><span class="btn-add-wrap"></span> <?php _e('Wrap','ux');?></button>
        <ul class="dropdown-menu nav nav-pills nav-stacked">
            <li><a href="#" class="general_wrap item_click"><?php _e('General Wrap','ux');?></a></li>
            <li><a href="#" class="fullwidth_wrap item_click"><?php _e('FullWidth Wrap','ux');?></a></li>
        </ul>
    </div>
    <div class="btn-group pagebuilder_tool_choose custom-window-toggle">
        <button class="button button-large dropdown-toggle"><?php _e('Choose Module','ux');?> <span class="btn-choose-module"></span></button>
    </div>
    <div class="btn-group pagebuilder_tool_template">
        <button class="button button-large dropdown-toggle" data-toggle="dropdown"><?php _e('Template','ux');?> <span class="btn-choose-module"></span></button>
        <ul class="dropdown-menu nav nav-pills nav-stacked">
            <li><a href="#" class="save_current_template"><?php _e('Save Current Layout as a Template','ux');?></a></li>
            <li class="divider"></li>
            <li><a href="#" class="load_a_template"><?php _e('Load a Template','ux');?></a></li>
        </ul>
    </div>
</div>
<div id="pagebuilder_container">
    <div id="pagebuilder_wrap_container" class="item_connect">
        <?php 
		if(ux_custom_meta('pagebuilder_item_width') != ''){
			foreach(ux_custom_meta('pagebuilder_item_width') as $num => $width){
                CustomWrapItemContainer($num, $width, 'n', $module_fields);
			}
		}
		?>
    </div>
</div>
<div id="showModalListWindow" class="modal hide fade">
    <div class="modal-header">
        <h3><?php _e('Choose Module','ux');?></h3>
    </div>
    <ul class="modal_list_window">
		<?php foreach($module_fields as $field): 
            if($field['display'] != 'none'):?>
            <li><a href="#" class="choose_module add_module item_click set_module_icons <?php echo $field['icon']; ?>" module-id="<?php echo $field['id']; ?>"><?php echo $field['name']; ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <div class="modal_template_window">
        <div id="save_current_template">
            <div class="modal_template_select">
                <div class="row-fluid">
                    <div class="span4">
                        <div class="module_descriptive_title" data-module="">
                            <strong class="lead"><?php _e('Template Name','ux');?></strong>
                        </div>
                    </div>
                    <div class="span8">
                        <input type="text" value="" class="span12" name="modal_template_title">
                    </div>
                </div>
            </div>
            <div id="modal_template_save" class="row-fluid">
                <button class="btn modal_template_save modal_save" type="button"><?php _e('Save','ux');?></button>
                <div class="modal_template_loading"></div>
            </div>
        </div>
        <div id="load_a_template">
            <div class="modal_template_select">
                <div class="row-fluid">
                    <div class="span4">
                        <div class="module_descriptive_title" data-module="">
                            <strong class="lead"><?php _e('Select Template','ux');?></strong>
                        </div>
                    </div>
                    <div class="span8">
                        <select class="span12"  name="modal_template_post_select">
							<?php 
                            $template_post = get_posts(array(
                                'posts_per_page' => -1,
                                'post_type'      => 'custom_template'
                            ));
                            
                            foreach($template_post as $t_p){ ?>
                                <option value="<?php echo $t_p->ID; ?>"><?php echo get_the_title($t_p->ID); ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div id="modal_template_save" class="row-fluid">
                <button class="btn modal_template_load modal_save" type="button"><?php _e('Load','ux');?></button>
                <button class="btn modal_template_remove modal_save" type="button"><?php _e('Remove','ux');?></button>
                <div class="modal_template_loading"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div id="showModalWindow" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close window_close" data-dismiss="modal" aria-hidden="true"></button>
        <a href="#" class="back_lists item_click"><?php _e('Back Lists','ux');?></a>
        <h3 id="showModalTitle"></h3>
    </div>
    <div class="modal-body">
        <div class="modal_loading"></div>
        <div id="pagebuilder_module_pop">
			<?php require_once locate_template('/functions/pagebuilder/pagebuilder-modules-pop.php'); ?>
        </div>
        <div class="modal_iframe"></div>
    </div>
    <div class="modal-footer">
        <div class="modal_save_loading"></div>
        <a class="modal_save item_click" href="#"><?php _e('Save','ux');?></a>
        <a class="modal_item_save item_click" href="#"><?php _e('Save Item','ux');?></a>
    </div>
</div>