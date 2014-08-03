<?php
	if(!isset($_SESSION['customer_revenda'])||($_SESSION['customer_revenda']==0)){//VERIFICANDO TIPO DE CONSUMIDOR	
		  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
			$new_products_query = tep_db_query("select DISTINCT p.products_id, p.products_image, p.products_price, p.products_quantity, p.products_weight, p.products_free_shipping, p.products_tax_class_id, if(s.status, s.specials_new_products_price, NULL) as specials_new_products_price from ".TABLE_CATEGORIES." c, ".TABLE_PRODUCTS_TO_CATEGORIES." ptc, " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where products_status = '1'  and p.products_id = ptc.products_id AND c.categories_id = ptc.categories_id and products_quantity > '0' and products_highlight = 1  order by rand() limit " . MAX_DISPLAY_NEW_PRODUCTS);
		  	$num = tep_db_num_rows($new_products_query); //and c.categories_highlights = '1'
		  	if($num <= 0) $new_products_query = tep_db_query("select DISTINCT p.products_id, p.products_image, p.products_price, p.products_quantity, p.products_weight, p.products_free_shipping, p.products_tax_class_id, if(s.status, s.specials_new_products_price, NULL) as specials_new_products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where products_status = '1' and products_quantity > '0' and products_highlight = 1 order by rand() limit " . MAX_DISPLAY_NEW_PRODUCTS);
		  } else {
			$new_products_query = tep_db_query("select DISTINCT p.products_id, p.products_image, p.products_quantity, p.products_weight, p.products_free_shipping, p.products_tax_class_id, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and products_quantity > '0' and products_highlight = 1 order by rand() desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
		  }
  }else{
  		if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
			$new_products_query = tep_db_query("select DISTINCT p.products_id, p.products_image, p.products_quantity, p.products_weight, p.products_free_shipping, p.products_tax_class_id, p.products_price_revenda as products_price_revenda from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where products_status = '1' and products_quantity >'0' and products_highlight = 1 order by rand() limit " . MAX_DISPLAY_NEW_PRODUCTS);
		  } else {
			$new_products_query = tep_db_query("select DISTINCT p.products_id, p.products_image, p.products_quantity, p.products_weight, p.products_free_shipping, p.products_tax_class_id, p.products_price_revenda as products_price_revenda from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and products_quantity > '0' and products_highlight = 1 order by rand() desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
		  }
  	
  }
  $row = 0;
  $col = 0;
  echo '<ul>';

  while ($new_products = tep_db_fetch_array($new_products_query)) {
	 
	  if(!isset($_SESSION['customer_revenda'])||($_SESSION['customer_revenda']==0)){
	  //PARCELAMENTO NO CARTAO. BY v3.5 REV 1 - OSCOMMERCE 
		if($new_products['specials_new_products_price'] != 0){
			$total_parcelado = $new_products['specials_new_products_price'];
		}else{
			$total_parcelado = $new_products['products_price'];
		}
	  //PARCELAMENTO NO CARTAO. BY v3.5 REV 1 - OSCOMMERCE
	  }else{
	  	$total_parcelado = $new_products['products_price_revenda'];
	  }


   $new_products['products_name'] = tep_get_products_name($new_products['products_id']);
   $new_products['products_availability'] = tep_get_products_availability($new_products['products_id']);
   
   // get products category
   $categories_query = tep_db_query("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$new_products['products_id'] . "'");
   if (tep_db_num_rows($categories_query) > 0) {
     $categories = tep_db_fetch_array($categories_query);
     $categories_query2 = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$categories['categories_id'] . "'");
     $categories2 = tep_db_fetch_array($categories_query2);
     $category_name = $categories2['categories_name'];
   } else {
     $category_name = '';
   }
      // get products manufacturers
   $man_query = tep_db_query("select manufacturers_id from " . TABLE_PRODUCTS . " where products_id = '" . (int)$new_products['products_id'] . "'");
   if (tep_db_num_rows($categories_query) > 0) {
     $manuf = tep_db_fetch_array($man_query);
     $man_query2 = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$manuf['manufacturers_id'] . "'");
     $manuf2 = tep_db_fetch_array($man_query2);
     $man_name = $manuf2['manufacturers_name'];
   } else {
     $man_name = '';
   }
	
   
	 if($not_show =='False'){//VERIFICA SE OS PRE?OS E O BOT?O DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
			$preco ='';
			$fretegratis ='';
			$botao_comprar ='';
			
	 		if(tep_not_null($new_products['specials_new_products_price'])) {
			  	if(!isset($_SESSION['customer_revenda'])||($_SESSION['customer_revenda']==0))//VERIFICANDO TIPO DE CONSUMIDOR	
				$price = '<span class="pr_price" style="padding-right:0px; font-size:12px"><span style="color: #666; font-family:Tahoma; font-size:12px; font-weight:normal"> de </span><s>'.  $currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</s></span><span style="color: #666; font-family:Tahoma; font-size:12px; font-weight:normal"> por </span><span class="pr_price"> ' . $currencies->display_price($new_products['specials_new_products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</span><br /> <span class="textdesconto">' . tep_display_parcela($new_products['specials_new_products_price']).' '.tep_discount_products($new_products['products_id']).'</span>';
				else 
				$price = '<span class="pr_price">' . $currencies->display_price($new_products['products_price_revenda'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</span><br /><span class="textdesconto">' . tep_display_parcela($new_products['specials_new_products_price']).'</span>';
			}else{
				if(!isset($_SESSION['customer_revenda'])||($_SESSION['customer_revenda']==0))//VERIFICANDO TIPO DE CONSUMIDOR	
				$price = '<span style="color: #666; font-family:Tahoma; font-size:12px; font-weight:normal">a partir de </span>'.$currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '<br /><span class="textdesconto">' . tep_display_parcela($total_parcelado).' '.tep_discount_products($new_products['products_id']).'</span>';
				else	
				$price = '<span style="color: #666; font-family:Tahoma; font-size:12px; font-weight:normal">a partir de </span>'.$currencies->display_price($new_products['products_price_revenda'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</b><br /><span class="textdesconto">' . tep_display_parcela($total_parcelado).'</span>' ;		
			}
			
			if($new_products['products_quantity']<=0){
				$ver_num_products = 'Disponibilidade: <a href="' . tep_href_link(FILENAME_NOTIFYME_PRODUCT, 'products_id=' . $new_products['products_id']) . '" style="font-style:italic;text-decoration:underline;">'.ENTRY_TEXT_PRODUCTS_SOB_CONSULTA.'</a>';
			}elseif($new_products['products_quantity']>0){
				if(STORE_OPENED_TO_BUY == 'True')
				$botao_comprar = '<div style="margin-top:5px;"><a href="' .tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $new_products['products_id']) . '">' . tep_image_button('button_in_cart.gif') . '</a></div>';
				else
				$botao_comprar = '';
				if($new_products['products_availability']!='') $ver_num_products = 'Disponibilidade: <b>'.$new_products['products_availability'].'</b>';
				else $ver_num_products = 'Disponibilidade: <b>Pronta Entrega</b>';
				$preco = '<span class="pr_price">'.$price.'</span><br/>';
				if($new_products['products_free_shipping'] == 1 or $new_products['products_weight'] == '0.00') $fretegratis = '<img src="includes/languages/portugues/images/buttons/frete_gratis.gif" alt="'.TEXT_FREE_SHIPPING_TO_BRASIL.'" width="125" height="52" />'; else $fretegratis ='';		
			}
	}
	
	switch (3) {
    case 2:
        $widthli = '48%';
        break;
	case 3:
        $widthli = '32%';
        break;
	case 4:
        $widthli = '23%';
        break;
	case 5:
        $widthli = '18%';
        break;
}
	
		

   echo '<li style="width:'.$widthli.';">
   			<div style="max-width:390px; margin:0 auto;">
			 		<div class="image"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $new_products['products_image'], $new_products['products_name'], 'YES', 'SPPE') . '</a></div>
                    <h2><a class="pr_name"  href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a></h2>
                    '.$preco.'
            </div>
		</li>';
    $col ++;
	$numcolShow = 3;
    if ($col == $numcolShow) {
      $col = 0;
      $row ++;
      echo '</ul>
	  <ul>';
    } else echo '';
  }
  echo '<li></li></ul><div style="clear:left; margin:0; padding:0;"></div>';
?>
<!--
<div style="padding:20px">
	<div style="height:20px; background-color:#CC6E6E; color:#FFF; font-size:20px; padding:10px">Últimas Inspirações...</div>
    <? //require_once('includes/boxes/newsbox.php');?>
</div>
-->