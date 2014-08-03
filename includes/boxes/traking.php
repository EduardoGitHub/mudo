<?
$shipping1 = strpos(MODULE_SHIPPING_INSTALLED, 'sedex');
$shipping2 = strpos(MODULE_SHIPPING_INSTALLED, 'paclocal.php');
if(($shipping1 !== false) or ($shipping2 !== false)){
?>
<div class="box" id="rastrear">
<div class="lay_bordaBox"><span>Rastrear pedido</span></div>
<div class="boxconteudo">
    <form method="get" target="_blank" action="http://websro.correios.com.br/sro_bin/txect01$.QueryList?" name="rastreamento">
    <input type="hidden" name="P_TIPO" value="001" />
    <center><?=tep_image('images/correios.jpg','Correios')?></center><br />
    Número do Objeto:<br />
    <textarea name="P_COD_UNI" cols="30" rows="4" style="border:1px solid #CCC;" onClick="limpa_modelo();">Informe aqui o número do objeto fornecido pela loja, ex: SR398190350BR</textarea>
    <input type="hidden" name="P_LINGUA" value="001" checked="checked" />
    <input type="submit" value="Rastrear" />
    </form>
</div>
</div>	
<? }?>					