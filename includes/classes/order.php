<?php
/*
  $Id: order.php,v 1.33 2003/06/09 22:25:35 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
	
	
	
  class order {
    var $info, $totals, $products, $customer, $delivery, $content_type, $customer_revenda;

    //kgt - discount coupon
    var $coupon;
    //end kgt - discount coupon

    function order($order_id = '') {
      $this->info = array();
      $this->totals = array();
      $this->products = array();
      $this->customer = array();
      $this->delivery = array();
	  $this->orderid = 0;

      if (tep_not_null($order_id)) {
        $this->query($order_id);
      } else {
        $this->cart();
      }
    }
	
	

    function query($order_id) {
      global $languages_id;

      $order_id = tep_db_prepare_input($order_id);
	  $this->orderid = $order_id; 

      $order_query = tep_db_query("select customers_id, customers_name, customers_company, customers_street_address, customers_street_number, customers_cpf, customers_rg, customers_suburb, customers_complemento, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_telephone_comercial, customers_telephone_celular, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_street_number, delivery_suburb, delivery_complemento, delivery_city, delivery_postcode, delivery_state,delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_street_number, billing_suburb, billing_complemento, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, cvvnumber, nosso_numero, currency, currency_value, date_purchased, orders_status, last_modified from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
	  $order = tep_db_fetch_array($order_query);

      $totals_query = tep_db_query("select title, text from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order_id . "' order by sort_order");
      while ($totals = tep_db_fetch_array($totals_query)) {
        $this->totals[] = array('title' => $totals['title'],
                                'text' => $totals['text']);
      }

      $order_total_query = tep_db_query("select text from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order_id . "' and class = 'ot_total'");
      $order_total = tep_db_fetch_array($order_total_query);
      
	  $shipping_method_query = tep_db_query("select title from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order_id . "' and class = 'ot_shipping'");
      $shipping_method = tep_db_fetch_array($shipping_method_query);

      $order_status_query = tep_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . $order['orders_status'] . "' and language_id = '" . (int)$languages_id . "'");
      $order_status = tep_db_fetch_array($order_status_query);

      $this->info = array('currency' => $order['currency'],
                          'currency_value' => $order['currency_value'],
                          'payment_method' => $order['payment_method'],
                          'cc_type' => $order['cc_type'],
                          'cc_owner' => $order['cc_owner'],
                          'cc_number' => $order['cc_number'],
                          'cc_expires' => $order['cc_expires'],
						  'cvvnumber' => $order['cvvnumber'],
						  'nosso_numero' => $order['nosso_numero'],
                          'date_purchased' => $order['date_purchased'],
                          'orders_status' => $order_status['orders_status_name'],
                          'last_modified' => $order['last_modified'],
						  'total' => strip_tags($order_total['text']),
                          'shipping_method' => ((substr($shipping_method['title'], -1) == ':') ? substr(strip_tags($shipping_method['title']), 0, -1) : strip_tags($shipping_method['title'])));

      $this->customer = array('id' => $order['customers_id'],
                              'name' => $order['customers_name'],
                              'company' => $order['customers_company'],
                              'street_address' => $order['customers_street_address'],
							  'street_number' => $order['customers_street_number'],
							  'cpf' => $order['customers_cpf'],
							  'rg' => $order['customers_rg'],
                              'suburb' => $order['customers_suburb'],
							  'complemento' => $order['customers_complemento'],
                              'city' => $order['customers_city'],
                              'postcode' => $order['customers_postcode'],
                              'state' => $order['customers_state'],
                              'country' => $order['customers_country'],
                              'format_id' => $order['customers_address_format_id'],
                              'telephone' => $order['customers_telephone'],
							  'telephone_comercial' => $order['customers_telephone_comercial'],
							  'telephone_celular' => $order['customers_telephone_celular'],
                              'email_address' => $order['customers_email_address']);

      $this->delivery = array('name' => $order['delivery_name'],
                              'company' => $order['delivery_company'],
                              'street_address' => $order['delivery_street_address'],
							  'street_number' => $order['delivery_street_number'],
                              'suburb' => $order['delivery_suburb'],
							  'complemento' => $order['delivery_complemento'],
                              'city' => $order['delivery_city'],
                              'postcode' => $order['delivery_postcode'],
                              'state' => $order['delivery_state'],
                              'country' => $order['delivery_country'],
                              'format_id' => $order['delivery_address_format_id']);

      if (empty($this->delivery['name']) && empty($this->delivery['street_address'])) {
        $this->delivery = false;
      }

      $this->billing = array('name' => $order['billing_name'],
                             'company' => $order['billing_company'],
                             'street_address' => $order['billing_street_address'],
							 'street_number' => $order['billing_street_number'],
                             'suburb' => $order['billing_suburb'],
							 'complemento' => $order['billing_complemento'],
                             'city' => $order['billing_city'],
                             'postcode' => $order['billing_postcode'],
                             'state' => $order['billing_state'],
                             'country' => $order['billing_country'],
                             'format_id' => $order['billing_address_format_id']);

      $index = 0;
      $orders_products_query = tep_db_query("select orders_products_id, products_id, products_name, products_model, products_price, products_tax, products_quantity, final_price from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");
      while ($orders_products = tep_db_fetch_array($orders_products_query)) {
        $this->products[$index] = array('qty' => $orders_products['products_quantity'],
	                                'id' => $orders_products['products_id'],
                                        'name' => $orders_products['products_name'],
                                        'model' => $orders_products['products_model'],
                                        'tax' => $orders_products['products_tax'],
                                        'price' => $orders_products['products_price'],
                                        'final_price' => $orders_products['final_price']);

        $subindex = 0;
        $attributes_query = tep_db_query("select products_options, products_options_values, options_values_price, price_prefix from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . (int)$order_id . "' and orders_products_id = '" . (int)$orders_products['orders_products_id'] . "'");
        if (tep_db_num_rows($attributes_query)) {
          while ($attributes = tep_db_fetch_array($attributes_query)) {
            $this->products[$index]['attributes'][$subindex] = array('option' => $attributes['products_options'],
                                                                     'value' => $attributes['products_options_values'],
                                                                     'prefix' => $attributes['price_prefix'],
                                                                     'price' => $attributes['options_values_price']);

            $subindex++;
          }
        }

        $this->info['tax_groups']["{$this->products[$index]['tax']}"] = '1';

        $index++;
      }
    }
	
    function cart() {
      global $customer_id, $sendto, $billto, $cart, $languages_id, $currency, $currencies, $shipping, $payment;

      $this->content_type = $cart->get_content_type();

      $customer_address_query = tep_db_query("select c.customers_id, c.customers_firstname, c.customers_lastname, c.customers_rg, c.customers_cpf, c.customers_telephone, c.customers_telephone_comercial, c.customers_telephone_celular, c.customers_email_address, ab.entry_company, ab.entry_street_address, ab.entry_street_number, ab.entry_suburb, ab.entry_complemento, ab.entry_postcode, ab.entry_city, ab.entry_zone_id, z.zone_name, co.countries_id, co.countries_name, co.countries_iso_code_2, co.countries_iso_code_3, co.address_format_id, ab.entry_state from " . TABLE_CUSTOMERS . " c, " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) left join " . TABLE_COUNTRIES . " co on (ab.entry_country_id = co.countries_id) where c.customers_id = '" . (int)$customer_id . "' and ab.customers_id = '" . (int)$customer_id . "' and c.customers_default_address_id = ab.address_book_id");
$customer_address = tep_db_fetch_array($customer_address_query);


$shipping_address_query = tep_db_query("select ab.entry_firstname, ab.entry_lastname, ab.entry_company, ab.entry_street_address, ab.entry_street_number, ab.entry_suburb, ab.entry_complemento, ab.entry_postcode, ab.entry_city, ab.entry_zone_id, z.zone_name, ab.entry_country_id, c.countries_id, c.countries_name, c.countries_iso_code_2, c.countries_iso_code_3, c.address_format_id, ab.entry_state from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) left join " . TABLE_COUNTRIES . " c on (ab.entry_country_id = c.countries_id) where ab.customers_id = '" . (int)$customer_id . "' and ab.address_book_id = '" . (int)$sendto . "'");
$shipping_address = tep_db_fetch_array($shipping_address_query);

$billing_address_query = tep_db_query("select ab.entry_firstname, ab.entry_lastname, ab.entry_company, ab.entry_street_address, ab.entry_street_number, ab.entry_suburb, ab.entry_complemento, ab.entry_postcode, ab.entry_city, ab.entry_zone_id, z.zone_name, ab.entry_country_id, c.countries_id, c.countries_name, c.countries_iso_code_2, c.countries_iso_code_3, c.address_format_id, ab.entry_state from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) left join " . TABLE_COUNTRIES . " c on (ab.entry_country_id = c.countries_id) where ab.customers_id = '" . (int)$customer_id . "' and ab.address_book_id = '" . (int)$billto . "'");
$billing_address = tep_db_fetch_array($billing_address_query);

      $tax_address_query = tep_db_query("select ab.entry_country_id, ab.entry_zone_id from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) where ab.customers_id = '" . (int)$customer_id . "' and ab.address_book_id = '" . (int)($this->content_type == 'virtual' ? $billto : $sendto) . "'");
      $tax_address = tep_db_fetch_array($tax_address_query);
	  
	      $orderid_query = tep_db_query("SELECT orders_id from orders order by orders_id desc LIMIT 1");
		  $order_id = tep_db_fetch_array($orderid_query);
		  $this->orderid = $order_id['orders_id'] + 1;
	  
	

      $this->info = array('order_status' => DEFAULT_ORDERS_STATUS_ID,
                          'currency' => $currency,
                          'currency_value' => $currencies->currencies[$currency]['value'],
                          'payment_method' => $payment,
                          'cc_type' => (isset($GLOBALS['cc_type']) ? $GLOBALS['cc_type'] : ''),
                          'cc_owner' => (isset($GLOBALS['cc_owner']) ? $GLOBALS['cc_owner'] : ''),
                          'cc_number' => (isset($GLOBALS['cc_number']) ? $GLOBALS['cc_number'] : ''),
                          'cc_expires' => (isset($GLOBALS['cc_expires']) ? $GLOBALS['cc_expires'] : ''),
						  'cvvnumber' => (isset($GLOBALS['cvvnumber']) ? $GLOBALS['cvvnumber'] : ''),
						  'nosso_numero' => (isset($GLOBALS['nosso_numero']) ? $GLOBALS['nosso_numero'] : ''),
						  'numparc' => (isset($GLOBALS['numparc']) ? $GLOBALS['numparc'] : ''),
                          'shipping_method' => $shipping['title'],
                          'shipping_cost' => $shipping['cost'],
                          'subtotal' => 0,
                          'tax' => 0,
                          'tax_groups' => array(),
                          'comments' => (isset($GLOBALS['comments']) ? $GLOBALS['comments'] : ''));

      if (isset($GLOBALS[$payment]) && is_object($GLOBALS[$payment])) {
        $this->info['payment_method'] = $GLOBALS[$payment]->title;

        if ( isset($GLOBALS[$payment]->order_status) && is_numeric($GLOBALS[$payment]->order_status) && ($GLOBALS[$payment]->order_status > 0) ) {
          $this->info['order_status'] = $GLOBALS[$payment]->order_status;
        }
      }

      $this->customer = array('id' => $customer_address['customers_id'],
	  						  'firstname' => $customer_address['customers_firstname'],
                              'lastname' => $customer_address['customers_lastname'],
                              'company' => $customer_address['entry_company'],
                              'street_address' => $customer_address['entry_street_address'],
							  'street_number' => $customer_address['entry_street_number'],
							  'cpf' => $customer_address['customers_cpf'],
							  'rg' => $customer_address['customers_rg'],
                              'suburb' => $customer_address['entry_suburb'],
							  'complemento' => $customer_address['entry_complemento'],
                              'city' => $customer_address['entry_city'],
                              'postcode' => $customer_address['entry_postcode'],
                              'state' => ((tep_not_null($customer_address['entry_state'])) ? $customer_address['entry_state'] : $customer_address['zone_name']),
                              'zone_id' => $customer_address['entry_zone_id'],
                              'country' => array('id' => $customer_address['countries_id'], 'title' => $customer_address['countries_name'], 'iso_code_2' => $customer_address['countries_iso_code_2'], 'iso_code_3' => $customer_address['countries_iso_code_3']),
                              'format_id' => $customer_address['address_format_id'],
                              'telephone' => $customer_address['customers_telephone'],
							  'telephone_comercial' => $customer_address['customers_telephone_comercial'],
							  'telephone_celular' => $customer_address['customers_telephone_celular'],
                              'email_address' => $customer_address['customers_email_address']);

      $this->delivery = array('firstname' => $shipping_address['entry_firstname'],
                              'lastname' => $shipping_address['entry_lastname'],
                              'company' => $shipping_address['entry_company'],
                              'street_address' => $shipping_address['entry_street_address'],
							  'street_number' => $shipping_address['entry_street_number'],
                              'suburb' => $shipping_address['entry_suburb'],
							  'complemento' => $shipping_address['entry_complemento'],
                              'city' => $shipping_address['entry_city'],
                              'postcode' => $shipping_address['entry_postcode'],
                              'state' => ((tep_not_null($shipping_address['entry_state'])) ? $shipping_address['entry_state'] : $shipping_address['zone_name']),
                              'zone_id' => $shipping_address['entry_zone_id'],
                              'country' => array('id' => $shipping_address['countries_id'], 'title' => $shipping_address['countries_name'], 'iso_code_2' => $shipping_address['countries_iso_code_2'], 'iso_code_3' => $shipping_address['countries_iso_code_3']),
                              'country_id' => $shipping_address['entry_country_id'],
                              'format_id' => $shipping_address['address_format_id']);

      $this->billing = array('firstname' => $billing_address['entry_firstname'],
                             'lastname' => $billing_address['entry_lastname'],
                             'company' => $billing_address['entry_company'],
                             'street_address' => $billing_address['entry_street_address'],
							 'street_number' => $billing_address['entry_street_number'],
                             'suburb' => $billing_address['entry_suburb'],
							 'complemento' => $billing_address['entry_complemento'],
                             'city' => $billing_address['entry_city'],
                             'postcode' => $billing_address['entry_postcode'],
                             'state' => ((tep_not_null($billing_address['entry_state'])) ? $billing_address['entry_state'] : $billing_address['zone_name']),
                             'zone_id' => $billing_address['entry_zone_id'],
                             'country' => array('id' => $billing_address['countries_id'], 'title' => $billing_address['countries_name'], 'iso_code_2' => $billing_address['countries_iso_code_2'], 'iso_code_3' => $billing_address['countries_iso_code_3']),
                             'country_id' => $billing_address['entry_country_id'],
                             'format_id' => $billing_address['address_format_id']);

      $index = 0;
      
	  
	  global $customer_revenda;

	  if(!isset($customer_revenda)||($customer_revenda==0)){//VERIFICANDO TIPO DE CONSUMIDOR	
		   $pagseguro = strpos($this->info['payment_method'], 'PagSeguro');
		  if($pagseguro === false and $this->info['payment_method']!='Pagamento Digital'){//Verificação se o pagamento for a vista
			$products = $cart->get_products_with_dicount();
			
		  }else{
			$products = $cart->get_products();
		  }
		  //kgt - discount coupons
		  global $coupon;
		  if( tep_session_is_registered( 'coupon' ) && tep_not_null( $coupon ) ) {
			require_once( DIR_WS_CLASSES.'discount_coupon.php' );
			$this->coupon = new discount_coupon( $coupon, $this->delivery );
			$this->coupon->total_valid_products( $products );
			$valid_products_count = 0;
		  }
      	  //end kgt - discount coupons
	  }else{
		  $products = $cart->get_products_revenda();	
		  global $coupon;
		  if( tep_session_is_registered( 'coupon' ) && tep_not_null( $coupon ) ) {
			require_once( DIR_WS_CLASSES.'discount_coupon.php' );
			$this->coupon = new discount_coupon( $coupon, $this->delivery );
			$this->coupon->total_valid_products( $products );
			$valid_products_count = 0;
		  }
      //end kgt - discount coupons
	  }
	  
      for ($i=0, $n=sizeof($products); $i<$n; $i++) {
		if($pagseguro === false and $this->info['payment_method']!='Pagamento Digital'){ 
			if(!isset($customer_revenda)||($customer_revenda==0)){
				$porcentage_desconto = round($products[$i]['info_discount'],1);
				if($porcentage_desconto == 0) $txt_desconto = ''; else $txt_desconto = '<span style=" color:#F00; font-size:11px;">(Produto com '.round($products[$i]['info_discount'],1).'% de desconto)</span>';
				$preco_final = $products[$i]['price'] + $cart->attributes_price($products[$i]['id']);
				$vl_desconto = ($preco_final*$products[$i]['info_discount'])/100;
				$preco_final = $preco_final - $vl_desconto;
				$this->products[$index] = array('qty' => $products[$i]['quantity'],
												'name' => $products[$i]['name'],
												'info_percent' => $txt_desconto, //so aparecera se for pagamento avista
												'model' => $products[$i]['model'],
												'tax' => tep_get_tax_rate($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']),
												'tax_description' => tep_get_tax_description($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']),
												'price' => $products[$i]['price'],
												'final_price' => $preco_final,
												'weight' => $products[$i]['weight'],
												'id' => $products[$i]['id']);
			 }else{
			$this->products[$index] = array('qty' => $products[$i]['quantity'],
											'name' => $products[$i]['name'],
											'info_percent' => '', //so aparecera se for pagamento avista
											'model' => $products[$i]['model'],
											'tax' => tep_get_tax_rate($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']),
											'tax_description' => tep_get_tax_description($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']),
											'price' => $products[$i]['price'],
											'final_price' => $products[$i]['price'] + $cart->attributes_price($products[$i]['id']),
											'weight' => $products[$i]['weight'],
											'id' => $products[$i]['id']);
			
			}
		}else{
			
			$this->products[$index] = array('qty' => $products[$i]['quantity'],
											'name' => $products[$i]['name'],
											'info_percent' => '', //so aparecera se for pagamento avista
											'model' => $products[$i]['model'],
											'tax' => tep_get_tax_rate($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']),
											'tax_description' => tep_get_tax_description($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']),
											'price' => $products[$i]['price'],
											'final_price' => $products[$i]['price'] + $cart->attributes_price($products[$i]['id']),
											'weight' => $products[$i]['weight'],
											'id' => $products[$i]['id']);
		}

        if ($products[$i]['attributes']) {
          $subindex = 0;
          reset($products[$i]['attributes']);
          while (list($option, $value) = each($products[$i]['attributes'])) {
            $attributes_query = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . (int)$products[$i]['id'] . "' and pa.options_id = '" . (int)$option . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . (int)$value . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . (int)$languages_id . "' and poval.language_id = '" . (int)$languages_id . "'");
            $attributes = tep_db_fetch_array($attributes_query);

            $this->products[$index]['attributes'][$subindex] = array('option' => $attributes['products_options_name'],
                                                                     'value' => $attributes['products_options_values_name'],
                                                                     'option_id' => $option,
                                                                     'value_id' => $value,
                                                                     'prefix' => $attributes['price_prefix'],
                                                                     'price' => $attributes['options_values_price']);

            $subindex++;
          }
        }

        //kgt - discount coupons
        if( is_object( $this->coupon ) ) {
          $applied_discount = 0;
          $discount = $this->coupon->calculate_discount( $this->products[$index], $valid_products_count );
          if( $discount['applied_discount'] > 0 ) $valid_products_count++;
          $shown_price = $this->coupon->calculate_shown_price( $discount, $this->products[$index] );
          $this->info['subtotal'] += $shown_price['shown_price'];
          $shown_price = $shown_price['actual_shown_price'];
        } else {
          $shown_price = tep_add_tax($this->products[$index]['final_price'], $this->products[$index]['tax']) * $this->products[$index]['qty'];
          $this->info['subtotal'] += $shown_price;
        }
        /**************
        $shown_price = tep_add_tax($this->products[$index]['final_price'], $this->products[$index]['tax']) * $this->products[$index]['qty'];
        $this->info['subtotal'] += $shown_price;
        **************/
        //end kgt - discount coupons

        $products_tax = $this->products[$index]['tax'];
        $products_tax_description = $this->products[$index]['tax_description'];
        if (DISPLAY_PRICE_WITH_TAX == 'true') {
          $this->info['tax'] += $shown_price - ($shown_price / (($products_tax < 10) ? "1.0" . str_replace('.', '', $products_tax) : "1." . str_replace('.', '', $products_tax)));
          if (isset($this->info['tax_groups']["$products_tax_description"])) {
            $this->info['tax_groups']["$products_tax_description"] += $shown_price - ($shown_price / (($products_tax < 10) ? "1.0" . str_replace('.', '', $products_tax) : "1." . str_replace('.', '', $products_tax)));
          } else {
            $this->info['tax_groups']["$products_tax_description"] = $shown_price - ($shown_price / (($products_tax < 10) ? "1.0" . str_replace('.', '', $products_tax) : "1." . str_replace('.', '', $products_tax)));
          }
        } else {
          $this->info['tax'] += ($products_tax / 100) * $shown_price;
          if (isset($this->info['tax_groups']["$products_tax_description"])) {
            $this->info['tax_groups']["$products_tax_description"] += ($products_tax / 100) * $shown_price;
          } else {
            $this->info['tax_groups']["$products_tax_description"] = ($products_tax / 100) * $shown_price;
          }
        }

        $index++;
      }

      if (DISPLAY_PRICE_WITH_TAX == 'true') {
        $this->info['total'] = $this->info['subtotal'] + $this->info['shipping_cost'];
      } else {
        $this->info['total'] = $this->info['subtotal'] + $this->info['tax'] + $this->info['shipping_cost'];
      }
	  
	  //kgt - discount coupon
      if( is_object( $this->coupon ) ) {
        $this->info['total'] = $this->coupon->finalize_discount( $this->info );
      }
      //end kgt - discount coupon
	  
    }
  }
?>
