<?
require('includes/application_top.php');

/*
CODIGO PARA FAZER AJUSTES NO PREÇO DE PRODUTOS E ATRIBUTO
*/

$query = tep_db_query('SELECT products_id, products_price from products');
while($result = mysql_fetch_array($query)){
	$new = 	ceil($result['products_price']*1.13);//13%
	mysql_query('UPDATE PRODUCTS SET products_price="'.$new.'" WHERE products_id='.$result['products_id']);
}

$query = tep_db_query('SELECT options_values_price, products_attributes_id from products_attributes');
while($result = mysql_fetch_array($query)){
	$new = 	ceil($result['options_values_price']*1.13);//13%
	mysql_query('UPDATE products_attributes SET options_values_price="'.$new.'" WHERE products_attributes_id='.$result['products_attributes_id']);
}
?>