<?php
/*
  pagamentodigital.php 22/01/2007
  Módulo de Pagamento osCommerce 2.2 para o Pagamento Digital
  Desenvolvido por http://www.webtask.com.br
  Programador: Luiz Fumes
*/

  class pagamentodigital {
    var $code, $title, $description, $enabled, $image;

    // classe construtora
    function pagamentodigital() {
      global $order;

      $this->code = 'pagamentodigital';
      $this->title = MODULE_PAYMENT_PD_TEXT_TITLE;
	  $this->revenda = MODULE_PAYMENT_PD_TEXT_ENABLE_REVENDA;
	  $this->normaluser = MODULE_PAYMENT_PD_TEXT_ENABLE_USERFINAL;
      $this->description = MODULE_PAYMENT_PD_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PD_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_PD_STATUS == 'True') ? true : false);
      $this->image = './pagamentoDigital/images/logoGrande.gif';

      if ((int)MODULE_PAYMENT_PD_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PD_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

     //$this->form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true);
	 $this->form_action_url = "https://www.pagamentodigital.com.br/checkout/pay/";
    }

    // metodos
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PD_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PD_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
      return false;
    }

    function selection() {
     return array('id' => $this->code,
                   'module' => '<img src="'.$this->image.'" border="0"> '.$this->title."<br /><span style=\"font-weight: normal; margin-left: 50px;\">(".$this->description.")</span>",
				   'userrevenda' => $this->revenda,
				   'usernormal' => $this->normaluser);

    }

    function pre_confirmation_check() {
    }

    function confirmation() {
      global $order, $insert_id;
      $confirmation = array('title' => $this->title,
                            'fields' => array(array('title' => MODULE_PAYMENT_PD_TEXT_FINALIZAR
                                                    )));
	  
	  $insert_id = tep_db_insert_id();
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
      // removes non numeric characters from the telephone field, and trims to 8 chars long.
      $cust_telephone = eregi_replace ("[^0-9]", "", $order->customer['telephone']);
      $st = strlen($cust_telephone)-8;
	  $ddd= substr($cust_telephone,0,2);
      if ($st>0) { // in case this string is longer than 8 characters (PagSeguro's settings)
          $cust_telephone = substr($cust_telephone, $st, 8);
      }
      $UF = $this->get_uf();
      $CEP = substr(eregi_replace ("[^0-9]", "", $order->customer['postcode']).'00000000',0,8);
	
      $process_button_string = tep_draw_hidden_field('email_loja',MODULE_PAYMENT_PD_EMAIL_LOJA) . "\n" .// email de cobrança, definido no admin
                               tep_draw_hidden_field('id_pedido', $insert_id) . "\n" . 
							   tep_draw_hidden_field('tipo_integracao', MODULE_PAYMENT_PD_TIPO_INTEGRACAO) . "\n" .
							   tep_draw_hidden_field('frete', number_format($order->info['shipping_cost'], 2, '.', '')) . "\n" .
							   tep_draw_hidden_field('tipo_frete', $order->info['shipping_method']) . "\n" . //nome do frete
							   tep_draw_hidden_field('email', $order->customer['email_address']) . "\n" .
							   tep_draw_hidden_field('nome', $order->customer['firstname']. " " . $order->customer['lastname']) . "\n" .
							   tep_draw_hidden_field('cpf', $order->customer['cpf']) . "\n" .
							   tep_draw_hidden_field('telefone', $cust_telephone) . "\n" .
							   tep_draw_hidden_field('endereco', $order->delivery['street_address'].' '.$order->customer['complemento'].' - '.$order->delivery['suburb']) . "\n" .
							   tep_draw_hidden_field('cidade', $order->delivery['city']) . "\n" .
							   tep_draw_hidden_field('estado', $UF) . "\n" .
							   tep_draw_hidden_field('cep', $CEP) . "\n" .
							   tep_draw_hidden_field('free',$insert_id) . "\n" .
							   tep_draw_hidden_field('url_retorno',MODULE_PAYMENT_PD_URL_RETORNO) . "\n" .
							   tep_draw_hidden_field('vencimento',MODULE_PAYMENT_PD_DIAS_VENCIMENTO_BOLETO) . "\n";
							   
							   
	  
	  //$order_subtotal = 0; 
	  // calcula o somatório dos valores dos produtos
	  
      for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
          $process_button_string .= tep_draw_hidden_field('produto_codigo_'.($i+1),     $order->products[$i]['id']) . "\n" .
		                            tep_draw_hidden_field('produto_descricao_'.($i+1),  $order->products[$i]['name'].(strlen($order->products[$i]['model'])>0?'['.$order->products[$i]['model'].']':'')) ."\n" .
		                            tep_draw_hidden_field('produto_qtde_'.($i+1), 		$order->products[$i]['qty']) ."\n" .
		                            tep_draw_hidden_field('produto_valor_'.($i+1),		number_format($order->products[$i]['final_price'], 2, '.', ''))."\n";
          //$order_subtotal += $order->products[$i]['qty'] * $order->products[$i]['final_price']* $currencies->get_value($currency)*100;
		  //$order_subtotal += $order->products[$i]['qty'] * round($order->products[$i]['final_price'], 2)*100;
       	 
	  }


     
      return $process_button_string;
	
    }

    function before_process() {
      return false;
    }
    function after_process() {
      return false;
    }

/*
    function after_process() {
     global $order, $cart, $insert_id;

     $html  = '<html>';
     $html .= '<body onload="document.checkout_confirmation_pagamentodigital.submit();">';
     $process_form =  tep_draw_form('checkout_confirmation_pagamentodigital', 'checkout_pagamentodigital.php', 'post', '').
                               tep_draw_hidden_field('orders_id', $insert_id);
     $html .= $process_form;
     $html .= '<noscript>';
     $html .= MODULE_PAYMENT_PD_TEXT_JS_FINALIZAR;
     $html .= ' <input type="submit" value="'.MODULE_PAYMENT_PD_TEXT_BTN_CONTINUAR.'" name="pagamento_bb" style="cursor: hand;">';
     $html .= '</noscript>';
     $html .= '</form>';
     $html .= '</body>';
     $html .= '</html>';

     echo $html;
     exit;

     return false;

    }
*/
    function get_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PD_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Pagamento Digital', 'MODULE_PAYMENT_PD_STATUS', 'True', ".
                   "'Ativar pagamento utilizando o Pagamento Digital?', '0', '1', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Email da Loja', 'MODULE_PAYMENT_PD_EMAIL_LOJA', '', ".
                   "'Email da Loja no Pagamento Digital.', '6', '8', ".
                   "now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Tipo de Integração', 'MODULE_PAYMENT_PD_TIPO_INTEGRACAO', 'PAD', ".
                   "'Tipo de Integração. (PAD padrão)', '6', '8', ".
                   "now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'URL Retorno', 'MODULE_PAYMENT_PD_URL_RETORNO', '".HTTP_SERVER."/pagamentoDigital/retorno.php', ".
                   "'URL de retorno para envio dos dados pelo pagamento digital (com HTTP ou HTTPS).', '6', '8', ".
                   "now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Código da Loja', 'MODULE_PAYMENT_PD_CODIGO', '0', ".
                   "'Pode ser obtida na administração do Pagamento Digital em: Ferramentas - Códigos para Integração.', '6', '8', ".
                   "now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Chave', 'MODULE_PAYMENT_PD_CHAVE', '0', ".
                   "'Pode ser obtida na administração do Pagamento Digital em: Ferramentas - Códigos para Integração.', '6', '8', ".
                   "now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Dias para vencimento do Boleto', 'MODULE_PAYMENT_PD_DIAS_VENCIMENTO_BOLETO', '3', ".
                   "'Número de dias para o vencimento do boleto após sua emissão', '6', '8', ".
                   "now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário revendedor', 'MODULE_PAYMENT_PD_TEXT_ENABLE_REVENDA', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários revendedor?', '6', '9', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário normal', 'MODULE_PAYMENT_PD_TEXT_ENABLE_USERFINAL', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários normais?', '6', '10', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");		  	
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Ordem de exibição', 'MODULE_PAYMENT_PD_SORT_ORDER', '0', ".
                   "'Determina a ordem de exibição do meio de pagamento.', '6', '8', ".
                   "now())");
    }
    
    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_PD_STATUS', 'MODULE_PAYMENT_PD_EMAIL_LOJA', 'MODULE_PAYMENT_PD_CHAVE', 
                   'MODULE_PAYMENT_PD_CODIGO', 'MODULE_PAYMENT_PD_TIPO_INTEGRACAO', 
                   'MODULE_PAYMENT_PD_URL_RETORNO', 'MODULE_PAYMENT_PD_DIAS_VENCIMENTO_BOLETO', 'MODULE_PAYMENT_PD_TEXT_ENABLE_REVENDA',
                   'MODULE_PAYMENT_PD_TEXT_ENABLE_USERFINAL', 'MODULE_PAYMENT_PD_SORT_ORDER');
    }
  }
?>