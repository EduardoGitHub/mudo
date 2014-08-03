<?php
/***************************************************************************/
/*                                                                         */
/*  osCommerce, Open Source E-Commerce Solutions                           */
/*  http://www.oscommerce.com                                              */
/*  Released under the GNU General Public License                          */
/*                                                                         */
/*  Tradução Para o Português Brasil por:                                  */
/*  Alexandre August alexandre@brim.com.br | http://www.brimempresas.com.br*/
/*  osCommerce 2.2 Milestone 2 Português-Brasil Versão BRIM Empresas       */
/*                                                                         */
/***************************************************************************/

define('HEADING_TITLE', 'Database Backup Manager');

define('TABLE_HEADING_TITLE', 'Título');
define('TABLE_HEADING_FILE_DATE', 'Data');
define('TABLE_HEADING_FILE_SIZE', 'Tam.');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Novo Backup');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurar Local');
define('TEXT_INFO_NEW_BACKUP', 'Não interrompa o processo de backup. Ele pode durar alguns minutos.');
define('TEXT_INFO_UNPACK', '<br><br>(after unpacking the file from the archive)');
define('TEXT_INFO_RESTORE', 'Não interrompa o processo de restauração.<br><br>Quanto maior o arquivo de backup, maior será a demora no processamento!<br><br>Se possível, use o cliente MYSQL.<br><br>Por exemplo:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Não interrompa o processo de restauração.<br><br>Quanto maior o arquivo de backup, maior será a demora no processamento!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'O arquivo a ser carregado deve ser do tipo texto.');
define('TEXT_INFO_DATE', 'Data:');
define('TEXT_INFO_SIZE', 'Tam.:');
define('TEXT_INFO_COMPRESSION', 'Compressão:');
define('TEXT_INFO_USE_GZIP', 'Use GZIP');
define('TEXT_INFO_USE_ZIP', 'Use ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sem Compressão (SQL Puro)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Apenas Download (do not store server side)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Mais indicado através de uma conexão HTTPS');
define('TEXT_DELETE_INTRO', 'Tem certeza que quer apagar este backup?');
define('TEXT_NO_EXTENSION', 'Nenhum');
define('TEXT_BACKUP_DIRECTORY', 'Diretório de Backup:');
define('TEXT_LAST_RESTORATION', 'Última Restauração:');
define('TEXT_FORGET', '(<u>Esquecer</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Erro: Diretório de Backup não existe. Verifique o arquivo configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Erro: Diretório de Backup protegido contra escrita.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Erro: Link de Download inaceitável.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Sucesso: A última data de restauração foi limpa.');
define('SUCCESS_DATABASE_SAVED', 'Sucesso: A Base de Dados foi salva.');
define('SUCCESS_DATABASE_RESTORED', 'Sucesso: A Base de Dados foi restaurada.');
define('SUCCESS_BACKUP_DELETED', 'Sucesso: O backup foi removido.');
?>
