<?php
/*
Plugin Name: UX Social Icons
Description: Shows Social Icons in your blog
Version: 1.0
Author: fape
Author URI: http://www.uiueux.com
*/ 
class UXSocialInons extends WP_Widget
{
	function UXSocialInons() {
	
		//global $domain;
	//	$widget_options = array(
		//	'classname' => 'ux-ads-unit',
			//'description' => 'Shows Advertising in your blog');
		//	parent::WP_Widget('ux_ads_unit_1','UX Ads Unit', $widget_options);
	 $widget_ops = array('description' => __('Shows Social Network Icons in your blog', 'ux-social-icons') );
     //Create widget
     $this->WP_Widget('UXsocialinons', __('Social Network Icons', 'ux-social-icons'), $widget_ops);
	}
	function widget( $args, $instance ) {
		extract ( $args, EXTR_SKIP );
		$title = ( $instance['title'] ) ? $instance['title'] : 'Follow us';
		$facebook = ( $instance['facebook'] ) ? $instance['facebook'] : 'http://www.facebook.com';
		$tweet = ( $instance['tweet'] ) ? $instance['tweet'] : '';
		
		$googleplus = ( $instance['googleplus'] ) ? $instance['googleplus'] : ''; 
		$pinterest = ( $instance['pinterest'] ) ? $instance['pinterest'] : '';
		$instagram = ( $instance['instagram'] ) ? $instance['instagram'] : '';
		$tumblr = ( $instance['tumblr'] ) ? $instance['tumblr'] : '';
		$in = ( $instance['in'] ) ? $instance['in'] : '';
		$flickr = ( $instance['flickr'] ) ? $instance['flickr'] : '';
		$youtube = ( $instance['youtube'] ) ? $instance['youtube'] : '';
		$vimeo = ( $instance['vimeo'] ) ? $instance['vimeo'] : '';
		$dribbble  = ( $instance['dribbble'] ) ? $instance['dribbble'] : '';
		$forst = ( $instance['forst'] ) ? $instance['forst'] : '';
		$github = ( $instance['github'] ) ? $instance['github'] : '';
		$rss = ( $instance['rss'] ) ? $instance['rss'] : '';
		$vk = ( $instance['vk'] ) ? $instance['vk'] : '';
		$weibo = ( $instance['weibo'] ) ? $instance['weibo'] : '';
		$wechat = ( $instance['wechat'] ) ? $instance['wechat'] : '';
		$renren = ( $instance['renren'] ) ? $instance['renren'] : '';
		$douban = ( $instance['douban'] ) ? $instance['douban'] : '';
		$xing = ( $instance['xing'] ) ? $instance['xing'] : '';
		$reddit = ( $instance['reddit'] ) ? $instance['reddit'] : '';
		$livejournal = ( $instance['livejournal'] ) ? $instance['livejournal'] : '';
		$path = ( $instance['path'] ) ? $instance['path'] : '';
		$bebo = ( $instance['bebo'] ) ? $instance['bebo'] : '';
		$odnoklassniki = ( $instance['odnoklassniki'] ) ? $instance['odnoklassniki'] : '';
		$wordpress = ( $instance['wordpress'] ) ? $instance['wordpress'] : '';
		$email = ( $instance['email'] ) ? $instance['email'] : '';
		$blogger = ( $instance['blogger'] ) ? $instance['blogger'] : '';
		$deviantart = ( $instance['deviantart'] ) ? $instance['deviantart'] : '';
		$lastfm = ( $instance['lastfm'] ) ? $instance['lastfm'] : '';
		$stumbleupon = ( $instance['stumbleupon'] ) ? $instance['stumbleupon'] : '';
		$myspace = ( $instance['myspace'] ) ? $instance['myspace'] : '';
		?>
		<?php echo $before_widget; ?>
		<?php echo $before_title . $title . $after_title; ?>
		<?php echo '<div class="icon">' ?>
		<?php 
		if( $facebook != ''){
		echo '<a id="social_facebook" class="social_active" href="'.$facebook.'" title="';
		_e('Visit Facebook page','ux');
		echo '"><i class="s-facebook"></i></a>';
		}
		if( $tweet != ''){
		echo '<a id="social_twitter" class="social_active" href="'.$tweet.'" title="';
		_e('Visit Twitter page','ux');
		echo '"><i class="s-twitter"></i></a>' ;
		}
		if( $googleplus != ''){
		echo '<a id="social_google_plus" class="social_active" href="'.$googleplus.'" title="';
		_e('Visit Google Plus page','ux');
		echo '"><i class="s-googleplus"></i></a>' ;
		}
		if( $vk != ''){
		echo '<a id="social_vk" class="social_active" href="'.$vk.'" title="';
		_e('Visit VK page','ux');
		echo '"><i class="icon-s-vk"></i></a>' ;
		} 
		if( $weibo != ''){
		echo '<a id="social_weibo" class="social_active" href="'.$weibo.'" title="';
		_e('Visit Weibo page','ux');
		echo '"><i class="icon-s-weibo"></i></a>' ;
		} 
		if( $renren != ''){
		echo '<a id="social_renren" class="social_active" href="'.$renren.'" title="';
		_e('Visit Renren page','ux');
		echo '"><i class="icon-s-renren"></i></a>' ;
		}
		if( $wechat != ''){
		echo '<a id="social_wechat" class="social_active" href="'.$wechat.'" title="';
		_e('Find me at Wechat','ux');
		echo '"><i class="icon-s-wechat"></i></a>' ;
		}
		if( $douban != ''){
		echo '<a id="social_douban" class="social_active" href="'.$douban.'" title="';
		_e('Visit Douban page','ux');
		echo '"><i class="icon-s-douban"></i></a>' ;
		}
		if( $odnoklassniki != ''){
		echo '<a id="social_odnoklassniki" class="social_active" href="'.$odnoklassniki.'" title="';
		_e('Visit Odnoklassniki page','ux');
		echo '"><i class="icon-s-odnoklassniki"></i></a>' ;
		} 
		if( $bebo != ''){
		echo '<a id="social_bebo" class="social_active" href="'.$bebo.'" title="';
		_e('Visit Bebo page','ux');
		echo '"><i class="icon-s-bebo"></i></a>' ;
		} 		
		if( $pinterest != ''){
		echo '<a id="social_pinterest" class="social_active" href="'.$pinterest.'" title="';
		_e('Visit Pinterest page','ux');
		echo '"><i class="s-pinterest"></i></a>' ;
		}
		if( $instagram != ''){
		echo '<a id="social_instagram" class="social_active" href="'.$instagram.'" title="';
		_e('Visit Instagram page','ux');
		echo '"><i class="s-instagram"></i></a>' ;
		}
		if( $tumblr != ''){
		echo '<a id="social_trumblr" class="social_active" href="'.$tumblr.'" title="';
		_e('Visit Tumblr page','ux');
		echo '"><i class="s-tumblr"></i></a>' ;
		}
		if( $flickr != ''){
		echo '<a id="social_flickr" class="social_active" href="'.$flickr.'" title="';
		_e('Visit Flickr page','ux');
		echo '"><i class="s-flickr"></i></a>' ;
		}
		if( $youtube != ''){
		echo '<a id="social_youtube" class="social_active" href="'.$youtube.'" title="';
		_e('Visit Youtube page','ux');
		echo '"><i class="s-youtube"></i></a>' ;
		} 
		if( $vimeo != ''){
		echo '<a id="social_vimeo" class="social_active" href="'.$vimeo.'" title="';
		_e('Visit Vimeo page','ux');
		echo '"><i class="s-vimeo"></i></a>' ;
		}
		if( $in != ''){
		echo '<a id="social_linkedin" class="social_active" href="'.$in.'" title="';
		_e('Visit Linkedin page','ux');
		echo '"><i class="s-linkedin"></i></a>' ;
		}
		if( $dribbble != ''){
		echo '<a id="social_dribbble" class="social_active" href="'.$dribbble.'" title="';
		_e('Visit Dribbble page','ux');
		echo '"><i class="s-dribbble"></i></a>' ;
		}
		if( $forst != ''){
		echo '<a id="social_forst" class="social_active" href="'.$forst.'" title="';
		_e('Visit Forst page','ux');
		echo '"><i class="s-forrst"></i></a>' ;
		}
		if( $github != ''){
		echo '<a id="social_github" class="social_active" href="'.$github.'" title="';
		_e('Visit Github page','ux');
		echo '"><i class="s-git"></i></a>' ;
		}
		if( $xing != ''){
		echo '<a id="social_xing" class="social_active" href="'.$xing.'" title="';
		_e('Visit Xing page','ux');
		echo '"><i class="icon-s-xing"></i></a>' ;
		} 
		if( $reddit != ''){
		echo '<a id="social_reddit" class="social_active" href="'.$reddit.'" title="';
		_e('Visit Reddit page','ux');
		echo '"><i class="icon-s-reddit"></i></a>' ;
		} 
		if( $path != ''){
		echo '<a id="social_path" class="social_active" href="'.$path.'" title="';
		_e('Find me at Path','ux');
		echo '"><i class="icon-s-path"></i></a>' ;
		} 
		if( $livejournal != ''){
		echo '<a id="social_livejournal" class="social_active" href="'.$livejournal.'" title="';
		_e('Visit Livejournal page','ux');
		echo '"><i class="icon-s-livejournal"></i></a>' ;
		} 
		if( $blogger != ''){
		echo '<a id="social_blogger" class="social_active" href="'.$blogger.'" title="';
		_e('Visit Blogger page','ux');
		echo '"><i class="icon-s-blogger"></i></a>' ;
		} 
		if( $deviantart != ''){
		echo '<a id="social_deviantart" class="social_active" href="'.$deviantart.'" title="';
		_e('Visit Deviantart page','ux');
		echo '"><i class="icon-s-deviantart"></i></a>' ;
		} 
		if( $lastfm != ''){
		echo '<a id="social_lastfm" class="social_active" href="'.$lastfm.'" title="';
		_e('Visit Lastfm page','ux');
		echo '"><i class="icon-s-lastfm"></i></a>' ;
		} 
		if( $stumbleupon != ''){
		echo '<a id="social_stumbleupon" class="social_active" href="'.$stumbleupon.'" title="';
		_e('Visit Stumbleupon page','ux');
		echo '"><i class="icon-s-stumbleupon"></i></a>' ;
		} 
		if( $wordpress != ''){
		echo '<a id="social_wordpress" class="social_active" href="'.$wordpress.'" title="';
		_e('Visit Wordpress page','ux');
		echo '"><i class="icon-s-wordpress"></i></a>' ;
		}
		if( $myspace != ''){
		echo '<a id="social_myspace" class="social_active" href="'.$myspace.'" title="';
		_e('Visit Myspace page','ux');
		echo '"><i class="icon-s-myspace"></i></a>' ;
		} 
		if( $email != ''){
		echo '<a id="social_email" class="social_active" href="'.$email.'" title="';
		_e('Email','ux');
		echo '"><i class="icon-s-email"></i></a>' ;
		} 
		if( $rss != ''){
		echo '<a id="social_rss" class="social_active" href="'.$rss.'" title="';
		_e('Rss','ux');
		echo '"><i class="s-rss"></i></a>' ;
		} 
		
		echo '</div><div class="clear"></div>';
		echo $after_widget; 
		?>
	<?php
	}
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['tweet'] = strip_tags($new_instance['tweet']);
		$instance['googleplus'] = strip_tags($new_instance['googleplus']);
		$instance['pinterest'] = strip_tags($new_instance['pinterest']);
		$instance['instagram'] = strip_tags($new_instance['instagram']);
		$instance['tumblr'] = strip_tags($new_instance['tumblr']);
		$instance['in'] = strip_tags($new_instance['in']);
		$instance['flickr'] = strip_tags($new_instance['flickr']);
		$instance['youtube'] = strip_tags($new_instance['youtube']);
		$instance['vimeo'] = strip_tags($new_instance['vimeo']);
		$instance['dribbble'] = strip_tags($new_instance['dribbble']);		
		$instance['forst'] = strip_tags($new_instance['forst']);
		$instance['github'] = strip_tags($new_instance['github']);
		$instance['rss'] = strip_tags($new_instance['rss']);
		$instance['vk'] = strip_tags($new_instance['vk']);
		$instance['weibo'] = strip_tags($new_instance['weibo']);
		$instance['wechat'] = strip_tags($new_instance['wechat']);
		$instance['renren'] = strip_tags($new_instance['renren']);
		$instance['douban'] = strip_tags($new_instance['douban']);
		$instance['xing'] = strip_tags($new_instance['xing']);
		$instance['reddit'] = strip_tags($new_instance['reddit']);
		$instance['livejournal'] = strip_tags($new_instance['livejournal']);
		$instance['path'] = strip_tags($new_instance['path']);
		$instance['bebo'] = strip_tags($new_instance['bebo']);
		$instance['odnoklassniki'] = strip_tags($new_instance['odnoklassniki']);
		$instance['wordpress'] = strip_tags($new_instance['wordpress']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['blogger'] = strip_tags($new_instance['blogger']);
		$instance['deviantart'] = strip_tags($new_instance['deviantart']);
		$instance['lastfm'] = strip_tags($new_instance['lastfm']);
		$instance['stumbleupon'] = strip_tags($new_instance['stumbleupon']);
		$instance['myspace'] = strip_tags($new_instance['myspace']);
		
		return $instance;
	}
	function form($instance){
		$defaults = array('title' => '', 'facebook' => '', 'tweet' => '', 'googleplus' => '', 'pinterest' => '', 'instagram' => '', 'tumblr' => '', 'in' => '', 'flickr' => '', 'youtube' => '', 'vimeo' => '', 'dribbble' => '', 'forst' => '', 'github' => '', 'rss' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
		<p>
			<b><?php _e('Title:','ux'); ?></b><input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<?php _e('Your Facebook link:','ux'); ?><input id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php  echo $instance['facebook']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Twitter link:','ux'); ?><input id="<?php echo $this->get_field_id('tweet'); ?>" name="<?php echo $this->get_field_name('tweet'); ?>" value="<?php echo $instance['tweet']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your GooglePlus link:','ux'); ?><input id="<?php echo $this->get_field_id('googleplus'); ?>" name="<?php echo $this->get_field_name('googleplus'); ?>" value="<?php echo $instance['googleplus']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your VK link:','ux'); ?><input id="<?php echo $this->get_field_id('vk'); ?>" name="<?php echo $this->get_field_name('vk'); ?>" value="<?php echo $instance['vk']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Weibo link:','ux'); ?><input id="<?php echo $this->get_field_id('weibo'); ?>" name="<?php echo $this->get_field_name('weibo'); ?>" value="<?php echo $instance['weibo']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Wechat link:','ux'); ?><input id="<?php echo $this->get_field_id('wechat'); ?>" name="<?php echo $this->get_field_name('wechat'); ?>" value="<?php echo $instance['wechat']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Renren link:','ux'); ?><input id="<?php echo $this->get_field_id('renren'); ?>" name="<?php echo $this->get_field_name('renren'); ?>" value="<?php echo $instance['renren']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Douban link:','ux'); ?><input id="<?php echo $this->get_field_id('douban'); ?>" name="<?php echo $this->get_field_name('douban'); ?>" value="<?php echo $instance['douban']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Odnoklassniki link:','ux'); ?><input id="<?php echo $this->get_field_id('odnoklassniki'); ?>" name="<?php echo $this->get_field_name('odnoklassniki'); ?>" value="<?php echo $instance['odnoklassniki']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Pinterest link:','ux'); ?><input id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo $instance['pinterest']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Instagram link:','ux'); ?><input id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo $instance['instagram']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Tumblr link:','ux'); ?><input id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" value="<?php echo $instance['tumblr']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Linkedin link:','ux'); ?><input id="<?php echo $this->get_field_id('in'); ?>" name="<?php echo $this->get_field_name('in'); ?>" value="<?php echo $instance['in']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Flickr link:','ux'); ?><input id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $instance['flickr']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Youtube link:','ux'); ?><input id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Vimeo link:','ux'); ?><input id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" value="<?php echo $instance['vimeo']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Dribbble link:','ux'); ?><input id="<?php echo $this->get_field_id('dribbble'); ?>" name="<?php echo $this->get_field_name('dribbble'); ?>" value="<?php echo $instance['dribbble']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Forst link:','ux'); ?><input id="<?php echo $this->get_field_id('forst'); ?>" name="<?php echo $this->get_field_name('forst'); ?>" value="<?php echo $instance['forst']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Github link:','ux'); ?><input id="<?php echo $this->get_field_id('github'); ?>" name="<?php echo $this->get_field_name('github'); ?>" value="<?php echo $instance['github']; ?>" class="widefat">
		</p>
		
		<p>
			<?php _e('Your Xing link:','ux'); ?><input id="<?php echo $this->get_field_id('xing'); ?>" name="<?php echo $this->get_field_name('xing'); ?>" value="<?php echo $instance['xing']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Reddit link:','ux'); ?><input id="<?php echo $this->get_field_id('reddit'); ?>" name="<?php echo $this->get_field_name('reddit'); ?>" value="<?php echo $instance['reddit']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Livejournal link:','ux'); ?><input id="<?php echo $this->get_field_id('livejournal'); ?>" name="<?php echo $this->get_field_name('livejournal'); ?>" value="<?php echo $instance['livejournal']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Path link:','ux'); ?><input id="<?php echo $this->get_field_id('path'); ?>" name="<?php echo $this->get_field_name('path'); ?>" value="<?php echo $instance['path']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Bebo link:','ux'); ?><input id="<?php echo $this->get_field_id('bebo'); ?>" name="<?php echo $this->get_field_name('bebo'); ?>" value="<?php echo $instance['bebo']; ?>" class="widefat">
		</p>

		
		<p>
			<?php _e('Your Blogger link:','ux'); ?><input id="<?php echo $this->get_field_id('blogger'); ?>" name="<?php echo $this->get_field_name('blogger'); ?>" value="<?php echo $instance['blogger']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Deviantart link:','ux'); ?><input id="<?php echo $this->get_field_id('deviantart'); ?>" name="<?php echo $this->get_field_name('deviantart'); ?>" value="<?php echo $instance['deviantart']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Lastfm link:','ux'); ?><input id="<?php echo $this->get_field_id('lastfm'); ?>" name="<?php echo $this->get_field_name('lastfm'); ?>" value="<?php echo $instance['lastfm']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Stumbleupon link:','ux'); ?><input id="<?php echo $this->get_field_id('stumbleupon'); ?>" name="<?php echo $this->get_field_name('stumbleupon'); ?>" value="<?php echo $instance['stumbleupon']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Myspace link:','ux'); ?><input id="<?php echo $this->get_field_id('myspace'); ?>" name="<?php echo $this->get_field_name('myspace'); ?>" value="<?php echo $instance['myspace']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Wordpress link:','ux'); ?><input id="<?php echo $this->get_field_id('wordpress'); ?>" name="<?php echo $this->get_field_name('wordpress'); ?>" value="<?php echo $instance['wordpress']; ?>" class="widefat">
		</p>
		<p>
			<?php _e('Your Email:','ux'); ?><input id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" class="widefat"><small>e.g. mailto:uiueux@gmail.com</small>
		</p>
		<p>
			<?php _e('Your RSS link:','ux'); ?><input id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $instance['rss']; ?>" class="widefat">
		</p>
<?php
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("UXSocialInons");') );
?>