<?php
/*
  $Id: transferenciaUnibanco2.php, 10/16/2004
  
  O download do módulo deposito/transferência bancária
   pode ser efetuado em http://www.phpmania.org

  Copyright (c) 2004 PHPmania.org <phpmania@mail.com>

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce


*/

  class transferenciaUnibanco {
    var $code, $title, $description, $enabled;

// class constructor
    function transferenciaUnibanco() {

      global $order;
      $this->code = 'transferenciaUnibanco';
      $this->title = MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_TITLE;
	  $this->revenda = MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_ENABLE_REVENDA;
	  $this->normaluser = MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_ENABLE_USERFINAL;
      $this->description = MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_DESCRIPTION;
      $this->email_footer =MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_CONFIRMATION .
							"\n\nDados para depósito\\transferência:\n" .
							MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TITULAR . "\n" .
							"Banco: " . MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_BANCO . "\n" .
							"Agência: " . MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_AGENCIA . "\n" .
							"Conta Corrente: " . MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_CC . "\n\n";
      $this->sort_order = MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_NZ_BANK_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
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
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_CONFIRMATION . "\n<pre>\nDados para depósito\\transferência:\n" . MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TITULAR . "\n" . "Banco: " . MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_BANCO . "\n" . "Agência: " . MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_AGENCIA . "\n" . "Conta Corrente: " . MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_CC . "\n</PRE>");
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
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Ativar o módulo Transferência', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_STATUS', 'True', '', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Opções de Pagamento)', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_SELECTION', 'Depósito/Transferência Bancária (Banco Unibanco)', 'Texto a ser exibido para o cliente na tela do opções de pagamento:', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Instruções para o Cliente)', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_CONFIRMATION', 'Seu pedido será enviado quando confirmado o pagamento. Para agilizar o processo, envie o comprovante por fax: (xx)xxxx-xxxx ou email: cobranca@seusite.com.br.', 'Texto a ser exibido para o cliente na confirmação da compra', '6', '5', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Titular da Conta Bancária', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TITULAR', 'PHPmania Ltda.', 'Titular da Conta Bancária', '6', '3', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Nome do Banco', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_BANCO', 'Banco Unibanco', 'Nome do Banco', '6', '4', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Agência', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_AGENCIA', 'xxxx-x', 'Agência', '6', '5', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Conta Corrente', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_CC', 'xxxxx-x', 'Conta Corrente', '6', '2', now())");
	   tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Status dos pedidos', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_ORDER_STATUS_ID', '0', 'Atualiza o status dos pedidos efetuados por este módulo de pagamento para este valor.', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
	   tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário revendedor', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_ENABLE_REVENDA', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários revendedor?', '6', '0', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
				   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário normal', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_ENABLE_USERFINAL', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários normais?', '6', '0', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");		
				     
	   tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordem de exibição.', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_SORT_ORDER', '0', 'Ordem de exibição', '6', '0', now())");


   }


    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_STATUS', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_SELECTION', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_CONFIRMATION', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TITULAR', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_BANCO', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_AGENCIA', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_CC', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_ORDER_STATUS_ID', 'MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_ENABLE_REVENDA','MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_TEXT_ENABLE_USERFINAL','MODULE_PAYMENT_TRANSFERENCIAUNIBANCO_SORT_ORDER');

    }
  }
?>
