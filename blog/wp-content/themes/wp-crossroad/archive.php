<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 */
?>


<?php get_header(); ?>


  <?php 
	$category_layout = stripslashes( $data['crossroad_category_layout'] );
  ?>	


  <!-- START ARCHIVE CONTENT ENTRY -->
  <div id="content" class="container">

	<?php
	if ( is_active_sidebar(12) ): ?>
	<!-- START TOP ARCHIVE WIDGETS AREA -->
	  <div class="row-fluid">
	    <div class="span12">
			<?php
			  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Top Widgets") ) : ?>
			<?php endif; ?>
	    </div> <!-- /span12 -->	
	  </div> <!-- /row-fluid -->
	<!-- END TOP ARCHIVE WIDGETS AREA -->
	<?php endif; ?>	


    <?php if ( $category_layout == 'l_c_r' ) :	?>
	  <!-- LEFT + CONTENT + RIGHT -->
      <div class="row-fluid">
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Left Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->
        <div class="span6">
          <?php if ( is_active_sidebar(13) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Before Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
          <div class="row-fluid">
            <div class="span12">
		  	  <?php get_template_part( 'content', 'archive' ); ?>
            </div><!-- span12 -->
          </div><!-- row-fluid -->
          <?php if ( is_active_sidebar(14) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category After Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
        </div><!-- span6 -->
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Right Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->      
      </div><!-- row-fluid l_c_r -->
	  <!-- END LEFT + CONTENT + RIGHT -->
	  
    <?php elseif ( $category_layout == 'c_l_r' ) :	?>
    
	  <!-- CONTENT + LEFT + RIGHT -->
      <div class="row-fluid">
        <div class="span6">
          <?php if ( is_active_sidebar(13) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Before Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
          <div class="row-fluid">
            <div class="span12">
		  	  <?php get_template_part( 'content', 'archive' ); ?>
            </div><!-- span12 -->
          </div><!-- row-fluid -->
          <?php if ( is_active_sidebar(14) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category After Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
        </div><!-- span6 -->
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Left Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Right Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->      
      </div><!-- row-fluid -->
	  <!-- END LEFT + CONTENT + RIGHT -->


    <?php elseif ( $category_layout == 'l_r_c' ) :	?>
	  <!-- LEFT + RIGHT + CONTENT -->
      <div class="row-fluid">
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Left Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Right Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->
        <div class="span6">
          <?php if ( is_active_sidebar(13) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Before Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
          <div class="row-fluid">
            <div class="span12">
		  	  <?php get_template_part( 'content', 'archive' ); ?>
            </div><!-- span12 -->
          </div><!-- row-fluid -->
          <?php if ( is_active_sidebar(14) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category After Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
        </div><!-- span6 -->
      </div><!-- row-fluid -->
	  <!-- END LEFT + RIGHT + CONTENT -->


    <?php elseif ( $category_layout == 'c_r' ) :	?>
	  <!-- CONTENT + RIGHT -->
      <div id="wide-sidebar" class="row-fluid">
        <div class="span8">
          <?php if ( is_active_sidebar(13) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Before Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
          <div class="row-fluid">
            <div class="span12">
		  	  <?php get_template_part( 'content', 'archive' ); ?>
            </div><!-- span12 -->
          </div><!-- row-fluid -->
          <?php if ( is_active_sidebar(14) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category After Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
        </div><!-- span8 -->
        <div class="span4">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Right Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span4 -->      
      </div><!-- row-fluid -->
	  <!-- END CONTENT + RIGHT -->


    <?php elseif ( $category_layout == 'l_c' ) : ?>
	  <!-- LEFT + CONTENT -->
      <div id="wide-sidebar" class="row-fluid">
        <div class="span4">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Left Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span4 -->
        <div class="span8">
          <?php if ( is_active_sidebar(13) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Before Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
          <div class="row-fluid">
            <div class="span12">
		  	  <?php get_template_part( 'content', 'archive' ); ?>
            </div><!-- span12 -->
          </div><!-- row-fluid -->
          <?php if ( is_active_sidebar(14) ): ?>
            <div class="row-fluid">
              <div class="span12">
		  	    <?php
		    	  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category After Widgets") ) : ?>
		  	    <?php endif; ?>
              </div><!-- span12 -->
            </div><!-- row-fluid -->
		  <?php endif; ?>
        </div><!-- span8 -->
      </div><!-- row-fluid -->
	  <!-- END LEFT + CONTENT -->
    <?php endif; ?>
    
  </div> <!-- #content -->
  <!-- END ARCHIVE ENTRY -->

<?php get_footer(); ?>