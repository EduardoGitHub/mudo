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

define('TEXT_MAIN', 'Aqui voc� encontrar� desde os mais modernos instrumentos e equipamentos at� raridades.<br><br>- Temos na loja Luthier especializado para ajustes em guitarras, baixos e viol�es;<br> 
- Consultoria especializada em instrumentos de sopros para igrejas e orquestras;<br>- T�cnicos em PAs e sonoriza��o em igrejas, bares e danceterias;<br>- Todos os Instrumentos usados s�o revisados e com garantia;<br> 
<br>Al�m destes temos muitos outros diferenciais que oferecem ao cliente comodidade e seguran�a em suas compras.');
define('TABLE_HEADING_NEW_PRODUCTS', 'Produtos novos para %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Pr�ximos produtos');
define('TABLE_HEADING_DATE_EXPECTED', 'Data esperada');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Vamos ver o que temos aqui');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Modelo');
  define('TABLE_HEADING_PRODUCTS', 'Nome');
  define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
  define('TABLE_HEADING_QUANTITY', 'Qtde');
  define('TABLE_HEADING_PRICE', 'Pre�o');
  define('TABLE_HEADING_WEIGHT', 'Peso');
  define('TABLE_HEADING_BUY_NOW', 'Compre agora');
  define('TEXT_NO_PRODUCTS', 'N�o h� produtos nessa categoria.');
  define('TEXT_NO_PRODUCTS2', 'N�o h� produtos dispon�veis para esse fabricante.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'N�mero de Produtos: ');
  define('TEXT_SHOW', '<b>Filtrar:</b>');
  define('TEXT_BUY', 'Comprar 1 \'');
  define('TEXT_NOW', '\' agora');
  define('TEXT_ALL_CATEGORIES', 'Todas as categorias');
  define('TEXT_ALL_MANUFACTURERS', 'Todos os fabricantes');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'O que h� de novo?');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Categorias');
}

define('BOX_HEADING_SHOP_BY_PRICE', 'Relev�ncia');
?>
