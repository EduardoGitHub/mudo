<?php
/*
  $Id: whos_online.php,v 3.2 2007/04/27 nerbonne Exp $
  updated version number because of version number jumble and provide installation instructions.
  corection french by azer
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// added for version 1.9 - to be translated to the right language BOF ******
define('AZER_WHOSONLINE_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip='); //for version 2.9 by azer - whois ip
define('TEXT_NOT_AVAILABLE', '   <b>Nota:</b> N/A = IP n�o dispon�vel'); //for version 2.9 by azer was missing
define('TEXT_LAST_REFRESH', '�ltima Atualiza��o �s'); //for version 2.9 by azer was missing
define('TEXT_EMPTY', 'Empty'); //for version 2.8 by azer was missing
define('TEXT_MY_IP_ADDRESS', 'Meu Endere�o de IP '); //for version 2.8 by azer was missing
define('TABLE_HEADING_COUNTRY', 'Pa�s'); // azerc : 25oct05 for contrib whos_online with country and flag
// added for version 1.9 EOF *************************************************

define('HEADING_TITLE', 'Quem Est� Online Turbo - <a href="index.php"><b>Voltar ao Painel de Op��es do Administrador</b></a>');  // Version update to 3.2 because of multiple 1.x and 2.x jumble.  apr-07 by nerbonne
define('TABLE_HEADING_ONLINE', 'Online');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Nome');
define('TABLE_HEADING_IP_ADDRESS', 'Endere�o de IP');
define('TABLE_HEADING_ENTRY_TIME', 'Entrou');
define('TABLE_HEADING_LAST_CLICK', '�ltimo Clique');
define('TABLE_HEADING_LAST_PAGE_URL', '�ltima URL');
define('TABLE_HEADING_ACTION', 'A��o');
define('TABLE_HEADING_SHOPPING_CART', 'Sacola');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Subtotal');
define('TEXT_NUMBER_OF_CUSTOMERS', '%s &nbsp; Visitantes/Clientes (Ser�o considerados inativos depois de 5 minutos e apagados depois de 15 minutos)');
define('TEXT_NUMBER_OF_CUSTOMER', 'Visitantes online (Considere inativo ap�s 5 minutos. Remove ap�s 15 minutos Removed after 15 minutes)');
define('TABLE_HEADING_HTTP_REFERER', 'Origem');
define('TEXT_HTTP_REFERER_URL', 'Endere�o de Origem');
define('TEXT_HTTP_REFERER_FOUND', 'Sim');
define('TEXT_HTTP_REFERER_NOT_FOUND', 'Desconhecida');
define('TEXT_STATUS_ACTIVE_CART', 'Ativo COM Sacola');
define('TEXT_STATUS_ACTIVE_NOCART', 'Ativo SEM Sacola');
define('TEXT_STATUS_INACTIVE_CART', 'Inativo COM Sacola');
define('TEXT_STATUS_INACTIVE_NOCART', 'Inativo SEM Sacola');
define('TEXT_STATUS_NO_SESSION_BOT', 'Inactive Bot with no session?'); //Azer !!! check if right description
define('TEXT_STATUS_INACTIVE_BOT', 'Motor de busca desativo com sess�o.'); //Azer !!! check if right description
define('TEXT_STATUS_ACTIVE_BOT', 'Motor de busca ativa com a sess�o '); //Azer !!! check if right description
define('TABLE_HEADING_COUNTRY', 'Pa�s');
define('TABLE_HEADING_USER_SESSION', 'Sess�o');
define('TEXT_IN_SESSION', 'Sim');
define('TEXT_NO_SESSION', 'N�o');

define('TEXT_OSCID', 'osCsid');
define('TEXT_PROFILE_DISPLAY', 'Detalhes');
define('TEXT_USER_AGENT', 'Navegador');
define('TEXT_ERROR', 'Erro!');
define('TEXT_ADMIN', 'Admin');
define('TEXT_DUPLICATE_IP', 'IP Duplicado');
define('TEXT_DUPLICATE_IPS', 'IP Duplicados');
define('TEXT_BOT', 'Rob�');
define('TEXT_BOTS', 'Rob�s');
define('TEXT_ME', 'Eu Mesmo');
define('TEXT_ALL', 'Todos');
define('TEXT_REAL_CUSTOMERS', 'Clientes');
define('TEXT_REAL_CUSTOMER', 'Cliente');
define('TEXT_ACTIVE_CUSTOMER', ' est� ativo.');
define('TEXT_ACTIVE_CUSTOMERS', ' est�o ativos.');

define('TEXT_YOUR_IP_ADDRESS', 'Seu IP');
define('TEXT_SET_REFRESH_RATE', 'Atualizar');
define('TEXT_NONE_', 'Todos');
define('TEXT_CUSTOMERS', 'Clientes');
define('TEXT_SHOW_BOTS', 'Mostrar Rob�s');
define('TEXT_SHOW_MAP', 'Mostrar Mapa');
define('TEXT_COUNTRY', 'Pa�s');
define('TEXT_REGION', 'Regi�o');
define('TEXT_CITY', 'Cidade');
?>
