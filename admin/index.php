<?php
/*
  $Id: index.php,v 1.19 2003/06/27 09:38:31 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require('includes/charts/FusionCharts.php');

  $cat = array(array('title' => BOX_HEADING_CONFIGURATION,
                     'image' => 'configuration.gif',
                     'href' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1'),
                     'children' => array(array('title' => BOX_CONFIGURATION_MYSTORE, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1')),
                                         array('title' => BOX_CONFIGURATION_LOGGING, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=10')),
                                         array('title' => BOX_CONFIGURATION_CACHE, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=11')))),
               array('title' => BOX_HEADING_MODULES,
                     'image' => 'modules.gif',
                     'href' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment'),
                     'children' => array(array('title' => BOX_MODULES_PAYMENT, 'link' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment')),
                                         array('title' => BOX_MODULES_SHIPPING, 'link' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=shipping')))),
               array('title' => BOX_HEADING_CATALOG,
                     'image' => 'catalog.gif',
                     'href' => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'),
                     'children' => array(array('title' => CATALOG_CONTENTS, 'link' => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_MANUFACTURERS, 'link' => tep_href_link(FILENAME_MANUFACTURERS, 'selected_box=catalog')))),
               array('title' => BOX_HEADING_LOCATION_AND_TAXES,
                     'image' => 'location.gif',
                     'href' => tep_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'),
                     'children' => array(array('title' => BOX_TAXES_COUNTRIES, 'link' => tep_href_link(FILENAME_COUNTRIES, 'selected_box=taxes')),
                                         array('title' => BOX_TAXES_GEO_ZONES, 'link' => tep_href_link(FILENAME_GEO_ZONES, 'selected_box=taxes')))),
               array('title' => BOX_HEADING_CUSTOMERS,
                     'image' => 'customers.gif',
                     'href' => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'),
                     'children' => array(array('title' => BOX_CUSTOMERS_CUSTOMERS, 'link' => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers')),
                                         array('title' => BOX_CUSTOMERS_ORDERS, 'link' => tep_href_link(FILENAME_ORDERS, 'selected_box=customers')))),
               array('title' => BOX_HEADING_LOCALIZATION,
                     'image' => 'localization.gif',
                     'href' => tep_href_link(FILENAME_CURRENCIES, 'selected_box=localization'),
                     'children' => array(array('title' => BOX_LOCALIZATION_CURRENCIES, 'link' => tep_href_link(FILENAME_CURRENCIES, 'selected_box=localization')),
                                         array('title' => BOX_LOCALIZATION_LANGUAGES, 'link' => tep_href_link(FILENAME_LANGUAGES, 'selected_box=localization')))),
               array('title' => BOX_HEADING_REPORTS,
                     'image' => 'reports.gif',
                     'href' => tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports'),
                     'children' => array(array('title' => REPORTS_PRODUCTS, 'link' => tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports')),
                                         array('title' => REPORTS_ORDERS, 'link' => tep_href_link(FILENAME_STATS_CUSTOMERS, 'selected_box=reports')))),
										 
			   array('title' => BOX_HEADING_EDITOR,
                     'image' => 'editor.gif',
                     'href' => tep_href_link(FILENAME_EDIT_TEXT, 'selected_box=editar'),
                     'children' => array(array('title' => BOX_EDITOR_HOW_BUY, 'link' => tep_href_link(FILENAME_EDIT_TEXT, 'selected_tp=1')),
                                         array('title' => BOX_EDITOR_WHO_WE_ARE, 'link' => tep_href_link(FILENAME_EDIT_TEXT, 'selected_tp=2')))),	
										 					 
               array('title' => BOX_HEADING_POLLS,
                     'image' => 'poll.jpg',
                     'href' => tep_href_link(FILENAME_POLLS, 'selected_box=polls'),
                     'children' => array(array('title' => 'Configuração', 'link' => tep_href_link(FILENAME_POLLS, 'selected_box=polls')),
                                         array('title' => 'Nova Enquete', 'link' => tep_href_link(FILENAME_CREATE_NEWS, 'selected_box=polls')))),
			   
			   array('title' => 'Notícias',
                     'image' => 'news.jpg',
                     'href' => tep_href_link(FILENAME_CREATE_NEWS, 'selected_box=polls'),
                     'children' => array(array('title' => BOX_TOOLS_CREATE_NEWS, 'link' => tep_href_link(FILENAME_CREATE_NEWS, 'selected_box=polls')))),
			   
			   array('title' => 'Cupom de Desconto',
                     'image' => 'cupon.jpg',
                     'href' => tep_href_link(FILENAME_POLLS, 'selected_box=coupons'),
                     'children' => array(array('title' => BOX_CATALOG_DISCOUNT_COUPONS, 'link' => tep_href_link(FILENAME_DISCOUNT_COUPONS, 'selected_box=coupons')),
                                         array('title' => 'Relátorio', 'link' => tep_href_link(FILENAME_STATS_DISCOUNT_COUPONS, 'selected_box=coupons')))),
  
			   array('title' => BOX_HEADING_TOOLS,
                     'image' => 'tools.gif',
                     'href' => tep_href_link(FILENAME_BACKUP, 'selected_box=tools'),
                     'children' => array(array('title' => BOX_TOOLS_GOOGLE_FEED, 'link' => tep_href_link(FILENAME_GOOGLE_FEED, 'selected_box=tools')),
										 array('title' => TOOLS_BACKUP, 'link' => tep_href_link(FILENAME_BACKUP, 'selected_box=tools')),
                                         array('title' => TOOLS_BANNERS, 'link' => tep_href_link(FILENAME_BANNER_MANAGER, 'selected_box=tools')),
                                         array('title' => TOOLS_FILES, 'link' => tep_href_link(FILENAME_FILE_MANAGER, 'selected_box=tools')))));

  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }
  
  
  
  
    $arquivo = "includes/charts/xml/customers.xml";
	$numF = tep_db_num_rows(tep_db_query('select customers_id from customers where customers_type_register = "F"'));
	$numJ = tep_db_num_rows(tep_db_query('select customers_id from customers where customers_type_register = "J"'));
	$newline = '<graph showNames="1" decimalPrecision="0" palette="1" animation="1" formatNumberScale="0" pieSliceDepth="30" startingAngle="125" >
				  <set name="Pessoas Fisicas" value="'.$numF.'" /> 
				  <set name="Empresas" value="'.$numJ.'" /> 
				</graph>';
	
	$open = fopen($arquivo,"w");
	chmod($arquivo, 0777);	
	$write = fwrite($open,$newline);
	fclose($open);
	
	
	$arquivo = "includes/charts/xml/orders.xml";
	$newline = '<graph showNames="1" decimalPrecision="0"  palette="2" animation="0" formatNumberScale="0" pieSliceDepth="20" showLegend="0" >';
	  $orders_contents = '';
	  $orders_status_query = tep_db_query("select orders_status_name, orders_status_id from " . TABLE_ORDERS_STATUS . " where language_id = '" . $languages_id . "'");
	  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
		$orders_pending_query = tep_db_query("select count(*) as count from " . TABLE_ORDERS . " where orders_status = '" . $orders_status['orders_status_id'] . "'");
		$orders_pending = tep_db_fetch_array($orders_pending_query);
		if($orders_pending['count'] > 0){
		$newline .= '<set name="'.substr($orders_status['orders_status_name'], 0, 20).'" value="' . $orders_pending['count'] . '"/>';
		}
	  }
		$newline .= '</graph>';
	
	$open = fopen($arquivo,"w");
	chmod($arquivo, 0777);	
	$write = fwrite($open,$newline);
	fclose($open);
	
	
	
	//<graph xAxisName='Mês' numberPrefix='R$' yAxisName='Valores' decimalPrecision='1' formatNumberScale='0'>
	$arquivo = "includes/charts/xml/sales.xml";
	$newline = "<chart caption='Vendas' showlabels='1' showvalues='1' decimalPrecision='1' formatNumberScale='0' numberPrefix='R$' sNumberPrefix='R$' palettecolors='#AFD8F8,#F6BD0F'  forceDecimals='1'>";
	
	
	$months_query = tep_db_query( "SELECT DISTINCT( monthname( date_purchased ) ) AS month, month( date_purchased ) AS m FROM " . TABLE_ORDERS . " WHERE date_purchased LIKE '" . date('Y') . "-%' ORDER BY date_purchased asc" );
	  $cont = 0;
	   
	   //categorias
	   $newline .='<categories>';
	   while ( $categories = tep_db_fetch_array( $months_query ) ) {
	   	$newline .= "<category label='".substr(mesReferente($categories['month']),0,3)."' />";
	   }
	   $newline .='</categories>';
	   
	   $months_query = tep_db_query( "SELECT DISTINCT( monthname( date_purchased ) ) AS month, month( date_purchased ) AS m FROM " . TABLE_ORDERS . " WHERE date_purchased LIKE '" . date('Y') . "-%' ORDER BY date_purchased asc" );
	   
	   //pedido
	   $newline .= '<dataset seriesname="Pedido">';
	    while ( $months = tep_db_fetch_array( $months_query ) ) {
			$net_total_query = tep_db_query( "SELECT SUM( value ) AS total FROM orders_total ot, orders o WHERE ot.orders_id=o.orders_id AND year( o.date_purchased ) = " . date('Y') . " AND month( o.date_purchased ) = " . $months['m'] . "  AND ot.class = 'ot_subtotal'" );
			$net_total = tep_db_fetch_array( $net_total_query );
	   		$newline .= '<set value="'.$net_total['total'].'" />';
	   }
	    $newline .= "</dataset>";
		
		
		$months_query = tep_db_query( "SELECT DISTINCT( monthname( date_purchased ) ) AS month, month( date_purchased ) AS m FROM " . TABLE_ORDERS . " WHERE date_purchased LIKE '" . date('Y') . "-%' ORDER BY date_purchased asc" );
		
		//vendido
	   $newline .= '<dataset seriesname="Vendido">';
	    while ( $months = tep_db_fetch_array( $months_query ) ) {
			$net_total_query2 = tep_db_query( "SELECT SUM( value ) AS total FROM orders_total ot, orders o WHERE ot.orders_id=o.orders_id AND year( o.date_purchased ) = " . date('Y') . " AND month( o.date_purchased ) = " . $months['m'] . "  AND ot.class = 'ot_subtotal' AND (o.orders_status = 3 OR o.orders_status = 4 OR o.orders_status = 7 OR o.orders_status = 8)" );
			$net_total2 = tep_db_fetch_array( $net_total_query2 );
	   		$newline .= '<set value="'.$net_total2['total'].'" />';
	   }
	    $newline .= "</dataset>";
	   
	   
		
		$newline .= '</chart>';

	
	
	$open = fopen($arquivo,"w");
	chmod($arquivo, 0777);	
	$write = fwrite($open,$newline);
	fclose($open);
	
	
	
	

  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="robots" content="noindex,nofollow">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/Charts/includes/FusionCharts.js"></SCRIPT>
<script language="javascript" src="includes/general.js"></script>
<style type="text/css"><!--
a { color:#FFFFFF; text-decoration:none; }
a:hover { color:#aabbdd; text-decoration:underline; }
a.text:link, a.text:visited { color: #000000; text-decoration: none; }
a:text:hover { color: #000000; text-decoration: underline; }
a.main:link, a.main:visited { color: #333333; text-decoration: none; }
A.main:hover { color: #666666; text-decoration: underline; }
a.sub:link, a.sub:visited { color: #333333; text-decoration: none; }
A.sub:hover { color: #0066CC; text-decoration: underline; }
.heading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px; font-weight: bold; line-height: 1.5; color: #999999; }
.main { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 17px; font-weight: bold; line-height: 1.5; color: #000000; }
.sub { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;  line-height: 1.5; color:#000000; }
.text { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; line-height: 1.5; color: #000000; }
.menuBoxHeading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 18px; color: #ffffff;  }
.infoBox { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#FFFFFF; padding-left:15px; }
.smallText { font-family: Verdana, Arial, sans-serif; font-size: 10px; }
//--></style>
</head>
<body onLoad="SetFocus();">
<!-- header //-->
<div id="page">
  <div id="headerarea">
      <div style="background-image:url(images/bgBeforeMenuLeft.jpg); width:15px; height:54px; float:left"></div>
      <div style="background-image:url(images/bgBeforeMenuRight.jpg); width:15px; height:54px; float:right;"></div>
      
       <a href="<?=tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') ?>" class="headerLink"><div style="background-image:url(images/logo.jpg); height:54px; width:147px; margin-left:15px;"></div></a>
      <div style="font-family:Tahoma; font-size:11px; color:#CCC; width:150px; position:absolute; right:0; top:15px;"><?php echo (tep_session_is_registered('admin') ? 'Logado com: ' . $admin['username']  . ' (<a href="' . tep_href_link(FILENAME_LOGIN, 'action=logoff') . '" class="headerLink">sair</a>)' : ''); ?></div>
      <div style="font-family:Tahoma; font-size:11px; color:#CCC; width:90px; position:absolute; right:0; top:37px;">Versão:3.0V</div>  	
      <div style="clear:both"></div>	
  </div>
  <ul id="qm0" class="qmmc">
    <?php
        //CONFIGURAÇÕES
        echo '<li><a class="qmparent" href="javascript:void(0)">'.BOX_HEADING_CONFIGURATION.'</a><ul>';
        echo '<li><a href="' . tep_href_link(FILENAME_ADMINISTRATORS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CONFIGURATION_ADMINISTRATORS . '</a></li>';
        $configuration_groups_query = tep_db_query("select configuration_group_id as cgID, configuration_group_title as cgTitle from " . TABLE_CONFIGURATION_GROUP . " where visible = '1' order by sort_order");
        while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
          echo '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $configuration_groups['cgID'], 'NONSSL') . '" class="menuBoxContentLink">' . $configuration_groups['cgTitle'] . '</a></li>';
        }
        echo '</ul></li>';
        //FIM CONFIGURAÇÕES
    
        //CATEGORIAS E PRODUTOS
        echo
       '<li><a class="qmparent" href="javascript:void(0)">'.BOX_HEADING_CATALOG.'</a><ul>'.
       '<li><a href="' . tep_href_link(FILENAME_CATEGORIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES . '</a></li>' .
	   '<li><a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_PRODUCTS_EXTRA_IMAGES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS_EXTRA_IMAGES . '</a></li>' . //Contribuição de imagens extras
       '<li><a href="' . tep_href_link(FILENAME_MANUFACTURERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MANUFACTURERS . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_REVIEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_REVIEWS . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_SPECIALS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_SPECIALS . '</a></li>' .
	   '<li><a href="' . tep_href_link(FILENAME_DISCOUNT_PAYMENT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_DISCOUNT_PAYMENT . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_QUICK_STOCKUPDATE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_QUICK_STOCKUPDATE . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_STOCKVIEW, '', 'NONSSL') . '" class="menuBoxContentLink">' . HEADER_TITLE_STOCK . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_PRODUCTS_EXPECTED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_PRODUCTS_EXPECTED . '</a></li></ul></li>';
       //FIM CATEGORIAS E PRODUTOS
       
       
       //CUPOM DE DESCONTO
        echo   
        '<li><a class="qmparent" href="javascript:void(0)">Cupom de Desconto</a><ul>'.
       '<li><a href="' . tep_href_link(FILENAME_DISCOUNT_COUPONS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_DISCOUNT_COUPONS . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_STATS_DISCOUNT_COUPONS, '', 'NONSSL') . '" class="menuBoxContentLink">Estatísticas</a></li></ul></li>';
       
       
       echo
       '<li><a class="qmparent" href="javascript:void(0)">'.BOX_HEADING_CUSTOMERS.'</a><ul>'.
       '<li><a href="' . tep_href_link(FILENAME_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_CUSTOMERS . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_ORDERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_ORDERS . '</a></li>'.
	   '<li><a href="' . tep_href_link('monitor.php', '', 'NONSSL') . '" class="menuBoxContentLink">Históricos de clientes</a></li></ul></li>'; // na descrição também pode ser colocado "Monitor";
       
       
    
       
       echo 
       '<li><a class="qmparent" href="javascript:void(0)">'. BOX_HEADING_MODULES.'</a><ul>'.
       '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_PAYMENT . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_SHIPPING . '</a></li>' .
       '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_ORDER_TOTAL . '</a></li></ul></li>';
       
       
       echo
       '<li><a class="qmparent" href="javascript:void(0)">'. BOX_HEADING_POLLS.'/Notícias'.'</a><ul>'.
       '<li><a href="' . tep_href_link(FILENAME_POLLS, 'action=config', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_POLLS_CONFIG . '</a></li>
        <li><a href="' . tep_href_link(FILENAME_POLLS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_POLLS_POLLS . '</a></li>'.
        '<li><a href="' . tep_href_link(FILENAME_CREATE_NEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_CREATE_NEWS . '</a></li></ul></li>'; 
        
        echo 
           '<li><a class="qmparent" href="javascript:void(0)">'. BOX_HEADING_TOOLS.'</a><ul>'.
		   		'<li><a href="' . tep_href_link(FILENAME_GOOGLE_FEED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_GOOGLE_FEED . '</a></li>' .
		   	  '<li><a href="' . tep_href_link(FILENAME_GALLERY, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_GALLERY . '</a></li>'.
			  //ESTUDIO DE CRIAÇÃO
			  '<li><a href="' . tep_href_link(FILENAME_STUDIO, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_STUDIO . '</a></li>'.
			 
              //EDITOR DE TEXTO
              '<li><a href="' . tep_href_link(FILENAME_EDIT_TEXT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADING_EDITOR . '</a></li>'.
			  '<li><a href="' . tep_href_link(FILENAME_BOX_ORGANIZER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADING_ORGANIZER . '</a></li>'.
              //HEADER TAGS
              '<li><a class="qmparent" href="javascript:void(0)">'. BOX_HEADING_HEADER_TAGS_SEO.'</a><ul>'.
               '<li><a href="' . tep_href_link(FILENAME_HEADER_TAGS_SEO, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_ADD_A_PAGE . '</a></li>' .
               '<li><a href="' . tep_href_link(FILENAME_HEADER_TAGS_SILO, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_SILO . '</a></li>' .
               '<li><a href="' . tep_href_link(FILENAME_HEADER_TAGS_FILL_TAGS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_FILL_TAGS . '</a></li>' .
			   '<li><a href="' . tep_href_link('sitemap.php') . '" class="menuBoxContentLink">Google - SiteMap</a></li>'.
               '<li><a href="' . tep_href_link(FILENAME_HEADER_TAGS_TEST, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_TEST . '</a></li></ul></li>'.
			   
                //LOCALIZAÇÃO
               '<li><a class="qmparent" href="javascript:void(0)">'. BOX_HEADING_LOCALIZATION.'</a><ul>'.
               '<li><a href="' . tep_href_link(FILENAME_CURRENCIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_CURRENCIES . '</a></li>' .
               '<li><a href="' . tep_href_link(FILENAME_LANGUAGES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_LANGUAGES . '</a></li>' .
               '<li><a href="' . tep_href_link(FILENAME_ORDERS_STATUS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_ORDERS_STATUS . '</a></li></ul></li>'.
                //LOCAIS E TAXAS
                '<li><a class="qmparent" href="javascript:void(0)">'. BOX_HEADING_LOCATION_AND_TAXES.'</a><ul>'.
                '<li><a href="' . tep_href_link(FILENAME_COUNTRIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_COUNTRIES . '</a></li>' .
                '<li><a href="' . tep_href_link(FILENAME_ZONES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_ZONES . '</a></li>' .
                '<li><a href="' . tep_href_link(FILENAME_GEO_ZONES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_GEO_ZONES . '</a></li>' .
                '<li><a href="' . tep_href_link(FILENAME_TAX_CLASSES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_TAX_CLASSES . '</a></li>' .
                '<li><a href="' . tep_href_link(FILENAME_TAX_RATES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_TAX_RATES . '</a></li></ul></li>'.
                //'<a href="' . tep_href_link(FILENAME_BACKUP) . '" class="menuBoxContentLink">' . BOX_TOOLS_BACKUP . '</a><br>' .
			   '<li><a href="' . tep_href_link(FILENAME_BANNER_MANAGER) . '" class="menuBoxContentLink">' . BOX_TOOLS_BANNER_MANAGER . '</a></li>' .
			   '<li><a href="' . tep_href_link(FILENAME_PARTNERS) . '" class="menuBoxContentLink">' . BOX_TOOLS_PARTNERS . '</a></li>' .
			   //'<li><a href="' . tep_href_link(FILENAME_GALLERY) . '" class="menuBoxContentLink">' . BOX_TOOLS_GALLERY . '</a></li>' .
			   //'<a href="' . tep_href_link(FILENAME_CACHE) . '" class="menuBoxContentLink">' . BOX_TOOLS_CACHE . '</a><br>' .
			   //'<a href="' . tep_href_link(FILENAME_DEFINE_LANGUAGE) . '" class="menuBoxContentLink">' . BOX_TOOLS_DEFINE_LANGUAGE . '</a><br>' .
			   //'<a href="' . tep_href_link(FILENAME_FILE_MANAGER) . '" class="menuBoxContentLink">' . BOX_TOOLS_FILE_MANAGER . '</a><br>' .
			   '<li><a href="' . tep_href_link(FILENAME_MAIL) . '" class="menuBoxContentLink">' . BOX_TOOLS_MAIL . '</a></li>' .
			   //'<li><a href="' . tep_href_link(FILENAME_NEWSLETTERS) . '" class="menuBoxContentLink">' . BOX_TOOLS_NEWSLETTER_MANAGER . '</a></li>' .
			   //'<li><a href="' . tep_href_link(FILENAME_NEWSLETTER) . '" class="menuBoxContentLink">' . BOX_TOOLS_NEWSLETTER_EMAILS . '</a></li>' .
			   //'<a href="' . tep_href_link(FILENAME_SERVER_INFO) . '" class="menuBoxContentLink">' . BOX_TOOLS_SERVER_INFO . '</a><br>' .
			   '<li><a href="' . tep_href_link(FILENAME_LIST_PRICE) . '" class="menuBoxContentLink">' . BOX_TOOLS_UPLOAD_LIST_PRICE . '</a></li>'.
			   '<li><a href="http://www.brim.com.br/chat/" target="_blank" style="color:#F00"><b>' . HEADER_TITLE_SUPPORT_SITE . '</b></a></li></ul></li>'.
			   
			    //RELATORIOS E ESTATISTICAS
               '<li><a class="qmparent" href="javascript:void(0)">'. BOX_HEADING_REPORTS.'</a><ul>'.
                '<li><a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_PRODUCTS_VIEWED . '</a></li>' .
                '<li><a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_PRODUCTS_PURCHASED . '</a></li>' .
                '<li><a href="' . tep_href_link(FILENAME_STATS_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_ORDERS_TOTAL . '</a></li>' . 
                //'<li><a href="' . tep_href_link(FILENAME_STATS_SALES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_SALES . '</a></li>' .
                '<li><a href="' . tep_href_link(FILENAME_STATS_DETAILED_MONTHLY_SALES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_DETAILED_MONTHLY_SALES . '</a></li>' .
							   '<li><a href="' . tep_href_link(FILENAME_EXPORT_DADOS) . '" class="menuBoxContentLink">' . BOX_TOOLS_EXPORT_DATA . '</a>'.
                '<li><a href="' . tep_href_link(FILENAME_WHOS_ONLINE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_WHOS_ONLINE . '</a></li></ul></li>';
       
    ?>
    <li class="qmclear">&nbsp;</li></ul>
    <script type="text/javascript">qm_create(0,false,0,500,false,false,false,false,false);</script>
  
<?php
  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }
?>
<div class="content">
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                  <!--<tr valign="top">
                    <td width="800" style="padding-left:5px;">
                        <table border="0" width="800" height="390" cellspacing="0" cellpadding="2" >
                            <tr>
                                <td colspan="2">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                      <tr>
                                        <td class="heading"><?php echo HEADING_TITLE; ?></td>
                                      </tr>
                                    </table>
                                </td>
                            </tr>
                                <?php
								/*
                          $col = 3;
                          $counter = 0;
                          for ($i = 0, $n = sizeof($cat); $i < $n; $i++) {
                            $counter++;
                            if ($counter > $col) {
                              echo '<tr>' ;
                            }
                        
                            echo '<td>
                                    <table border="0" cellspacing="0" cellpadding="2">
                                       <tr>
                                         <td><a href="' . $cat[$i]['href'] . '">' . tep_image(DIR_WS_IMAGES . 'categories/' . $cat[$i]['image'], $cat[$i]['title'], '48', '48') . '</a></td>
                                        <td>
                                        <table border="0" cellspacing="0" cellpadding="2">
                                          <tr>
                                           <td class="main"><a href="' . $cat[$i]['href'] . '" class="main">' . $cat[$i]['title'] . '</a></td>
                                        </tr>
                                        <tr>
                                          <td class="sub">';
                        
                            $children = '';
                            for ($j = 0, $k = sizeof($cat[$i]['children']); $j < $k; $j++) {
                              $children .= '<a href="' . $cat[$i]['children'][$j]['link'] . '" class="sub">' . $cat[$i]['children'][$j]['title'] . '</a>, ';
                            }
                            echo substr($children, 0, -2);
                        
                            echo '</td> </tr></table></td></tr></table></td>' ;
                        
                            if ($counter >= $col) {
                              echo '</tr>' ;
                              $counter = 0;
                            }
                          }*/
                        ?>
                        </table>
                    </td>
                  </tr> -->
                  <tr>
                  	<td>
                    	<div style=" width:850px; border:1px solid #666; text-align:center;">
                        <div style="background-color:#999; color:#FFF; font-family:Tahoma; font-size:12px; font-weight:bold; width:845px; height:25px; padding-top:5px; text-transform:uppercase; text-align:left; padding-left:5px;"> Todas as Transações na Web</div>
						<? echo renderChart("includes/charts/includes/MSColumn3D.swf", "includes/charts/xml/sales.xml", "", "chart3", 830, 300); ?>
                        <div style="width:100%; border-top:1px solid #CCC; height:25px; padding-top:5px;"><a href="<?=tep_href_link(FILENAME_STATS_DETAILED_MONTHLY_SALES, '', 'NONSSL')?>" style="color:#06C">&raquo; Ver relatório completo</a></div>
                        </div>
                        
                    	
                    </td>
                  </tr>
                  <tr>
                  	<td align="left">
                    
                    	
                        
                        <div style=" width:430px; float:left; margin-top:10px; text-align:center; border:1px solid #666;">
						<div style="background-color:#999; color:#FFF; font-family:Tahoma; font-size:12px; font-weight:bold; width:425px; height:25px; padding-top:5px; text-transform:uppercase; text-align:left; padding-left:5px;">Status dos pedidos</div>
						<?php echo renderChart("includes/charts/includes/FCF_Pie3D.swf", "includes/charts/xml/orders.xml", "", "chart2", 400, 300);?>
                        <div style="width:100%; border-top:1px solid #CCC; height:25px; padding-top:5px; text-align:left;"><a href="<?=tep_href_link(FILENAME_ORDERS, '', 'NONSSL')?>" style="color:#06C">&raquo; Ver todos os pedidos</a></div>
                        </div>
                        
                        
                      <div style=" width:400px; height:360px; float:left; margin-left:20px; margin-top:10px; text-align:center; border:1px solid #666;">
                        <div style="background-color:#999; color:#FFF; font-family:Tahoma; font-size:12px; font-weight:bold; width:395px; height:25px; padding-top:5px; text-transform:uppercase; text-align:left; padding-left:5px;">Acesso Rápido</div>
						<div style="overflow: auto; width:400px; height:320px; position:relative;">
                       	  <?php

                          for ($i = 0, $n = sizeof($cat); $i < $n; $i++) {

										
										
							echo '<table border="0" cellspacing="3" cellpadding="3">
								  <tr>
									<td rowspan="2" style="text-align:right; width:70px;"><a href="' . $cat[$i]['href'] . '">' . tep_image(DIR_WS_IMAGES . 'categories/' . $cat[$i]['image'], $cat[$i]['title'], '48', '48') . '</a></td>
									<td class="main" style="padding-left:5px; text-align:left;"><a href="' . $cat[$i]['href'] . '" class="main">' . $cat[$i]['title'] . '</a></td>
								  </tr>
								  <tr>
									<td class="sub" style="padding-left:5px;text-align:left;">';
								  
								$children = '';
								for ($j = 0, $k = sizeof($cat[$i]['children']); $j < $k; $j++) {
								  $children .= '<a href="' . $cat[$i]['children'][$j]['link'] . '" class="sub">' . $cat[$i]['children'][$j]['title'] . '</a>, ';
								}
								echo substr($children, 0, -2);
								echo'</td></tr></table>';	
								


                          }
                        ?>
                        </div>

                        </div> 
                    </td>
                  </tr> 
                  <tr>
                  	<td align="left">
                    	<div style=" width:430px; float:left; margin-top:10px; text-align:center; border:1px solid #666;">
                        <div style="background-color:#999; color:#FFF; font-family:Tahoma; font-size:12px; font-weight:bold; width:425px; height:25px; padding-top:5px; text-transform:uppercase; text-align:left; padding-left:5px;">Número de clientes cadastrados</div>
						<?php echo renderChart("includes/charts/includes/FCF_Pie3D.swf", "includes/charts/xml/customers.xml", "", "chart1", 400, 300); ?>
                        <div style="width:100%; border-top:1px solid #CCC; height:25px; padding-top:5px; text-align:left;"><a href="<?=tep_href_link(FILENAME_CUSTOMERS, '', 'NONSSL')?>" style="color:#06C">&raquo; Ver todos os clientes.</a></div>
                        </div>
                        
                        
                        
                    </td>
                  </tr>   
            </table>
        </td>
      </tr>
    </table>
	     

<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
