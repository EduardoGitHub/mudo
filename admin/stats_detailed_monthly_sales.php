<?
require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
		<title><?php echo TITLE; ?></title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
        <script language="javascript" src="includes/general.js"></script>
	</head>
	<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
		<? if ( ! $_REQUEST['print'] ) require(DIR_WS_INCLUDES . 'header.php'); ?>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
  		<tr>

  			<td width="100%" valign="top" id="main">
  				<div class="pageHeading"><?= HEADING_TITLE ?></div><br />
  				<table border="0" width='100%' cellspacing="0" cellpadding="2">
<?
if ( isset( $_REQUEST['year'] ) && isset( $_REQUEST['month'] ) ) {
	if ( ! in_array( $_REQUEST['month'], explode( ',', MONTH_LIST ) ) ) {
?>
						<tr>
							<td class="pageHeading">Erro!</td>
						</tr>
						<tr>
							<td class="dataTableContent">'<?= mesReferente($_REQUEST['month']) ?>' não é um mês valido!</td>
						</tr>
<?
	} else {
?>
						<tr>
							<td class="pageHeading" colspan="6"><?= $_REQUEST['year'] ?> &raquo; <?= mesReferente($_REQUEST['month']) ?></td>
						</tr>
						<tr>
							<td class="dataTableContent" colspan="3"><a href="<?=tep_href_link('stats_detailed_monthly_sales.php');?>">Voltar</a></td>
							<td class="dataTableContent" colspan="3" align="right"><? if ( ! $_REQUEST['print'] ) { ?><a href="<?=tep_href_link('stats_detailed_monthly_sales.php', 'year='.$_REQUEST['year'].'&month='.$_GET['month'].'&amp;print=true') ?>" target="_blank">versão para impressão</a></td><? } ?>
						</tr>
						<tr>
							<td class="dataTableContent" colspan="6">&nbsp;</td>
						</tr>
						<tr class="dataTableHeadingRow">
							<td class="dataTableHeadingContent">Pedido #</td>
							<td class="dataTableHeadingContent">Cliente</td>
							<td class="dataTableHeadingContent">Data</td>
							<td class="dataTableHeadingContent" align="right">Sub Total do pedido</td>
							<td class="dataTableHeadingContent" align="right">Total valor entrega</td>
							<td class="dataTableHeadingContent" align="right">Total taxa</td>
							<td class="dataTableHeadingContent" align="right">Total pedido</td>
						</tr>
<?
	$orders_query = tep_db_query( "SELECT * FROM orders WHERE year( date_purchased ) = " . $_REQUEST['year'] . " AND monthname( date_purchased ) = '" . mesReferenteEN($_REQUEST['month']) . "' ORDER BY date_purchased DESC" );
	$running_net_total = 0;
	$running_tax_total = 0;
	$running_shipping_total = 0;
	$order_count=0;
	while ( $orders = tep_db_fetch_array( $orders_query ) ) {
		$order_count++;
		$net_total_query = tep_db_query( "SELECT value AS total FROM orders_total WHERE orders_id = " . $orders['orders_id'] . " AND class = 'ot_subtotal'" );
		$net_total = tep_db_fetch_array( $net_total_query );
		$shipping_total_query = tep_db_query( "SELECT value AS total FROM orders_total WHERE orders_id = " . $orders['orders_id'] . " AND class = 'ot_shipping'" );
		$shipping_total = tep_db_fetch_array( $shipping_total_query );
		$tax_total_query = tep_db_query( "SELECT value AS total FROM orders_total WHERE orders_id = " . $orders['orders_id'] . " AND class = 'ot_tax'" );
		$tax_total = tep_db_fetch_array( $tax_total_query );
		$running_net_total += $net_total['total'];
		$running_shipping_total += $shipping_total['total'];
		$running_tax_total += $tax_total['total'];
?>
						<tr class="dataTableRow">
							<td class="dataTableContent"> <a href="<?=tep_href_link('invoice.php', 'oID='.$orders['orders_id']) ?>" target="_blank"><?= $orders['orders_id'] ?>
                            <a href="<?=tep_href_link('invoice.php', 'oID='.$orders['orders_id']) ?>"></td>
							<td class="dataTableContent"><?= $orders['customers_name'] ?></td>
							<td class="dataTableContent"><?= date( 'd/m/Y', strtotime( $orders['date_purchased'] ) ) ?></td>
							<td class="dataTableContent" align="right">$<?= number_format( $net_total['total'], 2 ) ?></td>
							<td class="dataTableContent" align="right">$<?= number_format( $shipping_total['total'], 2 ) ?></td>
							<td class="dataTableContent" align="right">$<?= number_format( $tax_total['total'], 2 ) ?></td>
							<td class="dataTableContent" align="right">$<?= number_format( $net_total['total'] + $shipping_total['total'] + $tax_total['total'], 2 ) ?></td>
						</tr>
<?
	}
?>
						<tr class="dataTableHeadingRow">
                        	<td class="dataTableHeadingContent"><?php echo $order_count ?> pedidos</td>
							<td class="dataTableHeadingContent" colspan="2">&nbsp;</td>
							<td class="dataTableHeadingContent" align="right">$<?= number_format( $running_net_total, 2 ) ?></td>
							<td class="dataTableHeadingContent" align="right">$<?= number_format( $running_shipping_total, 2 ) ?></td>
							<td class="dataTableHeadingContent" align="right">$<?= number_format( $running_tax_total, 2 ) ?></td>
							<td class="dataTableHeadingContent" align="right">$<?= number_format( $running_net_total + $running_shipping_total + $running_tax_total, 2 ) ?></td>
						</tr>
<?
	}
} else {
	$count = 0;
	$years_query = tep_db_query( "SELECT DISTINCT( year( date_purchased ) ) AS y FROM " . TABLE_ORDERS . " ORDER BY date_purchased DESC" );
	$total_running_net_total =0;
	$total_running_shipping_total =0;
	$total_running_tax_total =0;
	while ( $years = tep_db_fetch_array( $years_query ) ) {
		if ( $count > 0 ) {
?>
						<tr>
							<td class="dataTableContent">&nbsp;
						</tr>	
<?
		}
?>
						<tr>
							<td class="pageHeading" colspan="4"><?= $years['y'] ?></td>
						</tr>
						<tr class="dataTableHeadingRow">
							<td class="dataTableHeadingContent" width="20%" align="left"><?= TABLE_HEADING_MONTH ?></td>
							<td class="dataTableHeadingContent" width="20%" align="right"><?= TABLE_HEADING_TOTAL_SALES_NET ?></td>
							<td class="dataTableHeadingContent" width="20%" align="right"><?= TABLE_HEADING_TOTAL_SHIPPING ?></td>
							<td class="dataTableHeadingContent" width="20%" align="right"><?= TABLE_HEADING_TOTAL_TAX ?></td>
							<td class="dataTableHeadingContent" width="20%" align="right"><?= TABLE_HEADING_TOTAL_SALES_GROSS ?></td>
						</tr>
<?
		$months_query = tep_db_query( "SELECT DISTINCT( monthname( date_purchased ) ) AS month, month( date_purchased ) AS m FROM " . TABLE_ORDERS . " WHERE date_purchased LIKE '" . $years['y'] . "-%' ORDER BY date_purchased DESC" );
		while ( $months = tep_db_fetch_array( $months_query ) ) {
			$net_total_query = tep_db_query( "SELECT SUM( value ) AS total FROM orders_total ot, orders o WHERE ot.orders_id=o.orders_id AND year( o.date_purchased ) = " . $years['y'] . " AND month( o.date_purchased ) = " . $months['m'] . "  AND ot.class = 'ot_subtotal'" );
			$net_total = tep_db_fetch_array( $net_total_query );
			$shipping_total_query = tep_db_query( "SELECT SUM( value ) AS total FROM orders_total ot, orders o WHERE ot.orders_id=o.orders_id AND year( o.date_purchased ) = " . $years['y'] . " AND month( o.date_purchased ) = " . $months['m'] . "  AND ot.class = 'ot_shipping'" );
			$shipping_total = tep_db_fetch_array( $shipping_total_query );
			$tax_total_query = tep_db_query( "SELECT SUM( value ) AS total FROM orders_total ot, orders o WHERE ot.orders_id=o.orders_id AND year( o.date_purchased ) = " . $years['y'] . " AND month( o.date_purchased ) = " . $months['m'] . "  AND ot.class = 'ot_tax'" );
			$tax_total = tep_db_fetch_array( $tax_total_query );
			$yearly_running_net_total += $net_total['total'];
			$yearly_running_shipping_total += $shipping_total['total'];
			$yearly_running_tax_total += $tax_total['total'];
			$total_running_net_total += $net_total['total'];
			$total_running_shipping_total += $shipping_total['total'];
			$total_running_tax_total += $tax_total['total'];
?>
					
    <tr class="dataTableRow">
        <td class="dataTableContent"><a href="<?=tep_href_link('stats_detailed_monthly_sales.php', 'year='.$years['y'].'&month='.mesReferente($months['month'])) ?>"><?= mesReferente($months['month']) ?></a></td>
        <td class="dataTableContent" align="right">$<?= number_format( $net_total['total'], 2 ) ?></td>
        <td class="dataTableContent" align="right">$<?= number_format( $shipping_total['total'], 2 ) ?></td>
        <td class="dataTableContent" align="right">$<?= number_format( $tax_total['total'], 2 ) ?></td>
        <td class="dataTableContent" align="right">$<?= number_format( $net_total['total'] + $shipping_total['total'] + $tax_total['total'], 2 ) ?></td>
    </tr>
					
<?
			$count ++;
		}
?>
    <tr class="dataTableHeadingRow">
        <td class="dataTableContent" style="color:#FFF"><?= $years['y'] ?> Total</td>
        <td class="dataTableHeadingContent" align="right">$<?= number_format( $yearly_running_net_total, 2 ) ?></td>
        <td class="dataTableHeadingContent" align="right">$<?= number_format( $yearly_running_shipping_total, 2 ) ?></td>
        <td class="dataTableHeadingContent" align="right">$<?= number_format( $yearly_running_tax_total, 2 ) ?></td>
        <td class="dataTableHeadingContent" align="right">$<?= number_format( $yearly_running_net_total + $yearly_running_shipping_total + $yearly_running_tax_total, 2 ) ?></td>
    </tr>
<?
		$yearly_running_net_total =0;
		$yearly_running_shipping_total =0;
		$yearly_running_tax_total =0;
	}
?>

			<tr>
            	<td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td class="pageHeading" colspan="5">TOTAL</td>
            </tr>
                        
            <tr class="dataTableHeadingRow">
                <td class="dataTableContent" style="color:#FFF">Total de vendas da Loja</td>
                <td class="dataTableHeadingContent" align="right">$<?= number_format( $total_running_net_total, 2 ) ?></td>
                <td class="dataTableHeadingContent" align="right">$<?= number_format( $total_running_shipping_total, 2 ) ?></td>
                <td class="dataTableHeadingContent" align="right">$<?= number_format( $total_running_tax_total, 2 ) ?></td>
                <td class="dataTableHeadingContent" align="right">$<?= number_format( $total_running_net_total + $total_running_shipping_total + $total_running_tax_total, 2 ) ?></td>
            </tr>
<?
}
?>
					</table>
  			</td>
  		</tr>
		</table>
		<? if ( ! $_REQUEST['print'] ) require(DIR_WS_INCLUDES . 'footer.php'); ?>
	</body>
</html>
  		