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

$products_and_price = mysql_query("select pd.products_name, p.products_price from products_description pd, products p where pd.products_id = p.products_id order by pd.products_name asc");
//$info = mysql_query("select configuration_value from configuration where configuration_id =1");
//$query_info = mysql_fetch_assoc($info);

$flag = 'True';
$html2 = "<table border=0><tr><td>".STORE_NAME_ADDRESS."</td></tr><tr><td height=10></td></tr></table>";
//$html3 = "<table border=0><tr><td>Tabela de Preço</td></tr><tr><td>_________________________________________________________</td></tr></table>";
$html = "<table width=170 border=0 cellspacing=0 cellpadding=0>";
while ($query = mysql_fetch_array($products_and_price)) {
	if($flag == 'True'){
		$color = 'bgcolor="#F8F8F8"';
		$flag = 'False';
	}elseif($flag == 'False'){
		$color = 'bgcolor="#FFFFFF"';
		$flag = 'True';
	}
	$html .= "<tr ".$color."> 
				<td align=left width=140>".$query['products_name']."</td>
				<td align=right width=30>R$ ".number_format($query['products_price'], 2, ',', '.')."</td>
			  </tr>";
}		  
$html .= "</table>";

define('FPDF_FONTPATH','includes/librays/pdftable/font/');
require('includes/librays/pdftable/lib/pdftable.inc.php');
$p = new PDFTable();
$p->AddPage();
$p->setfont('Arial','',14);
$p->htmltable($html2);
//$p->setfont('Arial','',14);
//$p->htmltable($html3);
$p->setfont('Arial','',10);
$p->htmltable($html);
$p->output("arquivo.pdf", "D");
?>