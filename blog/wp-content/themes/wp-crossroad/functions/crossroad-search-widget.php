<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Search Widget
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
add_action( 'widgets_init', 'crossroad_search_load_widgets' );

function crossroad_search_load_widgets()
{
	register_widget('CrossRoad_Search_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_Search_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function CrossRoad_Search_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'crossroad_search_widget', 'description' => __( 'Search Widget' , 'color-theme-framework' ) );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_search_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_search_widget', __( 'CrossRoad: Search' , 'color-theme-framework' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];

		$background = $instance['background'];
		
		echo $before_widget;
		echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';
		?>
		<!-- BEGIN WIDGET -->
		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
		
		?>
		
		<?php 
			global $data;
		?>


			<?php
		  if ( $title ) : 
		    echo '<div class="bt-pt15-1px"></div>';
		  endif;
		?>

		<div id="search-block"><?php get_search_form(); ?></div><!-- /search-block -->

	
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
		$defaults = array('title' => __( 'Search' , 'color-theme-framework' ));
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
          <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Border Color:', 'color-theme-framework'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php if($background) { echo $background; } else { echo '#E64946'; } ?>" />
			<div class="cw-color-picker" rel="<?php echo $this->get_field_id('background'); ?>"></div>
        </p>
        		
	<?php 
	}
}
?>