<?php
  require('includes/application_top.php');
  $sbprice = true;
  $range = 0;
  if (isset($_GET['range'])) {
    $range = $_GET['range'];
  }
  
  if (isset($_GET['keywords'])) {
    $keywords = $_GET['keywords'];
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOP_BY_PRICE);

  // create column list
		  $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
		                       'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
		                       'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
		                       'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
		                       'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
		                       'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
		                       'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
		                       // Product Listing in Columns - Start  (You can remove those 4 lines if you are not using it).
		                       'PRODUCT_LIST_MULTIPLE' => PRODUCT_LIST_MULTIPLE,
		                       'PRODUCT_LIST_BUY_NOW_MULTIPLE' => PRODUCT_LIST_BUY_NOW_MULTIPLE,
		                       // Product Listing in Columns - End
		                       'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW);
		
		  asort($define_list);
		
		  $column_list = array();
		  reset($define_list);
		  while (list($key, $value) = each($define_list)) {
		    if ($value > 0) $column_list[] = $key;
		  }
		
		  $select_column_list = '';
		
		  for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
		    switch ($column_list[$i]) {
		      case 'PRODUCT_LIST_MODEL':
		        $select_column_list .= 'p.products_model, ';
		        break;
			   case 'PRODUCT_LIST_NAME':
              $select_column_list .= 'pd.products_name, ';
              break;	
		      case 'PRODUCT_LIST_MANUFACTURER':
		        $select_column_list .= 'm.manufacturers_name, ';
		        break;
		      case 'PRODUCT_LIST_QUANTITY':
		        $select_column_list .= 'p.products_quantity, ';
		        break;
		      case 'PRODUCT_LIST_IMAGE':
		        $select_column_list .= 'p.products_image, ';
		        break;
		      case 'PRODUCT_LIST_WEIGHT':
		        $select_column_list .= 'p.products_weight, ';
		        break;
		    }
		  }
		  
		  if($range == 0)
			$teste = "products_price asc";
		  else if($range == 1)
		  	$teste = " products_price desc";
		  else if($range == 2)
		  	$teste = " products_name asc";
		  else if($range == 3)
		  	$teste = " products_name desc";


			if (isset($_GET['manufacturers_id'])) {
				if(!isset($customer_revenda)||($customer_revenda==0))//VERIFICANDO TIPO DE CONSUMIDOR	  	
				// We show them all
				$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] ."' and p.products_quantity > 0 order by ".$teste;
            	else
				// We show them all
				$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price_revenda, p.products_tax_class_id, p.products_price_revenda as final_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] ."' and p.products_quantity > 0 order by ".$teste;
			}else{
				
				$parm = strstr($_GET['cPath'],'_');
				if($parm)
				$parm = substr($parm,1);
				else
				$parm = $_GET['cPath'];
				
				if(!isset($customer_revenda)||($customer_revenda==0)){
					if($keywords =='')
						$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = ".$parm." and p.products_quantity > 0 order by ".$teste;
					else
						$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and (pd.products_name like '%" . tep_db_input($keywords) . "%' or p.products_model like '%" . tep_db_input($keywords) . "%' or m.manufacturers_name like '%" . tep_db_input($keywords) . "%')       and p.products_quantity > 0 order by ".$teste;
				}else{
					if($keywords =='')
						$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price_revenda, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = ".$parm." and p.products_quantity > 0 order by ".$teste;
					else
						$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price_revenda, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and (pd.products_name like '%" . tep_db_input($keywords) . "%' or p.products_model like '%" . tep_db_input($keywords) . "%' or m.manufacturers_name like '%" . tep_db_input($keywords) . "%') and p.products_quantity > 0 order by ".$teste;
				}
			}
			
			
//arrumar filtro!! não esta aparecendo os produtos que tem estoque igual 0. CODIGO CERTO ABAIXO



/*(select p.products_image, pd.products_name, p.products_quantity, p.products_price, p.products_weight, p.products_id, p.manufacturers_id, p.products_free_shipping, p.products_tax_class_id, 
IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price 
from products_description pd, products p 
left join manufacturers m on p.manufacturers_id = m.manufacturers_id 
left join specials s on p.products_id = s.products_id, products_to_categories p2c 
where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '2' and p2c.categories_id = 24 
and p.products_quantity > 0
order by products_price desc
limit 0, 18
)
union all
(
select p.products_image, pd.products_name, p.products_quantity, p.products_price, p.products_weight, p.products_id, p.manufacturers_id, p.products_free_shipping, p.products_tax_class_id, 
IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price 
from products_description pd, products p 
left join manufacturers m on p.manufacturers_id = m.manufacturers_id 
left join specials s on p.products_id = s.products_id, products_to_categories p2c 
where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '2' and p2c.categories_id = 24 
and p.products_quantity = 0

limit 0, 18

)*/
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
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>"/>
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
	<div class="listaprodutos"> <?php require(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING); ?> </div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>