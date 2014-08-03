<?php
  /*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL).

  define('HTTP_URL_EMAIL_ORDER', 'http://loja.mudominhacasa/');
  define('HTTPS_URL_EMAIL_ORDER', 'https://loja.mudominhacasa/');
  define('HTTP_SERVER', 'http://loja.mudominhacasa'); // eg, http://localhost - should not be empty for productive servers
  define('HTTP_CATALOG_SERVER', 'http://loja.mudominhacasa');
  define('HTTPS_CATALOG_SERVER', 'https://loja.mudominhacasa');
  define('HTTP_SERVER_PRODUTOS', '../images/ImgProdutos/');
  define('HTTP_SERVER_IMAGES', '../images/');
  define('ENABLE_SSL_CATALOG', false); // secure webserver for catalog module
  define('DIR_FS_DOCUMENT_ROOT', 'C:/inetpub/wwwroot/Lojas/MudoMinhaCasa/v4/'); // where the pages are located on the server
  define('DIR_WS_ADMIN', '/admin/'); // absolute path required
  define('DIR_FS_ADMIN', 'C:/inetpub/wwwroot/Lojas/MudoMinhaCasa/v4/admin/'); // absolute pate required
  define('DIR_WS_CATALOG', 'http://loja.mudominhacasa/'); // absolute path required
  define('DIR_FS_CATALOG', 'C:/inetpub/wwwroot/Lojas/MudoMinhaCasa/v4/'); // absolute path required
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_IMAGES_PRODUTOS', 'images/Imgprodutos/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/Imgprodutos/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/Imgprodutos/');
  define('DIR_FS_CATALOG_BANNERS', DIR_FS_CATALOG . 'images/Banners/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  
  define('HTTP_SERVER', 'http://loja.mudominhacasa'); // eg, http://localhost - should not be empty for productive servers
  define('HTTPS_SERVER', 'https://loja.mudominhacasa'); // eg, https://localhost - should not be empty for productive servers
  define('DIR_WS_HTTPS_CATALOG', '/');

// define our database connection
  define('DB_SERVER', 'localhost:3308'); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '1234');
  define('DB_DATABASE', 'loja_mudominhacasa');
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
?>