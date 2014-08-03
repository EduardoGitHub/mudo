<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Social Icons Sidebar Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show icons for Social Services.
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CrossRoad_social_load_widgets');


function CrossRoad_social_load_widgets(){
		register_widget("CrossRoad_socialicons_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_socialicons_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CrossRoad_socialicons_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'crossroad_social_icons_widget', 'description' => __( 'Social Icons Widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_social_icon_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_social_icon_widget', __( 'CrossRoad: Social Icons' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		
		$behance = $instance['behance'];
		$delicious = $instance['delicious'];
		$deviantart = $instance['deviantart'];		
		$digg = $instance['digg'];				
		$dribbble = $instance['dribbble'];
		$facebook = $instance['facebook'];		
		$flickr = $instance['flickr'];		
		$forrst = $instance['forrst'];
		$google = $instance['google'];		
		$lastfm = $instance['lastfm'];		
		$linkedin = $instance['linkedin'];		
		$pinterest = $instance['pinterest'];		
		$rss = $instance['rss'];		
		$skype = $instance['skype'];		
		$tumblr = $instance['tumblr'];		
		$twitter = $instance['twitter'];		
		$vimeo = $instance['vimeo'];		
		$youtube = $instance['youtube'];
		$background = $instance['background'];

		// Before widget (defined by theme functions file)
		echo $before_widget;
		echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';

		?>

		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>

		<?php
		  if ( $title ) : 
		    echo '<div class="clearfix" style="border-top: 1px solid #EBECED; padding-top:10px">';
		  else : echo '<div class="clearfix">';
		  endif;
		?>

			<?php 
				if( $behance != '' ) echo '<a href="' . $behance . '" class="behance" target="_blank" title="Behance"></a>'; 
				if( $delicious != '' ) echo '<a href="' . $delicious . '" class="delicious" target="_blank" title="Delicious"></a>'; 				
				if( $deviantart != '' ) echo '<a href="' . $deviantart . '" class="deviantart" target="_blank" title="Deviantart"></a>'; 								
				if( $digg != '' ) echo '<a href="' . $digg . '" class="digg" target="_blank" title="Digg"></a>';
				if( $dribbble != '' ) echo '<a href="' . $dribbble . '" class="dribbble" target="_blank" title="Dribbble"></a>';
				if( $facebook != '' ) echo '<a href="' . $facebook . '" class="facebook" target="_blank" title="Facebook"></a>';				
				if( $flickr != '' ) echo '<a href="' . $flickr . '" class="flickr" target="_blank" title="Flickr"></a>';				
				if( $forrst != '' ) echo '<a href="' . $forrst . '" class="forrst" target="_blank" title="Forrst"></a>';				
				if( $google != '' ) echo '<a href="' . $google . '" class="google" target="_blank" title="Google"></a>';								
				if( $lastfm != '' ) echo '<a href="' . $lastfm . '" class="lastfm" target="_blank" title="LastFm"></a>';												
				if( $linkedin != '' ) echo '<a href="' . $linkedin . '" class="linkedin" target="_blank" title="Linkedin"></a>';																
				if( $pinterest != '' ) echo '<a href="' . $pinterest . '" class="pinterest" target="_blank" title="Pinterest"></a>';																				
				if( $rss != '' ) echo '<a href="' . $rss . '" class="rss" target="_blank" title="RSS"></a>';																								
				if( $skype != '' ) echo '<a href="' . $skype . '" class="skype" target="_blank" title="Skype"></a>';																												
				if( $tumblr != '' ) echo '<a href="' . $tumblr . '" class="tumblr" target="_blank" title="Tumblr"></a>';
				if( $twitter != '' ) echo '<a href="' . $twitter . '" class="twitter" target="_blank" title="Twitter"></a>';				
				if( $vimeo != '' ) echo '<a href="' . $vimeo . '" class="vimeo" target="_blank" title="Vimeo"></a>';								
				if( $youtube != '' ) echo '<a href="' . $youtube . '" class="youtube" target="_blank" title="Youtube"></a>';
			?>												
		</div>				

	<?php
	// After widget (defined by theme functions file)
	echo $after_widget;

			
			?>
	
		<?php
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];	
			
		$instance['behance'] = $new_instance['behance'];
		$instance['delicious'] = $new_instance['delicious'];
		$instance['deviantart'] = $new_instance['deviantart'];		
		$instance['digg'] = $new_instance['digg'];				
		$instance['dribbble'] = $new_instance['dribbble'];
		$instance['facebook'] = $new_instance['facebook'];		
		$instance['flickr'] = $new_instance['flickr'];		
		$instance['forrst'] = $new_instance['forrst'];
		$instance['google'] = $new_instance['google'];		
		$instance['lastfm'] = $new_instance['lastfm'];		
		$instance['linkedin'] = $new_instance['linkedin'];		
		$instance['pinterest'] = $new_instance['pinterest'];		
		$instance['rss'] = $new_instance['rss'];		
		$instance['skype'] = $new_instance['skype'];		
		$instance['tumblr'] = $new_instance['tumblr'];		
		$instance['twitter'] = $new_instance['twitter'];		
		$instance['vimeo'] = $new_instance['vimeo'];		
		$instance['youtube'] = $new_instance['youtube'];
		$instance['background'] = strip_tags($new_instance['background']);
		
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
			$defaults = array( 'title' => __( 'Get Social', 'color-theme-framework' ), 'behance' => '' , 'delicious' => '', 'deviantart' => '', 'digg' => '', 'dribbble' => '', 'facebook' => '', 'flickr' => '', 'forrst' => '', 'google' => '', 'lastfm' => '', 'linkedin' => '', 'pinterest' => '', 'rss' => '', 'skype' => '', 'tumblr' => '', 'twitter' => '', 'vimeo' => '', 'youtube' => '' );
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
			<label for="<?php echo $this->get_field_id('behance'); ?>"><?php _e( 'URL for Behance Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('behance'); ?>" name="<?php echo $this->get_field_name('behance'); ?>" value="<?php echo $instance['behance']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('delicious'); ?>"><?php _e( 'URL for Delicious Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('delicious'); ?>" name="<?php echo $this->get_field_name('delicious'); ?>" value="<?php echo $instance['delicious']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('deviantart'); ?>"><?php _e( 'URL for Deviantart Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('deviantart'); ?>" name="<?php echo $this->get_field_name('deviantart'); ?>" value="<?php echo $instance['deviantart']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('digg'); ?>"><?php _e( 'URL for Digg Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('digg'); ?>" name="<?php echo $this->get_field_name('digg'); ?>" value="<?php echo $instance['digg']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php _e( 'URL for Dribbble Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('dribbble'); ?>" name="<?php echo $this->get_field_name('dribbble'); ?>" value="<?php echo $instance['dribbble']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e( 'URL for Facebook Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $instance['facebook']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e( 'URL for Flickr Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $instance['flickr']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('forrst'); ?>"><?php _e( 'URL for Forrst Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('forrst'); ?>" name="<?php echo $this->get_field_name('forrst'); ?>" value="<?php echo $instance['forrst']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('google'); ?>"><?php _e( 'URL for Google Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" value="<?php echo $instance['google']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('lastfm'); ?>"><?php _e( 'URL for LastFm Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('lastfm'); ?>" name="<?php echo $this->get_field_name('lastfm'); ?>" value="<?php echo $instance['lastfm']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e( 'URL for Linkedin Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo $instance['linkedin']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e( 'URL for Pinterest Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo $instance['pinterest']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e( 'URL for RSS Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $instance['rss']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('skype'); ?>"><?php _e( 'URL for Skype Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" value="<?php echo $instance['skype']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e( 'URL for Tumblr Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" value="<?php echo $instance['tumblr']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e( 'URL for Twitter Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e( 'URL for Vimeo Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" value="<?php echo $instance['vimeo']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e( 'URL for Youtube Service:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $instance['youtube']; ?>" />
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