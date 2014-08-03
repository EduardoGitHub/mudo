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

define('HEADING_TITLE', 'Moedas');

define('TABLE_HEADING_CURRENCY_NAME', 'Moeda');
define('TABLE_HEADING_CURRENCY_CODES', 'Código');
define('TABLE_HEADING_CURRENCY_VALUE', 'Valor');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_INFO_EDIT_INTRO', 'Por favor faça as alterações necessárias');
define('TEXT_INFO_CURRENCY_TITLE', 'Título:');
define('TEXT_INFO_CURRENCY_CODE', 'Código:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Símbolo a Esquerda:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Símbolo a Direita:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Ponto Decimal:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Separador de Milhares:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Casas Decimais:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Última Atualização:');
define('TEXT_INFO_CURRENCY_VALUE', 'Valor:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Exemplo:');
define('TEXT_INFO_INSERT_INTRO', 'Por favor introduza a moeda e sua informação correspondente');
define('TEXT_INFO_DELETE_INTRO', 'Tem certeza que quer eliminar esta moeda?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nova Moeda');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Editar Moeda');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Eliminar Moeda');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (requer atualização manual para os valores da moeda)');
define('TEXT_INFO_CURRENCY_UPDATED', 'A taxa de conversão para %s (%s) foi atualizada com sucesso via %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Erro: A moeda padrão não pode ser removida. Escolha outra moeda como padrão e tente novamente.');
define('ERROR_CURRENCY_INVALID', 'Erro: A taxa de conversão para %s (%s) não foi atualizada via %s. O código de moeda é válido?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Atenção : O servidor primário de taxa de conversão (%s) falhou para %s (%s) - Tentando servidor secundário.');
?>
