<?php 

/* 

Alterado por Valmy Gomes em 19/02/2009 = Adição de novas funções e ajuste para o novo endereço dos Correios
www.legalloja.com.br - Lojas Oscommerce Integradas com Mercado Livre, Toda Oferta, Twitter e envio de SMS
//Até aqui nos ajudou o Senhor!
Baseado no módulo de:
  Welson Tavares 
  welsontavares@yahoo.com.br 
  de 17/02/2006 
 
Atualizado em 30/07/2010 para incluir a nova URL do webservice dos Correios
  By Patty (CybernetFX)
  Suporte: www.forumdowebmaster.com.br

*/ 

class sedexac 
{ 

  var $code, $title, $description, $enabled, $sedex; 

  // class constructor 

  function sedexac() 
  { 

    $this->code = 'sedexac';
    $this->title = MODULE_SHIPPING_SEDEXAC_TEXT_TITLE;
    $this->description = MODULE_SHIPPING_SEDEXAC_TEXT_DESCRIPTION;
    $this->sort_order = MODULE_SHIPPING_SEDEXAC_SORT_ORDER;
    $this->icon = '';
    $this->enabled = ((MODULE_SHIPPING_SEDEXAC_STATUS == 'True') ? true : false);
    $this->sedexac = 1;
  } 

// class methods 

  function quote($method = '') 
  {
	  
    global $order, $shipping_weight, $cart, $total_count; 
   
    $cep_origem=tep_db_query("SELECT configuration_value FROM `configuration` WHERE `configuration_key` = 'SHIPPING_ORIGIN_ZIP'");
    $cep = tep_db_fetch_array($cep_origem);    
    $cep_origem = $cep["configuration_value"];
    $cep_origem = str_replace('-','',$cep_origem);
    $cep_origem = str_replace('.','',$cep_origem);
    $cep_origem = str_replace(',','',$cep_origem);
    $cep_origem = str_replace(' ','',$cep_origem);
    
    $cep_destino = $order->delivery['postcode'];
    $cep_destino = str_replace('-','',$cep_destino);
    $cep_destino = str_replace('.','',$cep_destino);
    $cep_destino = str_replace(',','',$cep_destino);
    $cep_destino = str_replace(' ','',$cep_destino);
    
    //Para utilizar o peso em gramas descomente o bloco abaixo e comente a linha 50.
    
    /*
    if ($cart->show_weight()) 
    { 
      $peso = $cart->show_weight(); 
      $peso = $peso/1000; 
    } 
    
    else 
      $peso = 1; 

    if($peso<=1000) 
      $peso = 1; 
    */
    // até aqui 

	$total = $cart->show_total();

    $peso=$cart->show_weight();
    if ($peso > 0.3){
    	$peso=$this->arredonda_peso($peso);
    }
	
	//VERIFICAÇÃO PARA CUBAGEM
	$cubagem = $cart->show_cubagem();//Informa a cubagem correta
    $maopropria = MODULE_SHIPPING_SEDEXAC_MAOPROPRIA;
	$avrecebimento = MODULE_SHIPPING_SEDEXAC_AVRECEBIMENTO;
	$tipoembalagem = SHIPPING_TYPE_PACK;
    $servico = '40045';//Sedex a Cobrar  

	$frete = $this->calcula_frete_correios($cep_origem, $cep_destino, $peso, $total, $servico, $cubagem, $maopropria, $avrecebimento, $tipoembalagem);

    if (!$shipping = $frete)

      $shipping = 0; 

    $this->quotes = array('id' => $this->code, 'module' =>MODULE_SHIPPING_SEDEXAC_TEXT_TITLE, 'methods' => array(array('id' => $this->code, 'title' => MODULE_SHIPPING_SEDEXAC_MSG, 'cost'
=>$shipping_cost = ($shipping + MODULE_SHIPPING_SEDEXAC_HANDLING + SHIPPING_HANDLING)))); 

    if ($shipping > 0) 
      return $this->quotes;
    else 
      return $this->quotes['error'] = MODULE_SHIPPING_SEDEXAC_INVALID_ZONE; 
  } 

  function check() 
  { 
    if (!isset($this->_check)) 
    { 
      $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_SEDEXAC_STATUS'");$this->_check =tep_db_num_rows($check_query);
    } 

    return $this->_check; 
  } 

  function install() 
  { 

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Entrega via Sedex a Cobrar', 'MODULE_SHIPPING_SEDEXAC_STATUS', 'True', 'Ativar Entrega via Sedex a Cobrar (cálculo online via Correios)?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())"); 

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Taxa de manipulação', 'MODULE_SHIPPING_SEDEXAC_HANDLING', '0', 'Taxa de manipulação para esta forma de envio.', '6', '0', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem na tela de frete', 'MODULE_SHIPPING_SEDEXAC_MSG', 'Prazo de Entrega: 3 dias úteis após a postagem.', 'Mensagem que será exibida de tela de seleção da forma de envio.', '6', '0', now())");
	
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Serviço Mão Propria', 'MODULE_SHIPPING_SEDEXAC_MAOPROPRIA', 'N', 'Indica se a encomenda será entregue com o serviço adicional mão própria.<br/>S ou N (S – Sim, N – Não) ', '6', '0', now())");
		
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Serviço Aviso de Recebimento', 'MODULE_SHIPPING_SEDEXAC_AVRECEBIMENTO', 'N', 'Indica se a encomenda será entregue com o serviço adicional aviso de recebimento.<br />S ou N (S – Sim, N – Não)', '6', '0', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordem de exibição.', 'MODULE_SHIPPING_SEDEXAC_SORT_ORDER', '5', 'Determina a ordem de exibição desta forma de envio.', '6', '0', now())"); 
 
  } 

  function remove() 
  { 
    $keys = ''; 
    $keys_array = $this->keys(); 
    for ($i=0; $i<sizeof($keys_array); $i++)     
      $keys .= "'" . $keys_array[$i] . "',"; 

    $keys = substr($keys, 0, -1); 

    tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")"); 
  } 
  
      function calcula_frete_correios( $cepOrigem, $cepDestino, $peso, $valor='0', $servico, $cubagem, $maopropria, $avrecebimento, $tipoembalagem )
{
$webservice = 'ws.correios.com.br';
$resposta = 'xml';

 $conexao = fsockopen($webservice, 80, $errno, $errstr, 30);
    if (!$conexao)
     $erro = "$errstr ($errno)<br />\n"; 
    else 
    { 
      $saida = "GET /calculador/CalcPrecoPrazo.aspx?ncdempresa=&sdssenha=&sceporigem=$cepOrigem&scepdestino=$cepDestino&nvlpeso=$peso&ncdformato=$tipoembalagem&nvlcomprimento=".$cubagem[0]."&nvlaltura=".$cubagem[2]."&nvllargura=".$cubagem[1]."&scdmaopropria=$maopropria&nvlvalordeclarado=$valor&scdavisorecebimento=$avrecebimento&ncdservico=$servico&nvldiametro=".$cubagem[3]."&strretorno=$resposta HTTP/1.1\r\n";  
$saida .= "Host: $webservice\r\n"; 
$saida .= "Connection: Close\r\n\r\n"; 

      fwrite($conexao, $saida); 
     $saida = ""; 
      
      while (!feof($conexao))       
       $saida .= fgets($conexao, 128); 
       //echo $resposta;
      fclose($conexao); 
////////////extração dos dados//////////////

} 
$preco_postal = explode('<Valor>',$saida);
$preco_postal = explode('</Valor>',$preco_postal[1]);
$preco_postal = str_replace(',','.',$preco_postal[0]); 

return number_format( $preco_postal, 2, ".", "," );

}

  function keys() 
  { 
     $keys = array('MODULE_SHIPPING_SEDEXAC_STATUS', 'MODULE_SHIPPING_SEDEXAC_HANDLING', 'MODULE_SHIPPING_SEDEXAC_MSG','MODULE_SHIPPING_SEDEXAC_MAOPROPRIA','MODULE_SHIPPING_SEDEXAC_AVRECEBIMENTO','MODULE_SHIPPING_SEDEXAC_SORT_ORDER'); 

     return $keys; 
   }

   function arredonda_peso($peso)
   { 
      $tipo=gettype($peso); //armazena tipo de variável do peso
      $peso=preg_replace("/,/",".",$peso);//substitui vírgula por ponto
      settype($peso,"float"); //força o peso ser um número decimal

      if (floor($peso)<$peso)
        $peso = ceil($peso);

      settype($peso,$tipo);
        return $peso; //retorna peso com valor arredondado e com mesmo tipo informado
   } 
}
?>