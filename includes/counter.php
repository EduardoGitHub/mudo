<?php
/*
  $Id: counter.php,v 1.5 2003/02/10 22:30:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

	$counter_query = tep_db_query("select startdate, counter from " . TABLE_COUNTER);
	$counter = tep_db_fetch_array($counter_query);
	$counter_now = $counter['counter'];
	$counter_startdate = $counter['startdate'];
	$counter_startdate_formatted = strftime(DATE_FORMAT_LONG, mktime(0, 0, 0, substr($counter_startdate, 4, 2), substr($counter_startdate, -2), substr($counter_startdate, 0, 4)));
?>
