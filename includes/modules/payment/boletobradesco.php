<?php
// +--------------------------------------------------------------------------------------+
// |  Módulo de Pagamento osCommerce 2.2 para gerar boletos bancários com BoletoPHP 	  |
// |  O download do BoletoPHP pode ser efetuado em www.boletophp.com.br     	 		  |
// |  Copyright (c) 2002 osCommerce														  |
// |  Released under the GNU General Public License										  |
// | 																					  |
// | ADAPTADO-BOLETOBRADESCO PARA OSCOMMERCE: Welliton Cordeiro (Pinga_oz) - www.airgun.com.br |
// | Informações de Instalação e configuração no arquivo LEIAME_BPHP_OSC.TXT 			  |
// +--------------------------------------------------------------------------------------+


  class boletobradesco {
    var $code, $title, $description, $enabled;

// class constructor
    function boletobradesco() {
      global $order;

      $this->code = 'boletobradesco';
      $this->title = MODULE_PAYMENT_BOLETOBRADESCO_TEXT_TITLE;
	  $this->revenda = MODULE_PAYMENT_BOLETOBRADESCO_TEXT_ENABLE_REVENDA;
	  $this->normaluser = MODULE_PAYMENT_BOLETOBRADESCO_TEXT_ENABLE_USERFINAL;
      $this->description = MODULE_PAYMENT_BOLETOBRADESCO_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_BOLETOBRADESCO_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_BOLETOBRADESCO_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_BOLETOBRADESCO_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_BOLETOBRADESCO_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true);
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_BOLETOBRADESCO_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_BOLETOBRADESCO_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BOLETOBRADESCO_STATUS'");
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
                   "'Gerar Boletos Bancário - Bradesco', 'MODULE_PAYMENT_BOLETOBRADESCO_STATUS', 'True', ".
                   "'Você deseja gerar Boletos Bancário do Bradesco?', '6', '1', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'URL do arquivo de geração do boleto.', 'MODULE_PAYMENT_BOLETOBRADESCO_URL', 'boletos/bradesco/boleto_bradesco.php', ".
                   "'Informar a URL do arquivo de geração do BOLETOBRADESCO referente ao seu banco.<br>Ex.(boletos/bradesco/boleto_bradesco.php)', '6', '2', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Local de Pagamento', 'MODULE_PAYMENT_BOLETOBRADESCO_LOCALPAGAMENTO', '', ".
                   "'Informe o local onde o boleto deverá ser pago.', '6', '3', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Agencia Bancária', 'MODULE_PAYMENT_BOLETOBRADESCO_AGENCIA', '', ".
                   "'Informar a agência bancária sem o dígito.', '6', '3', ".
                   "now())");
				   
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Agencia Bancária DV', 'MODULE_PAYMENT_BOLETOBRADESCO_AGENCIADV', '', ".
                   "'Informar o dígito da agência bancária.', '6', '3', ".
                   "now())");		   
				   
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Conta Corrente', 'MODULE_PAYMENT_BOLETOBRADESCO_CONTA', '', ".
                   "'Informar a conta corrente sem o dígito.', '6', '3', ".
                   "now())");
				   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Conta Corrente DV', 'MODULE_PAYMENT_BOLETOBRADESCO_CONTADV', '', ".
                   "'Informe o dígito da conta corrente.', '6', '3', ".
                   "now())");		   
		
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Carteira', 'MODULE_PAYMENT_BOLETOBRADESCO_CARTEIRA', '', ".
                   "'Informar a caretira com qual você trabalha. Ex: (Carteira 06 / 03 - Sem Registro)', '6', '4', ".
                   "now())");


      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'CNPJ', 'MODULE_PAYMENT_BOLETOBRADESCO_CNPJ', '', ".
                   "'Informar o numero de seu CNPJ.', '6', '4', ".
                   "now())");

		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Endereço', 'MODULE_PAYMENT_BOLETOBRADESCO_ENDERECO', '', ".
                   "'Informar seu endereço.', '6', '4', ".
                   "now())");

		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Cidade', 'MODULE_PAYMENT_BOLETOBRADESCO_CIDADE', '', ".
                   "'Informar sua cidade.', '6', '4', ".
                   "now())");

		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Cedente', 'MODULE_PAYMENT_BOLETOBRADESCO_CEDENTE', '', ".
                   "'Informar o nome do titular da conta que receberá o pagamento do boleto.', '6', '4', ".
                   "now())");
		
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Prazo de Vencimento', 'MODULE_PAYMENT_BOLETOBRADESCO_PRAZOVENCIMENTO', '1', ".
                   "'Informar a quantidade de dias úteis para o vencimento do boleto.', '6', '5', ".
                   "now())");		   

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Demonstrativo', 'MODULE_PAYMENT_BOLETOBRADESCO_DEMONSTRATIVO', '', ".
                   "'Informar o texto a ser exibido no campo Demonstrativo do boleto.', '6', '6', ".
                   "now())");
				   
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Instruções', 'MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES', '', ".
                   "'Primeira linha de instruções para o caixa', '6', '6', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Instruções', 'MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES1', '', ".
                   "'Segunda linha de instruções para o caixa', '6', '6', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Instruções', 'MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES2', '', ".
                   "'Terceira linha de instruções para o caixa', '6', '6', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Instruções', 'MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES3', '', ".
                   "'Quarta linha de instruções para o caixa', '6', '6', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Zonas suportadas', 'MODULE_PAYMENT_BOLETOBRADESCO_ZONE', '0', ".
                   "'Se uma zona for selecionada, somente este meio de pagamento estará disponível para esta zona.', '6', '8', ".
                   "'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "use_function, set_function, date_added".
                   ") values (".
                   "'Status dos pedidos', 'MODULE_PAYMENT_BOLETOBRADESCO_ORDER_STATUS_ID', '1', ".
                   "'Atualiza o status dos pedidos efetuados por este módulo de pagamento para este valor.', '6', '9', ".
                   "'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(', now())");


      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Ordem de exibição', 'MODULE_PAYMENT_BOLETOBRADESCO_SORT_ORDER', '0', ".
                   "'Determina a ordem de exibição do meio de pagamento.', '6', '10', ".
                   "now())");
				   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário revendedor', 'MODULE_PAYMENT_BOLETOBRADESCO_TEXT_ENABLE_REVENDA', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários revendedor?', '6', '11', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
				   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário normal', 'MODULE_PAYMENT_BOLETOBRADESCO_TEXT_ENABLE_USERFINAL', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários normais?', '6', '12', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");		   		   
		
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Nosso número', 'MODULE_PAYMENT_BOLETOBRADESCO_FX_INICIAL', '', ".
                   "'Informe faixa inicial do nosso número.', '6', '4', ".
                   "now())");			   
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {

      return array('MODULE_PAYMENT_BOLETOBRADESCO_STATUS', 'MODULE_PAYMENT_BOLETOBRADESCO_CEDENTE', 'MODULE_PAYMENT_BOLETOBRADESCO_PRAZOVENCIMENTO', 'MODULE_PAYMENT_BOLETOBRADESCO_CNPJ', 'MODULE_PAYMENT_BOLETOBRADESCO_ENDERECO', 
	  			   'MODULE_PAYMENT_BOLETOBRADESCO_CIDADE', 'MODULE_PAYMENT_BOLETOBRADESCO_URL', 'MODULE_PAYMENT_BOLETOBRADESCO_LOCALPAGAMENTO', 'MODULE_PAYMENT_BOLETOBRADESCO_AGENCIA','MODULE_PAYMENT_BOLETOBRADESCO_AGENCIADV',
				   'MODULE_PAYMENT_BOLETOBRADESCO_CONTA', 'MODULE_PAYMENT_BOLETOBRADESCO_CONTADV','MODULE_PAYMENT_BOLETOBRADESCO_CARTEIRA', 'MODULE_PAYMENT_BOLETOBRADESCO_DEMONSTRATIVO', 'MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES', 'MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES1', 'MODULE_PAYMENT_BOLETOBRADESCO_FX_INICIAL',
				   'MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES2', 'MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES3','MODULE_PAYMENT_BOLETOBRADESCO_ZONE',
				   'MODULE_PAYMENT_BOLETOBRADESCO_ORDER_STATUS_ID', 'MODULE_PAYMENT_BOLETOBRADESCO_TEXT_ENABLE_REVENDA','MODULE_PAYMENT_BOLETOBRADESCO_TEXT_ENABLE_USERFINAL','MODULE_PAYMENT_BOLETOBRADESCO_SORT_ORDER');

    }
  }
?>
