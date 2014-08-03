<?php
/*
  $Id: checkout_new_address.php,v 1.4 2003/06/09 22:49:57 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if (!isset($process)) $process = false;
?>
	<table border="0" width="100%" cellspacing="0" cellpadding="2">
	  <?php if ($type_is['customers_type_register']=='F'){?>
		  <?php
		  if (ACCOUNT_GENDER == 'true') {
			if (isset($gender)) {
			  $male = ($gender == 'm') ? true : false;
			  $female = ($gender == 'f') ? true : false;
			} else {
			  $male = false;
			  $female = false;
			}
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
		<td class="main"><?php echo tep_draw_input_field('firstname','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
	  </tr>
	  <tr>
		<td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
		<td class="main"><?php echo tep_draw_input_field('lastname','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
	  </tr>
	  <?php }else if ($type_is['customers_type_register']=='J'){?>
	  	<tr>
		<td class="main"><?php echo ENTRY_RAZAO_SOCIAL; ?></td>
		<td class="main"><?php echo tep_draw_input_field('firstname','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_RAZAO_SOCIAL_TEXT) ? '<span class="inputRequirement">' . ENTRY_RAZAO_SOCIAL_TEXT . '</span>': ''); ?></td>
	  </tr>
	  <tr>
		<td class="main"><?php echo ENTRY_NOME_FANTASIA; ?></td>
		<td class="main"><?php echo tep_draw_input_field('lastname','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_NOME_FANTASIA_TEXT) ? '<span class="inputRequirement">' . ENTRY_NOME_FANTASIA_TEXT . '</span>': ''); ?></td>
	  </tr>
	<tr>
		<td class="main"><?php echo ENTRY_RESPONSAVEL; ?></td>
		<td class="main"><?php echo tep_draw_input_field('company','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_RESPONSAVEL_TEXT) ? '<span class="inputRequirement">' . ENTRY_RESPONSAVEL_TEXT . '</span>': ''); ?></td>
	  </tr>
	  <?php }?>
	<?php
	  if (ACCOUNT_COMPANY == 'true') {
	?>
	  <tr>
		<td class="main"><?php echo ENTRY_COMPANY; ?></td>
		<td class="main"><?php echo tep_draw_input_field('company','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
	  </tr>
	<?php
	  }
	?>
	  <tr>
		<td class="main"><?php echo ENTRY_POST_CODE; ?></td>
		<td class="main"><?php echo tep_draw_input_field('postcode', '', 'onkeypress="return MM_formtCep(event,this,\'#####-###\');" size="10" maxlength="9"') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '&nbsp;<a href="javascript:SEDEX('."'../comum/busca_cep.htm'".');" style="font-family:Arial, Helvetica, sans-serif; color:#000000; font-size:8px;"><B>NÃO SEI O CEP. QUERO PROUCURAR</B></a></span><div id="validpostcode" style="color:#000000;" class="inputRequirement"></div>': ''); ?></td>
	  </tr>	
	  <tr>
		<td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
		<td class="main"><?php echo tep_draw_input_field('street_address','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
	  </tr>
	  <tr>
		<td class="main"><?php echo ENTRY_STREET_NUMBER; ?></td>
		<td class="main"><?php echo tep_draw_input_field('street_number','','size="10"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_NUMBER_TEXT . '</span>': ''); ?>  <?php echo ENTRY_COMPLEMENTO; ?> <?php echo tep_draw_input_field('complemento','','size="20"') . '&nbsp;' .(tep_not_null(ENTRY_COMPLEMENTO_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPLEMENTO_TEXT . '</span>': '');?></td>
	  </tr>
	<?php
	  if (ACCOUNT_SUBURB == 'true') {
	?>
	  <tr>
		<td class="main"><?php echo ENTRY_SUBURB; ?></td>
		<td class="main"><?php echo tep_draw_input_field('suburb','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
	  </tr>
	<?php
	  }
	?>
	  <tr>
		<td class="main"><?php echo ENTRY_CITY; ?></td>
		<td class="main"><?php echo tep_draw_input_field('city','','size="50"') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
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
			echo tep_draw_input_field('state','','size="2" maxlength="2" style="text-transform:uppercase"');
		  }
		} else {
		  echo tep_draw_input_field('state','','size="2" maxlength="2" style="text-transform:uppercase"');
		}
	
		if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;
	?>
		</td>
	  </tr>
	<?php
	  }
	?>
	  <tr>
		<td class="main"><?php echo ENTRY_COUNTRY; ?></td>
		<td class="main"><?php echo tep_get_country_list('country') . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
	  </tr>
	</table>