<?php
/*
	Id: create_news.php v1.0
		
	osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  
  Copyright (c) 2009 Nicholas Vergunst
*/

define('HEADING_TITLE_MAIN', 'Gerenciar Itens de Notícias ');
define('HEADING_TITLE_CREATE', 'Criando Novos Itens de Notícia');
define('HEADING_TITLE_UPDATE', 'Atualizando Itens de Notícias: ');
define('HEADING_TITLE_CONFIRM_DELETE', 'Confirmar Exclusão');

define('CREATE_NEWS_IMAGES', HTTP_SERVER . DIR_WS_ADMIN . DIR_WS_IMAGES . 'create_news/');
define('CREATE_NEWS_JS', HTTP_SERVER . DIR_WS_ADMIN . 'includes/javascript/create_news/');

define('CREATE_NEWS_ICON', CREATE_NEWS_IMAGES . 'create_news_icon.png');
define('CREATE_NEWS_IMAGE_SAVE_BUTTON', CREATE_NEWS_IMAGES . 'save.png');
define('CREATE_NEWS_IMAGE_CANCEL_BUTTON', CREATE_NEWS_IMAGES . 'cancel.png');
define('CREATE_NEWS_IMAGE_CREATE_BUTTON', CREATE_NEWS_IMAGES . 'create.png');
define('CREATE_NEWS_IMAGE_DELETE_BUTTON', CREATE_NEWS_IMAGES . 'delete.png');
define('CREATE_NEWS_IMAGE_EDIT_BUTTON', CREATE_NEWS_IMAGES . 'edit.png');
define('CREATE_NEWS_IMAGE_CONFIRM_DELETE_YES_BUTTON', CREATE_NEWS_IMAGES . 'confirm_yes.png');
define('CREATE_NEWS_IMAGE_CONFIRM_DELETE_NO_BUTTON', CREATE_NEWS_IMAGES . 'confirm_no.png');
define('CREATE_NEWS_IMAGE_FORM_DATA_DATE_CALENDAR_MAIN', CREATE_NEWS_IMAGES . 'calendar_main.gif');
define('CREATE_NEWS_IMAGE_FORM_DATA_DATE_CALENDAR_NEXT', CREATE_NEWS_IMAGES . 'calendar_next.gif');
define('CREATE_NEWS_IMAGE_FORM_DATA_DATE_CALENDAR_PREV', CREATE_NEWS_IMAGES . 'calendar_prev.gif');

define('CREATE_NEWS_TABLE_HEADING_DATE', 'Data');
define('CREATE_NEWS_TABLE_HEADING_UID', 'UID');
define('CREATE_NEWS_TABLE_HEADING_TITLE', 'Título');
define('CREATE_NEWS_TABLE_HEADING_ACTION', 'Ação');

define('CREATE_NEWS_TABLE_HEADING_EDIT_NAME', 'Títulos');
define('CREATE_NEWS_TABLE_HEADING_EDIT_VALUE', 'Valores');

define('CREATE_NEWS_TABLE_FORM_DATA_HEADING_TITLE', 'Título do artigo:');
define('CREATE_NEWS_TABLE_FORM_DATA_HEADING_SUBTITLE', 'Subtítulo do artigo:');
define('CREATE_NEWS_TABLE_FORM_DATA_HEADING_BODY', 'Corpo do artigo:');
define('CREATE_NEWS_TABLE_FORM_DATA_HEADING_DATE', 'Data do artigo:');

define('CREATE_NEWS_CONFIRM_DELETE_MESSAGE', 'Você tem certeza que deseja deletar esta notícia?');

?>