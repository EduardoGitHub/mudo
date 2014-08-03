<?php
// +--------------------------------------------------------------------------------------+
// |  Módulo de Pagamento osCommerce 2.2 para gerar boletos bancários com BoletoPHP 	  |
// |  O download do BoletoPHP pode ser efetuado em www.boletophp.com.br     	 		  |
// |  Copyright (c) 2002 osCommerce														  |
// |  Released under the GNU General Public License										  |
// | 																					  |
// | ADAPTADO-BOLETOITAU PARA OSCOMMERCE: Welliton Cordeiro (Pinga_oz) - www.airgun.com.br |
// | Informações de Instalação e configuração no arquivo LEIAME_BPHP_OSC.TXT 			  |
// +--------------------------------------------------------------------------------------+


  class boletoitau {
    var $code, $title, $description, $enabled;

// class constructor
    function boletoitau() {
      global $order;

      $this->code = 'boletoitau';
      $this->title = MODULE_PAYMENT_BOLETOITAU_TEXT_TITLE;
	  $this->revenda = MODULE_PAYMENT_BOLETOITAU_TEXT_ENABLE_REVENDA;
	  $this->normaluser = MODULE_PAYMENT_BOLETOITAU_TEXT_ENABLE_USERFINAL;
      $this->description = MODULE_PAYMENT_BOLETOITAU_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_BOLETOITAU_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_BOLETOITAU_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_BOLETOITAU_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_BOLETOITAU_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true);
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_BOLETOITAU_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_BOLETOITAU_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
                   'module' => $this->title,
				   'userrevenda' => $this->revenda,
				   'usernormal' => $this->normaluser);
      }

    function pre_confirmation_check() {
    }

    function confirmation() {
global $order, $n_pedido;
$pedido_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " order by orders_id desc limit 0,1");
$res_pedido = tep_db_fetch_array($pedido_query);
if ($res_pedido['orders_id'] < 1) {
$n_pedido = 1;
}else{
$n_pedido = $res_pedido['orders_id'] + 1;
}
     $confirmation = array('title' => $this->title,
                            'fields' => array(array('title' => '<span style="font-size:12px;color: #FF0000;">
                     <br><br>Após finalizar seu pedido, será gerado automaticamente seu boleto.</span>')));
                                                    /*'field' => tep_draw_form('boleto', MODULE_PAYMENT_BOLETOBRASIL_URL, 'post', 'target=_blank') .
                                                               tep_draw_hidden_field('order_id',$n_pedido, '') .
                                                tep_draw_hidden_field('local_pagamento', MODULE_PAYMENT_BOLETOBRASIL_LOCALPAGAMENTO, '') .
                                                               tep_draw_hidden_field('agencia', MODULE_PAYMENT_BOLETOBRASIL_AGENCIA, '') .
                                                tep_draw_hidden_field('conta', MODULE_PAYMENT_BOLETOBRASIL_CONTA, '') .
                                                tep_draw_hidden_field('convenio', MODULE_PAYMENT_BOLETOBRASIL_CONVENIO, '') .
                                                tep_draw_hidden_field('contrato', MODULE_PAYMENT_BOLETOBRASIL_CONTRATO, '') .
                                                tep_draw_hidden_field('formatacao_nosso_numero', MODULE_PAYMENT_BOLETOBRASIL_NNUMERO, '') .
                                                tep_draw_hidden_field('carteira', MODULE_PAYMENT_BOLETOBRASIL_CARTEIRA, '') .
                                                tep_draw_hidden_field('cpf_cnpj', MODULE_PAYMENT_BOLETOBRASIL_CNPJ, '') .
                                                tep_draw_hidden_field('endereco', MODULE_PAYMENT_BOLETOBRASIL_ENDERECO, '') .
                                                tep_draw_hidden_field('cidade', MODULE_PAYMENT_BOLETOBRASIL_CIDADE, '') .
                                                tep_draw_hidden_field('cedente', MODULE_PAYMENT_BOLETOBRASIL_CEDENTE, '') .
                                                tep_draw_hidden_field('demonstrativo', MODULE_PAYMENT_BOLETOBRASIL_DEMONSTRATIVO, '') .
                                                tep_draw_hidden_field('instrucoes', MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES, '') .
                                                tep_draw_hidden_field('instrucoes1', MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES1, '') .
                                                tep_draw_hidden_field('instrucoes2', MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES2, '') .
                                                tep_draw_hidden_field('instrucoes3', MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES3, '') .
                                                tep_draw_hidden_field('instrucoes4', MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES4, '') .
                                                tep_draw_hidden_field('data_vencimento', date("d/m/Y", time()+60*60*24*MODULE_PAYMENT_BOLETOBRASIL_PRAZOVENCIMENTO), '') .
                                                               tep_draw_hidden_field('valor_boleto', $order->info['total'], '') .
                                                tep_draw_hidden_field('sacado_id', session_is_registered('customer_id'), '') .
                                                               tep_draw_hidden_field('sacado', $order->customer['firstname'] . ' ' . $order->customer['lastname'], '') .
                                                               tep_draw_hidden_field('endereco_sacado', $order->customer['street_address'] . " - " . $order->customer['suburb'] . " / " . $order->customer['city'] . "-" . $order->customer['state'] . " / " .$order->customer['postcode'], '') .
                                                               tep_draw_input_field('BGB', 'Exibir Boleto', '', 'submit', true) .
                                                               '</form>'))); */
      return $confirmation;
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETOITAU_STATUS'");
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
                   "'Gerar Boletos Bancário - Itaú', 'MODULE_PAYMENT_BOLETOITAU_STATUS', 'True', ".
                   "'Você deseja gerar Boletos Bancário do Itaú?', '6', '1', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'URL do arquivo de geração do boleto.', 'MODULE_PAYMENT_BOLETOITAU_URL', '" . HTTPS_CATALOG_SERVER . "boletos/itau/boleto_itau.php', ".
                   "'Informar a URL do arquivo de geração do BOLETOITAU referente ao seu banco.<br>Ex.(boleto/boleto_itau.php)', '6', '2', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Local de Pagamento', 'MODULE_PAYMENT_BOLETOITAU_LOCALPAGAMENTO', '', ".
                   "'Informe o local onde o boleto deverá ser pago.', '6', '3', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Agencia Bancária', 'MODULE_PAYMENT_BOLETOITAU_AGENCIA', '', ".
                   "'Informar a agência bancária sem o dígito.', '6', '3', ".
                   "now())");
				   
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Conta Corrente', 'MODULE_PAYMENT_BOLETOITAU_CONTA', '', ".
                   "'Informar a conta corrente sem o dígito.', '6', '3', ".
                   "now())");
				   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Conta Corrente DV', 'MODULE_PAYMENT_BOLETOITAU_CONTADV', '', ".
                   "'Informe o dígito da conta corrente.', '6', '3', ".
                   "now())");		   
		
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Carteira', 'MODULE_PAYMENT_BOLETOITAU_CARTEIRA', '', ".
                   "'Informar a caretira com qual você trabalha. Ex: 109, 123 ou xx.', '6', '4', ".
                   "now())");


      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'CNPJ', 'MODULE_PAYMENT_BOLETOITAU_CNPJ', '', ".
                   "'Informar o numero de seu CNPJ.', '6', '4', ".
                   "now())");

		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Endereço', 'MODULE_PAYMENT_BOLETOITAU_ENDERECO', '', ".
                   "'Informar seu endereço.', '6', '4', ".
                   "now())");

		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Cidade', 'MODULE_PAYMENT_BOLETOITAU_CIDADE', '', ".
                   "'Informar sua cidade.', '6', '4', ".
                   "now())");

		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Cedente', 'MODULE_PAYMENT_BOLETOITAU_CEDENTE', '', ".
                   "'Informar o nome do titular da conta que receberá o pagamento do boleto.', '6', '4', ".
                   "now())");
		
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Prazo de Vencimento', 'MODULE_PAYMENT_BOLETOITAU_PRAZOVENCIMENTO', '1', ".
                   "'Informar a quantidade de dias úteis para o vencimento do boleto.', '6', '5', ".
                   "now())");		   

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Demonstrativo', 'MODULE_PAYMENT_BOLETOITAU_DEMONSTRATIVO', '', ".
                   "'Informar o texto a ser exibido no campo Demonstrativo do boleto.', '6', '6', ".
                   "now())");
				   
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Instruções', 'MODULE_PAYMENT_BOLETOITAU_INSTRUCOES', '', ".
                   "'Primeira linha de instruções para o caixa', '6', '6', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Instruções', 'MODULE_PAYMENT_BOLETOITAU_INSTRUCOES1', '', ".
                   "'Segunda linha de instruções para o caixa', '6', '6', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Instruções', 'MODULE_PAYMENT_BOLETOITAU_INSTRUCOES2', '', ".
                   "'Terceira linha de instruções para o caixa', '6', '6', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Instruções', 'MODULE_PAYMENT_BOLETOITAU_INSTRUCOES3', '', ".
                   "'Quarta linha de instruções para o caixa', '6', '6', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Zonas suportadas', 'MODULE_PAYMENT_BOLETOITAU_ZONE', '0', ".
                   "'Se uma zona for selecionada, somente este meio de pagamento estará disponível para esta zona.', '6', '8', ".
                   "'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Status dos pedidos', 'MODULE_PAYMENT_BOLETOITAU_ORDER_STATUS_ID', '1', ".
                   "'Atualiza o status dos pedidos efetuados por este módulo de pagamento para este valor.', '6', '9', ".
                   "'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(', now())");


      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Ordem de exibição', 'MODULE_PAYMENT_BOLETOITAU_SORT_ORDER', '0', ".
                   "'Determina a ordem de exibição do meio de pagamento.', '6', '10', ".
                   "now())");
				   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário revendedor', 'MODULE_PAYMENT_BOLETOITAU_TEXT_ENABLE_REVENDA', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários revendedor?', '6', '0', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
				   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário normal', 'MODULE_PAYMENT_BOLETOITAU_TEXT_ENABLE_USERFINAL', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários normais?', '6', '0', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");		     
		
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Nosso número', 'MODULE_PAYMENT_BOLETOITAU_FX_INICIAL', '', ".
                   "'Informe faixa inicial do nosso número.', '6', '4', ".
                   "now())");			   
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {

      return array('MODULE_PAYMENT_BOLETOITAU_STATUS', 'MODULE_PAYMENT_BOLETOITAU_CEDENTE', 'MODULE_PAYMENT_BOLETOITAU_PRAZOVENCIMENTO', 'MODULE_PAYMENT_BOLETOITAU_CNPJ', 'MODULE_PAYMENT_BOLETOITAU_ENDERECO',
	  			   'MODULE_PAYMENT_BOLETOITAU_CIDADE', 'MODULE_PAYMENT_BOLETOITAU_URL', 'MODULE_PAYMENT_BOLETOITAU_LOCALPAGAMENTO', 'MODULE_PAYMENT_BOLETOITAU_AGENCIA',
				   'MODULE_PAYMENT_BOLETOITAU_CONTA', 'MODULE_PAYMENT_BOLETOITAU_CONTADV','MODULE_PAYMENT_BOLETOITAU_CARTEIRA', 'MODULE_PAYMENT_BOLETOITAU_DEMONSTRATIVO', 'MODULE_PAYMENT_BOLETOITAU_INSTRUCOES', 'MODULE_PAYMENT_BOLETOITAU_INSTRUCOES1', 'MODULE_PAYMENT_BOLETOITAU_FX_INICIAL',
				   'MODULE_PAYMENT_BOLETOITAU_INSTRUCOES2', 'MODULE_PAYMENT_BOLETOITAU_INSTRUCOES3','MODULE_PAYMENT_BOLETOITAU_ZONE',
				   'MODULE_PAYMENT_BOLETOITAU_ORDER_STATUS_ID','MODULE_PAYMENT_BOLETOITAU_TEXT_ENABLE_REVENDA','MODULE_PAYMENT_BOLETOITAU_TEXT_ENABLE_USERFINAL', 'MODULE_PAYMENT_BOLETOITAU_SORT_ORDER');

    }
  }
?>
