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

define('TEXT_MAIN', 'Aqui você encontrará desde os mais modernos instrumentos e equipamentos até raridades.<br><br>- Temos na loja Luthier especializado para ajustes em guitarras, baixos e violões;<br> 
- Consultoria especializada em instrumentos de sopros para igrejas e orquestras;<br>- Técnicos em PAs e sonorização em igrejas, bares e danceterias;<br>- Todos os Instrumentos usados são revisados e com garantia;<br> 
<br>Além destes temos muitos outros diferenciais que oferecem ao cliente comodidade e segurança em suas compras.');
define('TABLE_HEADING_NEW_PRODUCTS', 'Produtos novos para %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Próximos produtos');
define('TABLE_HEADING_DATE_EXPECTED', 'Data esperada');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Vamos ver o que temos aqui');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Modelo');
  define('TABLE_HEADING_PRODUCTS', 'Nome');
  define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
  define('TABLE_HEADING_QUANTITY', 'Qtde');
  define('TABLE_HEADING_PRICE', 'Preço');
  define('TABLE_HEADING_WEIGHT', 'Peso');
  define('TABLE_HEADING_BUY_NOW', 'Compre agora');
  define('TEXT_NO_PRODUCTS', 'Não há produtos nessa categoria.');
  define('TEXT_NO_PRODUCTS2', 'Não há produtos disponíveis para esse fabricante.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Número de Produtos: ');
  define('TEXT_SHOW', '<b>Filtrar:</b>');
  define('TEXT_BUY', 'Comprar 1 \'');
  define('TEXT_NOW', '\' agora');
  define('TEXT_ALL_CATEGORIES', 'Todas as categorias');
  define('TEXT_ALL_MANUFACTURERS', 'Todos os fabricantes');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'O que há de novo?');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Categorias');
}

define('BOX_HEADING_SHOP_BY_PRICE', 'Relevância');
?>
