<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Facebook Like Box Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show like box from facebook.com
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/*
==========================================================================
  Add function to widgets_init that'll load our widget.
==========================================================================  
*/

add_action('widgets_init','CrossRoad_fblikebox_load_widgets');


function CrossRoad_fblikebox_load_widgets(){
		register_widget("CrossRoad_fb_likebox_Widget");
}

/*
==========================================================================
  Widget class.
  This class handles everything that needs to be handled with the widget:
  the settings, form, display, and update. 
==========================================================================
*/
class CrossRoad_fb_likebox_Widget extends WP_widget{

	/* Widget setup. */
	function CrossRoad_fb_likebox_Widget(){
		
		/* Widget settings. */		
		$widget_ops = array( 'classname' => 'crossroad_fblikebox_widget', 'description' => __( 'FB Like Box Widget For Sidebar' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_fblikebox_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_fblikebox_widget' , __( 'CrossRoad: FB Like Box' , 'color-theme-framework' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$page_url = $instance['page_url'];
		$lang = $instance['lang'];		
		$theme_color = $instance['theme_color'];
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$stream = isset($instance['stream']) ? 'true' : 'false';		
		$header = isset($instance['header']) ? 'true' : 'false';
		$background = $instance['background'];

		echo $before_widget;
		echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';
		?>
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $lang; ?>/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
			
		<div class="facebook-box" style="margin:0 -10px;">
			<div class="fb-like-box" data-href="<?php echo $page_url; ?>" data-border-color="#fff"  data-show-faces="<?php echo $show_faces; ?>" <?php if( $theme_color == 'dark' ) echo 'data-colorscheme="dark"'; ?> data-stream="<?php echo $stream; ?>" data-header="<?php echo $header; ?>"></div>
		</div><!-- facebook-box -->

			<?php
			echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['page_url'] = $new_instance['page_url'];
		$instance['lang'] = $new_instance['lang'];
		$instance['theme_color'] = $new_instance['theme_color'];
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['stream'] = $new_instance['stream'];		
		$instance['header'] = $new_instance['header'];	
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
			$defaults = array( 'title'=> __( 'FB Like Box' , 'color-theme-framework' ), 'page_url' => 'http://facebook.com/envato', 'lang' => 'en_US', 'theme_color' => 'light', 'show_faces' => 'on', 'stream' => 'off', 'header' => 'on' );
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
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('page_url'); ?>"><?php _e( 'Facebook Page URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('page_url'); ?>" name="<?php echo $this->get_field_name('page_url'); ?>" value="<?php echo $instance['page_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e( 'Facebook Language:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 60px;" id="<?php echo $this->get_field_id('lang'); ?>" name="<?php echo $this->get_field_name('lang'); ?>" value="<?php echo $instance['lang']; ?>" />
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e( 'Show Faces' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_stream'], 'on'); ?> id="<?php echo $this->get_field_id('show_stream'); ?>" name="<?php echo $this->get_field_name('show_stream'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_stream'); ?>"><?php _e( 'Show Stream' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['header'], 'on'); ?> id="<?php echo $this->get_field_id('header'); ?>" name="<?php echo $this->get_field_name('header'); ?>" /> 
			<label for="<?php echo $this->get_field_id('header'); ?>"><?php _e( 'Show Header' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'theme_color' ); ?>"><?php _e('Theme Color:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme_color' ); ?>" name="<?php echo $this->get_field_name( 'theme_color' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'dark' == $instance['theme_color'] ) echo 'selected="selected"'; ?>>dark</option>
				<option <?php if ( 'light' == $instance['theme_color'] ) echo 'selected="selected"'; ?>>light</option>
			</select>
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