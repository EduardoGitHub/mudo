<?php

/*
�ltima edi��o 26/04/2009 por  www.legalloja.com.br (Valmy Gomes)
  sedex.php 26/04/2009
  M�dulo de Frete SEDEX para osCommerce 
  
  Vers�o 2.0: C�digo portado para oscommerce 2.2MS2
  	      Developed by Angelo Bannack <angelo@earmazem.com.br> and Giordano Bruno Wolaniuk (giordano@earmazem.com.br)
  	      06-04-2004
  Vers�o 1.0: Desenvolvimento para oscommerce 2.2MS1
  	      Developed by Angelo Bannack <angelo@earmazem.com.br>
  	      08-03-2003
  Released under the GNU General Public License
//ADICIONADO FUN��O PARA ATUALIZA��O DE TARIFA DOS CORREIOS
//PIRAPETINGA - MINAS GERAIS - BRASIL - 26 DE ABRIL DE 2009
//AUTOR: VALMY GOMES
//COLABORA��O1: RODRIGO MANGA
//COLABORA��O2: DOUGLAS GOMES DE SOUZA 
//ATUALIZA��O EM 17/07/2009 - By Edgar / CybernetFX - www.cybernetfx.com: Corre��o do script de atualiza��o para incluir e calcular pre�o para 300gr + Corre��o da fun��o Ativar/Desativar m�dulo + Adapta��o para Sedex 10/Sedex Hoje/Sedex a Cobrar + Inclus�o de alguns strings de linguagem 
//OUTROS CR�DITOS: Lucas Ferreira, Angelo Bannack, Giordano Bruno Wolaniuk, Welson Tavares e Marcelo_73 por terem desenvolvido c�digos anteriores que serviram de base para este.
//Agradecimentos ao pessoal que participa dos f�runs  sobre OsCommerce no Brasil.
//AT� AQUI NOS AJUDOU O SENHOR
//FA�A BOM PROVEITO!
//SEJA �TICO, MANTENHA OS CREDITOS, SE MELHORAR ALGO, JUNTE COM ORGULHO O SEU NOME AOS DEMAIS E COMPARTILHE
*/



define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_TITLE', 'Sedex Hoje                              <img src="'.$link.'images/entrega_sedexhoje.gif" width="43" height="23" align="absmiddle">'); 

define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_DESCRIPTION', 'SEDEX HOJE');
define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_ERRO', 'Erro no c�lculo do frete ou modalidade n�o dispon�vel para este local!<br> <a href=contact_us.php>Clique aqui</a> para contactar a Administra��o e informar sobre este erro');
define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_PESO', 'Peso-base para c�lculo');
define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_PRAZO', 'Mesmo dia da postagem (Peso m�ximo por pacote: 10kg)');
?>