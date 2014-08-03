<?php 
/* 
  
07/06/2010 - MÓDULO E-SEDEX 
- Cálculo online direto dos servidores dos Correios
- Inclui campo para login corporativo e senha do contrato com os Correios configuráveis na administração do módulo
- Atualização da URL dos Correios de acordo com as instruções em http://www.correios.com.br/servicos/precos_tarifas/pdf/SCPP_Manual_Implementacao_Calculo_Remoto_de_Precos_e_Prazos.pdf
- Necessário ter contrato com os Correios para usar e-Sedex

Adaptação do módulo PAC/Sedex de Welson Tavares com atualizações e melhorias de Valmy Gomes
by CybernetFX - www.cybernetfx.com

Atualizado em 30/07/2010 para incluir a nova URL do webservice dos Correios
  By Patty (CybernetFX)

Fóruns de suporte: www.forumdowebmaster.com.br 
                   www.forums.oscommerce.com
   
*/ 


class esedex 
{ 
  var $code, $title, $description, $enabled, $esedex; 

  // class constructor 
  function esedex() 
  { 
    $this->code = 'esedex';
    $this->title = MODULE_SHIPPING_ESEDEX_TEXT_TITLE;
    $this->description = MODULE_SHIPPING_ESEDEX_TEXT_DESCRIPTION;
    $this->sort_order = MODULE_SHIPPING_ESEDEX_SORT_ORDER;
    $this->icon = '';
    $this->enabled = ((MODULE_SHIPPING_ESEDEX_STATUS == 'True') ? true : false);
    $this->esedex = 1;
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
	
	$login = tep_db_query("SELECT configuration_value FROM `configuration` WHERE `configuration_key` = 'MODULE_SHIPPING_ESEDEX_LOGIN'");
	$lg = tep_db_fetch_array($login);    
    $login = $lg["configuration_value"];
	$senha = tep_db_query("SELECT configuration_value FROM `configuration` WHERE `configuration_key` = 'MODULE_SHIPPING_ESEDEX_SENHA'");
	$sn = tep_db_fetch_array($senha);    
    $senha = $sn["configuration_value"];
     

	$total = 0;

    $peso=$cart->show_weight();
    if ($peso > 0.3){
    	$peso=$this->arredonda_peso($peso);
    }
    
    //VERIFICAÇÃO PARA CUBAGEM
	$cubagem = $cart->show_cubagem();//Informa a cubagem correta
    $maopropria = MODULE_SHIPPING_ESEDEX_MAOPROPRIA;
	$avrecebimento = MODULE_SHIPPING_ESEDEX_AVRECEBIMENTO;
	$tipoembalagem = SHIPPING_TYPE_PACK;
    $servico = '81019'; //e-Sedex
    
    $frete = $this->calcula_frete_correios($login, $senha, $cep_origem, $cep_destino, $peso, $total, $servico, $cubagem, $maopropria, $avrecebimento, $tipoembalagem);  
      
    if (!$shipping = $frete)
      $shipping = 0; 
    
    $this->quotes = array('id' => $this->code, 'module' =>MODULE_SHIPPING_ESEDEX_TEXT_TITLE, 'methods' => array(array('id' => $this->code, 'title' => MODULE_SHIPPING_ESEDEX_MSG, 'cost'
=>$shipping_cost = ($shipping + MODULE_SHIPPING_ESEDEX_HANDLING + SHIPPING_HANDLING)))); 
    if ($shipping > 0) 
      return $this->quotes;
	 elseif ($shipping == -3)
		return $this->quotes['error'] = MODULE_SHIPPING_ESEDEX_NO_ZONE; 
	elseif ($shipping == -6)
		return $this->quotes['error'] = MODULE_SHIPPING_ESEDEX_INVALID_ZONE; 
    else 
      return $this->quotes['error'] = MODULE_SHIPPING_ESEDEX_UNDEFINED_RATE; 
  } 

  function check() 
  { 
    if (!isset($this->_check)) 
    { 
      $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_ESEDEX_STATUS'");$this->_check =tep_db_num_rows($check_query);
    } 
    return $this->_check; 
  } 

  function install() 
  { 
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function,
date_added) values ('e-Sedex', 'MODULE_SHIPPING_ESEDEX_STATUS', 'True', 'Ativar o módulo e-Sedex?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ',
now())"); 
				 
				      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login', 'MODULE_SHIPPING_ESEDEX_LOGIN', '', 'Digite seu Código Administrativo com os Correios.', '6', '0', now())");
																																																																																															
	     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Senha', 'MODULE_SHIPPING_ESEDEX_SENHA', '', 'Digite sua senha de acesso aos Correios.', '6', '0', now())");
		 
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)
values ('Taxa de manipulação', 'MODULE_SHIPPING_ESEDEX_HANDLING', '0', 'Taxa de manipulação para esta forma de envio.', '6', '0', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)
values ('Mensagem para o Cliente', 'MODULE_SHIPPING_ESEDEX_MSG', ' 	O prazo de Entrega é de 1 a 3 dias úteis após a postagem nos correios.', 'Digite uma mensagem informativa.', '6', '0', now())");    

tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Serviço Mão Propria', 'MODULE_SHIPPING_ESEDEX_MAOPROPRIA', 'N', 'Indica se a encomenda será entregue com o serviço adicional mão própria.<br/>S ou N (S – Sim, N – Não) ', '6', '0', now())");
		
		tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Serviço Aviso de Recebimento', 'MODULE_SHIPPING_ESEDEX_AVRECEBIMENTO', 'N', 'Indica se a encomenda será entregue com o serviço adicional aviso de recebimento.<br />S ou N (S – Sim, N – Não)', '6', '0', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)
values ('Ordem de exibição.', 'MODULE_SHIPPING_ESEDEX_SORT_ORDER', '0', 'Determina a ordem de exibição desta forma de envio na tela de opções de envio.', '6', '0', now())");   
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
      
      function calcula_frete_correios( $login, $senha, $cepOrigem, $cepDestino, $peso, $valor='0', $servico, $cubagem, $maopropria, $avrecebimento, $tipoembalagem )
{
	
$webservice = 'ws.correios.com.br';
$resposta = 'xml';

$conexao = fsockopen($webservice, 80, $errno, $errstr, 30);
    if (!$conexao)
    	$erro = "$errstr ($errno)<br />\n"; 
    else 
    { 
$saida = "GET /calculador/CalcPrecoPrazo.aspx?ncdempresa=$login&sdssenha=$senha&sceporigem=$cepOrigem&scepdestino=$cepDestino&nvlpeso=$peso&ncdformato=$tipoembalagem&nvlcomprimento=".$cubagem[0]."&nvlaltura=".$cubagem[2]."&nvllargura=".$cubagem[1]."&scdmaopropria=$maopropria&nvlvalordeclarado=$valor&scdavisorecebimento=$avrecebimento&ncdservico=$servico&nvldiametro=".$cubagem[3]."&strretorno=$resposta HTTP/1.1\r\n";


$saida .= "Host: $webservice\r\n"; 
$saida .= "Connection: Close\r\n\r\n"; 

      fwrite($conexao, $saida); 
      $saida = ""; 
      
      while (!feof($conexao))       
      $saida .= fgets($conexao, 128); 
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
     $keys = array('MODULE_SHIPPING_ESEDEX_STATUS', 'MODULE_SHIPPING_ESEDEX_LOGIN', 'MODULE_SHIPPING_ESEDEX_SENHA', 'MODULE_SHIPPING_ESEDEX_HANDLING', 'MODULE_SHIPPING_ESEDEX_MSG','MODULE_SHIPPING_ESEDEX_MAOPROPRIA','MODULE_SHIPPING_ESEDEX_AVRECEBIMENTO','MODULE_SHIPPING_ESEDEX_SORT_ORDER'); 

     return $keys; 
   }

   function arredonda_peso($peso)
   { 
      $tipo=gettype($peso); //armazena tipo de variável do peso
      $peso=ereg_replace(",",".",$peso); //substitui vírgula por ponto
      settype($peso,"float"); //força o peso ser um número decimal

      if (floor($peso)<$peso)
        $peso = ceil($peso);

      settype($peso,$tipo);
        return $peso; //retorna peso com valor arredondado e com mesmo tipo informado
   } 
}
?>