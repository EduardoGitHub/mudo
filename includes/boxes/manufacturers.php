<div class="box" id="fabricantesmarcas">
<div class="lay_bordaBox"><span>Fabricantes / Marcas</span></div>
<div class="boxconteudo">
<?php
  $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
  if ($number_of_rows = tep_db_num_rows($manufacturers_query)) {

	if ($number_of_rows <= MAX_DISPLAY_MANUFACTURERS_IN_A_LIST) {
	  $manufacturers_list = '';
	  while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
		$manufacturers_name = ((strlen($manufacturers['manufacturers_name']) > MAX_DISPLAY_MANUFACTURER_NAME_LEN) ? substr($manufacturers['manufacturers_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN) . '..' : $manufacturers['manufacturers_name']);
		if (isset($HTTP_GET_VARS['manufacturers_id']) && ($HTTP_GET_VARS['manufacturers_id'] == $manufacturers['manufacturers_id'])) $manufacturers_name = '<b>' . $manufacturers_name .'</b>';
		$manufacturers_list .= '<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturers['manufacturers_id']) . '">' . $manufacturers_name . '</a>';
	  }

	  $manufacturers_list = substr($manufacturers_list, 0, -4);

	  echo $manufacturers_list;
	} else {
	  $manufacturers_array = array();

	  while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
		$manufacturers_name = ((strlen($manufacturers['manufacturers_name']) > MAX_DISPLAY_MANUFACTURER_NAME_LEN) ? substr($manufacturers['manufacturers_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN) . '..' : $manufacturers['manufacturers_name']);
		$manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
									   'text' => $manufacturers_name);
	  }

	  echo tep_draw_form('manufacturers', tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false), 'get');
	  echo tep_draw_pull_down_menu2('manufacturers_id', $manufacturers_array, (isset($HTTP_GET_VARS['manufacturers_id']) ? $HTTP_GET_VARS['manufacturers_id'] : '')) . tep_hide_session_id();
	}
  }
?>
</div>
</div>