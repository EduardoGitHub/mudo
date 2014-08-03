<?php
/*
  $Id: account_history_info.php,v 1.100 2003/06/09 23:03:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }
  
  $customer_info_query = tep_db_query("select customers_id from " . TABLE_ORDERS . " where orders_id = '". (int)$_GET['order_id'] . "'");
  $customer_info = tep_db_fetch_array($customer_info_query);
  if ($customer_info['customers_id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_HISTORY_INFO);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  $breadcrumb->add(sprintf(NAVBAR_TITLE_3, $_GET['order_id']), tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $_GET['order_id'], 'SSL'));

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order($_GET['order_id']);
  
  
  //require(DIR_WS_CLASSES . 'payment.php');
  //$payment_modules = new payment($payment);
  
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
<style type="text/css">
.btnboleto{background-image:url(images/botao2via.jpg); width:205px;height:25px; border:0px; cursor:pointer;}
.btnpagseguro{background-image:url(images/botao2via2.jpg); width:165px; height:25px; border:0px; cursor:pointer;}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  
  <div id="mainContent" style="margin:0px;">
  
  	<div class="tituloCompra"><?php echo HEADING_TITLE; ?></div>
  
		<table border="0" width="99%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td><b><?php echo sprintf(HEADING_ORDER_NUMBER, $_GET['order_id']) . ' <small>(' . $order->info['orders_status'] . ')</small>'; ?></b> </td>
					<td align="right">
						<? 
					//PEGA VALOR SEM R$
					$string = $order->info['total'];
					$valor_boleto = substr($string, 2); 
					if (($order->info['orders_status'] != 'Entregue' or $order->info['orders_status'] != 'Enviado') and $order->info['payment_method'] == '<div style="float:left; margin:10px 5px 0 0">Boleto Bancário Banco do Brasil</div><div style="float:left"><img src="images/formas-de-pagamento-boleto.png" /></div><div style="clear:left"></div>') 
						{ 
						?>
							<form action="<?php echo MODULE_PAYMENT_BOLETOBRASIL_URL;?>" method="post" name="boleto" target="_blank"> 
							<input type="hidden" id="order_id" name="order_id" value="<?php echo $_GET['order_id']; ?>"> 
							<input type="hidden" name="local_pagamento" id="local_pagamento" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_LOCALPAGAMENTO  ?>">
							<input type="hidden" name="agencia" id="agencia" value= "<?php echo MODULE_PAYMENT_BOLETOBRASIL_AGENCIA  ?>">
							<input type="hidden" name="conta" id="conta" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_CONTA  ?>">
							<input type="hidden" name="convenio" id="convenio" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_CONVENIO  ?>">
							<input type="hidden" name="contrato" id="contrato" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_CONTRATO  ?>">
							<input type="hidden" name="formatacao_nosso_numero" id="formatacao_nosso_numero" value= "<? echo MODULE_PAYMENT_BOLETOBRASIL_NNUMERO ?>">
							<input type="hidden" name="nosso_numero" id="nosso_numero" value= "<? echo $order->info['nosso_numero']; ?>">
							<input type="hidden" name="carteira" id="carteira" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_CARTEIRA  ?>">
							<input type="hidden" name="cpf_cnpj" id="cpf_cnpj" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_CNPJ  ?>">
							<input type="hidden" name="endereco" id="endereco" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_ENDERECO  ?>">
							<input type="hidden" name="cidade" id="cidade" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_CIDADE ?>">
							<input type="hidden" name="cedente" id="cedente" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_CEDENTE ?>">
							<input type="hidden" name="demonstrativo" id="demostrativo" value= "<?php echo MODULE_PAYMENT_BOLETOBRASIL_DEMONSTRATIVO  ?>">
							<input type="hidden" name="instrucoes" id="instrucoes" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES  ?>">
							<input type="hidden" name="instrucoes1" id="instrucoes1" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES1  ?>">
							<input type="hidden" name="instrucoes2" id="instrucoes2" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES2  ?>">
							<input type="hidden" name="instrucoes3" id="instrucoes3" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES3  ?>">
							<input type="hidden" name="instrucoes4" id="instrucoes4" value= "<?php  echo MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES4  ?>">
							<input type="hidden" name="data_vencimento" id="data_vencimento" value= "<?php echo  date("d/m/Y", time()+60*60*24*MODULE_PAYMENT_BOLETOBRASIL_PRAZOVENCIMENTO); ?>">
							<input type="hidden" name="valor_boleto" id="valor_boleto" value= "<?php  echo $valor_boleto;  ?>">
							<input type="hidden" name="sacado_id" id="sacado_id" value= "<?php echo session_is_registered('customer_id')  ?>">
							<input type="hidden" id="endereco_sacado" name="endereco_sacado" value="<?php echo $order->customer['street_address'] . " - " . $order->customer['suburb'] . " / " . $order->customer['city'] . "-" . $order->customer['state'] . " / " .$order->customer['postcode']; ?>"> 
							<input type="hidden" id="sacado" name="sacado" value="<?php echo $order->customer['name']; ?>"> 
							<input type="submit" class="btnboleto" value="">
							</form>
						<?php 
							}else if (($order->info['orders_status'] != 'Entregue' or $order->info['orders_status'] != 'Enviado') and $order->info['payment_method'] == 'Boleto Bancário Banco do Itaú') {
						  ?>
								<form name="boleto" action="<?php echo MODULE_PAYMENT_BOLETOITAU_URL;?>" method="post" target="_blank">   
								<input type="hidden" id="order_id" name="order_id" value="<?php echo $_GET['order_id']; ?>"> 
								<input type="hidden" name="local_pagamento" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_LOCALPAGAMENTO; ?>">
								<input type="hidden" name="agencia" value= "<?php echo MODULE_PAYMENT_BOLETOITAU_AGENCIA;  ?>">
								<input type="hidden" name="conta" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_CONTA;  ?>">
								<input type="hidden" name="contadv" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_CONTADV;  ?>">
								<input type="hidden" name="nosso_numero" value= "<? echo $order->info['nosso_numero']; ?>">
								<input type="hidden" name="carteira" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_CARTEIRA;  ?>">
								<input type="hidden" name="cpf_cnpj" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_CNPJ;  ?>">
								<input type="hidden" name="endereco" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_ENDERECO;  ?>">
								<input type="hidden" name="cidade" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_CIDADE; ?>">
								<input type="hidden" name="cedente" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_CEDENTE; ?>">
								<input type="hidden" name="demonstrativo" value= "<?php echo MODULE_PAYMENT_BOLETOITAU_DEMONSTRATIVO;  ?>">
								<input type="hidden" name="instrucoes" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_INSTRUCOES;  ?>">
								<input type="hidden" name="instrucoes1" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_INSTRUCOES1;  ?>">
								<input type="hidden" name="instrucoes2" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_INSTRUCOES2;  ?>">
								<input type="hidden" name="instrucoes3" value= "<?php  echo MODULE_PAYMENT_BOLETOITAU_INSTRUCOES3;  ?>">
								<input type="hidden" name="data_vencimento" value= "<?php echo MODULE_PAYMENT_BOLETOBRASIL_PRAZOVENCIMENTO;?>">
								<input type="hidden" name="valor_boleto" value= "<?php  echo $valor_boleto; ?>">
								<input type="hidden" name="sacado_id" value= "<?php echo session_is_registered('customer_id');  ?>">
								<input type="hidden" name="sacado" value= "<?php echo $order->customer['name']; ?>">
								<input type="hidden" name="endereco_sacado" value= "<?php echo $order->customer['street_address'] . " - " . $order->customer['suburb'] . " / " . $order->customer['city'] . "-" . $order->customer['state'] . " / " .$order->customer['postcode']; ?>">
								<input type="submit" class="btnboleto" value="">
								</form>
						  <? }else if (($order->info['orders_status'] != 'Entregue' or $order->info['orders_status'] != 'Enviado') and $order->info['payment_method'] == 'Boleto Bancário Banco do Bradesco') {
						  ?>
							<form name="boleto" action= "<?php echo MODULE_PAYMENT_BOLETOBRADESCO_URL; ?>" method="post" target=_blank>   
							<input type="hidden" name="order_id" value= "<?php echo $_GET['order_id']; ?>">
							<input type="hidden" name="local_pagamento" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_LOCALPAGAMENTO ; ?>">
							<input type="hidden" name="agencia" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_AGENCIA ; ?>">
							<input type="hidden" name="agenciadv" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_AGENCIADV ; ?>">
							<input type="hidden" name="conta" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_CONTA ; ?>">
							<input type="hidden" name="contadv" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_CONTADV ; ?>">
							<input type="hidden" name="nosso_numero" value= "<? echo $order->info['nosso_numero']; ?>">
							<input type="hidden" name="carteira" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_CARTEIRA ; ?>">
							<input type="hidden" name="cpf_cnpj" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_CNPJ ; ?>">
							<input type="hidden" name="endereco" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_ENDERECO ; ?>">
							<input type="hidden" name="cidade" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_CIDADE ; ?>">
							<input type="hidden" name="cedente" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_CEDENTE ; ?>">
							<input type="hidden" name="demonstrativo" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_DEMONSTRATIVO ; ?>">
							<input type="hidden" name="instrucoes" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES ; ?>">
							<input type="hidden" name="instrucoes1" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES1 ; ?>">
							<input type="hidden" name="instrucoes2" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES2 ; ?>">
							<input type="hidden" name="instrucoes3" value= "<?php echo  MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES3 ; ?>">
							<input type="hidden" name="data_vencimento" value= "<?php echo MODULE_PAYMENT_BOLETOBRADESCO_PRAZOVENCIMENTO ; ?>">
							<input type="hidden" name="valor_boleto" value= "<?php  echo $valor_boleto; ?>">
							<input type="hidden" name="sacado_id" value= "<?php echo  session_is_registered('customer_id') ; ?>">
							<input type="hidden" name="sacado" value= "<?php echo  $order->customer['firstname'] . ' ' . $order->customer['lastname'] ; ?>">
							<input type="hidden" name="endereco_sacado" value= "<?php echo  $order->customer['street_address'] . " - " . $order->customer['suburb'] . " / " . $order->customer['city'] . "-" . $order->customer['state'] . " / " .$order->customer['postcode'] ; ?>">
							<input type="submit" class="btnboleto" value="">
							</form>
						  <?
						  }else if (($order->info['orders_status'] != 'Entregue' or $order->info['orders_status'] != 'Enviado') and $order->info['payment_method'] == '<div style="float:left; margin:10px 5px 0 0">PagSeguro - pagamentos</div><div style="float:left"><img src="images/formas de pagamento_pagseguro.png" /></div><div style="clear:left"></div>') {
						  
						  $get_frete = tep_db_query("select value from ".TABLE_ORDERS_TOTAL." where class ='ot_shipping' and orders_id ='" . $_GET['order_id'] . "'");
				  		  $data_frete = tep_db_fetch_array($get_frete);
						 
						  $desconto = mysql_fetch_array(tep_db_query("select value from ".TABLE_ORDERS_TOTAL." where class ='ot_discount_coupon' and orders_id ='" . $_GET['order_id'] . "'"));						  
						  ?>
							<form name="pagseguro" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post" target=_blank>
							<input type="hidden" name="email_cobranca" value="<?php echo MODULE_PAYMENT_PAGSEGURO_EMAIL ?>">
							<input type="hidden" name="tipo" value="CP">
							<input type="hidden" name="moeda" value="BRL">
							<input type="hidden" name="cliente_nome" value="<?php echo  $order->customer['name'] ; ?>">
							<input type="hidden" name="cliente_cep" value="<?php echo $order->customer['postcode']; ?>">
							<input type="hidden" name="cliente_end" value="<?php echo $order->customer['street_address']; ?>">
							<input type="hidden" name="cliente_bairro" value="<?php echo $order->customer['suburb']?>">
							<input type="hidden" name="cliente_cidade" value="<?php echo $order->customer['city']; ?>">
							<input type="hidden" name="cliente_num" value="<?php echo $order->customer['street_number']; ?>">
							<input type="hidden" name="cliente_compl" value="<?php echo $order->customer['complemento']; ?>">
							<input type="hidden" name="cliente_uf" value="MG">
							<input type="hidden" name="cliente_pais" value="BRA">
							<input type="hidden" name="cliente_ddd" value="<?php echo substr($order->customer['telephone'],0,2) ?>">
							<input type="hidden" name="cliente_tel" value="<?php echo substr($order->customer['telephone'],2)?>">
							<input type="hidden" name="cliente_email" value="<?php echo $order->customer['email_address']; ?>">
							<? for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
                            
								<input type="hidden" name="item_id_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['id'];?>">
								<input type="hidden" name="item_descr_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['name'].(strlen($order->products[$i]['model'])>0?'['.$order->products[$i]['model'].']':'');?>">
								<input type="hidden" name="item_quant_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['qty'];?>">
								<input type="hidden" name="item_valor_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['final_price']*100;?>">
							<? }?>
                            
                            <? if($desconto['value'] != ''){?>
                            	<input type="hidden" name="extras" value="<?php echo $desconto['value']*100;?>">
                            <? }?>
                            
							<input type="hidden" name="item_frete_1" value="<?php echo substr(str_replace('.','',$data_frete['value']) ,0,4);?>">
							<input type="hidden" name="ref_transacao" value="Pedido: <?php echo $_GET['order_id']; ?> - Cliente: <?php echo  session_is_registered('customer_id') ; ?>">
							<input type="submit" value="" class="btnpagseguro">
							</form>
				
			<?php }?>			  
						  
			  		</td>
				  </tr>
				</table>
			</td>
          </tr>
          <tr>
            <td class="smallText"><?php 
			$today = getdate(strtotime($order->info['date_purchased']));
			$cadastrado_dia = diaDaSemana($today["weekday"]).' '.$today["mday"].' '.mesReferente($today["month"]).' de '.$today["year"];
			echo HEADING_ORDER_DATE . ' ' . $cadastrado_dia; ?></td>
            <td class="smallText" align="right"><?php echo HEADING_ORDER_TOTAL . ' ' . $order->info['total']; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
<?php
  if ($order->delivery != false) {
?>
            <td width="30%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo HEADING_DELIVERY_ADDRESS; ?></b></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>'); ?></td>
              </tr>
<?php
    if (tep_not_null($order->info['shipping_method'])) {
?>
              <tr>
                <td class="main"><b><?php echo HEADING_SHIPPING_METHOD; ?></b></td>
              </tr>
              <tr>
                <td class="main"><?php echo $order->info['shipping_method']; ?></td>
              </tr>
<?php
    }
?>
            </table></td>
<?php
  }
?>
            <td width="<?php echo (($order->delivery != false) ? '70%' : '100%'); ?>" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
                  <tr>
                    <td class="main" colspan="2"><b><?php echo HEADING_PRODUCTS; ?></b></td>
                    <td class="smallText" align="right"><b><?php echo HEADING_TAX; ?></b></td>
                    <td class="smallText" align="right"><b><?php echo HEADING_TOTAL; ?></b></td>
                  </tr>
<?php
  } else {
?>
                  <tr>
                    <td class="main" colspan="3"><b><?php echo HEADING_PRODUCTS; ?></b></td>
                  </tr>
<?php
  }

  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    echo '          <tr>' . "\n" .
         '            <td class="main" align="right" valign="top" width="30">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
         '            <td class="main" valign="top">' . $order->products[$i]['name'];

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></small></nobr>';
      }
    }

    echo '</td>' . "\n";

    if (sizeof($order->info['tax_groups']) > 1) {
      echo '            <td class="main" valign="top" align="right">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n";
    }

    echo '            <td class="main" align="right" valign="top">' . $currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</td>' . "\n" .
         '          </tr>' . "\n";
  }
?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo HEADING_BILLING_INFORMATION; ?></b></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td width="30%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo HEADING_BILLING_ADDRESS; ?></b></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>'); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo HEADING_PAYMENT_METHOD; ?></b></td>
              </tr>
              <tr>
                <td class="main"><?php echo $order->info['payment_method']; ?></td>
              </tr>
            </table></td>
            <td width="70%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
    echo '              <tr>' . "\n" .
         '                <td class="main" align="right" width="100%">' . $order->totals[$i]['title'] . '</td>' . "\n" .
         '                <td class="main" align="right">' . $order->totals[$i]['text'] . '</td>' . "\n" .
         '              </tr>' . "\n";
  }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo HEADING_ORDER_HISTORY; ?></b></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $statuses_query = tep_db_query("select os.orders_status_name, osh.date_added, osh.comments from " . TABLE_ORDERS_STATUS . " os, " . TABLE_ORDERS_STATUS_HISTORY . " osh where osh.orders_id = '" . (int)$_GET['order_id'] . "' and osh.orders_status_id = os.orders_status_id and os.language_id = '" . (int)$languages_id . "' order by osh.date_added");
  while ($statuses = tep_db_fetch_array($statuses_query)) {
    echo '              <tr>' . "\n" .
         '                <td class="main" valign="top" width="70">' . tep_date_short($statuses['date_added']) . '</td>' . "\n" .
         '                <td class="main" valign="top" width="70">' . $statuses['orders_status_name'] . '</td>' . "\n" .
         '                <td class="main" valign="top">' . (empty($statuses['comments']) ? '&nbsp;' : nl2br(tep_output_string_protected($statuses['comments']))) . '</td>' . "\n" .
         '              </tr>' . "\n";
  }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php');
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  		
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, tep_get_all_get_params(array('order_id')), 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
		  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>