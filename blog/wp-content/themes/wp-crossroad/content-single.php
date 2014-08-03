<?php
/**
 * The template for displaying content in the single.php template
 *
 */
?>

<?php
  global $data;
  $featured_image_post = stripslashes( $data['crossroad_featured_image_post'] );
  $blog_sharing = stripslashes( $data['crossroad_blog_sharing'] );
  $disqus_shortname = stripslashes( $data['crossroad_disqus_shortname'] );
  $facebook_appid = stripslashes( $data['crossroad_facebook_appid'] );
  $theme_color = stripslashes ( $data['crossroad_theme_color'] );
?>

  <div class="row-fluid">
    <div class="span12">
	  <div id="entry-post" class="margin-25t bt-5px b-shadow clearfix">		
	    <?php 
		  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
       	    setPostViews(get_the_ID()); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
			  <div class="title-block">
				<?php 
		  		  $category = get_the_category(); 
		   		  $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id );
		  		  $cat_color = ct_get_color($category[0]->term_id);
		  		  if ( $cat_color == '') { $cat_color = $theme_color; }
				?>

		  		<span class="category-item" style="background-color:<?php echo $cat_color; ?>"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo __('View all posts in ', 'color-theme-framework'); echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></span>
				<time datetime="<?php the_time('F j, Y'); ?>" itemprop="datePublished"><span class="meta-time"><?php the_time('F j, Y'); ?></span></time>
				<span class="meta-author"><?php _e('posted by ','color-theme-framework'); echo the_author_posts_link(); ?></span>
				<meta itemprop="author" content="<?php echo get_the_author_meta( 'nickname' ); ?>">

				<div class="meta-share">
					    <div class="entry-share">
  					      <span class="share-twitter"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>"></a></span>
					      <span class="share-fb"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"></a></span>
					      <span class="share-google"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"></a></span>
					    </div><!-- entry-share -->
					    <a href="#"><?php _e('Share','color-theme-framework'); ?></a>
				</div><!-- meta-share -->
			  </div> <!-- /title-block -->

			  <h1 class="entry-title" itemprop="name headline"><?php the_title(); ?></h1>
			
<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Image or Standard  
-----------------------------------------------------------------------------------------------------------------							
*/
?>

			  <?php 
	            if ( $featured_image_post == 'Show' ) :
	 			  if ( has_post_format ( 'image' ) or ( !has_post_format ( 'audio' ) and !has_post_format ( 'video' ) and !has_post_format ( 'gallery' ) ) ) : ?>
				    <!-- start post thumb -->
				    <div class="entry-thumb">
 				      <?php
					    if ( has_post_thumbnail() ) { 
		                  $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumb');
		                  $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                    	  <a data-rel="prettyPhoto" href="<?php echo $large_image_url[0]; ?>"><img itemprop="image" src="<?php echo $small_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
					  <?php } ?>
				    </div> <!-- /entry-thumb -->
			  	  <?php endif;
				endif; ?>

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

			  <script type="text/javascript">
				jQuery.noConflict()(function($){
		    		$(window).load(function () {
					  $('#slider-<?php echo $post->ID; ?>').flexslider({
					    animation: "fade",
						directionNav: true,
						controlNav: false,
						slideshow: false,
						smoothHeight: true
					  });
					});
   				});
			  </script>

			  <!-- Start FlexSlider -->
			  <div id="slider-<?php echo $post->ID; ?>" class="flexslider clearfix">
			    <ul class="slides clearfix">
				  <?php if ( $image1 != ''  ) {	?>
					<li>
					  <img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image1_upload', true ) ?>" alt="<?php the_title(); ?>">
					  <div class="mask"><a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image1_upload', true ) ?>" data-rel="prettyPhoto[gal]"></a></div>
					</li>
				  <?php } ?>

				  <?php if ( $image2 != ''  ) {	?>
					<li>
					  <img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image2_upload', true ) ?>" alt="<?php the_title(); ?>">
					  <div class="mask"><a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image2_upload', true ) ?>" data-rel="prettyPhoto[gal]"></a></div>
					</li>
				  <?php } ?>

				  <?php if ( $image3 != ''  ) {	?>
					<li>
					  <img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image3_upload', true ) ?>" alt="<?php the_title(); ?>">
					  <div class="mask"><a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image3_upload', true ) ?>" data-rel="prettyPhoto[gal]"></a></div>
					</li>
				  <?php } ?>

				  <?php if ( $image4 != ''  ) {	?>
					<li>
					  <img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image4_upload', true ) ?>" alt="<?php the_title(); ?>">
					  <div class="mask"><a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image4_upload', true ) ?>" data-rel="prettyPhoto[gal]"></a></div>
					</li>
				  <?php } ?>

				  <?php if ( $image5 != ''  ) {	?>
					<li>
					  <img src="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image5_upload', true ) ?>" alt="<?php the_title(); ?>">
					  <div class="mask"><a href="<?php echo get_post_meta( $post->ID, 'crossroad_mb_image5_upload', true ) ?>" data-rel="prettyPhoto[gal]"></a></div>
					</li>
				  <?php } ?>
				</ul>
			  </div> <!-- /flexSlider -->
			<?php } ?>

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Video  
-----------------------------------------------------------------------------------------------------------------							
*/
?>

			  <?php	if ( has_post_format ( 'video' ) ) { ?>
				<div class="single-video-post">
				  <?php	$video_type = get_post_meta( $post->ID, 'crossroad_mb_post_video_type', true );
				  $videoid = get_post_meta( $post->ID, 'crossroad_mb_post_video_file', true );

	              if ( $video_type == 'youtube' ) {
		            echo '<iframe height="295" src="http://www.youtube.com/embed/' . $videoid . '?autohide=1&amp;showinfo=0&amp;wmode=transparent"></iframe>';
		          } else if ( $video_type == 'vimeo' ) {	            					
		          	echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '" height="295"></iframe>';
		          } else if( $video_type == 'dailymotion' ) { 
					echo '<iframe height="290" src="http://www.dailymotion.com/embed/video/' . $videoid . '?logo=0"></iframe>';
				  } ?>
				</div> <!-- /single-video-post-->
			  <?php } ?>

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Audio  
-----------------------------------------------------------------------------------------------------------------							
*/
?>
						
			  <?php if ( has_post_format ( 'audio' ) ) { ?>
				<div class="single-audio-post">
				  <?php	
					$soundcloud = get_post_meta( $post->ID, 'crossroad_mb_post_soundcloud', true );
         			if ( $soundcloud != '' ) {
		              echo $soundcloud;
					} ?>
		        </div> <!-- /single-audio-post-->
			  <?php } ?>

<?php						
/*
-----------------------------------------------------------------------------------------------------------------						
		CONTENT
-----------------------------------------------------------------------------------------------------------------							
*/
?>
			  <div itemprop="articleBody"><?php the_content(); ?></div>
			<div class="clearfix" style="margin-bottom:40px;">
			  <div class="entry-tags">
			    <?php the_tags('','' ,'' ); ?>
			    <meta itemprop="keywords" content="<?php echo strip_tags(get_the_tag_list('',', ','')); ?>">
			  </div><!-- entry-tags -->
			  
			  <div class="entry-likes">
			    <?php getPostLikeLink(get_the_ID()); ?>
			  </div><!-- entry-likes -->
			</div>

		  <?php if ( $blog_sharing != '') { ?>			
			<div class="entry-share">
			  <div class="post-title"><h4><?php _e('Share Article: ','color-theme-framework') ?></h4></div><!-- post-title -->
			  <div><?php echo $blog_sharing; ?></div>
			</div><!-- entry-share -->
		  <?php } ?>
							
			  <div id="entry-comments" class="clearfix">
				<?php comments_template(); ?>							

						<?php if ($data['crossroad_comments_type']['facebook'] == true && $facebook_appid != '') { ?>
					    		<div class="post-title" style="margin-top:40px;"><h4 style="border-top: 1px solid #EBECED; padding-top: 10px;"><?php _e('Facebook Comments','color-theme-framework'); ?></h4></div><!-- post-title -->
					    		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="2" data-width="470"></div><!-- fb-comments -->
								<div id="fb-root"></div><!-- fb-root -->
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = <?php echo '"//connect.facebook.net/en_GB/all.js#xfbml=1&appId=' . $facebook_appid . '"'; ?>; ;
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
						<?php } ?>


						<?php if ($data['crossroad_comments_type']['disqus'] == true && $disqus_shortname != '') { ?>
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = <?php echo json_encode($disqus_shortname); ?>; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        								
						<?php } ?>

	</div><!-- entry-comments -->
	</article><!-- post-ID -->
 						
				<?php
			  			endwhile;  
					endif;  
				?>		

	

		</div> <!-- post-entry -->
	  </div><!-- span12 -->
	</div><!-- row-fluid -->