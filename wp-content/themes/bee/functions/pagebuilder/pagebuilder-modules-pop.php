<div class="module_pop_item">
    <div class="module_pop_content">
        <div id="module_pop_content_prepend"></div>
        <div class="row-fluid" data-module="text_block icon_box accordion_toggle tabs">
            <div class="span4">
                <div class="module_descriptive_title" data-module="text_block">
                    <strong class="lead"><?php _e('Enter Content','ux');?></strong><br />
                    <span class="muted"><?php _e('Enter some content for this Text Block.','ux');?></span>
                </div>
                <div class="module_descriptive_title" data-module="icon_box accordion_toggle tabs">
                    <strong class="lead"><?php _e('Content','ux');?></strong><br />
                    <span class="muted"><?php _e('Enter content for this Icon Box','ux');?></span>
                </div>
            </div>
            
            <div class="span8">
                <div class="module_post_content" data-module="text_block icon_box accordion_toggle tabs">
				<?php
                wp_editor('', 'module_content',
                    array(
                        'quicktags' => 1,
                        'tinymce' => 1,
                        'media_buttons' => 1,
                        'textarea_rows' => 10
                ));
                ?>
                </div>
            </div>
            
        </div>
        <div id="module_pop_content_append"></div>
    </div>
</div>