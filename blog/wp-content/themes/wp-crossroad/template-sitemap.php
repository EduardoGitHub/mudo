<?php
/*
		Template Name: Sitemap

	 * @package WordPress 3.4.2
	 * @subpackage CrossRoad - Responsive WordPress Magazine Blog Theme
	 * @since CrossRoad 1.0

*/

get_header(); ?>


  <!-- START SITEMAP CONTENT ENTRY -->
  <div id="content" class="container">

    <!-- CONTENT + RIGHT -->
    <div id="wide-sidebar" class="row-fluid">
      <div class="span8">
        <div class="ct-page box margin-25t bt-5px b-shadow clearfix">
		  <h1 class="entry-title"><?php the_title(); ?></h1>
    		<div class="entry-sitemap">
      		  <h4 id="posts">Posts</h4>
      		  <ul class="posts-name">
        	    <?php
			      // Add categories seprated with comma (,) you'd like to hide to display on sitemap
				  $cats = get_categories('exclude=');
				  foreach ($cats as $cat) {
  				    echo "<li><h5>".$cat->cat_name."</h5>";
  				    echo "<ul>";
  				    query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
  				    while(have_posts()) {
    				  the_post();
    				  $category = get_the_category();
    				  // Only display a post link once, even if it's in multiple categories
    				  if ($category[0]->cat_ID == $cat->cat_ID) {
      				    echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
    				  }
  				    }
  				    echo "</ul>";
  				    echo "</li>";
				  }
			    ?>
      		  </ul>

			  <!-- Display Categories -->
      		  <h4>Categories</h4>
      		  <ul class="category-name">
        		<?php 
				  $catrssimg = "/img/icons/rss16x16.png";
            	  $catrssurl = get_template_directory_uri() . $catrssimg;        
        		  wp_list_categories("sort_column=name&feed_image=$catrssurl&optioncount=1&hierarchical=0");
        		?>
      		  </ul>
			
			  <!-- Display Pages -->
      		  <h4 id="pages">Pages</h4>
      		  <ul class="pages-name">
        		<?php
				  // Add pages seprated with comma[,] that you'd like to hide to display on sitemap
				  wp_list_pages(
  					array(
    					'exclude' => '',
    					'title_li' => '',
  						 )
				  );
				?>
      		  </ul>
    		</div><!-- entry-sitemap -->
			<?php wp_reset_query();  ?>
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
  <!-- END SITEMAP CONTENT ENTRY -->

<?php get_footer(); ?>