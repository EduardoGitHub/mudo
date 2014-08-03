<?php
/*
   quick_stockupdate.php v1.1 by Tomorn Kaewtong / http://www.phpthailand.com
   MODIFIED quick_stockupdate.php v2.5 by Günter Geisler / http://www.highlight-pc.de

   Stand-alone Admin tool for osCommerce v2.2-CVS

   A spin-off of my Quick DeActivate script so you can set a lot of quantities
   in a single process. Also allows you to change the STATUS of the products
   based upon quantities provided.

   Released under the GPL licence.
*/

include('includes/application_top.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
 <tr>
<!-- body_text //-->
 <td width="100%" valign="top" id="main">
 <table border="0" width="100%" cellspacing="0" cellpadding="0">
     <tr>
       <td>
   <table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr>
		    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
         </tr>
         <tr>
           <td class="pageHeading"><?php echo QUICK_HEAD1 ?><br><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
           <td class="pageHeading" align="right">DFAS<?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
         </tr>
       </table>
   </td>
     </tr>
     <tr>
       <td>
   <table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr>
           <td valign="top">
   <table border="0" width="100%" cellspacing="0" cellpadding="1">
             <tr >
               <td ><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
             </tr>
             <tr>
               <td class="main"><?php echo QUICK_HEAD2 ?></td>
             </tr>
   </table>
   </td>
         </tr>
   </table>
   </td>
     </tr>
     <tr>
       <td>
   <table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr>
           <td>
<?php
 if ($HTTP_POST_VARS['stock_update']) {


  while (list($key, $items) = each($HTTP_POST_VARS['stock_update'])) {
   // update the quantity in stock
   $sql = "UPDATE products SET products_quantity = '".$items['stock']."', products_model = '".$items['model']."', products_price = '".$items['price']."',
   products_price_revenda = '".$items['price_revenda']."',products_warranty = '".$items['warranty']."', products_weight = '".$items['weight']."', products_last_modified ='".date("Y-m-d H:i:s")."' WHERE products_id = $key";
   $update = tep_db_query($sql);
   $stock_i++;

   // we're de-re-activating the selected products
   if ($HTTP_POST_VARS['update_status']) {
     if ($items['stock'] >= 1 ) {
                       $dereac = tep_db_query("UPDATE products SET products_status = 1 WHERE products_id = $key");
     $status_a++;
     }else{
                       $dereac = tep_db_query("UPDATE products SET products_status = 0 WHERE products_id = $key");
     $status_d++;
    }
   }
  }
 }
?>
<br>

<?php
tep_draw_form('quick_stockupdate', FILENAME_QUICK_STOCKUPDATE, tep_get_all_get_params(array('action')), 'post');
// first select all categories that have 0 as parent:
 $sql = tep_db_query("SELECT c.categories_id, cd.categories_name from categories c, categories_description cd WHERE c.parent_id = 0 AND c.categories_id = cd.categories_id AND cd.language_id = 2");

 echo '            <table border="0">';
 echo '              <tr>';
 while ($parents = tep_db_fetch_array($sql)) {
   // check if the parent has products
   $check = tep_db_query("SELECT products_id FROM products_to_categories WHERE categories_id = '" . $parents['categories_id'] . "'");

   $tree = tep_get_category_tree();
   $dropdown= tep_draw_pull_down_menu('cat_id', $tree, '', 'onChange="this.form.submit();"'); //single
   
   
    $manufacturers_array = array();
	if ((sizeof($manufacturers_array) < 1) && ($exclude != '0') ) $manufacturers_array[] = array('id' => '0', 'text' => 'Selecione um fabricante');
	$manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name  from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
	
	while ($manufacturers_values = tep_db_fetch_array($manufacturers_query)) {
	  $manufacturers_array[] = array('id' => $manufacturers_values['manufacturers_id'], 'text' => $manufacturers_values['manufacturers_name']);
	}
	$dropdown2= tep_draw_pull_down_menu('fab', $manufacturers_array,'','onChange="this.form.submit();"');
   
   
   $all_list = tep_draw_form('teste', FILENAME_QUICK_STOCKUPDATE, tep_get_all_get_params(array('action'))).'<th class="smallText" align="left" valign="top">Categorias:<br>' . $dropdown . '</form></th>';
   $all_list2 = tep_draw_form('teste', FILENAME_QUICK_STOCKUPDATE, tep_get_all_get_params(array('action'))).'<th class="smallText" align="left" valign="top">Fabricantes:<br>' . $dropdown2 . '</form></th>';
 }
 echo $all_list;
 echo $all_list2;
 echo '              </tr>';
 echo '            </table>';
 echo '            </form>';
 echo '            </td>';
 echo '          </tr>';
 echo '        </table>';

 // see if there is a category ID:
 if ($HTTP_POST_VARS['cat_id']) {
   // start the table
   echo tep_draw_form('quick_stockupdate', FILENAME_QUICK_STOCKUPDATE, tep_get_all_get_params(array('action')), 'post');
   echo '            <table width="100%" border="0" cellspacing=2 cellpadding=2>';

   // get all active prods in that specific category

       $sql2 = tep_db_query("SELECT p.products_id, p.products_model, p.products_warranty, p. products_quantity, p.products_status, p.products_weight, p.products_price, p.products_price_revenda, pd.products_name from products p, products_to_categories ptc, products_description pd where p.products_id = ptc.products_id and p.products_id = pd.products_id and language_id = $languages_id and ptc.categories_id = '" . $HTTP_POST_VARS['cat_id'] . "' order by pd.products_name");
	   
	   //<td class="dataTableContent" align="left"><b>' . QUICK_MODEL . '</b></td>
         echo '<tr class="dataTableHeadingRow"><td class="dataTableHeadingContent" align="left"><b>' . QUICK_ID . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_NAME . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_WEIGHT . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_PRICE . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_PRICE_REVENDA . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_MODEL .'</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_WARRANTY . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_STOCK . '</b></td></tr>';
// added changes thowden 10/2004 stock_update becomes a multi-dim array
     while ($results = tep_db_fetch_array($sql2)) {
             //echo '<tr class="dataTableRow"><td class="dataTableHeadingContent" align="left"><input type="text" size="16" name="stock_update[' . $results['products_id'] . '][model]" value="' . $results['products_model'] . '"><i>';
			 echo '<tr class="dataTableRow"></td><td class="dataTableContent" align="left">' . $results['products_id'] . '</td><td class="dataTableContent" align="left">' . $results['products_name'];
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="4" name="stock_update[' . $results['products_id'] . '][weight]" value="' . $results['products_weight'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="6" name="stock_update[' . $results['products_id'] . '][price]" value="' . $results['products_price'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="6" name="stock_update[' . $results['products_id'] . '][price_revenda]" value="' . $results['products_price_revenda'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="10" name="stock_update[' . $results['products_id'] . '][model]" value="' . $results['products_model'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="4" name="stock_update[' . $results['products_id'] . '][warranty]" value="' . $results['products_warranty'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="4" name="stock_update[' . $results['products_id'] . '][stock]" value="' . $results['products_quantity'] . '"><i>';
             echo (($results['products_status'] == 0) ? '<font color="ff0000"><b> ' . QUICK_INACTIVE . '</b></font>' : '<font color="009933"><b> ' . QUICK_ACTIVE . '</b></font>');
             echo '</i></td></tr>';
    }
  echo '</table><table border="0" width="100%" cellspacing=2 cellpadding=2><tr>';
  echo '<input type="hidden" name="cat_id" value="' . $HTTP_POST_VARS['cat_id'] . '">';
  echo '</tr><br><td align="center" colspan="10" class="smallText">';
  echo '<input type="checkbox" name="update_status">' . QUICK_TEXT . '';
  echo '<input type="submit" value="Update"></td></tr></form>';
  } elseif ($HTTP_POST_VARS['fab']) {
	  
// start the table
   echo tep_draw_form('quick_stockupdate', FILENAME_QUICK_STOCKUPDATE, tep_get_all_get_params(array('action')), 'post');
   echo '            <table width="100%" border="0" cellspacing=2 cellpadding=2>';

   // get all active prods in that specific category

       $sql2 = tep_db_query("SELECT p.products_id, p.products_model, p.products_warranty, p. products_quantity, p.products_status, p.products_weight, p.products_price, p.products_price_revenda, pd.products_name from products p, products_to_categories ptc, products_description pd where p.products_id = ptc.products_id and p.products_id = pd.products_id and language_id = $languages_id and p.manufacturers_id = '" . $HTTP_POST_VARS['fab'] . "' order by pd.products_name");
	   
	   //<td class="dataTableContent" align="left"><b>' . QUICK_MODEL . '</b></td>
         echo '<tr class="dataTableHeadingRow"><td class="dataTableHeadingContent" align="left"><b>' . QUICK_ID . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_NAME . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_WEIGHT . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_PRICE . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_PRICE_REVENDA . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_MODEL .'</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_WARRANTY . '</b></td><td class="dataTableHeadingContent" align="left"><b>' . QUICK_STOCK . '</b></td></tr>';
// added changes thowden 10/2004 stock_update becomes a multi-dim array
     while ($results = tep_db_fetch_array($sql2)) {
             //echo '<tr class="dataTableRow"><td class="dataTableHeadingContent" align="left"><input type="text" size="16" name="stock_update[' . $results['products_id'] . '][model]" value="' . $results['products_model'] . '"><i>';
			 echo '<tr class="dataTableRow"></td><td class="dataTableContent" align="left">' . $results['products_id'] . '</td><td class="dataTableContent" align="left">' . $results['products_name'];
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="4" name="stock_update[' . $results['products_id'] . '][weight]" value="' . $results['products_weight'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="6" name="stock_update[' . $results['products_id'] . '][price]" value="' . $results['products_price'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="6" name="stock_update[' . $results['products_id'] . '][price_revenda]" value="' . $results['products_price_revenda'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="10" name="stock_update[' . $results['products_id'] . '][model]" value="' . $results['products_model'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="4" name="stock_update[' . $results['products_id'] . '][warranty]" value="' . $results['products_warranty'] . '"><i>';
			 echo '</td><td class="dataTableContent" align="left"><input type="text" size="4" name="stock_update[' . $results['products_id'] . '][stock]" value="' . $results['products_quantity'] . '"><i>';
             echo (($results['products_status'] == 0) ? '<font color="ff0000"><b> ' . QUICK_INACTIVE . '</b></font>' : '<font color="009933"><b> ' . QUICK_ACTIVE . '</b></font>');
             echo '</i></td></tr>';
    }
  echo '</table><table border="0" width="100%" cellspacing=2 cellpadding=2><tr>';
  echo '<input type="hidden" name="fab" value="' . $HTTP_POST_VARS['fab'] . '">';
  echo '</tr><br><td align="center" colspan="10" class="smallText">';
  echo '<input type="checkbox" name="update_status">' . QUICK_TEXT . '';
  echo '<input type="submit" value="Update"></td></tr></form>';	  
	  
}
?>
    </tr></table>
  </td>
</tr></table>

		</td>
<!-- body_text_eof //-->
	</tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
