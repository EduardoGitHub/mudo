<?php
  require('includes/application_top.php');
  
  header("HTTP/1.1 301 Moved Permanently"); 
  header("Location: ".tep_href_link('product_info.php','products_id='.(int)$HTTP_GET_VARS['products_id'])); 



      $product_info_query = tep_db_query("select p.products_id, pd.products_name, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_price_revenda, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  if (!tep_db_num_rows($product_info_query)) {
    tep_redirect(tep_href_link(FILENAME_REVIEWS));
  } else {
    $product_info = tep_db_fetch_array($product_info_query);
  }

if(!isset($customer_revenda)||($customer_revenda==0)){//VERIFICANDO TIPO DE CONSUMIDOR	
		if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
		if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
		  $products_price = '<s pr_price  style="color:#777777; font-size:11px">' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</s>&nbsp;<span class=ch8>' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
		} else {
		  $products_price ='<span pr_price>'. $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
		}
		}// FIM VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
	}else{
	
		if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
		if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
		  $products_price = '<s pr_price  style="color:#777777; font-size:11px">' . $currencies->display_price($product_info['products_price_revenda'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</s>&nbsp;<span class=ch8>' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
		} else {
		  $products_price ='<span pr_price>'. $currencies->display_price($product_info['products_price_revenda'], tep_get_tax_rate($product_info['products_tax_class_id']));
		}
		}// FIM VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
	}

  if (tep_not_null($product_info['products_model'])) {
    $products_name = $product_info['products_name'] . '<br><span class="smallText">[' . $product_info['products_model'] . ']</span>';
  } else {
    $products_name = $product_info['products_name'];
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_REVIEWS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params()));
  

  
  if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
		   if(($product_info['products_quantity']<=0)&&(STORE_OPENED_TO_BUY == 'True')){
			$ver_num_products = 'Disponibilidade: <a href="' . tep_href_link(FILENAME_NOTIFYME_PRODUCT, 'products_id=' . $product_info['products_id']) . '" style="font-style:italic;text-decoration:underline;">'.ENTRY_TEXT_PRODUCTS_SOB_CONSULTA.'</a>';
			$comprar ='';
			
		}elseif(($product_info['products_quantity']>0)&&(STORE_OPENED_TO_BUY == 'True')){
			$ver_num_products = 'Disponibilidade: Pronta Entrega';
			$comprar = tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_BUY_NOW);
		}
	}
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
<link rel="stylesheet" href="includes/librays/zoom/jqzoom.css" type="text/css" />
<style type="text/css">
.Comentarios{ position:relative; display:inline-table; width:100%;}
.ProdutosImagem{width:210px; height:200px;  text-align:center; float:left; display:inline;}
.ComentariosLista{font-family:Tahoma; font-size:11px; color:#333; float:left; width:70%; display:inline; margin-top:10px; border-bottom:1px dashed #666; padding-bottom:5px; margin-left:10px; }
.ml5 h1{ font-size:25px; color: #0076B1; text-decoration: none; font-weight: bold; font-family: arial; }
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
  	<div class="pagestitulo"><span><?php echo HEADING_TITLE; ?></span></div>
    <div class="Comentarios">
    <div class="addthis_toolbox addthis_default_style" style="padding-top:5px;">
        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
        <a class="addthis_button_tweet"></a>
        <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
        <a class="addthis_counter addthis_pill_style"></a>
      </div>
		<?php
        $reviews_query_raw = "select r.reviews_id, left(rd.reviews_text, 100) as reviews_text, r.reviews_rating, r.date_added, r.customers_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.products_id = '" . (int)$product_info['products_id'] . "' and r.reviews_id = rd.reviews_id and r.status = 1 and rd.languages_id = '" . (int)$languages_id . "' order by r.reviews_id desc";
        $reviews_split = new splitPageResults($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);
        if ($reviews_split->number_of_rows > 0) {
        	if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
        ?>
        <div>
            <span class="smallText"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></span>
            <span style="float:right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?></span>
        </div>
        <? } ?>
       
        <div style="margin-left:10px;"><span class="ml5"><h1><?=$products_name?></h1></span></div>
        
		<? 
            $reviews_query = tep_db_query($reviews_split->sql_query);
            while ($reviews = tep_db_fetch_array($reviews_query)) { 
        ?>   
        <div class="ComentariosLista">
          <span class="main"><?php echo '<a style="font-weight:bold; color:#333;"  href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $product_info['products_id'] . '&reviews_id=' . $reviews['reviews_id']) . '"><u>' . sprintf(TEXT_REVIEW_BY, tep_output_string_protected($reviews['customers_name'])) . '</u></a>'; ?>
          </span>
	
          <span class="main">
		  <?php 
		  $today = getdate(strtotime($reviews['date_added']));
		  $dias = diaDaSemana($today["weekday"]).' '.$today["mday"].' '.mesReferente($today["month"]).' de '.$today["year"];		  
		  echo '('.sprintf(TEXT_REVIEW_DATE_ADDED, $dias).')'; ?>
          </span>
          
          <br /><br /> 
          <span class="main"><?php echo tep_break_string(tep_output_string_protected($reviews['reviews_text']), 60, '<br />') . ((strlen($reviews['reviews_text']) >= 100) ? '..' : '') . '<br><br><i>' . sprintf(TEXT_REVIEW_RATING, tep_image(DIR_WS_IMAGES . 'stars_' . $reviews['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])) . '</i>'; ?>
          </span>
        </div>
       
      
		<? 
        
        } 
         } else
           echo '<span class="main">'.TEXT_NO_REVIEWS.'</span>'; 
          if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
        ?>
        	<br class="clearfloat" />
            <br /><br />
            <div >
                <span class="smallText"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></span>
                <span style="float:right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?></span>
            </div>
        <? 
        }  
		echo '<br /><br />';
        echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params()) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>&nbsp;&nbsp;&nbsp;&nbsp;'; 
        echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params()) . '">' . tep_image_button('button_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW) . '</a>'; 
        ?>
	</div> 
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>