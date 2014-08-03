<?php get_header(); 

global $data, $page, $paged;

?>

<?php $main_layout = stripslashes( $data['crossroad_main_layout'] ); ?>


  <!-- START CONTENT ENTRY -->
  <div id="content" class="container">
  
	<!-- START TOP WIDGETS AREA -->
	<?php
	if ( is_active_sidebar(1) ): ?>
	  <div class="row-fluid">
	    <div class="span12">
			<?php
			  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Top Widgets") ) : ?>
			<?php endif; ?>
	    </div> <!-- /span12 -->	
	  </div> <!-- /row-fluid -->
	<?php endif; ?>	
	<!-- END TOP WIDGETS AREA -->
	
	
	
    <?php if ( $main_layout == 'l_c_r' ) :	?>
	  <!-- LEFT + CONTENT + RIGHT -->
      <div class="row-fluid">
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Left Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->
        <div class="span6">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Center Widgets") ) : ?>
		  <?php endif; ?>
        </div><!-- span6 -->
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Right Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->      
      </div><!-- row-fluid -->
	  <!-- END LEFT + CONTENT + RIGHT -->
	  
    <?php elseif ( $main_layout == 'c_l_r' ) :	?>
    
	  <!-- CONTENT + LEFT + RIGHT -->
      <div class="row-fluid">
        <div class="span6">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Center Widgets") ) : ?>
		  <?php endif; ?>
        </div><!-- span6 -->
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Left Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Right Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->      
      </div><!-- row-fluid -->
	  <!-- END LEFT + CONTENT + RIGHT -->


    <?php elseif ( $main_layout == 'l_r_c' ) :	?>
	  <!-- LEFT + RIGHT + CONTENT -->
      <div class="row-fluid">
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Left Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->
        <div class="span3">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Right Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span3 -->
        <div class="span6">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Center Widgets") ) : ?>
		  <?php endif; ?>
        </div><!-- span6 -->
      </div><!-- row-fluid -->
	  <!-- END LEFT + RIGHT + CONTENT -->


    <?php elseif ( $main_layout == 'c_r' ) :	?>
	  <!-- CONTENT + RIGHT -->
      <div id="wide-sidebar" class="row-fluid">
        <div class="span8">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Center Widgets") ) : ?>
		  <?php endif; ?>
        </div><!-- span8 -->
        <div class="span4">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Right Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span4 -->      
      </div><!-- row-fluid -->
	  <!-- END CONTENT + RIGHT -->


    <?php elseif ( $main_layout == 'l_c' ) :	?>
	  <!-- LEFT + CONTENT -->
      <div id="wide-sidebar" class="row-fluid">
        <div class="span4">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Left Sidebar") ) : ?>
		  <?php endif; ?>
        </div><!-- span4 -->
        <div class="span8">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine Center Widgets") ) : ?>
		  <?php endif; ?>
        </div><!-- span8 -->
      </div><!-- row-fluid -->
	  <!-- END LEFT + CONTENT -->
    <?php endif; ?>
    
  </div> <!-- #content -->
  <!-- END CONTENT ENTRY -->


<?php get_footer(); ?>
