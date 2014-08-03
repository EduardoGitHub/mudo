<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Text Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show recent posts ( Specified by cat-id )
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'crossroad_text_load_widgets' );

function crossroad_text_load_widgets()
{
	register_widget('CrossRoad_Text_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_Text_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function CrossRoad_Text_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'crossroad_text_widget', 'description' => __( 'Text Widget' , 'color-theme-framework' ) );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_text_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_text_widget', __( 'CrossRoad: Text' , 'color-theme-framework' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$text  = $instance['text'];
		$remove_background = isset($instance['remove_background']) ? 'true' : 'false';
		$remove_margins = isset($instance['remove_margins']) ? 'true' : 'false';
		$center_text = isset($instance['center_text']) ? 'true' : 'false';

		$background = $instance['background'];

		if ( $remove_margins == 'false' && $remove_background == 'true' ) :
		  echo '<div class="widget margin-25t clearfix" style="padding: 20px;">';		
		elseif ( $remove_margins == 'true' && $remove_background == 'true') :
		  echo '<div class="widget margin-25t clearfix">';
		elseif ( $remove_margins == 'true' && $remove_background == 'false') :
		  echo '<div class="widget margin-25t clearfix" style="background: white;">';
		else :
		  echo '<div class="widget box margin-25t bt-5px b-shadow clearfix">';		
		  echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';		  
		endif;
		?>
		
		<!-- BEGIN WIDGET -->
		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
		
		?>
		
		<?php 
			global $data;
		

		if ( $center_text == 'true' ): ?>
		  <div class="text-widget" style="overflow: hidden;text-align: center;"><?php echo $text; ?></div>
		<?php else : ?>
		  <div class="text-widget" style="overflow: hidden;"><?php echo $text; ?></div>
		<?php endif; ?>
	
		<!-- END WIDGET -->
		<?php
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = $new_instance['text'];

		$instance['remove_background'] = $new_instance['remove_background'];
		$instance['remove_margins'] = $new_instance['remove_margins'];
		$instance['center_text'] = $new_instance['center_text'];
		$instance['background'] = strip_tags($new_instance['background']);
				
		return $instance;
	}


	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array('title' => __( 'Text' , 'color-theme-framework' ), 'remove_background' => 'off', 'remove_margins' => 'off', 'background' => '#E64946', 'text' => '', 'center_text' => 'off');
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
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<textarea class="widefat" style="width: 216px;" rows="16" cols="20" style="width: 30px;" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $instance['text']; ?></textarea>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['remove_background'], 'on'); ?> id="<?php echo $this->get_field_id('remove_background'); ?>" name="<?php echo $this->get_field_name('remove_background'); ?>" /> 
			<label for="<?php echo $this->get_field_id('remove_background'); ?>"><?php _e( 'Remove background' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['remove_margins'], 'on'); ?> id="<?php echo $this->get_field_id('remove_margins'); ?>" name="<?php echo $this->get_field_name('remove_margins'); ?>" /> 
			<label for="<?php echo $this->get_field_id('remove_margins'); ?>"><?php _e( 'Remove margins' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['center_text'], 'on'); ?> id="<?php echo $this->get_field_id('center_text'); ?>" name="<?php echo $this->get_field_name('center_text'); ?>" /> 
			<label for="<?php echo $this->get_field_id('center_text'); ?>"><?php _e( 'Centering Text' , 'color-theme-framework' ); ?></label>
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