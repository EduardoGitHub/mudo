<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad 2 Columns Magazine Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show recent posts by categories
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/

/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init', 'crossroad_2columns_load_widgets');

function crossroad_2columns_load_widgets()
{
	register_widget('CrossRoad_2Columns_Widget');
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_2Columns_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CrossRoad_2Columns_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'crossroad_2columns_widget', 'description' => __( '2 Columns Vertical Magazine Widget (show recent posts).' , 'color-theme-framework' ) );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_2columns_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_2columns_widget', __( 'CrossRoad: 2 Columns Magazine Widget' , 'color-theme-framework' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';

		$title2 = $instance['title2'];
		$categories2 = $instance['categories2'];
		$posts2 = $instance['posts2'];
		$show_image2 = isset($instance['show_image2']) ? 'true' : 'false';
		$background = $instance['background'];
	
		echo $before_widget;
		echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';
		?>

		<!-- FIRST COLUMN -->	
		<?php
		  $recent_posts = new WP_Query(array(
		    'showposts' => 1,
			'post_type' => 'post',
			'cat' => $categories,
		  ));
		?>

		<div class="row-fluid two-column-widget">
	  	  <div class="span6">
	  	  <div style="padding-right:8px">
		    <?php
			  if ($title) {
				if ( $categories != 'all' ):
				$category_title_link = get_category_link( $categories );
				echo '<div class="widget-title category-title"><h2><a href="'.$category_title_link.'" title="'.__('View all posts in ','color-theme-framework').$title.'">'.$title.'</a></h2></div><!-- widget-title -->';
				else : echo $before_title.$title.$after_title;
				endif;
			  }
			?>

			<div class="bt-pt15-1px"></div>
			<?php while($recent_posts->have_posts()): $recent_posts->the_post();  ?>
			  <?php if(has_post_thumbnail()): ?>
			    <div class="widget-post-big-thumb">
				  <!-- <?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image')) $post_format = 'class="format-standard-icon"'; ?> -->
				  <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumb'); ?>	
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
			    </div><!-- widget-post-big-thumb -->
			  <?php endif; ?>
			  
			  <div class="meta">
				<span class="meta-comments">
  				  <?php comments_popup_link(__('No Comments','color-theme-framework'),__('1 Comment','color-theme-framework'),__('% Comments','color-theme-framework'));echo '&nbsp;&nbsp;'; ?>
				</span><!-- meta-comments -->
			    <span class="meta-time"><?php the_time('M j, Y'); ?></span><!-- meta-time -->
			  </div><!-- meta -->
			  <h2 class="entry-title"><a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><?php the_title(); ?></a></h2>
			  <div class="entry-content"><?php echo get_the_excerpt(); ?></div><!-- entry-content -->
			<?php endwhile; ?>

			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => 'post',
				'cat' => $categories,
			));
			
			$counter = 0; ?>

			<ul class="widget-two-column-horizontal">
			  <?php while($recent_posts->have_posts()): $recent_posts->the_post(); 
			    if($counter >= 1 ) { ?>
				  <li class="clearfix">
					<!-- <?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image')) $post_format = 'class="format-standard-icon"'; ?> -->
					<?php if( $show_image == 'true' ): ?>
					  <?php if(has_post_thumbnail()): ?>
			    		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumb'); 
			    		if ( $image[1] == 50 && $image[2] == 50 ) : //if has generated thumb ?>
				 		  <div class="widget-post-small-thumb">
						    <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><img style="margin-bottom: 20px;" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
				  		  </div><!-- widget-post-small-thumb -->
						<?php else : // else use standard 150x150 thumb
		  		  		  $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
				 	 	  <div class="widget-post-small-thumb">
						    <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><img style="margin-bottom: 20px;" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
				  		  </div><!-- widget-post-small-thumb -->
				  		<?php endif; ?>
					  <?php endif; ?><!-- has_post_thumbnail -->
					<?php endif; ?><!-- show_image -->

					<div class="post-title">
					  <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><?php the_title(); ?></a>
					</div><!-- post-title -->

					<div class="meta" style="margin-bottom:15px;">
					  <span class="meta-comments">
 					  	<?php comments_popup_link(__('No Comments','color-theme-framework'),__('1 Comment','color-theme-framework'),__('% Comments','color-theme-framework'));echo '&nbsp;&nbsp;'; ?>
					  </span><!-- meta-comments -->
			    	  <span class="meta-time"><?php the_time('M j, Y'); ?></span><!-- meta-time -->
			  		</div><!-- meta -->
				  </li>
				<?php }
			  
			  $counter++;
			  endwhile; ?>
			</ul>
		  </div><!-- padding -->
		  </div><!-- span6 -->


		<!-- SECOND COLUMN -->
		<?php
			$recent_posts = new WP_Query(array(
				'showposts' => 1,
				'post_type' => 'post',
				'cat' => $categories2,
			));
			?>

	  	  <div class="span6 second-column">
	  	  <div style="padding-left:8px">
		    <?php
			  if ($title2) {
				if ( $categories2 != 'all' ):
				$category_title_link2 = get_category_link( $categories2 );
				echo '<div class="widget-title category-title" style=""><h2><a href="'.$category_title_link2.'" title="'.__('View all posts in ','color-theme-framework').$title2.'">'.$title2.'</a></h2></div><!-- widget-title -->';
				else : echo '<div>'.$before_title.$title2.$after_title.'</div>';
				endif;
			  }
			?>

			<div class="bt-pt15-1px"></div>
	  	  
			<?php while($recent_posts->have_posts()): $recent_posts->the_post();  ?>
			  <?php if(has_post_thumbnail()): ?>
			    <div class="widget-post-big-thumb">
				  <!-- <?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image')) $post_format = 'class="format-standard-icon"'; ?> -->
				  <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumb'); ?>	
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
			    </div><!-- widget-post-big-thumb -->
			  <?php endif; ?>
			  
			  <div class="meta">
				<span class="meta-comments">
  				  <?php comments_popup_link(__('No Comments','color-theme-framework'),__('1 Comment','color-theme-framework'),__('% Comments','color-theme-framework'));echo '&nbsp;&nbsp;'; ?>
				</span><!-- meta-comments -->
			    <span class="meta-time"><?php the_time('M j, Y'); ?></span><!-- meta-time -->
			  </div><!-- meta -->
			  <h2 class="entry-title"><a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><?php the_title(); ?></a></h2>
			  <div class="entry-content"><?php echo get_the_excerpt(); ?></div><!-- entry-content -->
			<?php endwhile; ?>

			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts2,
				'post_type' => 'post',
				'cat' => $categories2,
			));
			
			$counter = 0;
			?>

			<ul class="widget-two-column-horizontal">
			  <?php while($recent_posts->have_posts()): $recent_posts->the_post(); 
			    if($counter >= 1 ) { ?>
				  <li class="clearfix">
					<!-- <?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image')) $post_format = 'class="format-standard-icon"'; ?> -->
					<?php if( $show_image2 == 'true' ): ?>
					  <?php if(has_post_thumbnail()): ?>
			    		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumb'); 
			    		if ( $image[1] == 50 && $image[2] == 50 ) : //if has generated thumb ?>
				 		  <div class="widget-post-small-thumb">
						    <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><img style="margin-bottom: 20px;" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
				  		  </div><!-- widget-post-small-thumb -->
						<?php else : // else use standard 150x150 thumb
		  		  		  $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
				 	 	  <div class="widget-post-small-thumb">
						    <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><img style="margin-bottom: 20px;" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
				  		  </div><!-- widget-post-small-thumb -->
				  		<?php endif; ?>
					  <?php endif; ?><!-- has_post_thumbnail -->
					<?php endif; ?><!-- show_image -->

					<div class="post-title">
					  <a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><?php the_title(); ?></a>
					</div><!-- post-title -->

					<div class="meta" style="margin-bottom:15px;">
					  <span class="meta-comments">
 					  	<?php comments_popup_link(__('No Comments','color-theme-framework'),__('1 Comment','color-theme-framework'),__('% Comments','color-theme-framework'));echo '&nbsp;&nbsp;'; ?>
					  </span><!-- meta-comments -->
			    	  <span class="meta-time"><?php the_time('M j, Y'); ?></span><!-- meta-time -->
			  		</div><!-- meta -->
				  </li>
				<?php }
			  
			  $counter++;
			  endwhile; ?>
			</ul>
		  </div><!-- padding -->		
		  </div><!-- span6 -->
		</div><!-- row-fluid -->


		<?php
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */			
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_image'] = $new_instance['show_image'];

		$instance['title2'] = $new_instance['title2'];
		$instance['categories2'] = $new_instance['categories2'];
		$instance['posts2'] = $new_instance['posts2'];
		$instance['show_image2'] = $new_instance['show_image2'];
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
		$defaults = array( 'title' => __( 'First Column' , 'color-theme-framework' ) , 'categories' => 'all', 'posts' => 4, 'show_image'=> 'on');
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
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title (1st column):' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category (1st column):' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of posts (1st column):' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show thumbnail image' , 'color-theme-framework' ); ?></label>
		</p>

<?php
		$defaults2 = array( 'title2' => __( 'Second Column' , 'color-theme-framework' ) , 'categories2' => 'all', 'posts2' => 4, 'show_image2'=> 'on');
		$instance = wp_parse_args((array) $instance, $defaults2); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e( 'Title (2nd column):' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" value="<?php echo $instance['title2']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories2'); ?>"><?php _e( 'Filter by Category (2nd column):' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories2'); ?>" name="<?php echo $this->get_field_name('categories2'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories2']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories2']) echo 'selected="selected2"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts2'); ?>"><?php _e( 'Number of posts (2nd column):' , 'color-theme-framework' ); ?> </label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts2'); ?>" name="<?php echo $this->get_field_name('posts2'); ?>" value="<?php echo $instance['posts2']; ?>" />

		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image2'], 'on'); ?> id="<?php echo $this->get_field_id('show_image2'); ?>" name="<?php echo $this->get_field_name('show_image2'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image2'); ?>"><?php _e( 'Show thumbnail image' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
          <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Border Color:', 'color-theme-framework'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php if($background) { echo $background; } else { echo '#E64946'; } ?>" />
			<div class="cw-color-picker" rel="<?php echo $this->get_field_id('background'); ?>"></div>
        </p>

	<?php }
}
?>