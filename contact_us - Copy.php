<?php
  require('includes/application_top.php');
  require("includes/modules/email/class.phpmailer.php");
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);

  
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
  $error = false;
    $name = tep_db_prepare_input($HTTP_POST_VARS['name']);
	$type = tep_db_prepare_input($HTTP_POST_VARS['tipo']);
	$telephone = tep_db_prepare_input($HTTP_POST_VARS['telefone']);
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email']);
	$email_address_confirmation = tep_db_prepare_input($HTTP_POST_VARS['email_confirmation']);
    $enquiry = tep_db_prepare_input($HTTP_POST_VARS['enquiry']);
	$city = tep_db_prepare_input($HTTP_POST_VARS['cidade']);
	$state = tep_db_prepare_input($HTTP_POST_VARS['estado']);
	$arquivos = tep_db_prepare_input($HTTP_POST_VARS['arquivos']);
	
	if (empty($name)) {
      $error = true;
      $messageStack->add('contact', ERROR_NAME);
    }
	if (empty($enquiry)) {
      $error = true;
      $messageStack->add('contact', ERROR_ENQUIRY);
    }
	
	if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }else if($email_address != $email_address_confirmation){
		$error = true;

      	$messageStack->add('contact', 'Os e-mails não conferem. Verifique se o e-mails esta digita corretamente.');
	}	
				   
				   
	$html = '		Nome: '.$HTTP_POST_VARS['name'].'<br/>
					E-Mail: '.$email_address.'<br/>
					Telefone: '.$telephone.'<br/>
					Cidade:'.$city.'<br/>
					Estado:'.$state.'<br/>
					Mensagem: '.$enquiry.'
				';			   
	
	define('EMAIL_SUBJECT', $type.' a ' . STORE_NAME);
	
    if (tep_validate_email($email_address)) {
	  tep_sendMail('atendimento@mudominhacasa.com.br', EMAIL_SUBJECT, $html, $name, $email_address);
	  //tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $text_format, $name, $email_address);
	  if($arquivos == 1) tep_redirect(tep_href_link('envie-seus-arquivos-fale-conosco.php', 'nome='.$name.'&email='.$email_address.'&telefone='.$telephone.'&type='.$type.'&url=fale-conosco.html'));
	  else tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
    } else {
      $error = true;

      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
  }


  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONTACT_US));
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

  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
  
  <div class="pagestitulo"><span><?php echo HEADING_TITLE; ?></span></div>
  
  <?php echo tep_draw_form('contact_us', tep_href_link(FILENAME_CONTACT_US, 'action=send')); ?>
  
  <?php if ($messageStack->size('contact') > 0) {?>
  <div class="message"><?php echo $messageStack->output('contact'); ?></div>
  <? }?>
  
  <?  if(isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'success')){ ?>
  <div class="pagestexto">
  <br /><br />
  	<?php echo TEXT_SUCCESS; ?><br /><br />
    <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
  </div>
  <?php }else{ ?>
  
  
  <div class="pagestexto">
  
  <div style="font-size:13px; text-align:justify; padding:15px 0 15px 0; line-height:22px">Olá! Este é o ambiente ideal para começarmos a nos conhecer. Aqui é o lugar onde você descobre um pouco mais sobre nosso trabalho, entra em contato, manda sugestões, faz reclamações, envia elogios (por favor!!!), nos entrega seu currículo ou portfólio, tira suas dúvidas e descobre como é fácil simples e seguro fazer parte desta nossa enorme CASA!</div>
  	
    <div style="font-size:13px;">
  	<b><?php echo ENTRY_TYPE; ?></b><br />
  	<select name="tipo">
    <option value="DÚVIDAS">DÚVIDAS</option>
    <option value="ORÇAMENTOS">ORÇAMENTOS</option>
    <option value="REVENDA – PESSOA FÍSICA">REVENDA – PESSOA FÍSICA</option>
    <option value="REVENDA – LOJISTA">REVENDA – LOJISTA</option>
    <option value="SUGESTÃO">SUGESTÃO</option>
    <option value="RECLAMAÇÃO E ELOGIOS">RECLAMAÇÃO E ELOGIOS</option>
    </select>
    <br /><br />
    
    <b><?php echo ENTRY_NAME; ?></b><br />
	<?php echo tep_draw_input_field('email_confirmation','','size="40"'); ?><br /><br />
    
	<b><?php echo ENTRY_TELEPHONE; ?></b><br />
	<?php echo tep_draw_input_field('telefone','','id="telefone"'); ?><br /><br />
    
    <b>Cidade:</b><br />
    <?php echo tep_draw_input_field('cidade','','size="40"'); ?><br /><br />
    
    <b>Estado:</b><br />
    <?php echo tep_draw_input_field('estado','','size="40"'); ?><br /><br />
    
	<b><?php echo ENTRY_ENQUIRY; ?></b><br />
    <?php echo tep_draw_textarea_field('enquiry', 'soft', 50, 15); ?><br /><br />
    </div>
    
    <div style="text-align:center; font-size:15px; color:#ccc">Você pode nos enviar arquivos na próxima tela!</div>
                                <div style="text-align:center; font-size:12px; color:#000; width:600px; margin:10px auto">Fique a vontade para nos enviar imagens, desenhos ou qualquer outro material que possa nos ajudar a entender o que deseja. Se possível nos envie fotos do local onde deseja decorar.
                                <br /><br />
    
    <input type="checkbox" value="1" name="arquivos" /> Desejo enviar um arquivo para o Mudo Minha Casa<br /><br />
    </div>
 
  </div>
  
  <div> <?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?> </div>
  </form>
  
  <div style="padding:20px 0 20px 0">
  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="46%" align="center" bgcolor="#EAEAEA" class="main" style="padding:10px;">
                <b>Telefones de Contato:</b> (31) 3327-3267 ou 0800 032 1777<br />
<b>Horário de atendimento:</b><br />
Segunda a Sexta de
09:00 às 18:00</b><br />
Belo Horizonte<br />

</td>
                <td width="9%">&nbsp;</td>
                <td width="45%" align="left" bgcolor="#EAEAEA" class="main" style="padding:10px;">
               <b> Contatos via internet:</b><br />
<b>e-mail:</b>   <a href="mailto:mudo@mudominhacasa.com.br">mudo@mudominhacasa.com.br</a><br />
<b>skype:</b>    mudominhacasa<br />
<!--<b>msn:</b>       mudo@mudominhacasa.com.br<br /> -->

                </td>
              </tr>
            </table>
  </div>
  
 <!-- <div><iframe width="800" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=Rua+Aquiles+Lobo,+544,+Floresta,+BH+-+MG&amp;aq=0&amp;oq=Rua+Aquiles+Lobo+544+-+Floresta+bh+mg&amp;sll=-14.239424,-53.186502&amp;sspn=47.485853,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Aquiles+Lobo,+544+-+Floresta,+Belo+Horizonte+-+Minas+Gerais,+30150-160&amp;t=m&amp;ll=-19.909285,-43.931322&amp;spn=0.036315,0.068665&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=Rua+Aquiles+Lobo,+544,+Floresta,+BH+-+MG&amp;aq=0&amp;oq=Rua+Aquiles+Lobo+544+-+Floresta+bh+mg&amp;sll=-14.239424,-53.186502&amp;sspn=47.485853,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Aquiles+Lobo,+544+-+Floresta,+Belo+Horizonte+-+Minas+Gerais,+30150-160&amp;t=m&amp;ll=-19.909285,-43.931322&amp;spn=0.036315,0.068665&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>
</div> -->
  
  <?php } ?>
</div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script type="text/javascript" src="includes/librays/jquery.maskedinput.js"></script>
<script type="text/javascript">
jQuery(function($){  
	$("#telefone").mask("(99) 9999-9999");   
});

/* <![CDATA[ */
var google_conversion_id = 1055985706;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1055985706/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>