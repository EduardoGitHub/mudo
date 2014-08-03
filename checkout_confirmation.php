<?php
/*
  $Id: checkout_confirmation.php,v 1.139 2003/06/11 17:34:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }


// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $_SESSION['cartID']) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  if (!isset($_SESSION['payment'])) $_SESSION['payment'];
  if (isset($_POST['payment'])) $payment = $_SESSION['payment'] = $_POST['payment'];

  if (!isset($_SESSION['comments'])) $_SESSION['comments'];
  if (isset($_POST['comments'])) {
    $comments = $_SESSION['comments'] = tep_db_prepare_input($_POST['comments']);
  }

//kgt - discount coupons
  if (!isset($_SESSION['coupon'])) $_SESSION['coupon'];
  //this needs to be set before the order object is created, but we must process it after
  $coupon = $_SESSION['coupon'] = tep_db_prepare_input($_POST['coupon']);
  //end kgt - discount coupons


// load the selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($payment);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  $payment_modules->update_status();

  if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  }

  if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
  }
  
     //kgt - discount coupons
  if( tep_not_null( $coupon ) && is_object( $order->coupon ) ) { //if they have entered something in the coupon field
    $order->coupon->verify_code();
    if( MODULE_ORDER_TOTAL_DISCOUNT_COUPON_DEBUG != 'true' ) {
		  if( !$order->coupon->is_errors() ) { //if we have passed all tests (no error message), make sure we still meet free shipping requirements, if any
			  if( $order->coupon->is_recalc_shipping() ) tep_redirect( tep_href_link( FILENAME_CHECKOUT_SHIPPING, 'error_message=' . urlencode( ENTRY_DISCOUNT_COUPON_SHIPPING_CALC_ERROR ), 'SSL' ) ); //redirect to the shipping page to reselect the shipping method
		  } else {
			  if( isset($_SESSION['coupon']) ) tep_session_unregister('coupon'); //remove the coupon from the session
			  tep_redirect( tep_href_link( FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode( implode( ' ', $order->coupon->get_messages() ) ), 'SSL' ) ); //redirect to the payment page
		  }
    }
	} else { //if the coupon field is empty, unregister the coupon from the session
		if( isset($_SESSION['coupon'])) { //we had a coupon entered before, so we need to unregister it
      tep_session_unregister('coupon');
      //now check to see if we need to recalculate shipping:
      require_once( DIR_WS_CLASSES.'discount_coupon.php' );
      if( discount_coupon::is_recalc_shipping() ) tep_redirect( tep_href_link( FILENAME_CHECKOUT_SHIPPING, 'error_message=' . urlencode( ENTRY_DISCOUNT_COUPON_SHIPPING_CALC_ERROR ), 'SSL' ) ); //redirect to the shipping page to reselect the shipping method
    }
	}
	//end kgt - discount coupons
	

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($shipping);

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;

// Stock Check
  $any_out_of_stock = 0;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        $any_out_of_stock = 1;
      }
    }
    // Out of Stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == 1) ) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2);
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
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="mainContent" style="width:100%; margin:0; padding:10px 0 0 0;">
<!-- body //-->
<table border="0" width="99%" cellspacing="0" cellpadding="0" align="center">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top">
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
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
                    <td align="center" width="25%" class="checkoutBarFrom"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . CHECKOUT_BAR_DELIVERY . '</a>'; ?></td>
                    <td align="center" width="25%" class="checkoutBarFrom"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . CHECKOUT_BAR_PAYMENT . '</a>'; ?></td>
                    <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
                    <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
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
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
              </tr>
            </table></td>
          </tr>

        </table></td>
      </tr>
       <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
            <tr>
                <td class="main"><b>Suas compras</b></td>
              </tr>
      	  <tr>
          <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
        	<td>
            	<table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          			<tr class="infoBoxContents2">
						
                        <td width="<?php echo (($sendto != false) ? '70%' : '70%'); ?>" valign="top">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                              <tr>
                                <td>
                                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                        <?php if (sizeof($order->info['tax_groups']) > 1) { ?>
                                          <tr>
                                            <td class="main" colspan="2"><?php echo '<b>' . HEADING_PRODUCTS . '</b> <a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></td>
                                            <td class="smallText" align="right"><b><?php echo HEADING_TAX; ?></b></td>
                                            <td class="smallText" align="right"><b><?php echo HEADING_TOTAL; ?></b></td>
                                          </tr>
                                        <?php } else { ?>
                                          <tr>
                                            <td class="main" colspan="3"><?php echo '<b>' . HEADING_PRODUCTS . '</b> <a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></td>
                                          </tr>
                                            <?php
                                              }
                                              for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
                                                echo '          <tr>' . "\n" .
                                                     '            <td class="main" style="text-align:right" valign="top" width="30">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
                                                     '            <td class="main" valign="top">' . $order->products[$i]['name'].' '.$order->products[$i]['info_percent'];
                                            
                                                if (STOCK_CHECK == 'true') {
                                                  echo tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
                                                }
                                            
                                                if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
                                                  for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
                                                    echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></small></nobr>';
                                                  }
                                                }
                                            
                                                echo '</td>' . "\n";
                                            
                                                if (sizeof($order->info['tax_groups']) > 1) echo '            <td class="main" valign="top" style="text-align:right">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n";
                                            
                                                echo '            <td class="main" style="text-align:right" valign="top">' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . '</td>' . "\n" .
                                                     '          </tr>' . "\n";
                                              }
                                            ?>
                                    </table>
                                 </td>
                              </tr>
                            </table>
                        </td>
          			</tr>
                    <tr>
                    	<td style="border-top:1px dashed #666;">
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        	<?php
							  if (MODULE_ORDER_TOTAL_INSTALLED) {
								$order_total_modules->process();
								echo $order_total_modules->output();
							  }
							?>
                         </table>
                        </td>
                    </tr>
        		</table>
            </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main" width="49%"><b>Informações Gerais<?php //echo HEADING_BILLING_INFORMATION; ?></b></td>
                <td width="2%"></td>
                <td class="main" width="49%" height="30"  bgcolor="#4295D9" style="color:#FFF">&nbsp;&nbsp;&nbsp;<b><?php echo HEADING_PAYMENT_INFORMATION; ?></b></td>
              </tr>
            </table>
        </td>
      </tr>

  
      <tr>
        <td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="49%">
                	<table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2" height="200">
                      <tr class="infoBoxContents2">
                        <td width="100%" valign="top">
                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                              <tr>
                                <td class="main"><?php echo $order->info['payment_method'].'<b>' . HEADING_PAYMENT_METHOD . '</b>: <a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></td>
                              </tr>
                              <tr>
                                <td class="main"></td>
                              </tr>
                              <?php if ($sendto != false) { ?>
                              <tr>
                                <td class="main"><?php echo '<b>' . HEADING_DELIVERY_ADDRESS . '</b> <a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">:<span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></td>
                              </tr>
                              <?php  if ($order->info['shipping_method']) { ?>
                              <tr>
                                <td class="main"><?php echo '<b>' . HEADING_SHIPPING_METHOD . '</b> <a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">: '.$order->info['shipping_method'].' <span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></td>
                              </tr>
                              <?php } 
                              } ?>
                              <?php  if (tep_not_null($order->info['comments'])) { ?>
                              <tr>
                                <td class="main"><?php echo '<b>' . HEADING_ORDER_COMMENTS . '</b> <a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">: '. nl2br(tep_output_string_protected($order->info['comments'])) . tep_draw_hidden_field('comments', $order->info['comments']).' <span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></td>
                              </tr>
                             <?php } ?>
                            </table>
                        </td>
                      </tr>
                    </table>
                </td>
                <td width="2%"></td>
                <td width="49%">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
					 <?php
                      if (is_array($payment_modules->modules)) {
                        if ($confirmation = $payment_modules->confirmation()) {
                    ?>
                          <tr>
                            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2" height="200" style="border:2px #4295D9 dashed;">
                              <tr class="infoBoxContents2">
                                <td><table border="0" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td class="main" colspan="4"><?php echo $confirmation['title']; ?></td>
                                  </tr>
                                 <?php for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) { ?>
                                  <tr>
                                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                                    <td class="main"><?php echo $confirmation['fields'][$i]['title']; ?></td><!-- GERA O TEXTO -->
                                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                                    <td class="main"><?php echo $confirmation['fields'][$i]['field']; ?></td> <!-- GERA BOTÃO DO BOLETO -->
                                  </tr>
                                <?php  } ?>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                    <?php
                        }
                      }
                    ?>
                    </table>
                </td>
              </tr>
            </table>

            
         </td>
      </tr>
	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
        <td class="main">
		<?php if(($order->info['payment_method'] == 'PagSeguro - pagamentos')or($order->info['payment_method'] == 'Pagamento Digital')) {?>
		<script type="text/javascript">
		<!--
		var pop = window.open("about:blank","_blank","width=10,height=100,top=0,left=0");
		if (null == pop || true == pop.closed)
			{  
				document.writeln('<table width="100%" cellspacing="1" cellpadding="2" border="0" bgcolor="#FFFAF3" style="border:1px #000000 dashed;">');
				document.writeln('<tr>');
				document.writeln('<td style="font-family:Verdana; font-size:11px; color:#FF0000; padding:10px;">');
				document.writeln('<b>');
				document.writeln('&raquo;');
				document.writeln('<u>');
				document.writeln('ATENÇÃO');
				document.writeln('</u>');
				document.writeln('</b>');
				document.writeln('<br>');
				document.writeln('<br>');
				document.writeln('<span style="line-height:18px; color:#000000">');
				document.writeln('Favor desativar o anti pop-up para efetuar o pagamento. Após desativar o o pop-up clique no botão Confirmar Pedido e você será redirecionado para o site do pagseguro para efeturar sua comprar, caso isso não aconteça entre em contato com a administração do site ou clique no menu superior MINHA CONTA >> PEDIDOS ANTERIORES e clique em --> Gerar 2ª Via <<--. Para maior esclarecimento entre em contato com a administração do site.');
				document.writeln('</span>')
				document.writeln('</td>');
				document.writeln('</tr>');
				document.writeln('</table>');
			} else {  
				pop.close();
			}
		//-->	
		</script>
		<? }?>
		</td>
      </tr>
      
      
     
      

      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" class="main" style="text-align:right;">

<? echo '<a onclick="history.go(-1)" style="cursor:pointer;">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK,'id="botao_voltar"') . '</a>&nbsp;&nbsp;&nbsp;'; ?>

<!-- AQUI E MONTADO O FORMULARIO PARA SUBMETER PARA A PAGINA checkout_process.php -->
<?php
if(($order->info['payment_method'] == '<div style="float:left; margin:10px 5px 0 0">Boleto Bancário Banco do Brasil</div><div style="float:left"><img src="images/formas-de-pagamento-boleto.png" /></div><div style="clear:left"></div>')) {
echo '<form name="checkout_confirmation" id="checkout_confirmation" action="'.MODULE_PAYMENT_BOLETOBRASIL_URL.'" method="post" target="_blank" rel="nofollow" onsubmit="setTimeout(goOn, 1000);">   
<input type="hidden" name="order_id" value= "'. $n_pedido .'">
<input type="hidden" name="local_pagamento" value= "'. MODULE_PAYMENT_BOLETOBRASIL_LOCALPAGAMENTO .'">
<input type="hidden" name="agencia" value= "'. MODULE_PAYMENT_BOLETOBRASIL_AGENCIA .'">
<input type="hidden" name="conta" value= "'. MODULE_PAYMENT_BOLETOBRASIL_CONTA .'">
<input type="hidden" name="convenio" value= "'. MODULE_PAYMENT_BOLETOBRASIL_CONVENIO .'">
<input type="hidden" name="contrato" value= "'. MODULE_PAYMENT_BOLETOBRASIL_CONTRATO .'">
<input type="hidden" name="formatacao_nosso_numero" value= "'. MODULE_PAYMENT_BOLETOBRASIL_NNUMERO .'">
<input type="hidden" name="nosso_numero" value= "'. MODULE_PAYMENT_BOLETOBRASIL_FX_INICIAL .'">
<input type="hidden" name="carteira" value= "'. MODULE_PAYMENT_BOLETOBRASIL_CARTEIRA .'">
<input type="hidden" name="cpf_cnpj" value= "'. MODULE_PAYMENT_BOLETOBRASIL_CNPJ .'">
<input type="hidden" name="endereco" value= "'. MODULE_PAYMENT_BOLETOBRASIL_ENDERECO .'">
<input type="hidden" name="cidade" value= "'. MODULE_PAYMENT_BOLETOBRASIL_CIDADE .'">
<input type="hidden" name="cedente" value= "'. MODULE_PAYMENT_BOLETOBRASIL_CEDENTE .'">
<input type="hidden" name="demonstrativo" value= "'. MODULE_PAYMENT_BOLETOBRASIL_DEMONSTRATIVO .'">
<input type="hidden" name="instrucoes" value= "'. MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES .'">
<input type="hidden" name="instrucoes1" value= "'. MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES1 .'">
<input type="hidden" name="instrucoes2" value= "'. MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES2 .'">
<input type="hidden" name="instrucoes3" value= "'. MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES3 .'">
<input type="hidden" name="instrucoes4" value= "'. MODULE_PAYMENT_BOLETOBRASIL_INSTRUCOES4 .'">
<input type="hidden" name="data_vencimento" value= "'. date("d/m/Y", time()+60*60*24*MODULE_PAYMENT_BOLETOBRASIL_PRAZOVENCIMENTO) .'">
<input type="hidden" name="valor_boleto" value= "'. number_format($order->info['total'],2,",",".") .'">
<input type="hidden" name="sacado_id" value= "'. $_SESSION['customer_id'] .'">
<input type="hidden" name="sacado" value= "'. $order->customer['firstname'] . ' ' . $order->customer['lastname'] .'">
<input type="hidden" name="endereco_sacado" value= "'. $order->customer['street_address'] . " - " . $order->customer['suburb'] . " / " . $order->customer['city'] . "-" . $order->customer['state'] . " / " .$order->customer['postcode'] .'">
<input type="image" name="BGB" src="includes/languages/portugues/images/buttons/finalizar_gerar.gif" id="botao_processar">
</form>' . "\n";
}else if(($order->info['payment_method'] == 'Boleto Bancário Banco do Itaú')) {
echo '<form name="checkout_confirmation" id="checkout_confirmation" action="'.MODULE_PAYMENT_BOLETOITAU_URL.'" method="post" target="_blank" rel="nofollow" onsubmit="setTimeout(goOn, 1000);">   
<input type="hidden" name="order_id" value= "'. $n_pedido .'">
<input type="hidden" name="local_pagamento" value= "'. MODULE_PAYMENT_BOLETOITAU_LOCALPAGAMENTO .'">
<input type="hidden" name="agencia" value= "'. MODULE_PAYMENT_BOLETOITAU_AGENCIA .'">
<input type="hidden" name="conta" value= "'. MODULE_PAYMENT_BOLETOITAU_CONTA .'">
<input type="hidden" name="contadv" value= "'. MODULE_PAYMENT_BOLETOITAU_CONTADV .'">
<input type="hidden" name="nosso_numero" value= "'. MODULE_PAYMENT_BOLETOITAU_FX_INICIAL .'">
<input type="hidden" name="carteira" value= "'. MODULE_PAYMENT_BOLETOITAU_CARTEIRA .'">
<input type="hidden" name="cpf_cnpj" value= "'. MODULE_PAYMENT_BOLETOITAU_CNPJ .'">
<input type="hidden" name="endereco" value= "'. MODULE_PAYMENT_BOLETOITAU_ENDERECO .'">
<input type="hidden" name="cidade" value= "'. MODULE_PAYMENT_BOLETOITAU_CIDADE .'">
<input type="hidden" name="cedente" value= "'. MODULE_PAYMENT_BOLETOITAU_CEDENTE .'">
<input type="hidden" name="demonstrativo" value= "'. MODULE_PAYMENT_BOLETOITAU_DEMONSTRATIVO .'">
<input type="hidden" name="instrucoes" value= "'. MODULE_PAYMENT_BOLETOITAU_INSTRUCOES .'">
<input type="hidden" name="instrucoes1" value= "'. MODULE_PAYMENT_BOLETOITAU_INSTRUCOES1 .'">
<input type="hidden" name="instrucoes2" value= "'. MODULE_PAYMENT_BOLETOITAU_INSTRUCOES2 .'">
<input type="hidden" name="instrucoes3" value= "'. MODULE_PAYMENT_BOLETOITAU_INSTRUCOES3 .'">
<input type="hidden" name="data_vencimento" value= "'.MODULE_PAYMENT_BOLETOITAU_PRAZOVENCIMENTO .'">
<input type="hidden" name="valor_boleto" value= "'. $order->info['total'] .'">
<input type="hidden" name="sacado_id" value= "'. $_SESSION['customer_id'] .'">
<input type="hidden" name="sacado" value= "'. $order->customer['firstname'] . ' ' . $order->customer['lastname'] .'">
<input type="hidden" name="endereco_sacado" value= "'. $order->customer['street_address'] . " - " . $order->customer['suburb'] . " / " . $order->customer['city'] . "-" . $order->customer['state'] . " / " .$order->customer['postcode'] .'">
<input type="image" name="BGB" src="includes/languages/portugues/images/buttons/finalizar_gerar.gif" id="botao_processar">
</form>' . "\n";
}else if(($order->info['payment_method'] == 'Boleto Bancário Banco do Bradesco')) {
echo '<form name="checkout_confirmation" id="checkout_confirmation" action="'.MODULE_PAYMENT_BOLETOBRADESCO_URL.'" method="post" target="_blank" rel="nofollow" onsubmit="setTimeout(goOn, 1000);">   
<input type="hidden" name="order_id" value= "'. $n_pedido .'">
<input type="hidden" name="local_pagamento" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_LOCALPAGAMENTO .'">
<input type="hidden" name="agencia" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_AGENCIA .'">
<input type="hidden" name="agenciadv" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_AGENCIADV .'">
<input type="hidden" name="conta" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_CONTA .'">
<input type="hidden" name="contadv" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_CONTADV .'">
<input type="hidden" name="nosso_numero" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_FX_INICIAL .'">
<input type="hidden" name="carteira" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_CARTEIRA .'">
<input type="hidden" name="cpf_cnpj" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_CNPJ .'">
<input type="hidden" name="endereco" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_ENDERECO .'">
<input type="hidden" name="cidade" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_CIDADE .'">
<input type="hidden" name="cedente" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_CEDENTE .'">
<input type="hidden" name="demonstrativo" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_DEMONSTRATIVO .'">
<input type="hidden" name="instrucoes" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES .'">
<input type="hidden" name="instrucoes1" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES1 .'">
<input type="hidden" name="instrucoes2" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES2 .'">
<input type="hidden" name="instrucoes3" value= "'. MODULE_PAYMENT_BOLETOBRADESCO_INSTRUCOES3 .'">
<input type="hidden" name="data_vencimento" value= "'.MODULE_PAYMENT_BOLETOBRADESCO_PRAZOVENCIMENTO .'">
<input type="hidden" name="valor_boleto" value= "'. $order->info['total'] .'">
<input type="hidden" name="sacado_id" value= "'. $_SESSION['customer_id'] .'">
<input type="hidden" name="sacado" value= "'. $order->customer['firstname'] . ' ' . $order->customer['lastname'] .'">
<input type="hidden" name="endereco_sacado" value= "'. $order->customer['street_address'] . " - " . $order->customer['suburb'] . " / " . $order->customer['city'] . "-" . $order->customer['state'] . " / " .$order->customer['postcode'] .'">
<input type="image" name="BGB" src="includes/languages/portugues/images/buttons/finalizar_gerar.gif" id="botao_processar">
</form>' . "\n";
}else if(($order->info['payment_method'] == '<div style="float:left; margin:10px 5px 0 0">PagSeguro - pagamentos</div><div style="float:left"><img src="images/formas de pagamento_pagseguro.png" /></div><div style="clear:left"></div>')) {

	
	  if (isset($$payment->form_action_url)) {
		$form_action_url = $$payment->form_action_url;
	  } else {
		$form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
	}
	echo tep_draw_form('checkout_confirmation', $form_action_url, 'post', 'target="_blank" rel="nofollow" onsubmit="setTimeout(goOn, 1000);"');
	  if (is_array($payment_modules->modules)) {
		echo $payment_modules->process_button();
	  echo tep_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONFIRM_ORDER, 'id="botao_processar"') . '</form>' . "\n";
	}

}else if(($order->info['payment_method'] == 'Pagamento Digital')) {

	
	  if (isset($$payment->form_action_url)) {
		$form_action_url = $$payment->form_action_url;
	  } else {
		$form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
	}
	echo tep_draw_form('checkout_confirmation', $form_action_url, 'post', 'target="_blank" rel="nofollow" onsubmit="setTimeout(goOn, 1000);"');
	  if (is_array($payment_modules->modules)) {
		echo $payment_modules->process_button();
	  echo tep_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONFIRM_ORDER, 'id="botao_processar"') . '</form>' . "\n";
	}

}

else{ 
  if (isset($$payment->form_action_url)) {
    $form_action_url = $$payment->form_action_url;
  } else {
    $form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
}

  echo tep_draw_form('checkout_confirmation', $form_action_url, 'post');

  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  echo tep_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONFIRM_ORDER, 'onclick="travabotao()" id="botao_processar"') . '</form>' . "\n";
}
}?>
<!-- FIM DO FORMULARIO -->
<div id="carregando" style="border:2px solid #CCC; width:250px; font-family:Tahoma; font-size:13px; font-weight:bold; padding:5px; background-color:#FFF; text-align:left; float:right; display:none;"><table width="100%" cellpadding="0" cellspacing="0"><tr><td><img src="images/carregando.gif" width="42" height="42" /></td><td></td><td>Processando pedido, aguarde...</td></tr></table></div>


            </td>
          </tr>
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
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script language="javascript">
<!--
function travabotao(){
	document.getElementById('carregando').style.display = 'inline';
	document.getElementById('botao_processar').style.display = 'none';
	document.getElementById('botao_voltar').style.display = 'none';
}

function goOn() {
document.getElementById('carregando').style.display = 'inline';
document.getElementById('botao_processar').style.display = 'none';
document.getElementById('botao_voltar').style.display = 'none';	
//document.checkout_confirmation.submit(); // envia o formulário que gera o boleto
self.location.href = '<?=tep_href_link('checkout_process.php')?>'; // vai para página de finalização
}
//-->
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>