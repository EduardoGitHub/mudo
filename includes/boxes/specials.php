<? if(isset($customer_revenda) && $customer_revenda == 0){//VERIFICANDO TIPO DE CONSUMIDOR 
$random_product_select = tep_db_query("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_quantity > 0 and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS);
$num = tep_db_num_rows($random_product_select);
$random_product = tep_db_fetch_array($random_product_select);
if ($num >0) {
?>
<div class="box" id="promocao">
<div class="lay_bordaBox"><span><?=BOX_HEADING_SPECIALS?></span></div>
<div class="boxconteudo">
<marquee  behavior="scroll" direction="up" scrolldelay="100" onmouseover="this.stop();" onmouseout="this.start();">
<?php
for($cont2 = 0; $cont2 < $num; $cont2++){
	$preco ='';
	if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
		$preco = '
		<span class="pr_price" style="padding-right:0px; color:#7F7F7F; font-size:11px">de <s>' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s></span><br />
		<span class="pr_price" style="color:#FF0000; font-size:15px; font-weight:bold;">por ' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
	}
	
		echo '<div style="border-bottom:1px dashed #CCC; padding-bottom:5px; text-align:center;">
			  <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]) . '">' .tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $random_product['products_image'], $random_product['products_name'], 'YES', 'SP') . '</a><br />
			  <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '" style="color:#000; font-size:11px; font-weight:bold;">
			 ' . substr($random_product['products_name'],0,17) . '...</a><br />'.$preco.' </div>';
			 $random_product = tep_db_fetch_array($random_product_select);
}
?>
</marquee>
</div>
</div>
<? }}?>