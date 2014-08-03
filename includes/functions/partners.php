<?php
/*
  $Id: banner.php,v 1.12 2003/06/20 00:12:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

////

// Sets the status of a banner
  function tep_set_partner_status($partners_id, $status) {
    if ($status == '1') {
      return tep_db_query("update " . TABLE_PARTNERS . " set status = '1', date_status_change = now(), date_scheduled = NULL where banners_id = '" . (int)$partners_id . "'");
    } elseif ($status == '0') {
      return tep_db_query("update " . TABLE_PARTNERS . " set status = '0', date_status_change = now() where banners_id = '" . (int)$partners_id . "'");
    } else {
      return -1;
    }
  }

////
// Auto activate banners
  function tep_activate_partners() {
    $partners_query = tep_db_query("select banners_id, date_scheduled from " . TABLE_PARTNERS . " where date_scheduled != ''");
    if (tep_db_num_rows($partners_query)) {
      while ($partners = tep_db_fetch_array($partners_query)) {
        if (date('Y-m-d H:i:s') >= $partners['date_scheduled']) {
          tep_set_partner_status($partners['banners_id'], '1');
        }
      }
    }
  }

////
// Auto expire banners
  function tep_expire_partners() {
    $partners_query = tep_db_query("select b.banners_id, b.expires_date, b.expires_impressions, sum(bh.banners_shown) as banners_shown from " . TABLE_PARTNERS . " b, " . TABLE_PARTNERS_HISTORY . " bh where b.status = '1' and b.banners_id = bh.banners_id group by b.banners_id");
    if (tep_db_num_rows($partners_query)) {
      while ($partners = tep_db_fetch_array($partners_query)) {
        if (tep_not_null($partners['expires_date'])) {
          if (date('Y-m-d H:i:s') >= $partners['expires_date']) {
            tep_set_partner_status($partners['banners_id'], '0');
          }
        } elseif (tep_not_null($partners['expires_impressions'])) {
          if ( ($partners['expires_impressions'] > 0) && ($partners['banners_shown'] >= $partners['expires_impressions']) ) {
            tep_set_partner_status($partners['banners_id'], '0');
          }
        }
      }
    }
  }

////
// Display a banner from the specified group or banner id ($identifier)
  function tep_display_partner($action, $identifier) {
    if ($action == 'dynamic') {
      $partners_query = tep_db_query("select count(*) as count from " . TABLE_PARTNERS . " where status = '1' and banners_group = '" . $identifier . "'");
      $partners = tep_db_fetch_array($partners_query);
      if ($partners['count'] > 0) {
        $partner = tep_random_select("select banners_id, banners_title, banners_image, banners_html_text from " . TABLE_PARTNERS . " where status = '1' and banners_group = '" . $identifier . "'");
      } else {
        return '<b>TEP ERROR! (tep_display_banner(' . $action . ', ' . $identifier . ') -> No banners with group \'' . $identifier . '\' found!</b>';
      }
    } elseif ($action == 'static') {
      if (is_array($identifier)) {
        $partner = $identifier;
      } else {
        $partner_query = tep_db_query("select banners_id, banners_title, banners_image, banners_html_text from " . TABLE_PARTNERS . " where status = '1' and banners_id = '" . (int)$identifier . "'");
        if (tep_db_num_rows($partner_query)) {
          $partner = tep_db_fetch_array($partner_query);
        } else {
          return '<b>TEP ERROR! (tep_display_banner(' . $action . ', ' . $identifier . ') -> Banner with ID \'' . $identifier . '\' not found, or status inactive</b>';
        }
      }
    } else {
      return '<b>TEP ERROR! (tep_display_banner(' . $action . ', ' . $identifier . ') -> Unknown $action parameter value - it must be either \'dynamic\' or \'static\'</b>';
    }

    if (tep_not_null($partner['banners_html_text'])) {
      $partner_string = $partner['banners_html_text'];
    } else {
      if ( substr($partner['banners_image'], -3, 3) == 'swf' ) {
	  $size = getimagesize(DIR_WS_IMAGES . $partner['banners_image']);
      $banner_string = '<a href="' . tep_href_link(FILENAME_REDIRECT, 'action=parceiro&goto=' . $partner['banners_id']) . '" target="_blank">' . mm_output_flash_movie( $partner['banners_title'], DIR_WS_IMAGES . $partner['banners_image'] , $size[0]  , $size[1]) . '</a>';
	  } else {
	  $partner_string = '<a href="' . tep_href_link(FILENAME_REDIRECT, 'action=parceiro&goto=' . $partner['banners_id']) . '" target="_blank">' . tep_image(DIR_WS_IMAGES . $partner['banners_image'], $partner['banners_title']) . '</a>';
	  }
	}

    tep_update_partner_display_count($partner['banners_id']);

    return $partner_string;
  }

////
// Check to see if a banner exists
  function tep_partner_exists($action, $identifier) {
    if ($action == 'dynamic') {
      return tep_random_select("select banners_id, banners_title, banners_image, banners_html_text from " . TABLE_PARTNERS . " where status = '1' and banners_group = '" . $identifier . "'");
    } elseif ($action == 'static') {
      $partner_query = tep_db_query("select banners_id, banners_title, banners_image, banners_html_text from " . TABLE_PARTNERS . " where status = '1' and banners_id = '" . (int)$identifier . "'");
      return tep_db_fetch_array($partner_query);
    } else {
      return false;
    }
  }

////
// Update the banner display statistics
  function tep_update_partner_display_count($partner_id) {
    $partner_check_query = tep_db_query("select count(*) as count from " . TABLE_PARTNERS_HISTORY . " where banners_id = '" . (int)$partner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
    $partner_check = tep_db_fetch_array($partner_check_query);

    if ($partner_check['count'] > 0) {
      tep_db_query("update " . TABLE_PARTNERS_HISTORY . " set banners_shown = banners_shown + 1 where banners_id = '" . (int)$partner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
    } else {
      tep_db_query("insert into " . TABLE_PARTNERS_HISTORY . " (banners_id, banners_shown, banners_history_date) values ('" . (int)$partner_id . "', 1, now())");
    }
  }

////
// Update the banner click statistics
  function tep_update_partner_click_count($partner_id) {
    tep_db_query("update " . TABLE_PARTNERS_HISTORY . " set banners_clicked = banners_clicked + 1 where banners_id = '" . (int)$partner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
  }
?>