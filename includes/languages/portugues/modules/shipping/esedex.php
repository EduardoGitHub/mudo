<?php 
/* 
  
07/06/2010 - M�DULO E-SEDEX 
- C�lculo online direto dos servidores dos Correios
- Inclui campo para login corporativo e senha do contrato com os Correios configur�veis na administra��o do m�dulo
- Atualiza��o da URL dos Correios de acordo com as instru��es em http://www.correios.com.br/servicos/precos_tarifas/pdf/SCPP_Manual_Implementacao_Calculo_Remoto_de_Precos_e_Prazos.pdf
- Necess�rio ter contrato com os Correios para usar e-Sedex

Adapta��o do m�dulo PAC/Sedex de Welson Tavares com atualiza��es e melhorias de Valmy Gomes
by CybernetFX - www.cybernetfx.com
F�runs de suporte: www.forumdowebmaster.com.br 
                   www.forums.oscommerce.com
   
*/ 

define('MODULE_SHIPPING_ESEDEX_TEXT_TITLE', '<img src='.  DIR_WS_CATALOG .'images/cards/esedex.gif border=0 align=absmiddle /> Entrega via e-Sedex'); 
define('MODULE_SHIPPING_ESEDEX_TEXT_DESCRIPTION', 'Entrega via e-Sedex'); 
define('MODULE_SHIPPING_ESEDEX_ITEM', 'Enviar'); 
define('MODULE_SHIPPING_ESEDEX_ITEMS', 'Items em'); 
define('MODULE_SHIPPING_ESEDEX_TEXT_WAY', 'O prazo de Entrega � de 1 a 3 dias ap�s a postagem nos Correios.'); 
define('MODULE_SHIPPING_ESEDEX_TEXT_UNITS', ' '); 
define('MODULE_SHIPPING_ESEDEX_INVALID_ZONE', 'Esta forma de envio n�o est� dispon�vel para este local. Em caso de d�vidas, entre em contato com a <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><b>Administra��o da Loja</b></a>.');
define('MODULE_SHIPPING_ESEDEX_NO_ZONE', 'O CEP de destino � inv�lido. Por favor, verifique o CEP informado.'); 
define('MODULE_SHIPPING_ESEDEX_UNDEFINED_RATE', 'Erro: A taxa de envio do produto n�o pode ser encontrada'); 
?>