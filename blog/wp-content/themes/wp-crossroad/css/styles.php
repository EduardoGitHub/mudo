<?php

	if ( isset( $data['crossroad_theme_color'] ) ) $theme_color = stripslashes ( $data['crossroad_theme_color'] );
	if ( isset( $data['crossroad_custom_bg'] ) ) $custom_bg = stripslashes ( $data['crossroad_custom_bg'] );	
	if ( isset( $data['crossroad_bg_color'] ) ) $bg_color = stripslashes ( $data['crossroad_bg_color'] );	
	if ( isset( $data['crossroad_body_background'] ) ) $body_background = stripslashes ( $data['crossroad_body_background'] );
	if ( isset( $data['crossroad_header_background'] ) ) $header_background = stripslashes ( $data['crossroad_header_background'] );
	if ( isset( $data['crossroad_menu_background'] ) ) $menu_background = stripslashes ( $data['crossroad_menu_background'] );
	if ( isset( $data['crossroad_links_color'] ) ) $links_color = stripslashes ( $data['crossroad_links_color'] );
	if ( isset( $data['crossroad_bg_attachment'] ) ) $bg_attachment = stripslashes ( $data['crossroad_bg_attachment'] );
	if ( isset( $data['crossroad_thumb_posts_stretch'] ) ) $thumb_posts_stretch = stripslashes ( $data['crossroad_thumb_posts_stretch'] );
	if ( isset( $data['crossroad_widget_border'] ) ) $widget_border = stripslashes ( $data['crossroad_widget_border'] );
	if ( isset( $data['crossroad_google_fontfamily'] ) ) $font_family = stripslashes ( $data['crossroad_google_fontfamily'] );
	if ( isset( $data['crossroad_google_stylesheet'] ) ) $google_stylesheet = stripslashes ( $data['crossroad_google_stylesheet'] );
	
	if ( isset( $data['crossroad_bg_upload'] ) ) $bg_upload = stripslashes( $data['crossroad_bg_upload'] );
?>

<?php 

	if ( $bg_color == 'Background Image' && $bg_attachment == 'Scroll' ) {
?>
body, .body-class {
	background: url(<?php echo $custom_bg; ?>) left top repeat;
}
<?php } else if( $bg_color == 'Background Image' && $bg_attachment == 'Fixed' ) { ?>
body, .body-class {
	background: url(<?php echo $custom_bg; ?>) left top repeat fixed;
}
<?php } else if( $bg_color == 'Color' ) { ?>
body, .body-class {
	background: none;
	background-color: <?php echo $body_background; ?>
}
<?php } else if ( $bg_color == 'Upload' && $bg_attachment == 'Scroll' ) { ?>
body, .body-class {
	background: url(<?php echo $bg_upload; ?>) left top repeat;
	background-color: <?php echo $body_background; ?>
}	
<?php } else if ( $bg_color == 'Upload' && $bg_attachment == 'Fixed' ) { ?>
body, .body-class {
	background: url(<?php echo $bg_upload; ?>) left top repeat fixed;
	background-color: <?php echo $body_background; ?>
}	
<?php } ?>

#top-block-bg, #bottom-block-bg { background:<?php echo $header_background; ?>;}
#mainmenu-block-bg, #bottommenu-block-bg { background:<?php echo $menu_background; ?>;}

<?php 
	if ( $widget_border == 'Hide' ) { ?>
	  .bt-5px { border-top: 0; }
	  .colored-border { display:none; }
<?php } ?>


a { color: <?php echo $links_color; ?>; }
textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .uneditable-input:focus {
border-color: <?php echo $links_color; ?>;
}

/* Theme Color */
.colored-bg, .sf-menu ul > li:hover { background: <?php echo $theme_color; ?>; }
#social-counter .c-icon { background-color: <?php echo $theme_color; ?>; }
.colored-border { border-top-color: <?php echo $theme_color; ?>; }
.colored { color: <?php echo $theme_color; ?>; }
.sf-menu li .sf-sub-indicator { border-color: transparent transparent <?php echo $theme_color; ?> transparent; }
.widget .tagcloud a[class|=tag-link]:hover, .widget a[rel=tag]:hover, #entry-post a[rel=tag]:hover { background-color: <?php echo $theme_color; ?>; }


/* Links Color */
.widget .category-title a:hover,
#pbd-alp-load-posts a:hover, #pbd-alp-load-posts a:active,
.widget li.cat-item a:hover, .left-col a:hover, .right-col a:hover,
#social-counter li:hover .social,
.copyright a:hover, .add-info a:hover,
.meta-comments a:hover, ul.popular-post-widget .meta-comments a:hover,
.two-column-widget .post-title a:hover,
ul.popular-post-widget .comments a:hover,
.pagination a:hover, .pagination span.current { color: <?php echo $links_color; ?>; }



<?php 
	if ( $thumb_posts_stretch == 'No' ) { ?>
	  .widget .entry-thumb img, .widget .single-media-thumb img, #entry-blog .entry-thumb img, #entry-blog .single-media-thumb img { width:auto;}
<?php } ?>

::selection { 	background-color: <?php echo $links_color; ?> !important; color: #fff	 }

::-moz-selection { 	background-color: <?php echo $links_color; ?> !important;	 }

<?php
  if ( ( $font_family != '' ) &&  ( $google_stylesheet != '' ) ) { ?>
		h1, h2, h3, h4, h5, h6,	#menu, .bottom-menu .add-nav li a, #pbd-alp-load-posts a, .category-item, .title-block .category-item  { <?php echo $font_family ?> };
<?php } ?>