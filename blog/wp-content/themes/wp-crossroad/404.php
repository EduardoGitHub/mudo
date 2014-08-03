<?php get_header(); ?>

  <!-- START 404 CONTENT ENTRY -->
  <div id="content" class="container">
	<div class="ct-page box margin-25t bt-5px b-shadow clearfix">
      <div class="row-fluid">
        <div class="span12">
	     <h1 class="entry-title"><?php _e( '404 Error' , 'color-theme-framework' ); ?></h1>
	     
	    <div class="row-fluid">	     
	     <div class="span3"><div id="search-block"><?php get_search_form(); ?></div><!-- /search-block --></div><!-- span3 -->
   	     <div class="span3"><div class="tagcloud"><?php wp_tag_cloud('number=30&orderby=count'); ?></div><!-- tagcloud --></div><!-- span9 -->
				    <div class="span3">
					  <h5><?php _e('Last 15 Posts', 'color-theme-framework') ?></h5>
					  <ul class="archives" style="">
					    <?php $archive_30 = get_posts('numberposts=15');
					    foreach($archive_30 as $post) : ?>
						  <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
					  	<?php endforeach; ?>
					  </ul>
					</div><!-- /span3 -->
						
				    <div class="span3">
					  <h5><?php _e('Archives by Subject:', 'color-theme-framework') ?></h5>
					  <ul class="archives">
					    <?php wp_list_categories( 'title_li=' ); ?>
					  </ul>
					</div><!-- /span3 -->					
   	     
    </div><!-- row-fluid -->
      </div><!-- span12 -->
    </div><!-- row-fluid -->
    </div>
  </div> <!-- #content -->
  <!-- END 404 ENTRY -->

<?php get_footer(); ?>