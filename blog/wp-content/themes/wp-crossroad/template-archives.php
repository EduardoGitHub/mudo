<?php
/*
		Template Name: Archives

	 * @package WordPress 3.4.2
	 * @subpackage CrossRoad - Responsive WordPress Magazine Blog Theme
	 * @since CrossRoad 1.0

*/

get_header(); ?>


  <!-- START ARCHIVES CONTENT ENTRY -->
  <div id="content" class="container">

    <!-- CONTENT + RIGHT -->
    <div id="wide-sidebar" class="row-fluid">
      <div class="span8">
        <div class="ct-page box margin-25t bt-5px b-shadow clearfix">
		  <h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="row-fluid">
		  	  <div class="span12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

				  <?php the_content(__('Read more...', 'color-theme-framework')); ?>
				  <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'color-theme-framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					
				  <!-- /archive-lists -->
				  <div class="row-fluid">
				    <div class="span4">
					  <h5><?php _e('Last 30 Posts', 'color-theme-framework') ?></h5>
					  <ul class="archives" style="">
					    <?php $archive_30 = get_posts('numberposts=30');
					    foreach($archive_30 as $post) : ?>
						  <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
					  	<?php endforeach; ?>
					  </ul>
					</div><!-- /span4 -->
						
					<div class="span4">
					  <h5><?php _e('Archives by Month:', 'color-theme-framework') ?></h5>
					  <ul class="archives" style="">
					    <?php wp_get_archives('type=monthly'); ?>
					  </ul>
					</div><!-- /span4 -->

				    <div class="span4">
					  <h5><?php _e('Archives by Subject:', 'color-theme-framework') ?></h5>
					  <ul class="archives">
					    <?php wp_list_categories( 'title_li=' ); ?>
					  </ul>
					</div><!-- /span4 -->					
				  <!-- /archive-lists -->
				  </div><!-- row-fluid -->
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
  <!-- END ARCHIVES CONTENT ENTRY -->

<?php get_footer(); ?>