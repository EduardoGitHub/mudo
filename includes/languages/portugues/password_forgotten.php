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

define('NAVBAR_TITLE_1', 'Login');
define('NAVBAR_TITLE_2', 'Senha perdida');

define('HEADING_TITLE', 'Eu esqueci minha senha!');

define('TEXT_MAIN', 'Se você se esqueceu de sua senha, coloque seu e-mail logo abaixo e nós enviaremos um e-mail com sua nova senha.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Erro: O e-mail não foi encontrado em nossos registros, por favor tente novamente.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nova senha');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Uma nova senha foi requisitada de ' . $REMOTE_ADDR . '.' . "<br/>" . 'Sua nova senha para acesso a loja \'' . STORE_NAME . '\' é <b>: %s' . "</b><br/><br/>");
define('TEXT_EMAIL_SIGNATURE', 'Atenciosamente,' . "<br/>" . '%s');

define('SUCCESS_PASSWORD_SENT', 'Sucesso: Uma nova senha foi enviada para seu e-mail.');
?>
