<?php
  require('includes/application_top.php');
  require("includes/modules/email/class.phpmailer.php");
 
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
  	$error = false;
 	//if($customer_id > 0){
		//$customers_query = tep_db_query("SELECT customers_firstname as cliente, customers_email_address as email FROM CUSTOMERS WHERE customers_id=".$customer_id);
		//$customers_name = tep_db_fetch_array($customers_query);
		define('EMAIL_SUBJECT', ' :: ORÇAMENTO :: ' . STORE_NAME);
	
			$nome = tep_db_prepare_input($_POST['nome']);
			$email = tep_db_prepare_input($_POST['email']);
			$telefone = tep_db_prepare_input($_POST['telefone']);
			$cep = tep_db_prepare_input($_POST['cep']);
			
			$erro_email = checa_email($email);
			if($erro_email == "") $sql = mysql_query("INSERT INTO newsletter(email,nome)VALUES('".$email."','".$nome."')");
		
			$nomeCod_op1 = tep_db_prepare_input($_POST['nomeCodop1']);
			$tamanhoLar_op1 = tep_db_prepare_input($_POST['tamanhoLarop1']);
			$tamanhoAlt_op1 = tep_db_prepare_input($_POST['tamanhoAltop1']);
			$enquiry_op1 = tep_db_prepare_input($_POST['enquiryop1']);
		  	$html = '<b>Quero alterar o tamanho do meu modelo!</b><br/>
					
					<b>Nome: </b>'.$nome.'<br/>
					<b>Email: </b>'.$email.'<br/>
					<b>Telefone: </b>'.$telefone.'<br/>
					<b>CEP: </b>'.$cep.'<br/>
					
					<b>Nome e/ou Código:</b> '.$nomeCod_op1.'<br/>
					<b>Tamanho:</b> '.$tamanhoLar_op1.'cm largura x '.$tamanhoAlt_op1.'cm altura<br/>
					<b>Observação:</b> '.$enquiry_op1.'<br/>
					<br/><br/>
					'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME);

		if (tep_validate_email($email)) {
		  tep_sendMail(STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $html, $nome, $email);
		  
		  tep_redirect(tep_href_link('alterar-tamanho-de-sua-imagem.php', 'action=success'));
		} else {
		  $error = true;
	
		  $messageStack->add('alterar-tamanho-de-sua-imagem', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
 	//}else tep_redirect(tep_href_link(FILENAME_LOGIN));
  }
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
<link rel="stylesheet" type="text/css" href="includes/librays/galeria/jquery.ad-gallery.css">
<style type="text/css">
.OrcTitulosLink{font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#1B4B89; color:#FFF; padding-left:5px; height:25px; padding-top:5px;}
.OrcTitulosLink a{ color:#FFF; text-decoration:none; cursor:pointer}
.OrcTitulosLink a:hover{ text-decoration:underline;cursor:pointer}
.OrcTitulos{font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#ccc; color:#000; padding-left:10px; height:30px; padding-top:10px;}
.OrcOpcao{font-family:Tahoma; color:#666; font-size:12px; padding-bottom:10px; padding-top:10px; text-align:left;  text-decoration:none; width:100%; text-align:justify;}
.OrcOpcao .titulos{ font-family:Tahoma; font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#CCC; color:#000; height:20px; padding-top:5px; padding-left:5px; width:100%; margin-top:10px; margin-bottom:10px;}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
      <div class="pagestitulo"><span>Quero alterar o tamanho do meu modelo!</span></div><br/>
      <?php if ($messageStack->size('alterar-tamanho-de-sua-imagem') > 0) echo $messageStack->output('alterar-tamanho-de-sua-imagem'); ?>
 
      <div class="pagestexto">
      <?php echo tep_draw_form('alterar-tamanho-de-sua-imagem', tep_href_link('alterar-tamanho-de-sua-imagem.php', 'action=send'), 'post', 'enctype="multipart/form-data"'); ?>
                  <!--<div class="OrcTitulosLink"><a href="<?= tep_href_link('alterar-tamanho-de-sua-imagem.php')?>">Quero fazer meu Projeto Exclusivo!</a></div>-->
                    <div class="OrcOpcao">
                        <span class="main">&nbsp;&nbsp;&nbsp;Se nenhum dos modelos que você gostou atende às suas necessidades, no quesito tamanho disponível, neste local você pode solicitar um orçamento exclusivo que apresente as alterações no seu produto, fazendo com que ele se adapte direitinho ao espaço que você dispõe...</span><br /><br />
                        
                        <div class="titulos">1° Passo - Seus dados:</div>
                        
                        	Informe seus dados corretamente para que nossa equipe entre em contato com você.<br />
                            <br />	<b>Nome:</b><br />
                            <?php echo tep_draw_input_field('nome','','size="45"'); ?><br />
                            
                            <br />	<b>Email:</b><br />
                            <?php echo tep_draw_input_field('email','','size="45"'); ?><br />
                            
                            <br />	<b>Confirme seu e-mail:</b><br />
                            <?php echo tep_draw_input_field('confirme-email','','size="45"'); ?><br />
                            
                            <br />	<b>Telefone:</b><br />
                            <?php echo tep_draw_input_field('telefone','','size="25"'); ?><br />
                            
                            <br />	<b>CEP:</b><br />
                            <?php echo tep_draw_input_field('cep','','size="25"'); ?><br /><br />
            
                        <div class="titulos">2° Passo - Preencha os campos abaixo:</div>
                        <b>Qual o nome do modelo que você quer alterar?</b><br />
						<?php echo tep_draw_input_field('nomeCodop1',$_GET['nome'],'size="30"'); ?>
                        <br /><br />
            
                        <b>Qual o espaço que você tem disponível, ao qual o modelo deve se adaptar?</b>
                        <br /><br />
            
                        Largura:<?php echo tep_draw_input_field('tamanhoLarop1','','size="15"'); ?>cm <b>X</b> Altura:<?php echo tep_draw_input_field('tamanhoAltop1','','size="15"'); ?>cm.
                        <br /><br />
            
                        <b>Use o campo abaixo para fazer observações e comentários sobre o orçamento, pedir para incluir nomes, incluir bordas ou qualquer idéia que tiver em mente...</b><br />
                        <?php echo tep_draw_textarea_field('enquiryop1', 'soft', 50, 15); ?>
            
                        <div class="titulos">3° Passo - Enviar formulário:</div>
                                <div>
                                    <div style="float:left; width:200px;"><a onclick="history.go(-1)" style="cursor:pointer"><?=tep_image_button('button_back.gif', IMAGE_BUTTON_BACK)?></a></div>
                                    <div style="float:right; width:220px; text-align:right"><?php echo tep_image_submit('button_buguet.gif', IMAGE_BUTTON_CONTINUE); ?></div>
                                    <div style="clear:both"></div>
                                </div>
                    </div>
                </form>     
      </div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script type="text/javascript" src="includes/librays/galeria/jquery.ad-gallery.js"></script>
  <script type="text/javascript">
  $(function() {
    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
  });
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>