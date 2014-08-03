<?php

  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');		
  $list_box_contents = array();

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = TABLE_HEADING_IMAGE;
        $lc_align = 'center';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
        $lc_text = TABLE_HEADING_BUY_NOW;
        $lc_align = 'center';
        break;
    }

    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {
      $lc_text = tep_create_sort_heading($HTTP_GET_VARS['sort'], $col+1, $lc_text);
    }

    $list_box_contents[0][] = array('align' => $lc_align,
                                    'params' => 'class="productListing-heading"',
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $column = 0;
	
	if (PRODUCT_LIST_FILTER > 0) {
	  if (isset($HTTP_GET_VARS['manufacturers_id'])) {
		$filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name, cd.categories_description from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' order by cd.categories_name";
	  } else {
		$filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
	  }
	  $filterlist_query = tep_db_query($filterlist_sql);
	  if (tep_db_num_rows($filterlist_query) >= 1) {
		$fabricantes = tep_draw_form('filter', FILENAME_DEFAULT, 'get'); //. TEXT_SHOW . '&nbsp;';
		if (isset($HTTP_GET_VARS['manufacturers_id'])) {
		  $fabricantes .= tep_draw_hidden_field('manufacturers_id', $HTTP_GET_VARS['manufacturers_id']);
		  $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
		} else {
		  $fabricantes .= tep_draw_hidden_field('cPath', $cPath);
		  $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
		}
		
		while ($filterlist = tep_db_fetch_array($filterlist_query)) {
		  $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
		}
		echo tep_draw_hidden_field('sort', $HTTP_GET_VARS['sort']);
		$fabricantes .= tep_draw_pull_down_menu('filter_id', $options, (isset($HTTP_GET_VARS['filter_id']) ? $HTTP_GET_VARS['filter_id'] : ''), 'onchange="this.form.submit()"');
		$fabricantes .= '</form>';
	  }
	}
	
	$price_ranges = Array( "Menor preço", "Maior preço", "Nome A - Z", "Nome Z - A");
	$price_range_list = '';
	$price_range_list[] = array('id' => '0', 'text' => BOX_HEADING_SHOP_BY_PRICE );
	for ($range=0; $range<sizeof($price_ranges); $range++) {
		$price_range_list[] = array('id' => $range, 'text' => $price_ranges[$range] );
	}
	
	
	 
		$sortby = '<form name="shop_price" action="' . tep_href_link(FILENAME_SHOP_BY_PRICE) . '" method="get">'; 
		if (isset($HTTP_GET_VARS['manufacturers_id']))	
			$sortby .= tep_hide_session_id().tep_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']).tep_draw_hidden_field('keywords', (isset($_GET['keywords']) ? $_GET['keywords'] : ''));
		else
			$sortby .= tep_hide_session_id().tep_draw_hidden_field('cPath', $_GET['cPath']).tep_draw_hidden_field('keywords', (isset($_GET['keywords']) ? $_GET['keywords'] : '') );
    
		$sortby .=  tep_draw_pull_down_menu('range', $price_range_list, $range, 'onchange="this.form.submit();"') . tep_hide_session_id();
		$sortby .='</form>';
	
	
	
	// Get the right image for the top-right
	$image = DIR_WS_IMAGES . 'table_background_list.gif';
	if (isset($HTTP_GET_VARS['manufacturers_id'])) {
	  $image = tep_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'");
	  $image = tep_db_fetch_array($image);
	  $image = $image['manufacturers_image'];
	} elseif ($current_category_id) {
	  $image = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
	  $image = tep_db_fetch_array($image);
	  $image = $image['categories_image'];
	}
	
	
	
    echo '<div class="pagestitulo"><div class="CaminhoNav" style="position:absolute; left:0; top:0px;">'.$breadcrumb->trail(' >> ').'</div><span style="position:absolute; right:25px;">'.$sortby.' </span></div>';
	
	if (isset($_GET['cPath']) && strpos('_', $_GET['cPath'])) { 
	$cPaths = explode('_', $_GET['cPath']); 
	$categoriesid = $cPaths[1]; 
	}else  $categoriesid = $_GET['cPath'];

	$nomeCategoria = '';

	if(isset($_GET['cPath']) && $_GET['cPath'] <>'' ){
		$categoriesquery = tep_db_query("SELECT categories_name, categories_description FROM categories_description WHERE categories_id = ".$categoriesid);
		$categoriesdados =  tep_db_fetch_array($categoriesquery);
		$nomeCategoria = $categoriesdados['categories_name'];
		echo '
		<div class="TextoCategorias">
			<h1>'.$nomeCategoria.'</h1><br />
			<div>'.$categoriesdados['categories_description'].'</div>
		</div>';
	}

	  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {

		echo '<div style="padding:15px; 25px 0 0 "><span class="smallText">'.$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS).'</span> <span style="float:right" class="smallText">'.TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))).'</span></div>';
  }
	
	
	
	
			echo '<ul>';
    $listing_query = tep_db_query($listing_split->sql_query);
    while ($listing = tep_db_fetch_array($listing_query)) {
		

      $product_contents = array();
      $rows++;
      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';
		
		
		
        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $lc_align = '';
            $lc_text = '&nbsp;' . $listing['products_model'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_NAME':
            $lc_align = '';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
              $lc_text = '<a class="pr_name"   href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a>';
            } else {                 
              $lc_text = '<a class="pr_name"  href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a>';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_align = '';
            $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a>&nbsp;';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';
            if(tep_not_null($listing['specials_new_products_price'])) {
				  if($not_show =='False'){	//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
				  	if(!isset($_SESSION['customer_revenda'])||($_SESSION['customer_revenda']==0))//VERIFICANDO TIPO DE CONSUMIDOR	
					$lc_text = '<span class="pr_price" style="padding-right:0px; color:#333; font-size:12px">de <s>'.  $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s></span>&nbsp; <span class="pr_price">por ' . $currencies->display_price($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span><br /> <span class="textdesconto">' . tep_display_parcela($listing['specials_new_products_price']).' '.tep_discount_products($listing['products_id']).'</span>';
					else $lc_text = '<span class="pr_price">' . $currencies->display_price($listing['products_price_revenda'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span><br /><span class="textdesconto">' . tep_display_parcela($listing['specials_new_products_price']).'</span>';
				  }else $lc_text = '';
            }else{
			  if($not_show =='False'){	 //VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )	
              	if(!isset($_SESSION['customer_revenda'])||($_SESSION['customer_revenda']==0))//VERIFICANDO TIPO DE CONSUMIDOR
				$lc_text = '<span style="color: #666; font-family:Tahoma; font-size:12px; font-weight:normal">a partir de </span>'.$currencies->display_price($listing['products_price'],  tep_get_tax_rate($listing['products_tax_class_id'])) . '<br /><span class="textdesconto">' . tep_display_parcela($listing['products_price']).' '.tep_discount_products($listing['products_id']).'</span>';
				else $lc_text = $currencies->display_price($listing['products_price_revenda'],  tep_get_tax_rate($listing['products_tax_class_id'])) . '<br /><span class="textdesconto">' . tep_display_parcela($listing['products_price_revenda']).'</span>';
			  }else $lc_text = '';
            }       
            break;

          case 'PRODUCT_LIST_QUANTITY':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing['products_quantity'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing['products_weight'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_IMAGE':
            $lc_align = 'center';
			
			
	

            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
              $lc_text = '<a href="'. tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">
			  ' . tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $listing['products_image'], $listing['products_name'], 'YES', 'P') . '</a>';
            } else {
              $lc_text = '<a href="'. tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '" >
			  ' . tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $listing['products_image'], $listing['products_name'], 'YES', 'P') . '
			  </a>';
            }
            break;
          case 'PRODUCT_LIST_BUY_NOW':
            $lc_align = 'center';
            $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), 'action=buy_now&products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a>&nbsp;';
            break;
        }

        $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => 'class="productListing-data"',
                                               'text'  => $lc_text);
        $product_contents[] = $lc_text;       
      }
   // get products category
   $categories_query = tep_db_query("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$listing['products_id'] . "'");
   if (tep_db_num_rows($categories_query) > 0) {
     $categories = tep_db_fetch_array($categories_query);
     $categories_query2 = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$categories['categories_id'] . "'");
     $categories2 = tep_db_fetch_array($categories_query2);
     $category_name = $categories2['categories_name'];
   } else {
     $category_name = '';
   }
   
   	if($not_show =='False'){
      if($listing['products_quantity']<=0){
	   $ver_num_products = 'Disponibilidade: <a href="' . tep_href_link(FILENAME_NOTIFYME_PRODUCT, 'products_id=' . $listing['products_id']) . '" style="font-style:italic;text-decoration:underline;">'.ENTRY_TEXT_PRODUCTS_SOB_CONSULTA.'</a>';
	   $preco ='';
	   $fretegratis ='';
	   $botao_comprar ='';
	  }elseif($listing['products_quantity']>0){
		  if($listing['products_availability'] !='')$ver_num_products = 'Disponibilidade: <b>'.$listing['products_availability'].'</b>';
		  else $ver_num_products = 'Disponibilidade: <b>Pronta Entrega</b>';
	   $preco = '<span class="pr_price">'.$product_contents[2].'</span><br/>';
	   if($listing['products_free_shipping'] == 1 or $listing['products_weight'] == '0.00') $fretegratis = '<img src="includes/languages/portugues/images/buttons/frete_gratis.gif" alt="'.TEXT_FREE_SHIPPING_TO_BRASIL.'" width="125" height="52" />'; else $fretegratis ='';
	   
	   if(STORE_OPENED_TO_BUY == 'True')
	   $botao_comprar = '<div style="margin-top:5px;"><a href="' .tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing['products_id']) . '">' . tep_image_button('button_in_cart.gif') . '</a></div><br/>';
	   else
	   $botao_comprar = '';
	  }
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
	echo '<li style="width:'.$widthli.';">
			<div style="max-width:390px; margin:0 auto;">
					<div style="width:'.SMALL_IMAGE_WIDTH.'px; ">'.$product_contents[0].'</div>
                        <h2>'.$product_contents[1].'</h2>
                        '.$preco.'
                   
			</div>
		</li>';
		
		//height:'.SMALL_IMAGE_HEIGHT.'px;
      $column ++;
	  $numcolShow = ENTRY_NUM_COLUMN;
      if ($column >= $numcolShow) {
        $rows ++;
        $column = 0;
        echo '</ul><div style="clear:left; margin:0; padding:0;"></div>
	  <ul>';
      }
    }
    echo '<li></li></ul>';
			if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3') ) ) { 
  				$prev_next = '<div><span class="smallText">'.$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS).'</span> <span style="float:right" class="smallText">'. TEXT_RESULT_PAGE.''.$listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))).'</span></div>';
			}
			
			
			
    echo '<div style="clear:left; margin:0; padding:0;"></div>
			<br/><br/><br/><br/><div>'.$prev_next.'  <br/>';

			echo '</div>';
  } else {
    echo '<div class="pagestitulo"><span>Categorias</span></div>
		  <div class="productListing-data">'.TEXT_NO_PRODUCTS.'</div>';
  }
  
  if(isset($_GET['cPath']) && $_GET['cPath'] <>'' ){
  $seo = tep_db_query("SELECT * FROM categories_seo WHERE categories_id = ".$categoriesid);
  ?>
  
  
  <?
  	if (tep_db_num_rows($seo) > 0) {
    echo '<div class="seoMoreInfo">Saiba mais sobre adesivos de parede '.$nomeCategoria.'</div>';
	while($seo_dados =  tep_db_fetch_array($seo)){
  ?>
  <div class="exemplo">
	<h2 class="accordion">&raquo; <?=$seo_dados['title']?></h2>
	<div class="accordion">
		<p><?=$seo_dados['text']?></p>
	</div>
  </div>
  <? }} }?>