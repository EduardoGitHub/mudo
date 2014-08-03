<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Slider Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show slider with latest posts.
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CrossRoad_slider_load_widgets');


function CrossRoad_slider_load_widgets(){
		register_widget("CrossRoad_slider_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_slider_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CrossRoad_slider_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'crossroad_slider_widget', 'description' => __( 'Slider widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_slider_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_slider_widget', __( 'CrossRoad: Slider Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$slideshow = isset($instance['slideshow']) ? 'true' : 'false';
		$carousel = isset($instance['carousel']) ? 'true' : 'false';		
		$show_text = $instance['show_text'];
//		$show_post_title = isset($instance['show_post_title']) ? 'true' : 'false';
//		$show_post_badge = isset($instance['show_post_badge']) ? 'true' : 'false';
		?>

		<?php
		
		/* Before widget (defined by themes). */
		echo $before_widget . '<div class="row-fluid"><div class="span12">';
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
		/* Display the widget title if one was input (before and after defined by themes). */ ?>
		
		<?php	
			$slider_posts = new WP_Query(array(
				//'orderby' => 'rand',
				'showposts' => $posts,
				'post_type' => 'post',
				'cat' => $categories,
			));
			
			/*$carousel_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => 'post',
				'cat' => $categories,
			));			*/
		?>
<?php
	global $data, $post;
	$time_id = rand();
	$theme_color = stripslashes ( $data['crossroad_theme_color'] );	
?>

<script type="text/javascript">
jQuery.noConflict()(function($){
	$(window).load(function() {
      $('#carousel-<?php echo $time_id; ?>').flexslider({
    	animation: "slide",
    	animationLoop: true,
    	itemWidth: 230,
    	itemMargin: 20,
    	slideshow: false,
    	controlNav: false,
    	asNavFor: '#slider-<?php echo $time_id; ?>'
  	  });
  	  
  	  $('#slider-<?php echo $time_id; ?>').flexslider({
    	animation: "slide",
    	controlNav: false,
    	itemWidth: 730,
    	animationLoop: true,
    	slideshow: <?php echo $slideshow; ?>,
		smoothHeight: true,    
    	sync: "#carousel-<?php echo $time_id; ?>"
  	  });
	});
});
</script>

		<?php
		  if ( $title ) : 
		    echo '<div style="border-top: 1px solid #EBECED; padding-top: 15px;"></div>';
		  endif;
		?>

<!-- #########  SLIDER  ######### -->
	<div id="slider-<?php echo $time_id; ?>" class="widget-slider flex-main flexslider">
 	  <ul class="slides">

		<?php while($slider_posts->have_posts()): $slider_posts->the_post(); ?>
		  <?php if( has_post_thumbnail() ): 
		    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-thumb'); ?>
	    	<li>
			  <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="" /></a>
			  <div class="title-mask"><h2 class="entry-title"><?php the_title(); ?></h2></div><!-- title-mask -->
	    	</li>
		  <?php endif; ?>
		<?php endwhile; ?>
	  </ul><!-- slides -->
	</div><!-- slider -->



  <?php if ( $carousel == 'true') : ?>
<!-- #########  CAROUSEL  ######### -->
		
	<div id="carousel-<?php echo $time_id; ?>" class="widget-carousel flexslider ">
	  <ul class="slides">
		<?php
		  while($slider_posts->have_posts()): $slider_posts->the_post(); 
		?>

		<?php if( has_post_thumbnail() ): ?>

	    <li>
	      <div class="carousel-thumb">
			<?php $carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carousel-thumb'); 
			if ( $carousel_image_url[1] == 270 && $carousel_image_url[2] == 190 ) { ?>	      
			  <img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php the_title(); ?>" />
			  
			<?php } else { 
			  $carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');?>
	          <img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php the_title(); ?>" />
			<?php } ?>
			
		    <div class="mask"><a href="<?php the_permalink(); ?>"></a></div>
  			  <?php 
			    if ( has_post_format ( 'video' ) ) {
			  ?>

			    <?php	
			      $video_type = get_post_meta( $post->ID, 'accord_mb_post_video_type', true );
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
<?php endif; ?> <!-- show carousel -->

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
		$instance['carousel'] = $new_instance['carousel'];
		$instance['show_text'] = $new_instance['show_text'];
//		$instance['show_post_title'] = $new_instance['show_post_title'];
//		$instance['show_post_badge'] = $new_instance['show_post_badge'];
		
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
			$defaults = array( 'title' => __( '', 'color-theme-framework' ), 'slideshow' => 'off', 'carousel' => 'on', 'categories' => 'all', 'show_text' => 'category', 'posts' => '10' );
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
			<input class="checkbox" type="checkbox" <?php checked($instance['carousel'], 'on'); ?> id="<?php echo $this->get_field_id('carousel'); ?>" name="<?php echo $this->get_field_name('carousel'); ?>" /> 
			<label for="<?php echo $this->get_field_id('carousel'); ?>"><?php _e( 'Show carousel' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_text' ); ?>"><?php _e('Type of text to show (for carousel):', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'show_text' ); ?>" name="<?php echo $this->get_field_name( 'show_text' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'category' == $instance['show_text'] ) echo 'selected="selected"'; ?>>category</option>
				<option <?php if ( 'title' == $instance['show_text'] ) echo 'selected="selected"'; ?>>title</option>
				<option <?php if ( 'none' == $instance['show_text'] ) echo 'selected="selected"'; ?>>none</option>
			</select>
		</p>

<!--		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_post_title'], 'on'); ?> id="<?php echo $this->get_field_id('show_post_title'); ?>" name="<?php echo $this->get_field_name('show_post_title'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_post_title'); ?>"><?php _e( 'Show post title' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_post_badge'], 'on'); ?> id="<?php echo $this->get_field_id('show_post_badge'); ?>" name="<?php echo $this->get_field_name('show_post_badge'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_post_badge'); ?>"><?php _e( 'Show post badge' , 'color-theme-framework' ); ?></label>
		</p> -->

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['slideshow'], 'on'); ?> id="<?php echo $this->get_field_id('slideshow'); ?>" name="<?php echo $this->get_field_name('slideshow'); ?>" /> 
			<label for="<?php echo $this->get_field_id('slideshow'); ?>"><?php _e( 'Animate slider automatically' , 'color-theme-framework' ); ?></label>
		</p>
				
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>

		<?php

	}
}
?>