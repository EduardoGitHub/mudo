<?php
require('includes/application_top.php');
  if(LOGIN_AUTHENTICCATION=='True'){
// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
 } 
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SPECIALS);
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_SPECIALS));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
/*** Begin Header Tags SEO ***/
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
  <title><?php echo TITLE; ?></title>
<?php
}
/*** End Header Tags SEO ***/
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
  
  

<div class="listaprodutos">
<div class="pagestitulo"><span>Produtos em Promoção</span></div>

  <?php
  $product_q = '';
  if(SHOW_WITH_STOCK_ZERO != 'True')$product_q = ' and p.products_quantity > 0';
  
  $specials_query_raw = "select p.products_id, pd.products_name, pd.products_availability, p.products_price, p.products_price_revenda, p.products_quantity, p.products_weight, p.products_free_shipping, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' ".$product_q." order by s.specials_date_added DESC";
  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div style="padding-top:10px;"><span class="smallText"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></span> <span style="float:right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></span></div>
<?php } ?>

<ul>
<?php
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



	
	
	if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
		
			if(!isset($customer_revenda)||($customer_revenda==0)){//VERIFICANDO TIPO DE CONSUMIDOR	
				if(PARCELAMENTO_SHOW == 'true')
				$price = '<span  class="pr_price" style="padding-right:0px; color:#333; font-size:12px">de <s>'.$currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</s></span>&nbsp; por <span class="pr_price">' . $currencies->display_price($specials['specials_new_products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span><br/><span class="textdesconto">' . tep_display_parcela($specials['specials_new_products_price']).' '.tep_discount_products($specials['products_id']).'</span>';
				else
				$price = '<span  class="pr_price" style="padding-right:0px; color:#333; font-size:12px">de <s>'.$currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</s></span>&nbsp; por <span class="pr_price">' . $currencies->display_price($specials['specials_new_products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span>';
			
			}else{	
				if(PARCELAMENTO_SHOW == 'true')
				$price = '<span class="pr_price" style="padding-right:0px; color:#333; font-size:12px"><span class="pr_price">' . $currencies->display_price($specials['products_price_revenda'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span><br/><span class="textdesconto">' . tep_display_parcela($specials['products_price_revenda']).' '.tep_discount_products($specials['products_id']).'</span>';
				else
				$price = '<span class="pr_price" style="padding-right:0px; color:#333; font-size:12px"><span class="pr_price">' . $currencies->display_price($specials['products_price_revenda'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span>';
			}
			
		   if($specials['products_quantity']<=0){
		   $ver_num_products = 'Disponibilidade: <a href="' . tep_href_link(FILENAME_NOTIFYME_PRODUCT, 'products_id=' . $specials['products_id']) . '" style="font-style:italic;text-decoration:underline;">Sob consulta</a>';
		   $preco ='';
		   $fretegratis ='';
		   $botao_comprar ='';
		  }else{
			  $preco ='';
		   $fretegratis ='';
		   $botao_comprar ='';
		   if($specials['products_availability']!='')$ver_num_products = 'Disponibilidade: '.$specials['products_availability'];
		   else $ver_num_products = 'Disponibilidade: Pronta Entrega';
		   if(STORE_OPENED_TO_BUY == 'True')
		   $botao_comprar = '<div style="margin-top:5px;"><a href="' .tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials['products_id']) . '">' . tep_image_button('button_in_cart.gif') . '</a></div><br/>';
		   else
		   $botao_comprar = '';
		   
		   if($specials['products_free_shipping'] == 1 or $specials['products_weight'] == '0.00' ) $fretegratis = '<img src="includes/languages/portugues/images/buttons/frete_gratis.gif" alt="'.TEXT_FREE_SHIPPING_TO_BRASIL.'" width="125" height="52" />';
		   
		   $preco = '<span class="pr_price">'.$price.'</span><br/>';
		   
		  }
	}
	
	
	switch (ENTRY_NUM_COLUMN) {
    case 2:
        $widthli = '48%';
        break;
	case 3:
        $widthli = '31%';
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
	  	<div style="max-width:380px; margin:0 auto;">
			  <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '">' .tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $specials['products_image'], $specials['products_name'], 'YES','P', 'vspace="0"'). '</a><br/><br/>
			  <a class="pr_name"  href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '"><strong><b>' . $specials['products_name'] . '</b></strong></a><br/>
			  '.$preco.'
			  '.$fretegratis.'
		</div>
	  </li>';
	
 $numcolShow = ENTRY_NUM_COLUMN;
      if ((($row / $numcolShow) == floor($row / $numcolShow))) {
		echo '</ul><div style="clear:left; margin:0; padding:0;"></div>
	  <ul>';
      }else echo '';
    }
//<span class="ml6">'.substr(strip_tags($product['products_description']), 0, 60).' ...</span><br/>	
//<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials['products_id']) . '">' . tep_image_button('button_in_cart.gif') . '</a>
?>
</ul>
</div>
<br /><br /><br />
<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div><span class="smallText"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></span> <span style="float:right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></span></div>
<?php
  }
  
?>

<br />
<div><?php echo '<a onclick="history.go(-1)" style="cursor:pointer">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>';?></div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?> 