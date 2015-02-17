<ul class="post_meta clearfix">
    <li class="post_author"><?php _e('Posted by', 'ux'); ?> <?php the_author(); ?></li>
    <li class="post_date"><?php echo get_the_time('F j Y'); ?></li>
    <?php
	if(get_the_tags()){
		?><li class="post_tag"><?php echo get_the_tag_list('',' ',''); ?></li><?php
	}
	?>
    
    
</ul>