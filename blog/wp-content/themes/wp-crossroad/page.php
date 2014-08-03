	<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); ?>


  <!-- START PAGE CONTENT ENTRY -->
  <div id="content" class="container">

    <!-- CONTENT + RIGHT -->
    <div id="wide-sidebar" class="row-fluid">
      <div class="span8">
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
        </div><!-- span8 -->
        <div class="span4">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar Widgets") ) : ?>
		  <?php endif; ?>
        </div><!-- span4 -->      
      </div><!-- row-fluid -->
	  <!-- END CONTENT + RIGHT -->

  </div> <!-- #content -->
  <!-- END PAGE CONTENT ENTRY -->

<?php get_footer(); ?>