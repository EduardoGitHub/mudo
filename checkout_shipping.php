<?php
/*
  $Id: checkout_shipping.php,v 1.16 2003/06/09 23:03:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require('includes/classes/http_client.php');

// if the customer is not logged on, redirect them to the login page

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }


// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping destination address was selected, use the customers own address as default
  if (!isset($_SESSION['sendto'])) {
    //tep_session_register('sendto');
    $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];
  } else {
// verify the selected shipping address
    $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and address_book_id = '" . (int)$_SESSION['sendto'] . "'");
    $check_address = tep_db_fetch_array($check_address_query);

    if ($check_address['total'] != '1') {
      $_SESSION['sendto'] = $customer_default_address_id;
      if (tep_session_is_registered('shipping')) $_SESSION['shipping'];
    }
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
  if (!isset($_SESSION['cartID'])) $_SESSION['cartID'];
  $cartID = $_SESSION['cartID'] = $cart->cartID;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed
  if ($order->content_type == 'virtual') {
    if (!tep_session_is_registered('shipping')) $_SESSION['shipping'];
    $shipping = $_SESSION['shipping'] = false;
    $_SESSION['sendto'] = false;
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();

// load all enabled shipping modules
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping;

  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
    $pass = false;

    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
      case 'national':
        if ($order->delivery['country_id'] == STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'international':
        if ($order->delivery['country_id'] != STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'both':
        $pass = true;
        break;
    }

    $free_shipping = false;
	$free_for_cep = false;
	$free_for_total = false;
	if(MODULE_ORDER_TOTAL_SHIPPING_FREE_ZIPCODE !=''){ $free_for_cep = true; $faixas_cep = explode('-',MODULE_ORDER_TOTAL_SHIPPING_FREE_ZIPCODE);}
	if(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER !='') $free_for_total = true;
	
	
	if(($pass == true) && ($free_for_cep == true) && ($free_for_total == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) && ($order->delivery['postcode']>=$faixas_cep[0]) && ($order->delivery['postcode']<=$faixas_cep[1])){//verifica os dois
			$free_shipping = true;
			include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
	}else if(($pass == true) && ($free_for_cep == true) && ($free_for_total == false) && ($order->delivery['postcode']>=$faixas_cep[0]) && ($order->delivery['postcode']<=$faixas_cep[1])){ // verifica apenas o CEP
			$free_shipping = true;
			include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
	}else if(($pass == true) && ($free_for_cep == false) && ($free_for_total == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)){//Apenas verifica o valor total da compra
			$free_shipping = true;
			include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
	}
	
	
   /*
   if ( ($pass == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
      $free_shipping = true;

      include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
    }
	*/
	//Verifica se o CEP da pessoa que esta comprando esta dentro da faixa de cep que � para ser gratis
	
	

	
	
  } else {
    $free_shipping = false;
  }



// process the selected shipping method
  if ( isset($_POST['action']) && ($_POST['action'] == 'process') ) {
    if (!tep_session_is_registered('comments')) $_SESSION['comments'];
	
    if (tep_not_null($_POST['comments'])) {
		 
      $comments = $_SESSION['comments'] = tep_db_prepare_input($_POST['comments']);
    }

    if (!tep_session_is_registered('shipping')) $_SESSION['shipping'];

    if ( (tep_count_shipping_modules() > 0) || ($free_shipping == true) ) {
      if ( (isset($_POST['shipping'])) && (strpos($_POST['shipping'], '_')) ) {
        $shipping = $_SESSION['shipping'] = $_POST['shipping'];

        list($module, $method) = explode('_', $shipping);
        if ( is_object($$module) || ($shipping == 'free_free') ) {
          if ($shipping == 'free_free') {
            $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
            $quote[0]['methods'][0]['cost'] = '0';
          } else {
            $quote = $shipping_modules->quote($method, $module);
          }
          if (isset($quote['error'])) {
            tep_session_unregister('shipping');
          } else {
            if($total_weight >0){
            	if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
              	$shipping = array('id' => $shipping,
                                	'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                	'cost' => $quote[0]['methods'][0]['cost']);

              	tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            	}
			}else{
				$free_shipping = true;
				$shipping = array('id' => $shipping,
                                	'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                	'cost' => 0);

              tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
      }
    } else {
      $shipping = false;
                
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }    
  }

// get all available shipping quotes
  $quotes = $shipping_modules->quote();

// if no shipping method has been selected, automatically select the cheapest method.
// if the modules status was changed when none were available, to save on implementing
// a javascript force-selection method, also automatically select the cheapest shipping
// method if more than one module is now enabled
  if ( !tep_session_is_registered('shipping') || ( tep_session_is_registered('shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1) ) ) $shipping = $shipping_modules->cheapest();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
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
  <div id="mainContent" style="width:100%; margin:0; padding:10px 0 0 0;">

<!-- body //-->
<table border="0" width="99%" cellspacing="0" cellpadding="0" align="center">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top">
	<?php echo tep_draw_form('checkout_address', tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) . tep_draw_hidden_field('action', 'process'); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
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
                    <td align="center" width="25%" class="checkoutBarCurrent" style="border-left:0;"><?php echo CHECKOUT_BAR_DELIVERY; ?></td>
                    <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
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
                <td width="50%" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
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
      
      
      
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      
      
<?php
if($total_weight > 0){
  if (tep_count_shipping_modules() > 0) {
?>
      <tr>
        <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></b></td>
              </tr>
            </table>
        </td>
      </tr>
      <tr>
        <td>
        <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
			  <?php if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) { ?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="50%" valign="top"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></td>
                <td class="main" width="50%" valign="top" style="text-align:right;"><?php echo '<b>' . TITLE_PLEASE_SELECT . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif'); ?></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
				<?php } elseif ($free_shipping == false) { ?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
				<?php } if ($free_shipping == true) { ?>
             		<? if($free_for_total == true){//Exibi a mensagem para fretes gratis para valores?>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td colspan="2" width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                            <td class="main" colspan="3"><b><?php echo FREE_SHIPPING_TITLE; ?></b>&nbsp;<?php echo $quotes[$i]['icon']; ?></td>
                            <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                          </tr>
                          <tr id="defaultSelected" class="moduleRowSelected" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="selectRowEffect(this, 0)">
                            <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                            <td class="main" width="100%"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field('shipping', 'free_free'); ?></td>
                            <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                          </tr>
                        </table></td>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
                      </tr>
                   <? }else if($free_for_total == false && $free_for_cep == true ){//Exibi a mensagem para fretes gratis para regi�o?>
                   	  <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td colspan="2" width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                            <td class="main" colspan="3"><b><?php echo FREE_SHIPPING_TITLE; ?></b>&nbsp;<?php echo $quotes[$i]['icon']; ?></td>
                            <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                          </tr>
                          <tr id="defaultSelected" class="moduleRowSelected" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="selectRowEffect(this, 0)">
                            <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                            <td class="main" width="100%"><?php echo FREE_SHIPPING_DESCRIPTION_FOR_CEP . tep_draw_hidden_field('shipping', 'free_free'); ?></td>
                            <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                          </tr>
                        </table></td>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
                      </tr>
                   <? } ?>   
<?php  } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" colspan="3"><b><?php echo $quotes[$i]['module']; ?></b>&nbsp;<?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
				  <?php if (isset($quotes[$i]['error'])) { ?>
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" colspan="3"><?php echo $quotes[$i]['error']; ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
					<?php
                            } else {
                              for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
                    // set the radio button to be checked if it is the method chosen
                                $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);
                                if(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)) <= 2){
                                    $quotes[$i]['methods'][$j]['cost'] = 0;
                                }
                                if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
                                  echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
                                } else {
                                  echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
                                }
                    ?>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" width="75%"><?php echo $quotes[$i]['methods'][$j]['title']; ?></td>
					<?php  if ( ($n > 1) || ($n2 > 1) ) { ?>
                    <td class="main"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></td>
                    <td class="main" style="text-align:right"><?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked); ?></td>
					<?php  } else { ?>
                    <td class="main" style="text-align:right" colspan="2"><?php //edited
					echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></td>
					<?php } ?>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
				<?php
                            $radio_buttons++;
                          }
                        }
                ?>
                </table></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
              </tr>
<?php
      }
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }}else{//edit for shipping on 0 weights
  	for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
  		for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
  			echo '<tr><td>'.tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']).'</td></tr>';
  			$order->info['shipping_cost'] = 0;
  			
  		}
	}
?>
<tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>ATEN��O</b></td>
          </tr>
        </table></td>
      </tr>
	  <tr>
        <td>
		<table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td>
				<table border="0" width="100%" cellspacing="0" cellpadding="2">
				  <tr>
					<td class="main"><?PHP echo TEXT_ENTER_INFORMATION_WITHOUT_SHIPPING;?></td>
				  </tr>
				</table>
			</td>
          </tr>
        </table>
		</td>
      </tr>

<?php

}
?>
	<tr>
    	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="49%">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td>
                                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td class="main"><b><?php echo TABLE_HEADING_SHIPPING_ADDRESS; ?></b></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td>
                                <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2" height="250">
                                  <tr class="infoBoxContents2">
                                    <td>
                                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                          <tr>
                                            <td class="main" width="50%" valign="top"><?php echo TEXT_CHOOSE_SHIPPING_DESTINATION . '<br><br>'; ?></td>
                                          </tr>
                                          <tr>
                                          	<td>
                                                <table border="0" cellspacing="0" cellpadding="2">
                                                  <tr>
                                                    <td class="main" align="center" valign="top"><?php echo '<b>' . TITLE_SHIPPING_ADDRESS . '</b>'; ?></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="main" valign="top"><?php echo tep_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br>'); ?></td>
                                                  </tr>
                                                </table>
                                            </td>
                                          </tr>
                                          <tr>
                                          	<td><? echo '<br><a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . tep_image_button('button_change_address.gif', IMAGE_BUTTON_CHANGE_ADDRESS) . '</a>';?></td>
                                          </tr>  	
                                        </table>
                                    </td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                    </table>
                </td>
                <td width="2%"></td>
                <td width="49%">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                              <tr>
                                <td class="main"><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBox2" height="250">
                              <tr class="infoBoxContents2">
                                <td>
                                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                      <tr>
                                        <td><?php echo tep_draw_textarea_field('comments', 'soft', '60', '16');?></td>
                                      </tr>
                                    </table>
                                </td>
                              </tr>
                            </table>
                        </td>
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
                <td class="main"><?php echo '<b>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></td>
                <td class="main" align="right" style="text-align:right;"><?php echo '<a onclick="history.go(-1)" style="cursor:pointer;">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>&nbsp;&nbsp;&nbsp;'; echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
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
  if (document.checkout_address.shipping[0]) {
    document.checkout_address.shipping[buttonSelect].checked=true;
  } else {
    document.checkout_address.shipping.checked=true;
  }
}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
//--></script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>