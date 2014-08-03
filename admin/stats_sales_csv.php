<?php
/*
 ===========================================
	Created by Dave Ferrise - Ferrise Design
	www.ferrisedesign.com
	For use with Oscommerce
	Use with permission only
	Copyright 2005 FerriseDesign
 ===========================================
 ===========================================
    9/22/05 - added international currency
	          support by using $currencies->format()
			  class instead or hard-coded "$"
 ===========================================
*/
  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  $sales_products_query = tep_db_query("select sum(op.final_price*op.products_quantity) as daily_prod, sum(op.final_price*op.products_quantity*(1+op.products_tax/100)) as withtax, o.date_purchased, op.products_name, sum(op.products_quantity) as qty, op.products_model from orders as o, orders_products as op where o.orders_id = op.orders_id GROUP by year(o.date_purchased), month(o.date_purchased) ORDER BY year(o.date_purchased) DESC, month(o.date_purchased) DESC");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>

<!-- body_text //-->
    <td width="100%" valign="top" id="main">
	  <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td>
		  <form action="<?php echo $PHP_SELF; ?>" method="post" name="reportit">
	        <table border="0" width="60%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading" width="500" nowrap><?php echo HEADING_TITLE; ?></td>
                <td class="main" align="right">&nbsp;</td>
              </tr>
              <tr>
                <td class="main" align="left" colspan='2'><BR><BR><?php echo TEXT_FACTOR . ":";?>&nbsp;&nbsp;
<select name="multiplex">
                      <option value="1" <?php if ($multiplex == 1) echo "selected";?>>1</option>
                      <option value="10" <?php if ($multiplex == 10) echo "selected";?>>10</option>
                      <option value="25" <?php if (($multiplex == 25) || ($multiplex == '')) echo "selected";?>>25</option>
                      <option value="50" <?php if ($multiplex == 50) echo "selected";?>>50</option>
                      <option value="100" <?php if ($multiplex == 100) echo "selected";?>>100</option>
                      <option value="500" <?php if ($multiplex == 500) echo "selected";?>>500</option>
                      <option value="1000" <?php if ($multiplex == 1000) echo "selected";?>>1000</option>
                      <option value="10000" <?php if ($multiplex == 10000) echo "selected";?>>10000</option>
                    </select>
                    <input type="submit" name=<?php echo TEXT_BUTTON; ?> value=<?php echo TEXT_BUTTON; ?>>
				</td>
              </tr>
            </table>
	      </form>
          </td>
        </tr>
<?php
if  ($multiplex !='') {
  if (tep_db_num_rows($sales_products_query) > 0) {
?>
        <tr>
          <td class=main>
		    <table>
<?php
// open file

	$fp = fopen(DL_LOC,"w");
	fputs($fp, CSV_MONTH . ";" . CSV_SALES . ";" .  CSV_WITH_TAX . "\r");
    while ($sales_products = tep_db_fetch_array($sales_products_query)) {
	  if  (date("M-Y") == date("M-Y",strtotime($sales_products['date_purchased']))) {
		echo "<tr><td colspan='3'><hr></td></tr>";
		echo "<tr><td class=mainred width='70'>";
		echo TEXT_PROJECTED.": </td>\n";
		$this_day = date("j");
		$tot_days = date("t");
		$m_amt = round($sales_products ['daily_prod'],0);
		$proj = round(($m_amt/$this_day)*$tot_days,0);
		$pbar = $proj/$multiplex;
		echo "<td class=mainred width='70' align='right'>&nbsp;". $currencies->format($proj) . "&nbsp;</td>\n";
		echo "<td class=main><img src='images/bar_red.jpg' height='10' width='".$pbar."' border='1'></td>\n</tr>\n";
		echo "<tr><td colspan='3'><hr></td></tr>";
	  }
	  fputs($fp, date("M-Y",strtotime($sales_products['date_purchased'])) . ";" .round($sales_products ['daily_prod'],2) . ";" . round($sales_products ['withtax'],2)."\r");
	  echo "<tr><td class=main width='70'>";
      echo date("M-Y",strtotime($sales_products['date_purchased']))."</td>\n";
	  $m_amt = round($sales_products ['daily_prod'],0);
	  $bar = $m_amt/$multiplex;
	  echo "<td class=main width='70' align='right'>&nbsp;". $currencies->format($m_amt)."&nbsp;</td>\n";
	  echo "<td class=main><img src='images/bar.jpg' height='10' width='".$bar."' border='1'></td>\n</tr>\n";
	}
?>
		    </table>
		  </td>
		</tr>
        <tr>
          <td class=main>
          <?php echo "<a href='" . tep_href_link(DL_LOC, '', 'NONSSL'). "'>" . TEXT_DOWNLOAD . "</a></td>";?>
        </tr>
<?php
  } else {
?>
        <tr>
          <td class=main><b><?php echo TEXT_NO_SALES;?></b></td>
        </tr>
<?php
   }
}
?>
      </table>
    </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
