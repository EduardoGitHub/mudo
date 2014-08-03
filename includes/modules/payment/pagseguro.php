<?php
/*******************************************************************************************************
*
* pagseguro.php 12/03/2006
*
* Módulo de Pagamento osCommerce 2.2 para aprovar Cartões de Crédito através do serviço PagSeguro brasileiro
*
* Author: Claudio H. Imai <imai@creativstudios.org>
* March, 2006
*
* Copyright (c) 2006 Creativstudios Web Solutions <suporte@creativstudios.org>
* Copyright (c) 2002 osCommerce
*
* Released under the GNU General Public License
* 
* versão 1.5
* Descrição:
* Adicionado um campo de status dos pedidos com pagamento aprovado.
* O módulo anterior não separava entre pagamentos em aberto ou aprovados, tendo de ser alterado manualmente
* no momento do processamento do pedido.
* Isso significava que se a loja vende produtos por download, o cliente deveria esperar a autorização manual
* do pagamento.
* Corrigida a atualização do pedido no segundo post do servidor. Agora é feito logo após o primeiro POST, porque o método anterior
* não atualizava o status do pedido se o cliente fechasse a janela antes de voltar para a loja.
* 
* em aberto: Foram criados dois novos campos para serem valores a somar no pedido, a fim de cobrir as
* taxas cobradas pelo PagSeguro ao lojista. Notificar ao comprador dessa possibilidade, se o lojista optar
* pelo uso desses valores.
* 
* Atualização:
* 1. DESINSTALE o módulo anterior da loja (na administração);
* 2. sobrescreva os arquivos referentes ao módulo, via ftp;
* 3. reinstale o módulo novo;
* 4. crie um novo status de pedido para pagamentos aprovados;
* 5. Reconfigure o módulo como descrito nas instruções de instalação, tomando o cuidado de alterar o campo de "Pedidos aprovados" de acordo com sua configuração.
*
* Em caso de dúvidas, verique nossa documentação em www.creativstudios.org ou no forum.
********************************************************************************************************/
  class pagseguro {
    var $code, $title, $description, $enabled;
// class constructor
    function pagseguro() {
      global $order;
      $this->code = 'pagseguro';
      $this->title = MODULE_PAYMENT_PAGSEGURO_TEXT_TITLE;
	  $this->revenda = MODULE_PAYMENT_PAGSEGURO_TEXT_ENABLE_REVENDA;
	  $this->normaluser = MODULE_PAYMENT_PAGSEGURO_TEXT_ENABLE_USERFINAL;
      $this->description = MODULE_PAYMENT_PAGSEGURO_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PAGSEGURO_SORT_ORDER;
      $this->enabled = true; //((MODULE_PAYMENT_PAGSEGURO_STATUS == 'True') ? true : false);
      if ((int)MODULE_PAYMENT_PAGSEGURO_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PAGSEGURO_ORDER_STATUS_ID;
      }
      if (is_object($order)) $this->update_status();
// URL for transaction. In this case, the parameters are sent to a CGI, so the URL is checkout_process.php
// If the parameters were to be sent as POST variables, the URL would be different. See paypal_ipn contribution for an example.
// Claudio Mar, 18th, 2006
//      $this->form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true);
      $this->form_action_url = "https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx";
    }
// class methods
    function update_status() {
      global $order;
      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAGSEGURO_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAGSEGURO_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }
        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }
    function javascript_validation() {
      return true;
    }
/*******************************************************************************
* function to handle options before exchanging data with the payment gateway
* Payment information screen
* ******************************************************************************/
    function selection() {
      global $order;
      $shipping_cost = $order->info['shipping_cost'];
      $pagseguro_image = "http://pagseguro.uol.com.br/Imagens/".(MODULE_PAYMENT_PAGSEGURO_CREDIT_CARD=='True'?"btnWebprefC.gif":"btnWebpref.gif");
      $fields = array();
      $fields[] = array('title' => 'Finalize sua compra no ambiente do PagSeguro e evite fraudes com seu cartão de crédito. Clique no botão continuar na parte inferior da Loja Virtual que no final de sua compra você será redirecionado para um ambiente <b>SEGURO</b> onde poderá escolher a forma de pagamento que melhor atende. Qualquer dúvida entre em contato com a Loja Virtual.',
                        'text'  => "Finalize seu pagamento no site seguro do PagSeguro, e proteja-se de fraudes.");
      $fields[] = array('title' => '',
                        'text'  => '');
      $fields[] = array('title' => '',
                        'text'  => '');
      if (MODULE_PAYMENT_PAGSEGURO_SHIPPING=="True") { // Cálculo do frete pelo PagSeguro habilitado
          $tipoFretes = array (array('id' => 'EN',
                                     'text' => 'PAC'),
                               array('id' => 'SD',
                                     'text' => 'Sedex'));
          if (($shipping_cost>0)&&false) { // desativado enquanto não aceita escolha caso a caso.
              $fields[] = array('title' => "&nbsp;&nbsp;Cálculo de frete padrão",
                                'field' => tep_draw_radio_field("calcfrete", "LOJA", TRUE));
              $fields[] = array('title' => "&nbsp;&nbsp;Cálculo de frete pelo PagSeguro",
                                'field' => tep_draw_radio_field("calcfrete", "PAGSEGURO"));
          } else {
              $fields[] = array('title' => "&nbsp;&nbsp;Cálculo de frete pelo PagSeguro",
                                'field' => tep_draw_hidden_field("calcfrete", "PAGSEGURO", true));
          }
          $fields[] = array('title' => '&nbsp;&nbsp;&nbsp;&nbsp;Tipo de frete',
                            'field' => tep_draw_pull_down_menu('TipoFrete', $tipoFretes));
      }
      $selection = array('id' => $this->code,
                         'module' => $this->title,
						 'userrevenda' => $this->revenda,
				   		 'usernormal' => $this->normaluser,
                         'fields' => $fields);
      return $selection;
    }
/*************************************************************
* Checks the data in the Payment selection screen
* Validate data from this->selection() function
* if data is incorrect, return to checkout payment screen
* and prompt user for the incorrect data.
* ************************************************************/
    function pre_confirmation_check() {
		return false;
    }
/******************************************
* Function in the order confirmation screen
* *****************************************/
    function confirmation() {
      global $cartID, $cart_pagseguro_ID, $customer_id, $languages_id, $order, $order_total_modules, $insert_id;
      $confirmation = array('title' => $this->title . ': ',
                            'fields' => array(array('title' => MODULE_PAYMENT_PAGSEGURO_TEXT_OUTSIDE,
                                                    'field' => "")));

      return $confirmation;
    }
    function get_uf(){
       global $order;
        $res = tep_db_fetch_array($qry=tep_db_query('select countries_id from '.TABLE_COUNTRIES.' where countries_name="Brazil" or countries_name="Brasil"'));
        $br_id = $res['countries_id']; // código do Brasil. em caso da loja ter usado outro código interno.
        $res = tep_db_fetch_array($qry=tep_db_query('select zone_code from '.TABLE_ZONES.' where zone_country_id="'.$br_id.'" and zone_name="'.$order->delivery['state'].'"'));
        return $res['zone_code'];
    }
    function process_button() {
      global $order, $cart, $currencies, $cartID, $cart_pagseguro_ID, $insert_id, $customer_id;
	  $currency = MODULE_PAYMENT_PAGSEGURO_CURRENCY; // Somente reais
      // removes non numeric characters from the telephone field, and trims to 8 chars long.
      $cust_telephone = eregi_replace ("[^0-9]", "", $order->customer['telephone']);
      $st = strlen($cust_telephone)-8;
	  $ddd= substr($cust_telephone,0,2);
      if ($st>0) { // in case this string is longer than 8 characters (PagSeguro's settings)
          $cust_telephone = substr($cust_telephone, $st, 8);
      }
      $UF = $this->get_uf();
      $CEP = substr(eregi_replace ("[^0-9]", "", $order->customer['postcode']).'00000000',0,8);
	  $insert_id = substr($cart_pagseguro_ID, strpos($cart_pagseguro_ID, '-')+1);
      $process_button_string = tep_draw_hidden_field('email_cobranca', 'pedidos@mudominhacasa.com.br') . "\n" .// email de cobrança, definido no admin
                               tep_draw_hidden_field('tipo', 'CP') . "\n" .  // Carrinho prório
                               tep_draw_hidden_field('moeda', 'BRL') . "\n" .// Somente Reais
                               tep_draw_hidden_field('cliente_nome', $order->customer['firstname']. " " . $order->customer['lastname']) . "\n" .
                               tep_draw_hidden_field('cliente_cep', $CEP) . "\n" .
                               tep_draw_hidden_field('cliente_end', $order->delivery['street_address']) . "\n" .
                               tep_draw_hidden_field('cliente_bairro', $order->delivery['suburb']) . "\n" .
                               tep_draw_hidden_field('cliente_cidade', $order->delivery['city']) . "\n" .
							   tep_draw_hidden_field('cliente_num', $order->customer['street_number']) . "\n" .
							   tep_draw_hidden_field('cliente_compl', $order->customer['complemento']) . "\n" .
                               tep_draw_hidden_field('cliente_uf', $UF) . "\n" .
                               tep_draw_hidden_field('cliente_pais', 'BRA') . "\n" .
                               tep_draw_hidden_field('cliente_ddd', $ddd) . "\n" .
							   tep_draw_hidden_field('cliente_tel', $cust_telephone) . "\n" .
                               tep_draw_hidden_field('cliente_email', $order->customer['email_address'])."\n";
	  
	  $order_subtotal = 0; // calcula o somatório dos valores dos produtos
	  
      for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
          $process_button_string .= tep_draw_hidden_field('item_id_'.($i+1),    $order->products[$i]['id']) . "\n" .
		                            tep_draw_hidden_field('item_descr_'.($i+1), $order->products[$i]['name'].(strlen($order->products[$i]['model'])>0?'['.$order->products[$i]['model'].']':'')) ."\n" .
		                            tep_draw_hidden_field('item_quant_'.($i+1), $order->products[$i]['qty']) ."\n" .
		                            tep_draw_hidden_field('item_valor_'.($i+1), round($order->products[$i]['final_price'], 2) *100)."\n";

          //$order_subtotal += $order->products[$i]['qty'] * $order->products[$i]['final_price']* $currencies->get_value($currency)*100;
		  $order_subtotal += $order->products[$i]['qty'] * round($order->products[$i]['final_price'], 2)*100;
       	  if (MODULE_PAYMENT_PAGSEGURO_SHIPPING=='True') {
              $process_button_string .= tep_draw_hidden_field('item_peso_'.($i+1),    (int)($order->products[$i]['weight']*(MODULE_PAYMENT_PAGSEGURO_WEIGHT=='Kg'?1000:1))) . "\n";
       	  }
	  }
	  // campo para informar os descontos / acréscimos extras do pedido
	     // $retificacao = ($order->info['total'] - $order->info['shipping_cost'])* $currencies->get_value($currency)*100- $order_subtotal ;
	      $retificacao = ($order->info['total'] - $order->info['shipping_cost'])*100- $order_subtotal ;
	      if ((int)$retificacao!=0) {
              $process_button_string .= tep_draw_hidden_field('extras', floor($retificacao))."\n";
	      }
      //
	  if (MODULE_PAYMENT_PAGSEGURO_SHIPPING=='True') {
         $process_button_string .= "\n".tep_draw_hidden_field('tipo_frete', $_POST['TipoFrete']) ."\n"; // EN: PAC; SD: Sedex
	  } else {
         //$process_button_string .= "\n".tep_draw_hidden_field('item_frete_1', round($order->info['shipping_cost']* $currencies->get_value($currency)*100)) ."\n";
		 $process_button_string .= "\n".tep_draw_hidden_field('item_frete_1', round($order->info['shipping_cost']*100)) ."\n";
      }
      $process_button_string .= tep_draw_hidden_field('ref_transacao', 'Pedido: '.$order->orderid.' - Cliente: '.$customer_id);
	  $this->debug_var($process_button_string, 'process: '.date("Y-m-d G:i:s"), true);
          if (tep_session_is_registered('INSERT_ID')) {
               tep_session_unregister('INSERT_ID');
          }
          $INSERT_ID = $insert_id;
          $_SESSION['INSERT_ID']= $insert_id;
          tep_session_register('INSERT_ID');
      return $process_button_string;
    }
	
    /*
	function before_process() {
	// chamado pelo checkout_process.php depois que a transaçào foi finalizada
      global $order, $cart, $sendto, $billto, $currencies;
        $tmp = explode('-',$_SESSION['cart_pagseguro_ID']);
        $insert_id = $tmp[1];
        $qry = tep_db_query ("select * from temp_pagseguro where referencia like 'PEDIDO: $insert_id - CLIENTE: %'");
		$order_array = tep_db_fetch_array($qry);
		$status = trim($order_array['statustransacao']);
        $ids = explode('-',$order_array['referencia']);
		$tmp = explode(':',$ids[0]);
$this->debug_var ($order_array, "Pedido(recuperado do bd): ".date("Y-m-d G:i:s"),true);
$this->debug_var ($status, "Status de pagamento: ".date("Y-m-d G:i:s"),true);
        $customer = explode(':',$ids[1]);
        $customer_id = trim($customer[1]);
		switch($status){
		    case 'Completo':
		    case 'Aprovado':
                    $order->info['order_status'] = MODULE_PAYMENT_PAGSEGURO_APPROVED_ORDER_STATUS_ID;
		    case 'Em Análise':
		    case 'Aguardando Pagto':
$this->debug_var ($order->info['order_status'].' - '.$status, "status do pagto: ".date("Y-m-d G:i:s"),true);
            		$order->info['comments'] .= "ID de Transação: ". $order_array['transacaoid'].
					                            "\nAnotação: ". $order_array['anotacao'].
            		                            "\nTipo do Pagamento: ". $order_array['tipopagamento'].
            									"\nStatus: ". $status.'-'.$order->info['order_status'];
                    include(DIR_WS_CLASSES . 'order_total.php');
                    $order_total_modules = new order_total;
                    $order_totals = $order_total_modules->process();
                    $order_id = $insert_id;
                    $sql_data_array = array('orders_id' => $order_id,
                                            'orders_status_id' => $order->info['order_status'],
                                            'date_added' => 'now()',
                                            'customer_notified' => (SEND_EMAILS == 'true') ? '1' : '0',
                                            'comments' => $order->info['comments']);
                    tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
                    // update orders table
                    $sql_data_array = array('orders_status' => $order->info['order_status']);
                    tep_db_perform(TABLE_ORDERS, $sql_data_array, 'update', "orders_id = '" . (int)$order_id . "'");
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
                        if ( ($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
                          tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
                        }
                      }
                    }
            // Update products_ordered (for bestsellers list)
                    tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
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
                        $products_ordered_attributes .= "\n\t" . $attributes_values['products_options_name'] . ' ' . $attributes_values['products_options_values_name'];
                      }
                    }
            //------insert customer choosen option eof ----
                    $total_weight += ($order->products[$i]['qty'] * $order->products[$i]['weight']);
                    $total_tax    += tep_calculate_tax($total_products_price, $products_tax) * $order->products[$i]['qty'];
                    $total_cost   += $total_products_price;
                    $products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . ' (' . $order->products[$i]['model'] . ') = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . $products_ordered_attributes . "\n";
                  }
            // lets start with the email confirmation
                  $email_order = STORE_NAME . "\n" .
                                 EMAIL_SEPARATOR . "\n" .
                                 EMAIL_TEXT_ORDER_NUMBER . ' ' . $order_id . "\n" .
                                 EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $order_id, 'SSL', false) . "\n" .
                                 EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";
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
                                    tep_address_label($customer_id, $sendto, 0, '', "\n") . "\n";
                  }
                  $email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
                                  EMAIL_SEPARATOR . "\n" .
                                  tep_address_label($customer_id, $billto, 0, '', "\n") . "\n\n";
                  if (is_object($$payment)) {
                    $email_order .= EMAIL_TEXT_PAYMENT_METHOD . "\n" .
                                    EMAIL_SEPARATOR . "\n".
            						EMAIL_TEXT_PAGSEGURO_WAIT. "\n";
                    $payment_class = $$payment;
                    $email_order .= $payment_class->title . "\n\n";
                    if ($payment_class->email_footer) {
                      $email_order .= $payment_class->email_footer . "\n\n";
                    }
                  }
                  tep_mail($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            // send emails to other people
                  if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
                    tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
                  }
            // load the after_process function from the payment modules
                  $this->after_process();
                  $cart->reset(true);
            // unregister session variables used during checkout
                  tep_session_unregister('sendto');
                  tep_session_unregister('billto');
                  tep_session_unregister('shipping');
                  tep_session_unregister('payment');
                  tep_session_unregister('comments');
                  tep_session_unregister('cart_pagseguro_ID');
                  tep_redirect(tep_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
            	  return false;
                break;
		    default:
                  $email_order = 'Pedido feito no '. STORE_NAME . "\n" .
                                 'Cliente: '. $order->customer['firstname'] . ' ' . $order->customer['lastname']. "\n" .
                                 EMAIL_SEPARATOR . "\n" .
                                 'Status do pagamento: '. $status . "\n" .
                                 EMAIL_TEXT_ORDER_NUMBER . ' ' . $order_id . "\n" .
                                 EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";
                  tep_mail(	STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'Pedido efetuado e pago no pagSeguro - email enviado para verificação do funcionamento', $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      		    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error='.urlencode('Ocorreu algum erro de comunicação com o servidor. Verifique se seu pagamento foi processado e entre em contato com a administração.'),'NONSSL', true, false));
		} // switch
		exit();
    }
	*/
	function before_process() {
      return false;
    }
    function after_process() {
      return false;
    }
    function get_error() {
		global $language;
		$error_text['title']='Erro:';
		$error_text['error']=urldecode($_GET['error']);
      return $error_text;
    }
    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAGSEGURO_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }
    function install() {
	  $sort_order = 1;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added) values ('Aprovacao de Pagamento - PagSeguro', 'MODULE_PAYMENT_PAGSEGURO_STATUS', 'True', ".
                   "'Voce deseja aprovar compras utilizando o PagSeguro?', '6', '".$sort_order."', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Email no PagSeguro', 'MODULE_PAYMENT_PAGSEGURO_EMAIL', 'seu@email.com', ".
                   "'Informar o email de cobrança registrado junto ao PagSeguro.', '6', '".$sort_order."', ".
                   "now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Token', 'MODULE_PAYMENT_PAGSEGURO_TOKEN', '0', ".
                   "'Código de segurança gerado manualmente no website do PagSeguro.', '6', '".$sort_order."', ".
                   "now())");
	  $sort_order++;  // Seleciona o código para a moeda padrão (em julho/2006 é Real, código = BRL, BR, etc)
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Moeda padrão', 'MODULE_PAYMENT_PAGSEGURO_CURRENCY', 'BR', ".
                   "'Código da moeda usado em seu site para o Real. Por ex.: BR, BRL, etc.', '6', '".$sort_order."', ".
                   "now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added) values ('Unidade de peso', 'MODULE_PAYMENT_PAGSEGURO_WEIGHT', 'KG', ".
                   "'Você deseja calcular o frete em KG ou gramas?', '6', '".$sort_order."', ".
                   "'tep_cfg_select_option(array(\'Kg\', \'gramas\'), ', now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added) values ('Cálculo do frete pelo PagSeguro?', 'MODULE_PAYMENT_PAGSEGURO_SHIPPING', 'True', ".
                   "'Você deseja calcular o frete através do site do PagSeguro?', '6', '".$sort_order."', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added)
                   values ('Aceita cartão?', 'MODULE_PAYMENT_PAGSEGURO_CREDIT_CARD', 'False', ".
                   "'Sua conta está configurada para aceitar cartões de crédito?', '6', '".$sort_order."', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  $sort_order++;
/*
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Valor adicional 1', 'MODULE_PAYMENT_PAGSEGURO_ABSOLUTE', '', ".
                   "'Valor absoluto a ser acrescentado no total do pedido.', '6', '".$sort_order."', ".
                   "now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Valor adicional 2', 'MODULE_PAYMENT_PAGSEGURO_PERCENT', '', ".
                   "'Valor percentual a acrescentar ao valor total do pedido.', '6', '".$sort_order."', ".
                   "now())");
	  $sort_order++;
*/
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Zonas suportadas', 'MODULE_PAYMENT_PAGSEGURO_ZONE', '0', ".
                   "'Se uma zona for selecionada, este meio de pagamento estará disponível somente para esta zona.', '6', '".$sort_order."', ".
                   "'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Status dos pedidos', 'MODULE_PAYMENT_PAGSEGURO_ORDER_STATUS_ID', '2', ".
                   "'Atualiza o status dos pedidos efetuados por este módulo de pagamento para este valor.', '6', '".$sort_order."', ".
                   "'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(', now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Pedidos aprovados', 'MODULE_PAYMENT_PAGSEGURO_APPROVED_ORDER_STATUS_ID', '2', ".
                   "'Atualiza o status dos pedidos aprovados por este módulo de pagamento para este valor.', '6', '".$sort_order."', ".
                   "'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(', now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added)".
                   "values ('Debug log', 'MODULE_PAYMENT_PAGSEGURO_DEBUG_LOG', 'False', ".
                   "'O módulo deve criar um log de debug na pasta EXT? Em caso afirmativo, dê permissão de escrita à pasta EXT. o arquivo debug.log conterá informações sobre a comunicação entre os servidores.', '6', '".$sort_order."', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  $sort_order++;
      tep_db_query("insert into " . TABLE_CONFIGURATION .
                   " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)
              values ('Email de debug', 'MODULE_PAYMENT_PAGSEGURO_DEBUG_EMAIL', '',
                      'Todos os parâmetros de uma notificação inválida serão enviados para este endereço de email se estiver presente.', '6', $sort_order, now())");
	  $sort_order++;
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário revendedor', 'MODULE_PAYMENT_PAGSEGURO_TEXT_ENABLE_REVENDA', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários revendedor?', '6', '".$sort_order."', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
			 $sort_order++;	   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário normal', 'MODULE_PAYMENT_PAGSEGURO_TEXT_ENABLE_USERFINAL', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários normais?', '6', '".$sort_order."', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");		  
	   $sort_order++;				   
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Ordem de exibição', 'MODULE_PAYMENT_PAGSEGURO_SORT_ORDER', '0', ".
                   "'Determina a ordem de exibição do meio de pagamento.', '6', '".$sort_order."', ".
                   "now())");
      tep_db_query("CREATE TABLE temp_pagseguro (
                        id INT( 13 ) NOT NULL AUTO_INCREMENT ,
                        vendedoremail VARCHAR( 200 ) NOT NULL ,
                        transacaoid VARCHAR( 40 ) NOT NULL ,
                        referencia VARCHAR( 128 ) NOT NULL ,
                        anotacao TEXT ,
                        datatransacao DATE NOT NULL ,
                        tipopagamento VARCHAR( 32 ) NOT NULL ,
                        statustransacao VARCHAR( 32 ) NOT NULL ,
                        clinome VARCHAR( 128 ) NOT NULL ,
                        cliemail VARCHAR( 128 ) NOT NULL ,
                        date_created datetime ,
                        PRIMARY KEY ( id ));"
                  );
    }
    function remove() {
       tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
       tep_db_query("drop table temp_pagseguro");
    }
    function keys() {
		$key_listing = array();
		$qry = "select configuration_key from " . TABLE_CONFIGURATION . " where LOCATE('MODULE_PAYMENT_PAGSEGURO_', configuration_key)>0 order by sort_order";
		$findkey = tep_db_query($qry);
		while($key = tep_db_fetch_array($findkey)){
			$key_listing[] = $key['configuration_key'];
		} // while
      return $key_listing;
    }
      function debug_var($var, $name="", $to_file=false){
        if ($to_file) {
            if (MODULE_PAYMENT_PAGSEGURO_DEBUG_LOG=='True') {
                if ($txt = @fopen('ext/debug.log','a')) {
                    fwrite($txt, "-----------------------------------\n");
                    fwrite($txt, $name."\n");
                    fwrite($txt,  print_r($var, true)."\n");
                    fclose($txt);
                }
            }
        } else {
             print('<br><b>'.$name.'</b><br>');
             echo '<pre>';
        	 print_r($var);
        	 echo '</pre>';
        }
      }
  }
?>
