
<?php

	
	$price_ranges = Array( "Menor preço", "Maior preço");
	$price_range_list = '';
	$price_range_list[] = array('id' => '0', 'text' => ':: Compre pelo Preço ::' );
	for ($range=0; $range<sizeof($price_ranges); $range++) {
		$price_range_list[] = array('id' => $range, 'text' => $price_ranges[$range] );
	}
	echo  '<form name="shop_price" action="' . tep_href_link(FILENAME_SHOP_BY_PRICE) . '" method="get">' . tep_hide_session_id().tep_draw_hidden_field('cPath', $_GET['cPath']);
    echo  tep_draw_pull_down_menu('range', $price_range_list, $range, 'onchange="this.form.submit();"  size="1" style="width: 100%"') . tep_hide_session_id();
	echo '</form>'

  
?>
