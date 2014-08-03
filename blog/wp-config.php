<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'loja_mudominhacasablog');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'lj_mudo');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'loja@8721');

/** nome do host do MySQL */
define('DB_HOST', 'localhost:3307');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+m?cX~0>H:{oe/1YLjRLr}-)Ay_4*4a|K!X4d=r`1odq]}32:i-v)a90i4Z{)%b7');
define('SECURE_AUTH_KEY',  '@qym?n{l{ZkvF*wRx_JwoEep:emBa2lHqC=n,~{2_r)DDSb%ZZoJ>uH?;|L+Qqni');
define('LOGGED_IN_KEY',    ';};{@?M2s$4oapJagwcNW;3$g~mB|NM;H?W%$Q-ti8IwGy_ /<E`e30jzRlaf?rq');
define('NONCE_KEY',        'W|D</`(ZCzX_P-]2/%E&~!</2?f?~S/tQ&S[+j1cHar@![wP3qVDrA2<xgp#Dci0');
define('AUTH_SALT',        'rXA]VeD]QoSu2oWVi7fA^qk*;:ya/gYc6v5dlz+~4,(]CmR~o<U#gJ~W7`6Bu>Rm');
define('SECURE_AUTH_SALT', 'Vy{k-:r*u4-KaadO`ji:Gj#-@U2O42SLR^*{4@ADQA]Eu#{fgGoC{d#Sg&JTFXaZ');
define('LOGGED_IN_SALT',   'XA,gVX*_iSvZ;Cb#n)gZHWx>InjD<NChP3*C]qvSGF%st_P[,=5v/iX`yRI;-lz)');
define('NONCE_SALT',       'ZJS1t@o<BjZ-`W#Otp4NV[RZjNia>#]K>/gps e::Cj9(_v*F7^P~6!BPs,Y((-0');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
