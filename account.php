<?php
  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
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
<style type="text/css">
.moduleRowOver { background-color: #D7E9F7; cursor: pointer; cursor: hand; }
.moduleRowSelected { background-color: #E9F4FC; }
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="mainContent" style="margin:0px;">
  
  <div class="tituloCompra"><b><?=HEADING_TITLE; ?></b></div>
  <?php if ($messageStack->size('account') > 0) { ?>
  <div><?php echo $messageStack->output('account'); ?></div>
  <?php } ?>
  
  
  <div>
  <span class="main"><b><?php echo OVERVIEW_TITLE; ?></b> <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '"><u>' . OVERVIEW_SHOW_ALL_ORDERS . '</u></a>'; ?></span>
  <br /><br />
 <span class="main"> <?php echo '<b>' . OVERVIEW_PREVIOUS_ORDERS . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></span>
  
  <?php
    $orders_query = tep_db_query("select o.orders_id, o.date_purchased, o.delivery_name, o.delivery_country, o.billing_name, o.billing_country, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' order by orders_id desc limit 3");
	
	echo '<table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBox2">';
    while ($orders = tep_db_fetch_array($orders_query)) {
      if (tep_not_null($orders['delivery_name'])) {
        $order_name = $orders['delivery_name'];
        $order_country = $orders['delivery_country'];
      } else {
        $order_name = $orders['billing_name'];
        $order_country = $orders['billing_country'];
      }
?>
      <tr class="moduleRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL'); ?>'">
        <td class="main" width="80"><?php echo tep_date_short($orders['date_purchased']); ?></td>
        <td class="main"><?php echo '#' . $orders['orders_id']; ?></td>
        <td class="main"><?php echo tep_output_string_protected($order_name) . ', ' . $order_country; ?></td>
        <td class="main"><?php echo $orders['orders_status_name']; ?></td>
        <td class="main" align="right"><?php echo $orders['order_total']; ?></td>
        <td class="main" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL') . '">' . tep_image_button('small_view.gif', SMALL_IMAGE_BUTTON_VIEW) . '</a>'; ?></td>
      </tr>
<?php
    }
	echo '</table>';
?>
  
  </div>
  
<!-- body //-->
<table border="0" width="99%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">


<?php


  if (tep_count_customer_orders() > 0) {
?>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"></td>
            <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '"><u>' . OVERVIEW_SHOW_ALL_ORDERS . '</u></a>'; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" align="center" valign="top" width="130"></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">

                </table></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_ACCOUNT_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'account_personal.gif'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'arrow_green.gif') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . MY_ACCOUNT_INFORMATION . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'arrow_green.gif') . ' <a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . MY_ACCOUNT_ADDRESS_BOOK . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'arrow_green.gif') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php
                    $afiliados = process_db(TABLE_PARTNERS, array('partner_id'), 'WHERE customers_id='.(int)$customer_id);
                    $num = count($afiliados);
                    if($num > 0){
                    	echo tep_image(DIR_WS_IMAGES . 'arrow_green.gif') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">Painel de Afiliados</a>'; 
                    }
                    ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_ORDERS_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'account_orders.gif'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'arrow_green.gif') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . MY_ORDERS_VIEW . '</a>'; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo EMAIL_NOTIFICATIONS_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'account_notifications.gif'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'arrow_green.gif') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_NEWSLETTERS . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'arrow_green.gif') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_PRODUCTS . '</a>'; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
	  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script language="javascript">
function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>