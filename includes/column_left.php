<?PHP 
$column_left_query = tep_db_query("SELECT file_boxes FROM boxes WHERE status_boxes = 1 AND position_boxes = 1 ORDER BY order_boxes ASC");
$column_left_result = tep_db_fetch_array($column_left_query);
$column_left_rows = tep_db_num_rows($column_left_query);

if (HEADER_TAGS_DISPLAY_SILO_BOX == 'true')
if (isset($category_depth) && $category_depth !== 'top')
  include(DIR_WS_BOXES . 'headertags_seo_silo.php');

for($cont_colunmLeft = 0; $cont_colunmLeft < $column_left_rows; $cont_colunmLeft++){
	require(DIR_WS_BOXES . $column_left_result['file_boxes']);
	$column_left_result = tep_db_fetch_array($column_left_query);
}
/*
  if (HEADER_TAGS_DISPLAY_COLUMN_BOX == 'true' && basename($PHP_SELF) == FILENAME_PRODUCT_INFO)
    include(DIR_WS_BOXES . 'header_tags.php');
*/
?>



