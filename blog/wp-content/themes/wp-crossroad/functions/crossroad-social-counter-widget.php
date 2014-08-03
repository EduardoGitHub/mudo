<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Social Counter Sidebar Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show counters for facebook/twitter/feedburner.
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CrossRoad_social_counter_load_widgets');


function CrossRoad_social_counter_load_widgets(){
		register_widget("CrossRoad_social_counter_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_social_counter_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CrossRoad_social_counter_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'crossroad_social_counter_widget', 'description' => __( 'Social Counter Widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_social_counter_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_social_counter_widget', __( 'CrossRoad: Social Counter' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
			$title = $instance['title'];
			$twitter_ID = $instance['twitter_ID'];
			$facebook_ID = $instance['facebook_ID'];
			$youtube_ID = $instance['youtube_ID'];
			
			$show_twitter = isset($instance['show_twitter']) ? 'true' : 'false';
			$show_facebook = isset($instance['show_facebook']) ? 'true' : 'false';
			$show_youtube = isset($instance['show_youtube']) ? 'true' : 'false';
			$background = $instance['background'];
		?>


		<?php
		/* Before widget (defined by themes). */
		echo $before_widget;
		echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
		?>
	
		<?php	
		

	/* ============ FUNCTIONS ============ */
	function curl_subscribers_text_counter( $xml_url ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $xml_url);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}


	function yt_count( $username ) { 
		try {
			@$xmlData = @curl_subscribers_text_counter('http://gdata.youtube.com/feeds/api/users/' . strtolower($username)); 
			@$xmlData = str_replace('yt:', 'yt', $xmlData); 
			@$xml = new SimpleXMLElement($xmlData); 
			@$ytCount['yt_count'] = ( string ) $xml->ytstatistics['subscriberCount'];
			@$ytCount['page_url'] = "http://www.youtube.com/user/".$username;
		} catch (Exception $e) {
			$ytCount['yt_count'] = 0;
			$ytCount['page_url'] = "http://www.youtube.com";
		}
		return($ytCount); 
	} 
		
		
		
		/* ============ FACEBOOK ============ */

			if( !empty( $facebook_ID ) ) {

				$fans = get_transient('social_subscribers_counter_facebook');
			
				if( false === $fans ) {
			
					$urlFacebook = (array)wp_remote_get("http://graph.facebook.com/" . $facebook_ID );
					$facebookAccount = json_decode($urlFacebook['body']);
					$fans = $facebookAccount->likes;
					
					if( $fans != 0 ) {
						set_transient('social_subscribers_counter_facebook', $fans, 3600);
					}	
				}	
			}

		/* ============ YOUTUBE ============ */

			if( !empty( $youtube_ID ) ) {

				$yt_subscribers = get_transient('social_subscribers_counter_youtube');

				if( false === $yt_subscribers ) {

					$youtube = yt_count($youtube_ID);
					$yt_subscribers = $youtube['yt_count'];

					if( $yt_subscribers != 0 ) {
						set_transient('social_subscribers_counter_youtube', $yt_subscribers, 3600);
					}	
				}	
			}

		/* ============ TWITTER ============ */

		ob_start();
		
		if( !empty( $twitter_ID ) and ($show_twitter == 'true') ) {  

			$followers = get_transient('social_subscribers_counter_twitter3');
			
			if( false === $followers ) {	
			
				ini_set('display_errors', 1);
				require_once("TwitterAPIExchange.php");

				/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
				global $data;
				$oauth_access_token = $data['ct_user_token'];
				$oauth_access_token_secret = $data['ct_user_secret'];
				$consumer_key = $data['ct_consumer_key'];
				$consumer_secret = $data['ct_consumer_secret'];

				$settings = array(
    				'oauth_access_token' => $oauth_access_token,
    				'oauth_access_token_secret' => $oauth_access_token_secret,
    				'consumer_key' => $consumer_key,
    				'consumer_secret' => $consumer_secret
				);

				if( ( empty($consumer_key) || empty($consumer_secret) || empty($oauth_access_token) || empty($oauth_access_token_secret) ) ) {
					echo '<span class="counters_info">Please fill all Twitter Settings (menu Appearance -> Theme Options -> Twitter settings)</span>' . $after_widget;
					return;
				}

				/** Perform a GET request and echo the response **/
				/** Note: Set the GET field BEFORE calling buildOauth(); **/
				$url = 'https://api.twitter.com/1.1/users/show.json';
				$getfield = '?screen_name=' . $twitter_ID;
				$requestMethod = 'GET';
				$twitter = new TwitterAPIExchange($settings);
				$response = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

				$followers_decode = json_decode($response);
				$followers = $followers_decode->followers_count;

				if ( $followers != 0 ) {
					set_transient('social_subscribers_counter_twitter3', $followers, 3600);
				}	
			} //false
		}

		
		?>

	<div class="social-center">
		<?php
		  if ( $title ) : 
		    echo '<ul id="social-counter" style="border-top: 1px solid #EBECED; padding-top: 15px;">';
		  else : echo '<ul id="social-counter">';
		  endif;
		?>
		
		<?php if ( $show_facebook == 'true') : ?>
		<li class="facebook-social">
		  <a href="https://www.facebook.com/<?php echo $facebook_ID ?>"><span class="c-icon"></span>
		  <?php echo '<span class="social">' . $fans . '</span>'; ?><br/><span class="fans"><?php _e('Fans','color-theme-framework'); ?></span></a>
		</li>
		<?php endif; ?>

		<?php if ( $show_twitter == 'true') : ?>
		<li class="twitter-social">
		  <a href="http://twitter.com/<?php echo $twitter_ID ?>"><span class="c-icon"></span>
			<?php echo '<span class="social">' . $followers . '</span>'; ?><br/><span class="fans"><?php _e('Followers','color-theme-framework'); ?></span></a>
		</li>
		<?php endif; ?>

		<?php if ( $show_youtube == 'true') : ?>
		<li class="youtube-social">
		  <a href="http://www.youtube.com/user/<?php echo $youtube_ID ?>"><span class="c-icon"></span>
			<?php echo '<span class="social">' . $yt_subscribers . '</span>'; ?><br/><span class="fans"><?php _e('Subscribers','color-theme-framework'); ?></span></a>
		</li>
		<?php endif; ?>

		</ul>
	</div><!-- social-center -->

		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];		
		$instance['twitter_ID'] = $new_instance['twitter_ID'];
		$instance['facebook_ID'] = $new_instance['facebook_ID'];
		$instance['youtube_ID'] = $new_instance['youtube_ID'];
		$instance['show_twitter'] = $new_instance['show_twitter'];
		$instance['show_facebook'] = $new_instance['show_facebook'];
		$instance['show_youtube'] = $new_instance['show_youtube'];

		$instance['background'] = strip_tags($new_instance['background']);
		
		delete_transient('social_subscribers_counter_twitter3');
		delete_transient('social_subscribers_counter_facebook');
		delete_transient('social_subscribers_counter_feedburner');
		delete_transient('social_subscribers_counter_youtube');		

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		?>
		<?php
			$defaults = array( 
			'title' => __( 'Social Counters', 'color-theme-framework' ), 
			'twitter_ID' => 'envato' , 
			'facebook_ID' => 'themeforest', 
			'youtube_ID' => 'Envato',
			'show_twitter' => 'on',
			'show_facebook' => 'on',
			'show_youtube' => 'on' );
			
			$instance = wp_parse_args((array) $instance, $defaults); 
			$background = esc_attr($instance['background']); ?>

		<script type="text/javascript">
			//<![CDATA[
				jQuery(document).ready(function()
				{
					// colorpicker field
					jQuery('.cw-color-picker').each(function(){
						var $this = jQuery(this),
							id = $this.attr('rel');

						$this.farbtastic('#' + id);
					});
				});
			//]]>   
		  </script>	
		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_ID'); ?>"><?php _e( 'Twitter ID:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('twitter_ID'); ?>" name="<?php echo $this->get_field_name('twitter_ID'); ?>" value="<?php echo $instance['twitter_ID']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('facebook_ID'); ?>"><?php _e( 'Facebook ID:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('facebook_ID'); ?>" name="<?php echo $this->get_field_name('facebook_ID'); ?>" value="<?php echo $instance['facebook_ID']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('youtube_ID'); ?>"><?php _e( 'YouTube ID:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('youtube_ID'); ?>" name="<?php echo $this->get_field_name('youtube_ID'); ?>" value="<?php echo $instance['youtube_ID']; ?>" />
		</p>
		
		<p style="display:block; margin-bottom:5px;">
			<label for="Show counters" style="display:block;"><?php _e( 'Show counters:' , 'color-theme-framework' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_twitter'], 'on'); ?> id="<?php echo $this->get_field_id('show_twitter'); ?>" name="<?php echo $this->get_field_name('show_twitter'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_twitter'); ?>"><?php _e( 'Twitter' , 'color-theme-framework' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_facebook'], 'on'); ?> id="<?php echo $this->get_field_id('show_facebook'); ?>" name="<?php echo $this->get_field_name('show_facebook'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_facebook'); ?>"><?php _e( 'Facebook' , 'color-theme-framework' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_youtube'], 'on'); ?> id="<?php echo $this->get_field_id('show_youtube'); ?>" name="<?php echo $this->get_field_name('show_youtube'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_youtube'); ?>"><?php _e( 'Youtube' , 'color-theme-framework' ); ?></label>
		</p>		

		<p>
          <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Border Color:', 'color-theme-framework'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php if($background) { echo $background; } else { echo '#E64946'; } ?>" />
			<div class="cw-color-picker" rel="<?php echo $this->get_field_id('background'); ?>"></div>
        </p>
        
		<?php

	}
}
?>