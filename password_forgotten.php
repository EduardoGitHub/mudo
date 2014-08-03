<?php
/*
  $Id: password_forgotten.php,v 1.50 2003/06/05 23:28:24 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PASSWORD_FORGOTTEN);

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = tep_db_prepare_input($_POST['email_address']);

    $check_customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_password, customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
    if (tep_db_num_rows($check_customer_query)) {
      $check_customer = tep_db_fetch_array($check_customer_query);

      $new_password = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
      //$crypted_password = tep_encrypt_password($new_password);
	  $crypted_password = $new_password;

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . tep_db_input($crypted_password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");
     
	 
	 
	    //CONFIGURAÇÃO DO EMAIL
		require("includes/modules/email/class.phpmailer.php");
	    $html = '	
				'.sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password).'<br/><br/>
				'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME);
	 
	 	tep_sendMail($email_address, sprintf(EMAIL_PASSWORD_REMINDER_SUBJECT, STORE_OWNER, STORE_NAME), $html, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

	 
      $messageStack->add_session('login', SUCCESS_PASSWORD_SENT, 'success');

      tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
    } else {
      $messageStack->add('password_forgotten', TEXT_NO_EMAIL_ADDRESS_FOUND);
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>"/>
<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">

	<div class="pagestitulo"><span><?php echo HEADING_TITLE; ?></span></div>
    <?php if ($messageStack->size('password_forgotten') > 0) { ?>
    	<div><?php echo $messageStack->output('password_forgotten'); ?></div>
	<?php } ?>
    <?php echo tep_draw_form('password_forgotten', tep_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL')); ?>
    <div class="pagestexto">
    	<br /><?php echo TEXT_MAIN; ?><br /><br />
        <?php echo '<b>' . ENTRY_EMAIL_ADDRESS . '</b> ' . tep_draw_input_field('email_address','','size="50"'); ?>
    </div><br />
     <div>
    	<?php echo '<a href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?>
        <?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?>
	</div>
    </form>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>