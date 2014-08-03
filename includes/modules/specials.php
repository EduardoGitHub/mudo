<div class="pagestitulo">
    <div style="float:left">Produtos em Promoção</div>
    <div style="float:right;margin-right:15px"><a href="<?php echo tep_href_link('promocao.html')?>">Veja mais...</a></div>
    <div style="clear:both"></div>
</div>
<?php
  if(!isset($customer_revenda)||($customer_revenda==0)){//VERIFICANDO TIPO DE CONSUMIDOR
  $specials_query_raw = "select p.products_id, pd.products_name, pd.products_availability, p.products_price, p.products_quantity, p.products_weight, p.products_free_shipping, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by rand() "; // s.specials_date_added DESC
  $specials_split = new splitPageResults($specials_query_raw, 6);
	}else{
	$specials_query_raw = "select p.products_id, pd.products_name, pd.products_availability, p.products_weight, p.products_price_revenda, p.products_quantity, p.products_free_shipping, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by rand() ";
  $specials_split = new splitPageResults($specials_query_raw, 6);
	
	}
  /*
  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {

		echo '<div style="padding-top:10px;"><span class="smallText">'.$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS).'</span> <span style="float:right" class="smallText">'.TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))).'</span></div>';
  }
  */

	echo '<ul>';
	$row = 0;
	$specials_query = tep_db_query($specials_split->sql_query);
	while ($specials = tep_db_fetch_array($specials_query)) {
	  $row++;
	/*
	  $product_query = tep_db_query("select products_description  from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$specials['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
	  $product = tep_db_fetch_array($product_query);
	  $new_products['products_description'] = $product['products_description'];
   */
   // get products category
   $categories_query = tep_db_query("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$specials['products_id'] . "'");
   if (tep_db_num_rows($categories_query) > 0) {
	 $categories = tep_db_fetch_array($categories_query);
	 $categories_query2 = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$categories['categories_id'] . "'");
	 $categories2 = tep_db_fetch_array($categories_query2);
	 $category_name = $categories2['categories_name'];
   } else {
	 $category_name = '';
   }
   
   if($specials['products_quantity']<=0){
    $ver_num_products = 'Disponibilidade: <a href="' . tep_href_link(FILENAME_NOTIFYME_PRODUCT, 'products_id=' . $listing['products_id']) . '" style="font-style:italic;text-decoration:underline;">'.ENTRY_TEXT_PRODUCTS_SOB_CONSULTA.'</a>';
    $preco ='';
	$fretegratis ='';
	$botao_comprar ='';
   }else{
	if($specials['products_availability']!='')  $ver_num_products = 'Disponibilidade: '.$specials['products_availability'];
	else $ver_num_products = 'Disponibilidade: Pronta Entrega';
	
	if($specials['products_free_shipping'] == 1 or $specials['products_weight'] == '0.00') $fretegratis = '<img src="includes/languages/portugues/images/buttons/frete_gratis.gif" alt="'.TEXT_FREE_SHIPPING_TO_BRASIL.'" width="125" height="52" />'; else $fretegratis ='';
	
	
	
	if(!isset($customer_revenda)||($customer_revenda==0)){
	if(PARCELAMENTO_SHOW == 'true')	
	$preco = '<span class="ch6"><span class="pr_price" style="padding-right:0px; font-size:12px">de <s>'.$currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</s></span><span class="pr_price"> por ' . $currencies->display_price($specials['specials_new_products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span><br/><span class="textdesconto">' . tep_display_parcela($specials['specials_new_products_price']).' '.tep_discount_products($specials['products_id']).'</span>';
	else
	$preco = '<span class="ch6"><span class="pr_price" style="padding-right:0px; color:#83255A; font-size:12px">de <s>'.$currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</s></span> <span class="pr_price"> por ' . $currencies->display_price($specials['specials_new_products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span><br/>';
	
	}else
	$preco = '<span  class="pr_price">'.$currencies->display_price($specials['products_price_revenda'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span><br/><span class="textdesconto">' . tep_display_parcela($specials['specials_new_products_price']).'</span>';
	
	if(STORE_OPENED_TO_BUY == 'True')
	$botao_comprar = '<br/><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials['products_id']) . '">' . tep_image_button('button_in_cart.gif') . '</a><br/>';
	else
	$botao_comprar = '';
   }
	
	
	switch (ENTRY_NUM_COLUMN) {
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
   
	  echo '
	  <li style="width:'.$widthli.';">
		<div style="max-width:390px; margin:0 auto;">
			<div style="width:'.SMALL_IMAGE_WIDTH.'px; "><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '">' . tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $specials['products_image'], $specials['products_name'], 'YES', 'P') . '</a></div>

			<h2><a class="pr_name"  href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $specials['products_id']) . '">' . $specials['products_name'] . '</a></h2>
			'.$preco.'
		
		</div>
	  </li>';
//height:'.SMALL_IMAGE_HEIGHT.'px;
	  if ((($row / ENTRY_NUM_COLUMN) == floor($row / ENTRY_NUM_COLUMN)))  
	  echo '</ul><div style="clear:left; margin:0; padding:0;"></div>
	  <ul>';

    }
	  echo '<div style="clear:left; margin:0; padding:0;"></div><br/><br/>';  
	  /*
  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {

		echo '<div style="padding-top:10px;"><span class="smallText">'.$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS).'</span> <span style="float:right" class="smallText">'.TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))).'</span></div>';
  }
  */
?>