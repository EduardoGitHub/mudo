<div class="box" id="informacao">
<div class="lay_bordaBox"><span>Login</span></div>
<div class="boxconteudo">
	 <? if (!tep_session_is_registered('customer_id')) {?>
		<div style=" margin-top:15px; margin-left:10px; display:inline-table; float:left; ">
		<!-- LOGIN -->
		<?=tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
		Usuário:<br />
		<?=tep_draw_input_field('email_address', '', 'size="20" maxlength="50"    onclick="this.value=\'\'" value="Informe seu e-mail"   class="se" style="width:130px;" ') . ' ' . tep_hide_session_id()?><br />
		Senha:<br />
		<?=tep_draw_password_field('password', '', 'size="10" maxlength="50"    onclick="this.value=\'\'" value="Senha"   class="se" style="width:100px;"') . ' ' . tep_hide_session_id()?>
		<?=tep_image_submit('button_login2.png', IMAGE_BUTTON_LOGIN,'SSL'); ?>
		</form>
		<!-- FIM LOGIN -->
		</div><br /><br />
		&nbsp;&nbsp;&nbsp;<a href="<?=tep_href_link('password_forgotten.php')?>" style="font-family:Tahoma; font-size:11px; color:#333;">Esqueceu sua senha?</a><br />
		&nbsp;&nbsp;&nbsp;<a href="<?=tep_href_link('login.php')?>" style="font-family:Tahoma; font-size:11px; color:#333;">Cadastre-se  </a><br />
	<? }else if (tep_session_is_registered('customer_id')) {?>
        <div style="width:100%;">
			<br />
            <div style="font-weight:bold; text-align:center;">Você está logado!<br />
            <a href=<?= tep_href_link('account.php')?> style="color:#FFFFFF" title="Minha Conta"><?php echo tep_image('images/icon_account.gif');?></a>&nbsp;&nbsp;<a href=<?=tep_href_link('logoff.php')?> style="color:#FFFFFF" title="Sair da Conta"><?php echo tep_image('images/icon_logoff.gif');?></a>
			</div>
        </div>
     <?php }?>    
</div>
</div>