<?php
error_reporting(0);

/*
  $Id: ot_total.php,v 1.7 2003/02/13 00:12:04 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class ot_parcelas {
    var $title, $output;

    function ot_parcelas() {
      $this->code = 'ot_parcelas';
      $this->title = MODULE_ORDER_TOTAL_PARCELAS_TITLE;
      $this->description = MODULE_ORDER_TOTAL_PARCELAS_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_PARCELAS_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_PARCELAS_SORT_ORDER;
      $this->output = array();
    }

    function process() {
      global $order, $currencies;
	  $parc_vl = ($order->info['total']/$order->info['numparc']);
	  if(($order->info['total'] > MODULE_ORDER_TOTAL_VALOR_PARCELAS_SORT_ORDER ) && ($order->info['payment_method'] == 'Cartão de Crédito')){
      $this->output[] = array('title' => $this->title . ':',
                              'text' => $order->info['numparc'].'x de <b>'.$currencies->format($parc_vl, true, $order->info['currency'], $order->info['currency_value']).'</b>',
                              'value' => $order->info['numparc']);
	 }else{
	 $this->output[] = array('title' => $this->title . ':',
                              'text' => 'Sem parcelas',
                              'value' => '0');
	 
	 }					  
    }
	

	

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_PARCELAS_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_PARCELAS_STATUS', 'MODULE_ORDER_TOTAL_PARCELAS_SORT_ORDER', 'MODULE_ORDER_TOTAL_TAX_PARCELAS', 'MODULE_ORDER_TOTAL_NUM_PARCELAS_SORT_ORDER', 'MODULE_ORDER_TOTAL_VALOR_PARCELAS_SORT_ORDER');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Mostrar Parcelas', 'MODULE_ORDER_TOTAL_PARCELAS_STATUS', 'true', 'Você quer mostrar numero de parcelas na tela', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordem de classificação', 'MODULE_ORDER_TOTAL_PARCELAS_SORT_ORDER', '5', 'Sort order of display.', '6', '2', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Número de parcelas', 'MODULE_ORDER_TOTAL_NUM_PARCELAS_SORT_ORDER', '5', 'Informe o número de vezes que você deseja dividir a valor.', '6', '3', now())");  
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('Valor mínimo para parcelar', 'MODULE_ORDER_TOTAL_VALOR_PARCELAS_SORT_ORDER', '50', 'Informe o valor mínimo para dividir no cartão.', '6', '4', 'currencies->format', now())");
	  
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Juros ao cartão', 'MODULE_ORDER_TOTAL_TAX_PARCELAS', '1%', 'Informe o juros para o cartão de credito Ex(2%, 2,5% 10%).', '6', '3', now())");

    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>