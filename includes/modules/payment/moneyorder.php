<?php
/*
  $Id: moneyorder.php,v 1.10 2003/01/29 19:57:14 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class moneyorder {
    var $code, $title, $description, $enabled;

// class constructor
    function moneyorder() {
      global $order;

      $this->code = 'moneyorder';
      $this->title = MODULE_PAYMENT_MONEYORDER_TEXT_TITLE;
	  $this->revenda = MODULE_PAYMENT_MONEYORDER_TEXT_ENABLE_REVENDA;
	  $this->normaluser = MODULE_PAYMENT_MONEYORDER_TEXT_ENABLE_USERFINAL;
      $this->description = MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_MONEYORDER_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_MONEYORDER_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    
      $this->email_footer = MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_MONEYORDER_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_MONEYORDER_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION);
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
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MONEYORDER_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Habilitar modulo de cheque.', 'MODULE_PAYMENT_MONEYORDER_STATUS', 'True', 'Você deseja aceitar pagamento em cheque?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Fazer pagamento para:', 'MODULE_PAYMENT_MONEYORDER_PAYTO', '', 'Os pagamentos devem ser feitos para?', '6', '1', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordem de exibição.', 'MODULE_PAYMENT_MONEYORDER_SORT_ORDER', '0', 'Ordem de exibição deve aparecer para o visitante.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Pagamento por região.', 'MODULE_PAYMENT_MONEYORDER_ZONE', '0', 'Se a zona for selecionado este modulo so será habilitado para a região correspondente.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Status do pedido', 'MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID', '0', 'Informe o status que o pedido deve ir para o banco de dados.', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário revendedor', 'MODULE_PAYMENT_MONEYORDER_TEXT_ENABLE_REVENDA', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários revendedor?', '6', '0', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
				   
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Habilitar módulo de pagamento para usuário normal', 'MODULE_PAYMENT_MONEYORDER_TEXT_ENABLE_USERFINAL', 'True', ".
                   "'Você deseja habilitar este módulo de pagamento para usuários normais?', '6', '0', ".
                   "'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");		  
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_MONEYORDER_STATUS', 'MODULE_PAYMENT_MONEYORDER_ZONE', 'MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID', 'MODULE_PAYMENT_MONEYORDER_PAYTO','MODULE_PAYMENT_MONEYORDER_TEXT_ENABLE_REVENDA','MODULE_PAYMENT_MONEYORDER_TEXT_ENABLE_USERFINAL','MODULE_PAYMENT_MONEYORDER_SORT_ORDER');
    }
  }
?>
