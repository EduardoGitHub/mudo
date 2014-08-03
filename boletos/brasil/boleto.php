<?

/*
C�digo reestruturado por: Daniel William Schultz
Email: hospedavip@hospedavip.com

Este c�digo foi construido atrav�s de reutiliza��o de c�digos do PHPBoleto para BB.
Fique livre pra mudar este programa, redistribuir de gra�a, vender...
S� pe�o que n�o roube os creditos, que pertencem em grande parte � equipe do PHPBoleto...E em �nfima parte, � mim.

Os valores ai embaixo podem ser colocados manualmente, atrav�s de formul�rio com POST, GET
Ou retirados de uma tabela mysql, pgsql....ou qualquer nome-sql

Ensinar isso seria demais, vai em www.php.net e come�e a ler o manual ;o)
*/

/*
Dados do boleto - Obrigat�rios
*/

//MUDANDO O NOSSO NUMERO
$dadosboleto["data_vencimento"] = $_POST["data_vencimento"]; // Data de Vencimento do Boleto
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = ""; // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $_POST["valor_boleto"];
$dadosboleto["local_pagamento"] = $_POST["local_pagamento"]; // Local de pagamento do boleto
//opcionais
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "N";
$dadosboleto["uso_banco"] = "";
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";

//dados da sua conta e conv�nio
$dadosboleto["agencia"] = $_POST["agencia"]; // Num da agencia, sem digito
$dadosboleto["conta"] = $_POST["conta"]; 	// Num da conta, sem digito
//convenio e contrato podem ser vistos no gerenciador financeiro do BB
$dadosboleto["convenio"] = $_POST["convenio"];  // Num do conv�nio
$dadosboleto["contrato"] = $_POST["contrato"]; // Num do seu contrato

/*
FORMATA��O DO NOSSO NUMERO
*/

$dadosboleto["formatacao_nosso_numero"] = $_POST["formatacao_nosso_numero"];

/*
#################################################
Sei que isso funciona pra carteira 18....pras outras, deixe op��o 1

1	=	Formata��o gerada: Num do convenio + 5 digitos informados por voc� + digito verificador
		(neste caso, informe de 1 a 5 digitos somente)

2	=	para 17 digitos informados por voc� ( de 1 a 99999999999999999)

Se voc� n�o entendeu, deixe a op��o 1 e informe at� 5 digitos no nosso numero

Nosso n�mero:
de 1 a 99999 para op��o de 12 d�gitos
de 1 a 99999999999999999 para op��o de 17 d�gitos
#################################################
*/

//$dadosboleto["nosso_numero"] = $_POST["order_id"].$_POST["sacado_id"]; //Nosso numero original
$dadosboleto["nosso_numero"] = $_POST["nosso_numero"];
$dadosboleto["numero_documento"] = $dadosboleto["nosso_numero"];	// Num do pedido ou nosso numero
$dadosboleto["carteira"] = $_POST["carteira"];  // C�digo da Carteira 18 - 17 ou 11
$dadosboleto["variacao_carteira"] = "";  // Varia��o da Carteira, com tra�o (opcional)

/*
SEUS DADOS
*/
$dadosboleto["cpf_cnpj"] = $_POST["cpf_cnpj"];
$dadosboleto["endereco"] = $_POST["endereco"];
$dadosboleto["cidade"] = $_POST["cidade"];
$dadosboleto["cedente"] = $_POST["cedente"];

/*
DADOS DO SEU CLIENTE
*/
$dadosboleto["sacado"] = $_POST["sacado"];
$dadosboleto["endereco1"] = $_POST["endereco_sacado"];
$dadosboleto["endereco2"] = "";

/*
INSTRU��ES PARA O CLIENTE
*/
$dadosboleto["demonstrativo"] = $_POST["demonstrativo"];
$dadosboleto["instrucoes"] = @$_POST["instrucoes"];
$dadosboleto["instrucoes1"] = @$_POST["instrucoes1"];
$dadosboleto["instrucoes2"] = @$_POST["instrucoes2"];
$dadosboleto["instrucoes3"] = @$_POST["instrucoes3"];
$dadosboleto["instrucoes4"] = @$_POST["instrucoes4"];
//S� MEXA DEPOIS DISSO SE VOC� FOR EXPERIENTE EM PHP
include("include/funcoesbb.php"); 
include("include/layoutbbhtml.php");
?>
