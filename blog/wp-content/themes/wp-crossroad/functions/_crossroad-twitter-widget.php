<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Twitter Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that displays messages from twitter.com
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'CrossRoad_twitter_load_widgets' );

// Register widget
function CrossRoad_twitter_load_widgets() {
	register_widget( 'CrossRoad_Twitter_Widget' );
}

// Widget class
class CrossRoad_Twitter_Widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function CrossRoad_Twitter_Widget() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'crossroad_twitter_widget' , 'description' => __( 'Twitter Widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_twitter_widget' );
		
		/* Create the widget. */
		$this->WP_Widget('crossroad_twitter_widget', __( 'CrossRoad: Twitter Widget' , 'color-theme-framework' ) , $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );
	global $wpdb;

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$user_name = $instance['user_name'];
	$count_message = $instance['count_message'];	
	$background = $instance['background'];
	
	// Before widget (defined by theme functions file)
	echo $before_widget;
	echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';
	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;
	// Display widget
	
	$time_id = rand();	
	?>

<script type="text/javascript">
/***************************************************
					Flickr
***************************************************/
jQuery.noConflict()(function($){
$(document).ready(function() {

	  $(".tweet-<?php echo $time_id; ?>").tweet({
        	count: <?php echo $count_message; ?>,
        	username: "<?php echo $instance['user_name']; ?>",
        	loading_text: "     loading feed..."
//			avatar_size: 32      
		});
});
});
</script>		

			<div class="tweet tweet-<?php echo $time_id; ?>"></div>
	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['user_name'] = stripslashes( $new_instance['user_name']);
	$instance['count_message'] = stripslashes( $new_instance['count_message']);	
	$instance['background'] = strip_tags($new_instance['background']);
	
	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'Latest Tweets' , 'color-theme-framework' ), 'user_name' => 'envato', 'count_message' => '3', );
	
	$instance = wp_parse_args( (array) $instance, $defaults );
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


	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'color-theme-framework' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	
	<!-- User Name For Twitter Service Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'user_name' ); ?>"><?php _e( 'User Name:' , 'color-theme-framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_name' ); ?>" name="<?php echo $this->get_field_name( 'user_name' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['user_name'] ), ENT_QUOTES)); ?>" />
	</p>

	<!-- Count Messages: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'count_message' ); ?>"><?php _e( 'The Number of Displayed Messages:' , 'color-theme-framework' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'count_message' ); ?>" name="<?php echo $this->get_field_name( 'count_message' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['count_message'] ), ENT_QUOTES)); ?>" />
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