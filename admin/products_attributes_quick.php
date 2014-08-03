<?php
/*
  $Id: products_attributes.php,v 1.52 2003/07/10 20:46:01 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
  
  "Quick Attributes" contribution written by DeLySh 2008/11/04
  "Quick Attributes" contribution-v1.2 modified by jestep 2009/06 - Sort Sequence
*/

  require('includes/application_top.php');
  $languages = tep_get_languages();

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
  $pID = (isset($HTTP_GET_VARS['pID']) ? $HTTP_GET_VARS['pID'] : '1');
  $cPath = (isset($HTTP_GET_VARS['cPath']) ? $HTTP_GET_VARS['cPath'] : '');

  if (tep_not_null($action)) {
    $page_info = '';
    if (isset($HTTP_GET_VARS['option_page'])) $page_info .= 'option_page=' . $HTTP_GET_VARS['option_page'] . '&';
    if (isset($HTTP_GET_VARS['value_page'])) $page_info .= 'value_page=' . $HTTP_GET_VARS['value_page'] . '&';
    if (isset($HTTP_GET_VARS['attribute_page'])) $page_info .= 'attribute_page=' . $HTTP_GET_VARS['attribute_page'] . '&';
    if (isset($HTTP_POST_VARS['products_id'])) $page_info .= 'pID=' . $HTTP_POST_VARS['products_id'] . '&';
    if (isset($HTTP_GET_VARS['pID'])) $page_info .= 'pID=' . $HTTP_GET_VARS['pID'] . '&';
    if (isset($HTTP_GET_VARS['cPath'])) $page_info .= 'cPath=' . $HTTP_GET_VARS['cPath'] . '&';
    if (isset($HTTP_POST_VARS['products_path'])) $page_info .= 'cPath=' . $HTTP_POST_VARS['products_path'] . '&';
    if (tep_not_null($page_info)) {
      $page_info = substr($page_info, 0, -1);
    }

    switch ($action) {
      case 'add_product_attributes':
        $products_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
        $options_id = tep_db_prepare_input($HTTP_POST_VARS['options_id']);
        $values_id = tep_db_prepare_input($HTTP_POST_VARS['values_id']);
        $value_price = tep_db_prepare_input($HTTP_POST_VARS['value_price']);
		$obs = tep_db_prepare_input($HTTP_POST_VARS['obs']);
		$desc = tep_db_prepare_input($HTTP_POST_VARS['desc']);
        $price_prefix = tep_db_prepare_input($HTTP_POST_VARS['price_prefix']);

//        tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " values ('', '" . (int)$products_id . "', '" . (int)$options_id . "', '" . (int)$values_id . "', '" . tep_db_input($value_price) . "', '" . tep_db_input($price_prefix) . "')");
        //////////////////// MODIFIED BY JES USING A DAYANAHOST MOD ///////////////////////
        tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, options_obs, options_desc, price_prefix) values ( '" .  (int)$products_id . "', '" . (int)$options_id . "', '" . (int)$values_id . "', '" . tep_db_input($value_price) . "', '" . tep_db_input($obs) . "','" . tep_db_input($desc) . "', '" . tep_db_input($price_prefix) . "')");
	    //////////////////// END of MOD BY JES USING A DAYANAHOST MOD ///////////////////////


        if (DOWNLOAD_ENABLED == 'true') {
          $products_attributes_id = tep_db_insert_id();

          $products_attributes_filename = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_filename']);
          $products_attributes_maxdays = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_maxdays']);
          $products_attributes_maxcount = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_maxcount']);

          if (tep_not_null($products_attributes_filename)) {
            tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " values (" . (int)$products_attributes_id . ", '" . tep_db_input($products_attributes_filename) . "', '" . tep_db_input($products_attributes_maxdays) . "', '" . tep_db_input($products_attributes_maxcount) . "')");
          }
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;

      case 'update_product_attribute':
        $products_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
        $options_id = tep_db_prepare_input($HTTP_POST_VARS['options_id']);
        $values_id = tep_db_prepare_input($HTTP_POST_VARS['values_id']);
        $value_price = tep_db_prepare_input($HTTP_POST_VARS['value_price']);
		$obs = tep_db_prepare_input($HTTP_POST_VARS['obs']);
		$desc = tep_db_prepare_input($HTTP_POST_VARS['desc']);
        $price_prefix = tep_db_prepare_input($HTTP_POST_VARS['price_prefix']);
        $attribute_id = tep_db_prepare_input($HTTP_POST_VARS['attribute_id']);

        tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_id = '" . (int)$products_id . "', options_id = '" . (int)$options_id . "', options_values_id = '" . (int)$values_id . "', options_values_price = '" . tep_db_input($value_price) . "', options_obs = '".tep_db_input($obs)."', options_desc = '".tep_db_input($desc)."', price_prefix = '" . tep_db_input($price_prefix) . "' where products_attributes_id = '" . (int)$attribute_id . "'");

        if (DOWNLOAD_ENABLED == 'true') {
          $products_attributes_filename = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_filename']);
          $products_attributes_maxdays = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_maxdays']);
          $products_attributes_maxcount = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_maxcount']);

          if (tep_not_null($products_attributes_filename)) {
            tep_db_query("replace into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " set products_attributes_id = '" . (int)$attribute_id . "', products_attributes_filename = '" . tep_db_input($products_attributes_filename) . "', products_attributes_maxdays = '" . tep_db_input($products_attributes_maxdays) . "', products_attributes_maxcount = '" . tep_db_input($products_attributes_maxcount) . "'");
          }
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;

      case 'delete_attribute':
        $attribute_id = tep_db_prepare_input($HTTP_GET_VARS['attribute_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_attributes_id = '" . (int)$attribute_id . "'");

// added for DOWNLOAD_ENABLED. Always try to remove attributes, even if downloads are no longer enabled
        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . (int)$attribute_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		
		
		case 'delete_all':
        $pID = tep_db_prepare_input($HTTP_GET_VARS['pID']);

        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$pID . "'");


        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		
		case 'create_all':
       $pID = tep_db_prepare_input($HTTP_GET_VARS['pID']);
		
		$teste = mysql_query('select products_options_id,products_options_values_id from products_options_values_to_products_options order by products_options_values_to_products_options_id asc');
		
		while($resp = mysql_fetch_array($teste)){
			
			tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, options_obs, options_desc, price_prefix) values ( '" .  $pID . "', '" . $resp['products_options_id'] . "', '" . $resp['products_options_values_id'] . "', '0.000', '', '', '+')");
		  
		}
		//tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		case 'create_tamanho':
       $pID = tep_db_prepare_input($HTTP_GET_VARS['pID']);
		
		$teste = mysql_query('select products_options_id,products_options_values_id from products_options_values_to_products_options WHERE products_options_id = 1 order by products_options_values_to_products_options_id asc');
		
		while($resp = mysql_fetch_array($teste)){
			
			tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, options_obs, options_desc, price_prefix) values ( '" .  $pID . "', '" . $resp['products_options_id'] . "', '" . $resp['products_options_values_id'] . "', '0.000', '', '', '+')");
		  
		}
		//tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		case 'create_posicao':
       $pID = tep_db_prepare_input($HTTP_GET_VARS['pID']);
		
		$teste = mysql_query('select products_options_id,products_options_values_id from products_options_values_to_products_options WHERE products_options_id = 4 order by products_options_values_to_products_options_id asc');
		
		while($resp = mysql_fetch_array($teste)){
			
			tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, options_obs, options_desc, price_prefix) values ( '" .  $pID . "', '" . $resp['products_options_id'] . "', '" . $resp['products_options_values_id'] . "', '0.000', '', '', '+')");
		  
		}
		//tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		case 'create_cor':
       $pID = tep_db_prepare_input($HTTP_GET_VARS['pID']);
		
		$teste = mysql_query('select products_options_id,products_options_values_id from products_options_values_to_products_options WHERE products_options_id = 2 order by products_options_values_to_products_options_id asc');
		
		while($resp = mysql_fetch_array($teste)){
			
			tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, options_obs, options_desc, price_prefix) values ( '" .  $pID . "', '" . $resp['products_options_id'] . "', '" . $resp['products_options_values_id'] . "', '0.000', '', '', '+')");
		  
		}
		//tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		case 'create_cor_murals':
       $pID = tep_db_prepare_input($HTTP_GET_VARS['pID']);
		
		$teste = mysql_query('select products_options_id,products_options_values_id from products_options_values_to_products_options WHERE products_options_id = 5 order by products_options_values_to_products_options_id asc');
		
		while($resp = mysql_fetch_array($teste)){
			
			tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, options_obs, options_desc, price_prefix) values ( '" .  $pID . "', '" . $resp['products_options_id'] . "', '" . $resp['products_options_values_id'] . "', '0.000', '', '', '+')");
		  
		}
		//tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		case 'create_material':
       $pID = tep_db_prepare_input($HTTP_GET_VARS['pID']);
		
		$teste = mysql_query('select products_options_id,products_options_values_id from products_options_values_to_products_options WHERE products_options_id =6 order by products_options_values_to_products_options_id asc');
		
		while($resp = mysql_fetch_array($teste)){
			
			tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, options_obs, options_desc, price_prefix) values ( '" .  $pID . "', '" . $resp['products_options_id'] . "', '" . $resp['products_options_values_id'] . "', '0.000', '', '', '+')");
		  
		}
		//tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		case 'create_espelhar':
       $pID = tep_db_prepare_input($HTTP_GET_VARS['pID']);
		
		$teste = mysql_query('select products_options_id,products_options_values_id from products_options_values_to_products_options WHERE products_options_id =3 order by products_options_values_to_products_options_id asc');
		
		while($resp = mysql_fetch_array($teste)){
			
			tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, options_obs, options_desc, price_prefix) values ( '" .  $pID . "', '" . $resp['products_options_id'] . "', '" . $resp['products_options_values_id'] . "', '0.000', '', '', '+')");
		  
		}
		//tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, $page_info));
        break;
		
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="javascript"><!--
function go_option() {
  if (document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value != "none") {
    location = "<?php echo tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'option_page=' . ($HTTP_GET_VARS['option_page'] ? $HTTP_GET_VARS['option_page'] : 1)); ?>&option_order_by="+document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value;
  }
}
//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" id="main"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<!-- options and values//-->

<!-- products_attributes //-->  
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE_ATRIB; ?>&nbsp;</td>
            <td>&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '53'); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
<?php
  if ($action == 'update_attribute') {
    $form_action = 'update_product_attribute';
  } else {
    $form_action = 'add_product_attributes';
  }

 /* if (!isset($attribute_page)) {
    $attribute_page = 1;
  }*/
  $attribute_page=(isset($_REQUEST['attribute_page']))?$_REQUEST['attribute_page']:1;
  $prev_attribute_page = $attribute_page - 1;
  $next_attribute_page = $attribute_page + 1;
?>
        <td><form name="attributes" action="<?php echo tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=' . $form_action . '&option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page); ?>" method="post"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="8" class="smallText">
<?php
  $per_page = MAX_ROW_LISTS_OPTIONS;//'20';
  $attributes = "select pa.* from " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pa.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' where pa.products_id = '".$pID."' order by pa.products_attributes_id";
  $attribute_query = tep_db_query($attributes);

  $attribute_page_start = ($per_page * $attribute_page) - $per_page;
  $num_rows = tep_db_num_rows($attribute_query);

  if ($num_rows <= $per_page) {
     $num_pages = 1;
  } else if (($num_rows % $per_page) == 0) {
     $num_pages = ($num_rows / $per_page);
  } else {
     $num_pages = ($num_rows / $per_page) + 1;
  }
  $num_pages = (int) $num_pages;

  $attributes = $attributes ;
  //. " LIMIT $attribute_page_start, $per_page";

  // Previous
  if ($prev_attribute_page) {
    echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'pID='.$pID.'&cPath='.$cPath.'&attribute_page=' . $prev_attribute_page) . '"> &lt;&lt; </a> | ';
  }

  for ($i = 1; $i <= $num_pages; $i++) {
    if ($i != $attribute_page) {
      echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'pID='.$pID.'&cPath='.$cPath.'&attribute_page=' . $i) . '">' . $i . '</a> | ';
    } else {
      echo '<b><font color="red">' . $i . '</font></b> | ';
    }
  }

  // Next
  if ($attribute_page != $num_pages) {
    echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'pID='.$pID.'&cPath='.$cPath.'&attribute_page=' . $next_attribute_page) . '"> &gt;&gt; </a>';
  }
?>
            </td>
          </tr>
          <tr>
            <td colspan="8"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_VALUE; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OBS; ?>&nbsp;</td>
			<td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_DESC; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_OPT_PRICE; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_PRICE_PREFIX; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="8"><?php echo tep_black_line(); ?></td>
          </tr>
<?php
if($num_rows > 0){
  $next_id = 1;
  $attributes = tep_db_query($attributes);
  while ($attributes_values = tep_db_fetch_array($attributes)) {
    $products_name_only = tep_get_products_name($attributes_values['products_id']);
    $options_name = tep_options_name($attributes_values['options_id']);
    $values_name = tep_values_name($attributes_values['options_values_id']);
    $rows++;
  
?>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
    if (($action == 'update_attribute') && ($HTTP_GET_VARS['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values['products_attributes_id']; ?><input type="hidden" name="attribute_id" value="<?php echo $attributes_values['products_attributes_id']; ?>">&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $products_name_only; ?>&nbsp;<input name="products_id" type="hidden" value="<?=$pID;?>"><input name="products_path" type="hidden" value="<?=$cPath;?>"></td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
      $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
      while($options_values = tep_db_fetch_array($options)) {
        if ($attributes_values['options_id'] == $options_values['products_options_id']) {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '" SELECTED>' . $options_values['products_options_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
      $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id ='" . $languages_id . "' order by products_options_values_id");
      while($values_values = tep_db_fetch_array($values)) {
        if ($attributes_values['options_values_id'] == $values_values['products_options_values_id']) {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '" SELECTED>' . $values_values['products_options_values_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
        }
      } 
?>        
            </select>&nbsp;</td>
            <td align="left" class="smallText">&nbsp;<input type="text" name="obs" value="<?php echo $attributes_values['options_obs']; ?>" size="6">&nbsp;</td>
            <td align="left" class="smallText">&nbsp;<input type="text" name="desc" value="<?php echo $attributes_values['options_desc']; ?>" size="20">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" value="<?php echo $attributes_values['options_values_price']; ?>" size="6">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="price_prefix" value="<?php echo $attributes_values['price_prefix']; ?>" size="2">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, '&attribute_page=' . $attribute_page . '&pID='. $pID . '&cPath=' . $cPath, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>&nbsp;</td>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $download_query_raw ="select products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount 
                              from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
                              where products_attributes_id='" . $attributes_values['products_attributes_id'] . "'";
        $download_query = tep_db_query($download_query_raw);
        if (tep_db_num_rows($download_query) > 0) {
          $download = tep_db_fetch_array($download_query);
          $products_attributes_filename = $download['products_attributes_filename'];
          $products_attributes_maxdays  = $download['products_attributes_maxdays'];
          $products_attributes_maxcount = $download['products_attributes_maxcount'];
        }
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <td colspan="5">
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      }
?>
<?php
    } elseif (($action == 'delete_product_attribute') && ($HTTP_GET_VARS['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<b><?php echo $attributes_values["products_attributes_id"]; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $products_name_only; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $options_name; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $values_name; ?></b>&nbsp;</td>
            <td align="left" class="smallText">&nbsp;<?php echo $attributes_values["options_obs"]; ?>&nbsp;</td>
            <td align="left" class="smallText">&nbsp;<?php echo $attributes_values["options_desc"]; ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<b><?php echo $attributes_values["options_values_price"]; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo $attributes_values["price_prefix"]; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=delete_attribute&attribute_id=' . $HTTP_GET_VARS['attribute_id']. '&pID='. $pID . '&cPath=' . $cPath) . '">'; ?><?php echo tep_image_button('button_confirm.gif', IMAGE_CONFIRM); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, '&option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page. '&pID='. $pID . '&cPath=' . $cPath, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>&nbsp;</b></td>
<?php
    } else {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values["products_attributes_id"]; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $products_name_only; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
            <td align="left" class="smallText">&nbsp;<?php echo $attributes_values["options_obs"]; ?>&nbsp;</td>
            <td align="left" class="smallText">&nbsp;<?php echo $attributes_values["options_desc"]; ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<?php echo $attributes_values["options_values_price"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_values["price_prefix"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=update_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&attribute_page=' . $attribute_page . '&pID='. $pID . '&cPath=' . $cPath, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.gif', IMAGE_UPDATE); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=delete_product_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&attribute_page=' . $attribute_page. '&pID='. $pID . '&cPath=' . $cPath, 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.gif', IMAGE_DELETE); ?></a>&nbsp;</td>
<?php
    }
    $max_attributes_id_query = tep_db_query("select max(products_attributes_id) + 1 as next_id from " . TABLE_PRODUCTS_ATTRIBUTES);
    $max_attributes_id_values = tep_db_fetch_array($max_attributes_id_query);
    $next_id = $max_attributes_id_values['next_id'];
?>
          </tr>
<?php
  }
}
else{
 $products_name_only = tep_get_products_name($pID);
 $max_attributes_id_query = tep_db_query("select max(products_attributes_id) + 1 as next_id from " . TABLE_PRODUCTS_ATTRIBUTES);
 $max_attributes_id_values = tep_db_fetch_array($max_attributes_id_query);
 $next_id = $max_attributes_id_values['next_id'];
}
  if ($action != 'update_attribute') {

?>
          <tr>
            <td colspan="8"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr class="<?php echo (floor($rows/2) != ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
            <td class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
      	    <td class="smallText">&nbsp;<?php echo $products_name_only; ?>&nbsp;<input name="products_id" type="hidden" value="<?=$pID;?>"><input name="products_path" type="hidden" value="<?=$cPath;?>"></td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
    $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
    while ($options_values = tep_db_fetch_array($options)) {
      echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
    $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . $languages_id . "' order by products_options_values_id");
    while ($values_values = tep_db_fetch_array($values)) {
      echo '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td align="left" class="smallText"><input type="text" name="obs" size="6"></td>
			<td align="left" class="smallText"><input type="text" name="desc" size="20"></td>            
			<td align="right" class="smallText">&nbsp;<input type="text" name="value_price" size="6" value="0.000">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="price_prefix" size="2" value="+">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_insert.gif', IMAGE_INSERT); ?>&nbsp;</td>
          </tr>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $products_attributes_maxdays  = DOWNLOAD_MAX_DAYS;
        $products_attributes_maxcount = DOWNLOAD_MAX_COUNT;
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <td colspan="5">
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      } // end of DOWNLOAD_ENABLED section
?>
<?php
  }
?>
		
          <tr>
            <td colspan="8"><?php echo tep_black_line(); ?></td>
          </tr>
        </table></form></td>
      </tr>
      <tr>
            <td colspan="8">
			<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=delete_all&pID='. $pID . '&cPath=' . $cPath) . '">'; ?>Deletar Tudo</a> | 
			<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=create_all&pID='. $pID . '&cPath=' . $cPath) . '">'; ?>Criar tudo</a> |
            <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=create_tamanho&pID='. $pID . '&cPath=' . $cPath) . '">'; ?>Criar Tamanhos</a> |
            <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=create_cor&pID='. $pID . '&cPath=' . $cPath) . '">'; ?>Criar Cor</a> |
            <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=create_espelhar&pID='. $pID . '&cPath=' . $cPath) . '">'; ?>Espelhar Adesivo</a> | 
            <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=create_posicao&pID='. $pID . '&cPath=' . $cPath) . '">'; ?>Mural - Criar Posi&atilde;o</a> |
            <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=create_cor_murals&pID='. $pID . '&cPath=' . $cPath) . '">'; ?>Mural - Criar Cor</a> |
            <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES_QUICK, 'action=create_material&pID='. $pID . '&cPath=' . $cPath) . '">'; ?>Mural - Material</a>
            </td>
          </tr>
          
      <tr>
        <td colspan="8">&nbsp;<?php echo TEXT_GO_BACK .'<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath='.$cPath.'&pID='.$pID, 'NONSSL') . '">';
         $path_up = explode('&nbsp;&gt;&nbsp;', tep_output_generated_category_path($current_category_id));
         krsort($path_up);
         echo(implode('&nbsp;&gt;&nbsp;', $path_up));
         ?>
        </a>
       </td>
      </tr>
    </table></td>
<!-- products_attributes_eof //-->
  </tr>
</table>
<!-- body_text_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
