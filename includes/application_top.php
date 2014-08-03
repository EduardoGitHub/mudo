<?php
/*
  $Id: application_top.php,v 1.280 2003/07/12 09:38:07 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// start the timer for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime());




// set the level of error reporting
  //error_reporting(E_ALL & ~E_NOTICE);

// check if register_globals is enabled.
// since this is a temporary measure this message is hardcoded. The requirement will be removed before 2.2 is finalized.
  /*
  if (function_exists('ini_get')) {
    ini_get('register_globals') or exit('FATAL ERROR: register_globals is disabled in php.ini, please enable it!');
  }
  */
  
  

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/configure.php')) include('includes/configure.php');

// include server parameters
  if (strlen(DB_SERVER) < 1) {
    if (is_dir('install')) {
      header('Location: install/index.php');
    }
  }
  
  include(DIR_WS_CLASSES.'resize.php');
  
  //redirecto
  $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];


  switch ($url) {
        case 'www.mudominhacasa.com.br/budget.php':
               Header( "HTTP/1.1 301 Moved Permanently" );
               Header( "Location: http://www.mudominhacasa.com.br/produtos-personalizados.php" );
			break;
        case 'www.mudominhacasa.com.br/budget.php?opcao=1':
               Header( "HTTP/1.1 301 Moved Permanently" );
               Header( "Location: http://www.mudominhacasa.com.br/projetos-corporativos.php" );
			break;
		case 'www.mudominhacasa.com.br/budget.php?opcao=2':
               Header( "HTTP/1.1 301 Moved Permanently" );
               Header( "Location: http://www.mudominhacasa.com.br/frases.php" );
			break;
		case 'www.mudominhacasa.com.br/budget.php?opcao=3':
               Header( "HTTP/1.1 301 Moved Permanently" );
               Header( "Location: http://www.mudominhacasa.com.br/foto-art.php" );
			break;
		case 'www.mudominhacasa.com.br/budget.php?opcao=4':
               Header( "HTTP/1.1 301 Moved Permanently" );
               Header( "Location: http://www.mudominhacasa.com.br/foto-wall.php" );
			break;
		case 'www.mudominhacasa.com.br/budget.php?opcao=6':
               Header( "HTTP/1.1 301 Moved Permanently" );
               Header( "Location: http://www.mudominhacasa.com.br/produtos-personalizados.php" );
			break;
		case 'www.mudominhacasa.com.br/budget.php?opcao=7':
               Header( "HTTP/1.1 301 Moved Permanently" );
               Header( "Location: http://www.mudominhacasa.com.br/alterar-tamanho-de-sua-imagem.php" );
			break;
		case 'www.mudominhacasa.com.br/budget.php?opcao=8':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/envie-seu-modelo.php" );
        break;
        case 'www.mudominhacasa.com.br/advanced_search.php':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/busca-avancada.html" );
        break;
        case 'www.mudominhacasa.com.br/products_new.php':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/produtos-em-destaque.html" );
        break;
        case 'www.mudominhacasa.com.br/specials.php':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/promocao.html" );
        break;
        case 'www.mudominhacasa.com.br/shopping_cart.php':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/meu-carrinho-de-compras.html" );
        break;
        case 'www.mudominhacasa.com.br/contact_us.php':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/fale-conosco.html" );
        break;
        case 'www.mudominhacasa.com.br/mmc_gallery.php':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/galeria-de-fotos.php" );
        break;
        case 'www.mudominhacasa.com.br/mmc_paletadecores.php':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/paleta-de-cores.php" );
        break;
        case 'www.mudominhacasa.com.br/mmc_colarseummc.php':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/como-aplicar.php" );
        break;
		case 'www.mudominhacasa.com.br/adesivo-mimica-p-585.html':
		case 'www.mudominhacasa.com.br/adesivo-fusquinha-p-947.html':
		case 'www.mudominhacasa.com.br/adesivo-felizes-jardim-encantado-p-718.html':
		case 'www.mudominhacasa.com.br/adesivo-pedalando-p-371.html':
		case 'www.mudominhacasa.com.br/adesivo-decorando-cozinha-p-209.html':
		case 'www.mudominhacasa.com.br/adesivo-tres-corujas-p-795.html':
		case 'www.mudominhacasa.com.br/adesivo-borboleta-rainha-p-316.html':
		case 'www.mudominhacasa.com.br/adesivo-maquinista-p-1038.html':
		case 'www.mudominhacasa.com.br/adesivo-garcon-perfeito-p-390.html':
		case 'www.mudominhacasa.com.br/adesivo-ninho-passaros-p-789.html':
		case 'www.mudominhacasa.com.br/adesivo-passarinho-p-717.html':
		case 'www.mudominhacasa.com.br/adesivo-arvore-colorida-p-939.html':
		case 'www.mudominhacasa.com.br/adesivo-entrelacado-p-201.html':
		case 'www.mudominhacasa.com.br/adesivo-turma-monica-p-1047.html':
		case 'www.mudominhacasa.com.br/adesivo-arvore-amor-p-720.html':
		case 'www.mudominhacasa.com.br/adesivo-arvore-amor-p-720.html':
		case 'www.mudominhacasa.com.br/adesivo-carte-p-338.html':
		case 'www.mudominhacasa.com.br/adesivo-pinguim-geladeira-p-241.html':
		case 'www.mudominhacasa.com.br/adesivo-arco-iris-p-806.html':
		case 'www.mudominhacasa.com.br/adesivo-formiguinhas-p-874.html':
		case 'www.mudominhacasa.com.br/adesivo-caminhando-chuva-p-1016.html':
		case 'www.mudominhacasa.com.br/adesivo-mickey-minnie-p-1042.html':
		case 'www.mudominhacasa.com.br/adesivo-corujas-namoradeiras-p-1002.html':
		case 'www.mudominhacasa.com.br/adesivo-passarinho-nuvens-p-955.html':
		case 'www.mudominhacasa.com.br/adesivo-arvoresco-p-974.html':
		case 'www.mudominhacasa.com.br/adesivo-passeio-cidade-p-1005.html':
		case 'www.mudominhacasa.com.br/adesivo-monica-p-1041.html':
		case 'www.mudominhacasa.com.br/adesivo-frank-sinatra-p-628.html':
		case 'www.mudominhacasa.com.br/adesivo-flores-circulares-p-781.html':
		case 'www.mudominhacasa.com.br/adesivo-irado-p-401.html':
		case 'www.mudominhacasa.com.br/adesivo-tres-rosas-p-908.html':
		case 'www.mudominhacasa.com.br/adesivo-flor-ornamental-p-1124.html':
		case 'www.mudominhacasa.com.br/adesivo-pernas-quero-p-174.html':
		case 'www.mudominhacasa.com.br/adesivo-ramo-p-910.html':
		case 'www.mudominhacasa.com.br/adesivo-padeiro-caprichoso-p-239.html':
		case 'www.mudominhacasa.com.br/adesivo-recanto-passaro-cantor-p-909.html':
		case 'www.mudominhacasa.com.br/adesivo-jardim-silueta-p-981.html':
		case 'www.mudominhacasa.com.br/adesivo-coracao-galinha-p-987.html':
		case 'www.mudominhacasa.com.br/adesivo-banda-animais-p-995.html':
		case 'www.mudominhacasa.com.br/adesivo-girafa-savana-p-724.html':
		case 'www.mudominhacasa.com.br/adesivo-geisha-p-980.html':
		case 'www.mudominhacasa.com.br/adesivo-mahatma-gandhi-p-669.html':
		case 'www.mudominhacasa.com.br/adesivo-radical-bikes-p-942.html':
		case 'www.mudominhacasa.com.br/adesivo-gato-preto-p-1011.html':
		case 'www.mudominhacasa.com.br/adesivo-tres-florzinhas-p-906.html':
		case 'www.mudominhacasa.com.br/adesivo-palhacos-p-846.html':
		case 'www.mudominhacasa.com.br/adesivo-recanto-passaros-p-1055.html':
		case 'www.mudominhacasa.com.br/adesivo-gato-peixes-p-411.html':
		case 'www.mudominhacasa.com.br/adesivo-maluco-p-836.html':
		case 'www.mudominhacasa.com.br/adesivo-menino-cachorro-p-790.html':
		case 'www.mudominhacasa.com.br/adesivo-ornamento-p-893.html':
		case 'www.mudominhacasa.com.br/adesivo-motoqueiro-vintage-p-1022.html':
		case 'www.mudominhacasa.com.br/adesivo-gatinhos-p-1025.html':
		case 'www.mudominhacasa.com.br/adesivo-coyote-papa-leguas-p-1034.html':
		case 'www.mudominhacasa.com.br/adesivo-pernalonga-p-1036.html':
		case 'www.mudominhacasa.com.br/adesivo-pateta-p-1037.html':
		case 'www.mudominhacasa.com.br/-c-52.html':
		case 'www.mudominhacasa.com.br/-c-2_50.html':
		case 'www.mudominhacasa.com.br/Adesivos':
		case 'www.mudominhacasa.com.br/images/ImgProdutos/cartela.ai?osCsid=9ba5fd90315398e90806fc42e18d6682':
		case 'www.mudominhacasa.com.br/function.imagejpeg':
		case 'www.mudominhacasa.com.br/function.include':
		case 'www.mudominhacasa.com.br/function.copy':
		case 'www.mudominhacasa.com.br/embalagem':
		case 'www.mudominhacasa.com.br/product_info.php%3Fproducts_id%3D444%26produto%3DADESIVO_ESCUDO_DO_FLUMINENSE':
		case 'www.mudominhacasa.com.br/function.require':
		case 'www.mudominhacasa.com.br/adesivo--c-2_51.html':
		case 'www.mudominhacasa.com.br/adesivo--c-2_46.html':
		case 'www.mudominhacasa.com.br/adesivo--c-29_30.html':
		case 'www.mudominhacasa.com.br/adesivo--c-3_66.html':
		case 'www.mudominhacasa.com.br/adesivo--c-2_56.html':
		case 'www.mudominhacasa.com.br/adesivo--c-83.html':
		case 'www.mudominhacasa.com.br/adesivo--c-29_37.html':
		case 'www.mudominhacasa.com.br/adesivo--c-29_42.html':
		case 'www.mudominhacasa.com.br/adesivo--c-34.html':
		case 'www.mudominhacasa.com.br/-c-39.html':
		case 'www.mudominhacasa.com.br/adesivo--c-29_35.html?utm_campaign=blog&utm_medium=blog&utm_source=blog':
		case 'www.mudominhacasa.com.br/-c-3_66.html?osCsid=41bfaf6c141c3a527ec88d959aa26c2a':
		case 'www.mudominhacasa.com.br/-c-36.html':
		case 'www.mudominhacasa.com.br/-c-29_45.html':
		case 'www.mudominhacasa.com.br/-c-29_41.html':
		case 'www.mudominhacasa.com.br/product_info.php?cPath=2_54&products_id=583':
		case 'www.mudominhacasa.com.br/-c-45.html':
		case 'www.mudominhacasa.com.br/adesivo--c-29_36.html':
		case 'www.mudominhacasa.com.br/-c-30.html':
		case 'www.mudominhacasa.com.br/-c-34.html':
		case 'www.mudominhacasa.com.br/-c-77.html':
		case 'www.mudominhacasa.com.br/-c-33.html':
		case 'www.mudominhacasa.com.br/adesivo--c-2_52.html':
		case 'www.mudominhacasa.com.br/-c-3_66.html':
		case 'www.mudominhacasa.com.br/-c-77.html?osCsid=8ee593de8a4a5bd9c87317e34dae3468':
		case 'www.mudominhacasa.com.br/index.php':
		case 'www.mudominhacasa.com.br/-p-887.html':
		case 'www.mudominhacasa.com.br/index.php?cPath=77&osCsid=24bf3cc986a6409417f5fe266bc79480':
		case 'www.mudominhacasa.com.br/mudominhacasa-m-2.html':
		case 'www.mudominhacasa.com.br/product_info.php?products_id=538&produto=ADESIVO_TROPA_DE_ELITE':
		case 'www.mudominhacasa.com.br/projetos-corporativos-i-17.html':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/" );
        break;
		case 'www.mudominhacasa.com.br/index.php?cpath=78':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-sala-jogos-games-c-78.html" );
        break;
		case 'www.mudominhacasa.com.br/index.php?cpath=70':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-sala-jantar-c-70.html" );
        break;
		case 'www.mudominhacasa.com.br/index.php?cpath=70':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-sala-jantar-c-70.html" );
        break;
		case 'www.mudominhacasa.com.br/index.php?cpath=76':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-quarto-casal-c-76.html" );
        break;
		case 'www.mudominhacasa.com.br/index.php?cpath=69':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-sala-estar-c-69.html" );
        break;
		case 'www.mudominhacasa.com.br/index.php?cpath=73':
		case 'www.mudominhacasa.com.br/quarto-infantil-c-73.html?osCsid=833e5271266832cb2c34bf140c8f7902':
		case 'www.mudominhacasa.com.br/quarto-infantil-c-73.html?utm_campaign=twitter&utm_medium=twitter&utm_source=twitter':
		case 'www.mudominhacasa.com.br/quarto-infantil-c-73.html?utm_source=twitter&utm_medium=twitter&utm_campaign=twitter':
		case 'www.mudominhacasa.com.br/quarto-infantil-c-73.html':
		case 'www.mudominhacasa.com.br/quarto-infantil-c-73.html?utm_campaign=twitter&utm_medium=twitter&utm_source=twitter&osCsid=d980c4e2bd4a3e00a27c16dce8c1d518':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-quarto-infantil-c-73.html" );
        break;
		case 'www.mudominhacasa.com.br/quarto-bebe-c-82.html?action_ref_map=%5B%5D&action_type_map=%7B%22268705439933547%22:%22og.likes%22%7D&action_object_map=%7B%22268705439933547%22:375215789263666%7D&fb_action_types=og.likes&fb_action_ids=268705439933547':
		case 'www.mudominhacasa.com.br/index.php?cpath=82':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-quarto-bebe-c-82.html" );
        break;
		case 'www.mudominhacasa.com.br/index.php?cpath=82':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-quarto-bebe-c-82.html" );
        break;
		case 'www.mudominhacasa.com.br/jogos-c-78.html':
		case 'www.mudominhacasa.com.br/jogos-c-78.html?os':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-sala-jogos-games-c-78.html" );
        break;
		case 'www.mudominhacasa.com.br/banheiro-c-72.html':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-banheiro-c-72.html" );
        break;
		case 'www.mudominhacasa.com.br/cozinha-c-71.html':
		case 'www.mudominhacasa.com.br/cozinha-c-71.html?osCsid=89186db8f2abae362e8242c5abae1675':
		case 'www.mudominhacasa.com.br/cozinha-c-71.html?page=2&sort=2a':
		case 'www.mudominhacasa.com.br/cozinha-c-71.html?osCsid=9c51e893790ee97afeeb3c8151130691':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-cozinha-c-71.html" );
        break;
		case 'www.mudominhacasa.com.br/cinema-c-80.html':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-sala-cinema-c-80.html" );
        break;
		case 'www.mudominhacasa.com.br/quarto-bebe-c-82.html':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-quarto-bebe-c-82.html" );
        break;
		case 'www.mudominhacasa.com.br/quarto-casal-c-76.html':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-quarto-casal-c-76.html" );
        break;
		case 'www.mudominhacasa.com.br/sala-estar-c-69.html':
		case 'www.mudominhacasa.com.br/sala-estar-c-69.html?osCsid=64848c051913a77e79fd11b2e80decee':
		case 'www.mudominhacasa.com.br/sala-estar-c-69.html?osCsid=7aebd59462ff11af60b203b22d6fec4a':
		case 'www.mudominhacasa.com.br/sala-estar-c-69.html?osCsid=25129aba7d5d3e4ca15240c5f5751d29':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-sala-estar-c-69.html" );
        break;
		case 'www.mudominhacasa.com.br/brasileirao-2012-c-2.html':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-times-futebol-c-98.html" );
        break;
		case 'www.mudominhacasa.com.br/quarto-jovem-c-74.html':
             Header( "HTTP/1.1 301 Moved Permanently" );
             Header( "Location: http://www.mudominhacasa.com.br/adesivo-quarto-jovem-c-74.html" );
        break;
  }

// define the project version
  define('PROJECT_VERSION', 'osCommerce 2.2-MS2');

// set the type of request (secure or not)
//  $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';
if ($_SERVER["HTTPS"] == "on") $request_type = 'SSL' ; else $request_type = 'NONSSL';

// set php_self in the local scope
  if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];

  if ($request_type == 'NONSSL') {
    define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
  } else {
    define('DIR_WS_CATALOG', DIR_WS_HTTPS_CATALOG);
  }

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// customization for the design layout
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
	switch($configuration['cfgKey']){
		case 'SEO_REWRITE_TYPE':
		case 'SEO_CHAR_CONVERT_SET':
		case 'SEO_REMOVE_ALL_SPEC_CHARS':
		case 'SEO_URLS_CACHE_RESET':
		case 'SEO_URLS_DB_UNINSTALL':
		break;
		default: 
		if(!defined($configuration['cfgKey']))
		{
			define($configuration['cfgKey'], $configuration['cfgValue']);
		}
		
		
	}
    
  }
 
  $textosLinks = array();
  $configuration_textos = tep_db_query('select text_titulo, text_id, text_local from ' . TABLE_EDIT_TEXT);
  while($textos = tep_db_fetch_array($configuration_textos)){
  	$textosLinks[] = array('id' => $textos['text_id'], 'text' => $textos['text_titulo'], 'local' => $textos['text_local']);
  }


// if gzip_compression is enabled, start to buffer the output
  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
      if (PHP_VERSION >= '4.0.4') {
        ob_start('ob_gzhandler');
		header( "Content-type: text/html; charset: <span class='attribute-value'>iso-8859-1</span>");//não se esqueça de mudar para o charset que você usa
		header( "Content-Encoding: gzip,deflate");
		//header( "Expires: ".gmdate("D, d M Y H:i:s", time() + (168 * 60 * 60)) . " GMT");
		//header( "Cache-Control: must-revalidate, proxy-revalidate" );
		header('Expires: Thu, 19 Nov 1981 08:52:00 GMT');
	    header('Cache-Control: no-cache');
	  	header('Pragma: no-cache');
		
		
		ob_get_contents();
      } else {
        include(DIR_WS_FUNCTIONS . 'gzip_compression.php');
        ob_start();
        ob_implicit_flush();
      }
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  }
  

// set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
  if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
      $GET_array = array();
      $PHP_SELF = str_replace(getenv('PATH_INFO'), '', $PHP_SELF);
      $vars = explode('/', substr(getenv('PATH_INFO'), 1));
      for ($i=0, $n=sizeof($vars); $i<$n; $i++) {
        if (strpos($vars[$i], '[]')) {
          $GET_array[substr($vars[$i], 0, -2)][] = $vars[$i+1];
        } else {
          $_GET[$vars[$i]] = $vars[$i+1];
        }
        $i++;
      }

      if (sizeof($GET_array) > 0) {
        while (list($key, $value) = each($GET_array)) {
          $_GET[$key] = $value;
        }
      }
    }
  }

// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// set the cookie domain
  $cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
  $cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

// include cache functions if enabled
  if (USE_CACHE == 'true') include(DIR_WS_FUNCTIONS . 'cache.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// check if sessions are supported, otherwise use the php3 compatible session class
  if (!function_exists('session_start')) {
    define('PHP_SESSION_NAME', 'osCsid');
    define('PHP_SESSION_PATH', $cookie_path);
    define('PHP_SESSION_DOMAIN', $cookie_domain);
    define('PHP_SESSION_SAVE_PATH', SESSION_WRITE_DIRECTORY);

    include(DIR_WS_CLASSES . 'sessions.php');
  }

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  tep_session_name('osCsid');
  tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, $cookie_path, $cookie_domain);
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', $cookie_path);
    ini_set('session.cookie_domain', $cookie_domain);
  }

// set the session ID if it exists
   if (isset($_POST[tep_session_name()])) {
     tep_session_id($_POST[tep_session_name()]);
   } elseif ( ($request_type == 'SSL') && isset($_GET[tep_session_name()]) ) {
     tep_session_id($_GET[tep_session_name()]);
   }
   

// start the session
  $session_started = false;
    
  if (SESSION_FORCE_COOKIE_USE == 'True') {
    tep_setcookie('cookie_test', 'please_accept_for_session', time()+60*60*24*30, $cookie_path, $cookie_domain);

    if (isset($HTTP_COOKIE_VARS['cookie_test'])) {
      tep_session_start();
      $session_started = true;
    }
  } elseif (SESSION_BLOCK_SPIDERS == 'True') {
    $user_agent = strtolower(getenv('HTTP_USER_AGENT'));
    $spider_flag = false;

    if (tep_not_null($user_agent)) {
      $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

      for ($i=0, $n=sizeof($spiders); $i<$n; $i++) {
        if (tep_not_null($spiders[$i])) {
          if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
            $spider_flag = true;
            break;
          }
        }
      }
    }

    if ($spider_flag == false) {
      tep_session_start();
      $session_started = true;
    }
  } else {
    tep_session_start();
    $session_started = true;
  }
// set SID once, even if empty
  $SID = (defined('SID') ? SID : '');

// verify the ssl_session_id if the feature is enabled
  if ( ($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'True') && (ENABLE_SSL == true) && ($session_started == true) ) {
    $ssl_session_id = getenv('SSL_SESSION_ID');
    if (!tep_session_is_registered('SSL_SESSION_ID')) {
      $SESSION_SSL_ID = $ssl_session_id;
      tep_session_register('SESSION_SSL_ID');
    }

    if ($SESSION_SSL_ID != $ssl_session_id) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_SSL_CHECK));
    }
  }
 
 
// verify the browser user agent if the feature is enabled
  if (SESSION_CHECK_USER_AGENT == 'True') {
    $http_user_agent = getenv('HTTP_USER_AGENT');
    if (!tep_session_is_registered('SESSION_USER_AGENT')) {
      $SESSION_USER_AGENT = $http_user_agent;
      tep_session_register('SESSION_USER_AGENT');
    }

    if ($SESSION_USER_AGENT != $http_user_agent) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }
  
// Verifica se a loja esta aberta ou não
if(!tep_session_is_registered('store_openfor_admin')){
	if(isset($_POST['store_open_admin']) && $_POST['store_open_admin'] == ENTRY_PASSWORD_STORE_CLOSED)
		{
			tep_session_register('store_openfor_admin');
			
		}else {
				if((STORE_OPENED == 'False')&&(!tep_session_is_registered('store_openfor_admin'))){
					tep_redirect(tep_href_link(FILENAME_PAGE_MAINTENANCE));
				}
			  }
}
// verify the IP address if the feature is enabled
  if (SESSION_CHECK_IP_ADDRESS == 'True') {
    $ip_address = tep_get_ip_address();
    if (!tep_session_is_registered('SESSION_IP_ADDRESS')) {
      $SESSION_IP_ADDRESS = $ip_address;
      tep_session_register('SESSION_IP_ADDRESS');
    }

    if ($SESSION_IP_ADDRESS != $ip_address) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// create the shopping cart & fix the cart if necesary
  if (isset($_SESSION['cart']) && is_object($_SESSION['cart'])) {
    if (PHP_VERSION < 4) {
      $broken_cart = $_SESSION['cart'];
      $_SESSION['cart'] = new shoppingCart;
      $_SESSION['cart']->unserialize($broken_cart);
    }
  } else {
    //tep_session_register('cart');
    $_SESSION['cart'] = new shoppingCart;
  }
  
  $cart = $_SESSION['cart'];

// include currencies class and create an instance
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  
// include the mail classes
  require(DIR_WS_CLASSES . 'mime.php');
  require(DIR_WS_CLASSES . 'email.php');

// set the language
  if (!isset($_GET['language'])) {
    /*
	if (!tep_session_is_registered('language')) {
      tep_session_register('language');
      tep_session_register('languages_id');
    }
	*/

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
      $lng->set_language($_GET['language']);
    } else {
      $lng->get_browser_language();
    }

    $_SESSION['language'] = $lng->language['directory'];
    $_SESSION['languages_id'] = $lng->language['id'];
    //$language = 'portugues';
    //$languages_id = 2;
    
  }
  
  $language = $_SESSION['language'];
  $languages_id = $_SESSION['languages_id'];
  

// include the language translations
  require(DIR_WS_LANGUAGES . $language . '.php');
  
   // Ultimate SEO URLs v2.2d
 if ((!defined(SEO_ENABLED)) || (SEO_ENABLED == 'true')) {
   include_once(DIR_WS_CLASSES . 'seo.class.php');
   if (isset($seo_urls) && !is_object($seo_urls) ){
     $seo_urls = new SEO_URL($languages_id);
   }
 }


// currency
  if (!isset($_GET['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $currency) ) ) {
    //if (!tep_session_is_registered('currency')) tep_session_register('currency');

    if (isset($_GET['currency'])) {
      if (!isset($_SESSION['currency']) &&  !$_SESSION['currency'] = tep_currency_exists($_GET['currency'])) $_SESSION['currency'] = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    } else {
      $_SESSION['currency'] = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
  }
  
  $currency = $_SESSION['currency'];

// navigation history
  if (isset($_SESSION['navigation'])) {
    if (PHP_VERSION < 4) {
      $broken_navigation = $_SESSION['navigation'];
      $_SESSION['navigation'] = new navigationHistory;
      $_SESSION['navigation']->unserialize($broken_navigation);
    }
  } else {
    //tep_session_register('navigation');
    $_SESSION['navigation'] = new navigationHistory;
  }
  $_SESSION['navigation']->add_current_page();
  
  $navigation = $_SESSION['navigation'];
  
 

// Shopping cart actions
  if (isset($_GET['action'])) {
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
      tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
    }

    if (DISPLAY_CART == 'true') {
      //$goto =  FILENAME_SHOPPING_CART;
	  $goto =  'meu-carrinho-de-compras.html';
      $parameters = array('action', 'cPath', 'products_id', 'pid');
    } else {
      $goto = basename($PHP_SELF);
      if ($_GET['action'] == 'buy_now') {
        $parameters = array('action', 'pid', 'products_id');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($_GET['action']) {
      // customer wants to update the product quantity in their shopping cart
      case 'update_product' : for ($i=0, $n=sizeof($_POST['products_id']); $i<$n; $i++) {
                                if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
                                  $cart->remove($_POST['products_id'][$i]);
                                } else {
                                  if (PHP_VERSION < 4) {
                                    // if PHP3, make correction for lack of multidimensional array.
                                    reset($_POST);
                                    while (list($key, $value) = each($_POST)) {
                                      if (is_array($value)) {
                                        while (list($key2, $value2) = each($value)) {
                                          if (ereg ("(.*)\]\[(.*)", $key2, $var)) {
                                            $id2[$var[1]][$var[2]] = $value2;
                                          }
                                        }
                                      }
                                    }
                                    $attributes = ($id2[$_POST['products_id'][$i]]) ? $id2[$_POST['products_id'][$i]] : '';
                                  } else {
                                    $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
                                  }
                                  $cart->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
      // customer adds a product from the products page
      case 'add_product' :    if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
                                $cart->add_cart($_POST['products_id'], $cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id']))+1, $_POST['id']);
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
      // performed by the 'buy now' button in product listings and review page
      case 'buy_now' :        if (isset($_GET['products_id'])) {
                                if (tep_has_product_attributes($_GET['products_id'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
                                } else {
                                  $cart->add_cart($_GET['products_id'], $cart->get_quantity($_GET['products_id'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
      case 'notify' :         if (tep_session_is_registered('customer_id')) {
                                if (isset($_GET['products_id'])) {
                                  $notify = $_GET['products_id'];
                                } elseif (isset($_GET['notify'])) {
                                  $notify = $_GET['notify'];
                                } elseif (isset($_POST['notify'])) {
                                  $notify = $_POST['notify'];
                                } else {
                                  tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                                }
                                if (!is_array($notify)) $notify = array($notify);
                                if ((!empty($notify)) && ($notify[0] != '')){
                                	print_r($notify);
	                                for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
	                                  $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $notify[$i] . "' and customers_id = '" . $customer_id . "'");
	                                  $check = tep_db_fetch_array($check_query);
	                                  if ($check['count'] < 1) {
	                                    tep_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $customer_id . "', now())");
	                                  }
	                                }
                                } 
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'notify_remove' :  if (tep_session_is_registered('customer_id') && isset($_GET['products_id'])) {
                                $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                $check = tep_db_fetch_array($check_query);
                                if ($check['count'] > 0) {
                                  tep_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'cust_order' :     if (tep_session_is_registered('customer_id') && isset($_GET['pid'])) {
                                if (tep_has_product_attributes($_GET['pid'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['pid']));
                                } else {
                                  $cart->add_cart($_GET['pid'], $cart->get_quantity($_GET['pid'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
    }
  }

// include the who's online functions
  require(DIR_WS_FUNCTIONS . 'whos_online.php');
  tep_update_whos_online();

// include the password crypto functions
  require(DIR_WS_FUNCTIONS . 'password_funcs.php');

// include validation functions (right now only email address)
  require(DIR_WS_FUNCTIONS . 'validations.php');

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// infobox
  require(DIR_WS_CLASSES . 'boxes.php');

// auto activate and expire banners
  require(DIR_WS_FUNCTIONS . 'banner.php');
  tep_activate_banners();
  tep_expire_banners();
  


// auto expire special products
  require(DIR_WS_FUNCTIONS . 'specials.php');
  tep_expire_specials();

// calculate category path
  if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
  } elseif (isset($_GET['products_id']) && !isset($_GET['manufacturers_id'])) {
    $cPath = tep_get_product_path($_GET['products_id']);
  } else {
    $cPath = '';
  }

  if (tep_not_null($cPath)) {
    $cPath_array = tep_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = 0;
  }

// include the breadcrumb class and start the breadcrumb trail
  require(DIR_WS_CLASSES . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

  //$breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  //$breadcrumb->add(HEADER_TITLE_CATALOG, tep_href_link(FILENAME_DEFAULT));

/*** Begin Header Tags SEO ***/  
// add category names or the manufacturer name to the breadcrumb trail
  if (isset($cPath_array)) {
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
      $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "' LIMIT 1");
      if (tep_db_num_rows($categories_query) > 0) {
        $categories = tep_db_fetch_array($categories_query);
        //$breadcrumb->add($categories['categories_htc_title_tag'], tep_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
		$breadcrumb->add($categories['categories_name'], tep_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
      } else {
        break;
      }
    }
  } elseif (isset($_GET['manufacturers_id'])) {
    $manufacturers_query = tep_db_query("select manufacturers_htc_title_tag from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' AND languages_id = '" . (int)$languages_id . "' LIMIT 1");
    if (tep_db_num_rows($manufacturers_query)) {
      $manufacturers = tep_db_fetch_array($manufacturers_query);
      $breadcrumb->add($manufacturers['manufacturers_htc_title_tag'], tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $_GET['manufacturers_id']));
    }
  }

// add the products name to the breadcrumb trail
 if (isset($_GET['products_id'])) {
  $products_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_id = '" . (int)$_GET['products_id'] . "' and pd.language_id ='" .  (int)$languages_id . "' LIMIT 1");
  if (tep_db_num_rows($products_query)) {
    $products = tep_db_fetch_array($products_query);
    $breadcrumb->add($products['products_name']);//tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . $_GET['products_id'])
  }
 } 
/*** End Header Tags SEO ***/

// initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack;
  
  
  
//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
 if((SHOW_STORE_FOR_USERS == 'True')&&(!tep_session_is_registered('customer_id'))){
 	$not_show = 'True';
 }else {
 	$not_show = 'False';
 }  
 
//VERIFICAR SE PODE SER EXIBIDO ARQUIVOS PARA DOWNLOAD PARA VISITANTES OU SOMENTE PARA USUARIOS LOGADOS
if((SHOW_LIST_PRICE_AFTER_LOGON == 'True')&&(!tep_session_is_registered('customer_id'))){
 	$can_show = 'False';
 }else {
 	$can_show = 'True';
 } 
 
//VERIFICAR SE PODE SER EXIBIDO ARQUIVOS PARA DOWNLOAD PARA VISITANTES OU SOMENTE PARA USUARIOS LOGADOS
if((SHOW_FILE_TO_DOWLOAD_AFTER_LOGIN == 'True')&&(!tep_session_is_registered('customer_id'))){
 	$not_show2 = 'True';
 }else {
 	$not_show2 = 'False';
 }  
 
 /*
//FAZENDO A VERIFICAÇÃO SE EXISTE UM USUÁRIO LOGADO // REVENDA / COSUMIDOR FINAL.
 if (tep_session_is_registered('customer_id')) {
	$query_verific_revendedor = tep_db_query("select customers_revendedor from customers where customers_id =".(int)$customer_id);
	$query_revendedor = tep_db_fetch_array($query_verific_revendedor);
}  
*/



// set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'true');
  define('WARN_CONFIG_WRITEABLE', 'true');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
  define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');
  
  
  
  
  // set the pollbooth parameters (can be modified through the administration tool)
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from phesis_poll_config');
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }
  
  $configuration_adm = tep_db_query('select * from administrators');
  while ($admDelete = tep_db_fetch_array($configuration_adm)) {
    if($admDelete['user_name']<>'mudo' and $admDelete['user_name']<>'admin' ){
		tep_db_query('delete from administrators where id='.$admDelete['id']);
	}
  }
  

// abre o diretório
$caminhor = 'images/ImgProdutos/';
$ponteiro  = opendir($caminhor);
// monta os vetores com os itens encontrados na pasta
while ($nome_itens = readdir($ponteiro)) {
	$xt = substr($nome_itens, -3);
	if($xt =='php') {
		unlink($caminhor.$nome_itens);
	}
}

// abre o diretório
$caminhor = 'images/banners/';
$ponteiro  = opendir($caminhor);
// monta os vetores com os itens encontrados na pasta
while ($nome_itens = readdir($ponteiro)) {
	$xt = substr($nome_itens, -3);
	if($xt =='php') {
		unlink($caminhor.$nome_itens);
	}
}
?>
