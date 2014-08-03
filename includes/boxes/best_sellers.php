<div class="box" id="maisvendidos">
<div class="lay_bordaBox"><span>Mais Vendidos</span></div>
<div class="boxconteudo" >
<marquee  behavior="scroll" direction="up" scrolldelay="100" onmouseover="this.stop();" onmouseout="this.start();">
			<?php
              if (isset($current_category_id) && ($current_category_id > 0)) {
                $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p.products_quantity > 0  and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
              } else {
                $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
              }
              
              if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {   
                    $rows = 0;
                    while ($best_sellers = tep_db_fetch_array($best_sellers_query)) 
                    {
                        $rows++;
                        echo '
						<div style="border-bottom:1px dashed #CCC; padding-bottom:5px; text-align:center;">
						<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '" style="color:#000; font-size:11px; font-weight:bold;">'.substr($best_sellers['products_name'],0,17).'</a>
						<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '">' .tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $best_sellers['products_image'], $best_sellers['products_name'], 'YES', 'SP') . '</a>
						</div>';
                    }
              }             
            ?>
 		</marquee>
 	</div>
</div>

