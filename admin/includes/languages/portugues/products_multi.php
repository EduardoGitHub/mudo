<?php
/*
  $Id: products_multi.php, v 2.6

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gerenciar Varios Produtos');
define('HEADING_TITLE_SEARCH', 'Procurar:');
define('HEADING_TITLE_GOTO', 'Ir Para:');

define('TABLE_HEADING_SELECT', 'Selecionar');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Departamentos / Produtos');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_ACTION', 'Ação');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Quantidade');
define('TABLE_HEADING_MANUFACTURERS_NAME', 'Fabricantes');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_DELETE_PRODUCT', 'Deletar Produto:');
define('DEL_CHOOSE_DELETE_ART', 'Como deletar?');
define('DEL_THIS_CAT', 'Apenas nessa categoria');
define('DEL_COMPLETE', 'Produto completamente deletado');

define('TEXT_CATEGORIES', 'Departamentos:');
define('TEXT_ATTENTION_DANGER', '<span class="dataTableContentRedAlert"><u>Aviso:</u></span>&nbsp;Faça Backup de seu banco de dados após mover, copiar, ou deletar qualquer produto de sua loja.');
define('TEXT_MOVE_TO', 'Mover Para:');
define('TEXT_LINK_TO', 'Linkar Para:');
define('TEXT_COPY_TO', 'Copiar Para:');
define('TEXT_CHOOSE_ALL', 'Selecionar Todos');
define('TEXT_CHOOSE_ALL_REMOVE', 'Remover Todos');
define('TEXT_SUBCATEGORIES', 'Subcategorias:');
define('TEXT_PRODUCTS', 'Produtos:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preço:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Nota do Produto:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantidade:');
define('TEXT_DATE_ADDED', 'Adicionado Em:');
define('TEXT_LAST_MODIFIED', 'Última Modificação:');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Por favor insira um novo departamento ou produto<br>&nbsp;<br><b>%s</b>');
define('TEXT_IMAGE_NONEXISTENT', 'IMAGEM NÃO EXISTE');

define('EMPTY_CATEGORY', 'Departamento Vazio');

define('TEXT_HOW_TO_COPY', 'Método de Copia:');
define('TEXT_COPY_AS_LINK', 'Linkar produto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicar produto');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Erro: Não se pode linkar produtos no mesmo departamento.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erro: Diretório de imagens da loja não esta acessível para escrever: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erro: Diretório de imagens da loja não existe: ' . DIR_FS_CATALOG_IMAGES);
?>