<?php
/*
  $Id: checkout_process.php,v 1.128 2003/05/28 18:00:29 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

include('includes/application_top.php');
// CONFIGURAÇÃO DO EMAIL
require("includes/modules/email/class.phpmailer.php");
  
// if the customer is not logged on, redirect them to the login page
  if (!isset($_SESSION['customer_id'])) {
    $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  
  if (!isset($_SESSION['sendto'])) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }

  if ( (tep_not_null(MODULE_PAYMENT_INSTALLED)) && (!isset($_SESSION['payment'])) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
 }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && isset($_SESSION['cartID'])) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);

// load selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($_SESSION['payment']);

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($_SESSION['shipping']);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

// load the before_process function from the payment modules
  $payment_modules->before_process();

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;

  $order_totals = $order_total_modules->process();
  
	
  if(($order->info['payment_method'] == '<div style="float:left; margin:10px 5px 0 0">Boleto Bancário Banco do Brasil</div><div style="float:left"><img src="images/formas-de-pagamento-boleto.png" /></div><div style="clear:left"></div>')) {  	
	$new_nn = MODULE_PAYMENT_BOLETOBRASIL_FX_INICIAL + 1;
  	tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '".$new_nn."', last_modified = now() where configuration_key ='MODULE_PAYMENT_BOLETOBRASIL_FX_INICIAL'");
	$nossonumero = MODULE_PAYMENT_BOLETOBRASIL_FX_INICIAL;
  }else if(($order->info['payment_method'] == 'Boleto Bancário Banco do Itaú')) {
  	$new_nn = MODULE_PAYMENT_BOLETOITAU_FX_INICIAL + 1;
  	tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '".$new_nn."', last_modified = now() where configuration_key ='MODULE_PAYMENT_BOLETOITAU_FX_INICIAL'");
  $nossonumero = MODULE_PAYMENT_BOLETOITAU_FX_INICIAL;
  }else if(($order->info['payment_method'] == 'Boleto Bancário Banco do Bradesco')) {
  	$new_nn = MODULE_PAYMENT_BOLETOBRADESCO_FX_INICIAL + 1;
  	tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '".$new_nn."', last_modified = now() where configuration_key ='MODULE_PAYMENT_BOLETOBRADESCO_FX_INICIAL'");
  $nossonumero = MODULE_PAYMENT_BOLETOBRADESCO_FX_INICIAL;
  }else if(($order->info['payment_method'] == 'Boleto Bancário Banco do Unibanco')) {
  	$new_nn = MODULE_PAYMENT_BOLETOUNIBANCO_FX_INICIAL + 1;
  	tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '".$new_nn."', last_modified = now() where configuration_key ='MODULE_PAYMENT_BOLETOUNIBANCO_FX_INICIAL'");
  $nossonumero = MODULE_PAYMENT_BOLETOUNIBANCO_FX_INICIAL;
  }else if(($order->info['payment_method'] == 'Boleto Bancário Banco do Real')) {
  	$new_nn = MODULE_PAYMENT_BOLETOREAL_FX_INICIAL + 1;
  	tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '".$new_nn."', last_modified = now() where configuration_key ='MODULE_PAYMENT_BOLETOREAL_FX_INICIAL'");
  $nossonumero = MODULE_PAYMENT_BOLETOREAL_FX_INICIAL;
  }
  
  /*
  $existePedido = false;
  
  switch ($_SESSION['customer_id']){
	case 5427:
		$oldId_insert = 2552;
		$orderid = array('orders_id'=>2552);
		$existePedido = true;
	break;  
	case 5428:
		$oldId_insert = 2572;
		$orderid = array('orders_id'=>2572);
		$existePedido = true;
	break;
  }
  */
  
  $sql_data_array = array('customers_id' => $_SESSION['customer_id'],
                          'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
                          'customers_company' => $order->customer['company'],
                          'customers_street_address' => $order->customer['street_address'],
						  'customers_street_number' => $order->customer['street_number'],
						  'customers_cpf' => $order->customer['cpf'],
						  'customers_rg' => $order->customer['rg'],
                          'customers_suburb' => $order->customer['suburb'],
						  'customers_complemento' => $order->customer['complemento'],
                          'customers_city' => $order->customer['city'],
                          'customers_postcode' => $order->customer['postcode'], 
                          'customers_state' => $order->customer['state'], 
                          'customers_country' => $order->customer['country']['title'], 
						  'customers_telephone' => $order->customer['telephone'], 
						  'customers_telephone_comercial' => $order->customer['telephone_comercial'],
						  'customers_telephone_celular' => $order->customer['telephone_celular'],
                          'customers_email_address' => $order->customer['email_address'],
                          'customers_address_format_id' => $order->customer['format_id'], 
                          'delivery_name' => $order->delivery['firstname'] . ' ' . $order->delivery['lastname'], 
                          'delivery_company' => $order->delivery['company'],
                          'delivery_street_address' => $order->delivery['street_address'],
						  'delivery_street_number' => $order->delivery['street_number'], 
                          'delivery_suburb' => $order->delivery['suburb'], 
						  'delivery_complemento' => $order->delivery['complemento'], 
                          'delivery_city' => $order->delivery['city'], 
                          'delivery_postcode' => $order->delivery['postcode'], 
                          'delivery_state' => $order->delivery['state'], 
                          'delivery_country' => $order->delivery['country']['title'], 
                          'delivery_address_format_id' => $order->delivery['format_id'], 
                          'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['lastname'], 
                          'billing_company' => $order->billing['company'],
                          'billing_street_address' => $order->billing['street_address'], 
						  'billing_street_number' => $order->billing['street_number'], 
                          'billing_suburb' => $order->billing['suburb'], 
						  'billing_complemento' => $order->billing['complemento'], 
                          'billing_city' => $order->billing['city'], 
                          'billing_postcode' => $order->billing['postcode'], 
                          'billing_state' => $order->billing['state'], 
                          'billing_country' => $order->billing['country']['title'], 
                          'billing_address_format_id' => $order->billing['format_id'], 
                          'payment_method' => $order->info['payment_method'], 
                          /*
						  'cc_type' => $order->info['cc_type'], 
                          'cc_owner' => $order->info['cc_owner'], 
                          'cc_number' => $order->info['cc_number'], 
                          'cc_expires' => $order->info['cc_expires'], 
						  'cvvnumber' => $order->info['cvvnumber'], 
						  */
						  'nosso_numero' => $nossonumero,
                          'date_purchased' => 'now()', 
                          'orders_status' => $order->info['order_status'], 
                          'currency' => $order->info['currency'], 
                          'currency_value' => $order->info['currency_value']);
	/*					  
	if($existePedido == true){
		$insert_id = $oldId_insert;
		$new = array_merge($sql_data_array,$orderid); 
		tep_db_perform(TABLE_ORDERS, $new);
	}else{
		 tep_db_perform(TABLE_ORDERS, $new);
		 $insert_id = tep_db_insert_id();
	}
  */
  
  tep_db_perform(TABLE_ORDERS, $sql_data_array);
  $insert_id = tep_db_insert_id();
		 
  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    $sql_data_array = array('orders_id' => $insert_id,
                            'title' => $order_totals[$i]['title'],
                            'text' => $order_totals[$i]['text'],
                            'value' => $order_totals[$i]['value'], 
                            'class' => $order_totals[$i]['code'], 
                            'sort_order' => $order_totals[$i]['sort_order']);
    tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
  }

  $customer_notification = (SEND_EMAILS == 'true') ? '1' : '0';
  $sql_data_array = array('orders_id' => $insert_id, 
                          'orders_status_id' => $order->info['order_status'], 
                          'date_added' => 'now()', 
                          'customer_notified' => $customer_notification,
                          'comments' => $order->info['comments']);
  tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
  
  
    //kgt - discount coupons
  if( tep_session_is_registered( 'coupon' ) && is_object( $order->coupon ) ) {
	  $sql_data_array = array( 'coupons_id' => $order->coupon->coupon['coupons_id'],
                             'orders_id' => $insert_id );
	  tep_db_perform( TABLE_DISCOUNT_COUPONS_TO_ORDERS, $sql_data_array );
  }
  //end kgt - discount coupons

// initialized for the email confirmation
  $products_ordered = '';
  $subtotal = 0;
  $total_tax = 0;

  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
// Stock Update - Joao Correia
    if (STOCK_LIMITED == 'true') {
      if (DOWNLOAD_ENABLED == 'true') {
        $stock_query_raw = "SELECT products_quantity, pad.products_attributes_filename 
                            FROM " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                             ON p.products_id=pa.products_id
                            LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                             ON pa.products_attributes_id=pad.products_attributes_id
                            WHERE p.products_id = '" . tep_get_prid($order->products[$i]['id']) . "'";
// Will work with only one option for downloadable products
// otherwise, we have to build the query dynamically with a loop
        $products_attributes = $order->products[$i]['attributes'];
        if (is_array($products_attributes)) {
          $stock_query_raw .= " AND pa.options_id = '" . $products_attributes[0]['option_id'] . "' AND pa.options_values_id = '" . $products_attributes[0]['value_id'] . "'";
        }
        $stock_query = tep_db_query($stock_query_raw);
      } else {
        $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
      }
      if (tep_db_num_rows($stock_query) > 0) {
        $stock_values = tep_db_fetch_array($stock_query);
// do not decrement quantities if products_attributes_filename exists
        if ((DOWNLOAD_ENABLED != 'true') || (!$stock_values['products_attributes_filename'])) {
          $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
        } else {
          $stock_left = $stock_values['products_quantity'];
        }
        tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . $stock_left . "' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
        if ( ($stock_left < 1) && (SHOW_WITH_STOCK_ZERO == 'False') ) {
          tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
        }
      }
    }

// Update products_ordered (for bestsellers list)
    tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");

    $sql_data_array = array('orders_id' => $insert_id, 
                            'products_id' => tep_get_prid($order->products[$i]['id']), 
                            'products_model' => $order->products[$i]['model'], 
                            'products_name' => $order->products[$i]['name'], 
                            'products_price' => $order->products[$i]['price'], 
                            'final_price' => $order->products[$i]['final_price'], 
                            'products_tax' => $order->products[$i]['tax'], 
                            'products_quantity' => $order->products[$i]['qty']);
    tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);
    $order_products_id = tep_db_insert_id();

//------insert customer choosen option to order--------
    $attributes_exist = '0';
    $products_ordered_attributes = '';
    if (isset($order->products[$i]['attributes'])) {
      $attributes_exist = '1';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        if (DOWNLOAD_ENABLED == 'true') {
          $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename 
                               from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
                               left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                on pa.products_attributes_id=pad.products_attributes_id
                               where pa.products_id = '" . $order->products[$i]['id'] . "' 
                                and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' 
                                and pa.options_id = popt.products_options_id 
                                and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' 
                                and pa.options_values_id = poval.products_options_values_id 
                                and popt.language_id = '" . $languages_id . "' 
                                and poval.language_id = '" . $languages_id . "'";
          $attributes = tep_db_query($attributes_query);
        } else {
          $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
        }
        $attributes_values = tep_db_fetch_array($attributes);

        $sql_data_array = array('orders_id' => $insert_id, 
                                'orders_products_id' => $order_products_id, 
                                'products_options' => $attributes_values['products_options_name'],
                                'products_options_values' => $attributes_values['products_options_values_name'], 
                                'options_values_price' => $attributes_values['options_values_price'], 
                                'price_prefix' => $attributes_values['price_prefix']);
        tep_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

        if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && tep_not_null($attributes_values['products_attributes_filename'])) {
          $sql_data_array = array('orders_id' => $insert_id, 
                                  'orders_products_id' => $order_products_id, 
                                  'orders_products_filename' => $attributes_values['products_attributes_filename'], 
                                  'download_maxdays' => $attributes_values['products_attributes_maxdays'], 
                                  'download_count' => $attributes_values['products_attributes_maxcount']);
          tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
        }
        //$products_ordered_attributes .= "\n\t" . $attributes_values['products_options_name'] . ' ' . $attributes_values['products_options_values_name'];
		$products_ordered_attributes .= "<br/><b>" . $attributes_values['products_options_name'] . ':</b> ' . $attributes_values['products_options_values_name'];
      }
    }
//------insert customer choosen option eof ----
    $total_weight += ($order->products[$i]['qty'] * $order->products[$i]['weight']);
    $total_tax += tep_calculate_tax($total_products_price, $products_tax) * $order->products[$i]['qty'];
    $total_cost += $total_products_price;

    //$products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . ' (' . $order->products[$i]['model'] . ') = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . $products_ordered_attributes . "\n";
	$products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . ' (' . $order->products[$i]['model'] . ') = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . $products_ordered_attributes . "<br/><br/>";
  }



// lets start with the email confirmation
  
  //PEGANDO DATA EM PORTUGUES
	  $today = getdate();
	  $day_of_order = diaDaSemana($today["weekday"]).' '.$today["mday"].' de '.mesReferente($today["month"]);
  //FIM
  
 /*
  $linkAlt = HTTP_URL_EMAIL_ORDER.'index.php?pedido='.$insert_id;
  
  $email_order = STORE_NAME . "\n" . 
                 EMAIL_SEPARATOR . "\n" . 
                 EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id . "\n" .
				 EMAIL_TEXT_INVOICE_URL . ' ' . $linkAlt . "\n" .
                // EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "\n" .
                 EMAIL_TEXT_DATE_ORDERED . ' ' . $day_of_order . "\n\n";
				 
  if ($order->info['comments']) {
    $email_order .= tep_db_output($order->info['comments']) . "\n\n";
  }
  $email_order .= EMAIL_TEXT_PRODUCTS . "\n" . 
                  EMAIL_SEPARATOR . "\n" . 
                  $products_ordered . 
                  EMAIL_SEPARATOR . "\n";
				  
				 

  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    $email_order .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "\n";
  }

  if ($order->content_type != 'virtual') {
    $email_order .= "\n" . EMAIL_TEXT_DELIVERY_ADDRESS . "\n" . 
                    EMAIL_SEPARATOR . "\n" .
                    tep_address_label($_SESSION['customer_id'], $sendto, 0, '', "\n") . "\n";
  }


  $email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
                  EMAIL_SEPARATOR . "\n" .
                  tep_address_label($_SESSION['customer_id'], $billto, 0, '', "\n") . "\n\n";
  				  
				  
		*/
	
	if ($order->info['comments']) {
    $comments .= tep_db_output($order->info['comments']) . "<br/>";
  }
		
		if ($order->content_type != 'virtual') {
    $email_order3 .= tep_address_label($_SESSION['customer_id'], $sendto, 0, '', "<br/>") . "<br/>";
  }
	
	for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    $email_order2 .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "<br/>";
  }
		
  if (is_object($$payment)) {
    $payment_class = $$payment;
    $email_order .= $payment_class->title . "<br/><br/>";
    if ($payment_class->email_footer) { 
      $email_order .= $payment_class->email_footer . "<br/><br/>";
    }
  }
 // tep_mail($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT_CLIENT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  
  /*
// send emails to other people
  if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
    tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }
*/



$html = '
<table width="760" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; background-color:#CC6E6E">
  <tr>
    <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="56%" style="font-size:30px; color:#FFF; font-family:Calibri;">'.EMAIL_TEXT_ORDER_NUMBER.'</b> '.$insert_id.'</td>
            <td width="44%"><img src="'.HTTP_SERVER.'/images/mail/mudominhacasa.png" width="332" height="59"/></td>
          </tr>
          <tr>
            <td style="color:#FFF; font-family:Calibri;">'.EMAIL_TEXT_DATE_ORDERED.' '.$day_of_order.'</td>
            <td style="color:#FFF; font-weight:bold; text-align:right; padding-right:3px;">wwww.mudominhacasa.com.br</td>
          </tr>
        </table>
     </td>
  </tr>
  <tr>
    <td>
    	<table width="760" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri;background-color:#FFF; margin:5px; padding:5px;">
          <tr>
            <td>
            	<table width="760" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                  <tr>
                    <td width="380" valign="top">
                    	<table width="95%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                                  <tr>
                                    <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon2.gif" alt=""/></td>
                                    <td width="89%"style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase;font-family:Calibri">:: PRODUTOS</td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; line-height:20px; text-align:left">'.$products_ordered.'</td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; line-height:20px; text-align:left" style="border-top:1px dashed #CCC;">'.$email_order2.'</td>
                          </tr>
                        </table>
                    </td>
                    <td width="380" valign="top" align="right">
                    	<table width="95%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                                  <tr>
                                    <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon1.gif" alt=""/></td>
                                    <td width="89%"style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase;font-family:Calibri">:: '.EMAIL_TEXT_PAYMENT_METHOD.'</td>
                                  </tr>
                                </table>

                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; line-height:20px; text-align:left">'.$email_order.'</td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                </table>
            </td>
          </tr>
		  <tr><td height="10"></td></tr>';
		  
		  if($comments !=''){
			$html .= '  
          <tr>
            <td>
                <table width="50%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                  <tr>
                   <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon6.gif" alt=""/></td>
                    <td width="89%"style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase; font-family:Calibri">:: COMENTÁRIO</td>
                  </tr>
                </table>
            </td>
          </tr>
          <tr>
          	<td bgcolor="#E9C0C0" style="padding:10px;">'.$comments.'</td>
          </tr>
          <tr><td height="10"></td></tr> ';
		  }
		  $html .= '
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                  <tr>
                    <td width="50%">
                    	<table width="95%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                                  <tr>
                                    <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon3.gif" alt=""/></td>
                                    <td width="89%"style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase">:: '.EMAIL_TEXT_DELIVERY_ADDRESS.'</td>
                                  </tr>
                                </table>

                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; padding-left:10PX; line-height:20px; text-align:left; background-color:#D9E5FF">'.$email_order3.'</td>
                          </tr>
                        </table>
                    </td>
                    <td width="50%" align="right">
                    	<table width="95%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                                  <tr>
                                    <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon4.gif" alt=""/></td>
                                    <td width="89%"style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase;font-family:Calibri">:: '.EMAIL_TEXT_BILLING_ADDRESS.'</td>
                                  </tr>
                                </table>

                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; padding-left:10PX; line-height:20px; text-align:left; background-color:#D9E5FF">'.tep_address_label($_SESSION['customer_id'], $billto, 0, '', "<br/>") . '"<br/><br/></td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                </table>

            </td>
          </tr>
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                  <tr>
                    <td width="82%" style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; line-height:20px; text-align:left">
                    	<span style="font-size:38px; color:#000;">'.substr(HTTP_SERVER,7).'</span><BR /><BR />
                        '.nl2br(STORE_NAME_ADDRESS).'
                    </td>
                    <td width="18%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon5.gif" /></td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
			<td style="text-align:center; font-size:13px; font-family:Tahoma; padding:10px; color:#FFF; font-family:Calibri">
            Muito obrigado pela sua preferência e compreensão!<br>
            Esperamos sua total satisfação na aquisição do seu produto Mudominhacasa - Adesivos Decorativos
            </td>
		  </tr>
</table>';

tep_sendMailOrders($order->customer['email_address'], sprintf(EMAIL_TEXT_SUBJECT_CLIENT, EMAIL_FROM, STORE_NAME), $html, EMAIL_FROM, STORE_OWNER_EMAIL_ADDRESS);		


if (SEND_EXTRA_ORDER_EMAILS_TO != '') {		
 	$html = '

<table width="760" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; background-color:#CC6E6E">
  <tr>
    <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="56%" style="font-size:30px; color:#FFF">'.EMAIL_TEXT_ORDER_NUMBER.'</b> '.$insert_id.'</td>
            <td width="44%"><img src="'.HTTP_SERVER.'/images/mail/mudominhacasa.png" width="332" height="59"/></td>
          </tr>
          <tr>
            <td>'.EMAIL_TEXT_DATE_ORDERED.' '.$day_of_order.'</td>
            <td style="color:#000; font-weight:bold; text-align:right; padding-right:3px; color:#FFF">wwww.mudominhacasa.com.br</td>
          </tr>
        </table>
     </td>
  </tr>
  <tr>
    <td>
    	<table width="760" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri;background-color:#FFF; padding:5px;">
          <tr>
            <td>
            	<table width="760" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                  <tr>
                    <td width="380" valign="top">
                    	<table width="95%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                                  <tr>
                                    <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/cesta-produtos.png" alt=""/></td>
                                    <td width="89%" style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase;font-family:Calibri">:: PRODUTOS</td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; line-height:20px; text-align:left">'.$products_ordered.'</td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; line-height:20px; text-align:left" style="border-top:1px dashed #CCC;">'.$email_order2.'</td>
                          </tr>
                        </table>
                    </td>
                    <td width="380" valign="top" align="right">
                    	<table width="95%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                                  <tr>
                                    <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon1.gif" alt=""/></td>
                                    <td width="89%" style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase;font-family:Calibri">:: '.EMAIL_TEXT_PAYMENT_METHOD.'</td>
                                  </tr>
                                </table>

                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; line-height:20px; text-align:left">'.$email_order.'</td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                </table>
            </td>
          </tr>
		  <tr><td height="10"></td></tr>';
		  
		  if($comments !=''){
			$html .= '  
          <tr>
            <td>
                <table width="50%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                  <tr>
                   <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon6.gif" alt=""/></td>
                    <td width="89%" style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase;font-family:Calibri">:: COMENTÁRIO</td>
                  </tr>
                </table>
            </td>
          </tr>
          <tr>
          	<td bgcolor="#FFDAA3" style="padding:10px;">'.$comments.'</td>
          </tr>
          <tr><td height="10"></td></tr> ';
		  }
		  $html .= '
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                  <tr>
                    <td align="right">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10PX; padding-top:10PX; height:75PX;">
                                  <tr>
                                    <td width="11%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon4.gif" alt=""/></td>
                                    <td width="89%" style="border-bottom:1px solid #CCC; font-size:20px; color:#000; vertical-align:bottom; font-weight:bold; text-align:left;text-transform:uppercase;font-family:Calibri">:: '.EMAIL_TEXT_INFOR_CUSTOMERS.'</td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; padding-left:10PX; line-height:20px; text-align:left; background-color:#D9E5FF">';
							$type_register = strlen($order->customer['cpf']);
							if($type_register == 11){
							$html .= '	
								<b>Nome:</b>'.$order->customer['firstname'] . ' ' . $order->customer['lastname'].'<br />
								<b>CPF:</b>'.$order->customer['cpf'].'<br />
								<b>RG:</b>'.$order->customer['rg'].'<br />
								<b>E-mail:</b>'.$order->customer['email_address'].'<br />
								<b>Endereço:</b>'.$order->customer['street_address'].','.$order->customer['street_number'].' - '.$order->customer['suburb'].', '.$order->customer['complemento'].' / '.$order->customer['city'].' - '.$order->customer['state'].' ['.$order->customer['postcode'].']<br />
								<b>Telefone:</b>'.$order->customer['telephone'].'<br />
								<b>Tel. Comercial:</b>'.$order->customer['telephone_comercial'].'<br />
								<b>Tel. Celular:</b>'.$order->customer['telephone_celular'].'<br />';
							}else if($type_register == 14){
							$html .= '	
								<b>Razão Social:</b>'.$order->customer['firstname'] . '<br />
								<b>Nome Fantasia:</b>' . $order->customer['lastname'].'<br />
								<b>CNPJ:</b>'.$order->customer['cpf'].'<br />
								<b>IE:</b>'.$order->customer['rg'].'<br />
								<b>Responsável:</b>'.$order->delivery['company'].'<br />
								<b>E-mail:</b>'.$order->customer['email_address'].'<br />
								<b>Endereço:</b>'.$order->customer['street_address'].','.$order->customer['street_number'].' - '.$order->customer['suburb'].', '.$order->customer['complemento'].' / '.$order->customer['city'].' - '.$order->customer['state'].' ['.$order->customer['postcode'].']<br />
								<b>Telefone:</b>'.$order->customer['telephone'].'<br />
								<b>Tel. Comercial:</b>'.$order->customer['telephone_comercial'].'<br />
								<b>Tel. Celular:</b>'.$order->customer['telephone_celular'].'<br />';
							}
							$html .= '	
								</td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                </table>

            </td>
          </tr>
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Calibri">
                  <tr>
                    <td width="82%" style="font-size:15px; color:#000; vertical-align:bottom; padding-top:10px;padding-bottom:10px; line-height:20px; text-align:left">
                    	<span style="font-size:38px; color:#000;">'.substr(HTTP_SERVER,7).'</span><BR /><BR />
                        '.nl2br(STORE_NAME_ADDRESS).'
                    </td>
                    <td width="18%"><img src="'.HTTP_SERVER.'/images/mail/pedido-icon5.gif" /></td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
			<td style="text-align:center; font-size:13px; font-family:Tahoma; padding:10px color:#FFF">
            Muito obrigado pela sua preferência e compreensão!<br>
            Esperamos sua total satisfação na aquisição do seu produto Mudominhacasa - Adesivos Decorativos
            </td>
		  </tr>
</table>';

tep_sendMailOrders(SEND_EXTRA_ORDER_EMAILS_TO, sprintf(EMAIL_TEXT_SUBJECT, EMAIL_FROM, STORE_NAME), $html, EMAIL_FROM, STORE_OWNER_EMAIL_ADDRESS);
}
		

// load the after_process function from the payment modules
  $payment_modules->after_process();

  $cart->reset(true);

// unregister session variables used during checkout
  tep_session_unregister('sendto');
  tep_session_unregister('billto');
  tep_session_unregister('shipping');
  tep_session_unregister('payment');
  tep_session_unregister('comments');
  
  //kgt - discount coupons
  tep_session_unregister('coupon');
//end kgt - discount coupons  

  tep_redirect(tep_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
