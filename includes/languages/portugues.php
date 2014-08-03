<?php

/***************************************************************************/
/*                                                                         */
/*  osCommerce, Open Source E-Commerce Solutions                           */
/*  http://www.oscommerce.com                                              */
/*  Released under the GNU General Public License                          */
/*                                                                         */
/*  Translation Brazilian by:                                              */
/*  Tradução Para o Português Brasil por:                                  */
/*  Reginaldo Gomes (Envoy) envoy@phpmania.org | http://phpmania.org       */
/*  osCommerce 2.2 Milestone 2 Português-Brasil Versão PHPmania.org        */
/*                                                                         */
/***************************************************************************/

@setlocale(LC_TIME, 'pt_BR');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}



// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'BR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="br"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Criar uma conta');
define('HEADER_TITLE_MY_ACCOUNT', 'Minha Conta');
define('HEADER_TITLE_CART_CONTENTS', 'Suas Compras');
define('HEADER_TITLE_CHECKOUT', 'Realizar Pedido');
define('HEADER_TITLE_TOP', 'Home');
define('HEADER_TITLE_CATALOG', 'Loja');
define('HEADER_TITLE_LOGOFF', 'Sair');
define('HEADER_TITLE_LOGIN', 'Entrar');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'visitas desde');

// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');
define('MALE_ADDRESS', 'Sr.');
define('FEMALE_ADDRESS', 'Sra.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorias');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricantes');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Novidades');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Busca Rápida');
define('BOX_SEARCH_TEXT', 'Use palavras-chave para achar o que procura.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Busca Avançada1');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Promoções');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Comentário');
define('BOX_REVIEWS_WRITE_REVIEW', 'Escreva um comentário neste produto!');
define('BOX_REVIEWS_NO_REVIEWS', 'Não há comentários atualizados para este produto');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s de 5 Estrelas!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Suas Compras');
define('BOX_SHOPPING_CART_EMPTY', '0 itens');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Histórico de Pedidos');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Mais Vendidos');
define('BOX_HEADING_BESTSELLERS_IN', 'Mias Vendidos em<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notificações');
define('BOX_NOTIFICATIONS_NOTIFY', 'Notifique-me de atualidades para<b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Notifique-me de atualidades para<b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Informações de Fabricante');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Outros produtos');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Idiomas');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Moedas');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informações');
define('BOX_INFORMATION_PRIVACY', 'Notas de Privacidade');
define('BOX_INFORMATION_CONDITIONS', 'Condições de Uso');
define('BOX_INFORMATION_SHIPPING', 'Fretes e Devoluções');
define('BOX_INFORMATION_CONTACT', 'Fale Conosco');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Indique a um amigo');
define('BOX_TELL_A_FRIEND_TEXT', 'Diga para alguém que você conheça sobre esse produto.');


define('BOX_HEADING_TIPS', 'Comentários');
define('BOX_TIPS_NO_TIPS', 'Sem comentários');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', '<b>(1º) </b> Formas Entrega');
define('CHECKOUT_BAR_PAYMENT', '<b>(2º) </b>Formas Pagamento');
define('CHECKOUT_BAR_CONFIRMATION', '<b>(3º) </b> Confirmação');
define('CHECKOUT_BAR_FINISHED', '<b>Terminado!</b>');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Por favor selecione');
define('TYPE_BELOW', 'Digite abaixo');

// javascript messages
define('JS_ERROR', 'Erros ocorreram durante o envio de seu formulário.\n\nPor favor, faça as seguintes correções:\n\n');

define('JS_REVIEW_TEXT', '* O \'Review Text\' deve ter no mínimo ' . REVIEW_TEXT_MIN_LENGTH . ' caracteres.\n');
define('JS_REVIEW_RATING', '* Você deve cotar o produto para seu comentário.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor, selecione a forma de pagamento para seu pedido.\n');

define('JS_ERROR_SUBMITTED', 'Este formulário já foi enviado. Por favor pressione OK e aguarde o processo ser completado.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor, selecione a forma de pagamento para seu pedido.');

define('CATEGORY_COMPANY', 'Detalhes da Empresa');
define('CATEGORY_PERSONAL', 'Seus detalhes Pessoais');
define('CATEGORY_ADDRESS', 'Seu Endereço');
define('CATEGORY_CONTACT', 'Suas Informações de Contato');
define('CATEGORY_OPTIONS', 'Opções');
define('CATEGORY_PASSWORD', 'Sua Senha');

define('ENTRY_COMPANY', 'Nome da Empresa:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', 'Por favor selecione o sexo.');
define('ENTRY_TPCADASTRO_ERROR', 'Por favor selecione um tipo de cadastro.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', 'Seu nome deve conter o mínimo de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_ERROR', 'Seu sobrenome deve ter o mínimo de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Data de Nascimento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Sua data de nascimento deve ser neste formato: DD/MM/YYYY (ex 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (ex. 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Seu E-Mail deve conter o mínimo de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Seu E-mail não parece ser válido - Por favor, faça as correções necessárias.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Seu E-mail já existe em nossa base de dados - por favor, entre com seu e-mail ou crie uma conta com endereço diferente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Endereço:');
define('ENTRY_STREET_NUMBER', 'Número:');
define('ENTRY_STREET_CPF', 'CPF:');
define('ENTRY_STREET_RG', 'RG:');
define('ENTRY_STREET_CPF_ERROR', 'Seu CPF deve ter o mínimo de ' . ENTRY_STREET_CPF_MIN_LENGTH . ' caracteres.');
define('ENTRY_STREET_RG_ERROR', 'Seu RG deve ter o mínimo de ' . ENTRY_STREET_RG_MIN_LENGTH . ' caracteres.');
define('ENTRY_STREET_ADDRESS_ERROR', 'Seu endereço deve ter o mínimo de ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.');

define('ENTRY_STREET_NUMBER_ERROR', 'O campo número deve ter o mínimo de ' . ENTRY_STREET_NUMBER_MIN_LENGTH . ' caracteres.');
define('ENTRY_STREET_NUMBER_TEXT', '*');

define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS_CPF', ' *');
define('ENTRY_STREET_ADDRESS_RG', '*');
define('ENTRY_SUBURB', 'Bairro:');
define('ENTRY_COMPLEMENTO', 'Complemento:');
define('ENTRY_COMPLEMENTO_ERROR', '');
define('ENTRY_COMPLEMENTO_TEXT', '');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_ERROR', 'Seu CEP deve ter o mínimo de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_ERROR', 'Sua cidade deve ter o mínimo de ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_ERROR', 'Seu estado deve ter o mínimo de ' . ENTRY_STATE_MIN_LENGTH . ' caracteres.');
//define('ENTRY_STATE_ERROR_SELECT', 'Por favor selecione um estado');
define('ENTRY_STATE_ERROR_SELECT', 'Informe a sigla correta do seu estado.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'País:');
define('ENTRY_COUNTRY_ERROR', 'Você deve selecionar um país da lista abaixo.');
define('ENTRY_COUNTRY_TEXT', '*');

//DEFINIÇOES PARA CADASTRO DE PESSOA JURIDICA

define('ENTRY_RAZAO_SOCIAL', 'Razão Social:');
define('ENTRY_RAZAO_SOCIAL_TEXT', '*');
define('ENTRY_RAZAO_SOCIAL_ERROR', 'Seu campo Razão Social deve ter o mínimo de ' . ENTRY_RAZAO_SOCIAL_MIN_LENGTH . ' caracteres.');

define('ENTRY_NOME_FANTASIA', 'Nome Fantasia:');
define('ENTRY_NOME_FANTASIA_TEXT', '*');
define('ENTRY_NOME_FANTASIA_ERROR', 'Seu campo Nome Fantasia deve ter o mínimo de ' . ENTRY_NOME_FANTASIA_MIN_LENGTH . ' caracteres.');

define('ENTRY_INSCRICAO_ESTADUAL', 'Inscrição Estadual:');
define('ENTRY_INSCRICAO_ESTADUAL_TEXT', '');
define('ENTRY_INSCRICAO_ESTADUAL_ERROR', 'Seu campo Inscrição Estadual deve ter o mínimo de ' . ENTRY_INSCRICAO_ESTADUAL_MIN_LENGTH . ' caracteres.');

define('ENTRY_CNPJ', 'CNPJ:');
define('ENTRY_CNPJ_TEXT', ' *');
define('ENTRY_CNPJ_ERROR', 'Seu campo CNPJ deve ter o mínimo de ' . ENTRY_CNPJ_MIN_LENGTH . ' caracteres.');

define('ENTRY_RESPONSAVEL', 'Responsavel/Contato:');
define('ENTRY_RESPONSAVEL_TEXT', '*');
define('ENTRY_RESPONSAVEL_ERROR', 'Seu campo Responsavel deve ter o mínimo de ' . ENTRY_RESPONSAVEL_MIN_LENGTH . ' caracteres.');

define('ENTRY_TELEPHONE2_NUMBER', 'Telefone Comercial:');
define('ENTRY_TELEPHONE2_NUMBER_ERROR', 'Seu telefone comercial deve ter o mínimo de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.');
//-------------------------------------------------------------------------------------//

define('ENTRY_TELEPHONE_NUMBER', 'Telefone Residencial:');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Seu telefone residencial deve ter o mínimo de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.');


define('ENTRY_TELEPHONE_COMERCIAL_NUMBER', 'Telefone Comercial:');
define('ENTRY_TELEPHONE_COMERCIAL_NUMBER_ERROR', '');
define('ENTRY_TELEPHONE_COMERCIAL_NUMBER_TEXT', '');

define('ENTRY_TELEPHONE_CELULAR_NUMBER', 'Celular:');
define('ENTRY_TELEPHONE_CELULAR_NUMBER_ERROR', 'Seu telefone celular deve ter o mínimo de ' . ENTRY_TELEPHONE_COMERCIAL_MIN_LENGTH . ' caracteres.');
define('ENTRY_TELEPHONE_CELULAR_NUMBER_TEXT', '');




define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Receber e-mails promocionais:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Inscrito');
define('ENTRY_NEWSLETTER_NO', 'Não Inscrito');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Senha:');
define('ENTRY_PASSWORD_ERROR', 'Sua senha deve ter o mínimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'A confirmação de senha deve combinar com sua senha.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirmação de Senha:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Senha atual:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Sua senha deve ter o mínimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_NEW', 'Nova senha:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Sua nova senha deve ter o mínimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'A confirmação de senha deve combinar com sua senha.');
define('PASSWORD_HIDDEN', '--HIDDEN--');

define('FORM_REQUIRED_INFORMATION', '* Preenchimento obrigatório');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Páginas:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Mostrando<b>%d</b> para <b>%d</b> (de <b>%d</b> produtos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> comentários)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Mostrando<b>%d</b> para <b>%d</b> (de <b>%d</b> novos produtos)');
define('TEXT_DISPLAY_NUMBER_OF_PHOTOS', 'Mostrando<b>%d</b> para <b>%d</b> (de <b>%d</b> novas fotos)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Mostrando <b>%d</b> para <b>%d</b> (de <b>%d</b> especiais)');
define('PREVNEXT_TITLE_FIRST_PAGE', 'Primeira Página');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Página Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Próxima Página');
define('PREVNEXT_TITLE_LAST_PAGE', 'Última Página');
define('PREVNEXT_TITLE_PAGE_NO', 'Página %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Conjunto Anterior de %d páginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Próximo Conjunto de %d páginas');
//define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRIMEIRO');
define('PREVNEXT_BUTTON_FIRST', 'PRIMEIRO');
define('PREVNEXT_BUTTON_PREV', '[ANTERIOR]');
define('PREVNEXT_BUTTON_NEXT', '[PRÓXIMO]');
//define('PREVNEXT_BUTTON_LAST', 'ÚLTIMO&gt;&gt;');
define('PREVNEXT_BUTTON_LAST', 'ÚLTIMO');


define('IMAGE_BUTTON_ADD_ADDRESS', 'Adicionar endereço');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Livro de Endereços');
define('IMAGE_BUTTON_BACK', 'Voltar');
define('IMAGE_BUTTON_BUY_NOW', 'Compre Agora');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Mudar Endereço');
define('IMAGE_BUTTON_CHECKOUT', 'Realizar Pedido');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmar Pedido');
define('IMAGE_BUTTON_CONTINUE', 'Continuar');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continuar Comprando');
define('IMAGE_BUTTON_DELETE', 'Apagar');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Editar Conta');
define('IMAGE_BUTTON_HISTORY', 'Histórico de Pedidos');
define('IMAGE_BUTTON_LOGIN', 'Assinar');
define('IMAGE_BUTTON_IN_CART', 'Adicionar ao carrinho');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notificações');
define('IMAGE_BUTTON_QUICK_FIND', 'Busca Rápida');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Remover Notificações');
define('IMAGE_BUTTON_REVIEWS', 'Comentários');
define('IMAGE_BUTTON_SEARCH', 'Busca');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Opções de Envio');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Contar para um amigo');
define('IMAGE_BUTTON_UPDATE', 'Atualizar');
define('IMAGE_BUTTON_UPDATE_CART', 'Atualizar Carrinho');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Escrever comentário');

define('SMALL_IMAGE_BUTTON_DELETE', 'Apagar');
define('SMALL_IMAGE_BUTTON_EDIT', 'Editar');
define('SMALL_IMAGE_BUTTON_VIEW', 'Ver');

define('ICON_ARROW_RIGHT', 'mais');
define('ICON_CART', 'No carrinho');
define('ICON_ERROR', 'Erro');
define('ICON_SUCCESS', 'Sucesso');
define('ICON_WARNING', 'Atenção');

define('TEXT_GREETING_PERSONAL', 'Bem-vindo de volta <span class="greetUser">%s!</span>Você gostaria de ver quais <a href="%s"><u> novos produtos</u></a> estão disponíveis para comprar?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Se você não é %s, por favor<a href="%s"><u>faça o login</u></a>com sua conta.</small>');
define('TEXT_GREETING_GUEST', 'Bem-vindo <span class="greetUser">Convidado!</span>Gostaria de <a href="%s"><u>fazer o login</u></a>? Ou prefere <a href="%s"><u>criar uma conta</u></a>?');

define('TEXT_SORT_PRODUCTS', 'Produtos sortidos');
define('TEXT_DESCENDINGLY', 'Descendente');
define('TEXT_ASCENDINGLY', 'Ascendente');
define('TEXT_BY', ' por ');
define('TEXT_FREE_SHIPPING_TO_BRASIL','Produto promocional com frete grátis para todo o Brasil, compre agora !!');

define('TEXT_REVIEW_BY', 'por %s');
define('TEXT_REVIEW_WORD_COUNT', '%s palavras');
define('TEXT_REVIEW_RATING', 'Cotar: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Data adicionada: %s');
define('TEXT_NO_REVIEWS', 'Não existe comentários para este produto.<br /> Seja o primeiro a comentar.');

define('TEXT_NO_NEW_PRODUCTS', 'Não há produtos.');

define('TEXT_UNKNOWN_TAX_RATE', 'Taxa desconhecida');

define('TEXT_REQUIRED', '<span class="errorText">Requerido</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERRO:</small> Não é posspivel enviar o email através do servidor SMTP especificado. Por favor, cheque seu php.ini e corrija o servidor STMP se necessário.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Atenção: Diretório de instalação existente em: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/install. por favor, remova o diretório por razões de segurança.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Atenção: Eu estou apto a reescrever os arquivos de configuração: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. Este é um risco de segurança - por favor, configure permissão de usuários para esse arquivo.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Atenção: o diretório de sessions  não existe: ' . tep_session_save_path() . '. Sessions não funcionarão se o diretório não for criado.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Atenção: Estou estou apto a reescrever o diretório de sessions: ' . tep_session_save_path() . '. Sessions não funcionarão se você não configurar corretamente as permissões de usuário.');
define('WARNING_SESSION_AUTO_START', 'Atenção: session.auto_start está habilitado - por favor desabilite esta função no php.ini e restarte seu web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Atenção: O diretório de produtos não existe: ' . DIR_FS_DOWNLOAD . '. Os produtos não funcionarão se você não tornar o diretório válido.');

/* Por favor não remova o copyright do autor e dos desenvolvedores do sistema oscommerce - Respeite o GNU General Public License */
define('FOOTER_TEXT_BODY', '<font color="#595959">Copyright &copy; </font> <a href="http://www.oscommerce.com" target="_blank"><font color="#595959">osCommerce</a></font><br> <a href="http://www.phpmania.org"target="_blank"><font color="#595959">Versão 2.2 MS2-BR Por PHPmania</a>');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'A data de validade colocada para o cartão de crédito é inválida.<br>Por favor, veja a data de  e tente de novo.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'O número do cartão de crédito é inválido.<br>Por favor, verifique o número e tente novamente.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Os primeiros 4 dígitos do número entrado são: %s.  Se o número estiver correto, Não não aceitamos este tipo de cartão de crédito. Se estiver errado, tente de novo.');

define('BOX_HEADING_LOGIN', 'Entrar');
define('BOX_HEADING_LOGED', 'Minha conta');
define('BOX_HEADING_WELLCOME', 'Bem-vindo!');
define('BOX_LOGIN_USERNAME', 'Seu Email');
define('BOX_LOGIN_PASSWORD', 'Senha');
define('BOX_LOGIN_NEWACCOUNT', 'Cadastre-se');
define('BOX_LOGIN_PASSWORD_FORGOTTEN', 'Esqueceu a senha?');
define('BOX_LOGIN_LOGOUT', 'Sair');
define('BOX_LOGIN_VIEW', 'Ver minha conta');

define('BOX_HEADING_EXTRA','Favoritos');
define('BOX_EXTRA_FAVOURITES','Adicionar aos Favoritos');
define('BOX_EXTRA_STARTPAGE','Definir como Página Inicial');

define('BOX_HEADING_WHOS_ONLINE', 'Quem está online');
define('BOX_WHOS_ONLINE_THEREIS', 'No momento há<br>');
define('BOX_WHOS_ONLINE_THEREARE', 'No momento há<br>');
define('BOX_WHOS_ONLINE_GUEST', 'Visitante');
define('BOX_WHOS_ONLINE_GUESTS', 'Visitantes');
define('BOX_WHOS_ONLINE_AND', 'e');
define('BOX_WHOS_ONLINE_MEMBER', 'Cliente');
define('BOX_WHOS_ONLINE_MEMBERS', 'Clientes');

define('TEXT_EXTRA_IMAGES', 'Imagens Extras');


// Poll Box Text
define('_RESULTS', 'Resultados');
define('_POLLS','Enquetes');
define('_VOTE', 'VOTAR');
define('_VOTES', 'Votos');
define('_NOPOLLS','Nenhuma enquete elegível');
define('_NOPOLLSCONTENT','Não existem pesquisas que você está qualificado para, no entanto você ainda pode ver os resultados de outras sondagens<br><br><a href="pollbooth.php">['._POLLS.']');

define('BOX_HEADING_POLLS', 'Enquetes');
define('BOX_POLLS_POLLS', 'Administrador da enquete.');
define('BOX_POLLS_CONFIG','Configuração da equete.');


//kgt - discount coupons
define('ENTRY_DISCOUNT_COUPON_ERROR', 'O código de cupom que você digitou não é válido.');
define('ENTRY_DISCOUNT_COUPON_AVAILABLE_ERROR', 'O código de cupom que você digitou não é válido.');
define('ENTRY_DISCOUNT_COUPON_USE_ERROR', 'Nossos registros mostram que você já usou este cupom %s vez(es).  Você não pode usar esse código mais %s vez(es).');
define('ENTRY_DISCOUNT_COUPON_MIN_PRICE_ERROR', 'O total mínimo de ordem para esse cupom é %s');
define('ENTRY_DISCOUNT_COUPON_MIN_QUANTITY_ERROR', 'O número mínimo de produtos necessários para este cupom é %s');
define('ENTRY_DISCOUNT_COUPON_EXCLUSION_ERROR', 'Alguns ou todos os produtos no seu carrinho são excluídos' );
define('ENTRY_DISCOUNT_COUPON', 'Código do Cupom:');
define('ENTRY_DISCOUNT_COUPON_SHIPPING_CALC_ERROR', 'Suas taxas de transporte calculadas mudaram.');
//end kgt - discount coupons


define('TEXT_SEE_MORE', 'Veja Mais');

?>
