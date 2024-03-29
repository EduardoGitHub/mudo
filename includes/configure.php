<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_URL_EMAIL_ORDER', 'http://loja.mudominhacasa');
  define('HTTPS_URL_EMAIL_ORDER', 'https://loja.mudominhacasa');
  define('HTTP_SERVER_PRODUTOS', 'images/ImgProdutos/');
  define('HTTP_SERVER_IMAGES', ' images/');
  define('HTTP_SERVER', 'http://loja.mudominhacasa'); // eg, http://localhost - should not be empty for productive servers
  define('HTTPS_SERVER', 'https://loja.mudominhacasa'); // eg, https://localhost - should not be empty for productive servers
  define('ENABLE_SSL', false); // secure webserver for checkout procedure?
  define('HTTP_COOKIE_DOMAIN', 'loja.mudominhacasa');
  define('HTTPS_COOKIE_DOMAIN', 'loja.mudominhacasa');
  define('HTTP_COOKIE_PATH', 'wwwloja');
  define('HTTPS_COOKIE_PATH', 'wwwloja');
  define('DIR_WS_HTTP_CATALOG', '/');
  define('DIR_WS_HTTPS_CATALOG', '/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_COMUM', 'comum/');
  define('DIR_WS_IMAGES_PRODUTOS', 'images/ImgProdutos/');
  define('DIR_WS_IMAGES_BANNERS', 'images/Banners/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', 'C:/inetpub/wwwroot/Lojas/MudoMinhaCasa/v4/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

// define our database connection
  define('DB_SERVER', 'localhost:3308'); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '1234');
  define('DB_DATABASE', 'loja_mudominhacasa');
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
?>