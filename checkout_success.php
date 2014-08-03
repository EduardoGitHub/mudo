<?php
/*
  $Id: checkout_success.php,v 1.49 2003/06/09 23:03:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the shopping cart page
  if (!tep_session_is_registered('customer_id')) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'update')) {
    $notify_string = 'action=notify&';
    $notify = $_POST['notify'];
    if (!is_array($notify)) $notify = array($notify);
    for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
      $notify_string .= 'notify[]=' . $notify[$i] . '&';
    }
    if (strlen($notify_string) > 0) $notify_string = substr($notify_string, 0, -1);

    tep_redirect(tep_href_link(FILENAME_DEFAULT, $notify_string));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);

  $breadcrumb->add(NAVBAR_TITLE_1);
  $breadcrumb->add(NAVBAR_TITLE_2);

  $global_query = tep_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
  $global = tep_db_fetch_array($global_query);

  if ($global['global_product_notifications'] != '1') {
    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
    $orders = tep_db_fetch_array($orders_query);

    $products_array = array();
    $products_query = tep_db_query("select products_id, products_name from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$orders['orders_id'] . "' order by products_name");
    while ($products = tep_db_fetch_array($products_query)) {
      $products_array[] = array('id' => $products['products_id'],
                                'text' => $products['products_name']);
    }
  }
  
  require(DIR_WS_CLASSES . 'order.php');
  $order = new order($orders['orders_id']);
  
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
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>"/>
<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
<style>
.btnboleto{background-image:url(images/button_bolet.jpg); width:153px;height:25px; border:0px; cursor:pointer;}
.btnpagseguro{background-image:url(images/button-pagseguro.jpg); width:201px; height:25px; border:0px; cursor:pointer;}
</style>
<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6008589998054';
fb_param.value = '0.00';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6008589998054&amp;value=0" /></noscript>

</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="mainContent" style="width:100%; margin:0; padding:10px 0 0 0;">
<!-- body //-->
<table border="0" width="99%" cellspacing="0" cellpadding="0" align="center">
   <!--<tr>
            <td><div class="tituloCompra"><span><?php echo HEADING_TITLE; ?></span></div></td>
          </tr> -->
  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
      
      <tr>
      	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" height="30">
                <tr>
                    <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_DELIVERY; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
            <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
                </tr>
			</table>

        </td>
      </tr>
      
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
              </tr>
            </table></td>
          </tr>

        </table></td>
      </tr>
        
  	  <tr>
    	<td width="100%" valign="top">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><?php //echo tep_image(DIR_WS_IMAGES . 'table_background_man_on_board.gif', HEADING_TITLE); ?></td>
            <td valign="top">
            
            <div style=" background-color:#F2F8DE; color:#000; font-size:18px; text-transform:uppercase; text-decoration:none; padding:10px; line-height:18px ">
					<div style="width:800px; margin:0 auto;">
                        <div style="float:left; width:75px"><img src="images/icon_success.png"  /></div>
                        <div style="float:left; margin-left:5px; margin-top:0px; width:700px;">
                        <?php echo HEADING_TITLE; ?> <?php echo TEXT_THANKS_FOR_SHOPPING; ?><br /><span style="font-size:12px; font-family:Arial; color:#000; font-weight:normal; text-transform:none">Em alguns minutos você deverá receber um e-mail da nossa loja com as informações de sua compra, caso isso não ocorra pedimos que entre em contato através do e-mail <a href="mailto:atendimento@mudominhacasa.com.br" style="color:#000; font-weight:bold; text-decoration:underline;;">atendimento@mudominhacasa.com.br</a>. <br />Para maiores informações sobre sua compra <a href="<?php echo tep_href_link('contact_us.php')?>" style="color:#000; font-weight:bold; text-decoration:underline;;" target="_blank">clique aqui</a>.</span>
                        </div>
                        
                    </div>
                    <div style="clear:both"></div>
             </div>
             
             <div style="background-color:#F2F8DE; text-align:center;">
             	<? 
					//PEGA VALOR SEM R$
					$string = $order->info['total'];
					$valor_boleto = substr($string, 2);
					
					$get_frete = tep_db_query("select value from ".TABLE_ORDERS_TOTAL." where class ='ot_shipping' and orders_id ='" . $orders['orders_id'] . "'");
				  	$data_frete = tep_db_fetch_array($get_frete);
					
					if (($order->info['orders_status'] == 'Pendente' or $order->info['orders_status'] == 'Processando') and $order->info['payment_method'] == '<div style="float:left; margin:10px 5px 0 0">Boleto Bancário Banco do Brasil</div><div style="float:left"><img src="images/formas-de-pagamento-boleto.png" /></div><div style="clear:left"></div>') 
						{ 
						echo '<br /><span style="font-family:Tahoma; font-size:12px;color:#FF0000;padding-bottom:5px;">Caso não tenha sido gerado seu boleto automaticamente clique no botão abaixo para imprimir o boleto.</span><br /><br />';
						?>
							<form action="<?php echo MODULE_PAYMENT_BOLETOBRASIL_URL;?>" method="post" name="boleto" target="_blank"> 
							<input type="hidden" id="order_id" name="order_id" value="<?php echo $orders['orders_id']; ?>"> 
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
							}else if (($order->info['orders_status'] == 'Pendente' or $order->info['orders_status'] == 'Processando') and $order->info['payment_method'] == 'Boleto Bancário Banco do Itaú') {
								echo '<br /><span style="font-family:Tahoma; font-size:12px;color:#FF0000;padding-bottom:5px;">Caso não tenha sido gerado seu boleto automaticamente clique no botão abaixo para imprimir o boleto.</span><br /><br />';
						  ?>
								<form name="boleto" action="<?php echo MODULE_PAYMENT_BOLETOITAU_URL;?>" method="post" target="_blank">   
								<input type="hidden" id="order_id" name="order_id" value="<?php echo $orders['orders_id']; ?>"> 
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
						  <? }else if (($order->info['orders_status'] == 'Pendente' or $order->info['orders_status'] == 'Processando') and $order->info['payment_method'] == 'Boleto Bancário Banco do Bradesc') {
							  echo '<br /><span style="font-family:Verdana; font-size:16px;color:#000;padding-bottom:5px;">Caso não tenha sido gerado seu boleto automaticamente clique no botão abaixo para imprimir o boleto.</span><br /><br />';
						  ?>
							<form name="boleto" action= "<?php echo MODULE_PAYMENT_BOLETOBRADESCO_URL; ?>" method="post" target="_blank">   
							<input type="hidden" name="order_id" value= "<?php echo $orders['orders_id']; ?>">
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
						  }else if (($order->info['orders_status'] == 'Pendente' or $order->info['orders_status'] == 'Processando') and $order->info['payment_method'] == '<div style="float:left; margin:10px 5px 0 0">PagSeguro - pagamentos</div><div style="float:left"><img src="images/formas de pagamento_pagseguro.png" /></div><div style="clear:left"></div>') {
							  echo '<br /><span style="font-family:Tahoma; font-size:12px;color:#FF0000;padding-bottom:5px;">Se você não foi redirecionado para o ambiente do <b>PagSeguro</b> clique no botão abaixo para efetuar o pagamento</span><br /><br />';

							$desconto = mysql_fetch_array(tep_db_query("select value from ".TABLE_ORDERS_TOTAL." where class ='ot_discount_coupon' and orders_id ='" . $orders['orders_id'] . "'"));
						  ?>
							<form name="pagseguro" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post" target="_blank">
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
							<input type="hidden" name="cliente_uf" value="<?php echo $order->customer['state']; ?>">
							<input type="hidden" name="cliente_pais" value="BRA">
							<input type="hidden" name="cliente_ddd" value="<?php echo substr($order->customer['telephone'],0,2) ?>">
							<input type="hidden" name="cliente_tel" value="<?php echo substr($order->customer['telephone'],2)?>">
							<input type="hidden" name="cliente_email" value="<?php echo $order->customer['email_address']; ?>">
							<? for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
								<input type="hidden" name="item_id_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['id'];?>">
								<input type="hidden" name="item_descr_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['name'].(strlen($order->products[$i]['model'])>0?'['.$order->products[$i]['model'].']':'');?>">
								<input type="hidden" name="item_quant_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['qty'];?>">
								<input type="hidden" name="item_valor_<?php echo ($i+1);?>" value="<?php echo round($order->products[$i]['final_price'], 2)*100;?>">
							<? }?>
                            
                            <? if($desconto['value'] != ''){?>
                            <input type="hidden" name="extras" value="<?php echo $desconto['value']*100;?>">
                            <? }?>
							<input type="hidden" name="item_frete_1" value="<?php echo substr(str_replace('.','',$data_frete['value']) ,0,4);?>">
							<input type="hidden" name="ref_transacao" value="Pedido: <?php echo $orders['orders_id']; ?> - Cliente: <?php echo  session_is_registered('customer_id') ; ?>">
							<input type="submit" value="" class="btnpagseguro">
							</form>
				
						<?php }else if (($order->info['orders_status'] == 'Pendente' or $order->info['orders_status'] == 'Processando') and $order->info['payment_method'] == 'Pagamento Digital'){
								echo '<br /><span style="font-family:Tahoma; font-size:12px;color:#FF0000;padding-bottom:5px;">Se você não foi redirecionado para o ambiente do <b>Pagamento Digital</b> clique no botão abaixo para efetuar o pagamento</span><br /><br />';
						  
						?>
                        
                             <form name="checkout_confirmation" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post" target="_blank">
                             	<input type="hidden" name="email_loja" value="<?=MODULE_PAYMENT_PD_EMAIL_LOJA?>" />
                                <input type="hidden" name="id_pedido" value="<?php echo $orders['orders_id']; ?>"/>
                                <input type="hidden" name="tipo_integracao" value="<?=MODULE_PAYMENT_PD_TIPO_INTEGRACAO?>" />
                                <input type="hidden" name="frete" value="<?php echo substr(str_replace('.','',$data_frete['value']) ,0,4);?>" />
                                <input type="hidden" name="tipo_frete" value="<?=$data_frete['title']?>" />
                                <input type="hidden" name="email" value="<?php echo $order->customer['email_address']; ?>" />
                                <input type="hidden" name="nome" value="<?php echo  $order->customer['name'] ; ?>" />
                                <input type="hidden" name="cpf" value="<?php echo  $order->customer['cpf'] ; ?>" />
                                <input type="hidden" name="telefone" value="<?php echo substr($order->customer['telephone'],2)?>" />
                                <input type="hidden" name="endereco" value="<?php echo $order->customer['street_address']; ?> - <?php echo $order->customer['suburb']?>" />
                                <input type="hidden" name="cidade" value="<?php echo $order->customer['city']; ?>" />
                                <input type="hidden" name="estado" value="<?php echo $order->customer['state']; ?>" />
                                <input type="hidden" name="cep" value="<?php echo $order->customer['postcode']; ?>" />
                                 <? if($desconto['value'] != ''){?>
                                    <input type="hidden" name="free" value="<?php echo $desconto['value']*100;?>">
                                 <? }?>
                                <input type="hidden" name="url_retorno" value="<?=MODULE_PAYMENT_PD_URL_RETORNO?>" />
                                <input type="hidden" name="vencimento" value="<?=MODULE_PAYMENT_PD_DIAS_VENCIMENTO_BOLETO?>" />
                                <? for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
								<input type="hidden" name="produto_codigo_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['id'];?>">
								<input type="hidden" name="produto_descricao_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['name'].(strlen($order->products[$i]['model'])>0?'['.$order->products[$i]['model'].']':'');?>">
								<input type="hidden" name="produto_qtde_<?php echo ($i+1);?>" value="<?php echo $order->products[$i]['qty'];?>">
								<input type="hidden" name="produto_valor_<?php echo ($i+1);?>" value="<?php echo round($order->products[$i]['final_price'], 2)*100;?>">
								<? }?>
                                <input type="image" src="includes/languages/portugues/images/buttons/button_pd.jpg" alt="Confirmar Pedido" title=" Confirmar Pedido " id="botao_processar" />
                            </form>

                        <? }?>
             </div>
             
             <div style="width:468px; margin:10px auto;">
				<?php if(EBIT_COD != ''){?>
                <form name="formebit" method="get" target="_blank" action="https://www.ebitempresa.com.br/bitrate/pesquisa1.asp">
                    <input type="hidden" name="empresa" value="<?=EBIT_COD?>" />    
                    <input type="image" border="0" name="banner" src="https://www.ebitempresa.com.br/bitrate/banners/b151995.gif" alt="O que voc&ecirc; achou desta loja?" width="468" height="60" /> 
                </form>
                <?php }?>
        	</div>
             
             <br/><br/>
            <?php echo tep_draw_form('order', tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL'));
              if ($global['global_product_notifications'] != '1') {
                echo TEXT_NOTIFY_PRODUCTS . '<br><p class="productsNotifications">';
            
                $products_displayed = array();
                for ($i=0, $n=sizeof($products_array); $i<$n; $i++) {
                  if (!in_array($products_array[$i]['id'], $products_displayed)) {
                    echo tep_draw_checkbox_field('notify[]', $products_array[$i]['id']) . ' ' . $products_array[$i]['text'] . '<br>';
                    $products_displayed[] = $products_array[$i]['id'];
                  }
                }
            
                echo '</p>';
              } else {
                echo TEXT_SEE_ORDERS . '<br><br>' . TEXT_CONTACT_STORE_OWNER;
              }
             echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?>
            </form>
            </td>
          </tr>
        </table></td>
      </tr>
<?php //if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php'); ?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<!-- Google Code for 2 Clicks - Vendas Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1055985706;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "OtRICMyztwUQqqDE9wM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1055985706/?value=0&amp;label=OtRICMyztwUQqqDE9wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-10692384-1']);
_gaq.push(['_trackPageview']);
// transaction details
_gaq.push(['_addTrans',
	'<?=$orders['orders_id']?>',
	'Mudo Minha Casa',
	'<?=$valor_boleto?>',
	'0.00',
	'<?=substr($data_frete['value'] ,0,5);?>',
	'<?=$order->customer['city']; ?>',
	'<?=$order->customer['state']; ?>',
	'BRA'
]);

<? for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
_gaq.push(['_addItem',
	'<?=$orders['orders_id']?>',
	'<?=$order->products[$i]['id'];?>',
	'<?=$order->products[$i]['name']?>',
	'<?=$order->products[$i]['model']?>',
	'<?=$order->products[$i]['final_price'];?>',
	'<?=$order->products[$i]['qty']?>'
]);
<? }?>

// track transaction
_gaq.push(['_trackTrans']);
// load Analytics
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>

</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
