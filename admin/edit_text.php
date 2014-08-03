<?php
/*
  $Id: mail.php,v 1.31 2003/06/20 00:37:51 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  //Pegando o editor  
  //include("includes/librays/fckeditor/fckeditor.php");

  
  
  $tp_texto = (isset($HTTP_GET_VARS['selected_tp']) ? $HTTP_GET_VARS['selected_tp'] : '');
  $delete_id = (isset($HTTP_GET_VARS['delete_id']) ? $HTTP_GET_VARS['delete_id'] : '');
  $newText = (isset($HTTP_GET_VARS['newText']) ? $HTTP_GET_VARS['newText'] : '');
  
  
  if(isset($tp_texto) && $tp_texto > 0){
  	$edit_query = tep_db_query("select * from " . TABLE_EDIT_TEXT . " where text_id = '" . $tp_texto . "'");
  	$edit_text = tep_db_fetch_array($edit_query);
	
	
	 switch ($edit_text['text_status']) {
      case '0': $in_status = false; $out_status = true; break;
      case '1':
      default: $in_status = true; $out_status = false;
    }
	
	switch ($edit_text['text_local']) {
      case '1': $in_status1 = true; $in_status2 = false; $in_status3 = false; break;
      case '2': $in_status1 = false; $in_status2 = true; $in_status3 = false; break;
	  case '3': $in_status1 = false; $in_status2 = false; $in_status3 = true; break;
    }
	
  }
  
  if(isset($delete_id) && $delete_id >0){
	tep_db_query("delete from " . TABLE_EDIT_TEXT . " where text_id = " . (int)$delete_id);
	tep_redirect(tep_href_link(FILENAME_EDIT_TEXT));
  }
  
  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
	$titulo = tep_db_prepare_input($HTTP_POST_VARS['titulo']);
	$status = tep_db_prepare_input($HTTP_POST_VARS['status']);
	$local = tep_db_prepare_input($HTTP_POST_VARS['local']);
	$texto = tep_db_prepare_input($HTTP_POST_VARS['texto']);
    $error = false;
	if ($error == false) {
     $sql_data_array = array('text_descricao' => $texto,
							 'text_titulo' => $titulo,
							 'text_status' => $status,
							 'text_local' => $local
							 );
	 }
	tep_db_perform(TABLE_EDIT_TEXT, $sql_data_array, 'update', "text_id = '" . $tp_texto . "'");
    tep_redirect(tep_href_link(FILENAME_EDIT_TEXT));
  }else if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'new')) {
	  
	  $titulo = tep_db_prepare_input($HTTP_POST_VARS['titulo']);
	$status = tep_db_prepare_input($HTTP_POST_VARS['status']);
	$local = tep_db_prepare_input($HTTP_POST_VARS['local']);
	$texto = tep_db_prepare_input($HTTP_POST_VARS['texto']);
    $error = false;
	if ($error == false) {
     $sql_data_array = array('text_descricao' => $texto,
							 'text_titulo' => $titulo,
							 'text_status' => $status,
							 'text_local' => $local
							 );
	 }
		tep_db_perform(TABLE_EDIT_TEXT, $sql_data_array);
    	tep_redirect(tep_href_link(FILENAME_EDIT_TEXT));  
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="file_inc.php?file=includes/general.js"></script>
<script type="text/javascript" src="includes/librays/ckeditor/ckeditor_basic.js"></script>
<link href="includes/librays/ckeditor/contents.css" rel="stylesheet" type="text/css" />

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
      <tr>
        <td width="100%">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			  <tr>
				<td class="pageHeading"><?php echo HEADING_TITLE; ?><?php if (($HTTP_GET_VARS['selected_tp'])||($HTTP_GET_VARS['selected_tp'] <> '')){echo ' ('.$edit_text['text_titulo'].')';}?></td>
				<td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
			  </tr>
			</table>
		</td>
      </tr>
      <? if (((!$HTTP_GET_VARS['selected_tp']) || ($HTTP_GET_VARS['selected_tp'] == '')) && ($HTTP_GET_VARS['newText'] != 'novo')){?>
	  <tr>
        <td class="smallText">
			Este espaço é reservado para crição de páginas informativas em sua loja virtual. Você pode criar, remover e escolher o melhor posicionamento de cada texto. <br><br>
            
            <?php  echo '<a href="' . tep_href_link(FILENAME_EDIT_TEXT, 'newText=novo') . '" title="Novo Texto">' .tep_image_button('button_new.gif', IMAGE_UPADATE).'</a>';  ?>
            <br><br>
			<?
              $textos_query = tep_db_query("select text_id, text_titulo from " . TABLE_EDIT_TEXT);
              $textos_result = tep_db_fetch_array($textos_query);
              while($textos_result){							
                echo '<a href="' . tep_href_link(FILENAME_EDIT_TEXT, 'selected_tp='.$textos_result['text_id']) . '" class="menuBoxContentLink" style="color:#0000FF" title="Editar">' . $textos_result['text_titulo'] . '</a> | <a href="' . tep_href_link(FILENAME_EDIT_TEXT, 'delete_id='.$textos_result['text_id']) . '" title="Deletar Texto"><img src="images/delete.gif" border="0" alt="Deletar Texto" /></a><br>';
                $textos_result = tep_db_fetch_array($textos_query);
              }
            ?>
			
		</td>
      </tr>
	  <? }else if (isset($HTTP_GET_VARS['selected_tp'])||($HTTP_GET_VARS['selected_tp'] <> '')){ ?>
	  <tr>
	  	<td>
			<?php echo tep_draw_form('form', FILENAME_EDIT_TEXT, 'action=process&selected_tp='.$edit_text['text_id']).tep_draw_hidden_field('action', 'process').tep_draw_hidden_field('selected_tp', $edit_text['text_id']); ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
              	<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main" width="3%">Título:</td>
                <td class="main"><?php echo tep_draw_input_field('titulo', $edit_text['text_titulo']); ?></td>
              </tr>
              <tr>
                <td class="main">Status:</td>
                <td class="main"><?php echo tep_draw_radio_field('status', '1', $in_status).' Ativo '.tep_draw_radio_field('status', '0', $out_status).' Inativo' ?></td>
              </tr>
              <tr>
                <td class="main">Local:</td>
                <td class="main"><?php echo tep_draw_radio_field('local', '1', $in_status1).' Topo '.tep_draw_radio_field('local', '2', $in_status2).' Rodape '.tep_draw_radio_field('local', '3', $in_status3).' Ambos' ?></td>
              </tr>
			  <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main" colspan="2">Descrição:</td>
              </tr>
              <tr>
              	<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
			  <tr>
				<td colspan="2">
                
				<textarea cols="80" id="texto" name="texto" rows="10"><?=$edit_text['text_descricao'];?></textarea>
				<script type="text/javascript">
                    CKEDITOR.replace( 'texto', { 
					extraPlugins : 'autogrow',
					enterMode		: Number( 2 ), //br
					shiftEnterMode	: Number( 1 ), //p
					skin : 'kama' });
                </script>
				</td>
			  </tr>
			  <tr>
              	<td class="main"></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
			  <tr>
                <td colspan="2"><?php echo tep_image_submit('button_update.gif', IMAGE_UPADATE); ?> <a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.gif', 'Voltar'); ?></a></td>
              </tr>
			</table>
			</form>
		</td>
	  </tr>	
	  <? }
	  if (isset($HTTP_GET_VARS['newText'])||($HTTP_GET_VARS['newText'] == 'novo')){ ?>
      <tr>
	  	<td>
			<?php echo tep_draw_form('form', FILENAME_EDIT_TEXT).tep_draw_hidden_field('action', 'new'); ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
              	<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main" width="3%">Título:</td>
                <td class="main"><?php echo tep_draw_input_field('titulo'); ?></td>
              </tr>
              <tr>
                <td class="main">Status:</td>
                <td class="main"><?php echo tep_draw_radio_field('status', '1').' Ativo '.tep_draw_radio_field('status', '0').' Inativo' ?></td>
              </tr>
              <tr>
                <td class="main">Local:</td>
                <td class="main"><?php echo tep_draw_radio_field('local', '1').' Topo '.tep_draw_radio_field('local', '2').' Rodape '.tep_draw_radio_field('local', '3').' Ambos' ?></td>
              </tr>
			  <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main" colspan="2">Descrição:</td>
              </tr>
              <tr>
              	<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
			  <tr>
				<td colspan="2">
                    <textarea cols="80" id="texto" name="texto" rows="10"></textarea>
				<script type="text/javascript">
                    CKEDITOR.replace( 'texto', { 
					extraPlugins : 'autogrow',
					enterMode		: Number( 2 ), //br
					shiftEnterMode	: Number( 1 ), //p
					skin : 'kama' });
                </script>
				</td>
			  </tr>
			  <tr>
              	<td class="main"></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
			  <tr>
                <td colspan="2"><?php echo tep_image_submit('button_update.gif', IMAGE_UPADATE); ?> <a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.gif', 'Voltar'); ?></a></td>
              </tr>
			</table>
			</form>
		</td>
	  </tr>
      <? }?>
    </table></td>
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