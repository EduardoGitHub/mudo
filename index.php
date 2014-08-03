<?php
require('includes/application_top.php');

if(LOGIN_AUTHENTICCATION=='True'){
// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
 } 
 
// the following cPath references come from application_top.php
  $category_depth = 'top';
  if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
    $cateqories_products = tep_db_fetch_array($categories_products_query);
    if ($cateqories_products['total'] > 0) {
      $category_depth = 'products'; // display products
    } else {
      $category_parent_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'");
      $category_parent = tep_db_fetch_array($category_parent_query);
      if ($category_parent['total'] > 0) {
        $category_depth = 'nested'; // navigate through the categories
      } else {
        $category_depth = 'products'; // category has no products, but display the 'no products' message
      }
    }
  }
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
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
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body class="layoutLoja">
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>

<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="sidebar2"><?php //require(DIR_WS_INCLUDES . 'column_right.php'); ?></div>
  <div id="mainContent">
  <? 
  if(!isset($_GET['cPath'])){
  if ($banner = tep_banner_exists('dynamic', 'banner_flutuante')){ ?>
  <div style="height:350px; width: 500px; position:absolute; z-index:1; left:50%; margin-left:-250px; top:150px;" id="DivFlutuante">
  <a onClick="controlaCamada('DivFlutuante')" style="padding:5px;border:1px solid #000;text-decoration:none;background:#000;color:#fff; font-family:Tahoma; font-size:12px; cursor:pointer;" >Fechar</a>
  <?= tep_display_banner('static', $banner);?>
  </div>
  <? }} ?>
  
    <?php if((SHOW_FILE_TO_DOWLOAD == 'True')&&(SHOW_FILE_TO_DOWLOAD_AFTER_LOGIN == 'False')){?>
    <div class="tabelaPreco"><div>&nbsp;&nbsp;&raquo; TABELA DE PREÇO <a href="admin/exportprod_txt.php" TARGET="_parent" >( TXT )</a> &nbsp;&nbsp; <a href="admin/export_pdf.php" TARGET="_parent">( PDF )</a></div></div>
    <?php }else if(($not_show2 == 'False')&&(SHOW_FILE_TO_DOWLOAD_AFTER_LOGIN == 'True')){?>
        <div class="tabelaPreco"><div>&nbsp;&nbsp;&raquo; TABELA DE PREÇO <a href="admin/exportprod_txt.php" TARGET="_parent" >( TXT )</a> &nbsp;&nbsp; <a href="admin/export_pdf.php" TARGET="_parent">( PDF )</a></div></div>
     <?php }?>
    <?php
      if ($category_depth == 'nested') {
        $category_query = tep_db_query("select cd.categories_name, c.categories_image, cd.categories_htc_title_tag, cd.categories_htc_description from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");
		
        $category = tep_db_fetch_array($category_query);
    ?>
    <div class="pagestitulo"><span><h1><?php echo $category['categories_htc_title_tag']; ?></h1></span></div>
    <div>
	<?php 
	if (isset($cPath) && strpos('_', $cPath)) {
// check to see if there are deeper categories within the current category
$category_links = array_reverse($cPath_array);
for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
$categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
$categories = tep_db_fetch_array($categories_query);
if ($categories['total'] < 1) {
  // do nothing, go through the loop
} else {
  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
  break; // we've found the deepest category the customer is in
}
}
} else {
$categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
}

$number_of_categories = tep_db_num_rows($categories_query);

$rows = 0;
while ($categories = tep_db_fetch_array($categories_query)) {
$rows++;
$cPath_new = tep_get_path($categories['categories_id']);

if($categories['categories_image'] <> ''){
$p_pic_sub = '<a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . tep_image(DIR_WS_IMAGES_PRODUTOS . $categories['categories_image'], $categories['categories_name'], SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT) . '</a>';
}else {$p_pic_sub = '<a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '"><img src="images/prod_sem_imagem.jpg" border="0"></a>';}

$p_name_sub = '<a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . $categories['categories_name'] . '</a>';

$width = (int)(100 / MAX_DISPLAY_CATEGORIES_PER_ROW) . '%';
echo '<td align="center" width="' . $width . '">'.$p_pic_sub.'
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="vam name name2_padd" align="center"><b>'.$p_name_sub.'</b></td>
            </tr>
        </table>
    </td>'."\n";
    
  if ($col!=(MAX_DISPLAY_CATEGORIES_PER_ROW-1)){
  echo '
        <td class="padd_vv">'.tep_draw_separator('spacer.gif', '1', '1').'</td>					
        ';
  }else{	
                      
  if ((($rows / MAX_DISPLAY_CATEGORIES_PER_ROW) == floor($rows / MAX_DISPLAY_CATEGORIES_PER_ROW)) && ($rows != $number_of_categories)) {
    echo '              
</tr><tr><td class="bg_line_x" colspan="'.(MAX_DISPLAY_CATEGORIES_PER_ROW + MAX_DISPLAY_CATEGORIES_PER_ROW -1).'">'.tep_draw_separator('spacer.gif', '1', '15').'</td></tr>' . "\n";
    echo '<tr>' . "\n";
}
}
if ($col==MAX_DISPLAY_CATEGORIES_PER_ROW-1){
$col=0;
}else{
$col++;
}
}	

// needed for the new products module shown below
$new_products_category_id = $current_category_id; 
	?>
    </div>
    
    <?php
      } elseif ($category_depth == 'products' || isset($_GET['manufacturers_id'])) {
    // create column list
        $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                             'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                             'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                             'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                             'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                             'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                             'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
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
		
		$product_q = '';
		if(SHOW_WITH_STOCK_ZERO !='True')$product_q = ' and p.products_quantity > 0';
		
    // show the products of a specified manufacturer
        if (isset($_GET['manufacturers_id'])) {
        
            if(!isset($_SESSION['customer_revenda'])||($_SESSION['customer_revenda']==0)){//VERIFICANDO TIPO DE CONSUMIDOR	  	
                if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
				// We are asked to show only a specific category
					$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, pd.products_availability, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$_GET['filter_id'] . "' ".$product_q;
				  } else {
				// We show them all
					$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, pd.products_availability, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' ".$product_q;
				  }
            }else{
                if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
				// We are asked to show only a specific category
				$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price_revenda, pd.products_availability, p.products_tax_class_id, p.products_price_revenda as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$_GET['filter_id'] . "' ".$product_q;
				} else { 
				// We show them all
				$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price_revenda, pd.products_availability, p.products_tax_class_id, p.products_price_revenda as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' ".$product_q;
				}
            }
			
			
        } else {
    	  // show the products in a given categorie
          if(!isset($_SESSION['customer_revenda'])||($_SESSION['customer_revenda']==0)){//VERIFICANDO TIPO DE CONSUMIDOR	  	
                if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
				// We are asked to show only specific catgeory
					$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, pd.products_availability, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "' ".$product_q;
				} else {
				// We show them all
					$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, pd.products_availability, p.products_free_shipping, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "' ".$product_q;
				}
          }else{
                if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
				// We are asked to show only specific catgeory
					$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price_revenda, pd.products_availability, p.products_free_shipping, p.products_tax_class_id, p.products_price_revenda as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "' ".$product_q." ";
				} else {
				 // We show them all
					$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price_revenda, pd.products_availability, p.products_free_shipping, p.products_tax_class_id, p.products_price_revenda as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "' ".$product_q;
          		}
          }
        }    
		
		
		
		
        if ( (!isset($_GET['sort'])) || (!ereg('[1-8][ad]', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
          for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
            if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
              $_GET['sort'] = $i+1 . 'a';
              //$listing_sql .= " order by pd.products_name";
			  $listing_sql .= " order by pd.products_name asc, p.products_quantity desc";
              
			  break;
            }
          }
        } else {
          $sort_col = substr($_GET['sort'], 0 , 1);
          $sort_order = substr($_GET['sort'], 1);
          $listing_sql .= ' order by ';
		  
          switch ($column_list[$sort_col-1]) {
            case 'PRODUCT_LIST_MODEL':
              $listing_sql .= "p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_NAME':
              //$listing_sql .= "pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
			  $listing_sql .= " pd.products_name asc, p.products_quantity desc";
              break;
            case 'PRODUCT_LIST_MANUFACTURER':
              $listing_sql .= "m.manufacturers_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_QUANTITY':
              $listing_sql .= "p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_IMAGE':
              //$listing_sql .= "pd.products_name";
			  $listing_sql .= " pd.products_name asc, p.products_quantity desc";
              break;
            case 'PRODUCT_LIST_WEIGHT':
              $listing_sql .= "p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
            case 'PRODUCT_LIST_PRICE':
              $listing_sql .= "final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
              break;
          }
        }
    ?>
        
     <div class="listaprodutos"><?php include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);  
	 ?></div>   

    <?php }else{?>
    
    <?php  if((DISPLAY_PRODUCTS_IN_PROMOTION == 'true') && ($_SESSION['customer_revenda']==0 || !$_SESSION['customer_revenda'])){?>
    <div class="pagestitulo"><span>Produtos em Promoção</span></div>
    <div style="border:1px solid #CCC;">
        <?php include(DIR_WS_MODULES .FILENAME_ROTATOR);?>
    </div>
    <?php } ?>
    
    <div class="listaprodutos">
    	<?php 
		 if(SHOW_FRIST_PAGE_PROMOTION =='False'){
				 include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);	 
		 //include(DIR_WS_MODULES .FILENAME_SPECIALS);
		 }else
		 include(DIR_WS_MODULES .FILENAME_SPECIALS);
		 ?>
    </div>
    
    <?php  } ?>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>