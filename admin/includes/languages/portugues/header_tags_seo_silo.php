<?php
/*
  $Id: header_tags_seo_silo.php,v 3.0 2009/10/10 14:07:36 hpdl Exp $
  Created by Jack_mcs from http://www.oscommerce-solution.com
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/

define('HEADING_TITLE_SILO', 'GOOGLE WEB TAGS - Controle do box');
define('HEADING_TITLE_SECTION_MAIN', 'Controle principal');
define('HEADING_TITLE_SECTION_LINKS', 'Controle de links');

define('SELECT_A_FILE', 'Selecione um arquivo');

define('TABLE_HEADING_CAT_NAME', 'Nome da Categoria');
define('TABLE_HEADING_BOX_TITLE', 'Título do Box');
define('TABLE_HEADING_MAX_LINKS', 'Máximo de links');
define('TABLE_HEADING_SORT_ORDER', 'Ordernar');

define('TEXT_PAGE_HEADING', 'Esta seção controla o numero de links em um Box no canto esquerdo quando estiver em uma categoria.
	   Existe um seção em <b>Header Tags configuration</b> que você pode habilitar esta opção. Esta opção faz com que uma técnica de SEO disponível
conhecido como "Siloing" e é usado nos círculos de SEO para aumentar a importância de uma página específica. Por ter mais links
apontando para uma página, os motores de busca ver essa página como mais importante. Isto, em teoria, vai ajudar com
todos os motores de busca, mas deve ser especialmente útil com googles sistema de ranking da página..<br><br>

Nenhuma das opções abaixo são necessários para usar isto. Enquanto a principal opção acima estiver habilitado, os valores padrão serão aplicadas. Mas cada categoria pode ser controlado individualmente.
Se você quiser apenas uma ou duas categorias para usar esta opção, marque a caixa desativar quando estiver "Selecionar todas as categorias" e clique em atualizar. Em seguida, selecione uma determinada categoria e configurá-lo. Todos, menos que uma categoria será desativado.');

define('SELECT_ALL_CATEGORIES', 'Selecionar todas as categorias');
define('TEXT_FILTER_LIST_CATEGORY', 'Categorias');

define('ENTRY_SELECT_A_PAGE', 'Selecionar uma página');
define('ENTRY_SILO_BOX_TITLE', 'Título do Boxe:');
define('ENTRY_SILO_DISABLE', 'Desabilitar');
define('ENTRY_SILO_NUMBER_LINKS', 'Número de links:');
define('ENTRY_SILO_SORT_BY', 'Ordernar por:');
define('ENTRY_SILO_SORT_BEST', 'Mais vendidos');
define('ENTRY_SILO_SORT_DATE', 'Data');
define('ENTRY_SILO_SORT_NAME', 'Nome');
define('ENTRY_SILO_SORT_CUSTOM', 'Personalizar');

define('ERROR_INCORRECT_MAX_LINKS', 'Erro - O número de links deve ser maior que 0 para  %s language.');
?>
