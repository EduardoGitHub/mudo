<?php
/*
  $Id: shopping_cart.php,v 1.35 2003/06/25 21:14:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class shoppingCart {
    var $contents, $total, $weight, $cartID, $content_type;

     function ajustaQtde($id, $qtde)
	 	{
  			$product_qty = tep_db_query("select products_qty_blocks from " . TABLE_PRODUCTS . " where products_id = '" . $id . "'");
  			$result_qty = tep_db_fetch_array($product_qty);
			if($result_qty['products_qty_blocks'] > $qtde)
			return $result_qty['products_qty_blocks'];
			else
			return $qtde;
		}
  
	
	function shoppingCart() {
      $this->reset();
    }
	


    function restore_contents() {
      global $customer_id;

      if (!tep_session_is_registered('customer_id')) return false;

// insert current cart contents in database
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
		
          $qty = $this->ajustaQtde($products_id, $this->contents[$products_id]['qty']); //$this->contents[$products_id]['qty'];
          $product_query = tep_db_query("select products_id from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
          if (!tep_db_num_rows($product_query)) {
            tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . $qty . "', '" . date('Ymd') . "')");
            if (isset($this->contents[$products_id]['attributes'])) {
              reset($this->contents[$products_id]['attributes']);
              while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
                tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . (int)$option . "', '" . (int)$value . "')");
              }
            }
          } else {
            tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . $qty . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
          }
        }
      }

// reset per-session cart contents, but not the database contents
      $this->reset(false);

      $products_query = tep_db_query("select products_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
      while ($products = tep_db_fetch_array($products_query)) {
        $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity']);
// attributes
        $attributes_query = tep_db_query("select products_options_id, products_options_value_id from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products['products_id']) . "'");
        while ($attributes = tep_db_fetch_array($attributes_query)) {
          $this->contents[$products['products_id']]['attributes'][$attributes['products_options_id']] = $attributes['products_options_value_id'];
        }
      }

      $this->cleanup();
    }

    function reset($reset_database = false) {
      global $customer_id;

      $this->contents = array();
      $this->total = 0;
      $this->weight = 0;
      $this->content_type = false;

      if (tep_session_is_registered('customer_id') && ($reset_database == true)) {
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "'");
      }

      unset($this->cartID);
      if (tep_session_is_registered('cartID')) tep_session_unregister('cartID');
    }

    function add_cart($products_id, $qty = '1', $attributes = '', $notify = true) {
      global $new_products_id_in_cart, $customer_id;

      $products_id = tep_get_uprid($products_id, $attributes);
      if ($notify == true) {
        $new_products_id_in_cart = $products_id;
        tep_session_register('new_products_id_in_cart');
      }

      if ($this->in_cart($products_id)) {
        $this->update_quantity($products_id, $this->ajustaQtde($products_id, $qty), $attributes);
      } else {
        $this->contents[] = array($products_id);
        //$this->contents[$products_id] = array('qty' => $qty);
		$this->contents[$products_id] = array('qty' => $this->ajustaQtde($products_id, $qty));
// insert into database
        if (tep_session_is_registered('customer_id')) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . $this->ajustaQtde($products_id, $qty) . "', '" . date('Ymd') . "')");

        if (is_array($attributes)) {
          reset($attributes);
          while (list($option, $value) = each($attributes)) {
            $this->contents[$products_id]['attributes'][$option] = $value;
// insert into database
            if (tep_session_is_registered('customer_id')) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . (int)$option . "', '" . (int)$value . "')");
          }
        }
      }
      $this->cleanup();

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
      $this->cartID = $this->generate_cart_id();
    }

    function update_quantity($products_id, $quantity = '', $attributes = '') {
      global $customer_id;

      if (empty($quantity)) return true; // nothing needs to be updated if theres no quantity, so we return true..
	  //$this->contents[$products_id] = array('qty' => $quantity);	
      $this->contents[$products_id] = array('qty' => $this->ajustaQtde($products_id, $quantity));
// update database
      if (tep_session_is_registered('customer_id')) tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . $this->ajustaQtde($products_id, $quantity) . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");

      if (is_array($attributes)) {
        reset($attributes);
        while (list($option, $value) = each($attributes)) {
          $this->contents[$products_id]['attributes'][$option] = $value;
// update database
          if (tep_session_is_registered('customer_id')) tep_db_query("update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " set products_options_value_id = '" . (int)$value . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "' and products_options_id = '" . (int)$option . "'");
        }
      }
    }

    function cleanup() {
      global $customer_id;

      reset($this->contents);
      while (list($key,) = each($this->contents)) {
        if ($this->contents[$key]['qty'] < 1) {
          unset($this->contents[$key]);
// remove from database
          if (tep_session_is_registered('customer_id')) {
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
          }
        }
      }
    }

    function count_contents() {  // get total number of items in cart 
      $total_items = 0;
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $total_items += $this->get_quantity($products_id);
        }
      }

      return $total_items;
    }

    function get_quantity($products_id) {
      if (isset($this->contents[$products_id])) {
        return $this->ajustaQtde($products_id, $this->contents[$products_id]['qty']);//$this->contents[$products_id]['qty'];
      } else {
        return 0;
      }
    }

    function in_cart($products_id) {
      if (isset($this->contents[$products_id])) {
        return true;
      } else {
        return false;
      }
    }

    function remove($products_id) {
      global $customer_id;

      unset($this->contents[$products_id]);
// remove from database
      if (tep_session_is_registered('customer_id')) {
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
      }

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
      $this->cartID = $this->generate_cart_id();
    }

    function remove_all() {
      $this->reset();
    }

    function get_product_id_list() {
      $product_id_list = '';
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $product_id_list .= ', ' . $products_id;
        }
      }

      return substr($product_id_list, 2);
    }
	
	function cubagemCorreios($length, $width, $height, $diameter){
		$length = round($length);
		$width = round($width);
		$height = round($height);
		$diameter = round($diameter);
		if(SHIPPING_TYPE_PACK == 1){//Se for Caixa/Pacote
			if($length != 0 && $width != 0 && $height != 0){
				if($length < 90 && $width < 90 && $height < 90){//As dimensões tem que ser menor que 90 cm se não ele vai pegar os valores padrões
					if($length < 16) $length = 16; //O comprimento não pode ser inferior a 16 cm.
					if($height < 2) $height = 2; //A altura não pode ser inferior a 2 cm.
					if($height > $length) $height = $length; //A altura não pode ser maior que o comprimento.
					if($width < 11) $width = 11;//A largura não pode ser inferior a 5 cm.
					if($length < 25 && $width < 11)$width = 11; // A largura não pode ser menor que 11cm, quando o comprimento for menor que 25cm.
					$tot_cubagem = $length + $width + $height; //Soma todas aa dimenssões
					if($tot_cubagem <=160)//total da cubagem não pode ser maior que 160. Se for maior ele vai pegar os valores padrões que tiverem na configuração do modulo
					$cubagem = array($length, $width, $height, 0); 
					else
					$cubagem = array(SHIPPING_LENGHT, SHIPPING_WIDTH, SHIPPING_HEIGHT,0);
				}else $cubagem = array(SHIPPING_LENGHT, SHIPPING_WIDTH, SHIPPING_HEIGHT,0);
			}else $cubagem = array(SHIPPING_LENGHT, SHIPPING_WIDTH, SHIPPING_HEIGHT,0);
		}elseif(SHIPPING_TYPE_PACK == 2){// Se for Rolo/Prisma
			if($length != 0 && $diameter != 0){
				if($length < 90 && $diameter < 90){//As dimensões tem que ser menor que 90 cm se não ele vai pegar os valores padrões
					if($length < 18) $length = 18;//O comprimento não pode ser inferior a 18 cm.
					if($diameter < 5) $diameter = 5; //O diâmetro não pode ser inferior a 5 cm.
					$tot_cubagem = $length + ($diameter * 2);
					if($tot_cubagem <=104)
					$cubagem = array($length, 0, 0, $diameter); 
					else
					$cubagem = array(SHIPPING_LENGHT, 0, 0, SHIPPING_DIAMETER);
				}else $cubagem = array(SHIPPING_LENGHT, 0, 0, SHIPPING_DIAMETER);
			}else $cubagem = array(SHIPPING_LENGHT, 0, 0, SHIPPING_DIAMETER);
		}
		return $cubagem;		
	}
	
    function calculate() {
      $this->total = 0;
      $this->weight = 0;
	  $this->cubagem = array();
	  $comprimento = '';
	  $largura = '';
	  $altura = '';
	  $diametro = '';
      if (!is_array($this->contents)) return 0;

      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $qty = $this->ajustaQtde($products_id, $this->contents[$products_id]['qty']);// $this->contents[$products_id]['qty'];

// products price
        $product_query = tep_db_query("select products_id, products_price, products_free_shipping, products_tax_class_id, products_weight, products_pack_length, products_pack_width, products_pack_height, products_pack_diameter from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        if ($product = tep_db_fetch_array($product_query)) {
          $prid = $product['products_id'];
          $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
          $products_price = $product['products_price'];
          $products_weight = $product['products_weight'];
		  $products_weight = 0;
		  if($product['products_free_shipping'] ==1){
		  	$products_weight = 0;
		  }else{
		  	$products_weight = $product['products_weight'];
		  }
		  

          $specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
          if (tep_db_num_rows ($specials_query)) {
            $specials = tep_db_fetch_array($specials_query);
            $products_price = $specials['specials_new_products_price'];
          }

          $this->total += tep_add_tax($products_price, $products_tax) * $qty;
		  $this->weight += ($qty * $products_weight);
          $comprimento += ($qty * $product['products_pack_length']);
		  $largura += ($qty * $product['products_pack_width']);
		  $altura += ($qty * $product['products_pack_height']);
		  $diametro += ($qty * $product['products_pack_diameter']);

		  
        }
		

// attributes price
        if (isset($this->contents[$products_id]['attributes'])) {
          reset($this->contents[$products_id]['attributes']);
          while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
            $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
            $attribute_price = tep_db_fetch_array($attribute_price_query);
            if ($attribute_price['price_prefix'] == '+') {
              $this->total += $qty * tep_add_tax($attribute_price['options_values_price'], $products_tax);
            } else {
              $this->total -= $qty * tep_add_tax($attribute_price['options_values_price'], $products_tax);
            }
          }
        }
		
      }
	  
	  $this->cubagem = shoppingCart::cubagemCorreios($comprimento, $largura, $altura, $diametro);//Faz o calculo da cubagem e devolver um array com os valores
    }
	
	
	function calculate_price_revenda() {
      $this->total = 0;
      $this->weight = 0;
      if (!is_array($this->contents)) return 0;

      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $qty = $this->ajustaQtde($products_id, $this->contents[$products_id]['qty']);//$this->contents[$products_id]['qty'];

// products price
        $product_query = tep_db_query("select products_id, products_price_revenda, products_free_shipping, products_tax_class_id, products_weight from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        if ($product = tep_db_fetch_array($product_query)) {
          $prid = $product['products_id'];
          $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
          $products_price = $product['products_price_revenda'];
          $products_weight = $product['products_weight'];
		  $products_weight = 0;
		  if($product['products_free_shipping'] ==1){
		  	$products_weight = 0;
		  }else{
		  	$products_weight = $product['products_weight'];
		  }

		  /*	
          $specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
          if (tep_db_num_rows ($specials_query)) {
            $specials = tep_db_fetch_array($specials_query);
            $products_price = $specials['specials_new_products_price'];
          }
		  */

          $this->total += tep_add_tax($products_price, $products_tax) * $qty;
          $this->weight += ($qty * $products_weight);
        }

// attributes price
        if (isset($this->contents[$products_id]['attributes'])) {
          reset($this->contents[$products_id]['attributes']);
          while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
            $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
            $attribute_price = tep_db_fetch_array($attribute_price_query);
            if ($attribute_price['price_prefix'] == '+') {
              $this->total += $qty * tep_add_tax($attribute_price['options_values_price'], $products_tax);
            } else {
              $this->total -= $qty * tep_add_tax($attribute_price['options_values_price'], $products_tax);
            }
          }
        }
      }
    }

    function attributes_price($products_id) {
      $attributes_price = 0;

      if (isset($this->contents[$products_id]['attributes'])) {
        reset($this->contents[$products_id]['attributes']);
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
          $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
          $attribute_price = tep_db_fetch_array($attribute_price_query);
          if ($attribute_price['price_prefix'] == '+') {
            $attributes_price += $attribute_price['options_values_price'];
          } else {
            $attributes_price -= $attribute_price['options_values_price'];
          }
        }
      }

      return $attributes_price;
    }

    function get_products() {
      global $languages_id;

      if (!is_array($this->contents)) return false;

      $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        
		$products_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$products_id . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
        
		
		if ($products = tep_db_fetch_array($products_query)) {
          $prid = $products['products_id'];
          $products_price = $products['products_price'];

          $specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
          if (tep_db_num_rows($specials_query)) {
            $specials = tep_db_fetch_array($specials_query);
            $products_price = $specials['specials_new_products_price'];
          }
		  
		  

          $products_array[] = array('id' => $products_id,
                                    'name' => $products['products_name'],
                                    'description' => $products['products_description'],
                                    'model' => $products['products_model'],
                                    'image' => $products['products_image'],
                                    'price' => $products_price,
                                    'quantity' => $this->ajustaQtde($products_id, $this->contents[$products_id]['qty']),//$this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                                    'tax_class_id' => $products['products_tax_class_id'],
                                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''));
        }
      }

      return $products_array;
    }
	
	
	//FUNÇAO PARA PEGAR PREÇO DE REVENDEDOR
	function get_products_revenda() {
      global $languages_id;

      if (!is_array($this->contents)) return false;

      $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $products_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_image, p.products_price_revenda, p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$products_id . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
        if ($products = tep_db_fetch_array($products_query)) {
          $prid = $products['products_id'];
          $products_price = $products['products_price_revenda'];

		  /*	
          $specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
          if (tep_db_num_rows($specials_query)) {
            $specials = tep_db_fetch_array($specials_query);
            $products_price = $specials['specials_new_products_price'];
          }
		  */

          $products_array[] = array('id' => $products_id,
                                    'name' => $products['products_name'],
                                    'description' => $products['products_description'],
                                    'model' => $products['products_model'],
                                    'image' => $products['products_image'],
                                    'price' => $products_price,
                                    'quantity' => $this->ajustaQtde($products_id, $this->contents[$products_id]['qty']),//$this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                                    'tax_class_id' => $products['products_tax_class_id'],
                                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''));
        }
      }

      return $products_array;
    }
	
	
	//FUNÇÃO PARA PAGAMENTOS FEITO EM DINHEIRO COM DESCONTO
	function get_products_with_dicount() {
      global $languages_id;

      if (!is_array($this->contents)) return false;

      $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
		
		$products_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_price, dp.discount_percent, dp.discount_new_products_price, p.products_image, p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p
									   LEFT JOIN ".TABLE_DISCOUNT_PAYMENT." dp on dp.products_id = p.products_id
									   LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id
									   where p.products_id = '" . (int)$products_id . "' and  pd.language_id = '" . (int)$languages_id . "'");
		$num_rows =  tep_db_num_rows($products_query);

		if($products_query['discount_percent'] == ''){//tem desconto para pagamento a vista
			$specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$products_id . "' and status = '1'");
			$numrows_specials = tep_db_num_rows($specials_query);
			if ($numrows_specials > 0) {
				$specials = tep_db_fetch_array($specials_query);
				$products_price_specials = $specials['specials_new_products_price'];
			}
		}
		
		if ($products = tep_db_fetch_array($products_query)) {
          $prid = $products['products_id'];
		  //echo "select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$products_id . "' and status = '1'";
          if(($products_query['discount_percent'] == '')&&($numrows_specials > 0)){
			  $products_price = $products_price_specials; 
			 
		  }else if(($products_query['discount_percent'] <> '')&&($numrows_specials > 0)){
			  $products_price = $products['discount_new_products_price'];
		  }else{
			  $products_price = $products['products_price'];
		  }

          $products_array[] = array('id' => $products_id,
                                    'name' => $products['products_name'],
                                    'description' => $products['products_description'],
                                    'model' => $products['products_model'],
                                    'image' => $products['products_image'],
                                    'price' => $products_price,
                                    'quantity' => $this->ajustaQtde($products_id, $this->contents[$products_id]['qty']),//$this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                                    'tax_class_id' => $products['products_tax_class_id'],
									'info_discount' => $products['discount_percent'],
                                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''));
        }
      }

      return $products_array;
    }
	
	//FUNÇÃO PARA PAGAMENTOS FEITO EM DINHEIRO COM DESCONTO
	function get_products_with_dicount_revenda() {
      global $languages_id;

      if (!is_array($this->contents)) return false;

      $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
		
		$products_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, dp.discount_new_products_price as products_price_revenda, dp.discount_percent, p.products_image,  p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, ".TABLE_DISCOUNT_PAYMENT." dp where p.products_id = '" . (int)$products_id . "' and pd.products_id = p.products_id and dp.products_id = p.products_id and  pd.language_id = '" . (int)$languages_id . "'");
		$num_rows =  tep_db_num_rows($products_query);
		
		if($num_rows <=0){
			$products_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_image, p.products_price_revenda, p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$products_id . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
		}
		
		if ($products = tep_db_fetch_array($products_query)) {
          $prid = $products['products_id'];
          $products_price = $products['products_price_revenda'];

          $products_array[] = array('id' => $products_id,
                                    'name' => $products['products_name'],
                                    'description' => $products['products_description'],
                                    'model' => $products['products_model'],
                                    'image' => $products['products_image'],
                                    'price' => $products_price,
                                    'quantity' => $this->ajustaQtde($products_id, $this->contents[$products_id]['qty']),//$this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                                    'tax_class_id' => $products['products_tax_class_id'],
									'info_discount' => $products['discount_percent'],
                                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''));
        }
      }

      return $products_array;
    }
	

    function show_total() {
      $this->calculate();

      return $this->total;
    }
	
	function show_total_revenda() {
      $this->calculate_price_revenda();

      return $this->total;
    }

    function show_weight() {
      $this->calculate();

      return $this->weight;
    }
	
	//CUBAGEM
/*
	function show_length() {
      $this->calculate();

      return $this->length;
    }
	
	function show_width() {
      $this->calculate();

      return $this->width;
    }
	
	function show_height() {
      $this->calculate();

      return $this->height;
    }
	
	function show_diameter() {
      $this->calculate();

      return $this->diameter;
    }*/
	
	function show_cubagem() {
      $this->calculate();

      return $this->cubagem;
    }
	//FIM CUBAGEM

    function generate_cart_id($length = 5) {
      return tep_create_random_value($length, 'digits');
    }

    function get_content_type() {
      $this->content_type = false;

      if ( (DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0) ) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          if (isset($this->contents[$products_id]['attributes'])) {
            reset($this->contents[$products_id]['attributes']);
            while (list(, $value) = each($this->contents[$products_id]['attributes'])) {
              $virtual_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad where pa.products_id = '" . (int)$products_id . "' and pa.options_values_id = '" . (int)$value . "' and pa.products_attributes_id = pad.products_attributes_id");
              $virtual_check = tep_db_fetch_array($virtual_check_query);

              if ($virtual_check['total'] > 0) {
                switch ($this->content_type) {
                  case 'physical':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'virtual';
                    break;
                }
              } else {
                switch ($this->content_type) {
                  case 'virtual':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'physical';
                    break;
                }
              }
            }
          } else {
            switch ($this->content_type) {
              case 'virtual':
                $this->content_type = 'mixed';

                return $this->content_type;
                break;
              default:
                $this->content_type = 'physical';
                break;
            }
          }
        }
      } else {
        $this->content_type = 'physical';
      }

      return $this->content_type;
    }

    function unserialize($broken) {
      for(reset($broken);$kv=each($broken);) {
        $key=$kv['key'];
        if (gettype($this->$key)!="user function")
        $this->$key=$kv['value'];
      }
    }

  }
?>
