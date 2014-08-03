<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Carousel Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show carousel with latest posts.
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init','CrossRoad_carousel_load_widgets');

function CrossRoad_carousel_load_widgets(){
		register_widget("CrossRoad_carousel_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_carousel_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CrossRoad_carousel_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'crossroad_carousel_widget', 'description' => __( 'Carousel widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_carousel_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_carousel_widget', __( 'CrossRoad: Carousel Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$slideshow = isset($instance['slideshow']) ? 'true' : 'false';
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$show_random = isset($instance['show_random']) ? 'true' : 'false';
		$show_text = $instance['show_text'];
		?>

		<?php
		
		/* Before widget (defined by themes). */
		echo $before_widget . '<div class="row-fluid margin-25t"><div class="span12">';
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
		/* Display the widget title if one was input (before and after defined by themes). */ ?>
		
<?php
	global  $data, $post;
	$time_id = rand();
	$theme_color = stripslashes ( $data['crossroad_theme_color'] );	
	$orderby = 'date';
	
	if ( $show_random == 'true' ) : $orderby = 'rand'; endif;

	if ( $show_related == 'true' ) :
	  $related_category = get_the_category($post->ID);
	  $related_category_id = get_cat_ID( $related_category[0]->cat_name );			
	  $recent_posts = new WP_Query(array('orderby' => $orderby, 'showposts' => $posts, 'post_type' => 'post', 'cat' => $related_category_id, 'post__not_in' => array( $post->ID )));
	else :
	  $recent_posts = new WP_Query(array('orderby' => $orderby, 'showposts' => $posts, 'post_type' => 'post', 'cat' => $categories));
	endif; 
?>


<script type="text/javascript">
jQuery.noConflict()(function($){
	$(document).ready(function() {

  $('#carousel-<?php echo $time_id; ?>').flexslider({
    animation: "slide",
    animationLoop: true,
    itemWidth: 270,
    itemMargin: 30,
	minItems: 1,
	maxItems: 4,   
    slideshow: <?php echo $slideshow; ?>,
    controlNav: false
  });
   
});
}); 

</script>
		
	<div id="carousel-<?php echo $time_id; ?>" class="flexslider">
	  <ul class="slides">
		<?php
		  global $post;		
		  while($recent_posts->have_posts()): $recent_posts->the_post(); 
		?>

		<?php if( has_post_thumbnail() ): ?>

	    <li>
	      <div class="carousel-thumb">
			<?php $carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carousel-thumb'); 
			if ( $carousel_image_url[1] == 270 && $carousel_image_url[2] == 190 ) { ?>	      
			  <a href="<?php the_permalink(); ?>"><img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
			  
			<?php } else { 
			  $carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');?>
	          <a href="<?php the_permalink(); ?>"><img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
			<?php } ?>
			
<!--		    <div class="mask"></div>  
		    <a class="mask" href="<?php the_permalink(); ?>"></a> -->
  			  <?php 
			    if ( has_post_format ( 'video' ) ) {
			  ?>

			    <?php	
			      $video_type = get_post_meta( $post->ID, 'crossroad_mb_post_video_type', true );
				  $perma_link = get_permalink($post->ID);

				  if ( $video_type == 'youtube' ) {
				    echo '<div class="video youtube"><a href="' . $perma_link . '" title="'. __('Watch Youtube Video','color-theme-framework').'"></a></div>';
			      }
   				  else if ( $video_type == 'vimeo' ) {
				    echo '<div class="video vimeo"><a href="' . $perma_link . '" title="'. __('Watch Vimeo Video','color-theme-framework').'"></a></div>';
			      }	
				  elseif ( $video_type == 'dailymotion' ) {
				    echo '<div class="video dailymotion"><a href="' . $perma_link . '" title="'. __('Watch DailyMotion Video','color-theme-framework').'"></a></div>';
				  } 
			    ?>
			  <?php } ?>

			<?php 
			  $category = get_the_category(); 
			  $cat_color = ct_get_color($category[0]->term_id);
			  if ( $cat_color == '') { $cat_color = $theme_color; }
			?>

			<?php if ( $show_text == 'category' ) {
			   $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); ?>
			  <span class="category-item" style="background-color:<?php echo $cat_color; ?>"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo __('View all posts in ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></span>
			<?php } 
			else if ( $show_text == 'title' ) { ?>
			  <span class="category-item" style="background-color:<?php echo $cat_color; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>			
			<?php } ?>
			
			<div class="title-mask">
			  <?php the_title(); ?>
			</div><!-- title-mask -->
			
		  </div><!-- /carousel-thumb -->
		  
	    </li>
<?php endif; ?>
	<?php endwhile; ?>

	  </ul>
	</div> <!-- /flexslider -->

		<?php

		/* After widget (defined by themes). */
		echo '</div><!-- span12 --></div><!-- row-fluid -->' . $after_widget;
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['slideshow'] = $new_instance['slideshow'];
		$instance['show_text'] = $new_instance['show_text'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['show_random'] = $new_instance['show_random'];
		
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
			$defaults = array( 'title' => __( '', 'color-theme-framework' ), 'slideshow' => 'off', 'categories' => 'all', 'show_text' => 'category', 'posts' => '10', 'show_related' => 'off', 'show_random' => 'off' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_text' ); ?>"><?php _e('Type of text to show:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'show_text' ); ?>" name="<?php echo $this->get_field_name( 'show_text' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'category' == $instance['show_text'] ) echo 'selected="selected"'; ?>>category</option>
				<option <?php if ( 'title' == $instance['show_text'] ) echo 'selected="selected"'; ?>>title</option>
				<option <?php if ( 'none' == $instance['show_text'] ) echo 'selected="selected"'; ?>>none</option>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo $this->get_field_id('show_related'); ?>" name="<?php echo $this->get_field_name('show_related'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_related'); ?>"><?php _e( 'Show related category posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_random'], 'on'); ?> id="<?php echo $this->get_field_id('show_random'); ?>" name="<?php echo $this->get_field_name('show_random'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_random'); ?>"><?php _e( 'Show random posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['slideshow'], 'on'); ?> id="<?php echo $this->get_field_id('slideshow'); ?>" name="<?php echo $this->get_field_name('slideshow'); ?>" /> 
			<label for="<?php echo $this->get_field_id('slideshow'); ?>"><?php _e( 'Animate carousel automatically' , 'color-theme-framework' ); ?></label>
		</p>
				
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>

		<?php

	}
}
?>