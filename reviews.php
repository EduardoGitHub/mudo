<?php
/*
  $Id: reviews.php,v 1.51 2003/06/09 23:03:55 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_REVIEWS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_REVIEWS));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<? include('metatags.php')?>
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
    
            <!-- body //-->
            <table border="0" width="99%" cellspacing="0" cellpadding="0">
              <tr>
            <!-- body_text //-->
                <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>
                            <table cellspacing="0" cellpadding="0" width="100%" style="padding-top:5PX;">
                            <tr>
                     <td width="100%" height="28" style="background-image:url(images/back_footer_information.jpg);" align="left"><span style="padding-left: 19px"></span><span class=ch3><?php echo HEADING_TITLE; ?></span></td>
                     </tr>  
                    </table>
                        </td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                  </tr>
                  <tr>
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
            <?php
              $reviews_query_raw = "select r.reviews_id, left(rd.reviews_text, 100) as reviews_text, r.reviews_rating, r.date_added, p.products_id, pd.products_name, p.products_image, r.customers_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and rd.languages_id = '" . (int)$languages_id . "' order by r.reviews_id DESC";
              $reviews_split = new splitPageResults($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);
            
              if ($reviews_split->number_of_rows > 0) {
                if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
            ?>
                      <tr>
                        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr>
                            <td class="pr_descr"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></td>
                            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                      </tr>
            <?php
                }
            
                $reviews_query = tep_db_query($reviews_split->sql_query);
                while ($reviews = tep_db_fetch_array($reviews_query)) {
            ?>
                      <tr>
                        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr>
                            <td class="main"><?php echo '<a pr_name href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews['products_id'] . '&reviews_id=' . $reviews['reviews_id']) . '"><u><b>' . $reviews['products_name'] . '</b></u></a> <span class="pr_descr">' . sprintf(TEXT_REVIEW_BY, tep_output_string_protected($reviews['customers_name'])) . '</span>'; ?></td>
                            <td class="pr_descr" align="right"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, tep_date_long($reviews['date_added'])); ?></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
                          <tr class="infoBoxContents2">
                            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                              <tr>
                                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                                <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" align="center" valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews['products_id'] . '&reviews_id=' . $reviews['reviews_id']) . '">' . tep_image(DIR_WS_IMAGES . $reviews['products_image'], $reviews['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?></td>
                                <td valign="top" class="main"><?php echo tep_break_string(tep_output_string_protected($reviews['reviews_text']), 60, '-<br>') . ((strlen($reviews['reviews_text']) >= 100) ? '..' : '') . '<br><br><i>' . sprintf(TEXT_REVIEW_RATING, tep_image(DIR_WS_IMAGES . 'stars_' . $reviews['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])) . '</i>'; ?></td>
                                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                      </tr>
            <?php
                }
            ?>
            <?php
              } else {
            ?>
                      <tr>
                        <td><?php new infoBox(array(array('text' => TEXT_NO_REVIEWS))); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                      </tr>
            <?php
              }
            
              if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
            ?>
                      <tr>
                        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <tr>
                            <td class="smallText"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></td>
                            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                      </tr>
            <?php
              }
            ?>
                    </table></td>
                  </tr>
                </table></td>
            <!-- body_text_eof //-->
              </tr>
            </table>
            <!-- body_eof //-->
    
              </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?> 