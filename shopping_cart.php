<?php
  require("includes/application_top.php");
  if(LOGIN_AUTHENTICCATION=='True'){
// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
 } 
 
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_SHOPPING_CART));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<style>
TABLE.productListing { border: 0px; border-style: solid; border-color: #FFFFFF; border-spacing: 1px; }
.productListing-heading { border:1px solid #CCC;  text-align:center; color: #0076B1; font-weight: bold; padding: 11px; font-family:Tahoma; font-size: 11px; background: #fff; text-transform:uppercase; }
.productListing-data { text-align:center;  padding:3px 3px 3px 3px; font-family: Tahoma; font-size: 11px; color: #D42700; }
.productListing-even{ background-color:#FFFFE1;}
.stockWarning { font-family : Tahoma; font-size : 11px; color: #cc0033; }
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">

  <div id="mainContent" style="width:99%; margin:0 auto; padding:10px 0 0 0;">


	<div class="tituloCompra"><span><?php echo HEADING_TITLE; ?></span></div>
    <div class="pagestexto" style="width:100%;">
    <?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_SHOPPING_CART, 'action=update_product','SSL')); ?>


<?php 

if ($cart->count_contents() > 0) { 

    $info_box_contents = array();
    $info_box_contents[0][] = array('align' => 'center',
                                    'params' => 'class="productListing-heading" width="80"',
                                    'text' => TABLE_HEADING_REMOVE);

    $info_box_contents[0][] = array('params' => 'class="productListing-heading"',
                                    'text' => TABLE_HEADING_PRODUCTS);

    $info_box_contents[0][] = array('align' => 'center',
                                    'params' => 'class="productListing-heading" width="80"',
                                    'text' => TABLE_HEADING_QUANTITY);

    $info_box_contents[0][] = array('align' => 'right',
                                    'params' => 'class="productListing-heading" width="150"',
                                    'text' => TABLE_HEADING_TOTAL);

    $any_out_of_stock = 0;
	
	if(!isset($customer_revenda)||($customer_revenda==0))//VERIFICANDO TIPO DE CONSUMIDOR	
    $products = $cart->get_products();
	else
	$products = $cart->get_products_revenda();
	
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
// Push all attributes information in an array
      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        while (list($option, $value) = each($products[$i]['attributes'])) {
          echo tep_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
          $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                                      from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . $products[$i]['id'] . "'
                                       and pa.options_id = '" . $option . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . $value . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . $languages_id . "'
                                       and poval.language_id = '" . $languages_id . "'");
          $attributes_values = tep_db_fetch_array($attributes);

          $products[$i][$option]['products_options_name'] = $attributes_values['products_options_name'];
          $products[$i][$option]['options_values_id'] = $value;
          $products[$i][$option]['products_options_values_name'] = $attributes_values['products_options_values_name'];
          $products[$i][$option]['options_values_price'] = $attributes_values['options_values_price'];
          $products[$i][$option]['price_prefix'] = $attributes_values['price_prefix'];
        }
      }
    }

    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (($i/2) == floor($i/2)) {
        $info_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $info_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($info_box_contents) - 1;

      $info_box_contents[$cur_row][] = array('align' => 'center',
                                             'params' => 'class="productListing-data"',
                                             'text' => tep_draw_checkbox_field('cart_delete[]', $products[$i]['id'], '', 'onClick="confSubmit(this.form);" id="checkbox['.$products[$i]['id'].']"'));	   

		
		//'    <td align="center" ><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '&produto='.$novo_nome.'">' . tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $products[$i]['image'], addslashes($products[$i]['name']), 'YES','SP', 'vspace="0"'). '</a></td>' .

      $products_name = '<table border="0" cellspacing="0" cellpadding="0" width="100%">' .
                       '  <tr>' .
                       
                       '    <td align="left" height="35"><a style="color:#000; font-size:11px" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '"><b>' . $products[$i]['name'] . '</b></a>'; 

      if (STOCK_CHECK == 'true') {
        $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity']);
		
        if (tep_not_null($stock_check)) {
          $any_out_of_stock = 1;

		$compl = '';
		if(STOCK_ALLOW_CHECKOUT == 'false')
		$compl = '<span class="smallText"> Quantidade máxima disponível em nosso estoque ('.tep_get_products_stock($products[$i]['id']).') </span>';
		
          $products_name .= '<span style="color:#cc0033"> '.$stock_check.'</span> '.$compl;
        }
      }

      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        reset($products[$i]['attributes']);
        while (list($option, $value) = each($products[$i]['attributes'])) {
          $products_name .= '<br><small><i> - ' . $products[$i][$option]['products_options_name'] . ' ' . $products[$i][$option]['products_options_values_name'] . '</i></small>';
        }
      }

      $products_name .= '    </td>' .
                        '  </tr>' .
                        '</table>';

      $info_box_contents[$cur_row][] = array('params' => 'class="productListing-data"',
                                             'text' => $products_name);

      if ($products[$i]['quantity']==1) {
$minus_field = tep_image(DIR_WS_IMAGES . 'minusBtn.gif', 'remover', '', '',  'onclick="javascript:check(\'checkbox['.$products[$i]['id'].']\'); javascript:document.cart_quantity.submit();"');
} else {
$minus_field = '<a href="javascript:changeQuantity(&quot;'.$products[$i]['id'].'&quot;,-1)">'.tep_image(DIR_WS_IMAGES .'minusBtn.gif').'</a>';
}
      $info_box_contents[$cur_row][] = array('align' => 'center',
                                             'params' => 'class="productListing-data" valign="middle"',
                                             'text' => $minus_field . tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'], 'size="4" onChange="UpdateCartQuantity();" style="vertical-align:top;margin-left:2px; margin-right:2px;" id="qty_'.$products[$i]['id'].'"').'<a href="javascript:changeQuantity(&quot;'.$products[$i]['id'].'&quot;, 1)">'.tep_image(DIR_WS_IMAGES .'plusBtn.gif').'</a>'. tep_draw_hidden_field('products_id[]', $products[$i]['id']));


      $info_box_contents[$cur_row][] = array('align' => 'right',
                                             'params' => 'class="productListing-data" valign="middle"',
                                             'text' => '<b>' . $currencies->display_price($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) . '</b>');
    }

    new productListingBox($info_box_contents);
?>


<div style="color: #0076B1;  font-size:11px; padding-right:15px; padding-left:25px; text-transform:none; height:30px; border-top:1px solid #CCC; border-bottom:1px solid #CCC; text-transform:uppercase; font-family:Tahoma; padding-top:15px;">
	<b><?php echo SUB_TITLE_SUB_TOTAL; ?></b>
    <span style="color:#D42700; font-size:13px; font-weight:bold; float:right; text-align:center; width:150px;"><?php if(!isset($customer_revenda)||($customer_revenda==0)) echo $currencies->format($cart->show_total()); else echo $currencies->format($cart->show_total_revenda()); ?>
    </span>
</div>

<?php
    if ($any_out_of_stock == 1) {
      if (STOCK_ALLOW_CHECKOUT == 'true') {
?>
<div class="stockWarning"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div> 
<script type="text/javascript">alert('<?=OUT_OF_STOCK_CAN_CHECKOUT_JAVASCRIPT?>')</script>
<?php } else { ?>
<div class="stockWarning"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?>
<script type="text/javascript">alert('<?=OUT_OF_STOCK_CANT_CHECKOUT_JAVASCRIPT?>')</script>
</div> 
<?php } } ?>

<div style="margin-top:10px; text-align:right">
	<div style="float:left; width:270px; text-align:center; border:2px #4295D9 dashed; padding:3px;">
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php if( MODULE_ORDER_TOTAL_DISCOUNT_COUPON_STATUS == 'true' ) { ?>
  <tr>
	<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
	  <tr>
		<td class="main"><b>Você possui um código promocional ou cupom de desconto?</b></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td><table border="0" width="100%" cellspacing="1" cellpadding="2" height="50">
	  <tr class="infoBoxContents2">
		<td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
		  <tr>
			<td class="main"><?php //echo ENTRY_DISCOUNT_COUPON.'<br/> '.tep_draw_input_field('coupon', '', 'size="32"'); ?></td>
		  </tr>
		</table></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td><?php //echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
<?php } /* end kgt - discount coupons */ ?> 
</table>-->
<div style="background-color:#4295D9; color:#FFF">Caso possua um <span style="font-size:15px;"><b>Cumpom de Desconto</b></span>, favor inseri-lo no campo indicado alguns passos a frente!</div>
</div>
<div style="float:right">
<?php 
//echo tep_image_submit('button_update_cart.gif', IMAGE_BUTTON_UPDATE_CART); 
$back = sizeof($navigation->path)-2;
if (isset($navigation->path[$back]))
echo '&nbsp;<a href="' . tep_href_link($navigation->path[$back]['page'], tep_array_to_string($navigation->path[$back]['get'], array('action')), $navigation->path[$back]['mode']) . '">' . tep_image_button('button_continue_shopping.gif', IMAGE_BUTTON_CONTINUE_SHOPPING) . '</a>&nbsp;'; 			
echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image_button('button_checkout.gif', IMAGE_BUTTON_CHECKOUT) . '</a>'; ?>
</div>
<div style="clear:both"></div>
</div>
<?php
  } else {
?>
      <tr>
        <td style="background: #F6E4DF"  align="center" class="main"><?php new infoBox(array(array('text' => TEXT_CART_EMPTY))); ?></td>
      </tr>
      <tr>
        <td style="background: #F6E4DF"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td style="background: #F6E4DF"><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
	<tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	<tr>
    	<td class="main"><b>Instruções</b></td>
    </tr> 
    <tr>
    	<td>
        	<div style="font-family:Tahoma; font-size:11px; width:400px; border:1px dashed #F00; padding:5px;">
        	Para retirar um item de seu Carrinho clique no <?=tep_image(DIR_WS_IMAGES .'delete_transp.gif')?> à sua direita.<br />
			Para alterar a quantidade de um item, clique nos botões <?=tep_image(DIR_WS_IMAGES .'plusBtn.gif')?>,<?=tep_image(DIR_WS_IMAGES .'minusBtn.gif')?> para aumentar, diminuir respectivamente ou altere diretamente o número especificado para quantidade desejada e pressione ENTER.<br />
			Clique em <b>Finalizar compra</b> para definir o meio de entrega e pagamento desejado.
            </div>
        </td>
    </tr>  
    </table></form>
    
   <center> <img src="images/info-pagamentos-carrinho.jpg" /> </center>
    </div>

  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1055985706;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1055985706/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<script language="javascript" type="text/javascript">
function UpdateCartQuantity()
{
  document.cart_quantity.submit();
}
function changeQuantity(i,qty)
{
	document.cart_quantity['qty_'+i].value = Number(document.cart_quantity['qty_'+i].value)+Number(qty);
	UpdateCartQuantity();
}
function confSubmit(form) {
form.submit();
}
 function check(checkboxid) {  
 document.getElementById(checkboxid).checked = "checked";  
 }  
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>