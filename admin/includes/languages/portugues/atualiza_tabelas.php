<?
/*
  $Id: affiliate_affiliate.php,v 1.7 2003/02/16 12:30:38 harley_vb Exp $

  OSC-Affiliate

  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Atualizar Tabelas Correios');
define('HEADING_INFO', 'Quando o cliente for finalizar o pedido, para informar o valor do frete, a loja faz a consulta dos valores nos servidores (site) dos correios, se este estiver fora do ar, a loja far� a consulta ao PagSeguro (somente PAC e Sedex). Se este tamb�m n�o retornar um valor por qualquer raz�o, ent�o a loja retornar� o valor da tabela gravada em seu banco de dados que pode ser atualizada sempre que houver necessidades ou reajuste de pre�os nos correios, isto garantir� uma estabilidade na loja.');
define('HEADING_RECOMENDO', '<font color="red">Recomend�vel executar a cada 6 meses ( reajuste dos correios ).
<b />N�o fechar a janela do navegador enquanto tiver atualizando, o processo pode demorar ate 20mim.</font>');
?>