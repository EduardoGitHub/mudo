<?php
/*
  $Id: products_attributes.php,v 1.52 2003/07/10 20:46:01 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  $languages = tep_get_languages();

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {

    switch ($action) {
      //CADASTRA ARQUIVOS
	  case 'add_product_options':
        $id_table = tep_db_prepare_input($HTTP_POST_VARS['id_tableprice']);
		$arquivo = tep_db_prepare_input($HTTP_POST_VARS['arquivo']);
		$descricao = tep_db_prepare_input($HTTP_POST_VARS['desc']);
		
		//FAZENDO UPLOAD
			$products_image = new upload('arquivo');
			$products_image->set_destination(DIR_FS_CATALOG.DIR_WS_IMAGES.'arquivos/');
			if ($products_image->parse() && $products_image->save()) {
			  $products_image_name = $products_image->filename;
			} else {
			  $products_image_name = (isset($HTTP_POST_VARS['arquivo']) ? $HTTP_POST_VARS['arquivo'] : '');
			}
		//FIM FAZENDO UPLOAD	

        tep_db_query("insert into " . TABLE_TABLE_PRICE . " (id_listprice, lp_arquivo, lp_desc) values ('" . (int)$id_table . "', '" . $products_image_name . "', '".$descricao."')");
        tep_redirect(tep_href_link(FILENAME_LIST_PRICE));
        break;
		//FIM CADASTRA ARQUIVOS		
		
		
	  //EDITA O REGISTRO	
      case 'update_option_name':
        $option_id = tep_db_prepare_input($HTTP_POST_VARS['option_id']);
		$desc = tep_db_prepare_input($HTTP_POST_VARS['desc']);
        tep_db_query("update " . TABLE_TABLE_PRICE . " set lp_desc = '" . $desc . "' where id_listprice = '" . (int)$option_id . "'");
        tep_redirect(tep_href_link(FILENAME_LIST_PRICE, $page_info));
        break;
		//FIM EDITA REGISTRO
		
		//DELETA REGISTRO
		case 'delete_option':
        $option_id = tep_db_prepare_input($HTTP_GET_VARS['option_id']);
		$sql = mysql_query('select lp_arquivo from '. TABLE_TABLE_PRICE .' where id_listprice ="'.(int)$option_id.'"');
		$query = mysql_fetch_assoc($sql);
		@unlink(DIR_FS_CATALOG.DIR_WS_IMAGES.'arquivos/'.$query['lp_arquivo']);
        tep_db_query("delete from " . TABLE_TABLE_PRICE . " where id_listprice = '" . (int)$option_id . "'");
        tep_redirect(tep_href_link(FILENAME_LIST_PRICE));
        break;
		//FIM DELETA REGISTRO
		
		
		/*case 'new_product_preview':
// copy image only if modified
        $products_image = new upload('products_image');
        $products_image->set_destination(DIR_FS_CATALOG.DIR_WS_IMAGES);
        if ($products_image->parse() && $products_image->save()) {
          $products_image_name = $products_image->filename;
        } else {
          $products_image_name = (isset($HTTP_POST_VARS['products_previous_image']) ? $HTTP_POST_VARS['products_previous_image'] : '');
        }
        break;*/
		
		
		
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
    location = "<?php echo tep_href_link(FILENAME_LIST_PRICE, 'option_page=' . ($HTTP_GET_VARS['option_page'] ? $HTTP_GET_VARS['option_page'] : 1)); ?>&option_order_by="+document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value;
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
      <tr>
        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" width="50%">
			
			
			
			
			
			
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<!-- options //-->			
			<?php
			 if ($action != 'delete_product_option'){
				if (isset($HTTP_GET_VARS['option_order_by'])) {
				  $option_order_by = $HTTP_GET_VARS['option_order_by'];
				} else {
				  $option_order_by = 'id_listprice';
				}
			?>
              <tr>
                <td colspan="4" class="pageHeading">&nbsp;<?php echo HEADING_TITLE_OPT; ?>&nbsp;</td>
                <td align="right"><br><form name="option_order_by" action="<?php echo FILENAME_LIST_PRICE; ?>"></form></td>
              </tr>
              <tr>
                <td colspan="4" class="smallText">
				<!--PEGA OS DADOS PARA EXIBIR NA TELA -->
				<?php
					//$per_page = MAX_ROW_LISTS_OPTIONS;
					$options = "select * from " . TABLE_TABLE_PRICE." order by " . $option_order_by ;
				?>
                </td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
				<td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_DESCRICAO; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
				<?php
					$next_id = 1;
					$rows = 0;
					$options = tep_db_query($options);
					while ($options_values = tep_db_fetch_array($options)) {
					  $rows++;
				?>
              	<tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
				<?php
					  // AREA ONDE FAZ O UPDATE DA IMAGEM.	
					  if (($action == 'update_option') && ($HTTP_GET_VARS['option_id'] == $options_values['id_listprice'])) {
						echo '<form name="option" action="' . tep_href_link(FILENAME_LIST_PRICE, 'action=update_option_name', 'NONSSL') . '" method="post">';
						$inputs = '';
						for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
						  $option_name = tep_db_query("select lp_arquivo, lp_desc, id_listprice from " . TABLE_TABLE_PRICE ." where id_listprice=".$HTTP_GET_VARS['option_id']);
						  $option_name = tep_db_fetch_array($option_name);
						  $inputs .='<input type="text" name="option_name[' . $languages[$i]['id'] . ']" size="20" disabled="disabled" value="' . $option_name['lp_arquivo'] . '">&nbsp;<input type="text" name="option_name[' . $languages[$i]['id'] . ']" size="40" value="' . $option_name['lp_desc'] . '"><br>';
						}
				?>
				<!-- TELA QUANDO VOCÊ CLICA EM EDITAR. -->
                <td align="center" class="smallText">&nbsp;<?php echo $options_values['id_listprice']; ?><input type="hidden" name="option_id" value="<?php echo $options_values['id_listprice']; ?>">&nbsp;</td>
                <td class="smallText"><?php echo tep_draw_input_field('arquivo',$option_name['lp_arquivo'], 'disabled="disabled"'); ?>&nbsp;&nbsp;&nbsp;</td>
				<td class="smallText"><?php echo tep_draw_input_field('desc',$option_name['lp_desc'],'size="40"'); ?></td>
                <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_LIST_PRICE, '', 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>&nbsp;</td>
				<!-- FIM TELA QUANDO VOCÊ CLICA EM EDITAR. -->
				<?php
						echo '</form>' . "\n";
					  } else {
				?>
				<!-- TELA PRINCIPAL. -->
				<td align="center" class="smallText">&nbsp;<?php echo $options_values["id_listprice"]; ?>&nbsp;</td>
				<td class="smallText">&nbsp;<?php echo $options_values["lp_arquivo"]; ?>&nbsp;</td>
				<td class="smallText">&nbsp;<?php echo $options_values["lp_desc"]; ?>&nbsp;</td>
				<td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_LIST_PRICE, 'action=update_option&option_id=' . $options_values['id_listprice'] . '&option_order_by=' . $option_order_by, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.gif', IMAGE_UPDATE); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_LIST_PRICE, 'action=delete_option&option_id=' . $options_values['id_listprice'], 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.gif', IMAGE_DELETE); ?></a>&nbsp;</td>
				<!-- FIM DA TELA PRINCIPAL -->
				<?php
					  }
				?>
              </tr>
			  
<?php
      $max_options_id_query = tep_db_query("select max(id_listprice) + 1 as next_id from " . TABLE_TABLE_PRICE);
      $max_options_id_values = tep_db_fetch_array($max_options_id_query);
      $next_id = $max_options_id_values['next_id'];
    }
?>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
			 <!-- ADICIONA DADOS NO BANDO DE DADOS --> 
			<?php
				if ($action != 'update_option') {
			?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
			<?php
				  echo '<form name="options" action="' . tep_href_link(FILENAME_LIST_PRICE, 'action=add_product_options', 'NONSSL') . '" method="post" enctype="multipart/form-data"><input type="hidden" name="id_tableprice" value="' . $next_id . '">';
			?>
                <td align="center" class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
                <td class="smallText"><?php echo tep_draw_file_field('arquivo'); ?></td>
				<td class="smallText"><?php echo tep_draw_input_field('desc','','size="40"'); ?></td>
                <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_insert.gif', IMAGE_INSERT); ?>&nbsp;</td>
			<?php
				  echo '</form>';
			?>
			<!-- FIM ADICIONA DADOS NO BANDO DE DADOS -->
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    }
  }
?>
            </table>
			
			
			
			
			
			
			
			
			
			
			
			
			</td>
<!-- options eof //-->
            <td valign="top" width="50%">&nbsp;</td>
          </tr>
        </table></td>
<!-- option value eof //-->
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
