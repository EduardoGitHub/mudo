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
    <?
		//if($admin['username']==''
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