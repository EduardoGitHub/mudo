<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o 0.01 para - Oscommerce vers�o 2.2 Milestone 2     |
// | origin�rio de : BoletoPhp - Vers�o 0.10                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa				  |
// | 																	  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +--------------------------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   				  |
// | Desenvolvimento Boleto Bradesco: Ramon Soares									      |
// | Adapta��o para Oscommerce: Welliton Cordeiro (Pinga_oz)	- www.airgun.com.br		  |
// +--------------------------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE

$dias_de_prazo_para_pagamento = $_POST["data_vencimento"];

//$taxa_boleto = 2.95;
$taxa_boleto = 0;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
//================================================================================================================================>
$valor_cobrado = $_POST["valor_boleto"]; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
//================================================================================================================================<

$valor_cobrado = str_replace(",", ".",$valor_cobrado);

//=============================================================================>
$valor_boleto = number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
//=============================================================================<

$dadosboleto["nosso_numero"] = $_POST["nosso_numero"];  // Nosso numero - REGRA: M�ximo de 8 caracteres!
$dadosboleto["numero_documento"] = $_POST["nosso_numero"];	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
//====================================================>
$dadosboleto["sacado"] = $_POST["sacado"];
$dadosboleto["endereco1"] = $_POST["endereco_sacado"];
//====================================================<
$dadosboleto["endereco2"] = ""; 

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = $_POST["demonstrativo"];
$dadosboleto["demonstrativo2"] = "";
$dadosboleto["demonstrativo3"] = "";
$dadosboleto["instrucoes1"] = @$_POST["instrucoes"];
$dadosboleto["instrucoes2"] = @$_POST["instrucoes1"];
$dadosboleto["instrucoes3"] = @$_POST["instrucoes2"];
$dadosboleto["instrucoes4"] = @$_POST["instrucoes3"];

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "N";		
$dadosboleto["uso_banco"] = ""; 	
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITA�
$dadosboleto["agencia"] = $_POST["agencia"]; // Num da agencia, sem digito
$dadosboleto["conta"] = $_POST["conta"];	// Num da conta, sem digito
$dadosboleto["conta_dv"] = $_POST["contadv"]; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITA�
$dadosboleto["carteira"] = $_POST["carteira"];  // C�digo da Carteira

// SEUS DADOS
$dadosboleto["identificacao"] = "BRIM Sistemas";
$dadosboleto["cpf_cnpj"] = $_POST["cpf_cnpj"];
$dadosboleto["endereco"] = $_POST["endereco"];
$dadosboleto["cidade_uf"] = $_POST["cidade"];
$dadosboleto["cedente"] = $_POST["cedente"];

// N�O ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_itau.php");
?>
