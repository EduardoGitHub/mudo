<?php
/*
  $Id: account_history.php,v 1.63 2003/06/09 23:03:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_HISTORY);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
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
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="mainContent">
  	<div class="tituloCompra"><?php echo HEADING_TITLE; ?></div>
		<!-- body //-->
<table border="0" width="99%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php
  $orders_total = tep_count_customer_orders();

  if ($orders_total > 0) {
    $history_query_raw = "select o.orders_id, o.date_purchased, o.delivery_name, o.billing_name, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' order by orders_id DESC";
    $history_split = new splitPageResults($history_query_raw, MAX_DISPLAY_ORDER_HISTORY);
    $history_query = tep_db_query($history_split->sql_query);

    while ($history = tep_db_fetch_array($history_query)) {
      $products_query = tep_db_query("select count(*) as count from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$history['orders_id'] . "'");
      $products = tep_db_fetch_array($products_query);

      if (tep_not_null($history['delivery_name'])) {
        $order_type = TEXT_ORDER_SHIPPED_TO;
        $order_name = $history['delivery_name'];
      } else {
        $order_type = TEXT_ORDER_BILLED_TO;
        $order_name = $history['billing_name'];
      }
?>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="main"><?php echo '<b>' . TEXT_ORDER_NUMBER . '</b> ' . $history['orders_id']; ?></td>
              <td class="main" align="right"><?php echo '<b>' . TEXT_ORDER_STATUS . '</b> ' . $history['orders_status_name']; ?></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
            <tr class="infoBoxContents2">
              <td><table border="0" width="100%" cellspacing="2" cellpadding="4">
                <tr>
					<?php
						$data_purchased = getdate(strtotime($history['date_purchased']));
						$data = diaDaSemana($data_purchased["weekday"]).' '.$data_purchased["mday"].' '.mesReferente($data_purchased["month"]).' de '.$data_purchased["year"];
					?>
                  <td class="main" width="50%" valign="top"><?php echo '<b>' . TEXT_ORDER_DATE . '</b> ' . $data . '<br><b>' . $order_type . '</b> ' . tep_output_string_protected($order_name); ?></td>
                  <td class="main" width="30%" valign="top"><?php echo '<b>' . TEXT_ORDER_PRODUCTS . '</b> ' . $products['count'] . '<br><b>' . TEXT_ORDER_COST . '</b> ' . strip_tags($history['order_total']); ?></td>
                  <td class="main" width="20%"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' . $history['orders_id'], 'SSL') . '">' . tep_image_button('small_view.gif', SMALL_IMAGE_BUTTON_VIEW) . '</a>'; ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
            </tr>
          </table>
<?php
    }
  } else {
?>
          <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
            <tr class="infoBoxContents2">
              <td><table border="0" width="100%" cellspacing="2" cellpadding="4">
                <tr>
                  <td class="main"><?php echo TEXT_NO_PURCHASES; ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
<?php
  }
?>
        </td>
      </tr>
<?php
  if ($orders_total > 0) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText" valign="top"><?php echo $history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
            <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $history_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
		  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>