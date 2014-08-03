<div class="box">
<div class="lay_bordaBox"><span>Categorias</span></div>
<div class="boxconteudo" style=" padding:0; padding-top:5px; padding-bottom:5px;">
<?php
 if (MAX_MANUFACTURERS_LIST < 2) {
	$cat_choose = array(array('id' => '', 'text' => ':: Escolha uma categoria ::'));
  } else {
	$cat_choose = '';
  }			
  $categories_array = tep_get_categories($cat_choose);
  for ($i=0; $i<sizeof($categories_array); $i++) {
	  $path = "";
	  $parent_categories = array();
 }

 echo '<form action="' . tep_href_link(FILENAME_DEFAULT) . '" method="get">';
 echo tep_draw_pull_down_menu('cPath', $categories_array,'','onChange="this.form.submit();" id="DropDownCategorias"' );
 if(isset($osCsid) && $osCsid != '') echo '<input type="hidden" name="osCsid" value="'.$osCsid.'">'; 
 echo '</form>';
?>
</div>
</div>