<ul class="post_social post-meta-social clearfix">
<input value="<?php the_permalink(); ?>" name="url"  type="hidden"/>
<input value="<?php the_title(); ?>" name="title"  type="hidden"/>
<input value="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" name="media"  type="hidden"/>
    <li>
        <a class="share postshareicon-facebook-wrap" href="javascript:;">
        <span class="icon postshareicon-facebook"><i class="m-social-facebook"></i></span>
        <span class="count">0</span>
    	</a>
    </li>
	
	<li>
        <a class="share postshareicon-twitter-wrap" href="javascript:;">
        <span class="icon postshareicon-twitter"><i class="m-social-twitter"></i></span>
        <span class="count">0</span>
    	</a>
    </li>
	<?php if(has_post_thumbnail()) { ?>
	<li>
        <a class="share postshareicon-pinterest-wrap" href="javascript:;">
        <span class="icon postshareicon-pinterest"><i class="m-social-pinterest"></i></span>
        <span class="count">0</span>
    	</a>
    </li>
    <?php } ?>
</ul>