<?php

/***************************************************************************/
/*                                                                         */
/*  osCommerce, Open Source E-Commerce Solutions                           */
/*  http://www.oscommerce.com                                              */
/*  Released under the GNU General Public License                          */
/*                                                                         */
/*  Translation Brazilian by:                                              */
/*  Tradu��o Para o Portugu�s Brasil por:                                  */
/*  Alexandre Costa alexandre@brim.com.br | http://www.brimempresas.com.br */
/*  osCommerce 2.2 Milestone 2 Portugu�s-Brasil Vers�o BRIM Sistemas Ltda. */
/*                                                                         */
/***************************************************************************/

setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="pt"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administra��o');
define('HEADER_TITLE_SUPPORT_SITE', 'Suporte da Loja');
define('HEADER_TITLE_ONLINE_CATALOG', 'Cat�logo Online');
define('HEADER_TITLE_ADMINISTRATION', 'Administra��o');

// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configura��o');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrador');
define('BOX_CONFIGURATION_MYSTORE', 'Minha Loja');
define('BOX_CONFIGURATION_LOGGING', 'Log');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'M�dulos');
define('BOX_MODULES_PAYMENT', 'Pagamento');
define('BOX_MODULES_SHIPPING', 'Envio');
define('BOX_MODULES_ORDER_TOTAL', 'Configura��o de Pedidos');
define('BOX_MODULES_SHIPPING_CORREIOS', 'Atualizar Tabelas');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Categorias/Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias/Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos de Produtos');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Coment�rios');
define('BOX_CATALOG_SPECIALS', 'Promo��es');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produtos Esperados');

define('BOX_CATALOG_DISCOUNT_PAYMENT', 'Desconto para pagamento a vista');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes/Pedidos');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Pedidos');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locais/ Taxas');
define('BOX_TAXES_COUNTRIES', 'Pa�ses');
define('BOX_TAXES_ZONES', 'Estados');
define('BOX_TAXES_GEO_ZONES', 'Taxas de Estados');
define('BOX_TAXES_TAX_CLASSES', 'Classe de Taxas');
define('BOX_TAXES_TAX_RATES', 'Cota��o de Taxas');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Relat�rios');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produtos Mais Vistos');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produtos Mais Vendidos');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total de Pedidos por Cliente');
define('BOX_REPORTS_WHOS_ONLINE', 'Usu�rios ON-Line');
define('BOX_REPORTS_SALES', 'Gr�fico de Vendas Mensal');
define('BOX_REPORTS_DETAILED_MONTHLY_SALES', 'Detalhes mensal de vendas');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Ferramentas');
define('BOX_TOOLS_BACKUP', 'C�pia do banco de dados');
define('BOX_TOOLS_BANNER_MANAGER', 'Gerenciador de Banners');
define('BOX_TOOLS_PARTNERS', 'Parceiros');
define('BOX_TOOLS_CACHE', 'Controle de Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir L�nguas');
define('BOX_TOOLS_FILE_MANAGER', 'Gerenciador de Arquivos');
define('BOX_TOOLS_MAIL', 'Enviar Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gerenciador de Newsletter');
define('BOX_TOOLS_NEWSLETTER_EMAILS', 'Marketing E-mails');
define('BOX_TOOLS_SERVER_INFO', 'Informa��es de Servidor');
define('BOX_TOOLS_WHOS_ONLINE', 'Quem est� online?');
define('BOX_TOOLS_UPLOAD_LIST_PRICE', 'Downloads');
define('BOX_TOOLS_EXPORT_DADOS', 'Exportar tabela de pre�o');
define('BOX_TOOLS_GALLERY', 'Galeria de fotos');
define('BOX_TOOLS_STUDIO', 'Galeria Est�dio de Cria��o');
define('BOX_TOOLS_COMMENT8R', 'Grupo de Discurss�o'); 
define('BOX_TOOLS_EXPORT_DATA', 'Exporta��o de Dados');

//editor testo em includes/boxes/editor.php
define('BOX_HEADING_EDITOR', 'Editor de Textos');
define('BOX_HEADING_ORGANIZER', 'Organizador de boxes');
define('BOX_EDITOR_HOW_BUY', 'Como comprar');
define('BOX_EDITOR_WHO_WE_ARE', 'Quem somos');
define('BOX_EDITOR_CONTACT', 'Contato'); //guarantee
define('BOX_EDITOR_GUARANTEE', 'Garantia');
define('BOX_EDITOR_SHAPE_PAYMENT', 'Forma de Pagamento');
define('BOX_EDITOR_SHAPE_SHIPPING', 'Forma de Envio');
define('BOX_EDITOR_SECURITY_PRIVACITY', 'Seguran�a e Privacidade');
define('BOX_EDITOR_FAQ', 'FAQ');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localiza��o');
define('BOX_LOCALIZATION_CURRENCIES', 'Moedas');
define('BOX_LOCALIZATION_LANGUAGES', 'L�nguas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Status de Pedidos');

// javascript messages
define('JS_ERROR', 'Erros aconteceram durante o envio de seu formul�rio!\n Por favor, fa�a as seguintes corre��es:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* O novo produto precisa de um pre�o\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* O novo produto precisa de um pre�o pr�-fixado\n');

define('JS_PRODUCTS_NAME', '* O novo produto precisa de um nome\n');
define('JS_PRODUCTS_DESCRIPTION', '* O novo produto precisa de uma descri��o\n');
define('JS_PRODUCTS_PRICE', '* O novo produto precisa de um valor\n');
define('JS_PRODUCTS_WEIGHT', '* O novo produto precisa de um peso\n');
define('JS_PRODUCTS_QUANTITY', '* O novo produto precisa de quantidade\n');
define('JS_PRODUCTS_MODEL', '* O novo produto precisa de um modelo\n');
define('JS_PRODUCTS_IMAGE', '* o novo produto precisa de uma imagem\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Um novo pre�o precisa ser configurado para este produto\n');

define('JS_GENDER', '* O \'Sexo\' deve ser escolhido.\n');
define('JS_FIRST_NAME', '* O \'Nome\' deve ter no m�nimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_LAST_NAME', '* O \'Sobrenome\' deve ter no m�nimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n');

define('JS_RAZAO_SOCIAL', '* O \'Raz�o Social\' deve ter no m�nimo ' . ENTRY_RAZAO_SOCIAL_MIN_LENGTH . ' caracteres.\n');
define('JS_NOME_FANTASIA', '* O \'Nome Fantasia\' deve ter no m�nimo ' . ENTRY_NOME_FANTASIA_MIN_LENGTH . ' caracteres.\n');
define('JS_CNPJ', '* O \'CNPJ\' deve ter no m�nimo ' . ENTRY_CNPJ_MIN_LENGTH . ' caracteres.\n');
define('JS_RESPONSAVEL', '* O \'Respons�vel\' deve ter no m�nimo ' . ENTRY_RESPONSAVEL_MIN_LENGTH . ' caracteres.\n');
//define('JS_INSCRICAO_ESTADUAL', '* O \'Inscricao Estadual\' deve ter no m�nimo ' . ENTRY_INSCRICAO_ESTADUAL_MIN_LENGTH . ' caracteres.\n');


define('JS_DOB', '* A \'Data de Nascimento\' deve estar no formato: xx/xx/xxxx (dia/m�s/ano).\n');
define('JS_EMAIL_ADDRESS', '* O \'E-Mail\' deve ter no m�nimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* O \'Endere�o\' deve ter no m�nimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* O \'campo n�mero\' deve ter no m�nimo ' . ENTRY_STREET_NUMBER_MIN_LENGTH . ' caracteres.\n');

define('JS_CPF', '* O \'CPF\' deve ter no m�nimo' . ENTRY_STREET_CPF_MIN_LENGTH . ' characters. ');
define('JS_RG', '* O \'RG\' deve ter no m�nimo' . ENTRY_STREET_RG_MIN_LENGTH . ' characters. ');
define('JS_POST_CODE', '* O \'CEP\' deve ter no m�nimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n');
define('JS_CITY', '* A \'Cidade\' deve ter no m�nimo ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.\n');
define('JS_STATE', '* O \'Estado\' deve ser selecionado.\n');
define('JS_STATE_SELECT', '-- Selecione Acima --');
define('JS_ZONE', '* O \'Estado\' deve ser selecionado atrav�s da lista para este Pa�s.');
define('JS_COUNTRY', '* O \'Pa�s\' deve ser escolhido.\n');
define('JS_TELEPHONE', '* O \'Fone\' deve ter no m�nimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.\n');
/*define('JS_TELEPHONE_COMERCIAL', '* O \'Fone\' deve ter no m�nimo ' . ENTRY_TELEPHONE_CELULAR_MIN_LENGTH . ' caracteres.\n');
define('JS_TELEPHONE_CELULAR', '* O \'Fone\' deve ter no m�nimo ' . ENTRY_TELEPHONE_CELULAR_MIN_LENGTH . ' caracteres.\n'); */
define('JS_PASSWORD', '* A \'Senha\' e \'Confirma��o\' devem combinar e ter no m�nimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'O n�mero de pedido %s n�o existe!');

define('CATEGORY_PERSONAL', 'Pessoal');
define('CATEGORY_ADDRESS', 'Endere�o');
define('CATEGORY_CONTACT', 'Contato');
define('CATEGORY_COMPANY', 'Companhia');
define('CATEGORY_OPTIONS', 'Op��es');

define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">� obrigat�rio</span>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_DATE_OF_BIRTH', 'Data de nascimento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ex. 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">O endere�o de email n�o parece ser v�lido!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Este email j� existe!</span>');


define('ENTRY_COMPANY', 'Nome da Empresa:');
define('ENTRY_COMPANY_ERROR', '');


define('ENTRY_STREET_ADDRESS', 'Endere�o:');
define('ENTRY_STREET_NUMBER', 'N�mero:');
define('ENTRY_CPF', 'CPF:');
define('ENTRY_RG', 'RG:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_STREET_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_NUMBER_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_STREET_CPF_ERROR', ' min ' . ENTRY_STREET_CPF_MIN_LENGTH . ' caracteres');
define('ENTRY_STREET_RG_ERROR', ' min ' . ENTRY_STREET_RG_MIN_LENGTH . ' caracteres');
define('ENTRY_SUBURB', 'Bairro:');

// CAMPOS INCLUIDOS POR MIM
define('ENTRY_COMPLEMENTO', 'Complemento:');
define('ENTRY_COMPLEMENTO_ERROR', '');

define('ENTRY_TELEPHONE_COMERCIAL_NUMBER', 'Telefone Comercial:');
define('ENTRY_TELEPHONE_COMERCIAL_NUMBER_ERROR', '');
define('ENTRY_TELEPHONE_COMERCIAL_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_COMERCIAL_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_TELEPHONE_CELULAR_NUMBER', 'Celular:');
define('ENTRY_TELEPHONE_CELULAR_NUMBER_ERROR', '');
define('ENTRY_TELEPHONE_CELULAR_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_CELULAR_MIN_LENGTH . ' caracteres</span>');

// FIM

//DEFINI�OES PARA CADASTRO DE PESSOA JURIDICA
define('ENTRY_RAZAO_SOCIAL', 'Raz�o Social:');
define('ENTRY_RAZAO_SOCIAL_ERROR', '*');
define('ENTRY_RAZAO_SOCIAL_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_RAZAO_SOCIAL_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_NOME_FANTASIA', 'Nome Fantasia:');
define('ENTRY_NOME_FANTASIA_ERROR', '*');
define('ENTRY_NOME_FANTASIA_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_NOME_FANTASIA_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_INSCRICAO_ESTADUAL', 'Inscri��o Estadual:');
define('ENTRY_INSCRICAO_ESTADUAL_ERROR', '');

define('ENTRY_CNPJ', 'CNPJ:');
define('ENTRY_CNPJ_TEXT', ' *');
define('ENTRY_CNPJ_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CNPJ_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_RESPONSAVEL', 'Respons�vel/Contato:');
define('ENTRY_RESPONSAVEL_TEXT', '*');
define('ENTRY_RESPONSAVEL_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_RESPONSAVEL_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_TELEPHONE2_NUMBER', 'Telefone Comercial:');
define('ENTRY_TELEPHONE2_NUMBER_ERROR', 'Seu telefone comercial deve ter o m�nimo de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.');
//-------------------------------------------------------------------------------------//


define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">� obrigat�rio</span>');
define('ENTRY_COUNTRY', 'Pa�s:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone Residencial:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_USER_RVENDEDOR', 'Cliente revendedor:');
define('ENTRY_USER_RVENDEDOR_YES', 'Sim');
define('ENTRY_USER_RVENDEDOR_NO', 'N�o');
define('ENTRY_NEWSLETTER_YES', 'Inscrito');
define('ENTRY_NEWSLETTER_NO', 'N�o inscrito');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Enviando E-Mail');
define('IMAGE_BACK', 'Voltar');
define('IMAGE_BACKUP', 'C�pia de Seguran�a');
define('IMAGE_CANCEL', 'Cancelar');
define('IMAGE_CONFIRM', 'Confirmar');
define('IMAGE_COPY', 'Copiar');
define('IMAGE_COPY_TO', 'Copiar para');
define('IMAGE_DETAILS', 'Detalhes');
define('IMAGE_DELETE', 'Apagar');
define('IMAGE_EDIT', 'Editar');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Gerenciador de Arquivos');
define('IMAGE_ICON_STATUS_GREEN', 'Ativo');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Deixar Ativo');
define('IMAGE_ICON_STATUS_RED', 'Inativo');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Deixar Inativo');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Inserir');
define('IMAGE_LOCK', 'Travar');
define('IMAGE_MODULE_INSTALL', 'Instalar M�dulo');
define('IMAGE_MODULE_REMOVE', 'Remover M�dulo');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Novo Banner');
define('IMAGE_NEW_CATEGORY', 'Nova Categoria');
define('IMAGE_NEW_COUNTRY', 'Novo Pa�s');
define('IMAGE_NEW_CURRENCY', 'Nova Moeda');
define('IMAGE_NEW_FILE', 'Novo Arquivo');
define('IMAGE_NEW_FOLDER', 'Nova Pasta');
define('IMAGE_NEW_LANGUAGE', 'Nova L�ngua');
define('IMAGE_NEW_NEWSLETTER', 'Novo Newsletter');
define('IMAGE_NEW_PRODUCT', 'Novo Produto');
define('IMAGE_NEW_TAX_CLASS', 'Nova Classe de Taxas');
define('IMAGE_NEW_TAX_RATE', 'Nova Percentagem de Taxa');
define('IMAGE_NEW_TAX_ZONE', 'Nova Zona de Taxa');
define('IMAGE_NEW_ZONE', 'Nova Zona');
define('IMAGE_ORDERS', 'Pedidos');
define('IMAGE_ORDERS_INVOICE', 'Faturas');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Pr�via');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_RESET', 'Resetar');
define('IMAGE_SAVE', 'Salvar');
define('IMAGE_SEARCH', 'Busca');
define('IMAGE_SELECT', 'Selecionar');
define('IMAGE_SEND', 'Enviar');
define('IMAGE_SEND_EMAIL', 'Enviar Email');
define('IMAGE_UNLOCK', 'Destravar');
define('IMAGE_UPDATE', 'Atualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Atualizar Taxa de C�mbio');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CROSS', 'Falso');
define('ICON_CURRENT_FOLDER', 'Pasta atual');
define('ICON_DELETE', 'Deletar');
define('ICON_ERROR', 'Erro');
define('ICON_FILE', 'Arquivo');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Pasta');
define('ICON_LOCKED', 'Travado');
define('ICON_PREVIOUS_LEVEL', 'N�vel atual');
define('ICON_PREVIEW', 'Pr�via');
define('ICON_STATISTICS', 'Estat�sticas');
define('ICON_SUCCESS', 'Sucesso');
define('ICON_TICK', 'Verdade');
define('ICON_UNLOCKED', 'Destravado');
define('ICON_WARNING', 'Aten��o');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P�gina %s de %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> banners)');
define('TEXT_DISPLAY_PARTNERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> parceiros)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> pa�ses)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> moedas)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> l�nguas)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> fabricantes)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> status de pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> produtos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> produtos esperados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> produtos comentados)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> produtos em promo��o)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> classes de taxas)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> taxas de estado)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> percentagem de taxas)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> estados)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'padr�o');
define('TEXT_SET_DEFAULT', 'Configurar como padr�o');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Obrigat�rio</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erro: N�o h� moeda configurada no momento. Por favor, configure uma em: Ferramentas Administrativas->Localiza��es->Moedas');

define('TEXT_CACHE_CATEGORIES', 'Categorias');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'M�dulo tamb�m adquirido');

define('TEXT_NONE', '--nenhum--');
define('TEXT_TOP', 'Selecione uma categoria');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Erro: Destino n�o existe.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Erro: N�o � permitido escrever neste destino.');
define('ERROR_FILE_NOT_SAVED', 'Erro: Upload n�o foi salvo.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Erro: Tipo de arquivo para upload n�o permitido.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Successo: Upload salvo com sucesso.');
define('WARNING_NO_FILE_UPLOADED', 'Aten��o: Nenhum arquivo foi enviado.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Aten��o: Upload de arquivos est�o desabilitados no php.ini .');
define('HEADER_TITLE_STOCK', 'Conferir estoque');

define('BOX_CATALOG_QUICK_STOCKUPDATE', 'Atualiza��o Estoque');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_EXTRA_IMAGES','Imagens extras');

// polls box text in includes/boxes/polls.php
define('BOX_HEADING_POLLS', 'Enquetes');
define('BOX_POLLS_POLLS', 'Administra��o de Enquetes');
define('BOX_POLLS_CONFIG','Configura��o de Enquetes');

define('BOX_TOOLS_CREATE_NEWS', 'Administra��o de Not�cias');



//kgt - discount coupons
define('BOX_CATALOG_DISCOUNT_COUPONS', 'Cupom de Desconto');
//end kgt - discount coupons

//kgt - discount coupons report
define('BOX_REPORTS_DISCOUNT_COUPONS', 'Cupom de Desconto');
//end kgt - discount coupons report

define('IMAGE_GOOGLE_DIRECTIONS', 'Google Mapas de Entrega');

// BOF Quick Attributes

define('IMAGE_ICON_QUICK_ATTRIBUTE', 'Adicionar atributo r�pido');

// EOF Quick Attributes

/*** Begin Header Tags SEO ***/
// header_tags_seo text in includes/boxes/header_tags_seo.php
define('BOX_HEADING_HEADER_TAGS_SEO', 'Google - Otimiza��o');
define('BOX_HEADER_TAGS_ADD_A_PAGE', 'Google - Painel de Controle');
define('BOX_HEADER_TAGS_SILO', 'Google - Silo Control');
define('BOX_HEADER_TAGS_FILL_TAGS', 'Google - Preencher Tags');
define('BOX_HEADER_TAGS_TEST', 'Testar');
/*** End Header Tags SEO ***/

define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Controle de multiplos produtos');

define('BOX_TOOLS_GOOGLE_FEED', 'Google Feed Produtos');
?>
