<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrossRoad Blog Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show posts as Blog Style 1.
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CrossRoad_blog_load_widgets');


function CrossRoad_blog_load_widgets(){
		register_widget("CrossRoad_blog_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrossRoad_blog_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CrossRoad_blog_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'crossroad_blog_widget', 'description' => __( 'Blog Widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crossroad_blog_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crossroad_blog_widget', __( 'CrossRoad: Blog Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);	
		
		$num_posts = $instance['num_posts'];
		$title = $instance['title'];
		$show_content = $instance['show_content'];
		$show_date = isset($instance['show_date']) ? 'true' : 'false';
		$show_author = isset($instance['show_author']) ? 'true' : 'false';
		$show_share = isset($instance['show_share']) ? 'true' : 'false';
		$thumb_type = $instance['thumb_type'];
		$pagination_type = $instance['pagination_type'];
		
		/* Before widget (defined by themes). */
		echo $before_widget . '<div class="row-fluid"><div class="span12 button-blog">';
				
	?>

<?php

	global $data, $post, $wp_query;
	
	$max = 0;
	$count_posts = wp_count_posts();
	$ct_post_count = $count_posts->publish;
	$max = ceil ($ct_post_count / $num_posts);

	
	if ( get_query_var('paged') ) {
      $paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
	  $paged = get_query_var('page');
	} else {
	  $paged = 1;
	}

function wp_corenavi_widget($ct_max) {
  global $wp_rewrite;
  $max = $ct_max;
  $pages = '';
//  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = ($wp_rewrite->using_permalinks()) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ) : @add_query_arg('paged','%#%');
  if( !empty($wp_query->query_vars['s']) ) $a['add_args'] = array( 's' => get_query_var( 's' ) );
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; 
  $a['mid_size'] = '3'; 
  $a['end_size'] = '1'; 
  $a['prev_text'] = 'Previous'; 
  $a['next_text'] = 'Next'; 
//  $a['total'] = $wp_query->max_num_pages;
  $a['total'] = $max;

  if ($max > 1) echo '<div class="pagination clearfix">';
  echo  paginate_links($a);
  if ($max > 1) echo '</div>';
}

	
	
	// Check if Load More Button
	if ( $pagination_type == 'load_more' ) :
 		wp_enqueue_script(
 			'pbd-alp-load-posts',
 			get_template_directory_uri() . '/js/load-posts.js',
 			array('jquery'),
 			'1.0',
 			true
 		);

 		// Add some parameters for the JS.
 		wp_localize_script(
 			'pbd-alp-load-posts',
 			'pbd_alp',
 			array(
 				'startPage' => $paged,
 				'maxPages' => $max,
 				'nextLink' => next_posts($max, false)
 			)
 		);
	endif;

 ?>


		  <?php if ( $title ){ echo $before_title . $title . $after_title; }
		  
			echo '<div id="entry-blog">';

			$theme_color = stripslashes ( $data['crossroad_theme_color'] );
		    $recent_posts = new WP_Query(array(
				'posts_per_page' => $num_posts,
				'paged' => $paged,
				'post_type' => 'post',
			));

			if ( $recent_posts->have_posts() ) : while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('entry-post'); ?>>	
				  <div class="title-block">
					<?php 
			  		  $category = get_the_category(); 
			   		  $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id );
			  		  $cat_color = ct_get_color($category[0]->term_id);
			  		  if ( $cat_color == '') { $cat_color = $theme_color; }
					?>

			  		<span class="category-item" style="background-color:<?php echo $cat_color; ?>"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo __('View all posts in ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></span>
					<?php if ( $show_date == 'true' ) : ?><span class="meta-time"><?php the_time('F j, Y'); ?></span><?php endif; ?>
					<?php if ( $show_author == 'true' ) : ?><span class="meta-author"><?php _e('posted by ','color-theme-framework'); echo the_author_posts_link(); ?></span><?php endif; ?>
					<?php if ( $show_share == 'true' ) : ?>
					  <div class="meta-share">
					    <div class="entry-share">
  					      <span class="share-twitter"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>"></a></span>
					      <span class="share-fb"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"></a></span>
					      <span class="share-google"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"></a></span>
					    </div><!-- entry-share -->
					    <a href="#"><?php _e('Share','color-theme-framework'); ?></a>
					  </div><!-- meta-share -->
					<?php endif; ?>
				  </div> <!-- /title-block -->

				  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>

				  <div class="entry-content">
				    <?php 
				    $excerpt = get_the_excerpt();
				    if ( $show_content == 'content' ) {	
					  the_content('<a style="margin-left: 5px;text-transform: uppercase;display: inline-block;" href="'. get_permalink($post->ID) . '"> '. __( 'Leia mais' , 'color-theme-framework' ) .'</a>',true,'');
				    }	
				    else if ( $show_content == 'excerpt' && $excerpt != '' ){
					  the_excerpt('',FALSE,'');
					  echo '<a style="margin-left: 5px;display: inline-block;" href="' . get_permalink($post->ID) . '">' . __('Leia Mais', 'color-theme-framework') . '</a>';
				    } ?>
				  </div><!-- entry-content -->


	 			  <?php if ( has_post_format ( 'image' ) or ( !has_post_format ( 'audio' ) and !has_post_format ( 'video' ) and !has_post_format ( 'gallery' ) ) ) { ?>
				  <!-- start post thumb -->
				  <div class="entry-thumb">
 					  <?php
						if ( has_post_thumbnail() ) { 
		                 $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumb'); ?>  
                    	 <a href="<?php echo the_permalink(); ?>"><img src="<?php echo $small_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
					    <?php } ?>
				  </div> <!-- /entry-thumb -->
			  	  <?php } ?>

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Video  
-----------------------------------------------------------------------------------------------------------------							
*/
?>
					<?php 
				
				    if ( has_post_format ( 'video' ) ) : 
									$video_type = get_post_meta( $post->ID, 'crossroad_mb_post_video_type', true );
									//$thumb_type = get_post_meta( $post->ID, 'crossroad_mb_post_video_thumb', true );
									$videoid = get_post_meta( $post->ID, 'crossroad_mb_post_video_file', true );
									$perma_link = get_permalink($post->ID);
								if( $videoid != '' ) : ?>
									<div class="single-media-thumb">

									<?php
		            					if ( $video_type == 'youtube' ) {
		            						if ( $thumb_type == 'auto' ) {
		            							echo '<img src="http://img.youtube.com/vi/' . $videoid . '/0.jpg" alt="'. the_title('','',false) . '" />';
											} 
											else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
												$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb');
												echo '<img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" />';
											}
											else if ( $thumb_type == 'player' ) {
												echo '<iframe height="295" src="http://www.youtube.com/embed/' . $videoid . '?autohide=1&amp;showinfo=0&amp;wmode=transparent"></iframe>';
											}
											else { echo '<img src="http://img.youtube.com/vi/' . $videoid . '/0.jpg" alt="'. the_title('','',false) . '" />'; }
											if ( $thumb_type != 'player' ) {
				  								echo '<div class="mask"><a href="' . $perma_link . '"></a></div>';
				  								echo '<div class="video youtube"><a href="' . $perma_link . '" title="'. __('Watch Youtube Video','color-theme-framework').'"></a></div>';
				  							}
			            				}
			            				 
			            				else if ( $video_type == 'vimeo' ) {
		            						if ( $thumb_type == 'auto' ) {
			            						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php"));
			            						echo '<img src="' . $hash[0]['thumbnail_large'] . '" alt="'. the_title('','',false) . '" />';
											} 
											else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
												$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb');
												echo '<img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" />';
											}
											else if ( $thumb_type == 'player' ) {
												echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '" height="295"></iframe>';
											}
											else {
			            						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php"));
			            						echo '<img src="' . $hash[0]['thumbnail_large'] . '" alt="'. the_title('','',false) . '" />';
											}
											if ( $thumb_type != 'player' ) {
				  								echo '<div class="mask"><a href="' . $perma_link . '"></a></div>';
					  							echo '<div class="video vimeo"><a href="' . $perma_link . '" title="'. __('Watch Vimeo Video','color-theme-framework').'"></a></div>';
				  							}
			            				}	
			            				
										elseif ( $video_type == 'dailymotion' ) {
		            						if ( $thumb_type == 'auto' ) {
			            						echo '<img src="' . getDailyMotionThumb($videoid) . '" alt="'. the_title('','',false) . '" />';
											} 
											else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
												$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb');
												echo '<img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" />';
											}
											else if ( $thumb_type == 'player' ) {
												echo '<iframe frameborder="0" height="270" src="http://www.dailymotion.com/embed/video/' . $videoid . '"></iframe>';
											}
											else {
			            						echo '<img src="' . getDailyMotionThumb($videoid) . '" alt="'. the_title('','',false) . '" />';
											}										
											if ( $thumb_type != 'player' ) {
				  								echo '<div class="mask"><a href="' . $perma_link . '"></a></div>';
					  							echo '<div class="video dailymotion"><a href="' . $perma_link . '" title="'. __('Watch DailyMotion Video','color-theme-framework').'"></a></div>';
				  							}
										 } 
										 ?>
		            				
								</div> <!-- /single-media-thumb-->		
						<?php endif; else : ?>

 					
 					<?php endif;  ?>

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Gallery
-----------------------------------------------------------------------------------------------------------------							
*/
?>

	                  <?php 
					    $image1 = get_post_meta( $post->ID, 'crossroad_mb_image1_upload', true );	                   		
					  	$image2 = get_post_meta( $post->ID, 'crossroad_mb_image2_upload', true ); 					  		
					  	$image3 = get_post_meta( $post->ID, 'crossroad_mb_image3_upload', true ); 					  		
					  	$image4 = get_post_meta( $post->ID, 'crossroad_mb_image4_upload', true ); 	
					  	$image5 = get_post_meta( $post->ID, 'crossroad_mb_image5_upload', true ); 						  							  		
					  		
						if ( has_post_format( 'gallery' ) && ( ( $image1 != '') or ( $image2 != '') or ( $image3 != '' ) or ( $image4 != '') or ( $image5 != '' ) ) ) {	                   	
					  ?>
				  <div class="entry-thumb">
	<script type="text/javascript">
	/* <![CDATA[ */
	jQuery.noConflict()(function($){
		$(window).load(function () {
			$('#slider-<?php echo $post->ID; ?>').flexslider({
				directionNav: true,
				controlNav: false,
				smoothHeight: true,
				slideshow: false
		});
	});
	});
	/* ]]> */
	</script>	

							<!-- Start FlexSlider -->				
							<div id="slider-<?php echo $post->ID; ?>" class="flexslider flex-blog">
								  <ul class="slides">
								  	<?php 
								  		if ( $image1 != ''  ) {	
								  	?>
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image1_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image1_upload', true ) ?>" alt=""></a>
								    </li>
								    <?php } ?>

								  	<?php 

								  		if ( $image2 != ''  ) {	
								  	?>							    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image2_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image2_upload', true ) ?>" alt=""></a>
								    </li>
								    <?php } ?>
								    

								  	<?php 
								  		if ( $image3 != ''  ) {	
								  	?>							    						    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image3_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image3_upload', true ) ?>" alt=""></a>																							
								    </li>
								    <?php } ?>

								  	<?php 
								  		if ( $image4 != ''  ) {	
								  	?>							    						    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image4_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image4_upload', true ) ?>" alt=""></a>																							
								    </li>
								    <?php } ?>

								  	<?php 
								  		if ( $image5 != ''  ) {	
								  	?>							    						    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image5_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image5_upload', true ) ?>" alt=""></a>																							
								    </li>
								    <?php } ?>
								    								    
								  </ul>
							</div> <!-- /flexSlider -->		
				  </div><!-- entry-thumb -->
						<?php } else ?>
									<?php
										if ( ( ( $image1 == '') && ( $image2 == '') && ( $image3 == '' ) && ( $image4 == '') && ( $image5 == '' ) ) && has_post_thumbnail() && has_post_format( 'gallery' ) ) { 
		                        			$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumb'); 
											$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 	                        	
				                        ?>  
									<div class="entry-thumb">
				                    	<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $small_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>				
									</div><!-- entry-thumb foo -->
								<?php } ?>


<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Audio  
-----------------------------------------------------------------------------------------------------------------							
*/
?>
						
						<?php 
							if ( has_post_format ( 'audio' ) ) {
						?>
						
						<?php	
 						  $soundcloud = get_post_meta( $post->ID, 'crossroad_mb_post_soundcloud', true );

	            		  if ( $soundcloud != '' ) { ?>
        					<div class="entry-thumb">	
	            			  <div class="single-audio-post">
		            			<?php	echo $soundcloud; ?>
							  </div> <!-- /single-audio-post-->
							</div> <!-- /entry-thumb-->
						  <?php } ?>
						<?php } ?>

				</article> <!-- /post ID -->

			<?php endwhile; endif;  

		/* After widget (defined by themes). */
		echo '</div><!-- entry-blog -->'; ?>
		

	    <!-- Begin Navigation -->
		<?php if ( $max > 1 ) : ?>
		  <div class="blog-navigation clearfix">
			<?php if(function_exists('wp_corenavi_widget')) { wp_corenavi_widget($max); } ?>
		  </div> <!-- blog-navigation -->
		<?php endif; ?>
		<!-- End Navigation -->

		<?php echo '</div><!-- span12 --></div><!-- row-fluid -->'.$after_widget; ?>
		
<?php } 

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['title'] = $new_instance['title'];
		$instance['show_content'] = $new_instance['show_content'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_author'] = $new_instance['show_author'];
		$instance['show_share'] = $new_instance['show_share'];
		$instance['thumb_type'] = $new_instance['thumb_type'];
		$instance['pagination_type'] = $new_instance['pagination_type'];


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
			$defaults = array( 'title' => __( 'Latest Posts', 'color-theme-framework' ), 'num_posts' => '3', 'show_content' => 'excerpt', 'show_date' =>'on', 'show_author' => 'off', 'show_share' => 'on', 'thumb_type' => 'auto', 'pagination_type' => 'load_more' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_author'], 'on'); ?> id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e( 'Show author' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_share'], 'on'); ?> id="<?php echo $this->get_field_id('show_share'); ?>" name="<?php echo $this->get_field_name('show_share'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_share'); ?>"><?php _e( 'Show share' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'pagination_type' ); ?>"><?php _e('Type of Pagination:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'pagination_type' ); ?>" name="<?php echo $this->get_field_name( 'pagination_type' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'load_more' == $instance['pagination_type'] ) echo 'selected="selected"'; ?>>load_more</option>
				<option <?php if ( 'standard_numeric' == $instance['pagination_type'] ) echo 'selected="selected"'; ?>>standard_numeric</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'thumb_type' ); ?>"><?php _e('Type of Video Thumb:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'thumb_type' ); ?>" name="<?php echo $this->get_field_name( 'thumb_type' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'auto' == $instance['thumb_type'] ) echo 'selected="selected"'; ?>>auto</option>
				<option <?php if ( 'featured' == $instance['thumb_type'] ) echo 'selected="selected"'; ?>>featured</option>
				<option <?php if ( 'player' == $instance['thumb_type'] ) echo 'selected="selected"'; ?>>player</option>
			</select>
		</p> 

		<p>
			<label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e('Select a Excerpt (automatically) or Content (More tag):', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'excerpt' == $instance['show_content'] ) echo 'selected="selected"'; ?>>excerpt</option>
				<option <?php if ( 'content' == $instance['show_content'] ) echo 'selected="selected"'; ?>>content</option>
			</select>
		</p>		
		<?php

	}
}
?>