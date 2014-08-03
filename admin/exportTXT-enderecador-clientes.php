<?php
include('includes/configure.php');
include('includes/functions/database.php');
tep_db_connect() or die('Não foi possível conectar com o banco de dados!');
// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');


// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }
$customers = mysql_query("select c.customers_id, c.customers_lastname, c.customers_firstname, c.customers_email_address, c.customers_telephone, c.customers_telephone_comercial, c.customers_dob, a.entry_street_address, a.entry_street_number, a.entry_suburb, a.entry_complemento, a.entry_postcode, a.entry_city as city, z.zone_name as state, ctry.countries_iso_code_2 as country, a.entry_company 
from customers c left join address_book a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id left join customers_info ci on c.customers_id = ci.customers_info_id left join countries ctry on a.entry_country_id = ctry.countries_id left join zones z on a.entry_zone_id = z.zone_id order by c.customers_firstname ASC, c.customers_lastname ASC");
$query = mysql_fetch_array($customers);
$array_estados = array("Acre","Alagoas","Amapa","Amazonas","Bahia","Ceara","Distrito Federal","Espirito Santo","Goias","Maranhao","Mato Grosso","Mato Grosso do Sul","Minas Gerais","Para","Paraiba","Parana","Pernambuco","Piaui","Rio de Janeiro","Rio Grande do Norte","Rio Grande do Sul","Rondonia","Roraima","Santa Catarina","Sao Paulo","Sergipe","Tocantins");
$array_ufs = array("AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO");

$newline ='';
$arquivo = "Todos.txt";
for($contar=0; $contar < mysql_num_rows($customers); $contar++){

$uf = str_replace($array_estados, $array_ufs, $query['state']);

$newline .= "Sr(a);".$query['customers_firstname']." ".$query['customers_lastname'].";".$query['entry_company'].";;".$query['entry_street_address'].";".$query['entry_street_number'].";".$query['entry_complemento'].";".$query['entry_suburb'].";".$query['city'].";".$uf.";".$query['customers_email_address'].";".$query['customers_telephone'].";".$query['customers_telephone_comercial'].";;".$query['entry_postcode']."\r\n";

$query = mysql_fetch_array($customers);
}

$open = fopen($arquivo,"w");
chmod($arquivo, 0777);	
$write = fwrite($open,$newline);
fclose($open);	

header("Content-Type: application/save"); 
header("Content-Length:".filesize($arquivo)); 
header('Content-Disposition: attachment; filename="' . $arquivo . '"'); 
header("Content-Transfer-Encoding: binary");
header('Expires: 0'); 
header('Pragma: no-cache'); 
// nesse momento ele le o arquivo e envia
$fp = fopen("$arquivo", "r"); 
fpassthru($fp); fclose($fp); 	
?>