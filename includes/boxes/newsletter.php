<div class="box" id="newsletter">
<div class="lay_bordaBox"><span>Receba Informativo</span></div>
<div class="boxconteudo">
<form>
<?= 'Informe seu nome e e-mail abaixo para receber informações sobre o nosso site.<p>'.tep_draw_input_field('nomenewsletter', '', 'size="20" maxlength="50" id="nomenewsletter" onclick="this.value=\'\'" value="Seu nome"   class="se" style="width:150px; margin-bottom:3px;"') . '<br />'.tep_draw_input_field('email', '', 'size="20" maxlength="50" id="email"    onclick="this.value=\'\'" value="Informe seu e-mail"   class="se" style="width:150px;"') . '</p>' . tep_image_button('button_newletter_cad.gif', 'Recebe informativos','onclick="excuteAct(\'inReg\');" style="cursor:pointer;"');
?>
</form>
</div>
</div>