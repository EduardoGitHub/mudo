<?php
/*
  $Id: general.php,v 1.231 2003/07/09 01:15:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

////

//////////////////////////////////////////////////////////////
/*
FUN��O CONVERTE DATA DE INGL�S PARA PORTUGUES
Como utilizar a fun��o.
$today = getdate(strtotime($product_info['products_date_added']));
$cadastrado_dia = '<br>'.diaDaSemana($today["weekday"]).' '.$today["mday"].' '.mesReferente($today["month"]).' de '.$today["year"];
*/
/////////////////////////////////////////////////////////////

//funcao para conveter semana do ingles para portugues
	function diaDaSemana($diaSemana){ 
		switch ($diaSemana) {
		   case 'Sunday':    return 'Domingo';       break;
		   case 'Monday':    return 'Segunda-feira'; break;
		   case 'Tuesday':   return 'Ter�a-feira';    break;
		   case 'Wednesday': return 'Quarta-feira';  break;
		   case 'Thursday':  return 'Quinta-feira';  break;
		   case 'Friday':    return 'Sexta-feira';   break;
		   case 'Saturday':  return 'S�bado';        break;
		}
	} 
	
	//funcao para conveter mes do ingles para portugues
	function mesReferente($diaSemana){ 
		switch ($diaSemana) {
			case 'January':   return 'Janeiro';   break;
			case 'February':  return 'Fevereiro'; break;
			case 'March':     return 'Mar�o';     break;
			case 'April':     return 'Abril';     break;
			case 'May':       return 'Maio';      break;
			case 'June':      return 'Junho';     break;
			case 'July':      return 'Julho';     break;
			case 'August':    return 'Agosto';    break;
			case 'September': return 'Setembro';  break;
			case 'October':   return 'Outubro';   break;
			case 'November':  return 'Novembro';  break;
			case 'December':  return 'Dezembro';  break;
		}
	}
	
// fun��o adicionar dias em uma data
function addDayIntoDate($date,$days) {
	 $thisyear = substr ( $date, 0, 4 );
	 $thismonth = substr ( $date, 4, 2 );
	 $thisday =  substr ( $date, 6, 2 );
	 $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday + $days, $thisyear );
	 return strftime("%Y%m%d", $nextdate);
}

//fun��o para subtrair dias em uma data
function subDayIntoDate($date,$days) {
     $thisyear = substr ( $date, 0, 4 );
     $thismonth = substr ( $date, 4, 2 );
     $thisday =  substr ( $date, 6, 2 );
     $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday - $days, $thisyear );
     return strftime("%Y%m%d", $nextdate);
}
	

// Stop from parsing any further PHP code
  function tep_exit() {
   tep_session_close();
   exit();
  }
  
  //Coloca caracters.
  function tep_putcaracters($valor,$mask)
	  {
		if($valor <> ''){
		$tamanho_string = strlen($valor);
		for($cont =0; $cont < $tamanho_string; $cont++)
			{
				$x = strpos($mask, '#');
				if ($x >= 0)
				{
					$mask[$x] = $valor[$cont];
				}
			}
			return $mask;
		}else{
			return;
		}	
	  }
	  
   //Remove caracters
   function tep_removecaracters($valor)
  	{
		$caracters = array(".", "-", "/", ",", "(", ")"," ");
		$valor = str_replace($caracters,"",$valor);
		return $valor;
	}

////
// Redirect to another page or site
  function tep_redirect($url) {
    if ( (ENABLE_SSL == true) && (getenv('HTTPS') == 'on') ) { // We are loading an SSL page
      if (substr($url, 0, strlen(HTTP_SERVER)) == HTTP_SERVER) { // NONSSL url
        $url = HTTPS_SERVER . substr($url, strlen(HTTP_SERVER)); // Change it to SSL
      }
    }

    header('Location: ' . $url);

    tep_exit();
  }
  
  function tep_redirect_banner($url) {
    if ( (ENABLE_SSL == true) && (getenv('HTTPS') == 'on') ) { // We are loading an SSL page
      if (substr($url, 0, strlen(HTTP_SERVER)) == HTTP_SERVER) { // NONSSL url
        $url = HTTPS_SERVER . substr($url, strlen(HTTP_SERVER)); // Change it to SSL
      }
    }

    header('Location: ' . tep_href_link($url));

    tep_exit();
  }

////
// Parse the data used in the html tags to ensure the tags will not break
  function tep_parse_input_field_data($data, $parse) {
    return strtr(trim($data), $parse);
  }

  function tep_output_string($string, $translate = false, $protected = false) {
    if ($protected == true) {
      return htmlspecialchars($string);
    } else {
      if ($translate == false) {
        return tep_parse_input_field_data($string, array('"' => '&quot;'));
      } else {
        return tep_parse_input_field_data($string, $translate);
      }
    }
  }

  function tep_output_string_protected($string) {
    return tep_output_string($string, false, true);
  }

  function tep_sanitize_string($string) {
    $string = preg_replace('/ +/', ' ', trim($string));

    return preg_replace("/[<>]/", '_', $string);
  }

////
// Return a random row from a database query
  function tep_random_select($query) {
    $random_product = '';
    $random_query = tep_db_query($query);
    $num_rows = tep_db_num_rows($random_query);
    if ($num_rows > 0) {
      $random_row = tep_rand(0, ($num_rows - 1));
      tep_db_data_seek($random_query, $random_row);
      $random_product = tep_db_fetch_array($random_query);
    }

    return $random_product;
  }

////
// Return a product's name
// TABLES: products
  function tep_get_products_name($product_id, $language = '') {
    global $languages_id;

    if (empty($language)) $language = $languages_id;

    $product_query = tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_name'];
  }
  
  function tep_get_products_availability($product_id, $language = '') {
    global $languages_id;

    if (empty($language)) $language = $languages_id;

    $product_query = tep_db_query("select products_availability from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_availability'];
  }

////
// Return a product's special price (returns nothing if there is no offer)
// TABLES: products
  function tep_get_products_special_price($product_id) {
    $product_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$product_id . "' and status");
    $product = tep_db_fetch_array($product_query);

    return $product['specials_new_products_price'];
  }

////
// Return a product's stock
// TABLES: products
  function tep_get_products_stock($products_id) {
    $products_id = tep_get_prid($products_id);
    $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
    $stock_values = tep_db_fetch_array($stock_query);

    return $stock_values['products_quantity'];
  }

////
// Check if the required stock is available
// If insufficent stock is available return an out of stock message
  function tep_check_stock($products_id, $products_quantity) {
    $stock_left = tep_get_products_stock($products_id) - $products_quantity;
    $out_of_stock = '';

    if ($stock_left < 0) {
      $out_of_stock = '<span class="markProductOutOfStock">' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</span>';
    }

    return $out_of_stock;
  }

////
// Break a word in a string if it is longer than a specified length ($len)
  function tep_break_string($string, $len, $break_char = '-') {
    $l = 0;
    $output = '';
    for ($i=0, $n=strlen($string); $i<$n; $i++) {
      $char = substr($string, $i, 1);
      if ($char != ' ') {
        $l++;
      } else {
        $l = 0;
      }
      if ($l > $len) {
        $l = 1;
        $output .= $break_char;
      }
      $output .= $char;
    }

    return $output;
  }

////
// Return all HTTP GET variables, except those passed as a parameter
  function tep_get_all_get_params($exclude_array = '') {
    global $HTTP_GET_VARS;

    if (!is_array($exclude_array)) $exclude_array = array();

    $get_url = '';
    if (is_array($HTTP_GET_VARS) && (sizeof($HTTP_GET_VARS) > 0)) {
      reset($HTTP_GET_VARS);
      while (list($key, $value) = each($HTTP_GET_VARS)) {
        if ( (strlen($value) > 0) && ($key != tep_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y') ) {
          $get_url .= $key . '=' . rawurlencode(stripslashes($value)) . '&';
        }
      }
    }

    return $get_url;
  }

////
// Returns an array with countries
// TABLES: countries
  function tep_get_countries($countries_id = '', $with_iso_codes = false) {
    $countries_array = array();
    if (tep_not_null($countries_id)) {
      if ($with_iso_codes == true) {
        $countries = tep_db_query("select countries_name, countries_iso_code_2, countries_iso_code_3 from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$countries_id . "' order by countries_name");
        $countries_values = tep_db_fetch_array($countries);
        $countries_array = array('countries_name' => $countries_values['countries_name'],
                                 'countries_iso_code_2' => $countries_values['countries_iso_code_2'],
                                 'countries_iso_code_3' => $countries_values['countries_iso_code_3']);
      } else {
        $countries = tep_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$countries_id . "'");
        $countries_values = tep_db_fetch_array($countries);
        $countries_array = array('countries_name' => $countries_values['countries_name']);
      }
    } else {
      $countries = tep_db_query("select countries_id, countries_name from " . TABLE_COUNTRIES . " order by countries_name");
      while ($countries_values = tep_db_fetch_array($countries)) {
        $countries_array[] = array('countries_id' => $countries_values['countries_id'],
                                   'countries_name' => $countries_values['countries_name']);
      }
    }

    return $countries_array;
  }

////
// Alias function to tep_get_countries, which also returns the countries iso codes
  function tep_get_countries_with_iso_codes($countries_id) {
    return tep_get_countries($countries_id, true);
  }

////
// Generate a path to categories
  function tep_get_path($current_category_id = '') {
    global $cPath_array;

    if (tep_not_null($current_category_id)) {
      $cp_size = sizeof($cPath_array);
      if ($cp_size == 0) {
        $cPath_new = $current_category_id;
      } else {
        $cPath_new = '';
        $last_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$cPath_array[($cp_size-1)] . "'");
        $last_category = tep_db_fetch_array($last_category_query);

        $current_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
        $current_category = tep_db_fetch_array($current_category_query);

        if ($last_category['parent_id'] == $current_category['parent_id']) {
          for ($i=0; $i<($cp_size-1); $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        } else {
          for ($i=0; $i<$cp_size; $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        }
        $cPath_new .= '_' . $current_category_id;

        if (substr($cPath_new, 0, 1) == '_') {
          $cPath_new = substr($cPath_new, 1);
        }
      }
    } else {
      $cPath_new = implode('_', $cPath_array);
    }

    return 'cPath=' . $cPath_new;
  }

////
// Returns the clients browser
  function tep_browser_detect($component) {
    global $HTTP_USER_AGENT;

    return stristr($HTTP_USER_AGENT, $component);
  }

////
// Alias function to tep_get_countries()
  function tep_get_country_name($country_id) {
    $country_array = tep_get_countries($country_id);

    return $country_array['countries_name'];
  }

////
// Returns the zone (State/Province) name
// TABLES: zones
  function tep_get_zone_name($country_id, $zone_id, $default_zone) {
    $zone_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' and zone_id = '" . (int)$zone_id . "'");
    if (tep_db_num_rows($zone_query)) {
      $zone = tep_db_fetch_array($zone_query);
      return $zone['zone_name'];
    } else {
      return $default_zone;
    }
  }

////
// Returns the zone (State/Province) code
// TABLES: zones
  function tep_get_zone_code($country_id, $zone_id, $default_zone) {
    $zone_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' and zone_id = '" . (int)$zone_id . "'");
    if (tep_db_num_rows($zone_query)) {
      $zone = tep_db_fetch_array($zone_query);
      return $zone['zone_code'];
    } else {
      return $default_zone;
    }
  }

////
// Wrapper function for round()
  function tep_round($number, $precision) {
    if (strpos($number, '.') && (strlen(substr($number, strpos($number, '.')+1)) > $precision)) {
      $number = substr($number, 0, strpos($number, '.') + 1 + $precision + 1);

      if (substr($number, -1) >= 5) {
        if ($precision > 1) {
          $number = substr($number, 0, -1) + ('0.' . str_repeat(0, $precision-1) . '1');
        } elseif ($precision == 1) {
          $number = substr($number, 0, -1) + 0.1;
        } else {
          $number = substr($number, 0, -1) + 1;
        }
      } else {
        $number = substr($number, 0, -1);
      }
    }

    return $number;
  }

////
// Returns the tax rate for a zone / class
// TABLES: tax_rates, zones_to_geo_zones
  function tep_get_tax_rate($class_id, $country_id = -1, $zone_id = -1) {
    global $customer_zone_id, $customer_country_id;

    if ( ($country_id == -1) && ($zone_id == -1) ) {
      if (!tep_session_is_registered('customer_id')) {
        $country_id = STORE_COUNTRY;
        $zone_id = STORE_ZONE;
      } else {
        $country_id = $_SESSION['customer_country_id'];
        $zone_id = $_SESSION['customer_zone_id'];
      }
    }

    $tax_query = tep_db_query("select sum(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' group by tr.tax_priority");
    if (tep_db_num_rows($tax_query)) {
      $tax_multiplier = 1.0;
      while ($tax = tep_db_fetch_array($tax_query)) {
        $tax_multiplier *= 1.0 + ($tax['tax_rate'] / 100);
      }
      return ($tax_multiplier - 1.0) * 100;
    } else {
      return 0;
    }
  }

////
// Return the tax description for a zone / class
// TABLES: tax_rates;
  function tep_get_tax_description($class_id, $country_id, $zone_id) {
    $tax_query = tep_db_query("select tax_description from " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' order by tr.tax_priority");
    if (tep_db_num_rows($tax_query)) {
      $tax_description = '';
      while ($tax = tep_db_fetch_array($tax_query)) {
        $tax_description .= $tax['tax_description'] . ' + ';
      }
      $tax_description = substr($tax_description, 0, -3);

      return $tax_description;
    } else {
      return TEXT_UNKNOWN_TAX_RATE;
    }
  }

////
// Add tax to a products price
  function tep_add_tax($price, $tax) {
    global $currencies;

    if ( (DISPLAY_PRICE_WITH_TAX == 'true') && ($tax > 0) ) {
      return tep_round($price, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']) + tep_calculate_tax($price, $tax);
    } else {
      return tep_round($price, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']);
    }
  }

// Calculates Tax rounding the result
  function tep_calculate_tax($price, $tax) {
    global $currencies;

    return tep_round($price * $tax / 100, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']);
  }

////
// Return the number of products in a category
// TABLES: products, products_to_categories, categories
  function tep_count_products_in_category($category_id, $include_inactive = false) {
    $products_count = 0;
    if ($include_inactive == true) {
      $products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p.products_status = '1' and p2c.categories_id = '" . (int)$category_id . "'");
    } else {
		
      $products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p.products_status = '1' and p2c.categories_id = '" . (int)$category_id . "'");
	  
    }
    $products = tep_db_fetch_array($products_query);
    $products_count += $products['total'];

/*
    $child_categories_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$category_id . "'");
    if (tep_db_num_rows($child_categories_query)) {
      while ($child_categories = tep_db_fetch_array($child_categories_query)) {
        $products_count += tep_count_products_in_category($child_categories['categories_id'], $include_inactive);
      }
  
    }
*/	
    return $products_count;
  }

////
// Return true if the category has subcategories
// TABLES: categories
  function tep_has_category_subcategories($category_id) {
    $child_category_query = tep_db_query("select count(*) as count from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$category_id . "'");
    $child_category = tep_db_fetch_array($child_category_query);

    if ($child_category['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }

////
// Returns the address_format_id for the given country
// TABLES: countries;
  function tep_get_address_format_id($country_id) {
    $address_format_query = tep_db_query("select address_format_id as format_id from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$country_id . "'");
    if (tep_db_num_rows($address_format_query)) {
      $address_format = tep_db_fetch_array($address_format_query);
      return $address_format['format_id'];
    } else {
      return '1';
    }
  }

////
// Return a formatted address
// TABLES: address_format
  function tep_address_format($address_format_id, $address, $html, $boln, $eoln) {
    $address_format_query = tep_db_query("select address_format as format from " . TABLE_ADDRESS_FORMAT . " where address_format_id = '" . (int)$address_format_id . "'");
    $address_format = tep_db_fetch_array($address_format_query);

    $company = tep_output_string_protected($address['company']);
    if (isset($address['firstname']) && tep_not_null($address['firstname'])) {
      $firstname = tep_output_string_protected($address['firstname']);
      $lastname = tep_output_string_protected($address['lastname']);
    } elseif (isset($address['name']) && tep_not_null($address['name'])) {
      $firstname = tep_output_string_protected($address['name']);
      $lastname = '';
    } else {
      $firstname = '';
      $lastname = '';
    }
    $street = tep_output_string_protected($address['street_address']);
	$number = tep_output_string_protected($address['street_number']);
    $suburb = tep_output_string_protected($address['suburb']);
	$complemento = tep_output_string_protected($address['complemento']);
    $city = tep_output_string_protected($address['city']);
    $state = tep_output_string_protected($address['state']);
    if (isset($address['country_id']) && tep_not_null($address['country_id'])) {
      $country = tep_get_country_name($address['country_id']);

      if (isset($address['zone_id']) && tep_not_null($address['zone_id'])) {
        $state = tep_get_zone_code($address['country_id'], $address['zone_id'], $state);
      }
    } elseif (isset($address['country']) && tep_not_null($address['country'])) {
      $country = tep_output_string_protected($address['country']);
    } else {
      $country = '';
    }
    $postcode = tep_output_string_protected($address['postcode']);
    $zip = $postcode;

    if ($html) {
// HTML Mode
      $HR = '<hr>';
      $hr = '<hr>';
      if ( ($boln == '') && ($eoln == "\n") ) { // Values not specified, use rational defaults
        $CR = '<br>';
        $cr = '<br>';
        $eoln = $cr;
      } else { // Use values supplied
        $CR = $eoln . $boln;
        $cr = $CR;
      }
    } else {
// Text Mode
      $CR = $eoln;
      $cr = $CR;
      $HR = '----------------------------------------';
      $hr = '----------------------------------------';
    }

$statecomma = ''; 
$streets = $street; 
if (isset($street2) && $street2 != '') $streets = $street ; 
if (isset($suburb) && $suburb != '') $streets = $street . $cr .$number. $cr . $complemento . $cr . $suburb; 
if (isset($country) && $country == '') $country = tep_output_string_protected($address['country']); 
if (isset($state) && $state != '') $statecomma = tep_putcaracters($zip, '#####-###').$cr.$state . ', ';
    $fmt = $address_format['format'];
    eval("\$address = \"$fmt\";");


    if ( (ACCOUNT_COMPANY == 'true') && (tep_not_null($company)) ) {
      $address = $company . $cr . $address;
    }

    return $address;
  }

////
// Return a formatted address
// TABLES: customers, address_book
  // TABLES: customers, address_book
function tep_address_label($customers_id, $address_id = 1, $html = false, $boln = '', $eoln = "\n") {
$address_query = tep_db_query("select entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_number as street_number, entry_street_address as street_address, entry_suburb as suburb, entry_complemento as complemento, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customers_id . "' and address_book_id = '" . (int)$address_id . "'");
$address = tep_db_fetch_array($address_query);$format_id = tep_get_address_format_id($address['country_id']);

    $format_id = tep_get_address_format_id($address['country_id']);

    return tep_address_format($format_id, $address, $html, $boln, $eoln);
  }

  function tep_row_number_format($number) {
    if ( ($number < 10) && (substr($number, 0, 1) != '0') ) $number = '0' . $number;

    return $number;
  }

 function tep_get_categories($categories_array = '', $parent_id = '0', $indent = '') {
    global $languages_id;

    if (!is_array($categories_array)) $categories_array = array();

    $categories_query = tep_db_query("select c.categories_id, cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where parent_id = '" . (int)$parent_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and categories_highlights = 0 order by sort_order, cd.categories_name");
    while ($categories = tep_db_fetch_array($categories_query)) {
      $categories_array[] = array('id' => $categories['categories_id'],
                                  'text' => $indent . $categories['categories_name']);

      if ($categories['categories_id'] != $parent_id) {
        $categories_array = tep_get_categories($categories_array, $categories['categories_id'], $indent . '&nbsp;&nbsp;');
      }
    }

    return $categories_array;
  }

  function tep_get_manufacturers($manufacturers_array = '') {
    if (!is_array($manufacturers_array)) $manufacturers_array = array();

    $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
      $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'], 'text' => $manufacturers['manufacturers_name']);
    }

    return $manufacturers_array;
  }

////
// Return all subcategory IDs
// TABLES: categories
  function tep_get_subcategories(&$subcategories_array, $parent_id = 0) {
    $subcategories_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$parent_id . "'");
    while ($subcategories = tep_db_fetch_array($subcategories_query)) {
      $subcategories_array[sizeof($subcategories_array)] = $subcategories['categories_id'];
      if ($subcategories['categories_id'] != $parent_id) {
        tep_get_subcategories($subcategories_array, $subcategories['categories_id']);
      }
    }
  }

// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
  function tep_date_long($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return strftime(DATE_FORMAT_LONG, mktime($hour,$minute,$second,$month,$day,$year));
  }

////
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// NOTE: Includes a workaround for dates before 01/01/1970 that fail on windows servers
  function tep_date_short($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || empty($raw_date) ) return false;

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    if (@date('Y', mktime($hour, $minute, $second, $month, $day, $year)) == $year) {
      return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    } else {
      return ereg_replace('2037' . '$', $year, date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037)));
    }
  }

////
// Parse search string into indivual objects
  function tep_parse_search_string($search_str = '', &$objects) {
    $search_str = trim(strtolower($search_str));

// Break up $search_str on whitespace; quoted string will be reconstructed later
    $pieces = explode('[[:space:]]+', $search_str);
    $objects = array();
    $tmpstring = '';
    $flag = '';

    for ($k=0; $k<count($pieces); $k++) {
      while (substr($pieces[$k], 0, 1) == '(') {
        $objects[] = '(';
        if (strlen($pieces[$k]) > 1) {
          $pieces[$k] = substr($pieces[$k], 1);
        } else {
          $pieces[$k] = '';
        }
      }

      $post_objects = array();

      while (substr($pieces[$k], -1) == ')')  {
        $post_objects[] = ')';
        if (strlen($pieces[$k]) > 1) {
          $pieces[$k] = substr($pieces[$k], 0, -1);
        } else {
          $pieces[$k] = '';
        }
      }

// Check individual words

      if ( (substr($pieces[$k], -1) != '"') && (substr($pieces[$k], 0, 1) != '"') ) {
        $objects[] = trim($pieces[$k]);

        for ($j=0; $j<count($post_objects); $j++) {
          $objects[] = $post_objects[$j];
        }
      } else {
/* This means that the $piece is either the beginning or the end of a string.
   So, we'll slurp up the $pieces and stick them together until we get to the
   end of the string or run out of pieces.
*/

// Add this word to the $tmpstring, starting the $tmpstring
        $tmpstring = trim(ereg_replace('"', ' ', $pieces[$k]));

// Check for one possible exception to the rule. That there is a single quoted word.
        if (substr($pieces[$k], -1 ) == '"') {
// Turn the flag off for future iterations
          $flag = 'off';

          $objects[] = trim($pieces[$k]);

          for ($j=0; $j<count($post_objects); $j++) {
            $objects[] = $post_objects[$j];
          }

          unset($tmpstring);

// Stop looking for the end of the string and move onto the next word.
          continue;
        }

// Otherwise, turn on the flag to indicate no quotes have been found attached to this word in the string.
        $flag = 'on';

// Move on to the next word
        $k++;

// Keep reading until the end of the string as long as the $flag is on

        while ( ($flag == 'on') && ($k < count($pieces)) ) {
          while (substr($pieces[$k], -1) == ')') {
            $post_objects[] = ')';
            if (strlen($pieces[$k]) > 1) {
              $pieces[$k] = substr($pieces[$k], 0, -1);
            } else {
              $pieces[$k] = '';
            }
          }

// If the word doesn't end in double quotes, append it to the $tmpstring.
          if (substr($pieces[$k], -1) != '"') {
// Tack this word onto the current string entity
            $tmpstring .= ' ' . $pieces[$k];

// Move on to the next word
            $k++;
            continue;
          } else {
/* If the $piece ends in double quotes, strip the double quotes, tack the
   $piece onto the tail of the string, push the $tmpstring onto the $haves,
   kill the $tmpstring, turn the $flag "off", and return.
*/
            $tmpstring .= ' ' . trim(ereg_replace('"', ' ', $pieces[$k]));

// Push the $tmpstring onto the array of stuff to search for
            $objects[] = trim($tmpstring);

            for ($j=0; $j<count($post_objects); $j++) {
              $objects[] = $post_objects[$j];
            }

            unset($tmpstring);

// Turn off the flag to exit the loop
            $flag = 'off';
          }
        }
      }
    }

// add default logical operators if needed
    $temp = array();
    for($i=0; $i<(count($objects)-1); $i++) {
      $temp[] = $objects[$i];
      if ( ($objects[$i] != 'and') &&
           ($objects[$i] != 'or') &&
           ($objects[$i] != '(') &&
           ($objects[$i+1] != 'and') &&
           ($objects[$i+1] != 'or') &&
           ($objects[$i+1] != ')') ) {
        $temp[] = ADVANCED_SEARCH_DEFAULT_OPERATOR;
      }
    }
    $temp[] = $objects[$i];
    $objects = $temp;

    $keyword_count = 0;
    $operator_count = 0;
    $balance = 0;
    for($i=0; $i<count($objects); $i++) {
      if ($objects[$i] == '(') $balance --;
      if ($objects[$i] == ')') $balance ++;
      if ( ($objects[$i] == 'and') || ($objects[$i] == 'or') ) {
        $operator_count ++;
      } elseif ( ($objects[$i]) && ($objects[$i] != '(') && ($objects[$i] != ')') ) {
        $keyword_count ++;
      }
    }

    if ( ($operator_count < $keyword_count) && ($balance == 0) ) {
      return true;
    } else {
      return false;
    }
  }

////
// Check date
  function tep_checkdate($date_to_check, $format_string, &$date_array) {
    $separator_idx = -1;

    $separators = array('-', ' ', '/', '.');
    $month_abbr = array('jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');
    $no_of_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    $format_string = strtolower($format_string);

    if (strlen($date_to_check) != strlen($format_string)) {
      return false;
    }

    $size = sizeof($separators);
    for ($i=0; $i<$size; $i++) {
      $pos_separator = strpos($date_to_check, $separators[$i]);
      if ($pos_separator != false) {
        $date_separator_idx = $i;
        break;
      }
    }

    for ($i=0; $i<$size; $i++) {
      $pos_separator = strpos($format_string, $separators[$i]);
      if ($pos_separator != false) {
        $format_separator_idx = $i;
        break;
      }
    }

    if ($date_separator_idx != $format_separator_idx) {
      return false;
    }

    if ($date_separator_idx != -1) {
      $format_string_array = explode( $separators[$date_separator_idx], $format_string );
      if (sizeof($format_string_array) != 3) {
        return false;
      }

      $date_to_check_array = explode( $separators[$date_separator_idx], $date_to_check );
      if (sizeof($date_to_check_array) != 3) {
        return false;
      }

      $size = sizeof($format_string_array);
      for ($i=0; $i<$size; $i++) {
        if ($format_string_array[$i] == 'mm' || $format_string_array[$i] == 'mmm') $month = $date_to_check_array[$i];
        if ($format_string_array[$i] == 'dd') $day = $date_to_check_array[$i];
        if ( ($format_string_array[$i] == 'yyyy') || ($format_string_array[$i] == 'aaaa') ) $year = $date_to_check_array[$i];
      }
    } else {
      if (strlen($format_string) == 8 || strlen($format_string) == 9) {
        $pos_month = strpos($format_string, 'mmm');
        if ($pos_month != false) {
          $month = substr( $date_to_check, $pos_month, 3 );
          $size = sizeof($month_abbr);
          for ($i=0; $i<$size; $i++) {
            if ($month == $month_abbr[$i]) {
              $month = $i;
              break;
            }
          }
        } else {
          $month = substr($date_to_check, strpos($format_string, 'mm'), 2);
        }
      } else {
        return false;
      }

      $day = substr($date_to_check, strpos($format_string, 'dd'), 2);
      $year = substr($date_to_check, strpos($format_string, 'yyyy'), 4);
    }

    if (strlen($year) != 4) {
      return false;
    }

    if (!settype($year, 'integer') || !settype($month, 'integer') || !settype($day, 'integer')) {
      return false;
    }

    if ($month > 12 || $month < 1) {
      return false;
    }

    if ($day < 1) {
      return false;
    }

    if (tep_is_leap_year($year)) {
      $no_of_days[1] = 29;
    }

    if ($day > $no_of_days[$month - 1]) {
      return false;
    }

    $date_array = array($year, $month, $day);

    return true;
  }

////
// Check if year is a leap year
  function tep_is_leap_year($year) {
    if ($year % 100 == 0) {
      if ($year % 400 == 0) return true;
    } else {
      if (($year % 4) == 0) return true;
    }

    return false;
  }

////
// Return table heading with sorting capabilities
  function tep_create_sort_heading($sortby, $colnum, $heading) {
    global $PHP_SELF;

    $sort_prefix = '';
    $sort_suffix = '';

    if ($sortby) {
      $sort_prefix = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('page', 'info', 'sort')) . 'page=1&sort=' . $colnum . ($sortby == $colnum . 'a' ? 'd' : 'a')) . '" title="' . tep_output_string(TEXT_SORT_PRODUCTS . ($sortby == $colnum . 'd' || substr($sortby, 0, 1) != $colnum ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . '" class="productListing-heading">' ;
      $sort_suffix = (substr($sortby, 0, 1) == $colnum ? (substr($sortby, 1, 1) == 'a' ? '+' : '-') : '') . '</a>';
    }

    return $sort_prefix . $heading . $sort_suffix;
  }

////
// Recursively go through the categories and retreive all parent categories IDs
// TABLES: categories
  function tep_get_parent_categories(&$categories, $categories_id) {
    $parent_categories_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$categories_id . "'");
    while ($parent_categories = tep_db_fetch_array($parent_categories_query)) {
      if ($parent_categories['parent_id'] == 0) return true;
      $categories[sizeof($categories)] = $parent_categories['parent_id'];
      if ($parent_categories['parent_id'] != $categories_id) {
        tep_get_parent_categories($categories, $parent_categories['parent_id']);
      }
    }
  }

////
// Construct a category path to the product
// TABLES: products_to_categories
  function tep_get_product_path($products_id) {
    $cPath = '';

    $category_query = tep_db_query("select p2c.categories_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = '" . (int)$products_id . "' and p.products_status = '1' and p.products_id = p2c.products_id limit 1");
    if (tep_db_num_rows($category_query)) {
      $category = tep_db_fetch_array($category_query);

      $categories = array();
      tep_get_parent_categories($categories, $category['categories_id']);

      $categories = array_reverse($categories);

      $cPath = implode('_', $categories);

      if (tep_not_null($cPath)) $cPath .= '_';
      $cPath .= $category['categories_id'];
    }

    return $cPath;
  }

////
// Return a product ID with attributes
  function tep_get_uprid($prid, $params) {
    $uprid = $prid;
    if ( (is_array($params)) && (!strstr($prid, '{')) ) {
      while (list($option, $value) = each($params)) {
        $uprid = $uprid . '{' . $option . '}' . $value;
      }
    }

    return $uprid;
  }

////
// Return a product ID from a product ID with attributes
  function tep_get_prid($uprid) {
    $pieces = explode('{', $uprid);

    return $pieces[0];
  }

////
// Return a customer greeting
  function tep_customer_greeting() {
    global $customer_id, $customer_first_name;

    if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
      $greeting_string = sprintf(TEXT_GREETING_PERSONAL, tep_output_string_protected($customer_first_name), tep_href_link(FILENAME_PRODUCTS_NEW));
    } else {
      $greeting_string = sprintf(TEXT_GREETING_GUEST, tep_href_link(FILENAME_LOGIN, '', 'SSL'), tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
    }

    return $greeting_string;
  }

////
//! Send email (text/html) using MIME
// This is the central mail function. The SMTP Server should be configured
// correct in php.ini
// Parameters:
// $to_name           The name of the recipient, e.g. "Jan Wildeboer"
// $to_email_address  The eMail address of the recipient,
//                    e.g. jan.wildeboer@gmx.de
// $email_subject     The subject of the eMail
// $email_text        The text of the eMail, may contain HTML entities
// $from_email_name   The name of the sender, e.g. Shop Administration
// $from_email_adress The eMail address of the sender,
//                    e.g. info@mytepshop.com

  function tep_mail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address) {
    if (SEND_EMAILS != 'true') return false;

    // Instantiate a new mail object
    $message = new email(array('X-Mailer: osCommerce Mailer'));

    // Build the text version
    $text = strip_tags($email_text);
    if (EMAIL_USE_HTML == 'true') {
      $message->add_html($email_text, $text);
	  
    } else {
      $message->add_text($text);
    }

    // Send message
    $message->build_message();
    $message->send($to_name, $to_email_address, $from_email_name, $from_email_address, $email_subject);
  }
  
  
  function tep_sendMail($to_email_address, $email_subject, $html, $from_email_name, $from_email_address){ //NOVO
  
  	$smtp_endereco = ENTRY_EMAIL_HOST; // coloque aqui seu endere�o ou ip do servidor SMTP
	$usuario_smtp = ENTRY_EMAIL_USER; // coloque aqui seu usu�rio SMTP em geral � o pr�prio email que envia.
	$senha_smtp = ENTRY_EMAIL_PASSWORD; // coloque aqui sua senha para o usu�rio SMTP acima.
	
	//$mensagem_sucesso = $_POST['SuccessDocument']; // coloque aqui sua mensagem de sucesso ao envio do formul�rio.
	$mail = new PHPMailer(); // envodo de email com autenticacao do provedor
	$mail->SMTP_PORT = ENTRY_EMAIL_PORT; // ajusto a porta de smt a ser utilizada. Neste caso, a 587 que o GMail utiliza
	$mail->SMTPSecure = ENTRY_EMAIL_COMUNICATION; // ajusto o tipo de comunica��o a ser utilizada, no caso, a TLS do GMail
	$mail->SetLanguage("br", "language/");
	$mail->IsSMTP();
	$mail->IsHTML(true);
	//Cria PHPmailer class
	$mail->From = $from_email_address; //email do remetente
	$mail->FromName =  $from_email_name; //Nome de formatado do remetente
	$mail->Host = "$smtp_endereco"; //Pegando dados do alterar_esse_arquivo.php
	$mail->Mailer = "smtp"; //Usando protocolo SMTP

	$email_to = strstr($to_email_address,',');
	if($email_to){
	
		$email_to = explode(',',$to_email_address);
		for($cont = 0; $cont < sizeof($email_to); $cont++){
		$mail->AddAddress($email_to[$cont]);  // coloque aqui o endere�o de email que deseja receber as mensagems do formul�rio de contato.
		}
    }else $mail->AddAddress($to_email_address);
	
	$mail->AddReplyTo($from_email_address, $from_email_name); 
	$mail->Subject = $email_subject;
	//Assunto do email
	$mail->Body = '
	<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<style>
		.NomoLoja{ font-family:Calibri; font-size:29px; font-weight:bold;text-align:left;}
		.Site{font-family:Calibri; font-size:29px; text-align:left;}
		.texto{font-family:Calibri; font-size:16px; line-height:28px; color:#333; text-align:left;}
		</style>
		</head>
		<body>
		<table width="760" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; background-color:#CC6E6E" align="center">
		  
          <tr>
			<td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="56%" rowspan="2"></td>
                    <td width="44%"><img src="images/mail/mudominhacasa.png" width="332" height="59"/></td>
                  </tr>
                  <tr>
                    <td style="color:#000; font-weight:bold; text-align:right; padding-right:3px;">wwww.mudominhacasa.com.br</td>
                  </tr>
                </table>
            </td>
		  </tr>
		  <tr>
			<td class="texto">
            	<table width="760" border="0" cellspacing="0" cellpadding="0" style="background-color:#FFF; margin:5px">
					<tr><td>'.$html.'</td></tr>
				<table>
			</td>
		  </tr>	
		  <tr>
			<td style="text-align:center; font-size:13px; font-family:Tahoma; padding:10px; color:#FFF">
            Muito obrigado pela sua prefer�ncia e compreens�o!<br>
            Esperamos sua total satisfa��o na aquisi��o do seu produto Mudominhacasa - Adesivos Decorativos
            </td>
		  </tr>
		</table>
		</body>
	</html>'; 

	//SMTP
	$mail->SMTPAuth = true;
	$mail->Username = "$usuario_smtp"; 
	$mail->Password = "$senha_smtp";
	//Verifica se email sera enviado
	if(!$mail->Send())
	{ //Checa erros no envo do email
		//echo "Erro: " . $mail->ErrorInfo; //Imprime mensagem de que email n�o foi enviado
		//exit; 
	}
			
  
  }
  
  function tep_sendMailOrders($to_email_address, $email_subject, $html, $from_email_name, $from_email_address){ //NOVO
  
  	$smtp_endereco = ENTRY_EMAIL_HOST; // coloque aqui seu endere�o ou ip do servidor SMTP
	$usuario_smtp = ENTRY_EMAIL_USER; // coloque aqui seu usu�rio SMTP em geral � o pr�prio email que envia.
	$senha_smtp = ENTRY_EMAIL_PASSWORD; // coloque aqui sua senha para o usu�rio SMTP acima.
	
	//$mensagem_sucesso = $_POST['SuccessDocument']; // coloque aqui sua mensagem de sucesso ao envio do formul�rio.
	$mail = new PHPMailer(); // envodo de email com autenticacao do provedor
	$mail->SMTP_PORT = ENTRY_EMAIL_PORT; // ajusto a porta de smt a ser utilizada. Neste caso, a 587 que o GMail utiliza
	$mail->SMTPSecure = ENTRY_EMAIL_COMUNICATION; // ajusto o tipo de comunica��o a ser utilizada, no caso, a TLS do GMail
	$mail->SetLanguage("br", "language/");
	$mail->IsSMTP();
	$mail->IsHTML(true);
	//Cria PHPmailer class
	$mail->From = $from_email_address; //email do remetente
	$mail->FromName =  $from_email_name; //Nome de formatado do remetente
	$mail->Host = "$smtp_endereco"; //Pegando dados do alterar_esse_arquivo.php
	$mail->Mailer = "smtp"; //Usando protocolo SMTP

	$email_to = strstr($to_email_address,',');
	if($email_to){
	
		$email_to = explode(',',$to_email_address);
		for($cont = 0; $cont < sizeof($email_to); $cont++){
		$mail->AddAddress($email_to[$cont]);  // coloque aqui o endere�o de email que deseja receber as mensagems do formul�rio de contato.
		}
    }else $mail->AddAddress($to_email_address);
	
	$mail->AddReplyTo($from_email_address, $from_email_name); 
	$mail->Subject = $email_subject;
	//Assunto do email
	$mail->Body = '
	<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">		
		<body>'.$html.'</body>
	</html>'; 

	//SMTP
	$mail->SMTPAuth = true;
	$mail->Username = "$usuario_smtp"; 
	$mail->Password = "$senha_smtp";
	//Verifica se email sera enviado
	if(!$mail->Send())
	{ //Checa erros no envo do email
		//echo "Erro: " . $mail->ErrorInfo; //Imprime mensagem de que email n�o foi enviado
		//exit; 
	}
			
  
  }

////
// Check if product has attributes
  function tep_has_product_attributes($products_id) {
    $attributes_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "'");
    $attributes = tep_db_fetch_array($attributes_query);

    if ($attributes['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }

////
// Get the number of times a word/character is present in a string
  function tep_word_count($string, $needle) {
    $temp_array = explode($needle, $string);

    return sizeof($temp_array);
  }

  function tep_count_modules($modules = '') {
    $count = 0;

    if (empty($modules)) return $count;

    $modules_array = explode(';', $modules);

    for ($i=0, $n=sizeof($modules_array); $i<$n; $i++) {
      $class = substr($modules_array[$i], 0, strrpos($modules_array[$i], '.'));

      if (is_object($GLOBALS[$class])) {
        if ($GLOBALS[$class]->enabled) {
          $count++;
        }
      }
    }

    return $count;
  }

  function tep_count_payment_modules() {
    return tep_count_modules(MODULE_PAYMENT_INSTALLED);
  }

  function tep_count_shipping_modules() {
    return tep_count_modules(MODULE_SHIPPING_INSTALLED);
  }

  function tep_create_random_value($length, $type = 'mixed') {
    if ( ($type != 'mixed') && ($type != 'chars') && ($type != 'digits')) return false;

    $rand_value = '';
    while (strlen($rand_value) < $length) {
      if ($type == 'digits') {
        $char = tep_rand(0,9);
      } else {
        $char = chr(tep_rand(0,255));
      }
      if ($type == 'mixed') {
        if (eregi('^[a-z0-9]$', $char)) $rand_value .= $char;
      } elseif ($type == 'chars') {
        if (eregi('^[a-z]$', $char)) $rand_value .= $char;
      } elseif ($type == 'digits') {
        if (ereg('^[0-9]$', $char)) $rand_value .= $char;
      }
    }

    return $rand_value;
  }

  function tep_array_to_string($array, $exclude = '', $equals = '=', $separator = '&') {
    if (!is_array($exclude)) $exclude = array();

    $get_string = '';
    if (sizeof($array) > 0) {
      while (list($key, $value) = each($array)) {
        if ( (!in_array($key, $exclude)) && ($key != 'x') && ($key != 'y') ) {
          $get_string .= $key . $equals . $value . $separator;
        }
      }
      $remove_chars = strlen($separator);
      $get_string = substr($get_string, 0, -$remove_chars);
    }

    return $get_string;
  }

  function tep_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      if (isset($value) && ($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }

////
// Output the tax percentage with optional padded decimals
  function tep_display_tax_value($value, $padding = TAX_DECIMAL_PLACES) {
    if (strpos($value, '.')) {
      $loop = true;
      while ($loop) {
        if (substr($value, -1) == '0') {
          $value = substr($value, 0, -1);
        } else {
          $loop = false;
          if (substr($value, -1) == '.') {
            $value = substr($value, 0, -1);
          }
        }
      }
    }

    if ($padding > 0) {
      if ($decimal_pos = strpos($value, '.')) {
        $decimals = strlen(substr($value, ($decimal_pos+1)));
        for ($i=$decimals; $i<$padding; $i++) {
          $value .= '0';
        }
      } else {
        $value .= '.';
        for ($i=0; $i<$padding; $i++) {
          $value .= '0';
        }
      }
    }

    return $value;
  }

////
// Checks to see if the currency code exists as a currency
// TABLES: currencies
  function tep_currency_exists($code) {
    $code = tep_db_prepare_input($code);

    $currency_code = tep_db_query("select currencies_id from " . TABLE_CURRENCIES . " where code = '" . tep_db_input($code) . "'");
    if (tep_db_num_rows($currency_code)) {
      return $code;
    } else {
      return false;
    }
  }

  function tep_string_to_int($string) {
    return (int)$string;
  }

////
// Parse and secure the cPath parameter values
  function tep_parse_category_path($cPath) {
// make sure the category IDs are integers
    $cPath_array = array_map('tep_string_to_int', explode('_', $cPath));

// make sure no duplicate category IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($cPath_array);
    for ($i=0; $i<$n; $i++) {
      if (!in_array($cPath_array[$i], $tmp_array)) {
        $tmp_array[] = $cPath_array[$i];
      }
    }

    return $tmp_array;
  }

////
// Return a random value
  function tep_rand($min = null, $max = null) {
    static $seeded;

    if (!isset($seeded)) {
      mt_srand((double)microtime()*1000000);
      $seeded = true;
    }

    if (isset($min) && isset($max)) {
      if ($min >= $max) {
        return $min;
      } else {
        return mt_rand($min, $max);
      }
    } else {
      return mt_rand();
    }
  }

  function tep_setcookie($name, $value = '', $expire = 0, $path = '/', $domain = '', $secure = 0) {
    setcookie($name, $value, $expire, $path, (tep_not_null($domain) ? $domain : ''), $secure);
  }

  function tep_get_ip_address() {
    if (isset($_SERVER)) {
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      } else {
        $ip = $_SERVER['REMOTE_ADDR'];
      }
    } else {
      if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
      } elseif (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
      } else {
        $ip = getenv('REMOTE_ADDR');
      }
    }

    return $ip;
  }

  function tep_count_customer_orders($id = '', $check_session = true) {
    global $customer_id;

    if (is_numeric($id) == false) {
      if (tep_session_is_registered('customer_id')) {
        $id = $customer_id;
      } else {
        return 0;
      }
    }

    if ($check_session == true) {
      if ( (tep_session_is_registered('customer_id') == false) || ($id != $customer_id) ) {
        return 0;
      }
    }

    $orders_check_query = tep_db_query("select count(*) as total from " . TABLE_ORDERS . " where customers_id = '" . (int)$id . "'");
    $orders_check = tep_db_fetch_array($orders_check_query);

    return $orders_check['total'];
  }

  function tep_count_customer_address_book_entries($id = '', $check_session = true) {
    global $customer_id;

    if (is_numeric($id) == false) {
      if (tep_session_is_registered('customer_id')) {
        $id = $customer_id;
      } else {
        return 0;
      }
    }

    if ($check_session == true) {
      if ( (tep_session_is_registered('customer_id') == false) || ($id != $customer_id) ) {
        return 0;
      }
    }

    $addresses_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$id . "'");
    $addresses = tep_db_fetch_array($addresses_query);

    return $addresses['total'];
  }

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
  function tep_convert_linefeeds($from, $to, $string) {
    if ((PHP_VERSION < "4.0.5") && is_array($from)) {
      return ereg_replace('(' . implode('|', $from) . ')', $to, $string);
    } else {
      return str_replace($from, $to, $string);
    }
  }
  

// Exibe o Parcelamento na listagem de produtos
function tep_display_parcela($total) { 
	if(PARCELAMENTO_SHOW == 'true'){
		$explodes = ((int)(($total)/PARCELAMENTO_CARTAO_MINIMO)); 
		$minimo = PARCELAMENTO_CARTAO_MINIMO * 2;
		if(PARCELAMENTO_CARTAO_SEM_JUROS == 1){
			if ($explodes > PARCELAMENTO_CARTAO_PARCELAS){
				$explodes = PARCELAMENTO_CARTAO_PARCELAS;
			}
		}else $explodes = PARCELAMENTO_CARTAO_SEM_JUROS;
		$valor = '';
		if (($explodes > 0)and($total >= $minimo )){
			if($explodes <= PARCELAMENTO_CARTAO_SEM_JUROS){
				$taxa = 0;
				$total = $total/$explodes;
				$valor = '<span>'.$explodes.'x</span> de <span>R$'. number_format($total, 2 , "," , ".").'</span> <b>sem juros</b>';
				//em at� no cart�o 
			}else{
				$fator = array('','1.00000','0.51875','0.35007','0.26575','0.21518','0.18148','0.15743','0.13941','0.12540','0.11420','0.10505','0.09743');
				$valor = '<span>'.$explodes.'x</span> de <span>R$'. number_format($total*($fator[$explodes]), 2 , "," , ".") .'</span>';
				//em at�   no cart�o
			}
		}
		return($valor);
	}else
	return '';
 }

 function tep_discount_products($products_id){
		$discount = tep_db_query("select discount_percent, discount_new_products_price from " . TABLE_DISCOUNT_PAYMENT . " where products_id = '" . $products_id . "'");
		$discount_values = tep_db_fetch_array($discount);
		$message ='';
			
		if(isset($discount_values['discount_percent']))
		$message = 'ou <span>R$'.number_format($discount_values['discount_new_products_price'], 2 , "," , ".").'</span> � vista ';
		//com <span>' .round($discount_values['discount_percent'],0).'%</span> de desconto
		return $message;
}

 function tep_discount_products_price($products_id, $newprice){
		$discount = tep_db_query("select discount_percent from " . TABLE_DISCOUNT_PAYMENT . " where products_id = '" . $products_id . "'");
		$discount_values = tep_db_fetch_array($discount);
		$message ='';
			
		if(isset($discount_values['discount_percent'])){
			$desconto = ($discount_values['discount_percent']/100);
			$price = $newprice * $desconto;
			$price = $newprice - $price;
		$message = 'ou <span>R$'.number_format($price, 2 , "," , ".").'</span> � vista ';
		//com <span>' .round($discount_values['discount_percent'],0).'%</span> de desconto
		}
		
		return $message;
}

function tep_make_catsf_ullist($rootcatid = 0, $maxlevel = 0, $param, $param2 = ''){
		$output = '';
   global $cPath_array, $show_full_tree, $languages_id;
		if (!$show_full_tree) {
        $parent_query	= 'AND (c.parent_id = "0"';	
				
				if (isset($cPath_array)) {
				
				    $cPath_array_temp = $cPath_array;
				
				    foreach($cPath_array_temp AS $key => $value) {
						    $parent_query	.= ' OR c.parent_id = "'.$value.'"';
						}
						
						unset($cPath_array_temp);
				}	
				
        $parent_query .= ')';				
		} else {
        $parent_query	= '';	
		}
		
		$result = tep_db_query('select c.categories_id, cd.categories_name, c.parent_id from ' . TABLE_CATEGORIES . ' c, ' . TABLE_CATEGORIES_DESCRIPTION . ' cd where c.categories_id = cd.categories_id '.$param.' and categories_status = 1 and cd.language_id="' . (int)$languages_id .'" '.$parent_query.' order by sort_order, cd.categories_name'.$param2);
    
		while ($row = tep_db_fetch_array($result)) {				
        $table[$row['parent_id']][$row['categories_id']] = $row['categories_name'];
    }
   // $output .= '<ul id="sidebarmenu1">';
    $output .= tep_make_catsf_ulbranch($rootcatid, $table, 0, $maxlevel);
    for ($nest = 0; $nest <= $GLOBALS['this_level']; $nest++) {
    //    $output .= '</ul>';		
		}
    return $output;
}

function tep_make_catsf_ulbranch($parcat, $table, $level, $maxlevel) {
	$output = '';
	global $cPath_array;		
    $list = $table[$parcat];
    while(list($key,$val) = @each($list)){
			 
        if ($GLOBALS['this_level'] != $level) {

		        if ($GLOBALS['this_level'] < $level) {
				        $output .= "\n".'<ul>';
				    } else {
                for ($nest = 1; $nest <= ($GLOBALS['this_level'] - $level); $nest++) {
                    $output .= '</ul></li>'."\n";	
		            }
						}			
		
		        $GLOBALS['this_level'] = $level;
        }
         $output .= '<li><a href="';
        if (!$level) {
				    unset($GLOBALS['cPath_set']);
						$GLOBALS['cPath_set'][0] = $key;
            $cPath_new = 'cPath=' . $key;

        } else {
						$GLOBALS['cPath_set'][$level] = $key;		
            $cPath_new = 'cPath=' . implode("_", array_slice($GLOBALS['cPath_set'], 0, ($level+1)));
        }
        $output .= tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">'.$val;		

        if (SHOW_COUNTS == 'true') {
            $products_in_category = tep_count_products_in_category($key);
            if ($products_in_category > 0) {
                $output .= '&nbsp;(' . $products_in_category . ')';
            }
        }
		
        $output .= '</a>';	

        if (!tep_has_category_subcategories($key)) {
            $output .= '</li>'."\n";	
        }						 
								
        if ((isset($table[$key])) AND (($maxlevel > $level + 1) OR ($maxlevel == '0'))) {
            $output .= tep_make_catsf_ulbranch($key,$table,$level + 1,$maxlevel);
        }
    
		} // End while loop
    return $output;
}
function thumb_galery($img, $width, $height, $fill = false) {
  if (!extension_loaded('gd') && !extension_loaded('gd2')) {
				trigger_error("Voc� n�o possui a biblioteca GD.", E_USER_WARNING);
				return false;
		}
	  $imgInfo = getimagesize($img);
	  switch ($imgInfo[2]) {
		case 1: $im = imagecreatefromgif($img); break;
		case 2: $im = imagecreatefromjpeg($img);  break;
		case 3: $im = imagecreatefrompng($img); break;
		default:  trigger_error('Tipo de imagem n�o reconhecido. Apenas imagens PNG, JPEG, JPG e GIF s�o aceitas', E_USER_WARNING);  break;
	  }
				$ratio = $imgInfo[1] / $imgInfo[0];
	
				// Set the width and height to the proper ratio
				if (!$width && $height) {
					$ratio = $height / $imgInfo[1];
					$width = intval($imgInfo[0] * $ratio);
				} elseif ($width && !$height) {
					$ratio = $width / $imgInfo[0];
					$height = intval($imgInfo[1] * $ratio);
				} elseif (!$width && !$height) {
					$width = $imgInfo[0];
					$height = $imgInfo[1];
				}
	
				// Scale the image if not the original size
				if ($imgInfo[0] != $width || $imgInfo[1] != $height) {
					$rx = $imgInfo[0] / $width;
					$ry = $imgInfo[1] / $height;
	
					if ($rx < $ry) {
						$width = intval($height / $ratio);
					} else {
						$height = intval($width * $ratio);
					}
				}
	//
	
	
	  $nWidth = round($width);
	  $nHeight = round($height);
	
	  $newImg = imagecreatetruecolor($nWidth, $nHeight);
	  $th_bg_color = imagecolorallocate($newImg, 255, 255, 255);
	  imagefill($newImg, 0, 0, $th_bg_color);
	  imagecolortransparent($newImg, $th_bg_color);
	
	  imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);
	
	  //$img = str_replace('Imgprodutos/','',$img);
	  switch ($imgInfo[2]) {
		case 1: imagegif($newImg,$img.'partner.gif');
		return 'partner.gif';
		break;
		case 2: imagejpeg($newImg,$img.'partner.jpg');
		return 'partner.jpg';
		break;
		case 3: imagepng($newImg,$img.'partner.png');
		return 'partner.png';
		break;
		default:  trigger_error('I havea problem ', E_USER_WARNING);  break;
	  }
	
	  imagedestroy($newImg);
	}
	
	function checa_email($email)
	{
		// Expressao regular para verificar e-mail
		$regex = '/^[A-z0-9][\w.-]*@[A-z0-9][\w\-\.]+\.[A-z0-9]{2,6}$/';
		
		// caso o email seja valido, verifica se ja esta cadastrado
		$sql = "SELECT * FROM newsletter WHERE email = '".$email."'";
		$resultq = mysql_query($sql);
		// Caso o e-mail seja invalido
		if(!preg_match($regex, $email, $match))
		{
			// Escreve mensagem de erro
			$erro = "Erro";
			print 'alert("Informe um e-mail v�lido!")';
		}else if(mysql_num_rows($resultq) > 0)
				{
					// Caso esteja, escreve mensagem de erro
					$erro = "Erro";
					print 'alert("E-mail j� existente! Informe outro e-mail.")';
				}else{
					$erro = "";
				}
		
		return $erro;
	}
	
	function checa_email2($email)
	{
		// Expressao regular para verificar e-mail
		$regex = '/^[A-z0-9][\w.-]*@[A-z0-9][\w\-\.]+\.[A-z0-9]{2,6}$/';
		
		// caso o email seja valido, verifica se ja esta cadastrado
		$sql = "SELECT * FROM newsletter WHERE email = '".$email."'";
		$resultq = mysql_query($sql);
		// Caso o e-mail seja invalido
		if(!preg_match($regex, $email, $match))
		{
			// Escreve mensagem de erro
			$erro = "Erro";
			print 'alert("Informe um e-mail v�lido!")';
		}else if(mysql_num_rows($resultq) > 0)
				{
					// Caso esteja, escreve mensagem de erro
					$erro = "Erro";
					//print 'alert("E-mail j� existente! Informe outro e-mail.")';
				}else{
					$erro = "";
				}
		
		return $erro;
	}
?>
