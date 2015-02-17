<?php
/*
Plugin Name: UX Contact Form
Description: Shows Contact Form in your blog
Version: 1.0
Author: fape
Author URI: http://www.uiueux.com
*/ 
class UXConatactForm extends WP_Widget
{
	function UXConatactForm() {
	 $widget_ops = array('description' => __('Shows Contact Form in your blog', 'ux-contant-form') );
     //Create widget
     $this->WP_Widget('UXconatactform', __('Contact Form', 'ux-contant-form'), $widget_ops);
	}
	
	function widget( $args, $instance ) {
		extract ( $args, EXTR_SKIP );
		$title = ( $instance['title'] ) ? $instance['title'] : 'Contact us';
		$emailto = ( $instance['emailto'] ) ? $instance['emailto'] : get_bloginfo('admin_email');
		$button = ( $instance['button'] ) ? $instance['button'] : 'SEND';
		$message =  ( $instance['message'] ) ? $instance['message'] : 'Thanks, your email was successfully sent.';
		$verifynumber = ( $instance['verifynumber'] ) ? $instance['verifynumber'] : 'yes';
		
		?>
		<?php echo $before_widget; ?>
		<?php echo '<h3 class="widget-title">'. $title . '</h3>'; ?>
		<?php 
		if( isset($_POST['idi_form']) && $_POST['idi_form'] == 'send')
				{
					$name = isset( $_POST['idi_name'] ) ? trim(htmlspecialchars($_POST['idi_name'], ENT_QUOTES)) : '';
					$email =  isset( $_POST['idi_mail'] ) ? trim(htmlspecialchars($_POST['idi_mail'], ENT_QUOTES)) : '';
					$content =  isset( $_POST['idi_text'] ) ? trim(htmlspecialchars($_POST['idi_text'], ENT_QUOTES)) : '';
					$sitename = get_bloginfo( 'name' );
					$siteurl = get_bloginfo( 'url' );
					
					$post_content = "This mail was sent by  $name .  Content:  $content . Sent on: $sitename - $siteurl";
					$title = 'Mail from '.$email. ' sent on '.$sitename ;
					$headers = 'from :'.$email.'\n content-type:text/html';
					wp_mail($emailto,$title,$post_content,$headers);
				}
		echo '<form action="';
		echo $_SERVER["REQUEST_URI"]; 
		echo '" id="contact-form" class="contact_form" method="POST">';	?>
		<p><input type="text" id="idi_name" name="idi_name" class="requiredField" value="<?php _e('Name','ux'); ?>*" onblur="if (this.value == '') {this.value = '<?php _e('Name','ux'); ?>*';}" onfocus="if (this.value == '<?php _e('Name','ux'); ?>*' || this.value  == '<?php _e('Required','ux'); ?>') {this.value = '';}" /></p>
		<p><input type="text" id="idi_mail" name="idi_mail" class="requiredField email" value="<?php _e('Email','ux'); ?>*" onblur="if (this.value == '') {this.value = '<?php _e('Email','ux'); ?>*';}" onfocus="if (this.value == '<?php _e('Email','ux'); ?>*' || this.value  == '<?php _e('Required','ux'); ?>') {this.value = '';}" /></p>
		<p><textarea rows="4" name="idi_text" id="idi_text" cols="4" class="requiredField inputError" onFocus="if (this.value  == '<?php _e('Required','ux'); ?>' ) {this.value = '';}" ></textarea></p>
		
		<input type="hidden" value="send" name="idi_form" class="info-tip" data-message="<?php echo $message; ?>" data-sending="<?php _e('Sending...','ux')?>" data-error="<?php _e('Please Enter Correct Verification Number','ux')?>" />
		<div class="btnarea">
		<?php if( $verifynumber =='yes') { ?>
			<div class="verify-wrap">
				<input type="hidden" value="701469" id="verifyNumHidden" class="verifyNumHidden" name="verifyNumHidden" />
				<input type="text" id="enterVerify" name="enterVerify" class="requiredField Verify" onFocus="if (this.value  == '<?php _e('Required','ux'); ?>' ) {this.value = '';}" />
				<span class="verifyNum" id="verifyNum"></span>
			</div>
		<?php } ?>	
			<input type="submit" id="idi_send" name="idi_send" value="<?php echo $button; ?>" />
		</div>
		</form>
		</li>
	<?php
	}
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['emailto'] = strip_tags($new_instance['emailto']);
		$instance['button'] = strip_tags($new_instance['button']);
		$instance['message'] = strip_tags($new_instance['message']);
		$instance['verifynumber'] = strip_tags($new_instance['verifynumber']);
		return $instance;
	}
	function form($instance){
		$defaults = array('title' => 'Contact us', 'button' => 'SEND','message' => 'Thanks, your email was successfully sent.','verifynumber' =>'yes' );
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
		<p>
			<b><?php _e('Title:','ux'); ?></b><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<?php _e('Recipient Email:','ux'); ?><input id="<?php echo $this->get_field_id('emailto'); ?>" name="<?php echo $this->get_field_name('emailto'); ?>" value="<?php if(isset($instance['emailto'])) echo $instance['emailto']; ?>" class="widefat"><small>Enter the email receiver form.</small>
		</p>
		<p>
			<?php _e('Button Text:','ux'); ?><input id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo $instance['button']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Sent Message:','ux'); ?><textarea id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" class="widefat"><?php echo $instance['message']; ?></textarea>
		</p>
		<p>
			<?php _e('Show Verify Random Number:','ux'); ?><select id="<?php echo $this->get_field_id('verifynumber'); ?>" name="<?php echo $this->get_field_name('verifynumber'); ?>" class="widefat" style="width:100%;">
				<option <?php if ( $instance['verifynumber'] == 'yes') echo 'selected="selected"'; ?>><?php _e('yes','ux'); ?></option>
				<option <?php if ( $instance['verifynumber'] == 'no') echo 'selected="selected"'; ?>><?php _e('no','ux'); ?></option>
			</select>
		</p>
		
<?php
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("UXConatactForm");') );
?>