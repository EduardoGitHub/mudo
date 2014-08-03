<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Popular Posts Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show popular posts( Specified by cat-id ).
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/



/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'CrossRoad_popular_post_widget' );

function CrossRoad_popular_post_widget() {
	register_widget( 'CrossRoad_Popular_Post' );
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_Popular_Post extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  CrossRoad_Popular_Post() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'crossroad-popularpost-widget', 'description' => __( 'A widget that show popular posts' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad-popularpost-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'crossroad-popularpost-widget', __('CrossRoad: Popular Posts', 'color-theme-framework'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		global $wpdb;

		/* Our variables from the widget settings. */
		$title = apply_filters('Popular Posts', $instance['title'] );
		$num_posts = $instance['num_posts'];

		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$show_comments = isset($instance['show_comments']) ? 'true' : 'false';
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$blank_thumb = isset($instance['blank_thumb']) ? 'true' : 'false';
		$theme_orderby = $instance['theme_orderby'];
		$background = $instance['background'];
			
		/* Before widget (defined by themes). */
		echo $before_widget;
		echo '<div class="colored-border" style="border-top-color:' . $background . ';"></div>';
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}


		/* Display the widget title if one was input (before and after defined by themes). */
			?>
			
		<?php 
			global $post, $data;
			$theme_color = stripslashes ( $data['crossroad_theme_color'] );
			if ( $show_related == 'true' ) { //show related category
			  $related_category = get_the_category($post->ID);
			  $related_category_id = get_cat_ID( $related_category[0]->cat_name );			
//			  $popular_posts = new WP_Query(array('showposts' => $num_posts, 'post_type' => 'post', 'cat' => $related_category_id, 'post__not_in' => array( $post->ID )));
			  
				if ($theme_orderby == 'comments') {
					$popular_posts = new WP_Query(array(
						'showposts' => $num_posts,
						'orderby' => 'comment_count',
						'cat' => $related_category_id, 
						'post__not_in' => array( $post->ID )
					));
				} 
				else if ($theme_orderby == 'likes') {
					$popular_posts = new WP_Query(array(
						'showposts' => $num_posts,
						'orderby' => 'meta_value_num',
						'meta_key' => 'votes_count',
						'cat' => $related_category_id, 
						'post__not_in' => array( $post->ID )
					));		
				}
				else if ($theme_orderby == 'views') {
					$popular_posts = new WP_Query(array(
						'showposts' => $num_posts,
						'orderby' => 'meta_value_num',
						'meta_key' => 'post_views_count',
						'cat' => $related_category_id, 
						'post__not_in' => array( $post->ID )
					));		
				}}
			else {
				if ($theme_orderby == 'comments') {
					$popular_posts = new WP_Query(array(
						'showposts' => $num_posts,
						'orderby' => 'comment_count'
					));
				} 
				else if ($theme_orderby == 'likes') {
					$popular_posts = new WP_Query(array(
						'showposts' => $num_posts,
						'orderby' => 'meta_value_num',
						'meta_key' => 'votes_count'
					));		
				}
				else if ($theme_orderby == 'views') {
					$popular_posts = new WP_Query(array(
						'showposts' => $num_posts,
						'orderby' => 'meta_value_num',
						'meta_key' => 'post_views_count'
					));		
				}}
		?>





			<ul class="popular-post-widget">
			  <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
			  <li class="clearfix">

				<?php if( $show_image == 'true' ): ?>
				  <?php if(has_post_thumbnail()):
				    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumb'); 
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
				  <?php endif; ?>

			      <?php else :
			      if ($theme_orderby == 'comments') : ?>
				    <div class="comments comm">
				      <?php comments_popup_link( __( '0' , 'color-theme-framework' ) , __( '1' , 'color-theme-framework' ) , __( '%' , 'color-theme-framework' ) , '', __( 'off' , 'color-theme-framework' ) ); ?>
				    </div><!-- comments -->
				  <?php elseif ($theme_orderby == 'views') : ?>
				    <div class="comments views" title="<?php _e('Views','color-theme-framework') ?>">
				      <?php echo get_post_meta( get_the_ID(), "post_views_count", true); ?>
				    </div><!-- comments -->
				  <?php elseif ($theme_orderby == 'likes') : ?>
				    <div class="comments likes" title="<?php _e('Likes','color-theme-framework') ?>">
				      <?php echo get_post_meta( get_the_ID(), "votes_count", true); ?>
				    </div><!-- comments -->
				  <?php endif; ?>
				<?php endif; ?>
				
				<!-- Post Title -->
				<?php if ( $blank_thumb == 'false' && !has_post_thumbnail() ) : ?>
				  <div class="post-title" style="margin-left:0;"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></div><!-- post-title -->
				<?php else : ?>
				  <div class="post-title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></div><!-- post-title -->
				<?php endif; ?>

				<!-- Meta -->
				<?php if ( $blank_thumb == 'false' && !has_post_thumbnail() ) : ?>
				  <div class="meta" style="margin-left:0;">
				<?php else : ?>
				  <div class="meta">
				<?php endif; ?>				
				  <div class="meta-comments"><?php
				    if( $show_image == 'true' ) :
				      if ($theme_orderby == 'comments') : 
				        comments_popup_link( __( 'No comments' , 'color-theme-framework' ) , __( '1 comment' , 'color-theme-framework' ) , __( '% comments' , 'color-theme-framework' ) , '', __( 'Comments are off' , 'color-theme-framework' ) ); echo '&nbsp;&nbsp;';
				      elseif ($theme_orderby == 'views') :
				        echo getPostViews(get_the_ID()).'&nbsp;&nbsp;';
				      else :
				        echo get_post_meta( get_the_ID(), "votes_count", true).' likes'.'&nbsp;&nbsp;';
				      endif;
				    endif; ?>
				  </div><!-- meta-comments -->
				  <div class="meta-time"><?php the_time('M j, Y'); ?></div><!-- meta-time -->
				</div><!-- meta -->
			  </li>	
		     <?php endwhile; ?>
		   </ul>

<?php wp_reset_query(); ?>

<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = $new_instance['num_posts'];

		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_comments'] = $new_instance['show_comments'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['blank_thumb'] = $new_instance['blank_thumb'];
		$instance['theme_orderby'] = $new_instance['theme_orderby'];
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
		$defaults = array('title' => __( 'Most Popular' , 'color-theme-framework' ) , 'num_posts' => 4, 'show_image' => 'off', 'show_comments' => 'on', 'blank_thumb' => 'on', 'background' => '#E64946');
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
			<label for="<?php echo $this->get_field_id( 'theme_orderby' ); ?>"><?php _e('Order by:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme_orderby' ); ?>" name="<?php echo $this->get_field_name( 'theme_orderby' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'comments' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>comments</option>
				<option <?php if ( 'likes' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>likes</option>
				<option <?php if ( 'views' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>views</option>
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