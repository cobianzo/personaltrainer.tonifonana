<?php

/* SETUP THE COMMENTS SECTION
   ================================================== */

?>
<div id="comments">
<?php
    $req = get_option('require_name_email'); // Checks if fields are required.
    if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
        die ( 'Please do not load this page directly. Thanks!' );
    if ( ! empty($post->post_password) ) :
        if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
	<div class="nopassword"><?php _e("This post is password protected. Enter the password to view any comments.", "ux"); ?></div>
<!-- </div>.comments ? -->
<?php
        return;
    endif;
endif;
 

/* DISPLAY THE COMMENTS
   ================================================== */
?>


	
	<?php if ( have_comments() ) : ?>
	<div id="comments_box">
	<span id="comments_inlist"><?php comments_number(__('0 COMMENTS', "ux"), __('1 COMMENT', "ux"), __('% COMMENTS', "ux") ); ?></span>
		<?php $ping_count = $comment_count = 0;
		foreach ( $comments as $comment )
	          get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
		  if (  empty($comments_by_type['comment']) ) : ?>
				<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
					<div class="commnetsnavi">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</div><!-- #comments-nav-above -->
				<?php endif; ?>                   
				<ol class="commentlist commentlist-only">
					<?php wp_list_comments('type=comment&callback=idi_cust_comment'); ?>
				</ol>
				<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
					<div class="commnetsnavi">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</div><!-- #comments-nav-below -->
				<?php endif; ?>                   
		<?php endif; /* if ( $comment_count ) */ ?>
</div><!-- #comments_box-->	
<?php endif /* if ( $comments ) */ ?>


<?php

/* COMMENT ENTRY FORM
   ================================================== */

?>

<?php if ( 'open' == $post->comment_status ) : ?>
	<div id="respondwrap">
		<?php 
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			if(esc_attr( $commenter['comment_author'] )){
			$fields =  array(
				'author' => '<p><input id="author" name="author" type="text" class="requiredFieldcomm" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' tabindex="1" onfocus="if(this.value==\'Name*\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\'Name*\';}"/></p>',
				'email' => '<p><input id="email" name="email" type="text" class="email requiredFieldcomm" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' tabindex="2" onfocus="if(this.value==\'Email*\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\'Email*\';}"/></p>'
			);
			}else{
			$fields =  array(
				'author' => '<p><input id="author" name="author" type="text" class="requiredFieldcomm" value="Name*" size="30"' . $aria_req . ' tabindex="1" onfocus="if(this.value==\'Name*\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\'Name*\';}"/></p>',
				'email' => '<p><input id="email" name="email" type="text" class="email requiredFieldcomm" value="Email*" size="30"' . $aria_req . ' tabindex="2" onfocus="if(this.value==\'Email*\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\'Email*\';}"/></p>'
			);
			}
			$comments_args = array(
			    'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			    'logged_in_as'		   => '<p class="logged">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', 'ux' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			    'title_reply'          => '<span class="comm-reply-title">'.__( 'LEAVE A REPLY', 'ux' ).'</span>',
			    'title_reply_to'       => __( 'Leave a Reply to %s', 'ux' ),
			    'cancel_reply_link'    => __( 'Cancel reply', 'ux' ),
			    'label_submit'         => __( 'SEND', 'ux' ),
			    'comment_field'		   => '<p><textarea id="comment" name="comment" class="requiredFieldcomm" cols="100%" tabindex="4" aria-required="true"></textarea></p>',
			    'must_log_in'		   => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'ux' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
                'comment_notes_after'  =>'',
                'comment_notes_before'  =>''
			);
        ?>
		<?php comment_form($comments_args); ?>
	</div>
<?php endif; /* if ( 'open' == $post->comment_status ) */ ?>
</div><!-- #comments -->