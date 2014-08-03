<?php
/**
 * The template for displaying content in the search.php template
 *
 */
?>

<?php
  global $data, $post, $page, $paged, $wp_query;
  $theme_color = stripslashes ( $data['crossroad_theme_color'] );
  $ct_pagination_type = stripslashes ( $data['crossroad_pagination_type'] );
?>

<?php

	if ( $ct_pagination_type == 'Show more button' ) :
 		// Queue JS and CSS
 		wp_enqueue_script(
 			'pbd-alp-load-posts',
 			get_template_directory_uri() . '/js/load-posts.js',
 			array('jquery'),
 			'1.0',
 			true
 		);
 		
 		// What page are we on? And what is the pages limit?
 		$max = $wp_query->max_num_pages;
 		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
 		
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

			$theme_color = stripslashes ( $data['crossroad_theme_color'] );
			$use_excerpt = stripslashes( $data['crossroad_excerpt_function'] );
			
 ?>


			<div class="ct-page box margin-25t bt-5px b-shadow clearfix">
		  	  <div class="row-fluid">
		        <div class="span12 button-blog">
	    	  	  <div class="category-title">
			          <h1 class="entry-title" style="margin-bottom:0;"><?php _e('Search Results for', 'color-theme-framework') ?> &#8220;<?php the_search_query(); ?>&#8221;</h1>
		    	  </div> <!-- category-title -->

				  <div id="entry-blog">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					  <article id="post-<?php the_ID(); ?>" <?php post_class('entry-post'); ?>>	
				  		<div class="title-block">
					<?php 
					if ($post->post_type == 'post') {
			  		  $category = get_the_category(); 
			   		  $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id );
			  		  $cat_color = ct_get_color($category[0]->term_id);
			  		  if ( $cat_color == '') { $cat_color = $theme_color; }
					?>
					
			  		<span class="category-item" style="background-color:<?php echo $cat_color; ?>"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo __('View all posts in ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></span>
			  		<?php } ?>
					<?php if ($data['crossroad_blog_show_meta']['date'] == true ) : ?><span class="meta-time"><?php the_time('F j, Y'); ?></span><?php endif; ?>
					<?php if ($data['crossroad_blog_show_meta']['author'] == true ) : ?><span class="meta-author"><?php _e('posted by ','color-theme-framework'); echo the_author_posts_link(); ?></span><?php endif; ?>
					<?php if ($data['crossroad_blog_show_meta']['share'] == true ) : 
					?>
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
				    if ( $use_excerpt == 'Content' ) {	
					  the_content('<a style="margin-left: 5px;text-transform: uppercase;display: inline-block;" href="'. get_permalink($post->ID) . '"> '. __( 'Read More' , 'color-theme-framework' ) .'</a>',true,'');
				    }	
				    else if ( $use_excerpt == 'Excerpt' && $excerpt != '' ){
					  the_excerpt('',FALSE,'');
					  echo '<a style="margin-left: 5px;display: inline-block;" href="' . get_permalink($post->ID) . '">' . __('Read More', 'color-theme-framework') . '</a>';
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
									$thumb_type = stripslashes ( $data['crossroad_video_thumb_type'] );
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
		jQuery.noConflict()(function($){
		    $(window).load(function() {

			$('#slider-<?php echo $post->ID; ?>').flexslider({
									    animation: "fade",
										directionNav: true,
										controlNav: false,
										smoothHeight: true,
										slideshow: false
									  });
		});
   	});
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

			<?php endwhile; endif;  ?>


</div><!-- entry-blog -->

	    <!-- Begin Navigation -->
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		  <div class="blog-navigation clearfix">
			<?php if(function_exists('wp_corenavi')) { wp_corenavi(); } ?>
		  </div> <!-- blog-navigation -->
		<?php endif; ?>
		<!-- End Navigation -->

</div><!-- span12 -->
</div><!-- row-fluid -->
</div><!-- .widget -->

