<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Flickr Widget For Sidebar/Footer
 	Plugin URI: http://www.color-theme.com
 	Description: A widget thats displays your projects from flickr.com
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'CrossRoad_load_categories_widgets');

function CrossRoad_load_categories_widgets()
{
	register_widget('CrossRoad_Categories_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class CrossRoad_Categories_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CrossRoad_Categories_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'crossroad_categories_widget', 'description' => __( 'CrossRoad: Categories Widget', 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_categories_widget' );

		/* Create the widget. */		
		$this->WP_Widget( 'crossroad_categories_widget', __( 'CrossRoad: Categories Widget' , 'color-theme-framework' ), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$background = $instance['background'];

	// Before widget (defined by theme functions file)
	echo $before_widget;
	echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';
	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>

	<?php
	  $cat_left = '';
	  $cat_right = '';
	  $cats = explode("<br />",wp_list_categories('title_li=&echo=0&depth=1&style=none'));
 	  $cat_n = count($cats) - 1;
 	  for ($i=0;$i<$cat_n;$i++):
	    if ($i<$cat_n/2):
		  $cat_left = $cat_left.'<li>'.$cats[$i].'</li>';
		elseif ($i>=$cat_n/2):
		  $cat_right = $cat_right.'<li>'.$cats[$i].'</li>';
		endif;
	  endfor;
	?>
	
	<div class="row-fluid" style="border-top: 1px solid #EBECED;padding-top: 10px;">
	  <div class="span6">
		<ul class="left-col">
	  	  <?php echo $cat_left;?>
		</ul><!-- left-col -->
	  </div><!-- span6 -->
	  <div class="span6">
		<ul class="right-col">
	  	  <?php echo $cat_right;?>
		</ul><!-- right-col -->
	  </div><!-- span6 -->
	</div><!-- row-fluid -->
	
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
	$instance['background'] = strip_tags($new_instance['background']);
	// Stripslashes for html inputs

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'Categories' , 'color-theme-framework' ) );
	
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
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'color-theme-framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
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