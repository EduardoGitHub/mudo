<?php
	/* 
		Template Name: Full Width Page
		
	 * @package WordPress 3.4.2
	 * @subpackage CrossRoad - Responsive WordPress Magazine Blog Theme
	 * @since CrossRoad 1.0
		
	*/

get_header(); ?>

  <!-- START FULL WIDTH PAGE CONTENT ENTRY -->
  <div id="content" class="container">

    <!-- CONTENT + RIGHT -->
    <div id="wide-sidebar" class="row-fluid">
      <div class="span12">
        <div class="ct-page box margin-25t bt-5px b-shadow clearfix">
		  <h1 class="entry-title"><?php the_title(); ?></h1>
		  <?php $text = get_post_meta($post->ID,'_custom_page_desc',true);
		  if ( $text != '' ) : ?>
		    <div style="color: #888;font-style: italic; margin-bottom:20px;"><?php echo $text; ?></div>
		  <?php endif; ?>
			<div class="row-fluid">
		  	  <div class="span12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				  <?php the_content(); ?>
				<?php endwhile; endif; ?>
			  </div><!-- /span12 -->
			</div><!-- row-fluid -->
		  </div><!-- ct-page box -->
        </div><!-- span12 -->
      </div><!-- row-fluid -->
	  <!-- END CONTENT + RIGHT -->

  </div> <!-- #content -->
  <!-- END FULL WIDTH PAGE CONTENT ENTRY -->

<?php get_footer(); ?>