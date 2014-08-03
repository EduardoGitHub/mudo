<?php

/***************************************************************************/
/*                                                                         */
/*  osCommerce, Open Source E-Commerce Solutions                           */
/*  http://www.oscommerce.com                                              */
/*  Released under the GNU General Public License                          */
/*                                                                         */
/*  Translation Brazilian by:                                              */
/*  Tradução Para o Português Brasil por:                                  */
/*  Alexandre Costa alexandre@brim.com.br | http://www.brimempresas.com.br */
/*  osCommerce 2.2 Milestone 2 Português-Brasil Versão BRIM Sistemas Ltda. */
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
define('HEADER_TITLE_TOP', 'Administração');
define('HEADER_TITLE_SUPPORT_SITE', 'Suporte da Loja');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catálogo Online');
define('HEADER_TITLE_ADMINISTRATION', 'Administração');

// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuração');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrador');
define('BOX_CONFIGURATION_MYSTORE', 'Minha Loja');
define('BOX_CONFIGURATION_LOGGING', 'Log');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Módulos');
define('BOX_MODULES_PAYMENT', 'Pagamento');
define('BOX_MODULES_SHIPPING', 'Envio');
define('BOX_MODULES_ORDER_TOTAL', 'Configuração de Pedidos');
define('BOX_MODULES_SHIPPING_CORREIOS', 'Atualizar Tabelas');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Categorias/Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias/Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos de Produtos');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Comentários');
define('BOX_CATALOG_SPECIALS', 'Promoções');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produtos Esperados');

define('BOX_CATALOG_DISCOUNT_PAYMENT', 'Desconto para pagamento a vista');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes/Pedidos');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Pedidos');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locais/ Taxas');
define('BOX_TAXES_COUNTRIES', 'Países');
define('BOX_TAXES_ZONES', 'Estados');
define('BOX_TAXES_GEO_ZONES', 'Taxas de Estados');
define('BOX_TAXES_TAX_CLASSES', 'Classe de Taxas');
define('BOX_TAXES_TAX_RATES', 'Cotação de Taxas');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Relatórios');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produtos Mais Vistos');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produtos Mais Vendidos');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total de Pedidos por Cliente');
define('BOX_REPORTS_WHOS_ONLINE', 'Usuários ON-Line');
define('BOX_REPORTS_SALES', 'Gráfico de Vendas Mensal');
define('BOX_REPORTS_DETAILED_MONTHLY_SALES', 'Detalhes mensal de vendas');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Ferramentas');
define('BOX_TOOLS_BACKUP', 'Cópia do banco de dados');
define('BOX_TOOLS_BANNER_MANAGER', 'Gerenciador de Banners');
define('BOX_TOOLS_PARTNERS', 'Parceiros');
define('BOX_TOOLS_CACHE', 'Controle de Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir Línguas');
define('BOX_TOOLS_FILE_MANAGER', 'Gerenciador de Arquivos');
define('BOX_TOOLS_MAIL', 'Enviar Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gerenciador de Newsletter');
define('BOX_TOOLS_NEWSLETTER_EMAILS', 'Marketing E-mails');
define('BOX_TOOLS_SERVER_INFO', 'Informações de Servidor');
define('BOX_TOOLS_WHOS_ONLINE', 'Quem está online?');
define('BOX_TOOLS_UPLOAD_LIST_PRICE', 'Downloads');
define('BOX_TOOLS_EXPORT_DADOS', 'Exportar tabela de preço');
define('BOX_TOOLS_GALLERY', 'Galeria de fotos');
define('BOX_TOOLS_STUDIO', 'Galeria Estúdio de Criação');
define('BOX_TOOLS_COMMENT8R', 'Grupo de Discurssão'); 
define('BOX_TOOLS_EXPORT_DATA', 'Exportação de Dados');

//editor testo em includes/boxes/editor.php
define('BOX_HEADING_EDITOR', 'Editor de Textos');
define('BOX_HEADING_ORGANIZER', 'Organizador de boxes');
define('BOX_EDITOR_HOW_BUY', 'Como comprar');
define('BOX_EDITOR_WHO_WE_ARE', 'Quem somos');
define('BOX_EDITOR_CONTACT', 'Contato'); //guarantee
define('BOX_EDITOR_GUARANTEE', 'Garantia');
define('BOX_EDITOR_SHAPE_PAYMENT', 'Forma de Pagamento');
define('BOX_EDITOR_SHAPE_SHIPPING', 'Forma de Envio');
define('BOX_EDITOR_SECURITY_PRIVACITY', 'Segurança e Privacidade');
define('BOX_EDITOR_FAQ', 'FAQ');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localização');
define('BOX_LOCALIZATION_CURRENCIES', 'Moedas');
define('BOX_LOCALIZATION_LANGUAGES', 'Línguas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Status de Pedidos');

// javascript messages
define('JS_ERROR', 'Erros aconteceram durante o envio de seu formulário!\n Por favor, faça as seguintes correções:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* O novo produto precisa de um preço\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* O novo produto precisa de um preço pré-fixado\n');

define('JS_PRODUCTS_NAME', '* O novo produto precisa de um nome\n');
define('JS_PRODUCTS_DESCRIPTION', '* O novo produto precisa de uma descrição\n');
define('JS_PRODUCTS_PRICE', '* O novo produto precisa de um valor\n');
define('JS_PRODUCTS_WEIGHT', '* O novo produto precisa de um peso\n');
define('JS_PRODUCTS_QUANTITY', '* O novo produto precisa de quantidade\n');
define('JS_PRODUCTS_MODEL', '* O novo produto precisa de um modelo\n');
define('JS_PRODUCTS_IMAGE', '* o novo produto precisa de uma imagem\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Um novo preço precisa ser configurado para este produto\n');

define('JS_GENDER', '* O \'Sexo\' deve ser escolhido.\n');
define('JS_FIRST_NAME', '* O \'Nome\' deve ter no mínimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_LAST_NAME', '* O \'Sobrenome\' deve ter no mínimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n');

define('JS_RAZAO_SOCIAL', '* O \'Razão Social\' deve ter no mínimo ' . ENTRY_RAZAO_SOCIAL_MIN_LENGTH . ' caracteres.\n');
define('JS_NOME_FANTASIA', '* O \'Nome Fantasia\' deve ter no mínimo ' . ENTRY_NOME_FANTASIA_MIN_LENGTH . ' caracteres.\n');
define('JS_CNPJ', '* O \'CNPJ\' deve ter no mínimo ' . ENTRY_CNPJ_MIN_LENGTH . ' caracteres.\n');
define('JS_RESPONSAVEL', '* O \'Responsável\' deve ter no mínimo ' . ENTRY_RESPONSAVEL_MIN_LENGTH . ' caracteres.\n');
//define('JS_INSCRICAO_ESTADUAL', '* O \'Inscricao Estadual\' deve ter no mínimo ' . ENTRY_INSCRICAO_ESTADUAL_MIN_LENGTH . ' caracteres.\n');


define('JS_DOB', '* A \'Data de Nascimento\' deve estar no formato: xx/xx/xxxx (dia/mês/ano).\n');
define('JS_EMAIL_ADDRESS', '* O \'E-Mail\' deve ter no mínimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* O \'Endereço\' deve ter no mínimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* O \'campo número\' deve ter no mínimo ' . ENTRY_STREET_NUMBER_MIN_LENGTH . ' caracteres.\n');

define('JS_CPF', '* O \'CPF\' deve ter no mínimo' . ENTRY_STREET_CPF_MIN_LENGTH . ' characters. ');
define('JS_RG', '* O \'RG\' deve ter no mínimo' . ENTRY_STREET_RG_MIN_LENGTH . ' characters. ');
define('JS_POST_CODE', '* O \'CEP\' deve ter no mínimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n');
define('JS_CITY', '* A \'Cidade\' deve ter no mínimo ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.\n');
define('JS_STATE', '* O \'Estado\' deve ser selecionado.\n');
define('JS_STATE_SELECT', '-- Selecione Acima --');
define('JS_ZONE', '* O \'Estado\' deve ser selecionado através da lista para este País.');
define('JS_COUNTRY', '* O \'País\' deve ser escolhido.\n');
define('JS_TELEPHONE', '* O \'Fone\' deve ter no mínimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.\n');
/*define('JS_TELEPHONE_COMERCIAL', '* O \'Fone\' deve ter no mínimo ' . ENTRY_TELEPHONE_CELULAR_MIN_LENGTH . ' caracteres.\n');
define('JS_TELEPHONE_CELULAR', '* O \'Fone\' deve ter no mínimo ' . ENTRY_TELEPHONE_CELULAR_MIN_LENGTH . ' caracteres.\n'); */
define('JS_PASSWORD', '* A \'Senha\' e \'Confirmação\' devem combinar e ter no mínimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'O número de pedido %s não existe!');

define('CATEGORY_PERSONAL', 'Pessoal');
define('CATEGORY_ADDRESS', 'Endereço');
define('CATEGORY_CONTACT', 'Contato');
define('CATEGORY_COMPANY', 'Companhia');
define('CATEGORY_OPTIONS', 'Opções');

define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">é obrigatório</span>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_DATE_OF_BIRTH', 'Data de nascimento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ex. 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">O endereço de email não parece ser válido!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Este email já existe!</span>');


define('ENTRY_COMPANY', 'Nome da Empresa:');
define('ENTRY_COMPANY_ERROR', '');


define('ENTRY_STREET_ADDRESS', 'Endereço:');
define('ENTRY_STREET_NUMBER', 'Número:');
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

//DEFINIÇOES PARA CADASTRO DE PESSOA JURIDICA
define('ENTRY_RAZAO_SOCIAL', 'Razão Social:');
define('ENTRY_RAZAO_SOCIAL_ERROR', '*');
define('ENTRY_RAZAO_SOCIAL_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_RAZAO_SOCIAL_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_NOME_FANTASIA', 'Nome Fantasia:');
define('ENTRY_NOME_FANTASIA_ERROR', '*');
define('ENTRY_NOME_FANTASIA_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_NOME_FANTASIA_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_INSCRICAO_ESTADUAL', 'Inscrição Estadual:');
define('ENTRY_INSCRICAO_ESTADUAL_ERROR', '');

define('ENTRY_CNPJ', 'CNPJ:');
define('ENTRY_CNPJ_TEXT', ' *');
define('ENTRY_CNPJ_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CNPJ_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_RESPONSAVEL', 'Responsável/Contato:');
define('ENTRY_RESPONSAVEL_TEXT', '*');
define('ENTRY_RESPONSAVEL_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_RESPONSAVEL_MIN_LENGTH . ' caracteres</span>');

define('ENTRY_TELEPHONE2_NUMBER', 'Telefone Comercial:');
define('ENTRY_TELEPHONE2_NUMBER_ERROR', 'Seu telefone comercial deve ter o mínimo de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.');
//-------------------------------------------------------------------------------------//


define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">é obrigatório</span>');
define('ENTRY_COUNTRY', 'País:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone Residencial:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_USER_RVENDEDOR', 'Cliente revendedor:');
define('ENTRY_USER_RVENDEDOR_YES', 'Sim');
define('ENTRY_USER_RVENDEDOR_NO', 'Não');
define('ENTRY_NEWSLETTER_YES', 'Inscrito');
define('ENTRY_NEWSLETTER_NO', 'Não inscrito');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Enviando E-Mail');
define('IMAGE_BACK', 'Voltar');
define('IMAGE_BACKUP', 'Cópia de Segurança');
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
define('IMAGE_MODULE_INSTALL', 'Instalar Módulo');
define('IMAGE_MODULE_REMOVE', 'Remover Módulo');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Novo Banner');
define('IMAGE_NEW_CATEGORY', 'Nova Categoria');
define('IMAGE_NEW_COUNTRY', 'Novo País');
define('IMAGE_NEW_CURRENCY', 'Nova Moeda');
define('IMAGE_NEW_FILE', 'Novo Arquivo');
define('IMAGE_NEW_FOLDER', 'Nova Pasta');
define('IMAGE_NEW_LANGUAGE', 'Nova Língua');
define('IMAGE_NEW_NEWSLETTER', 'Novo Newsletter');
define('IMAGE_NEW_PRODUCT', 'Novo Produto');
define('IMAGE_NEW_TAX_CLASS', 'Nova Classe de Taxas');
define('IMAGE_NEW_TAX_RATE', 'Nova Percentagem de Taxa');
define('IMAGE_NEW_TAX_ZONE', 'Nova Zona de Taxa');
define('IMAGE_NEW_ZONE', 'Nova Zona');
define('IMAGE_ORDERS', 'Pedidos');
define('IMAGE_ORDERS_INVOICE', 'Faturas');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Prévia');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_RESET', 'Resetar');
define('IMAGE_SAVE', 'Salvar');
define('IMAGE_SEARCH', 'Busca');
define('IMAGE_SELECT', 'Selecionar');
define('IMAGE_SEND', 'Enviar');
define('IMAGE_SEND_EMAIL', 'Enviar Email');
define('IMAGE_UNLOCK', 'Destravar');
define('IMAGE_UPDATE', 'Atualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Atualizar Taxa de Câmbio');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CROSS', 'Falso');
define('ICON_CURRENT_FOLDER', 'Pasta atual');
define('ICON_DELETE', 'Deletar');
define('ICON_ERROR', 'Erro');
define('ICON_FILE', 'Arquivo');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Pasta');
define('ICON_LOCKED', 'Travado');
define('ICON_PREVIOUS_LEVEL', 'Nível atual');
define('ICON_PREVIEW', 'Prévia');
define('ICON_STATISTICS', 'Estatísticas');
define('ICON_SUCCESS', 'Sucesso');
define('ICON_TICK', 'Verdade');
define('ICON_UNLOCKED', 'Destravado');
define('ICON_WARNING', 'Atenção');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Página %s de %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> banners)');
define('TEXT_DISPLAY_PARTNERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> parceiros)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> países)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> moedas)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> línguas)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> fabricantes)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> status de pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> produtos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> produtos esperados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> produtos comentados)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> produtos em promoção)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> classes de taxas)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> taxas de estado)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> percentagem de taxas)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> estados)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'padrão');
define('TEXT_SET_DEFAULT', 'Configurar como padrão');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Obrigatório</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erro: Não há moeda configurada no momento. Por favor, configure uma em: Ferramentas Administrativas->Localizações->Moedas');

define('TEXT_CACHE_CATEGORIES', 'Categorias');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'Módulo também adquirido');

define('TEXT_NONE', '--nenhum--');
define('TEXT_TOP', 'Selecione uma categoria');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Erro: Destino não existe.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Erro: Não é permitido escrever neste destino.');
define('ERROR_FILE_NOT_SAVED', 'Erro: Upload não foi salvo.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Erro: Tipo de arquivo para upload não permitido.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Successo: Upload salvo com sucesso.');
define('WARNING_NO_FILE_UPLOADED', 'Atenção: Nenhum arquivo foi enviado.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Atenção: Upload de arquivos estão desabilitados no php.ini .');
define('HEADER_TITLE_STOCK', 'Conferir estoque');

define('BOX_CATALOG_QUICK_STOCKUPDATE', 'Atualização Estoque');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_EXTRA_IMAGES','Imagens extras');

// polls box text in includes/boxes/polls.php
define('BOX_HEADING_POLLS', 'Enquetes');
define('BOX_POLLS_POLLS', 'Administração de Enquetes');
define('BOX_POLLS_CONFIG','Configuração de Enquetes');

define('BOX_TOOLS_CREATE_NEWS', 'Administração de Notícias');



//kgt - discount coupons
define('BOX_CATALOG_DISCOUNT_COUPONS', 'Cupom de Desconto');
//end kgt - discount coupons

//kgt - discount coupons report
define('BOX_REPORTS_DISCOUNT_COUPONS', 'Cupom de Desconto');
//end kgt - discount coupons report

define('IMAGE_GOOGLE_DIRECTIONS', 'Google Mapas de Entrega');

// BOF Quick Attributes

define('IMAGE_ICON_QUICK_ATTRIBUTE', 'Adicionar atributo rápido');

// EOF Quick Attributes

/*** Begin Header Tags SEO ***/
// header_tags_seo text in includes/boxes/header_tags_seo.php
define('BOX_HEADING_HEADER_TAGS_SEO', 'Google - Otimização');
define('BOX_HEADER_TAGS_ADD_A_PAGE', 'Google - Painel de Controle');
define('BOX_HEADER_TAGS_SILO', 'Google - Silo Control');
define('BOX_HEADER_TAGS_FILL_TAGS', 'Google - Preencher Tags');
define('BOX_HEADER_TAGS_TEST', 'Testar');
/*** End Header Tags SEO ***/

define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Controle de multiplos produtos');

define('BOX_TOOLS_GOOGLE_FEED', 'Google Feed Produtos');
?>
