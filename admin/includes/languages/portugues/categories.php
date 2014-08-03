<?php

/***************************************************************************/
/*                                                                         */
/*  osCommerce, Open Source E-Commerce Solutions                           */
/*  http://www.oscommerce.com                                              */
/*  Released under the GNU General Public License                          */
/*                                                                         */
/*  Tradu��o Para o Portugu�s Brasil por:                                  */
/*  Alexandre August alexandre@brim.com.br | http://www.brimempresas.com.br*/
/*  osCommerce 2.2 Milestone 2 Portugu�s-Brasil Vers�o BRIM Empresas       */
/*                                                                         */
/***************************************************************************/

define('HEADING_TITLE', 'Categorias / Produtos');
define('HEADING_TITLE_SEARCH', 'Busca:');
define('HEADING_TITLE_GOTO', 'Ir para:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorias / Produtos');
define('TABLE_HEADING_ACTION', 'A��o');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Novo Produto em  &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categorias:');
define('TEXT_SUBCATEGORIES', 'Subcategorias:');
define('TEXT_PRODUCTS', 'Produtos:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Pre�o:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Classe de Impostos:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Nota M�dia:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantidade:');
define('TEXT_DATE_ADDED', 'Adicionado Em:');
define('TEXT_DATE_AVAILABLE', 'Dispon�vel Em:');
define('TEXT_LAST_MODIFIED', '�ltima Modifica��o:');
define('TEXT_IMAGE_NONEXISTENT', 'Foto Inexistente');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Por favor introduza uma nova categoria ou um novo produto neste n�vel.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Para maiores informa��es , visite a p�gina oficial deste produto <a href="http://%s" target="blank"><u> </u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Este produto foi adicionado ao nosso cat�logo em %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este produto estar� dispon�vel a partir de  %s.');

define('TEXT_EDIT_INTRO', 'Por favor fa�a as altera��es necess�rias');
define('TEXT_EDIT_CATEGORIES_ID', 'Nr. da Categoria:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nome da Categoria:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Figura da Categoria:');
define('TEXT_EDIT_SORT_ORDER', 'Ordenamento:');

define('TEXT_INFO_COPY_TO_INTRO', 'Por favor escolha a nova categoria para copiar este produto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorias Existentes:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nova Categoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar Categoria');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Apagar Categoria');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categoria');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Apagar Produto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Produto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar Para');

define('TEXT_DELETE_CATEGORY_INTRO', 'Tem certeza que quer excluir esta categoria?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Tem certeza que quer excluir definitivamente este produto?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>CUIDADO:</b> Ainda h� %s (sub-)categorias lincadas a esta categoria!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>CUIDADO:</b> Ainda h�  %s produtos lincados a esta categoria!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Por favor selecione qual categoria deseja <b>%s</b> utilizar');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Por favor selecione qual categoria deseja <b>%s</b> utilizar');
define('TEXT_MOVE', 'Mover <b>%s</b> para:');

define('TEXT_NEW_CATEGORY_INTRO', 'Por favor preencha a segunte informa��o sobre a nova categoria ');
define('TEXT_CATEGORIES_NAME', 'Nome da Categoria:');
define('TEXT_CATEGORIES_IMAGE', 'Figura da Categoria:');
define('TEXT_SORT_ORDER', 'Ordenamento:');

define('TEXT_PRODUCTS_STATUS', 'Status dos Produtos:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Dispon�vel em:');
define('TEXT_PRODUCT_AVAILABLE', 'Em Estoque');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Sem Saldo Em Estoque');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante do Produto:');
define('TEXT_PRODUCTS_NAME', 'Nome do Produto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descri��o do Produto:');
define('TEXT_PRODUCTS_QUANTITY', 'Quantidade:');
define('TEXT_PRODUCTS_MODEL', 'Modelo do Produto:');
define('TEXT_PRODUCTS_IMAGE', 'Figura do Produto:');
define('TEXT_PRODUCTS_URL', 'P�gina web do Produto :');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sem o  http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Pre�o do Produto (L�quido):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Pre�o do Produto (Bruto):');
define('TEXT_PRODUCTS_PRICE_REVENDA', 'Pre�o do Produto (Revenda):');
define('TEXT_PRODUCTS_WEIGHT', 'Peso do Produto:');
define('TEXT_PRODUCTS_WARRANTY', 'Garantia do Produto:');
define('TEXT_PRODUCTS_WARRANTY_DAYS', '<small>(N�mero de dias)');

define('EMPTY_CATEGORY', 'Categorias Vazia');

define('TEXT_HOW_TO_COPY', 'M�todo de C�pia:');
define('TEXT_COPY_AS_LINK', 'Lincar ao Produto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicar Produto');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Erro: N�o � poss�vel lincar produtos na mesma categoria.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erro: Diret�rio de figuras do Cat�logo protegido contra escrita: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erro: Diret�rio de figuras do Cat�logo n�o existe: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Erro: Categoria n�o pode ser movida para uma categoria filho.');
define('TEXT_PRODUCTS_QTY_BLOCKS', 'Qtde. min�ma p/ compra:');
define('TEXT_PRODUCTS_QTY_BLOCKS_INFO', '(S� informe a quantidade m�nima para restringir o usu�rio de comprar quantidades inferiores.)');


/*** Begin Header Tags SEO ***/
define('TEXT_PRODUCT_METTA_INFO', '<b>Informa��es para otimiza��o do seu site nas busca do Google, Yahoo e Bing (SEO)</b>');
define('TEXT_PRODUCTS_PAGE_TITLE', 'Titulo (SEO):');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Descri��o (SEO):');
define('TEXT_PRODUCTS_KEYWORDS', 'Palavras-chaves (SEO):');
/*** End Header Tags SEO ***/

define('TEXT_PRODUCT_FREE_SHIPPING', 'Sim');
define('TEXT_PRODUCT_NOT_FREE_SHIPPING', 'N�o');
define('TEXT_PRODUCTS_FREE_SHIPPING', 'Produto com frete gr�tis:');
?>