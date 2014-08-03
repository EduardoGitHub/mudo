<?
$column_right_query = tep_db_query("SELECT file_boxes FROM boxes WHERE status_boxes = 1 AND position_boxes = 2 ORDER BY order_boxes ASC");
$column_right_result = tep_db_fetch_array($column_right_query);
$column_right_rows = tep_db_num_rows($column_right_query);
for($cont_colunmRight = 0; $cont_colunmRight < $column_right_rows; $cont_colunmRight++){
	include(DIR_WS_BOXES . $column_right_result['file_boxes']);
	$column_right_result = tep_db_fetch_array($column_right_query);
}
?>
