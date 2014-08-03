<?php
/*
  $Id: address_book_details.php,v 1.10 2003/06/09 22:49:56 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if (!isset($process)) $process = false;
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><b><?php echo NEW_ADDRESS_TITLE; ?></b></td>
        <td class="inputRequirement" align="right"><?php echo FORM_REQUIRED_INFORMATION; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<?php if($type_is['customers_type_register']=='F'){?>
	<table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
      <tr class="infoBoxContents2">
        <td>
		<table border="0" cellspacing="2" cellpadding="2">
<?php
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
    } else {
      $male = ($entry['entry_gender'] == 'm') ? true : false;
    }
    $female = !$male;
?>
          <tr>
            <td class="main"><?php echo ENTRY_GENDER; ?></td>
            <td class="main"><?php echo tep_draw_radio_field('gender', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('firstname', $entry['entry_firstname'],'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('lastname', $entry['entry_lastname'],'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_COMPANY; ?></td>
            <td class="main"><?php echo tep_draw_input_field('company', $entry['entry_company'],'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  }
?>
			<tr>
            <td class="main"><?php echo ENTRY_POST_CODE; ?></td>
            <td class="main"><?php echo tep_draw_input_field('postcode', $entry['entry_postcode'], 'id="postcode"') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '&nbsp;<a href="javascript:SEDEX('."'busca_cep.htm'".');" style="font-family:Arial, Helvetica, sans-serif; color:#000000; font-size:8px;"><B>NÃO SEI O CEP. QUERO PROUCURAR</B></a></span><div id="validpostcode" style="color:#000000;" class="inputRequirement"></div>': ''); ?>
			</td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
            <td class="main"><?php echo tep_draw_input_field('street_address', $entry['entry_street_address'],'size="60"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_STREET_NUMBER; ?></td>
            <td class="main"><?php echo tep_draw_input_field('street_number', $entry['entry_street_number'],'size="10"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_NUMBER_TEXT . '</span>': ''); ?>&nbsp;<?php echo ENTRY_COMPLEMENTO; ?>&nbsp;<?php echo tep_draw_input_field('complemento', $entry['entry_complemento'],'size="30"') . ' ' . (tep_not_null(ENTRY_COMPLEMENTO_TEXT) ? '' . ENTRY_COMPLEMENTO_TEXT . '': ''); ?></td>
          </tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_SUBURB; ?></td>
            <td class="main"><?php echo tep_draw_input_field('suburb', $entry['entry_suburb'],'size="60"') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_CITY; ?></td>
            <td class="main"><?php echo tep_draw_input_field('city', $entry['entry_city'],'size="60"') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_STATE; ?></td>
            <td class="main">
<?php
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu('state', $zones_array);
      } else {
        echo tep_draw_input_field('state');
      }
    } else {
	 $zone_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_id = '".$entry['entry_zone_id']."'");
	 $zone_value = tep_db_fetch_array($zone_query);
      echo tep_draw_input_field('state', $zone_value['zone_code'],'size="2" maxlength="2" style="text-transform:uppercase"');
    }

    if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;
?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
            <td class="main"><?php echo tep_get_country_list('country', $entry['entry_country_id']) . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  if ((isset($HTTP_GET_VARS['edit']) && ($customer_default_address_id != $HTTP_GET_VARS['edit'])) || (isset($HTTP_GET_VARS['edit']) == false) ) {
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td colspan="2" class="main"><?php echo tep_draw_checkbox_field('primary', 'on', false, 'id="primary"') . ' ' . SET_AS_PRIMARY; ?></td>
          </tr>
<?php
  }
?>
        </table></td>
      </tr>
    </table>
	<?php }else if($type_is['customers_type_register']=='J'){ ?>
	<table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
      <tr class="infoBoxContents2">
        <td>
		<table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_RAZAO_SOCIAL; ?></td>
            <td class="main"><?php echo tep_draw_input_field('firstname', $entry['entry_firstname'],'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_RAZAO_SOCIAL_TEXT) ? '<span class="inputRequirement">' . ENTRY_RAZAO_SOCIAL_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_NOME_FANTASIA; ?></td>
            <td class="main"><?php echo tep_draw_input_field('lastname', $entry['entry_lastname'],'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_NOME_FANTASIA_TEXT) ? '<span class="inputRequirement">' . ENTRY_NOME_FANTASIA_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_RESPONSAVEL; ?></td>
            <td class="main"><?php echo tep_draw_input_field('company', $entry['entry_company'],'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_RESPONSAVEL_TEXT) ? '<span class="inputRequirement">' . ENTRY_RESPONSAVEL_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_POST_CODE; ?></td>
            <td class="main"><?php echo tep_draw_input_field('postcode', $entry['entry_postcode'], 'id="postcode"') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '&nbsp;<a href="javascript:SEDEX('."'busca_cep.htm'".');" style="font-family:Arial, Helvetica, sans-serif; color:#000000; font-size:8px;"><B>NÃO SEI O CEP. QUERO PROUCURAR</B></a></span><div id="validpostcode" style="color:#000000;" class="inputRequirement"></div>': ''); ?>
			</td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
            <td class="main"><?php echo tep_draw_input_field('street_address', $entry['entry_street_address'],'size="60"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_STREET_NUMBER; ?></td>
            <td class="main"><?php echo tep_draw_input_field('street_number', $entry['entry_street_number'],'size="10"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_NUMBER_TEXT . '</span>': ''); ?>&nbsp;<?php echo ENTRY_COMPLEMENTO; ?>&nbsp;<?php echo tep_draw_input_field('complemento', $entry['entry_complemento'],'size="30"') . ' ' . (tep_not_null(ENTRY_COMPLEMENTO_TEXT) ? '' . ENTRY_COMPLEMENTO_TEXT . '': ''); ?></td>
          </tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_SUBURB; ?></td>
            <td class="main"><?php echo tep_draw_input_field('suburb', $entry['entry_suburb'],'size="60"') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_CITY; ?></td>
            <td class="main"><?php echo tep_draw_input_field('city', $entry['entry_city'],'size="60"') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_STATE; ?></td>
            <td class="main">
<?php
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu('state', $zones_array);
      } else {
        echo tep_draw_input_field('state');
      }
    } else {
	 $zone_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_id = '".$entry['entry_zone_id']."'");
	 $zone_value = tep_db_fetch_array($zone_query);
      echo tep_draw_input_field('state', $zone_value['zone_code'],'size="2" maxlength="2" style="text-transform:uppercase"');
    }

    if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;
?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
            <td class="main"><?php echo tep_get_country_list('country', $entry['entry_country_id']) . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  if ((isset($HTTP_GET_VARS['edit']) && ($customer_default_address_id != $HTTP_GET_VARS['edit'])) || (isset($HTTP_GET_VARS['edit']) == false) ) {
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td colspan="2" class="main"><?php echo tep_draw_checkbox_field('primary', 'on', false, 'id="primary"') . ' ' . SET_AS_PRIMARY; ?></td>
          </tr>
<?php
  }
?>
        </table></td>
      </tr>
    </table>
	<?php }?>
	</td>
  </tr>
</table>
