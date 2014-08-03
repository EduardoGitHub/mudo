<?php
function pd_banner_divulgacao() {
$banner = '<table border=0 align=center cellspacing=0 cellpadding=0 class="infoBox">
    <tr><td>
      <table cellspacing=0 cellpadding=10 class="infoBoxContents" align=center><tr><td colspan=9 align=center><strong>Meios de Pagamento</strong></td></tr>
<!--		    <td align=center valign=top><a target=_blank href="https://www.pagamentodigital.com.br/cartaopagamentodigital/"><img src="https://www.pagamentodigital.com.br/webroot/img/img_meios/ct_pd.gif" border="0"  alt="Cartão Pagamento Digital Aura"/><BR />Pagto&nbsp;Digital</a></td>  -->
		    <td align=center valign=top><img src="https://www.pagamentodigital.com.br/img/img_meios/_new.pagamento_visa.gif" border="0"  alt="Visa 12 x"/><BR />12 x</td> 
			<td align=center valign=top><img src="https://www.pagamentodigital.com.br/img/img_meios/_new.pagamento_master.gif" border="0"  alt="Mastercard 12 x"/><BR />12 x</td> 
			<td align=center valign=top><img src="https://www.pagamentodigital.com.br/img/img_meios/_new.pagamento_americans.gif" border="0"  alt="American Express 15 x"/><BR />15 x</td> 
			<td align=center valign=top><img src="https://www.pagamentodigital.com.br/img/img_meios/_new.pagamento_aura.gif" border="0"  alt="Aura 24 x"/><BR />24 x</td> 
			<td align=center valign=top><img src="https://www.pagamentodigital.com.br/img/img_meios/_new.pagamento_diners.gif" border="0"  alt="Diners 12 x"/><BR />12 x</td> 
			<td align=center valign=top><img src="https://www.pagamentodigital.com.br/img/img_meios/_new.pagamento_hipercard.gif" border="0"  alt="HiperCard 12 x"/><BR />12 x</td>
			</tr>
			<tr>
			<td align=center valign=bottom><a target=_blank href="https://www.pagamentodigital.com.br/site/ProdutosServicos/SaldoVirtual/"><img src="https://www.pagamentodigital.com.br/webroot/img/img_meios/cred_virtual.gif" border="0"  alt="Saldo Virtual"/><BR /><small>Saldo Virtual</small></a></td> 
			<td align=center valign=bottom><img src="https://www.pagamentodigital.com.br/img/img_meios/_new.pagamento_boleto.gif" border="0"  alt="Boleto Bancário"/><BR /><small>Boleto</small></td> 
			<td align=center valign=bottom><img src="https://www.pagamentodigital.com.br/webroot/img/img_meios/pagamento_banco_do_brasil.gif" border="0"  alt="Transferência bancária Banco do Brasil"/><BR /><small>Banco do Brasil</small></td> 
			<td align=center valign=bottom><img src="https://www.pagamentodigital.com.br/webroot/img/img_meios/pagamento_banco_bradesco.gif" border="0"  alt="Transferência bancária Bradesco"/><BR /><small>Bradesco</small></td> 
			<td align=center valign=bottom><img src="https://www.pagamentodigital.com.br/webroot/img/img_meios/pagamento_banco_itau.gif" border="0"  alt="Transferência bancária Itaú"/><BR /><small>Itaú</small></td> 
			<td align=center valign=bottom>&nbsp;</td> 
		    </tr></table></td></tr></table><br>';

return $banner;
}
function pd_splitCredit($totalValue,$origem=''){
	// novo módulo com cálculos pelo pagamento digital
	echo '<table border=0 cellpadding=0 cellspacing=0 width=432 align=center>';
	echo '<tr><td width=1%><img src="/loja/images/infobox/corner_left.gif"></td>
              <td width=100% class="infoBoxHeading" nowrap align=center><b>Pagamento Digital - Compre agora pelo site.</b></td>
              <td width=1%><img src="/loja/images/infobox/corner_right.gif"></td>
          </tr>';
	echo '<tr><td colspan=3><iframe name="pagamentodigital"
	src="https://www.pagamentodigital.com.br/site/calcula_parcelamento_cliente.php?valor='.number_format($totalValue,2,",",'').'&key='.MODULE_PAYMENT_PD_CHAVE.'&nmp=24"
	width=432 height=340 frameborder=0 scrolling=auto marginwidth=0 marginheight=0></iframe></td></tr></table>';
}
?>