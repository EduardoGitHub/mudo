<?php
	global $data;
?>
<?php
	/*
	----------------------------------------------------
			Start Footer
	----------------------------------------------------				
	*/
?>

	<footer id="footer" itemscope="" itemtype="http://schema.org/WPFooter">
			
	  <!-- START FOOTER WIDGETS -->
	  <div class="container">
		<div class="row-fluid">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
		  <?php endif; ?>
  	    </div> <!-- /row-fluid -->
	  </div><!-- container -->
	  <!-- END FOOTER WIDGETS -->
	  
	  <div id="bottommenu-block-bg">
	    <div class="container">
			  <div class="row-fluid">
			    <div class="span12">
			    	<div class="bottom-menu">
		        		<?php if ( has_nav_menu('bottom_menu') ) wp_nav_menu( array('theme_location' => 'bottom_menu', 'menu_class' => 'sf-menu add-nav')); ?>
		      		</div> <!-- /top-menu -->
			    </div><!-- span12 -->
			  </div><!-- row -->
	    </div><!-- container -->
	  </div><!-- bottommenu-block-bg -->

  	  <!-- START COPYRIGHT -->	
	  <div id="bottom-block-bg">
	    <div class="container">
			  <div class="row-fluid">
			    <div class="span4 clearfix">
  				  		<div class="copyright">
						  <p><?php echo stripslashes( $data['crossroad_copyrights'] ); ?></p>
				  		</div> <!-- /copyright -->
			    </div><!-- span4 -->
			    <div class="span8">
  				  		<div class="add-info">
			      			<p><?php echo stripslashes( $data['crossroad_add_copyrights'] ); ?></p>
				  		</div> <!-- /copyright -->
		    
		    	<div>
		      		</div> <!--  -->
			    </div><!-- span8 -->
			  </div><!-- row -->
	    </div><!-- container -->
	  </div><!-- bottom-block-bg -->		  
	</footer>



<?php wp_footer(); ?>


<!-- STICKY MAIN MENU -->
<?php 

$sticky_menu = stripslashes( $data['crossroad_sticky_menu'] );
$menu_background = stripslashes( $data['crossroad_menu_background'] );

if ( $sticky_menu == 'Yes') { ?>
<script>
jQuery.noConflict()(function($){
  $(document).ready(function(){
  
	// grab the initial top offset of the navigation 
	var sticky_navigation_offset_top = $('#mainmenu-block-bg').offset().top+50;
	
	// our function that decides weather the navigation bar should have "fixed" css position or not.
	var sticky_navigation = function(){
		var scroll_top = $(window).scrollTop(); // our current vertical position from the top
		
		// if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
		if (scroll_top > sticky_navigation_offset_top) { 
			$('#mainmenu-block-bg').css({ 'background': 'rgba(47, 47, 47, 0.9)',  'position': 'fixed', 'top':0, 'left':0 });
		} else {
			$('#mainmenu-block-bg').css({ 'position': 'relative', 'background': '<?php echo $menu_background ?>' }); 
		}   
	};
	
	// run our function on load
	sticky_navigation();
	
	// and run it again every time you scroll
	$(window).scroll(function() {
		 sticky_navigation();
	});
  });
});
</script>
<?php } ?>
<!-- STICKY MAIN MENU -->

<!-- GOGLE ANALYTICS -->
<?php echo stripslashes ( $data['crossroad_google_analytics'] ); ?>



</body>

</html>


