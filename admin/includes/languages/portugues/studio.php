<?php
/*
  $Id: products_extra_images.php,v 1.0 2003/06/11 Mikel Williams

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

	Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

/* Added for small improvements in upload UI */
define('TEXT_PRODUCTS_TYPE', 'Nome da foto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descri��o/Coment�rio:');
define('TEXT_PRODUCTS_AUTOR', 'Autor:');


define('HEADING_TITLE', 'Galeria de Estudio de Cria��o');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS_NAME', 'Nome da Foto');

/* Added for product image*/
define('TABLE_HEADING_PRODUCTS_IMAGE', 'Foto');
define('TABLE_HEADING_PRODUCTS_IMAGE_PATH', 'Tipo do Adesivo');
define('TABLE_HEADING_PRODUCTS_EXTRA_IMAGE', 'Descri��o');
/* Added for product image*/

define('TABLE_HEADING_PRODUCTS_ID', 'ID do produto');
define('TABLE_HEADING_ACTION', 'A��o');

define('TEXT_PAGING_FORMAT', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> fotos)');
define('TEXT_HEADING_EDIT_EXTRA_IMAGE', 'Editar imagem extra do produto');
define('TEXT_HEADING_NEW_EXTRA_IMAGE', 'Adicionar imagem extra');
define('TEXT_NEW_INTRO', 'Por favor, preencha as seguintes informa��es para adicionar uma nova imagem.');
define('TEXT_EDIT_INTRO', 'Por favor, fa�a as altera��es necess�rias');
define('TEXT_PRODUCTS', 'N�mero de produtos:');

/* Added for small improvements in upload UI */
define('TEXT_PRODUCTS_NAME', 'Nome do produto:');
define('TEXT_PRODUCTS_IMAGE', 'Imagem do produto:');

/* Added for fix and allows for setting customized paths to image on server*/
define('TEXT_IMAGE_NONEXISTENT', 'SEM IMAGEM');
//define('TEXT_SPECIAL_IMAGE_PATH', 'Se voc� desejar customizar a pasta de destino da imagem,<BR>digite o caminho da subpasta(s) <BR><B>COM</B>uma barra no final (subpastas devem existir dentro do diret�rio <b>"images/"</b>).');
define('TEXT_SPECIAL_IMAGE_PATH', 'Local onde ser� armazenado as fotos.');
define('UPDATE_EXTRA_IMAGE_OPTION', 'OU, se a foto j� foi enviada<BR>(Deixar o campo ao lado do bot�o "Procurar" em branco), <BR>deixe o caminho para o arquivo de imagem "images /" pasta');
/* Added for fix and allows for setting customized paths to image on server*/

/** Added to place a link to insert a link to add a new image on the top of the table **/
define(ACTION_ADD_NEW_EXTRA_IMAGE, "Adicionar nova imagem extra");
?>
