<?php
require('includes/application_top.php');
include(DIR_WS_CLASSES . 'order.php');
	$order = new order($_GET['oID']);
	$newline ='';
	$arquivo = $order->customer['name'].".txt";
	
	$array_estados = array("Acre","Alagoas","Amapa","Amazonas","Bahia","Ceara","Distrito Federal","Espirito Santo","Goias","Maranhao","Mato Grosso","Mato Grosso do Sul","Minas Gerais","Para","Paraiba","Parana","Pernambuco","Piaui","Rio de Janeiro","Rio Grande do Norte","Rio Grande do Sul","Rondonia","Roraima","Santa Catarina","Sao Paulo","Sergipe","Tocantins");
$array_ufs = array("AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO");

$uf = str_replace($array_estados, $array_ufs, $order->customer['state']);

	$newline .= 'Sr(a);'.$order->customer['name'].';;'.$order->customer['postcode'].';'.$order->customer['street_address'].';'.$order->customer['number'].';'.$order->customer['complemento'].';'.$order->customer['suburb'].';'.$order->customer['city'].';'.$uf.';'.$order->customer['email_address'].';'.$order->customer['telephone'].';'.$order->customer['telephone_comercial'].';;'.$order->customer['postcode'];
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