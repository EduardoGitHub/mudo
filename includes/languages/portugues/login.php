<?php

/***************************************************************************/
/*                                                                         */
/*  osCommerce, Open Source E-Commerce Solutions                           */
/*  http://www.oscommerce.com                                              */
/*  Released under the GNU General Public License                          */
/*                                                                         */
/*  Translation Brazilian by:                                              */
/*  Tradução Para o Português Brasil por:                                  */
/*  Reginaldo Gomes (Envoy) envoy@phpmania.org | http://phpmania.org       */
/*  osCommerce 2.2 Milestone 2 Português-Brasil Versão PHPmania.org        */
/*                                                                         */
/***************************************************************************/

if ($HTTP_GET_VARS['origin'] == FILENAME_CHECKOUT_PAYMENT) {
  define('NAVBAR_TITLE', 'Fazer Pedido');
  define('HEADING_TITLE', 'Comprar aqui é muito fácil.');
  define('TEXT_STEP_BY_STEP', 'Siga as instruções passo a passo.');
} else {
  define('NAVBAR_TITLE', 'Entrar');
  define('HEADING_TITLE', 'Quero me cadastrar!');
  define('TEXT_STEP_BY_STEP', ''); // should be empty
}
define('HEADING_NEW_CUSTOMER', 'Novo cliente');
define('HEADING_RETURNING_CUSTOMER', 'Já sou cadastrado');
define('ENTRY_EMAIL_ADDRESS2', 'Digite seu endereço de E-mail:');
define('TEXT_NEW_CUSTOMER', 'Sou um novo cliente.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Criando uma conta no ' . STORE_NAME . ' você poderá fazer suas compras com rapidez e segurança, além de controlar os pedidos que você já fez. Escolha uma das opções abaixo para iniciar o cadastro, lembrando que os campos tiverem <span style="color:#FF0000">* asterisco</span> são obrigatórios.');
define('TEXT_RETURNING_CUSTOMER', 'Já comprei outras vezes, e minha senha é:');
define('TEXT_COOKIE', 'Salvar informações em um \'cookie\'?');
define('TEXT_PASSWORD_FORGOTTEN', 'Esqueceu sua senha? Clique neste botão que a enviaremos para seu e-mail.');
define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERRO:</b></font> O \'E-Mail\' e/ou \'Senha\' não constam no nosso banco de dados.');
define('TEXT_LOGIN_ERROR_EMAIL', '<font color="#ff0000"><b>ERRO:</b></font> O \'E-Mail\' ja consta no nosso banco de dados, use sua \'senha\' para entrar.');
define('TEXT_VISITORS_CART', '
	   <span style="font-size:30px; color:#FF0000; text-transform:uppercase;"><b>ATENÇÃO: </b></span><span style="font-size:30px; color:#0A629C; text-transform:uppercase;"><b>Você já é cliente?</b></span><br /><br />
	   <span style="line-height:18px;">
	   Se você já é cliente, informe seu email e senha para prosseguir com a operação desejada. Se ainda não é cliente, faça seu cadastro rapidamente seguindo as instruções abaixo. <br/ ><font color="#ff0000"><b>Obs:</b></font>  Caso você esteja efetuando uma compra todos os produtos adicionados serão mantidados após entrar no sistema ou fazer um novo cadastro. <a href="javascript:session_win();">[Mais Informações]</a></span>
 ');
?>
