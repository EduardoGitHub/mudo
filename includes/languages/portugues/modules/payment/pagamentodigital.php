<?php
/*
  visa.php 22/01/2007
  M�dulo de Pagamento osCommerce 2.2 para pagamento com Visa
  Desenvolvido por http://www.helpdesk.eti.br
*/
  define('MODULE_PAYMENT_PD_TEXT_TITLE', 'Pagamento Digital');
  define('MODULE_PAYMENT_PD_TEXT_DESCRIPTION', 'Boleto Banc�rio, Visa(10x), Mastercard(12x), American Express(15x), Aura(24x), Diners(10x), Hipercard (10x)');
  define('MODULE_PAYMENT_PD_TEXT_FINALIZAR', 'A forma de pagamento ser� aberta na pr�xima etapa.');
  define('MODULE_PAYMENT_PD_TEXT_JS_FINALIZAR', 'Seu navegador n�o suporta Javascript. Isso pode interferir s�riamente em seu pagamento. Caso queira continuar, clique no bot�o abaixo.');
  define('MODULE_PAYMENT_PD_TEXT_BTN_CONTINUAR', 'Continuar');
  
  /**
  * Email de retorno
  */
  define('EMAIL_TITLE_PG', 'Retorno Pagamento Digital');
  define('EMAIL_PG_ID_TRANSACAO', 'Id da Transa��o: ');
  define('EMAIL_PG_DATA', 'Data da Transa��o: ');
  define('EMAIL_PG_VALOR', 'Valor da Transa��o: ');
  define('EMAIL_PG_TIPO_PAGAMENTO', 'Tipo de Pagamento: ');
  define('EMAIL_PG_PARCELAS', 'Parcelas: ');
  define('EMAIL_PG_STATUS', 'Status do Pagamento: ');
  define('EMAIL_PG_CLIENTE_NOME', 'Nome: ');
  define('EMAIL_PG_CLIENTE_EMAIL', 'Email: ');
  define('EMAIL_PG_CLIENTE_CPF', 'CPF: ');
  define('EMAIL_PG_CLIENTE_ENDERECO', 'Endere�o: ');
  define('EMAIL_PG_COMPLEMENTO', 'Complemento: ');
  define('EMAIL_PG_BAIRRO', 'Bairro: ');
  define('EMAIL_PG_CIDADE', 'Cidade: ');
  define('EMAIL_PG_ESTADO', 'Estado: ');
  define('EMAIL_PG_CEP', 'CEP: ');
  define('EMAIL_PG_FRETE', 'Frete: ');
  define('EMAIL_PG_INFORMACOES', 'Informa�oes: ');
  define('EMAIL_PG_REPOSTA', 'Retorno do Pagamento Digital: ');
  
?>