<?php
/*
  $Id: checkout_payment.php,v 1.113 2003/06/29 23:03:27 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
// Se o cliente não estiver logado, redirecione ele para a pagina de login
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
// Se não tiver nada no carrinho do cliente, redirecione o mesmo para a pagina de compra 
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
// Se não tiver metodo de entrega selecionado, redirecione o mesmo para a pagina shipping metodo
  if (!tep_session_is_registered('shipping')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
// Evita que hack invade
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $_SESSION['cartID']) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (tep_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
        break;
      }
    }
  }

// if no billing destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('billto')) {
    //tep_session_register('billto');
    $billto = $_SESSION['billto'] = $_SESSION['customer_default_address_id'];
  } else {
// verify the selected billing address
    $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and address_book_id = '" . $_SESSION['billto'] . "'");
    $check_address = tep_db_fetch_array($check_address_query);

    if ($check_address['total'] != '1') {
      $billto = $_SESSION['billto'] = $_SESSION['customer_default_address_id'];
      if (tep_session_is_registered('payment')) tep_session_unregister('payment');
    }
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;
  
  
  ////// load the selected shipping module ///////////
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($shipping);

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;
  ///////////////////////////////////////////////////

  if (!isset($_SESSION['comments'])) $_SESSION['comments'];

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();

// load all enabled payment modules
// carrega todos os modulos de pagamento
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  
  //Iniciando o processo para parcelas
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    $order_total_modules->process();
	}

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
<?php echo $payment_modules->javascript_validation(); ?>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="mainContent" style="width:100%; margin:0; padding:10px 0 0 0;">

<!-- body //-->
<table border="0" width="99%" cellspacing="0" cellpadding="0" align="center">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><?php echo tep_draw_form('checkout_payment', tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'), 'post', 'onsubmit="return check_form();"'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <!--<tr>
        <td><div class="tituloCompra"><span><?php echo HEADING_TITLE; ?></span></div></td>
      </tr> -->
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
      
      <tr>
      	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" height="30">
                <tr>
                    <td align="center" width="25%" class="checkoutBarFrom"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL').'">' . CHECKOUT_BAR_DELIVERY . '</a>'; ?></td>
                    <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
                    <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
                    <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
                </tr>
			</table>

        </td>
      </tr>
      
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" style="text-align:right;"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
              </tr>
            </table></td>
          </tr>

        </table></td>
      </tr>
      
      
      
      
      
<?php
  if (isset($HTTP_GET_VARS['payment_error']) && is_object(${$HTTP_GET_VARS['payment_error']}) && ($error = ${$HTTP_GET_VARS['payment_error']}->get_error())) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo tep_output_string_protected($error['title']); ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBoxNotice">
          <tr class="infoBoxNoticeContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="100%" valign="top"><?php echo tep_output_string_protected($error['error']); ?></td>
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
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></b> 
			</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $selection = $payment_modules->selection();

  if (sizeof($selection) > 1) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="50%" valign="top"><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></td>
                <td class="main" width="50%" valign="top" style="text-align:right;"><b><?php echo TITLE_PLEASE_SELECT; ?></b><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif'); ?></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
<?php
  } else {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
<?php
  }

  $radio_buttons = 0;
  
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
	  if(($customer_revenda ==1)&&($selection[$i]['userrevenda'] == 'True')){ // VERIFICA SE ESTE MODULO DE PAGAMENTO PODE SER HABILITADO PARA REVENDEDOR
?>
            <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
				<?php
					if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) {
					  echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
					} else {
					  echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
					}
				?>
				<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				<td class="main" colspan="3"><b><?php echo $selection[$i]['module']; ?></b> </td>
				<td class="main" style="text-align:right;">
				<?php
					if (sizeof($selection) > 1) {
					  echo tep_draw_radio_field('payment', $selection[$i]['id']);
					} else {
					  echo tep_draw_hidden_field('payment', $selection[$i]['id']);
					}
				?>
                </td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
				<?php
					if (isset($selection[$i]['error'])) {
				?>
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" colspan="4"><?php echo $selection[$i]['error']; ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
				<?php
					} elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
				?>
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td colspan="4"><table border="0" cellspacing="0" cellpadding="2">
				<?php
					  for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
				?>
                      <tr>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                      </tr>
				<?php
					  }
				?>
                    </table></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
				<?php
					}
				?>
                </table></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr> 
			<?php
			}else if(($customer_revenda ==0) &&($selection[$i]['usernormal'] == 'True')){
			
			?>
			<tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
				<?php
					if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) {
					  echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
					} else {
					  echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
					}
				?>
				<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				<td class="main" colspan="3"><b><?php echo $selection[$i]['module']; ?></b> </td>
				<td class="main" style="text-align:right;">
				<?php
					if (sizeof($selection) > 1) {
					  echo tep_draw_radio_field('payment', $selection[$i]['id']);
					} else {
					  echo tep_draw_hidden_field('payment', $selection[$i]['id']);
					}
				?>
                </td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
				<?php
					if (isset($selection[$i]['error'])) {
				?>
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" colspan="4"><?php echo $selection[$i]['error']; ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
				<?php
					} elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
				?>
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td colspan="4"><table border="0" cellspacing="0" cellpadding="2">
				<?php
					  for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
				?>
                      <tr>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                      </tr>
				<?php
					  }
				?>
                    </table></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
				<?php
					}
				?>
                </table></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
			<?php
			}
				$radio_buttons++;
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
    	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="49%">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<?php if( MODULE_ORDER_TOTAL_DISCOUNT_COUPON_STATUS == 'true' ) { ?>
                          <tr>
                            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                              <tr>
                                <td class="main" bgcolor="#4295D9" height="30" style="color:#FFF; text-align:center"><b>Você possui um cupom de desconto?</b></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2" height="165" style="border:2px #4295D9 dashed;">
                              <tr class="infoBoxContents2">
                                <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td class="main"><?php echo ENTRY_DISCOUNT_COUPON.'<br/> '.tep_draw_input_field('coupon', '', 'size="32"'); ?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                          </tr>
                        <?php } /* end kgt - discount coupons */ ?> 
                    </table>
                </td>
                <td width="2%"></td>
                <td width="49%">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                              <tr>
                                <td class="main"><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2" height="165">
                              <tr class="infoBoxContents2">
                                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td><?php echo tep_draw_textarea_field('comments', 'soft', '60', '10'); ?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                    </table>
                </td>
              </tr>
            </table>
        </td>
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
                <td class="main"><b><?php echo TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></td>
                <td class="main" style="text-align:right;"><?php echo '<a onclick="history.go(-1)" style="cursor:pointer;">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>&nbsp;&nbsp;&nbsp;'; echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      
    </table></form></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script language="javascript"><!--
var selected;

function selectRowEffect(object, buttonSelect) {
  if (!selected) {
    if (document.getElementById) {
      selected = document.getElementById('defaultSelected');
    } else {
      selected = document.all['defaultSelected'];
    }
  }

  if (selected) selected.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selected = object;

// one button is not an array
  if (document.checkout_payment.payment[0]) {
    document.checkout_payment.payment[buttonSelect].checked=true;
  } else {
    document.checkout_payment.payment.checked=true;
  }
}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}

function janelaSecundaria (URL){ 
   window.open(URL,"janela1","width=495,height=467,scrollbars=NO") 
} 
//--></script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>