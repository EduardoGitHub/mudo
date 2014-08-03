<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Recent Posts Widget For Sidebar
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
add_action( 'widgets_init', 'crossroad_posts_load_widgets' );

function crossroad_posts_load_widgets()
{
	register_widget('CrossRoad_Recent_Posts_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function CrossRoad_Recent_Posts_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'crossroad_posts_widget', 'description' => __( 'Display Recent Posts by Categories' , 'color-theme-framework' ) );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_posts_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_posts_widget', __( 'CrossRoad: Recent Posts' , 'color-theme-framework' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$num_posts = $instance['num_posts'];

		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$show_category = isset($instance['show_category']) ? 'true' : 'false';
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$blank_thumb = isset($instance['blank_thumb']) ? 'true' : 'false';
		$background = $instance['background'];
		
		echo $before_widget;
		echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';
		?>
		<!-- BEGIN WIDGET -->

	    <?php
		  if ($title) {
			if ( $categories != 'all' ):
			$category_title_link = get_category_link( $categories );
			echo '<div class="widget-title category-title"><h2><a href="'.$category_title_link.'" title="'.__('View all posts in ','color-theme-framework').$title.'">'.$title.'</a></h2></div><!-- widget-title -->';
			else : echo $before_title.$title.$after_title;
			endif;
		  }
		?>
		
		<?php 
			global $post, $data;
			$theme_color = stripslashes ( $data['crossroad_theme_color'] );
			if ( $show_related == 'true' ) :
			  $related_category = get_the_category($post->ID);
			  $related_category_id = get_cat_ID( $related_category[0]->cat_name );			
			  $recent_posts = new WP_Query(array('showposts' => $num_posts, 'post_type' => 'post', 'cat' => $related_category_id, 'post__not_in' => array( $post->ID )));
			else :
			  $recent_posts = new WP_Query(array('showposts' => $num_posts, 'post_type' => 'post', 'cat' => $categories));
			endif;
		?>
	
		<ul class="recent-post-widget"><!-- version 1.0.4 -->
		  <?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>

		    <li class="clearfix">
			  <?php if( $show_image == 'true' ): ?>
			    <?php if(has_post_thumbnail()): ?>
				    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumb'); 
				    if ( $image[1] == 50 && $image[2] == 50 ) : ?>
					  <div class="widget-thumb">
					    <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
					  </div><!-- widget-thumb -->
					<?php else :   
			  		  $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
					  <div class="widget-thumb">
					    <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
					  </div><!-- widget-thumb -->
	          		<?php endif; ?>
			    <?php endif; ?><!-- show_image -->
			  <?php endif; ?><!-- has_post_thumbnail -->


			  <?php if ( $show_image == 'false' or $blank_thumb == 'false' ) : ?>
  			    <div class="post-title" style="margin-left:0;">
			  <?php elseif( $show_image == 'true' or $blank_thumb == 'true' ): ?>
			    <div class="post-title">
			  <?php endif; ?>
			    <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><?php the_title(); ?></a></div><!-- post-title -->


			  <?php if ( $show_image == 'false' or ($blank_thumb == 'false' && !has_post_thumbnail()) ) : ?>
 			  	<div class="meta" style="margin-left:0;">
			  <?php elseif( $show_image == 'true' or $blank_thumb == 'true' ): ?>
			  	<div class="meta">
			  <?php endif; ?>

		        <?php if (  $show_category == 'true' ) : 
			    
		  		  $category = get_the_category(); 
		   		  $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id );
		  		  $cat_color = ct_get_color($category[0]->term_id);
		  		  if ( $cat_color == '') { $cat_color = $theme_color; } ?>
				  <span class="category-item" style="background-color:<?php echo $cat_color; ?>"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php _e('View all posts in ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></span>
			  	  <span class="meta-time" style="margin-top: 5px;display: block;"><?php the_time('M j, Y'); ?></span>
			    <?php else: ?>
				  <span class="meta-time" style="margin-top: -5px;display: block;"><?php the_time('M j, Y'); ?></span>
				<?php endif; ?>
			  </div><!-- meta -->
			</li>
		  <?php endwhile; ?>
		</ul><!-- recent-post-widget -->

		
		<?php wp_reset_query(); ?>
		
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
		$instance['categories'] = $new_instance['categories'];
		$instance['num_posts'] = $new_instance['num_posts'];

		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_category'] = $new_instance['show_category'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['blank_thumb'] = $new_instance['blank_thumb'];
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
		$defaults = array('title' => __( 'Recent Posts' , 'color-theme-framework' ) , 'categories' => 'all', 'num_posts' => 4, 'show_image' => 'on', 'show_category' => 'on', 'show_related' => 'off', 'blank_thumb' => 'on', 'background' => '#E64946' );
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
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ( 'all' == $instance['categories'] ) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
				<?php foreach( $categories as $category ) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo $this->get_field_id('show_related'); ?>" name="<?php echo $this->get_field_name('show_related'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_related'); ?>"><?php _e( 'Show related category posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show thumbnail image' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['blank_thumb'], 'on'); ?> id="<?php echo $this->get_field_id('blank_thumb'); ?>" name="<?php echo $this->get_field_name('blank_thumb'); ?>" /> 
			<label for="<?php echo $this->get_field_id('blank_thumb'); ?>"><?php _e( 'Show blank thumbnail' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_category'], 'on'); ?> id="<?php echo $this->get_field_id('show_category'); ?>" name="<?php echo $this->get_field_name('show_category'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_category'); ?>"><?php _e( 'Show post category' , 'color-theme-framework' ); ?></label>
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