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

	$arquivo = "products.txt";
	$products_and_price = mysql_query("select pd.products_name, p.products_price from products_description pd, products p where pd.products_id = p.products_id order by pd.products_name asc");
	$query = mysql_fetch_assoc($products_and_price);
	$word_most = 65;
	$traco = '';
	$newline = '';
	$information_client = "######################################################################"
						  ."\r\n\r\n".
							STORE_NAME_ADDRESS
						  ."\r\n\r\n".
						  "######################################################################";
						  			
	
	//while ($query = mysql_fetch_array($products_and_price)) {
	for($contar=0; $contar < mysql_num_rows($products_and_price); $contar++){
	
		$cal = $word_most - strlen($query['products_name']);
		for($cont=0; $cont < $cal; $cont++){
			$traco .= '-' ;
		}	
		$newline .= $query['products_name']." ".$traco." R$ ".number_format($query['products_price'], 2, ',', '.')."\r\n";
		$traco ='';
		$query = mysql_fetch_array($products_and_price);
	}
	$arq = $information_client."\r\n\r\n".$newline;
	$open = fopen($arquivo,"w");
	chmod($arquivo, 0777);	
	$write = fwrite($open,$arq);
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