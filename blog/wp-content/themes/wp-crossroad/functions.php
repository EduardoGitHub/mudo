<?php
/**
 * Slightly Modified Options Framework
*/
require_once ('admin/index.php');

/*=======================================
    Preparing the Theme For Localization
=======================================*/

add_action('after_setup_theme', 'crossroad_theme_setup');
if ( !function_exists( 'crossroad_theme_setup' ) ) {	
  function crossroad_theme_setup(){
	load_theme_textdomain( 'color-theme-framework', get_template_directory() . '/languages' );
	
  	/* Configure WP 2.9+ Thumbnails ---------------------------------------------*/
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   

	add_image_size( 'small-thumb', 50, 50, true );
	add_image_size( 'carousel-thumb', 270, 190, true );	// carousel thumbs	
	add_image_size( 'slider-thumb', 730, 514, true );	// slider thumbs	
	add_image_size( 'post-thumb', 730, 9999 ); //530 pixels wide (and unlimited height)
  }
}

/*=======================================
	Add WP Menu Support
=======================================*/

function register_crossroad_menu() { 
  register_nav_menus(
    array(
      'main_menu' => __( 'main navigation' , 'color-theme-framework' ),
      'secondary_menu' => __( 'additional navigation' , 'color-theme-framework' ),
      'bottom_menu' => __( 'bottom navigation' , 'color-theme-framework' )
    )
  );
}

add_action( 'init', 'register_crossroad_menu' ); 



/*-----------------------------------------------------------------------------------*/
/* Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_wp_title' ) ) {
    function ct_wp_title( $title, $sep ) {
        global $paged, $page;

        if ( is_feed() )
            return $title;

        // Add the site name.
        $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'color-theme-framework' ), max( $paged, $page ) );

        return $title;
    }
    add_filter( 'wp_title', 'ct_wp_title', 10, 2 );
}



/*=======================================
	Register Sidebar
=======================================*/

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Magazine Top Widgets',
        'before_widget' => '<div class="widget clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Magazine Center Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Magazine Left Sidebar',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Magazine Right Sidebar',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

// ##########  SINGLE POST WIDGETS   #############
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Single Top Widgets',
        'before_widget' => '<div class="widget clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Single Before Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Single After Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));    

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Single Left Sidebar',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Single Right Sidebar',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Contacts Sidebar Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));    

// ##########  CATEGORY WIDGETS   #############
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Category Top Widgets',
        'before_widget' => '<div class="widget clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Category Before Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Category After Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));    

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Category Left Sidebar',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Category Right Sidebar',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

// ##########  BLOG WIDGETS   #############
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Blog Top Widgets',
        'before_widget' => '<div class="widget clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Blog Before Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Blog After Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));    

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Blog Left Sidebar',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Blog Right Sidebar',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));

// ##########  ONLY FOR DEMO   #############
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Demo Magazine Center Widgets',
        'before_widget' => '<div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
    ));


// ##########  FOOTER WIDGETS   #############
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer',
        'before_widget' => '<div class="span3"><div class="widget box margin-25t bt-5px b-shadow clearfix">',
        'after_widget' => '</div><!-- .widget --></div><!-- span3 -->',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div><!-- widget-title -->',
));



// Adding the Farbtastic Color Picker
// register message box widget
add_action('widgets_init', create_function('', 'return register_widget("CrossRoad_Popular_Post");'));
 
function sample_load_color_picker_script() {
	wp_enqueue_script('farbtastic');
}
function sample_load_color_picker_style() {
	wp_enqueue_style('farbtastic');	
}
add_action('admin_print_scripts-widgets.php', 'sample_load_color_picker_script');
add_action('admin_print_styles-widgets.php', 'sample_load_color_picker_style');




/*=======================================
	Content Width and Excerpt Redeclared
=======================================*/
if ( !isset( $content_width ) ) 
    $content_width = 980;

// Remove rel attribute from the category list
function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}

add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');

remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

add_theme_support( 'automatic-feed-links' );

function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');


function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/*=======================================
	Add Admin Bar only for Editors
=======================================*/

if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}


/*=======================================
	Show Featured Images in RSS Feed
 =======================================*/

function featuredtoRSS($content) {
  global $post;
  if ( has_post_thumbnail( $post->ID ) ){
    $content = '<div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
  }
  return $content;
}
 
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');


/*=======================================
	Post Formats
=======================================*/

add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );


/*=======================================
	Enable Shortcodes In Sidebar Widgets
=======================================*/

add_filter('widget_text', 'do_shortcode');


/*=======================================
	Include jQuery Libraries
=======================================*/

add_action('wp_enqueue_scripts', 'crossroad_scripts_method');

if ( !function_exists( 'crossroad_scripts_method' ) ) {
function crossroad_scripts_method() {

	//enqueue jquery
	wp_enqueue_script('jquery');

	if( !is_admin() ) {
	
		global $data;

		/* Super Fish JS */
		wp_register_script('super-fish',get_template_directory_uri().'/js/superfish.js',false, null , true);
		wp_enqueue_script('super-fish',array('jquery'));	

		/* Jquery-Easing */
		wp_register_script('jquery-easing',get_template_directory_uri().'/js/jquery.easing.1.3.js',false, null , true);
		wp_enqueue_script('jquery-easing',array('jquery'));	

		/* Google Prettify */
		wp_register_script('google-prettify',get_template_directory_uri().'/js/prettify.js',false, null , true);
		wp_enqueue_script('google-prettify',array('jquery'));
		
		/* Flickr */
		wp_register_script('jquery-flickr',get_template_directory_uri().'/js/jflickrfeed.min.js',false, null , true);
		wp_enqueue_script('jquery-flickr',array('jquery'));	

		/* Twitter */
		wp_register_script('jquery-tweet',get_template_directory_uri().'/js/jquery.tweet.js',false, null , true);
		wp_enqueue_script('jquery-tweet',array('jquery'));	

		/* News Ticker */
		wp_register_script('jquery-ticker',get_template_directory_uri().'/js/jquery.ticker.js',false, null , true);
		wp_enqueue_script('jquery-ticker',array('jquery'));

		/* Flex Slider */
		wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
		wp_enqueue_script('flex-min-jquery',array('jquery'));	

		/* FitVids */
		wp_register_script('fitvids',get_template_directory_uri().'/js/jquery.fitvids.js',false, null , true);
		wp_enqueue_script('fitvids',array('jquery'));

		/* Prettyphoto */
		wp_register_script('prettyphoto-js',get_template_directory_uri().'/js/jquery.prettyphoto.js',false, null , true);
		wp_enqueue_script('prettyphoto-js',array('jquery'));

		/* To Top */
//		wp_register_script('scrolltopcontrol-js',get_template_directory_uri().'/js/scrolltopcontrol.js',false, null , true);
//		wp_enqueue_script('scrolltopcontrol-js',array('jquery'));

		/* Bootstrap */
		wp_register_script('jquery-bootstrap',get_template_directory_uri().'/js/bootstrap.js',false, null , true);
		wp_enqueue_script('jquery-bootstrap',array('jquery'));

		/* Custom JS */
		wp_register_script('custom-js',get_template_directory_uri().'/js/custom.js',false, null , true);
		wp_enqueue_script('custom-js',array('jquery'));
		
	
	} /* End Include jQuery Libraries */
  }
}


add_action( 'init', 'wap8_google_fonts' );
 
if ( !function_exists( 'wap8_google_fonts' ) ) {
	function wap8_google_fonts() {
		if ( !is_admin() ) { // we do not want this to load in the dashboard
			// register Google Fonts stylesheet
			wp_register_style( 'abel_google-fonts', 'http://fonts.googleapis.com/css?family=Abel', '', '', 'screen' );
 
			// enqueue Google Fonts stylesheet
			wp_enqueue_style( 'abel_google-fonts' );
		}
	}
}


// add ie conditional fix to header
function add_ie_fix () {
    echo '<!--[if lt IE 9]>';
    echo '<link rel="stylesheet" id="ie-fix-css"  href="'.get_template_directory_uri().'/css/ie-fix.css" type="text/css" media="all" /> ';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_fix');


// Related Post
function get_related_posts($post_id, $tags = array(), $posts_number_display) {
	$query = new WP_Query();
	
	$post_types = get_post_types();
	unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
	
	if($tags) {
		foreach($tags as $tag) {
			$tagsA[] = $tag->term_id;
		}
	}
	$query = new WP_Query( array('showposts' => $posts_number_display,'post_type' => $post_types,'post__not_in' => array($post_id),'tag__in' => $tagsA,'ignore_sticky_posts' => 1,
	));
  	return $query;
}



/*-----------------------------------------------------------------------------------*/
/* Pagination function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'wp_corenavi' ) ) {
    function wp_corenavi($pages = '', $range = 4)
    {  
        $showitems = ($range * 2)+1;  
 
        global $paged;
        if(empty($paged)) $paged = 1;
 
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }   
 
        if(1 != $pages)
        {
            echo "<div class=\"pagination clearfix\" role=\"navigation\"><span>Page ".$paged." of ".$pages."</span>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
            if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
                }
            }
 
            if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
            echo "</div>\n";
        }
    }
}


/*function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = ($wp_rewrite->using_permalinks()) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ) : @add_query_arg('paged','%#%');
  if( !empty($wp_query->query_vars['s']) ) $a['add_args'] = array( 's' => get_query_var( 's' ) );
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; 
  $a['mid_size'] = '3'; 
  $a['end_size'] = '1'; 
  $a['prev_text'] = 'Previous'; 
  $a['next_text'] = 'Next'; 
  $a['total'] = $wp_query->max_num_pages;

  if ($max > 1) echo '<div class="pagination clearfix">';
  echo  paginate_links($a);
  if ($max > 1) echo '</div>';
}*/


/*function paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'plain'
	);
	if( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	if( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo paginate_links( $pagination );
} */



function upload_scripts_post() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}

function upload_styles_post() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style( 'style-metabox-admin',get_template_directory_uri().'/admin/assets/css/metabox-options.css','','','all');
}
add_action('admin_print_scripts', 'upload_scripts_post'); 
add_action('admin_print_styles', 'upload_styles_post'); 



// Get DailyMotion Thumbnail
function getDailyMotionThumb( $id ) {
	if ( ! function_exists( 'curl_init' ) ) {
		return null;
	} else {
		$ch = curl_init();
		$videoinfo_url = "https://api.dailymotion.com/video/$id?fields=thumbnail_url";
		curl_setopt( $ch, CURLOPT_URL, $videoinfo_url );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_FAILONERROR, true ); // Return an error for curl_error() processing if HTTP response code >= 400
		$output = curl_exec( $ch );
		$output = json_decode( $output );
		$output = $output->thumbnail_url;
		if ( curl_error( $ch ) != null ) {
			$output = new WP_Error( 'dailymotion_info_retrieval', __( 'Error retrieving video information from the URL','color-theme-framework') . '<a href="' . $videoinfo_url . '">' . $videoinfo_url . '</a>.<br /><a href="http://curl.haxx.se/libcurl/c/libcurl-errors.html">Libcurl error</a> ' . curl_errno( $ch ) . ': <code>' . curl_error( $ch ) . '</code>. If opening that URL in your web browser returns anything else than an error page, the problem may be related to your web server and might be something your host administrator can solve.' );
		}
		curl_close( $ch ); // Moved here to allow curl_error() operation above. Was previously below curl_exec() call.
		return $output;
	}
};


function ct_get_post_count() {
	 $res_search = &new WP_Query("showposts=-1");
	 $count = $res_search->post_count;

	 return $count; 
	     
	 wp_reset_query();
	 unset($res_search, $count);
}



// Add Widgets

include("functions/crossroad-social-widget.php");
include("functions/crossroad-fblikebox-widget.php");
include("functions/crossroad-fbsubscribe-widget.php");
include("functions/crossroad-flickr-widget.php");
include("functions/crossroad-twitter-widget.php");
include("functions/crossroad-popular-post-widget.php");
include("functions/crossroad-related-posts-widget.php");
include("functions/crossroad-recent-posts-widget.php");
include("functions/crossroad-news-ticker-widget.php");
include("functions/crossroad-carousel-widget.php");
include("functions/crossroad-blog-widget.php");
include("functions/crossroad-text-widget.php");
include("functions/crossroad-search-widget.php");
include("functions/crossroad-categories-widget.php");
include("functions/crossroad-slider-widget.php");
include("functions/crossroad-social-counter-widget.php");
include("functions/crossroad-2-columns-magazine-widget.php");
include("functions/crossroad-1-column-magazine-widget.php");

// Add Color Picker field for Categories
include("includes/categories-color.php");

// Post Like
include("post-like.php");

/* Create Post Views in admin panel */
include("includes/post_views.php");

/* AJAX Thumbnail Rebuild */
require_once ('includes/ajax-thumbnail-rebuild.php');

/* Update notifier */
include("includes/update-notifier.php");

/* Get Shortcodes */
include("includes/shortcodes.php");


// ****************************************************
// Custom Page Description field below post/page editor
// ****************************************************
add_action('admin_menu', 'custom_page_desc');
add_action('save_post', 'save_custom_page_desc');

function custom_page_desc() {
	add_meta_box('custom_page_desc', 'Add Page description <small>(if left empty, the first 200 characters of the excerpt will be used)</small>', 'custom_page_desc_input_function', 'page', 'normal', 'high');
}

function custom_page_desc_input_function() {
	global $post;
	echo '<input type="hidden" name="custom_page_desc_input_hidden" id="custom_page_desc_input_hidden" value="'.wp_create_nonce('custom-page-desc-nonce').'" />';
	echo '<input type="text" name="custom_page_desc_input" id="custom_page_desc_input" style="width:100%;" value="'.get_post_meta($post->ID,'_custom_page_desc',true).'" />';
}

function save_custom_page_desc($post_id) {
	if (!wp_verify_nonce($_POST['custom_page_desc_input_hidden'], 'custom-page-desc-nonce')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$customMetaDesc = $_POST['custom_page_desc_input'];
	update_post_meta($post_id, '_custom_page_desc', $customMetaDesc);
}



// Get author for comment
function dp_get_author($comment) {
    $author = "";
    if ( empty($comment->comment_author) )
        $author = __('Anonymous', 'color-theme-framework');
    else
        $author = $comment->comment_author;
    return $author;
} 



function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="first-comment">
   
      <?php if ($comment->comment_approved == '0') : ?>
   	    <em><?php _e( 'Your comment is awaiting moderation.' , 'color-theme-framework' ); ?></em>
   	  <?php endif; ?>
   	  
	  <?php echo get_avatar($comment,$size='50',$default='' ); ?>
   	  
	  <div class="entry-comment-meta">
	    <div class="comment-author-link">
	      <?php comment_author_link(); ?>
		</div><!-- comment-author-link -->
		<div class="comment-date-link">
		  <?php echo get_comment_date('F d, Y g:i:s a'); ?>
		</div><!-- comment-date-link -->
		<?php comment_text() ?>
	  </div><!-- entry-comment-meta -->

      <div class="replay-buttton">	
	    <?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>	
	  </div><!-- replay-buttton -->
    </div> <!-- end #comment-ID -->
  <?php
}
