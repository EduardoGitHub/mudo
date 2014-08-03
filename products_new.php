<?php
/*
  $Id: products_new.php,v 1.27 2003/06/09 22:35:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if(LOGIN_AUTHENTICCATION=='True'){
// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
 } 


  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCTS_NEW);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PRODUCTS_NEW));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">

<!-- body //-->
<table border="0" width="99%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top">
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      		<tr>
        		<td><div class="pagestitulo"><span><?php echo HEADING_TITLE; ?></span></div></td>
      		</tr>
            <tr><td><? echo '<div class="CaminhoNav"><b>Você está em:</b> </b<a href="'.tep_href_link(FILENAME_DEFAULT).'">Home</a> / '.$breadcrumb->trail(' / ').'</div>';?></td></tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  $products_new_array = array();

  $products_new_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, pd.products_availability, p.products_price_revenda, p.products_quantity, p.products_tax_class_id, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and products_highlight = 1 and p.products_quantity >0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by  pd.products_name"; //p.products_date_added DESC,
  $products_new_split = new splitPageResults($products_new_query_raw, MAX_DISPLAY_PRODUCTS_NEW);

  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>	
<?php
  }
?>
      <tr>
        <td><table border="0" width="90%" cellspacing="0" cellpadding="2">
<?php
  if ($products_new_split->number_of_rows > 0) {
    $products_new_query = tep_db_query($products_new_split->sql_query);
    while ($products_new = tep_db_fetch_array($products_new_query)) {
		/*if(!isset($customer_revenda)||($customer_revenda==0)){//VERIFICANDO TIPO DE CONSUMIDOR		  
			  
			  if ($new_price = tep_get_products_special_price($products_new['products_id'])) {
				$products_price = '<s class="pr_price"  style="color:#7F7F7F;font-size:11px">' . $currencies->display_price($products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id'])) . '</s> <span class="pr_price">' . $currencies->display_price($new_price, tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span>';
			  } else {
				$products_price = '<span class="pr_price">'.$currencies->display_price($products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id'])).'</span>';
			  }
		}else{
			if ($new_price = tep_get_products_special_price($products_new['products_id'])) {
				$products_price = '<s class="pr_price"  style="color:#7F7F7F;font-size:11px">' . $currencies->display_price($products_new['products_price_revenda'], tep_get_tax_rate($products_new['products_tax_class_id'])) . '</s> <span class="pr_price">' . $currencies->display_price($new_price, tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span>';
			  } else {
				$products_price = '<span class="pr_price">'.$currencies->display_price($products_new['products_price_revenda'], tep_get_tax_rate($products_new['products_tax_class_id'])).'</span>';
			  }
			
		}	  */
		
		
		if($new_price = tep_get_products_special_price($products_new['products_id'])) {
				  if($not_show =='False'){	//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
				  	if(!isset($customer_revenda)||($customer_revenda==0))//VERIFICANDO TIPO DE CONSUMIDOR	
					$products_price = '<span class="pr_price" style="padding-right:0px; color:#333; font-size:14px">de <s>'.  $currencies->display_price($products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id'])) . '</s></span>&nbsp;<br/> <span class="pr_price">por ' . $currencies->display_price($new_price, tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span><br /> <span class="textdesconto">' . tep_display_parcela($new_price).' '.tep_discount_products($products_new['products_id']).'</span>';
					else $products_price = '<span class="pr_price">' . $currencies->display_price($products_new['products_price_revenda'], tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span><br /><span class="textdesconto">' . tep_display_parcela($new_price).'</span>';
				  }else $products_price = '';
            }else{
			  if($not_show =='False'){	 //VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )	
              	if(!isset($customer_revenda)||($customer_revenda==0))//VERIFICANDO TIPO DE CONSUMIDOR
				$products_price = 'por: '.$currencies->display_price($products_new['products_price'],  tep_get_tax_rate($products_new['products_tax_class_id'])) . '<br /><span class="textdesconto">' . tep_display_parcela($products_new['products_price']).' '.tep_discount_products($products_new['products_id']).'</span>';
				else $products_price = $currencies->display_price($products_new['products_price_revenda'],  tep_get_tax_rate($products_new['products_tax_class_id'])) . '<br /><span class="textdesconto">' . tep_display_parcela($products_new['products_price_revenda']).'</span>';
			  }else $products_price = '';
            }

			
			if($not_show =='False'){
			  if($products_new['products_quantity']<=0){
			   $ver_num_products = 'Disponibilidade: <a href="' . tep_href_link(FILENAME_NOTIFYME_PRODUCT, 'products_id=' . $products_new['products_id']) . '" style="font-style:italic;text-decoration:underline;">'.ENTRY_TEXT_PRODUCTS_SOB_CONSULTA.'</a>';
			   $preco ='';
			   $fretegratis ='';
			   $botao_comprar ='';
			  }elseif($products_new['products_quantity']>0){
				  
			   if($products_new['products_availability']!='')$ver_num_products = 'Disponibilidade: <b>'.$products_new['products_availability'].'</b>';
			   else $ver_num_products = 'Disponibilidade: <b>Pronta Entrega</b>';
			   
			   $preco = $products_price;
			   if($products_new['products_free_shipping'] == 1 or $products_new['products_weight'] == '0.00') $fretegratis = '<img src="includes/languages/portugues/images/buttons/frete_gratis.gif" alt="'.TEXT_FREE_SHIPPING_TO_BRASIL.'" width="125" height="52" />'; else $fretegratis ='';
			   
			   if(STORE_OPENED_TO_BUY == 'True')
			   $botao_comprar = '<div style="margin-top:5px;"><a href="' .tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_new['products_id']) . '">' . tep_image_button('button_in_cart.gif') . '</a></div><br/>';
			   else
			   $botao_comprar = '';
			  }
			}
			
			?>
          <tr>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id']) . '">' . 
			tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $products_new['products_image'], $products_new['products_name'], 'YES', 'P') . '</a>'; ?></td>
            <td valign="top" class="main"><?php echo '<a class="pr_name"  href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id']) . '"><b><u>' . $products_new['products_name'] . '</u></b></a>
				<br><span class="pr_price">'.$preco.'</span>
				'.$fretegratis; 
			
	
			
			
			?></td><!-- ' . TEXT_DATE_ADDED . ' ' . tep_date_long($products_new['products_date_added']) . ' -->
            
            
            <td align="right" valign="middle" class="main">
			<?php 
				if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
				if(($products_new['products_quantity']>0)&&(STORE_OPENED_TO_BUY == 'True')){
					//echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_new['products_id']) . '">' . tep_image_button('button_in_cart.gif', IMAGE_BUTTON_IN_CART) . '</a>&nbsp; &nbsp;';
					}
			}?></td>
          </tr>
          <tr>
            <td colspüan="3"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr>
            <td class="main"><?php echo TEXT_NO_NEW_PRODUCTS; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  }
?>
        </table></td>
      </tr>
<?php
  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?> 