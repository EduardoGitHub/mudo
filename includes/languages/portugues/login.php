<?php

/***************************************************************************/
/*                                                                         */
/*  osCommerce, Open Source E-Commerce Solutions                           */
/*  http://www.oscommerce.com                                              */
/*  Released under the GNU General Public License                          */
/*                                                                         */
/*  Translation Brazilian by:                                              */
/*  Tradu��o Para o Portugu�s Brasil por:                                  */
/*  Reginaldo Gomes (Envoy) envoy@phpmania.org | http://phpmania.org       */
/*  osCommerce 2.2 Milestone 2 Portugu�s-Brasil Vers�o PHPmania.org        */
/*                                                                         */
/***************************************************************************/

if ($HTTP_GET_VARS['origin'] == FILENAME_CHECKOUT_PAYMENT) {
  define('NAVBAR_TITLE', 'Fazer Pedido');
  define('HEADING_TITLE', 'Comprar aqui � muito f�cil.');
  define('TEXT_STEP_BY_STEP', 'Siga as instru��es passo a passo.');
} else {
  define('NAVBAR_TITLE', 'Entrar');
  define('HEADING_TITLE', 'Quero me cadastrar!');
  define('TEXT_STEP_BY_STEP', ''); // should be empty
}
define('HEADING_NEW_CUSTOMER', 'Novo cliente');
define('HEADING_RETURNING_CUSTOMER', 'J� sou cadastrado');
define('ENTRY_EMAIL_ADDRESS2', 'Digite seu endere�o de E-mail:');
define('TEXT_NEW_CUSTOMER', 'Sou um novo cliente.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Criando uma conta no ' . STORE_NAME . ' voc� poder� fazer suas compras com rapidez e seguran�a, al�m de controlar os pedidos que voc� j� fez. Escolha uma das op��es abaixo para iniciar o cadastro, lembrando que os campos tiverem <span style="color:#FF0000">* asterisco</span> s�o obrigat�rios.');
define('TEXT_RETURNING_CUSTOMER', 'J� comprei outras vezes, e minha senha �:');
define('TEXT_COOKIE', 'Salvar informa��es em um \'cookie\'?');
define('TEXT_PASSWORD_FORGOTTEN', 'Esqueceu sua senha? Clique neste bot�o que a enviaremos para seu e-mail.');
define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERRO:</b></font> O \'E-Mail\' e/ou \'Senha\' n�o constam no nosso banco de dados.');
define('TEXT_LOGIN_ERROR_EMAIL', '<font color="#ff0000"><b>ERRO:</b></font> O \'E-Mail\' ja consta no nosso banco de dados, use sua \'senha\' para entrar.');
define('TEXT_VISITORS_CART', '
	   <span style="font-size:30px; color:#FF0000; text-transform:uppercase;"><b>ATEN��O: </b></span><span style="font-size:30px; color:#0A629C; text-transform:uppercase;"><b>Voc� j� � cliente?</b></span><br /><br />
	   <span style="line-height:18px;">
	   Se voc� j� � cliente, informe seu email e senha para prosseguir com a opera��o desejada. Se ainda n�o � cliente, fa�a seu cadastro rapidamente seguindo as instru��es abaixo. <br/ ><font color="#ff0000"><b>Obs:</b></font>  Caso voc� esteja efetuando uma compra todos os produtos adicionados ser�o mantidados ap�s entrar no sistema ou fazer um novo cadastro. <a href="javascript:session_win();">[Mais Informa��es]</a></span>
 ');
?>
