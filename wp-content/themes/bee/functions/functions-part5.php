<?php
function ux_p5_module_fields($module_fields){
	$button = array(
		'id' => 'button',
		'name' => __('Button','ux'),
		'icon' => 'button_icon',
		'display' => 'block',
		'item' => array(
			
			array('title' => __('Size','ux'),
				  'description' => __('Choose a size for the button','ux'),
				  'type' => 'select',
				  'name' => 'module_select_button_size'),
				  
			array('title' => __('Button Color','ux'),
				  'description' => __('Choose a color for the button','ux'),
				  'type' => 'background_color',
				  'name' => 'module_background_color'),
				  
			array('title' => __('Button Text','ux'),
				  'description' => __('Enter the text you want to show on button','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_button_text'),
				  
			array('title' => __('Button Link','ux'),
				  'description' => __('Paste a url for the button','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_button_link',
				  'placeholder' => 'http://aol.com')
		
		)
	);
	array_push($module_fields, $button);
	
	$carousel = array(
		'id' => 'carousel',
		'name' => __('Carousel','ux'),
		'icon' => 'carousel_icon',
		'display' => 'block',
		'item' => array(
			
			array('title' => __('Post Type','ux'),
				  'description' => __('Check on the post types you want to show on this module','ux'),
				  'type' => 'cheak',
				  'name' => 'module_cheak_post_type'),
				  
			array('title' => __('Category','ux'),
				  'description' =>__('The posts under the category you selected would be shown in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_category'),
				  
			array('title' => __('Number of Items','ux'),
				  'description' => __('How many items should be displayed in this module, leave it empty to show all items','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_number_of_items'),
				  
			array('title' => __('Ratio of Thumb','ux'),
				  'description' => __('The images come from featured image, choose a ratio to show in this module','ux'),
				  'type' => 'select',
				  'name' => 'module_select_image_ratio'),
				  
			array('title' => __('Order by','ux'),
				  'description' => __('Select sequence rules for the list','ux'),
				  'type' => 'select',
				  'name' => 'module_select_orderby'),
				  
			array('title' => __('Show','ux'),
				  'description' => __('Check on the elements you want to show','ux'),
				  'type' => 'cheak',
				  'name' => 'module_cheak_show_function'),
				  
			  array('title' => __('Text Align','ux'),
				  'description' => __('Select alignment for the text','ux'),
				  'type' => 'select',
				  'name' => 'module_select_text_align'),
				  
			array('title' => __('Button Text','ux'),
				  'description' => __('It is a read more button, enter the text you want to show on button','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_button_text'),
				  
			array('title' => __('Show Navigation Hint','ux'),
				  'description' => __('Turn on it to show navigation hint','ux'),
				  'type' => 'switch',
				  'name' => 'module_switch_navigation_hint',
				  'default' => 'false')
		
		)
	);
	array_push($module_fields, $carousel);
	
	$latest_tweets = array(
		'id' => 'latest_tweets',
		'name' => __('Latest Tweets','ux'),
		'icon' => 'twitter_icon',
		'display' => 'block',
		'item' => array(
			
			array('title' => __('User Name','ux'),
				  'description' => __('please enter the twitter user name you want to display','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_title'),
				  
			array('title' => __('Number of Items','ux'),
				  'description' => __('number of items you want to show','ux'),
				  'type' => 'input_text',
				  'name' => 'module_input_number_of_items')
		
		)
	);
	//array_push($module_fields, $latest_tweets);
	
	return $module_fields;
	
}
add_filter('pagebuilder_module_fields','ux_p5_module_fields');

function ux_p5_module_type_fields($module_type_fields){
	$select_key = false;

	foreach($module_type_fields as $i => $type_field){
		switch($type_field['id']){
			case 'select': $select_key = $i; break;
		}
	};
	
	if($select_key){
		$module_type_fields[$select_key]['item']['module_select_button_size'] = array(
			array('title' => __('Small','ux'), 'value' => 'small'),
			array('title' => __('Medium','ux'), 'value' => 'medium'),
			array('title' => __('Large','ux'), 'value' => 'large'),
		); 
		$module_type_fields[$select_key]['item']['module_select_flexslider_animation'] = array(
			array('title' => __('Fade','ux'), 'value' => 'fade'),
			array('title' => __('Slide','ux'), 'value' => 'slide')
		); 
		
	}
	
	return $module_type_fields;
	
}
add_filter('pagebuilder_module_type_fields','ux_p5_module_type_fields');

function ux_p5_view_module_switch($modules){
	global $post;
	$module_id = $modules['module_id'];
	$module_post = $modules['module_post'];
	
	switch($module_id){
		case 'button':
			$select_button_size = ux_get_module_meta($module_post, 'module_select_button_size', get_the_ID());
			$select_background_color = ux_get_module_meta($module_post, 'module_background_color', get_the_ID());
			$select_button_text = ux_get_module_meta($module_post, 'module_input_button_text', get_the_ID());
			$select_button_link = ux_get_module_meta($module_post, 'module_input_button_link', get_the_ID());
			
			global $theme_color;
			$background_color = ($select_background_color) ? 'bg-'.$theme_color[$select_background_color]['value'] : 'post-bgcolor-default';
			
			$button_link = ($select_button_link) ? esc_url($select_button_link) : '#';
			$button_size = false;
			switch($select_button_size){
				case 'small': $button_size = 'ux-btn-small'; break;
				case 'medium': $button_size = false; break;
				case 'large': $button_size = 'ux-btn-big'; break;
			}
			?>
            <a href="<?php echo $button_link; ?>" class="ux-btn <?php echo $button_size; ?> <?php echo $background_color; ?>"><?php echo $select_button_text; ?></a>
        <?php    
		break;
		
		case 'carousel':
			$select_post_type = ux_get_module_meta($module_post, 'module_cheak_post_type', get_the_ID());
			$select_category = ux_get_module_meta($module_post, 'module_select_category', get_the_ID());
			$select_orderby = ux_get_module_meta($module_post, 'module_select_orderby', get_the_ID());
			$select_order = ux_get_module_meta($module_post, 'module_select_order', get_the_ID());
			$select_image_ratio = ux_get_module_meta($module_post, 'module_select_image_ratio', get_the_ID());
			$select_number_of_items = ux_get_module_meta($module_post, 'module_input_number_of_items', get_the_ID());
			$select_show_function = ux_get_module_meta($module_post, 'module_cheak_show_function', get_the_ID());
			$select_text_align = ux_get_module_meta($module_post, 'module_select_text_align', get_the_ID());
			$select_button_text = ux_get_module_meta($module_post, 'module_input_button_text', get_the_ID());
			$select_navigation_hint = ux_get_module_meta($module_post, 'module_switch_navigation_hint', get_the_ID());
			
			$idObj = get_category_by_slug($select_category);
			$select_category = ($idObj) ? $idObj->term_id : '0';
			$select_orderby = ($select_orderby != '-1') ? $select_orderby : 'none';
			$select_order = ($select_order == 'descending') ? 'DESC' : 'ASC';
			
			$select_image_ratio = ($select_image_ratio) ? $select_image_ratio : 'image-thumb';
			$select_number_of_items = ($select_number_of_items) ? $select_number_of_items : -1;
			$select_show_function = ($select_show_function) ? explode("'%_%'",$select_show_function) : false;
			$select_button_text = ($select_button_text) ? $select_button_text : __('Read more','ux');
			
			$select_post_type = ($select_post_type) ? explode("'%_%'",$select_post_type) : false;
			$select_post_format = false;
			$select_post_operator = false;
			$select_thumbnail_compare = array(
				'relation' => 'AND',
				array(
					'key' => '_thumbnail_id',
					'compare' => 'EXISTS'
				)
			);
			if($select_post_type){
				$select_post_format = array();
				$post_format = array(
					'post-format-aside',
					'post-format-chat',
					'post-format-gallery',
					'post-format-link',
					'post-format-image',
					'post-format-quote',
					'post-format-status',
					'post-format-video',
					'post-format-audio'
				);
				foreach($select_post_type as $post_type){
					switch($post_type){
						case 'image': array_push($select_post_format, 'post-format-image'); break;
						case 'portfolio': array_push($select_post_format, 'post-format-gallery'); break;
						case 'audio': array_push($select_post_format, 'post-format-audio'); break;
						case 'video': array_push($select_post_format, 'post-format-video'); break;
					}
				}
				if(in_array("standard", $select_post_type)){
					$select_post_operator = 'NOT IN';
					foreach($select_post_format as $delete_format){
						foreach($post_format as $key => $format_string){
							if($delete_format == $format_string) unset($post_format[$key]);
						}
					}
					$select_post_format = $post_format;
				}else{
					$select_post_operator = 'IN';
				}
			}
			
			$image_ratio = 'image-thumb';
			if($select_image_ratio){
				switch($select_image_ratio){
					case 'landscape': $image_ratio = 'image-thumb'; break;
					case 'square': $image_ratio = 'image-thumb-1'; break;
					case 'auto': $image_ratio = 'standard-thumb'; break;
				}
			}
			
			$text_align = 'text-left';
			$pull_align = 'pull-left';
			if($select_text_align){
				switch($select_text_align){
					case 'center': $text_align = 'text-center'; $pull_align = false; break;
					case 'right': $text_align = 'text-right'; $pull_align = 'pull-right'; break;
				}
			}
			
			$get_posts = get_posts(array(
				'posts_per_page' => $select_number_of_items,
				'category' => $select_category,
				'orderby' => $select_orderby,
				'order' => $select_order,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => $select_post_format,
						'operator' => $select_post_operator
					)
				),
				'meta_query' => $select_thumbnail_compare
			));
			
			if($select_post_type){ ?>
                <div class="post-carousel-wrap" data-column="4">
                    <div class="post-carousel">
						<?php foreach($get_posts as $post){ setup_postdata( $post ); ?>
                            <section class="post-carousel-item">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), $image_ratio, array('title' => get_the_title(get_post_thumbnail_id()))); ?></a>
                                <?php if($select_show_function){
									if(in_array("title", $select_show_function)){ ?><h1 class="<?php echo $text_align; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1><?php }
									if(in_array("excerpt", $select_show_function)){ ?><div class="post-carousel-item-des <?php echo $text_align; ?>"><?php if(has_excerpt()) the_excerpt(); ?></div><?php }
									if(in_array("read_more_button", $select_show_function)){ ?><a href="<?php the_permalink(); ?>" class="post-carousel-item-more <?php echo $pull_align; ?>" title="<?php the_title(); ?>"><?php echo $select_button_text; ?></a>
									<?php 
									}
								} ?>
                            </section>
                        
                        <?php }
						wp_reset_postdata(); ?>
                    </div>
                    <?php if($select_navigation_hint != 'false'){ ?><div class="post-carousel-pagination"></div><?php } ?>
                </div>
			<?php
			}
		break;
		
		case 'latest_tweets':
			$select_title = ux_get_module_meta($module_post, 'module_input_title', get_the_ID());
			$select_number = ux_get_module_meta($module_post, 'module_input_number_of_items', get_the_ID());
			
			$select_title = ($select_title) ? $select_title : 'twitterapi';
			$select_number = ($select_number) ? $select_number : 20;
			
			echo getTwitterFollowers($select_title);
			$tweets = json_decode(ux_tweets_api($select_title, $select_number));
			if(function_exists('rawurlencode')){
				echo 'rawurlencode';
			}else{
				echo 'no-rawurlencode';
			}
			echo '<br />';
			
			if(function_exists('hash_hmac')){
				echo 'hash_hmac';
			}else{
				echo 'no-hash_hmac';
			}
			echo '<br />';
			
			if(function_exists('base64_encode')){
				echo 'base64_encode';
			}else{
				echo 'no-base64_encode';
			}
			echo '<br />';
			
			if(function_exists('curl_init')){
				echo 'curl_init';
			}else{
				echo 'no-curl_init';
			}
			echo '<br />';
			
			if(function_exists('curl_setopt')){
				echo 'curl_setopt';
			}else{
				echo 'no-curl_setopt';
			}
			echo '<br />';
			
			if(function_exists('curl_exec')){
				echo 'curl_exec';
			}else{
				echo 'no-curl_exec';
			}
			echo '<br />';
			
			if(function_exists('paeson')){
				echo 'paeson';
			}else{
				echo 'no-paeson';
			}
			echo '<br />';
			
			if($tweets){ ?>
                <div class="twitter-wrap">
                    <i class="s-twitter"></i>
                    <div class="flexslider">
                        <ul class="slides clearfix">
                            <?php if(!isset($tweets->errors)){
                                foreach($tweets as $twit){ ?>
                                    <li><?php echo $twit->text; ?></li>
                                <?php 
                                }
                            }else{ ?>
                                <li><?php echo $tweets->errors[0]->message; ?></li>
                            <?php } ?>
                        </ul>
                    </div><!--End flexslider-->
                </div><!--End twitter-wrap-->
            
            <?php
			}
        break;
	}
}
add_action('ux_view_module_switch', 'ux_p5_view_module_switch');

function ux_tweets_api($screen_name, $count){
	$oauth_hash = '';
	$oauth_hash .= 'count=' . $count . '&';
	$oauth_hash .= 'oauth_consumer_key=Y0xwl0AhZQwU1NpWF9bA&';
	$oauth_hash .= 'oauth_nonce=' . time() . '&';
	$oauth_hash .= 'oauth_signature_method=HMAC-SHA1&';
	$oauth_hash .= 'oauth_timestamp=' . time() . '&';
	$oauth_hash .= 'oauth_token=259654516-c7h6Gz81OurmjBH8hQ40HajnLwIA0kYtqW1qFRFB&';
	$oauth_hash .= 'oauth_version=1.0&';
	$oauth_hash .= 'screen_name=' . $screen_name . '';
	
	$base = '';
	$base .= 'GET';
	$base .= '&';
	$base .= rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json');
	$base .= '&';
	$base .= rawurlencode($oauth_hash);
	$key = '';
	$key .= rawurlencode('4rTqKq24Adhce1QazeD5jzXxlw0j1RNIHgBtw83zqU');
	$key .= '&';
	$key .= rawurlencode('hW1TTh2hTYdBgryzXVtGizI2Yamv833diwPPa8LqxdVs4');
	
	$signature = base64_encode(hash_hmac('sha1', $base, $key, true));
	$signature = rawurlencode($signature);
	
	$oauth_header = '';
	$oauth_header .= 'count="' . $count . '", ';
	$oauth_header .= 'oauth_consumer_key="Y0xwl0AhZQwU1NpWF9bA", ';
	$oauth_header .= 'oauth_nonce="' . time() . '", ';
	$oauth_header .= 'oauth_signature="' . $signature . '", ';
	$oauth_header .= 'oauth_signature_method="HMAC-SHA1", ';
	$oauth_header .= 'oauth_timestamp="' . time() . '", ';
	$oauth_header .= 'oauth_token="259654516-c7h6Gz81OurmjBH8hQ40HajnLwIA0kYtqW1qFRFB", ';
	$oauth_header .= 'oauth_version="1.0", ';
	$oauth_header .= 'screen_name="' . $screen_name . '"'; 
	
	$curl_header = array("Authorization: Oauth {$oauth_header}", 'Expect:');
	
	$curl_request = curl_init();
	
	curl_setopt($curl_request, CURLOPT_HTTPHEADER, $curl_header);
	curl_setopt($curl_request, CURLOPT_HEADER, false);
	curl_setopt($curl_request, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/user_timeline.json?count=' . $count . '&screen_name=' . $screen_name);
	curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);
	$json = curl_exec($curl_request);
	curl_close($curl_request);
	
	return $json;
}

function getTwitterFollowers($screenName = 'codeforest')
{
    // some variables
    $consumerKey = 'Y0xwl0AhZQwU1NpWF9bA';
    $consumerSecret = '4rTqKq24Adhce1QazeD5jzXxlw0j1RNIHgBtw83zqU';
    $token = get_option('cfTwitterToken');
 
    // get follower count from cache
    $numberOfFollowers = get_transient('cfTwitterFollowers');
 
    // cache version does not exist or expired
    if (false === $numberOfFollowers) {
        // getting new auth bearer only if we don't have one
        if(!$token) {
            // preparing credentials
            $credentials = $consumerKey . ':' . $consumerSecret;
            $toSend = base64_encode($credentials);
 
            // http post arguments
            $args = array(
                'method' => 'POST',
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => 'Basic ' . $toSend,
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
                ),
                'body' => array( 'grant_type' => 'client_credentials' )
            );
 
            add_filter('https_ssl_verify', '__return_false');
            $response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);
 
            $keys = json_decode(wp_remote_retrieve_body($response));
 
            if($keys) {
                // saving token to wp_options table
                update_option('cfTwitterToken', $keys->access_token);
                $token = $keys->access_token;
            }
        }
        // we have bearer token wether we obtained it from API or from options
        $args = array(
            'httpversion' => '1.1',
            'blocking' => true,
            'headers' => array(
                'Authorization' => "Bearer $token"
            )
        );
 
        add_filter('https_ssl_verify', '__return_false');
        $api_url = "https://api.twitter.com/1.1/users/show.json?screen_name=$screenName";
        $response = wp_remote_get($api_url, $args);
 
        if (!is_wp_error($response)) {
            $followers = json_decode(wp_remote_retrieve_body($response));
            $numberOfFollowers = $followers->followers_count;
        } else {
            // get old value and break
            $numberOfFollowers = get_option('cfNumberOfFollowers');
            // uncomment below to debug
            //die($response->get_error_message());
        }
 
        // cache for an hour
        set_transient('cfTwitterFollowers', $numberOfFollowers, 1*60*60);
        update_option('cfNumberOfFollowers', $numberOfFollowers);
    }
 
    return $numberOfFollowers;
}
?>