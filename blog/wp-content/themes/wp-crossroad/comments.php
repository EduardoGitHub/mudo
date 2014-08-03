<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p><?php _e( "This post is password protected. Enter the password to view comments." , "color-theme-framework" ); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

  <?php comments_number('','<div class="post-title"><h4>' . __('1 Comment','color-theme-framework') . '</h4></div>','<div class="post-title"><h4>' . __('% Comments','color-theme-framework') . '</h4></div>')?>
  <ul id="comments" class="margin-comments">
    <?php wp_list_comments('max_depth=2&callback=mytheme_comment'); ?>     
  </ul><!-- margin-comments -->
		
<?php else : // this is displayed if there are no comments so far ?>
  <?php if ( comments_open() ) : ?>
    <!-- If comments are open, but there are no comments. -->
  <?php else : // comments are closed ?>
    <!-- If comments are closed. -->
	<p><?php _e( "Comments are closed." , "color-theme-framework" ); ?></p>
  <?php endif; ?>

<?php endif; ?>


  <?php if ( comments_open() ) : ?>
		
	<!--- replace comment_form();  -->
	<?php paginate_comments_links('prev_text=back&next_text=forward'); ?>
<!--	<?php cancel_comment_reply_link(); ?> -->

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	  <p><?php _e( 'You must be' , 'color-theme-framework' ); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e( 'logged in' , 'color-theme-framework' ); ?></a> <?php _e('to post a comment.' , 'color-theme-framework' ); ?></p>
	
    <?php else : ?>
	  <?php comment_form(); ?>
    <?php endif; // If registration required and not logged in ?>

  <?php endif; // if you delete this the sky will fall on your head ?>
