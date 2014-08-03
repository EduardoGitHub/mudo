<?
///////////////////////////////////////////////////
//
// Consulta de CEP usando AJAX sem banco de dados
//
// Feito por: Rafael Amorim - wwww.rafaelamorim.com
// email: contato@rafaelamorim.com
// baseado no script de: chiper
//
///////////////////////////////////////////////////

//Header para evitar cahe
      $gmtDate = gmdate("D, d M Y H:i:s");
      header("Expires: {$gmtDate} GMT");
      header("Last-Modified: {$gmtDate} GMT");
      header("Cache-Control: no-cache, must-revalidate");
      header("Pragma: no-cache");
      header("Content-Type: text/html; charset=iso-8859-1");
      extract($_GET);
      /* proteзгo sql injection escarpando as aspas */
      $n_cep=addslashes($cep);

function busca_cep($cep){  
	$resultado = file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');  
	if(!$resultado){  
		$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
	}  
	parse_str($resultado, $retorno);   
	return $retorno;  
}  
     
   //Vamos buscar o CEP
   $resultado_busca = busca_cep($n_cep);  

     
   switch($resultado_busca['resultado']){  
       case '2':  //cidades com cep unico
$texto = "::".str_replace(" ", "+", $resultado_busca['cidade']).":".$resultado_busca['uf'].";";    
       break;  
         
       case '1':  	   //cidades normais
$texto =  $resultado_busca['tipo_logradouro']."+".$resultado_busca['logradouro'].":".$resultado_busca['bairro'].":".str_replace(" ", "+", $resultado_busca['cidade']).":".$resultado_busca['uf'].";";
       break;  
         
       default:  
           $texto = "";  
  break;  
 }  

echo $texto;  
?>