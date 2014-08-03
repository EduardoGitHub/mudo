<?php
require('includes/application_top.php');
header('Content-Type: text/html; charset=ISO-8859-1');
setlocale(LC_CTYPE,"pt_BR"); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");




$cepOrigem = SHIPPING_ORIGIN_ZIP; // Recebe o cep Origem da loja

/* Abaixo recebe o cep de Destino do cliente e faz uma validação para verificar se ele digitou e se tiver digitado verifica se tem 8 caracteres */
$cepDestino = $_GET["destino"];
if($cepDestino == "") { echo "Preencha o CEP de Destino!"; exit;}
elseif($cepDestino == ""  || strlen($cepDestino) < 9) {
echo "CEP deve conter 8 números!";
exit;
}

$cep_destino = str_replace('-','',$cepDestino);
$free_shipping = false;
$free_for_cep = false;
$free_for_total = false;
if(MODULE_ORDER_TOTAL_SHIPPING_FREE_ZIPCODE !=''){ $free_for_cep = true; $faixas_cep = explode('-',MODULE_ORDER_TOTAL_SHIPPING_FREE_ZIPCODE);}
if(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER !='') $free_for_total = true;
$fregratis_valor = $_GET["valor"] * $_GET["qtd"];
if(($free_for_cep == true) && ($free_for_total == true) && ($fregratis_valor >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) && ($cep_destino>=$faixas_cep[0]) && ($cep_destino<=$faixas_cep[1])){//verifica os dois
		$free_shipping = true;
}else if(($free_for_cep == true) && ($free_for_total == false) && ($cep_destino>=$faixas_cep[0]) && ($cep_destino<=$faixas_cep[1])){ // verifica apenas o CEP
		$free_shipping = true;
}else if(($free_for_cep == false) && ($free_for_total == true) && ($fregratis_valor >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)){//Apenas verifica o valor total da compra
		$free_shipping = true;
}

//echo $free_shipping;
if($free_shipping == true ){
	
	if($free_for_total == true)
	echo '<img src="'.  DIR_WS_CATALOG .'includes/languages/portugues/images/buttons/frete_gratis.png" border="0" align="absmiddle" /> <b>Frete gratis</b> - (Frete grátis para compras acima de R$'.number_format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER, 2, ".", "," ).')';
	else
	if($free_for_total == false && $free_for_cep == true )
	echo '<img src="'.  DIR_WS_CATALOG .'includes/languages/portugues/images/buttons/frete_gratis.png" border="0" align="absmiddle" /> <b>Frete gratis</b> - (Frete gratis para sua região)';

}else{
$peso = $_GET["peso"]* $_GET["qtd"];
if($peso == "") {echo "Selecione a Qtd que deseja do produto!";exit;}


/* Aredonda o peso, se der menos que 300 arredonda para 500, foi feito isso pois havia divergências do frete calculado por esse módulo e o frete calculado ao finalizar o pedido */
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

$peso = arredonda_peso($peso);

//$peso = $peso/1000;  // se o peso da sua loja for em kg comente essa linha

$comprimento = $_GET["comprimento"] * $_GET["qtd"];
$largura = $_GET["largura"] * $_GET["qtd"];
$altura = $_GET["altura"] * $_GET["qtd"];
$diametro = $_GET["diametro"] * $_GET["qtd"];
$cubagem = $cart->cubagemCorreios($comprimento, $largura, $altura, $diametro);


//Checa se é SEDEX a cobrar
//if($srv == '40045')
// esta é a URL dos correios
//$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cepOrigem."&sCepDestino=".$cepDestino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=25&nVlAltura=5&nVlLargura=15&sCdMaoPropria=n&nVlValorDeclarado=1&sCdAvisoRecebimento=n&nCdServico=".$srv."&nVlDiametro=20&StrRetorno=xml";
//else
// esta é a URL dos correios

//Verifica qual modulo esta instalado 

$pac = strpos(MODULE_SHIPPING_INSTALLED, 'pac.php');
$sedex = strpos(MODULE_SHIPPING_INSTALLED, 'sedex.php');
$sedex10 = strpos(MODULE_SHIPPING_INSTALLED, 'sedex10.php');
$sedexh = strpos(MODULE_SHIPPING_INSTALLED, 'sedexh.php');
$sedexac = strpos(MODULE_SHIPPING_INSTALLED, 'sedexac.php');

$srv = array();
$infor = array();
$maopropria = array();
$avrecebimento = array();
$price = array();
$tipoembalagem = SHIPPING_TYPE_PACK;


if($pac !== false) {
$srv[] = '41106';
$infor[] = '<img src="'.  DIR_WS_CATALOG .'images/modulos/entrega_pac.gif" border="0" align="absmiddle" /> <b>Entrega via PAC</b> - ('.MODULE_SHIPPING_PAC_MSG.')';
$maopropria[] = MODULE_SHIPPING_PAC_MAOPROPRIA;
$avrecebimento[] = MODULE_SHIPPING_PAC_AVRECEBIMENTO;
if(MODULE_SHIPPING_PAC_VALORD=='Sim') $price[] = $_GET["valor"] * $_GET["qtd"]; else $price[] = 0;
}

if($sedex !== false) {
$srv[] = '40010';
$infor[] = '<img src="'.  DIR_WS_CATALOG .'images/modulos/entrega_sedex.gif" border="0" align="absmiddle" /> <b>Entrega via Sedex</b> - ('.MODULE_SHIPPING_SEDEX_MSG.')';
$maopropria[] = MODULE_SHIPPING_SEDEX_MAOPROPRIA;
$avrecebimento[] = MODULE_SHIPPING_SEDEX_AVRECEBIMENTO;
if(MODULE_SHIPPING_SEDEX_VALORD=='Sim') $price[] = $_GET["valor"] * $_GET["qtd"]; else $price[] = 0;
}

if($sedex10 !== false) {
$srv[] = '40215';
$infor[] = '<img src="'.  DIR_WS_CATALOG .'images/modulos/entrega_sedex10.gif" border="0" align="absmiddle" /> <b>Entrega via Sedex 10</b> - ('.MODULE_SHIPPING_SEDEX10_MSG.')';
$maopropria[] = MODULE_SHIPPING_SEDEX10_MAOPROPRIA;
$avrecebimento[] = MODULE_SHIPPING_SEDEX10_AVRECEBIMENTO;
if(MODULE_SHIPPING_SEDEX10_VALORD=='Sim') $price[] = $_GET["valor"] * $_GET["qtd"]; else $price[] = 0;
}

if($sedexh !== false) {
$srv[] = '40290';
$infor[] = '<img src="'.  DIR_WS_CATALOG .'images/modulos/entrega_sedexhoje.gif" border="0" align="absmiddle" /> <b>Entrega via Sedex Hoje</b> - ('.MODULE_SHIPPING_SEDEXH_MSG.')';
$maopropria[] = MODULE_SHIPPING_SEDEXH_MAOPROPRIA;
$avrecebimento[] = MODULE_SHIPPING_SEDEXH_AVRECEBIMENTO;
if(MODULE_SHIPPING_SEDEXH_VALORD=='Sim') $price[] = $_GET["valor"] * $_GET["qtd"]; else $price[] = 0;
}

if($sedexac !== false) {
$srv[] = '40045';
$infor[] = '<img src="'.  DIR_WS_CATALOG .'images/modulos/sedexacobrar.jpg" border="0" align="absmiddle" /> <b>Entrega via Sedex a Cobrar</b> - ('.MODULE_SHIPPING_SEDEXAC_MSG.')';
$maopropria[] = MODULE_SHIPPING_SEDEXAC_MAOPROPRIA;
$avrecebimento[] = MODULE_SHIPPING_SEDEXAC_AVRECEBIMENTO;
$price[] = $_GET["valor"] * $_GET["qtd"];
}

/*
$srv = array('41106' => '<img src="'.  DIR_WS_CATALOG .'images/modulos/entrega_pac.gif" border="0" align="absmiddle" /> Entrega via PAC - '.MODULE_SHIPPING_PAC_MSG,
			 '40010' => '<img src="'.  DIR_WS_CATALOG .'images/modulos/entrega_sedex.gif" border="0" align="absmiddle" /> Entrega via Sedex - '.MODULE_SHIPPING_SEDEX_MSG,
			 '40215' => '<img src="'.  DIR_WS_CATALOG .'images/modulos/entrega_sedex10.gif" border="0" align="absmiddle" /> Entrega via Sedex 10 - '.MODULE_SHIPPING_SEDEX10_MSG,
			 '40045' => '<img src="'.  DIR_WS_CATALOG .'images/modulos/sedexacobrar.jpg" border="0" align="absmiddle" /> Entrega via Sedex a Cobrar - '.MODULE_SHIPPING_SEDEXAC_MSG,
			 '40290' => '<img src="'.  DIR_WS_CATALOG .'images/modulos/entrega_sedexhoje.gif" border="0" align="absmiddle" /> Entrega via Sedex Hoje -'.MODULE_SHIPPING_SEDEXH_MSG);
*/

for($cont =0; $cont < count($srv); $cont++){
//$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cepOrigem."&sCepDestino=".$cepDestino."&nVlPeso=".$peso."&nCdFormato=1&nvlcomprimento=".$cubagem[0]."&nvlaltura=".$cubagem[2]."&nvllargura=".$cubagem[1]."&sCdMaoPropria=n&nVlValorDeclarado=$valor&sCdAvisoRecebimento=n&nCdServico=".$srv[$cont]."&nVlDiametro=".$cubagem[3]."&StrRetorno=xml";

$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cepOrigem."&sCepDestino=".$cepDestino."&nVlPeso=".$peso."&nCdFormato=$tipoembalagem&nVlComprimento=".$cubagem[0]."&nVlAltura=".$cubagem[2]."&nVlLargura=".$cubagem[1]."&sCdMaoPropria=".$maopropria[$cont]."&nVlValorDeclarado=".$price[$cont]."&sCdAvisoRecebimento=".$avrecebimento[$cont]."&nCdServico=".$srv[$cont]."&nVlDiametro=".$cubagem[3]."&StrRetorno=xml";

// captura as linhas da URL retornada
$fonte = file($url);
// varro as linhas e procuro o valor do frete, no caso está na linha 660
// caso não retorne descomene a linha dentro do foreach e veja qual a linha que retorna o valor


foreach ($fonte as $www) {
	$bsc = "/\<Valor>(.*)\<\/Valor>/";
	$bsc2 = "/\<MsgErro>(.*)\<\/MsgErro>/";
	if(preg_match($bsc,$www,$retorno)){
		//$preco = number_format($retorno[1],2,',','.');
		$preco = str_replace(',','.',$retorno[0]);
		$preco = strip_tags($preco);	
	}
	if(preg_match($bsc2,$www,$retorno)){
		$descricao = $retorno[1];
	}
}


// Se os correios estiver fora do ar aparece uma mensagem
if($preco == '') echo "Erro, correios não respondeu!";
if(empty($descricao)) { echo $infor[$cont].' R$'.number_format($preco, 2, ".", "," ).'<br/>'; } //else { echo $descricao; }
}
}
?>