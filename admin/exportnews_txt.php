<?php
include('includes/configure.php');
include('includes/functions/database.php');
tep_db_connect() or die('Não foi possível conectar com o banco de dados!');

	if($_GET['cod']== 1){
		$newline ='';
		$arquivo = "Emails - Receba Informativo.txt";
		$emails_news = mysql_query("select email from newsletter order by email");
		while ($emails = mysql_fetch_array($emails_news)) {
			$newline .= $emails['email']."\r\n";
		}
		$open = fopen($arquivo,"w");
		chmod($arquivo, 0777);	
		$write = fwrite($open,$newline);
	}else if($_GET['cod']== 2){
		$newline ='';
		$arquivo = "Emails - Clientes da Loja.txt";
		$emails_news = mysql_query("select customers_email_address from customers order by customers_email_address");
		while ($emails = mysql_fetch_array($emails_news)) {
			$newline .= $emails['customers_email_address']."\r\n";
		}
		$open = fopen($arquivo,"w");
		chmod($arquivo, 0777);	
		$write = fwrite($open,$newline);
	}else if($_GET['cod']== 3){
		$newline ='';
		$arquivo = "Emails - Clientes da Loja.txt";
		$emails_news = mysql_query("select customers_email_address from customers where customers_newsletter = 1 order by customers_email_address ");
		while ($emails = mysql_fetch_array($emails_news)) {
			$newline .= $emails['customers_email_address']."\r\n";
		}
		$open = fopen($arquivo,"w");
		chmod($arquivo, 0777);	
		$write = fwrite($open,$newline);
	}
						
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