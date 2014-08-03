<?php
/*
  $Id: header_tags_seo.php,v 3.0 2008/01/10 by Jack_mcs - http://www.oscommerce-solution.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/

require_once(DIR_WS_FUNCTIONS . 'header_tags.php');
require_once(DIR_WS_FUNCTIONS . 'clean_html_comments.php'); // Clean out HTML comments from ALT tags etc.

$cache_output = '';
$canonical_url = '';
$header_tags_array = array();
$sortOrder = array();
$tmpTags = array();

$defaultTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS_DEFAULT . " where language_id = '" . (int)$languages_id . "'");
$defaultTags = tep_db_fetch_array($defaultTags_query);
$tmpTags['def_title']     =  (tep_not_null($defaultTags['default_title'])) ? $defaultTags['default_title'] : '';
$tmpTags['def_desc']      =  (tep_not_null($defaultTags['default_description'])) ? $defaultTags['default_description'] : '';
$tmpTags['def_keywords']  =  (tep_not_null($defaultTags['default_keywords'])) ? $defaultTags['default_keywords'] : '';
$tmpTags['def_logo_text'] =  (tep_not_null($defaultTags['default_logo_text'])) ? $defaultTags['default_logo_text'] : '';

// Define specific settings per page:
switch (true) {
  // INDEX.PHP
  case (basename($_SERVER['PHP_SELF']) === FILENAME_DEFAULT):
    $id = ($current_category_id ? 'c_' . (int)$current_category_id : ((isset($_GET['manufacturers_id']) ? 'm_' . (int)$_GET['manufacturers_id'] : '')));

    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, $id))
    {
       $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . FILENAME_DEFAULT . "' and language_id = '" . (int)$languages_id . "'");
       $pageTags = tep_db_fetch_array($pageTags_query);

       $catStr = "select categories_htc_title_tag as htc_title_tag, categories_htc_desc_tag as htc_desc_tag, categories_htc_keywords_tag as htc_keywords_tag from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$current_category_id . "' and language_id = '" . (int)$languages_id . "' limit 1";
       $manStr = '';
       if (isset($_GET['manufacturers_id']) && $category_depth == 'top')
         $manStr = "select mi.manufacturers_htc_title_tag as htc_title_tag, mi.manufacturers_htc_desc_tag as htc_desc_tag, mi.manufacturers_htc_keywords_tag as htc_keywords_tag from " . TABLE_MANUFACTURERS . " m LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi on m.manufacturers_id = mi.manufacturers_id where m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and mi.languages_id = '" . (int)$languages_id . "' limit 1";


       if ($pageTags['append_root'] || $category_depth == 'top' && ! isset($_GET['manufacturers_id']) )
       {
         
		 @(isset($sortOrder['title'][$pageTags['sortorder_root']]) ? $pageTags['page_title'] : '');
		 (isset($sortOrder['description'][$pageTags['sortorder_root']]) ? $pageTags['page_description'] : '');
		 (isset($sortOrder['keywords'][$pageTags['sortorder_root']]) ? $pageTags['page_keywords']  : '');
		 (isset($sortOrder['logo'][$pageTags['sortorder_root']]) ? $pageTags['page_logo'] : '');
		 (isset($sortOrder['logo_1'][$pageTags['sortorder_root_1']]) ? $pageTags['page_logo_1'] : '');
		 (isset($sortOrder['logo_2'][$pageTags['sortorder_root_2']]) ? $pageTags['page_logo_2'] : '');
		 (isset($sortOrder['logo_3'][$pageTags['sortorder_root_3']]) ? $pageTags['page_logo_3'] : '');
		 (isset($sortOrder['logo_4'][$pageTags['sortorder_root_4']]) ? $pageTags['page_logo_4'] : '');
       }

       $sortOrder = GetCategoryAndManufacturer($sortOrder, $pageTags, $defaultTags, $catStr, $manStr);

       if ($pageTags['append_default_title'] && tep_not_null($tmpTags['def_title'])) $sortOrder['title'][$pageTags['sortorder_title']] = $tmpTags['def_title'];
       if ($pageTags['append_default_description'] && tep_not_null($tmpTags['def_desc'])) $sortOrder['description'][$pageTags['sortorder_description']] = $tmpTags['def_desc'];
       if ($pageTags['append_default_keywords'] && tep_not_null($tmpTags['def_keywords'])) $sortOrder['keywords'][$pageTags['sortorder_keywords']] = $tmpTags['def_keywords'];
       if ($pageTags['append_default_logo'] && tep_not_null($tmpTags['def_logo_text']))  $sortOrder['logo'][$pageTags['sortorder_logo']] = $tmpTags['def_logo_text'];

       FillHeaderTagsArray($header_tags_array, $sortOrder);

       // Canonical URL add-on
       if (tep_not_null($cPath) || (isset($_GET['manufacturers_id']) && $category_depth == 'top'))
       {
          $args = tep_get_all_get_params(array('action','currency', tep_session_name(),'sort','page'));
          $canonical_url = StripSID(tep_href_link(FILENAME_DEFAULT, $args, 'NONSSL', false) );
       }
       WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, $id);
    }
    break;

  // PRODUCT_INFO.PHP
  // PRODUCT_REVIEWS.PHP
  // PRODUCT_REVIEWS_INFO.PHP
  // PRODUCT_REVIEWS_WRITE.PHP
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_INFO):
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_REVIEWS):
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_REVIEWS_INFO):
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_REVIEWS_WRITE):

    switch (true)
    {
     case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_INFO):          $filename = FILENAME_PRODUCT_INFO;          break;
     case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_REVIEWS):       $filename = FILENAME_PRODUCT_REVIEWS;       break;
     case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_REVIEWS_INFO):  $filename = FILENAME_PRODUCT_REVIEWS_INFO;  break;
     case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_REVIEWS_WRITE): $filename = FILENAME_PRODUCT_REVIEWS_WRITE; break;
     default: $filename = FILENAME_PRODUCT_INFO;
    }

    $id = ($_GET['products_id'] ? 'p_' . (int)$_GET['products_id'] : '');

    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, $id))
    {
       $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . $filename . "' and language_id = '" . (int)$languages_id . "'");
       $pageTags = tep_db_fetch_array($pageTags_query);

       $the_product_info_query = tep_db_query("select p.products_id, pd.products_head_title_tag, pd.products_head_keywords_tag, pd.products_head_desc_tag, p.manufacturers_id from " . TABLE_PRODUCTS . " p inner join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_id = '" . (int)$_GET['products_id'] . "' and pd.language_id ='" .  (int)$languages_id . "' limit 1");
       $the_product_info = tep_db_fetch_array($the_product_info_query);
       $header_tags_array['product'] = $the_product_info['products_head_title_tag'];  //save for use on the logo
       $tmpTags['prod_title'] = (tep_not_null($the_product_info['products_head_title_tag'])) ? $the_product_info['products_head_title_tag'] : '';
       $tmpTags['prod_desc'] = (tep_not_null($the_product_info['products_head_desc_tag'])) ? $the_product_info['products_head_desc_tag'] : '';
       $tmpTags['prod_keywords'] = (tep_not_null($the_product_info['products_head_keywords_tag'])) ? $the_product_info['products_head_keywords_tag'] : '';

       $catStr = "select c.categories_htc_title_tag as htc_title_tag, c.categories_htc_desc_tag as htc_desc_tag, c.categories_htc_keywords_tag as htc_keywords_tag from " . TABLE_CATEGORIES_DESCRIPTION . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_id = p2c.categories_id and p2c.products_id = '" . (int)$the_product_info['products_id'] . "' and language_id = '" . (int)$languages_id . "'";
       $manStr = "select mi.manufacturers_htc_title_tag as htc_title_tag, mi.manufacturers_htc_desc_tag as htc_desc_tag, mi.manufacturers_htc_keywords_tag as htc_keywords_tag from " . TABLE_MANUFACTURERS . " m LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi on m.manufacturers_id = mi.manufacturers_id  where m.manufacturers_id = '" . (int)$the_product_info['manufacturers_id'] . "' and mi.languages_id = '" . (int)$languages_id . "' LIMIT 1";

       if ($pageTags['append_root'])
       {
         $sortOrder['title'][$pageTags['sortorder_root']] = $pageTags['page_title'];
         $sortOrder['description'][$pageTags['sortorder_root']] = $pageTags['page_description'];
         $sortOrder['keywords'][$pageTags['sortorder_root']] = $pageTags['page_keywords'];
         $sortOrder['logo'][$pageTags['sortorder_root']] = $pageTags['page_logo'];
         $sortOrder['logo_1'][$pageTags['sortorder_root_1']] = $pageTags['page_logo_1'];
         $sortOrder['logo_2'][$pageTags['sortorder_root_2']] = $pageTags['page_logo_2'];
         $sortOrder['logo_3'][$pageTags['sortorder_root_3']] = $pageTags['page_logo_3'];
         $sortOrder['logo_4'][$pageTags['sortorder_root_4']] = $pageTags['page_logo_4'];
       }

       if ($pageTags['append_product'])
       {
         $sortOrder['title'][$pageTags['sortorder_product']] = $tmpTags['prod_title'];  //places the product title at the end of the list
         $sortOrder['description'][$pageTags['sortorder_product']] = $tmpTags['prod_desc'];
         $sortOrder['keywords'][$pageTags['sortorder_product']] = $tmpTags['prod_keywords'];
         $sortOrder['logo'][$pageTags['sortorder_product']] = $tmpTags['prod_title'];
       }

       $sortOrder = GetCategoryAndManufacturer($sortOrder, $pageTags, $defaultTags, $catStr, $manStr, true);
       if ($pageTags['append_default_title'] && tep_not_null($tmpTags['def_title'])) $sortOrder['title'][$pageTags['sortorder_title']] = $tmpTags['def_title'];
       if ($pageTags['append_default_description'] && tep_not_null($tmpTags['def_desc'])) $sortOrder['description'][$pageTags['sortorder_description']] = $tmpTags['def_desc'];
       if ($pageTags['append_default_keywords'] && tep_not_null($tmpTags['def_keywords'])) $sortOrder['keywords'][$pageTags['sortorder_keywords']] = $tmpTags['def_keywords'];
       if ($pageTags['append_default_logo'] && tep_not_null($tmpTags['def_logo_text']))  $sortOrder['logo'][$pageTags['sortorder_logo']] = $tmpTags['def_logo_text'];

       FillHeaderTagsArray($header_tags_array, $sortOrder);

       // Canonical URL add-on
       if ($_GET['products_id'] != '') {
           $canonical_url = StripSID(tep_href_link(basename($_SERVER['PHP_SELF']), 'products_id='.(int)$_GET['products_id']));
       }

       WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, $id);
    }
    break;

  // SPECIALS.PHP
  case (basename($_SERVER['PHP_SELF']) === FILENAME_SPECIALS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, ''))
    {
       $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . FILENAME_SPECIALS . "' and language_id = '" . (int)$languages_id . "'");
       $pageTags = tep_db_fetch_array($pageTags_query);

       // Build a list of ALL specials product names to put in keywords
       $new = tep_db_query("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added DESC ");
       $row = 0;
       $the_specials='';
       while ($new_values = tep_db_fetch_array($new)) {
         $the_specials .= clean_html_comments($new_values['products_name']) . ', ';
       }

       if (strlen($the_specials) > 30000)                  //arbitrary number - may vary with server setting
        $the_specials = substr($the_specials, 0, 30000);   //adjust as needed

       if ($pageTags['append_root'])
       {
         $sortOrder['title'][$pageTags['sortorder_root']] = $pageTags['page_title'];
         $sortOrder['description'][$pageTags['sortorder_root']] = $pageTags['page_description'];
         $sortOrder['keywords'][$pageTags['sortorder_root']] = $pageTags['page_keywords'];
         $sortOrder['logo'][$pageTags['sortorder_root']] = $pageTags['page_logo'];
         $sortOrder['logo_1'][$pageTags['sortorder_root']] = $pageTags['page_logo_1'];
         $sortOrder['logo_2'][$pageTags['sortorder_root']] = $pageTags['page_logo_2'];
         $sortOrder['logo_3'][$pageTags['sortorder_root']] = $pageTags['page_logo_3'];
         $sortOrder['logo_4'][$pageTags['sortorder_root']] = $pageTags['page_logo_4'];
       }

       $sortOrder['keywords'][10] = $the_specials;;

       if ($pageTags['append_default_title'] && tep_not_null($tmpTags['def_title'])) $sortOrder['title'][$pageTags['sortorder_title']] = $tmpTags['def_title'];
       if ($pageTags['append_default_description'] && tep_not_null($tmpTags['def_desc'])) $sortOrder['description'][$pageTags['sortorder_description']] = $tmpTags['def_desc'];
       if ($pageTags['append_default_keywords'] && tep_not_null($tmpTags['def_keywords'])) $sortOrder['keywords'][$pageTags['sortorder_keywords']] = $tmpTags['def_keywords'];
       if ($pageTags['append_default_logo'] && tep_not_null($tmpTags['def_logo_text']))  $sortOrder['logo'][$pageTags['sortorder_logo']] = $tmpTags['def_logo_text'];

       FillHeaderTagsArray($header_tags_array, $sortOrder);
       WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// advanced_search_result.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ADVANCED_SEARCH_RESULT):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ADVANCED_SEARCH_RESULT);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// shop_by_price.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_SHOP_BY_PRICE):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_SHOP_BY_PRICE);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// tell_a_friend.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_TELL_A_FRIEND):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_TELL_A_FRIEND);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// shopping_cart.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_SHOPPING_CART):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_SHOPPING_CART);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// contact_us.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CONTACT_US):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CONTACT_US);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// news.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_NEWS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_NEWS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// warranty.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_WARRANTY):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_WARRANTY);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// information_store.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_INFORMATION_STORE):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_INFORMATION_STORE);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// notifyme_product.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_NOTIFYME_PRODUCT):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_NOTIFYME_PRODUCT);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// pollbooth.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_POLLBOOTH):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_POLLBOOTH);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// login.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_LOGIN):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_LOGIN);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// account.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ACCOUNT):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ACCOUNT);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// account_edit.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ACCOUNT_EDIT):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ACCOUNT_EDIT);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// account_history.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ACCOUNT_HISTORY):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ACCOUNT_HISTORY);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// account_password.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ACCOUNT_PASSWORD):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ACCOUNT_PASSWORD);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// checkout_confirmation.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CHECKOUT_CONFIRMATION):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CHECKOUT_CONFIRMATION);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// checkout_payment.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CHECKOUT_PAYMENT):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CHECKOUT_PAYMENT);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// checkout_payment_address.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CHECKOUT_PAYMENT_ADDRESS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CHECKOUT_PAYMENT_ADDRESS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// checkout_shipping.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CHECKOUT_SHIPPING):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CHECKOUT_SHIPPING);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// checkout_shipping_address.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CHECKOUT_SHIPPING_ADDRESS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CHECKOUT_SHIPPING_ADDRESS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// checkout_success.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CHECKOUT_SUCCESS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CHECKOUT_SUCCESS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// create_account.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CREATE_ACCOUNT):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CREATE_ACCOUNT);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// create_account_success.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CREATE_ACCOUNT_SUCCESS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CREATE_ACCOUNT_SUCCESS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// logoff.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_LOGOFF):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_LOGOFF);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// password_forgotten.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PASSWORD_FORGOTTEN):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PASSWORD_FORGOTTEN);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// alterar-tamanho-de-sua-imagem.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ALTERAR_TAMANHO_DE_SUA_IMAGEM):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ALTERAR-TAMANHO-DE-SUA-IMAGEM);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// como-aplicar.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_COMO_APLICAR):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_COMO_APLICAR);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// envie-seu-modelo.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ENVIE_SEU_MODELO):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ENVIE_SEU_MODELO);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// envie-seus-arquivos-fale-conosco.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ENVIE_SEUS_ARQUIVOS_FALE_CONOSCO):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ENVIE_SEUS_ARQUIVOS_FALE_CONOSCO);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// envie-seus-arquivos.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_ENVIE_SEUS_ARQUIVOS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_ENVIE_SEUS_ARQUIVOS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// foto-art.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_FOTO_ART):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_FOTO_ART);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// foto-wall.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_FOTO_WALL):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_FOTO_WALL);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// frases.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_FRASES):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_FRASES);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// galeria-de-fotos.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_GALERIA_DE_FOTOS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_GALERIA_DE_FOTOS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// paleta-de-cores.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PALETA_DE_CORES):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PALETA_DE_CORES);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// products_new.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCTS_NEW):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PRODUCTS_NEW);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// produtos-personalizados.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUTOS_PERSONALIZADOS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PRODUTOS_PERSONALIZADOS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// projetos-corporativos.php

  case (basename($_SERVER['PHP_SELF']) === FILENAME_PROJETOS_CORPORATIVOS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {

      $header_tags_array = tep_header_tag_page(FILENAME_PROJETOS_CORPORATIVOS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// afiliados-cadastro.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_AFILIADOS-CADASTRO):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_AFILIADOS-CADASTRO);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// afiliados-sucesso.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_AFILIADOS-SUCESSO):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_AFILIADOS-SUCESSO);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// afiliados.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_AFILIADOS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_AFILIADOS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// avaliacao-de-produtos.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_AVALIACAO-DE-PRODUTOS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_AVALIACAO-DE-PRODUTOS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// convenio.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_CONVENIO):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_CONVENIO);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// parceiros-cadastro.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PARCEIROS-CADASTRO):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PARCEIROS-CADASTRO);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// parceiros-sucesso.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PARCEIROS-SUCESSO):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PARCEIROS-SUCESSO);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// parceiros.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PARCEIROS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PARCEIROS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// product_reviews-Original.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_REVIEWS-ORIGINAL):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PRODUCT_REVIEWS-ORIGINAL);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// produtos-para-sorteios.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUTOS-PARA-SORTEIOS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_PRODUTOS-PARA-SORTEIOS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// troca-de-banners.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_TROCA-DE-BANNERS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_TROCA-DE-BANNERS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// troca-de-links.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_TROCA-DE-LINKS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_TROCA-DE-LINKS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// troca-de-posts.php
  case (basename($_SERVER['PHP_SELF']) === FILENAME_TROCA-DE-POSTS):
    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '')) {
      $header_tags_array = tep_header_tag_page(FILENAME_TROCA-DE-POSTS);
      WriteCacheHeaderTags($header_tags_array, basename($_SERVER['PHP_SELF']), $language, '');
    }
  break;

// ALL OTHER PAGES NOT DEFINED ABOVE
  default:
    $header_tags_array['title'] = tep_db_prepare_input($defaultTags['default_title']);
    $header_tags_array['desc'] = tep_db_prepare_input($defaultTags['default_description']);
    $header_tags_array['keywords'] = tep_db_prepare_input($defaultTags['default_keywords']);
    break;
  }

echo ' <meta http-equiv="Content-Type" content="text/html; charset=' . CHARSET  . '" />'."\n";
echo ' <title>' . (isset($header_tags_array['title']) ? $header_tags_array['title'] : '')  . '</title>' . "\n";
echo ' <meta name="Description" content="' . (isset($header_tags_array['desc']) ? $header_tags_array['desc'] : '')  . '" />' . "\n";
echo ' <meta name="Keywords" content="' . (isset($header_tags_array['keywords']) ? $header_tags_array['keywords'] : '') . '" />' . "\n";

if ($defaultTags['meta_language']) { $langName = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]); echo ' <meta http-equiv="Content-Language" content="' . $langName[0] . '" />'."\n"; }

echo ' <meta http-equiv="cache-control" content="no-cache" />' . "\n";
echo ' <meta http-equiv="pragma" content="no-cache" />' . "\n";
echo ' <meta http-equiv="expires" content="-1" />'. "\n";
echo ' <meta name="p:domain_verify" content="b6faeae16bc534fc934207894642a127"/>'. "\n";
if(ENTRY_GOOGLE_SITE_VERIFICATION !='')echo '<meta name="google-site-verification" content="'.ENTRY_GOOGLE_SITE_VERIFICATION.'" />' . "\n";
if ($defaultTags['meta_google'])    echo ' <meta name="googlebot" content="all" />' . "\n";
if ($defaultTags['meta_noodp'])     echo ' <meta name="robots" content="noodp" />' . "\n";
if ($defaultTags['meta_noydir'])    echo ' <meta name="slurp" content="noydir" />' . "\n";
if ($defaultTags['meta_revisit'])   echo ' <meta name="revisit-after" content="1 days" />' . "\n";
if ($defaultTags['meta_robots'])    echo ' <meta name="robots" content="index, follow" />' . "\n";
if ($defaultTags['meta_unspam'])    echo ' <meta name="no-email-collection" content="' . HTTP_SERVER . '" />' . "\n";
if ($defaultTags['meta_replyto'])   echo ' <meta name="Reply-to" content="' . STORE_OWNER_EMAIL_ADDRESS . '" />' . "\n";
if ($defaultTags['meta_canonical']) echo (tep_not_null($canonical_url) ? ' <link rel="canonical" href="'.$canonical_url.'" />'. "\n" : ' <link rel="canonical" href="'.GetCanonicalURL().'" />'. "\n");
?>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">


<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
        $.src='//v2.zopim.com/?25Z3FmJfOxSZ0wZMG4prBXnolDJ2WYmA';z.t=+new Date;$.
            type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
