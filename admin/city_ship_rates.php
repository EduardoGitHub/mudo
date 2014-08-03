<?php
/*
  $Id: city_ship_rates.php,v .5 2007/10/29
*/

  require('includes/application_top.php');

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
        $ship_rates_id = tep_db_prepare_input($HTTP_GET_VARS['tID']);
        $ship_city_name = tep_db_prepare_input($HTTP_POST_VARS['ship_city_name']);
        $ship_city_rate = tep_db_prepare_input($HTTP_POST_VARS['ship_city_rate']);

        tep_db_query("INSERT INTO `citysalesrate` (CITY,RATE) VALUES ('".$ship_city_name."','".$ship_city_rate."');");

        tep_redirect(tep_href_link('city_ship_rates.php'));
        break;
      case 'save':
        $ship_rates_id = tep_db_prepare_input($HTTP_GET_VARS['tID']);
        $ship_city_name = tep_db_prepare_input($HTTP_POST_VARS['ship_city_name']);
        $ship_city_rate = tep_db_prepare_input($HTTP_POST_VARS['ship_city_rate']);

        tep_db_query("UPDATE `citysalesrate` SET CITY = '".$ship_city_name."' ,RATE = '".$ship_city_rate."' WHERE recid = '".$ship_rates_id."';");

        tep_redirect(tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $ship_rates_id));
        break;
      case 'deleteconfirm':
        $ship_rates_id = tep_db_prepare_input($HTTP_GET_VARS['tID']);

        tep_db_query("DELETE FROM `citysalesrate` WHERE recid = '".(int)$ship_rates_id."';");

        tep_redirect(tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page']));
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
    <td width="<?php echo BOX_WIDTH; ?>" valign="top" id="left"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top" id="main"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo 'Configuração de taxa por cidades'; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo 'Cidade'; ?></td>
                <td class="dataTableHeadingContent"><?php echo 'Valor da entrega'; ?></td>
              </tr>
<?php
// update-20051113
  $rates_query_raw = "select recid, CITY, RATE from citysalesrate";
  $rates_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $rates_query_raw, $rates_query_numrows);
  $rates_query = tep_db_query($rates_query_raw);
  while ($rates = tep_db_fetch_array($rates_query)) {
    if ((!isset($HTTP_GET_VARS['tID']) || (isset($HTTP_GET_VARS['tID']) && ($HTTP_GET_VARS['tID'] == $rates['recid']))) && !isset($trInfo) && (substr($action, 0, 3) != 'new')) {
      $trInfo = new objectInfo($rates);
    }

    if (isset($trInfo) && is_object($trInfo) && ($rates['recid'] == $trInfo->recid)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $trInfo->recid . '&action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $rates['recid']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $rates['CITY']; ?></td>
                <td class="dataTableContent"><?php echo $rates['RATE']; ?></td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $rates_split->display_count($rates_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_TAX_RATES); ?></td>
                    <td class="smallText" align="right"><?php echo $rates_split->display_links($rates_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="5" align="right"><?php echo '<a href="' . tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_NEW_TAX_RATE) . '</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>Entre com a nova cidade e seu valor de entraga.</b>');

      $contents = array('form' => tep_draw_form('rates', 'city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&action=insert'));
      $contents[] = array('text' => 'Por favor, preencha as informações abaixo.');
      $contents[] = array('text' => '<br>Nome da cidade:<br>' . tep_draw_input_field('ship_city_name'));
      $contents[] = array('text' => '<br>Valor da entrega:<br>' . tep_draw_input_field('ship_city_rate'));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>Edite a cidade e o valor de entrega.</b>');

      $contents = array('form' => tep_draw_form('rates', 'city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $trInfo->recid  . '&action=save'));
      $contents[] = array('text' => 'Por favor, faça as mundanças necessárias');
      $contents[] = array('text' => '<br>Nome da cidade:<br>' . tep_draw_input_field('ship_city_name', $trInfo->CITY));
      $contents[] = array('text' => '<br>Valor da entrega:<br>' . tep_draw_input_field('ship_city_rate', $trInfo->RATE));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $trInfo->recid) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>Deletar valor de entrega para esta cidade</b>');

      $contents = array('form' => tep_draw_form('rates', 'city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $trInfo->recid  . '&action=deleteconfirm'));
      $contents[] = array('text' => 'Você tem certeza que você quer deletar o valor de entrega para esta cidade?');
      $contents[] = array('text' => '<br><b>' . $trInfo->CITY . ' ' . number_format($trInfo->RATE, TAX_DECIMAL_PLACES) . '%</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $trInfo->recid) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($trInfo)) {
        $heading[] = array('text' => '<b>' . $trInfo->CITY . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $trInfo->recid . '&action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link('city_ship_rates.php', 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $trInfo->recid . '&action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>Escolha a cidade<br>' . $trInfo->CITY);
      }
      break;
  }

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
