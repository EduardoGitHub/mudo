<?php
/*
  $Id: monitor.php,v 1.2 2004/01/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Contribution by wdo (waldosoc@yahoo.com.mx)

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Históricos de Clientes');

//CABECERAS
define('TABLE_HEADING_PAGE', 'Página');
define('TABLE_HEADING_CUSTOMER', 'Cliente');
define('TABLE_HEADING_COMPANY', 'Empresa');
define('TABLE_HEADING_IP', 'IP');
define('TABLE_HEADING_USER_AGENT', 'User Agent');
define('TABLE_HEADING_COMMENTS', 'Histórico');
define('TABLE_HEADING_DATE', 'Data');
define('TABLE_HEADING_TIME', 'Hora');
define('TABLE_HEADING_CC_DATE', 'Data');
define('TABLE_HEADING_ACTION', 'Ação');

//COLUMNAS
define('NO_REGISTERED_USER_NAME', 'Visitante');
define('NO_REGISTERED_USER_COMPANY', '-');
define('CATEGORY_TEXT', tep_image(DIR_WS_ICONS.'folder.gif').' ');
//define('PRODUCT_TEXT', tep_image(DIR_WS_ICONS.'box.gif').' ');
define('PRODUCT_TEXT', '');
define('TEXT_ALT_ORDER_ASC', 'Crescente');
define('TEXT_ALT_ORDER_DESC', 'Decrescente');
define ('TEXT_SHOWING','Mostrando de <b>%d</b> até <b>%d</b> de um total de <b>%d</b>');
define ('TEXT_NO_REGISTERS_IN_DB','<font color="red">Nenhum registro até o momento</font>');
define ('TEXT_SHOW_ALL_REGISTERS','<font color="blue">Todos</font>');

//BACKUP
define('TEXT_INFO_HEADING_BACKUP', 'Move information to a Backup');
define('TEXT_BACKUP_TAB', 'Dump database');
define('TEXT_DELETE_ALL_TAB', 'Delete all registers');
define('TEXT_INFO_BACKUP', 'Do not interrupt the backup process which might take a couple of minutes.');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Best through a HTTPS connection');
define('TEXT_DEL_ALL_REGISTERS', 'Delete all registers');

//ACCIONES
define('TEXT_DELETE_INTRO', 'Tem certeza que quer eliminar este registro?');
define('TEXT_DELETE_BACKUP', 'Are you sure you want to generate a Backup?');
define('TEXT_DELETE_ALL', 'Tem certeza que quer eliminar TODOS os registros?');
define('TEXT_SELECTED_BACKUP', 'Copy the selected text (CTRL + C),\\npaste it in any editor\\nand save it as:\\n\\n   backup'.date("Y_m_d_H-m").'.sql');
define('TEXT_INTRO_BACKUP', '* Backup generated correctly:');
define('TEXT_NO_ORDER_ALERT', 'There is not a valid order to this register');
define('TEXT_INFO_ORDER', 'Ordem');

define('ERROR_DELETED', 'Error when deleting register(s).');
define('SUCCESS_DELETED', 'O registro foi eliminado.');

//STATS
define('TEXT_STAT_TITLE_WEEK', 'Estatísticas da semana');
define('TEXT_STAT_TITLE_DAY', 'Estatísticas do dia ');
define('TEXT_STAT_TODAY', 'Hoje');
define('TEXT_STAT_YESTERDAY', 'Ontem');
define('TEXT_STAT_NUM_VISITS', 'Visitas');
define('TEXT_STAT_NUM_CLICKS', 'Cliques');
define('TEXT_STAT_TOTALS', 'Total:');

//WDO?>
