<?php
/*
  $Id: tools.php,v 1.21 2003/07/09 01:18:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tools //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => 'Cupom de Desc.',
                     'link'  => tep_href_link(FILENAME_DISCOUNT_COUPONS, 'selected_box=coupons'));

  if ($selected_box == 'coupons') {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_DISCOUNT_COUPONS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_DISCOUNT_COUPONS . '</a><br/>' .
                                   '<a href="' . tep_href_link(FILENAME_STATS_DISCOUNT_COUPONS, '', 'NONSSL') . '" class="menuBoxContentLink">Estatísticas</a>');
  }
  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- tools_eof //-->
