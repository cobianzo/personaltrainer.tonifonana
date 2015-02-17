<?php if(get_post_type() == 'team'): ?>

    <div class="post_option_content">
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Position', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_team_position">
					<?php $post_type_team_position = get_post_meta(get_the_ID(), 'post_type_team_position', true);?>
                    <input name="post_type_team_position" class="post_option_text_input span10" type="text" value="<?php echo $post_type_team_position; ?>" />
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Email', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_team_email">
					<?php $post_type_team_email = get_post_meta(get_the_ID(), 'post_type_team_email', true);?>
                    <input name="post_type_team_email" class="post_option_text_input span10" type="text" value="<?php echo $post_type_team_email; ?>" />
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Phone Number', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_team_phone_number">
					<?php $post_type_team_phone_number = get_post_meta(get_the_ID(), 'post_type_team_phone_number', true);?>
                    <input name="post_type_team_phone_number" class="post_option_text_input span10" type="text" value="<?php echo $post_type_team_phone_number; ?>" />
                </div>
            </div>
        </div>
        <div class="post_option_show_line"></div>
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Social Networks', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_team_social_networks">
                    <div class="row-fluid">
                        <div class="span10"><div class="post_option_add_btn team_social_add"></div></div>
                    </div>
                    <?php 
					$post_type_team_social_networks = get_post_meta(get_the_ID(), 'post_type_team_social_networks', true);
					$post_type_team_social_networks_url = get_post_meta(get_the_ID(), 'post_type_team_social_networks_url', true);
					global $social_networks;
					
					if($post_type_team_social_networks):
						$i = 0;
						for($i=0; $i<count($post_type_team_social_networks); $i++){?>
							<div class="row-fluid">
                                <select name="post_type_team_social_networks[]" class="span3">
                                    <?php foreach($social_networks as $social){
										if($post_type_team_social_networks){
											if($post_type_team_social_networks[$i] == $social['icon']){
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
                                <input name="post_type_team_social_networks_url[]" class="post_option_text_input span6" type="text" value="<?php echo $post_type_team_social_networks_url[$i]; ?>" />
                                <div class="span2"><div class="post_option_remove_btn team_social_remove"></div></div>
                                
                            </div>
							
                            
						<?php
						}
					
					?>
                    
                    <?php else: ?>
                        <div class="row-fluid">
                            <select name="post_type_team_social_networks[]" class="span3">
                                <?php foreach($social_networks as $social){
                                        echo '<option value="'.$social['slug'].'">'.$social['name'].'</option>';
                                    
                                }?>
                            </select>
                            <input name="post_type_team_social_networks_url[]" class="post_option_text_input span6" type="text" value="<?php echo $post_type_team_social_networks_url; ?>" />
                            <div class="span2"><div class="post_option_remove_btn team_social_remove"></div></div>
                            
                        </div>
                        
					<?php endif; ?>
                    <script type="text/javascript">
					jQuery(document).ready(function() {
						function team_social_remove(){
							jQuery('.team_social_remove').click(function(){
								if(jQuery('.team_social_remove').length > 1){
									jQuery(this).parent().parent().remove();
								}
								
							});
						}
						
						//$('.hello').clone()
						jQuery('.team_social_add').click(function(){
							var post_type_team_social_networks = jQuery('[name*=post_type_team_social_networks]:first');
							
							jQuery('.post_type_team_social_networks').append('<div class="row-fluid"><select name="post_type_team_social_networks[]" class="span3"><?php foreach($social_networks as $social):?><option value="<?php echo $social["slug"]; ?>"><?php echo $social["name"]; ?></option><?php endforeach; ?></select><input name="post_type_team_social_networks_url[]" class="post_option_text_input span6" type="text" value="" /><div class="span2"><div class="post_option_remove_btn team_social_remove"></div></div></div>');
							
							team_social_remove();
							
						});
						team_social_remove();
					});
					</script>
                </div> 
            </div>
        </div>
    </div>

<?php elseif(get_post_type() == 'clients'): ?>

    <div class="post_option_content">
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Client Link', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_client_link">
					<?php $post_type_client_link = get_post_meta(get_the_ID(), 'post_type_client_link', true);?>
                    <input name="post_type_client_link" class="post_option_text_input span10" type="text" value="<?php echo $post_type_client_link; ?>" />
                </div>
            </div>
        </div>
    </div>


<?php elseif(get_post_type() == 'testimonials'): ?>

    <div class="post_option_content">
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Testimonial Cite', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_testimonial_cite">
					<?php $post_type_testimonial_cite = get_post_meta(get_the_ID(), 'post_type_testimonial_cite', true);?>
                    <input name="post_type_testimonial_cite" class="post_option_text_input span10" type="text" value="<?php echo $post_type_testimonial_cite; ?>" />
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Position', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_testimonial_position">
					<?php $post_type_testimonial_position = get_post_meta(get_the_ID(), 'post_type_testimonial_position', true);?>
                    <input name="post_type_testimonial_position" class="post_option_text_input span10" type="text" value="<?php echo $post_type_testimonial_position; ?>" />
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Link', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_testimonial_link row-fluid">
					<?php $post_type_testimonial_link = get_post_meta(get_the_ID(), 'post_type_testimonial_link', true);
					$testimonial_title = ($post_type_testimonial_link) ? $post_type_testimonial_link['title'] : false;
					$testimonial_link = ($post_type_testimonial_link) ? $post_type_testimonial_link['link'] : false;
					?>
                    <input name="post_type_testimonial_link[title]" class="post_option_text_input span3" type="text" value="<?php echo $testimonial_title; ?>" placeholder="<?php _e('Title', 'ux'); ?>" />
                    <input name="post_type_testimonial_link[link]" class="post_option_text_input span6" type="text" value="<?php echo $testimonial_link; ?>" placeholder="<?php _e('Link', 'ux'); ?>" />
                </div>
            </div>
        </div>
    </div>
    
<?php elseif(get_post_type() == 'jobs'): ?>

    <div class="post_option_content">
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Location', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_job_location">
					<?php $post_type_job_location = get_post_meta(get_the_ID(), 'post_type_job_location', true);?>
                    <input name="post_type_job_location" class="post_option_text_input span10" type="text" value="<?php echo $post_type_job_location; ?>" />
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2">
                <div class="post_descriptive_title">
                    <strong class="lead"><?php _e('Number', 'ux'); ?></strong>
                </div>
            </div>
            <div class="span10">
                <div class="post_type_job_number">
					<?php $post_type_job_number = get_post_meta(get_the_ID(), 'post_type_job_number', true);?>
                    <input name="post_type_job_number" class="post_option_text_input span10" type="text" value="<?php echo $post_type_job_number; ?>" />
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>