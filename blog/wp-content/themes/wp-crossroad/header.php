<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!-- A ZERGE design (http://www.color-theme.com - http://themeforest.net/user/ZERGE) - Proudly powered by WordPress (http://wordpress.org) -->

<head>
  <?php global $data; ?>
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>	
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<!-- Mobile Specific Metas  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
	
	<?php global $is_IE; ?>

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo stripslashes( $data['crossroad_custom_favicon'] ); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon-57-precomposed.png">

	<?php wp_enqueue_style( 'bootstrap',get_template_directory_uri().'/css/bootstrap.css','','','all'); ?>
	<?php wp_enqueue_style( 'bootstrap-responsive',get_template_directory_uri().'/css/bootstrap-responsive.css','','','all'); ?>	
	<?php wp_enqueue_style( 'style',get_stylesheet_directory_uri().'/style.css','','','all'); ?>		
	<?php wp_enqueue_style( 'prettyPhoto-css',get_template_directory_uri().'/css/prettyphoto.css','','','all'); ?>		
	<?php wp_enqueue_style( 'custom-options',get_template_directory_uri().'/css/options.css','','','all'); ?>

	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>	

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	  <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->
	
	<?php 
		$google_stylesheet = stripslashes( $data['crossroad_google_stylesheet'] );
		if ( $google_stylesheet != '' ) echo $google_stylesheet; 
	?>
</head>

<body <?php body_class('body-class'); ?>>


<!-- Start Top Content -->


  <div id="header" itemscope itemtype="http://schema.org/WPHeader" >

    <!-- START TOP BLOCK -->
    <div id="top-block-bg" style="background:url('http://www.mudominhacasa.com.br/blog/wp-content/uploads/fundo-imagem-topo-blog-rosa.jpg'); height:300px">
  	  <div class="container">
        <div class="row-fluid" style="height:300px">
          <div class="span3 logo-block colored-bg">
      	    <div class="row-fluid">
      	      <div class="span12" style="height:300px">
      	  	    <div class="row-fluid">
    	    	  <div class="span12">
				    <div id="logo">
		  			  <?php $logo_type = stripslashes( $data['crossroad_type_logo'] );  			
						if ( $logo_type == "image" ) { 
							if ( is_front_page() ) { ?>
    							<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $data['crossroad_logo_upload'] ) ?>" alt="" /></a></h1>
							<?php } else { ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $data['crossroad_logo_upload'] ) ?>" alt="" /></a>
							<?php }
						 }	
			
						if ( $logo_type == "text" ) { ?>
							<h1><a href="<?php echo home_url(); ?>"><?php echo stripslashes( $data['crossroad_logo_text'] ); ?></a></h1>
							<span class="logo-slogan"><?php echo stripslashes( $data['crossroad_logo_slogan'] ); ?></span>
					  <?php }	?>
				    </div> <!-- #logo -->
    	    	  </div><!-- /span12 -->
    	  	    </div><!-- /row-fluid -->
      	      </div><!-- /span12 -->
    	    </div><!-- /row-fluid -->
          </div><!-- /span3 -->
          <div class="span9">
      	    <div class="row-fluid">
      	      <div class="span12">
		        <div class="top-menu">
		          <?php if ( has_nav_menu('secondary_menu') ) wp_nav_menu( array('theme_location' => 'secondary_menu', 'menu_class' => 'sf-menu add-nav')); ?>
		        </div> <!-- /top-menu -->
      	  	    <div class="row-fluid">
    	    	  <div class="span12">
		  		    <div class="banner">
		  			  <?php
						$banner_upload = stripslashes( $data['crossroad_banner_upload'] );
						$banner_code = stripslashes( $data['crossroad_banner_code'] );
						$show_top_banner = stripslashes( $data['crossroad_top_banner'] );
			
						if ( $banner_upload != '' && $show_top_banner == 'Upload' ) {
			  		  ?>
			    	  <a target="_blank" href="<?php echo stripslashes( $data['crossroad_banner_link'] ); ?>"><img src="<?php echo stripslashes( $data['crossroad_banner_upload'] ) ?>" alt="" /></a>
			  		  <?php } else if ( $banner_code != '' && $show_top_banner == 'Code' ) { echo $banner_code; } ?>
		  		    </div><!-- /banner -->
    	    	  </div><!-- /span12 -->
      	  	    </div><!-- /row-fluid -->
    	  	  </div><!-- /span12 -->
    	    </div><!-- /row-fluid -->
          </div><!-- /span9 -->
        </div><!-- /row-fluid -->
	  </div><!-- /container -->      
    </div><!-- /top-block-bg -->	
    <!-- END TOP BLOCK -->
	
  <!-- START MAIN MENU -->
  <div id="mainmenu-block-bg">
	<div class="container">
	  <div class="row-fluid">
	    <div class="span12">	  
		  <div class="navigation">
		    <div id="menu">
		  	  <?php 
				if ( has_nav_menu('main_menu') ) wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu')); 					
			  ?>             
		    </div> <!-- /menu -->
		  </div>  <!-- /navigation -->
		</div> <!-- /span12 -->
      </div><!-- /row-fluid -->
  	</div> <!-- container -->
  </div> <!-- mainmenu-block-bg -->	

  </div> <!-- #header -->