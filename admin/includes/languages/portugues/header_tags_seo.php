<?php
/*
  $Id: header_tags_seo.php,v 3.0 2008/01/10 14:07:36 hpdl Exp $
  Created by Jack_mcs from http://www.oscommerce-solution.com
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/
define('HEADING_TITLE', 'GOOGLE SEO - Configura��o');
define('HEADING_TITLE_AUTHOR', 'by Jack_mcs from <a href="http://www.oscommerce-solution.com/" target="_blank"><span style="font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px;">oscommerce-solution.com</span></a>');
define('HEADING_TITLE_FILL_TAGS', 'GOOGLE SEO TAGS - Preencher Tags');
define('HEADING_TITLE_FILL_TAGS_OPTIONS', 'Preencher Tags');
define('HEADING_TITLE_FILL_TAGS_OVERRIDES', 'Substituir Op��es');
define('HEADING_TITLE_SUPPORT_THREAD', '<a href="http://forums.oscommerce.com/topic/298099-header-tags-seo" target="_blank"><span style="color: sienna;">(visit the support thread)</span></a>');


define('TEXT_INFORMATION_PAGES', 'Se os checkboxes estiverem marcados, as tags padrao (mostrados a direita) ser�o adcicionados ao que foi digitado.');
define('TEXT_INFORMATION_DEFAULT', 'As op��es desta coluna s�o padr�o para todas as pagianas. O texto informado e os iten selecionados aqui aparecer� em cada pagian que o Google SEO estiver habilitado.');
define('TEXT_INFORMATION_DELETE_PAGE', '<b>Delete a New Page</b> - This option will remove the code for a page from the
above files.'); 
define('TEXT_INFORMATION_CHECK_PAGES', '<b>Verificar pagina que n�o possui as configura��es do Google SEO</b> - Esta op��o permite que voc� verifique quais arquivos em sua loja n�o tem as fun��es abaixo. Observe que n�o � toda pagina que deve ter essas fun��es. Por exemplo qualquer pagina que usar� SSL como login ou Cria��o de conta. Para ver as paginas, clique em UPDATE(Atualizar) e ent�o selecione no combobox.'); 

define('TEXT_PAGE_TAGS', 'Esta p�gina permite a cria��o de todas as p�ginas em uma loja. Para que
esta se��o para trabalhar em uma p�gina, a p�gina deve ter o cabe�alho c�digo Tags instalado. Veja o Install_Catalog.txt
arquivo para obter instru��es sobre como fazer isso. Uma vez que o c�digo foi adicionado, as seguintes op��es permitir�o
da sua cria��o e aplica��o de qualquer uma das op��es que lhe s�o aplic�veis.
');

define('TEXT_FILL_TAGS', 'Esta se��o permite que a meta tags adicionadas por Header Tags SEO para ser preenchido.
As op��es Override permite alterar a forma como as metatags s�o preenchidos.');

define('TEXT_EXPLAIN_DESC', '<p> A se��o superior determina como as tags meta descri��o s�o preenchidos. Se "Sim" ent�o a descri��o meta tag ser� preenchido com a descri��o do produto. Se um n�mero �
introduzido na caixa de comprimento, a descri��o ser� truncado para o comprimento. Se "N�o" � escolhido, ent�o o
t�tulo de produtos � utilizado para a descri��o tag. </p>
<p> A se��o central determina como as palavras estejam preenchidas Selecionando "Sim" far� com que o c�digo para tentar
gerar as palavras-chave do texto em cada uma das p�ginas que foram adicionadas ao cabe�alho Tags (veja a p�gina de controle
se��o para saber como fazer isso). Selecionar "N�o" ir� fazer com que sejam criados a partir do t�tulo do produto no
banco de dados. </ p>
<p> A parte inferior permite que os itens selecionados para ser preenchido para todos os itens (categorias, fabricantes e produtos).
Sempre que o texto cont�m as palavras especiais ItemName ou UPPER_ITEMNAME, aquelas palavras especiais ser� substitu�do
pelas categorias, os fabricantes ou o nome do produto. ItemName vai usar o texto como ele aparece no banco de dados
enquanto UPPER_ITEMNAME ir� convert�-lo para letras mai�sculas. Para poder utilizar esta se��o, voc� deve clicar
na principal op��o Ativar. Isso far� com que todas as caixas de sele��o individual se torne habilitado. Cada indiv�duo
campo pode ser ativado / desativado pelo caixa ao lado da caixa de texto. Ap�s as caixas de sele��o s�o verificados e as
o texto � inserido como voc� gosta, selecione as op��es de preenchimento Tags no fundo e, em seguida, clique em Atualizar.
</p>
');

define('TEXT_EXPLAIN_FILLTAGS', 'Esta se��o � usada para preencher o t�tulo e meta tags diferentes
para as categorias, fabricantes e produtos em sua loja. Selecione a configura��o adequada para as categorias,
fabricantes e marcas de produtos e, em seguida, clique em Atualizar. Se voc� selecionar a preencher apenas tags vazias, em seguida, as marcas j�
preenchido n�o ser�o substitu�dos. Se o acima "palavra-chave override" op��o for selecionada, ent�o a meta palavras-chave
tags ser�o preenchidas a partir das p�ginas reais da loja <br> <br> <span style="font-weight: bold;">. Nota: </ span> As op��es
Nesta p�gina n�o s�o defini��es. Se voc� deixar esta p�gina e voltar, as op��es nesta p�gina ir� reverter para a
configura��es padr�o. Isso afeta apenas esta p�gina n�o, as altera��es feitas no banco de dados.');

define('TEXT_EXPLAIN_POPUP', 'explicar');

// header_tags_seo.php
define('HEADING_TITLE_SEO_DELETE', 'Deletar:');
define('HEADING_TITLE_SEO_EXPLAIN', '(Explicar)');
define('HEADING_TITLE_SEO_TITLE', 'T�tulo:');
define('HEADING_TITLE_SEO_DESCRIPTION', 'Descri��o:');
define('HEADING_TITLE_SEO_KEYWORDS', 'Palavras Chave(s):');
define('HEADING_TITLE_SEO_LOGO', 'Texto da logomarca:');
define('HEADING_TITLE_SEO_OPTIONS', 'Incluir:');
define('HEADING_TITLE_SEO_PAGENAME', 'Selecione uma op��o:');
define('HEADING_TITLE_SEO_PAGENAME_ERROR', 'Nome da p�gina j� est� informada -> ');
define('HEADING_TITLE_SEO_PAGENAME_INVALID_ERROR', 'Page name is invalid Nome da p�gina esta invalido -> ');
define('HEADING_TITLE_SEO_NO_DELETE_ERROR', 'Excluir %s n�o � permitida');
define('HEADING_TITLE_SEO_VIEW_RESULT', 'Ver resultado:');
define('HEADING_TITLE_TEST', 'Testar a instala��o');

define('HEADING_TITLE_SEO_DEFAULT_TAGS', 'Tags padr�o');
define('HEADING_TITLE_SEO_DEFAULT_META_TAGS', 'Meta Tags');
define('HEADING_TITLE_SEO_DEFAULT_DESCRIPTION', 'Descri��o padr�o:');
define('HEADING_TITLE_SEO_DEFAULT_KEYWORDS', 'Palavras chave(s) padr�o:');
define('HEADING_TITLE_SEO_DEFAULT_LOGO', 'Texto da logomarca');

define('HEADING_TITLE_SEO_PSEUDO', 'Adicionar uma p�gina de Pseudo:');

// header_tags_fill_tags.php
define('HEADING_TITLE_SEO_CATEGORIES', 'CATEGORIAS');
define('HEADING_TITLE_SEO_MANUFACTURERS', 'FABRICANTES');
define('HEADING_TITLE_SEO_PRODUCTS', 'PRODUTOS');
define('HEADING_TITLE_SEO_SKIPALL', 'Passar todas as tags');
define('HEADING_TITLE_SEO_FILLONLY', 'Preencha apenas tags vazias');
define('HEADING_TITLE_SEO_FILLALL', 'Preencha todas as tags vazias');
define('HEADING_TITLE_SEO_CLEARALL', 'Limpar todas as tags');
define('HEADING_TITLE_SEO_SHOW_MISSING_TAGS', 'Mostrar Tags faltando');
define('HEADING_TITLE_SEO_INCLUDE_MISSING_DESCRIPTION', 'Incluir descri��es na busca '); //Include Missing Descriptions in search

define('TEXT_COMMON_PROBLEMS_HEADING', 'Problemas comuns');
$commonQuestionsArray = array();
$commonQuestionsArray[] = array('Q' => 'Header Tags funciona em todas as minhas p�ginas com exce��o de um. O que eu fa�o?',
                                'A' => 'Replace the file for that page with the one from the contribution. If it works, then use a program like WinMerge to compare the two files.');
$commonQuestionsArray[] = array('Q' => 'Why do the titles and tags show in admin but not on the shop?',
                                'A' => 'Either the head code change for the files in the shop is missing or the includes/header_tags.php file is at fault. The latter can be replaced with the one from the contribution.');
$commonQuestionsArray[] = array('Q' => 'Why is the alignment of my page incorrect after installing Header Tags?',
                                'A' => 'You\'ve made a mistake in the installation. Try using the file of the same name from the contribution to see if the problem goes away. If it does, then use a program like WinMerge to compare the two to find your mistake.');
$commonQuestionsArray[] = array('Q' => 'Why aren\'t my urls working correctly?', 
                                'A' => 'Header Tags doesn\'t change the url\'s unless that option in Ultimate SEO is used. You need to ask in the support thread for the contribution you are using to handle your url\'s.');
$commonQuestionsArray[] = array('Q' => 'Why do I get a failure when Header Tags is used with Ultimate seo urls 5?',
                                'A' => 'That contribution isn\'t coded in a standard oscommerce way. There is a setting in it to allow the code to work correctly.');
$commonQuestionsArray[] = array('Q' => 'Why are my categories or products missing titles or meta tag information?',
                                'A' => 'You need to run Fill Tags to setup up the titles and meta tags or edit them manually in the catalog section.');
$commonQuestionsArray[] = array('Q' => 'Why do I get "error message appears on top "Warning: implode() [function.implode]: Invalid arguments passed"?',
                                'A' => 'You need to run Fill Tags.');
$commonQuestionsArray[] = array('Q' => 'Why is php code now appearing on my page?',
                                'A' => 'You overwrote or missed a php delimiter. Use the file in the contribution package by the same name and a program like WinMerge to find the mistake.');
$commonQuestionsArray[] = array('Q' => 'Why aren\'t the Social Bookmarks showing?',
                                'A' => 'You need to enable that option in admin->Header Tags SEO.');
$commonQuestionsArray[] = array('Q' => 'Does the Header Tags code that goes in the head section have to be added to every page?',
                                'A' => 'It should be in every page that you want to show up well in the search engine listings. However, if you are using BTS or STS, it should not be in any of them, as explained in the installation instructions.');
$commonQuestionsArray[] = array('Q' => 'Why don\'t the settings stay set in Fill Tags?',
                                'A' => 'As the text beside Fill Tags states, those are not settings. They will reset each time Fill Tags is loaded.');
 

define('TEXT_CHARACTERS', 'caracteres.');
define('TEXT_CLOSE_POPUP', 'Fechar esta Janela');
define('TEXT_FILL_CATEGORIES_CLEAR', 'Todas %s tags das categorias foram limpadas.');
define('TEXT_FILL_CATEGORIES_EMPTY', '%s tags de categorias vazias foram preenchidos.');
define('TEXT_FILL_CATEGORIES_FULL', '%s tags de categoria foram preenchidos.');
define('TEXT_FILL_KEYWORDS_FROM_SHOP', ' Preencher palavras-chave para todas as p�ginas adicionadas a partir de palavras-chave produzidos em suas p�ginas?');
define('TEXT_FILL_WITH_DESCIPTION', 'Preencher descri��o <meta> produtos com descri��o?');
define('TEXT_FILL_KEYWORDS_WITH_GENERIC', 'Verifique para preencher o t�tulo e tags com as palavras gen�ricas.');
define('TEXT_FILL_GENERIC_TITLE', 'T�tulo:');
define('TEXT_FILL_GENERIC_META_DESC', 'Descri��o:');
define('TEXT_FILL_GENERIC_KEYWORDS', 'Palavras-chaves:');
define('TEXT_FILL_GENERIC_DESCRIPTION', 'Descri��o: (p�gina)');
define('TEXT_FILL_GENERIC_SECTION_CATEGORIES', 'Categorias');
define('TEXT_FILL_GENERIC_SECTION_MANUFACTURERS', 'Fabrincantes');
define('TEXT_FILL_GENERIC_SECTION_PRODUCTS', 'Produtos');
define('TEXT_FILL_MANUFACTURERS_CLEAR', 'Todas %s as tags de fabricantes foram limpadas.');
define('TEXT_FILL_MANUFACTURERS_EMPTY', '%s Empty Manufacturer tags have been filled.');
define('TEXT_FILL_MANUFACTURERS_FULL', '%s Manufacturer tags have been filled.');
define('TEXT_FILL_PRODUCTS_CLEAR', 'All %s Product tags have been cleared.');
define('TEXT_FILL_PRODUCTS_EMPTY', '%s Empty Product tags have been filled.');
define('TEXT_FILL_PRODUCTS_FULL', '%s Product tags have been filled.');
define('TEXT_FILTER_LIST_CATEGORY', 'Filtrar por categorias');
define('TEXT_FILTER_LIST_MULTI', '(OBS: Esta lista permite multipla sele��o.)');
define('TEXT_FILTER_LIST_SELECT_ALL', 'Selecionar tudo');
define('TEXT_GENERIC_TITLE', 'ITEMNAME is a great product ');
define('TEXT_GENERIC_DESC', 'We sell ITEMNAME in an quantity ');
define('TEXT_GENERIC_KEYWORDS', 'ITEMNAME, ITEMNAME computer, ITEMNAME dresses ');
define('TEXT_GENERIC_DESCRIPTION', 'UPPER_ITEMNAME is one of our best categories. There are many types of ITEMNAME\'s in the ITEMNAME category. ');
define('TEXT_LANGUAGE', 'L�ngua:');
define('TEXT_LIMIT_TO', 'Limite para');
define('TEXT_NO', 'N�o');
define('TEXT_YES', 'Sim');
define('SELECT_A_FILE', 'Selecione um arquivo');
define('SHOW_ALL_FILES', 'Mostrar todos os arquivos');
define('ADD_MISSING_PAGES', 'Adicionar paginas que faltam');
define('TEXT_MISSING_TAGS', 'Tags que faltam');
define('TEXT_MISSING_VERSION_CHECKER', 'Version Checker is not installed. See <a href="http://addons.oscommerce.com/info/7148" target="_blank">here</a> for details.');
define('TEXT_TEXT_INFORMATION', '<p>Use this page to run a test on your installation of Header Tags SEO. If any
recognizable problems are found, they will be listed. The only error that may show up and which can, maybe, 
be ignored, is the permissions settings (see the note in the install files regarding this error). Also, this 
test is mainly meant for a standard osCommerce shop. BTS and STS based shops may, or may not, see errors that 
apply to them.</p>
');
define('TEST_FILE_NOTIN_DB', 'Files not in the database:');
define('TEST_FILE_NOTIN_FILE', 'Files not in the includes/header_tags.php file:');
define('TEST_RESULTS_HEADING', 'Test Results');
define('TEXT_OVERRIDE_DESCRIPTION', 'Description Override');
define('TEXT_OVERRIDE_KEYWORDS', 'Keywords Override');
define('TEXT_OVERRIDE_GENERIC', 'Generic Override');
define('TEXT_PSEUDO_PAGE_NAME', 'Page Name:');
define('TEXT_PSEUDO_PAGE_NAME_NOTE', 'The page name must be entered as it appears on the page, with the root page 
included. For example, if Articles Manager is installed, the root page for articles is article_info.php. The 
additional articles would have an ID, like articles_id=2. So to add such a page, you would enter article_info.php?articles_id=2.<br><br>
<span style="color: red;">Note: </span>Add Missing Pages <b>Must</b> be ran prior to using this option to ensure the 
root file is present.');
define('TEXT_SHOW_LIMIT_MESSAGES', 'Show Limit Warnings.');

define('OPTION_SELECT_ALL', 'Selecionar Tudo:');
define('OPTION_INCL_TITLE', 'T�tulo padr�o');
define('OPTION_INCL_DESC', 'Descri��o padr�o');
define('OPTION_INCL_KEYWORDS', 'Palavra Chave padr�o:');
define('OPTION_INCL_LOGO', 'Logo Padr�o:');
define('OPTION_INCL_CATEGORY', 'Categoria:');
define('OPTION_INCL_ROOT', 'Root:');
define('OPTION_INCL_MANUFACTURER', 'Fabricante:');
define('OPTION_INCL_PRODUCT', 'Produto:');
define('OPTION_INCL_GROUP', 'Grupo:');
define('OPTION_META_GOOGLE', 'Google');
define('OPTION_META_LANGUAGE', 'Lingua');
define('OPTION_META_NOODP', 'NOODP');
define('OPTION_META_NOYDIR', 'NOYDIR');
define('OPTION_META_REPLYTO', 'Responder para');
define('OPTION_META_REVISIT', 'Revisitar');
define('OPTION_META_ROBOTS', 'Robots');
define('OPTION_META_UNSPAM', 'UnSpam');
define('OPTION_META_CANONICAL', 'Can�nico');

define('POPUP_COMMON_DELETE', ' Deletar todas as entras para esta p�gina ');
define('POPUP_COMMON_TITLE', ' T�tulo de texto para esta p�gina. Pode variar dependendo das op��es');
define('POPUP_COMMON_DESC', ' Meta texto de descri��o para essa p�gina. Pode variar dependendo das op��es ');  
define('POPUP_COMMON_KYWRDS', ' Meta Keywords(Palavra chave) texto para esta p�gina. Pode variar dependendo das op��es ');  
define('POPUP_COMMON_KYWRDS_LIVE', ' Use Keywords(Palavra chave) do texto na p�gina atual ');
define('POPUP_COMMON_LOGO', ' Alt texto tag para a imagem do logotipo desta p�gina. Pode variar dependendo das op��es ');  
define('POPUP_COMMON_LOGO_EXTRA', ' Abrir a janela para digitar o texto tag alt para imagens logo adicionais sobre esta p�gina. ');
define('POPUP_COMMON_VIEW', ' Ver como o t�tulo e meta tags realmente aparecer no site ');
define('POPUP_COMMON_VIEW_TITLE_A', ' T�tulo realmente sobre esta p�gina. Amarelo = Encontrado, Red = N�o encontrados ');
define('POPUP_COMMON_VIEW_TITLE_B', ' T�tulo em que aparece nesta p�gina on-line e para os motores de busca ');
define('POPUP_COMMON_VIEW_DESC_A', ' Descri��o realmente sobre esta p�gina. Amarelo = Encontrado, Red = N�o encontrados ');
define('POPUP_COMMON_VIEW_DESC_B', ' Descri��o tal como aparece nesta p�gina on-line e para os motores de busca ');
define('POPUP_COMMON_VIEW_KEYWORDS_A', ' Palavras-chave realmente sobre esta p�gina. Amarelo = Encontrado, Red = N�o encontrados ');
define('POPUP_COMMON_VIEW_KEYWORDS_B', ' Palavras-chave que aparecem nesta p�gina online e aos motores da busca ');
define('POPUP_COMMON_PSEUDO_ADD', ' Adicionar uma p�gina pseudo - veja as instru��es acima. ');
define('POPUP_DEFAULT_ALL', ' Incluir todas as op��es no texto logo ');  
define('POPUP_DEFAULT_CAT', ' Inclua o nome da categoria no texto logo ');  
define('POPUP_DEFAULT_MANU', ' Incluir o nome do fabricante no texto logotipo ');  
define('POPUP_DEFAULT_PROD', ' Incluir o nome do produto no texto logo ');  
define('POPUP_DEFAULT_TITLE', ' Texto padr�o para todas as p�ginas do t�tulo. Pode variar dependendo das op��es ');
define('POPUP_DEFAULT_DESC', ' Texto padr�o de descri��o Meta para todas as p�ginas. Pode variar dependendo das op��es ');  
define('POPUP_DEFAULT_KYWRDS', ' Meta Keywords texto padr�o para todas as p�ginas. Pode variar dependendo das op��es ');  
define('POPUP_DEFAULT_LOGO', ' Texto padr�o tag Alt para a imagem do logotipo em todas as p�ginas. Pode variar dependendo das op��es '); 
define('POPUP_FILTAGS_CLEAR', 'Limpar todas as Tags nesta se��o. '); 
define('POPUP_FILTAGS_DESC_YES', ' Use a descri��o do produto para preencher a descri��o meta tag. '); 
define('POPUP_FILTAGS_DESC_NO', ' Use o t�tulo do produto para preencher a descri��o meta tag. '); 
define('POPUP_FILTAGS_KEYWORDS_YES', ' Use as palavras derivadas a partir das p�ginas reais. '); 
define('POPUP_FILTAGS_KEYWORDS_NO', ' Use palavras-chave constru�da nas p�ginas do produto. '); 
define('POPUP_FILTAGS_SIZE', ' Se a op��o definida para yes, quanto a descri��o do produto deve ser usado. '); 
define('POPUP_FILTAGS_FULL', ' Preencha todas as Tags nesta se��o. '); 
define('POPUP_FILTAGS_EMPTY', ' Apenas preencha tags vazias nesta se��o. '); 
define('POPUP_FILTAGS_SKIPALL', ' N�o preencher qualquer tags nesta se��o. '); 
define('POPUP_FILTAGS_SHOW_MISSING_TAGS', ' Exibir uma lista de desaparecidos meta tags. ');
define('POPUP_FILTAGS_INCLUDE_MISSING_DESCRIPTION', ' Confira a descri��o deste item. ');
define('POPUP_METATAGS_GOOGLE', ' Controle como o Google indexa seu site. Padr�es para todas as p�ginas - todas as liga��es. '); 
define('POPUP_METATAGS_LANG', ' Informa o site motores de busca que a l�ngua se destina. '); 
define('POPUP_METATAGS_NOODP', ' Informa todos os motores de busca para usar a sua descri��o, em vez de DMoz\'s. '); 
define('POPUP_METATAGS_NOYDIR', ' Yahoo diz para usar a sua descri��o, em vez de DMoz\'s.  '); 
define('POPUP_METATAGS_REPLY', ' Lista o endere�o de email lojas. N�o recomendado para a maioria das lojas  '); 
define('POPUP_METATAGS_REVIST', ' Informa os motores de busca para revisitar seu site ap�s um determinado per�odo. '); 
define('POPUP_METATAGS_ROBOTS', ' Controlar a forma como todos os motores de busca indexar o seu site. Padr�es para todas as p�ginas - todas as liga��es. '); 
define('POPUP_METATAGS_UNSPAM', ' Tenta impedir que os motores de busca colher endere�os de e-mail. '); 
define('POPUP_METATAGS_CANONICAL', ' Adiciona uma tag meta Canonical para todas as p�ginas que precisam, exceto aqueles j� tratados nas categorias e produtos. '); 
define('POPUP_OPTION_TITLE', ' Incluir t�tulo do padr�o ');
define('POPUP_OPTION_DESC', ' Incluir a descri��o do padr�o ');  
define('POPUP_OPTION_KYWRDS', ' Inclua o padr�o palavras-chave ');  
define('POPUP_OPTION_LOGO', ' Incluir o texto logo padr�o ');
define('POPUP_OPTION_CAT', ' Inclua o nome da categoria ');  
define('POPUP_OPTION_MANU', ' Incluir o nome do fabricante ');
define('POPUP_OPTION_PROD', ' Incluir o t�tulo do produto e as marcas se for o caso ');
define('POPUP_OPTION_ROOT', ' Incluir o t�tulo da raiz e tags (em caixas acima) ');
define('POPUP_OPTION_CHECKBOX_TITLE', ' Ativar / desativar o t�tulo do padr�o ');
define('POPUP_OPTION_CHECKBOX_DESC', ' Activar / Desactivar a descri��o do padr�o ');  
define('POPUP_OPTION_CHECKBOX_KYWRDS', ' Activar / Desactivar palavras-chave padr�o ');  
define('POPUP_OPTION_CHECKBOX_LOGO', ' Activar / Desactivar o texto logotipo padr�o ');
define('POPUP_OPTION_CHECKBOX_CAT', ' Activar / Desactivar o nome da categoria ');  
define('POPUP_OPTION_CHECKBOX_MANU', ' Activar / Desactivar o nome do fabricante ');
define('POPUP_OPTION_CHECKBOX_PROD', ' Activar / Desactivar o nome do produto');
define('POPUP_OPTION_CHECKBOX_ROOT', ' Activar / Desactivar o t�tulo de raiz e tags (em caixas acima) ');
define('POPUP_OPTION_SORT_TITLE', ' Defina a ordena��o do t�tulo padr�o ');
define('POPUP_OPTION_SORT_DESC', ' Defina a ordem de classifica��o da descri��o padr�o');  
define('POPUP_OPTION_SORT_KYWRDS', ' Defina a ordem de classifica��o do padr�o de palavras-chave ');  
define('POPUP_OPTION_SORT_LOGO', ' Defina a ordem de classifica��o do texto do logotipo padr�o ');
define('POPUP_OPTION_SORT_CAT', ' Defina a ordem de classifica��o do nome da categoria ');  
define('POPUP_OPTION_SORT_MANU', ' Defina a ordem de classifica��o do nome do fabricante');
define('POPUP_OPTION_SORT_PROD', ' Defina a ordem de classifica��o do nome do produto');
define('POPUP_OPTION_SORT_ROOT', ' Defina a ordem de classifica��o do t�tulo raiz e tags (em caixas acima) ');
    
define('FIRST_PAGE_ENTRY', '3');

define('ERROR_HEADING_COUNT_MISMATCH', '<b>Banco de Dados/Erro de arquivo incompat�vel:</b>');
define('ERROR_HEADING_DATABASE', '<b>Erro no banco de dados:</b>');
define('ERROR_HEADING_DESCRIPTION_LENGTH', '<b>Meta Description length warning:  (Suggested range is 15 to 300 characters)</b>');
define('ERROR_HEADING_DEFAULT_ROOT_TEXT_PRESENT', '<b>Default Text Present:</b>');
define('ERROR_HEADING_DUPLICATE_TITLE', '<b>Duplicate title found:</b>');
define('ERROR_HEADING_DUPLICATE_META_DESCRIPTION', '<b>Duplicate meta description found:</b>');
define('ERROR_HEADING_EXTRA_FILE', '<b>Extra File Error:</b>');
define('ERROR_HEADING_LANGUAGE_MISMATCH', '<b>Language Mismatch Error:</b>');
define('ERROR_HEADING_MISSING_CODE', '<b>Missing Code in File</b>');
define('ERROR_HEADING_MISSING_FILE', '<b>Missing File Error:</b>');
define('ERROR_HEADING_MISSING_TAGS', '<b>Missing Title and/or descriptions:</b>');
define('ERROR_HEADING_PERMISSIONS', '<b>Permissions Error:</b>');
define('ERROR_HEADING_SEARCH_ENGINE_OPTION', '<b>Option Error:</b>');
define('ERROR_HEADING_STS', '<b>STS Error:</b>');
define('ERROR_HEADING_TEMPLATE', '<b>CRE or oscMax Error:</b>');
define('ERROR_HEADING_TITLE_LENGTH', '<b>Title length warning: (Suggested range is 60 to 120 characters)</b>');

define('ERROR_CANT_CHMOD', 'N�o � possivel mudar a permiss�o em %s');
define('ERROR_COUNT_MISMATCH', 'The number of file entries in the database (%s) does not match the number in the includes/header_tags.php file (%s).');
define('ERROR_DEFAULT_ROOT_TEXT_PRESENT', 'The default root text, %s, should be removed or changed for %s with language ID of %d.');
define('ERROR_DESCRIPTION_LENGTH_SHORT', 'The Meta Description for %s may be too short. It is %s characters long.');
define('ERROR_DESCRIPTION_LENGTH_LONG', 'The Meta Description for %s may be too long. It is %s characters long.');
define('ERROR_DUPLICATE_PAGE', 'An entry for the page %s already exists.');
define('ERROR_DUPLICATE_SORT_ORDER', 'Duplicate sort orders are not allowed -> %s');
define('ERROR_DUPLICATE_TITLE_LANGUAGE', '<b>for %s</b>');
define('ERROR_DUPLICATE_TITLE_META_DESCRIPTION', '%s exists more than once.');
define('ERROR_EXTRA_FILE', 'The %s file is present and should be removed.');
define('ERROR_FILL_TAGS_CATEGORIES', '&nbsp; Error: Category with ID of %s and language ID of %s is missing a name');
define('ERROR_FILL_TAGS_MANUFACTURERS', '&nbsp; Error: Manufacturer with ID of %s and language ID of %s is missing a name');
define('ERROR_FILL_TAGS_PRODUCTS', '&nbsp; Error: Product with ID of %s and language ID of %s is missing a name');

define('ERROR_EXPLAIN_COUNT_MISMATCH', 'Header Tags makes an entry in the database for each page and a 
corresponding entry in the includes/header_tags.php file. This error is saying those counts do not match. If
the database contains more entries than the file, an option is provided to delete those entries. If the 
file contains more entries than the database, then replace the file and choose the Add Missing Pages in Page Control.');
define('ERROR_EXPLAIN_DATABASE', 'The indicated table cannot be found in the database. Run the headertags_seo_uninstall.php
and then the headertags_seo_install.php to repair the database.');
define('ERROR_EXPLAIN_DESCRIPTION_LENGTH', 'Google will give warnings if they deem the meta description tag is too short or
too long. However, they do not say how long it should be. The general accepted notion is that it should be somewhere
between 15 and 300 characters, but what the description says plays a part in that too.');
define('ERROR_EXPLAIN_DEFAULT_ROOT_TEXT_PRESENT', 'Header Tags installs with some sample text. If that is left in,
it will have a negative affect on your pages. This error says that the text was found and needs to be removed.');
define('ERROR_EXPLAIN_DUPLICATE_TITLE', 'Google will issue a warning if the title of two pages are the same. If possible,
the titles of all items should be unique.');
define('ERROR_EXPLAIN_DUPLICATE_META_DESCRIPTION', 'Google will issue a warning if the meta description of two pages 
are the same. If possible, that description should be unique.');
define('ERROR_EXPLAIN_EXTRA_FILE', 'The indicated file(s) should not be present on the server during normal operation
so they should be deleted.');
define('ERROR_EXPLAIN_LANGUAGE_MISMATCH', 'This means that an entry in the Header Tags tables is for a certain language
that does not exist in the shops declared languages or vice versa.');
define('ERROR_EXPLAIN_MISSING_CODE', 'The code required for Header Tags to work properly is missing from the indicated file(s).
See the Install_Catalog.txt file for what should be added.');
define('ERROR_EXPLAIN_MISSING_FILE', 'A file required by Header Tags to function properly cannot be found. The file 
needs to be uploaded from the contribution package.');
define('ERROR_EXPLAIN_MISSING_TAGS', 'The title or description is missing from the indicated file(s).');
define('ERROR_EXPLAIN_PERMISSIONS', 'The permissions settings on the includes/header_tags.php file are incorrect.
The code will try to determine the proper setting but they should typically match the ones on the images directory.
If that does not clear the error, then you will need to ask your host for the proper settings. However, if your
site is on a Windows server, which includes home computers, the error can be disregarded. Just make sure the 
setting on that file allow it to be written to.');
define('ERROR_EXPLAIN_SEARCH_ENGINE_OPTION', 'This error says the admin->configuration->My Store0>Search Engine Friendly 
option is turned on. It should always be disabled, whether Header Tags is installed or not.');
define('ERROR_EXPLAIN_STS', 'STS is installed but the Header Tags code is not setup properly.');
define('ERROR_EXPLAIN_TEMPLATE', 'The code has detected that either CRE or oscMax is installed but the Header Tags
code has not been added properly. See the Install_Catalog.txt file for instructions on how to do that.');
define('ERROR_EXPLAIN_TITLE_LENGTH', 'Google will issue a warning if the title of two pages are the same. If possible,
the titles of all items should be unique. The suggested range is 60 to 120 characters. Anything over 120 is generally
truncates so it serves little purpose to have such long titles.');

define('ERROR_FAILED_NO_KEYWORDS_FOUND', '*** Nenhuma palavra chave foi encontrada nesta p�gina: %s');
define('ERROR_FAILED_PAGE_LOAD', 'Erro para carregar pagina do Loja: %s');
define('ERROR_FAILED_WORDS', 'Erro para carregar palavras do arquivo SEO: %s');
define('ERROR_FAILED_DIR_OPEN', 'Erro ao abrir diretorio: %s');
define('ERROR_FAILED_FILE_OPEN', 'Erro ao abrir arquivo: %s<br>');
define('ERROR_FAILED_FILE_WRITE', 'Erro ao escrever no arquivo: %s<br>');
define('ERROR_INVALID_DELETION', 'A supens�o de %s n�o esta permitida');
define('ERROR_INVALID_FILENAME', 'Pagina n�o adicionada - nome do arquivo invalido %s');
define('ERROR_INVALID_PSEUDO_FORMAT', 'Entered pseudo page format, %s, is incorrect.');
define('ERROR_INVALID_PSEUDO_PAGE', 'The base file entered, %s, does not support pseudo pages.');
define('ERROR_LANGUAGE_MISMATCH_DB', 'Language %s (%d) in the shops languages does not have an entry in the default Header Tags table.');
define('ERROR_LANGUAGE_MISMATCH_HT', 'Language ID %d in default Header Tags table does not exist in the shops languages.');
define('ERROR_MISSING_CODE', 'The Header Tags head code for the %s file cannot be found.');
define('ERROR_MISSING_CONFIGURATION', 'The Header Tags entries are missing from the configuration table.');
define('ERROR_MISSING_CONFIGURATION_GROUP', 'The Header Tags entry is missing from the configuration group table.');
define('ERROR_MISSING_DATABASE', 'The %s table cannot be found in the database.');
define('ERROR_MISSING_DATABASE_FIELD', 'The %s field cannot be found in the %s table.');
define('ERROR_MISSING_FILE', 'N�o pode encontrar o arquivo %s.');
define('ERROR_MISSING_SORT_ORDER', 'Missing sort orders are not allowed -> %s');
define('ERROR_MISSING_STS_FILE', 'Required module entry, headertags.php, for STS not found.');
define('ERROR_MISSING_TAGS', 'Foi encontrado produto, categorias ou fabricantes sem o preenchimento das TAGS:<br>');
define('ERROR_MISSING_TAGS_TYPE', 'A tabela %s tem %d item sem as informa��es de TAGS.');
define('ERROR_NO_NAME', 'O nome para este item esta faltando');
define('ERROR_NOT_USING_HEADER_TAGS', 'O arquivo %s n�o esta sendo usado nas Tags de cabe�alho.');
define('ERROR_SEARCH_ENGINE_OPTION', 'The Search Engine Friendly option is set. This should be disabled since it can cause various problems.');
define('ERROR_STS_EXTRA_CODE', 'STS is running and the head code in the %s file has Header Tags code installed, which is a mistake.');
define('ERROR_TEMPLATE_EXTRA_CODE', 'CRE or oscMax is running and the head code in the %s file has Header Tags code installed, which is a mistake.');
define('ERROR_TITLE_LENGTH_SHORT', 'The Title for %s may be too short. It is %s characters long.');
define('ERROR_TITLE_LENGTH_LONG', 'The Title for %s may be too long. It is %s characters long.');
define('ERROR_WRONG_PERMISSIONS', 'Permissions settings for the %s file appear to be incorrect. Change to %s. <span style="font-weight: bold; color: red;">NOTE: Disregard if on Windows server.</span>');

define('IMAGE_ADD', 'Adicionar');
?>
