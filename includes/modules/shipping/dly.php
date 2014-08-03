<?php
  class dly {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function dly() {
	  global $order;

      $this->code = 'dly';
      $this->title = MODULE_SHIPPING_DLY_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_DLY_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_DLY_SORT_ORDER;
      $this->icon = DIR_WS_ICONS . 'shipping_dly.gif';  // To remove icon change this line to: $this->icon = '';
      $this->enabled = MODULE_SHIPPING_DLY_STATUS;
// Beg Minimum Order Total required to activate module
      $this->min_order = MODULE_SHIPPING_DLY_MINIMUM_ORDER_TOTAL;

    if ( ($order->info['total']) < ($this->min_order) )  {
          $this->enabled = false;
    }
// End Minimum Order Total required to activate module

	  if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_DLY_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_DLY_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
		$zipcodes=split (',',MODULE_SHIPPING_DLY_ZIPCODE);
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
		    if ((in_array($order->delivery['postcode'],$zipcodes )) or (MODULE_SHIPPING_DLY_ZIPCODE==''))
              $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
		      if ((in_array($order->delivery['postcode'],$zipcodes )or (MODULE_SHIPPING_DLY_ZIPCODE=='')))
                $check_flag = true;
            break;
          }
		}

		if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

// class methods

    function quote($method = '') {
	  global $order;

      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_DLY_TEXT_TITLE,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => MODULE_SHIPPING_DLY_TEXT_WAY,
                                                     'cost' =>  MODULE_SHIPPING_DLY_COST)));

      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_DLY_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Habilitar este modulo de entrega?', 'MODULE_SHIPPING_DLY_STATUS', '1', 'Você deseja habilitar este modulo de entrega', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Custo da entrega', 'MODULE_SHIPPING_DLY_COST', '0.00', 'Qual é o preço da entrega? (Se for GRATIS deixe vazio este campo)', '6', '6', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Valor minimo para entrega.', 'MODULE_SHIPPING_DLY_MINIMUM_ORDER_TOTAL', '0.00', 'Qual será o valor minimo para entrega.', '6', '7', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CEP', 'MODULE_SHIPPING_DLY_ZIPCODE', '', 'Habilitar entrega somente para os CEP abaixo. (Separe os CEP com virgula. Deixe vazio para todos.)', '6', '7', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Texto de entrega', 'MODULE_SHIPPING_DLY_TEXT_WAY', 'A entrega será realizada no mesmo dia (até as 22h), ou no dia seguinte, dependendo do horário de confirmação do pagamento.', 'Informe o texto de entrega', '6', '8', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Regi&atilde;o de entrega.', 'MODULE_SHIPPING_DLY_ZONE', '0', 'Se for selecionado uma regi&atilde;o este meio de entrega so será entregue na regi&atilde;o escolhida.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordem de exibi&ccedil;&atilde;o.', 'MODULE_SHIPPING_DLY_SORT_ORDER', '3', 'Ordem de exibi&ccedil;&atilde;o para o cliente.', '6', '0', now())");
    }
    function remove() {
      $keys = '';
      $keys_array = $this->keys();
      for ($i=0; $i<sizeof($keys_array); $i++) {
        $keys .= "'" . $keys_array[$i] . "',";
      }
      $keys = substr($keys, 0, -1);

      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
    }

    function keys() {
      return array('MODULE_SHIPPING_DLY_STATUS',
                   'MODULE_SHIPPING_DLY_COST',
				   'MODULE_SHIPPING_DLY_TEXT_WAY',
                   'MODULE_SHIPPING_DLY_MINIMUM_ORDER_TOTAL',
                   'MODULE_SHIPPING_DLY_ZIPCODE',
                   'MODULE_SHIPPING_DLY_SORT_ORDER',
                   'MODULE_SHIPPING_DLY_ZONE');
    }
  }
?>
