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

define('HEADING_TITLE', 'Gerenciador de Banner');

define('TABLE_HEADING_BANNERS', 'Banners');
define('TABLE_HEADING_GROUPS', 'Grupos');
define('TABLE_HEADING_STATISTICS', 'Vistos / Clicados');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Ação');
define('TEXT_BANNERS_TITLE', 'Título do Banner:');
define('TEXT_BANNERS_URL', 'Endereço do Banner:');
define('TEXT_BANNERS_GROUP', 'Grupo do Banner:');
define('TEXT_BANNERS_NEW_GROUP', ', ou entre com um novo grupo de banner abaixo');
define('TEXT_BANNERS_IMAGE', 'Imagem:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', ou entre com o arquivo local abaixo');
define('TEXT_BANNERS_IMAGE_TARGET', 'Imagem  (Salvar como):');
define('TEXT_BANNERS_HTML_TEXT', 'Texto HTML :');
define('TEXT_BANNERS_EXPIRES_ON', 'Expira Em:');
define('TEXT_BANNERS_OR_AT', ', ou após');
define('TEXT_BANNERS_IMPRESSIONS', ' impressões/vistas.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Programado para:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Nota sobre o Banner:</b><ul><li>Use uma imagem ou um texto HTML para o banner - não ambos.</li><li>o Texto HTML tem prioridade sobre uma imagem</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Nota sobre a Imagem:</b><ul><li>Os diretórios de upload(envio) devem ter as permissões de escrita(CHMOD) apropriadas!</li><li>Não preencha o campo \'Salvar Como\' se você não estiver fazendo o upload de uma imagem para o servidor (ie, se estiver usando uma imagem local).</li><li>O campo \'Salvar Como\' deve ser um diretório existente e terminar com uma barra (ex, banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Nota sobre a expiração:</b><ul><li>Apenas um dos dois campos deve ser preenchido</li><li>Se o banner não expira automaticamente, deixe ambos em branco</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Nota sobre a Programação:</b><ul><li>Se uma programação foi definida, o banner será ativado naquela data.</li><li>Todos os banners programados são marcados como desativados até que aquela data tenha chegado, e então serão marcados como ativos.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Adicionado em :');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Programado para: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expira em: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expira após : <b>%s</b> impressões');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status da Mudança: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Últimos 3 Dias');
define('TEXT_BANNERS_BANNER_VIEWS', 'Banner Vistos');
define('TEXT_BANNERS_BANNER_CLICKS', 'Banner Clicados');

define('TEXT_INFO_DELETE_INTRO', 'Tem certeza que quer deletar este banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Deletar a figura do banner');

define('SUCCESS_BANNER_INSERTED', 'Sucesso: O banner foi inserido.');
define('SUCCESS_BANNER_UPDATED', 'Sucesso: O banner foi atualizado.');
define('SUCCESS_BANNER_REMOVED', 'Sucesso: O banner foi removido.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Sucesso: O status do banner foi atualizado.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Erro: Título do Banner requerido.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Erro: Grupo do Banner requerido.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erro: Este diretório não existe: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erro: Diretório protegido contra escrita: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Erro: Figura não existe.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Erro: Figurão não pôde ser removida.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Erro: flag de Status desconhecido.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Erro: Diretório Graphs não existe. Por favor crie o diretório \'graphs\' dentro de  \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Erro: Diretório Graphs protegido contra escrita.');
?>