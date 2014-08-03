<?php
/*
  $Id: invoice.php,v 1.6 2003/06/20 00:37:30 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $oID = tep_db_prepare_input($HTTP_GET_VARS['oID']);
  //$orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
  include(DIR_WS_CLASSES . 'order.php');
  $order = new order($oID);
  
  $orders_query = tep_db_query("select comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . (int)$oID . "' and orders_obs_invoice = 1");
  $orders_obs = tep_db_fetch_array($orders_query);
  $num_rows = tep_db_num_rows($orders_query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<style>
BODY {
  margin: 0;
  padding: 0;
  text-align: center;
  font-size: 10px;
  font-family: 'Trebuchet MS', Helvetica, sans-serif;
}

td {
    font-size: 11px;
    font-family: 'Trebuchet MS', Helvetica, sans-serif;
}
.pageHeading {
  font-family: 'Trebuchet MS', Helvetica, sans-serif;
  font-size: 15px;
  font-weight: bold;
  color: #575757;
}

.main {  font-size: 12px; }

.dataTableHeadingRow { background-color: #FFF; }
.dataTableHeadingContent {   color: #000; font-weight: bold; border-bottom:1px solid #000; border-top:1px solid #000; text-align:left; }
.dataTableRow { background-color: #FFF; text-align:left;}
a#this { color: blue; background: transparent;}
.dataTableRowSelected { background-color: #FFF; }
.dataTableRowOver { background-color: #FFFFFF; cursor: pointer; cursor: hand; }
.dataTableContent {   color: #000000; text-align:left; }
.smallText {   }

.DivReportInvoice{ border:1px solid #EEE; width:605px; margin:0 auto; padding:5px;}
.DivReportInvoice .campo{ font-family:Arial; font-size:11px; font-weight:bold; text-align:left; padding-left:2px;}
.DivReportInvoice .texto{ font-family:Arial; font-size:11px; text-align:left; padding-left:2px;}
</style>

<script type="text/javascript" src="../includes/librays/jquery.js" ></script>
<script type="text/javascript">
function ClickHereToPrint(){
try{
var oIframe = document.getElementById('ifrmPrint');
var oContent = document.getElementById('divToPrint').innerHTML;
var oDoc = (oIframe.contentWindow || oIframe.contentDocument);
if (oDoc.document) oDoc = oDoc.document;
oDoc.write("<head><title>Fatura</title>");
oDoc.write("</head><body onload='this.focus(); this.print();'>");
oDoc.write(oContent + "</body>");
oDoc.close();
}
catch(e){
self.print();
}
}
</script>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<br />
<input type="button" onclick="ClickHereToPrint();" value="Imprimir Fatura" />

<iframe id='ifrmPrint' src='#' style="width:0px; height:0px; visibility:hidden"></iframe><br /><br />
<div class="DivReportInvoice" id="divToPrint">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    	<!--CABEÇALHO LOGOMARCA -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="38%" style="border-right:1px solid #CCC;"><img src="../images/logo-fatura.png" width="220" height="70"  /></td>
            <td width="62%" style="text-align:left; padding-left:10px;"><?=STORE_NAME_ADDRESS?></td>
          </tr>
        </table>
        <!--CABEÇALHO LOGOMARCA -->
    </td>
  </tr>
  <tr>
    <td style="font-family:Arial; font-size:12px; font-weight:bold; text-align:center; padding-top:10px;">CONFIRMAÇÃO DE PEDIDO</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="border-top:1px solid #333; border-bottom:1px solid #333; padding-bottom:5px; padding-top:5px;">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="15%" class="campo"><b>Cliente:</b></td>
            <td width="23%" class="texto"><?=$order->customer['name']?></td>
            <td width="2%">&nbsp;</td>
            <td width="10%" class="campo"><b>Endereço:</b></td>
            <td width="50%" class="texto"><?=$order->delivery['street_address']?></td>
          </tr>
          <tr>
            <td class="campo"><b>Email:</b></td>
            <td class="texto"><?=$order->customer['email_address']?></td>
            <td>&nbsp;</td>
            <td class="campo"><b>Bairro:</b></td>
            <td class="texto"><?=$order->delivery['suburb']?></td>
          </tr>
          <tr>
            <td class="campo"><b>Tel. Comercial:</b></td>
            <td class="texto"><?=$order->customer['telephone']?></td>
            <td>&nbsp;</td>
            <td class="campo"><b>Cidade/UF:</b></td>
            <td class="texto"><?=$order->delivery['city']?>/<?=$order->delivery['state']?></td>
          </tr>
          <tr>
            <td class="campo"><b>Celular:</b></td>
            <td class="texto"><?=$order->customer['telephone_celular']?></td>
            <td>&nbsp;</td>
            <td class="campo"><b>CEP:</b></td>
            <td class="texto"><?=$order->delivery['postcode']?></td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td class="texto" style="border-bottom:1px solid #333; padding-bottom:5px; padding-top:5px;"><b>Condição de pagamento:</b> <?php echo $order->info['payment_method']; ?></td>
  </tr>
  <? if ($num_rows > 0){?>
   <tr>
    <td class="texto" style="border-bottom:1px solid #333; padding-bottom:5px; padding-top:5px;"><b>Observação:</b><br /> 
    <?
	  for($cont = 0; $cont < $num_rows; $cont++){
	  	echo $orders_obs['comments'].'<br/>';
		$orders_obs = tep_db_fetch_array($orders_query);
	  }
	?>
    </td>
  </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    
    	 <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="dataTableHeadingRow">
        <td class="dataTableHeadingContent">Qtde.</td>
        <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>

        <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>

      </tr>
<?php
    for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
      echo '      <tr class="dataTableRow">' . "\n" .
           '        <td class="dataTableContent" valign="top" align="right">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
           '        <td class="dataTableContent" valign="top">' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (($k = sizeof($order->products[$i]['attributes'])) > 0)) {
        for ($j = 0; $j < $k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          echo '</i></small></nobr>';
        }
      }

      echo '        </td>' . "\n".
	  '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n";
      echo '      </tr>' . "\n";
    }
?>
      <tr>
        <td align="right" colspan="8"><table border="0" cellspacing="0" cellpadding="2">
<?php
  for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
    echo '          <tr>' . "\n" .
         '            <td align="right" class="smallText">' . $order->totals[$i]['title'] . '</td>' . "\n" .
         '            <td align="right" class="smallText">' . $order->totals[$i]['text'] . '</td>' . "\n" .
         '          </tr>' . "\n";
  }
?>
        </table></td>
      </tr>
    </table>
        
    </td>
  </tr>
</table>
</div>

<br /><br />
<input type="button" onclick="ClickHereToPrint();" value="Imprimir Fatura" />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
