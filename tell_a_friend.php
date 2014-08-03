<?php
  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id') && (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $valid_product = false;
  if (isset($_GET['products_id'])) {
    $product_info_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
    if (tep_db_num_rows($product_info_query)) {
      $valid_product = true;

      $product_info = tep_db_fetch_array($product_info_query);
    }
  }

  if ($valid_product == false) {
    tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_TELL_A_FRIEND);

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $error = false;

    $to_email_address = tep_db_prepare_input($_POST['to_email_address']);
    $to_name = tep_db_prepare_input($_POST['to_name']);
    $from_email_address = tep_db_prepare_input($_POST['from_email_address']);
    $from_name = tep_db_prepare_input($_POST['from_name']);
    $message = tep_db_prepare_input($_POST['message']);

    if (empty($from_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_NAME);
    }

    if (!tep_validate_email($from_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_ADDRESS);
    }

    if (empty($to_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_NAME);
    }

    if (!tep_validate_email($to_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_ADDRESS);
    }

    if ($error == false) {
				 
	  require("includes/modules/email/class.phpmailer.php");
	  $html = ' 		
				'.sprintf(TEXT_EMAIL_INTRO, $to_name, $from_name, $product_info['products_name'], STORE_NAME).'<br/>
				<br/><br/>'.$message.'<br/><br/>
				'.sprintf(TEXT_EMAIL_LINK, tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id'])).'<br/><br/>
				'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME) .' ';

	  //tep_sendMail($to_email_address, sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME), $html, $from_name, $from_email_address);

      $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $product_info['products_name'], tep_output_string_protected($to_name)), 'success');

      tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
    }
  } elseif (tep_session_is_registered('customer_id')) {
    $account_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $account = tep_db_fetch_array($account_query);

    $from_name = $account['customers_firstname'] . ' ' . $account['customers_lastname'];
    $from_email_address = $account['customers_email_address'];
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . $_GET['products_id']));
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
      <div class="pagestitulo"><span><?php echo sprintf(HEADING_TITLE, substr($product_info['products_name'],0,50)); ?></span></div>
      <div><?php if ($messageStack->size('friend') > 0) { echo $messageStack->output('friend');  } ?></div>
      <?php echo tep_draw_form('email_friend', tep_href_link(FILENAME_TELL_A_FRIEND, 'action=process&products_id=' . $_GET['products_id'])); ?>
        <div class="pagestexto">
			<br /><br /><br />
            <span class="smallText" style="float:right;"><?php echo FORM_REQUIRED_INFORMATION; ?></span>
            
            <br /><span class="main"><b><?php echo FORM_TITLE_CUSTOMER_DETAILS; ?></b></span><br />
            <div style="border:1px solid #CCC; padding:10px;">
                <?php echo FORM_FIELD_CUSTOMER_NAME; ?> <?php echo tep_draw_input_field('from_name'). '&nbsp;<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?> <br />
                <?php echo FORM_FIELD_CUSTOMER_EMAIL; ?> <?php echo tep_draw_input_field('from_email_address'). '&nbsp;<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>';?>
            </div>
			
            <br /><span class="main"><b><?php echo FORM_TITLE_FRIEND_DETAILS; ?></b></span>            
            <div style="border:1px solid #CCC; padding:10px;">
                <?php echo FORM_FIELD_FRIEND_NAME; ?> <?php echo tep_draw_input_field('to_name') . '&nbsp;<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>'; ?> <br />
                <?php echo FORM_FIELD_FRIEND_EMAIL; ?> <?php echo tep_draw_input_field('to_email_address') . '&nbsp;<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?>
            </div>
            
            <br /><span class="main"><b><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></b></span><br />
            <div style="border:1px solid #CCC; padding:10px;">
                <?php echo tep_draw_textarea_field('message', 'soft', 40, 8); ?>
            </div>
            
            <div><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?>
            <?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?>
            </div>
        
        </div>
        </form>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>