<?php
/*
  $Id: products_extra_images.php,v 1.0 2003/06/11 Mikel Williams

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

	Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Imagens extras de produtos');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS_NAME', 'Nome do produto');

/* Added for product image*/
define('TABLE_HEADING_PRODUCTS_IMAGE', 'Produto');
define('TABLE_HEADING_PRODUCTS_IMAGE_PATH', 'Local da imagem');
define('TABLE_HEADING_PRODUCTS_EXTRA_IMAGE', 'Imagem Extra');
/* Added for product image*/

define('TABLE_HEADING_PRODUCTS_ID', 'ID do produto');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_PAGING_FORMAT', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> imagens extras)');
define('TEXT_HEADING_EDIT_EXTRA_IMAGE', 'Editar imagem extra do produto');
define('TEXT_HEADING_NEW_EXTRA_IMAGE', 'Adicionar imagem extra');
define('TEXT_NEW_INTRO', 'Por favor, preencha as seguintes informações para adicionar uma nova imagem extra');
define('TEXT_EDIT_INTRO', 'Por favor, faça as alterações necessárias');
define('TEXT_PRODUCTS', 'Número de produtos:');

/* Added for small improvements in upload UI */
define('TEXT_PRODUCTS_NAME', 'Nome do produto:');
define('TEXT_PRODUCTS_IMAGE', 'Imagem do produto:');

/* Added for fix and allows for setting customized paths to image on server*/
define('TEXT_IMAGE_NONEXISTENT', 'SEM IMAGEM');
define('TEXT_SPECIAL_IMAGE_PATH', 'Se você desejar customizar a pasta de destino da imagem,<BR>digite o caminho da subpasta(s) <BR><B>COM</B>uma barra no final (subpastas devem existir dentro do diretório <b>"images/"</b>).');
define('UPDATE_EXTRA_IMAGE_OPTION', 'OU, se a foto já foi enviada<BR>(Deixar o campo ao lado do botão "Procurar" em branco), <BR>deixe o caminho para o arquivo de imagem "images /" pasta');
/* Added for fix and allows for setting customized paths to image on server*/

/** Added to place a link to insert a link to add a new image on the top of the table **/
define(ACTION_ADD_NEW_EXTRA_IMAGE, "Adicionar nova imagem extra");
?>
