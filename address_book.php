<?php
/*
  $Id: address_book.php,v 1.58 2003/06/09 23:03:52 hpdl Exp $

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
  
  $type_register = tep_db_query("select customers_type_register from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $type_is = tep_db_fetch_array($type_register);

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADDRESS_BOOK);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<script language="javascript"><!--
function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
//--></script>
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
        <td></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('addressbook') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('addressbook'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td class="main"><b><?php echo PRIMARY_ADDRESS_TITLE; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="50%" valign="top"><?php echo PRIMARY_ADDRESS_DESCRIPTION; ?></td>
                <td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="center" valign="top"><b><?php echo PRIMARY_ADDRESS_TITLE; ?></b><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" valign="top"><?php echo tep_address_label($customer_id, $customer_default_address_id, true, ' ', '<br>'); ?></td>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo ADDRESS_BOOK_TITLE; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_complemento as complemento, entry_street_number as street_number, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' order by firstname, lastname");
while ($addresses = tep_db_fetch_array($addresses_query)) {
$format_id = tep_get_address_format_id($addresses['country_id']);
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="moduleRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL'); ?>'">
				  <?php if($type_is['customers_type_register']== 'F'){?>
                    <td class="main"><b><?php echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?></b><?php if ($addresses['address_book_id'] == $customer_default_address_id) echo '&nbsp;<small><i>' . PRIMARY_ADDRESS . '</i></small>'; ?></td>
                    <td class="main" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . tep_image_button('small_edit.gif', SMALL_IMAGE_BUTTON_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . tep_image_button('small_delete.gif', SMALL_IMAGE_BUTTON_DELETE) . '</a>'; ?></td>
					<?php }else if($type_is['customers_type_register']== 'J'){?>
					<td class="main"><b><?php echo tep_output_string_protected($addresses['firstname']); ?></b><?php if ($addresses['address_book_id'] == $customer_default_address_id) echo '&nbsp;<small><i>' . PRIMARY_ADDRESS . '</i></small>'; ?></td>
                    <td class="main" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . tep_image_button('small_edit.gif', SMALL_IMAGE_BUTTON_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . tep_image_button('small_delete.gif', SMALL_IMAGE_BUTTON_DELETE) . '</a>'; ?></td>
					<?php }?>
					
                  </tr>
                  <tr>
                    <td colspan="2"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td class="main"><?php if($type_is['customers_type_register']== 'F') echo tep_address_format($format_id, $addresses, true, ' ', '<br>'); else if($type_is['customers_type_register']== 'J'){ 
						$cr = '<br>'; 						
						//PEGAR ESTADO
						$state_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_id = '" . $addresses['zone_id'] . "'");
  						$state_is = tep_db_fetch_array($state_query);
						echo $addresses['firstname'].$cr.$addresses['street_address'].$cr.$addresses['number'].$cr.$addresses['complemento'].$cr.$addresses['suburb'].$cr.$addresses['city'].', '.$state_is['zone_code'].' '.tep_putcaracters($addresses['postcode'],'#####-###');
						} ?></td>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
<?php
  }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="smallText"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
<?php
  if (tep_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
?>
                <td class="smallText" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL') . '">' . tep_image_button('button_add_address.gif', IMAGE_BUTTON_ADD_ADDRESS) . '</a>'; ?></td>
<?php
  }
?>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="smallText"><?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); ?></td>
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
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>