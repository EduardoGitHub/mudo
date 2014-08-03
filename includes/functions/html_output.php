<?php
/*
  $Id: html_output.php,v 1.56 2003/07/09 01:15:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

////
// The HTML href link wrapper function
  ////
// Ultimate SEO URLs v2.2d
// The HTML href link wrapper function
function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
   global $seo_urls;                
   if ( !is_object($seo_urls) ){
    if ( !class_exists('SEO_URL') ){
     include_once(DIR_WS_CLASSES . 'seo.class.php');
    }
    global $languages_id;
    $seo_urls = new SEO_URL($languages_id);
   }
   return $seo_urls->href_link($page, $parameters, $connection, $add_session_id);
 }
 
 
 /*
 function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $request_type, $session_started, $SID;

    if (!tep_not_null($page)) {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>');
    }

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
    }

    if (tep_not_null($parameters)) {
      $link .= $page . '?' . tep_output_string($parameters);
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null($SID)) {
        $_sid = $SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
      while (strstr($link, '&&')) $link = str_replace('&&', '&', $link);

      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);

      $separator = '?';
    }

    if (isset($_sid)) {
      $link .= $separator . $_sid;
    }

    return $link;
  }
 */


////
// The HTML image wrapper function
  function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false;
    }

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
$image = '<img src="'.HTTP_SERVER_IMAGES . tep_output_string(substr($src, strlen(DIR_WS_IMAGES))) . '" border="0" alt="' . tep_output_string($alt) . '"';
//    $image = '<img src="' . tep_output_string($src) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }
	
	if(empty($width) || empty($height)){
		$image_size = @getimagesize($src);

      $image .= ' width="' . tep_output_string($image_size[0]) . '" height="' . tep_output_string($image_size[1]) . '"';
	}else{
		 $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
		
		}
    

    if (tep_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= '/>';

    return $image;
  }
  
  
  // The HTML image wrapper function
  function tep_image_produto($src, $alt = '', $redimencionar = 'NO', $tamanhoRedm = 'P', $parameters = '') {
// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
	$image_size = @getimagesize($src);
	if($redimencionar == 'NO'){
		$image = '<img src="' .$src . '" border="0" alt="' . tep_output_string($alt) . '"';
		if (tep_not_null($alt)) {
			  $image .= ' title=" ' . tep_output_string($alt) . ' "';
			}
			if (tep_not_null($parameters)) $image .= ' ' . $parameters;
		$image .= ' width="' . tep_output_string($image_size[0]) . '" height="' . tep_output_string($image_size[1]) . '"';
		$image .= '/>';
	}else if($redimencionar == 'YES'){
		if(($image_size[2] <> 1) && ($image_size[2] <> 2) && ($image_size[2] <> 3) ){
			$new_name = reduzir($src,$tamanhoRedm);
			$image = '<img src="'.HTTP_SERVER_PRODUTOS. tep_output_string($new_name[0]) . '" border="0" alt="' . tep_output_string($alt) . '"';
			if (tep_not_null($alt)) {
			  $image .= ' title=" ' . tep_output_string($alt) . ' "';
			}
			if (tep_not_null($parameters)) $image .= ' ' . $parameters;
			$image .= ' width="' . tep_output_string($new_name[1]) . '" height="' . tep_output_string($new_name[2]) . '"';
			$image .= '/>';
		}else{
		

			$new_name = redimenciona($src,$tamanhoRedm);
			$nome = substr($new_name[0],strlen(DIR_WS_IMAGES_PRODUTOS));
			$image = '<img src="'.HTTP_SERVER_PRODUTOS. tep_output_string($nome) . '" border="0" alt="' . tep_output_string($alt) . '"';
			if (tep_not_null($alt)) {
			  $image .= ' title=" ' . tep_output_string($alt) . ' "';
			}
			if (tep_not_null($parameters)) 
			$image .= ' ' . $parameters;
			
			$image .= ' width="' . tep_output_string($new_name[1]) . '" height="' . tep_output_string($new_name[2]) . '"';
			$image .= '/>';
		}

	}
    return $image;
  }

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
  function tep_image_submit($image, $alt = '', $parameters = '') {
    global $language;

    $image_submit = '<input type="image" src="' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';

    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;

    $image_submit .= ' />';

    return $image_submit;
  }

////
// Output a function button in the selected language
  function tep_image_button($image, $alt = '', $parameters = '') {
    global $language;

    //return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
	
	return '<img src="' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" alt="' . tep_output_string($alt) . '" '.$parameters.' />';
  }

////
// Output a separator either through whitespace, or with an image
  function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return tep_image(DIR_WS_IMAGES . $image, '', $width, $height);
  }

////
// Output a form
  function tep_draw_form($name, $action, $method = 'post', $parameters = '') {
    $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

    if (tep_not_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    return $form;
  }

////
// Output a form input field
  function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    } elseif (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' />';

    return $field;
  }

////
// Output a form password field
  function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
  function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
    $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';

    if ( ($checked == true) || ( isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ( ($GLOBALS[$name] == 'on') || (isset($value) && (stripslashes($GLOBALS[$name]) == $value)) ) ) ) {
      $selection .= ' CHECKED';
    }

    if (tep_not_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= ' />';

    return $selection;
  }

////
// Output a form checkbox field
  function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = 'class="styled"') {
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
  }

////
// Output a form radio field
  function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = 'class="styled"') {
    return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters);
  }

////
// Output a form textarea field
  function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    $field = '<textarea name="' . tep_output_string($name) . '" wrap="' . tep_output_string($wrap) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= stripslashes($GLOBALS[$name]);
    } elseif (tep_not_null($text)) {
      $field .= $text;
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function tep_draw_hidden_field($name, $value = '', $parameters = '') {
    $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    } elseif (isset($GLOBALS[$name])) {
      $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' />';

    return $field;
  }

////
// Hide form elements
  function tep_hide_session_id() {
    global $session_started, $SID;

    if (($session_started == true) && tep_not_null($SID)) {
      return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
  }

////
// Output a form pull down menu
  function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    $field = '<select name="' . tep_output_string($name) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . tep_output_string($values[$i]['id']) . '"';
      if ($default == $values[$i]['id']) {
        $field .= 'selected="selected"';
      }

      $field .= '>' . tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

function tep_draw_pull_down_menu2($name, $values, $default = '', $parameters = '', $required = false) {
    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= tep_image(DIR_WS_IMAGES . 'seta.gif').'&nbsp;&nbsp; <a href="' . tep_href_link('index.php','manufacturers_id='.tep_output_string($values[$i]['id'])).'">';

      $field .= tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</a><br>';
    }
    return $field;
  }


////
// Creates a pull-down list of countries
  function tep_get_country_list($name, $selected = '', $parameters = '') {
    $countries_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
    $countries = tep_get_countries();

    for ($i=0, $n=sizeof($countries); $i<$n; $i++) {
      $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
    }

    return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
  }


  function mm_output_flash_movie($name, $movie, $width = '' , $height = '' , $background = '' , $parameters = '') {
    
    if(tep_not_null($width)) {
		//$movie_width = 'width="'.$width.'"' ;
		$movie_width = 'width="100%"' ;
	}
    
	if(tep_not_null($height)) {
		$movie_height = 'height="'.$height.'"' ;
	}

	if(tep_not_null($parameters)) {
	  $flash_movie = $movie . '?' . $parameters ;
	} else {
	  $flash_movie = $movie ;
	}
	
	//fix ie 1 :: begins
	//\'width\',\' '. $width .'\',
	$flash = '<script src="includes/librays/AC_RunActiveContent.js" type="text/javascript"></script>' . "\n" ;
	$flash .= '<script type="text/javascript">AC_FL_RunContent( 
	\'codebase\',\'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\',
	\'width\',\' 100%\',
	\'height\',\' '. $height .'\',
	\'quality\',\'high\',
	\'scale\',\'noscale\',
	\'wmode\',\'transparent\',
	\'allowScriptAccess\',\'always\',
	\'pluginspage\',\'http://www.macromedia.com/go/getflashplayer\',
	\'movie\',\' '. $movie .'\' );' . "\n" ;
	$flash .= '</script>' . "\n" ;

	$flash .= '<noscript>' . "\n" ;
	//fix ie 1 :: ends
	
	$flash .= '<object type="application/x-shockwave-flash" data="'. $movie .'" '. $movie_width .' '. $movie_height.'>'."\n";
	$flash .= '<param name="movie" value="'.$flash_movie.'" />' . "\n";
 	$flash .= '<param name="scale" value="noscale" />';
	$flash .= '<param name="allowScriptAccess" value="always" />';
	if(tep_not_null($background)) {
	  $flash .= '<param name="bgcolor" value="#'.$background.'" />' . "\n" ;	
	} else {
	  $flash .= '<param name="wmode" value="transparent" />' . "\n" ;
	}
	
	$flash .= '</object>' . "\n\n" ;

	//fix ie 2 :: begins
	$flash .= '</noscript>' . "\n" ;
	//fix ie 2 :: ends

    return $flash;
  }
  function tep_display_option($product_id, $wicth_option, $languages_cod, $required = false, $price = 0) {
		$products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $product_id . "' and patrib.options_id = popt.products_options_id and popt.products_options_id ='".$wicth_option."' and popt.language_id = '" . (int) $languages_cod . "' order by popt.products_options_name");
		$products_options_name = tep_db_fetch_array($products_options_name_query);
		$products_options_num_rows = tep_db_num_rows($products_options_name_query);
		if($products_options_num_rows > 0){//Verifica se tem algum atributo para esse registro
			if($products_options_name['products_options_name']=='Espelhar o Adesivo')$t ='<br><br><a href="javascript:popup(\'adesivo.html\');" style="color:#890000; font-size:12px; font-weight:bold;">O que é isto?</a>';else $t = '';
			
			if($products_options_name['products_options_name'] <> 'Cor' and $products_options_name['products_options_name'] <> 'Posição' and $products_options_name['products_options_name'] <> 'Material'){
			$field = '<h2 style="font-family:Tahoma; font-size:12px; color:#000; font-weight:bold; text-align:center; padding:5px;"><img src="images/detalheProdutoInfo.jpg" />'.$products_options_name['products_options_name'].' '.$t.'</h2>';//Mostra o nome da opção
			}
			
			$products_options_array = array();
			$products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.options_obs, pa.options_desc, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . $product_id . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int) $languages_cod . "'");
			while ($products_options = tep_db_fetch_array($products_options_query)) {
				$products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name'], 'obs' =>$products_options['options_obs'], 'desc' =>$products_options['options_desc']);
				
				if ($products_options['options_values_price'] != '0'){
					if($products_options['price_prefix'] == '-')
					$preco_size = $price - $products_options['options_values_price'];
					else if($products_options['price_prefix'] == '+')
					$preco_size = $price + $products_options['options_values_price'];
					//$products_options_array[sizeof($products_options_array)-1]['re'] .= $products_options['price_prefix'].' '.$products_options['options_values_price'];
					(isset($products_options_array[sizeof($products_options_array)-1]['re']) ? $products_options_array[sizeof($products_options_array)-1]['re'] .= 'R$'.number_format($preco_size,2,',','.') : '');
					(isset($products_options_array[sizeof($products_options_array)-1]['ret']) ? $products_options_array[sizeof($products_options_array)-1]['ret'] .= $preco_size : '');
					(isset($products_options_array[sizeof($products_options_array)-1]['rett']) ? $products_options_array[sizeof($products_options_array)-1]['rett'] .= '<span class="textdesconto" style="color:#666; font-size:14px"><br />'.tep_display_parcela($preco_size).'</span>' : '');
					(isset($products_options_array[sizeof($products_options_array)-1]['rettt']) ? $products_options_array[sizeof($products_options_array)-1]['rettt'] .= '<span class="textdesconto" style="color:#666; font-size:14px">'.tep_discount_products_price($product_id, $preco_size).'</span>' : '');

				}else{
					(isset($products_options_array[sizeof($products_options_array)-1]['re']) ? $products_options_array[sizeof($products_options_array)-1]['re'] .= 'R$'.number_format($price,2,',','.') : '');
					(isset($products_options_array[sizeof($products_options_array)-1]['ret']) ? $products_options_array[sizeof($products_options_array)-1]['ret'] .= $price : '');
					(isset($products_options_array[sizeof($products_options_array)-1]['rett']) ? $products_options_array[sizeof($products_options_array)-1]['rett'] .= '<span class="textdesconto" style="color:#666; font-size:14px"><br />'.tep_display_parcela($price).'</span>' : '');
					(isset($products_options_array[sizeof($products_options_array)-1]['rettt']) ? $products_options_array[sizeof($products_options_array)-1]['rettt'] .= '<span class="textdesconto" style="color:#666; font-size:14px">'.tep_discount_products_price($product_id, $price).'</span>' : '');
					
				}
			}

		if (isset($cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']]))  $selected_attribute = $cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']];
		else $selected_attribute = false;
	

		$name = 'id['.$products_options_name['products_options_id'].']';
		$values = $products_options_array;
		$default = $selected_attribute;
	
		
		if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);
			
			$op = array('opcao1.png', 'opcao2.png', 'opcao3.png');
			if($wicth_option == 1){	
			
				$n = sizeof($values);
				sort($values);
				
				for ($i=0; $i<$n; $i++) {
					
				  $field .= '<div class="optionTamanho" id="size'.$i.'" >
								<div class="input"><input type="radio"  name="' . tep_output_string($name) . '"  value="' . tep_output_string($values[$i]['id']) . '" onclick="javascript:selecionadoT('.$i.');"/></div>
								<div class="image">'; 
									if($values[$i]['text'] == 'Grande') $field .= tep_image('images/optionTgrande.png'); 
									else if($values[$i]['text'] == 'Médio') $field .= tep_image('images/optionTmedio.png'); 
									else $field .= tep_image('images/optionTpequeno.png');  
					$field .= '</div>
								<div class="info"><span>Tamanho do desenho: <br><b>'.$values[$i]['obs'].'</b></span><br /><span><input type="hidden" id="hpred'.$i.'" name="hpre'.$i.'" value="'.(isset($values[$i]['ret']) ? : '').'"/><span id="textparc'.$i.'" style="display:none;">'.(isset($values[$i]['rett']) ? $values[$i]['rett'] : '').'</span> <span id="textdescavista'.$i.'" style="display:none;">'.(isset($values[$i]['rettt']) ? $values[$i]['rettt'] : '').'</span></span>
								</div>
								<div class="valor"><span id="valor'.$i.'" style="font-weight:bold;">'.(isset($values[$i]['re']) ? $values[$i]['re'] : '').'</span></div>
								<div style="clear:both"></div>
								<div class="desc">'.(isset($values[$i]['desc']) ? $values[$i]['desc'] : '').'</div>
							</div>';					
				}
			}else if($wicth_option == 2){//cor
				
				$cor = array( "Colorido" => "#FFF", "Preto" => "#000", "Branco" => "#FFF", "Amarelo" => "#FEEC40", "Amarelo Ouro" => "#FFCC00","Laranja" => "#F4962D","Vermelho" => "#A70302","Verde Claro" => "#4DBA2D","Verde" => "#026900","Verde Escuro" => "#08290A","Azul Claro" => "#37CAF5","Azul" => "#2A04AF","Azul Escuro" => "#010161","Violeta" => "#652464","Magenta" => "#F548B3","Cinza" => "#5C5C5A","Marrom" => "#6B3103","Cinza Claro" => "#B0AFAB","Vermelho Tomate" => "#C40202","Preto Fosco" => "#333","Bordeaux" => "#57010C","Lilás" => "#EDA1EB");


					
					$field .= '<div class="optionCor"><div id="paleta'.$e.'" class="paletadecores">';
					$field .= '<ul>';
					for ($i=0, $n=sizeof($values); $i<$n; $i++) {
				/*		if($values[$i]['text']=='Colorido')
						$field .= '<li style="background-image:url(images/mudo-icon-cor-colorido.png); text-align:left;" title="'.$values[$i]['text'].'"><input type="radio" name="' . tep_output_string($name) . '" value="' . tep_output_string($values[$i]['id']) . '" onclick="" /><span style="color:#000">'.$values[$i]['text'].'</span></li>';
						else{*/
							if($values[$i]['text']=='Branco' or $values[$i]['text']=='Amarelo' or $values[$i]['text']=='Colorido') $cors = 'style="color:#000"'; else $cors ='';
						$field .= '<li style="background-color:'.$cor[$values[$i]['text']].'; text-align:left;" title="'.$values[$i]['text'].'"><input type="radio" name="' . tep_output_string($name) . '" value="' . tep_output_string($values[$i]['id']) . '" onclick="'.$cor_action[$values[$i]['text']].'" /> <span '.$cors.'>'.$values[$i]['text'].'</span></li>';
						//}
						
					}
					$field .= '</ul><div style="clear:left"></div>';
					$field .= '</div>';
					
			
				
				$field .= '</div>';
			}else if($wicth_option == 3){
				$field .= '<div class="optionEspelhado"><ul>';
				for ($i=0, $n=sizeof($values); $i<$n; $i++) {	
					
					$field .= '<li><p><input type="radio" name="' . tep_output_string($name) . '" value="' . tep_output_string($values[$i]['id']) . '" /><label>'.tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')).' '.tep_output_string($values[$i]['obs']).'</label></p></li>';
				}
					$field .= '</ul></div>';
			}else if($wicth_option == 4){
				$field .= '<div class="optionMural"><ul><li class="titulos">'.$products_options_name['products_options_name'].': </li>';
				for ($i=0, $n=sizeof($values); $i<$n; $i++) {	
					
					if($values[$i]['text']=="Normal") $click = ' onClick="removeInvert()"'; else $click = ' onClick="invert()"';
					
					$field .= '<li><button type="button"  value="' . tep_output_string($values[$i]['id']) . '" '.$click.'>'.tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')).' '.tep_output_string($values[$i]['obs']).'</button></li>';
					
					//onclick="ValorMidiaCm('.$values[$i]['ret'].')"
					//<a style="color:#0000FF; cursor:pointer" onclick="javascript:popupMidias(\''.$paginas[$i].'\')"> + Detalhes</a>
					//id="' . tep_output_string($name) . '"
				}
				$field .= '</ul><div style="clear:both"></div></div>';	
			}else if($wicth_option == 5){
				$n = sizeof($values);
				$field .= '<div class="optionMural"><ul><li class="titulos">'.$products_options_name['products_options_name'].': </li>';
				for ($s=0; $s<$n; $s++) {
					/*
				$field .= '<div class="options" id="size'.$s.'" >
								<div class="input"><input type="radio"  name="' . tep_output_string($name) . '"  value="' . tep_output_string($values[$s]['id']) . '" onclick="javascript:selecionadoT('.$s.');"/></div>
								<div class="image">'.tep_image('images/'.$op[$s]).'</div>
								<div class="info">'.$values[$s]['text'].'</div>
								<div style="float:right; margin:15px 20px; 0 0; text-align:center;"><span id="valor'.$s.'" style="width:138px; color:#FF0000; font-weight:bold; font-size:20px">'.$values[$s]['re'].'</span><br/>
								'.tep_display_parcela($values[$s]['ret']).'
								<span id="textparc'.$s.'" style="display:none;"><br /><br />'.tep_display_parcela($values[$s]['ret']).'</span>
								<input type="hidden" id="hpred'.$d.'" name="hpre'.$i.'" value="'.$values[$s]['ret'].'"/></div>
								<div style="clear:both"></div>
							</div>';	
				*/
				
				
				if($values[$s]['text']=="Colorido") $click = ' onClick="removeGray()"'; else $click = ' onClick="gray()"';
				
				$field .= '<li><button type="button"  value="' . tep_output_string($values[$s]['id']) . '" '.$click.'>'.tep_output_string($values[$s]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')).'</button></li>';
				
				}
				$field .= '</ul><div style="clear:both"></div></div>';	
			}else if($wicth_option == 6){
				$n = sizeof($values);
				$field .= '<div class="optionMuralList"><ul><li class="titulos">'.$products_options_name['products_options_name'].': </li>';
				for ($s=0; $s<$n; $s++) {
				
				$field .= '<li><input type="radio" name="' . tep_output_string($name) . '" value="' . tep_output_string($values[$s]['id']) . '" /><label>'.tep_output_string($values[$s]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')).' '.tep_output_string($values[$s]['obs']).' <a style="color:#0000FF; cursor:pointer" onclick="javascript:popupMidias(\''.$paginas[$s].'\')"> + Detalhes</a></label></li>';
				
				}
				$field .= '</ul><div style="clear:both"></div></div>';	
			}
			//$field .= '</ul><div style="clear:both"></div></div>';
			
		if ($required == true) $field .= TEXT_FIELD_REQUIRED;
		}else $field = '';
		return $field;
	}
?>