<div class="box" id="novidades">
<div class="lay_bordaBox"><span><?=BOX_HEADING_WHATS_NEW?></span></div>
<div class="boxconteudo">

<?php
  if ($random_product_select = tep_db_query("select products_id, products_image, products_tax_class_id, products_price, products_price_revenda from " . TABLE_PRODUCTS . " where products_status = '1' and products_quantity > 0 and products_status = 1 order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {

for($cont = 0; $cont < tep_db_num_rows($random_product_select); $cont++){
	$random_product = tep_db_fetch_array($random_product_select);
	$random_product['products_name'] = tep_get_products_name($random_product['products_id']);
	$random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);

	

   if($not_show =='False'){
	   if(!isset($customer_revenda)||($customer_revenda==0)){
		   if (tep_not_null($random_product['specials_new_products_price'])) {
			  $whats_new_price = '<s style="color:#666666; font-size:11px; font-weight:bold; text-decoration:overline;">' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br />';
			  $whats_new_price .= '<span style="color:#FF0000; font-size:15px; font-weight:bold;">' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
			} else {
			  $whats_new_price = '<span style="color:#FF0000; font-size:15px; font-weight:bold;">'.$currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])).'</span>';
			}
	   }else{
		   	$whats_new_price = '<span style="color:#FF0000; font-size:15px; font-weight:bold;">'.$currencies->display_price($random_product['products_price_revenda'], tep_get_tax_rate($random_product['products_tax_class_id'])).'</span>';
	   }
   }else{
	   $whats_new_price = '';
	  }
	  
	 

	echo '<div style="border-bottom:1px dashed #CCC; padding-bottom:5px; text-align:center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $random_product['products_image'], $random_product['products_name'], 'YES','SP', 'vspace="0"') . '</a><br /><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '" style="color:#000; font-size:11px; font-weight:bold; ">' . substr($random_product['products_name'],0,17) . '...</a><br />' . $whats_new_price.'</div>';

}	
  }
  
  
?>
</div>
</div>