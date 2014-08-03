<?php

/*
Última edição 26/04/2009 por  www.legalloja.com.br (Valmy Gomes)
  sedex.php 26/04/2009
  Módulo de Frete SEDEX para osCommerce 
  
  Versão 2.0: Código portado para oscommerce 2.2MS2
  	      Developed by Angelo Bannack <angelo@earmazem.com.br> and Giordano Bruno Wolaniuk (giordano@earmazem.com.br)
  	      06-04-2004
  Versão 1.0: Desenvolvimento para oscommerce 2.2MS1
  	      Developed by Angelo Bannack <angelo@earmazem.com.br>
  	      08-03-2003
  Released under the GNU General Public License
//ADICIONADO FUNÇÃO PARA ATUALIZAÇÃO DE TARIFA DOS CORREIOS
//PIRAPETINGA - MINAS GERAIS - BRASIL - 26 DE ABRIL DE 2009
//AUTOR: VALMY GOMES
//COLABORAÇÃO1: RODRIGO MANGA
//COLABORAÇÃO2: DOUGLAS GOMES DE SOUZA 
//ATUALIZAÇÃO EM 17/07/2009 - By Edgar / CybernetFX - www.cybernetfx.com: Correção do script de atualização para incluir e calcular preço para 300gr + Correção da função Ativar/Desativar módulo + Adaptação para Sedex 10/Sedex Hoje/Sedex a Cobrar + Inclusão de alguns strings de linguagem 
//OUTROS CRÉDITOS: Lucas Ferreira, Angelo Bannack, Giordano Bruno Wolaniuk, Welson Tavares e Marcelo_73 por terem desenvolvido códigos anteriores que serviram de base para este.
//Agradecimentos ao pessoal que participa dos fóruns  sobre OsCommerce no Brasil.
//ATÉ AQUI NOS AJUDOU O SENHOR
//FAÇA BOM PROVEITO!
//SEJA ÉTICO, MANTENHA OS CREDITOS, SE MELHORAR ALGO, JUNTE COM ORGULHO O SEU NOME AOS DEMAIS E COMPARTILHE
*/



define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_TITLE', 'Sedex Hoje                              <img src="'.$link.'images/entrega_sedexhoje.gif" width="43" height="23" align="absmiddle">'); 

define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_DESCRIPTION', 'SEDEX HOJE');
define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_ERRO', 'Erro no cálculo do frete ou modalidade não disponível para este local!<br> <a href=contact_us.php>Clique aqui</a> para contactar a Administração e informar sobre este erro');
define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_PESO', 'Peso-base para cálculo');
define('MODULE_SHIPPING_SEDEXHOJELOCAL_TEXT_PRAZO', 'Mesmo dia da postagem (Peso máximo por pacote: 10kg)');
?>