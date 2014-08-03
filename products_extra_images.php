<?php
$products_extra_images_query = tep_db_query("SELECT pe.products_extra_image, p.products_name FROM " . TABLE_PRODUCTS_EXTRA_IMAGES . " pe, ".TABLE_PRODUCTS_DESCRIPTION." p WHERE pe.products_id='" . $product_info['products_id'] . "' and p.products_id='" . $product_info['products_id'] . "'");

if (tep_db_num_rows($products_extra_images_query) >= 1){
	$rowcount_value=3; 	
	$rowcount=1;
?>
<div>
<?php	
	while ($extra_images = tep_db_fetch_array($products_extra_images_query)) {
	echo '<a href="' . tep_href_link(DIR_WS_IMAGES_PRODUTOS . htmlentities($extra_images['products_extra_image'])) . '" rel="prettyPhoto[gallery1]">'. tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $extra_images['products_extra_image'], addslashes($extra_images['products_name']), 'YES','SP', 'vspace="0"'). '</a>';
	if ($rowcount == $rowcount_value){echo '</tr><tr>'; $rowcount=1;}
	else {$rowcount=$rowcount+1;}
	}
?>	 
</div>
<?php } ?>