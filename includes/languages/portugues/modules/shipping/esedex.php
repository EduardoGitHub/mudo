<?php 
/* 
  
07/06/2010 - MÓDULO E-SEDEX 
- Cálculo online direto dos servidores dos Correios
- Inclui campo para login corporativo e senha do contrato com os Correios configuráveis na administração do módulo
- Atualização da URL dos Correios de acordo com as instruções em http://www.correios.com.br/servicos/precos_tarifas/pdf/SCPP_Manual_Implementacao_Calculo_Remoto_de_Precos_e_Prazos.pdf
- Necessário ter contrato com os Correios para usar e-Sedex

Adaptação do módulo PAC/Sedex de Welson Tavares com atualizações e melhorias de Valmy Gomes
by CybernetFX - www.cybernetfx.com
Fóruns de suporte: www.forumdowebmaster.com.br 
                   www.forums.oscommerce.com
   
*/ 

define('MODULE_SHIPPING_ESEDEX_TEXT_TITLE', '<img src='.  DIR_WS_CATALOG .'images/cards/esedex.gif border=0 align=absmiddle /> Entrega via e-Sedex'); 
define('MODULE_SHIPPING_ESEDEX_TEXT_DESCRIPTION', 'Entrega via e-Sedex'); 
define('MODULE_SHIPPING_ESEDEX_ITEM', 'Enviar'); 
define('MODULE_SHIPPING_ESEDEX_ITEMS', 'Items em'); 
define('MODULE_SHIPPING_ESEDEX_TEXT_WAY', 'O prazo de Entrega é de 1 a 3 dias após a postagem nos Correios.'); 
define('MODULE_SHIPPING_ESEDEX_TEXT_UNITS', ' '); 
define('MODULE_SHIPPING_ESEDEX_INVALID_ZONE', 'Esta forma de envio não está disponível para este local. Em caso de dúvidas, entre em contato com a <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><b>Administração da Loja</b></a>.');
define('MODULE_SHIPPING_ESEDEX_NO_ZONE', 'O CEP de destino é inválido. Por favor, verifique o CEP informado.'); 
define('MODULE_SHIPPING_ESEDEX_UNDEFINED_RATE', 'Erro: A taxa de envio do produto não pode ser encontrada'); 
?>