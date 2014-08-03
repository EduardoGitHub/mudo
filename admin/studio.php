<?php
/*
  $Id: manufacturers.php,v 1.55 2003/06/29 22:50:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/


  require('includes/application_top.php');
  
// check if the catalog image directory exists
  if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES)) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');


// populate $products_array with available product model names
$products_array = array(array('id' => '', 'text' => TEXT_NONE));
//$products_query = tep_db_query("select products_id, products_name from " . TABLE_PRODUCTS_DESCRIPTION . " order by products_name");
$products_query = tep_db_query("SELECT * from ".TABLE_GALLERY_STUDIO);


while ($products = tep_db_fetch_array($products_query)) {
    $products_array[] = array('id' => $products['gallery_id'],
                                    'text' => $products['gallery_foto']);
//  $i++;
}

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':    
	  
	  	$description = tep_db_prepare_input($HTTP_POST_VARS['descricao']);
        $type = tep_db_prepare_input($HTTP_POST_VARS['type_adesivo']);
		$type2 = tep_db_prepare_input($HTTP_POST_VARS['type']);
		$foto = tep_db_prepare_input($_FILES['pei_file']['name']);
		
		
								
        if ($action == 'insert') {
			$sql_data_array = array('gallery_foto' => $foto, 'gallery_description' => $description, 'gallery_adesivo' => $type, 'gallery_type'  =>$type2);
		if (isset($_FILES['pei_file']) && $_FILES['pei_file']['name'] != '') { $extra_image = new upload('pei_file', DIR_FS_CATALOG_IMAGES.'Fotos/');}
          tep_db_perform(TABLE_GALLERY_STUDIO, $sql_data_array);
        } else if ($action == 'save') {
			if (isset($_FILES['pei_file']) && $_FILES['pei_file']['name'] != '') { 
				$gallery_query = tep_db_query("select gallery_foto from " . TABLE_GALLERY_STUDIO . " where gallery_id = '" . $_GET['pId'] . "'");
        		$gallery_result = tep_db_fetch_array($gallery_query);
				@unlink(DIR_FS_CATALOG_IMAGES.'Fotos/' . $gallery_result['gallery_foto']);
				$extra_image = new upload('pei_file', DIR_FS_CATALOG_IMAGES.'Fotos/');
		 		$sql_data_array = array('gallery_foto' => $foto, 'gallery_description' => $description, 'gallery_adesivo' => $type);
			}else {
			$sql_data_array = array('gallery_description' => $description, 'gallery_adesivo' => $type, 'gallery_type'  => $type2);
				
			}
		  tep_db_perform(TABLE_GALLERY_STUDIO, $sql_data_array, 'update', 'gallery_id=' . tep_db_input($_GET['pId']));
        }
		
		tep_redirect(tep_href_link(FILENAME_STUDIO, 'page=' . $_GET['page'] . '&pId=' . $_GET['pId']));
                break;
      case 'delete':
                //$sql_data_array = array('gallery_id' => tep_db_prepare_input($_GET['pId']));
				$gallery_query = tep_db_query("select gallery_foto from " . TABLE_GALLERY_STUDIO . " where gallery_id = '" . $_GET['pId'] . "'");
        		$gallery_result = tep_db_fetch_array($gallery_query);
				@unlink(DIR_FS_CATALOG_IMAGES.'Fotos/' . $gallery_result['gallery_foto']);
                tep_db_query("DELETE FROM " . TABLE_GALLERY_STUDIO . " WHERE gallery_id=" . $_GET['pId']);
                tep_redirect(tep_href_link(FILENAME_STUDIO, 'page=' . $_GET['page']));
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
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" id="main"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>

		<?php
		  /*if (empty($action)) {
			 echo '<a href="' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pInfo->gallery_id . '&action=new') . '">' . ACTION_ADD_NEW_EXTRA_IMAGE . '</a>'; 
		  }*/
		?>		
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <TD class="dataTableHeadingContent" width=20% align="left"><?php echo TABLE_HEADING_PRODUCTS_IMAGE; ?></TD>
                <TD class="dataTableHeadingContent" width=30% align="left"><?php echo TABLE_HEADING_PRODUCTS_IMAGE_PATH; ?></TD>
                <TD class="dataTableHeadingContent" width=20% align="left"><?php echo TABLE_HEADING_PRODUCTS_EXTRA_IMAGE; ?></TD>
                <TD class="dataTableHeadingContent" width=20% align="left"><?php echo TEXT_PRODUCTS_WHERE; ?></TD>
                <TD class="dataTableHeadingContent" align="right" width=10%> <?php echo TABLE_HEADING_ACTION; ?></TD>
              </tr>

			  
<?php
  $page = $_GET['page'];
  if (!$page) $page = 1;
  $pId = $_GET['pId'];
  if (!$pId) unset($pId);
	$products_gallery_images_query_raw = 'select * from '.TABLE_GALLERY_STUDIO;
	$products_gallery_images_split = new splitPageResults($page, MAX_DISPLAY_SEARCH_RESULTS, $products_gallery_images_query_raw , $products_gallery_images_query_numrows);
	$products_gallery_images_query = tep_db_query($products_gallery_images_query_raw);
	
	while ($products_gallery_image = tep_db_fetch_array($products_gallery_images_query)) {
    if (!isset($pId))
      $pId = $products_gallery_image['gallery_id'];
    if ($products_gallery_image['gallery_id'] == $pId) {
      $pInfo = new objectInfo($products_gallery_image);
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $products_gallery_image['gallery_id'] . '&action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $products_gallery_image['gallery_id']) . '\'">' . "\n";
    }
	
	
	$array_local = array('','Projetos Personalizados','Projetos Corporativos','FotoWall','FotoArt','Frases','Caricaturas','Crie seu Modelo',);
	
?>

				
				<td class="dataTableContent" align="center">
                <?php 
				$new_image = $products_gallery_image['gallery_foto'].thumb_galery('../'.DIR_WS_IMAGES_PRODUTOS.'Fotos/'.$products_gallery_image['gallery_foto'], 185, 140,false);
				echo '<img src="../'.DIR_WS_IMAGES_PRODUTOS.'Fotos/'.$new_image.'" border="0" />';
				 ?>
                </td>
                <td class="dataTableContent" align="left"><?php echo $products_gallery_image['gallery_adesivo']; ?></td>
                <td class="dataTableContent" title="<?=$products_gallery_image['gallery_description']?>" align="left"><?php echo substr($products_gallery_image['gallery_description'],0,30).'...'; ?></td>
                <td class="dataTableContent" align="left"><?=$array_local[$products_gallery_image['gallery_type']] ?></td>
                <td class="dataTableContent" align="right"><?php if ($products_gallery_image['gallery_id'] == $pId) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pID=' . $pId) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>                
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $products_gallery_images_split->display_count($products_gallery_images_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $page, TEXT_PAGING_FORMAT); ?></td>
                    <td class="smallText" align="right"><?php echo $products_gallery_images_split->display_links($products_gallery_images_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $page);  ?></td>
                  </tr>
                </table></td>
              </tr>
<?php
  if (empty($action)) {
?>
              <tr>
                <td align="right" colspan="3" class="smallText"><?php echo '<a href="' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pInfo->gallery_id . '&action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':

      $heading[] = array('text' => '<b>' . TEXT_HEADING_NEW_EXTRA_IMAGE . '</b>');
      $contents = array('form' => tep_draw_form('form_pei_insert', FILENAME_STUDIO , 'action=insert', 'POST', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_NEW_INTRO);
	  $contents[] = array('text' => 'Escolha a imagem:');
      $contents[] = array('text' => tep_draw_file_field('pei_file'));
	  $contents[] = array('text' => TEXT_PRODUCTS_DESCRIPTION);
	  $contents[] = array('text' => tep_draw_textarea_field('descricao','','35', '10', ''));
	  $contents[] = array('text' => TEXT_PRODUCTS_TYPE);
	  $contents[] = array('text' =>  tep_draw_input_field('type_adesivo','','size=30 value=""').'<br>' );	  
	  /*Personalizados*/
	  $contents[] = array('text' => tep_draw_radio_field('type', '1','checked="checked"').'Projetos Personalizados <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '2').'Projetos Corporativos <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '3').'FotoWall <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '4').'FotoArt <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '5').'Frases <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '6').'Caricaturas <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '7').'Crie seu Modelo <br>' );
	  
	  
	  
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pId) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_EDIT_EXTRA_IMAGE . '</b>');

      $contents = array('form' => tep_draw_form('form_pei_edit', FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pInfo->gallery_id . '&action=save', 'post', 'enctype="multipart/form-data"'));
      
	  $contents[] = array('text' => TEXT_EDIT_INTRO);
	  $contents[] = array('text' => 'Escolha a imagem:');
      $contents[] = array('text' => tep_draw_file_field('pei_file'));
	  $contents[] = array('text' => TEXT_PRODUCTS_DESCRIPTION);
	  $contents[] = array('text' => tep_draw_textarea_field('descricao','','35', '10', $pInfo -> gallery_description));
	  $contents[] = array('text' => TEXT_PRODUCTS_TYPE);
	  $contents[] = array('text' =>  tep_draw_input_field('type_adesivo','','size=30 value="'.$pInfo -> gallery_adesivo.'"').'<br>' );
	  /*Personalizados*/
	  $contents[] = array('text' => tep_draw_radio_field('type', '1','checked="checked"').'Projetos Personalizados <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '2').'Projetos Corporativos <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '3').'FotoWall <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '4').'FotoArt <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '5').'Frases <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '6').'Caricaturas <br>' );
	  $contents[] = array('text' => tep_draw_radio_field('type', '7').'Crie seu Modelo <br>' );
	  
      $contents[] = array('text' => '<br>' . $pInfo -> gallery_foto );
      $contents[] = array('text' => '<br>' . TEXT_PRODUCTS . ' ' . (count($products_array)-1));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pInfo->gallery_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
	  
	  
	  
	  
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_DELETE_MANUFACTURER . '</b>');

      $contents = array('form' => tep_draw_form('products_extra_image', FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pInfo->gallery_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $pInfo->gallery_foto . '</b>');
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('delete_image', '', true) . ' ' . TEXT_DELETE_IMAGE);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pInfo->gallery_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break; 
		default:
      if (isset($pId)) {
		  $new_image = $pInfo->gallery_foto.thumb_galery('../'.DIR_WS_IMAGES_PRODUTOS.'/Fotos/'.$pInfo->gallery_foto, 185, 140,false);
        $heading[] = array('text' => '<b>' . $pInfo ->gallery_foto . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pId . '&action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a><a href="' . tep_href_link(FILENAME_STUDIO, 'page=' . $page . '&pId=' . $pId . '&action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<br><img src="../'.DIR_WS_IMAGES_PRODUTOS.'/Fotos/'.$new_image.'" border="0" />');
        $contents[] = array('align' => 'center', 'text' => '<br>' . TEXT_PRODUCTS . ' ' . (count($products_array)-1));
      }
      break;
  } // end of switch

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>