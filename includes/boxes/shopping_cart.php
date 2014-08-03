<div class="box" id="carrinho">
<div class="lay_bordaBox"><span>Carrinho de compra</span></div>
<div class="boxconteudo">
<?php
  $cart_contents_string = '';
  if ($cart->count_contents() > 0) {
    $cart_contents_string = '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      $cart_contents_string .= '<tr><td align="right" valign="top" class="infoBoxContents">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $cart_contents_string .= '<span class="newItemInCart">';
      } else {
        $cart_contents_string .= '<span class="infoBoxContents">';
      }

      $cart_contents_string .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top" class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $cart_contents_string .= '<span class="newItemInCart">';
      } else {
        $cart_contents_string .= '<span class="infoBoxContents">';
      }

      $cart_contents_string .= $products[$i]['name'] . '</span></a></td></tr>';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        tep_session_unregister('new_products_id_in_cart');
      }
    }
    $cart_contents_string .= '</table>';
  } else {
    $cart_contents_string .= '<div style="color:#000066; font-size:15px; font-weight:bold; font-family:Arial Black; text-align:left; padding-left:5px;">Carrinho Vazio</div>';
  }

  echo $cart_contents_string;
  
  if($customer_revenda==0)//VERIFICANDO TIPO DE CONSUMIDOR
  $total = $cart->show_total();
  else
  $total = $cart->show_total_revenda();

  if ($cart->count_contents() > 0) {
    echo tep_draw_separator();
    echo '<div style="color:#000066; font-size:18px; font-weight:bold; font-family:Arial ; text-align:left; padding-left:5px;">'.$currencies->format($total).'</div><br> <a class="ml2" href="'.tep_href_link('shopping_cart.php').'" style="color:#333;">&raquo;&nbsp;&nbsp;Finalizar compra</a>';
  }
?>
</div>
</div>