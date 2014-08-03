<?php
/*
  $Id: column_left.php,v 1.15 2002/01/11 05:03:25 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
/*** Begin Header Tags SEO ***/
  if (HEADER_TAGS_DISPLAY_SILO_BOX == 'true')
    if (isset($category_depth) && $category_depth !== 'top')
      include(DIR_WS_BOXES . 'headertags_seo_silo.php');
/*** End Header Tags SEO ***/

  require(DIR_WS_BOXES . 'configuration.php');
  require(DIR_WS_BOXES . 'catalog.php');
  require(DIR_WS_BOXES . 'modules.php');
  require(DIR_WS_BOXES . 'customers.php');
  require(DIR_WS_BOXES . 'taxes.php');
  //require(DIR_WS_BOXES . 'localization.php');
  require(DIR_WS_BOXES . 'reports.php');
  require(DIR_WS_BOXES . 'editor.php');
  require(DIR_WS_BOXES . 'tools.php');
  require(DIR_WS_BOXES . 'polls.php');
  require(DIR_WS_BOXES . 'coupons.php');
  
/*** Begin Header Tags SEO ***/
require(DIR_WS_BOXES . 'header_tags_seo.php');
/*** End Header Tags SEO ***/
?>
