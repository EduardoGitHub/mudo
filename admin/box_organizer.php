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
  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'update')) {
	for($cont = 1; $cont < 18; $cont++){
     $sql_data_array = array('position_boxes' => tep_db_prepare_input($HTTP_POST_VARS['boxposi'.$cont]),
							 'status_boxes' => tep_db_prepare_input($HTTP_POST_VARS['status'.$cont]),
							 'order_boxes' => tep_db_prepare_input($HTTP_POST_VARS['orderb'.$cont])
							 );

		tep_db_perform(TABLE_BOX_ORGANIZER, $sql_data_array, 'update', "id_boxes = '" . $cont . "'");
	}
    tep_redirect(tep_href_link(FILENAME_BOX_ORGANIZER));
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link href="includes/rte.css" rel="stylesheet" type="text/css" />
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
	  <tr>
        <td class="smallText">
			Este espaço é reservado para organização dos BOXES na area institucional da Loja Virtual. <br><br>
            <?php echo tep_draw_form('boxes', FILENAME_BOX_ORGANIZER, tep_get_all_get_params(array('action')) . 'action=update', 'post').tep_draw_hidden_field('action', 'update'); ?>
            <table border="0" width="600" cellspacing="0" cellpadding="1">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left">Nome do box</td>
                <td class="dataTableHeadingContent" nowrap>Posição</td>
                <td class="dataTableHeadingContent" align="left">Status (Ativo)</td>
                <td class="dataTableHeadingContent" align="left">Ordenação</td>
              </tr>
			<?
			 $status = array(array('id' => '1', 'text' => 'Ativo'),
                              array('id' => '0', 'text' => 'Inativo'));
              $textos_query = tep_db_query("select * from " . TABLE_BOX_ORGANIZER." order by position_boxes, order_boxes");
              $textos_result = tep_db_fetch_array($textos_query);
              while($textos_result){							
                echo '
				  <tr class="dataTableRow">
					<td nowrap class="dataTableContent" width="1%" height="30">'.$textos_result['name_boxes'].'</td>
					<td nowrap class="dataTableContent" width="1%"><center>'. tep_draw_radio_field('boxposi'.$textos_result['id_boxes'], '1', false, $textos_result['position_boxes']) . '&nbsp;&nbsp;Esquerda&nbsp;&nbsp;' . tep_draw_radio_field('boxposi'.$textos_result['id_boxes'], '2', false, $textos_result['position_boxes']).' Direita</center></td>
					<td nowrap class="dataTableContent" width="1%"><center>'.tep_draw_pull_down_menu('status'.$textos_result['id_boxes'], $status, (($textos_result['status_boxes'] == '1') ? '1' : '0')).'</center></td>
					<td nowrap class="dataTableContent" width="1%"><center>'.tep_draw_input_field('orderb'.$textos_result['id_boxes'], $textos_result['order_boxes'], 'maxlength="2" size="5"').'</center></td>
				  </tr>';
                $textos_result = tep_db_fetch_array($textos_query);
              }
            ?>
			</table>
           <br/><br/> 
		   <?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?>
            </form>
		</td>
      </tr>
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